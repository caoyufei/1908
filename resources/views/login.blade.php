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
<center><h2>登录页面</h2><hr/></center>
<!-- @if($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
<ul>
</div>
@endif -->
<center><b style="color:red">{{session('msg')}}</b></center>
<form class="form-horizontal" role="form" action="{{url('/logindo')}}" method="post">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">用户名</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname"  name="u_name"
				   placeholder="请输入名字">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-8">
			<input type="password" class="form-control" id="firstname"  name="u_pwd"
				   placeholder="请输入名字">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">登录</button>
		</div>
	</div>
</form>

</body>
</html>