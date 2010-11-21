<?php
require_once('inc/db.php');
require_once('inc/helper.php');
require_once('inc/fetch.php');

$fetchYahooIdx = true;
$fetchGoogleIdx = true;
$fetchBingIdx = true;
$saveToDB = true;

echo 'Start fetch Indexed Pages: '.date("Y-m-d H:i:s").'<br>';

foreach ($accounts as $account) {
	echo 'Get stat for: '.$account['url'].' - '.date("Y-m-d H:i:s").'<br>';

	$result = array();
	
	if ($fetchYahooIdx) {

		//http://siteexplorer.search.yahoo.com/search?p=[siteurl]&fr=sfp&bwm=i
		$ch = getCURLResource();
		curl_setopt($ch, CURLOPT_URL, "http://siteexplorer.search.yahoo.com/search?p=".$account['url']."&fr=sfp&bwm=i");
		$buf2 = curl_exec ($ch);
		curl_close($ch);
		
		$tempArr = explode('">Pages (', $buf2);
		$tempArr = explode(')<', $tempArr[1]);
	   	$indexedPage = str_replace(',', '', $tempArr[0]);
		
		echo 'Yahoo indexed page: '.$indexedPage.'<br>';
	}
		
	$result['yindex'] = $indexedPage;
		
	if ($fetchGoogleIdx) {
		//check indexed page google
		//http://www.google.com/search?hl=en&lr=&q=site%3A[siteurl]&btnG=Search
		$ch = getCURLResource();
		curl_setopt($ch, CURLOPT_URL, "http://www.google.com/search?hl=en&lr=&q=site%3A".$account['url']."&btnG=Search");
		$buf2 = curl_exec ($ch);
		curl_close($ch);
		
		$arrTemp = explode('results<nobr>',$buf2);
		$arrTemp = explode('>',$arrTemp[0]);
		$arrTemp = $arrTemp[sizeof($arrTemp)-1];
		$arrTemp = str_replace('About ', '', $arrTemp);
		$googleidxpage = str_replace(',', '', $arrTemp);
		
		echo 'Google indexed page: '.$googleidxpage.'<br>';
	}
		
	$result['gindex'] = $googleidxpage;

	if ($fetchBingIdx) {
		//bing index
		//http://www.bing.com/search?q=site%3A[siteurl]&go=&form=QBRE
		$ch = getCURLResource();
		curl_setopt($ch, CURLOPT_URL, "http://www.bing.com/search?q=site%3A".$account['url']."&go&FORM=QBRE");
		$buf2 = curl_exec ($ch);
		curl_close($ch);
		
		$tempArr = explode('<h1>All Results</h1><span class="sb_count" id="count">',$buf2);
		$tempArr = explode(' of ',$tempArr[1]);
		$tempArr = explode(' results',$tempArr[1]);
		$bingindex = str_replace(',', '', $tempArr[0]);
		
		echo 'Bing indexed page: '.$bingindex.'<br>';
	}

	$result['bingindex'] = $bingindex;
		
	if ($saveToDB) {
		saveIndexStat($account,$result);
	}	
}

echo 'End fetch Indexed Pages: '.date("Y-m-d H:i:s").'<br>';
?>