<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_facebook_statinfo.php" ?>
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
$tbl_facebook_stat_add = new ctbl_facebook_stat_add();
$Page =& $tbl_facebook_stat_add;

// Page init
$tbl_facebook_stat_add->Page_Init();

// Page main
$tbl_facebook_stat_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_facebook_stat_add = new ew_Page("tbl_facebook_stat_add");

// page properties
tbl_facebook_stat_add.PageID = "add"; // page ID
tbl_facebook_stat_add.FormID = "ftbl_facebook_statadd"; // form ID
var EW_PAGE_ID = tbl_facebook_stat_add.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_facebook_stat_add.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_facebook_stat->id_profile->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_stat_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_facebook_stat->stat_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_stat_date"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_facebook_stat->stat_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_facebook_stat->year->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_facebook_stat->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_facebook_stat->month->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_facebook_stat->month->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_week"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_facebook_stat->week->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_week"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_facebook_stat->week->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_interactions"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_facebook_stat->interactions->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_comments"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_facebook_stat->comments->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_wallposts"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_facebook_stat->wallposts->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_fans"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_facebook_stat->fans->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_likes"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_facebook_stat->likes->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_unsubscribe"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_facebook_stat->unsubscribe->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_unsubscribe"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_facebook_stat->unsubscribe->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_facebook_stat_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_facebook_stat_add.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_facebook_stat_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_facebook_stat_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_facebook_stat_add.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_facebook_stat_add.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_facebook_stat->TableCaption() ?><br><br>
<a href="<?php echo $tbl_facebook_stat->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_facebook_stat_add->ShowMessage();
?>
<form name="ftbl_facebook_statadd" id="ftbl_facebook_statadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_facebook_stat_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="tbl_facebook_stat">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_facebook_stat->id_profile->Visible) { // id_profile ?>
	<tr<?php echo $tbl_facebook_stat->id_profile->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->id_profile->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_facebook_stat->id_profile->CellAttributes() ?>><span id="el_id_profile">
