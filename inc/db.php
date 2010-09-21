<?
require_once('inc/conf.php');
require_once('lib/libcurlemu-1.0.4/libcurlemu.inc.php');

$conn = mysql_connect($dbhost, $dbuser, $dbpasswd);
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
mysql_select_db($dbname);

function getProfiles($id=null) {
	global $conn;
	if (isset($id)) {
		$query = "SELECT * FROM tbl_profile WHERE id IN ($id) AND is_active = '1'";	
	} else {
		$query = "SELECT * FROM tbl_profile WHERE is_active = '1'";	
	}
	$result = mysql_query($query, $conn) or die('Query failed: ' . mysql_error());	
	$profiles = array();
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$profiles[] = $line;
	}
	mysql_free_result($result);
	return $profiles;
}

function getProfilesByGroup($id=0) {
	global $conn;
	$query = "SELECT p.* FROM tbl_profile p JOIN tbl_group_profile gp ON p.id = gp.id_profile WHERE gp.id_group IN ($id) AND p.is_active = '1'";	
	$result = mysql_query($query, $conn) or die('Query failed: ' . mysql_error());	
	$profiles = array();
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$profiles[] = $line;
	}
	mysql_free_result($result);
	return $profiles;
}

function getGroups($id=null) {
	global $conn;
	if (isset($id)) {
		$query = "SELECT * FROM tbl_group WHERE id IN ($id) AND is_active = '1'";	
	} else {
		$query = "SELECT * FROM tbl_group WHERE is_active = '1'";	
	}
	$result = mysql_query($query, $conn) or die('Query failed: ' . mysql_error());	
	$groups = array();
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$groups[] = $line;
	}
	mysql_free_result($result);
	return $groups;
}

function getProfileDataByGroup($groupId=null) {
	global $conn;
	$data = array();
	if (isset($groupId)) {
		$sql = "SELECT * FROM v_dashboard WHERE id_group = $groupId";
		$result = mysql_query($sql, $conn) or die('Query failed: ' . mysql_error());	
		while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$data[] = $line;
		}
		mysql_free_result($result);		
	}
	return $data;
}

function getRankStat($id, $startDate, $endDate, $interval='d') {
	global $conn;
	$data = array();
	if ($interval == 'd') {
		$sql = "SELECT avg(alexa_rank) as alexa_rank, avg(google_pagerank) as google_pagerank, stat_date, DATE_FORMAT(stat_date,'%e %b') as period FROM 	tbl_rank_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by stat_date";
	} else if ($interval == 'w') {
		$sql = "SELECT avg(alexa_rank) as alexa_rank, avg(google_pagerank) as google_pagerank, year, week, CONCAT(week,'/',year) as period FROM 	tbl_rank_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by year, week";
	} else if ($interval == 'm') {
		$sql = "SELECT avg(alexa_rank) as alexa_rank, avg(google_pagerank) as google_pagerank, year, month, CONCAT(month,'/',year) as period FROM 	tbl_rank_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by year, month";
	}
	//echo $sql;
	$result = mysql_query($sql, $conn) or die('Query failed: ' . mysql_error());	
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$data[] = $line;
	}
	mysql_free_result($result);		
	return $data;
}

function getBacklinkStat($id, $startDate, $endDate, $interval='d') {
	global $conn;
	$data = array();
	if ($interval == 'd') {
		$sql = "SELECT avg(backlink1) as backlink1, avg(backlink2) as backlink2, avg(backlink3) as backlink3, stat_date, DATE_FORMAT(stat_date,'%e %b') as period FROM 	tbl_backlink_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by stat_date";
	} else if ($interval == 'w') {
		$sql = "SELECT avg(backlink1) as backlink1, avg(backlink2) as backlink2, avg(backlink3) as backlink3, year, week, CONCAT(week,'/',year) as period FROM 	tbl_backlink_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by year, week";
	} else if ($interval == 'm') {
		$sql = "SELECT avg(backlink1) as backlink1, avg(backlink2) as backlink2, avg(backlink3) as backlink3, year, month, CONCAT(month,'/',year) as period FROM 	tbl_backlink_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by year, month";
	}
	//echo $sql;
	$result = mysql_query($sql, $conn) or die('Query failed: ' . mysql_error());	
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$data[] = $line;
	}
	mysql_free_result($result);		
	return $data;
}
		
function getPageStat($id, $startDate, $endDate, $interval='d') {
	global $conn;
	$data = array();
	if ($interval == 'd') {
		$sql = "SELECT sum(pageview) as pageview, sum(visit) as visit, stat_date, DATE_FORMAT(stat_date,'%e %b') as period FROM 	tbl_ga_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by stat_date";
	} else if ($interval == 'w') {
		$sql = "SELECT sum(pageview) as pageview, sum(visit) as visit, year, week, CONCAT(week,'/',year) as period FROM 	tbl_ga_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by year, week";
	} else if ($interval == 'm') {
		$sql = "SELECT sum(pageview) as pageview, sum(visit) as visit, year, month, CONCAT(month,'/',year) as period FROM 	tbl_ga_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by year, month";
	}
	//echo $sql;
	$result = mysql_query($sql, $conn) or die('Query failed: ' . mysql_error());	
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$data[] = $line;
	}
	mysql_free_result($result);		
	return $data;
}
	
