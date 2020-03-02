<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h2>商品名称：{{$goods->g_name}}</h2>
	<td>当前访问量：{{$count}}</td>
	<p>商品价格{{$goods->g_price}}</p>
	<p>商品库存：{{$goods->g_num}}</p>	
</body>
</html>