<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_ga_statinfo.php" ?>
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
$tbl_ga_stat_search = new ctbl_ga_stat_search();
$Page =& $tbl_ga_stat_search;

// Page init
$tbl_ga_stat_search->Page_Init();

// Page main
$tbl_ga_stat_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_ga_stat_search = new ew_Page("tbl_ga_stat_search");

// page properties
tbl_ga_stat_search.PageID = "search"; // page ID
tbl_ga_stat_search.FormID = "ftbl_ga_statsearch"; // form ID
var EW_PAGE_ID = tbl_ga_stat_search.PageID; // for backward compatibility

// extend page with validate function for search
tbl_ga_stat_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_stat_date"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_ga_stat->stat_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_ga_stat->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_ga_stat->month->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_week"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_ga_stat->week->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_hour"];
		if (elm && !ew_CheckTime(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_ga_stat->hour->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_pageview"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_ga_stat->pageview->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_visit"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_ga_stat->visit->FldErrMsg()) ?>");

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
tbl_ga_stat_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_ga_stat_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_ga_stat_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_ga_stat_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_ga_stat_search.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_ga_stat_search.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_ga_stat->TableCaption() ?><br><br>
<a href="<?php echo $tbl_ga_stat->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_ga_stat_search->ShowMessage();
?>
<form name="ftbl_ga_statsearch" id="ftbl_ga_statsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_ga_stat_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="tbl_ga_stat">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $tbl_ga_stat->id_profile->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_ga_stat->id_profile->FldCaption() ?></td>
		<td<?php echo $tbl_ga_stat->id_profile->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id_profile" id="z_id_profile" value="="></span></td>
		<td<?php echo $tbl_ga_stat->id_profile->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_id_profile" name="x_id_profile" title="<?php echo $tbl_ga_stat->id_profile->FldTitle() ?>"<?php echo $tbl_ga_stat->id_profile->EditAttributes() ?>>
<?php
if (is_array($tbl_ga_stat->id_profile->EditValue)) {
	$arwrk = $tbl_ga_stat->id_profile->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_ga_stat->id_profile->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $tbl_ga_stat->stat_date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_ga_stat->stat_date->FldCaption() ?></td>
		<td<?php echo $tbl_ga_stat->stat_date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_stat_date" id="z_stat_date" value="="></span></td>
		<td<?php echo $tbl_ga_stat->stat_date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_stat_date" id="x_stat_date" title="<?php echo $tbl_ga_stat->stat_date->FldTitle() ?>" value="<?php echo $tbl_ga_stat->stat_date->EditValue ?>"<?php echo $tbl_ga_stat->stat_date->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_ga_stat->year->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_ga_stat->year->FldCaption() ?></td>
		<td<?php echo $tbl_ga_stat->year->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_year" id="z_year" value="="></span></td>
		<td<?php echo $tbl_ga_stat->year->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_year" id="x_year" title="<?php echo $tbl_ga_stat->year->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->year->EditValue ?>"<?php echo $tbl_ga_stat->year->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_ga_stat->month->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_ga_stat->month->FldCaption() ?></td>
		<td<?php echo $tbl_ga_stat->month->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_month" id="z_month" value="="></span></td>
		<td<?php echo $tbl_ga_stat->month->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_month" id="x_month" title="<?php echo $tbl_ga_stat->month->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->month->EditValue ?>"<?php echo $tbl_ga_stat->month->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_ga_stat->week->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_ga_stat->week->FldCaption() ?></td>
		<td<?php echo $tbl_ga_stat->week->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_week" id="z_week" value="="></span></td>
		<td<?php echo $tbl_ga_stat->week->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_week" id="x_week" title="<?php echo $tbl_ga_stat->week->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->week->EditValue ?>"<?php echo $tbl_ga_stat->week->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_ga_stat->day->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_ga_stat->day->FldCaption() ?></td>
		<td<?php echo $tbl_ga_stat->day->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_day" id="z_day" value="="></span></td>
		<td<?php echo $tbl_ga_stat->day->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_day" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_day" id="x_day" title="<?php echo $tbl_ga_stat->day->FldTitle() ?>" value="{value}"<?php echo $tbl_ga_stat->day->EditAttributes() ?>></label></div>
<div id="dsl_x_day" repeatcolumn="5">
<?php
$arwrk = $tbl_ga_stat->day->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_ga_stat->day->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_day" id="x_day" title="<?php echo $tbl_ga_stat->day->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_ga_stat->day->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_ga_stat->hour->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_ga_stat->hour->FldCaption() ?></td>
		<td<?php echo $tbl_ga_stat->hour->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_hour" id="z_hour" value="="></span></td>
		<td<?php echo $tbl_ga_stat->hour->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_hour" id="x_hour" title="<?php echo $tbl_ga_stat->hour->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->hour->EditValue ?>"<?php echo $tbl_ga_stat->hour->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_ga_stat->pageview->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_ga_stat->pageview->FldCaption() ?></td>
		<td<?php echo $tbl_ga_stat->pageview->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_pageview" id="z_pageview" value="="></span></td>
		<td<?php echo $tbl_ga_stat->pageview->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_pageview" id="x_pageview" title="<?php echo $tbl_ga_stat->pageview->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->pageview->EditValue ?>"<?php echo $tbl_ga_stat->pageview->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_ga_stat->visit->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_ga_stat->visit->FldCaption() ?></td>
		<td<?php echo $tbl_ga_stat->visit->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_visit" id="z_visit" value="="></span></td>
		<td<?php echo $tbl_ga_stat->visit->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_visit" id="x_visit" title="<?php echo $tbl_ga_stat->visit->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->visit->EditValue ?>"<?php echo $tbl_ga_stat->visit->EditAttributes() ?>>
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
$tbl_ga_stat_search->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_ga_stat_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'tbl_ga_stat';

	// Page object name
	var $PageObjName = 'tbl_ga_stat_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_ga_stat;
		if ($tbl_ga_stat->UseTokenInUrl) $PageUrl .= "t=" . $tbl_ga_stat->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_ga_stat;
		if ($tbl_ga_stat->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_ga_stat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_ga_stat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_ga_stat_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_ga_stat)
		$GLOBALS["tbl_ga_stat"] = new ctbl_ga_stat();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_ga_stat', TRUE);

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
		global $tbl_ga_stat;

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
			$this->Page_Terminate("tbl_ga_statlist.php");
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
		global $objForm, $Language, $gsSearchError, $tbl_ga_stat;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$tbl_ga_stat->CurrentAction = $objForm->GetValue("a_search");
			switch ($tbl_ga_stat->CurrentAction) {
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
						$sSrchStr = $tbl_ga_stat->UrlParm($sSrchStr);
						$this->Page_Terminate("tbl_ga_statlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$tbl_ga_stat->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $tbl_ga_stat;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $tbl_ga_stat->id_profile); // id_profile
	$this->BuildSearchUrl($sSrchUrl, $tbl_ga_stat->stat_date); // stat_date
	$this->BuildSearchUrl($sSrchUrl, $tbl_ga_stat->year); // year
	$this->BuildSearchUrl($sSrchUrl, $tbl_ga_stat->month); // month
	$this->BuildSearchUrl($sSrchUrl, $tbl_ga_stat->week); // week
	$this->BuildSearchUrl($sSrchUrl, $tbl_ga_stat->day); // day
	$this->BuildSearchUrl($sSrchUrl, $tbl_ga_stat->hour); // hour
	$this->BuildSearchUrl($sSrchUrl, $tbl_ga_stat->pageview); // pageview
	$this->BuildSearchUrl($sSrchUrl, $tbl_ga_stat->visit); // visit
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
		global $objForm, $tbl_ga_stat;

		// Load search values
		// id_profile

		$tbl_ga_stat->id_profile->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id_profile"));
		$tbl_ga_stat->id_profile->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id_profile");

		// stat_date
		$tbl_ga_stat->stat_date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_stat_date"));
		$tbl_ga_stat->stat_date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_stat_date");

		// year
		$tbl_ga_stat->year->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_year"));
		$tbl_ga_stat->year->AdvancedSearch->SearchOperator = $objForm->GetValue("z_year");

		// month
		$tbl_ga_stat->month->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_month"));
		$tbl_ga_stat->month->AdvancedSearch->SearchOperator = $objForm->GetValue("z_month");

		// week
		$tbl_ga_stat->week->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_week"));
		$tbl_ga_stat->week->AdvancedSearch->SearchOperator = $objForm->GetValue("z_week");

		// day
		$tbl_ga_stat->day->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_day"));
		$tbl_ga_stat->day->AdvancedSearch->SearchOperator = $objForm->GetValue("z_day");

		// hour
		$tbl_ga_stat->hour->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_hour"));
		$tbl_ga_stat->hour->AdvancedSearch->SearchOperator = $objForm->GetValue("z_hour");

		// pageview
		$tbl_ga_stat->pageview->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_pageview"));
		$tbl_ga_stat->pageview->AdvancedSearch->SearchOperator = $objForm->GetValue("z_pageview");

		// visit
		$tbl_ga_stat->visit->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_visit"));
		$tbl_ga_stat->visit->AdvancedSearch->SearchOperator = $objForm->GetValue("z_visit");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_ga_stat;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_ga_stat->Row_Rendering();

		// Common render codes for all row types
		// id_profile

		$tbl_ga_stat->id_profile->CellCssStyle = ""; $tbl_ga_stat->id_profile->CellCssClass = "";
		$tbl_ga_stat->id_profile->CellAttrs = array(); $tbl_ga_stat->id_profile->ViewAttrs = array(); $tbl_ga_stat->id_profile->EditAttrs = array();

		// stat_date
		$tbl_ga_stat->stat_date->CellCssStyle = ""; $tbl_ga_stat->stat_date->CellCssClass = "";
		$tbl_ga_stat->stat_date->CellAttrs = array(); $tbl_ga_stat->stat_date->ViewAttrs = array(); $tbl_ga_stat->stat_date->EditAttrs = array();

		// year
		$tbl_ga_stat->year->CellCssStyle = ""; $tbl_ga_stat->year->CellCssClass = "";
		$tbl_ga_stat->year->CellAttrs = array(); $tbl_ga_stat->year->ViewAttrs = array(); $tbl_ga_stat->year->EditAttrs = array();

		// month
		$tbl_ga_stat->month->CellCssStyle = ""; $tbl_ga_stat->month->CellCssClass = "";
		$tbl_ga_stat->month->CellAttrs = array(); $tbl_ga_stat->month->ViewAttrs = array(); $tbl_ga_stat->month->EditAttrs = array();

		// week
		$tbl_ga_stat->week->CellCssStyle = ""; $tbl_ga_stat->week->CellCssClass = "";
		$tbl_ga_stat->week->CellAttrs = array(); $tbl_ga_stat->week->ViewAttrs = array(); $tbl_ga_stat->week->EditAttrs = array();

		// day
		$tbl_ga_stat->day->CellCssStyle = ""; $tbl_ga_stat->day->CellCssClass = "";
		$tbl_ga_stat->day->CellAttrs = array(); $tbl_ga_stat->day->ViewAttrs = array(); $tbl_ga_stat->day->EditAttrs = array();

		// hour
		$tbl_ga_stat->hour->CellCssStyle = ""; $tbl_ga_stat->hour->CellCssClass = "";
		$tbl_ga_stat->hour->CellAttrs = array(); $tbl_ga_stat->hour->ViewAttrs = array(); $tbl_ga_stat->hour->EditAttrs = array();

		// pageview
		$tbl_ga_stat->pageview->CellCssStyle = ""; $tbl_ga_stat->pageview->CellCssClass = "";
		$tbl_ga_stat->pageview->CellAttrs = array(); $tbl_ga_stat->pageview->ViewAttrs = array(); $tbl_ga_stat->pageview->EditAttrs = array();

		// visit
		$tbl_ga_stat->visit->CellCssStyle = ""; $tbl_ga_stat->visit->CellCssClass = "";
		$tbl_ga_stat->visit->CellAttrs = array(); $tbl_ga_stat->visit->ViewAttrs = array(); $tbl_ga_stat->visit->EditAttrs = array();
		if ($tbl_ga_stat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_profile
			if (strval($tbl_ga_stat->id_profile->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_ga_stat->id_profile->CurrentValue) . "";
			$sSqlWrk = "SELECT DISTINCT `name` FROM `tbl_profile`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$tbl_ga_stat->id_profile->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_ga_stat->id_profile->ViewValue = $tbl_ga_stat->id_profile->CurrentValue;
				}
			} else {
				$tbl_ga_stat->id_profile->ViewValue = NULL;
			}
			$tbl_ga_stat->id_profile->CssStyle = "";
			$tbl_ga_stat->id_profile->CssClass = "";
			$tbl_ga_stat->id_profile->ViewCustomAttributes = "";

			// stat_date
			$tbl_ga_stat->stat_date->ViewValue = $tbl_ga_stat->stat_date->CurrentValue;
			$tbl_ga_stat->stat_date->ViewValue = ew_FormatDateTime($tbl_ga_stat->stat_date->ViewValue, 5);
			$tbl_ga_stat->stat_date->CssStyle = "";
			$tbl_ga_stat->stat_date->CssClass = "";
			$tbl_ga_stat->stat_date->ViewCustomAttributes = "";

			// year
			$tbl_ga_stat->year->ViewValue = $tbl_ga_stat->year->CurrentValue;
			$tbl_ga_stat->year->CssStyle = "";
			$tbl_ga_stat->year->CssClass = "";
			$tbl_ga_stat->year->ViewCustomAttributes = "";

			// month
			$tbl_ga_stat->month->ViewValue = $tbl_ga_stat->month->CurrentValue;
			$tbl_ga_stat->month->CssStyle = "";
			$tbl_ga_stat->month->CssClass = "";
			$tbl_ga_stat->month->ViewCustomAttributes = "";

			// week
			$tbl_ga_stat->week->ViewValue = $tbl_ga_stat->week->CurrentValue;
			$tbl_ga_stat->week->CssStyle = "";
			$tbl_ga_stat->week->CssClass = "";
			$tbl_ga_stat->week->ViewCustomAttributes = "";

			// day
			if (strval($tbl_ga_stat->day->CurrentValue) <> "") {
				switch ($tbl_ga_stat->day->CurrentValue) {
					case "1":
						$tbl_ga_stat->day->ViewValue = "1";
						break;
					case "2":
						$tbl_ga_stat->day->ViewValue = "2";
						break;
					case "3":
						$tbl_ga_stat->day->ViewValue = "3";
						break;
					case "4":
						$tbl_ga_stat->day->ViewValue = "4";
						break;
					case "5":
						$tbl_ga_stat->day->ViewValue = "5";
						break;
					case "6":
						$tbl_ga_stat->day->ViewValue = "6";
						break;
					case "7":
						$tbl_ga_stat->day->ViewValue = "7";
						break;
					default:
						$tbl_ga_stat->day->ViewValue = $tbl_ga_stat->day->CurrentValue;
				}
			} else {
				$tbl_ga_stat->day->ViewValue = NULL;
			}
			$tbl_ga_stat->day->CssStyle = "";
			$tbl_ga_stat->day->CssClass = "";
			$tbl_ga_stat->day->ViewCustomAttributes = "";

			// hour
			$tbl_ga_stat->hour->ViewValue = $tbl_ga_stat->hour->CurrentValue;
			$tbl_ga_stat->hour->ViewValue = ew_FormatDateTime($tbl_ga_stat->hour->ViewValue, 4);
			$tbl_ga_stat->hour->CssStyle = "";
			$tbl_ga_stat->hour->CssClass = "";
			$tbl_ga_stat->hour->ViewCustomAttributes = "";

			// pageview
			$tbl_ga_stat->pageview->ViewValue = $tbl_ga_stat->pageview->CurrentValue;
			$tbl_ga_stat->pageview->CssStyle = "";
			$tbl_ga_stat->pageview->CssClass = "";
			$tbl_ga_stat->pageview->ViewCustomAttributes = "";

			// visit
			$tbl_ga_stat->visit->ViewValue = $tbl_ga_stat->visit->CurrentValue;
			$tbl_ga_stat->visit->CssStyle = "";
			$tbl_ga_stat->visit->CssClass = "";
			$tbl_ga_stat->visit->ViewCustomAttributes = "";

			// id_profile
			$tbl_ga_stat->id_profile->HrefValue = "";
			$tbl_ga_stat->id_profile->TooltipValue = "";

			// stat_date
			$tbl_ga_stat->stat_date->HrefValue = "";
			$tbl_ga_stat->stat_date->TooltipValue = "";

			// year
			$tbl_ga_stat->year->HrefValue = "";
			$tbl_ga_stat->year->TooltipValue = "";

			// month
			$tbl_ga_stat->month->HrefValue = "";
			$tbl_ga_stat->month->TooltipValue = "";

			// week
			$tbl_ga_stat->week->HrefValue = "";
			$tbl_ga_stat->week->TooltipValue = "";

			// day
			$tbl_ga_stat->day->HrefValue = "";
			$tbl_ga_stat->day->TooltipValue = "";

			// hour
			$tbl_ga_stat->hour->HrefValue = "";
			$tbl_ga_stat->hour->TooltipValue = "";

			// pageview
			$tbl_ga_stat->pageview->HrefValue = "";
			$tbl_ga_stat->pageview->TooltipValue = "";

			// visit
			$tbl_ga_stat->visit->HrefValue = "";
			$tbl_ga_stat->visit->TooltipValue = "";
		} elseif ($tbl_ga_stat->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id_profile
			$tbl_ga_stat->id_profile->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT DISTINCT `id`, `name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `tbl_profile`";
			$sWhereWrk = "";
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
			$tbl_ga_stat->id_profile->EditValue = $arwrk;

			// stat_date
			$tbl_ga_stat->stat_date->EditCustomAttributes = "";
			$tbl_ga_stat->stat_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($tbl_ga_stat->stat_date->AdvancedSearch->SearchValue, 5), 5));

			// year
			$tbl_ga_stat->year->EditCustomAttributes = "";
			$tbl_ga_stat->year->EditValue = ew_HtmlEncode($tbl_ga_stat->year->AdvancedSearch->SearchValue);

			// month
			$tbl_ga_stat->month->EditCustomAttributes = "";
			$tbl_ga_stat->month->EditValue = ew_HtmlEncode($tbl_ga_stat->month->AdvancedSearch->SearchValue);

			// week
			$tbl_ga_stat->week->EditCustomAttributes = "";
			$tbl_ga_stat->week->EditValue = ew_HtmlEncode($tbl_ga_stat->week->AdvancedSearch->SearchValue);

			// day
			$tbl_ga_stat->day->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "1");
			$arwrk[] = array("2", "2");
			$arwrk[] = array("3", "3");
			$arwrk[] = array("4", "4");
			$arwrk[] = array("5", "5");
			$arwrk[] = array("6", "6");
			$arwrk[] = array("7", "7");
			$tbl_ga_stat->day->EditValue = $arwrk;

			// hour
			$tbl_ga_stat->hour->EditCustomAttributes = "";
			$tbl_ga_stat->hour->EditValue = ew_HtmlEncode(ew_FormatDateTime($tbl_ga_stat->hour->AdvancedSearch->SearchValue, 4));

			// pageview
			$tbl_ga_stat->pageview->EditCustomAttributes = "";
			$tbl_ga_stat->pageview->EditValue = ew_HtmlEncode($tbl_ga_stat->pageview->AdvancedSearch->SearchValue);

			// visit
			$tbl_ga_stat->visit->EditCustomAttributes = "";
			$tbl_ga_stat->visit->EditValue = ew_HtmlEncode($tbl_ga_stat->visit->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($tbl_ga_stat->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_ga_stat->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $tbl_ga_stat;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckDate($tbl_ga_stat->stat_date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_ga_stat->stat_date->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_ga_stat->year->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_ga_stat->year->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_ga_stat->month->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_ga_stat->month->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_ga_stat->week->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_ga_stat->week->FldErrMsg();
		}
		if (!ew_CheckTime($tbl_ga_stat->hour->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_ga_stat->hour->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_ga_stat->pageview->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_ga_stat->pageview->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_ga_stat->visit->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_ga_stat->visit->FldErrMsg();
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
		global $tbl_ga_stat;
		$tbl_ga_stat->id_profile->AdvancedSearch->SearchValue = $tbl_ga_stat->getAdvancedSearch("x_id_profile");
		$tbl_ga_stat->stat_date->AdvancedSearch->SearchValue = $tbl_ga_stat->getAdvancedSearch("x_stat_date");
		$tbl_ga_stat->year->AdvancedSearch->SearchValue = $tbl_ga_stat->getAdvancedSearch("x_year");
		$tbl_ga_stat->month->AdvancedSearch->SearchValue = $tbl_ga_stat->getAdvancedSearch("x_month");
		$tbl_ga_stat->week->AdvancedSearch->SearchValue = $tbl_ga_stat->getAdvancedSearch("x_week");
		$tbl_ga_stat->day->AdvancedSearch->SearchValue = $tbl_ga_stat->getAdvancedSearch("x_day");
		$tbl_ga_stat->hour->AdvancedSearch->SearchValue = $tbl_ga_stat->getAdvancedSearch("x_hour");
		$tbl_ga_stat->pageview->AdvancedSearch->SearchValue = $tbl_ga_stat->getAdvancedSearch("x_pageview");
		$tbl_ga_stat->visit->AdvancedSearch->SearchValue = $tbl_ga_stat->getAdvancedSearch("x_visit");
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
