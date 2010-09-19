<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_twitter_statinfo.php" ?>
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
$tbl_twitter_stat_add = new ctbl_twitter_stat_add();
$Page =& $tbl_twitter_stat_add;

// Page init
$tbl_twitter_stat_add->Page_Init();

// Page main
$tbl_twitter_stat_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_twitter_stat_add = new ew_Page("tbl_twitter_stat_add");

// page properties
tbl_twitter_stat_add.PageID = "add"; // page ID
tbl_twitter_stat_add.FormID = "ftbl_twitter_statadd"; // form ID
var EW_PAGE_ID = tbl_twitter_stat_add.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_twitter_stat_add.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_twitter_stat->id_profile->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_stat_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_twitter_stat->stat_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_stat_date"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_twitter_stat->stat_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_twitter_stat->year->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_twitter_stat->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_twitter_stat->month->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_twitter_stat->month->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_week"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_twitter_stat->week->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_week"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_twitter_stat->week->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_following"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_twitter_stat->following->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_followers"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_twitter_stat->followers->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_listed"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_twitter_stat->listed->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_tweets"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_twitter_stat->tweets->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_twitter_stat_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_twitter_stat_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_twitter_stat_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_twitter_stat_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_twitter_stat_add.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_twitter_stat_add.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_twitter_stat->TableCaption() ?><br><br>
<a href="<?php echo $tbl_twitter_stat->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_twitter_stat_add->ShowMessage();
?>
<form name="ftbl_twitter_statadd" id="ftbl_twitter_statadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_twitter_stat_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="tbl_twitter_stat">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_twitter_stat->id_profile->Visible) { // id_profile ?>
	<tr<?php echo $tbl_twitter_stat->id_profile->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->id_profile->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_twitter_stat->id_profile->CellAttributes() ?>><span id="el_id_profile">
