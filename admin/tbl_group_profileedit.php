<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_group_profileinfo.php" ?>
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
$tbl_group_profile_edit = new ctbl_group_profile_edit();
$Page =& $tbl_group_profile_edit;

// Page init
$tbl_group_profile_edit->Page_Init();

// Page main
$tbl_group_profile_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_group_profile_edit = new ew_Page("tbl_group_profile_edit");

// page properties
tbl_group_profile_edit.PageID = "edit"; // page ID
tbl_group_profile_edit.FormID = "ftbl_group_profileedit"; // form ID
var EW_PAGE_ID = tbl_group_profile_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_group_profile_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_id_group"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_group_profile->id_group->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_profile"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_group_profile->id_profile->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_group_profile_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_group_profile_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_group_profile_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_group_profile_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_group_profile_edit.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_group_profile_edit.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_group_profile->TableCaption() ?><br><br>
<a href="<?php echo $tbl_group_profile->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_group_profile_edit->ShowMessage();
?>
<form name="ftbl_group_profileedit" id="ftbl_group_profileedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_group_profile_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="tbl_group_profile">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_group_profile->id_group->Visible) { // id_group ?>
	<tr<?php echo $tbl_group_profile->id_group->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_group_profile->id_group->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_group_profile->id_group->CellAttributes() ?>><span id="el_id_group">
