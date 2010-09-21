<?php
set_time_limit(0);
if (isset($_GET['id'])) {
	$id = $_GET['id'];	
	if ($id == 'all') {
		$accounts = getProfiles();
	} else {
		$accounts = getProfiles($id);
	}
} else {
	if (isset($_GET['gid'])) {
		$id = $_GET['gid'];	
		$accounts = getProfilesByGroup($id);
	} else {
		die("Please specify profile ID..");
	}	
}
?>