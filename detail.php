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
		.detail{
			width: 100%;
			word-wrap: break-word;
			word-break: break-all;
		}
		.kv{
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin: 10px 0;
			color: #333333;
		}
		.kv .k{
			width: 80px;
			font-size: 16px;
		}
		.kv .v{
			flex: 1;
			color: #999999;
			font-size: 14px;
		}
	</style>
</head>
<body>
	<button onclick="history.go(-1);">返回</button>
<?php
	require_once("api.php");
	$id = $_GET["id"];
	if(empty($id)){
		die("<h1>ID不正确!</h1>");
	}
	$data = baiduApi("detail?id=".$id);
	if(empty($data)){
		die("<h1>数据未找到!</h1>");
	}
?>
	<h1>商标详情</h1>
	<div class="detail">
		<div style="text-align: center;">
			<img src="<?php echo $data->pic?>" width="100%" style="max-width:400px;max-height: 400px;"/>
		</div>
		<div class="kv">
			<div style="color:#3C82F0;font-size: 20px;letter-spacing: 0;overflow: hidden;"><?php echo $data->name?></div>
			<div style="padding: 0 5px;background-color: red;height: 18px;line-height: 18px;background-image: linear-gradient(to right, #66b0ff 0%, #3C82F0 100%);font-size: 14px;color: #fff;border-radius: 10px 1px 10px 1px;"><?php echo $data->cate?> 类</div>
		</div>
		<div style="font-size: 14px;color: #999999;"><?php echo $statusTxt[$data->status]?></div>
		<div class="kv">
			<span class="k">注 册 号</span>
			<span class="v"><?php echo $data->applyNo?></span>
		</div>
		<div class="kv">
			<span class="k">使用期限</span>
			<span class="v"><?php echo cutDate($data->start_time)?> —— <?php echo cutDate($data->end_time)?></span>
		</div>
		<div class="kv">
			<span class="k">类 似 群</span>
			<span class="v" style="word-wrap: break-all;word-break: break-all;white-space: pre-wrap;"><?php echo $data->group?></span>
		</div>
		<div class="kv">
			<span class="k">商品/服务</span>
			<span class="v" style="word-wrap: break-all;word-break: break-all;white-space: pre-wrap;"><?php echo join("\n", $data->goods)?></span>
		</div>
		<div class="kv">
			<span class="k">申请日期</span>
			<span class="v"><?php echo cutDate($data->apply_time)?></span>
		</div>
		<div class="kv">
			<span class="k">初审日期</span>
			<span class="v"><?php echo cutDate($data->review_time)?></span>
		</div>
		<div class="kv">
			<span class="k">初审公告</span>
			<span class="v"><?php echo $data->review_no?></span>
		</div>
		<div class="kv">
			<span class="k">注册日期</span>
			<span class="v"><?php echo cutDate($data->regist_time)?></span>
		</div>
		<div class="kv">
			<span class="k">注册公告</span>
			<span class="v"><?php echo $data->regist_no?></span>
		</div>
		<div class="kv">
			<span class="k">设计说明</span>
			<span class="v"><?php echo $data->designAbout?></span>
		</div>
		<div class="kv">
			<span class="k">申 请 人</span>
			<span class="v"><?php echo $data->applicant_name?></span>
		</div>
		<div class="kv">
			<span class="k">申请地址</span>
			<span class="v"><?php echo $data->applicant ? $data->applicant->address : ''?></span>
		</div>
		<div class="kv">
			<span class="k">代理机构</span>
			<span class="v"><?php echo $data->agency_name?></span>
		</div>
	</div>
</body>
</html>