<div<?php echo $tbl_group_profile->id_group->ViewAttributes() ?>><?php echo $tbl_group_profile->id_group->EditValue ?></div><input type="hidden" name="x_id_group" id="x_id_group" value="<?php echo ew_HtmlEncode($tbl_group_profile->id_group->CurrentValue) ?>">
</span><?php echo $tbl_group_profile->id_group->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_group_profile->id_profile->Visible) { // id_profile ?>
	<tr<?php echo $tbl_group_profile->id_profile->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_group_profile->id_profile->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_group_profile->id_profile->CellAttributes() ?>><span id="el_id_profile">
<div<?php echo $tbl_group_profile->id_profile->ViewAttributes() ?>><?php echo $tbl_group_profile->id_profile->EditValue ?></div><input type="hidden" name="x_id_profile" id="x_id_profile" value="<?php echo ew_HtmlEncode($tbl_group_profile->id_profile->CurrentValue) ?>">
</span><?php echo $tbl_group_profile->id_profile->CustomMsg ?></td>
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
$tbl_group_profile_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_group_profile_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'tbl_group_profile';

	// Page object name
	var $PageObjName = 'tbl_group_profile_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_group_profile;
		if ($tbl_group_profile->UseTokenInUrl) $PageUrl .= "t=" . $tbl_group_profile->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_group_profile;
		if ($tbl_group_profile->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_group_profile->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_group_profile->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_group_profile_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_group_profile)
		$GLOBALS["tbl_group_profile"] = new ctbl_group_profile();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_group_profile', TRUE);

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
		global $tbl_group_profile;

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
			$this->Page_Terminate("tbl_group_profilelist.php");
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
		global $objForm, $Language, $gsFormError, $tbl_group_profile;

		// Load key from QueryString
		if (@$_GET["id_group"] <> "")
			$tbl_group_profile->id_group->setQueryStringValue($_GET["id_group"]);
		if (@$_GET["id_profile"] <> "")
			$tbl_group_profile->id_profile->setQueryStringValue($_GET["id_profile"]);
		if (@$_POST["a_edit"] <> "") {
			$tbl_group_profile->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_group_profile->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$tbl_group_profile->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$tbl_group_profile->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($tbl_group_profile->id_group->CurrentValue == "")
			$this->Page_Terminate("tbl_group_profilelist.php"); // Invalid key, return to list
		if ($tbl_group_profile->id_profile->CurrentValue == "")
			$this->Page_Terminate("tbl_group_profilelist.php"); // Invalid key, return to list
		switch ($tbl_group_profile->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tbl_group_profilelist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$tbl_group_profile->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $tbl_group_profile->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tbl_group_profileview.php")
						$sReturnUrl = $tbl_group_profile->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$tbl_group_profile->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$tbl_group_profile->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_group_profile;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_group_profile;
		$tbl_group_profile->id_group->setFormValue($objForm->GetValue("x_id_group"));
		$tbl_group_profile->id_profile->setFormValue($objForm->GetValue("x_id_profile"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_group_profile;
		$this->LoadRow();
		$tbl_group_profile->id_group->CurrentValue = $tbl_group_profile->id_group->FormValue;
		$tbl_group_profile->id_profile->CurrentValue = $tbl_group_profile->id_profile->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_group_profile;
		$sFilter = $tbl_group_profile->KeyFilter();

		// Call Row Selecting event
		$tbl_group_profile->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_group_profile->CurrentFilter = $sFilter;
		$sSql = $tbl_group_profile->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_group_profile->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_group_profile;
		$tbl_group_profile->id_group->setDbValue($rs->fields('id_group'));
		$tbl_group_profile->id_profile->setDbValue($rs->fields('id_profile'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_group_profile;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_group_profile->Row_Rendering();

		// Common render codes for all row types
		// id_group

		$tbl_group_profile->id_group->CellCssStyle = ""; $tbl_group_profile->id_group->CellCssClass = "";
		$tbl_group_profile->id_group->CellAttrs = array(); $tbl_group_profile->id_group->ViewAttrs = array(); $tbl_group_profile->id_group->EditAttrs = array();

		// id_profile
		$tbl_group_profile->id_profile->CellCssStyle = ""; $tbl_group_profile->id_profile->CellCssClass = "";
		$tbl_group_profile->id_profile->CellAttrs = array(); $tbl_group_profile->id_profile->ViewAttrs = array(); $tbl_group_profile->id_profile->EditAttrs = array();
		if ($tbl_group_profile->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_group
			if (strval($tbl_group_profile->id_group->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_group_profile->id_group->CurrentValue) . "";
			$sSqlWrk = "SELECT DISTINCT `name` FROM `tbl_group`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "is_active = '1'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$tbl_group_profile->id_group->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_group_profile->id_group->ViewValue = $tbl_group_profile->id_group->CurrentValue;
				}
			} else {
				$tbl_group_profile->id_group->ViewValue = NULL;
			}
			$tbl_group_profile->id_group->CssStyle = "";
			$tbl_group_profile->id_group->CssClass = "";
			$tbl_group_profile->id_group->ViewCustomAttributes = "";

			// id_profile
			if (strval($tbl_group_profile->id_profile->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_group_profile->id_profile->CurrentValue) . "";
			$sSqlWrk = "SELECT DISTINCT `name` FROM `tbl_profile`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "is_active = '1'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$tbl_group_profile->id_profile->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_group_profile->id_profile->ViewValue = $tbl_group_profile->id_profile->CurrentValue;
				}
			} else {
				$tbl_group_profile->id_profile->ViewValue = NULL;
			}
			$tbl_group_profile->id_profile->CssStyle = "";
			$tbl_group_profile->id_profile->CssClass = "";
			$tbl_group_profile->id_profile->ViewCustomAttributes = "";

			// id_group
			$tbl_group_profile->id_group->HrefValue = "";
			$tbl_group_profile->id_group->TooltipValue = "";

			// id_profile
			$tbl_group_profile->id_profile->HrefValue = "";
			$tbl_group_profile->id_profile->TooltipValue = "";
		} elseif ($tbl_group_profile->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_group
			$tbl_group_profile->id_group->EditCustomAttributes = "";
			if (strval($tbl_group_profile->id_group->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_group_profile->id_group->CurrentValue) . "";
			$sSqlWrk = "SELECT DISTINCT `name` FROM `tbl_group`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "is_active = '1'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$tbl_group_profile->id_group->EditValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_group_profile->id_group->EditValue = $tbl_group_profile->id_group->CurrentValue;
				}
			} else {
				$tbl_group_profile->id_group->EditValue = NULL;
			}
			$tbl_group_profile->id_group->CssStyle = "";
			$tbl_group_profile->id_group->CssClass = "";
			$tbl_group_profile->id_group->ViewCustomAttributes = "";

			// id_profile
			$tbl_group_profile->id_profile->EditCustomAttributes = "";
			if (strval($tbl_group_profile->id_profile->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_group_profile->id_profile->CurrentValue) . "";
			$sSqlWrk = "SELECT DISTINCT `name` FROM `tbl_profile`";
			$sWhereWrk = "";
			if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
			$sWhereWrk .= "(" . "is_active = '1'" . ")";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$tbl_group_profile->id_profile->EditValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_group_profile->id_profile->EditValue = $tbl_group_profile->id_profile->CurrentValue;
				}
			} else {
				$tbl_group_profile->id_profile->EditValue = NULL;
			}
			$tbl_group_profile->id_profile->CssStyle = "";
			$tbl_group_profile->id_profile->CssClass = "";
			$tbl_group_profile->id_profile->ViewCustomAttributes = "";

			// Edit refer script
			// id_group

			$tbl_group_profile->id_group->HrefValue = "";

			// id_profile
			$tbl_group_profile->id_profile->HrefValue = "";
		}

		// Call Row Rendered event
		if ($tbl_group_profile->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_group_profile->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_group_profile;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_group_profile->id_group->FormValue) && $tbl_group_profile->id_group->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_group_profile->id_group->FldCaption();
		}
		if (!is_null($tbl_group_profile->id_profile->FormValue) && $tbl_group_profile->id_profile->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_group_profile->id_profile->FldCaption();
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
		global $conn, $Security, $Language, $tbl_group_profile;
		$sFilter = $tbl_group_profile->KeyFilter();
		$tbl_group_profile->CurrentFilter = $sFilter;
		$sSql = $tbl_group_profile->SQL();
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

			// id_group
			// id_profile
			// Call Row Updating event

			$bUpdateRow = $tbl_group_profile->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_group_profile->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_group_profile->CancelMessage <> "") {
					$this->setMessage($tbl_group_profile->CancelMessage);
					$tbl_group_profile->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_group_profile->Row_Updated($rsold, $rsnew);
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
