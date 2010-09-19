<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_userinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$default = new cdefault();
$Page =& $default;

// Page init
$default->Page_Init();

// Page main
$default->Page_Main();
?>
<?php
$default->Page_Terminate();
?>
<?php

//
// Page class
//
class cdefault {

	// Page ID
	var $PageID = 'default';

	// Page object name
	var $PageObjName = 'default';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		return TRUE;
	}

	//
	// Page class constructor
	//
	function cdefault() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// User table object (tbl_user)
		$GLOBALS["tbl_user"] = new ctbl_user;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'default', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $tbl_user;

		// Security
		$Security = new cAdvancedSecurity();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language;
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		$Security->LoadUserLevel(); // load User Level
		if ($Security->AllowList('tbl_backlink_stat'))
		$this->Page_Terminate("tbl_backlink_statlist.php"); // Exit and go to default page
		if ($Security->AllowList('tbl_facebook_stat'))
			$this->Page_Terminate("tbl_facebook_statlist.php");
		if ($Security->AllowList('tbl_ga_stat'))
			$this->Page_Terminate("tbl_ga_statlist.php");
		if ($Security->AllowList('tbl_group'))
			$this->Page_Terminate("tbl_grouplist.php");
		if ($Security->AllowList('tbl_group_profile'))
			$this->Page_Terminate("tbl_group_profilelist.php");
		if ($Security->AllowList('tbl_index_stat'))
			$this->Page_Terminate("tbl_index_statlist.php");
		if ($Security->AllowList('tbl_profile'))
			$this->Page_Terminate("tbl_profilelist.php");
		if ($Security->AllowList('tbl_rank_stat'))
			$this->Page_Terminate("tbl_rank_statlist.php");
		if ($Security->AllowList('tbl_target'))
			$this->Page_Terminate("tbl_targetlist.php");
		if ($Security->AllowList('tbl_twitter_stat'))
			$this->Page_Terminate("tbl_twitter_statlist.php");
		if ($Security->AllowList('tbl_user'))
			$this->Page_Terminate("tbl_userlist.php");
		if ($Security->IsLoggedIn()) {
			echo $Language->Phrase("NoPermission");
			echo "<br><a href=\"logout.php\">" . $Language->Phrase("BackToLogin") . "</a>";
		} else {
			$this->Page_Terminate("login.php"); // Exit and go to login page
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}
}
?>
