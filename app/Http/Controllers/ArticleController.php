<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
// use App\Http\Requests\StorePeoplePost;
use Validator;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title=request()->title??'';
        $type=request()->type??'';
        $where=[];
        if($title){
            $where[]=['title','like',"%$title%"];
        }
        if($type){
            $where[]=['type','like',"%$type%"];
        }
        $pageSize=config('app.pageSize');

        $data=Article::where($where)->orderby('id','desc')->paginate($pageSize);
        return view('article.index',['data'=>$data,'title'=>$title,'type'=>$type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
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
        $data['add_time']=time();
        $validator=Validator::make($data,
     [
        'title'=>'required|unique:article|regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]+$/u',
        'type'=>'required',
        
    ],[
        'title.required'=>'文章标题不能为空',
        'title.unique'=>'文章标题已存在',
        'title.regex'=>'文章标题由数字、字母、下划线组成',
        'type.required'=>'文章分类不能为空',

     ]);
        if($validator->fails()){
        return redirect('article/create')
            ->withErrors($validator)
            ->withInput();
        }
        if($request->hasFile('img')){
            $data['img']=upload('img');
        }

        $res=Article::insert($data);
       if($res){
            return redirect('/article');
        }
 }



/*
上传图片
 */
    
    //ajax唯一性验证
        public function checkOnly(){
            $title=request()->title;
            $where=[];
            if($title){
                $where[]=['title','=',$title];
            }
            //排除自身
            $id=request()->id;
            if($id){
                $where[]=['id','!=',$id];
            }
            $count=Article::where($where)->count();
            echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
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
        $user=Article::where('id',$id)->first();
        
        return view('article.edit',['user'=>$user]);
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
        if($request->hasFile('img')){
            $user['img']=upload('img');
        }
        $res=Article::where('id',$id)->update($user); 
        if($res!==false){
             return redirect('/article');
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
        $res=Article::destroy($id);
        if($res){
           echo json_encode(['code'=>'00000','msg'=>'ok']);
        }
    }
}
