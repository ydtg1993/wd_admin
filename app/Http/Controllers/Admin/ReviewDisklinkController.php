<?php

namespace App\Http\Controllers\Admin;


use App\Models\Disklink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class ReviewDisklinkController extends Controller
{
    /**
     * 磁链管理
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->method() == 'GET') {
            return View::make('admin.disklink.index');
        }

        $statusView = [
            '1'=>'未处理',
            '2'=>'已同步',
        ];

        $liView = [
            '1'=>'是'
        ];

        $where = array();
        //创建时间
        $data = explode('~', $request->input('date'));
        if (isset($data[0]) && isset($data[1])) {
            $where['created_at >'] = trim($data[0]);
            $where['created_at <'] = trim($data[1]);
        }

        //处理状态
        if($request->input('status')){
            $where['status'] = $request->input('status');
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
        $mdb = new Disklink();
        $total = $mdb->total($where);

        //读取列表
        $items = $mdb->lists($where,'id,number,displayname,ext,xt,resolution,size,sd,hd,bluray,subtitle,download,meta,link,filelists,ip,status,created_at,updated_at',$limit,$offset);

        //更新状态
        $aUid = [];
        foreach ($items as $k=>$v){
            //更新
            $items[$k]->status = isset($statusView[$v->status])?$statusView[$v->status]:'未处理';
            $items[$k]->sd = isset($liView[$v->sd])?$liView[$v->sd]:'否';
            $items[$k]->hd = isset($liView[$v->hd])?$liView[$v->hd]:'否';
            $items[$k]->bluray = isset($liView[$v->bluray])?$liView[$v->bluray]:'否';
            $items[$k]->subtitle = isset($liView[$v->subtitle])?$liView[$v->subtitle]:'否';
            $items[$k]->download = isset($liView[$v->download])?$liView[$v->download]:'否';
        }

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $total,
            'data' => $items,
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

            return View::make('admin.disklink.edit', compact(
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

            return Redirect::to(URL::route('admin.review.disklink'))->withErrors('更新失败:' . $exception->getMessage());
        }
        DB::commit();

        return Redirect::to(URL::route('admin.review.disklink'))->with(['success' => '更新成功']);
    }

}

