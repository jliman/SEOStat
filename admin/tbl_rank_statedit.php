<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_rank_statinfo.php" ?>
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
$tbl_rank_stat_edit = new ctbl_rank_stat_edit();
$Page =& $tbl_rank_stat_edit;

// Page init
$tbl_rank_stat_edit->Page_Init();

// Page main
$tbl_rank_stat_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_rank_stat_edit = new ew_Page("tbl_rank_stat_edit");

// page properties
tbl_rank_stat_edit.PageID = "edit"; // page ID
tbl_rank_stat_edit.FormID = "ftbl_rank_statedit"; // form ID
var EW_PAGE_ID = tbl_rank_stat_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_rank_stat_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_id_profile"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_rank_stat->id_profile->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_stat_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_rank_stat->stat_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_stat_date"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_rank_stat->stat_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_rank_stat->year->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_rank_stat->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_rank_stat->month->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_rank_stat->month->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_week"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_rank_stat->week->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_week"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_rank_stat->week->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_alexa_rank"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_rank_stat->alexa_rank->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_google_pagerank"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_rank_stat->google_pagerank->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_rank_stat_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_rank_stat_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_rank_stat_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_rank_stat_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_rank_stat_edit.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_rank_stat_edit.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_rank_stat->TableCaption() ?><br><br>
<a href="<?php echo $tbl_rank_stat->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_rank_stat_edit->ShowMessage();
?>
<form name="ftbl_rank_statedit" id="ftbl_rank_statedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_rank_stat_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="tbl_rank_stat">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_rank_stat->id_profile->Visible) { // id_profile ?>
	<tr<?php echo $tbl_rank_stat->id_profile->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_rank_stat->id_profile->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_rank_stat->id_profile->CellAttributes() ?>><span id="el_id_profile">
