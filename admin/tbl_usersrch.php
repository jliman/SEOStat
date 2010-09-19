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
$tbl_user_search = new ctbl_user_search();
$Page =& $tbl_user_search;

// Page init
$tbl_user_search->Page_Init();

// Page main
$tbl_user_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_user_search = new ew_Page("tbl_user_search");

// page properties
tbl_user_search.PageID = "search"; // page ID
tbl_user_search.FormID = "ftbl_usersearch"; // form ID
var EW_PAGE_ID = tbl_user_search.PageID; // for backward compatibility

// extend page with validate function for search
tbl_user_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_id_user"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_user->id_user->FldErrMsg()) ?>");

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
tbl_user_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_user_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_user_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_user_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_user_search.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_user_search.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_user->TableCaption() ?><br><br>
<a href="<?php echo $tbl_user->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_user_search->ShowMessage();
?>
<form name="ftbl_usersearch" id="ftbl_usersearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_user_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="tbl_user">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $tbl_user->id_user->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_user->id_user->FldCaption() ?></td>
		<td<?php echo $tbl_user->id_user->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id_user" id="z_id_user" value="="></span></td>
		<td<?php echo $tbl_user->id_user->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_id_user" id="x_id_user" title="<?php echo $tbl_user->id_user->FldTitle() ?>" value="<?php echo $tbl_user->id_user->EditValue ?>"<?php echo $tbl_user->id_user->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_user->username->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_user->username->FldCaption() ?></td>
		<td<?php echo $tbl_user->username->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_username" id="z_username" value="LIKE"></span></td>
		<td<?php echo $tbl_user->username->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_username" id="x_username" title="<?php echo $tbl_user->username->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $tbl_user->username->EditValue ?>"<?php echo $tbl_user->username->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_user->passwd->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_user->passwd->FldCaption() ?></td>
		<td<?php echo $tbl_user->passwd->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_passwd" id="z_passwd" value="LIKE"></span></td>
		<td<?php echo $tbl_user->passwd->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_passwd" id="x_passwd" title="<?php echo $tbl_user->passwd->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_user->passwd->EditValue ?>"<?php echo $tbl_user->passwd->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_user->id_userlevel->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_user->id_userlevel->FldCaption() ?></td>
		<td<?php echo $tbl_user->id_userlevel->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id_userlevel" id="z_id_userlevel" value="="></span></td>
		<td<?php echo $tbl_user->id_userlevel->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
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
		$selwrk = (strval($tbl_user->id_userlevel->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
$tbl_user_search->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_user_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'tbl_user';

	// Page object name
	var $PageObjName = 'tbl_user_search';

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
	function ctbl_user_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_user)
		$GLOBALS["tbl_user"] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

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
		if (!$Security->CanSearch()) {
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

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $tbl_user;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$tbl_user->CurrentAction = $objForm->GetValue("a_search");
			switch ($tbl_user->CurrentAction) {
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
						$sSrchStr = $tbl_user->UrlParm($sSrchStr);
						$this->Page_Terminate("tbl_userlist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$tbl_user->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $tbl_user;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $tbl_user->id_user); // id_user
	$this->BuildSearchUrl($sSrchUrl, $tbl_user->username); // username
	$this->BuildSearchUrl($sSrchUrl, $tbl_user->passwd); // passwd
	$this->BuildSearchUrl($sSrchUrl, $tbl_user->id_userlevel); // id_userlevel
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
		global $objForm, $tbl_user;

		// Load search values
		// id_user

		$tbl_user->id_user->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id_user"));
		$tbl_user->id_user->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id_user");

		// username
		$tbl_user->username->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_username"));
		$tbl_user->username->AdvancedSearch->SearchOperator = $objForm->GetValue("z_username");

		// passwd
		$tbl_user->passwd->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_passwd"));
		$tbl_user->passwd->AdvancedSearch->SearchOperator = $objForm->GetValue("z_passwd");

		// id_userlevel
		$tbl_user->id_userlevel->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id_userlevel"));
		$tbl_user->id_userlevel->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id_userlevel");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_user;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_user->Row_Rendering();

		// Common render codes for all row types
		// id_user

		$tbl_user->id_user->CellCssStyle = ""; $tbl_user->id_user->CellCssClass = "";
		$tbl_user->id_user->CellAttrs = array(); $tbl_user->id_user->ViewAttrs = array(); $tbl_user->id_user->EditAttrs = array();

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

			// id_user
			$tbl_user->id_user->HrefValue = "";
			$tbl_user->id_user->TooltipValue = "";

			// username
			$tbl_user->username->HrefValue = "";
			$tbl_user->username->TooltipValue = "";

			// passwd
			$tbl_user->passwd->HrefValue = "";
			$tbl_user->passwd->TooltipValue = "";

			// id_userlevel
			$tbl_user->id_userlevel->HrefValue = "";
			$tbl_user->id_userlevel->TooltipValue = "";
		} elseif ($tbl_user->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id_user
			$tbl_user->id_user->EditCustomAttributes = "";
			$tbl_user->id_user->EditValue = ew_HtmlEncode($tbl_user->id_user->AdvancedSearch->SearchValue);

			// username
			$tbl_user->username->EditCustomAttributes = "";
			$tbl_user->username->EditValue = ew_HtmlEncode($tbl_user->username->AdvancedSearch->SearchValue);

			// passwd
			$tbl_user->passwd->EditCustomAttributes = "";
			$tbl_user->passwd->EditValue = ew_HtmlEncode($tbl_user->passwd->AdvancedSearch->SearchValue);

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

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $tbl_user;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($tbl_user->id_user->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_user->id_user->FldErrMsg();
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
		global $tbl_user;
		$tbl_user->id_user->AdvancedSearch->SearchValue = $tbl_user->getAdvancedSearch("x_id_user");
		$tbl_user->username->AdvancedSearch->SearchValue = $tbl_user->getAdvancedSearch("x_username");
		$tbl_user->passwd->AdvancedSearch->SearchValue = $tbl_user->getAdvancedSearch("x_passwd");
		$tbl_user->id_userlevel->AdvancedSearch->SearchValue = $tbl_user->getAdvancedSearch("x_id_userlevel");
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
