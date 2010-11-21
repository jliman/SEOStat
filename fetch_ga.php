<?php
require_once('lib/gapi.class.php');
require_once('inc/db.php');
require_once('inc/helper.php');
require_once('inc/fetch.php');

$fetchGA = true;
$saveToDB = true;

echo 'Start fetch GA: '.date("Y-m-d H:i:s").'<br>';

foreach ($accounts as $account) {
	echo 'Get stat for: '.$account['url'].' - '.date("Y-m-d H:i:s").'<br>';
	
	if ($fetchGA) {
		if ($account['ga_username'] != '') {
			$ga = new gapi($account['ga_username'],$account['ga_passwd']);
			$fromDate = date("Y-m-d", strtotime('-6 days'));
			$toDate = date("Y-m-d");
			$ga->requestReportData($account['ga_profileid'], array('week','date','hour'), array('pageviews','visits'), array('date'), null, $fromDate, $toDate, 1, 1000);
			foreach($ga->getResults() as $result) {
				//01 20100101 00
				if ($saveToDB) {
					saveGAStat($account,$result);		
				}
			}	
		}
	}	
}

echo 'End fetch GA: '.date("Y-m-d H:i:s").'<br>';
?>