<?php

namespace App\Http\Controllers\Admin;

use App\Models\CollectFilmCompanies;
use App\Models\MovieActor;
use App\Models\MovieFilmCompanies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;

class ReviewFilmCompaniesController extends Controller
{
    /**
     * 采集演员管理
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        return View::make('admin.review_companies.index');
    }

    /**
     * 数据接口
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(Request $request)
    {
        $categories = DB::table('movie_film_companies_category')->pluck('name')->all();
        $res = CollectFilmCompanies::whereIn('status',[1,2])
            ->orderBy('id', 'desc')
            ->paginate($request->get('limit', 30));
        $records = $res->toArray();
        foreach ($records['data'] as &$record){
            $record['category2'] = '';
            $index = array_search($record['category'],$categories);
            if($index >= 0){
                $record['category2'] = $categories[$index];
            }
        }

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $records['data'],
        ];
        return Response::json($data);
    }

    /**
     * 更新
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $categories = DB::table('movie_film_companies_category')->pluck('name', 'id')->all();
        $company = CollectFilmCompanies::find($id);

        return View::make('admin.review_companies.edit', compact('company', 'categories'));
    }

    /**
     * 更新
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        try {
            $companies = MovieFilmCompanies::where('name' ,$data['name'])->get();
            foreach ($companies as $company){
                if(DB::table('movie_film_companies_category_associate')
                    ->where(['film_companies_id'=>$company->id,'cid'=>$data['category']])
                    ->exists()){
                    throw new \Exception('公司重复');
                }
            }

            CollectFilmCompanies::where('id', $id)->update(['status' => 2,'admin_id'=>Auth::id()]);
            $company_id = MovieFilmCompanies::insertGetId(['name' => $data['name'],'oid'=>$id]);
            DB::table('movie_film_companies_category_associate')->insert(['film_companies_id'=>$company_id,'cid'=>$data['category']]);

        } catch (\Exception $e) {
            return Redirect::back()->withErrors('更新失败:' . $e->getMessage());
        }
        return Redirect::to(URL::route('admin.review.companies'))->with(['success' => '更新成功']);
    }


}

