<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_targetinfo.php" ?>
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
$tbl_target_edit = new ctbl_target_edit();
$Page =& $tbl_target_edit;

// Page init
$tbl_target_edit->Page_Init();

// Page main
$tbl_target_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_target_edit = new ew_Page("tbl_target_edit");

// page properties
tbl_target_edit.PageID = "edit"; // page ID
tbl_target_edit.FormID = "ftbl_targetedit"; // form ID
var EW_PAGE_ID = tbl_target_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_target_edit.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->id_profile->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->year->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->month->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->month->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_visit"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->visit->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_visit"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->visit->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_pageview"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->pageview->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pageview"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->pageview->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_alexarank"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->alexarank->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_alexarank"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->alexarank->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_googlepagerank"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->googlepagerank->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_googlepagerank"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->googlepagerank->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_googleindexedpage"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->googleindexedpage->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_googleindexedpage"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->googleindexedpage->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_yahooindexedpage"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->yahooindexedpage->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_yahooindexedpage"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->yahooindexedpage->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_bingindexedpage"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->bingindexedpage->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_bingindexedpage"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->bingindexedpage->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_twitterfollower"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->twitterfollower->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_twitterfollower"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->twitterfollower->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_facebookfan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->facebookfan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_facebookfan"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->facebookfan->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_yahoobacklink"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->yahoobacklink->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_yahoobacklink"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->yahoobacklink->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_blwbacklink"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->blwbacklink->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_blwbacklink"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->blwbacklink->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_blcbacklink"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->blcbacklink->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_blcbacklink"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->blcbacklink->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_target_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_target_edit.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_target_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_target_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_target_edit.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_target_edit.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_target->TableCaption() ?><br><br>
<a href="<?php echo $tbl_target->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_target_edit->ShowMessage();
?>
<form name="ftbl_targetedit" id="ftbl_targetedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_target_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="tbl_target">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_target->id_profile->Visible) { // id_profile ?>
	<tr<?php echo $tbl_target->id_profile->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->id_profile->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_target->id_profile->CellAttributes() ?>><span id="el_id_profile">
