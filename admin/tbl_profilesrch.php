<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_profileinfo.php" ?>
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
$tbl_profile_search = new ctbl_profile_search();
$Page =& $tbl_profile_search;

// Page init
$tbl_profile_search->Page_Init();

// Page main
$tbl_profile_search->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_profile_search = new ew_Page("tbl_profile_search");

// page properties
tbl_profile_search.PageID = "search"; // page ID
tbl_profile_search.FormID = "ftbl_profilesearch"; // form ID
var EW_PAGE_ID = tbl_profile_search.PageID; // for backward compatibility

// extend page with validate function for search
tbl_profile_search.ValidateSearch = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (this.ValidateRequired) {
		var infix = "";
		elm = fobj.elements["x" + infix + "_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_profile->id->FldErrMsg()) ?>");

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
tbl_profile_search.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_profile_search.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_profile_search.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_profile_search.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_profile_search.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_profile_search.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("Search") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_profile->TableCaption() ?><br><br>
<a href="<?php echo $tbl_profile->getReturnUrl() ?>"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_profile_search->ShowMessage();
?>
<form name="ftbl_profilesearch" id="ftbl_profilesearch" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return tbl_profile_search.ValidateSearch(this);">
<p>
<input type="hidden" name="t" id="t" value="tbl_profile">
<input type="hidden" name="a_search" id="a_search" value="S">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
	<tr<?php echo $tbl_profile->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->id->FldCaption() ?></td>
		<td<?php echo $tbl_profile->id->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></span></td>
		<td<?php echo $tbl_profile->id->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_id" id="x_id" title="<?php echo $tbl_profile->id->FldTitle() ?>" value="<?php echo $tbl_profile->id->EditValue ?>"<?php echo $tbl_profile->id->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_profile->name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->name->FldCaption() ?></td>
		<td<?php echo $tbl_profile->name->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_name" id="z_name" value="LIKE"></span></td>
		<td<?php echo $tbl_profile->name->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_name" id="x_name" title="<?php echo $tbl_profile->name->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->name->EditValue ?>"<?php echo $tbl_profile->name->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_profile->ga_username->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->ga_username->FldCaption() ?></td>
		<td<?php echo $tbl_profile->ga_username->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_ga_username" id="z_ga_username" value="LIKE"></span></td>
		<td<?php echo $tbl_profile->ga_username->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ga_username" id="x_ga_username" title="<?php echo $tbl_profile->ga_username->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->ga_username->EditValue ?>"<?php echo $tbl_profile->ga_username->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_profile->ga_passwd->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->ga_passwd->FldCaption() ?></td>
		<td<?php echo $tbl_profile->ga_passwd->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_ga_passwd" id="z_ga_passwd" value="LIKE"></span></td>
		<td<?php echo $tbl_profile->ga_passwd->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ga_passwd" id="x_ga_passwd" title="<?php echo $tbl_profile->ga_passwd->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->ga_passwd->EditValue ?>"<?php echo $tbl_profile->ga_passwd->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_profile->ga_profileid->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->ga_profileid->FldCaption() ?></td>
		<td<?php echo $tbl_profile->ga_profileid->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_ga_profileid" id="z_ga_profileid" value="LIKE"></span></td>
		<td<?php echo $tbl_profile->ga_profileid->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_ga_profileid" id="x_ga_profileid" title="<?php echo $tbl_profile->ga_profileid->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $tbl_profile->ga_profileid->EditValue ?>"<?php echo $tbl_profile->ga_profileid->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_profile->url->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->url->FldCaption() ?></td>
		<td<?php echo $tbl_profile->url->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_url" id="z_url" value="LIKE"></span></td>
		<td<?php echo $tbl_profile->url->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_url" id="x_url" title="<?php echo $tbl_profile->url->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->url->EditValue ?>"<?php echo $tbl_profile->url->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_profile->fb_pageid->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->fb_pageid->FldCaption() ?></td>
		<td<?php echo $tbl_profile->fb_pageid->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_fb_pageid" id="z_fb_pageid" value="LIKE"></span></td>
		<td<?php echo $tbl_profile->fb_pageid->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_fb_pageid" id="x_fb_pageid" title="<?php echo $tbl_profile->fb_pageid->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $tbl_profile->fb_pageid->EditValue ?>"<?php echo $tbl_profile->fb_pageid->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_profile->twitter_page->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->twitter_page->FldCaption() ?></td>
		<td<?php echo $tbl_profile->twitter_page->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_twitter_page" id="z_twitter_page" value="LIKE"></span></td>
		<td<?php echo $tbl_profile->twitter_page->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<input type="text" name="x_twitter_page" id="x_twitter_page" title="<?php echo $tbl_profile->twitter_page->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->twitter_page->EditValue ?>"<?php echo $tbl_profile->twitter_page->EditAttributes() ?>>
</span>
			</div>
		</td>
	</tr>
	<tr<?php echo $tbl_profile->is_wordpress->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->is_wordpress->FldCaption() ?></td>
		<td<?php echo $tbl_profile->is_wordpress->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_is_wordpress" id="z_is_wordpress" value="="></span></td>
		<td<?php echo $tbl_profile->is_wordpress->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_is_wordpress" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_is_wordpress" id="x_is_wordpress" title="<?php echo $tbl_profile->is_wordpress->FldTitle() ?>" value="{value}"<?php echo $tbl_profile->is_wordpress->EditAttributes() ?>></label></div>
<div id="dsl_x_is_wordpress" repeatcolumn="5">
<?php
$arwrk = $tbl_profile->is_wordpress->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_profile->is_wordpress->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_is_wordpress" id="x_is_wordpress" title="<?php echo $tbl_profile->is_wordpress->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_profile->is_wordpress->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
	<tr<?php echo $tbl_profile->is_blogger->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->is_blogger->FldCaption() ?></td>
		<td<?php echo $tbl_profile->is_blogger->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_is_blogger" id="z_is_blogger" value="="></span></td>
		<td<?php echo $tbl_profile->is_blogger->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_is_blogger" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_is_blogger" id="x_is_blogger" title="<?php echo $tbl_profile->is_blogger->FldTitle() ?>" value="{value}"<?php echo $tbl_profile->is_blogger->EditAttributes() ?>></label></div>
<div id="dsl_x_is_blogger" repeatcolumn="5">
<?php
$arwrk = $tbl_profile->is_blogger->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_profile->is_blogger->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_is_blogger" id="x_is_blogger" title="<?php echo $tbl_profile->is_blogger->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_profile->is_blogger->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
	<tr<?php echo $tbl_profile->is_active->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->is_active->FldCaption() ?></td>
		<td<?php echo $tbl_profile->is_active->CellAttributes() ?>><span class="ewSearchOpr"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_is_active" id="z_is_active" value="="></span></td>
		<td<?php echo $tbl_profile->is_active->CellAttributes() ?>>
			<div style="white-space: nowrap;">
				<span class="phpmaker" style="float: left;">
<div id="tp_x_is_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x_is_active" id="x_is_active" title="<?php echo $tbl_profile->is_active->FldTitle() ?>" value="{value}"<?php echo $tbl_profile->is_active->EditAttributes() ?>></label></div>
<div id="dsl_x_is_active" repeatcolumn="5">
<?php
$arwrk = $tbl_profile->is_active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_profile->is_active->AdvancedSearch->SearchValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x_is_active" id="x_is_active" title="<?php echo $tbl_profile->is_active->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_profile->is_active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
$tbl_profile_search->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_profile_search {

	// Page ID
	var $PageID = 'search';

	// Table name
	var $TableName = 'tbl_profile';

	// Page object name
	var $PageObjName = 'tbl_profile_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_profile;
		if ($tbl_profile->UseTokenInUrl) $PageUrl .= "t=" . $tbl_profile->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_profile;
		if ($tbl_profile->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_profile->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_profile->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_profile_search() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_profile)
		$GLOBALS["tbl_profile"] = new ctbl_profile();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_profile', TRUE);

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
		global $tbl_profile;

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
			$this->Page_Terminate("tbl_profilelist.php");
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
		global $objForm, $Language, $gsSearchError, $tbl_profile;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$tbl_profile->CurrentAction = $objForm->GetValue("a_search");
			switch ($tbl_profile->CurrentAction) {
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
						$sSrchStr = $tbl_profile->UrlParm($sSrchStr);
						$this->Page_Terminate("tbl_profilelist.php" . "?" . $sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$tbl_profile->RowType = EW_ROWTYPE_SEARCH;
		$this->RenderRow();
	}

// Build advanced search
function BuildAdvancedSearch() {
	global $tbl_profile;
	$sSrchUrl = "";
	$this->BuildSearchUrl($sSrchUrl, $tbl_profile->id); // id
	$this->BuildSearchUrl($sSrchUrl, $tbl_profile->name); // name
	$this->BuildSearchUrl($sSrchUrl, $tbl_profile->ga_username); // ga_username
	$this->BuildSearchUrl($sSrchUrl, $tbl_profile->ga_passwd); // ga_passwd
	$this->BuildSearchUrl($sSrchUrl, $tbl_profile->ga_profileid); // ga_profileid
	$this->BuildSearchUrl($sSrchUrl, $tbl_profile->url); // url
	$this->BuildSearchUrl($sSrchUrl, $tbl_profile->fb_pageid); // fb_pageid
	$this->BuildSearchUrl($sSrchUrl, $tbl_profile->twitter_page); // twitter_page
	$this->BuildSearchUrl($sSrchUrl, $tbl_profile->is_wordpress); // is_wordpress
	$this->BuildSearchUrl($sSrchUrl, $tbl_profile->is_blogger); // is_blogger
	$this->BuildSearchUrl($sSrchUrl, $tbl_profile->is_active); // is_active
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
		global $objForm, $tbl_profile;

		// Load search values
		// id

		$tbl_profile->id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id"));
		$tbl_profile->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// name
		$tbl_profile->name->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_name"));
		$tbl_profile->name->AdvancedSearch->SearchOperator = $objForm->GetValue("z_name");

		// ga_username
		$tbl_profile->ga_username->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ga_username"));
		$tbl_profile->ga_username->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ga_username");

		// ga_passwd
		$tbl_profile->ga_passwd->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ga_passwd"));
		$tbl_profile->ga_passwd->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ga_passwd");

		// ga_profileid
		$tbl_profile->ga_profileid->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_ga_profileid"));
		$tbl_profile->ga_profileid->AdvancedSearch->SearchOperator = $objForm->GetValue("z_ga_profileid");

		// url
		$tbl_profile->url->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_url"));
		$tbl_profile->url->AdvancedSearch->SearchOperator = $objForm->GetValue("z_url");

		// fb_pageid
		$tbl_profile->fb_pageid->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_fb_pageid"));
		$tbl_profile->fb_pageid->AdvancedSearch->SearchOperator = $objForm->GetValue("z_fb_pageid");

		// twitter_page
		$tbl_profile->twitter_page->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_twitter_page"));
		$tbl_profile->twitter_page->AdvancedSearch->SearchOperator = $objForm->GetValue("z_twitter_page");

		// is_wordpress
		$tbl_profile->is_wordpress->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_is_wordpress"));
		$tbl_profile->is_wordpress->AdvancedSearch->SearchOperator = $objForm->GetValue("z_is_wordpress");

		// is_blogger
		$tbl_profile->is_blogger->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_is_blogger"));
		$tbl_profile->is_blogger->AdvancedSearch->SearchOperator = $objForm->GetValue("z_is_blogger");

		// is_active
		$tbl_profile->is_active->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_is_active"));
		$tbl_profile->is_active->AdvancedSearch->SearchOperator = $objForm->GetValue("z_is_active");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_profile;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_profile->Row_Rendering();

		// Common render codes for all row types
		// id

		$tbl_profile->id->CellCssStyle = ""; $tbl_profile->id->CellCssClass = "";
		$tbl_profile->id->CellAttrs = array(); $tbl_profile->id->ViewAttrs = array(); $tbl_profile->id->EditAttrs = array();

		// name
		$tbl_profile->name->CellCssStyle = ""; $tbl_profile->name->CellCssClass = "";
		$tbl_profile->name->CellAttrs = array(); $tbl_profile->name->ViewAttrs = array(); $tbl_profile->name->EditAttrs = array();

		// ga_username
		$tbl_profile->ga_username->CellCssStyle = ""; $tbl_profile->ga_username->CellCssClass = "";
		$tbl_profile->ga_username->CellAttrs = array(); $tbl_profile->ga_username->ViewAttrs = array(); $tbl_profile->ga_username->EditAttrs = array();

		// ga_passwd
		$tbl_profile->ga_passwd->CellCssStyle = ""; $tbl_profile->ga_passwd->CellCssClass = "";
		$tbl_profile->ga_passwd->CellAttrs = array(); $tbl_profile->ga_passwd->ViewAttrs = array(); $tbl_profile->ga_passwd->EditAttrs = array();

		// ga_profileid
		$tbl_profile->ga_profileid->CellCssStyle = ""; $tbl_profile->ga_profileid->CellCssClass = "";
		$tbl_profile->ga_profileid->CellAttrs = array(); $tbl_profile->ga_profileid->ViewAttrs = array(); $tbl_profile->ga_profileid->EditAttrs = array();

		// url
		$tbl_profile->url->CellCssStyle = ""; $tbl_profile->url->CellCssClass = "";
		$tbl_profile->url->CellAttrs = array(); $tbl_profile->url->ViewAttrs = array(); $tbl_profile->url->EditAttrs = array();

		// fb_pageid
		$tbl_profile->fb_pageid->CellCssStyle = ""; $tbl_profile->fb_pageid->CellCssClass = "";
		$tbl_profile->fb_pageid->CellAttrs = array(); $tbl_profile->fb_pageid->ViewAttrs = array(); $tbl_profile->fb_pageid->EditAttrs = array();

		// twitter_page
		$tbl_profile->twitter_page->CellCssStyle = ""; $tbl_profile->twitter_page->CellCssClass = "";
		$tbl_profile->twitter_page->CellAttrs = array(); $tbl_profile->twitter_page->ViewAttrs = array(); $tbl_profile->twitter_page->EditAttrs = array();

		// is_wordpress
		$tbl_profile->is_wordpress->CellCssStyle = ""; $tbl_profile->is_wordpress->CellCssClass = "";
		$tbl_profile->is_wordpress->CellAttrs = array(); $tbl_profile->is_wordpress->ViewAttrs = array(); $tbl_profile->is_wordpress->EditAttrs = array();

		// is_blogger
		$tbl_profile->is_blogger->CellCssStyle = ""; $tbl_profile->is_blogger->CellCssClass = "";
		$tbl_profile->is_blogger->CellAttrs = array(); $tbl_profile->is_blogger->ViewAttrs = array(); $tbl_profile->is_blogger->EditAttrs = array();

		// is_active
		$tbl_profile->is_active->CellCssStyle = ""; $tbl_profile->is_active->CellCssClass = "";
		$tbl_profile->is_active->CellAttrs = array(); $tbl_profile->is_active->ViewAttrs = array(); $tbl_profile->is_active->EditAttrs = array();
		if ($tbl_profile->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$tbl_profile->id->ViewValue = $tbl_profile->id->CurrentValue;
			$tbl_profile->id->CssStyle = "";
			$tbl_profile->id->CssClass = "";
			$tbl_profile->id->ViewCustomAttributes = "";

			// name
			$tbl_profile->name->ViewValue = $tbl_profile->name->CurrentValue;
			$tbl_profile->name->CssStyle = "";
			$tbl_profile->name->CssClass = "";
			$tbl_profile->name->ViewCustomAttributes = "";

			// ga_username
			$tbl_profile->ga_username->ViewValue = $tbl_profile->ga_username->CurrentValue;
			$tbl_profile->ga_username->CssStyle = "";
			$tbl_profile->ga_username->CssClass = "";
			$tbl_profile->ga_username->ViewCustomAttributes = "";

			// ga_passwd
			$tbl_profile->ga_passwd->ViewValue = $tbl_profile->ga_passwd->CurrentValue;
			$tbl_profile->ga_passwd->CssStyle = "";
			$tbl_profile->ga_passwd->CssClass = "";
			$tbl_profile->ga_passwd->ViewCustomAttributes = "";

			// ga_profileid
			$tbl_profile->ga_profileid->ViewValue = $tbl_profile->ga_profileid->CurrentValue;
			$tbl_profile->ga_profileid->CssStyle = "";
			$tbl_profile->ga_profileid->CssClass = "";
			$tbl_profile->ga_profileid->ViewCustomAttributes = "";

			// url
			$tbl_profile->url->ViewValue = $tbl_profile->url->CurrentValue;
			$tbl_profile->url->CssStyle = "";
			$tbl_profile->url->CssClass = "";
			$tbl_profile->url->ViewCustomAttributes = "";

			// fb_pageid
			$tbl_profile->fb_pageid->ViewValue = $tbl_profile->fb_pageid->CurrentValue;
			$tbl_profile->fb_pageid->CssStyle = "";
			$tbl_profile->fb_pageid->CssClass = "";
			$tbl_profile->fb_pageid->ViewCustomAttributes = "";

			// twitter_page
			$tbl_profile->twitter_page->ViewValue = $tbl_profile->twitter_page->CurrentValue;
			$tbl_profile->twitter_page->CssStyle = "";
			$tbl_profile->twitter_page->CssClass = "";
			$tbl_profile->twitter_page->ViewCustomAttributes = "";

			// is_wordpress
			if (strval($tbl_profile->is_wordpress->CurrentValue) <> "") {
				switch ($tbl_profile->is_wordpress->CurrentValue) {
					case "0":
						$tbl_profile->is_wordpress->ViewValue = "No";
						break;
					case "1":
						$tbl_profile->is_wordpress->ViewValue = "Yes";
						break;
					default:
						$tbl_profile->is_wordpress->ViewValue = $tbl_profile->is_wordpress->CurrentValue;
				}
			} else {
				$tbl_profile->is_wordpress->ViewValue = NULL;
			}
			$tbl_profile->is_wordpress->CssStyle = "";
			$tbl_profile->is_wordpress->CssClass = "";
			$tbl_profile->is_wordpress->ViewCustomAttributes = "";

			// is_blogger
			if (strval($tbl_profile->is_blogger->CurrentValue) <> "") {
				switch ($tbl_profile->is_blogger->CurrentValue) {
					case "0":
						$tbl_profile->is_blogger->ViewValue = "No";
						break;
					case "1":
						$tbl_profile->is_blogger->ViewValue = "Yes";
						break;
					default:
						$tbl_profile->is_blogger->ViewValue = $tbl_profile->is_blogger->CurrentValue;
				}
			} else {
				$tbl_profile->is_blogger->ViewValue = NULL;
			}
			$tbl_profile->is_blogger->CssStyle = "";
			$tbl_profile->is_blogger->CssClass = "";
			$tbl_profile->is_blogger->ViewCustomAttributes = "";

			// is_active
			if (strval($tbl_profile->is_active->CurrentValue) <> "") {
				switch ($tbl_profile->is_active->CurrentValue) {
					case "0":
						$tbl_profile->is_active->ViewValue = "No";
						break;
					case "1":
						$tbl_profile->is_active->ViewValue = "Yes";
						break;
					default:
						$tbl_profile->is_active->ViewValue = $tbl_profile->is_active->CurrentValue;
				}
			} else {
				$tbl_profile->is_active->ViewValue = NULL;
			}
			$tbl_profile->is_active->CssStyle = "";
			$tbl_profile->is_active->CssClass = "";
			$tbl_profile->is_active->ViewCustomAttributes = "";

			// id
			$tbl_profile->id->HrefValue = "";
			$tbl_profile->id->TooltipValue = "";

			// name
			$tbl_profile->name->HrefValue = "";
			$tbl_profile->name->TooltipValue = "";

			// ga_username
			$tbl_profile->ga_username->HrefValue = "";
			$tbl_profile->ga_username->TooltipValue = "";

			// ga_passwd
			$tbl_profile->ga_passwd->HrefValue = "";
			$tbl_profile->ga_passwd->TooltipValue = "";

			// ga_profileid
			$tbl_profile->ga_profileid->HrefValue = "";
			$tbl_profile->ga_profileid->TooltipValue = "";

			// url
			$tbl_profile->url->HrefValue = "";
			$tbl_profile->url->TooltipValue = "";

			// fb_pageid
			$tbl_profile->fb_pageid->HrefValue = "";
			$tbl_profile->fb_pageid->TooltipValue = "";

			// twitter_page
			$tbl_profile->twitter_page->HrefValue = "";
			$tbl_profile->twitter_page->TooltipValue = "";

			// is_wordpress
			$tbl_profile->is_wordpress->HrefValue = "";
			$tbl_profile->is_wordpress->TooltipValue = "";

			// is_blogger
			$tbl_profile->is_blogger->HrefValue = "";
			$tbl_profile->is_blogger->TooltipValue = "";

			// is_active
			$tbl_profile->is_active->HrefValue = "";
			$tbl_profile->is_active->TooltipValue = "";
		} elseif ($tbl_profile->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// id
			$tbl_profile->id->EditCustomAttributes = "";
			$tbl_profile->id->EditValue = ew_HtmlEncode($tbl_profile->id->AdvancedSearch->SearchValue);

			// name
			$tbl_profile->name->EditCustomAttributes = "";
			$tbl_profile->name->EditValue = ew_HtmlEncode($tbl_profile->name->AdvancedSearch->SearchValue);

			// ga_username
			$tbl_profile->ga_username->EditCustomAttributes = "";
			$tbl_profile->ga_username->EditValue = ew_HtmlEncode($tbl_profile->ga_username->AdvancedSearch->SearchValue);

			// ga_passwd
			$tbl_profile->ga_passwd->EditCustomAttributes = "";
			$tbl_profile->ga_passwd->EditValue = ew_HtmlEncode($tbl_profile->ga_passwd->AdvancedSearch->SearchValue);

			// ga_profileid
			$tbl_profile->ga_profileid->EditCustomAttributes = "";
			$tbl_profile->ga_profileid->EditValue = ew_HtmlEncode($tbl_profile->ga_profileid->AdvancedSearch->SearchValue);

			// url
			$tbl_profile->url->EditCustomAttributes = "";
			$tbl_profile->url->EditValue = ew_HtmlEncode($tbl_profile->url->AdvancedSearch->SearchValue);

			// fb_pageid
			$tbl_profile->fb_pageid->EditCustomAttributes = "";
			$tbl_profile->fb_pageid->EditValue = ew_HtmlEncode($tbl_profile->fb_pageid->AdvancedSearch->SearchValue);

			// twitter_page
			$tbl_profile->twitter_page->EditCustomAttributes = "";
			$tbl_profile->twitter_page->EditValue = ew_HtmlEncode($tbl_profile->twitter_page->AdvancedSearch->SearchValue);

			// is_wordpress
			$tbl_profile->is_wordpress->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$tbl_profile->is_wordpress->EditValue = $arwrk;

			// is_blogger
			$tbl_profile->is_blogger->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$tbl_profile->is_blogger->EditValue = $arwrk;

			// is_active
			$tbl_profile->is_active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("0", "No");
			$arwrk[] = array("1", "Yes");
			$tbl_profile->is_active->EditValue = $arwrk;
		}

		// Call Row Rendered event
		if ($tbl_profile->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_profile->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $tbl_profile;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($tbl_profile->id->AdvancedSearch->SearchValue)) {
			if ($gsSearchError <> "") $gsSearchError .= "<br>";
			$gsSearchError .= $tbl_profile->id->FldErrMsg();
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
		global $tbl_profile;
		$tbl_profile->id->AdvancedSearch->SearchValue = $tbl_profile->getAdvancedSearch("x_id");
		$tbl_profile->name->AdvancedSearch->SearchValue = $tbl_profile->getAdvancedSearch("x_name");
		$tbl_profile->ga_username->AdvancedSearch->SearchValue = $tbl_profile->getAdvancedSearch("x_ga_username");
		$tbl_profile->ga_passwd->AdvancedSearch->SearchValue = $tbl_profile->getAdvancedSearch("x_ga_passwd");
		$tbl_profile->ga_profileid->AdvancedSearch->SearchValue = $tbl_profile->getAdvancedSearch("x_ga_profileid");
		$tbl_profile->url->AdvancedSearch->SearchValue = $tbl_profile->getAdvancedSearch("x_url");
		$tbl_profile->fb_pageid->AdvancedSearch->SearchValue = $tbl_profile->getAdvancedSearch("x_fb_pageid");
		$tbl_profile->twitter_page->AdvancedSearch->SearchValue = $tbl_profile->getAdvancedSearch("x_twitter_page");
		$tbl_profile->is_wordpress->AdvancedSearch->SearchValue = $tbl_profile->getAdvancedSearch("x_is_wordpress");
		$tbl_profile->is_blogger->AdvancedSearch->SearchValue = $tbl_profile->getAdvancedSearch("x_is_blogger");
		$tbl_profile->is_active->AdvancedSearch->SearchValue = $tbl_profile->getAdvancedSearch("x_is_active");
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
