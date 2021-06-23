<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use App\Models\CollectionMovie;
use App\Models\MovieComment;
use App\Models\MovieLabel;
use App\Models\Movie;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class ReviewMovieController extends Controller
{
    /**
     * 影片管理
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.review.movie');
    }

    /**
     * 资讯数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $model = CollectionMovie::query();
        $res = $model->where('resources_status', '>', 1)->
        where('status',1)->
        orderBy('id', 'desc')->paginate($request->get('limit', 30));
        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $res->items(),
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
        $movie = CollectionMovie::findOrFail($id);

        $series = ['id' => 0, 'name' => $movie->series];
        $movie_series = DB::table('movie_series')->where('name', $movie->series)->first();
        if ($movie_series) {
            $series['id'] = $movie_series->id;
            $series['name'] = $movie_series->name;
        }

        $film_companies = ['id' => 0, 'name' => $movie->series];
        $movie_film_companies = DB::table('movie_film_companies')->where('name', $movie->film_companies)->first();
        if ($movie_film_companies) {
            $film_companies['id'] = $movie_film_companies->id;
            $film_companies['name'] = $movie_film_companies->name;
        }

        $labels = MovieLabel::where('cid','>',0)->pluck('name', 'id')->all();
        return View::make('admin.review.movie_edit', compact('movie', 'series', 'film_companies','labels'));
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
        /*判断*/
        $lock_path = storage_path('review_movie');
        if (is_dir($lock_path)) {
            mkdir($lock_path, 0777);
        }
        if (file_exists($lock_path . "/$id")) {
            return Redirect::back()->withErrors('请稍等正在提交数据中。。。');
        }
        file_put_contents($lock_path . "/$id", '');
        try {
            DB::beginTransaction();
            $date = date('Y-m-d H:i:s');
            $collect_movie = CollectionMovie::where('id', $id)->first();
            if (Movie::where('number', $collect_movie->number)->first()) {
                throw new \Exception('番号:' . $collect_movie->number . '已经上架');
            }

            CollectionMovie::where('id', $id)->update(['status' => 2, 'admin_id' => '']);
            $flux_linkage = (array)json_decode($data['flux_linkage'], true);
            $flux_linkage_num = count($flux_linkage);
            $movie_id = Movie::insertGetId([
                'number' => $collect_movie->number,
                'name' => $data['name'],
                'time' => $data['time'],
                'release_time' => $data['release_time'],
                'sell' => $data['sell'],
                'small_cover' => $collect_movie->small_cover,
                'big_cove' => $collect_movie->big_cove,
                'trailer' => $collect_movie->trailer,
                'map' => $collect_movie->map,
                'score' => $data['score'],
                'score_people' => $data['score_people'],
                'comment_num' => $data['comment_num'],
                'collection_score' => $collect_movie->score,
                'collection_score_people' => $collect_movie->score_people,
                'collection_comment_num' => $collect_movie->comment_num,
                'flux_linkage_num' => $flux_linkage_num,
                'flux_linkage' => $data['flux_linkage'],
                'is_download' => $data['is_download'],
                'is_subtitle' => $data['is_subtitle'],
                'is_hot' => $data['is_hot'],
                'oid' => $id,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
            $category = $data['category'];
            /*关联------------------------*/
            /*番号关联*/
            $this->associate('number', $collect_movie->number, ['nid' => '.id', 'mid' => $movie_id]);
            /*类别关联*/
            $this->associate('category', $data['category'], ['cid' => '.id', 'mid' => $movie_id]);
            /*导演关联*/
            $this->associate('director', $collect_movie->director, ['did' => '.id', 'mid' => $movie_id]);
            DB::table('movie_director')->where('name', $collect_movie->director)->increment('movie_sum');

            /*系列关联*/
            $this->associate('series',
                $collect_movie->series,
                ['series_id' => $data['series'], 'mid' => $movie_id],
                $category,
                'series_id'
            );
            DB::table('movie_series')->where('id', $data['series'])->increment('movie_sum');
            /*公司关联*/
            $this->associate('film_companies',
                $collect_movie->film_companies,
                ['film_companies_id' => $data['film_companies'], 'mid' => $movie_id],
                $category,
                'film_companies_id'
            );
            DB::table('movie_film_companies')->where('id', $data['film_companies'])->increment('movie_sum');
            /*标签关联*/
            $this->labelAssociate($movie_id, (array)json_decode($data['label'], true));
            /*演员关联*/
            $this->actorAssociate($movie_id, (array)json_decode($data['actor'], true));

            /*评论生成*/
            foreach ((array)json_decode($collect_movie->comment,true) as $comment){
                MovieComment::firstOrCreate([
                    'mid'=>$movie_id,
                    'collection_id'=>$collect_movie->id,
                    'source_type'=>3,
                    'nickname'=>$comment['commentator'],
                    'comment'=>$comment['comment_text']
                ],['comment_time'=>$comment['comment_time']]);
            }

            /*关联------------------------*/
        } catch (\Exception $exception) {
            DB::rollBack();
            unlink($lock_path . "/$id");
            return Redirect::back()->withErrors('更新失败:' . $exception->getMessage());
        }
        DB::commit();
        unlink($lock_path . "/$id");
        return Redirect::to(URL::route('admin.review.movie'))->with(['success' => '更新成功']);
    }

    private function associate($name, $value, $wv, $category = false, $category_associate_key = false)
    {
        if (!$value) {
            return;
        }
        $movie = DB::table('movie_' . $name)->where('name', $value)->first();
        if (!$movie) {
            $id = DB::table('movie_' . $name)->insertGetId(['name' => $value]);
        } else {
            $id = $movie->id;
        }

        $where = [];
        foreach ($wv as $w => $v) {
            if ($v == '.id') {
                $where[$w] = $id;
                continue;
            }
            $where[$w] = $v;
        }
        if (!DB::table('movie_' . $name . '_associate')->where($where)->first()) {
            DB::table('movie_' . $name . '_associate')->insert($where);
        }
        if (!$category) {
            return;
        }
        $movie_category = DB::table('movie_' . $name . '_category')->where('name', $category)->first();
        if (!$movie_category) {
            return;
        }
        $category_associate = [$category_associate_key => $id];
        $category_associate['cid'] = $movie_category->id;
        if (!DB::table('movie_' . $name . '_category_associate')->where($category_associate)->first()) {
            DB::table('movie_' . $name . '_category_associate')->insert($category_associate);
        }
    }

    private function labelAssociate($movie_id, $labels)
    {
        foreach ($labels as $label) {
            if (!DB::table('movie_label_associate')->where(['cid' => $label, 'mid' => $movie_id])->first()) {
                DB::table('movie_label_associate')->insert(['cid' => $label, 'mid' => $movie_id]);
            }
        }
    }

    private function actorAssociate($movie_id, $actors)
    {
        foreach ($actors as $actor) {
            if (!DB::table('movie_actor_associate')->where(['aid' => $actor, 'mid' => $movie_id])->first()) {
                DB::table('movie_actor_associate')->insert(['aid' => $actor, 'mid' => $movie_id]);
            }
        }
    }


}

