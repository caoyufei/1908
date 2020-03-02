<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<h2>修改管理员信息</h2>
<body>
	<form action="{{url('/username/update/'.$data->id)}}" method="post" enctype="multipart/form-data">
		@csrf
		<table>
			<tr>
				<td>管理员姓名</td>
				<td><input type="text" name="name" value="{{$data->name}}">
					<b style="color:red">{{$errors->first('name')}}</b>
				</td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input type="password" name="pwd" ></td>
			</tr>
			<tr>
				<td>手机号</td>
				<td><input type="tel" name="tel" value="{{$data->tel}}"></td>
			</tr>
			<tr>
				<td>邮箱</td>
				<td><input type="email" name="email" value="{{$data->email}}"></td>
			</tr>
			<tr>
				<td>头像</td>
				<td>
					<img src="{{env('UPLOAD_URL')}}{{$data->img}}" width="50" height="50">
					<input type="file" name="img" >
				</td>
			</tr>
			<tr>
				<td><input type="submit" value="修改"></td>
				<td></td>
			</tr>
		</table>
	</form>
</body>
</html>