function getIndexedPageStat($id, $startDate, $endDate, $interval='d') {
	global $conn;
	$data = array();
	if ($interval == 'd') {
		$sql = "SELECT avg(google) as google, avg(yahoo) as yahoo, avg(bing) as bing, stat_date, DATE_FORMAT(stat_date,'%e %b') as period FROM 	tbl_index_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by stat_date";
	} else if ($interval == 'w') {
		$sql = "SELECT avg(google) as google, avg(yahoo) as yahoo, avg(bing) as bing, year, week, CONCAT(week,'/',year) as period FROM 	tbl_index_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by year, week";
	} else if ($interval == 'm') {
		$sql = "SELECT avg(google) as google, avg(yahoo) as yahoo, avg(bing) as bing, year, month, CONCAT(month,'/',year) as period FROM 	tbl_index_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by year, month";
	}
	//echo $sql;
	$result = mysql_query($sql, $conn) or die('Query failed: ' . mysql_error());	
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$data[] = $line;
	}
	mysql_free_result($result);		
	return $data;
}
		
function getFacebookStat($id, $startDate, $endDate, $interval='d') {
	global $conn;
	$data = array();
	if ($interval == 'd') {
		$sql = "SELECT sum(interactions) as interactions, sum(comments) as comments, sum(wallposts) as wallposts, sum(likes) as likes, avg(fans) as fans, avg(unsubscribe) as unsubscribe, stat_date, DATE_FORMAT(stat_date,'%e %b') as period FROM tbl_facebook_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by stat_date";
	} else if ($interval == 'w') {
		$sql = "SELECT sum(interactions) as interactions, sum(comments) as comments, sum(wallposts) as wallposts, sum(likes) as likes, avg(fans) as fans, avg(unsubscribe) as unsubscribe, year, week, CONCAT(week,'/',year) as period FROM 	tbl_facebook_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by year, week";
	} else if ($interval == 'm') {
		$sql = "SELECT sum(interactions) as interactions, sum(comments) as comments, sum(wallposts) as wallposts, sum(likes) as likes, avg(fans) as fans, avg(unsubscribe) as unsubscribe,  year, month, CONCAT(month,'/',year) as period FROM 	tbl_facebook_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by year, month";
	}
	//echo $sql;
	$result = mysql_query($sql, $conn) or die('Query failed: ' . mysql_error());	
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$data[] = $line;
	}
	mysql_free_result($result);		
	return $data;
}
	
function getTwitterStat($id, $startDate, $endDate, $interval='d') {
	global $conn;
	$data = array();
	if ($interval == 'd') {
		$sql = "SELECT avg(followers) as followers, avg(tweets) as tweets, stat_date, DATE_FORMAT(stat_date,'%e %b') as period FROM tbl_twitter_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by stat_date";
	} else if ($interval == 'w') {
		$sql = "SELECT avg(followers) as followers, avg(tweets) as tweets, year, week, CONCAT(week,'/',year) as period FROM 	tbl_twitter_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by year, week";
	} else if ($interval == 'm') {
		$sql = "SELECT avg(followers) as followers, avg(tweets) as tweets,  year, month, CONCAT(month,'/',year) as period FROM 	tbl_twitter_stat WHERE id_profile = $id AND stat_date <= '$endDate' AND stat_date >= '$startDate' group by year, month";
	}
	//echo $sql;
	$result = mysql_query($sql, $conn) or die('Query failed: ' . mysql_error());	
	while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
		$data[] = $line;
	}
	mysql_free_result($result);		
	return $data;
}
	
function saveTwitterStat($account,$result) {
	global $conn;
	$date = date("Y-m-d");
	$year = date("Y");
	$month = date("m");
	$week = date("W");
	$sql = "REPLACE INTO tbl_twitter_stat (id_profile, stat_date, year, month, week, following, followers, listed, tweets) VALUES (".$account['id'].", '".$date."', '".$year."','".$month."','".$week."','".$result['following']."', '".$result['follower']."', '".$result['listed']."', '".$result['tweets']."')";
	//die($sql);
	mysql_query($sql,$conn);
}

