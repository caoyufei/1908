<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $s_name=request()->s_name??'';
        $s_class=request()->s_class??'';
        $where=[];
        if($s_name){
            $where[]=['s_name','like',"%$s_name%"];
        }
        if($s_class){
            $where[]=['s_class','like',"%$s_class%"];
        }
        $pageSize=config('app.pageSize');

     $data=DB::table('student')->where($where)->orderby('s_id','desc')->paginate($pageSize);
     return view('student.index',['data'=>$data,'s_name'=>$s_name,'s_class'=>$s_class]);  
    }

    /**
     * Show the form for creating a new resource.
     *添加
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            's_name'=>'required|unique:student|alpha_dash|min:2|max:12',
            's_sex'=>'required|numeric',
            's_success'=>'required|numeric|between:0,100',
        ],[
            's_name.required'=>'学生名称必填',
            's_name.unique'=>'学生名称已存在',
            's_name.min'=>'学生名称不能少于2位',
            's_name.max'=>'学生名称不能超过12位',
            's_sex.required'=>'学生性别必填',
            's_sex.required'=>'学生性别必须是数字',
            's_success.required'=>'学生成绩必填',
            's_success.numeric'=>'学生成绩必须是数字',
            's_success.between'=>'学生成绩不能超过100',
        ]);

        $data=$request->except('_token');
        //判断有无文件上传
        if($request->hasFile('s_head')){
            $data['s_head']=$this->upload('s_head');
        }
        $res=DB::table('student')->insert($data);
        if($res){
            return redirect('/student');
        }
    }

    /**
        上传文件
    */
   public function upload($filename){
    //判断上传过程有无错误
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
     *展示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *修改
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=DB::table('student')->where('s_id',$id)->first();
        return view('student.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *执行修改
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            's_name'=>[
           'regex:/^[\x{4e00}-\x{9fa5}A-Za-z0-9_-]{2,12}$/u',
            Rule::unique('student')->ignore($id,'s_id'),
        ],
            's_sex'=>'required|numeric',
            's_success'=>'required|numeric|between:0,100',
        ],[
            //'s_name.required'=>'学生名称必填',
            's_name.unique'=>'学生名称已存在',
            's_name.regex'=>'学生姓名必须是中文、数字、字母、下划线',
            // 's_name.min'=>'学生名称不能少于2位',
            // 's_name.max'=>'学生名称不能超过12位',
            's_sex.required'=>'学生性别必填',
            's_sex.required'=>'学生性别必须是数字',
            's_success.required'=>'学生成绩必填',
            's_success.numeric'=>'学生成绩必须是数字',
            's_success.between'=>'学生成绩不能超过100',
        ]);
        $user=$request->except('_token');
        if($request->hasFile('s_head')){
            $data['s_head']=$this->upload('s_head');
        }
        $res=DB::table('student')->where('s_id',$id)->update($user);
        if($res!==false){
            return redirect('/student');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=DB::table('student')->where('s_id',$id)->delete();
        if($res){
            return redirect('/student');
        }
    }
}
