<?php
require_once('inc/db.php');
require_once('inc/helper.php');
require_once('inc/fetch.php');

$fetchFacebook = true;
$saveToDB = true;

echo 'Start fetch Facebook: '.date("Y-m-d H:i:s").'<br>';

foreach ($accounts as $account) {
	echo 'Get stat for: '.$account['url'].' - '.date("Y-m-d H:i:s").'<br>';
		
	//get facebook page stat
	if ($fetchFacebook && $account['fb_pageid'] != '') {
		facebookLogin($account['ga_username'], $account['ga_passwd']);

		$ch = getCURLResource();
		curl_setopt($ch, CURLOPT_URL, "http://www.facebook.com/business/insights/json.php?id=".$account['fb_pageid']."&reports=1");
		$buf2 = curl_exec ($ch);
		curl_close($ch);

		//$tempArr = explode('or (;;);',$buf2);
		//$tempArr = json_decode($tempArr[1], true);
		
		//echo '<pre>'.$buf2.'</pre>';

		$result = array();
		
		$tempArr = explode('{"Total Interactions":[[',$buf2);
		$tempArr = explode(']]},{"Comments"',$tempArr[1]);
		$tempArr = explode('],[',$tempArr[0]);
		for ($i = 0; $i < sizeof($tempArr); $i++) {
			$tempArr[$i] = explode(',',$tempArr[$i]);
		}
		$result['Total Interactions'] = $tempArr;
		
		$tempArr = explode('{"Comments":[[',$buf2);
		$tempArr = explode(']]},{"Wall Posts"',$tempArr[1]);
		$tempArr = explode('],[',$tempArr[0]);
		for ($i = 0; $i < sizeof($tempArr); $i++) {
			$tempArr[$i] = explode(',',$tempArr[$i]);
		}
		$result['Comments'] = $tempArr;
		
		$tempArr = explode('{"Wall Posts":[[',$buf2);
		$tempArr = explode(']]},{"Likes"',$tempArr[1]);
		$tempArr = explode('],[',$tempArr[0]);
		for ($i = 0; $i < sizeof($tempArr); $i++) {
			$tempArr[$i] = explode(',',$tempArr[$i]);
		}
		$result['Wall Posts'] = $tempArr;
		
		$tempArr = explode('{"Likes":[[',$buf2);
		$tempArr = explode(']]},',$tempArr[1]);
		$tempArr = explode('],[',$tempArr[0]);
		for ($i = 0; $i < sizeof($tempArr); $i++) {
			$tempArr[$i] = explode(',',$tempArr[$i]);
		}
		$result['Likes'] = $tempArr;
		
		$ch = getCURLResource();
		curl_setopt($ch, CURLOPT_URL, "http://www.facebook.com/business/insights/json.php?id=".$account['fb_pageid']."&reports=2");
		$buf2 = curl_exec ($ch);
		curl_close($ch);

		$result2 = array();

		$tempArr = explode('{"Total Likes":[[',$buf2);
		$tempArr = explode(']]},{"Hidden From News Feed"',$tempArr[1]);
		$tempArr = explode('],[',$tempArr[0]);
		for ($i = 0; $i < sizeof($tempArr); $i++) {
			$tempArr[$i] = explode(',',$tempArr[$i]);
		}
		$result2['Total Fans'] = $tempArr;
		
		$tempArr = explode('{"Hidden From News Feed":[[',$buf2);
		$tempArr = explode(']]},',$tempArr[1]);
		$tempArr = explode('],[',$tempArr[0]);
		for ($i = 0; $i < sizeof($tempArr); $i++) {
			$tempArr[$i] = explode(',',$tempArr[$i]);
		}
		$result2['Unsubscribed Fans'] = $tempArr;
		
/*
		echo '<pre>';
		print_r($result);
		print_r($result2);
		echo '</pre>';
*/
		
		if ($saveToDB) {
			saveFacebookStat($account,$result,$result2);	
		}
		
		facebookLogout();
	}	
}

echo 'End fetch Facebook: '.date("Y-m-d H:i:s").'<br>';
?>