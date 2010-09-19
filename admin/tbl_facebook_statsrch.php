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
$tbl_facebook_stat_search = new ctbl_facebook_stat_search();
$Page =& $tbl_facebook_stat_search;

// Page init
$tbl_facebook_stat_search->Page_Init();

// Page main
$tbl_facebook_stat_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_facebook_stat_search = new ew_Page("tbl_facebook_stat_search");

// page properties
tbl_facebook_stat_search.PageID = "search"; // page ID
tbl_facebook_stat_search.FormID = "ftbl_facebook_statsearch"; // form ID
var EW_PAGE_ID = tbl_facebook_stat_search.PageID; // for backward compatibility

// extend page with validate function for search
tbl_facebook_stat_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_stat_date"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_facebook_stat->stat_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_facebook_stat->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_facebook_stat->month->FldErrMsg()) ?>");
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
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_facebook_stat->unsubscribe->FldErrMsg()) ?>");

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
tbl_facebook_stat_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_facebook_stat_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_facebook_stat_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_facebook_stat_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_facebook_stat_search.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_facebook_stat_search.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_facebook_stat->TableCaption() ?><br><br>
<a href="<?php echo $tbl_facebook_stat->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_facebook_stat_search->ShowMessage();
?>
<form name="ftbl_facebook_statsearch" id="ftbl_facebook_statsearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_facebook_stat_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="tbl_facebook_stat">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $tbl_facebook_stat->id_profile->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->id_profile->FldCaption() ?></td>
		<td<?php echo $tbl_facebook_stat->id_profile->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id_profile" id="z_id_profile" value="="></span></td>
		<td<?php echo $tbl_facebook_stat->id_profile->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<select id="x_id_profile" name="x_id_profile" title="<?php echo $tbl_facebook_stat->id_profile->FldTitle() ?>"<?php echo $tbl_facebook_stat->id_profile->EditAttributes() ?>>
