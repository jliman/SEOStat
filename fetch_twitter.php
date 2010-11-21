<?php
require_once('inc/db.php');
require_once('inc/helper.php');
require_once('inc/fetch.php');

$fetchTwitter = true;
$saveToDB = true;

echo 'Start fetch Twitter: '.date("Y-m-d H:i:s").'<br>';

foreach ($accounts as $account) {
	echo 'Get stat for: '.$account['url'].' - '.date("Y-m-d H:i:s").'<br>';

	if ($fetchTwitter && $account['twitter_page'] != '') {
		$ch = getCURLResource();
		curl_setopt($ch, CURLOPT_URL, "http://twitter.com/".$account['twitter_page']);
		$buf2 = curl_exec ($ch);
		curl_close($ch);
		
		$twitterData = array();
		$tempArr = explode('<span id="following_count" class="stats_count numeric">',$buf2);
		$tempArr = explode(' </span>',$tempArr[1]);
		$twitterData['following'] = str_replace(',','',trim($tempArr[0]));
		$tempArr = explode('<span id="follower_count" class="stats_count numeric">',$buf2);
		$tempArr = explode(' </span>',$tempArr[1]);
		$twitterData['follower'] = str_replace(',','',trim($tempArr[0]));
		$tempArr = explode('<span id="lists_count" class="stats_count numeric">',$buf2);
		$tempArr = explode('</span>',$tempArr[1]);
		$twitterData['listed'] = str_replace(',','',trim($tempArr[0]));
		$tempArr = explode('<span id="update_count" class="stat_count">',$buf2);
		$tempArr = explode('</span>',$tempArr[1]);
		$twitterData['tweets'] = str_replace(',','',trim($tempArr[0]));
		
		print_r($twitterData);
		echo '<br>';
		if ($saveToDB) {
			saveTwitterStat($account,$twitterData);		
		}
	}
	
}

echo 'End fetch Twitter: '.date("Y-m-d H:i:s").'<br>';
?>