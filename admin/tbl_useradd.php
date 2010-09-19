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
$tbl_user_add = new ctbl_user_add();
$Page =& $tbl_user_add;

// Page init
$tbl_user_add->Page_Init();

// Page main
$tbl_user_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_user_add = new ew_Page("tbl_user_add");

// page properties
tbl_user_add.PageID = "add"; // page ID
tbl_user_add.FormID = "ftbl_useradd"; // form ID
var EW_PAGE_ID = tbl_user_add.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_user_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_username"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_user->username->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_username"];
		if (elm && !ew_CheckEmail(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_user->username->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_passwd"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_user->passwd->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_userlevel"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_user->id_userlevel->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_user_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_user_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_user_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_user_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_user_add.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_user_add.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_user->TableCaption() ?><br><br>
<a href="<?php echo $tbl_user->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_user_add->ShowMessage();
?>
<form name="ftbl_useradd" id="ftbl_useradd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_user_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="tbl_user">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_user->username->Visible) { // username ?>
	<tr<?php echo $tbl_user->username->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_user->username->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_user->username->CellAttributes() ?>><span id="el_username">
<input type="text" name="x_username" id="x_username" title="<?php echo $tbl_user->username->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $tbl_user->username->EditValue ?>"<?php echo $tbl_user->username->EditAttributes() ?>>
</span><?php echo $tbl_user->username->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_user->passwd->Visible) { // passwd ?>
	<tr<?php echo $tbl_user->passwd->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_user->passwd->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_user->passwd->CellAttributes() ?>><span id="el_passwd">
<input type="text" name="x_passwd" id="x_passwd" title="<?php echo $tbl_user->passwd->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_user->passwd->EditValue ?>"<?php echo $tbl_user->passwd->EditAttributes() ?>>
</span><?php echo $tbl_user->passwd->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_user->id_userlevel->Visible) { // id_userlevel ?>
	<tr<?php echo $tbl_user->id_userlevel->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_user->id_userlevel->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_user->id_userlevel->CellAttributes() ?>><span id="el_id_userlevel">
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<div<?php echo $tbl_user->id_userlevel->ViewAttributes() ?>><?php echo $tbl_user->id_userlevel->EditValue ?></div>
<?php } else { ?>
<select id="x_id_userlevel" name="x_id_userlevel" title="<?php echo $tbl_user->id_userlevel->FldTitle() ?>"<?php echo $tbl_user->id_userlevel->EditAttributes() ?>>
<?php
if (is_array($tbl_user->id_userlevel->EditValue)) {
	$arwrk = $tbl_user->id_userlevel->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_user->id_userlevel->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;
?>
<option value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?>>
<?php echo $arwrk[$rowcntwrk][1] ?>
</option>
<?php
	}
}
?>
</select>
<?php } ?>
</span><?php echo $tbl_user->id_userlevel->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$tbl_user_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_user_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'tbl_user';

	// Page object name
	var $PageObjName = 'tbl_user_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_user;
		if ($tbl_user->UseTokenInUrl) $PageUrl .= "t=" . $tbl_user->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_user;
		if ($tbl_user->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_user->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_user->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_user_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_user)
		$GLOBALS["tbl_user"] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_user', TRUE);

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("tbl_userlist.php");
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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $tbl_user;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id_user"] != "") {
		  $tbl_user->id_user->setQueryStringValue($_GET["id_user"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $tbl_user->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_user->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $tbl_user->CurrentAction = "C"; // Copy record
		  } else {
		    $tbl_user->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($tbl_user->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("tbl_userlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$tbl_user->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $tbl_user->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tbl_userview.php")
						$sReturnUrl = $tbl_user->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$tbl_user->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_user;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $tbl_user;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_user;
		$tbl_user->username->setFormValue($objForm->GetValue("x_username"));
		$tbl_user->passwd->setFormValue($objForm->GetValue("x_passwd"));
		$tbl_user->id_userlevel->setFormValue($objForm->GetValue("x_id_userlevel"));
		$tbl_user->id_user->setFormValue($objForm->GetValue("x_id_user"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_user;
		$tbl_user->id_user->CurrentValue = $tbl_user->id_user->FormValue;
		$tbl_user->username->CurrentValue = $tbl_user->username->FormValue;
		$tbl_user->passwd->CurrentValue = $tbl_user->passwd->FormValue;
		$tbl_user->id_userlevel->CurrentValue = $tbl_user->id_userlevel->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_user;
		$sFilter = $tbl_user->KeyFilter();

		// Call Row Selecting event
		$tbl_user->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_user->CurrentFilter = $sFilter;
		$sSql = $tbl_user->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_user->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_user;
		$tbl_user->id_user->setDbValue($rs->fields('id_user'));
		$tbl_user->username->setDbValue($rs->fields('username'));
		$tbl_user->passwd->setDbValue($rs->fields('passwd'));
		$tbl_user->id_userlevel->setDbValue($rs->fields('id_userlevel'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_user;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_user->Row_Rendering();

		// Common render codes for all row types
		// username

		$tbl_user->username->CellCssStyle = ""; $tbl_user->username->CellCssClass = "";
		$tbl_user->username->CellAttrs = array(); $tbl_user->username->ViewAttrs = array(); $tbl_user->username->EditAttrs = array();

		// passwd
		$tbl_user->passwd->CellCssStyle = ""; $tbl_user->passwd->CellCssClass = "";
		$tbl_user->passwd->CellAttrs = array(); $tbl_user->passwd->ViewAttrs = array(); $tbl_user->passwd->EditAttrs = array();

		// id_userlevel
		$tbl_user->id_userlevel->CellCssStyle = ""; $tbl_user->id_userlevel->CellCssClass = "";
		$tbl_user->id_userlevel->CellAttrs = array(); $tbl_user->id_userlevel->ViewAttrs = array(); $tbl_user->id_userlevel->EditAttrs = array();
		if ($tbl_user->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_user
			$tbl_user->id_user->ViewValue = $tbl_user->id_user->CurrentValue;
			$tbl_user->id_user->CssStyle = "";
			$tbl_user->id_user->CssClass = "";
			$tbl_user->id_user->ViewCustomAttributes = "";

			// username
			$tbl_user->username->ViewValue = $tbl_user->username->CurrentValue;
			$tbl_user->username->CssStyle = "";
			$tbl_user->username->CssClass = "";
			$tbl_user->username->ViewCustomAttributes = "";

			// passwd
			$tbl_user->passwd->ViewValue = $tbl_user->passwd->CurrentValue;
			$tbl_user->passwd->CssStyle = "";
			$tbl_user->passwd->CssClass = "";
			$tbl_user->passwd->ViewCustomAttributes = "";

			// id_userlevel
			if ($Security->CanAdmin()) { // System admin
			if (strval($tbl_user->id_userlevel->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid` = " . ew_AdjustSql($tbl_user->id_userlevel->CurrentValue) . "";
			$sSqlWrk = "SELECT `userlevelname` FROM `tbl_user_level`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$tbl_user->id_userlevel->ViewValue = $rswrk->fields('userlevelname');
					$rswrk->Close();
				} else {
					$tbl_user->id_userlevel->ViewValue = $tbl_user->id_userlevel->CurrentValue;
				}
			} else {
				$tbl_user->id_userlevel->ViewValue = NULL;
			}
			} else {
				$tbl_user->id_userlevel->ViewValue = "********";
			}
			$tbl_user->id_userlevel->CssStyle = "";
			$tbl_user->id_userlevel->CssClass = "";
			$tbl_user->id_userlevel->ViewCustomAttributes = "";

			// username
			$tbl_user->username->HrefValue = "";
			$tbl_user->username->TooltipValue = "";

			// passwd
			$tbl_user->passwd->HrefValue = "";
			$tbl_user->passwd->TooltipValue = "";

			// id_userlevel
			$tbl_user->id_userlevel->HrefValue = "";
			$tbl_user->id_userlevel->TooltipValue = "";
		} elseif ($tbl_user->RowType == EW_ROWTYPE_ADD) { // Add row

			// username
			$tbl_user->username->EditCustomAttributes = "";
			$tbl_user->username->EditValue = ew_HtmlEncode($tbl_user->username->CurrentValue);

			// passwd
			$tbl_user->passwd->EditCustomAttributes = "";
			$tbl_user->passwd->EditValue = ew_HtmlEncode($tbl_user->passwd->CurrentValue);

			// id_userlevel
			$tbl_user->id_userlevel->EditCustomAttributes = "";
			if (!$Security->CanAdmin()) { // System admin
				$tbl_user->id_userlevel->EditValue = "********";
			} else {
				$sFilterWrk = "";
			$sSqlWrk = "SELECT `userlevelid`, `userlevelname`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `tbl_user_level`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = $conn->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$tbl_user->id_userlevel->EditValue = $arwrk;
			}
		}

		// Call Row Rendered event
		if ($tbl_user->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_user->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_user;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_user->username->FormValue) && $tbl_user->username->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_user->username->FldCaption();
		}
		if (!ew_CheckEmail($tbl_user->username->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_user->username->FldErrMsg();
		}
		if (!is_null($tbl_user->passwd->FormValue) && $tbl_user->passwd->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_user->passwd->FldCaption();
		}
		if (!is_null($tbl_user->id_userlevel->FormValue) && $tbl_user->id_userlevel->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_user->id_userlevel->FldCaption();
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

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $tbl_user;
		$rsnew = array();

		// username
		$tbl_user->username->SetDbValueDef($rsnew, $tbl_user->username->CurrentValue, "", FALSE);

		// passwd
		$tbl_user->passwd->SetDbValueDef($rsnew, $tbl_user->passwd->CurrentValue, "", FALSE);

		// id_userlevel
				if ($Security->CanAdmin()) { // System admin
		$tbl_user->id_userlevel->SetDbValueDef($rsnew, $tbl_user->id_userlevel->CurrentValue, 0, FALSE);
		}

		// Call Row Inserting event
		$bInsertRow = $tbl_user->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tbl_user->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tbl_user->CancelMessage <> "") {
				$this->setMessage($tbl_user->CancelMessage);
				$tbl_user->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$tbl_user->id_user->setDbValue($conn->Insert_ID());
			$rsnew['id_user'] = $tbl_user->id_user->DbValue;

			// Call Row Inserted event
			$tbl_user->Row_Inserted($rsnew);
		}
		return $AddRow;
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
