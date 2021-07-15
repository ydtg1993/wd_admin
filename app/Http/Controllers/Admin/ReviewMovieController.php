<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use App\Models\CollectionMovie;
use App\Models\MovieActor;
use App\Models\MovieCategory;
use App\Models\MovieComment;
use App\Models\MovieDirector;
use App\Models\MovieLabel;
use App\Models\Movie;
use App\Models\MovieSeries;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->method() == 'GET') {
            return View::make('admin.review.movie');
        }
        $model = CollectionMovie::query();
        /*search*/
        $data = explode('~', $request->input('date'));
        if (isset($data[0]) && isset($data[1])) {
            $model = $model->whereBetween('collection_movie.created_at', [trim($data[0]), trim($data[1])]);
        }
        if($request->input('status')){
            $model = $model->where('collection_movie.status', $request->input('status'));
        }
        if($request->input('nickname')){
            $model = $model->where('users.nickname', $request->input('nickname'));
        }

        $res = $model->leftJoin('users', 'users.id', '=', 'collection_movie.admin_id')
            ->where('collection_movie.resources_status', '>', 1)
            ->whereIn('collection_movie.status', [1,2])
            ->select('collection_movie.*', 'users.username')
            ->orderBy('collection_movie.id', 'desc')->paginate($request->get('limit', 30));

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $res->items(),
        ];
        return Response::json($data);
    }

    public function error(Request $request)
    {
        if ($request->method() == 'GET') {
            return View::make('admin.review.error');
        }

        $model = CollectionMovie::query();
        /*search*/
        $data = explode('~', $request->input('date'));
        if (isset($data[0]) && isset($data[1])) {
            $model = $model->whereBetween('collection_movie.created_at', [trim($data[0]), trim($data[1])]);
        }
        $res = $model->where('resources_status', '>', 1)->
        where('status', 5)->
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
     * 更新资讯
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Request $request, $id)
    {
        if ($request->method() == 'GET') {
            $movie = CollectionMovie::findOrFail($id);

            $categories = MovieCategory::where('status',1)->pluck('name', 'id')->all();
            /*寻找类别*/
            $index = array_search($movie->category, $categories);
            $category = ($index !== false) ? $categories[$index] : current($categories);

            $series = $this->categorySelect('series', 'series_id', $category);

            $companies = $this->categorySelect('film_companies', 'film_companies_id', $category);

            $directors = MovieDirector::pluck('name', 'id')->all();

            $labels = $this->categoryMultiSelect('label', 'lid', $category, [['cid', '>', 0]]);

            $actors = $this->categoryMultiSelect('actor', 'aid', $category);
            $selected_actors = [];
            foreach ((array)json_decode($movie->actor) as $ac) {
                if (is_array($ac) && isset($ac[0])) {
                    $selected_actors[] = $ac[0];
                    continue;
                }
                if (is_string($ac) && $ac !== '') {
                    $selected_actors[] = $ac;
                }
            };

            return View::make('admin.review.movie_edit', compact(
                'movie',
                'categories',
                'movie_category_associate',
                'series',
                'movie_series_associate',
                'companies',
                'labels',
                'directors',
                'actors',
                'selected_actors'));
        }

        $data = $request->all();
        /*文件锁判断*/
        $lock_path = storage_path('review_movie');
        if (!is_dir($lock_path)) {
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
            if (Movie::where(['number'=>$collect_movie->number,'status'=>1])->first()) {
                throw new \Exception('番号:' . $collect_movie->number . '已经上架');
            }

            CollectionMovie::where('id', $id)->update(['status' => 2, 'admin_id' => Auth::id()]);
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
            MovieDirector::where('name', $collect_movie->director)->increment('movie_sum');

            /*系列关联*/
            $this->associate('series',
                $collect_movie->series,
                ['series_id' => $data['series'], 'mid' => $movie_id],
                $category,
                'series_id'
            );
            MovieSeries::where('id', $data['series'])->increment('movie_sum');

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
            foreach ((array)json_decode($collect_movie->comment, true) as $comment) {
                MovieComment::firstOrCreate([
                    'mid' => $movie_id,
                    'collection_id' => $collect_movie->id,
                    'source_type' => 3,
                    'nickname' => $comment['commentator'],
                    'comment' => $comment['comment_text']
                ], ['comment_time' => $comment['comment_time']]);
            }

            /*关联------------------------*/
        } catch (\Exception $exception) {
            DB::rollBack();
            unlink($lock_path . "/$id");
            return Redirect::to(URL::route('admin.review.movie'))->withErrors('更新失败:' . $exception->getMessage());
        }
        DB::commit();
        unlink($lock_path . "/$id");
        return Redirect::to(URL::route('admin.review.movie'))->with(['success' => '更新成功']);
    }

    private function categorySelect($table, $column, $category, $where = [])
    {
        $movie_n_category = DB::table('movie_' . $table . '_category')->where('name', $category)->first();
        $movie_n_category_associate = DB::table('movie_' . $table . '_category_associate');
        $movie_n_category_id = -1;
        if ($movie_n_category) {
            $movie_n_category_id = $movie_n_category->id;
        }
        $movie_n_category_associate_ids = $movie_n_category_associate->where('cid', $movie_n_category_id)->pluck($column)->all();
        return DB::table('movie_' . $table)->where($where)->whereIn('id', $movie_n_category_associate_ids)->pluck('name', 'id')->all();
    }

    private function categoryMultiSelect($table, $column, $category, $where = [])
    {
        $movie_n_category = DB::table('movie_' . $table . '_category')->where('name', $category)->first();
        $select = [];
        $movie_n_model = DB::table('movie_' . $table)->where('status', 1)->where($where);
        $chunk = [];
        $movie_n_category && ($chunk = DB::table('movie_' . $table . '_category_associate')->where('cid', $movie_n_category->id)->pluck($column)->all());
        $records = $movie_n_model->whereIn('id', $chunk)->orderBy('id', 'DESC')->get();
        foreach ($records as $record) {
            if ($table == 'actor') {
                $sex = $record->sex == '♂' ? '(男)' : '';
                $select[$record->id] = urlencode($record->name) . ' ' . $sex;
                continue;
            }
            $select[$record->id] = urlencode($record->name);
        }

        return $select;
    }

    private function associate($name, $value, $wv, $category = false, $category_associate_key = false)
    {
        if (!$value) {
            return;
        }
        $movie = DB::table('movie_' . $name)->where('name', $value)->first();
        if (!$movie) {
            throw new \Exception("不存在的选项 表:movie_{$name} 选项:{$value}");
        }
        $id = $movie->id;

        $where = [];
        foreach ($wv as $w => $v) {
            if ($v == '.id') {
                $where[$w] = $id;
                continue;
            }
            $where[$w] = $v;
        }
        if (!DB::table('movie_' . $name . '_associate')->where($where)->exists()) {
            DB::table('movie_' . $name . '_associate')->insert($where);
        }
        if (!$category) {
            return;
        }
        $movie_category = DB::table('movie_' . $name . '_category')->where('name', $category)->where('status',1)->first();
        if (!$movie_category) {
            throw new \Exception("不存在分类 表：movie_{$name}_category 选项：{$category}");
        }
        $category_associate = [$category_associate_key => $id];
        $category_associate['cid'] = $movie_category->id;
        if (!DB::table('movie_' . $name . '_category_associate')->where($category_associate)->exists()) {
            DB::table('movie_' . $name . '_category_associate')->insert($category_associate);
        }
    }

    private function labelAssociate($movie_id, $labels)
    {
        foreach ($labels as $label) {
            if (!DB::table('movie_label_associate')->where(['cid' => $label, 'mid' => $movie_id])->exists()) {
                DB::table('movie_label_associate')->insert(['cid' => $label, 'mid' => $movie_id]);
            }
        }
    }

    private function actorAssociate($movie_id, $actors)
    {
        foreach ($actors as $actor) {
            if (!DB::table('movie_actor_associate')->where(['aid' => $actor, 'mid' => $movie_id])->exists()) {
                DB::table('movie_actor_associate')->insert(['aid' => $actor, 'mid' => $movie_id]);
                MovieActor::where('id',$actor)->increment('movie_sum');
            }
        }
    }


}

