<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/is/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>学生信息</h2><hr/></center>
<!-- @if($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
<ul>
</div>
@endif -->

<form class="form-horizontal" role="form" action="{{url('/student/store')}}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生姓名</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname"  name="s_name"
				   placeholder="请输入名字">
			<b style="color:red">{{$errors->first('s_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生性别</label>
		<div class="col-sm-8">
				<input type="radio" name="s_sex" id="optionsRadios4"   value="1" checked>男
				<input type="radio" name="s_sex" id="optionsRadios4"   value="2" >女
			<b style="color:red">{{$errors->first('s_sex')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生班级</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="s_class"
				   placeholder="请输入班级">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生成绩</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="s_success"
				   placeholder="请输入成绩">
			<b style="color:red">{{$errors->first('s_success')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">学生头像</label>
		<div class="col-sm-8">
			<input type="file" class="form-control" id="firstname" name="s_head">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>