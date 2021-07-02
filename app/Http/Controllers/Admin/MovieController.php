<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use App\Models\CollectionMovie;
use App\Models\MovieActor;
use App\Models\MovieCategory;
use App\Models\MovieComment;
use App\Models\MovieDirector;
use App\Models\MovieFilmCompanies;
use App\Models\MovieLabel;
use App\Models\Movie;
use App\Models\MovieSeries;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class MovieController extends Controller
{
    /**
     * 影片管理
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.movie.movie');
    }

    /**
     * 资讯数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $model = Movie::query();
        $res = $model->orderBy('id', 'desc')->paginate($request->get('limit', 30));

        $records = $res->toArray();
        $movies = $records['data'];
        foreach ($movies as &$movie) {
            $movie_actor_associate_ids = DB::table('movie_actor_associate')->where('mid', $movie['id'])->pluck('aid')->all();
            $actors = MovieActor::whereIn('id',$movie_actor_associate_ids)->pluck('name')->all();
            $movie['actors'] = join(',',$actors);
        }

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $movies,
        ];
        return Response::json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 更新资讯
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);

        $categories = MovieCategory::pluck('name', 'id')->all();
        $movie_category_associate = DB::table('movie_category_associate')->where('mid', $movie->id)->first();
        $category = MovieCategory::where('id',$movie_category_associate->cid)->first();

        list($series, $movie_series_associate) = $this->categorySelect('series','series_id',$category->name,$movie->id);

        list($companies,$movie_film_companies_associate) = $this->categorySelect('film_companies','film_companies_id',$category->name,$movie->id);

        $directors = MovieDirector::pluck('name', 'id')->all();
        $movie_director_associate = DB::table('movie_director_associate')->where('mid', $movie->id)->first();

        list($labels,$selected_labels) = $this->categoryMultiSelect('label','lid',$category->name,$movie->id,[['cid','>',0]]);

        list($actors,$selected_actors) = $this->categoryMultiSelect('actor','aid',$category->name,$movie->id);

        return View::make('admin.movie.movie_edit',
            compact('movie',
                'categories',
                'movie_category_associate',
                'series',
                'movie_series_associate',
                'companies',
                'movie_film_companies_associate',
                'labels',
                'selected_labels',
                'directors',
                'movie_director_associate',
                'actors',
                'selected_actors'
            )
        );
    }

    private function categorySelect($table,$column,$category,$movie_id,$where=[])
    {
        $movie_n_category = DB::table('movie_'.$table.'_category')->where('name',$category)->first();
        $movie_n_category_associate = DB::table('movie_'.$table.'_category_associate');
        $movie_n_category && ($movie_n_category_associate = $movie_n_category_associate->where('cid',$movie_n_category->id));
        $movie_n_category_associate_ids = $movie_n_category_associate->pluck($column)->all();
        $select = DB::table('movie_'.$table)->where($where)->whereIn('id',$movie_n_category_associate_ids)->pluck('name', 'id')->all();
        $option= DB::table('movie_'.$table.'_associate')->where('mid', $movie_id)->first();
        return [$select,$option];
    }

    private function categoryMultiSelect($table,$column,$category,$movie_id,$where=[])
    {
        $movie_n_category = DB::table('movie_'.$table.'_category')->where('name',$category)->first();
        $select = [];
        $movie_n_model = DB::table('movie_'.$table)->where('status', 1)->where($where);
        $chunk = [];
        $movie_n_category && ($chunk = DB::table('movie_'.$table.'_category_associate')->where('cid',$movie_n_category->id)->pluck($column)->all());
        !empty($chunk) && ($records = $movie_n_model->whereIn('id',$chunk));
        $records = $movie_n_model->orderBy('id','DESC')->get();
        foreach ($records as $record) {
            if($table == 'actor'){
                $sex = $record->sex == '♂' ? '(男)':'';
                $select[$record->id] = urlencode($record->name).' '.$sex;
                continue;
            }
            $select[$record->id] = urlencode($record->name);
        }
        if($table == 'label') {
            $column = 'cid';
        }
        $selected = DB::table('movie_'.$table.'_associate')->where('mid', $movie_id)->pluck($column)->all();
        return [$select,$selected];
    }

    /**
     * 更新资讯
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        try {
            DB::beginTransaction();
            $flux_linkage = (array)json_decode($data['flux_linkage'], true);
            $flux_linkage_num = count($flux_linkage);
            Movie::where('id', $id)->update([
                'name' => $data['name'],
                'release_time' => $data['release_time'],
                'score' => $data['score'],
                'score_people' => $data['score_people'],
                'flux_linkage_num' => $flux_linkage_num,
                'flux_linkage' => json_encode($flux_linkage),
                'is_download' => $data['is_download'],
                'is_subtitle' => $data['is_subtitle'],
                'is_hot' => $data['is_hot']
            ]);
            /*标签*/
            $this->dataAssociate('label',$id,explode(',',$data['labels']),'cid');
            /*演员*/
            $this->dataAssociate('actor',$id,explode(',',$data['actors']),'aid');

            /*导演*/
            $this->associate('director',$id,$data['director'],'did');
            /*系列*/
            $this->associate('series',$id,$data['series'],'series_id');
            /*片商*/
            $this->associate('film_companies',$id,$data['company'],'film_companies_id');
            /*分类*/
            $this->associate('category',$id,$data['category'],'cid');
        } catch (\Exception $exception) {
            DB::rollBack();
            return Redirect::back()->withErrors('更新失败:' . $exception->getMessage());
        }
        DB::commit();
        return Redirect::to(URL::route('admin.movie.movie'))->with(['success' => '更新成功']);
    }

    private function associate($table,$movie_id,$input,$column)
    {
        $movie_director_associate = DB::table('movie_'.$table.'_associate')->where('mid',$movie_id)->first();
        if($movie_director_associate && $movie_director_associate->{$column} !== $input){
            DB::table('movie_'.$table.'_associate')->update([$column=>$input]);
        }else{
            DB::table('movie_'.$table.'_associate')->insert(['mid'=>$movie_id,$column=>$input]);
        }
    }

    private function dataAssociate($table,$movie_id,$data,$column)
    {
        $associate_ids = DB::table('movie_'.$table.'_associate')->where('mid', $movie_id)->pluck($column,'id')->all();
        foreach ($associate_ids as $id=>$associate){
            $index = array_search($associate,$data);
            if($index !== false){
                array_splice($data,$index,1);
                continue;
            }
            DB::table('movie_'.$table.'_associate')->where('id', $id)->delete();
        }
        if(!empty($data)){
            $insertData = [];
            foreach ($data as $item){
                $insertData[] = ['mid'=>$movie_id,$column=>$item];
            }
            DB::table('movie_'.$table.'_associate')->insert($insertData);
        }
    }


}

