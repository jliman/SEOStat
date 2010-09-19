<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_index_statinfo.php" ?>
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
$tbl_index_stat_search = new ctbl_index_stat_search();
$Page =& $tbl_index_stat_search;

// Page init
$tbl_index_stat_search->Page_Init();

// Page main
$tbl_index_stat_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_index_stat_search = new ew_Page("tbl_index_stat_search");

// page properties
tbl_index_stat_search.PageID = "search"; // page ID
tbl_index_stat_search.FormID = "ftbl_index_statsearch"; // form ID
var EW_PAGE_ID = tbl_index_stat_search.PageID; // for backward compatibility

// extend page with validate function for search
tbl_index_stat_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_stat_date"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_index_stat->stat_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_index_stat->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_index_stat->month->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_week"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_index_stat->week->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_google"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_index_stat->google->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_yahoo"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_index_stat->yahoo->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_bing"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_index_stat->bing->FldErrMsg()) ?>");

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
tbl_index_stat_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_index_stat_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_index_stat_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_index_stat_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_index_stat_search.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_index_stat_search.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_index_stat->TableCaption() ?><br><br>
<a href="<?php echo $tbl_index_stat->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_index_stat_search->ShowMessage();
?>
<form name="ftbl_index_statsearch" id="ftbl_index_statsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_index_stat_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="tbl_index_stat">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $tbl_index_stat->id_profile->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_index_stat->id_profile->FldCaption() ?></td>
		<td<?php echo $tbl_index_stat->id_profile->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id_profile" id="z_id_profile" value="="></span></td>
		<td<?php echo $tbl_index_stat->id_profile->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_id_profile" name="x_id_profile" title="<?php echo $tbl_index_stat->id_profile->FldTitle() ?>"<?php echo $tbl_index_stat->id_profile->EditAttributes() ?>>
