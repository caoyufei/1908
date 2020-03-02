<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use App\Category;
use App\Brand;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //练习
        //全局辅助函数  设置
        // session(['name'=>'zhangyi']);
        // request()->session()->save();

        // //全局辅助函数   删除
        // // session(['name'=>null]);
        // // request()->session()->save();

        // echo session('name');


        //request实例  设置
        // request()->session()->put('age',18);
        // request()->session()->save();

        // //request实例  获取
        // echo request()->session()->get('age');

        // //request实例  删除
        // request()->session()->forget('age');

        // dd(request()->session()->get('age'));

        // die;

        //搜索
        $g_name=request()->g_name??'';
        $where=[];
        if($g_name){
            $where[]=['g_name','like',"%$g_name%"];
        }

        //接受当前的页码
        $page=request()->page??1;
       // Cache::flush();
        // $goods=Cache::get('goods');
        $goods=cache('goods_'.$page.'_'.$g_name);
      
        $goods=Redis::get('goods_'.$page.'_'.$g_name);
        //dd($goods);

        //dd($goods);
        if(!$goods){
            //echo "走DB==";
            $pageSize=config('app.pageSize');
            $goods=Goods::leftjoin('brand','goods.b_id','=','brand.b_id')
                     ->leftjoin('category','goods.id','=','category.id')
                     ->where($where)
                     ->orderby('g_id','desc')
                     ->paginate($pageSize);
       // Cache::put('goods',$goods,60*60*24*30);
      cache(['goods_'.$page.'_'.$g_name=>$goods],60*60*24*30);
      //序列化结果集  将object转化为字符串
      $goods=serialize($goods);
      Redis::setex('goods_'.$page.'_'.$g_name,20,$goods);
        }
        //反序列化结果集   将字符串转化为object对象
        $goods=unserialize($goods);

        return view('goods.index',['goods'=>$goods,'query'=>request()->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          //品牌
        $brand=Brand::all();
       // dd($brand);
       
       //分类
       $cate=Category::all();
       $cate=CreateTree($cate);
       //dd($cate);
        return view('goods.create',['brand'=>$brand],['cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');

    //     $validator=Validator::make($data,
    //  [
    //     'g_name'=>'required|unique:goods|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]+$/u',
    //     'g_article'=>'required',
    //     'g_price'=>'required',
    //     'g_num'=>'required',
        
    // ],[
    //     'g_name.required'=>'商品名称不能为空',
    //     'g_name.unique'=>'商品名称已存在',
    //     'g_name.regex'=>'商品名称由数字、字母、下划线组成',
    //     'g_article.required'=>'商品货号不能为空',
    //     'g_price.required'=>'商品价格不能为空',
    //     'g_num.required'=>'商品库存不能为空',
    //  ]);
    //     if($validator->fails()){
    //     return redirect('goods/create')
    //         ->withErrors($validator)
    //         ->withInput();
    //     }
        //单文件上传
        if($request->hasFile('g_img')){
            $data['g_img']=uploads('g_img');
        }

        //多文件上传
        if($data['g_logo']){
           $photos=Moreuploads('g_logo');
           $data['g_logo']=implode('|',$photos);
        }
        $res=Goods::insert($data);
        if($res){
            return redirect('/goods');
        }
    }
    

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count=Redis::setnx('num_'.$id,1);
        if(!$count){
            $count=Redis::incr('num_'.$id);
        }
         $goods=Goods::find($id);
         //dd($goods);
         return view('goods.show',['goods'=>$goods,'count'=>$count]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
