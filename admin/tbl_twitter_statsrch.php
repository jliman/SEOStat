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
$tbl_twitter_stat_search = new ctbl_twitter_stat_search();
$Page =& $tbl_twitter_stat_search;

// Page init
$tbl_twitter_stat_search->Page_Init();

// Page main
$tbl_twitter_stat_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_twitter_stat_search = new ew_Page("tbl_twitter_stat_search");

// page properties
tbl_twitter_stat_search.PageID = "search"; // page ID
tbl_twitter_stat_search.FormID = "ftbl_twitter_statsearch"; // form ID
var EW_PAGE_ID = tbl_twitter_stat_search.PageID; // for backward compatibility

// extend page with validate function for search
tbl_twitter_stat_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_stat_date"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_twitter_stat->stat_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_twitter_stat->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_twitter_stat->month->FldErrMsg()) ?>");
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
tbl_twitter_stat_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_twitter_stat_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_twitter_stat_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_twitter_stat_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_twitter_stat_search.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_twitter_stat_search.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_twitter_stat->TableCaption() ?><br><br>
<a href="<?php echo $tbl_twitter_stat->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_twitter_stat_search->ShowMessage();
?>
<form name="ftbl_twitter_statsearch" id="ftbl_twitter_statsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_twitter_stat_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="tbl_twitter_stat">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $tbl_twitter_stat->id_profile->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->id_profile->FldCaption() ?></td>
		<td<?php echo $tbl_twitter_stat->id_profile->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id_profile" id="z_id_profile" value="="></span></td>
		<td<?php echo $tbl_twitter_stat->id_profile->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_id_profile" name="x_id_profile" title="<?php echo $tbl_twitter_stat->id_profile->FldTitle() ?>"<?php echo $tbl_twitter_stat->id_profile->EditAttributes() ?>>
