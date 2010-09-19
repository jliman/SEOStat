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
$tbl_target_search = new ctbl_target_search();
$Page =& $tbl_target_search;

// Page init
$tbl_target_search->Page_Init();

// Page main
$tbl_target_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_target_search = new ew_Page("tbl_target_search");

// page properties
tbl_target_search.PageID = "search"; // page ID
tbl_target_search.FormID = "ftbl_targetsearch"; // form ID
var EW_PAGE_ID = tbl_target_search.PageID; // for backward compatibility

// extend page with validate function for search
tbl_target_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->month->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_visit"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->visit->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_pageview"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->pageview->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_alexarank"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->alexarank->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_googlepagerank"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->googlepagerank->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_googleindexedpage"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->googleindexedpage->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_yahooindexedpage"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->yahooindexedpage->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_bingindexedpage"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->bingindexedpage->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_twitterfollower"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->twitterfollower->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_facebookfan"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->facebookfan->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_yahoobacklink"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->yahoobacklink->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_blwbacklink"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->blwbacklink->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_blcbacklink"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->blcbacklink->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj))
			return false;
	}
	for (var i=0; i<fobj.elements.length; i++) {
		var elem = fobj.elements[i];
		if (elem.name.substring(0,2) == "s_" || elem.name.substring(0,3) == "sv_")
			elem.value = "";
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_target_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_target_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_target_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_target_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_target_search.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_target_search.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_target->TableCaption() ?><br><br>
<a href="<?php echo $tbl_target->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_target_search->ShowMessage();
?>
<form name="ftbl_targetsearch" id="ftbl_targetsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_target_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="tbl_target">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $tbl_target->id_profile->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->id_profile->FldCaption() ?></td>
		<td<?php echo $tbl_target->id_profile->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id_profile" id="z_id_profile" value="="></span></td>
		<td<?php echo $tbl_target->id_profile->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_id_profile" name="x_id_profile" title="<?php echo $tbl_target->id_profile->FldTitle() ?>"<?php echo $tbl_target->id_profile->EditAttributes() ?>>
<?php
if (is_array($tbl_target->id_profile->EditValue)) {
	$arwrk = $tbl_target->id_profile->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_target->id_profile->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_target->year->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->year->FldCaption() ?></td>
		<td<?php echo $tbl_target->year->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_year" id="z_year" value="="></span></td>
		<td<?php echo $tbl_target->year->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_year" id="x_year" title="<?php echo $tbl_target->year->FldTitle() ?>" size="30" value="<?php echo $tbl_target->year->EditValue ?>"<?php echo $tbl_target->year->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_target->month->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->month->FldCaption() ?></td>
		<td<?php echo $tbl_target->month->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_month" id="z_month" value="="></span></td>
		<td<?php echo $tbl_target->month->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_month" id="x_month" title="<?php echo $tbl_target->month->FldTitle() ?>" size="30" value="<?php echo $tbl_target->month->EditValue ?>"<?php echo $tbl_target->month->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_target->visit->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->visit->FldCaption() ?></td>
		<td<?php echo $tbl_target->visit->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_visit" id="z_visit" value="="></span></td>
		<td<?php echo $tbl_target->visit->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_visit" id="x_visit" title="<?php echo $tbl_target->visit->FldTitle() ?>" size="30" value="<?php echo $tbl_target->visit->EditValue ?>"<?php echo $tbl_target->visit->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_target->pageview->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->pageview->FldCaption() ?></td>
		<td<?php echo $tbl_target->pageview->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_pageview" id="z_pageview" value="="></span></td>
		<td<?php echo $tbl_target->pageview->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_pageview" id="x_pageview" title="<?php echo $tbl_target->pageview->FldTitle() ?>" size="30" value="<?php echo $tbl_target->pageview->EditValue ?>"<?php echo $tbl_target->pageview->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_target->alexarank->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->alexarank->FldCaption() ?></td>
		<td<?php echo $tbl_target->alexarank->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_alexarank" id="z_alexarank" value="="></span></td>
		<td<?php echo $tbl_target->alexarank->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_alexarank" id="x_alexarank" title="<?php echo $tbl_target->alexarank->FldTitle() ?>" size="30" value="<?php echo $tbl_target->alexarank->EditValue ?>"<?php echo $tbl_target->alexarank->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_target->googlepagerank->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->googlepagerank->FldCaption() ?></td>
		<td<?php echo $tbl_target->googlepagerank->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_googlepagerank" id="z_googlepagerank" value="="></span></td>
		<td<?php echo $tbl_target->googlepagerank->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_googlepagerank" id="x_googlepagerank" title="<?php echo $tbl_target->googlepagerank->FldTitle() ?>" size="30" value="<?php echo $tbl_target->googlepagerank->EditValue ?>"<?php echo $tbl_target->googlepagerank->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_target->googleindexedpage->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->googleindexedpage->FldCaption() ?></td>
		<td<?php echo $tbl_target->googleindexedpage->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_googleindexedpage" id="z_googleindexedpage" value="="></span></td>
		<td<?php echo $tbl_target->googleindexedpage->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_googleindexedpage" id="x_googleindexedpage" title="<?php echo $tbl_target->googleindexedpage->FldTitle() ?>" size="30" value="<?php echo $tbl_target->googleindexedpage->EditValue ?>"<?php echo $tbl_target->googleindexedpage->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_target->yahooindexedpage->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->yahooindexedpage->FldCaption() ?></td>
		<td<?php echo $tbl_target->yahooindexedpage->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_yahooindexedpage" id="z_yahooindexedpage" value="="></span></td>
		<td<?php echo $tbl_target->yahooindexedpage->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_yahooindexedpage" id="x_yahooindexedpage" title="<?php echo $tbl_target->yahooindexedpage->FldTitle() ?>" size="30" value="<?php echo $tbl_target->yahooindexedpage->EditValue ?>"<?php echo $tbl_target->yahooindexedpage->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_target->bingindexedpage->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->bingindexedpage->FldCaption() ?></td>
		<td<?php echo $tbl_target->bingindexedpage->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_bingindexedpage" id="z_bingindexedpage" value="="></span></td>
		<td<?php echo $tbl_target->bingindexedpage->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_bingindexedpage" id="x_bingindexedpage" title="<?php echo $tbl_target->bingindexedpage->FldTitle() ?>" size="30" value="<?php echo $tbl_target->bingindexedpage->EditValue ?>"<?php echo $tbl_target->bingindexedpage->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_target->twitterfollower->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->twitterfollower->FldCaption() ?></td>
		<td<?php echo $tbl_target->twitterfollower->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_twitterfollower" id="z_twitterfollower" value="="></span></td>
		<td<?php echo $tbl_target->twitterfollower->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_twitterfollower" id="x_twitterfollower" title="<?php echo $tbl_target->twitterfollower->FldTitle() ?>" size="30" value="<?php echo $tbl_target->twitterfollower->EditValue ?>"<?php echo $tbl_target->twitterfollower->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_target->facebookfan->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->facebookfan->FldCaption() ?></td>
		<td<?php echo $tbl_target->facebookfan->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_facebookfan" id="z_facebookfan" value="="></span></td>
		<td<?php echo $tbl_target->facebookfan->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_facebookfan" id="x_facebookfan" title="<?php echo $tbl_target->facebookfan->FldTitle() ?>" size="30" value="<?php echo $tbl_target->facebookfan->EditValue ?>"<?php echo $tbl_target->facebookfan->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_target->yahoobacklink->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->yahoobacklink->FldCaption() ?></td>
		<td<?php echo $tbl_target->yahoobacklink->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_yahoobacklink" id="z_yahoobacklink" value="="></span></td>
		<td<?php echo $tbl_target->yahoobacklink->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_yahoobacklink" id="x_yahoobacklink" title="<?php echo $tbl_target->yahoobacklink->FldTitle() ?>" size="30" value="<?php echo $tbl_target->yahoobacklink->EditValue ?>"<?php echo $tbl_target->yahoobacklink->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_target->blwbacklink->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->blwbacklink->FldCaption() ?></td>
		<td<?php echo $tbl_target->blwbacklink->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_blwbacklink" id="z_blwbacklink" value="="></span></td>
		<td<?php echo $tbl_target->blwbacklink->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_blwbacklink" id="x_blwbacklink" title="<?php echo $tbl_target->blwbacklink->FldTitle() ?>" size="30" value="<?php echo $tbl_target->blwbacklink->EditValue ?>"<?php echo $tbl_target->blwbacklink->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_target->blcbacklink->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->blcbacklink->FldCaption() ?></td>
		<td<?php echo $tbl_target->blcbacklink->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_blcbacklink" id="z_blcbacklink" value="="></span></td>
		<td<?php echo $tbl_target->blcbacklink->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_blcbacklink" id="x_blcbacklink" title="<?php echo $tbl_target->blcbacklink->FldTitle() ?>" size="30" value="<?php echo $tbl_target->blcbacklink->EditValue ?>"<?php echo $tbl_target->blcbacklink->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("Search")) ?>">
<input type="button" name="Reset" id="Reset" value="<?php echo ew_BtnCaption($Language->Phrase("Reset")) ?>" onclick="ew_ClearForm(this.form);">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$tbl_target_search->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_target_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'tbl_target';

	// Page object name
	var $PageObjName = 'tbl_target_search';

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
	function ctbl_target_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_target)
		$GLOBALS["tbl_target"] = new ctbl_target();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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
		if (!$Security->CanSearch()) {
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $tbl_target;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$tbl_target->CurrentAction = $objForm->GetValue("a_search");
			switch ($tbl_target->CurrentAction) {
				case "S": // Get search criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $tbl_target->UrlParm($sSrchStr);
						$this->Page_Terminate("tbl_targetlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$tbl_target->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $tbl_target;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $tbl_target->id_profile); // id_profile
	$this->BuildSearchUrl($sSrchUrl, $tbl_target->year); // year
	$this->BuildSearchUrl($sSrchUrl, $tbl_target->month); // month
	$this->BuildSearchUrl($sSrchUrl, $tbl_target->visit); // visit
	$this->BuildSearchUrl($sSrchUrl, $tbl_target->pageview); // pageview
	$this->BuildSearchUrl($sSrchUrl, $tbl_target->alexarank); // alexarank
	$this->BuildSearchUrl($sSrchUrl, $tbl_target->googlepagerank); // googlepagerank
	$this->BuildSearchUrl($sSrchUrl, $tbl_target->googleindexedpage); // googleindexedpage
	$this->BuildSearchUrl($sSrchUrl, $tbl_target->yahooindexedpage); // yahooindexedpage
	$this->BuildSearchUrl($sSrchUrl, $tbl_target->bingindexedpage); // bingindexedpage
	$this->BuildSearchUrl($sSrchUrl, $tbl_target->twitterfollower); // twitterfollower
	$this->BuildSearchUrl($sSrchUrl, $tbl_target->facebookfan); // facebookfan
	$this->BuildSearchUrl($sSrchUrl, $tbl_target->yahoobacklink); // yahoobacklink
	$this->BuildSearchUrl($sSrchUrl, $tbl_target->blwbacklink); // blwbacklink
	$this->BuildSearchUrl($sSrchUrl, $tbl_target->blcbacklink); // blcbacklink
	return $sSrchUrl;
}

// Build search URL
function BuildSearchUrl(&$Url, &$Fld) {
	global $objForm;
	$sWrk = "";
	$FldParm = substr($Fld->FldVar, 2);
	$FldVal = $objForm->GetValue("x_$FldParm");
	$FldOpr = $objForm->GetValue("z_$FldParm");
	$FldCond = $objForm->GetValue("v_$FldParm");
	$FldVal2 = $objForm->GetValue("y_$FldParm");
	$FldOpr2 = $objForm->GetValue("w_$FldParm");
	$FldVal = ew_StripSlashes($FldVal);
	if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
	$FldVal2 = ew_StripSlashes($FldVal2);
	if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
	$FldOpr = strtoupper(trim($FldOpr));
	$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
			"&z_" . $FldParm . "=" . urlencode($FldOpr);
	} else {
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $lFldDataType)) {

			//$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
				"&z_" . $FldParm . "=" . urlencode($FldOpr);
		}
		$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
			($lFldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $lFldDataType)) {

			//$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
			$sWrk .= "&y_" . $FldParm . "=" . urlencode($FldVal2) .
				"&w_" . $FldParm . "=" . urlencode($FldOpr2);
		}
	}
	if ($sWrk <> "") {
		if ($Url <> "") $Url .= "&";
		$Url .= $sWrk;
	}
}

