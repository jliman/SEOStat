<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_user_levelinfo.php" ?>
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
$tbl_user_level_edit = new ctbl_user_level_edit();
$Page =& $tbl_user_level_edit;

// Page init
$tbl_user_level_edit->Page_Init();

// Page main
$tbl_user_level_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_user_level_edit = new ew_Page("tbl_user_level_edit");

// page properties
tbl_user_level_edit.PageID = "edit"; // page ID
tbl_user_level_edit.FormID = "ftbl_user_leveledit"; // form ID
var EW_PAGE_ID = tbl_user_level_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_user_level_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_userlevelid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_user_level->userlevelid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_userlevelid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_user_level->userlevelid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_userlevelname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_user_level->userlevelname->FldCaption()) ?>");
		elmId = fobj.elements["x" + infix + "_userlevelid"];
		elmName = fobj.elements["x" + infix + "_userlevelname"];
		if (elmId && elmName) {
			elmId.value = elmId.value.replace(/^\s+|\s+$/, '');
			elmName.value = elmName.value.replace(/^\s+|\s+$/, '');
			if (elmId && !ew_CheckInteger(elmId.value))
				return ew_OnError(this, elmId, ewLanguage.Phrase("UserLevelIDInteger"));
			var level = parseInt(elmId.value);
			if (level == 0) {
				if (elmName.value.toLowerCase() != "default")
					return ew_OnError(this, elmName, ewLanguage.Phrase("UserLevelDefaultName"));
			} else if (level == -1) { 
				if (elmName.value.toLowerCase() != "administrator")
					return ew_OnError(this, elmName, ewLanguage.Phrase("UserLevelAdministratorName"));
			} else if (level < -1) {
				return ew_OnError(this, elmId, ewLanguage.Phrase("UserLevelIDIncorrect"));
			} else if (level > 0) { 
				if (elmName.value.toLowerCase() == "administrator" || elmName.value.toLowerCase() == "default")
					return ew_OnError(this, elmName, ewLanguage.Phrase("UserLevelNameIncorrect"));
			}
		}

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_user_level_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_user_level_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_user_level_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_user_level_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_user_level->TableCaption() ?><br><br>
<a href="<?php echo $tbl_user_level->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_user_level_edit->ShowMessage();
?>
<form name="ftbl_user_leveledit" id="ftbl_user_leveledit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_user_level_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="tbl_user_level">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_user_level->userlevelid->Visible) { // userlevelid ?>
	<tr<?php echo $tbl_user_level->userlevelid->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_user_level->userlevelid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_user_level->userlevelid->CellAttributes() ?>><span id="el_userlevelid">
