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
     * 发行商
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->method() == 'GET'){
            $categories = DB::table('movie_film_companies_category')->pluck('name')->all();
            return View::make('admin.review_companies.index',compact('categories'));
        }
        $model = CollectFilmCompanies::query();
        $table = 'collection_film_companies';
        /*search*/
        $data = explode('~', $request->input('date'));
        if (isset($data[0]) && isset($data[1])) {
            $model = $model->whereBetween($table.'.created_at', [trim($data[0]), trim($data[1])]);
        }
        if($request->input('status')){
            $model = $model->where($table.'.status', $request->input('status'));
        }
        if($request->input('name')){
            $model = $model->where($table.'.name', $request->input('name'));
        }
        if($request->input('nickname')){
            $model = $model->where('users.nickname', $request->input('nickname'));
        }
        $res = $model->whereIn($table.'.status',[1,2])
            ->leftJoin('users', 'users.id', '=', $table.'.admin_id')
            ->orderBy($table.'.id', 'desc')
            ->select($table.'.*','users.nickname')
            ->paginate($request->get('limit', 30));

        $data = [
            'code' => 0,
            'msg' => '正在请求中...',
            'count' => $res->total(),
            'data' => $res->items(),
        ];
        return Response::json($data);
    }

    /**
     * 更新
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Request $request, $id)
    {
        if($request->method() == 'GET') {
            $categories = DB::table('movie_film_companies_category')->pluck('name', 'id')->all();
            $company = CollectFilmCompanies::find($id);

            return View::make('admin.review_companies.edit', compact('company', 'categories'));
        }

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

