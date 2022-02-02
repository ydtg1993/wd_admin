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
use App\Models\MovieLabelCategory;
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
            $categories = MovieCategory::where('status',1)->pluck( 'name','id');
            return View::make('admin.movie.movie',compact('categories'));
        }
        
        $table = 'movie';
        $model = Movie::where($table.'.status',1);
        
        /*search*/
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween($table.'.updated_at',[trim($date[0]),trim($date[1])]);
        }
        $rdate = explode('~',$request->input('rdate'));
        if(isset($rdate[0]) && isset($rdate[1])){
            $model = $model->whereBetween($table.'.release_time',[trim($rdate[0]),trim($rdate[1])]);
        }
        if($request->input('name')){
            $model = $model->where($table.'.name', $request->input('name'));
        }
        if($request->input('is_up')){
            $model = $model->where($table.'.is_up', $request->input('is_up'));
        }
        if($request->input('search_key') && $request->input('search_value')){
            $Val = $request->input('search_value');
            switch($request->input('search_key'))
            {
                /**根据番号搜索*/
                case 'number' :
                    $model = $model->where($table.'.number','like', $Val.'%');
                    break;
                /**根据演员搜索*/
                case 'actor' :
                    $actor = MovieActor::where('name','like', $Val.'%')->select('id')->first();
                    $aid = $actor?$actor->id:0;
                    $model = $model->leftJoin('movie_actor_associate','movie_actor_associate.mid',$table.'.id')
                    ->where('movie_actor_associate.aid','=', $aid);
                    break;
                /**根据系列搜索*/
                case 'series' :
                    $series = MovieSeries::where('name','like', $Val.'%')->select('id')->first();
                    $sid = $series?$series->id:0;
                    $model = $model->leftJoin('movie_series_associate','movie_series_associate.mid',$table.'.id')
                    ->where('movie_series_associate.series_id','=', $sid);
                    break;
                /**根据片商搜索*/
                case 'film_companies' :
                    $film = MovieFilmCompanies::where('name','like', $Val.'%')->select('id')->first();
                    $fid = $film?$film->id:0;
                    $model = $model->leftJoin('movie_film_companies_associate','movie_film_companies_associate.mid',$table.'.id')
                    ->where('movie_film_companies_associate.film_companies_id','=', $fid);
                    break;
                /**根据导演搜索*/
                case 'director' :
                    $director = MovieDirector::where('name','like', $Val.'%')->select('id')->first();
                    $did = $director?$director->id:0;
                    $model = $model->leftJoin('movie_director_associate','movie_director_associate.mid',$table.'.id')
                    ->where('movie_director_associate.did','=', $did);
                    break;
            }
        }

        //排序
        $orderName = empty($request->input('field')) ?'updated_at':$request->input('field');
        $ordertype = empty($request->input('order')) ?'desc':$request->input('order');

        if($request->input('category')){
            $model = $model->where('movie_category.name', $request->input('category'));
        }
        $res = $model->join('movie_category','movie_category.id','=','movie.cid')
            ->orderBy($orderName, $ordertype)
            ->select($table.'.*','movie_category.name as category')
            ->paginate($request->get('limit', 30));

        $records = $res->toArray();
        $movies = $records['data'];
        foreach ($movies as &$movie) {
            $movie_actor_associate_ids = DB::table('movie_actor_associate')->where('mid', $movie['id'])->pluck('aid')->all();
            $actors = MovieActor::whereIn('id', $movie_actor_associate_ids)->pluck('name')->all();
            $movie['actors'] = join(',', $actors);
            $movie['is_up']=($movie['is_up']==1)?'上架':'下架';
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
     * 删除影片
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('ids');
        if (!is_array($ids) || empty($ids)){
            return Response::json(['code'=>1,'msg'=>'请选择删除项']);
        }
        DB::beginTransaction();
        try{
            //删除影片列表
            Movie::rm($ids);
            //删除影片演员关系表
            DB::table('movie_actor_associate')->whereIn('mid',$ids)->delete();
            //删除影片系列关系表
            DB::table('movie_series_associate')->whereIn('mid',$ids)->delete();
            //删除影片片商关系表
            DB::table('movie_film_companies_associate')->whereIn('mid',$ids)->delete();
            //删除影片导演关系表
            DB::table('movie_director_associate')->whereIn('mid',$ids)->delete();
            //删除影片番号关系表
            DB::table('movie_number_associate')->whereIn('mid',$ids)->delete();
            //删除影片标签关系表
            DB::table('movie_label_associate')->whereIn('mid',$ids)->delete();
            //删除影片类型关系表
            DB::table('movie_category_associate')->whereIn('mid',$ids)->delete();
            //删除影片评分记录表
            DB::table('movie_score_notes')->whereIn('mid',$ids)->delete();
            //删除影片浏览记录表
            DB::table('movie_log')->whereIn('mid',$ids)->delete();
            //影片评论表
            DB::table('movie_comment')->whereIn('mid',$ids)->delete();
            DB::commit();
            return Response::json(['code'=>0,'msg'=>'删除成功']);
        }catch (\Exception $exception){
            DB::rollback();
            return Response::json(['code'=>1,'msg'=>'删除失败','data'=>$exception->getMessage()]);
        }
    }

    /**
     * 上架影片
     */
    public function up(Request $request)
    {
        $id = $request->input('id');
        $aIds = explode(',',$id);
        Movie::up($aIds);

        return Response::json(['code'=>0,'msg'=>'下架成功']);
    }

    /**
     * 下架影片
     */
    public function down(Request $request)
    {
        $id = $request->input('id');
        $aIds = explode(',',$id);
        Movie::down($aIds);

        return Response::json(['code'=>0,'msg'=>'下架成功']);
    }

    public function collection(Request $request)
    {
        $id = $request->input('id');
        //获取参数
        $id = intval($request->input('id'));

        //变更自身状态
        Movie::where('id',$id)->update(['status'=>2]);

        //读取原表数据
        $MV = Movie::findOrFail($id);
        $oid = $MV->oid;

        //判断是否已经添加
        $CM = CollectionMovie::select('id')->where('id',$oid)->first();
        if($CM && isset($CM->id) && $CM->id>0)
        {
            //直接变更状态就好
            CollectionMovie::where('id',$CM->id)->update(['resources_status'=>3,'status'=>1]);
        }else{
            //读取关联的基础数据

            //进行番号组处理
            $sGroup = '';
            $numberExp = ['.','-'];
            //切割番号
            $numberGroup = [];
            for($i=0; $i<count($numberExp); $i++)
            {
                $numberGroup = explode($numberExp[$i],$mNumber);
            }
            if(count($numberGroup)>1)
            {
                $sGroup = $numberGroup[0];
            }
            //导演
            $director = MovieDirector::getForMid($id);
            //演员
            $actor = json_encode(MovieActor::getForMid($id));
            //系列
            $series = MovieSeries::getForMid($id);
            //片商
            $film = MovieFilmCompanies::getForMid($id);
            //分类名称
            $category = MovieCategory::getName($id);
            //得到标签
            $label = json_encode(MovieLabel::getForMid($id));

            //同步数据过去
            $data = array();

            $data['number'] = $MV->number;
            $data['number_source'] = $MV->number_source;
            $data['number_name'] = $sGroup;   //番号组
            $data['db_name'] = '';
            $data['name'] = $MV->name;

            $data['source_site'] = '';
            $data['source_url'] = '';
            $data['director'] = $director;   //导演
            $data['sell'] = $MV->sell;
            $data['time'] = $MV->time;
            
            $data['release_time'] = $MV->release_time;
            $data['small_cover'] = $MV->small_cover;
            $data['big_cove'] = $MV->big_cove;
            $data['trailer'] = $MV->trailer;
            $data['map'] = $MV->map;

            $data['series'] = $series;   //系列
            $data['film_companies'] = $film;   //片商
            $data['issued'] = $MV->issued;
            $data['actor'] = $actor;   //演员
            $data['category'] = $category;   //分类

            $data['label'] = $label;   //标签（需要补）
            $data['score'] = $MV->score;
            $data['score_people'] = $MV->score_people;
            $data['comment_num'] = $MV->comment_num;

            $data['actual_source'] = '';
            $data['flux_linkage_num'] = $MV->flux_linkage_num;
            $data['flux_linkage'] = $MV->flux_linkage;
            $data['is_download'] = $MV->is_download;
            $data['is_subtitle'] = $MV->is_subtitle;

            $data['is_new'] = 2;
            $data['status'] = 1;
            $data['resources_status'] = 3;
            $data['resources_info'] = '';   //资源列表（需要补）

            //同步到数据表
            CollectionMovie::insertGetId($data);
        }

        return Response::json(['code'=>0,'msg'=>'操作成功']);
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
            $categories = MovieCategory::where('status',1)->pluck('name', 'id')->all();

            //读取标签分类-包含父亲
            $labelCategory = MovieLabelCategory::listsWithChildren();
            $labelParent = MovieLabel::listsWithChildren();

            return View::make('admin.movie.create',
                compact(
                    'categories',
                    'series',
                    'companies',
                    'labels',
                    'directors',
                    'actors',
                    'labelCategory',
                    'labelParent'
                )
            );
        }


        $data = $request->all();
        try {
            $allowed_extensions = ["png", "jpg", "jpeg", "gif"];
            $maxSize = 5;
            $big_cove = '';
            $small_cover = '';
            $trailer = '';

            if(!(!isset($_FILES['big_cove']) || empty($_FILES['big_cove'])))
            {
                $file = $_FILES['big_cove'];
                if (!($file['error'] != 0))
                {
                    $ext = basename($file['type']);
                    if (!in_array($ext, $allowed_extensions)) {
                        $data['msg'] = '图片类型错误';
                        throw new \Exception('图片类型错误');
                    }
                    if ($file['size'] > $maxSize * 1024 * 1024) {
                        $data['msg'] = "图片大小限制" . $maxSize . "M";
                        throw new \Exception("图片大小限制" . $maxSize . "M");
                    }
                    $base_dir = public_path('resources');
                    $new_dir = '/movie_resources/' . date('Ym') . '/';
                    if (!is_dir($base_dir . $new_dir)) {
                        mkdir($base_dir . $new_dir, 0777, true);
                    }
                    $newFile = substr(md5($file['name'] . time()), 8, 16) . "." . $ext;
                    $res = move_uploaded_file($file['tmp_name'], $base_dir . $new_dir . $newFile);
                    if (!$res) {
                        throw new \Exception("文件上传失败:无文件操作权限");
                    }
                    $big_cove = $new_dir . $newFile;
                }
            }

            if(!(!isset($_FILES['small_cover']) || empty($_FILES['small_cover'])))
            {
                $file = $_FILES['small_cover'];
                if (!($file['error'] != 0))
                {
                    $ext = basename($file['type']);
                    if (!in_array($ext, $allowed_extensions)) {
                        $data['msg'] = '图片类型错误';
                        throw new \Exception('图片类型错误');
                    }
                    if ($file['size'] > $maxSize * 1024 * 1024) {
                        $data['msg'] = "图片大小限制" . $maxSize . "M";
                        throw new \Exception("图片大小限制" . $maxSize . "M");
                    }
                    $base_dir = public_path('resources');
                    $new_dir = '/movie_resources/' . date('Ym') . '/';
                    if (!is_dir($base_dir . $new_dir)) {
                        mkdir($base_dir . $new_dir, 0777, true);
                    }
                    $newFile = substr(md5($file['name'] . time()), 8, 16) . "." . $ext;
                    $res = move_uploaded_file($file['tmp_name'], $base_dir . $new_dir . $newFile);
                    if (!$res) {
                        throw new \Exception("文件上传失败:无文件操作权限");
                    }
                    $small_cover = $new_dir . $newFile;
                }
            }

            if(!(!isset($_FILES['trailer']) || empty($_FILES['trailer'])))
            {
                $file = $_FILES['trailer'];
                if (!($file['error'] != 0))
                {
                    $ext = basename($file['type']);
                    $base_dir = public_path('resources');
                    $new_dir = '/movie_resources/' . date('Ym') . '/';
                    if (!is_dir($base_dir . $new_dir)) {
                        mkdir($base_dir . $new_dir, 0777, true);
                    }
                    $newFile = substr(md5($file['name'] . time()), 8, 16) . "." . $ext;
                    $res = move_uploaded_file($file['tmp_name'], $base_dir . $new_dir . $newFile);
                    if (!$res) {
                        throw new \Exception("文件上传失败:无文件操作权限");
                    }
                    $trailer = $new_dir . $newFile;
                }
            }

            $map = [];
            if(!(!isset($_FILES['map']) || empty($_FILES['map']))) {
                $files = $_FILES['map'];
                if (count($files['name']) > 0) {
                    foreach ($files['name'] as $key => $value) {
                        if($files['name'][$key] == '')
                        {
                            continue;
                        }
                        $ext = basename($files['type'][$key]);
                        if (!in_array($ext, $allowed_extensions)) {
                            $data['msg'] = '图片类型错误';
                            throw new \Exception('图片类型错误');
                        }
                        if ($files['size'][$key] > $maxSize * 1024 * 1024) {
                            $data['msg'] = "图片大小限制" . $maxSize . "M";
                            throw new \Exception("图片大小限制" . $maxSize . "M");
                        }

                        $base_dir = public_path('resources');
                        $new_dir = '/movie_resources/' . date('Ym') . '/';
                        if (!is_dir($base_dir . $new_dir)) {
                            mkdir($base_dir . $new_dir, 0777, true);
                        }
                        $newFile = substr(md5($files['name'][$key] . time()), 8, 16) . "." . $ext;
                        $res = move_uploaded_file($files['tmp_name'][$key], $base_dir . $new_dir . $newFile);
                        if (!$res) {
                            throw new \Exception("文件上传失败:无文件操作权限");
                        }
                        $map[] = ['big_img' => $new_dir . $newFile, 'img' => $new_dir . $newFile];
                    }
                }
            }

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

            $data['flux_linkage_num'] = $flux_linkage_num;
            $data['flux_linkage'] = json_encode($flux_linkage);
            $data['big_cove'] = $big_cove;
            $data['small_cover'] = $small_cover;
            $data['trailer'] = $trailer;
            $data['map'] = json_encode($map);

            $data['arrLabels'] = $data['labels']?explode(',', $data['labels']):'';
            $data['arrActors'] = $data['actors']?explode(',', $data['actors']):'';

            $data['number'] = strtoupper($data['number']);

            $movie = new Movie();
            $movie->create($data,$category_id);

        } catch (\Exception $exception) {
            DB::rollBack();
            return Redirect::back()->withErrors('更新失败:' . $exception->getMessage());
        }

        DB::commit();
        return Redirect::to(URL::route('admin.movie.movie'))->with(['success' => '添加成功']);
    }

    /**
     * 更新
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id)
    {
        if ($request->method() == 'GET') {
            $movie = Movie::findOrFail($id);

            $categories = MovieCategory::where('status',1)->pluck('name', 'id')->all();
            $movie_category_associate = DB::table('movie_category_associate')->where('mid', $movie->id)->first();
            $category = MovieCategory::where('id', $movie->cid)->first();

            list($series, $movie_series_associate) = $this->categorySelect('series', 'series_id', $category->name, $movie->id);

            list($companies, $movie_film_companies_associate) = $this->categorySelect('film_companies', 'film_companies_id', $category->name, $movie->id);

            $directors = MovieDirector::pluck('name', 'id')->all();
            $movie_director_associate = DB::table('movie_director_associate')->where('mid', $movie->id)->first();

            list($labels, $selected_labels) = $this->categoryMultiSelect('label', 'lid', $category->name, $movie->id, [['cid', '>', 0]]);

            list($actors, $selected_actors) = $this->categoryMultiSelect('actor', 'aid', $category->name, $movie->id);
            $map = json_decode($movie->map,true) ;
            $mapData = [];
            foreach ($map as $value)
            {
                (( $value['big_img']??'')=='')?null: $mapData[] = ($value['big_img']??'');
            }
            $movie->map = json_encode($mapData);

            //读取标签分类-包含父亲
            $labelCategory = MovieLabelCategory::listsWithChildren();
            $labelParent = MovieLabel::listsWithChildren();

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
                    'selected_actors',
                    'labelCategory',
                    'labelParent'
                )
            );
        }


        $data = $request->all();

        if(!$data['name']){
            throw new \Exception('名称不能为空');
        }
        $flux_linkage = json_decode($data['flux_linkage'], true);

        $flux_linkage_num = 0 ;
        if($flux_linkage){
            $flux_linkage_num = count($flux_linkage);
        }

        if($flux_linkage_num >0)
        {
            $tempFlux_linkage = [];
            foreach ($flux_linkage as $v)
            {
                if($v['name'] && $v['url'] && $v['meta'])
                {
                    $arr = array();
                    $arr['name'] = $v['name']??'';
                    $arr['url'] = $v['url']??'';
                    $arr['meta'] = $v['meta'];
                    $arr['tooltip'] = ($v['tooltip']==1?1:2);
                    $arr['time'] = $v['time']?$v['time']:date('Y-m-d H:i:s');

                    if(isset($v['is-small'])){
                        $arr['is-small'] = intval($v['is-small']);
                    }
                    if(isset($v['issmall'])){
                        $arr['is-small'] = intval($v['issmall']);
                    }

                    if(isset($v['is-warning'])){
                        $arr['is-warning'] = intval($v['is-warning']);
                    }
                    if(isset($v['iswarning'])){
                        $arr['is-warning'] = intval($v['iswarning']);
                    }

                    $tempFlux_linkage[] = $arr;
                }

            }
            $flux_linkage = $tempFlux_linkage;
        }

        $movie = Movie::findOrFail($id);

        //读取磁链中最新的时间
        $mLinkage = json_decode($movie->flux_linkage,true);
        $fluxTime = strtotime($movie->flux_linkage_time);
        foreach($mLinkage as $v){
            if(strtotime($v["time"])>$fluxTime){
                $fluxTime = strtotime($v["time"]);
            }
        }

        //只有磁链数量+1，磁链更新时间修改
        $data['flux_linkage_time'] = date('Y-m-d H:i:s',$fluxTime);
        if($flux_linkage_num > $movie->flux_linkage_num){
            $data['flux_linkage_time'] = date('Y-m-d H:i:s');
        }

        $data['time'] = $data['time']?$data['time']:0;
        $data['category_id'] = $data['category_id']?$data['category_id']:0;
        $data['flux_linkage_num'] = $flux_linkage_num;
        $data['flux_linkage'] = json_encode($flux_linkage);
        $movie = new Movie();
        $movie->edit($data,$id);

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

