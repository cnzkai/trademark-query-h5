<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<title>商标查询</title>
	<style>
		* {
			margin: 0;
			box-sizing: border-box;
		}
		body{
			margin: 30px 10px 0 10px;
		}
		h1{
			margin: 30px 0;
			text-align: center;
		}
		.line {
			margin: 20px 0;
		}
		label{
			white-space:nowrap;
			margin: 0 2px;
		}
		.same{
			width: 100%;
			height: 35px;
		}
	</style>
</head>
<body>
	<H1>商标查询</H1>
	<form action="list.php" method="get">
		<div class="line">
			<label><input name="type" type="radio" value="5" />精准</label> 
			<label><input name="type" type="radio" value="1" checked/>近似</label> 
			<label><input name="type" type="radio" value="2" />注册号</label> 
			<label><input name="type" type="radio" value="3" />申请人</label> 
			<label><input name="type" type="radio" value="4" />代理机构</label>
		</div>
		<div class="line">
			<input class="same" type="text" name="keyword" placeholder="请输入关键词"/>
		</div>
		<div class="line">
			<input class="same" type="submit" value="查询"/>
		</div>
	</form>
</body>
</html>