<select id="x_id_profile" name="x_id_profile" title="<?php echo $tbl_facebook_stat->id_profile->FldTitle() ?>"<?php echo $tbl_facebook_stat->id_profile->EditAttributes() ?>>
<?php
if (is_array($tbl_facebook_stat->id_profile->EditValue)) {
	$arwrk = $tbl_facebook_stat->id_profile->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_facebook_stat->id_profile->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span><?php echo $tbl_facebook_stat->id_profile->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_facebook_stat->stat_date->Visible) { // stat_date ?>
	<tr<?php echo $tbl_facebook_stat->stat_date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->stat_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_facebook_stat->stat_date->CellAttributes() ?>><span id="el_stat_date">
<input type="text" name="x_stat_date" id="x_stat_date" title="<?php echo $tbl_facebook_stat->stat_date->FldTitle() ?>" value="<?php echo $tbl_facebook_stat->stat_date->EditValue ?>"<?php echo $tbl_facebook_stat->stat_date->EditAttributes() ?>>
</span><?php echo $tbl_facebook_stat->stat_date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_facebook_stat->year->Visible) { // year ?>
	<tr<?php echo $tbl_facebook_stat->year->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->year->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_facebook_stat->year->CellAttributes() ?>><span id="el_year">
<input type="text" name="x_year" id="x_year" title="<?php echo $tbl_facebook_stat->year->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->year->EditValue ?>"<?php echo $tbl_facebook_stat->year->EditAttributes() ?>>
</span><?php echo $tbl_facebook_stat->year->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_facebook_stat->month->Visible) { // month ?>
	<tr<?php echo $tbl_facebook_stat->month->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->month->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_facebook_stat->month->CellAttributes() ?>><span id="el_month">
<input type="text" name="x_month" id="x_month" title="<?php echo $tbl_facebook_stat->month->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->month->EditValue ?>"<?php echo $tbl_facebook_stat->month->EditAttributes() ?>>
</span><?php echo $tbl_facebook_stat->month->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_facebook_stat->week->Visible) { // week ?>
	<tr<?php echo $tbl_facebook_stat->week->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->week->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_facebook_stat->week->CellAttributes() ?>><span id="el_week">
<input type="text" name="x_week" id="x_week" title="<?php echo $tbl_facebook_stat->week->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->week->EditValue ?>"<?php echo $tbl_facebook_stat->week->EditAttributes() ?>>
</span><?php echo $tbl_facebook_stat->week->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_facebook_stat->interactions->Visible) { // interactions ?>
	<tr<?php echo $tbl_facebook_stat->interactions->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->interactions->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_facebook_stat->interactions->CellAttributes() ?>><span id="el_interactions">
<input type="text" name="x_interactions" id="x_interactions" title="<?php echo $tbl_facebook_stat->interactions->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->interactions->EditValue ?>"<?php echo $tbl_facebook_stat->interactions->EditAttributes() ?>>
</span><?php echo $tbl_facebook_stat->interactions->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_facebook_stat->comments->Visible) { // comments ?>
	<tr<?php echo $tbl_facebook_stat->comments->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->comments->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_facebook_stat->comments->CellAttributes() ?>><span id="el_comments">
<input type="text" name="x_comments" id="x_comments" title="<?php echo $tbl_facebook_stat->comments->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->comments->EditValue ?>"<?php echo $tbl_facebook_stat->comments->EditAttributes() ?>>
</span><?php echo $tbl_facebook_stat->comments->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_facebook_stat->wallposts->Visible) { // wallposts ?>
	<tr<?php echo $tbl_facebook_stat->wallposts->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->wallposts->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_facebook_stat->wallposts->CellAttributes() ?>><span id="el_wallposts">
<input type="text" name="x_wallposts" id="x_wallposts" title="<?php echo $tbl_facebook_stat->wallposts->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->wallposts->EditValue ?>"<?php echo $tbl_facebook_stat->wallposts->EditAttributes() ?>>
</span><?php echo $tbl_facebook_stat->wallposts->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_facebook_stat->fans->Visible) { // fans ?>
	<tr<?php echo $tbl_facebook_stat->fans->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->fans->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_facebook_stat->fans->CellAttributes() ?>><span id="el_fans">
<input type="text" name="x_fans" id="x_fans" title="<?php echo $tbl_facebook_stat->fans->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->fans->EditValue ?>"<?php echo $tbl_facebook_stat->fans->EditAttributes() ?>>
</span><?php echo $tbl_facebook_stat->fans->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_facebook_stat->likes->Visible) { // likes ?>
	<tr<?php echo $tbl_facebook_stat->likes->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->likes->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_facebook_stat->likes->CellAttributes() ?>><span id="el_likes">
<input type="text" name="x_likes" id="x_likes" title="<?php echo $tbl_facebook_stat->likes->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->likes->EditValue ?>"<?php echo $tbl_facebook_stat->likes->EditAttributes() ?>>
</span><?php echo $tbl_facebook_stat->likes->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_facebook_stat->unsubscribe->Visible) { // unsubscribe ?>
	<tr<?php echo $tbl_facebook_stat->unsubscribe->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->unsubscribe->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_facebook_stat->unsubscribe->CellAttributes() ?>><span id="el_unsubscribe">
<input type="text" name="x_unsubscribe" id="x_unsubscribe" title="<?php echo $tbl_facebook_stat->unsubscribe->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->unsubscribe->EditValue ?>"<?php echo $tbl_facebook_stat->unsubscribe->EditAttributes() ?>>
</span><?php echo $tbl_facebook_stat->unsubscribe->CustomMsg ?></td>
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
$tbl_facebook_stat_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_facebook_stat_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'tbl_facebook_stat';

	// Page object name
	var $PageObjName = 'tbl_facebook_stat_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_facebook_stat;
		if ($tbl_facebook_stat->UseTokenInUrl) $PageUrl .= "t=" . $tbl_facebook_stat->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_facebook_stat;
		if ($tbl_facebook_stat->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_facebook_stat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_facebook_stat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_facebook_stat_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_facebook_stat)
		$GLOBALS["tbl_facebook_stat"] = new ctbl_facebook_stat();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_facebook_stat', TRUE);

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
		global $tbl_facebook_stat;

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
			$this->Page_Terminate("tbl_facebook_statlist.php");
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
		global $objForm, $Language, $gsFormError, $tbl_facebook_stat;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id_profile"] != "") {
		  $tbl_facebook_stat->id_profile->setQueryStringValue($_GET["id_profile"]);
		} else {
		  $bCopy = FALSE;
		}
		if (@$_GET["stat_date"] != "") {
		  $tbl_facebook_stat->stat_date->setQueryStringValue($_GET["stat_date"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $tbl_facebook_stat->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_facebook_stat->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $tbl_facebook_stat->CurrentAction = "C"; // Copy record
		  } else {
		    $tbl_facebook_stat->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($tbl_facebook_stat->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("tbl_facebook_statlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$tbl_facebook_stat->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $tbl_facebook_stat->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tbl_facebook_statview.php")
						$sReturnUrl = $tbl_facebook_stat->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$tbl_facebook_stat->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_facebook_stat;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $tbl_facebook_stat;
		$tbl_facebook_stat->interactions->CurrentValue = 0;
		$tbl_facebook_stat->comments->CurrentValue = 0;
		$tbl_facebook_stat->wallposts->CurrentValue = 0;
		$tbl_facebook_stat->fans->CurrentValue = 0;
		$tbl_facebook_stat->likes->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_facebook_stat;
		$tbl_facebook_stat->id_profile->setFormValue($objForm->GetValue("x_id_profile"));
		$tbl_facebook_stat->stat_date->setFormValue($objForm->GetValue("x_stat_date"));
		$tbl_facebook_stat->stat_date->CurrentValue = ew_UnFormatDateTime($tbl_facebook_stat->stat_date->CurrentValue, 5);
		$tbl_facebook_stat->year->setFormValue($objForm->GetValue("x_year"));
		$tbl_facebook_stat->month->setFormValue($objForm->GetValue("x_month"));
		$tbl_facebook_stat->week->setFormValue($objForm->GetValue("x_week"));
		$tbl_facebook_stat->interactions->setFormValue($objForm->GetValue("x_interactions"));
		$tbl_facebook_stat->comments->setFormValue($objForm->GetValue("x_comments"));
		$tbl_facebook_stat->wallposts->setFormValue($objForm->GetValue("x_wallposts"));
		$tbl_facebook_stat->fans->setFormValue($objForm->GetValue("x_fans"));
		$tbl_facebook_stat->likes->setFormValue($objForm->GetValue("x_likes"));
		$tbl_facebook_stat->unsubscribe->setFormValue($objForm->GetValue("x_unsubscribe"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_facebook_stat;
		$tbl_facebook_stat->id_profile->CurrentValue = $tbl_facebook_stat->id_profile->FormValue;
		$tbl_facebook_stat->stat_date->CurrentValue = $tbl_facebook_stat->stat_date->FormValue;
		$tbl_facebook_stat->stat_date->CurrentValue = ew_UnFormatDateTime($tbl_facebook_stat->stat_date->CurrentValue, 5);
		$tbl_facebook_stat->year->CurrentValue = $tbl_facebook_stat->year->FormValue;
		$tbl_facebook_stat->month->CurrentValue = $tbl_facebook_stat->month->FormValue;
		$tbl_facebook_stat->week->CurrentValue = $tbl_facebook_stat->week->FormValue;
		$tbl_facebook_stat->interactions->CurrentValue = $tbl_facebook_stat->interactions->FormValue;
		$tbl_facebook_stat->comments->CurrentValue = $tbl_facebook_stat->comments->FormValue;
		$tbl_facebook_stat->wallposts->CurrentValue = $tbl_facebook_stat->wallposts->FormValue;
		$tbl_facebook_stat->fans->CurrentValue = $tbl_facebook_stat->fans->FormValue;
		$tbl_facebook_stat->likes->CurrentValue = $tbl_facebook_stat->likes->FormValue;
		$tbl_facebook_stat->unsubscribe->CurrentValue = $tbl_facebook_stat->unsubscribe->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_facebook_stat;
		$sFilter = $tbl_facebook_stat->KeyFilter();

		// Call Row Selecting event
		$tbl_facebook_stat->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_facebook_stat->CurrentFilter = $sFilter;
		$sSql = $tbl_facebook_stat->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_facebook_stat->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_facebook_stat;
		$tbl_facebook_stat->id_profile->setDbValue($rs->fields('id_profile'));
		$tbl_facebook_stat->stat_date->setDbValue($rs->fields('stat_date'));
		$tbl_facebook_stat->year->setDbValue($rs->fields('year'));
		$tbl_facebook_stat->month->setDbValue($rs->fields('month'));
		$tbl_facebook_stat->week->setDbValue($rs->fields('week'));
		$tbl_facebook_stat->interactions->setDbValue($rs->fields('interactions'));
		$tbl_facebook_stat->comments->setDbValue($rs->fields('comments'));
		$tbl_facebook_stat->wallposts->setDbValue($rs->fields('wallposts'));
		$tbl_facebook_stat->fans->setDbValue($rs->fields('fans'));
		$tbl_facebook_stat->likes->setDbValue($rs->fields('likes'));
		$tbl_facebook_stat->unsubscribe->setDbValue($rs->fields('unsubscribe'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_facebook_stat;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_facebook_stat->Row_Rendering();

		// Common render codes for all row types
		// id_profile

		$tbl_facebook_stat->id_profile->CellCssStyle = ""; $tbl_facebook_stat->id_profile->CellCssClass = "";
		$tbl_facebook_stat->id_profile->CellAttrs = array(); $tbl_facebook_stat->id_profile->ViewAttrs = array(); $tbl_facebook_stat->id_profile->EditAttrs = array();

		// stat_date
		$tbl_facebook_stat->stat_date->CellCssStyle = ""; $tbl_facebook_stat->stat_date->CellCssClass = "";
		$tbl_facebook_stat->stat_date->CellAttrs = array(); $tbl_facebook_stat->stat_date->ViewAttrs = array(); $tbl_facebook_stat->stat_date->EditAttrs = array();

		// year
		$tbl_facebook_stat->year->CellCssStyle = ""; $tbl_facebook_stat->year->CellCssClass = "";
		$tbl_facebook_stat->year->CellAttrs = array(); $tbl_facebook_stat->year->ViewAttrs = array(); $tbl_facebook_stat->year->EditAttrs = array();

		// month
		$tbl_facebook_stat->month->CellCssStyle = ""; $tbl_facebook_stat->month->CellCssClass = "";
		$tbl_facebook_stat->month->CellAttrs = array(); $tbl_facebook_stat->month->ViewAttrs = array(); $tbl_facebook_stat->month->EditAttrs = array();

		// week
		$tbl_facebook_stat->week->CellCssStyle = ""; $tbl_facebook_stat->week->CellCssClass = "";
		$tbl_facebook_stat->week->CellAttrs = array(); $tbl_facebook_stat->week->ViewAttrs = array(); $tbl_facebook_stat->week->EditAttrs = array();

		// interactions
		$tbl_facebook_stat->interactions->CellCssStyle = ""; $tbl_facebook_stat->interactions->CellCssClass = "";
		$tbl_facebook_stat->interactions->CellAttrs = array(); $tbl_facebook_stat->interactions->ViewAttrs = array(); $tbl_facebook_stat->interactions->EditAttrs = array();

		// comments
		$tbl_facebook_stat->comments->CellCssStyle = ""; $tbl_facebook_stat->comments->CellCssClass = "";
		$tbl_facebook_stat->comments->CellAttrs = array(); $tbl_facebook_stat->comments->ViewAttrs = array(); $tbl_facebook_stat->comments->EditAttrs = array();

		// wallposts
		$tbl_facebook_stat->wallposts->CellCssStyle = ""; $tbl_facebook_stat->wallposts->CellCssClass = "";
		$tbl_facebook_stat->wallposts->CellAttrs = array(); $tbl_facebook_stat->wallposts->ViewAttrs = array(); $tbl_facebook_stat->wallposts->EditAttrs = array();

		// fans
		$tbl_facebook_stat->fans->CellCssStyle = ""; $tbl_facebook_stat->fans->CellCssClass = "";
		$tbl_facebook_stat->fans->CellAttrs = array(); $tbl_facebook_stat->fans->ViewAttrs = array(); $tbl_facebook_stat->fans->EditAttrs = array();

		// likes
		$tbl_facebook_stat->likes->CellCssStyle = ""; $tbl_facebook_stat->likes->CellCssClass = "";
		$tbl_facebook_stat->likes->CellAttrs = array(); $tbl_facebook_stat->likes->ViewAttrs = array(); $tbl_facebook_stat->likes->EditAttrs = array();

		// unsubscribe
		$tbl_facebook_stat->unsubscribe->CellCssStyle = ""; $tbl_facebook_stat->unsubscribe->CellCssClass = "";
		$tbl_facebook_stat->unsubscribe->CellAttrs = array(); $tbl_facebook_stat->unsubscribe->ViewAttrs = array(); $tbl_facebook_stat->unsubscribe->EditAttrs = array();
		if ($tbl_facebook_stat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_profile
			if (strval($tbl_facebook_stat->id_profile->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_facebook_stat->id_profile->CurrentValue) . "";
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
					$tbl_facebook_stat->id_profile->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_facebook_stat->id_profile->ViewValue = $tbl_facebook_stat->id_profile->CurrentValue;
				}
			} else {
				$tbl_facebook_stat->id_profile->ViewValue = NULL;
			}
			$tbl_facebook_stat->id_profile->CssStyle = "";
			$tbl_facebook_stat->id_profile->CssClass = "";
			$tbl_facebook_stat->id_profile->ViewCustomAttributes = "";

			// stat_date
			$tbl_facebook_stat->stat_date->ViewValue = $tbl_facebook_stat->stat_date->CurrentValue;
			$tbl_facebook_stat->stat_date->ViewValue = ew_FormatDateTime($tbl_facebook_stat->stat_date->ViewValue, 5);
			$tbl_facebook_stat->stat_date->CssStyle = "";
			$tbl_facebook_stat->stat_date->CssClass = "";
			$tbl_facebook_stat->stat_date->ViewCustomAttributes = "";

			// year
			$tbl_facebook_stat->year->ViewValue = $tbl_facebook_stat->year->CurrentValue;
			$tbl_facebook_stat->year->CssStyle = "";
			$tbl_facebook_stat->year->CssClass = "";
			$tbl_facebook_stat->year->ViewCustomAttributes = "";

			// month
			$tbl_facebook_stat->month->ViewValue = $tbl_facebook_stat->month->CurrentValue;
			$tbl_facebook_stat->month->CssStyle = "";
			$tbl_facebook_stat->month->CssClass = "";
			$tbl_facebook_stat->month->ViewCustomAttributes = "";

			// week
			$tbl_facebook_stat->week->ViewValue = $tbl_facebook_stat->week->CurrentValue;
			$tbl_facebook_stat->week->CssStyle = "";
			$tbl_facebook_stat->week->CssClass = "";
			$tbl_facebook_stat->week->ViewCustomAttributes = "";

			// interactions
			$tbl_facebook_stat->interactions->ViewValue = $tbl_facebook_stat->interactions->CurrentValue;
			$tbl_facebook_stat->interactions->CssStyle = "";
			$tbl_facebook_stat->interactions->CssClass = "";
			$tbl_facebook_stat->interactions->ViewCustomAttributes = "";

			// comments
			$tbl_facebook_stat->comments->ViewValue = $tbl_facebook_stat->comments->CurrentValue;
			$tbl_facebook_stat->comments->CssStyle = "";
			$tbl_facebook_stat->comments->CssClass = "";
			$tbl_facebook_stat->comments->ViewCustomAttributes = "";

			// wallposts
			$tbl_facebook_stat->wallposts->ViewValue = $tbl_facebook_stat->wallposts->CurrentValue;
			$tbl_facebook_stat->wallposts->CssStyle = "";
			$tbl_facebook_stat->wallposts->CssClass = "";
			$tbl_facebook_stat->wallposts->ViewCustomAttributes = "";

			// fans
			$tbl_facebook_stat->fans->ViewValue = $tbl_facebook_stat->fans->CurrentValue;
			$tbl_facebook_stat->fans->CssStyle = "";
			$tbl_facebook_stat->fans->CssClass = "";
			$tbl_facebook_stat->fans->ViewCustomAttributes = "";

			// likes
			$tbl_facebook_stat->likes->ViewValue = $tbl_facebook_stat->likes->CurrentValue;
			$tbl_facebook_stat->likes->CssStyle = "";
			$tbl_facebook_stat->likes->CssClass = "";
			$tbl_facebook_stat->likes->ViewCustomAttributes = "";

			// unsubscribe
			$tbl_facebook_stat->unsubscribe->ViewValue = $tbl_facebook_stat->unsubscribe->CurrentValue;
			$tbl_facebook_stat->unsubscribe->CssStyle = "";
			$tbl_facebook_stat->unsubscribe->CssClass = "";
			$tbl_facebook_stat->unsubscribe->ViewCustomAttributes = "";

			// id_profile
			$tbl_facebook_stat->id_profile->HrefValue = "";
			$tbl_facebook_stat->id_profile->TooltipValue = "";

			// stat_date
			$tbl_facebook_stat->stat_date->HrefValue = "";
			$tbl_facebook_stat->stat_date->TooltipValue = "";

			// year
			$tbl_facebook_stat->year->HrefValue = "";
			$tbl_facebook_stat->year->TooltipValue = "";

			// month
			$tbl_facebook_stat->month->HrefValue = "";
			$tbl_facebook_stat->month->TooltipValue = "";

			// week
			$tbl_facebook_stat->week->HrefValue = "";
			$tbl_facebook_stat->week->TooltipValue = "";

			// interactions
			$tbl_facebook_stat->interactions->HrefValue = "";
			$tbl_facebook_stat->interactions->TooltipValue = "";

			// comments
			$tbl_facebook_stat->comments->HrefValue = "";
			$tbl_facebook_stat->comments->TooltipValue = "";

			// wallposts
			$tbl_facebook_stat->wallposts->HrefValue = "";
			$tbl_facebook_stat->wallposts->TooltipValue = "";

			// fans
			$tbl_facebook_stat->fans->HrefValue = "";
			$tbl_facebook_stat->fans->TooltipValue = "";

			// likes
			$tbl_facebook_stat->likes->HrefValue = "";
			$tbl_facebook_stat->likes->TooltipValue = "";

			// unsubscribe
			$tbl_facebook_stat->unsubscribe->HrefValue = "";
			$tbl_facebook_stat->unsubscribe->TooltipValue = "";
		} elseif ($tbl_facebook_stat->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_profile
			$tbl_facebook_stat->id_profile->EditCustomAttributes = "";
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
			$tbl_facebook_stat->id_profile->EditValue = $arwrk;

			// stat_date
			$tbl_facebook_stat->stat_date->EditCustomAttributes = "";
			$tbl_facebook_stat->stat_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($tbl_facebook_stat->stat_date->CurrentValue, 5));

			// year
			$tbl_facebook_stat->year->EditCustomAttributes = "";
			$tbl_facebook_stat->year->EditValue = ew_HtmlEncode($tbl_facebook_stat->year->CurrentValue);

			// month
			$tbl_facebook_stat->month->EditCustomAttributes = "";
			$tbl_facebook_stat->month->EditValue = ew_HtmlEncode($tbl_facebook_stat->month->CurrentValue);

			// week
			$tbl_facebook_stat->week->EditCustomAttributes = "";
			$tbl_facebook_stat->week->EditValue = ew_HtmlEncode($tbl_facebook_stat->week->CurrentValue);

			// interactions
			$tbl_facebook_stat->interactions->EditCustomAttributes = "";
			$tbl_facebook_stat->interactions->EditValue = ew_HtmlEncode($tbl_facebook_stat->interactions->CurrentValue);

			// comments
			$tbl_facebook_stat->comments->EditCustomAttributes = "";
			$tbl_facebook_stat->comments->EditValue = ew_HtmlEncode($tbl_facebook_stat->comments->CurrentValue);

			// wallposts
			$tbl_facebook_stat->wallposts->EditCustomAttributes = "";
			$tbl_facebook_stat->wallposts->EditValue = ew_HtmlEncode($tbl_facebook_stat->wallposts->CurrentValue);

			// fans
			$tbl_facebook_stat->fans->EditCustomAttributes = "";
			$tbl_facebook_stat->fans->EditValue = ew_HtmlEncode($tbl_facebook_stat->fans->CurrentValue);

			// likes
			$tbl_facebook_stat->likes->EditCustomAttributes = "";
			$tbl_facebook_stat->likes->EditValue = ew_HtmlEncode($tbl_facebook_stat->likes->CurrentValue);

			// unsubscribe
			$tbl_facebook_stat->unsubscribe->EditCustomAttributes = "";
			$tbl_facebook_stat->unsubscribe->EditValue = ew_HtmlEncode($tbl_facebook_stat->unsubscribe->CurrentValue);
		}

		// Call Row Rendered event
		if ($tbl_facebook_stat->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_facebook_stat->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_facebook_stat;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_facebook_stat->id_profile->FormValue) && $tbl_facebook_stat->id_profile->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_facebook_stat->id_profile->FldCaption();
		}
		if (!is_null($tbl_facebook_stat->stat_date->FormValue) && $tbl_facebook_stat->stat_date->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_facebook_stat->stat_date->FldCaption();
		}
		if (!ew_CheckDate($tbl_facebook_stat->stat_date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_facebook_stat->stat_date->FldErrMsg();
		}
		if (!is_null($tbl_facebook_stat->year->FormValue) && $tbl_facebook_stat->year->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_facebook_stat->year->FldCaption();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->year->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_facebook_stat->year->FldErrMsg();
		}
		if (!is_null($tbl_facebook_stat->month->FormValue) && $tbl_facebook_stat->month->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_facebook_stat->month->FldCaption();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->month->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_facebook_stat->month->FldErrMsg();
		}
		if (!is_null($tbl_facebook_stat->week->FormValue) && $tbl_facebook_stat->week->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_facebook_stat->week->FldCaption();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->week->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_facebook_stat->week->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->interactions->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_facebook_stat->interactions->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->comments->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_facebook_stat->comments->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->wallposts->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_facebook_stat->wallposts->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->fans->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_facebook_stat->fans->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->likes->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_facebook_stat->likes->FldErrMsg();
		}
		if (!is_null($tbl_facebook_stat->unsubscribe->FormValue) && $tbl_facebook_stat->unsubscribe->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_facebook_stat->unsubscribe->FldCaption();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->unsubscribe->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_facebook_stat->unsubscribe->FldErrMsg();
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
		global $conn, $Language, $Security, $tbl_facebook_stat;

		// Check if key value entered
		if ($tbl_facebook_stat->id_profile->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check if key value entered
		if ($tbl_facebook_stat->stat_date->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $tbl_facebook_stat->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $tbl_facebook_stat->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// id_profile
		$tbl_facebook_stat->id_profile->SetDbValueDef($rsnew, $tbl_facebook_stat->id_profile->CurrentValue, 0, FALSE);

		// stat_date
		$tbl_facebook_stat->stat_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($tbl_facebook_stat->stat_date->CurrentValue, 5, FALSE), ew_CurrentDate());

		// year
		$tbl_facebook_stat->year->SetDbValueDef($rsnew, $tbl_facebook_stat->year->CurrentValue, 0, FALSE);

		// month
		$tbl_facebook_stat->month->SetDbValueDef($rsnew, $tbl_facebook_stat->month->CurrentValue, 0, FALSE);

		// week
		$tbl_facebook_stat->week->SetDbValueDef($rsnew, $tbl_facebook_stat->week->CurrentValue, 0, FALSE);

		// interactions
		$tbl_facebook_stat->interactions->SetDbValueDef($rsnew, $tbl_facebook_stat->interactions->CurrentValue, 0, TRUE);

		// comments
		$tbl_facebook_stat->comments->SetDbValueDef($rsnew, $tbl_facebook_stat->comments->CurrentValue, 0, TRUE);

		// wallposts
		$tbl_facebook_stat->wallposts->SetDbValueDef($rsnew, $tbl_facebook_stat->wallposts->CurrentValue, 0, TRUE);

		// fans
		$tbl_facebook_stat->fans->SetDbValueDef($rsnew, $tbl_facebook_stat->fans->CurrentValue, 0, TRUE);

		// likes
		$tbl_facebook_stat->likes->SetDbValueDef($rsnew, $tbl_facebook_stat->likes->CurrentValue, 0, TRUE);

		// unsubscribe
		$tbl_facebook_stat->unsubscribe->SetDbValueDef($rsnew, $tbl_facebook_stat->unsubscribe->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$bInsertRow = $tbl_facebook_stat->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tbl_facebook_stat->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tbl_facebook_stat->CancelMessage <> "") {
				$this->setMessage($tbl_facebook_stat->CancelMessage);
				$tbl_facebook_stat->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$tbl_facebook_stat->Row_Inserted($rsnew);
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
