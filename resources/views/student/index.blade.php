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
<center><h2>学生列表</h2><hr/></center>
<form>
	<input type="text" name="s_name" value="{{$s_name}}" placeholder="请输入学生名称">
	<input type="text" name="s_class" value="{{$s_class}}" placeholder="请输入学生名称">
	<input type="submit" value="搜索">
</form>

<table class="table">
	<caption>上下文表格布局</caption>
	<thead>
		<tr>
			<th>ID</th>
			<th>学生名称</th>
			<th>学生性别</th>
			<th>学生班级</th>
			<th>学生成绩</th>
			<th>学生头像</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->s_id}}</td>
			<td>{{$v->s_name}}</td>
			<td>{{$v->s_sex==1?'男':'女'}}</td>
			<td>{{$v->s_class}}</td>
			<td>{{$v->s_success}}</td>
			<td>@if($v->s_head)<img src="{{env('UPLOAD_URL')}}{{$v->s_head}}" width="50" height="50">@endif</td>
			<td><a href="{{url('student/edit/'.$v->s_id)}}" class="btn btn-info">编辑</a>
				<a href="{{url('student/destroy/'.$v->s_id)}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
	<tr><td colspan="7">{{$data->appends(['s_name'=>$s_name,'s_class'=>$s_class])->links()}}</td></tr>
	</tbody>
</table>

</body>
</html>