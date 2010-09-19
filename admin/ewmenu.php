<?php

// Menu
define("EW_MENUBAR_CLASSNAME", "ewMenuBarVertical", TRUE);
define("EW_MENUBAR_SUBMENU_CLASSNAME", "", TRUE);
?>
<?php

// MenuItem Adding event
function MenuItem_Adding(&$Item) {

	//var_dump($Item);
	// Return FALSE if menu item not allowed

	return TRUE;
}
?>
<!-- Begin Main Menu -->
<div class="phpmaker">
<?php

// Generate all menu items
$RootMenu = new cMenu("RootMenu");
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(25, $Language->MenuPhrase("25", "MenuText"), "", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(1, $Language->MenuPhrase("1", "MenuText"), "tbl_backlink_statlist.php", 25, "", AllowListMenu('tbl_backlink_stat'));
$RootMenu->AddMenuItem(3, $Language->MenuPhrase("3", "MenuText"), "tbl_ga_statlist.php", 25, "", AllowListMenu('tbl_ga_stat'));
$RootMenu->AddMenuItem(6, $Language->MenuPhrase("6", "MenuText"), "tbl_index_statlist.php", 25, "", AllowListMenu('tbl_index_stat'));
$RootMenu->AddMenuItem(8, $Language->MenuPhrase("8", "MenuText"), "tbl_rank_statlist.php", 25, "", AllowListMenu('tbl_rank_stat'));
$RootMenu->AddMenuItem(27, $Language->MenuPhrase("27", "MenuText"), "", 25, "", IsLoggedIn());
$RootMenu->AddMenuItem(2, $Language->MenuPhrase("2", "MenuText"), "tbl_facebook_statlist.php", 27, "", AllowListMenu('tbl_facebook_stat'));
$RootMenu->AddMenuItem(10, $Language->MenuPhrase("10", "MenuText"), "tbl_twitter_statlist.php", 27, "", AllowListMenu('tbl_twitter_stat'));
$RootMenu->AddMenuItem(26, $Language->MenuPhrase("26", "MenuText"), "", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(4, $Language->MenuPhrase("4", "MenuText"), "tbl_grouplist.php", 26, "", AllowListMenu('tbl_group'));
$RootMenu->AddMenuItem(5, $Language->MenuPhrase("5", "MenuText"), "tbl_group_profilelist.php", 26, "", AllowListMenu('tbl_group_profile'));
$RootMenu->AddMenuItem(7, $Language->MenuPhrase("7", "MenuText"), "tbl_profilelist.php", 26, "", AllowListMenu('tbl_profile'));
$RootMenu->AddMenuItem(9, $Language->MenuPhrase("9", "MenuText"), "tbl_targetlist.php", 26, "", AllowListMenu('tbl_target'));
$RootMenu->AddMenuItem(28, $Language->MenuPhrase("28", "MenuText"), "tbl_userlist.php", 26, "", AllowListMenu('tbl_user'));
$RootMenu->AddMenuItem(-2, $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
</div>
<!-- End Main Menu -->