<select id="x_id_profile" name="x_id_profile" title="<?php echo $tbl_twitter_stat->id_profile->FldTitle() ?>"<?php echo $tbl_twitter_stat->id_profile->EditAttributes() ?>>
<?php
if (is_array($tbl_twitter_stat->id_profile->EditValue)) {
	$arwrk = $tbl_twitter_stat->id_profile->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_twitter_stat->id_profile->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $tbl_twitter_stat->id_profile->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_twitter_stat->stat_date->Visible) { // stat_date ?>
	<tr<?php echo $tbl_twitter_stat->stat_date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->stat_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_twitter_stat->stat_date->CellAttributes() ?>><span id="el_stat_date">
<input type="text" name="x_stat_date" id="x_stat_date" title="<?php echo $tbl_twitter_stat->stat_date->FldTitle() ?>" value="<?php echo $tbl_twitter_stat->stat_date->EditValue ?>"<?php echo $tbl_twitter_stat->stat_date->EditAttributes() ?>>
</span><?php echo $tbl_twitter_stat->stat_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_twitter_stat->year->Visible) { // year ?>
	<tr<?php echo $tbl_twitter_stat->year->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->year->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_twitter_stat->year->CellAttributes() ?>><span id="el_year">
<input type="text" name="x_year" id="x_year" title="<?php echo $tbl_twitter_stat->year->FldTitle() ?>" size="30" value="<?php echo $tbl_twitter_stat->year->EditValue ?>"<?php echo $tbl_twitter_stat->year->EditAttributes() ?>>
</span><?php echo $tbl_twitter_stat->year->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_twitter_stat->month->Visible) { // month ?>
	<tr<?php echo $tbl_twitter_stat->month->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->month->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_twitter_stat->month->CellAttributes() ?>><span id="el_month">
<input type="text" name="x_month" id="x_month" title="<?php echo $tbl_twitter_stat->month->FldTitle() ?>" size="30" value="<?php echo $tbl_twitter_stat->month->EditValue ?>"<?php echo $tbl_twitter_stat->month->EditAttributes() ?>>
</span><?php echo $tbl_twitter_stat->month->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_twitter_stat->week->Visible) { // week ?>
	<tr<?php echo $tbl_twitter_stat->week->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->week->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_twitter_stat->week->CellAttributes() ?>><span id="el_week">
<input type="text" name="x_week" id="x_week" title="<?php echo $tbl_twitter_stat->week->FldTitle() ?>" size="30" value="<?php echo $tbl_twitter_stat->week->EditValue ?>"<?php echo $tbl_twitter_stat->week->EditAttributes() ?>>
</span><?php echo $tbl_twitter_stat->week->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_twitter_stat->following->Visible) { // following ?>
	<tr<?php echo $tbl_twitter_stat->following->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->following->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_twitter_stat->following->CellAttributes() ?>><span id="el_following">
<input type="text" name="x_following" id="x_following" title="<?php echo $tbl_twitter_stat->following->FldTitle() ?>" size="30" value="<?php echo $tbl_twitter_stat->following->EditValue ?>"<?php echo $tbl_twitter_stat->following->EditAttributes() ?>>
</span><?php echo $tbl_twitter_stat->following->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_twitter_stat->followers->Visible) { // followers ?>
	<tr<?php echo $tbl_twitter_stat->followers->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->followers->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_twitter_stat->followers->CellAttributes() ?>><span id="el_followers">
<input type="text" name="x_followers" id="x_followers" title="<?php echo $tbl_twitter_stat->followers->FldTitle() ?>" size="30" value="<?php echo $tbl_twitter_stat->followers->EditValue ?>"<?php echo $tbl_twitter_stat->followers->EditAttributes() ?>>
</span><?php echo $tbl_twitter_stat->followers->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_twitter_stat->listed->Visible) { // listed ?>
	<tr<?php echo $tbl_twitter_stat->listed->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->listed->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_twitter_stat->listed->CellAttributes() ?>><span id="el_listed">
<input type="text" name="x_listed" id="x_listed" title="<?php echo $tbl_twitter_stat->listed->FldTitle() ?>" size="30" value="<?php echo $tbl_twitter_stat->listed->EditValue ?>"<?php echo $tbl_twitter_stat->listed->EditAttributes() ?>>
</span><?php echo $tbl_twitter_stat->listed->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_twitter_stat->tweets->Visible) { // tweets ?>
	<tr<?php echo $tbl_twitter_stat->tweets->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->tweets->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_twitter_stat->tweets->CellAttributes() ?>><span id="el_tweets">
<input type="text" name="x_tweets" id="x_tweets" title="<?php echo $tbl_twitter_stat->tweets->FldTitle() ?>" size="30" value="<?php echo $tbl_twitter_stat->tweets->EditValue ?>"<?php echo $tbl_twitter_stat->tweets->EditAttributes() ?>>
</span><?php echo $tbl_twitter_stat->tweets->CustomMsg ?></td>
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
$tbl_twitter_stat_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_twitter_stat_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'tbl_twitter_stat';

	// Page object name
	var $PageObjName = 'tbl_twitter_stat_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_twitter_stat;
		if ($tbl_twitter_stat->UseTokenInUrl) $PageUrl .= "t=" . $tbl_twitter_stat->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_twitter_stat;
		if ($tbl_twitter_stat->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_twitter_stat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_twitter_stat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_twitter_stat_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_twitter_stat)
		$GLOBALS["tbl_twitter_stat"] = new ctbl_twitter_stat();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_twitter_stat', TRUE);

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
		global $tbl_twitter_stat;

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
			$this->Page_Terminate("tbl_twitter_statlist.php");
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
		global $objForm, $Language, $gsFormError, $tbl_twitter_stat;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id_profile"] != "") {
		  $tbl_twitter_stat->id_profile->setQueryStringValue($_GET["id_profile"]);
		} else {
		  $bCopy = FALSE;
		}
		if (@$_GET["stat_date"] != "") {
		  $tbl_twitter_stat->stat_date->setQueryStringValue($_GET["stat_date"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $tbl_twitter_stat->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_twitter_stat->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $tbl_twitter_stat->CurrentAction = "C"; // Copy record
		  } else {
		    $tbl_twitter_stat->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($tbl_twitter_stat->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("tbl_twitter_statlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$tbl_twitter_stat->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $tbl_twitter_stat->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tbl_twitter_statview.php")
						$sReturnUrl = $tbl_twitter_stat->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$tbl_twitter_stat->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_twitter_stat;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $tbl_twitter_stat;
		$tbl_twitter_stat->following->CurrentValue = 0;
		$tbl_twitter_stat->followers->CurrentValue = 0;
		$tbl_twitter_stat->listed->CurrentValue = 0;
		$tbl_twitter_stat->tweets->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_twitter_stat;
		$tbl_twitter_stat->id_profile->setFormValue($objForm->GetValue("x_id_profile"));
		$tbl_twitter_stat->stat_date->setFormValue($objForm->GetValue("x_stat_date"));
		$tbl_twitter_stat->stat_date->CurrentValue = ew_UnFormatDateTime($tbl_twitter_stat->stat_date->CurrentValue, 5);
		$tbl_twitter_stat->year->setFormValue($objForm->GetValue("x_year"));
		$tbl_twitter_stat->month->setFormValue($objForm->GetValue("x_month"));
		$tbl_twitter_stat->week->setFormValue($objForm->GetValue("x_week"));
		$tbl_twitter_stat->following->setFormValue($objForm->GetValue("x_following"));
		$tbl_twitter_stat->followers->setFormValue($objForm->GetValue("x_followers"));
		$tbl_twitter_stat->listed->setFormValue($objForm->GetValue("x_listed"));
		$tbl_twitter_stat->tweets->setFormValue($objForm->GetValue("x_tweets"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_twitter_stat;
		$tbl_twitter_stat->id_profile->CurrentValue = $tbl_twitter_stat->id_profile->FormValue;
		$tbl_twitter_stat->stat_date->CurrentValue = $tbl_twitter_stat->stat_date->FormValue;
		$tbl_twitter_stat->stat_date->CurrentValue = ew_UnFormatDateTime($tbl_twitter_stat->stat_date->CurrentValue, 5);
		$tbl_twitter_stat->year->CurrentValue = $tbl_twitter_stat->year->FormValue;
		$tbl_twitter_stat->month->CurrentValue = $tbl_twitter_stat->month->FormValue;
		$tbl_twitter_stat->week->CurrentValue = $tbl_twitter_stat->week->FormValue;
		$tbl_twitter_stat->following->CurrentValue = $tbl_twitter_stat->following->FormValue;
		$tbl_twitter_stat->followers->CurrentValue = $tbl_twitter_stat->followers->FormValue;
		$tbl_twitter_stat->listed->CurrentValue = $tbl_twitter_stat->listed->FormValue;
		$tbl_twitter_stat->tweets->CurrentValue = $tbl_twitter_stat->tweets->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_twitter_stat;
		$sFilter = $tbl_twitter_stat->KeyFilter();

		// Call Row Selecting event
		$tbl_twitter_stat->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_twitter_stat->CurrentFilter = $sFilter;
		$sSql = $tbl_twitter_stat->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_twitter_stat->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_twitter_stat;
		$tbl_twitter_stat->id_profile->setDbValue($rs->fields('id_profile'));
		$tbl_twitter_stat->stat_date->setDbValue($rs->fields('stat_date'));
		$tbl_twitter_stat->year->setDbValue($rs->fields('year'));
		$tbl_twitter_stat->month->setDbValue($rs->fields('month'));
		$tbl_twitter_stat->week->setDbValue($rs->fields('week'));
		$tbl_twitter_stat->following->setDbValue($rs->fields('following'));
		$tbl_twitter_stat->followers->setDbValue($rs->fields('followers'));
		$tbl_twitter_stat->listed->setDbValue($rs->fields('listed'));
		$tbl_twitter_stat->tweets->setDbValue($rs->fields('tweets'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_twitter_stat;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_twitter_stat->Row_Rendering();

		// Common render codes for all row types
		// id_profile

		$tbl_twitter_stat->id_profile->CellCssStyle = ""; $tbl_twitter_stat->id_profile->CellCssClass = "";
		$tbl_twitter_stat->id_profile->CellAttrs = array(); $tbl_twitter_stat->id_profile->ViewAttrs = array(); $tbl_twitter_stat->id_profile->EditAttrs = array();

		// stat_date
		$tbl_twitter_stat->stat_date->CellCssStyle = ""; $tbl_twitter_stat->stat_date->CellCssClass = "";
		$tbl_twitter_stat->stat_date->CellAttrs = array(); $tbl_twitter_stat->stat_date->ViewAttrs = array(); $tbl_twitter_stat->stat_date->EditAttrs = array();

		// year
		$tbl_twitter_stat->year->CellCssStyle = ""; $tbl_twitter_stat->year->CellCssClass = "";
		$tbl_twitter_stat->year->CellAttrs = array(); $tbl_twitter_stat->year->ViewAttrs = array(); $tbl_twitter_stat->year->EditAttrs = array();

		// month
		$tbl_twitter_stat->month->CellCssStyle = ""; $tbl_twitter_stat->month->CellCssClass = "";
		$tbl_twitter_stat->month->CellAttrs = array(); $tbl_twitter_stat->month->ViewAttrs = array(); $tbl_twitter_stat->month->EditAttrs = array();

		// week
		$tbl_twitter_stat->week->CellCssStyle = ""; $tbl_twitter_stat->week->CellCssClass = "";
		$tbl_twitter_stat->week->CellAttrs = array(); $tbl_twitter_stat->week->ViewAttrs = array(); $tbl_twitter_stat->week->EditAttrs = array();

		// following
		$tbl_twitter_stat->following->CellCssStyle = ""; $tbl_twitter_stat->following->CellCssClass = "";
		$tbl_twitter_stat->following->CellAttrs = array(); $tbl_twitter_stat->following->ViewAttrs = array(); $tbl_twitter_stat->following->EditAttrs = array();

		// followers
		$tbl_twitter_stat->followers->CellCssStyle = ""; $tbl_twitter_stat->followers->CellCssClass = "";
		$tbl_twitter_stat->followers->CellAttrs = array(); $tbl_twitter_stat->followers->ViewAttrs = array(); $tbl_twitter_stat->followers->EditAttrs = array();

		// listed
		$tbl_twitter_stat->listed->CellCssStyle = ""; $tbl_twitter_stat->listed->CellCssClass = "";
		$tbl_twitter_stat->listed->CellAttrs = array(); $tbl_twitter_stat->listed->ViewAttrs = array(); $tbl_twitter_stat->listed->EditAttrs = array();

		// tweets
		$tbl_twitter_stat->tweets->CellCssStyle = ""; $tbl_twitter_stat->tweets->CellCssClass = "";
		$tbl_twitter_stat->tweets->CellAttrs = array(); $tbl_twitter_stat->tweets->ViewAttrs = array(); $tbl_twitter_stat->tweets->EditAttrs = array();
		if ($tbl_twitter_stat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_profile
			if (strval($tbl_twitter_stat->id_profile->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_twitter_stat->id_profile->CurrentValue) . "";
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
					$tbl_twitter_stat->id_profile->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_twitter_stat->id_profile->ViewValue = $tbl_twitter_stat->id_profile->CurrentValue;
				}
			} else {
				$tbl_twitter_stat->id_profile->ViewValue = NULL;
			}
			$tbl_twitter_stat->id_profile->CssStyle = "";
			$tbl_twitter_stat->id_profile->CssClass = "";
			$tbl_twitter_stat->id_profile->ViewCustomAttributes = "";

			// stat_date
			$tbl_twitter_stat->stat_date->ViewValue = $tbl_twitter_stat->stat_date->CurrentValue;
			$tbl_twitter_stat->stat_date->ViewValue = ew_FormatDateTime($tbl_twitter_stat->stat_date->ViewValue, 5);
			$tbl_twitter_stat->stat_date->CssStyle = "";
			$tbl_twitter_stat->stat_date->CssClass = "";
			$tbl_twitter_stat->stat_date->ViewCustomAttributes = "";

			// year
			$tbl_twitter_stat->year->ViewValue = $tbl_twitter_stat->year->CurrentValue;
			$tbl_twitter_stat->year->CssStyle = "";
			$tbl_twitter_stat->year->CssClass = "";
			$tbl_twitter_stat->year->ViewCustomAttributes = "";

			// month
			$tbl_twitter_stat->month->ViewValue = $tbl_twitter_stat->month->CurrentValue;
			$tbl_twitter_stat->month->CssStyle = "";
			$tbl_twitter_stat->month->CssClass = "";
			$tbl_twitter_stat->month->ViewCustomAttributes = "";

			// week
			$tbl_twitter_stat->week->ViewValue = $tbl_twitter_stat->week->CurrentValue;
			$tbl_twitter_stat->week->CssStyle = "";
			$tbl_twitter_stat->week->CssClass = "";
			$tbl_twitter_stat->week->ViewCustomAttributes = "";

			// following
			$tbl_twitter_stat->following->ViewValue = $tbl_twitter_stat->following->CurrentValue;
			$tbl_twitter_stat->following->CssStyle = "";
			$tbl_twitter_stat->following->CssClass = "";
			$tbl_twitter_stat->following->ViewCustomAttributes = "";

			// followers
			$tbl_twitter_stat->followers->ViewValue = $tbl_twitter_stat->followers->CurrentValue;
			$tbl_twitter_stat->followers->CssStyle = "";
			$tbl_twitter_stat->followers->CssClass = "";
			$tbl_twitter_stat->followers->ViewCustomAttributes = "";

			// listed
			$tbl_twitter_stat->listed->ViewValue = $tbl_twitter_stat->listed->CurrentValue;
			$tbl_twitter_stat->listed->CssStyle = "";
			$tbl_twitter_stat->listed->CssClass = "";
			$tbl_twitter_stat->listed->ViewCustomAttributes = "";

			// tweets
			$tbl_twitter_stat->tweets->ViewValue = $tbl_twitter_stat->tweets->CurrentValue;
			$tbl_twitter_stat->tweets->CssStyle = "";
			$tbl_twitter_stat->tweets->CssClass = "";
			$tbl_twitter_stat->tweets->ViewCustomAttributes = "";

			// id_profile
			$tbl_twitter_stat->id_profile->HrefValue = "";
			$tbl_twitter_stat->id_profile->TooltipValue = "";

			// stat_date
			$tbl_twitter_stat->stat_date->HrefValue = "";
			$tbl_twitter_stat->stat_date->TooltipValue = "";

			// year
			$tbl_twitter_stat->year->HrefValue = "";
			$tbl_twitter_stat->year->TooltipValue = "";

			// month
			$tbl_twitter_stat->month->HrefValue = "";
			$tbl_twitter_stat->month->TooltipValue = "";

			// week
			$tbl_twitter_stat->week->HrefValue = "";
			$tbl_twitter_stat->week->TooltipValue = "";

			// following
			$tbl_twitter_stat->following->HrefValue = "";
			$tbl_twitter_stat->following->TooltipValue = "";

			// followers
			$tbl_twitter_stat->followers->HrefValue = "";
			$tbl_twitter_stat->followers->TooltipValue = "";

			// listed
			$tbl_twitter_stat->listed->HrefValue = "";
			$tbl_twitter_stat->listed->TooltipValue = "";

			// tweets
			$tbl_twitter_stat->tweets->HrefValue = "";
			$tbl_twitter_stat->tweets->TooltipValue = "";
		} elseif ($tbl_twitter_stat->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_profile
			$tbl_twitter_stat->id_profile->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT DISTINCT `id`, `name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `tbl_profile`";
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
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			array_unshift($arwrk, array("", $Language->Phrase("PleaseSelect")));
			$tbl_twitter_stat->id_profile->EditValue = $arwrk;

			// stat_date
			$tbl_twitter_stat->stat_date->EditCustomAttributes = "";
			$tbl_twitter_stat->stat_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($tbl_twitter_stat->stat_date->CurrentValue, 5));

			// year
			$tbl_twitter_stat->year->EditCustomAttributes = "";
			$tbl_twitter_stat->year->EditValue = ew_HtmlEncode($tbl_twitter_stat->year->CurrentValue);

			// month
			$tbl_twitter_stat->month->EditCustomAttributes = "";
			$tbl_twitter_stat->month->EditValue = ew_HtmlEncode($tbl_twitter_stat->month->CurrentValue);

			// week
			$tbl_twitter_stat->week->EditCustomAttributes = "";
			$tbl_twitter_stat->week->EditValue = ew_HtmlEncode($tbl_twitter_stat->week->CurrentValue);

			// following
			$tbl_twitter_stat->following->EditCustomAttributes = "";
			$tbl_twitter_stat->following->EditValue = ew_HtmlEncode($tbl_twitter_stat->following->CurrentValue);

			// followers
			$tbl_twitter_stat->followers->EditCustomAttributes = "";
			$tbl_twitter_stat->followers->EditValue = ew_HtmlEncode($tbl_twitter_stat->followers->CurrentValue);

			// listed
			$tbl_twitter_stat->listed->EditCustomAttributes = "";
			$tbl_twitter_stat->listed->EditValue = ew_HtmlEncode($tbl_twitter_stat->listed->CurrentValue);

			// tweets
			$tbl_twitter_stat->tweets->EditCustomAttributes = "";
			$tbl_twitter_stat->tweets->EditValue = ew_HtmlEncode($tbl_twitter_stat->tweets->CurrentValue);
		}

		// Call Row Rendered event
		if ($tbl_twitter_stat->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_twitter_stat->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_twitter_stat;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_twitter_stat->id_profile->FormValue) && $tbl_twitter_stat->id_profile->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_twitter_stat->id_profile->FldCaption();
		}
		if (!is_null($tbl_twitter_stat->stat_date->FormValue) && $tbl_twitter_stat->stat_date->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_twitter_stat->stat_date->FldCaption();
		}
		if (!ew_CheckDate($tbl_twitter_stat->stat_date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_twitter_stat->stat_date->FldErrMsg();
		}
		if (!is_null($tbl_twitter_stat->year->FormValue) && $tbl_twitter_stat->year->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_twitter_stat->year->FldCaption();
		}
		if (!ew_CheckInteger($tbl_twitter_stat->year->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_twitter_stat->year->FldErrMsg();
		}
		if (!is_null($tbl_twitter_stat->month->FormValue) && $tbl_twitter_stat->month->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_twitter_stat->month->FldCaption();
		}
		if (!ew_CheckInteger($tbl_twitter_stat->month->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_twitter_stat->month->FldErrMsg();
		}
		if (!is_null($tbl_twitter_stat->week->FormValue) && $tbl_twitter_stat->week->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_twitter_stat->week->FldCaption();
		}
		if (!ew_CheckInteger($tbl_twitter_stat->week->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_twitter_stat->week->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_twitter_stat->following->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_twitter_stat->following->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_twitter_stat->followers->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_twitter_stat->followers->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_twitter_stat->listed->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_twitter_stat->listed->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_twitter_stat->tweets->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_twitter_stat->tweets->FldErrMsg();
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
		global $conn, $Language, $Security, $tbl_twitter_stat;

		// Check if key value entered
		if ($tbl_twitter_stat->id_profile->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check if key value entered
		if ($tbl_twitter_stat->stat_date->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $tbl_twitter_stat->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $tbl_twitter_stat->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// id_profile
		$tbl_twitter_stat->id_profile->SetDbValueDef($rsnew, $tbl_twitter_stat->id_profile->CurrentValue, 0, FALSE);

		// stat_date
		$tbl_twitter_stat->stat_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($tbl_twitter_stat->stat_date->CurrentValue, 5, FALSE), ew_CurrentDate());

		// year
		$tbl_twitter_stat->year->SetDbValueDef($rsnew, $tbl_twitter_stat->year->CurrentValue, 0, FALSE);

		// month
		$tbl_twitter_stat->month->SetDbValueDef($rsnew, $tbl_twitter_stat->month->CurrentValue, 0, FALSE);

		// week
		$tbl_twitter_stat->week->SetDbValueDef($rsnew, $tbl_twitter_stat->week->CurrentValue, 0, FALSE);

		// following
		$tbl_twitter_stat->following->SetDbValueDef($rsnew, $tbl_twitter_stat->following->CurrentValue, 0, TRUE);

		// followers
		$tbl_twitter_stat->followers->SetDbValueDef($rsnew, $tbl_twitter_stat->followers->CurrentValue, 0, TRUE);

		// listed
		$tbl_twitter_stat->listed->SetDbValueDef($rsnew, $tbl_twitter_stat->listed->CurrentValue, 0, TRUE);

		// tweets
		$tbl_twitter_stat->tweets->SetDbValueDef($rsnew, $tbl_twitter_stat->tweets->CurrentValue, 0, TRUE);

		// Call Row Inserting event
		$bInsertRow = $tbl_twitter_stat->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tbl_twitter_stat->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tbl_twitter_stat->CancelMessage <> "") {
				$this->setMessage($tbl_twitter_stat->CancelMessage);
				$tbl_twitter_stat->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$tbl_twitter_stat->Row_Inserted($rsnew);
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
