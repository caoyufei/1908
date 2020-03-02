<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//闭包路由
// Route::get('/', function () {
// 	$name="曹玉飞";
//     return view('welcome',['name'=>$name]);
// });

// Route::get('/show', function () {
// 	echo "hello";
// });

//路由显示视图
Route::get('/user', 'UserController@index');
Route::get('/adduser', 'UserController@add');
//post路由
Route::post('/adddo','UserController@adddo')->name('do');
//必填路由
// Route::get('/goods/{id}/{name}', function ($id,$name) {
// 	echo $id;
// 	echo $name;
// });
// 可选路由
// Route::get('/goods/{id?}', function ($id=null) {
// 	echo "可选参数";
// 	echo $id;
// });


//前台首页
Route::get('/','Index\IndexController@index');
Route::view('/login','index.login');
Route::get('/send','Index\LoginController@ajaxsend');
Route::get('/reg','Index\LoginController@reg');
Route::post('/regdo','Index\LoginController@regdo');




// Route::post('login','Index\IndexController@login');


//设置cookie
Route::get('/setcookie','Index\IndexController@setcookie');



//练习作业

// Route::get('/show', function () {
//  	echo "这里是商品详情页";
//  });

// Route::get('/show/{id}/', function ($id) {
// 	echo "商品id是：1";
// });

// Route::get('/show/{id}/{name}', function ($id,$name) {
// 	echo "商品id是：23";
// 	echo "关键字是：裤子";
// });

// Route::get('/category',function(){
// 	$fid="服装";
// 	return view('category.add',['fid'=>$fid]);
// });

// // Route::get('/addcategory', 'CategoryController@add');


// Route::get('/addbrand','BrandController@add');

//正则约束
Route::get('/goods/{id}',function($goods_id){
	echo "商品ID:";
	echo $goods_id;
});

Route::get('/show/{id}',function($goods_id){
	echo "ID";
	echo $goods_id;
});

Route::get('/goods/{id}/{name}',function($goods_id,$name){
	echo "商品ID：";
	echo $goods_id;
	echo "商品名称是：";
	echo $name;
})->where(['name'=>'\w+']);

//外来人口统计
Route::prefix('people')->middleware('checklogin')->group(function(){
	Route::get('create','PeopleController@create');
	Route::post('store','PeopleController@store');
	Route::get('/','PeopleController@index');
	Route::get('edit/{id}','PeopleController@edit');
	Route::post('update/{id}','PeopleController@update');
	Route::get('destroy/{id}','PeopleController@destroy');
});
//登录界面
// Route::view('/login','login');
// //执行登录
// Route::post('/logindo','LoginController@logindo');



//文章表  周测
Route::prefix('article')->middleware('checklogin')->group(function(){
	Route::get('/create','ArticleController@create');
	Route::post('/store','ArticleController@store');
	//唯一性
	Route::post('/checkOnly','ArticleController@checkOnly');
	Route::get('/','ArticleController@index');
	Route::get('/edit/{id}','ArticleController@edit');
	Route::post('/update/{id}','ArticleController@update');
	Route::get('/destroy/{id}','ArticleController@destroy');
});

//商品分类
Route::get('/category/create','CategoryController@create');
Route::post('/category/store','CategoryController@store');



//商品品牌信息表
Route::get('brand/create','BrandController@create');
Route::post('brand/store','BrandController@store');
Route::get('/brand','BrandController@index');
Route::get('brand/destroy/{id}','BrandController@destroy');
Route::get('brand/edit/{id}','BrandController@edit');
Route::post('brand/update/{id}','BrandController@update');

//商品管理表
Route::get('goods/create','GoodsController@create');
Route::post('goods/store','GoodsController@store');
Route::get('/goods','GoodsController@index');
Route::get('goods/show/{id}','GoodsController@show');






//管理员添加
Route::get('username/create','UsernameController@create');
Route::post('username/store','UsernameController@store');
Route::get('/username','UsernameController@index');
Route::get('username/destroy/{id}','UsernameController@destroy');
Route::get('username/edit/{id}','UsernameController@edit');
Route::post('username/update/{id}','UsernameController@update');




//学生信息表
Route::get('student/create','StudentController@create');
Route::post('student/store','StudentController@store');
Route::get('/student','StudentController@index');
Route::get('student/destroy/{id}','StudentController@destroy');
Route::get('student/edit/{id}','StudentController@edit');
Route::post('student/update/{id}','StudentController@update');


