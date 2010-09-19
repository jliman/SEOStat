<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_profileinfo.php" ?>
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
$tbl_profile_edit = new ctbl_profile_edit();
$Page =& $tbl_profile_edit;

// Page init
$tbl_profile_edit->Page_Init();

// Page main
$tbl_profile_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_profile_edit = new ew_Page("tbl_profile_edit");

// page properties
tbl_profile_edit.PageID = "edit"; // page ID
tbl_profile_edit.FormID = "ftbl_profileedit"; // form ID
var EW_PAGE_ID = tbl_profile_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_profile_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_profile->name->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_ga_username"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_profile->ga_username->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_ga_passwd"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_profile->ga_passwd->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_ga_profileid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_profile->ga_profileid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_url"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_profile->url->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_profile_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_profile_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_profile_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_profile_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_profile_edit.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_profile_edit.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script type="text/javascript">
<!--
var ew_DHTMLEditors = [];

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_profile->TableCaption() ?><br><br>
<a href="<?php echo $tbl_profile->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_profile_edit->ShowMessage();
?>
<form name="ftbl_profileedit" id="ftbl_profileedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_profile_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="tbl_profile">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_profile->id->Visible) { // id ?>
	<tr<?php echo $tbl_profile->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->id->FldCaption() ?></td>
		<td<?php echo $tbl_profile->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $tbl_profile->id->ViewAttributes() ?>><?php echo $tbl_profile->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($tbl_profile->id->CurrentValue) ?>">
