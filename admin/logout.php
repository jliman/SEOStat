<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "tbl_userinfo.php" ?>
<?php include "phpfn7.php" ?>
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
$logout = new clogout();
$Page =& $logout;

// Page init
$logout->Page_Init();

// Page main
$logout->Page_Main();
?>
<?php
$logout->Page_Terminate();
?>
<?php

//
// Page class
//
class clogout {

	// Page ID
	var $PageID = 'logout';

	// Page object name
	var $PageObjName = 'logout';

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
	function clogout() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_user)
		$GLOBALS["tbl_user"] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'logout', TRUE);

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
		global $Security, $Language, $UserProfile;
		$bValidate = TRUE;
		$sUsername = $Security->CurrentUserName();

		// Call User LoggingOut event
		$bValidate = $this->User_LoggingOut($sUsername);
		if (!$bValidate) {
			$sLastUrl = $Security->LastUrl();
			if ($sLastUrl == "")
				$sLastUrl = "index.php";
			$this->Page_Terminate($sLastUrl); // Go to last accessed URL
		} else {
			if (@$_COOKIE[EW_PROJECT_NAME]['AutoLogin'] == "") // Not autologin
				setcookie(EW_PROJECT_NAME . '[Username]', ""); // clear user name cookie
			setcookie(EW_PROJECT_NAME . '[Password]', ""); // clear password cookie
			setcookie(EW_PROJECT_NAME . '[LastUrl]', ""); // clear last URL

			// Call User LoggedOut event
			$this->User_LoggedOut($sUsername);

			// Unset all of the Session variables
			$_SESSION = array();

			// Delete the Session cookie and kill the Session
			if (isset($_COOKIE[session_name()]))
				setcookie(session_name(), '', time()-42000, '/');

			// Finally, destroy the Session
			@session_destroy();
			$this->Page_Terminate("login.php"); // Go to login page
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

	// User Logging Out event
	function User_LoggingOut($usr) {

		// Enter your code here
		// To cancel, set return value to FALSE;

		return TRUE;
	}

	// User Logged Out event
	function User_LoggedOut($usr) {

		//echo "User Logged Out";
	}
}
?>
