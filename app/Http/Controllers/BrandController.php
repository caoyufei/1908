<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

use Illuminate\Support\Facades\Cache;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $data=Brand::get();
        return view('brand.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
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
        if($request->hasFile('b_logo')){
            $data['b_logo']=$this->upload('b_logo');
        }
        $res=Brand::insert($data);
        return redirect('/brand');
    }
    /*
    上传文件
     */
    public function upload($filename){
         if(request()->file($filename)->isValid()){
            //接收值
            $photo=request()->file($filename);
            //上传
            $store_result=$photo->store('uploads');
            return $store_result;
        }
            exit('未获取到上传文件或上传过程出错');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=Brand::where('b_id',$id)->first();
        
        return view('brand.edit',['user'=>$user]);
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
         $user=$request->except('_token');
          //判断有无文件上传
        if($request->hasFile('b_logo')){
            $user['b_logo']=$this->upload('b_logo');
        }
        $res=Goods::where('b_id',$id)->update($user); 
        if($res!==false){
             return redirect('/brand');
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Brand::destroy($id);
        if($res){
            return redirect('/brand');
        }
    }
}
