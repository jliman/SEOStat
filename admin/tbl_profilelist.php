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
$tbl_profile_list = new ctbl_profile_list();
$Page =& $tbl_profile_list;

// Page init
$tbl_profile_list->Page_Init();

// Page main
$tbl_profile_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_profile->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_profile_list = new ew_Page("tbl_profile_list");

// page properties
tbl_profile_list.PageID = "list"; // page ID
tbl_profile_list.FormID = "ftbl_profilelist"; // form ID
var EW_PAGE_ID = tbl_profile_list.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_profile_list.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_name"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_profile->name->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_ga_username"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_profile->ga_username->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_ga_passwd"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_profile->ga_passwd->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_ga_profileid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_profile->ga_profileid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_url"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_profile->url->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_profile_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_profile_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_profile_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_profile_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_profile_list.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_profile_list.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<?php } ?>
<?php if ($tbl_profile->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$tbl_profile_list->lTotalRecs = $tbl_profile->SelectRecordCount();
	} else {
		if ($rs = $tbl_profile_list->LoadRecordset())
			$tbl_profile_list->lTotalRecs = $rs->RecordCount();
	}
	$tbl_profile_list->lStartRec = 1;
	if ($tbl_profile_list->lDisplayRecs <= 0 || ($tbl_profile->Export <> "" && $tbl_profile->ExportAll)) // Display all records
		$tbl_profile_list->lDisplayRecs = $tbl_profile_list->lTotalRecs;
	if (!($tbl_profile->Export <> "" && $tbl_profile->ExportAll))
		$tbl_profile_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $tbl_profile_list->LoadRecordset($tbl_profile_list->lStartRec-1, $tbl_profile_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_profile->TableCaption() ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($tbl_profile->Export == "" && $tbl_profile->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(tbl_profile_list);" style="text-decoration: none;"><img id="tbl_profile_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="tbl_profile_list_SearchPanel">
<form name="ftbl_profilelistsrch" id="ftbl_profilelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="tbl_profile">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($tbl_profile->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $tbl_profile_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="tbl_profilesrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
			<?php if ($tbl_profile_list->sSrchWhere <> "" && $tbl_profile_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(tbl_profile_list, this, '<?php echo $tbl_profile->HighlightName() ?>');"><?php echo $Language->Phrase("HideHighlight") ?></a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($tbl_profile->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($tbl_profile->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($tbl_profile->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_profile_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($tbl_profile->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($tbl_profile->CurrentAction <> "gridadd" && $tbl_profile->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_profile_list->Pager)) $tbl_profile_list->Pager = new cPrevNextPager($tbl_profile_list->lStartRec, $tbl_profile_list->lDisplayRecs, $tbl_profile_list->lTotalRecs) ?>
<?php if ($tbl_profile_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_profile_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_profile_list->PageUrl() ?>start=<?php echo $tbl_profile_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_profile_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_profile_list->PageUrl() ?>start=<?php echo $tbl_profile_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_profile_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_profile_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_profile_list->PageUrl() ?>start=<?php echo $tbl_profile_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_profile_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_profile_list->PageUrl() ?>start=<?php echo $tbl_profile_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_profile_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_profile_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_profile_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_profile_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_profile_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($tbl_profile_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tbl_profile">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="15"<?php if ($tbl_profile_list->lDisplayRecs == 15) { ?> selected="selected"<?php } ?>>15</option>
<option value="30"<?php if ($tbl_profile_list->lDisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="75"<?php if ($tbl_profile_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($tbl_profile_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($tbl_profile->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_profile_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $tbl_profile_list->InlineAddUrl ?>"><?php echo $Language->Phrase("InlineAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($tbl_profile_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftbl_profilelist, '<?php echo $tbl_profile_list->MultiDeleteUrl ?>', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="ftbl_profilelist" id="ftbl_profilelist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="tbl_profile">
<div id="gmp_tbl_profile" class="ewGridMiddlePanel">
<?php if ($tbl_profile_list->lTotalRecs > 0 || $tbl_profile->CurrentAction == "add" || $tbl_profile->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $tbl_profile->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$tbl_profile_list->RenderListOptions();

// Render list options (header, left)
$tbl_profile_list->ListOptions->Render("header", "left");
?>
<?php if ($tbl_profile->id->Visible) { // id ?>
	<?php if ($tbl_profile->SortUrl($tbl_profile->id) == "") { ?>
		<td><?php echo $tbl_profile->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_profile->SortUrl($tbl_profile->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_profile->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_profile->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_profile->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_profile->name->Visible) { // name ?>
	<?php if ($tbl_profile->SortUrl($tbl_profile->name) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $tbl_profile->name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_profile->SortUrl($tbl_profile->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $tbl_profile->name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_profile->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_profile->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_profile->ga_username->Visible) { // ga_username ?>
	<?php if ($tbl_profile->SortUrl($tbl_profile->ga_username) == "") { ?>
		<td><?php echo $tbl_profile->ga_username->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_profile->SortUrl($tbl_profile->ga_username) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_profile->ga_username->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_profile->ga_username->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_profile->ga_username->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_profile->ga_passwd->Visible) { // ga_passwd ?>
	<?php if ($tbl_profile->SortUrl($tbl_profile->ga_passwd) == "") { ?>
		<td><?php echo $tbl_profile->ga_passwd->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_profile->SortUrl($tbl_profile->ga_passwd) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_profile->ga_passwd->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_profile->ga_passwd->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_profile->ga_passwd->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_profile->ga_profileid->Visible) { // ga_profileid ?>
	<?php if ($tbl_profile->SortUrl($tbl_profile->ga_profileid) == "") { ?>
		<td><?php echo $tbl_profile->ga_profileid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_profile->SortUrl($tbl_profile->ga_profileid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_profile->ga_profileid->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_profile->ga_profileid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_profile->ga_profileid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_profile->url->Visible) { // url ?>
	<?php if ($tbl_profile->SortUrl($tbl_profile->url) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $tbl_profile->url->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_profile->SortUrl($tbl_profile->url) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $tbl_profile->url->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_profile->url->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_profile->url->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_profile->fb_pageid->Visible) { // fb_pageid ?>
	<?php if ($tbl_profile->SortUrl($tbl_profile->fb_pageid) == "") { ?>
		<td><?php echo $tbl_profile->fb_pageid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_profile->SortUrl($tbl_profile->fb_pageid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_profile->fb_pageid->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_profile->fb_pageid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_profile->fb_pageid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_profile->twitter_page->Visible) { // twitter_page ?>
	<?php if ($tbl_profile->SortUrl($tbl_profile->twitter_page) == "") { ?>
		<td><?php echo $tbl_profile->twitter_page->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_profile->SortUrl($tbl_profile->twitter_page) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_profile->twitter_page->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_profile->twitter_page->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_profile->twitter_page->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_profile->is_wordpress->Visible) { // is_wordpress ?>
	<?php if ($tbl_profile->SortUrl($tbl_profile->is_wordpress) == "") { ?>
		<td><?php echo $tbl_profile->is_wordpress->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_profile->SortUrl($tbl_profile->is_wordpress) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_profile->is_wordpress->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_profile->is_wordpress->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_profile->is_wordpress->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_profile->is_blogger->Visible) { // is_blogger ?>
	<?php if ($tbl_profile->SortUrl($tbl_profile->is_blogger) == "") { ?>
		<td><?php echo $tbl_profile->is_blogger->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_profile->SortUrl($tbl_profile->is_blogger) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_profile->is_blogger->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_profile->is_blogger->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_profile->is_blogger->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_profile->is_active->Visible) { // is_active ?>
	<?php if ($tbl_profile->SortUrl($tbl_profile->is_active) == "") { ?>
		<td><?php echo $tbl_profile->is_active->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_profile->SortUrl($tbl_profile->is_active) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_profile->is_active->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_profile->is_active->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_profile->is_active->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$tbl_profile_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
	if ($tbl_profile->CurrentAction == "add" || $tbl_profile->CurrentAction == "copy") {
		$tbl_profile_list->lRowIndex = 1;
		if ($tbl_profile->CurrentAction == "add")
			$tbl_profile_list->LoadDefaultValues();
		if ($tbl_profile->EventCancelled) // Insert failed
			$tbl_profile_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$tbl_profile->CssClass = "ewTableEditRow";
		$tbl_profile->CssStyle = "";
		$tbl_profile->RowAttrs = array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		$tbl_profile->RowType = EW_ROWTYPE_ADD;

		// Render row
		$tbl_profile_list->RenderRow();

		// Render list options
		$tbl_profile_list->RenderListOptions();
?>
	<tr<?php echo $tbl_profile->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_profile_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_profile->id->Visible) { // id ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($tbl_profile->name->Visible) { // name ?>
		<td>
<input type="text" name="x<?php echo $tbl_profile_list->lRowIndex ?>_name" id="x<?php echo $tbl_profile_list->lRowIndex ?>_name" title="<?php echo $tbl_profile->name->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->name->EditValue ?>"<?php echo $tbl_profile->name->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_profile->ga_username->Visible) { // ga_username ?>
		<td>
<input type="text" name="x<?php echo $tbl_profile_list->lRowIndex ?>_ga_username" id="x<?php echo $tbl_profile_list->lRowIndex ?>_ga_username" title="<?php echo $tbl_profile->ga_username->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->ga_username->EditValue ?>"<?php echo $tbl_profile->ga_username->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_profile->ga_passwd->Visible) { // ga_passwd ?>
		<td>
<input type="text" name="x<?php echo $tbl_profile_list->lRowIndex ?>_ga_passwd" id="x<?php echo $tbl_profile_list->lRowIndex ?>_ga_passwd" title="<?php echo $tbl_profile->ga_passwd->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->ga_passwd->EditValue ?>"<?php echo $tbl_profile->ga_passwd->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_profile->ga_profileid->Visible) { // ga_profileid ?>
		<td>
<input type="text" name="x<?php echo $tbl_profile_list->lRowIndex ?>_ga_profileid" id="x<?php echo $tbl_profile_list->lRowIndex ?>_ga_profileid" title="<?php echo $tbl_profile->ga_profileid->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $tbl_profile->ga_profileid->EditValue ?>"<?php echo $tbl_profile->ga_profileid->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_profile->url->Visible) { // url ?>
		<td>
<input type="text" name="x<?php echo $tbl_profile_list->lRowIndex ?>_url" id="x<?php echo $tbl_profile_list->lRowIndex ?>_url" title="<?php echo $tbl_profile->url->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->url->EditValue ?>"<?php echo $tbl_profile->url->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_profile->fb_pageid->Visible) { // fb_pageid ?>
		<td>
<input type="text" name="x<?php echo $tbl_profile_list->lRowIndex ?>_fb_pageid" id="x<?php echo $tbl_profile_list->lRowIndex ?>_fb_pageid" title="<?php echo $tbl_profile->fb_pageid->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $tbl_profile->fb_pageid->EditValue ?>"<?php echo $tbl_profile->fb_pageid->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_profile->twitter_page->Visible) { // twitter_page ?>
		<td>
<input type="text" name="x<?php echo $tbl_profile_list->lRowIndex ?>_twitter_page" id="x<?php echo $tbl_profile_list->lRowIndex ?>_twitter_page" title="<?php echo $tbl_profile->twitter_page->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->twitter_page->EditValue ?>"<?php echo $tbl_profile->twitter_page->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_profile->is_wordpress->Visible) { // is_wordpress ?>
		<td>
<div id="tp_x<?php echo $tbl_profile_list->lRowIndex ?>_is_wordpress" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x<?php echo $tbl_profile_list->lRowIndex ?>_is_wordpress" id="x<?php echo $tbl_profile_list->lRowIndex ?>_is_wordpress" title="<?php echo $tbl_profile->is_wordpress->FldTitle() ?>" value="{value}"<?php echo $tbl_profile->is_wordpress->EditAttributes() ?>></label></div>
<div id="dsl_x<?php echo $tbl_profile_list->lRowIndex ?>_is_wordpress" repeatcolumn="5">
<?php
$arwrk = $tbl_profile->is_wordpress->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_profile->is_wordpress->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $tbl_profile_list->lRowIndex ?>_is_wordpress" id="x<?php echo $tbl_profile_list->lRowIndex ?>_is_wordpress" title="<?php echo $tbl_profile->is_wordpress->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_profile->is_wordpress->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</td>
	<?php } ?>
	<?php if ($tbl_profile->is_blogger->Visible) { // is_blogger ?>
		<td>
<div id="tp_x<?php echo $tbl_profile_list->lRowIndex ?>_is_blogger" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x<?php echo $tbl_profile_list->lRowIndex ?>_is_blogger" id="x<?php echo $tbl_profile_list->lRowIndex ?>_is_blogger" title="<?php echo $tbl_profile->is_blogger->FldTitle() ?>" value="{value}"<?php echo $tbl_profile->is_blogger->EditAttributes() ?>></label></div>
<div id="dsl_x<?php echo $tbl_profile_list->lRowIndex ?>_is_blogger" repeatcolumn="5">
<?php
$arwrk = $tbl_profile->is_blogger->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_profile->is_blogger->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $tbl_profile_list->lRowIndex ?>_is_blogger" id="x<?php echo $tbl_profile_list->lRowIndex ?>_is_blogger" title="<?php echo $tbl_profile->is_blogger->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_profile->is_blogger->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</td>
	<?php } ?>
	<?php if ($tbl_profile->is_active->Visible) { // is_active ?>
		<td>
<div id="tp_x<?php echo $tbl_profile_list->lRowIndex ?>_is_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x<?php echo $tbl_profile_list->lRowIndex ?>_is_active" id="x<?php echo $tbl_profile_list->lRowIndex ?>_is_active" title="<?php echo $tbl_profile->is_active->FldTitle() ?>" value="{value}"<?php echo $tbl_profile->is_active->EditAttributes() ?>></label></div>
<div id="dsl_x<?php echo $tbl_profile_list->lRowIndex ?>_is_active" repeatcolumn="5">
<?php
$arwrk = $tbl_profile->is_active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_profile->is_active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $tbl_profile_list->lRowIndex ?>_is_active" id="x<?php echo $tbl_profile_list->lRowIndex ?>_is_active" title="<?php echo $tbl_profile->is_active->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_profile->is_active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_profile_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
<?php
if ($tbl_profile->ExportAll && $tbl_profile->Export <> "") {
	$tbl_profile_list->lStopRec = $tbl_profile_list->lTotalRecs;
} else {
	$tbl_profile_list->lStopRec = $tbl_profile_list->lStartRec + $tbl_profile_list->lDisplayRecs - 1; // Set the last record to display
}
$tbl_profile_list->lRecCount = $tbl_profile_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $tbl_profile_list->lStartRec > 1)
		$rs->Move($tbl_profile_list->lStartRec - 1);
}

// Initialize aggregate
$tbl_profile->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tbl_profile_list->RenderRow();
$tbl_profile_list->lRowCnt = 0;
$tbl_profile_list->lEditRowCnt = 0;
if ($tbl_profile->CurrentAction == "edit")
	$tbl_profile_list->lRowIndex = 1;
while (($tbl_profile->CurrentAction == "gridadd" || !$rs->EOF) &&
	$tbl_profile_list->lRecCount < $tbl_profile_list->lStopRec) {
	$tbl_profile_list->lRecCount++;
	if (intval($tbl_profile_list->lRecCount) >= intval($tbl_profile_list->lStartRec)) {
		$tbl_profile_list->lRowCnt++;

	// Init row class and style
	$tbl_profile->CssClass = "";
	$tbl_profile->CssStyle = "";
	$tbl_profile->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($tbl_profile->CurrentAction == "gridadd") {
		$tbl_profile_list->LoadDefaultValues(); // Load default values
	} else {
		$tbl_profile_list->LoadRowValues($rs); // Load row values
	}
	$tbl_profile->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($tbl_profile->CurrentAction == "edit") {
		if ($tbl_profile_list->CheckInlineEditKey() && $tbl_profile_list->lEditRowCnt == 0) { // Inline edit
			$tbl_profile->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
	}
	if ($tbl_profile->RowType == EW_ROWTYPE_EDIT && $tbl_profile->EventCancelled) { // Update failed
		if ($tbl_profile->CurrentAction == "edit")
			$tbl_profile_list->RestoreFormValues(); // Restore form values
	}
	if ($tbl_profile->RowType == EW_ROWTYPE_EDIT) // Edit row
		$tbl_profile_list->lEditRowCnt++;
	if ($tbl_profile->RowType == EW_ROWTYPE_ADD || $tbl_profile->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
		$tbl_profile->RowAttrs = array_merge($tbl_profile->RowAttrs, array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);'));
		$tbl_profile->CssClass = "ewTableEditRow";
	}

	// Render row
	$tbl_profile_list->RenderRow();

	// Render list options
	$tbl_profile_list->RenderListOptions();
?>
	<tr<?php echo $tbl_profile->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_profile_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_profile->id->Visible) { // id ?>
		<td<?php echo $tbl_profile->id->CellAttributes() ?>>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $tbl_profile->id->ViewAttributes() ?>><?php echo $tbl_profile->id->EditValue ?></div><input type="hidden" name="x<?php echo $tbl_profile_list->lRowIndex ?>_id" id="x<?php echo $tbl_profile_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($tbl_profile->id->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_profile->id->ViewAttributes() ?>><?php echo $tbl_profile->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_profile->name->Visible) { // name ?>
		<td<?php echo $tbl_profile->name->CellAttributes() ?>>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_profile_list->lRowIndex ?>_name" id="x<?php echo $tbl_profile_list->lRowIndex ?>_name" title="<?php echo $tbl_profile->name->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->name->EditValue ?>"<?php echo $tbl_profile->name->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_profile->name->ViewAttributes() ?>><?php echo $tbl_profile->name->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_profile->ga_username->Visible) { // ga_username ?>
		<td<?php echo $tbl_profile->ga_username->CellAttributes() ?>>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_profile_list->lRowIndex ?>_ga_username" id="x<?php echo $tbl_profile_list->lRowIndex ?>_ga_username" title="<?php echo $tbl_profile->ga_username->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->ga_username->EditValue ?>"<?php echo $tbl_profile->ga_username->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_profile->ga_username->ViewAttributes() ?>><?php echo $tbl_profile->ga_username->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_profile->ga_passwd->Visible) { // ga_passwd ?>
		<td<?php echo $tbl_profile->ga_passwd->CellAttributes() ?>>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_profile_list->lRowIndex ?>_ga_passwd" id="x<?php echo $tbl_profile_list->lRowIndex ?>_ga_passwd" title="<?php echo $tbl_profile->ga_passwd->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->ga_passwd->EditValue ?>"<?php echo $tbl_profile->ga_passwd->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_profile->ga_passwd->ViewAttributes() ?>><?php echo $tbl_profile->ga_passwd->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_profile->ga_profileid->Visible) { // ga_profileid ?>
		<td<?php echo $tbl_profile->ga_profileid->CellAttributes() ?>>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_profile_list->lRowIndex ?>_ga_profileid" id="x<?php echo $tbl_profile_list->lRowIndex ?>_ga_profileid" title="<?php echo $tbl_profile->ga_profileid->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $tbl_profile->ga_profileid->EditValue ?>"<?php echo $tbl_profile->ga_profileid->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_profile->ga_profileid->ViewAttributes() ?>><?php echo $tbl_profile->ga_profileid->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_profile->url->Visible) { // url ?>
		<td<?php echo $tbl_profile->url->CellAttributes() ?>>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_profile_list->lRowIndex ?>_url" id="x<?php echo $tbl_profile_list->lRowIndex ?>_url" title="<?php echo $tbl_profile->url->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->url->EditValue ?>"<?php echo $tbl_profile->url->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_profile->url->ViewAttributes() ?>><?php echo $tbl_profile->url->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_profile->fb_pageid->Visible) { // fb_pageid ?>
		<td<?php echo $tbl_profile->fb_pageid->CellAttributes() ?>>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_profile_list->lRowIndex ?>_fb_pageid" id="x<?php echo $tbl_profile_list->lRowIndex ?>_fb_pageid" title="<?php echo $tbl_profile->fb_pageid->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $tbl_profile->fb_pageid->EditValue ?>"<?php echo $tbl_profile->fb_pageid->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_profile->fb_pageid->ViewAttributes() ?>><?php echo $tbl_profile->fb_pageid->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_profile->twitter_page->Visible) { // twitter_page ?>
		<td<?php echo $tbl_profile->twitter_page->CellAttributes() ?>>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_profile_list->lRowIndex ?>_twitter_page" id="x<?php echo $tbl_profile_list->lRowIndex ?>_twitter_page" title="<?php echo $tbl_profile->twitter_page->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_profile->twitter_page->EditValue ?>"<?php echo $tbl_profile->twitter_page->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_profile->twitter_page->ViewAttributes() ?>><?php echo $tbl_profile->twitter_page->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_profile->is_wordpress->Visible) { // is_wordpress ?>
		<td<?php echo $tbl_profile->is_wordpress->CellAttributes() ?>>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $tbl_profile_list->lRowIndex ?>_is_wordpress" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x<?php echo $tbl_profile_list->lRowIndex ?>_is_wordpress" id="x<?php echo $tbl_profile_list->lRowIndex ?>_is_wordpress" title="<?php echo $tbl_profile->is_wordpress->FldTitle() ?>" value="{value}"<?php echo $tbl_profile->is_wordpress->EditAttributes() ?>></label></div>
<div id="dsl_x<?php echo $tbl_profile_list->lRowIndex ?>_is_wordpress" repeatcolumn="5">
<?php
$arwrk = $tbl_profile->is_wordpress->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_profile->is_wordpress->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $tbl_profile_list->lRowIndex ?>_is_wordpress" id="x<?php echo $tbl_profile_list->lRowIndex ?>_is_wordpress" title="<?php echo $tbl_profile->is_wordpress->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_profile->is_wordpress->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
<?php } ?>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_profile->is_wordpress->ViewAttributes() ?>><?php echo $tbl_profile->is_wordpress->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_profile->is_blogger->Visible) { // is_blogger ?>
		<td<?php echo $tbl_profile->is_blogger->CellAttributes() ?>>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $tbl_profile_list->lRowIndex ?>_is_blogger" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x<?php echo $tbl_profile_list->lRowIndex ?>_is_blogger" id="x<?php echo $tbl_profile_list->lRowIndex ?>_is_blogger" title="<?php echo $tbl_profile->is_blogger->FldTitle() ?>" value="{value}"<?php echo $tbl_profile->is_blogger->EditAttributes() ?>></label></div>
<div id="dsl_x<?php echo $tbl_profile_list->lRowIndex ?>_is_blogger" repeatcolumn="5">
<?php
$arwrk = $tbl_profile->is_blogger->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_profile->is_blogger->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $tbl_profile_list->lRowIndex ?>_is_blogger" id="x<?php echo $tbl_profile_list->lRowIndex ?>_is_blogger" title="<?php echo $tbl_profile->is_blogger->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_profile->is_blogger->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
<?php } ?>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_profile->is_blogger->ViewAttributes() ?>><?php echo $tbl_profile->is_blogger->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_profile->is_active->Visible) { // is_active ?>
		<td<?php echo $tbl_profile->is_active->CellAttributes() ?>>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $tbl_profile_list->lRowIndex ?>_is_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x<?php echo $tbl_profile_list->lRowIndex ?>_is_active" id="x<?php echo $tbl_profile_list->lRowIndex ?>_is_active" title="<?php echo $tbl_profile->is_active->FldTitle() ?>" value="{value}"<?php echo $tbl_profile->is_active->EditAttributes() ?>></label></div>
<div id="dsl_x<?php echo $tbl_profile_list->lRowIndex ?>_is_active" repeatcolumn="5">
<?php
$arwrk = $tbl_profile->is_active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_profile->is_active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $tbl_profile_list->lRowIndex ?>_is_active" id="x<?php echo $tbl_profile_list->lRowIndex ?>_is_active" title="<?php echo $tbl_profile->is_active->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_profile->is_active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
<?php } ?>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_profile->is_active->ViewAttributes() ?>><?php echo $tbl_profile->is_active->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_profile_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($tbl_profile->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($tbl_profile->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($tbl_profile->CurrentAction == "add" || $tbl_profile->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $tbl_profile_list->lRowIndex ?>">
<?php } ?>
<?php if ($tbl_profile->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $tbl_profile_list->lRowIndex ?>">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($tbl_profile_list->lTotalRecs > 0) { ?>
<?php if ($tbl_profile->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($tbl_profile->CurrentAction <> "gridadd" && $tbl_profile->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_profile_list->Pager)) $tbl_profile_list->Pager = new cPrevNextPager($tbl_profile_list->lStartRec, $tbl_profile_list->lDisplayRecs, $tbl_profile_list->lTotalRecs) ?>
<?php if ($tbl_profile_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_profile_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_profile_list->PageUrl() ?>start=<?php echo $tbl_profile_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_profile_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_profile_list->PageUrl() ?>start=<?php echo $tbl_profile_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_profile_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_profile_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_profile_list->PageUrl() ?>start=<?php echo $tbl_profile_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_profile_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_profile_list->PageUrl() ?>start=<?php echo $tbl_profile_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_profile_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_profile_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_profile_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_profile_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_profile_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($tbl_profile_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tbl_profile">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="15"<?php if ($tbl_profile_list->lDisplayRecs == 15) { ?> selected="selected"<?php } ?>>15</option>
<option value="30"<?php if ($tbl_profile_list->lDisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="75"<?php if ($tbl_profile_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($tbl_profile_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($tbl_profile->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($tbl_profile_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_profile_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $tbl_profile_list->InlineAddUrl ?>"><?php echo $Language->Phrase("InlineAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($tbl_profile_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftbl_profilelist, '<?php echo $tbl_profile_list->MultiDeleteUrl ?>', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($tbl_profile->Export == "" && $tbl_profile->CurrentAction == "") { ?>
<?php } ?>
<?php if ($tbl_profile->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_profile_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_profile_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'tbl_profile';

	// Page object name
	var $PageObjName = 'tbl_profile_list';

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
	function ctbl_profile_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_profile)
		$GLOBALS["tbl_profile"] = new ctbl_profile();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["tbl_profile"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tbl_profiledelete.php";
		$this->MultiUpdateUrl = "tbl_profileupdate.php";

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_profile', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Create form object
		$objForm = new cFormObj();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$tbl_profile->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$tbl_profile->Export = $_POST["exporttype"];
		} else {
			$tbl_profile->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $tbl_profile->Export; // Get export parameter, used in header
		$gsExportFile = $tbl_profile->TableVar; // Get export file, used in header

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

	// Class variables
	var $ListOptions; // List options
	var $lDisplayRecs = 15;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $sSrchWhere = ""; // Search WHERE clause
	var $lRecCnt = 0; // Record count
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex; // Row index
	var $lRecPerRow = 0;
	var $lColCnt = 0;
	var $sDbMasterFilter = ""; // Master filter
	var $sDbDetailFilter = ""; // Detail filter
	var $bMasterRecordExists;	
	var $sMultiSelectKey;
	var $RestoreSearch;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $tbl_profile;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$tbl_profile->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($tbl_profile->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($tbl_profile->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($tbl_profile->CurrentAction == "add" || $tbl_profile->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$tbl_profile->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if (($tbl_profile->CurrentAction == "update" || $tbl_profile->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($tbl_profile->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();
				}
			}

			// Set up list options
			$this->SetupListOptions();

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$tbl_profile->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($tbl_profile->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $tbl_profile->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 15; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$tbl_profile->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$tbl_profile->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$tbl_profile->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $tbl_profile->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$tbl_profile->setSessionWhere($sFilter);
		$tbl_profile->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $tbl_profile;
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->lDisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->lDisplayRecs = -1;
				} else {
					$this->lDisplayRecs = 15; // Non-numeric, load default
				}
			}
			$tbl_profile->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$tbl_profile->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $tbl_profile;
		$tbl_profile->setKey("id", ""); // Clear inline edit key
		$tbl_profile->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $tbl_profile;
		if (!$Security->CanEdit())
			$this->Page_Terminate("login.php"); // Go to login page
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$tbl_profile->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$tbl_profile->setKey("id", $tbl_profile->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError, $tbl_profile;
		$objForm->Index = 1; 
		$this->LoadFormValues(); // Get form values

		// Validate form
		$bInlineUpdate = TRUE;
		if (!$this->ValidateForm()) {	
			$bInlineUpdate = FALSE; // Form error, reset action
			$this->setMessage($gsFormError);
		} else {
			$bInlineUpdate = FALSE;	
			if ($this->CheckInlineEditKey()) { // Check key
				$tbl_profile->SendEmail = TRUE; // Send email on update success
				$bInlineUpdate = $this->EditRow(); // Update record
			} else {
				$bInlineUpdate = FALSE;
			}
		}
		if ($bInlineUpdate) { // Update success
			$this->setMessage($Language->Phrase("UpdateSuccess")); // Set success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getMessage() == "")
				$this->setMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$tbl_profile->EventCancelled = TRUE; // Cancel event
			$tbl_profile->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {
		global $tbl_profile;

		//CheckInlineEditKey = True
		if (strval($tbl_profile->getKey("id")) <> strval($tbl_profile->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $tbl_profile;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		$tbl_profile->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to Inline Add/Copy record
	function InlineInsert() {
		global $Language, $objForm, $gsFormError, $tbl_profile;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$tbl_profile->EventCancelled = TRUE; // Set event cancelled
			$tbl_profile->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$tbl_profile->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage($Language->Phrase("AddSuccess")); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$tbl_profile->EventCancelled = TRUE; // Set event cancelled
			$tbl_profile->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $tbl_profile;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $tbl_profile->id, FALSE); // id
		$this->BuildSearchSql($sWhere, $tbl_profile->name, FALSE); // name
		$this->BuildSearchSql($sWhere, $tbl_profile->ga_username, FALSE); // ga_username
		$this->BuildSearchSql($sWhere, $tbl_profile->ga_passwd, FALSE); // ga_passwd
		$this->BuildSearchSql($sWhere, $tbl_profile->ga_profileid, FALSE); // ga_profileid
		$this->BuildSearchSql($sWhere, $tbl_profile->url, FALSE); // url
		$this->BuildSearchSql($sWhere, $tbl_profile->fb_pageid, FALSE); // fb_pageid
		$this->BuildSearchSql($sWhere, $tbl_profile->twitter_page, FALSE); // twitter_page
		$this->BuildSearchSql($sWhere, $tbl_profile->is_wordpress, FALSE); // is_wordpress
		$this->BuildSearchSql($sWhere, $tbl_profile->is_blogger, FALSE); // is_blogger
		$this->BuildSearchSql($sWhere, $tbl_profile->is_active, FALSE); // is_active

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($tbl_profile->id); // id
			$this->SetSearchParm($tbl_profile->name); // name
			$this->SetSearchParm($tbl_profile->ga_username); // ga_username
			$this->SetSearchParm($tbl_profile->ga_passwd); // ga_passwd
			$this->SetSearchParm($tbl_profile->ga_profileid); // ga_profileid
			$this->SetSearchParm($tbl_profile->url); // url
			$this->SetSearchParm($tbl_profile->fb_pageid); // fb_pageid
			$this->SetSearchParm($tbl_profile->twitter_page); // twitter_page
			$this->SetSearchParm($tbl_profile->is_wordpress); // is_wordpress
			$this->SetSearchParm($tbl_profile->is_blogger); // is_blogger
			$this->SetSearchParm($tbl_profile->is_active); // is_active
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);		
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";

		//$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);

		//$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1 || $FldOpr <> "LIKE" ||
			($FldOpr2 <> "LIKE" && $FldVal2 <> ""))
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldVal) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldVal2) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2);
		}
		if ($sWrk <> "") {
			if ($Where <> "") $Where .= " AND ";
			$Where .= "(" . $sWrk . ")";
		}
	}

	// Set search parameters
	function SetSearchParm(&$Fld) {
		global $tbl_profile;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$tbl_profile->setAdvancedSearch("x_$FldParm", $FldVal);
		$tbl_profile->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$tbl_profile->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$tbl_profile->setAdvancedSearch("y_$FldParm", $FldVal2);
		$tbl_profile->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $tbl_profile;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $tbl_profile->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $tbl_profile->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $tbl_profile->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $tbl_profile->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $tbl_profile->GetAdvancedSearch("w_$FldParm");
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $tbl_profile;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $tbl_profile->name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_profile->ga_username, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_profile->ga_passwd, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_profile->ga_profileid, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_profile->url, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_profile->fb_pageid, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_profile->twitter_page, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_profile->is_wordpress, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_profile->is_blogger, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_profile->is_active, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . " LIKE " . ew_QuotedValue("%" . $Keyword . "%", $lFldDataType);
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $tbl_profile;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $tbl_profile->BasicSearchKeyword;
		$sSearchType = $tbl_profile->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$tbl_profile->setSessionBasicSearchKeyword($sSearchKeyword);
			$tbl_profile->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $tbl_profile;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$tbl_profile->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $tbl_profile;
		$tbl_profile->setSessionBasicSearchKeyword("");
		$tbl_profile->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $tbl_profile;
		$tbl_profile->setAdvancedSearch("x_id", "");
		$tbl_profile->setAdvancedSearch("x_name", "");
		$tbl_profile->setAdvancedSearch("x_ga_username", "");
		$tbl_profile->setAdvancedSearch("x_ga_passwd", "");
		$tbl_profile->setAdvancedSearch("x_ga_profileid", "");
		$tbl_profile->setAdvancedSearch("x_url", "");
		$tbl_profile->setAdvancedSearch("x_fb_pageid", "");
		$tbl_profile->setAdvancedSearch("x_twitter_page", "");
		$tbl_profile->setAdvancedSearch("x_is_wordpress", "");
		$tbl_profile->setAdvancedSearch("x_is_blogger", "");
		$tbl_profile->setAdvancedSearch("x_is_active", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $tbl_profile;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_name"] <> "") $bRestore = FALSE;
		if (@$_GET["x_ga_username"] <> "") $bRestore = FALSE;
		if (@$_GET["x_ga_passwd"] <> "") $bRestore = FALSE;
		if (@$_GET["x_ga_profileid"] <> "") $bRestore = FALSE;
		if (@$_GET["x_url"] <> "") $bRestore = FALSE;
		if (@$_GET["x_fb_pageid"] <> "") $bRestore = FALSE;
		if (@$_GET["x_twitter_page"] <> "") $bRestore = FALSE;
		if (@$_GET["x_is_wordpress"] <> "") $bRestore = FALSE;
		if (@$_GET["x_is_blogger"] <> "") $bRestore = FALSE;
		if (@$_GET["x_is_active"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$tbl_profile->BasicSearchKeyword = $tbl_profile->getSessionBasicSearchKeyword();
			$tbl_profile->BasicSearchType = $tbl_profile->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($tbl_profile->id);
			$this->GetSearchParm($tbl_profile->name);
			$this->GetSearchParm($tbl_profile->ga_username);
			$this->GetSearchParm($tbl_profile->ga_passwd);
			$this->GetSearchParm($tbl_profile->ga_profileid);
			$this->GetSearchParm($tbl_profile->url);
			$this->GetSearchParm($tbl_profile->fb_pageid);
			$this->GetSearchParm($tbl_profile->twitter_page);
			$this->GetSearchParm($tbl_profile->is_wordpress);
			$this->GetSearchParm($tbl_profile->is_blogger);
			$this->GetSearchParm($tbl_profile->is_active);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $tbl_profile;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$tbl_profile->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$tbl_profile->CurrentOrderType = @$_GET["ordertype"];
			$tbl_profile->UpdateSort($tbl_profile->id); // id
			$tbl_profile->UpdateSort($tbl_profile->name); // name
			$tbl_profile->UpdateSort($tbl_profile->ga_username); // ga_username
			$tbl_profile->UpdateSort($tbl_profile->ga_passwd); // ga_passwd
			$tbl_profile->UpdateSort($tbl_profile->ga_profileid); // ga_profileid
			$tbl_profile->UpdateSort($tbl_profile->url); // url
			$tbl_profile->UpdateSort($tbl_profile->fb_pageid); // fb_pageid
			$tbl_profile->UpdateSort($tbl_profile->twitter_page); // twitter_page
			$tbl_profile->UpdateSort($tbl_profile->is_wordpress); // is_wordpress
			$tbl_profile->UpdateSort($tbl_profile->is_blogger); // is_blogger
			$tbl_profile->UpdateSort($tbl_profile->is_active); // is_active
			$tbl_profile->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $tbl_profile;
		$sOrderBy = $tbl_profile->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($tbl_profile->SqlOrderBy() <> "") {
				$sOrderBy = $tbl_profile->SqlOrderBy();
				$tbl_profile->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $tbl_profile;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$tbl_profile->setSessionOrderBy($sOrderBy);
				$tbl_profile->id->setSort("");
				$tbl_profile->name->setSort("");
				$tbl_profile->ga_username->setSort("");
				$tbl_profile->ga_passwd->setSort("");
				$tbl_profile->ga_profileid->setSort("");
				$tbl_profile->url->setSort("");
				$tbl_profile->fb_pageid->setSort("");
				$tbl_profile->twitter_page->setSort("");
				$tbl_profile->is_wordpress->setSort("");
				$tbl_profile->is_blogger->setSort("");
				$tbl_profile->is_active->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$tbl_profile->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $tbl_profile;

		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanView();
		$item->OnLeft = TRUE;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = TRUE;

		// "copy"
		$this->ListOptions->Add("copy");
		$item =& $this->ListOptions->Items["copy"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanAdd();
		$item->OnLeft = TRUE;

		// "checkbox"
		$this->ListOptions->Add("checkbox");
		$item =& $this->ListOptions->Items["checkbox"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->CanDelete();
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"tbl_profile_list.SelectAllKey(this);\">";
		$this->ListOptions->MoveItem("checkbox", 0); // Move to first column

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($tbl_profile->Export <> "" ||
			$tbl_profile->CurrentAction == "gridadd" ||
			$tbl_profile->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $tbl_profile;
		$this->ListOptions->LoadDefault();

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if (($tbl_profile->CurrentAction == "add" || $tbl_profile->CurrentAction == "copy") &&
			$tbl_profile->RowType == EW_ROWTYPE_ADD) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
				"<a href=\"\" onclick=\"f=document.ftbl_profilelist;if(tbl_profile_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("InsertLink") . "</a>&nbsp;" .
				"<a href=\"" . $this->PageUrl() . "a=cancel\">" . $Language->Phrase("CancelLink") . "</a>" .
				"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"insert\"></div>";
			return;
		}

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($tbl_profile->CurrentAction == "edit" && $tbl_profile->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a href=\"\" onclick=\"f=document.ftbl_profilelist;if(tbl_profile_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
					"<a href=\"" . $this->PageUrl() . "a=cancel\">" . $Language->Phrase("CancelLink") . "</a>" .
					"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"update\"></div>";
			return;
		}

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
			$oListOpt->Body .= "<span class=\"ewSeparator\">&nbsp;|&nbsp;</span>";
			$oListOpt->Body .= "<a class=\"ewInlineLink\" href=\"" . $this->InlineEditUrl . "#" . $this->PageObjName . "_row_" . $this->lRowCnt . "\">" . $Language->Phrase("InlineEditLink") . "</a>";
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->CanAdd() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($tbl_profile->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $tbl_profile;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_profile;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_profile->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_profile->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_profile->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_profile->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_profile->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_profile->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $tbl_profile;
		$tbl_profile->is_wordpress->CurrentValue = "0";
		$tbl_profile->is_blogger->CurrentValue = "0";
		$tbl_profile->is_active->CurrentValue = "1";
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $tbl_profile;
		$tbl_profile->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$tbl_profile->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $tbl_profile;

		// Load search values
		// id

		$tbl_profile->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		$tbl_profile->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// name
		$tbl_profile->name->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_name"]);
		$tbl_profile->name->AdvancedSearch->SearchOperator = @$_GET["z_name"];

		// ga_username
		$tbl_profile->ga_username->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ga_username"]);
		$tbl_profile->ga_username->AdvancedSearch->SearchOperator = @$_GET["z_ga_username"];

		// ga_passwd
		$tbl_profile->ga_passwd->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ga_passwd"]);
		$tbl_profile->ga_passwd->AdvancedSearch->SearchOperator = @$_GET["z_ga_passwd"];

		// ga_profileid
		$tbl_profile->ga_profileid->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_ga_profileid"]);
		$tbl_profile->ga_profileid->AdvancedSearch->SearchOperator = @$_GET["z_ga_profileid"];

		// url
		$tbl_profile->url->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_url"]);
		$tbl_profile->url->AdvancedSearch->SearchOperator = @$_GET["z_url"];

		// fb_pageid
		$tbl_profile->fb_pageid->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_fb_pageid"]);
		$tbl_profile->fb_pageid->AdvancedSearch->SearchOperator = @$_GET["z_fb_pageid"];

		// twitter_page
		$tbl_profile->twitter_page->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_twitter_page"]);
		$tbl_profile->twitter_page->AdvancedSearch->SearchOperator = @$_GET["z_twitter_page"];

		// is_wordpress
		$tbl_profile->is_wordpress->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_is_wordpress"]);
		$tbl_profile->is_wordpress->AdvancedSearch->SearchOperator = @$_GET["z_is_wordpress"];

		// is_blogger
		$tbl_profile->is_blogger->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_is_blogger"]);
		$tbl_profile->is_blogger->AdvancedSearch->SearchOperator = @$_GET["z_is_blogger"];

		// is_active
		$tbl_profile->is_active->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_is_active"]);
		$tbl_profile->is_active->AdvancedSearch->SearchOperator = @$_GET["z_is_active"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_profile;
		$tbl_profile->id->setFormValue($objForm->GetValue("x_id"));
		$tbl_profile->name->setFormValue($objForm->GetValue("x_name"));
		$tbl_profile->ga_username->setFormValue($objForm->GetValue("x_ga_username"));
		$tbl_profile->ga_passwd->setFormValue($objForm->GetValue("x_ga_passwd"));
		$tbl_profile->ga_profileid->setFormValue($objForm->GetValue("x_ga_profileid"));
		$tbl_profile->url->setFormValue($objForm->GetValue("x_url"));
		$tbl_profile->fb_pageid->setFormValue($objForm->GetValue("x_fb_pageid"));
		$tbl_profile->twitter_page->setFormValue($objForm->GetValue("x_twitter_page"));
		$tbl_profile->is_wordpress->setFormValue($objForm->GetValue("x_is_wordpress"));
		$tbl_profile->is_blogger->setFormValue($objForm->GetValue("x_is_blogger"));
		$tbl_profile->is_active->setFormValue($objForm->GetValue("x_is_active"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_profile;
		$tbl_profile->id->CurrentValue = $tbl_profile->id->FormValue;
		$tbl_profile->name->CurrentValue = $tbl_profile->name->FormValue;
		$tbl_profile->ga_username->CurrentValue = $tbl_profile->ga_username->FormValue;
		$tbl_profile->ga_passwd->CurrentValue = $tbl_profile->ga_passwd->FormValue;
		$tbl_profile->ga_profileid->CurrentValue = $tbl_profile->ga_profileid->FormValue;
		$tbl_profile->url->CurrentValue = $tbl_profile->url->FormValue;
		$tbl_profile->fb_pageid->CurrentValue = $tbl_profile->fb_pageid->FormValue;
		$tbl_profile->twitter_page->CurrentValue = $tbl_profile->twitter_page->FormValue;
		$tbl_profile->is_wordpress->CurrentValue = $tbl_profile->is_wordpress->FormValue;
		$tbl_profile->is_blogger->CurrentValue = $tbl_profile->is_blogger->FormValue;
		$tbl_profile->is_active->CurrentValue = $tbl_profile->is_active->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_profile;

		// Call Recordset Selecting event
		$tbl_profile->Recordset_Selecting($tbl_profile->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_profile->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_profile->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_profile;
		$sFilter = $tbl_profile->KeyFilter();

		// Call Row Selecting event
		$tbl_profile->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_profile->CurrentFilter = $sFilter;
		$sSql = $tbl_profile->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_profile->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_profile;
		$tbl_profile->id->setDbValue($rs->fields('id'));
		$tbl_profile->name->setDbValue($rs->fields('name'));
		$tbl_profile->ga_username->setDbValue($rs->fields('ga_username'));
		$tbl_profile->ga_passwd->setDbValue($rs->fields('ga_passwd'));
		$tbl_profile->ga_profileid->setDbValue($rs->fields('ga_profileid'));
		$tbl_profile->url->setDbValue($rs->fields('url'));
		$tbl_profile->fb_pageid->setDbValue($rs->fields('fb_pageid'));
		$tbl_profile->twitter_page->setDbValue($rs->fields('twitter_page'));
		$tbl_profile->is_wordpress->setDbValue($rs->fields('is_wordpress'));
		$tbl_profile->is_blogger->setDbValue($rs->fields('is_blogger'));
		$tbl_profile->is_active->setDbValue($rs->fields('is_active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_profile;

		// Initialize URLs
		$this->ViewUrl = $tbl_profile->ViewUrl();
		$this->EditUrl = $tbl_profile->EditUrl();
		$this->InlineEditUrl = $tbl_profile->InlineEditUrl();
		$this->CopyUrl = $tbl_profile->CopyUrl();
		$this->InlineCopyUrl = $tbl_profile->InlineCopyUrl();
		$this->DeleteUrl = $tbl_profile->DeleteUrl();

		// Call Row_Rendering event
		$tbl_profile->Row_Rendering();

		// Common render codes for all row types
		// id

		$tbl_profile->id->CellCssStyle = ""; $tbl_profile->id->CellCssClass = "";
		$tbl_profile->id->CellAttrs = array(); $tbl_profile->id->ViewAttrs = array(); $tbl_profile->id->EditAttrs = array();

		// name
		$tbl_profile->name->CellCssStyle = "white-space: nowrap;"; $tbl_profile->name->CellCssClass = "";
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
		$tbl_profile->url->CellCssStyle = "white-space: nowrap;"; $tbl_profile->url->CellCssClass = "";
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
			if ($tbl_profile->Export == "")
				$tbl_profile->name->ViewValue = ew_Highlight($tbl_profile->HighlightName(), $tbl_profile->name->ViewValue, $tbl_profile->getSessionBasicSearchKeyword(), $tbl_profile->getSessionBasicSearchType(), $tbl_profile->getAdvancedSearch("x_name"));

			// ga_username
			$tbl_profile->ga_username->HrefValue = "";
			$tbl_profile->ga_username->TooltipValue = "";
			if ($tbl_profile->Export == "")
				$tbl_profile->ga_username->ViewValue = ew_Highlight($tbl_profile->HighlightName(), $tbl_profile->ga_username->ViewValue, $tbl_profile->getSessionBasicSearchKeyword(), $tbl_profile->getSessionBasicSearchType(), $tbl_profile->getAdvancedSearch("x_ga_username"));

			// ga_passwd
			$tbl_profile->ga_passwd->HrefValue = "";
			$tbl_profile->ga_passwd->TooltipValue = "";
			if ($tbl_profile->Export == "")
				$tbl_profile->ga_passwd->ViewValue = ew_Highlight($tbl_profile->HighlightName(), $tbl_profile->ga_passwd->ViewValue, $tbl_profile->getSessionBasicSearchKeyword(), $tbl_profile->getSessionBasicSearchType(), $tbl_profile->getAdvancedSearch("x_ga_passwd"));

			// ga_profileid
			$tbl_profile->ga_profileid->HrefValue = "";
			$tbl_profile->ga_profileid->TooltipValue = "";
			if ($tbl_profile->Export == "")
				$tbl_profile->ga_profileid->ViewValue = ew_Highlight($tbl_profile->HighlightName(), $tbl_profile->ga_profileid->ViewValue, $tbl_profile->getSessionBasicSearchKeyword(), $tbl_profile->getSessionBasicSearchType(), $tbl_profile->getAdvancedSearch("x_ga_profileid"));

			// url
			$tbl_profile->url->HrefValue = "";
			$tbl_profile->url->TooltipValue = "";
			if ($tbl_profile->Export == "")
				$tbl_profile->url->ViewValue = ew_Highlight($tbl_profile->HighlightName(), $tbl_profile->url->ViewValue, $tbl_profile->getSessionBasicSearchKeyword(), $tbl_profile->getSessionBasicSearchType(), $tbl_profile->getAdvancedSearch("x_url"));

			// fb_pageid
			$tbl_profile->fb_pageid->HrefValue = "";
			$tbl_profile->fb_pageid->TooltipValue = "";
			if ($tbl_profile->Export == "")
				$tbl_profile->fb_pageid->ViewValue = ew_Highlight($tbl_profile->HighlightName(), $tbl_profile->fb_pageid->ViewValue, $tbl_profile->getSessionBasicSearchKeyword(), $tbl_profile->getSessionBasicSearchType(), $tbl_profile->getAdvancedSearch("x_fb_pageid"));

			// twitter_page
			$tbl_profile->twitter_page->HrefValue = "";
			$tbl_profile->twitter_page->TooltipValue = "";
			if ($tbl_profile->Export == "")
				$tbl_profile->twitter_page->ViewValue = ew_Highlight($tbl_profile->HighlightName(), $tbl_profile->twitter_page->ViewValue, $tbl_profile->getSessionBasicSearchKeyword(), $tbl_profile->getSessionBasicSearchType(), $tbl_profile->getAdvancedSearch("x_twitter_page"));

			// is_wordpress
			$tbl_profile->is_wordpress->HrefValue = "";
			$tbl_profile->is_wordpress->TooltipValue = "";

			// is_blogger
			$tbl_profile->is_blogger->HrefValue = "";
			$tbl_profile->is_blogger->TooltipValue = "";

			// is_active
			$tbl_profile->is_active->HrefValue = "";
			$tbl_profile->is_active->TooltipValue = "";
		} elseif ($tbl_profile->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// name

			$tbl_profile->name->EditCustomAttributes = "";
			$tbl_profile->name->EditValue = ew_HtmlEncode($tbl_profile->name->CurrentValue);

			// ga_username
			$tbl_profile->ga_username->EditCustomAttributes = "";
			$tbl_profile->ga_username->EditValue = ew_HtmlEncode($tbl_profile->ga_username->CurrentValue);

			// ga_passwd
			$tbl_profile->ga_passwd->EditCustomAttributes = "";
			$tbl_profile->ga_passwd->EditValue = ew_HtmlEncode($tbl_profile->ga_passwd->CurrentValue);

			// ga_profileid
			$tbl_profile->ga_profileid->EditCustomAttributes = "";
			$tbl_profile->ga_profileid->EditValue = ew_HtmlEncode($tbl_profile->ga_profileid->CurrentValue);

			// url
			$tbl_profile->url->EditCustomAttributes = "";
			$tbl_profile->url->EditValue = ew_HtmlEncode($tbl_profile->url->CurrentValue);

			// fb_pageid
			$tbl_profile->fb_pageid->EditCustomAttributes = "";
			$tbl_profile->fb_pageid->EditValue = ew_HtmlEncode($tbl_profile->fb_pageid->CurrentValue);

			// twitter_page
			$tbl_profile->twitter_page->EditCustomAttributes = "";
			$tbl_profile->twitter_page->EditValue = ew_HtmlEncode($tbl_profile->twitter_page->CurrentValue);

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
		} elseif ($tbl_profile->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$tbl_profile->id->EditCustomAttributes = "";
			$tbl_profile->id->EditValue = $tbl_profile->id->CurrentValue;
			$tbl_profile->id->CssStyle = "";
			$tbl_profile->id->CssClass = "";
			$tbl_profile->id->ViewCustomAttributes = "";

			// name
			$tbl_profile->name->EditCustomAttributes = "";
			$tbl_profile->name->EditValue = ew_HtmlEncode($tbl_profile->name->CurrentValue);

			// ga_username
			$tbl_profile->ga_username->EditCustomAttributes = "";
			$tbl_profile->ga_username->EditValue = ew_HtmlEncode($tbl_profile->ga_username->CurrentValue);

			// ga_passwd
			$tbl_profile->ga_passwd->EditCustomAttributes = "";
			$tbl_profile->ga_passwd->EditValue = ew_HtmlEncode($tbl_profile->ga_passwd->CurrentValue);

			// ga_profileid
			$tbl_profile->ga_profileid->EditCustomAttributes = "";
			$tbl_profile->ga_profileid->EditValue = ew_HtmlEncode($tbl_profile->ga_profileid->CurrentValue);

			// url
			$tbl_profile->url->EditCustomAttributes = "";
			$tbl_profile->url->EditValue = ew_HtmlEncode($tbl_profile->url->CurrentValue);

			// fb_pageid
			$tbl_profile->fb_pageid->EditCustomAttributes = "";
			$tbl_profile->fb_pageid->EditValue = ew_HtmlEncode($tbl_profile->fb_pageid->CurrentValue);

			// twitter_page
			$tbl_profile->twitter_page->EditCustomAttributes = "";
			$tbl_profile->twitter_page->EditValue = ew_HtmlEncode($tbl_profile->twitter_page->CurrentValue);

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

			// Edit refer script
			// id

			$tbl_profile->id->HrefValue = "";

			// name
			$tbl_profile->name->HrefValue = "";

			// ga_username
			$tbl_profile->ga_username->HrefValue = "";

			// ga_passwd
			$tbl_profile->ga_passwd->HrefValue = "";

			// ga_profileid
			$tbl_profile->ga_profileid->HrefValue = "";

			// url
			$tbl_profile->url->HrefValue = "";

			// fb_pageid
			$tbl_profile->fb_pageid->HrefValue = "";

			// twitter_page
			$tbl_profile->twitter_page->HrefValue = "";

			// is_wordpress
			$tbl_profile->is_wordpress->HrefValue = "";

			// is_blogger
			$tbl_profile->is_blogger->HrefValue = "";

			// is_active
			$tbl_profile->is_active->HrefValue = "";
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

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $tbl_profile;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_profile->name->FormValue) && $tbl_profile->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_profile->name->FldCaption();
		}
		if (!is_null($tbl_profile->ga_username->FormValue) && $tbl_profile->ga_username->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_profile->ga_username->FldCaption();
		}
		if (!is_null($tbl_profile->ga_passwd->FormValue) && $tbl_profile->ga_passwd->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_profile->ga_passwd->FldCaption();
		}
		if (!is_null($tbl_profile->ga_profileid->FormValue) && $tbl_profile->ga_profileid->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_profile->ga_profileid->FldCaption();
		}
		if (!is_null($tbl_profile->url->FormValue) && $tbl_profile->url->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_profile->url->FldCaption();
		}
		if (!is_null($tbl_profile->fb_pageid->FormValue) && $tbl_profile->fb_pageid->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_profile->fb_pageid->FldCaption();
		}
		if (!is_null($tbl_profile->twitter_page->FormValue) && $tbl_profile->twitter_page->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_profile->twitter_page->FldCaption();
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
		global $conn, $Security, $Language, $tbl_profile;
		$sFilter = $tbl_profile->KeyFilter();
		$tbl_profile->CurrentFilter = $sFilter;
		$sSql = $tbl_profile->SQL();
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

			// name
			$tbl_profile->name->SetDbValueDef($rsnew, $tbl_profile->name->CurrentValue, "", FALSE);

			// ga_username
			$tbl_profile->ga_username->SetDbValueDef($rsnew, $tbl_profile->ga_username->CurrentValue, "", FALSE);

			// ga_passwd
			$tbl_profile->ga_passwd->SetDbValueDef($rsnew, $tbl_profile->ga_passwd->CurrentValue, "", FALSE);

			// ga_profileid
			$tbl_profile->ga_profileid->SetDbValueDef($rsnew, $tbl_profile->ga_profileid->CurrentValue, "", FALSE);

			// url
			$tbl_profile->url->SetDbValueDef($rsnew, $tbl_profile->url->CurrentValue, "", FALSE);

			// fb_pageid
			$tbl_profile->fb_pageid->SetDbValueDef($rsnew, $tbl_profile->fb_pageid->CurrentValue, "", FALSE);

			// twitter_page
			$tbl_profile->twitter_page->SetDbValueDef($rsnew, $tbl_profile->twitter_page->CurrentValue, "", FALSE);

			// is_wordpress
			$tbl_profile->is_wordpress->SetDbValueDef($rsnew, $tbl_profile->is_wordpress->CurrentValue, "", FALSE);

			// is_blogger
			$tbl_profile->is_blogger->SetDbValueDef($rsnew, $tbl_profile->is_blogger->CurrentValue, "", FALSE);

			// is_active
			$tbl_profile->is_active->SetDbValueDef($rsnew, $tbl_profile->is_active->CurrentValue, "", FALSE);

			// Call Row Updating event
			$bUpdateRow = $tbl_profile->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_profile->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_profile->CancelMessage <> "") {
					$this->setMessage($tbl_profile->CancelMessage);
					$tbl_profile->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_profile->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $tbl_profile;
		$rsnew = array();

		// name
		$tbl_profile->name->SetDbValueDef($rsnew, $tbl_profile->name->CurrentValue, "", FALSE);

		// ga_username
		$tbl_profile->ga_username->SetDbValueDef($rsnew, $tbl_profile->ga_username->CurrentValue, "", FALSE);

		// ga_passwd
		$tbl_profile->ga_passwd->SetDbValueDef($rsnew, $tbl_profile->ga_passwd->CurrentValue, "", FALSE);

		// ga_profileid
		$tbl_profile->ga_profileid->SetDbValueDef($rsnew, $tbl_profile->ga_profileid->CurrentValue, "", FALSE);

		// url
		$tbl_profile->url->SetDbValueDef($rsnew, $tbl_profile->url->CurrentValue, "", FALSE);

		// fb_pageid
		$tbl_profile->fb_pageid->SetDbValueDef($rsnew, $tbl_profile->fb_pageid->CurrentValue, "", FALSE);

		// twitter_page
		$tbl_profile->twitter_page->SetDbValueDef($rsnew, $tbl_profile->twitter_page->CurrentValue, "", FALSE);

		// is_wordpress
		$tbl_profile->is_wordpress->SetDbValueDef($rsnew, $tbl_profile->is_wordpress->CurrentValue, "", TRUE);

		// is_blogger
		$tbl_profile->is_blogger->SetDbValueDef($rsnew, $tbl_profile->is_blogger->CurrentValue, "", TRUE);

		// is_active
		$tbl_profile->is_active->SetDbValueDef($rsnew, $tbl_profile->is_active->CurrentValue, "", TRUE);

		// Call Row Inserting event
		$bInsertRow = $tbl_profile->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tbl_profile->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tbl_profile->CancelMessage <> "") {
				$this->setMessage($tbl_profile->CancelMessage);
				$tbl_profile->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$tbl_profile->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $tbl_profile->id->DbValue;

			// Call Row Inserted event
			$tbl_profile->Row_Inserted($rsnew);
		}
		return $AddRow;
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example: 
		//$this->ListOptions->Add("new");
		//$this->ListOptions->Items["new"]->OnLeft = TRUE; // Link on left
		//$this->ListOptions->MoveItem("new", 0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
