<?php

namespace App\Http\Controllers\Admin;

use App\Tools\RedisCache;
use App\Tools\MbEncode;
use App\Models\MovieCategory;
use App\Models\MovieSeries;
use App\Models\MovieDirector;
use App\Models\MovieFilmCompanies;
use App\Models\MovieLabel;
use App\Models\MovieActor;
use App\Models\Movie;
use App\Models\MovieNumbers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MovieUpController extends Controller
{
    protected $keyMovie     = 'moive_number';
    protected $keyCategory  = 'moive_category'; //影片分类缓存key
    protected $keyActor     = 'movie_actor';    //演员缓存key
    protected $keyDirector  = 'movie_director'; //导演缓存key
    protected $keyFilm      = 'movie_film';     //片商缓存key
    protected $keyLabel     = 'movie_label';    //标签缓存key
    protected $keySeries    = 'movie_series';   //系列缓存key
    protected $keyNum       = 'moive_number_group'; //影片番号组缓存key

    //上传影片文件
    public function movieup(Request $request)
    {
        //上传文件最大大小, 单位M 
        $maxSize = 10;
        //支持的表格类型
        $allowed_extensions = ["csv"];
        $file = $request->file('file');

        //检查文件是否上传完成
        if ($file->isValid()){
            //检测文件类型
            $ext = $file->getClientOriginalExtension();
            if (!in_array(strtolower($ext),$allowed_extensions)){
                echo "请上传".implode(",",$allowed_extensions)."格式的表格文件";
                exit();
            }
            //检测文件大小
            if ($file->getSize() > $maxSize*1024*1024){
                echo"文件大小限制".$maxSize."M";
                exit();
            }
        }else{
            echo $file->getErrorMessage();
            exit();
        }
        $newFile = date('Y-m-d')."_".time()."_".uniqid().".".$file->getClientOriginalExtension();
        $disk = Storage::disk('uploads');
        $res = $disk->put($newFile,file_get_contents($file->getRealPath()));
        if(!$res){
            echo $file->getErrorMessage();
            exit();
        }

        $jUrl = route('admin.movie.movie.mvdo',['path'=>$newFile,'p'=>1]);
        echo '<script>window.location.href="'.$jUrl.'"</script>';
    }

    /**
     * 处理影片数据 
     */
    public function movieDo(Request $request,$path,$p)
    {
        //获取完整路径
        $filePath = $_SERVER['DOCUMENT_ROOT'].'/uploads/local/'.$path;

        //读取数据
        $lineSize = 0;
        
        $lists = $this->readExcel($filePath,($p-1)*50,$lineSize);

        //得到总页数
        $allPage = ceil($lineSize / 50);

        $movie = new Movie();
        foreach($lists as $v)
        {          
            //少于13列，直接跳过
            if(count($v) < 13)
            {
                echo '<p>跳过数据不全：'.PHP_EOL.'</p>';
                continue;
            }

            $mName      = trim(trim($v[0]),'"');    //名称
            $mNumber    = trim(trim($v[1]),'"');    //番号
            $mCategory  = trim(trim($v[2]),'"');    //分类
            $mSeries    = trim(trim($v[3]),'"');    //系列
            $mSell      = trim(trim($v[4]),'"');    //卖家
            $mTime      = intval($v[5]);  //影片时长(秒)
            $mRelease   = trim(trim($v[6]),'"');    //发行时间
            $mDirector  = trim(trim($v[7]),'"');    //导演
            $mFilm      = trim(trim($v[8]),'"');    //片商
            $mDown      = trim(trim($v[9]),'"');    //可否下载
            $mSub       = trim(trim($v[10]),'"');   //是否包含字幕
            $mLabel     = trim(trim($v[11]),'"');   //标签
            $mActor     = trim(trim($v[12]),'"');   //演员

            //判断名称和番号必填
            if(empty($mName) || empty($mNumber) || empty($mCategory))
            {
                echo '<p>跳过缺失影片名称,番号,分类的数据:'.$mName.':'.$mNumber.PHP_EOL.'</p>';
                continue;
            }

            //判断是否重复
            $mkey = base64_encode($mNumber);
            $mid = RedisCache::getSetScore($this->keyMovie,$mkey);
            if($mid)
            {
                echo '<p>跳过重复数据:'.$mName.':'.$mNumber.PHP_EOL.'</p>';
                continue;
            }

            //进行番号组处理
            $numberExp = ['.','-'];
            //切割番号
            $numberGroup = [];
            for($i=0; $i<count($numberExp); $i++)
            {
                $numberGroup = explode($numberExp[$i],$mNumber);
            }
            if(count($numberGroup)>1)
            {
                //第一个位置位番号组
                $sGroup = $numberGroup[0];

                //判断分类是否存在
                $nkey   = base64_encode($sGroup);
                $nId    = RedisCache::getSetScore($this->keyNum,$nkey);
                if($nId == false)
                {
                    $dbNum = MovieNumbers::select('id')->where('name',$sGroup)->first();
                    if($dbNum && isset($dbNum->id))
                    {
                        $nId = $dbNum->id; 
                    }else{
                        $nId = MovieNumbers::create($sGroup);
                        echo '新增番号组:'.$sGroup.PHP_EOL;
                    }
                }
            }

            //判断分类是否存在
            $ckey   = base64_encode($mCategory);
            $cid    = RedisCache::getSetScore($this->keyCategory,$ckey);
            if($cid == false)
            {
                $cid = MovieCategory::create($mCategory,1);
                echo '<p>新增分类:'.$mCategory.PHP_EOL.'</p>';
            }

            //判断系列是否存在
            $sid = 0;
            if(!empty($mSeries))
            {
                $skey   = base64_encode($mSeries);
                $sid    = RedisCache::getSetScore($this->keySeries,$skey);
                if($sid == false)
                {
                    $sid = MovieSeries::create($mSeries,1);
                    //插入关联表
                    DB::table('movie_series_category_associate')->insert(['series_id'=>$sid,'cid'=>1]);
                    echo '<p>新增系列:'.$mSeries.PHP_EOL.'</p>';
                }
            }

            //判断导演是否存在
            $did = 0;
            if(!empty($mDirector))
            {
                $dkey   = base64_encode($mDirector);
                $did    = RedisCache::getSetScore($this->keyDirector,$dkey);
                if($did == false)
                {
                    $did = MovieDirector::create($mDirector,1);
                    echo '<p>新增导演:'.$mDirector.PHP_EOL.'</p>';
                }
            }

            //判断片商是否存在
            $fid = 0;
            if(!empty($mFilm))
            {
                $fkey   = base64_encode($mFilm);
                $fid    = RedisCache::getSetScore($this->keyFilm,$fkey);
                if($fid == false)
                {
                    $fid = MovieFilmCompanies::create($mFilm,1);
                    //插入关联表
                    DB::table('movie_film_companies_category_associate')->insert(['film_companies_id'=>$fid,'cid'=>1]);
                    echo '<p>新增片商:'.$mFilm.PHP_EOL.'</p>';
                }
            }

            //判断标签是否存在，数组循环
            $arrLids = array();
            $arrLabels = explode(';',$mLabel);
            foreach($arrLabels as $v)
            {
                if(!empty(trim($v)))
                {
                    $lkey   = base64_encode(trim($v));
                    $lid    = RedisCache::getSetScore($this->keyLabel,$lkey);
                    if($lid == false)
                    {
                        $lid = MovieLabel::create($v,1,1);
                        echo '<p>新增标签：'.$v.PHP_EOL.'</p>';
                    }
                    //标签id数组
                    $arrLids[] = $lid;
                }
            }

            //判断演员是否存在，数组循环
            $arrAids = array();
            $arrActors = explode(';',$mActor);
            foreach($arrActors as $v)
            {
                if(!empty(trim($v)))
                {
                    $akey   = base64_encode(trim($v));
                    $aid    = RedisCache::getSetScore($this->keyActor,$akey);
                    if($aid == false)
                    {
                        $aid = MovieActor::create($v,1,'♀','','[]');
                        //插入关联表
                        DB::table('movie_actor_category_associate')->insert(['aid'=>$aid,'cid'=>1]);
                        echo '<p>新增演员:'.$v.PHP_EOL.'</p>';
                    }
                    //标签id数组
                    $arrAids[] = $aid;
                }
            }
            
            //写入影片数到数据库
            $timeRelease = strtotime($mRelease);

            $data = array();
            $data['name']           = $mName;
            $data['number']         = $mNumber;
            $data['release_time']   = date('Y-m-d H:i:s',$timeRelease);
            $data['score']          = 0;
            $data['time']           = $mTime;
            $data['sell']           = $mSell;
            $data['is_download']    = ($mDown == '是')? 2 : 1;
            $data['is_subtitle']    = ($mSub == '是')? 2 : 1;
            $data['is_hot']         = 1;

            $data['arrLabels']      = $arrLids;
            $data['arrActors']      = $arrAids;
            $data['director']       = $did;
            $data['series']         = $sid;
            $data['company']        = $fid;

            //填充默认数据
            $data['flux_linkage_num'] = 0;
            $data['flux_linkage'] = '[]';
            $data['big_cove'] = '';
            $data['small_cover'] = '';
            $data['trailer'] = '';
            $data['map'] = '[]';

            $res = $movie->create($data,$cid);
            if($res >0 ){
                echo '<p>导入影片数据:'.$mName.PHP_EOL.'</p>';
            }
        }

        if($p >= $allPage){
            //删除文件
            unlink($filePath);
            echo '<p>本次导入执行完成'.PHP_EOL.'</p>';
            exit();
        }

        $jUrl = route('admin.movie.movie.mvdo',['path'=>$path,'p'=>$p+1]);
        echo '<p>正在执行批量导入数据，请不要关闭本页面......</p>';
        echo '<script>
                function sleep(n) {
                    var start = new Date().getTime();
                    while (true) {
                        if (new Date().getTime() - start > n) {
                            break;
                        }
                    }
                }
                sleep(5);
                window.location.href="'.$jUrl.'";
            </script>';
    }


    //上传磁链文件
    public function linkup(Request $request)
    {
        //上传文件最大大小, 单位M 
        $maxSize = 10;
        //支持的表格类型
        $allowed_extensions = ["csv"];
        $file = $request->file('file');

        //检查文件是否上传完成
        if ($file->isValid()){
            //检测文件类型
            $ext = $file->getClientOriginalExtension();
            if (!in_array(strtolower($ext),$allowed_extensions)){
                echo "请上传".implode(",",$allowed_extensions)."格式的表格文件";
                exit();
            }
            //检测文件大小
            if ($file->getSize() > $maxSize*1024*1024){
                echo"文件大小限制".$maxSize."M";
                exit();
            }
        }else{
            echo $file->getErrorMessage();
            exit();
        }
        $newFile = date('Y-m-d')."_".time()."_".uniqid().".".$file->getClientOriginalExtension();
        $disk = Storage::disk('uploads');
        $res = $disk->put($newFile,file_get_contents($file->getRealPath()));
        if(!$res){
            echo $file->getErrorMessage();
            exit();
        }

        $jUrl = route('admin.movie.movie.linkdo',['path'=>$newFile,'p'=>1]);
        echo '<script>window.location.href="'.$jUrl.'"</script>';
    }

    /**
     * 处理磁链数据 
     */
    public function linkdo(Request $request,$path,$p)
    {
        //获取完整路径
        $filePath = $_SERVER['DOCUMENT_ROOT'].'/uploads/local/'.$path;

        //读取数据
        $lineSize = 0;

        $lists = $this->readExcel($filePath,($p-1)*50,$lineSize);

        //得到总页数
        $allPage = ceil($lineSize / 50);

        $movie = new Movie();
        foreach($lists as $v)
        {
            //少于8列，直接跳过
            if(count($v) < 8)
            {
                echo '<p>跳过数据不全：'.PHP_EOL.'</p>';
                continue;
            }

            $mNumber    = trim(trim($v[0]),'"');    //番号
            $mName      = trim(trim($v[1]),'"');    //名称
            $mAddr      = trim(trim($v[2]),'"');    //地址
            $mMate      = trim(trim($v[3]),'"');    //文件信息
            $mTime      = trim(trim($v[4]),'"');    //更新日期
            $mHigh      = intval($v[5]);  //是否高清     is-small=1 是；
            $mSub       = intval($v[6]);  //是否含字幕   is-warning=1 是； 
            $mDown      = intval($v[7]);  //是否可下载   tooltip=1 是离线下载

            //过滤不全的数据
            if(empty($mName) || empty($mNumber) || empty($mAddr))
            {
                echo '<p>跳过缺失名称,番号,地址的数据:'.$mName.':'.$mNumber.PHP_EOL.'</p>';
                continue;
            }

            //番号不存在的，直接跳过
            $mkey = base64_encode($mNumber);
            $mid = RedisCache::getSetScore($this->keyMovie,$mkey);
            if($mid == false)
            {
                echo '<p>番号不存在的数据:'.$mName.':'.$mNumber.PHP_EOL.'</p>';
                continue;
            }

            $arrLink =array();
            //读取磁链信息
            $arr = $movie->getFluxLink($mid);
            $nLink = intval($arr[0]->flux_linkage_num);
            if($nLink > 0)
            {
                $arrLink = json_decode($arr[0]->flux_linkage,true);
            }

            //整理数据
            $timeFormat = strtotime($mTime);

            $data = array();
            $data['name']       = $mName;
            $data['url']        = $mAddr;
            $data['meta']       = $mMate;
            $data['time']       = date('Y-m-d H:i:s',$timeFormat);
            $data['is-small']   = ($mHigh=='是')?1:2;
            $data['is-warning'] = ($mSub=='是')?1:2;
            $data['tooltip']    = ($mDown=='是')?1:2;

            //添加到数组中
            $arrLink[]=$data;

            //压缩数据
            $sLink = json_encode($arrLink);

            //更新数据表
            $movie->updateFluxLink($mid, count($arrLink), $sLink);

            echo '<p>添加磁链：'.$mNumber.':'.$mName.PHP_EOL.'</p>';
        }

        if($p >= $allPage){
            //删除文件
            unlink($filePath);
            echo '<p>本次导入执行完成'.PHP_EOL.'</p>';
            exit();
        }

        $jUrl = route('admin.movie.movie.linkdo',['path'=>$path,'p'=>$p+1]);
        echo '<p>正在执行批量导入数据，请不要关闭本页面......</p>';
        echo '<script>
                function sleep(n) {
                    var start = new Date().getTime();
                    while (true) {
                        if (new Date().getTime() - start > n) {
                            break;
                        }
                    }
                }
                sleep(5);
                window.location.href="'.$jUrl.'";
            </script>';
    }

    /**
     * 导出影片到文件 
     */
    public function moviedown(Request $request)
    {
        //导出数据到excel文件
        $model = Movie::query();
        $table = 'movie';
        $date = explode('~',$request->input('date'));
        if(isset($date[0]) && isset($date[1])){
            $model = $model->whereBetween($table.'.created_at',[trim($date[0]),trim($date[1])]);
        }
        $rdate = explode('~',$request->input('rdate'));
        if(isset($rdate[0]) && isset($rdate[1])){
            $model = $model->whereBetween($table.'.release_time',[trim($rdate[0]),trim($rdate[1])]);
        }
        if($request->input('name')){
            $model = $model->where($table.'.name', $request->input('name'));
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
        if($request->input('category')){
            $model = $model->where('movie_category.name', $request->input('category'));
        }

        //获取
        $res = $model->leftJoin('movie_category_associate','movie_category_associate.mid',$table.'.id')
            ->join('movie_category','movie_category.id','=','movie_category_associate.cid')
            ->orderBy('id', 'desc')
            ->select($table.'.*','movie_category.name as category')
            ->paginate($request->get('limit', 30));

        $records = $res->toArray();
        $movies = $records['data'];

        $text = PHP_EOL;
        if($request->input('page')==1)
        {
            $text = 'ID,番号,标题,演员,评分,时长,类别,评论,磁链,想看,看过,创建时间,更新时间,发行时间'.PHP_EOL;
        }
        
        foreach ($movies as &$movie) {
            $movie_actor_associate_ids = DB::table('movie_actor_associate')->where('mid', $movie['id'])->pluck('aid')->all();
            $actors = MovieActor::whereIn('id', $movie_actor_associate_ids)->pluck('name')->all();
            $movie['actors'] = join(';', $actors);
            $text.=$movie['id'].',';     //ID
            $text.=$movie['number'].','; //番号
            $text.=$movie['name'].',';   //标题
            $text.=$movie['actors'].','; //演员
            $text.=$movie['score'].',';  //评分
            $text.=$movie['time'].',';   //时长
            $text.=$movie['category'].','; //类别
            $text.=$movie['comment_num'].','; //评论时间
            $text.=$movie['flux_linkage_num'].','; //磁链时间
            $text.=$movie['wan_see'].','; //想看
            $text.=$movie['seen'].',';   //看过
            $text.=$movie['created_at'].','; //创建时间
            $text.=$movie['updated_at'].','; //更新时间
            $text.=$movie['release_time'].PHP_EOL; //发行时间
        }

        //总数量
        $total = $res->total();
        //计算总页数
        $limit = $request->input('limit');
        $allPage = ceil($total/$limit);

        
         //获取完整路径
        $filePath = $_SERVER['DOCUMENT_ROOT'].'/uploads/local/movie_lists.csv';

        
        if($request->input('page')==1){
            //如果是第一页，从开头写入
            $fp=fopen($filePath,'w');            
            fwrite($fp, $text);
            fclose($fp);
        }else{
            //大于第一页，追加
            $fp=fopen($filePath,'a');            
            fwrite($fp, $text);
            fclose($fp);
        }

        //导出结束
        if($request->input('page')>=$allPage){
            echo '<p>文件生成完成，<a href="/uploads/local/movie_lists.csv" target="_blank">点击下载</a></p>';
            exit();
        }

        echo '<p>正在执行批量导出数据，请不要关闭本页面......</p>';
        echo '<p>总共'.$total.'条，每页生成'.$request->input('limit').'条， 共'.$allPage.'页，当前页：'.$request->input('page').'</p';

        echo '<div style="margin:20px">
                <form id="myfrm" method="post" action="'.route('admin.movie.movie.mvdown').'">
                <p><input type="hidden" name="_token" value="'.csrf_token().'"></p>
                <p><input type="hidden" name="date" value="'.$request->input('date').'"/></p>
                <p><input type="hidden" name="rdate" value="'.$request->input('rdate').'"/></p>
                <p><input type="hidden" name="name" value="'.$request->input('name').'"/></p>
                <p><input type="hidden" name="search_key" value="'.$request->input('search_key').'"/></p>
                <p><input type="hidden" name="search_value" value="'.$request->input('search_value').'"/></p>
                <p><input type="hidden" name="category" value="'.$request->input('category').'"/></p>
                <p><input type="hidden" name="page" value="'.($request->input('page')+1).'"/></p>
                <p><input type="hidden" name="limit" value="'.$request->input('limit').'"/></p>
                <p style="display:none"><input type="submit" value="导出影片"/></p>
                </form>
                </div>
            <script>
                document.getElementById("myfrm").submit();
            </script>';
        exit();
    }

    /**
     * 分页读取文件行数，每次50行
     * @param   string  $filePath   文件目录
     * @param   int     $line       从多少行开始读取，默认第0行
     */
    private function readExcel($filePath,$line=0,&$lineSize)
    {
        //跳过第一行的标题
        $line = ($line==0)?1:$line;

        $res = array();
        //将文档按行读入内存
        $f = file( $filePath);
        $lineSize = count($f);

        //得到文件总行数
        $max = ($line+50>count($f))?count($f):$line+50;

        //遍历读取50行
        for($i=$line;$i<$max;$i++)
        {
            //读取一行,防止填入全半角符号
            $t = str_replace('；',';',$f[$i]);
            //转码，把gb2312转成utf8
            $t = MbEncode::strToUtf8($t);
            //按照英文逗号，切割
            $a = explode(',',$t);
            $res[]=$a;
        }
        unset($f);
        return $res;
    }
}