<div<?php echo $tbl_rank_stat->id_profile->ViewAttributes() ?>><?php echo $tbl_rank_stat->id_profile->EditValue ?></div><input type="hidden" name="x_id_profile" id="x_id_profile" value="<?php echo ew_HtmlEncode($tbl_rank_stat->id_profile->CurrentValue) ?>">
</span><?php echo $tbl_rank_stat->id_profile->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_rank_stat->stat_date->Visible) { // stat_date ?>
	<tr<?php echo $tbl_rank_stat->stat_date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_rank_stat->stat_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_rank_stat->stat_date->CellAttributes() ?>><span id="el_stat_date">
<div<?php echo $tbl_rank_stat->stat_date->ViewAttributes() ?>><?php echo $tbl_rank_stat->stat_date->EditValue ?></div><input type="hidden" name="x_stat_date" id="x_stat_date" value="<?php echo ew_HtmlEncode($tbl_rank_stat->stat_date->CurrentValue) ?>">
</span><?php echo $tbl_rank_stat->stat_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_rank_stat->year->Visible) { // year ?>
	<tr<?php echo $tbl_rank_stat->year->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_rank_stat->year->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_rank_stat->year->CellAttributes() ?>><span id="el_year">
<input type="text" name="x_year" id="x_year" title="<?php echo $tbl_rank_stat->year->FldTitle() ?>" size="30" value="<?php echo $tbl_rank_stat->year->EditValue ?>"<?php echo $tbl_rank_stat->year->EditAttributes() ?>>
</span><?php echo $tbl_rank_stat->year->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_rank_stat->month->Visible) { // month ?>
	<tr<?php echo $tbl_rank_stat->month->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_rank_stat->month->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_rank_stat->month->CellAttributes() ?>><span id="el_month">
<input type="text" name="x_month" id="x_month" title="<?php echo $tbl_rank_stat->month->FldTitle() ?>" size="30" value="<?php echo $tbl_rank_stat->month->EditValue ?>"<?php echo $tbl_rank_stat->month->EditAttributes() ?>>
</span><?php echo $tbl_rank_stat->month->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_rank_stat->week->Visible) { // week ?>
	<tr<?php echo $tbl_rank_stat->week->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_rank_stat->week->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_rank_stat->week->CellAttributes() ?>><span id="el_week">
<input type="text" name="x_week" id="x_week" title="<?php echo $tbl_rank_stat->week->FldTitle() ?>" size="30" value="<?php echo $tbl_rank_stat->week->EditValue ?>"<?php echo $tbl_rank_stat->week->EditAttributes() ?>>
</span><?php echo $tbl_rank_stat->week->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_rank_stat->alexa_rank->Visible) { // alexa_rank ?>
	<tr<?php echo $tbl_rank_stat->alexa_rank->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_rank_stat->alexa_rank->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_rank_stat->alexa_rank->CellAttributes() ?>><span id="el_alexa_rank">
<input type="text" name="x_alexa_rank" id="x_alexa_rank" title="<?php echo $tbl_rank_stat->alexa_rank->FldTitle() ?>" size="30" value="<?php echo $tbl_rank_stat->alexa_rank->EditValue ?>"<?php echo $tbl_rank_stat->alexa_rank->EditAttributes() ?>>
</span><?php echo $tbl_rank_stat->alexa_rank->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_rank_stat->google_pagerank->Visible) { // google_pagerank ?>
	<tr<?php echo $tbl_rank_stat->google_pagerank->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_rank_stat->google_pagerank->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_rank_stat->google_pagerank->CellAttributes() ?>><span id="el_google_pagerank">
<input type="text" name="x_google_pagerank" id="x_google_pagerank" title="<?php echo $tbl_rank_stat->google_pagerank->FldTitle() ?>" size="30" value="<?php echo $tbl_rank_stat->google_pagerank->EditValue ?>"<?php echo $tbl_rank_stat->google_pagerank->EditAttributes() ?>>
</span><?php echo $tbl_rank_stat->google_pagerank->CustomMsg ?></td>
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
$tbl_rank_stat_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_rank_stat_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'tbl_rank_stat';

	// Page object name
	var $PageObjName = 'tbl_rank_stat_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_rank_stat;
		if ($tbl_rank_stat->UseTokenInUrl) $PageUrl .= "t=" . $tbl_rank_stat->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_rank_stat;
		if ($tbl_rank_stat->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_rank_stat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_rank_stat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_rank_stat_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_rank_stat)
		$GLOBALS["tbl_rank_stat"] = new ctbl_rank_stat();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_rank_stat', TRUE);

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
		global $tbl_rank_stat;

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
			$this->Page_Terminate("tbl_rank_statlist.php");
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
		global $objForm, $Language, $gsFormError, $tbl_rank_stat;

		// Load key from QueryString
		if (@$_GET["id_profile"] <> "")
			$tbl_rank_stat->id_profile->setQueryStringValue($_GET["id_profile"]);
		if (@$_GET["stat_date"] <> "")
			$tbl_rank_stat->stat_date->setQueryStringValue($_GET["stat_date"]);
		if (@$_POST["a_edit"] <> "") {
			$tbl_rank_stat->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_rank_stat->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$tbl_rank_stat->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$tbl_rank_stat->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($tbl_rank_stat->id_profile->CurrentValue == "")
			$this->Page_Terminate("tbl_rank_statlist.php"); // Invalid key, return to list
		if ($tbl_rank_stat->stat_date->CurrentValue == "")
			$this->Page_Terminate("tbl_rank_statlist.php"); // Invalid key, return to list
		switch ($tbl_rank_stat->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tbl_rank_statlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$tbl_rank_stat->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $tbl_rank_stat->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tbl_rank_statview.php")
						$sReturnUrl = $tbl_rank_stat->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$tbl_rank_stat->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$tbl_rank_stat->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_rank_stat;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_rank_stat;
		$tbl_rank_stat->id_profile->setFormValue($objForm->GetValue("x_id_profile"));
		$tbl_rank_stat->stat_date->setFormValue($objForm->GetValue("x_stat_date"));
		$tbl_rank_stat->stat_date->CurrentValue = ew_UnFormatDateTime($tbl_rank_stat->stat_date->CurrentValue, 5);
		$tbl_rank_stat->year->setFormValue($objForm->GetValue("x_year"));
		$tbl_rank_stat->month->setFormValue($objForm->GetValue("x_month"));
		$tbl_rank_stat->week->setFormValue($objForm->GetValue("x_week"));
		$tbl_rank_stat->alexa_rank->setFormValue($objForm->GetValue("x_alexa_rank"));
		$tbl_rank_stat->google_pagerank->setFormValue($objForm->GetValue("x_google_pagerank"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_rank_stat;
		$this->LoadRow();
		$tbl_rank_stat->id_profile->CurrentValue = $tbl_rank_stat->id_profile->FormValue;
		$tbl_rank_stat->stat_date->CurrentValue = $tbl_rank_stat->stat_date->FormValue;
		$tbl_rank_stat->stat_date->CurrentValue = ew_UnFormatDateTime($tbl_rank_stat->stat_date->CurrentValue, 5);
		$tbl_rank_stat->year->CurrentValue = $tbl_rank_stat->year->FormValue;
		$tbl_rank_stat->month->CurrentValue = $tbl_rank_stat->month->FormValue;
		$tbl_rank_stat->week->CurrentValue = $tbl_rank_stat->week->FormValue;
		$tbl_rank_stat->alexa_rank->CurrentValue = $tbl_rank_stat->alexa_rank->FormValue;
		$tbl_rank_stat->google_pagerank->CurrentValue = $tbl_rank_stat->google_pagerank->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_rank_stat;
		$sFilter = $tbl_rank_stat->KeyFilter();

		// Call Row Selecting event
		$tbl_rank_stat->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_rank_stat->CurrentFilter = $sFilter;
		$sSql = $tbl_rank_stat->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_rank_stat->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_rank_stat;
		$tbl_rank_stat->id_profile->setDbValue($rs->fields('id_profile'));
		$tbl_rank_stat->stat_date->setDbValue($rs->fields('stat_date'));
		$tbl_rank_stat->year->setDbValue($rs->fields('year'));
		$tbl_rank_stat->month->setDbValue($rs->fields('month'));
		$tbl_rank_stat->week->setDbValue($rs->fields('week'));
		$tbl_rank_stat->alexa_rank->setDbValue($rs->fields('alexa_rank'));
		$tbl_rank_stat->google_pagerank->setDbValue($rs->fields('google_pagerank'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_rank_stat;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_rank_stat->Row_Rendering();

		// Common render codes for all row types
		// id_profile

		$tbl_rank_stat->id_profile->CellCssStyle = ""; $tbl_rank_stat->id_profile->CellCssClass = "";
		$tbl_rank_stat->id_profile->CellAttrs = array(); $tbl_rank_stat->id_profile->ViewAttrs = array(); $tbl_rank_stat->id_profile->EditAttrs = array();

		// stat_date
		$tbl_rank_stat->stat_date->CellCssStyle = ""; $tbl_rank_stat->stat_date->CellCssClass = "";
		$tbl_rank_stat->stat_date->CellAttrs = array(); $tbl_rank_stat->stat_date->ViewAttrs = array(); $tbl_rank_stat->stat_date->EditAttrs = array();

		// year
		$tbl_rank_stat->year->CellCssStyle = ""; $tbl_rank_stat->year->CellCssClass = "";
		$tbl_rank_stat->year->CellAttrs = array(); $tbl_rank_stat->year->ViewAttrs = array(); $tbl_rank_stat->year->EditAttrs = array();

		// month
		$tbl_rank_stat->month->CellCssStyle = ""; $tbl_rank_stat->month->CellCssClass = "";
		$tbl_rank_stat->month->CellAttrs = array(); $tbl_rank_stat->month->ViewAttrs = array(); $tbl_rank_stat->month->EditAttrs = array();

		// week
		$tbl_rank_stat->week->CellCssStyle = ""; $tbl_rank_stat->week->CellCssClass = "";
		$tbl_rank_stat->week->CellAttrs = array(); $tbl_rank_stat->week->ViewAttrs = array(); $tbl_rank_stat->week->EditAttrs = array();

		// alexa_rank
		$tbl_rank_stat->alexa_rank->CellCssStyle = ""; $tbl_rank_stat->alexa_rank->CellCssClass = "";
		$tbl_rank_stat->alexa_rank->CellAttrs = array(); $tbl_rank_stat->alexa_rank->ViewAttrs = array(); $tbl_rank_stat->alexa_rank->EditAttrs = array();

		// google_pagerank
		$tbl_rank_stat->google_pagerank->CellCssStyle = ""; $tbl_rank_stat->google_pagerank->CellCssClass = "";
		$tbl_rank_stat->google_pagerank->CellAttrs = array(); $tbl_rank_stat->google_pagerank->ViewAttrs = array(); $tbl_rank_stat->google_pagerank->EditAttrs = array();
		if ($tbl_rank_stat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_profile
			if (strval($tbl_rank_stat->id_profile->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_rank_stat->id_profile->CurrentValue) . "";
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
					$tbl_rank_stat->id_profile->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_rank_stat->id_profile->ViewValue = $tbl_rank_stat->id_profile->CurrentValue;
				}
			} else {
				$tbl_rank_stat->id_profile->ViewValue = NULL;
			}
			$tbl_rank_stat->id_profile->CssStyle = "";
			$tbl_rank_stat->id_profile->CssClass = "";
			$tbl_rank_stat->id_profile->ViewCustomAttributes = "";

			// stat_date
			$tbl_rank_stat->stat_date->ViewValue = $tbl_rank_stat->stat_date->CurrentValue;
			$tbl_rank_stat->stat_date->ViewValue = ew_FormatDateTime($tbl_rank_stat->stat_date->ViewValue, 5);
			$tbl_rank_stat->stat_date->CssStyle = "";
			$tbl_rank_stat->stat_date->CssClass = "";
			$tbl_rank_stat->stat_date->ViewCustomAttributes = "";

			// year
			$tbl_rank_stat->year->ViewValue = $tbl_rank_stat->year->CurrentValue;
			$tbl_rank_stat->year->CssStyle = "";
			$tbl_rank_stat->year->CssClass = "";
			$tbl_rank_stat->year->ViewCustomAttributes = "";

			// month
			$tbl_rank_stat->month->ViewValue = $tbl_rank_stat->month->CurrentValue;
			$tbl_rank_stat->month->CssStyle = "";
			$tbl_rank_stat->month->CssClass = "";
			$tbl_rank_stat->month->ViewCustomAttributes = "";

			// week
			$tbl_rank_stat->week->ViewValue = $tbl_rank_stat->week->CurrentValue;
			$tbl_rank_stat->week->CssStyle = "";
			$tbl_rank_stat->week->CssClass = "";
			$tbl_rank_stat->week->ViewCustomAttributes = "";

			// alexa_rank
			$tbl_rank_stat->alexa_rank->ViewValue = $tbl_rank_stat->alexa_rank->CurrentValue;
			$tbl_rank_stat->alexa_rank->CssStyle = "";
			$tbl_rank_stat->alexa_rank->CssClass = "";
			$tbl_rank_stat->alexa_rank->ViewCustomAttributes = "";

			// google_pagerank
			$tbl_rank_stat->google_pagerank->ViewValue = $tbl_rank_stat->google_pagerank->CurrentValue;
			$tbl_rank_stat->google_pagerank->CssStyle = "";
			$tbl_rank_stat->google_pagerank->CssClass = "";
			$tbl_rank_stat->google_pagerank->ViewCustomAttributes = "";

			// id_profile
			$tbl_rank_stat->id_profile->HrefValue = "";
			$tbl_rank_stat->id_profile->TooltipValue = "";

			// stat_date
			$tbl_rank_stat->stat_date->HrefValue = "";
			$tbl_rank_stat->stat_date->TooltipValue = "";

			// year
			$tbl_rank_stat->year->HrefValue = "";
			$tbl_rank_stat->year->TooltipValue = "";

			// month
			$tbl_rank_stat->month->HrefValue = "";
			$tbl_rank_stat->month->TooltipValue = "";

			// week
			$tbl_rank_stat->week->HrefValue = "";
			$tbl_rank_stat->week->TooltipValue = "";

			// alexa_rank
			$tbl_rank_stat->alexa_rank->HrefValue = "";
			$tbl_rank_stat->alexa_rank->TooltipValue = "";

			// google_pagerank
			$tbl_rank_stat->google_pagerank->HrefValue = "";
			$tbl_rank_stat->google_pagerank->TooltipValue = "";
		} elseif ($tbl_rank_stat->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_profile
			$tbl_rank_stat->id_profile->EditCustomAttributes = "";
			if (strval($tbl_rank_stat->id_profile->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_rank_stat->id_profile->CurrentValue) . "";
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
					$tbl_rank_stat->id_profile->EditValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_rank_stat->id_profile->EditValue = $tbl_rank_stat->id_profile->CurrentValue;
				}
			} else {
				$tbl_rank_stat->id_profile->EditValue = NULL;
			}
			$tbl_rank_stat->id_profile->CssStyle = "";
			$tbl_rank_stat->id_profile->CssClass = "";
			$tbl_rank_stat->id_profile->ViewCustomAttributes = "";

			// stat_date
			$tbl_rank_stat->stat_date->EditCustomAttributes = "";
			$tbl_rank_stat->stat_date->EditValue = $tbl_rank_stat->stat_date->CurrentValue;
			$tbl_rank_stat->stat_date->EditValue = ew_FormatDateTime($tbl_rank_stat->stat_date->EditValue, 5);
			$tbl_rank_stat->stat_date->CssStyle = "";
			$tbl_rank_stat->stat_date->CssClass = "";
			$tbl_rank_stat->stat_date->ViewCustomAttributes = "";

			// year
			$tbl_rank_stat->year->EditCustomAttributes = "";
			$tbl_rank_stat->year->EditValue = ew_HtmlEncode($tbl_rank_stat->year->CurrentValue);

			// month
			$tbl_rank_stat->month->EditCustomAttributes = "";
			$tbl_rank_stat->month->EditValue = ew_HtmlEncode($tbl_rank_stat->month->CurrentValue);

			// week
			$tbl_rank_stat->week->EditCustomAttributes = "";
			$tbl_rank_stat->week->EditValue = ew_HtmlEncode($tbl_rank_stat->week->CurrentValue);

			// alexa_rank
			$tbl_rank_stat->alexa_rank->EditCustomAttributes = "";
			$tbl_rank_stat->alexa_rank->EditValue = ew_HtmlEncode($tbl_rank_stat->alexa_rank->CurrentValue);

			// google_pagerank
			$tbl_rank_stat->google_pagerank->EditCustomAttributes = "";
			$tbl_rank_stat->google_pagerank->EditValue = ew_HtmlEncode($tbl_rank_stat->google_pagerank->CurrentValue);

			// Edit refer script
			// id_profile

			$tbl_rank_stat->id_profile->HrefValue = "";

			// stat_date
			$tbl_rank_stat->stat_date->HrefValue = "";

			// year
			$tbl_rank_stat->year->HrefValue = "";

			// month
			$tbl_rank_stat->month->HrefValue = "";

			// week
			$tbl_rank_stat->week->HrefValue = "";

			// alexa_rank
			$tbl_rank_stat->alexa_rank->HrefValue = "";

			// google_pagerank
			$tbl_rank_stat->google_pagerank->HrefValue = "";
		}

		// Call Row Rendered event
		if ($tbl_rank_stat->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_rank_stat->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_rank_stat;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_rank_stat->id_profile->FormValue) && $tbl_rank_stat->id_profile->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_rank_stat->id_profile->FldCaption();
		}
		if (!is_null($tbl_rank_stat->stat_date->FormValue) && $tbl_rank_stat->stat_date->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_rank_stat->stat_date->FldCaption();
		}
		if (!ew_CheckDate($tbl_rank_stat->stat_date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_rank_stat->stat_date->FldErrMsg();
		}
		if (!is_null($tbl_rank_stat->year->FormValue) && $tbl_rank_stat->year->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_rank_stat->year->FldCaption();
		}
		if (!ew_CheckInteger($tbl_rank_stat->year->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_rank_stat->year->FldErrMsg();
		}
		if (!is_null($tbl_rank_stat->month->FormValue) && $tbl_rank_stat->month->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_rank_stat->month->FldCaption();
		}
		if (!ew_CheckInteger($tbl_rank_stat->month->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_rank_stat->month->FldErrMsg();
		}
		if (!is_null($tbl_rank_stat->week->FormValue) && $tbl_rank_stat->week->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_rank_stat->week->FldCaption();
		}
		if (!ew_CheckInteger($tbl_rank_stat->week->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_rank_stat->week->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_rank_stat->alexa_rank->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_rank_stat->alexa_rank->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_rank_stat->google_pagerank->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_rank_stat->google_pagerank->FldErrMsg();
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
		global $conn, $Security, $Language, $tbl_rank_stat;
		$sFilter = $tbl_rank_stat->KeyFilter();
		$tbl_rank_stat->CurrentFilter = $sFilter;
		$sSql = $tbl_rank_stat->SQL();
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

			// id_profile
			// stat_date
			// year

			$tbl_rank_stat->year->SetDbValueDef($rsnew, $tbl_rank_stat->year->CurrentValue, 0, FALSE);

			// month
			$tbl_rank_stat->month->SetDbValueDef($rsnew, $tbl_rank_stat->month->CurrentValue, 0, FALSE);

			// week
			$tbl_rank_stat->week->SetDbValueDef($rsnew, $tbl_rank_stat->week->CurrentValue, 0, FALSE);

			// alexa_rank
			$tbl_rank_stat->alexa_rank->SetDbValueDef($rsnew, $tbl_rank_stat->alexa_rank->CurrentValue, 0, FALSE);

			// google_pagerank
			$tbl_rank_stat->google_pagerank->SetDbValueDef($rsnew, $tbl_rank_stat->google_pagerank->CurrentValue, 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $tbl_rank_stat->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_rank_stat->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_rank_stat->CancelMessage <> "") {
					$this->setMessage($tbl_rank_stat->CancelMessage);
					$tbl_rank_stat->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_rank_stat->Row_Updated($rsold, $rsnew);
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
