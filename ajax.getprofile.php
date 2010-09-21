<?
require_once('inc/db.php');

$groupId = 0;
if (isset($_POST['groupId'])) {
	$groupId = $_POST['groupId'];
}
$profiles = getProfilesByGroup($groupId);

echo '<select class="jls_combo" name="cmbProfile" id="cmbProfile">';
foreach ($profiles as $profile) {
	echo '<option value="'.$profile['id'].'">'.$profile['name'].'</option>';
}
echo '</select>';
?>