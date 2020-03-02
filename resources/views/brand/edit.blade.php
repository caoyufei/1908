<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>编辑商品</h2><hr/></center>
<form action="{{url('/brand/update/'.$user->b_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname"  name="b_name" value="{{$user->b_name}}"
				   placeholder="请输入品牌名称">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" id="firstname" name="b_url" value="{{$user->b_url}}"
				   placeholder="请输入品牌网址">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌图标</label>
		<div class="col-sm-8">
			<img src="{{env('UPLOAD_URL')}}{{$user->g_logo}}" width="50" height="50">
			<input type="file" class="form-control" name="b_logo">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌描述</label>
		<div class="col-sm-8">
			<textarea name="b_desc" cols="30" rows="10"> {{$user->b_desc}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">编辑</button>
		</div>
	</div>
</form>

</body>
</html>