<div<?php echo $tbl_target->id_profile->ViewAttributes() ?>><?php echo $tbl_target->id_profile->EditValue ?></div><input type="hidden" name="x_id_profile" id="x_id_profile" value="<?php echo ew_HtmlEncode($tbl_target->id_profile->CurrentValue) ?>">
</span><?php echo $tbl_target->id_profile->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->year->Visible) { // year ?>
	<tr<?php echo $tbl_target->year->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->year->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_target->year->CellAttributes() ?>><span id="el_year">
<div<?php echo $tbl_target->year->ViewAttributes() ?>><?php echo $tbl_target->year->EditValue ?></div><input type="hidden" name="x_year" id="x_year" value="<?php echo ew_HtmlEncode($tbl_target->year->CurrentValue) ?>">
</span><?php echo $tbl_target->year->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->month->Visible) { // month ?>
	<tr<?php echo $tbl_target->month->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->month->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_target->month->CellAttributes() ?>><span id="el_month">
<div<?php echo $tbl_target->month->ViewAttributes() ?>><?php echo $tbl_target->month->EditValue ?></div><input type="hidden" name="x_month" id="x_month" value="<?php echo ew_HtmlEncode($tbl_target->month->CurrentValue) ?>">
</span><?php echo $tbl_target->month->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->visit->Visible) { // visit ?>
	<tr<?php echo $tbl_target->visit->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->visit->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_target->visit->CellAttributes() ?>><span id="el_visit">
<input type="text" name="x_visit" id="x_visit" title="<?php echo $tbl_target->visit->FldTitle() ?>" size="30" value="<?php echo $tbl_target->visit->EditValue ?>"<?php echo $tbl_target->visit->EditAttributes() ?>>
</span><?php echo $tbl_target->visit->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->pageview->Visible) { // pageview ?>
	<tr<?php echo $tbl_target->pageview->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->pageview->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_target->pageview->CellAttributes() ?>><span id="el_pageview">
<input type="text" name="x_pageview" id="x_pageview" title="<?php echo $tbl_target->pageview->FldTitle() ?>" size="30" value="<?php echo $tbl_target->pageview->EditValue ?>"<?php echo $tbl_target->pageview->EditAttributes() ?>>
</span><?php echo $tbl_target->pageview->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->alexarank->Visible) { // alexarank ?>
	<tr<?php echo $tbl_target->alexarank->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->alexarank->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_target->alexarank->CellAttributes() ?>><span id="el_alexarank">
<input type="text" name="x_alexarank" id="x_alexarank" title="<?php echo $tbl_target->alexarank->FldTitle() ?>" size="30" value="<?php echo $tbl_target->alexarank->EditValue ?>"<?php echo $tbl_target->alexarank->EditAttributes() ?>>
</span><?php echo $tbl_target->alexarank->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->googlepagerank->Visible) { // googlepagerank ?>
	<tr<?php echo $tbl_target->googlepagerank->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->googlepagerank->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_target->googlepagerank->CellAttributes() ?>><span id="el_googlepagerank">
<input type="text" name="x_googlepagerank" id="x_googlepagerank" title="<?php echo $tbl_target->googlepagerank->FldTitle() ?>" size="30" value="<?php echo $tbl_target->googlepagerank->EditValue ?>"<?php echo $tbl_target->googlepagerank->EditAttributes() ?>>
</span><?php echo $tbl_target->googlepagerank->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->googleindexedpage->Visible) { // googleindexedpage ?>
	<tr<?php echo $tbl_target->googleindexedpage->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->googleindexedpage->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_target->googleindexedpage->CellAttributes() ?>><span id="el_googleindexedpage">
<input type="text" name="x_googleindexedpage" id="x_googleindexedpage" title="<?php echo $tbl_target->googleindexedpage->FldTitle() ?>" size="30" value="<?php echo $tbl_target->googleindexedpage->EditValue ?>"<?php echo $tbl_target->googleindexedpage->EditAttributes() ?>>
</span><?php echo $tbl_target->googleindexedpage->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->yahooindexedpage->Visible) { // yahooindexedpage ?>
	<tr<?php echo $tbl_target->yahooindexedpage->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->yahooindexedpage->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_target->yahooindexedpage->CellAttributes() ?>><span id="el_yahooindexedpage">
<input type="text" name="x_yahooindexedpage" id="x_yahooindexedpage" title="<?php echo $tbl_target->yahooindexedpage->FldTitle() ?>" size="30" value="<?php echo $tbl_target->yahooindexedpage->EditValue ?>"<?php echo $tbl_target->yahooindexedpage->EditAttributes() ?>>
</span><?php echo $tbl_target->yahooindexedpage->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->bingindexedpage->Visible) { // bingindexedpage ?>
	<tr<?php echo $tbl_target->bingindexedpage->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->bingindexedpage->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_target->bingindexedpage->CellAttributes() ?>><span id="el_bingindexedpage">
<input type="text" name="x_bingindexedpage" id="x_bingindexedpage" title="<?php echo $tbl_target->bingindexedpage->FldTitle() ?>" size="30" value="<?php echo $tbl_target->bingindexedpage->EditValue ?>"<?php echo $tbl_target->bingindexedpage->EditAttributes() ?>>
</span><?php echo $tbl_target->bingindexedpage->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->twitterfollower->Visible) { // twitterfollower ?>
	<tr<?php echo $tbl_target->twitterfollower->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->twitterfollower->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_target->twitterfollower->CellAttributes() ?>><span id="el_twitterfollower">
<input type="text" name="x_twitterfollower" id="x_twitterfollower" title="<?php echo $tbl_target->twitterfollower->FldTitle() ?>" size="30" value="<?php echo $tbl_target->twitterfollower->EditValue ?>"<?php echo $tbl_target->twitterfollower->EditAttributes() ?>>
</span><?php echo $tbl_target->twitterfollower->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->facebookfan->Visible) { // facebookfan ?>
	<tr<?php echo $tbl_target->facebookfan->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->facebookfan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_target->facebookfan->CellAttributes() ?>><span id="el_facebookfan">
<input type="text" name="x_facebookfan" id="x_facebookfan" title="<?php echo $tbl_target->facebookfan->FldTitle() ?>" size="30" value="<?php echo $tbl_target->facebookfan->EditValue ?>"<?php echo $tbl_target->facebookfan->EditAttributes() ?>>
</span><?php echo $tbl_target->facebookfan->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->yahoobacklink->Visible) { // yahoobacklink ?>
	<tr<?php echo $tbl_target->yahoobacklink->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->yahoobacklink->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_target->yahoobacklink->CellAttributes() ?>><span id="el_yahoobacklink">
<input type="text" name="x_yahoobacklink" id="x_yahoobacklink" title="<?php echo $tbl_target->yahoobacklink->FldTitle() ?>" size="30" value="<?php echo $tbl_target->yahoobacklink->EditValue ?>"<?php echo $tbl_target->yahoobacklink->EditAttributes() ?>>
</span><?php echo $tbl_target->yahoobacklink->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->blwbacklink->Visible) { // blwbacklink ?>
	<tr<?php echo $tbl_target->blwbacklink->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->blwbacklink->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_target->blwbacklink->CellAttributes() ?>><span id="el_blwbacklink">
<input type="text" name="x_blwbacklink" id="x_blwbacklink" title="<?php echo $tbl_target->blwbacklink->FldTitle() ?>" size="30" value="<?php echo $tbl_target->blwbacklink->EditValue ?>"<?php echo $tbl_target->blwbacklink->EditAttributes() ?>>
</span><?php echo $tbl_target->blwbacklink->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->blcbacklink->Visible) { // blcbacklink ?>
	<tr<?php echo $tbl_target->blcbacklink->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->blcbacklink->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $tbl_target->blcbacklink->CellAttributes() ?>><span id="el_blcbacklink">
<input type="text" name="x_blcbacklink" id="x_blcbacklink" title="<?php echo $tbl_target->blcbacklink->FldTitle() ?>" size="30" value="<?php echo $tbl_target->blcbacklink->EditValue ?>"<?php echo $tbl_target->blcbacklink->EditAttributes() ?>>
</span><?php echo $tbl_target->blcbacklink->CustomMsg ?></td>
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
$tbl_target_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_target_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'tbl_target';

	// Page object name
	var $PageObjName = 'tbl_target_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_target;
		if ($tbl_target->UseTokenInUrl) $PageUrl .= "t=" . $tbl_target->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_target;
		if ($tbl_target->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_target->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_target->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_target_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_target)
		$GLOBALS["tbl_target"] = new ctbl_target();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_target', TRUE);

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
		global $tbl_target;

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
			$this->Page_Terminate("tbl_targetlist.php");
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
		global $objForm, $Language, $gsFormError, $tbl_target;

		// Load key from QueryString
		if (@$_GET["id_profile"] <> "")
			$tbl_target->id_profile->setQueryStringValue($_GET["id_profile"]);
		if (@$_GET["year"] <> "")
			$tbl_target->year->setQueryStringValue($_GET["year"]);
		if (@$_GET["month"] <> "")
			$tbl_target->month->setQueryStringValue($_GET["month"]);
		if (@$_POST["a_edit"] <> "") {
			$tbl_target->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$tbl_target->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$tbl_target->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$tbl_target->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($tbl_target->id_profile->CurrentValue == "")
			$this->Page_Terminate("tbl_targetlist.php"); // Invalid key, return to list
		if ($tbl_target->year->CurrentValue == "")
			$this->Page_Terminate("tbl_targetlist.php"); // Invalid key, return to list
		if ($tbl_target->month->CurrentValue == "")
			$this->Page_Terminate("tbl_targetlist.php"); // Invalid key, return to list
		switch ($tbl_target->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("tbl_targetlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$tbl_target->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $tbl_target->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "tbl_targetview.php")
						$sReturnUrl = $tbl_target->ViewUrl(); // View paging, return to View page directly
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$tbl_target->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$tbl_target->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $tbl_target;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_target;
		$tbl_target->id_profile->setFormValue($objForm->GetValue("x_id_profile"));
		$tbl_target->year->setFormValue($objForm->GetValue("x_year"));
		$tbl_target->month->setFormValue($objForm->GetValue("x_month"));
		$tbl_target->visit->setFormValue($objForm->GetValue("x_visit"));
		$tbl_target->pageview->setFormValue($objForm->GetValue("x_pageview"));
		$tbl_target->alexarank->setFormValue($objForm->GetValue("x_alexarank"));
		$tbl_target->googlepagerank->setFormValue($objForm->GetValue("x_googlepagerank"));
		$tbl_target->googleindexedpage->setFormValue($objForm->GetValue("x_googleindexedpage"));
		$tbl_target->yahooindexedpage->setFormValue($objForm->GetValue("x_yahooindexedpage"));
		$tbl_target->bingindexedpage->setFormValue($objForm->GetValue("x_bingindexedpage"));
		$tbl_target->twitterfollower->setFormValue($objForm->GetValue("x_twitterfollower"));
		$tbl_target->facebookfan->setFormValue($objForm->GetValue("x_facebookfan"));
		$tbl_target->yahoobacklink->setFormValue($objForm->GetValue("x_yahoobacklink"));
		$tbl_target->blwbacklink->setFormValue($objForm->GetValue("x_blwbacklink"));
		$tbl_target->blcbacklink->setFormValue($objForm->GetValue("x_blcbacklink"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_target;
		$this->LoadRow();
		$tbl_target->id_profile->CurrentValue = $tbl_target->id_profile->FormValue;
		$tbl_target->year->CurrentValue = $tbl_target->year->FormValue;
		$tbl_target->month->CurrentValue = $tbl_target->month->FormValue;
		$tbl_target->visit->CurrentValue = $tbl_target->visit->FormValue;
		$tbl_target->pageview->CurrentValue = $tbl_target->pageview->FormValue;
		$tbl_target->alexarank->CurrentValue = $tbl_target->alexarank->FormValue;
		$tbl_target->googlepagerank->CurrentValue = $tbl_target->googlepagerank->FormValue;
		$tbl_target->googleindexedpage->CurrentValue = $tbl_target->googleindexedpage->FormValue;
		$tbl_target->yahooindexedpage->CurrentValue = $tbl_target->yahooindexedpage->FormValue;
		$tbl_target->bingindexedpage->CurrentValue = $tbl_target->bingindexedpage->FormValue;
		$tbl_target->twitterfollower->CurrentValue = $tbl_target->twitterfollower->FormValue;
		$tbl_target->facebookfan->CurrentValue = $tbl_target->facebookfan->FormValue;
		$tbl_target->yahoobacklink->CurrentValue = $tbl_target->yahoobacklink->FormValue;
		$tbl_target->blwbacklink->CurrentValue = $tbl_target->blwbacklink->FormValue;
		$tbl_target->blcbacklink->CurrentValue = $tbl_target->blcbacklink->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_target;
		$sFilter = $tbl_target->KeyFilter();

		// Call Row Selecting event
		$tbl_target->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_target->CurrentFilter = $sFilter;
		$sSql = $tbl_target->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_target->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_target;
		$tbl_target->id_profile->setDbValue($rs->fields('id_profile'));
		$tbl_target->year->setDbValue($rs->fields('year'));
		$tbl_target->month->setDbValue($rs->fields('month'));
		$tbl_target->visit->setDbValue($rs->fields('visit'));
		$tbl_target->pageview->setDbValue($rs->fields('pageview'));
		$tbl_target->alexarank->setDbValue($rs->fields('alexarank'));
		$tbl_target->googlepagerank->setDbValue($rs->fields('googlepagerank'));
		$tbl_target->googleindexedpage->setDbValue($rs->fields('googleindexedpage'));
		$tbl_target->yahooindexedpage->setDbValue($rs->fields('yahooindexedpage'));
		$tbl_target->bingindexedpage->setDbValue($rs->fields('bingindexedpage'));
		$tbl_target->twitterfollower->setDbValue($rs->fields('twitterfollower'));
		$tbl_target->facebookfan->setDbValue($rs->fields('facebookfan'));
		$tbl_target->yahoobacklink->setDbValue($rs->fields('yahoobacklink'));
		$tbl_target->blwbacklink->setDbValue($rs->fields('blwbacklink'));
		$tbl_target->blcbacklink->setDbValue($rs->fields('blcbacklink'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_target;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_target->Row_Rendering();

		// Common render codes for all row types
		// id_profile

		$tbl_target->id_profile->CellCssStyle = ""; $tbl_target->id_profile->CellCssClass = "";
		$tbl_target->id_profile->CellAttrs = array(); $tbl_target->id_profile->ViewAttrs = array(); $tbl_target->id_profile->EditAttrs = array();

		// year
		$tbl_target->year->CellCssStyle = ""; $tbl_target->year->CellCssClass = "";
		$tbl_target->year->CellAttrs = array(); $tbl_target->year->ViewAttrs = array(); $tbl_target->year->EditAttrs = array();

		// month
		$tbl_target->month->CellCssStyle = ""; $tbl_target->month->CellCssClass = "";
		$tbl_target->month->CellAttrs = array(); $tbl_target->month->ViewAttrs = array(); $tbl_target->month->EditAttrs = array();

		// visit
		$tbl_target->visit->CellCssStyle = ""; $tbl_target->visit->CellCssClass = "";
		$tbl_target->visit->CellAttrs = array(); $tbl_target->visit->ViewAttrs = array(); $tbl_target->visit->EditAttrs = array();

		// pageview
		$tbl_target->pageview->CellCssStyle = ""; $tbl_target->pageview->CellCssClass = "";
		$tbl_target->pageview->CellAttrs = array(); $tbl_target->pageview->ViewAttrs = array(); $tbl_target->pageview->EditAttrs = array();

		// alexarank
		$tbl_target->alexarank->CellCssStyle = ""; $tbl_target->alexarank->CellCssClass = "";
		$tbl_target->alexarank->CellAttrs = array(); $tbl_target->alexarank->ViewAttrs = array(); $tbl_target->alexarank->EditAttrs = array();

		// googlepagerank
		$tbl_target->googlepagerank->CellCssStyle = ""; $tbl_target->googlepagerank->CellCssClass = "";
		$tbl_target->googlepagerank->CellAttrs = array(); $tbl_target->googlepagerank->ViewAttrs = array(); $tbl_target->googlepagerank->EditAttrs = array();

		// googleindexedpage
		$tbl_target->googleindexedpage->CellCssStyle = ""; $tbl_target->googleindexedpage->CellCssClass = "";
		$tbl_target->googleindexedpage->CellAttrs = array(); $tbl_target->googleindexedpage->ViewAttrs = array(); $tbl_target->googleindexedpage->EditAttrs = array();

		// yahooindexedpage
		$tbl_target->yahooindexedpage->CellCssStyle = ""; $tbl_target->yahooindexedpage->CellCssClass = "";
		$tbl_target->yahooindexedpage->CellAttrs = array(); $tbl_target->yahooindexedpage->ViewAttrs = array(); $tbl_target->yahooindexedpage->EditAttrs = array();

		// bingindexedpage
		$tbl_target->bingindexedpage->CellCssStyle = ""; $tbl_target->bingindexedpage->CellCssClass = "";
		$tbl_target->bingindexedpage->CellAttrs = array(); $tbl_target->bingindexedpage->ViewAttrs = array(); $tbl_target->bingindexedpage->EditAttrs = array();

		// twitterfollower
		$tbl_target->twitterfollower->CellCssStyle = ""; $tbl_target->twitterfollower->CellCssClass = "";
		$tbl_target->twitterfollower->CellAttrs = array(); $tbl_target->twitterfollower->ViewAttrs = array(); $tbl_target->twitterfollower->EditAttrs = array();

		// facebookfan
		$tbl_target->facebookfan->CellCssStyle = ""; $tbl_target->facebookfan->CellCssClass = "";
		$tbl_target->facebookfan->CellAttrs = array(); $tbl_target->facebookfan->ViewAttrs = array(); $tbl_target->facebookfan->EditAttrs = array();

		// yahoobacklink
		$tbl_target->yahoobacklink->CellCssStyle = ""; $tbl_target->yahoobacklink->CellCssClass = "";
		$tbl_target->yahoobacklink->CellAttrs = array(); $tbl_target->yahoobacklink->ViewAttrs = array(); $tbl_target->yahoobacklink->EditAttrs = array();

		// blwbacklink
		$tbl_target->blwbacklink->CellCssStyle = ""; $tbl_target->blwbacklink->CellCssClass = "";
		$tbl_target->blwbacklink->CellAttrs = array(); $tbl_target->blwbacklink->ViewAttrs = array(); $tbl_target->blwbacklink->EditAttrs = array();

		// blcbacklink
		$tbl_target->blcbacklink->CellCssStyle = ""; $tbl_target->blcbacklink->CellCssClass = "";
		$tbl_target->blcbacklink->CellAttrs = array(); $tbl_target->blcbacklink->ViewAttrs = array(); $tbl_target->blcbacklink->EditAttrs = array();
		if ($tbl_target->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_profile
			if (strval($tbl_target->id_profile->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_target->id_profile->CurrentValue) . "";
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
					$tbl_target->id_profile->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_target->id_profile->ViewValue = $tbl_target->id_profile->CurrentValue;
				}
			} else {
				$tbl_target->id_profile->ViewValue = NULL;
			}
			$tbl_target->id_profile->CssStyle = "";
			$tbl_target->id_profile->CssClass = "";
			$tbl_target->id_profile->ViewCustomAttributes = "";

			// year
			$tbl_target->year->ViewValue = $tbl_target->year->CurrentValue;
			$tbl_target->year->CssStyle = "";
			$tbl_target->year->CssClass = "";
			$tbl_target->year->ViewCustomAttributes = "";

			// month
			$tbl_target->month->ViewValue = $tbl_target->month->CurrentValue;
			$tbl_target->month->CssStyle = "";
			$tbl_target->month->CssClass = "";
			$tbl_target->month->ViewCustomAttributes = "";

			// visit
			$tbl_target->visit->ViewValue = $tbl_target->visit->CurrentValue;
			$tbl_target->visit->CssStyle = "";
			$tbl_target->visit->CssClass = "";
			$tbl_target->visit->ViewCustomAttributes = "";

			// pageview
			$tbl_target->pageview->ViewValue = $tbl_target->pageview->CurrentValue;
			$tbl_target->pageview->CssStyle = "";
			$tbl_target->pageview->CssClass = "";
			$tbl_target->pageview->ViewCustomAttributes = "";

			// alexarank
			$tbl_target->alexarank->ViewValue = $tbl_target->alexarank->CurrentValue;
			$tbl_target->alexarank->CssStyle = "";
			$tbl_target->alexarank->CssClass = "";
			$tbl_target->alexarank->ViewCustomAttributes = "";

			// googlepagerank
			$tbl_target->googlepagerank->ViewValue = $tbl_target->googlepagerank->CurrentValue;
			$tbl_target->googlepagerank->CssStyle = "";
			$tbl_target->googlepagerank->CssClass = "";
			$tbl_target->googlepagerank->ViewCustomAttributes = "";

			// googleindexedpage
			$tbl_target->googleindexedpage->ViewValue = $tbl_target->googleindexedpage->CurrentValue;
			$tbl_target->googleindexedpage->CssStyle = "";
			$tbl_target->googleindexedpage->CssClass = "";
			$tbl_target->googleindexedpage->ViewCustomAttributes = "";

			// yahooindexedpage
			$tbl_target->yahooindexedpage->ViewValue = $tbl_target->yahooindexedpage->CurrentValue;
			$tbl_target->yahooindexedpage->CssStyle = "";
			$tbl_target->yahooindexedpage->CssClass = "";
			$tbl_target->yahooindexedpage->ViewCustomAttributes = "";

			// bingindexedpage
			$tbl_target->bingindexedpage->ViewValue = $tbl_target->bingindexedpage->CurrentValue;
			$tbl_target->bingindexedpage->CssStyle = "";
			$tbl_target->bingindexedpage->CssClass = "";
			$tbl_target->bingindexedpage->ViewCustomAttributes = "";

			// twitterfollower
			$tbl_target->twitterfollower->ViewValue = $tbl_target->twitterfollower->CurrentValue;
			$tbl_target->twitterfollower->CssStyle = "";
			$tbl_target->twitterfollower->CssClass = "";
			$tbl_target->twitterfollower->ViewCustomAttributes = "";

			// facebookfan
			$tbl_target->facebookfan->ViewValue = $tbl_target->facebookfan->CurrentValue;
			$tbl_target->facebookfan->CssStyle = "";
			$tbl_target->facebookfan->CssClass = "";
			$tbl_target->facebookfan->ViewCustomAttributes = "";

			// yahoobacklink
			$tbl_target->yahoobacklink->ViewValue = $tbl_target->yahoobacklink->CurrentValue;
			$tbl_target->yahoobacklink->CssStyle = "";
			$tbl_target->yahoobacklink->CssClass = "";
			$tbl_target->yahoobacklink->ViewCustomAttributes = "";

			// blwbacklink
			$tbl_target->blwbacklink->ViewValue = $tbl_target->blwbacklink->CurrentValue;
			$tbl_target->blwbacklink->CssStyle = "";
			$tbl_target->blwbacklink->CssClass = "";
			$tbl_target->blwbacklink->ViewCustomAttributes = "";

			// blcbacklink
			$tbl_target->blcbacklink->ViewValue = $tbl_target->blcbacklink->CurrentValue;
			$tbl_target->blcbacklink->CssStyle = "";
			$tbl_target->blcbacklink->CssClass = "";
			$tbl_target->blcbacklink->ViewCustomAttributes = "";

			// id_profile
			$tbl_target->id_profile->HrefValue = "";
			$tbl_target->id_profile->TooltipValue = "";

			// year
			$tbl_target->year->HrefValue = "";
			$tbl_target->year->TooltipValue = "";

			// month
			$tbl_target->month->HrefValue = "";
			$tbl_target->month->TooltipValue = "";

			// visit
			$tbl_target->visit->HrefValue = "";
			$tbl_target->visit->TooltipValue = "";

			// pageview
			$tbl_target->pageview->HrefValue = "";
			$tbl_target->pageview->TooltipValue = "";

			// alexarank
			$tbl_target->alexarank->HrefValue = "";
			$tbl_target->alexarank->TooltipValue = "";

			// googlepagerank
			$tbl_target->googlepagerank->HrefValue = "";
			$tbl_target->googlepagerank->TooltipValue = "";

			// googleindexedpage
			$tbl_target->googleindexedpage->HrefValue = "";
			$tbl_target->googleindexedpage->TooltipValue = "";

			// yahooindexedpage
			$tbl_target->yahooindexedpage->HrefValue = "";
			$tbl_target->yahooindexedpage->TooltipValue = "";

			// bingindexedpage
			$tbl_target->bingindexedpage->HrefValue = "";
			$tbl_target->bingindexedpage->TooltipValue = "";

			// twitterfollower
			$tbl_target->twitterfollower->HrefValue = "";
			$tbl_target->twitterfollower->TooltipValue = "";

			// facebookfan
			$tbl_target->facebookfan->HrefValue = "";
			$tbl_target->facebookfan->TooltipValue = "";

			// yahoobacklink
			$tbl_target->yahoobacklink->HrefValue = "";
			$tbl_target->yahoobacklink->TooltipValue = "";

			// blwbacklink
			$tbl_target->blwbacklink->HrefValue = "";
			$tbl_target->blwbacklink->TooltipValue = "";

			// blcbacklink
			$tbl_target->blcbacklink->HrefValue = "";
			$tbl_target->blcbacklink->TooltipValue = "";
		} elseif ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_profile
			$tbl_target->id_profile->EditCustomAttributes = "";
			if (strval($tbl_target->id_profile->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_target->id_profile->CurrentValue) . "";
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
					$tbl_target->id_profile->EditValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_target->id_profile->EditValue = $tbl_target->id_profile->CurrentValue;
				}
			} else {
				$tbl_target->id_profile->EditValue = NULL;
			}
			$tbl_target->id_profile->CssStyle = "";
			$tbl_target->id_profile->CssClass = "";
			$tbl_target->id_profile->ViewCustomAttributes = "";

			// year
			$tbl_target->year->EditCustomAttributes = "";
			$tbl_target->year->EditValue = $tbl_target->year->CurrentValue;
			$tbl_target->year->CssStyle = "";
			$tbl_target->year->CssClass = "";
			$tbl_target->year->ViewCustomAttributes = "";

			// month
			$tbl_target->month->EditCustomAttributes = "";
			$tbl_target->month->EditValue = $tbl_target->month->CurrentValue;
			$tbl_target->month->CssStyle = "";
			$tbl_target->month->CssClass = "";
			$tbl_target->month->ViewCustomAttributes = "";

			// visit
			$tbl_target->visit->EditCustomAttributes = "";
			$tbl_target->visit->EditValue = ew_HtmlEncode($tbl_target->visit->CurrentValue);

			// pageview
			$tbl_target->pageview->EditCustomAttributes = "";
			$tbl_target->pageview->EditValue = ew_HtmlEncode($tbl_target->pageview->CurrentValue);

			// alexarank
			$tbl_target->alexarank->EditCustomAttributes = "";
			$tbl_target->alexarank->EditValue = ew_HtmlEncode($tbl_target->alexarank->CurrentValue);

			// googlepagerank
			$tbl_target->googlepagerank->EditCustomAttributes = "";
			$tbl_target->googlepagerank->EditValue = ew_HtmlEncode($tbl_target->googlepagerank->CurrentValue);

			// googleindexedpage
			$tbl_target->googleindexedpage->EditCustomAttributes = "";
			$tbl_target->googleindexedpage->EditValue = ew_HtmlEncode($tbl_target->googleindexedpage->CurrentValue);

			// yahooindexedpage
			$tbl_target->yahooindexedpage->EditCustomAttributes = "";
			$tbl_target->yahooindexedpage->EditValue = ew_HtmlEncode($tbl_target->yahooindexedpage->CurrentValue);

			// bingindexedpage
			$tbl_target->bingindexedpage->EditCustomAttributes = "";
			$tbl_target->bingindexedpage->EditValue = ew_HtmlEncode($tbl_target->bingindexedpage->CurrentValue);

			// twitterfollower
			$tbl_target->twitterfollower->EditCustomAttributes = "";
			$tbl_target->twitterfollower->EditValue = ew_HtmlEncode($tbl_target->twitterfollower->CurrentValue);

			// facebookfan
			$tbl_target->facebookfan->EditCustomAttributes = "";
			$tbl_target->facebookfan->EditValue = ew_HtmlEncode($tbl_target->facebookfan->CurrentValue);

			// yahoobacklink
			$tbl_target->yahoobacklink->EditCustomAttributes = "";
			$tbl_target->yahoobacklink->EditValue = ew_HtmlEncode($tbl_target->yahoobacklink->CurrentValue);

			// blwbacklink
			$tbl_target->blwbacklink->EditCustomAttributes = "";
			$tbl_target->blwbacklink->EditValue = ew_HtmlEncode($tbl_target->blwbacklink->CurrentValue);

			// blcbacklink
			$tbl_target->blcbacklink->EditCustomAttributes = "";
			$tbl_target->blcbacklink->EditValue = ew_HtmlEncode($tbl_target->blcbacklink->CurrentValue);

			// Edit refer script
			// id_profile

			$tbl_target->id_profile->HrefValue = "";

			// year
			$tbl_target->year->HrefValue = "";

			// month
			$tbl_target->month->HrefValue = "";

			// visit
			$tbl_target->visit->HrefValue = "";

			// pageview
			$tbl_target->pageview->HrefValue = "";

			// alexarank
			$tbl_target->alexarank->HrefValue = "";

			// googlepagerank
			$tbl_target->googlepagerank->HrefValue = "";

			// googleindexedpage
			$tbl_target->googleindexedpage->HrefValue = "";

			// yahooindexedpage
			$tbl_target->yahooindexedpage->HrefValue = "";

			// bingindexedpage
			$tbl_target->bingindexedpage->HrefValue = "";

			// twitterfollower
			$tbl_target->twitterfollower->HrefValue = "";

			// facebookfan
			$tbl_target->facebookfan->HrefValue = "";

			// yahoobacklink
			$tbl_target->yahoobacklink->HrefValue = "";

			// blwbacklink
			$tbl_target->blwbacklink->HrefValue = "";

			// blcbacklink
			$tbl_target->blcbacklink->HrefValue = "";
		}

		// Call Row Rendered event
		if ($tbl_target->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_target->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_target;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_target->id_profile->FormValue) && $tbl_target->id_profile->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->id_profile->FldCaption();
		}
		if (!is_null($tbl_target->year->FormValue) && $tbl_target->year->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->year->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->year->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->year->FldErrMsg();
		}
		if (!is_null($tbl_target->month->FormValue) && $tbl_target->month->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->month->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->month->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->month->FldErrMsg();
		}
		if (!is_null($tbl_target->visit->FormValue) && $tbl_target->visit->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->visit->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->visit->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->visit->FldErrMsg();
		}
		if (!is_null($tbl_target->pageview->FormValue) && $tbl_target->pageview->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->pageview->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->pageview->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->pageview->FldErrMsg();
		}
		if (!is_null($tbl_target->alexarank->FormValue) && $tbl_target->alexarank->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->alexarank->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->alexarank->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->alexarank->FldErrMsg();
		}
		if (!is_null($tbl_target->googlepagerank->FormValue) && $tbl_target->googlepagerank->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->googlepagerank->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->googlepagerank->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->googlepagerank->FldErrMsg();
		}
		if (!is_null($tbl_target->googleindexedpage->FormValue) && $tbl_target->googleindexedpage->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->googleindexedpage->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->googleindexedpage->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->googleindexedpage->FldErrMsg();
		}
		if (!is_null($tbl_target->yahooindexedpage->FormValue) && $tbl_target->yahooindexedpage->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->yahooindexedpage->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->yahooindexedpage->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->yahooindexedpage->FldErrMsg();
		}
		if (!is_null($tbl_target->bingindexedpage->FormValue) && $tbl_target->bingindexedpage->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->bingindexedpage->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->bingindexedpage->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->bingindexedpage->FldErrMsg();
		}
		if (!is_null($tbl_target->twitterfollower->FormValue) && $tbl_target->twitterfollower->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->twitterfollower->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->twitterfollower->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->twitterfollower->FldErrMsg();
		}
		if (!is_null($tbl_target->facebookfan->FormValue) && $tbl_target->facebookfan->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->facebookfan->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->facebookfan->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->facebookfan->FldErrMsg();
		}
		if (!is_null($tbl_target->yahoobacklink->FormValue) && $tbl_target->yahoobacklink->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->yahoobacklink->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->yahoobacklink->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->yahoobacklink->FldErrMsg();
		}
		if (!is_null($tbl_target->blwbacklink->FormValue) && $tbl_target->blwbacklink->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->blwbacklink->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->blwbacklink->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->blwbacklink->FldErrMsg();
		}
		if (!is_null($tbl_target->blcbacklink->FormValue) && $tbl_target->blcbacklink->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->blcbacklink->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->blcbacklink->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->blcbacklink->FldErrMsg();
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
		global $conn, $Security, $Language, $tbl_target;
		$sFilter = $tbl_target->KeyFilter();
		$tbl_target->CurrentFilter = $sFilter;
		$sSql = $tbl_target->SQL();
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
			// year
			// month
			// visit

			$tbl_target->visit->SetDbValueDef($rsnew, $tbl_target->visit->CurrentValue, 0, FALSE);

			// pageview
			$tbl_target->pageview->SetDbValueDef($rsnew, $tbl_target->pageview->CurrentValue, 0, FALSE);

			// alexarank
			$tbl_target->alexarank->SetDbValueDef($rsnew, $tbl_target->alexarank->CurrentValue, 0, FALSE);

			// googlepagerank
			$tbl_target->googlepagerank->SetDbValueDef($rsnew, $tbl_target->googlepagerank->CurrentValue, 0, FALSE);

			// googleindexedpage
			$tbl_target->googleindexedpage->SetDbValueDef($rsnew, $tbl_target->googleindexedpage->CurrentValue, 0, FALSE);

			// yahooindexedpage
			$tbl_target->yahooindexedpage->SetDbValueDef($rsnew, $tbl_target->yahooindexedpage->CurrentValue, 0, FALSE);

			// bingindexedpage
			$tbl_target->bingindexedpage->SetDbValueDef($rsnew, $tbl_target->bingindexedpage->CurrentValue, 0, FALSE);

			// twitterfollower
			$tbl_target->twitterfollower->SetDbValueDef($rsnew, $tbl_target->twitterfollower->CurrentValue, 0, FALSE);

			// facebookfan
			$tbl_target->facebookfan->SetDbValueDef($rsnew, $tbl_target->facebookfan->CurrentValue, 0, FALSE);

			// yahoobacklink
			$tbl_target->yahoobacklink->SetDbValueDef($rsnew, $tbl_target->yahoobacklink->CurrentValue, 0, FALSE);

			// blwbacklink
			$tbl_target->blwbacklink->SetDbValueDef($rsnew, $tbl_target->blwbacklink->CurrentValue, 0, FALSE);

			// blcbacklink
			$tbl_target->blcbacklink->SetDbValueDef($rsnew, $tbl_target->blcbacklink->CurrentValue, 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $tbl_target->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_target->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_target->CancelMessage <> "") {
					$this->setMessage($tbl_target->CancelMessage);
					$tbl_target->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_target->Row_Updated($rsold, $rsnew);
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
