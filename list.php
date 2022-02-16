<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<title>查询结果</title>
	<style>
		* {
			margin: 0;
			box-sizing: border-box;
		}
		body{
			margin: 10px;
		}
		h1{
			margin: 20px 0;
			text-align: center;
			color: #ff0000;
		}
		select{
			height: 25px;
		}
		.item{
			margin: 15px 0;
			display: flex;
		}
		.left{
			border: 1px solid #eeeeee;
			border-radius: 4px;
			height: 120px;
			width: 120px;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.right{
			margin-left: 10px;
			font-size: 13px;
			color: #666666;
		}
		.right div{
			margin: 2px 0;
		}
	</style>
	<script type="text/javascript">
		window.onload = function(){
			var status = getQueryVariable("status");
			if(status){
				document.getElementById("status").options[status].selected = true; 
			}
			var cate = getQueryVariable("cate");
    		if(cate){
				document.getElementById("cate").options[cate].selected = true; 
			}
		}
		function changeIntQuery(key,value) {
			if(location.href.indexOf(key +"=") > -1){
				var url = location.href.replace(key +"=", "replaceKey=");
				location.href = url.replace(/replaceKey=\d+/g, key +"="+ value);
			}else{
				location.href = location.href +"&"+ key +"="+ value;
			}
		}
		function getQueryVariable(variable){
			var query = window.location.search.substring(1);
			var vars = query.split("&");
			for (var i=0;i<vars.length;i++) {
				var pair = vars[i].split("=");
				if(pair[0] == variable){return pair[1];}
			}
			return(false);
		}
		function gotoDetail(id) {
			location.href = "detail.php?id="+id;
		}
		function nextPage() {
			if(document.getElementsByClassName("item").length == 20){
				var page = getQueryVariable("page");
				changeIntQuery("page",Number(page)+1);
			}else{
				alert("没有了!");
			}
		}
	</script>
</head>
<body>
	<button onclick="history.go(-1);">返回</button>
	<button onclick="location.href='/'">首页</button>
	<select id="status" onchange="changeIntQuery('status', this.options[this.selectedIndex].value);">
		<option value="0">所有状态</option>
		<option value="1">待受理</option>
		<option value="2">等待实质审核</option>
		<option value="3">初审公告</option>
		<option value="4">已注册</option>
		<option value="5">已销亡</option>
		<option value="6">无效商标</option>
	</select>
	<select id="cate" onchange="changeIntQuery('cate', this.options[this.selectedIndex].value);">
		<option value="0">所有类别</option>
		<option value="1">01</option><option value="2">02</option><option value="3">03</option><option value="4">04</option><option value="5">05</option>
		<option value="6">06</option><option value="7">07</option><option value="8">08</option><option value="9">09</option><option value="10">10</option>
		<option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option>
		<option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option>
		<option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option>
		<option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option>
		<option value="31">31</option><option value="32">32</option><option value="33">33</option><option value="34">34</option><option value="35">35</option>
		<option value="36">36</option><option value="37">37</option><option value="38">38</option><option value="39">39</option><option value="40">40</option>
		<option value="41">41</option><option value="42">42</option><option value="43">43</option><option value="44">44</option><option value="45">45</option>
	</select>
<?php
	require_once("api.php");
	$keyword = $_GET["keyword"];
	$type = $_GET["type"] ?? 1;
	$page = $_GET["page"] ?? 1;
	$cate = $_GET["cate"] ?? 0;
	$status = $_GET["status"] ?? 0;

	if (empty($keyword)){
		die("<h1>关键词不能为空!</h1>");
	}
	if(empty($type) || $type > 5){
		die("<h1>查询类型不正确!</h1>");
	}
	if(iconv_strlen($keyword) < 2){
		die("<h1>输入的关键词过短!</h1>");
	}
	$data = baiduApi("list?page=".$page."&pageSize=20&keyword=".$keyword."&type=".$type."&cate=".$cate."&status=".$status);
	if(empty($data)){
		die("<h1>没有找到结果!</h1>");
	}
?>
	<h1>查询结果</h1>
	<div>
<?php
	foreach ($data as $key => $value) {
?>
		<div class="item" onclick="gotoDetail(<?php echo $value->id?>)">
			<div class="left">
				<img src="<?php echo $value->pic?>" width="110px"/>
			</div>
			<div class="right">
				<div style="color: #000000;font-size:18px;">
					<?php echo $value->name?>
				</div>
				<div>
					<?php echo $value->applicant_name?>
				</div>
				<div>
					<div>注册号：<?php echo $value->applyNo?></div>
					<div>类别：<?php echo $value->cate?></div>
				</div>
				<div>
					申请日期：<?php echo cutDate($value->apply_time)?>
				</div>
				<div>
					当前状态：<?php echo $statusTxt[$value->status]?>
				</div>
			</div>
		</div>
<?php
	}
?>
	</div>
	<button style="width: 100%;" onclick="nextPage()">下一页</button>
</body>
</html>