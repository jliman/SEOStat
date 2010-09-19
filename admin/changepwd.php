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
$changepwd = new cchangepwd();
$Page =& $changepwd;

// Page init
$changepwd->Page_Init();

// Page main
$changepwd->Page_Main();
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
var changepwd = new ew_Page("changepwd");

// extend page with ValidateForm function
changepwd.ValidateForm = function(fobj) {
	if (!this.ValidateRequired)
		return true; // ignore validation
	if  (!ew_HasValue(fobj.opwd))
		return ew_OnError(this, fobj.opwd, ewLanguage.Phrase("EnterOldPassword"));
	if  (!ew_HasValue(fobj.npwd))
		return ew_OnError(this, fobj.npwd, ewLanguage.Phrase("EnterNewPassword"));
	if  (fobj.npwd.value != fobj.cpwd.value)
		return ew_OnError(this, fobj.cpwd, ewLanguage.Phrase("MismatchPassword"));

	// Call Form Custom Validate event
	if (!this.Form_CustomValidate(fobj)) return false;
	return true;
}

// extend page with Form_CustomValidate function
changepwd.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// requires js validation
<?php if (EW_CLIENT_VALIDATE) { ?>
changepwd.ValidateRequired = true;
<?php } else { ?>
changepwd.ValidateRequired = false;
<?php } ?>

//-->
</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("ChangePwdPage") ?></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$changepwd->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return changepwd.ValidateForm(this);">
<table border="0" cellspacing="0" cellpadding="4">
	<tr>
		<td><span class="phpmaker"><?php echo $Language->Phrase("OldPassword") ?></span></td>
		<td><span class="phpmaker"><input type="password" name="opwd" id="opwd" size="20"></span></td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $Language->Phrase("NewPassword") ?></span></td>
		<td><span class="phpmaker"><input type="password" name="npwd" id="npwd" size="20"></span></td>
	</tr>
	<tr>
		<td><span class="phpmaker"><?php echo $Language->Phrase("ConfirmPassword") ?></span></td>
		<td><span class="phpmaker"><input type="password" name="cpwd" id="cpwd" size="20"></span></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td><span class="phpmaker"><input type="submit" name="submit" id="submit" value="<?php echo ew_BtnCaption($Language->Phrase("ChangePwdBtn")) ?>"></span></td>
	</tr>
</table>
</form>
<br>
<script language="JavaScript" type="text/javascript">
<!--

// Write your startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$changepwd->Page_Terminate();
?>
<?php

//
// Page class
//
class cchangepwd {

	// Page ID
	var $PageID = 'changepwd';

	// Page object name
	var $PageObjName = 'changepwd';

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
	function cchangepwd() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_user)
		$GLOBALS["tbl_user"] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'changepwd', TRUE);

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
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn() || $Security->IsSysAdmin())
			$this->Page_Terminate("login.php");
		$Security->LoadCurrentUserLevel('tbl_user');

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
		global $conn, $Language, $Security, $gsFormError, $tbl_user;
		if (!ew_IsHttpPost())
			return;
		$bPwdUpdated = FALSE;

		// Setup variables
		$sUsername = $Security->CurrentUserName();
		$sOPwd = ew_StripSlashes(@$_POST["opwd"]);
		$sNPwd = ew_StripSlashes(@$_POST["npwd"]);
		$sCPwd = ew_StripSlashes(@$_POST["cpwd"]);
		if ($this->ValidateForm($sOPwd, $sNPwd, $sCPwd)) {
			$sFilter = str_replace("%u", ew_AdjustSql($sUsername), EW_USER_NAME_FILTER);

			// Set up filter (Sql Where Clause) and get Return SQL
			// SQL constructor in tbl_user class, tbl_userinfo.php

			$tbl_user->CurrentFilter = $sFilter;
			$sSql = $tbl_user->SQL();
			if ($rs = $conn->Execute($sSql)) {
				if (!$rs->EOF) {
					if ((EW_MD5_PASSWORD && md5($sOPwd) == $rs->fields('passwd')) ||
						(!EW_MD5_PASSWORD && $sOPwd == $rs->fields('passwd'))) {
						$rsnew = array('passwd' => $sNPwd); // Change Password
						$rs->Close();
						$conn->raiseErrorFn = 'ew_ErrorFn';
						$bValidPwd = $conn->Execute($tbl_user->UpdateSQL($rsnew));
						$conn->raiseErrorFn = '';
						if ($bValidPwd)
							$bPwdUpdated = TRUE;
					}	else {
						$this->setMessage($Language->Phrase("InvalidPassword"));
					}
				} else {
					$rs->Close();
				}
			}
		}
		if ($bPwdUpdated) {
			$this->setMessage($Language->Phrase("PasswordChanged")); // Set up message
			$this->Page_Terminate("index.php"); // Exit page and clean up
		} else {
			$this->setMessage($gsFormError);
		}
	}

	// Validate form
	function ValidateForm($opwd, $npwd, $cpwd) {
		global $Language, $gsFormError;

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Initialize form error message
		$gsFormError = "";
		if ($opwd == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterOldPassword");
		}
		if ($npwd == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterNewPassword");
		}
		if ($npwd <> $cpwd) {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("MismatchPassword");
		}

		// Return validate result
		$valid = ($gsFormError == "");

		// Call Form CustomValidate event
		$sFormCustomError = "";
		$valid = $valid && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $valid;
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

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
