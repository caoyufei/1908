<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<h2>添加管理员信息</h2>
<body>
	<form action="{{url('/username/store')}}" method="post" enctype="multipart/form-data">
		@csrf
		<table>
			<tr>
				<td>管理员姓名</td>
				<td><input type="text" name="name">
					<b style="color:red">{{$errors->first('name')}}</b>
				</td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input type="password" name="pwd"></td>
			</tr>
			<tr>
				<td>手机号</td>
				<td><input type="tel" name="tel"></td>
			</tr>
			<tr>
				<td>邮箱</td>
				<td><input type="email" name="email"></td>
			</tr>
			<tr>
				<td>头像</td>
				<td><input type="file" name="img"></td>
			</tr>
			<tr>
				<td><input type="submit" value="添加"></td>
				<td></td>
			</tr>
		</table>
	</form>
</body>
</html>