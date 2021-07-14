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
use App\Models\MovieScore;
use App\Models\MovieSeries;
use App\Models\Tag;
use App\Models\UserSeenMovie;
use App\Models\UserWantSeeMovie;
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
     *  影片管理
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->method() == 'GET') {
            $categories = DB::table('movie_category')->pluck( 'name','id');
            return View::make('admin.movie.movie',compact('categories'));
        }
        $model = Movie::query();
        $table = 'movie';
        /*search*/
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween($table.'.created_at',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('name')){
            $model = $model->where($table.'.name', $request->input('name'));
        }
        if($request->input('number')){
            $model = $model->where($table.'.number', $request->input('number'));
        }
        if($request->input('category')){
            $model = $model->where('movie_category.name', $request->input('category'));
        }
        $res = $model->leftJoin('movie_category_associate','movie_category_associate.mid',$table.'.id')
            ->join('movie_category','movie_category.id','=','movie_category_associate.cid')
            ->orderBy('id', 'desc')
            ->select($table.'.*','movie_category.name as category')
            ->paginate($request->get('limit', 30));

        $records = $res->toArray();
        $movies = $records['data'];
        foreach ($movies as &$movie) {
            $movie_actor_associate_ids = DB::table('movie_actor_associate')->where('mid', $movie['id'])->pluck('aid')->all();
            $actors = MovieActor::whereIn('id', $movie_actor_associate_ids)->pluck('name')->all();
            $movie['actors'] = join(',', $actors);
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
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        if ($request->method() == 'GET') {
            $category = $request->input('category');
            list($series, $movie_series_associate) = $this->categorySelect('series', 'series_id', $category);

            list($companies, $movie_film_companies_associate) = $this->categorySelect('film_companies', 'film_companies_id', $category);

            $directors = MovieDirector::pluck('name', 'id')->all();

            list($labels, $selected_labels) = $this->categoryMultiSelect('label', 'lid', $category, 0, [['cid', '>', 0]]);

            list($actors, $selected_actors) = $this->categoryMultiSelect('actor', 'aid', $category);

            return View::make('admin.movie.create',
                compact('movie',
                    'categories',
                    'series',
                    'companies',
                    'labels',
                    'directors',
                    'actors'
                )
            );
        }
        $data = $request->all();
        try {
            DB::beginTransaction();
            if(!$data['name']){
                throw new \Exception('名称不能为空');
            }
            if(Movie::where(['number'=>$data['number'],'status'=>1])->exists()){
                throw new \Exception('番号重复');
            }
            $category = DB::table('movie_category')->where('name',$data['category'])->first();
            if(!$category){
                throw new \Exception('分类错误');
            }
            $category_id = $category->id;

            $flux_linkage = (array)json_decode($data['flux_linkage'], true);
            $flux_linkage_num = count($flux_linkage);
            $id = Movie::insertGetId([
                'name' => $data['name'],
                'number'=>$data['number'],
                'release_time' => $data['release_time'],
                'score' => (int)$data['score'],
                'flux_linkage_num' => $flux_linkage_num,
                'flux_linkage' => json_encode($flux_linkage),
                'time'=>$data['time'],
                'sell'=>$data['sell'],
                'is_download' => $data['is_download'],
                'is_subtitle' => $data['is_subtitle'],
                'is_hot' => $data['is_hot']
            ]);

            /*标签*/
            $this->dataAssociate('label', $id, explode(',', $data['labels']), 'cid');
            /*演员*/
            $this->dataAssociate('actor', $id, explode(',', $data['actors']), 'aid');

            /*导演*/
            $this->associate('director', $id, $data['director'], 'did');
            /*系列*/
            $this->associate('series', $id, $data['series'], 'series_id');
            /*片商*/
            $this->associate('film_companies', $id, $data['company'], 'film_companies_id');
            /*分类*/
            $this->associate('category', $id, $category_id, 'cid');
        } catch (\Exception $exception) {
            DB::rollBack();
            return Redirect::back()->withErrors('更新失败:' . $exception->getMessage());
        }
        DB::commit();
        return Redirect::to(URL::route('admin.movie.movie'))->with(['success' => '更新成功']);
    }

    /**
     * 更新资讯
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id)
    {
        if ($request->method() == 'GET') {
            $movie = Movie::findOrFail($id);

            $categories = MovieCategory::pluck('name', 'id')->all();
            $movie_category_associate = DB::table('movie_category_associate')->where('mid', $movie->id)->first();
            $category = MovieCategory::where('id', $movie_category_associate->cid)->first();

            list($series, $movie_series_associate) = $this->categorySelect('series', 'series_id', $category->name, $movie->id);

            list($companies, $movie_film_companies_associate) = $this->categorySelect('film_companies', 'film_companies_id', $category->name, $movie->id);

            $directors = MovieDirector::pluck('name', 'id')->all();
            $movie_director_associate = DB::table('movie_director_associate')->where('mid', $movie->id)->first();

            list($labels, $selected_labels) = $this->categoryMultiSelect('label', 'lid', $category->name, $movie->id, [['cid', '>', 0]]);

            list($actors, $selected_actors) = $this->categoryMultiSelect('actor', 'aid', $category->name, $movie->id);

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
        $data = $request->all();
        try {
            DB::beginTransaction();
            if(!$data['name']){
                throw new \Exception('名称不能为空');
            }
            $flux_linkage = (array)json_decode($data['flux_linkage'], true);
            $flux_linkage_num = count($flux_linkage);
            Movie::where('id', $id)->update([
                'name' => $data['name'],
                'release_time' => $data['release_time'],
                'score' => $data['score'],
                'flux_linkage_num' => $flux_linkage_num,
                'flux_linkage' => json_encode($flux_linkage),
                'is_download' => $data['is_download'],
                'is_subtitle' => $data['is_subtitle'],
                'is_hot' => $data['is_hot']
            ]);
            /*标签*/
            $this->dataAssociate('label', $id, explode(',', $data['labels']), 'cid');
            /*演员*/
            $this->dataAssociate('actor', $id, explode(',', $data['actors']), 'aid');

            /*导演*/
            $this->associate('director', $id, $data['director'], 'did');
            /*系列*/
            $this->associate('series', $id, $data['series'], 'series_id');
            /*片商*/
            $this->associate('film_companies', $id, $data['company'], 'film_companies_id');
            /*分类*/
            $this->associate('category', $id, $data['category'], 'cid');
        } catch (\Exception $exception) {
            DB::rollBack();
            return Redirect::back()->withErrors('更新失败:' . $exception->getMessage());
        }
        DB::commit();
        return Redirect::to(URL::route('admin.movie.movie'))->with(['success' => '更新成功']);
    }


    private function categorySelect($table, $column, $category, $movie_id = 0, $where = [])
    {
        $movie_n_category = DB::table('movie_' . $table . '_category')->where('name', $category)->first();
        $movie_n_category_associate = DB::table('movie_' . $table . '_category_associate');
        $movie_n_category && ($movie_n_category_associate = $movie_n_category_associate->where('cid', $movie_n_category->id));
        $movie_n_category_associate_ids = $movie_n_category_associate->pluck($column)->all();
        $select = DB::table('movie_' . $table)->where($where)->whereIn('id', $movie_n_category_associate_ids)->pluck('name', 'id')->all();
        $option = [];
        $movie_id>0 && ($option = DB::table('movie_' . $table . '_associate')->where('mid', $movie_id)->first());
        return [$select, $option];
    }

    private function categoryMultiSelect($table, $column, $category, $movie_id=0, $where = [])
    {
        $movie_n_category = DB::table('movie_' . $table . '_category')->where('name', $category)->first();
        $select = [];
        $movie_n_model = DB::table('movie_' . $table)->where('status', 1)->where($where);
        $chunk = [];
        $movie_n_category && ($chunk = DB::table('movie_' . $table . '_category_associate')->where('cid', $movie_n_category->id)->pluck($column)->all());
        !empty($chunk) && ($movie_n_model = $movie_n_model->whereIn('id', $chunk));
        $records = $movie_n_model->orderBy('id', 'DESC')->get();
        foreach ($records as $record) {
            if ($table == 'actor') {
                $sex = $record->sex == '♂' ? '(男)' : '';
                $select[$record->id] = urlencode($record->name) . ' ' . $sex;
                continue;
            }
            $select[$record->id] = urlencode($record->name);
        }
        if ($table == 'label') {
            $column = 'cid';
        }
        $selected = [];
        $movie_id>0 && ($selected = DB::table('movie_' . $table . '_associate')->where('mid', $movie_id)->pluck($column)->all());
        return [$select, $selected];
    }

    private function associate($table, $movie_id, $input, $column)
    {
        $movie_director_associate = DB::table('movie_' . $table . '_associate')->where('mid', $movie_id)->first();
        if ($movie_director_associate && $movie_director_associate->{$column} !== $input) {
            DB::table('movie_' . $table . '_associate')->where('id',$movie_director_associate->id)->update([$column => $input]);
        } else {
            DB::table('movie_' . $table . '_associate')->insert(['mid' => $movie_id, $column => $input]);
        }
    }

    private function dataAssociate($table, $movie_id, $data, $column)
    {
        $associate_ids = DB::table('movie_' . $table . '_associate')->where('mid', $movie_id)->pluck($column, 'id')->all();
        foreach ($associate_ids as $id => $associate) {
            $index = array_search($associate, $data);
            if ($index !== false) {
                array_splice($data, $index, 1);
                continue;
            }
            DB::table('movie_' . $table . '_associate')->where('id', $id)->delete();
        }
        if (!empty($data)) {
            $insertData = [];
            foreach ($data as $item) {
                $insertData[] = ['mid' => $movie_id, $column => $item];
            }
            DB::table('movie_' . $table . '_associate')->insert($insertData);
        }
    }


    public function scoreList(Request $request)
    {
        if ($request->method() == 'GET') {
            return View::make('admin.movie.scoreList');
        }

        $model = MovieScore::query();
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween('movie_score_notes.created_at',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('score')){
            $model = $model->where('movie_score_notes.score', $request->input('score'));
        }
        if($request->input('number')){
            $model = $model->where('movie.number', $request->input('number'));
        }
        $res = $model->orderBy('movie_score_notes.id', 'DESC')
            ->where('movie_score_notes.source_type', 1)
            ->join('user_client', 'user_client.id', '=', 'movie_score_notes.uid')
            ->join('movie', 'movie.id', '=', 'movie_score_notes.mid')
            ->select('movie_score_notes.id', 'movie_score_notes.score_time', 'movie_score_notes.score',
                'movie.number', 'movie.name as movie_name',
                'user_client.nickname')
            ->paginate($request->get('limit', 30));

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $res->items(),
        ];
        return Response::json($data);
    }

    public function commentList(Request $request)
    {
        if ($request->method() == 'GET') {
            return View::make('admin.movie.commentList');
        }

        $model = MovieComment::query();
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween('movie.release_time',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('number')){
            $model = $model->where('movie.number', $request->input('number'));
        }
        if($request->input('nickname')){
            $model = $model->where('user_client.nickname', $request->input('nickname'));
        }
        $res = $model->orderBy('movie_comment.id', 'DESC')
            ->join('user_client', 'user_client.id', '=', 'movie_comment.uid')
            ->join('movie', 'movie.id', '=', 'movie_comment.mid')
            ->select('movie_comment.id', 'movie_comment.comment_time',
                'movie.number', 'movie.name as movie_name',
                'user_client.nickname')
            ->paginate($request->get('limit', 30));

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $res->items(),
        ];
        return Response::json($data);
    }

    public function wantSeeList(Request $request)
    {
        if ($request->method() == 'GET') {
            return View::make('admin.movie.wantSeeList');
        }

        $model = UserWantSeeMovie::query();
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween('user_want_see_movie.created_at',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('number')){
            $model = $model->where('movie.number', $request->input('number'));
        }
        if($request->input('nickname')){
            $model = $model->where('user_client.nickname', $request->input('nickname'));
        }

        $res = $model->orderBy('user_want_see_movie.id', 'DESC')
            ->join('user_client', 'user_client.id', '=', 'user_want_see_movie.uid')
            ->join('movie', 'movie.id', '=', 'user_want_see_movie.mid')
            ->select('user_want_see_movie.id', 'user_want_see_movie.mark_time',
                'movie.number', 'movie.name as movie_name',
                'user_client.nickname')
            ->paginate($request->get('limit', 30));

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $res->items(),
        ];
        return Response::json($data);
    }

    public function sawList(Request $request)
    {
        if ($request->method() == 'GET') {
            return View::make('admin.movie.sawList');
        }

        $model = UserSeenMovie::query();
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween('user_want_see_movie.created_at',[trim($date[0]),trim($date[1])]);
        }
        if($request->input('number')){
            $model = $model->where('movie.number', $request->input('number'));
        }
        if($request->input('nickname')){
            $model = $model->where('user_client.nickname', $request->input('nickname'));
        }
        $res = $model->orderBy('user_seen_movie.id', 'DESC')
            ->join('user_client', 'user_client.id', '=', 'user_seen_movie.uid')
            ->join('movie', 'movie.id', '=', 'user_seen_movie.mid')
            ->select('user_seen_movie.id', 'user_seen_movie.mark_time','user_seen_movie.score',
                'movie.number', 'movie.name as movie_name',
                'user_client.nickname')
            ->paginate($request->get('limit', 30));

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $res->items(),
        ];
        return Response::json($data);
    }

}