<?php
if (is_array($tbl_facebook_stat->id_profile->EditValue)) {
	$arwrk = $tbl_facebook_stat->id_profile->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_facebook_stat->id_profile->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<tr<?php echo $tbl_facebook_stat->stat_date->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->stat_date->FldCaption() ?></td>
		<td<?php echo $tbl_facebook_stat->stat_date->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_stat_date" id="z_stat_date" value="="></span></td>
		<td<?php echo $tbl_facebook_stat->stat_date->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_stat_date" id="x_stat_date" title="<?php echo $tbl_facebook_stat->stat_date->FldTitle() ?>" value="<?php echo $tbl_facebook_stat->stat_date->EditValue ?>"<?php echo $tbl_facebook_stat->stat_date->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_facebook_stat->year->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->year->FldCaption() ?></td>
		<td<?php echo $tbl_facebook_stat->year->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_year" id="z_year" value="="></span></td>
		<td<?php echo $tbl_facebook_stat->year->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_year" id="x_year" title="<?php echo $tbl_facebook_stat->year->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->year->EditValue ?>"<?php echo $tbl_facebook_stat->year->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_facebook_stat->month->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->month->FldCaption() ?></td>
		<td<?php echo $tbl_facebook_stat->month->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_month" id="z_month" value="="></span></td>
		<td<?php echo $tbl_facebook_stat->month->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_month" id="x_month" title="<?php echo $tbl_facebook_stat->month->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->month->EditValue ?>"<?php echo $tbl_facebook_stat->month->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_facebook_stat->week->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->week->FldCaption() ?></td>
		<td<?php echo $tbl_facebook_stat->week->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_week" id="z_week" value="="></span></td>
		<td<?php echo $tbl_facebook_stat->week->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_week" id="x_week" title="<?php echo $tbl_facebook_stat->week->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->week->EditValue ?>"<?php echo $tbl_facebook_stat->week->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_facebook_stat->interactions->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->interactions->FldCaption() ?></td>
		<td<?php echo $tbl_facebook_stat->interactions->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_interactions" id="z_interactions" value="="></span></td>
		<td<?php echo $tbl_facebook_stat->interactions->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_interactions" id="x_interactions" title="<?php echo $tbl_facebook_stat->interactions->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->interactions->EditValue ?>"<?php echo $tbl_facebook_stat->interactions->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_facebook_stat->comments->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->comments->FldCaption() ?></td>
		<td<?php echo $tbl_facebook_stat->comments->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_comments" id="z_comments" value="="></span></td>
		<td<?php echo $tbl_facebook_stat->comments->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_comments" id="x_comments" title="<?php echo $tbl_facebook_stat->comments->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->comments->EditValue ?>"<?php echo $tbl_facebook_stat->comments->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_facebook_stat->wallposts->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->wallposts->FldCaption() ?></td>
		<td<?php echo $tbl_facebook_stat->wallposts->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_wallposts" id="z_wallposts" value="="></span></td>
		<td<?php echo $tbl_facebook_stat->wallposts->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_wallposts" id="x_wallposts" title="<?php echo $tbl_facebook_stat->wallposts->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->wallposts->EditValue ?>"<?php echo $tbl_facebook_stat->wallposts->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_facebook_stat->fans->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->fans->FldCaption() ?></td>
		<td<?php echo $tbl_facebook_stat->fans->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_fans" id="z_fans" value="="></span></td>
		<td<?php echo $tbl_facebook_stat->fans->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_fans" id="x_fans" title="<?php echo $tbl_facebook_stat->fans->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->fans->EditValue ?>"<?php echo $tbl_facebook_stat->fans->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_facebook_stat->likes->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->likes->FldCaption() ?></td>
		<td<?php echo $tbl_facebook_stat->likes->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_likes" id="z_likes" value="="></span></td>
		<td<?php echo $tbl_facebook_stat->likes->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_likes" id="x_likes" title="<?php echo $tbl_facebook_stat->likes->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->likes->EditValue ?>"<?php echo $tbl_facebook_stat->likes->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_facebook_stat->unsubscribe->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_facebook_stat->unsubscribe->FldCaption() ?></td>
		<td<?php echo $tbl_facebook_stat->unsubscribe->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_unsubscribe" id="z_unsubscribe" value="="></span></td>
		<td<?php echo $tbl_facebook_stat->unsubscribe->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_unsubscribe" id="x_unsubscribe" title="<?php echo $tbl_facebook_stat->unsubscribe->FldTitle() ?>" size="30" value="<?php echo $tbl_facebook_stat->unsubscribe->EditValue ?>"<?php echo $tbl_facebook_stat->unsubscribe->EditAttributes() ?>>
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
$tbl_facebook_stat_search->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_facebook_stat_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'tbl_facebook_stat';

	// Page object name
	var $PageObjName = 'tbl_facebook_stat_search';

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
	function ctbl_facebook_stat_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_facebook_stat)
		$GLOBALS["tbl_facebook_stat"] = new ctbl_facebook_stat();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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
		if (!$Security->CanSearch()) {
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $tbl_facebook_stat;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$tbl_facebook_stat->CurrentAction = $objForm->GetValue("a_search");
			switch ($tbl_facebook_stat->CurrentAction) {
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
						$sSrchStr = $tbl_facebook_stat->UrlParm($sSrchStr);
						$this->Page_Terminate("tbl_facebook_statlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$tbl_facebook_stat->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $tbl_facebook_stat;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $tbl_facebook_stat->id_profile); // id_profile
	$this->BuildSearchUrl($sSrchUrl, $tbl_facebook_stat->stat_date); // stat_date
	$this->BuildSearchUrl($sSrchUrl, $tbl_facebook_stat->year); // year
	$this->BuildSearchUrl($sSrchUrl, $tbl_facebook_stat->month); // month
	$this->BuildSearchUrl($sSrchUrl, $tbl_facebook_stat->week); // week
	$this->BuildSearchUrl($sSrchUrl, $tbl_facebook_stat->interactions); // interactions
	$this->BuildSearchUrl($sSrchUrl, $tbl_facebook_stat->comments); // comments
	$this->BuildSearchUrl($sSrchUrl, $tbl_facebook_stat->wallposts); // wallposts
	$this->BuildSearchUrl($sSrchUrl, $tbl_facebook_stat->fans); // fans
	$this->BuildSearchUrl($sSrchUrl, $tbl_facebook_stat->likes); // likes
	$this->BuildSearchUrl($sSrchUrl, $tbl_facebook_stat->unsubscribe); // unsubscribe
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
		global $objForm, $tbl_facebook_stat;

		// Load search values
		// id_profile

		$tbl_facebook_stat->id_profile->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id_profile"));
		$tbl_facebook_stat->id_profile->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id_profile");

		// stat_date
		$tbl_facebook_stat->stat_date->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_stat_date"));
		$tbl_facebook_stat->stat_date->AdvancedSearch->SearchOperator = $objForm->GetValue("z_stat_date");

		// year
		$tbl_facebook_stat->year->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_year"));
		$tbl_facebook_stat->year->AdvancedSearch->SearchOperator = $objForm->GetValue("z_year");

		// month
		$tbl_facebook_stat->month->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_month"));
		$tbl_facebook_stat->month->AdvancedSearch->SearchOperator = $objForm->GetValue("z_month");

		// week
		$tbl_facebook_stat->week->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_week"));
		$tbl_facebook_stat->week->AdvancedSearch->SearchOperator = $objForm->GetValue("z_week");

		// interactions
		$tbl_facebook_stat->interactions->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_interactions"));
		$tbl_facebook_stat->interactions->AdvancedSearch->SearchOperator = $objForm->GetValue("z_interactions");

		// comments
		$tbl_facebook_stat->comments->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_comments"));
		$tbl_facebook_stat->comments->AdvancedSearch->SearchOperator = $objForm->GetValue("z_comments");

		// wallposts
		$tbl_facebook_stat->wallposts->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_wallposts"));
		$tbl_facebook_stat->wallposts->AdvancedSearch->SearchOperator = $objForm->GetValue("z_wallposts");

		// fans
		$tbl_facebook_stat->fans->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_fans"));
		$tbl_facebook_stat->fans->AdvancedSearch->SearchOperator = $objForm->GetValue("z_fans");

		// likes
		$tbl_facebook_stat->likes->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_likes"));
		$tbl_facebook_stat->likes->AdvancedSearch->SearchOperator = $objForm->GetValue("z_likes");

		// unsubscribe
		$tbl_facebook_stat->unsubscribe->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_unsubscribe"));
		$tbl_facebook_stat->unsubscribe->AdvancedSearch->SearchOperator = $objForm->GetValue("z_unsubscribe");
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
		} elseif ($tbl_facebook_stat->RowType == EW_ROWTYPE_SEARCH) { // Search row

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
			$tbl_facebook_stat->stat_date->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($tbl_facebook_stat->stat_date->AdvancedSearch->SearchValue, 5), 5));

			// year
			$tbl_facebook_stat->year->EditCustomAttributes = "";
			$tbl_facebook_stat->year->EditValue = ew_HtmlEncode($tbl_facebook_stat->year->AdvancedSearch->SearchValue);

			// month
			$tbl_facebook_stat->month->EditCustomAttributes = "";
			$tbl_facebook_stat->month->EditValue = ew_HtmlEncode($tbl_facebook_stat->month->AdvancedSearch->SearchValue);

			// week
			$tbl_facebook_stat->week->EditCustomAttributes = "";
			$tbl_facebook_stat->week->EditValue = ew_HtmlEncode($tbl_facebook_stat->week->AdvancedSearch->SearchValue);

			// interactions
			$tbl_facebook_stat->interactions->EditCustomAttributes = "";
			$tbl_facebook_stat->interactions->EditValue = ew_HtmlEncode($tbl_facebook_stat->interactions->AdvancedSearch->SearchValue);

			// comments
			$tbl_facebook_stat->comments->EditCustomAttributes = "";
			$tbl_facebook_stat->comments->EditValue = ew_HtmlEncode($tbl_facebook_stat->comments->AdvancedSearch->SearchValue);

			// wallposts
			$tbl_facebook_stat->wallposts->EditCustomAttributes = "";
			$tbl_facebook_stat->wallposts->EditValue = ew_HtmlEncode($tbl_facebook_stat->wallposts->AdvancedSearch->SearchValue);

			// fans
			$tbl_facebook_stat->fans->EditCustomAttributes = "";
			$tbl_facebook_stat->fans->EditValue = ew_HtmlEncode($tbl_facebook_stat->fans->AdvancedSearch->SearchValue);

			// likes
			$tbl_facebook_stat->likes->EditCustomAttributes = "";
			$tbl_facebook_stat->likes->EditValue = ew_HtmlEncode($tbl_facebook_stat->likes->AdvancedSearch->SearchValue);

			// unsubscribe
			$tbl_facebook_stat->unsubscribe->EditCustomAttributes = "";
			$tbl_facebook_stat->unsubscribe->EditValue = ew_HtmlEncode($tbl_facebook_stat->unsubscribe->AdvancedSearch->SearchValue);
		}

		// Call Row Rendered event
		if ($tbl_facebook_stat->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_facebook_stat->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $tbl_facebook_stat;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckDate($tbl_facebook_stat->stat_date->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_facebook_stat->stat_date->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->year->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_facebook_stat->year->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->month->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_facebook_stat->month->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->week->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_facebook_stat->week->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->interactions->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_facebook_stat->interactions->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->comments->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_facebook_stat->comments->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->wallposts->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_facebook_stat->wallposts->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->fans->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_facebook_stat->fans->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->likes->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_facebook_stat->likes->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_facebook_stat->unsubscribe->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_facebook_stat->unsubscribe->FldErrMsg();
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
		global $tbl_facebook_stat;
		$tbl_facebook_stat->id_profile->AdvancedSearch->SearchValue = $tbl_facebook_stat->getAdvancedSearch("x_id_profile");
		$tbl_facebook_stat->stat_date->AdvancedSearch->SearchValue = $tbl_facebook_stat->getAdvancedSearch("x_stat_date");
		$tbl_facebook_stat->year->AdvancedSearch->SearchValue = $tbl_facebook_stat->getAdvancedSearch("x_year");
		$tbl_facebook_stat->month->AdvancedSearch->SearchValue = $tbl_facebook_stat->getAdvancedSearch("x_month");
		$tbl_facebook_stat->week->AdvancedSearch->SearchValue = $tbl_facebook_stat->getAdvancedSearch("x_week");
		$tbl_facebook_stat->interactions->AdvancedSearch->SearchValue = $tbl_facebook_stat->getAdvancedSearch("x_interactions");
		$tbl_facebook_stat->comments->AdvancedSearch->SearchValue = $tbl_facebook_stat->getAdvancedSearch("x_comments");
		$tbl_facebook_stat->wallposts->AdvancedSearch->SearchValue = $tbl_facebook_stat->getAdvancedSearch("x_wallposts");
		$tbl_facebook_stat->fans->AdvancedSearch->SearchValue = $tbl_facebook_stat->getAdvancedSearch("x_fans");
		$tbl_facebook_stat->likes->AdvancedSearch->SearchValue = $tbl_facebook_stat->getAdvancedSearch("x_likes");
		$tbl_facebook_stat->unsubscribe->AdvancedSearch->SearchValue = $tbl_facebook_stat->getAdvancedSearch("x_unsubscribe");
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