<div<?php echo $tbl_user_level->userlevelid->ViewAttributes() ?>><?php echo $tbl_user_level->userlevelid->EditValue ?></div><input type="hidden" name="x_userlevelid" id="x_userlevelid" value="<?php echo ew_HtmlEncode($tbl_user_level->userlevelid->CurrentValue) ?>">
</span><?php echo $tbl_user_level->userlevelid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_user_level->userlevelname->Visible) { // userlevelname ?>
	<tr<?php echo $tbl_user_level->userlevelname->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_user_level->userlevelname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_user_level->userlevelname->CellAttributes() ?>><span id="el_userlevelname">
<input type="text" name="x_userlevelname" id="x_userlevelname" title="<?php echo $tbl_user_level->userlevelname->FldTitle() ?>" size="30" maxlength="80" value="<?php echo $tbl_user_level->userlevelname->EditValue ?>"<?php echo $tbl_user_level->userlevelname->EditAttributes() ?>>
</span><?php echo $tbl_user_level->userlevelname->CustomMsg ?></td>
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
$tbl_user_level_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_user_level_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'tbl_user_level';

	// Page object name
	var $PageObjName = 'tbl_user_level_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_user_level;
		if ($tbl_user_level->UseTokenInUrl) $PageUrl .= "t=" . $tbl_user_level->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_user_level;
		if ($tbl_user_level->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_user_level->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_user_level->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_user_level_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_user_level)
		$GLOBALS["tbl_user_level"] = new ctbl_user_level();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_user_level', TRUE);

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
		global $tbl_user_level;

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
		if (!$Security->CanAdmin()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
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
		global $objForm, $Language, $gsFormError, $tbl_user_level;

		// Load key from QueryString
		if (@$_GET["userlevelid"] <> "")
			$tbl_user_level->userlevelid->setQueryStringValue($_GET["userlevelid"]);
		if (@$_POST["a_edit"] <> "") {
			$tbl_user_level->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_user_level->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$tbl_user_level->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$tbl_user_level->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($tbl_user_level->userlevelid->CurrentValue == "")
			$this->Page_Terminate("tbl_user_levellist.php"); // Invalid key, return to list
		switch ($tbl_user_level->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tbl_user_levellist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$tbl_user_level->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $tbl_user_level->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tbl_user_levelview.php")
						$sReturnUrl = $tbl_user_level->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$tbl_user_level->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$tbl_user_level->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_user_level;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_user_level;
		$tbl_user_level->userlevelid->setFormValue($objForm->GetValue("x_userlevelid"));
		$tbl_user_level->userlevelname->setFormValue($objForm->GetValue("x_userlevelname"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_user_level;
		$this->LoadRow();
		$tbl_user_level->userlevelid->CurrentValue = $tbl_user_level->userlevelid->FormValue;
		$tbl_user_level->userlevelname->CurrentValue = $tbl_user_level->userlevelname->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_user_level;
		$sFilter = $tbl_user_level->KeyFilter();

		// Call Row Selecting event
		$tbl_user_level->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_user_level->CurrentFilter = $sFilter;
		$sSql = $tbl_user_level->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_user_level->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_user_level;
		$tbl_user_level->userlevelid->setDbValue($rs->fields('userlevelid'));
		if (is_null($tbl_user_level->userlevelid->CurrentValue)) {
			$tbl_user_level->userlevelid->CurrentValue = 0;
		} else {
			$tbl_user_level->userlevelid->CurrentValue = intval($tbl_user_level->userlevelid->CurrentValue);
		}
		$tbl_user_level->userlevelname->setDbValue($rs->fields('userlevelname'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_user_level;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_user_level->Row_Rendering();

		// Common render codes for all row types
		// userlevelid

		$tbl_user_level->userlevelid->CellCssStyle = ""; $tbl_user_level->userlevelid->CellCssClass = "";
		$tbl_user_level->userlevelid->CellAttrs = array(); $tbl_user_level->userlevelid->ViewAttrs = array(); $tbl_user_level->userlevelid->EditAttrs = array();

		// userlevelname
		$tbl_user_level->userlevelname->CellCssStyle = ""; $tbl_user_level->userlevelname->CellCssClass = "";
		$tbl_user_level->userlevelname->CellAttrs = array(); $tbl_user_level->userlevelname->ViewAttrs = array(); $tbl_user_level->userlevelname->EditAttrs = array();
		if ($tbl_user_level->RowType == EW_ROWTYPE_VIEW) { // View row

			// userlevelid
			$tbl_user_level->userlevelid->ViewValue = $tbl_user_level->userlevelid->CurrentValue;
			$tbl_user_level->userlevelid->CssStyle = "";
			$tbl_user_level->userlevelid->CssClass = "";
			$tbl_user_level->userlevelid->ViewCustomAttributes = "";

			// userlevelname
			$tbl_user_level->userlevelname->ViewValue = $tbl_user_level->userlevelname->CurrentValue;
			$tbl_user_level->userlevelname->CssStyle = "";
			$tbl_user_level->userlevelname->CssClass = "";
			$tbl_user_level->userlevelname->ViewCustomAttributes = "";

			// userlevelid
			$tbl_user_level->userlevelid->HrefValue = "";
			$tbl_user_level->userlevelid->TooltipValue = "";

			// userlevelname
			$tbl_user_level->userlevelname->HrefValue = "";
			$tbl_user_level->userlevelname->TooltipValue = "";
		} elseif ($tbl_user_level->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// userlevelid
			$tbl_user_level->userlevelid->EditCustomAttributes = "";
			$tbl_user_level->userlevelid->EditValue = $tbl_user_level->userlevelid->CurrentValue;
			$tbl_user_level->userlevelid->CssStyle = "";
			$tbl_user_level->userlevelid->CssClass = "";
			$tbl_user_level->userlevelid->ViewCustomAttributes = "";

			// userlevelname
			$tbl_user_level->userlevelname->EditCustomAttributes = "";
			$tbl_user_level->userlevelname->EditValue = ew_HtmlEncode($tbl_user_level->userlevelname->CurrentValue);

			// Edit refer script
			// userlevelid

			$tbl_user_level->userlevelid->HrefValue = "";

			// userlevelname
			$tbl_user_level->userlevelname->HrefValue = "";
		}

		// Call Row Rendered event
		if ($tbl_user_level->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_user_level->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_user_level;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_user_level->userlevelid->FormValue) && $tbl_user_level->userlevelid->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_user_level->userlevelid->FldCaption();
		}
		if (!ew_CheckInteger($tbl_user_level->userlevelid->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_user_level->userlevelid->FldErrMsg();
		}
		if (!is_null($tbl_user_level->userlevelname->FormValue) && $tbl_user_level->userlevelname->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_user_level->userlevelname->FldCaption();
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
		global $conn, $Security, $Language, $tbl_user_level;
		$sFilter = $tbl_user_level->KeyFilter();
		$tbl_user_level->CurrentFilter = $sFilter;
		$sSql = $tbl_user_level->SQL();
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

			// userlevelid
			// userlevelname

			$tbl_user_level->userlevelname->SetDbValueDef($rsnew, $tbl_user_level->userlevelname->CurrentValue, "", FALSE);

			// Call Row Updating event
			$bUpdateRow = $tbl_user_level->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_user_level->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_user_level->CancelMessage <> "") {
					$this->setMessage($tbl_user_level->CancelMessage);
					$tbl_user_level->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_user_level->Row_Updated($rsold, $rsnew);
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
