<script src="/static/js/jquery.min.js"></script>
<meta name="csrf-token" content="{{csrf_token()}}">
<form action="">
	<input type="text" name="title" value="{{$title}}" placeholder="请输入标题">
	<input type="text" name="type" value="{{$type}}" placeholder="请输入分类">
	<input type="submit" value="搜索">
</form>

<table border="1">
	<tr>
		<td>编号</td>
		<td>文章标题</td>
		<td>文章分类</td>
		<td>文章重要性</td>
		<td>是否显示</td>
		<td>添加时间</td>
		<td>操作</td>
	</tr>
	@foreach($data as  $k=>$v)
	<tr>
		<td>{{$v->id}}</td>
		<td>{{$v->title}}</td>
		<td>{{$v->c_id}}</td>
		<td>{{$v->importance==1?'普通':'置顶'}}</td>
		<td>{{$v->is_show==1?'√':'×'}}</td>
		<td>{{date('Y-m-d  H:i:s',$v->add_time)}}</td>
		<td>
			<a href="javascript:void(0)" onclick="del('{{$v->id}}')">删除</a>
			<a href="{{url('article/edit/'.$v->id)}}">修改</a>
		</td>
	</tr>
	@endforeach
</table>
{{$data->appends(['title'=>$title,'type'=>$type])->links()}}
<script>
	function del(id){
		if(!id){
			return;
		}
		if(confirm("是否确认删除此记录")){
			//ajax删除
			$.get('/article/destroy/'+id,function(request){
				if(request.code=='00000'){
					location.reload();
				}
			},'json')
		}
	}
</script>