function saveFacebookStat($account, $result, $result2) {
	global $conn;
	$interactions = $result['Total Interactions'];
	$comments = $result['Comments'];
	$wallposts = $result['Wall Posts'];
	$likes = $result['Likes'];
	$fans = $result2['Total Fans'];
	$unsubscribe = $result2['Unsubscribed Fans'];
	
	$stat = array();
	
	foreach($interactions as $data) {
		$date = date("Y-m-d",exp_to_dec($data[0])/1000);
		if (!isset($stat[$date])) {
			$stat[$date] = array();
		}
		$stat[$date]['date'] = $date;
		$stat[$date]['interactions'] = $data[1];
	}

	foreach($comments as $data) {
		$date = date("Y-m-d",exp_to_dec($data[0])/1000);
		if (!isset($stat[$date])) {
			$stat[$date] = array();
		}
		$stat[$date]['comments'] = $data[1];
	}

	foreach($wallposts as $data) {
		$date = date("Y-m-d",exp_to_dec($data[0])/1000);
		if (!isset($stat[$date])) {
			$stat[$date] = array();
		}
		$stat[$date]['wallposts'] = $data[1];
	}

	foreach($likes as $data) {
		$date = date("Y-m-d",exp_to_dec($data[0])/1000);
		if (!isset($stat[$date])) {
			$stat[$date] = array();
		}
		$stat[$date]['likes'] = $data[1];
	}

	foreach($fans as $data) {
		$date = date("Y-m-d",exp_to_dec($data[0])/1000);
		if (!isset($stat[$date])) {
			$stat[$date] = array();
		}
		$stat[$date]['date'] = $date;
		$stat[$date]['fans'] = $data[1];
	}

	foreach($unsubscribe as $data) {
		$date = date("Y-m-d",exp_to_dec($data[0])/1000);
		if (!isset($stat[$date])) {
			$stat[$date] = array();
		}
		$stat[$date]['date'] = $date;
		$stat[$date]['unsubscribe'] = $data[1];
	}
	
	foreach($stat as $data) {
		$year = strftime("%Y",strtotime($data['date']));
		$month = strftime("%m",strtotime($data['date']));
		$week = strftime("%W",strtotime($data['date']));
		$sql = "REPLACE INTO tbl_facebook_stat (id_profile, stat_date, year, month, week, interactions, comments, wallposts, fans, likes, unsubscribe) VALUES (".$account['id'].", '".$data['date']."', '$year', '$month', '$week', '".$data['interactions']."', '".$data['comments']."', '".$data['wallposts']."', '".$data['fans']."', '".$data['likes']."', '".$data['unsubscribe']."')";
		mysql_query($sql,$conn);
	}
}

function saveBacklinkStat($account, $result) {
	global $conn;
	$date = date("Y-m-d");
	$year = date("Y");
	$month = date("m");
	$week = date("W");
	$sql = "REPLACE INTO tbl_backlink_stat (id_profile, stat_date, year, month, week, backlink1, backlink2, backlink3) VALUES (".$account['id'].", '".$date."', '".$year."','".$month."','".$week."','".$result['blwbacklink']."', '".$result['blcbacklink']."', '".$result['ybacklink']."')";
	mysql_query($sql,$conn);
}

function saveIndexStat($account, $result) {
	global $conn;
	$date = date("Y-m-d");
	$year = date("Y");
	$month = date("m");
	$week = date("W");
	$sql = "REPLACE INTO tbl_index_stat (id_profile, stat_date, year, month, week, google, yahoo, bing) VALUES (".$account['id'].", '".$date."', '".$year."', '".$month."', '".$week."', '".$result['gindex']."', '".$result['yindex']."', '".$result['bingindex']."')";
	mysql_query($sql, $conn);
}

function saveRankStat($account, $result) {
	global $conn;
	$date = date("Y-m-d");
	$year = date("Y");
	$month = date("m");
	$week = date("W");
	$sql = "REPLACE INTO tbl_rank_stat (id_profile, stat_date, year, month, week, alexa_rank, google_pagerank) VALUES (".$account['id'].", '".$date."', '".$year."', '".$month."', '".$week."', '".$result['alexarank']."', '".$result['grank']."')";
	mysql_query($sql,$conn);
}

function saveGAStat($account, $result) {
	global $conn;
	//$week = substr($result,0,2);
	
	$metrics = $result->metrics;
	$dimensions = $result->dimensions;
	
	//print_r($metrics);
	//echo '<br>';
	//print_r($dimensions);
	//echo '<br>';
	
	$year = substr($dimensions['date'],0,4);
	$month = substr($dimensions['date'],4,2);
	$date = substr($dimensions['date'],6,2);
	$hour = $dimensions['hour'];
	$week = date("W", mktime(0, 0, 0, $month, $date, $year));
	$trx_date = $year.'-'.$month.'-'.$date;
	$trx_hour = $hour.':00:00';
	$day = date("N", mktime(0, 0, 0, $month, $date, $year));
	//echo $trx_date.' '.$result->getPageviews().' '.$result->getVisits();
	$sql = "REPLACE INTO tbl_ga_stat (id_profile, stat_date, year, month, week, day, hour, pageview, visit) VALUES (".$account['id'].", '".$trx_date."', '$year', '$month', '$week', '$day', '$trx_hour', '".$result->getPageviews()."', '".$result->getVisits()."')";	
	//echo $sql.'<br>';
	mysql_query($sql,$conn);
}

function emptyIfZero($val) {
	if ($val == 0) {
		return "";
	} else {
		return $val;
	}
}
?>