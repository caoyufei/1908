<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Username;

class UsernameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Username::get();
        return view('username.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('username.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $request->validate([
            'name'=>'required|unique:username|alpha_dash|min:2|max:12',
        ],[
            'name.required'=>'管理员姓名必填',
            'name.unique'=>'管理员姓名已存在',
            'name.min'=>'管理员姓名不能少于2位',
            'name.max'=>'管理员姓名不能超过12位',
        ]);

        $data=$request->except('_token');
        $data['pwd']=encrypt($data['pwd']);
        //判断有无文件上传
        if($request->hasFile('img')){
            $data['img']=uploads('img');
        }
        $res=Username::insert($data);
        if($res){
            return redirect('/username');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Username::where('id',$id)->first();
        return view('username.edit',['data'=>$data]);
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
        $data=$request->except('_token');
        if($request->hasFile('img')){
            $data['img']=uploads('img');
        }
        $res=Username::where('id',$id)->update($data); 
        if($res!==false){
             return redirect('/username');
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
        $res=Username::destroy($id);
        if($res){
            return redirect('/username');
        }
    }
}
