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
use App\Models\MovieNumbers;
use App\Models\MovieFilmCompanies;
use App\Models\Tag;
use App\Models\User;
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

        $resourceStatus = [
            '1'=>'未处理',
            '2'=>'已下载',
            '3'=>'下载失败'
        ];

        $where = array();
        //创建时间
        $data = explode('~', $request->input('date'));
        if (isset($data[0]) && isset($data[1])) {
            $where['updated_at >'] = trim($data[0]);
            $where['updated_at <'] = trim($data[1]);
        }
        //下载状态
        if($request->input('resources_status')){
            $where['resources_status'] = $request->input('resources_status');
        }else{
            $where['resources_status'] = 3;
        }
        //处理状态
        if($request->input('status')){
            $where['status'] = $request->input('status');
        }else{
            $where['status'] = 1;
        }
        //查询用户名
        if($request->input('username')){
            //查询uid
            $oUser = User::select("id")->where('username',$request->input('username'))->first();
            $uid = isset($oUser->id)?$oUser->id:0;

            $where['admin_id'] = $uid;
        }
        //查询番号
        if($request->input('number')){
            $where['number'] = $request->input('number');
        }

        //分页参数
        $limit = intval($request->input('limit'));
        $p = intval($request->input('page'));
        $offset = ($p-1) * $limit;

        //总记录数
        $mdb = new CollectionMovie();
        $total = $mdb->total($where);

        //读取列表
        $items = $mdb->lists($where,'id,number,name,time,resources_status,small_cover,status,admin_id,created_at,updated_at',$limit,$offset);

        //循环读取列表
        $aUid = [];
        foreach ($items as $k=>$v){

            //读取列表中的用户id
            if($v->admin_id>0){
                $aUid[] = $v->admin_id;
            }

            //设置状态
            $items[$k]->resources_status = $resourceStatus[$v->resources_status];
        }

        //读取用户名列表
        $keyUser = [];
        if(count($aUid)>0){
            $mUser = User::select('id','username')->whereIn('id',$aUid)->get();
            foreach($mUser as $v){
                 $keyUser[$v->id] = $v->username;
            }
        }

        //更新用户名
        $aUid = [];
        foreach ($items as $k=>$v){
            //更新用户名
            $items[$k]->username = isset($keyUser[$v->admin_id])?$keyUser[$v->admin_id]:'';
        }

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $total,
            'data' => $items,
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
        $res = $model->where('resources_status', '>', 2)->
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
     * 手动同步
    */
    public function synch(Request $request)
    {
        //获取参数
        $id = intval($request->input('id'));
        
        //读取原表数据
        $MVC = CollectionMovie::findOrFail($id);

        //判断是否已经添加
        $movieId = 0;
        $info = Movie::select('number','id')->where('number',$MVC->number)->first();
        if($info && isset($info->id) && $info->id>0){
            $movieId = $info->id;
        }

        //创建番号组
        $dbNum = MovieNumbers::select('id')->where('name',$MVC->number_name)->first();
        if($dbNum && isset($dbNum->id))
        {
            $nId = $dbNum->id; 
        }else{
            MovieNumbers::create($MVC->number_name);
        }

        //创建系列
        $sId = 0;
        $dbSeries = MovieSeries::select('id')->where('name',$MVC->series)->first();
        $sId = isset($dbSeries->id)?$dbSeries->id:0;
        if(!$dbSeries || !$dbSeries->id)
        {
            $sId = MovieSeries::create($MVC->series,1);
            //插入关联表
            DB::table('movie_series_category_associate')->insert(['series_id'=>$sId,'cid'=>1]);
        }

        //创建导演
        $dId = 0;
        $dbDirector = MovieDirector::select('id')->where('name',$MVC->director)->first();
        $dId = isset($dbDirector->id)?$dbDirector->id:0;
        if(!$dbDirector || !$dbDirector->id)
        {
            $dId = MovieDirector::create($MVC->director,1);
        }

        //创建片商
        $fId = 0;
        $dbFilm = MovieFilmCompanies::select('id')->where('name',$MVC->film_companies)->first();
        $fId = isset($dbFilm->id)?$dbFilm->id:0;
        if(!$dbFilm || !$dbFilm->id)
        {
            $fId = MovieFilmCompanies::create($MVC->film_companies,1);
            //插入关联表
            DB::table('movie_film_companies_category_associate')->insert(['film_companies_id'=>$fId,'cid'=>1]);
        }

        //创建标签
        $arrLids = [];
        $arrLabels = ($MVC->label=='""')?[]:json_decode($MVC->label,true);

        if(!is_null($arrLabels)){
            foreach($arrLabels as $v)
            {
                if(!empty(trim($v)))
                {
                    $dbLabel = MovieLabel::select('id')->where('name',$v)->first();
                    $lid = isset($dbLabel->id)?$dbLabel->id:0;

                    if(!$dbLabel || !$dbLabel->id)
                    {
                        $lid = MovieLabel::create($v,1);
                    }
                    //标签id数组
                    $arrLids[] = $lid;
                }
            }
        }

        //创建演员
        $arrAids = [];
        $arrActors = ($MVC->actor=='""')?[]:json_decode($MVC->actor,true);
        if(!is_null($arrActors)){
            foreach($arrActors as $v)
            {
                if($v && count($v)>1)
                {
                    $dbActor = MovieActor::select('id')->where('name',$v[0])->first();
                    $aid = isset($dbActor->id)?$dbActor->id:0;
                    if(!$dbActor || !$dbActor->id)
                    {
                        $aid = MovieActor::create($v[0],1,$v[1],'','[]');
                        //插入关联表
                        DB::table('movie_actor_category_associate')->insert(['aid'=>$aid,'cid'=>1]);
                    }
                    //标签id数组
                    $arrAids[] = $aid;
                }
            }
        }

        //读取分类
        $category = DB::table('movie_category')->where('name',$MVC->category)->first();
        if(!$category){
            throw new \Exception('分类错误');
        }
        $category_id = $category->id;

        //新添加
        //try {
            //保存数据
            $data = array();
            $data['number'] = $MVC->number;
            $data['number_source'] = $MVC->number_source;
            $data['name'] = $MVC->name;
            $data['time'] = $MVC->time;
            $data['release_time'] = $MVC->release_time;

            $data['issued'] = $MVC->issued;
            $data['sell'] = $MVC->sell;
            $data['small_cover'] = $MVC->small_cover;
            $data['big_cove'] = $MVC->big_cove;
            $data['trailer'] = $MVC->trailer;

            $data['map'] = $MVC->map;
            $data['score'] = $MVC->score;
            $data['score_people'] = $MVC->score_people;
            $data['comment_num'] = $MVC->comment_num;
            $data['collection_score'] = $MVC->score;

            $data['collection_score_people'] = $MVC->score_people;
            $data['collection_comment_num'] = $MVC->comment_num;
            $data['wan_see'] = 0;
            $data['seen'] = 0;
            $data['flux_linkage_num'] = $MVC->flux_linkage_num;

            $data['flux_linkage'] = $MVC->flux_linkage;
            $data['status'] = 1;
            $data['is_download'] = $MVC->is_download;
            $data['is_subtitle'] = $MVC->is_subtitle;
            $data['is_hot'] = 1;

            $data['is_short_comment'] = 1;
            $data['is_up'] = 1;
            //$data['new_comment_time'] = '';   //需要参考
            $data['flux_linkage_time'] = $MVC->flux_linkage_time;  //磁链更新时间，需要参考
            $data['oid'] = $id;

            $data['arrLabels']      = $arrLids;
            $data['arrActors']      = $arrAids;
            $data['director']       = $dId;
            $data['series']         = $sId;
            $data['company']        = $fId;
            $data['category_id']    = $category_id;

            //写入数据库
            $movie = new Movie();
            $mid = 0;
            if($movieId==0){
                $mid = $movie->create($data,$category_id);
            }else{
                $mid = $movieId;
                $movie->edit($data,$movieId);
            }

            //更新状态
            if($mid>0){
                CollectionMovie::where('id',$id)->update(['status'=>2]);
            }
        /*} catch (\Exception $exception) {
            DB::rollBack();
            $data = [
                'code' => 1,
                'msg' => '更新失败'. $exception->getMessage(),
            ];
            return Response::json($data);
        }*/

        $data = [
            'code' => 0,
            'msg' => '同步完成',
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

            $map = json_decode($movie->map,true) ;
            $mapData = [];
            foreach ($map as $value)
            {
                (( $value['big_img']??'')=='')?null: $mapData[] = ($value['big_img']??'');
            }
            $movie->map = json_encode($mapData);

            $categories = MovieCategory::where('status',1)->pluck('name', 'id')->all();
            /*寻找类别*/
            $index = array_search($movie->category, $categories);
            $category = ($index !== false) ? $categories[$index] : current($categories);

            $series = $this->categorySelect('series', 'series_id', $category);

            $companies = $this->categorySelect('film_companies', 'film_companies_id', $category);

            $directors = MovieDirector::pluck('name', 'id')->all();

            $labels = $this->categoryMultiSelect('label', 'lid', $category, [['cid', '>', 0]]);
            $selected_labels = [];
            foreach ((array)json_decode($movie->label) as $ac) {
                if (is_string($ac) && $ac !== '') {
                    $selected_labels[] = $ac;
                }
            };

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
                'series',
                'companies',
                'labels',
                'directors',
                'actors',
                'selected_labels',
                'selected_actors'));
        }

        $data = $request->all();

        try {
            DB::beginTransaction();
            $date = date('Y-m-d H:i:s');

            $flux_linkage = (array)json_decode($data['flux_linkage'], true);
            $flux_linkage_num = count($flux_linkage);
            if($flux_linkage_num >0)
            {
                $tempFlux_linkage = [];
                foreach ($flux_linkage as $flux_linkagek=>$flux_linkageval)
                {
                    $tempFlux_linkage[] = [
                        'name'=>$flux_linkageval['name']??'',
                        'url'=>$flux_linkageval['url']??'',
                        'meta'=>$flux_linkageval['meta']??'',
                        'is-small'=> (($flux_linkageval['issmall']??2)==1?1:2) ,
                        'is-warning'=>(($flux_linkageval['iswarning']??2)==1?1:2),
                        'tooltip'=>(($flux_linkageval['tooltip']??2)==1?1:2) ,
                        'time'=>date('Y-m-d H:i:s'),
                    ];
                }
                $flux_linkage = $tempFlux_linkage;
            }

            //处理标签
            $label = '';
            if($data['labels']){
                $arrLabel = explode(',',$data['labels']);
                $t = MovieLabel::select('name')->whereIn('id',$arrLabel)->get();

                $tt = [];
                foreach($t as $v)
                {
                    $tt[] = $v->name;
                }
                $label = json_encode($tt);
            }

            //处理演员
            $actor = '';
            if($data['actors']){
                $arr = explode(',',$data['actors']);
                $t = MovieActor::select('name','sex')->whereIn('id',$arr)->get();

                $tt = [];
                foreach($t as $v)
                {
                    $tt[] = [$v->name,$v->sex];
                }
                $actor = json_encode($tt);
            }


            $d = [
                'number' => $data['number'],
                'name' => $data['name'],
                'time' => $data['time'],
                'release_time' => $data['release_time'],
                'sell' => $data['sell'],

                'director'=>$data['director'],   //导演
                'series'=>$data['series'],       //系列
                'film_companies'=>$data['film_companies'],   //片商
                'category'=>$data['category'],  //分类

                'is_download' => isset($data['is_download'])?$data['is_download']:1,
                'is_subtitle' => $data['is_subtitle'],

                'actor' => $actor,
                'label' => $label,

                'score' => $data['score'],
                'comment_num' => isset($data['comment_num'])?$data['comment_num']:0,
                'score' => $data['score'],
                'flux_linkage_num' => $flux_linkage_num,
                'flux_linkage' => json_encode($flux_linkage),
                
                'created_at' => $date,
                'updated_at' => $date,
                'status' => 2, 
                'admin_id' => Auth::id()
            ];

            CollectionMovie::where('id', $id)->update($d);
    
            /*关联------------------------*/
        } catch (\Exception $exception) {
            DB::rollBack();
            //echo $exception->getMessage();

            return Redirect::to(URL::route('admin.review.movie'))->withErrors('更新失败:' . $exception->getMessage());
        }
        DB::commit();

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
                $select[$record->id] = urlencode($record->name);
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

