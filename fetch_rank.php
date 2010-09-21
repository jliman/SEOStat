<?php
require_once('lib/class.googlepr.php');
require_once('inc/db.php');
require_once('inc/helper.php');
require_once('inc/fetch.php');

ob_start();

$fetchGooglePR = true;
$fetchAlexa = true;
$saveToDB = true;

echo 'Start fetch Web Rank: '.date("Y-m-d H:i:s").'<br>';

foreach ($accounts as $account) {
	echo 'Get stat for: '.$account['url'].' - '.date("Y-m-d H:i:s").'<br>';
	
	$result = array();
		
	if ($fetchAlexa) {
		//alexa rank
		//http://xml.alexa.com/data?cli=10&url=waytodeal.com
		$ch = getCURLResource();
		curl_setopt($ch, CURLOPT_URL, "http://xml.alexa.com/data?cli=10&url=".$account['url']);
		$buf2 = curl_exec ($ch);
		curl_close($ch);
		
		$xml=xml2ary($buf2);
		$alexarank = $xml['ALEXA']['_c']['SD']['_c']['POPULARITY']['_a']['TEXT']; 
		
		echo 'Alexa rank: '.$alexarank.'<br>';
	}
	
	$result['alexarank'] = $alexarank;

	if ($fetchGooglePR) {
		$gpr = new GooglePR();
		$gpr->userAgent = $_SERVER["HTTP_USER_AGENT"];
		$gpr->cacheDir = dirname(__FILE__)."/prcache";
		$gpr->maxCacheAge = 86400;
		$gpr->useCache = false;
		$googlepr = $gpr->GetPR($account['url']);
		echo 'Google pagerank: '.$googlepr.'<br>';	
	}
	
	$result['grank'] = $googlepr;
	
	if ($saveToDB) {
		saveRankStat($account,$result);
	}
	
}

echo 'End fetch Web Rank: '.date("Y-m-d H:i:s").'<br>';
include('inc/notification.php');
?>