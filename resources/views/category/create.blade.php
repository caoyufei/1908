<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="{{url('/category/store')}}" method="post">
		@csrf
		<table>
			<tr>
				<td>分类名称</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>父级分类</td>
				<td>
					<select name="pid">
						<option value="0">--请选择--</option>
						@foreach($cate as $v)
							<option value="{{$v->id}}">{{str_repeat('|——',$v->level)}}{{$v->name}}</option>
						@endforeach	
					</select>
				</td>
			</tr>
			<tr>
				<td>描述</td>
				<td><textarea name="desc"  cols="30" rows="10"></textarea></td>
			</tr>
			<tr>
				<td><input type="submit" value="添加"></td>
				<td></td>
			</tr>
		</table>
	</form>
</body>
</html>