<?php
if (is_array($tbl_twitter_stat->id_profile->EditValue)) {
	$arwrk = $tbl_twitter_stat->id_profile->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_twitter_stat->id_profile->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $tbl_twitter_stat->stat_date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->stat_date->FldCaption() ?></td>
		<td<?php echo $tbl_twitter_stat->stat_date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_stat_date" id="z_stat_date" value="="></span></td>
		<td<?php echo $tbl_twitter_stat->stat_date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_stat_date" id="x_stat_date" title="<?php echo $tbl_twitter_stat->stat_date->FldTitle() ?>" value="<?php echo $tbl_twitter_stat->stat_date->EditValue ?>"<?php echo $tbl_twitter_stat->stat_date->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_twitter_stat->year->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->year->FldCaption() ?></td>
		<td<?php echo $tbl_twitter_stat->year->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_year" id="z_year" value="="></span></td>
		<td<?php echo $tbl_twitter_stat->year->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_year" id="x_year" title="<?php echo $tbl_twitter_stat->year->FldTitle() ?>" size="30" value="<?php echo $tbl_twitter_stat->year->EditValue ?>"<?php echo $tbl_twitter_stat->year->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_twitter_stat->month->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->month->FldCaption() ?></td>
		<td<?php echo $tbl_twitter_stat->month->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_month" id="z_month" value="="></span></td>
		<td<?php echo $tbl_twitter_stat->month->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_month" id="x_month" title="<?php echo $tbl_twitter_stat->month->FldTitle() ?>" size="30" value="<?php echo $tbl_twitter_stat->month->EditValue ?>"<?php echo $tbl_twitter_stat->month->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_twitter_stat->week->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->week->FldCaption() ?></td>
		<td<?php echo $tbl_twitter_stat->week->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_week" id="z_week" value="="></span></td>
		<td<?php echo $tbl_twitter_stat->week->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_week" id="x_week" title="<?php echo $tbl_twitter_stat->week->FldTitle() ?>" size="30" value="<?php echo $tbl_twitter_stat->week->EditValue ?>"<?php echo $tbl_twitter_stat->week->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_twitter_stat->following->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->following->FldCaption() ?></td>
		<td<?php echo $tbl_twitter_stat->following->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_following" id="z_following" value="="></span></td>
		<td<?php echo $tbl_twitter_stat->following->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_following" id="x_following" title="<?php echo $tbl_twitter_stat->following->FldTitle() ?>" size="30" value="<?php echo $tbl_twitter_stat->following->EditValue ?>"<?php echo $tbl_twitter_stat->following->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_twitter_stat->followers->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->followers->FldCaption() ?></td>
		<td<?php echo $tbl_twitter_stat->followers->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_followers" id="z_followers" value="="></span></td>
		<td<?php echo $tbl_twitter_stat->followers->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_followers" id="x_followers" title="<?php echo $tbl_twitter_stat->followers->FldTitle() ?>" size="30" value="<?php echo $tbl_twitter_stat->followers->EditValue ?>"<?php echo $tbl_twitter_stat->followers->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_twitter_stat->listed->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->listed->FldCaption() ?></td>
		<td<?php echo $tbl_twitter_stat->listed->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_listed" id="z_listed" value="="></span></td>
		<td<?php echo $tbl_twitter_stat->listed->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_listed" id="x_listed" title="<?php echo $tbl_twitter_stat->listed->FldTitle() ?>" size="30" value="<?php echo $tbl_twitter_stat->listed->EditValue ?>"<?php echo $tbl_twitter_stat->listed->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_twitter_stat->tweets->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_twitter_stat->tweets->FldCaption() ?></td>
		<td<?php echo $tbl_twitter_stat->tweets->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_tweets" id="z_tweets" value="="></span></td>
		<td<?php echo $tbl_twitter_stat->tweets->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_tweets" id="x_tweets" title="<?php echo $tbl_twitter_stat->tweets->FldTitle() ?>" size="30" value="<?php echo $tbl_twitter_stat->tweets->EditValue ?>"<?php echo $tbl_twitter_stat->tweets->EditAttributes() ?>>
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
$tbl_twitter_stat_search->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_twitter_stat_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'tbl_twitter_stat';

	// Page object name
	var $PageObjName = 'tbl_twitter_stat_search';

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
	function ctbl_twitter_stat_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_twitter_stat)
		$GLOBALS["tbl_twitter_stat"] = new ctbl_twitter_stat();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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
		if (!$Security->CanSearch()) {
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $tbl_twitter_stat;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$tbl_twitter_stat->CurrentAction = $objForm->GetValue("a_search");
			switch ($tbl_twitter_stat->CurrentAction) {
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
						$sSrchStr = $tbl_twitter_stat->UrlParm($sSrchStr);
						$this->Page_Terminate("tbl_twitter_statlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$tbl_twitter_stat->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $tbl_twitter_stat;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $tbl_twitter_stat->id_profile); // id_profile
	$this->BuildSearchUrl($sSrchUrl, $tbl_twitter_stat->stat_date); // stat_date
	$this->BuildSearchUrl($sSrchUrl, $tbl_twitter_stat->year); // year
	$this->BuildSearchUrl($sSrchUrl, $tbl_twitter_stat->month); // month
	$this->BuildSearchUrl($sSrchUrl, $tbl_twitter_stat->week); // week
	$this->BuildSearchUrl($sSrchUrl, $tbl_twitter_stat->following); // following
	$this->BuildSearchUrl($sSrchUrl, $tbl_twitter_stat->followers); // followers
	$this->BuildSearchUrl($sSrchUrl, $tbl_twitter_stat->listed); // listed
	$this->BuildSearchUrl($sSrchUrl, $tbl_twitter_stat->tweets); // tweets
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
		global $objForm, $tbl_twitter_stat;

		// Load search values
		// id_profile

		$tbl_twitter_stat->id_profile->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id_profile"));
		$tbl_twitter_stat->id_profile->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id_profile");

		// stat_date
		$tbl_twitter_stat->stat_date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_stat_date"));
		$tbl_twitter_stat->stat_date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_stat_date");

		// year
		$tbl_twitter_stat->year->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_year"));
		$tbl_twitter_stat->year->AdvancedSearch->SearchOperator = $objForm->GetValue("z_year");

		// month
		$tbl_twitter_stat->month->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_month"));
		$tbl_twitter_stat->month->AdvancedSearch->SearchOperator = $objForm->GetValue("z_month");

		// week
		$tbl_twitter_stat->week->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_week"));
		$tbl_twitter_stat->week->AdvancedSearch->SearchOperator = $objForm->GetValue("z_week");

		// following
		$tbl_twitter_stat->following->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_following"));
		$tbl_twitter_stat->following->AdvancedSearch->SearchOperator = $objForm->GetValue("z_following");

		// followers
		$tbl_twitter_stat->followers->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_followers"));
		$tbl_twitter_stat->followers->AdvancedSearch->SearchOperator = $objForm->GetValue("z_followers");

		// listed
		$tbl_twitter_stat->listed->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_listed"));
		$tbl_twitter_stat->listed->AdvancedSearch->SearchOperator = $objForm->GetValue("z_listed");

		// tweets
		$tbl_twitter_stat->tweets->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_tweets"));
		$tbl_twitter_stat->tweets->AdvancedSearch->SearchOperator = $objForm->GetValue("z_tweets");
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
		} elseif ($tbl_twitter_stat->RowType == EW_ROWTYPE_SEARCH) { // Search row

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
			$tbl_twitter_stat->stat_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($tbl_twitter_stat->stat_date->AdvancedSearch->SearchValue, 5), 5));

			// year
			$tbl_twitter_stat->year->EditCustomAttributes = "";
			$tbl_twitter_stat->year->EditValue = ew_HtmlEncode($tbl_twitter_stat->year->AdvancedSearch->SearchValue);

			// month
			$tbl_twitter_stat->month->EditCustomAttributes = "";
			$tbl_twitter_stat->month->EditValue = ew_HtmlEncode($tbl_twitter_stat->month->AdvancedSearch->SearchValue);

			// week
			$tbl_twitter_stat->week->EditCustomAttributes = "";
			$tbl_twitter_stat->week->EditValue = ew_HtmlEncode($tbl_twitter_stat->week->AdvancedSearch->SearchValue);

			// following
			$tbl_twitter_stat->following->EditCustomAttributes = "";
			$tbl_twitter_stat->following->EditValue = ew_HtmlEncode($tbl_twitter_stat->following->AdvancedSearch->SearchValue);

			// followers
			$tbl_twitter_stat->followers->EditCustomAttributes = "";
			$tbl_twitter_stat->followers->EditValue = ew_HtmlEncode($tbl_twitter_stat->followers->AdvancedSearch->SearchValue);

			// listed
			$tbl_twitter_stat->listed->EditCustomAttributes = "";
			$tbl_twitter_stat->listed->EditValue = ew_HtmlEncode($tbl_twitter_stat->listed->AdvancedSearch->SearchValue);

			// tweets
			$tbl_twitter_stat->tweets->EditCustomAttributes = "";
			$tbl_twitter_stat->tweets->EditValue = ew_HtmlEncode($tbl_twitter_stat->tweets->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($tbl_twitter_stat->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_twitter_stat->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $tbl_twitter_stat;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckDate($tbl_twitter_stat->stat_date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_twitter_stat->stat_date->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_twitter_stat->year->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_twitter_stat->year->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_twitter_stat->month->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_twitter_stat->month->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_twitter_stat->week->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_twitter_stat->week->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_twitter_stat->following->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_twitter_stat->following->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_twitter_stat->followers->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_twitter_stat->followers->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_twitter_stat->listed->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_twitter_stat->listed->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_twitter_stat->tweets->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_twitter_stat->tweets->FldErrMsg();
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
		global $tbl_twitter_stat;
		$tbl_twitter_stat->id_profile->AdvancedSearch->SearchValue = $tbl_twitter_stat->getAdvancedSearch("x_id_profile");
		$tbl_twitter_stat->stat_date->AdvancedSearch->SearchValue = $tbl_twitter_stat->getAdvancedSearch("x_stat_date");
		$tbl_twitter_stat->year->AdvancedSearch->SearchValue = $tbl_twitter_stat->getAdvancedSearch("x_year");
		$tbl_twitter_stat->month->AdvancedSearch->SearchValue = $tbl_twitter_stat->getAdvancedSearch("x_month");
		$tbl_twitter_stat->week->AdvancedSearch->SearchValue = $tbl_twitter_stat->getAdvancedSearch("x_week");
		$tbl_twitter_stat->following->AdvancedSearch->SearchValue = $tbl_twitter_stat->getAdvancedSearch("x_following");
		$tbl_twitter_stat->followers->AdvancedSearch->SearchValue = $tbl_twitter_stat->getAdvancedSearch("x_followers");
		$tbl_twitter_stat->listed->AdvancedSearch->SearchValue = $tbl_twitter_stat->getAdvancedSearch("x_listed");
		$tbl_twitter_stat->tweets->AdvancedSearch->SearchValue = $tbl_twitter_stat->getAdvancedSearch("x_tweets");
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
