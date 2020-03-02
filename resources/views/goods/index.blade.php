<form>
	<input type="text" name="g_name" value="{{$query['$g_name']??''}}" placeholder="请输入关键字">
	<input type="submit" value="搜索">
</form>
<table border="1">
	<tr>
		<td>商品ID</td>
		<td>商品名称</td>
		<td>商品价格</td>
		<td>商品缩略图</td>
		<td>商品相册</td>
		<td>是否精品</td>
		<td>操作</td>
	</tr>
	@foreach($goods as $k=>$v)
	<tr g_id="{{$v->g_id}}">
		<td>{{$v->g_id}}</td>
		<td>{{$v->g_name}}</td>
		<td>{{$v->g_price}}</td>
		<td><img src="{{env('UPLOAD_URL')}}{{$v->g_img}}" width="90" height="70"></td>
		<td>
			@if($v->g_logo)
			@php $photos=explode('|',$v->g_logo);@endphp
			@foreach($photos as $vv)
			<img src="{{env('UPLOAD_URL')}}{{$vv}}" width="90" height="70">
			@endforeach
			@endif
		</td>
		<td>{{$v->g_better==1?'是':'否'}}</td>
		<td>
			<a href="{{url('goods/show/'.$v->g_id)}}" class="btn btn-info">详情页</a>
			<a href="{{url('goods/edit/'.$v->g_id)}}" class="btn btn-info">编辑</a>
			<a href="{{url('goods/del/'.$v->g_id)}}" class="btn btn-info">删除</a>
		</td>
	</tr>
	@endforeach
</table>
<tr><td colspan="7">{{$goods->appends($query)->links()}}</td></tr>