// Convert search value for date
function ConvertSearchValue(&$Fld, $FldVal) {
	$Value = $FldVal;
	if ($Fld->FldDataType == EW_DATATYPE_DATE && $FldVal <> "")
		$Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
	return $Value;
}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $tbl_target;

		// Load search values
		// id_profile

		$tbl_target->id_profile->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id_profile"));
		$tbl_target->id_profile->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id_profile");

		// year
		$tbl_target->year->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_year"));
		$tbl_target->year->AdvancedSearch->SearchOperator = $objForm->GetValue("z_year");

		// month
		$tbl_target->month->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_month"));
		$tbl_target->month->AdvancedSearch->SearchOperator = $objForm->GetValue("z_month");

		// visit
		$tbl_target->visit->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_visit"));
		$tbl_target->visit->AdvancedSearch->SearchOperator = $objForm->GetValue("z_visit");

		// pageview
		$tbl_target->pageview->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_pageview"));
		$tbl_target->pageview->AdvancedSearch->SearchOperator = $objForm->GetValue("z_pageview");

		// alexarank
		$tbl_target->alexarank->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_alexarank"));
		$tbl_target->alexarank->AdvancedSearch->SearchOperator = $objForm->GetValue("z_alexarank");

		// googlepagerank
		$tbl_target->googlepagerank->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_googlepagerank"));
		$tbl_target->googlepagerank->AdvancedSearch->SearchOperator = $objForm->GetValue("z_googlepagerank");

		// googleindexedpage
		$tbl_target->googleindexedpage->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_googleindexedpage"));
		$tbl_target->googleindexedpage->AdvancedSearch->SearchOperator = $objForm->GetValue("z_googleindexedpage");

		// yahooindexedpage
		$tbl_target->yahooindexedpage->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_yahooindexedpage"));
		$tbl_target->yahooindexedpage->AdvancedSearch->SearchOperator = $objForm->GetValue("z_yahooindexedpage");

		// bingindexedpage
		$tbl_target->bingindexedpage->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_bingindexedpage"));
		$tbl_target->bingindexedpage->AdvancedSearch->SearchOperator = $objForm->GetValue("z_bingindexedpage");

		// twitterfollower
		$tbl_target->twitterfollower->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_twitterfollower"));
		$tbl_target->twitterfollower->AdvancedSearch->SearchOperator = $objForm->GetValue("z_twitterfollower");

		// facebookfan
		$tbl_target->facebookfan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_facebookfan"));
		$tbl_target->facebookfan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_facebookfan");

		// yahoobacklink
		$tbl_target->yahoobacklink->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_yahoobacklink"));
		$tbl_target->yahoobacklink->AdvancedSearch->SearchOperator = $objForm->GetValue("z_yahoobacklink");

		// blwbacklink
		$tbl_target->blwbacklink->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_blwbacklink"));
		$tbl_target->blwbacklink->AdvancedSearch->SearchOperator = $objForm->GetValue("z_blwbacklink");

		// blcbacklink
		$tbl_target->blcbacklink->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_blcbacklink"));
		$tbl_target->blcbacklink->AdvancedSearch->SearchOperator = $objForm->GetValue("z_blcbacklink");
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
		} elseif ($tbl_target->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id_profile
			$tbl_target->id_profile->EditCustomAttributes = "";
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
			$tbl_target->id_profile->EditValue = $arwrk;

			// year
			$tbl_target->year->EditCustomAttributes = "";
			$tbl_target->year->EditValue = ew_HtmlEncode($tbl_target->year->AdvancedSearch->SearchValue);

			// month
			$tbl_target->month->EditCustomAttributes = "";
			$tbl_target->month->EditValue = ew_HtmlEncode($tbl_target->month->AdvancedSearch->SearchValue);

			// visit
			$tbl_target->visit->EditCustomAttributes = "";
			$tbl_target->visit->EditValue = ew_HtmlEncode($tbl_target->visit->AdvancedSearch->SearchValue);

			// pageview
			$tbl_target->pageview->EditCustomAttributes = "";
			$tbl_target->pageview->EditValue = ew_HtmlEncode($tbl_target->pageview->AdvancedSearch->SearchValue);

			// alexarank
			$tbl_target->alexarank->EditCustomAttributes = "";
			$tbl_target->alexarank->EditValue = ew_HtmlEncode($tbl_target->alexarank->AdvancedSearch->SearchValue);

			// googlepagerank
			$tbl_target->googlepagerank->EditCustomAttributes = "";
			$tbl_target->googlepagerank->EditValue = ew_HtmlEncode($tbl_target->googlepagerank->AdvancedSearch->SearchValue);

			// googleindexedpage
			$tbl_target->googleindexedpage->EditCustomAttributes = "";
			$tbl_target->googleindexedpage->EditValue = ew_HtmlEncode($tbl_target->googleindexedpage->AdvancedSearch->SearchValue);

			// yahooindexedpage
			$tbl_target->yahooindexedpage->EditCustomAttributes = "";
			$tbl_target->yahooindexedpage->EditValue = ew_HtmlEncode($tbl_target->yahooindexedpage->AdvancedSearch->SearchValue);

			// bingindexedpage
			$tbl_target->bingindexedpage->EditCustomAttributes = "";
			$tbl_target->bingindexedpage->EditValue = ew_HtmlEncode($tbl_target->bingindexedpage->AdvancedSearch->SearchValue);

			// twitterfollower
			$tbl_target->twitterfollower->EditCustomAttributes = "";
			$tbl_target->twitterfollower->EditValue = ew_HtmlEncode($tbl_target->twitterfollower->AdvancedSearch->SearchValue);

			// facebookfan
			$tbl_target->facebookfan->EditCustomAttributes = "";
			$tbl_target->facebookfan->EditValue = ew_HtmlEncode($tbl_target->facebookfan->AdvancedSearch->SearchValue);

			// yahoobacklink
			$tbl_target->yahoobacklink->EditCustomAttributes = "";
			$tbl_target->yahoobacklink->EditValue = ew_HtmlEncode($tbl_target->yahoobacklink->AdvancedSearch->SearchValue);

			// blwbacklink
			$tbl_target->blwbacklink->EditCustomAttributes = "";
			$tbl_target->blwbacklink->EditValue = ew_HtmlEncode($tbl_target->blwbacklink->AdvancedSearch->SearchValue);

			// blcbacklink
			$tbl_target->blcbacklink->EditCustomAttributes = "";
			$tbl_target->blcbacklink->EditValue = ew_HtmlEncode($tbl_target->blcbacklink->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($tbl_target->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_target->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $tbl_target;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($tbl_target->year->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_target->year->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_target->month->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_target->month->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_target->visit->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_target->visit->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_target->pageview->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_target->pageview->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_target->alexarank->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_target->alexarank->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_target->googlepagerank->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_target->googlepagerank->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_target->googleindexedpage->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_target->googleindexedpage->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_target->yahooindexedpage->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_target->yahooindexedpage->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_target->bingindexedpage->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_target->bingindexedpage->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_target->twitterfollower->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_target->twitterfollower->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_target->facebookfan->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_target->facebookfan->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_target->yahoobacklink->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_target->yahoobacklink->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_target->blwbacklink->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_target->blwbacklink->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_target->blcbacklink->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_target->blcbacklink->FldErrMsg();
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $sFormCustomError;
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $tbl_target;
		$tbl_target->id_profile->AdvancedSearch->SearchValue = $tbl_target->getAdvancedSearch("x_id_profile");
		$tbl_target->year->AdvancedSearch->SearchValue = $tbl_target->getAdvancedSearch("x_year");
		$tbl_target->month->AdvancedSearch->SearchValue = $tbl_target->getAdvancedSearch("x_month");
		$tbl_target->visit->AdvancedSearch->SearchValue = $tbl_target->getAdvancedSearch("x_visit");
		$tbl_target->pageview->AdvancedSearch->SearchValue = $tbl_target->getAdvancedSearch("x_pageview");
		$tbl_target->alexarank->AdvancedSearch->SearchValue = $tbl_target->getAdvancedSearch("x_alexarank");
		$tbl_target->googlepagerank->AdvancedSearch->SearchValue = $tbl_target->getAdvancedSearch("x_googlepagerank");
		$tbl_target->googleindexedpage->AdvancedSearch->SearchValue = $tbl_target->getAdvancedSearch("x_googleindexedpage");
		$tbl_target->yahooindexedpage->AdvancedSearch->SearchValue = $tbl_target->getAdvancedSearch("x_yahooindexedpage");
		$tbl_target->bingindexedpage->AdvancedSearch->SearchValue = $tbl_target->getAdvancedSearch("x_bingindexedpage");
		$tbl_target->twitterfollower->AdvancedSearch->SearchValue = $tbl_target->getAdvancedSearch("x_twitterfollower");
		$tbl_target->facebookfan->AdvancedSearch->SearchValue = $tbl_target->getAdvancedSearch("x_facebookfan");
		$tbl_target->yahoobacklink->AdvancedSearch->SearchValue = $tbl_target->getAdvancedSearch("x_yahoobacklink");
		$tbl_target->blwbacklink->AdvancedSearch->SearchValue = $tbl_target->getAdvancedSearch("x_blwbacklink");
		$tbl_target->blcbacklink->AdvancedSearch->SearchValue = $tbl_target->getAdvancedSearch("x_blcbacklink");
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
