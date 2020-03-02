<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="/static/js/jquery.min.js"></script>
	<meta name="csrf-token" content="{{csrf_token()}}">
</head>
<body>
	<form action="{{url('/article/update/'.$user->id)}}" method="post" enctype="multipart/form-data">
		@csrf
		<table>
			<tr>
				<td>文章标题</td>
				<td><input type="text" name="title" value="{{$user->title}}">
					<b style="color:red">{{$errors->first('title')}}</b>
				</td>
				
			</tr>
			<tr>
				<td>文章分类</td>
				<td><input type="text" name="type" value="{{$user->type}}">
					<b style="color:red">{{$errors->first('type')}}</b>
				</td>
			
			</tr>
			<tr>
				<td>文章重要性</td>
				<td><input type="radio" name="importance" value="1" checked>普通
					<input type="radio" name="importance" value="2">置顶
				</td>
			</tr>
			<tr>
				<td>是否显示</td>
				<td>
					<input type="radio" name="is_show" value="1" checked>显示
					<input type="radio" name="is_show" value="2">不显示
				</td>
			</tr>
			<tr>
				<td>文章作者</td>
				<td><input type="text" name="author" value="{{$user->author}}">
						<b style="color:red">{{$errors->first('author')}}</b>
				</td>
			</tr>
			<tr>
				<td>作者email</td>
				<td><input type="text" name="author_email" value="{{$user->author_email}}"></td>
			</tr>
			<tr>
				<td>关键字</td>
				<td><input type="text" name="keyword" value="{{$user->keyword}}"></td>
			</tr>
			<tr>
				<td>网页描述</td>
				<td><textarea name="desc" id="" cols="30" rows="10">{{$user->desc}}</textarea></td>
			</tr>
			<tr>
				<td>上传文件</td>
				<td><input type="file" name="img"></td>
			</tr>
			<tr>
				<td><input type="submit" value="修改"></td>
			</tr>
		</table>
	</form>
</body>
</html>
<script>
$.ajaxSetup({headers:{'X-CSRF-TOKEN':$("meta[name='csrf-token']").attr('content')}});
	//定义全局变量
	var id="{{$user->id}}";
	//添加验证
	$("input[type='button']").click(function(){
		var titleflag=true;
		$('input[name="title"]').next().html('');
		//标题验证
		var title=$('input[name="title"]').val();
		var reg=/^[\4e00-\u9fa50-9A-Za-z_]{2,8}$/;
		if(!reg.test(title)){
			$('input[name="title"]').next().html('文章标题由中文数字字母组成且不能为空');
			return;
		}
		//验证唯一性
		$.ajax({
			type:'post',
			url:"/article/checkOnly",
			data:{title:title,id:id},
			async:false,
			dataType:'json',
			success:function(result){
				if(result.count>0){
					$("input[name='title']").next().html('标题已存在');
					titleflag=false;
				}
			}
		});
		if(!titleflag){
			return;
		}

		//作者验证
		var author=$('input[name="author"]').val();
		var reg=/^[\4e00-\u9fa50-9A-Za-z_]{2,8}$/;
		if(!reg.test(author)){
			$('input[name="author]').next().html('文章作者由中文数字字母组成且不能为空且长度2-8位');
			return;
		}
		//form提交
		$('form').submit();

	})



	//作者验证
	$('input[name="author"]').blur(function(){
		$(this).next().html('');
		var author=$(this).val();
		var reg=/^[\4e00-\u9fa50-9A-Za-z_]{2,8}$/;
		if(!reg.test(author)){
			$(this).next().html('文章作者由中文数字字母组成且不能为空且长度2-8位');
			return;
		}
	})

	//标题验证
	$("input[name='title']").blur(function(){
		$(this).next().html('');
		var title=$(this).val();
		var reg=/^[u4e00-\u9fa50-9A-Za-z_]+$/;
		if(!reg.test(title)){
			$(this).next().html('文章标题由中文数字字母组成且不能为空');
			return;
		}
		//验证唯一性
		$.ajax({
			type:'post',
			url:"/article/checkOnly",
			data:{title:title,id:id},
			dataType:'json',
			success:function(result){
				if(result.count>0){
					$("input[name='title']").next().html('标题已存在');
				}
			}
		})
	})
</script>
