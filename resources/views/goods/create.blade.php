<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<form action="{{url('/goods/store')}}" method="post" enctype="multipart/form-data">
		@csrf
		<table>
			<tr>
				<td>商品名称</td>
				<td><input type="text" name="g_name">
					<b style="color:red">{{$errors->first('g_name')}}</b>
				</td>
			</tr>
			<tr>
				<td>商品价格</td>
				<td><input type="text" name="g_price">
					<b style="color:red">{{$errors->first('g_price')}}</b>
				</td>
			</tr>
			<tr>
				<td>所属品牌</td>
				<td>
					<select name="b_id">
						<option value="">--请选择--</option>
						@foreach($brand as $v)
						<option value="{{$v->b_id}}">{{$v->b_name}}</option>
						@endforeach
					</select>
				</td>
			</tr>
			<tr>
				<td>所属分类</td>
				<td>
					<select name="id">
						<option value="">--请选择--</option>
						@foreach($cate as $v)
							<option value="{{$v->id}}">{{str_repeat('|——',$v->level)}}{{$v->name}}</option>
						@endforeach
					</select>
				</td>
			</tr>
			<tr>
				<td>商品缩略图</td>
				<td><input type="file" name="g_img"></td>
			</tr>
			<tr>
				<td>商品库存</td>
				<td><input type="text" name="g_num">
					<b style="color:red">{{$errors->first('g_num')}}</b>
				</td>
			</tr>
			<tr>
				<td>是否精品</td>
				<td>
					<input type="radio" name="g_better" value="1" checked>是
					<input type="radio" name="g_better" value="2">否
				</td>
			</tr>
			<tr>
				<td>是否热卖</td>
				<td>
					<input type="radio" name="g_hot" value="1" checked>是
					<input type="radio" name="g_hot" value="2">否
				</td>
			</tr>
			<tr>
				<td>商品详情</td>
				<td><textarea name="g_desc" cols="30" rows="10"></textarea></td>
			</tr>
			<tr>
				<td>商品相册</td>
				<td><input type="file" name="g_logo[]" multiple="multiple"></td>
			</tr>
			<tr>
				<td><input type="submit" value="添加"></td>
				<td></td>
			</tr>
		</table>
	</form>
</body>
</html>