<?php
if (is_array($tbl_index_stat->id_profile->EditValue)) {
	$arwrk = $tbl_index_stat->id_profile->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_index_stat->id_profile->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $tbl_index_stat->stat_date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_index_stat->stat_date->FldCaption() ?></td>
		<td<?php echo $tbl_index_stat->stat_date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_stat_date" id="z_stat_date" value="="></span></td>
		<td<?php echo $tbl_index_stat->stat_date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_stat_date" id="x_stat_date" title="<?php echo $tbl_index_stat->stat_date->FldTitle() ?>" value="<?php echo $tbl_index_stat->stat_date->EditValue ?>"<?php echo $tbl_index_stat->stat_date->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_index_stat->year->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_index_stat->year->FldCaption() ?></td>
		<td<?php echo $tbl_index_stat->year->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_year" id="z_year" value="="></span></td>
		<td<?php echo $tbl_index_stat->year->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_year" id="x_year" title="<?php echo $tbl_index_stat->year->FldTitle() ?>" size="30" value="<?php echo $tbl_index_stat->year->EditValue ?>"<?php echo $tbl_index_stat->year->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_index_stat->month->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_index_stat->month->FldCaption() ?></td>
		<td<?php echo $tbl_index_stat->month->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_month" id="z_month" value="="></span></td>
		<td<?php echo $tbl_index_stat->month->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_month" id="x_month" title="<?php echo $tbl_index_stat->month->FldTitle() ?>" size="30" value="<?php echo $tbl_index_stat->month->EditValue ?>"<?php echo $tbl_index_stat->month->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_index_stat->week->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_index_stat->week->FldCaption() ?></td>
		<td<?php echo $tbl_index_stat->week->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_week" id="z_week" value="="></span></td>
		<td<?php echo $tbl_index_stat->week->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_week" id="x_week" title="<?php echo $tbl_index_stat->week->FldTitle() ?>" size="30" value="<?php echo $tbl_index_stat->week->EditValue ?>"<?php echo $tbl_index_stat->week->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_index_stat->google->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_index_stat->google->FldCaption() ?></td>
		<td<?php echo $tbl_index_stat->google->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_google" id="z_google" value="="></span></td>
		<td<?php echo $tbl_index_stat->google->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_google" id="x_google" title="<?php echo $tbl_index_stat->google->FldTitle() ?>" size="30" value="<?php echo $tbl_index_stat->google->EditValue ?>"<?php echo $tbl_index_stat->google->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_index_stat->yahoo->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_index_stat->yahoo->FldCaption() ?></td>
		<td<?php echo $tbl_index_stat->yahoo->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_yahoo" id="z_yahoo" value="="></span></td>
		<td<?php echo $tbl_index_stat->yahoo->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_yahoo" id="x_yahoo" title="<?php echo $tbl_index_stat->yahoo->FldTitle() ?>" size="30" value="<?php echo $tbl_index_stat->yahoo->EditValue ?>"<?php echo $tbl_index_stat->yahoo->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_index_stat->bing->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_index_stat->bing->FldCaption() ?></td>
		<td<?php echo $tbl_index_stat->bing->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_bing" id="z_bing" value="="></span></td>
		<td<?php echo $tbl_index_stat->bing->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_bing" id="x_bing" title="<?php echo $tbl_index_stat->bing->FldTitle() ?>" size="30" value="<?php echo $tbl_index_stat->bing->EditValue ?>"<?php echo $tbl_index_stat->bing->EditAttributes() ?>>
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
$tbl_index_stat_search->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_index_stat_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'tbl_index_stat';

	// Page object name
	var $PageObjName = 'tbl_index_stat_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_index_stat;
		if ($tbl_index_stat->UseTokenInUrl) $PageUrl .= "t=" . $tbl_index_stat->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_index_stat;
		if ($tbl_index_stat->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_index_stat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_index_stat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_index_stat_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_index_stat)
		$GLOBALS["tbl_index_stat"] = new ctbl_index_stat();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_index_stat', TRUE);

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
		global $tbl_index_stat;

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
			$this->Page_Terminate("tbl_index_statlist.php");
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
		global $objForm, $Language, $gsSearchError, $tbl_index_stat;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$tbl_index_stat->CurrentAction = $objForm->GetValue("a_search");
			switch ($tbl_index_stat->CurrentAction) {
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
						$sSrchStr = $tbl_index_stat->UrlParm($sSrchStr);
						$this->Page_Terminate("tbl_index_statlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$tbl_index_stat->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $tbl_index_stat;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $tbl_index_stat->id_profile); // id_profile
	$this->BuildSearchUrl($sSrchUrl, $tbl_index_stat->stat_date); // stat_date
	$this->BuildSearchUrl($sSrchUrl, $tbl_index_stat->year); // year
	$this->BuildSearchUrl($sSrchUrl, $tbl_index_stat->month); // month
	$this->BuildSearchUrl($sSrchUrl, $tbl_index_stat->week); // week
	$this->BuildSearchUrl($sSrchUrl, $tbl_index_stat->google); // google
	$this->BuildSearchUrl($sSrchUrl, $tbl_index_stat->yahoo); // yahoo
	$this->BuildSearchUrl($sSrchUrl, $tbl_index_stat->bing); // bing
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
		global $objForm, $tbl_index_stat;

		// Load search values
		// id_profile

		$tbl_index_stat->id_profile->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id_profile"));
		$tbl_index_stat->id_profile->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id_profile");

		// stat_date
		$tbl_index_stat->stat_date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_stat_date"));
		$tbl_index_stat->stat_date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_stat_date");

		// year
		$tbl_index_stat->year->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_year"));
		$tbl_index_stat->year->AdvancedSearch->SearchOperator = $objForm->GetValue("z_year");

		// month
		$tbl_index_stat->month->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_month"));
		$tbl_index_stat->month->AdvancedSearch->SearchOperator = $objForm->GetValue("z_month");

		// week
		$tbl_index_stat->week->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_week"));
		$tbl_index_stat->week->AdvancedSearch->SearchOperator = $objForm->GetValue("z_week");

		// google
		$tbl_index_stat->google->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_google"));
		$tbl_index_stat->google->AdvancedSearch->SearchOperator = $objForm->GetValue("z_google");

		// yahoo
		$tbl_index_stat->yahoo->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_yahoo"));
		$tbl_index_stat->yahoo->AdvancedSearch->SearchOperator = $objForm->GetValue("z_yahoo");

		// bing
		$tbl_index_stat->bing->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_bing"));
		$tbl_index_stat->bing->AdvancedSearch->SearchOperator = $objForm->GetValue("z_bing");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_index_stat;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_index_stat->Row_Rendering();

		// Common render codes for all row types
		// id_profile

		$tbl_index_stat->id_profile->CellCssStyle = ""; $tbl_index_stat->id_profile->CellCssClass = "";
		$tbl_index_stat->id_profile->CellAttrs = array(); $tbl_index_stat->id_profile->ViewAttrs = array(); $tbl_index_stat->id_profile->EditAttrs = array();

		// stat_date
		$tbl_index_stat->stat_date->CellCssStyle = ""; $tbl_index_stat->stat_date->CellCssClass = "";
		$tbl_index_stat->stat_date->CellAttrs = array(); $tbl_index_stat->stat_date->ViewAttrs = array(); $tbl_index_stat->stat_date->EditAttrs = array();

		// year
		$tbl_index_stat->year->CellCssStyle = ""; $tbl_index_stat->year->CellCssClass = "";
		$tbl_index_stat->year->CellAttrs = array(); $tbl_index_stat->year->ViewAttrs = array(); $tbl_index_stat->year->EditAttrs = array();

		// month
		$tbl_index_stat->month->CellCssStyle = ""; $tbl_index_stat->month->CellCssClass = "";
		$tbl_index_stat->month->CellAttrs = array(); $tbl_index_stat->month->ViewAttrs = array(); $tbl_index_stat->month->EditAttrs = array();

		// week
		$tbl_index_stat->week->CellCssStyle = ""; $tbl_index_stat->week->CellCssClass = "";
		$tbl_index_stat->week->CellAttrs = array(); $tbl_index_stat->week->ViewAttrs = array(); $tbl_index_stat->week->EditAttrs = array();

		// google
		$tbl_index_stat->google->CellCssStyle = ""; $tbl_index_stat->google->CellCssClass = "";
		$tbl_index_stat->google->CellAttrs = array(); $tbl_index_stat->google->ViewAttrs = array(); $tbl_index_stat->google->EditAttrs = array();

		// yahoo
		$tbl_index_stat->yahoo->CellCssStyle = ""; $tbl_index_stat->yahoo->CellCssClass = "";
		$tbl_index_stat->yahoo->CellAttrs = array(); $tbl_index_stat->yahoo->ViewAttrs = array(); $tbl_index_stat->yahoo->EditAttrs = array();

		// bing
		$tbl_index_stat->bing->CellCssStyle = ""; $tbl_index_stat->bing->CellCssClass = "";
		$tbl_index_stat->bing->CellAttrs = array(); $tbl_index_stat->bing->ViewAttrs = array(); $tbl_index_stat->bing->EditAttrs = array();
		if ($tbl_index_stat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_profile
			if (strval($tbl_index_stat->id_profile->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_index_stat->id_profile->CurrentValue) . "";
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
					$tbl_index_stat->id_profile->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_index_stat->id_profile->ViewValue = $tbl_index_stat->id_profile->CurrentValue;
				}
			} else {
				$tbl_index_stat->id_profile->ViewValue = NULL;
			}
			$tbl_index_stat->id_profile->CssStyle = "";
			$tbl_index_stat->id_profile->CssClass = "";
			$tbl_index_stat->id_profile->ViewCustomAttributes = "";

			// stat_date
			$tbl_index_stat->stat_date->ViewValue = $tbl_index_stat->stat_date->CurrentValue;
			$tbl_index_stat->stat_date->ViewValue = ew_FormatDateTime($tbl_index_stat->stat_date->ViewValue, 5);
			$tbl_index_stat->stat_date->CssStyle = "";
			$tbl_index_stat->stat_date->CssClass = "";
			$tbl_index_stat->stat_date->ViewCustomAttributes = "";

			// year
			$tbl_index_stat->year->ViewValue = $tbl_index_stat->year->CurrentValue;
			$tbl_index_stat->year->CssStyle = "";
			$tbl_index_stat->year->CssClass = "";
			$tbl_index_stat->year->ViewCustomAttributes = "";

			// month
			$tbl_index_stat->month->ViewValue = $tbl_index_stat->month->CurrentValue;
			$tbl_index_stat->month->CssStyle = "";
			$tbl_index_stat->month->CssClass = "";
			$tbl_index_stat->month->ViewCustomAttributes = "";

			// week
			$tbl_index_stat->week->ViewValue = $tbl_index_stat->week->CurrentValue;
			$tbl_index_stat->week->CssStyle = "";
			$tbl_index_stat->week->CssClass = "";
			$tbl_index_stat->week->ViewCustomAttributes = "";

			// google
			$tbl_index_stat->google->ViewValue = $tbl_index_stat->google->CurrentValue;
			$tbl_index_stat->google->CssStyle = "";
			$tbl_index_stat->google->CssClass = "";
			$tbl_index_stat->google->ViewCustomAttributes = "";

			// yahoo
			$tbl_index_stat->yahoo->ViewValue = $tbl_index_stat->yahoo->CurrentValue;
			$tbl_index_stat->yahoo->CssStyle = "";
			$tbl_index_stat->yahoo->CssClass = "";
			$tbl_index_stat->yahoo->ViewCustomAttributes = "";

			// bing
			$tbl_index_stat->bing->ViewValue = $tbl_index_stat->bing->CurrentValue;
			$tbl_index_stat->bing->CssStyle = "";
			$tbl_index_stat->bing->CssClass = "";
			$tbl_index_stat->bing->ViewCustomAttributes = "";

			// id_profile
			$tbl_index_stat->id_profile->HrefValue = "";
			$tbl_index_stat->id_profile->TooltipValue = "";

			// stat_date
			$tbl_index_stat->stat_date->HrefValue = "";
			$tbl_index_stat->stat_date->TooltipValue = "";

			// year
			$tbl_index_stat->year->HrefValue = "";
			$tbl_index_stat->year->TooltipValue = "";

			// month
			$tbl_index_stat->month->HrefValue = "";
			$tbl_index_stat->month->TooltipValue = "";

			// week
			$tbl_index_stat->week->HrefValue = "";
			$tbl_index_stat->week->TooltipValue = "";

			// google
			$tbl_index_stat->google->HrefValue = "";
			$tbl_index_stat->google->TooltipValue = "";

			// yahoo
			$tbl_index_stat->yahoo->HrefValue = "";
			$tbl_index_stat->yahoo->TooltipValue = "";

			// bing
			$tbl_index_stat->bing->HrefValue = "";
			$tbl_index_stat->bing->TooltipValue = "";
		} elseif ($tbl_index_stat->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id_profile
			$tbl_index_stat->id_profile->EditCustomAttributes = "";
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
			$tbl_index_stat->id_profile->EditValue = $arwrk;

			// stat_date
			$tbl_index_stat->stat_date->EditCustomAttributes = "";
			$tbl_index_stat->stat_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($tbl_index_stat->stat_date->AdvancedSearch->SearchValue, 5), 5));

			// year
			$tbl_index_stat->year->EditCustomAttributes = "";
			$tbl_index_stat->year->EditValue = ew_HtmlEncode($tbl_index_stat->year->AdvancedSearch->SearchValue);

			// month
			$tbl_index_stat->month->EditCustomAttributes = "";
			$tbl_index_stat->month->EditValue = ew_HtmlEncode($tbl_index_stat->month->AdvancedSearch->SearchValue);

			// week
			$tbl_index_stat->week->EditCustomAttributes = "";
			$tbl_index_stat->week->EditValue = ew_HtmlEncode($tbl_index_stat->week->AdvancedSearch->SearchValue);

			// google
			$tbl_index_stat->google->EditCustomAttributes = "";
			$tbl_index_stat->google->EditValue = ew_HtmlEncode($tbl_index_stat->google->AdvancedSearch->SearchValue);

			// yahoo
			$tbl_index_stat->yahoo->EditCustomAttributes = "";
			$tbl_index_stat->yahoo->EditValue = ew_HtmlEncode($tbl_index_stat->yahoo->AdvancedSearch->SearchValue);

			// bing
			$tbl_index_stat->bing->EditCustomAttributes = "";
			$tbl_index_stat->bing->EditValue = ew_HtmlEncode($tbl_index_stat->bing->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($tbl_index_stat->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_index_stat->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $tbl_index_stat;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckDate($tbl_index_stat->stat_date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_index_stat->stat_date->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_index_stat->year->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_index_stat->year->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_index_stat->month->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_index_stat->month->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_index_stat->week->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_index_stat->week->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_index_stat->google->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_index_stat->google->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_index_stat->yahoo->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_index_stat->yahoo->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_index_stat->bing->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_index_stat->bing->FldErrMsg();
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
		global $tbl_index_stat;
		$tbl_index_stat->id_profile->AdvancedSearch->SearchValue = $tbl_index_stat->getAdvancedSearch("x_id_profile");
		$tbl_index_stat->stat_date->AdvancedSearch->SearchValue = $tbl_index_stat->getAdvancedSearch("x_stat_date");
		$tbl_index_stat->year->AdvancedSearch->SearchValue = $tbl_index_stat->getAdvancedSearch("x_year");
		$tbl_index_stat->month->AdvancedSearch->SearchValue = $tbl_index_stat->getAdvancedSearch("x_month");
		$tbl_index_stat->week->AdvancedSearch->SearchValue = $tbl_index_stat->getAdvancedSearch("x_week");
		$tbl_index_stat->google->AdvancedSearch->SearchValue = $tbl_index_stat->getAdvancedSearch("x_google");
		$tbl_index_stat->yahoo->AdvancedSearch->SearchValue = $tbl_index_stat->getAdvancedSearch("x_yahoo");
		$tbl_index_stat->bing->AdvancedSearch->SearchValue = $tbl_index_stat->getAdvancedSearch("x_bing");
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
