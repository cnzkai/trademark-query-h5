<?php
	$statusTxt = ["所有","待受理","等待实质审核","初审公告","已注册","已销亡","无效商标"];//1待受理,2等待实质审核,3初审公告,4已注册,5已销亡,6无效商标

	function baiduApi($query)
	{
		$appCode = "你的appCode";
		$headers = array();
		array_push($headers, "X-Bce-Signature:AppCode/" . $appCode);
		array_push($headers, "Content-Type".":"."application/json;charset=UTF-8");
		$url = "http://gwgp-yytgq5tciko.n.bdcloudapi.com/".$query;
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_FAILONERROR, false);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		$data = curl_exec($curl);
		curl_close($curl);
		$ret = json_decode($data);
		if($ret->code != 200){
			die("<h1>".$ret->msg."</h1>");
		}
		return $ret->data;
	}

	function cutDate($value)
	{
		if($value){
			return substr($value, 0, 4) . '-' . substr($value, 4, 2) . '-' . substr($value, 6, 2);
		}
		return '-';
	}
?>