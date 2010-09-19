<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_groupinfo.php" ?>
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
$tbl_group_edit = new ctbl_group_edit();
$Page =& $tbl_group_edit;

// Page init
$tbl_group_edit->Page_Init();

// Page main
$tbl_group_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_group_edit = new ew_Page("tbl_group_edit");

// page properties
tbl_group_edit.PageID = "edit"; // page ID
tbl_group_edit.FormID = "ftbl_groupedit"; // form ID
var EW_PAGE_ID = tbl_group_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_group_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_group->name->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_group_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_group_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_group_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_group_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_group_edit.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_group_edit.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_group->TableCaption() ?><br><br>
<a href="<?php echo $tbl_group->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_group_edit->ShowMessage();
?>
<form name="ftbl_groupedit" id="ftbl_groupedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_group_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="tbl_group">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_group->id->Visible) { // id ?>
	<tr<?php echo $tbl_group->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_group->id->FldCaption() ?></td>
		<td<?php echo $tbl_group->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $tbl_group->id->ViewAttributes() ?>><?php echo $tbl_group->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($tbl_group->id->CurrentValue) ?>">
</span><?php echo $tbl_group->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_group->name->Visible) { // name ?>
	<tr<?php echo $tbl_group->name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_group->name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_group->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" title="<?php echo $tbl_group->name->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_group->name->EditValue ?>"<?php echo $tbl_group->name->EditAttributes() ?>>
</span><?php echo $tbl_group->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_group->is_active->Visible) { // is_active ?>
	<tr<?php echo $tbl_group->is_active->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_group->is_active->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_group->is_active->CellAttributes() ?>><span id="el_is_active">
<div id="tp_x_is_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_is_active" id="x_is_active" title="<?php echo $tbl_group->is_active->FldTitle() ?>" value="{value}"<?php echo $tbl_group->is_active->EditAttributes() ?>></label></div>
<div id="dsl_x_is_active" repeatcolumn="5">
<?php
$arwrk = $tbl_group->is_active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_group->is_active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_is_active" id="x_is_active" title="<?php echo $tbl_group->is_active->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_group->is_active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span><?php echo $tbl_group->is_active->CustomMsg ?></td>
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
$tbl_group_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_group_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'tbl_group';

	// Page object name
	var $PageObjName = 'tbl_group_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_group;
		if ($tbl_group->UseTokenInUrl) $PageUrl .= "t=" . $tbl_group->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_group;
		if ($tbl_group->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_group->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_group->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_group_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_group)
		$GLOBALS["tbl_group"] = new ctbl_group();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_group', TRUE);

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
		global $tbl_group;

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
			$this->Page_Terminate("tbl_grouplist.php");
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
		global $objForm, $Language, $gsFormError, $tbl_group;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$tbl_group->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$tbl_group->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_group->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$tbl_group->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$tbl_group->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($tbl_group->id->CurrentValue == "")
			$this->Page_Terminate("tbl_grouplist.php"); // Invalid key, return to list
		switch ($tbl_group->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tbl_grouplist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$tbl_group->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $tbl_group->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tbl_groupview.php")
						$sReturnUrl = $tbl_group->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$tbl_group->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$tbl_group->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_group;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_group;
		$tbl_group->id->setFormValue($objForm->GetValue("x_id"));
		$tbl_group->name->setFormValue($objForm->GetValue("x_name"));
		$tbl_group->is_active->setFormValue($objForm->GetValue("x_is_active"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_group;
		$this->LoadRow();
		$tbl_group->id->CurrentValue = $tbl_group->id->FormValue;
		$tbl_group->name->CurrentValue = $tbl_group->name->FormValue;
		$tbl_group->is_active->CurrentValue = $tbl_group->is_active->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_group;
		$sFilter = $tbl_group->KeyFilter();

		// Call Row Selecting event
		$tbl_group->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_group->CurrentFilter = $sFilter;
		$sSql = $tbl_group->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_group->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_group;
		$tbl_group->id->setDbValue($rs->fields('id'));
		$tbl_group->name->setDbValue($rs->fields('name'));
		$tbl_group->is_active->setDbValue($rs->fields('is_active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_group;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_group->Row_Rendering();

		// Common render codes for all row types
		// id

		$tbl_group->id->CellCssStyle = ""; $tbl_group->id->CellCssClass = "";
		$tbl_group->id->CellAttrs = array(); $tbl_group->id->ViewAttrs = array(); $tbl_group->id->EditAttrs = array();

		// name
		$tbl_group->name->CellCssStyle = ""; $tbl_group->name->CellCssClass = "";
		$tbl_group->name->CellAttrs = array(); $tbl_group->name->ViewAttrs = array(); $tbl_group->name->EditAttrs = array();

		// is_active
		$tbl_group->is_active->CellCssStyle = ""; $tbl_group->is_active->CellCssClass = "";
		$tbl_group->is_active->CellAttrs = array(); $tbl_group->is_active->ViewAttrs = array(); $tbl_group->is_active->EditAttrs = array();
		if ($tbl_group->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$tbl_group->id->ViewValue = $tbl_group->id->CurrentValue;
			$tbl_group->id->CssStyle = "";
			$tbl_group->id->CssClass = "";
			$tbl_group->id->ViewCustomAttributes = "";

			// name
			$tbl_group->name->ViewValue = $tbl_group->name->CurrentValue;
			$tbl_group->name->CssStyle = "";
			$tbl_group->name->CssClass = "";
			$tbl_group->name->ViewCustomAttributes = "";

			// is_active
			if (ew_ConvertToBool($tbl_group->is_active->CurrentValue)) {
				$tbl_group->is_active->ViewValue = "Yes";
			} else {
				$tbl_group->is_active->ViewValue = "No";
			}
			$tbl_group->is_active->CssStyle = "";
			$tbl_group->is_active->CssClass = "";
			$tbl_group->is_active->ViewCustomAttributes = "";

			// id
			$tbl_group->id->HrefValue = "";
			$tbl_group->id->TooltipValue = "";

			// name
			$tbl_group->name->HrefValue = "";
			$tbl_group->name->TooltipValue = "";

			// is_active
			$tbl_group->is_active->HrefValue = "";
			$tbl_group->is_active->TooltipValue = "";
		} elseif ($tbl_group->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$tbl_group->id->EditCustomAttributes = "";
			$tbl_group->id->EditValue = $tbl_group->id->CurrentValue;
			$tbl_group->id->CssStyle = "";
			$tbl_group->id->CssClass = "";
			$tbl_group->id->ViewCustomAttributes = "";

			// name
			$tbl_group->name->EditCustomAttributes = "";
			$tbl_group->name->EditValue = ew_HtmlEncode($tbl_group->name->CurrentValue);

			// is_active
			$tbl_group->is_active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Yes");
			$arwrk[] = array("0", "No");
			$tbl_group->is_active->EditValue = $arwrk;

			// Edit refer script
			// id

			$tbl_group->id->HrefValue = "";

			// name
			$tbl_group->name->HrefValue = "";

			// is_active
			$tbl_group->is_active->HrefValue = "";
		}

		// Call Row Rendered event
		if ($tbl_group->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_group->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_group;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_group->name->FormValue) && $tbl_group->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_group->name->FldCaption();
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
		global $conn, $Security, $Language, $tbl_group;
		$sFilter = $tbl_group->KeyFilter();
		$tbl_group->CurrentFilter = $sFilter;
		$sSql = $tbl_group->SQL();
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
			$tbl_group->name->SetDbValueDef($rsnew, $tbl_group->name->CurrentValue, "", FALSE);

			// is_active
			$tbl_group->is_active->SetDbValueDef($rsnew, ((strval($tbl_group->is_active->CurrentValue) == "1") ? "1" : "0"), 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $tbl_group->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_group->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_group->CancelMessage <> "") {
					$this->setMessage($tbl_group->CancelMessage);
					$tbl_group->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_group->Row_Updated($rsold, $rsnew);
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
