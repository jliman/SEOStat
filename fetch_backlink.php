<?php
//comments

require_once('inc/db.php');
require_once('inc/helper.php');
require_once('inc/fetch.php');

ob_start();

$fetchYahoo = true;
$fetchBacklinkWatch = true;
$fetchDirgio = true;
$saveToDB = true;

echo 'Start fetch Backlink: '.date("Y-m-d H:i:s").'<br>';

foreach ($accounts as $account) {
	echo 'Get stat for: '.$account['url'].' - '.date("Y-m-d H:i:s").'<br>';
	
	if ($fetchYahoo) {
		//check backlink
		//http://siteexplorer.search.yahoo.com/search?p=www.waytodeal.com&fr=sfp&bwm=i
		$ch = getCURLResource();
		curl_setopt($ch, CURLOPT_URL, "http://siteexplorer.search.yahoo.com/search?p=".$account['url']."&fr=sfp&bwm=i");
		$buf2 = curl_exec ($ch);
		curl_close($ch);
		
		$tempArr = explode('">Pages (', $buf2);
		$tempArr = explode(')<i', $tempArr[1]);
	   $indexedPage = str_replace(',', '', $tempArr[0]);
		
		$tempArr = explode('Inlinks (',$tempArr[1]);
		$tempArr = explode('<i class',$tempArr[1]);
		$backlink = str_replace(',', '', $tempArr[0]);
		
		echo 'yahoo index: '.$indexedPage.'<br>yahoo backlink: '.$backlink.'<br>';
	}
		
	$result['yindex'] = $indexedPage;
	$result['ybacklink'] = $backlink;
	
	if ($fetchBacklinkWatch) {
		//check backlinkwatch.com
		$ch = getCURLResource();
		$page = 'http://www.backlinkwatch.com/index.php';
		curl_setopt($ch, CURLOPT_URL, $page);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "backlinkurl=".urlencode('http://'.$account['url'])."&submit=+Check+Backlinks+");
	
		$buf2 = curl_exec ($ch);
	
		curl_close($ch);
		
		$tempArr = explode('>Total Backlinks<',$buf2);
	   $tempArr = explode('<td class="row"align="center" width="671"  >',$tempArr[1]);
	   $tempArr = explode('&nbsp;</td>',$tempArr[1]);
		$backlinkwatch = $tempArr[0];
		
		echo 'Backlinkwatch: '.$backlinkwatch.'<br>';
	}
		
	$result['blwbacklink'] = $backlinkwatch;
	
	if ($fetchDirgio) {

		//http://www.dirgio.com/backlink-checker/?q=www.waytodeal.com&strOrderBy=&strOrder=&strAction=domain
		$ch = getCURLResource();		
		curl_setopt($ch, CURLOPT_URL, "http://www.dirgio.com/backlink-checker/?q=".$account['url']."&strOrderBy=&strOrder=&strAction=domain");
		$buf2 = curl_exec ($ch);
		curl_close($ch);
		
		//<script>parent.$('#results').html('<h3>Results (Total 301994)</h3><div id="pager-top"></div><br/><table
		
		$tempArr = explode(' out of ',$buf2);
		$tempArr = explode('</div>',$tempArr[1]);
		
		$backlinkcheck = str_replace(',','',$tempArr[0]);
		
		echo 'Dirgio.com: '.$backlinkcheck.'<br>';
	}
	$result['blcbacklink'] = $backlinkcheck;
	
	if ($saveToDB) {
		saveBacklinkStat($account,$result);
	}	
}

echo 'End fetch Backlink: '.date("Y-m-d H:i:s").'<br>';
include('inc/notification.php');
?>