</span><?php echo $tbl_profile->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->name->Visible) { // name ?>
	<tr<?php echo $tbl_profile->name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_profile->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" title="<?php echo $tbl_profile->name->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->name->EditValue ?>"<?php echo $tbl_profile->name->EditAttributes() ?>>
</span><?php echo $tbl_profile->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->ga_username->Visible) { // ga_username ?>
	<tr<?php echo $tbl_profile->ga_username->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->ga_username->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_profile->ga_username->CellAttributes() ?>><span id="el_ga_username">
<input type="text" name="x_ga_username" id="x_ga_username" title="<?php echo $tbl_profile->ga_username->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->ga_username->EditValue ?>"<?php echo $tbl_profile->ga_username->EditAttributes() ?>>
</span><?php echo $tbl_profile->ga_username->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->ga_passwd->Visible) { // ga_passwd ?>
	<tr<?php echo $tbl_profile->ga_passwd->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->ga_passwd->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_profile->ga_passwd->CellAttributes() ?>><span id="el_ga_passwd">
<input type="text" name="x_ga_passwd" id="x_ga_passwd" title="<?php echo $tbl_profile->ga_passwd->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->ga_passwd->EditValue ?>"<?php echo $tbl_profile->ga_passwd->EditAttributes() ?>>
</span><?php echo $tbl_profile->ga_passwd->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->ga_profileid->Visible) { // ga_profileid ?>
	<tr<?php echo $tbl_profile->ga_profileid->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->ga_profileid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_profile->ga_profileid->CellAttributes() ?>><span id="el_ga_profileid">
<input type="text" name="x_ga_profileid" id="x_ga_profileid" title="<?php echo $tbl_profile->ga_profileid->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $tbl_profile->ga_profileid->EditValue ?>"<?php echo $tbl_profile->ga_profileid->EditAttributes() ?>>
</span><?php echo $tbl_profile->ga_profileid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->url->Visible) { // url ?>
	<tr<?php echo $tbl_profile->url->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->url->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_profile->url->CellAttributes() ?>><span id="el_url">
<input type="text" name="x_url" id="x_url" title="<?php echo $tbl_profile->url->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->url->EditValue ?>"<?php echo $tbl_profile->url->EditAttributes() ?>>
</span><?php echo $tbl_profile->url->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->fb_pageid->Visible) { // fb_pageid ?>
	<tr<?php echo $tbl_profile->fb_pageid->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->fb_pageid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_profile->fb_pageid->CellAttributes() ?>><span id="el_fb_pageid">
<input type="text" name="x_fb_pageid" id="x_fb_pageid" title="<?php echo $tbl_profile->fb_pageid->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $tbl_profile->fb_pageid->EditValue ?>"<?php echo $tbl_profile->fb_pageid->EditAttributes() ?>>
</span><?php echo $tbl_profile->fb_pageid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->twitter_page->Visible) { // twitter_page ?>
	<tr<?php echo $tbl_profile->twitter_page->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->twitter_page->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_profile->twitter_page->CellAttributes() ?>><span id="el_twitter_page">
<input type="text" name="x_twitter_page" id="x_twitter_page" title="<?php echo $tbl_profile->twitter_page->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->twitter_page->EditValue ?>"<?php echo $tbl_profile->twitter_page->EditAttributes() ?>>
</span><?php echo $tbl_profile->twitter_page->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->is_wordpress->Visible) { // is_wordpress ?>
	<tr<?php echo $tbl_profile->is_wordpress->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->is_wordpress->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_profile->is_wordpress->CellAttributes() ?>><span id="el_is_wordpress">
<div id="tp_x_is_wordpress" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_is_wordpress" id="x_is_wordpress" title="<?php echo $tbl_profile->is_wordpress->FldTitle() ?>" value="{value}"<?php echo $tbl_profile->is_wordpress->EditAttributes() ?>></label></div>
<div id="dsl_x_is_wordpress" repeatcolumn="5">
<?php
$arwrk = $tbl_profile->is_wordpress->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_profile->is_wordpress->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_is_wordpress" id="x_is_wordpress" title="<?php echo $tbl_profile->is_wordpress->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_profile->is_wordpress->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $tbl_profile->is_wordpress->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->is_blogger->Visible) { // is_blogger ?>
	<tr<?php echo $tbl_profile->is_blogger->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->is_blogger->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_profile->is_blogger->CellAttributes() ?>><span id="el_is_blogger">
<div id="tp_x_is_blogger" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_is_blogger" id="x_is_blogger" title="<?php echo $tbl_profile->is_blogger->FldTitle() ?>" value="{value}"<?php echo $tbl_profile->is_blogger->EditAttributes() ?>></label></div>
<div id="dsl_x_is_blogger" repeatcolumn="5">
<?php
$arwrk = $tbl_profile->is_blogger->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_profile->is_blogger->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_is_blogger" id="x_is_blogger" title="<?php echo $tbl_profile->is_blogger->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_profile->is_blogger->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $tbl_profile->is_blogger->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->is_active->Visible) { // is_active ?>
	<tr<?php echo $tbl_profile->is_active->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->is_active->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_profile->is_active->CellAttributes() ?>><span id="el_is_active">
<div id="tp_x_is_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_is_active" id="x_is_active" title="<?php echo $tbl_profile->is_active->FldTitle() ?>" value="{value}"<?php echo $tbl_profile->is_active->EditAttributes() ?>></label></div>
<div id="dsl_x_is_active" repeatcolumn="5">
<?php
$arwrk = $tbl_profile->is_active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_profile->is_active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_is_active" id="x_is_active" title="<?php echo $tbl_profile->is_active->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_profile->is_active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $tbl_profile->is_active->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$tbl_profile_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_profile_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'tbl_profile';

	// Page object name
	var $PageObjName = 'tbl_profile_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_profile;
		if ($tbl_profile->UseTokenInUrl) $PageUrl .= "t=" . $tbl_profile->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_profile;
		if ($tbl_profile->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_profile->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_profile->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_profile_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_profile)
		$GLOBALS["tbl_profile"] = new ctbl_profile();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_profile', TRUE);

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
		global $tbl_profile;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		$Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->TableName);
		$Security->TablePermission_Loaded();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("tbl_profilelist.php");
		}

		// Create form object
		$objForm = new cFormObj();

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
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $tbl_profile;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$tbl_profile->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$tbl_profile->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_profile->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$tbl_profile->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$tbl_profile->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($tbl_profile->id->CurrentValue == "")
			$this->Page_Terminate("tbl_profilelist.php"); // Invalid key, return to list
		switch ($tbl_profile->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tbl_profilelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$tbl_profile->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $tbl_profile->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tbl_profileview.php")
						$sReturnUrl = $tbl_profile->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$tbl_profile->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$tbl_profile->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_profile;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_profile;
		$tbl_profile->id->setFormValue($objForm->GetValue("x_id"));
		$tbl_profile->name->setFormValue($objForm->GetValue("x_name"));
		$tbl_profile->ga_username->setFormValue($objForm->GetValue("x_ga_username"));
		$tbl_profile->ga_passwd->setFormValue($objForm->GetValue("x_ga_passwd"));
		$tbl_profile->ga_profileid->setFormValue($objForm->GetValue("x_ga_profileid"));
		$tbl_profile->url->setFormValue($objForm->GetValue("x_url"));
		$tbl_profile->fb_pageid->setFormValue($objForm->GetValue("x_fb_pageid"));
		$tbl_profile->twitter_page->setFormValue($objForm->GetValue("x_twitter_page"));
		$tbl_profile->is_wordpress->setFormValue($objForm->GetValue("x_is_wordpress"));
		$tbl_profile->is_blogger->setFormValue($objForm->GetValue("x_is_blogger"));
		$tbl_profile->is_active->setFormValue($objForm->GetValue("x_is_active"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_profile;
		$this->LoadRow();
		$tbl_profile->id->CurrentValue = $tbl_profile->id->FormValue;
		$tbl_profile->name->CurrentValue = $tbl_profile->name->FormValue;
		$tbl_profile->ga_username->CurrentValue = $tbl_profile->ga_username->FormValue;
		$tbl_profile->ga_passwd->CurrentValue = $tbl_profile->ga_passwd->FormValue;
		$tbl_profile->ga_profileid->CurrentValue = $tbl_profile->ga_profileid->FormValue;
		$tbl_profile->url->CurrentValue = $tbl_profile->url->FormValue;
		$tbl_profile->fb_pageid->CurrentValue = $tbl_profile->fb_pageid->FormValue;
		$tbl_profile->twitter_page->CurrentValue = $tbl_profile->twitter_page->FormValue;
		$tbl_profile->is_wordpress->CurrentValue = $tbl_profile->is_wordpress->FormValue;
		$tbl_profile->is_blogger->CurrentValue = $tbl_profile->is_blogger->FormValue;
		$tbl_profile->is_active->CurrentValue = $tbl_profile->is_active->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_profile;
		$sFilter = $tbl_profile->KeyFilter();

		// Call Row Selecting event
		$tbl_profile->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_profile->CurrentFilter = $sFilter;
		$sSql = $tbl_profile->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_profile->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_profile;
		$tbl_profile->id->setDbValue($rs->fields('id'));
		$tbl_profile->name->setDbValue($rs->fields('name'));
		$tbl_profile->ga_username->setDbValue($rs->fields('ga_username'));
		$tbl_profile->ga_passwd->setDbValue($rs->fields('ga_passwd'));
		$tbl_profile->ga_profileid->setDbValue($rs->fields('ga_profileid'));
		$tbl_profile->url->setDbValue($rs->fields('url'));
		$tbl_profile->fb_pageid->setDbValue($rs->fields('fb_pageid'));
		$tbl_profile->twitter_page->setDbValue($rs->fields('twitter_page'));
		$tbl_profile->is_wordpress->setDbValue($rs->fields('is_wordpress'));
		$tbl_profile->is_blogger->setDbValue($rs->fields('is_blogger'));
		$tbl_profile->is_active->setDbValue($rs->fields('is_active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_profile;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_profile->Row_Rendering();

		// Common render codes for all row types
		// id

		$tbl_profile->id->CellCssStyle = ""; $tbl_profile->id->CellCssClass = "";
		$tbl_profile->id->CellAttrs = array(); $tbl_profile->id->ViewAttrs = array(); $tbl_profile->id->EditAttrs = array();

		// name
		$tbl_profile->name->CellCssStyle = ""; $tbl_profile->name->CellCssClass = "";
		$tbl_profile->name->CellAttrs = array(); $tbl_profile->name->ViewAttrs = array(); $tbl_profile->name->EditAttrs = array();

		// ga_username
		$tbl_profile->ga_username->CellCssStyle = ""; $tbl_profile->ga_username->CellCssClass = "";
		$tbl_profile->ga_username->CellAttrs = array(); $tbl_profile->ga_username->ViewAttrs = array(); $tbl_profile->ga_username->EditAttrs = array();

		// ga_passwd
		$tbl_profile->ga_passwd->CellCssStyle = ""; $tbl_profile->ga_passwd->CellCssClass = "";
		$tbl_profile->ga_passwd->CellAttrs = array(); $tbl_profile->ga_passwd->ViewAttrs = array(); $tbl_profile->ga_passwd->EditAttrs = array();

		// ga_profileid
		$tbl_profile->ga_profileid->CellCssStyle = ""; $tbl_profile->ga_profileid->CellCssClass = "";
		$tbl_profile->ga_profileid->CellAttrs = array(); $tbl_profile->ga_profileid->ViewAttrs = array(); $tbl_profile->ga_profileid->EditAttrs = array();

		// url
		$tbl_profile->url->CellCssStyle = ""; $tbl_profile->url->CellCssClass = "";
		$tbl_profile->url->CellAttrs = array(); $tbl_profile->url->ViewAttrs = array(); $tbl_profile->url->EditAttrs = array();

		// fb_pageid
		$tbl_profile->fb_pageid->CellCssStyle = ""; $tbl_profile->fb_pageid->CellCssClass = "";
		$tbl_profile->fb_pageid->CellAttrs = array(); $tbl_profile->fb_pageid->ViewAttrs = array(); $tbl_profile->fb_pageid->EditAttrs = array();

		// twitter_page
		$tbl_profile->twitter_page->CellCssStyle = ""; $tbl_profile->twitter_page->CellCssClass = "";
		$tbl_profile->twitter_page->CellAttrs = array(); $tbl_profile->twitter_page->ViewAttrs = array(); $tbl_profile->twitter_page->EditAttrs = array();

		// is_wordpress
		$tbl_profile->is_wordpress->CellCssStyle = ""; $tbl_profile->is_wordpress->CellCssClass = "";
		$tbl_profile->is_wordpress->CellAttrs = array(); $tbl_profile->is_wordpress->ViewAttrs = array(); $tbl_profile->is_wordpress->EditAttrs = array();

		// is_blogger
		$tbl_profile->is_blogger->CellCssStyle = ""; $tbl_profile->is_blogger->CellCssClass = "";
		$tbl_profile->is_blogger->CellAttrs = array(); $tbl_profile->is_blogger->ViewAttrs = array(); $tbl_profile->is_blogger->EditAttrs = array();

		// is_active
		$tbl_profile->is_active->CellCssStyle = ""; $tbl_profile->is_active->CellCssClass = "";
		$tbl_profile->is_active->CellAttrs = array(); $tbl_profile->is_active->ViewAttrs = array(); $tbl_profile->is_active->EditAttrs = array();
		if ($tbl_profile->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$tbl_profile->id->ViewValue = $tbl_profile->id->CurrentValue;
			$tbl_profile->id->CssStyle = "";
			$tbl_profile->id->CssClass = "";
			$tbl_profile->id->ViewCustomAttributes = "";

			// name
			$tbl_profile->name->ViewValue = $tbl_profile->name->CurrentValue;
			$tbl_profile->name->CssStyle = "";
			$tbl_profile->name->CssClass = "";
			$tbl_profile->name->ViewCustomAttributes = "";

			// ga_username
			$tbl_profile->ga_username->ViewValue = $tbl_profile->ga_username->CurrentValue;
			$tbl_profile->ga_username->CssStyle = "";
			$tbl_profile->ga_username->CssClass = "";
			$tbl_profile->ga_username->ViewCustomAttributes = "";

			// ga_passwd
			$tbl_profile->ga_passwd->ViewValue = $tbl_profile->ga_passwd->CurrentValue;
			$tbl_profile->ga_passwd->CssStyle = "";
			$tbl_profile->ga_passwd->CssClass = "";
			$tbl_profile->ga_passwd->ViewCustomAttributes = "";

			// ga_profileid
			$tbl_profile->ga_profileid->ViewValue = $tbl_profile->ga_profileid->CurrentValue;
			$tbl_profile->ga_profileid->CssStyle = "";
			$tbl_profile->ga_profileid->CssClass = "";
			$tbl_profile->ga_profileid->ViewCustomAttributes = "";

			// url
			$tbl_profile->url->ViewValue = $tbl_profile->url->CurrentValue;
			$tbl_profile->url->CssStyle = "";
			$tbl_profile->url->CssClass = "";
			$tbl_profile->url->ViewCustomAttributes = "";

			// fb_pageid
			$tbl_profile->fb_pageid->ViewValue = $tbl_profile->fb_pageid->CurrentValue;
			$tbl_profile->fb_pageid->CssStyle = "";
			$tbl_profile->fb_pageid->CssClass = "";
			$tbl_profile->fb_pageid->ViewCustomAttributes = "";

			// twitter_page
			$tbl_profile->twitter_page->ViewValue = $tbl_profile->twitter_page->CurrentValue;
			$tbl_profile->twitter_page->CssStyle = "";
			$tbl_profile->twitter_page->CssClass = "";
			$tbl_profile->twitter_page->ViewCustomAttributes = "";

			// is_wordpress
			if (strval($tbl_profile->is_wordpress->CurrentValue) <> "") {
				switch ($tbl_profile->is_wordpress->CurrentValue) {
					case "0":
						$tbl_profile->is_wordpress->ViewValue = "No";
						break;
					case "1":
						$tbl_profile->is_wordpress->ViewValue = "Yes";
						break;
					default:
						$tbl_profile->is_wordpress->ViewValue = $tbl_profile->is_wordpress->CurrentValue;
				}
			} else {
				$tbl_profile->is_wordpress->ViewValue = NULL;
			}
			$tbl_profile->is_wordpress->CssStyle = "";
			$tbl_profile->is_wordpress->CssClass = "";
			$tbl_profile->is_wordpress->ViewCustomAttributes = "";

			// is_blogger
			if (strval($tbl_profile->is_blogger->CurrentValue) <> "") {
				switch ($tbl_profile->is_blogger->CurrentValue) {
					case "0":
						$tbl_profile->is_blogger->ViewValue = "No";
						break;
					case "1":
						$tbl_profile->is_blogger->ViewValue = "Yes";
						break;
					default:
						$tbl_profile->is_blogger->ViewValue = $tbl_profile->is_blogger->CurrentValue;
				}
			} else {
				$tbl_profile->is_blogger->ViewValue = NULL;
			}
			$tbl_profile->is_blogger->CssStyle = "";
			$tbl_profile->is_blogger->CssClass = "";
			$tbl_profile->is_blogger->ViewCustomAttributes = "";

			// is_active
			if (strval($tbl_profile->is_active->CurrentValue) <> "") {
				switch ($tbl_profile->is_active->CurrentValue) {
					case "0":
						$tbl_profile->is_active->ViewValue = "No";
						break;
					case "1":
						$tbl_profile->is_active->ViewValue = "Yes";
						break;
					default:
						$tbl_profile->is_active->ViewValue = $tbl_profile->is_active->CurrentValue;
				}
			} else {
				$tbl_profile->is_active->ViewValue = NULL;
			}
			$tbl_profile->is_active->CssStyle = "";
			$tbl_profile->is_active->CssClass = "";
			$tbl_profile->is_active->ViewCustomAttributes = "";

			// id
			$tbl_profile->id->HrefValue = "";
			$tbl_profile->id->TooltipValue = "";

			// name
			$tbl_profile->name->HrefValue = "";
			$tbl_profile->name->TooltipValue = "";

			// ga_username
			$tbl_profile->ga_username->HrefValue = "";
			$tbl_profile->ga_username->TooltipValue = "";

			// ga_passwd
			$tbl_profile->ga_passwd->HrefValue = "";
			$tbl_profile->ga_passwd->TooltipValue = "";

			// ga_profileid
			$tbl_profile->ga_profileid->HrefValue = "";
			$tbl_profile->ga_profileid->TooltipValue = "";

			// url
			$tbl_profile->url->HrefValue = "";
			$tbl_profile->url->TooltipValue = "";

			// fb_pageid
			$tbl_profile->fb_pageid->HrefValue = "";
			$tbl_profile->fb_pageid->TooltipValue = "";

			// twitter_page
			$tbl_profile->twitter_page->HrefValue = "";
			$tbl_profile->twitter_page->TooltipValue = "";

			// is_wordpress
			$tbl_profile->is_wordpress->HrefValue = "";
			$tbl_profile->is_wordpress->TooltipValue = "";

			// is_blogger
			$tbl_profile->is_blogger->HrefValue = "";
			$tbl_profile->is_blogger->TooltipValue = "";

			// is_active
			$tbl_profile->is_active->HrefValue = "";
			$tbl_profile->is_active->TooltipValue = "";
		} elseif ($tbl_profile->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$tbl_profile->id->EditCustomAttributes = "";
			$tbl_profile->id->EditValue = $tbl_profile->id->CurrentValue;
			$tbl_profile->id->CssStyle = "";
			$tbl_profile->id->CssClass = "";
			$tbl_profile->id->ViewCustomAttributes = "";

			// name
			$tbl_profile->name->EditCustomAttributes = "";
			$tbl_profile->name->EditValue = ew_HtmlEncode($tbl_profile->name->CurrentValue);

			// ga_username
			$tbl_profile->ga_username->EditCustomAttributes = "";
			$tbl_profile->ga_username->EditValue = ew_HtmlEncode($tbl_profile->ga_username->CurrentValue);

			// ga_passwd
			$tbl_profile->ga_passwd->EditCustomAttributes = "";
			$tbl_profile->ga_passwd->EditValue = ew_HtmlEncode($tbl_profile->ga_passwd->CurrentValue);

			// ga_profileid
			$tbl_profile->ga_profileid->EditCustomAttributes = "";
			$tbl_profile->ga_profileid->EditValue = ew_HtmlEncode($tbl_profile->ga_profileid->CurrentValue);

			// url
			$tbl_profile->url->EditCustomAttributes = "";
			$tbl_profile->url->EditValue = ew_HtmlEncode($tbl_profile->url->CurrentValue);

			// fb_pageid
			$tbl_profile->fb_pageid->EditCustomAttributes = "";
			$tbl_profile->fb_pageid->EditValue = ew_HtmlEncode($tbl_profile->fb_pageid->CurrentValue);

			// twitter_page
			$tbl_profile->twitter_page->EditCustomAttributes = "";
			$tbl_profile->twitter_page->EditValue = ew_HtmlEncode($tbl_profile->twitter_page->CurrentValue);

			// is_wordpress
			$tbl_profile->is_wordpress->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$tbl_profile->is_wordpress->EditValue = $arwrk;

			// is_blogger
			$tbl_profile->is_blogger->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$tbl_profile->is_blogger->EditValue = $arwrk;

			// is_active
			$tbl_profile->is_active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$tbl_profile->is_active->EditValue = $arwrk;

			// Edit refer script
			// id

			$tbl_profile->id->HrefValue = "";

			// name
			$tbl_profile->name->HrefValue = "";

			// ga_username
			$tbl_profile->ga_username->HrefValue = "";

			// ga_passwd
			$tbl_profile->ga_passwd->HrefValue = "";

			// ga_profileid
			$tbl_profile->ga_profileid->HrefValue = "";

			// url
			$tbl_profile->url->HrefValue = "";

			// fb_pageid
			$tbl_profile->fb_pageid->HrefValue = "";

			// twitter_page
			$tbl_profile->twitter_page->HrefValue = "";

			// is_wordpress
			$tbl_profile->is_wordpress->HrefValue = "";

			// is_blogger
			$tbl_profile->is_blogger->HrefValue = "";

			// is_active
			$tbl_profile->is_active->HrefValue = "";
		}

		// Call Row Rendered event
		if ($tbl_profile->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_profile->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_profile;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_profile->name->FormValue) && $tbl_profile->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_profile->name->FldCaption();
		}
		if (!is_null($tbl_profile->ga_username->FormValue) && $tbl_profile->ga_username->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_profile->ga_username->FldCaption();
		}
		if (!is_null($tbl_profile->ga_passwd->FormValue) && $tbl_profile->ga_passwd->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_profile->ga_passwd->FldCaption();
		}
		if (!is_null($tbl_profile->ga_profileid->FormValue) && $tbl_profile->ga_profileid->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_profile->ga_profileid->FldCaption();
		}
		if (!is_null($tbl_profile->url->FormValue) && $tbl_profile->url->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_profile->url->FldCaption();
		}
		if (!is_null($tbl_profile->fb_pageid->FormValue) && $tbl_profile->fb_pageid->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_profile->fb_pageid->FldCaption();
		}
		if (!is_null($tbl_profile->twitter_page->FormValue) && $tbl_profile->twitter_page->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_profile->twitter_page->FldCaption();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $tbl_profile;
		$sFilter = $tbl_profile->KeyFilter();
		$tbl_profile->CurrentFilter = $sFilter;
		$sSql = $tbl_profile->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// name
			$tbl_profile->name->SetDbValueDef($rsnew, $tbl_profile->name->CurrentValue, "", FALSE);

			// ga_username
			$tbl_profile->ga_username->SetDbValueDef($rsnew, $tbl_profile->ga_username->CurrentValue, "", FALSE);

			// ga_passwd
			$tbl_profile->ga_passwd->SetDbValueDef($rsnew, $tbl_profile->ga_passwd->CurrentValue, "", FALSE);

			// ga_profileid
			$tbl_profile->ga_profileid->SetDbValueDef($rsnew, $tbl_profile->ga_profileid->CurrentValue, "", FALSE);

			// url
			$tbl_profile->url->SetDbValueDef($rsnew, $tbl_profile->url->CurrentValue, "", FALSE);

			// fb_pageid
			$tbl_profile->fb_pageid->SetDbValueDef($rsnew, $tbl_profile->fb_pageid->CurrentValue, "", FALSE);

			// twitter_page
			$tbl_profile->twitter_page->SetDbValueDef($rsnew, $tbl_profile->twitter_page->CurrentValue, "", FALSE);

			// is_wordpress
			$tbl_profile->is_wordpress->SetDbValueDef($rsnew, $tbl_profile->is_wordpress->CurrentValue, "", FALSE);

			// is_blogger
			$tbl_profile->is_blogger->SetDbValueDef($rsnew, $tbl_profile->is_blogger->CurrentValue, "", FALSE);

			// is_active
			$tbl_profile->is_active->SetDbValueDef($rsnew, $tbl_profile->is_active->CurrentValue, "", FALSE);

			// Call Row Updating event
			$bUpdateRow = $tbl_profile->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_profile->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_profile->CancelMessage <> "") {
					$this->setMessage($tbl_profile->CancelMessage);
					$tbl_profile->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_profile->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
