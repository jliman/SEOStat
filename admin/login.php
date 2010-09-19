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
$login = new clogin();
$Page =& $login;

// Page init
$login->Page_Init();

// Page main
$login->Page_Main();
?>
<?php include "header.php" ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<script type="text/javascript">
<!--
var login = new ew_Page("login");

// extend page with ValidateForm function
login.ValidateForm = function(fobj)
{
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (!ew_HasValue(fobj.username))
		return ew_OnError(this, fobj.username, ewLanguage.Phrase("EnterUid"));
	if (!ew_HasValue(fobj.password))
		return ew_OnError(this, fobj.password, ewLanguage.Phrase("EnterPwd"));

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
login.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// requires js validation
<?php if (EW_CLIENT_VALIDATE) { ?>
login.ValidateRequired = true;
<?php } else { ?>
login.ValidateRequired = false;
<?php } ?>

//-->
</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("LoginPage") ?></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$login->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return login.ValidateForm(this);">
<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td><span class="phpmaker"><?php echo $Language->Phrase("Username") ?></span></td>
		<td><span class="phpmaker"><input type="text" name="username" id="username" size="20" value="<?php echo $login->Username ?>"></span></td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $Language->Phrase("Password") ?></span></td>
		<td><span class="phpmaker"><input type="password" name="password" id="password" size="20"></span></td>
	</tr>
	<tr>
		<td colspan="2" align="center"><span class="phpmaker"><input type="submit" name="submit" id="submit" value="<?php echo ew_BtnCaption($Language->Phrase("Login")) ?>"></span></td>
	</tr>
</table>
		<input type="hidden" name="rememberme" id="rememberme" value="a">
</form>
<br>
<p><span class="phpmaker">
</span></p>
<script language="JavaScript" type="text/javascript">
<!--

// Write your startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$login->Page_Terminate();
?>
<?php

//
// Page class
//
class clogin {

	// Page ID
	var $PageID = 'login';

	// Page object name
	var $PageObjName = 'login';

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
	function clogin() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_user)
		$GLOBALS["tbl_user"] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'login', TRUE);

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
	var $Username;
	var $LoginType;

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language, $UserProfile, $gsFormError;
		$sPassword = "";
		$sLastUrl = $Security->LastUrl(); // Get last URL
		if ($sLastUrl == "")
			$sLastUrl = "index.php";
		if (IsLoggingIn()) {
			$this->Username = @$_SESSION[EW_SESSION_USER_PROFILE_USER_NAME];
			$sPassword = @$_SESSION[EW_SESSION_USER_PROFILE_PASSWORD];
			$this->LoginType = @$_SESSION[EW_SESSION_USER_PROFILE_LOGIN_TYPE];
			$bValidPwd = $Security->ValidateUser($this->Username, $sPassword, FALSE);
			if ($bValidPwd) {
				$_SESSION[EW_SESSION_USER_PROFILE_USER_NAME] = "";
				$_SESSION[EW_SESSION_USER_PROFILE_PASSWORD] = "";
				$_SESSION[EW_SESSION_USER_PROFILE_LOGIN_TYPE] = "";
			}
		} else {
			if (!$Security->IsLoggedIn())
				$Security->AutoLogin();
			$Security->LoadUserLevel(); // Load user level
			if (@$_POST["username"] <> "") {

				// Setup variables
				$this->Username = ew_StripSlashes(@$_POST["username"]);
				$sPassword = ew_StripSlashes(@$_POST["password"]);
				$this->LoginType = strtolower(@$_POST["rememberme"]);
				$bValidate = $this->ValidateForm($this->Username, $sPassword);
				if (!$bValidate)
					$this->setMessage($gsFormError);
				$_SESSION[EW_SESSION_USER_PROFILE_USER_NAME] = $this->Username; // Save login user name
				$_SESSION[EW_SESSION_USER_PROFILE_LOGIN_TYPE] = $this->LoginType; // Save login type
			} else {
				if ($Security->IsLoggedIn()) {
					if ($this->getMessage() == "")
						$this->Page_Terminate($sLastUrl); // Return to last accessed page
				}
				$bValidate = FALSE;

				// Restore settings
				if (@$_COOKIE[EW_PROJECT_NAME]['Checksum'] == strval(crc32(md5(EW_RANDOM_KEY))))
					$this->Username = TEAdecrypt(@$_COOKIE[EW_PROJECT_NAME]['Username'], EW_RANDOM_KEY);
				if (@$_COOKIE[EW_PROJECT_NAME]['AutoLogin'] == "autologin") {
					$this->LoginType = "a";
				} elseif (@$_COOKIE[EW_PROJECT_NAME]['AutoLogin'] == "rememberusername") {
					$this->LoginType = "u";
				} else {
					$this->LoginType = "";
				}
			}
			$bValidPwd = FALSE;
			if ($bValidate) {

				// Call Logging In event
				$bValidate = $this->User_LoggingIn($this->Username, $sPassword);
				if ($bValidate) {
					$bValidPwd = $Security->ValidateUser($this->Username, $sPassword, FALSE); // Manual login
					if (!$bValidPwd) {
						if ($this->getMessage() == "")
							$this->setMessage($Language->Phrase("InvalidUidPwd")); // Invalid user id/password
					}
				} else {
					if ($this->getMessage() == "")
						$this-setMessage($Language->Phrase("LoginCancelled")); // Login cancelled
				}
			}
		}
		if ($bValidPwd) {

			// Write cookies
			if ($this->LoginType == "a") { // Auto login
				setcookie(EW_PROJECT_NAME . '[AutoLogin]',  "autologin", EW_COOKIE_EXPIRY_TIME); // Set autologin cookie
				setcookie(EW_PROJECT_NAME . '[Username]', TEAencrypt($this->Username, EW_RANDOM_KEY), EW_COOKIE_EXPIRY_TIME); // Set user name cookie
				setcookie(EW_PROJECT_NAME . '[Password]', TEAencrypt($sPassword, EW_RANDOM_KEY), EW_COOKIE_EXPIRY_TIME); // Set password cookie
				setcookie(EW_PROJECT_NAME . '[Checksum]', crc32(md5(EW_RANDOM_KEY)), EW_COOKIE_EXPIRY_TIME);
			} elseif ($this->LoginType == "u") { // Remember user name
				setcookie(EW_PROJECT_NAME . '[AutoLogin]', "rememberusername", EW_COOKIE_EXPIRY_TIME); // Set remember user name cookie
				setcookie(EW_PROJECT_NAME . '[Username]', TEAencrypt($this->Username, EW_RANDOM_KEY), EW_COOKIE_EXPIRY_TIME); // Set user name cookie
				setcookie(EW_PROJECT_NAME . '[Checksum]', crc32(md5(EW_RANDOM_KEY)), EW_COOKIE_EXPIRY_TIME);
			} else {
				setcookie(EW_PROJECT_NAME . '[AutoLogin]', "", EW_COOKIE_EXPIRY_TIME); // Clear auto login cookie
			}

			// Call loggedin event
			$this->User_LoggedIn($this->Username);
			$this->Page_Terminate($sLastUrl); // Return to last accessed URL
		} elseif ($this->Username <> "" && $sPassword <> "") {

			// Call user login error event
			$this->User_LoginError($this->Username, $sPassword);
		}
	}

	//
	// Validate form
	//
	function ValidateForm($usr, $pwd) {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (trim($usr) == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterUid");
		}
		if (trim($pwd) == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterPwd");
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form Custom Validate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
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

	// User Logging In event
	function User_LoggingIn($usr, $pwd) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// User Logged In event
	function User_LoggedIn($usr) {

		//echo "User Logged In";
	}

	// User Login Error event
	function User_LoginError($usr, $pwd) {

		//echo "User Login Error";
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
