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
$tbl_ga_stat_list = new ctbl_ga_stat_list();
$Page =& $tbl_ga_stat_list;

// Page init
$tbl_ga_stat_list->Page_Init();

// Page main
$tbl_ga_stat_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_ga_stat->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_ga_stat_list = new ew_Page("tbl_ga_stat_list");

// page properties
tbl_ga_stat_list.PageID = "list"; // page ID
tbl_ga_stat_list.FormID = "ftbl_ga_statlist"; // form ID
var EW_PAGE_ID = tbl_ga_stat_list.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_ga_stat_list.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_ga_stat->id_profile->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_stat_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_ga_stat->stat_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_stat_date"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_ga_stat->stat_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_ga_stat->year->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_ga_stat->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_ga_stat->month->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_ga_stat->month->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_week"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_ga_stat->week->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_week"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_ga_stat->week->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_hour"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_ga_stat->hour->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_hour"];
		if (elm && !ew_CheckTime(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_ga_stat->hour->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_pageview"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_ga_stat->pageview->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pageview"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_ga_stat->pageview->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_visit"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_ga_stat->visit->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_visit"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_ga_stat->visit->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_ga_stat_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_ga_stat_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_ga_stat_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_ga_stat_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_ga_stat_list.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_ga_stat_list.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<?php if ($tbl_ga_stat->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$tbl_ga_stat_list->lTotalRecs = $tbl_ga_stat->SelectRecordCount();
	} else {
		if ($rs = $tbl_ga_stat_list->LoadRecordset())
			$tbl_ga_stat_list->lTotalRecs = $rs->RecordCount();
	}
	$tbl_ga_stat_list->lStartRec = 1;
	if ($tbl_ga_stat_list->lDisplayRecs <= 0 || ($tbl_ga_stat->Export <> "" && $tbl_ga_stat->ExportAll)) // Display all records
		$tbl_ga_stat_list->lDisplayRecs = $tbl_ga_stat_list->lTotalRecs;
	if (!($tbl_ga_stat->Export <> "" && $tbl_ga_stat->ExportAll))
		$tbl_ga_stat_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $tbl_ga_stat_list->LoadRecordset($tbl_ga_stat_list->lStartRec-1, $tbl_ga_stat_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_ga_stat->TableCaption() ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($tbl_ga_stat->Export == "" && $tbl_ga_stat->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(tbl_ga_stat_list);" style="text-decoration: none;"><img id="tbl_ga_stat_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="tbl_ga_stat_list_SearchPanel">
<form name="ftbl_ga_statlistsrch" id="ftbl_ga_statlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="tbl_ga_stat">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $tbl_ga_stat_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="tbl_ga_statsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
			<?php if ($tbl_ga_stat_list->sSrchWhere <> "" && $tbl_ga_stat_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(tbl_ga_stat_list, this, '<?php echo $tbl_ga_stat->HighlightName() ?>');"><?php echo $Language->Phrase("HideHighlight") ?></a>
			<?php } ?>
		</span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_ga_stat_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($tbl_ga_stat->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($tbl_ga_stat->CurrentAction <> "gridadd" && $tbl_ga_stat->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_ga_stat_list->Pager)) $tbl_ga_stat_list->Pager = new cPrevNextPager($tbl_ga_stat_list->lStartRec, $tbl_ga_stat_list->lDisplayRecs, $tbl_ga_stat_list->lTotalRecs) ?>
<?php if ($tbl_ga_stat_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_ga_stat_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_ga_stat_list->PageUrl() ?>start=<?php echo $tbl_ga_stat_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_ga_stat_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_ga_stat_list->PageUrl() ?>start=<?php echo $tbl_ga_stat_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_ga_stat_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_ga_stat_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_ga_stat_list->PageUrl() ?>start=<?php echo $tbl_ga_stat_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_ga_stat_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_ga_stat_list->PageUrl() ?>start=<?php echo $tbl_ga_stat_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_ga_stat_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_ga_stat_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_ga_stat_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_ga_stat_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_ga_stat_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($tbl_ga_stat_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tbl_ga_stat">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="15"<?php if ($tbl_ga_stat_list->lDisplayRecs == 15) { ?> selected="selected"<?php } ?>>15</option>
<option value="30"<?php if ($tbl_ga_stat_list->lDisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="75"<?php if ($tbl_ga_stat_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($tbl_ga_stat_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($tbl_ga_stat->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_ga_stat_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $tbl_ga_stat_list->InlineAddUrl ?>"><?php echo $Language->Phrase("InlineAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($tbl_ga_stat_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftbl_ga_statlist, '<?php echo $tbl_ga_stat_list->MultiDeleteUrl ?>', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="ftbl_ga_statlist" id="ftbl_ga_statlist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="tbl_ga_stat">
<div id="gmp_tbl_ga_stat" class="ewGridMiddlePanel">
<?php if ($tbl_ga_stat_list->lTotalRecs > 0 || $tbl_ga_stat->CurrentAction == "add" || $tbl_ga_stat->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $tbl_ga_stat->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$tbl_ga_stat_list->RenderListOptions();

// Render list options (header, left)
$tbl_ga_stat_list->ListOptions->Render("header", "left");
?>
<?php if ($tbl_ga_stat->id_profile->Visible) { // id_profile ?>
	<?php if ($tbl_ga_stat->SortUrl($tbl_ga_stat->id_profile) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $tbl_ga_stat->id_profile->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_ga_stat->SortUrl($tbl_ga_stat->id_profile) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $tbl_ga_stat->id_profile->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_ga_stat->id_profile->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_ga_stat->id_profile->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_ga_stat->stat_date->Visible) { // stat_date ?>
	<?php if ($tbl_ga_stat->SortUrl($tbl_ga_stat->stat_date) == "") { ?>
		<td><?php echo $tbl_ga_stat->stat_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_ga_stat->SortUrl($tbl_ga_stat->stat_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_ga_stat->stat_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_ga_stat->stat_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_ga_stat->stat_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_ga_stat->year->Visible) { // year ?>
	<?php if ($tbl_ga_stat->SortUrl($tbl_ga_stat->year) == "") { ?>
		<td><?php echo $tbl_ga_stat->year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_ga_stat->SortUrl($tbl_ga_stat->year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_ga_stat->year->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_ga_stat->year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_ga_stat->year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_ga_stat->month->Visible) { // month ?>
	<?php if ($tbl_ga_stat->SortUrl($tbl_ga_stat->month) == "") { ?>
		<td><?php echo $tbl_ga_stat->month->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_ga_stat->SortUrl($tbl_ga_stat->month) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_ga_stat->month->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_ga_stat->month->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_ga_stat->month->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_ga_stat->week->Visible) { // week ?>
	<?php if ($tbl_ga_stat->SortUrl($tbl_ga_stat->week) == "") { ?>
		<td><?php echo $tbl_ga_stat->week->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_ga_stat->SortUrl($tbl_ga_stat->week) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_ga_stat->week->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_ga_stat->week->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_ga_stat->week->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_ga_stat->day->Visible) { // day ?>
	<?php if ($tbl_ga_stat->SortUrl($tbl_ga_stat->day) == "") { ?>
		<td><?php echo $tbl_ga_stat->day->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_ga_stat->SortUrl($tbl_ga_stat->day) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_ga_stat->day->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_ga_stat->day->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_ga_stat->day->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_ga_stat->hour->Visible) { // hour ?>
	<?php if ($tbl_ga_stat->SortUrl($tbl_ga_stat->hour) == "") { ?>
		<td><?php echo $tbl_ga_stat->hour->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_ga_stat->SortUrl($tbl_ga_stat->hour) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_ga_stat->hour->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_ga_stat->hour->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_ga_stat->hour->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_ga_stat->pageview->Visible) { // pageview ?>
	<?php if ($tbl_ga_stat->SortUrl($tbl_ga_stat->pageview) == "") { ?>
		<td><?php echo $tbl_ga_stat->pageview->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_ga_stat->SortUrl($tbl_ga_stat->pageview) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_ga_stat->pageview->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_ga_stat->pageview->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_ga_stat->pageview->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_ga_stat->visit->Visible) { // visit ?>
	<?php if ($tbl_ga_stat->SortUrl($tbl_ga_stat->visit) == "") { ?>
		<td><?php echo $tbl_ga_stat->visit->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_ga_stat->SortUrl($tbl_ga_stat->visit) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_ga_stat->visit->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_ga_stat->visit->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_ga_stat->visit->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$tbl_ga_stat_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
	if ($tbl_ga_stat->CurrentAction == "add" || $tbl_ga_stat->CurrentAction == "copy") {
		$tbl_ga_stat_list->lRowIndex = 1;
		if ($tbl_ga_stat->CurrentAction == "add")
			$tbl_ga_stat_list->LoadDefaultValues();
		if ($tbl_ga_stat->EventCancelled) // Insert failed
			$tbl_ga_stat_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$tbl_ga_stat->CssClass = "ewTableEditRow";
		$tbl_ga_stat->CssStyle = "";
		$tbl_ga_stat->RowAttrs = array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		$tbl_ga_stat->RowType = EW_ROWTYPE_ADD;

		// Render row
		$tbl_ga_stat_list->RenderRow();

		// Render list options
		$tbl_ga_stat_list->RenderListOptions();
?>
	<tr<?php echo $tbl_ga_stat->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_ga_stat_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_ga_stat->id_profile->Visible) { // id_profile ?>
		<td>
<select id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_id_profile" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_id_profile" title="<?php echo $tbl_ga_stat->id_profile->FldTitle() ?>"<?php echo $tbl_ga_stat->id_profile->EditAttributes() ?>>
<?php
if (is_array($tbl_ga_stat->id_profile->EditValue)) {
	$arwrk = $tbl_ga_stat->id_profile->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_ga_stat->id_profile->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</td>
	<?php } ?>
	<?php if ($tbl_ga_stat->stat_date->Visible) { // stat_date ?>
		<td>
<input type="text" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_stat_date" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_stat_date" title="<?php echo $tbl_ga_stat->stat_date->FldTitle() ?>" value="<?php echo $tbl_ga_stat->stat_date->EditValue ?>"<?php echo $tbl_ga_stat->stat_date->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_ga_stat->year->Visible) { // year ?>
		<td>
<input type="text" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_year" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_year" title="<?php echo $tbl_ga_stat->year->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->year->EditValue ?>"<?php echo $tbl_ga_stat->year->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_ga_stat->month->Visible) { // month ?>
		<td>
<input type="text" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_month" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_month" title="<?php echo $tbl_ga_stat->month->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->month->EditValue ?>"<?php echo $tbl_ga_stat->month->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_ga_stat->week->Visible) { // week ?>
		<td>
<input type="text" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_week" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_week" title="<?php echo $tbl_ga_stat->week->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->week->EditValue ?>"<?php echo $tbl_ga_stat->week->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_ga_stat->day->Visible) { // day ?>
		<td>
<div id="tp_x<?php echo $tbl_ga_stat_list->lRowIndex ?>_day" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_day" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_day" title="<?php echo $tbl_ga_stat->day->FldTitle() ?>" value="{value}"<?php echo $tbl_ga_stat->day->EditAttributes() ?>></label></div>
<div id="dsl_x<?php echo $tbl_ga_stat_list->lRowIndex ?>_day" repeatcolumn="5">
<?php
$arwrk = $tbl_ga_stat->day->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_ga_stat->day->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_day" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_day" title="<?php echo $tbl_ga_stat->day->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_ga_stat->day->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
</td>
	<?php } ?>
	<?php if ($tbl_ga_stat->hour->Visible) { // hour ?>
		<td>
<input type="text" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_hour" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_hour" title="<?php echo $tbl_ga_stat->hour->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->hour->EditValue ?>"<?php echo $tbl_ga_stat->hour->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_ga_stat->pageview->Visible) { // pageview ?>
		<td>
<input type="text" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_pageview" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_pageview" title="<?php echo $tbl_ga_stat->pageview->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->pageview->EditValue ?>"<?php echo $tbl_ga_stat->pageview->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_ga_stat->visit->Visible) { // visit ?>
		<td>
<input type="text" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_visit" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_visit" title="<?php echo $tbl_ga_stat->visit->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->visit->EditValue ?>"<?php echo $tbl_ga_stat->visit->EditAttributes() ?>>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_ga_stat_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
<?php
if ($tbl_ga_stat->ExportAll && $tbl_ga_stat->Export <> "") {
	$tbl_ga_stat_list->lStopRec = $tbl_ga_stat_list->lTotalRecs;
} else {
	$tbl_ga_stat_list->lStopRec = $tbl_ga_stat_list->lStartRec + $tbl_ga_stat_list->lDisplayRecs - 1; // Set the last record to display
}
$tbl_ga_stat_list->lRecCount = $tbl_ga_stat_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $tbl_ga_stat_list->lStartRec > 1)
		$rs->Move($tbl_ga_stat_list->lStartRec - 1);
}

// Initialize aggregate
$tbl_ga_stat->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tbl_ga_stat_list->RenderRow();
$tbl_ga_stat_list->lRowCnt = 0;
$tbl_ga_stat_list->lEditRowCnt = 0;
if ($tbl_ga_stat->CurrentAction == "edit")
	$tbl_ga_stat_list->lRowIndex = 1;
while (($tbl_ga_stat->CurrentAction == "gridadd" || !$rs->EOF) &&
	$tbl_ga_stat_list->lRecCount < $tbl_ga_stat_list->lStopRec) {
	$tbl_ga_stat_list->lRecCount++;
	if (intval($tbl_ga_stat_list->lRecCount) >= intval($tbl_ga_stat_list->lStartRec)) {
		$tbl_ga_stat_list->lRowCnt++;

	// Init row class and style
	$tbl_ga_stat->CssClass = "";
	$tbl_ga_stat->CssStyle = "";
	$tbl_ga_stat->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($tbl_ga_stat->CurrentAction == "gridadd") {
		$tbl_ga_stat_list->LoadDefaultValues(); // Load default values
	} else {
		$tbl_ga_stat_list->LoadRowValues($rs); // Load row values
	}
	$tbl_ga_stat->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($tbl_ga_stat->CurrentAction == "edit") {
		if ($tbl_ga_stat_list->CheckInlineEditKey() && $tbl_ga_stat_list->lEditRowCnt == 0) { // Inline edit
			$tbl_ga_stat->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
	}
	if ($tbl_ga_stat->RowType == EW_ROWTYPE_EDIT && $tbl_ga_stat->EventCancelled) { // Update failed
		if ($tbl_ga_stat->CurrentAction == "edit")
			$tbl_ga_stat_list->RestoreFormValues(); // Restore form values
	}
	if ($tbl_ga_stat->RowType == EW_ROWTYPE_EDIT) // Edit row
		$tbl_ga_stat_list->lEditRowCnt++;
	if ($tbl_ga_stat->RowType == EW_ROWTYPE_ADD || $tbl_ga_stat->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
		$tbl_ga_stat->RowAttrs = array_merge($tbl_ga_stat->RowAttrs, array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);'));
		$tbl_ga_stat->CssClass = "ewTableEditRow";
	}

	// Render row
	$tbl_ga_stat_list->RenderRow();

	// Render list options
	$tbl_ga_stat_list->RenderListOptions();
?>
	<tr<?php echo $tbl_ga_stat->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_ga_stat_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_ga_stat->id_profile->Visible) { // id_profile ?>
		<td<?php echo $tbl_ga_stat->id_profile->CellAttributes() ?>>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $tbl_ga_stat->id_profile->ViewAttributes() ?>><?php echo $tbl_ga_stat->id_profile->EditValue ?></div><input type="hidden" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_id_profile" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_id_profile" value="<?php echo ew_HtmlEncode($tbl_ga_stat->id_profile->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_ga_stat->id_profile->ViewAttributes() ?>><?php echo $tbl_ga_stat->id_profile->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_ga_stat->stat_date->Visible) { // stat_date ?>
		<td<?php echo $tbl_ga_stat->stat_date->CellAttributes() ?>>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $tbl_ga_stat->stat_date->ViewAttributes() ?>><?php echo $tbl_ga_stat->stat_date->EditValue ?></div><input type="hidden" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_stat_date" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_stat_date" value="<?php echo ew_HtmlEncode($tbl_ga_stat->stat_date->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_ga_stat->stat_date->ViewAttributes() ?>><?php echo $tbl_ga_stat->stat_date->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_ga_stat->year->Visible) { // year ?>
		<td<?php echo $tbl_ga_stat->year->CellAttributes() ?>>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_year" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_year" title="<?php echo $tbl_ga_stat->year->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->year->EditValue ?>"<?php echo $tbl_ga_stat->year->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_ga_stat->year->ViewAttributes() ?>><?php echo $tbl_ga_stat->year->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_ga_stat->month->Visible) { // month ?>
		<td<?php echo $tbl_ga_stat->month->CellAttributes() ?>>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_month" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_month" title="<?php echo $tbl_ga_stat->month->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->month->EditValue ?>"<?php echo $tbl_ga_stat->month->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_ga_stat->month->ViewAttributes() ?>><?php echo $tbl_ga_stat->month->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_ga_stat->week->Visible) { // week ?>
		<td<?php echo $tbl_ga_stat->week->CellAttributes() ?>>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_week" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_week" title="<?php echo $tbl_ga_stat->week->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->week->EditValue ?>"<?php echo $tbl_ga_stat->week->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_ga_stat->week->ViewAttributes() ?>><?php echo $tbl_ga_stat->week->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_ga_stat->day->Visible) { // day ?>
		<td<?php echo $tbl_ga_stat->day->CellAttributes() ?>>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $tbl_ga_stat_list->lRowIndex ?>_day" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_day" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_day" title="<?php echo $tbl_ga_stat->day->FldTitle() ?>" value="{value}"<?php echo $tbl_ga_stat->day->EditAttributes() ?>></label></div>
<div id="dsl_x<?php echo $tbl_ga_stat_list->lRowIndex ?>_day" repeatcolumn="5">
<?php
$arwrk = $tbl_ga_stat->day->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_ga_stat->day->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_day" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_day" title="<?php echo $tbl_ga_stat->day->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_ga_stat->day->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
<?php } ?>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_ga_stat->day->ViewAttributes() ?>><?php echo $tbl_ga_stat->day->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_ga_stat->hour->Visible) { // hour ?>
		<td<?php echo $tbl_ga_stat->hour->CellAttributes() ?>>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $tbl_ga_stat->hour->ViewAttributes() ?>><?php echo $tbl_ga_stat->hour->EditValue ?></div><input type="hidden" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_hour" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_hour" value="<?php echo ew_HtmlEncode($tbl_ga_stat->hour->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_ga_stat->hour->ViewAttributes() ?>><?php echo $tbl_ga_stat->hour->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_ga_stat->pageview->Visible) { // pageview ?>
		<td<?php echo $tbl_ga_stat->pageview->CellAttributes() ?>>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_pageview" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_pageview" title="<?php echo $tbl_ga_stat->pageview->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->pageview->EditValue ?>"<?php echo $tbl_ga_stat->pageview->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_ga_stat->pageview->ViewAttributes() ?>><?php echo $tbl_ga_stat->pageview->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_ga_stat->visit->Visible) { // visit ?>
		<td<?php echo $tbl_ga_stat->visit->CellAttributes() ?>>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_visit" id="x<?php echo $tbl_ga_stat_list->lRowIndex ?>_visit" title="<?php echo $tbl_ga_stat->visit->FldTitle() ?>" size="30" value="<?php echo $tbl_ga_stat->visit->EditValue ?>"<?php echo $tbl_ga_stat->visit->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_ga_stat->visit->ViewAttributes() ?>><?php echo $tbl_ga_stat->visit->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_ga_stat_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($tbl_ga_stat->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($tbl_ga_stat->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($tbl_ga_stat->CurrentAction == "add" || $tbl_ga_stat->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $tbl_ga_stat_list->lRowIndex ?>">
<?php } ?>
<?php if ($tbl_ga_stat->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $tbl_ga_stat_list->lRowIndex ?>">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($tbl_ga_stat_list->lTotalRecs > 0) { ?>
<?php if ($tbl_ga_stat->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($tbl_ga_stat->CurrentAction <> "gridadd" && $tbl_ga_stat->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_ga_stat_list->Pager)) $tbl_ga_stat_list->Pager = new cPrevNextPager($tbl_ga_stat_list->lStartRec, $tbl_ga_stat_list->lDisplayRecs, $tbl_ga_stat_list->lTotalRecs) ?>
<?php if ($tbl_ga_stat_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_ga_stat_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_ga_stat_list->PageUrl() ?>start=<?php echo $tbl_ga_stat_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_ga_stat_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_ga_stat_list->PageUrl() ?>start=<?php echo $tbl_ga_stat_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_ga_stat_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_ga_stat_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_ga_stat_list->PageUrl() ?>start=<?php echo $tbl_ga_stat_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_ga_stat_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_ga_stat_list->PageUrl() ?>start=<?php echo $tbl_ga_stat_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_ga_stat_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_ga_stat_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_ga_stat_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_ga_stat_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_ga_stat_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($tbl_ga_stat_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tbl_ga_stat">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="15"<?php if ($tbl_ga_stat_list->lDisplayRecs == 15) { ?> selected="selected"<?php } ?>>15</option>
<option value="30"<?php if ($tbl_ga_stat_list->lDisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="75"<?php if ($tbl_ga_stat_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($tbl_ga_stat_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($tbl_ga_stat->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($tbl_ga_stat_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_ga_stat_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $tbl_ga_stat_list->InlineAddUrl ?>"><?php echo $Language->Phrase("InlineAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($tbl_ga_stat_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftbl_ga_statlist, '<?php echo $tbl_ga_stat_list->MultiDeleteUrl ?>', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($tbl_ga_stat->Export == "" && $tbl_ga_stat->CurrentAction == "") { ?>
<?php } ?>
<?php if ($tbl_ga_stat->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_ga_stat_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_ga_stat_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'tbl_ga_stat';

	// Page object name
	var $PageObjName = 'tbl_ga_stat_list';

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
	function ctbl_ga_stat_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_ga_stat)
		$GLOBALS["tbl_ga_stat"] = new ctbl_ga_stat();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["tbl_ga_stat"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tbl_ga_statdelete.php";
		$this->MultiUpdateUrl = "tbl_ga_statupdate.php";

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_ga_stat', TRUE);

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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Create form object
		$objForm = new cFormObj();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$tbl_ga_stat->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$tbl_ga_stat->Export = $_POST["exporttype"];
		} else {
			$tbl_ga_stat->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $tbl_ga_stat->Export; // Get export parameter, used in header
		$gsExportFile = $tbl_ga_stat->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $tbl_ga_stat;

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
				$tbl_ga_stat->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($tbl_ga_stat->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($tbl_ga_stat->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($tbl_ga_stat->CurrentAction == "add" || $tbl_ga_stat->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$tbl_ga_stat->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if (($tbl_ga_stat->CurrentAction == "update" || $tbl_ga_stat->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($tbl_ga_stat->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
						$this->InlineInsert();
				}
			}

			// Set up list options
			$this->SetupListOptions();

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values
			if (!$this->ValidateSearch())
				$this->setMessage($gsSearchError);

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$tbl_ga_stat->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($tbl_ga_stat->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $tbl_ga_stat->getRecordsPerPage(); // Restore from Session
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
		$tbl_ga_stat->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$tbl_ga_stat->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$tbl_ga_stat->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $tbl_ga_stat->getSearchWhere();
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
		$tbl_ga_stat->setSessionWhere($sFilter);
		$tbl_ga_stat->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $tbl_ga_stat;
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
			$tbl_ga_stat->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$tbl_ga_stat->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $tbl_ga_stat;
		$tbl_ga_stat->setKey("id_profile", ""); // Clear inline edit key
		$tbl_ga_stat->setKey("stat_date", ""); // Clear inline edit key
		$tbl_ga_stat->setKey("hour", ""); // Clear inline edit key
		$tbl_ga_stat->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $tbl_ga_stat;
		if (!$Security->CanEdit())
			$this->Page_Terminate("login.php"); // Go to login page
		$bInlineEdit = TRUE;
		if (@$_GET["id_profile"] <> "") {
			$tbl_ga_stat->id_profile->setQueryStringValue($_GET["id_profile"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if (@$_GET["stat_date"] <> "") {
			$tbl_ga_stat->stat_date->setQueryStringValue($_GET["stat_date"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if (@$_GET["hour"] <> "") {
			$tbl_ga_stat->hour->setQueryStringValue($_GET["hour"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$tbl_ga_stat->setKey("id_profile", $tbl_ga_stat->id_profile->CurrentValue); // Set up inline edit key
				$tbl_ga_stat->setKey("stat_date", $tbl_ga_stat->stat_date->CurrentValue); // Set up inline edit key
				$tbl_ga_stat->setKey("hour", $tbl_ga_stat->hour->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError, $tbl_ga_stat;
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
				$tbl_ga_stat->SendEmail = TRUE; // Send email on update success
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
			$tbl_ga_stat->EventCancelled = TRUE; // Cancel event
			$tbl_ga_stat->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {
		global $tbl_ga_stat;

		//CheckInlineEditKey = True
		if (strval($tbl_ga_stat->getKey("id_profile")) <> strval($tbl_ga_stat->id_profile->CurrentValue))
			return FALSE;
		if (strval($tbl_ga_stat->getKey("stat_date")) <> strval($tbl_ga_stat->stat_date->CurrentValue))
			return FALSE;
		if (strval($tbl_ga_stat->getKey("hour")) <> strval($tbl_ga_stat->hour->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $tbl_ga_stat;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		$tbl_ga_stat->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to Inline Add/Copy record
	function InlineInsert() {
		global $Language, $objForm, $gsFormError, $tbl_ga_stat;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$tbl_ga_stat->EventCancelled = TRUE; // Set event cancelled
			$tbl_ga_stat->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$tbl_ga_stat->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage($Language->Phrase("AddSuccess")); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$tbl_ga_stat->EventCancelled = TRUE; // Set event cancelled
			$tbl_ga_stat->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $tbl_ga_stat;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $tbl_ga_stat->id_profile, FALSE); // id_profile
		$this->BuildSearchSql($sWhere, $tbl_ga_stat->stat_date, FALSE); // stat_date
		$this->BuildSearchSql($sWhere, $tbl_ga_stat->year, FALSE); // year
		$this->BuildSearchSql($sWhere, $tbl_ga_stat->month, FALSE); // month
		$this->BuildSearchSql($sWhere, $tbl_ga_stat->week, FALSE); // week
		$this->BuildSearchSql($sWhere, $tbl_ga_stat->day, FALSE); // day
		$this->BuildSearchSql($sWhere, $tbl_ga_stat->hour, FALSE); // hour
		$this->BuildSearchSql($sWhere, $tbl_ga_stat->pageview, FALSE); // pageview
		$this->BuildSearchSql($sWhere, $tbl_ga_stat->visit, FALSE); // visit

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($tbl_ga_stat->id_profile); // id_profile
			$this->SetSearchParm($tbl_ga_stat->stat_date); // stat_date
			$this->SetSearchParm($tbl_ga_stat->year); // year
			$this->SetSearchParm($tbl_ga_stat->month); // month
			$this->SetSearchParm($tbl_ga_stat->week); // week
			$this->SetSearchParm($tbl_ga_stat->day); // day
			$this->SetSearchParm($tbl_ga_stat->hour); // hour
			$this->SetSearchParm($tbl_ga_stat->pageview); // pageview
			$this->SetSearchParm($tbl_ga_stat->visit); // visit
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
		global $tbl_ga_stat;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$tbl_ga_stat->setAdvancedSearch("x_$FldParm", $FldVal);
		$tbl_ga_stat->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$tbl_ga_stat->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$tbl_ga_stat->setAdvancedSearch("y_$FldParm", $FldVal2);
		$tbl_ga_stat->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $tbl_ga_stat;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $tbl_ga_stat->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $tbl_ga_stat->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $tbl_ga_stat->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $tbl_ga_stat->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $tbl_ga_stat->GetAdvancedSearch("w_$FldParm");
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

	// Clear all search parameters
	function ResetSearchParms() {
		global $tbl_ga_stat;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$tbl_ga_stat->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $tbl_ga_stat;
		$tbl_ga_stat->setAdvancedSearch("x_id_profile", "");
		$tbl_ga_stat->setAdvancedSearch("x_stat_date", "");
		$tbl_ga_stat->setAdvancedSearch("x_year", "");
		$tbl_ga_stat->setAdvancedSearch("x_month", "");
		$tbl_ga_stat->setAdvancedSearch("x_week", "");
		$tbl_ga_stat->setAdvancedSearch("x_day", "");
		$tbl_ga_stat->setAdvancedSearch("x_hour", "");
		$tbl_ga_stat->setAdvancedSearch("x_pageview", "");
		$tbl_ga_stat->setAdvancedSearch("x_visit", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $tbl_ga_stat;
		$bRestore = TRUE;
		if (@$_GET["x_id_profile"] <> "") $bRestore = FALSE;
		if (@$_GET["x_stat_date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_year"] <> "") $bRestore = FALSE;
		if (@$_GET["x_month"] <> "") $bRestore = FALSE;
		if (@$_GET["x_week"] <> "") $bRestore = FALSE;
		if (@$_GET["x_day"] <> "") $bRestore = FALSE;
		if (@$_GET["x_hour"] <> "") $bRestore = FALSE;
		if (@$_GET["x_pageview"] <> "") $bRestore = FALSE;
		if (@$_GET["x_visit"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($tbl_ga_stat->id_profile);
			$this->GetSearchParm($tbl_ga_stat->stat_date);
			$this->GetSearchParm($tbl_ga_stat->year);
			$this->GetSearchParm($tbl_ga_stat->month);
			$this->GetSearchParm($tbl_ga_stat->week);
			$this->GetSearchParm($tbl_ga_stat->day);
			$this->GetSearchParm($tbl_ga_stat->hour);
			$this->GetSearchParm($tbl_ga_stat->pageview);
			$this->GetSearchParm($tbl_ga_stat->visit);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $tbl_ga_stat;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$tbl_ga_stat->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$tbl_ga_stat->CurrentOrderType = @$_GET["ordertype"];
			$tbl_ga_stat->UpdateSort($tbl_ga_stat->id_profile); // id_profile
			$tbl_ga_stat->UpdateSort($tbl_ga_stat->stat_date); // stat_date
			$tbl_ga_stat->UpdateSort($tbl_ga_stat->year); // year
			$tbl_ga_stat->UpdateSort($tbl_ga_stat->month); // month
			$tbl_ga_stat->UpdateSort($tbl_ga_stat->week); // week
			$tbl_ga_stat->UpdateSort($tbl_ga_stat->day); // day
			$tbl_ga_stat->UpdateSort($tbl_ga_stat->hour); // hour
			$tbl_ga_stat->UpdateSort($tbl_ga_stat->pageview); // pageview
			$tbl_ga_stat->UpdateSort($tbl_ga_stat->visit); // visit
			$tbl_ga_stat->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $tbl_ga_stat;
		$sOrderBy = $tbl_ga_stat->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($tbl_ga_stat->SqlOrderBy() <> "") {
				$sOrderBy = $tbl_ga_stat->SqlOrderBy();
				$tbl_ga_stat->setSessionOrderBy($sOrderBy);
				$tbl_ga_stat->stat_date->setSort("DESC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $tbl_ga_stat;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$tbl_ga_stat->setSessionOrderBy($sOrderBy);
				$tbl_ga_stat->id_profile->setSort("");
				$tbl_ga_stat->stat_date->setSort("");
				$tbl_ga_stat->year->setSort("");
				$tbl_ga_stat->month->setSort("");
				$tbl_ga_stat->week->setSort("");
				$tbl_ga_stat->day->setSort("");
				$tbl_ga_stat->hour->setSort("");
				$tbl_ga_stat->pageview->setSort("");
				$tbl_ga_stat->visit->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$tbl_ga_stat->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $tbl_ga_stat;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"tbl_ga_stat_list.SelectAllKey(this);\">";
		$this->ListOptions->MoveItem("checkbox", 0); // Move to first column

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($tbl_ga_stat->Export <> "" ||
			$tbl_ga_stat->CurrentAction == "gridadd" ||
			$tbl_ga_stat->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $tbl_ga_stat;
		$this->ListOptions->LoadDefault();

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if (($tbl_ga_stat->CurrentAction == "add" || $tbl_ga_stat->CurrentAction == "copy") &&
			$tbl_ga_stat->RowType == EW_ROWTYPE_ADD) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
				"<a href=\"\" onclick=\"f=document.ftbl_ga_statlist;if(tbl_ga_stat_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("InsertLink") . "</a>&nbsp;" .
				"<a href=\"" . $this->PageUrl() . "a=cancel\">" . $Language->Phrase("CancelLink") . "</a>" .
				"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"insert\"></div>";
			return;
		}

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($tbl_ga_stat->CurrentAction == "edit" && $tbl_ga_stat->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a href=\"\" onclick=\"f=document.ftbl_ga_statlist;if(tbl_ga_stat_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($tbl_ga_stat->id_profile->CurrentValue . EW_COMPOSITE_KEY_SEPARATOR . $tbl_ga_stat->stat_date->CurrentValue . EW_COMPOSITE_KEY_SEPARATOR . $tbl_ga_stat->hour->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $tbl_ga_stat;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_ga_stat;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_ga_stat->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_ga_stat->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_ga_stat->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_ga_stat->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_ga_stat->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_ga_stat->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $tbl_ga_stat;
		$tbl_ga_stat->day->CurrentValue = "1";
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $tbl_ga_stat;

		// Load search values
		// id_profile

		$tbl_ga_stat->id_profile->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id_profile"]);
		$tbl_ga_stat->id_profile->AdvancedSearch->SearchOperator = @$_GET["z_id_profile"];

		// stat_date
		$tbl_ga_stat->stat_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_stat_date"]);
		$tbl_ga_stat->stat_date->AdvancedSearch->SearchOperator = @$_GET["z_stat_date"];

		// year
		$tbl_ga_stat->year->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_year"]);
		$tbl_ga_stat->year->AdvancedSearch->SearchOperator = @$_GET["z_year"];

		// month
		$tbl_ga_stat->month->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_month"]);
		$tbl_ga_stat->month->AdvancedSearch->SearchOperator = @$_GET["z_month"];

		// week
		$tbl_ga_stat->week->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_week"]);
		$tbl_ga_stat->week->AdvancedSearch->SearchOperator = @$_GET["z_week"];

		// day
		$tbl_ga_stat->day->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_day"]);
		$tbl_ga_stat->day->AdvancedSearch->SearchOperator = @$_GET["z_day"];

		// hour
		$tbl_ga_stat->hour->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_hour"]);
		$tbl_ga_stat->hour->AdvancedSearch->SearchOperator = @$_GET["z_hour"];

		// pageview
		$tbl_ga_stat->pageview->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pageview"]);
		$tbl_ga_stat->pageview->AdvancedSearch->SearchOperator = @$_GET["z_pageview"];

		// visit
		$tbl_ga_stat->visit->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_visit"]);
		$tbl_ga_stat->visit->AdvancedSearch->SearchOperator = @$_GET["z_visit"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_ga_stat;
		$tbl_ga_stat->id_profile->setFormValue($objForm->GetValue("x_id_profile"));
		$tbl_ga_stat->stat_date->setFormValue($objForm->GetValue("x_stat_date"));
		$tbl_ga_stat->stat_date->CurrentValue = ew_UnFormatDateTime($tbl_ga_stat->stat_date->CurrentValue, 5);
		$tbl_ga_stat->year->setFormValue($objForm->GetValue("x_year"));
		$tbl_ga_stat->month->setFormValue($objForm->GetValue("x_month"));
		$tbl_ga_stat->week->setFormValue($objForm->GetValue("x_week"));
		$tbl_ga_stat->day->setFormValue($objForm->GetValue("x_day"));
		$tbl_ga_stat->hour->setFormValue($objForm->GetValue("x_hour"));
		$tbl_ga_stat->pageview->setFormValue($objForm->GetValue("x_pageview"));
		$tbl_ga_stat->visit->setFormValue($objForm->GetValue("x_visit"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_ga_stat;
		$tbl_ga_stat->id_profile->CurrentValue = $tbl_ga_stat->id_profile->FormValue;
		$tbl_ga_stat->stat_date->CurrentValue = $tbl_ga_stat->stat_date->FormValue;
		$tbl_ga_stat->stat_date->CurrentValue = ew_UnFormatDateTime($tbl_ga_stat->stat_date->CurrentValue, 5);
		$tbl_ga_stat->year->CurrentValue = $tbl_ga_stat->year->FormValue;
		$tbl_ga_stat->month->CurrentValue = $tbl_ga_stat->month->FormValue;
		$tbl_ga_stat->week->CurrentValue = $tbl_ga_stat->week->FormValue;
		$tbl_ga_stat->day->CurrentValue = $tbl_ga_stat->day->FormValue;
		$tbl_ga_stat->hour->CurrentValue = $tbl_ga_stat->hour->FormValue;
		$tbl_ga_stat->pageview->CurrentValue = $tbl_ga_stat->pageview->FormValue;
		$tbl_ga_stat->visit->CurrentValue = $tbl_ga_stat->visit->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_ga_stat;

		// Call Recordset Selecting event
		$tbl_ga_stat->Recordset_Selecting($tbl_ga_stat->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_ga_stat->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_ga_stat->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_ga_stat;
		$sFilter = $tbl_ga_stat->KeyFilter();

		// Call Row Selecting event
		$tbl_ga_stat->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_ga_stat->CurrentFilter = $sFilter;
		$sSql = $tbl_ga_stat->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_ga_stat->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_ga_stat;
		$tbl_ga_stat->id_profile->setDbValue($rs->fields('id_profile'));
		$tbl_ga_stat->stat_date->setDbValue($rs->fields('stat_date'));
		$tbl_ga_stat->year->setDbValue($rs->fields('year'));
		$tbl_ga_stat->month->setDbValue($rs->fields('month'));
		$tbl_ga_stat->week->setDbValue($rs->fields('week'));
		$tbl_ga_stat->day->setDbValue($rs->fields('day'));
		$tbl_ga_stat->hour->setDbValue($rs->fields('hour'));
		$tbl_ga_stat->pageview->setDbValue($rs->fields('pageview'));
		$tbl_ga_stat->visit->setDbValue($rs->fields('visit'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_ga_stat;

		// Initialize URLs
		$this->ViewUrl = $tbl_ga_stat->ViewUrl();
		$this->EditUrl = $tbl_ga_stat->EditUrl();
		$this->InlineEditUrl = $tbl_ga_stat->InlineEditUrl();
		$this->CopyUrl = $tbl_ga_stat->CopyUrl();
		$this->InlineCopyUrl = $tbl_ga_stat->InlineCopyUrl();
		$this->DeleteUrl = $tbl_ga_stat->DeleteUrl();

		// Call Row_Rendering event
		$tbl_ga_stat->Row_Rendering();

		// Common render codes for all row types
		// id_profile

		$tbl_ga_stat->id_profile->CellCssStyle = "white-space: nowrap;"; $tbl_ga_stat->id_profile->CellCssClass = "";
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
		} elseif ($tbl_ga_stat->RowType == EW_ROWTYPE_ADD) { // Add row

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
			$tbl_ga_stat->stat_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($tbl_ga_stat->stat_date->CurrentValue, 5));

			// year
			$tbl_ga_stat->year->EditCustomAttributes = "";
			$tbl_ga_stat->year->EditValue = ew_HtmlEncode($tbl_ga_stat->year->CurrentValue);

			// month
			$tbl_ga_stat->month->EditCustomAttributes = "";
			$tbl_ga_stat->month->EditValue = ew_HtmlEncode($tbl_ga_stat->month->CurrentValue);

			// week
			$tbl_ga_stat->week->EditCustomAttributes = "";
			$tbl_ga_stat->week->EditValue = ew_HtmlEncode($tbl_ga_stat->week->CurrentValue);

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
			$tbl_ga_stat->hour->EditValue = ew_HtmlEncode(ew_FormatDateTime($tbl_ga_stat->hour->CurrentValue, 4));

			// pageview
			$tbl_ga_stat->pageview->EditCustomAttributes = "";
			$tbl_ga_stat->pageview->EditValue = ew_HtmlEncode($tbl_ga_stat->pageview->CurrentValue);

			// visit
			$tbl_ga_stat->visit->EditCustomAttributes = "";
			$tbl_ga_stat->visit->EditValue = ew_HtmlEncode($tbl_ga_stat->visit->CurrentValue);
		} elseif ($tbl_ga_stat->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_profile
			$tbl_ga_stat->id_profile->EditCustomAttributes = "";
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
					$tbl_ga_stat->id_profile->EditValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_ga_stat->id_profile->EditValue = $tbl_ga_stat->id_profile->CurrentValue;
				}
			} else {
				$tbl_ga_stat->id_profile->EditValue = NULL;
			}
			$tbl_ga_stat->id_profile->CssStyle = "";
			$tbl_ga_stat->id_profile->CssClass = "";
			$tbl_ga_stat->id_profile->ViewCustomAttributes = "";

			// stat_date
			$tbl_ga_stat->stat_date->EditCustomAttributes = "";
			$tbl_ga_stat->stat_date->EditValue = $tbl_ga_stat->stat_date->CurrentValue;
			$tbl_ga_stat->stat_date->EditValue = ew_FormatDateTime($tbl_ga_stat->stat_date->EditValue, 5);
			$tbl_ga_stat->stat_date->CssStyle = "";
			$tbl_ga_stat->stat_date->CssClass = "";
			$tbl_ga_stat->stat_date->ViewCustomAttributes = "";

			// year
			$tbl_ga_stat->year->EditCustomAttributes = "";
			$tbl_ga_stat->year->EditValue = ew_HtmlEncode($tbl_ga_stat->year->CurrentValue);

			// month
			$tbl_ga_stat->month->EditCustomAttributes = "";
			$tbl_ga_stat->month->EditValue = ew_HtmlEncode($tbl_ga_stat->month->CurrentValue);

			// week
			$tbl_ga_stat->week->EditCustomAttributes = "";
			$tbl_ga_stat->week->EditValue = ew_HtmlEncode($tbl_ga_stat->week->CurrentValue);

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
			$tbl_ga_stat->hour->EditValue = $tbl_ga_stat->hour->CurrentValue;
			$tbl_ga_stat->hour->EditValue = ew_FormatDateTime($tbl_ga_stat->hour->EditValue, 4);
			$tbl_ga_stat->hour->CssStyle = "";
			$tbl_ga_stat->hour->CssClass = "";
			$tbl_ga_stat->hour->ViewCustomAttributes = "";

			// pageview
			$tbl_ga_stat->pageview->EditCustomAttributes = "";
			$tbl_ga_stat->pageview->EditValue = ew_HtmlEncode($tbl_ga_stat->pageview->CurrentValue);

			// visit
			$tbl_ga_stat->visit->EditCustomAttributes = "";
			$tbl_ga_stat->visit->EditValue = ew_HtmlEncode($tbl_ga_stat->visit->CurrentValue);

			// Edit refer script
			// id_profile

			$tbl_ga_stat->id_profile->HrefValue = "";

			// stat_date
			$tbl_ga_stat->stat_date->HrefValue = "";

			// year
			$tbl_ga_stat->year->HrefValue = "";

			// month
			$tbl_ga_stat->month->HrefValue = "";

			// week
			$tbl_ga_stat->week->HrefValue = "";

			// day
			$tbl_ga_stat->day->HrefValue = "";

			// hour
			$tbl_ga_stat->hour->HrefValue = "";

			// pageview
			$tbl_ga_stat->pageview->HrefValue = "";

			// visit
			$tbl_ga_stat->visit->HrefValue = "";
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
		global $Language, $gsFormError, $tbl_ga_stat;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_ga_stat->id_profile->FormValue) && $tbl_ga_stat->id_profile->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_ga_stat->id_profile->FldCaption();
		}
		if (!is_null($tbl_ga_stat->stat_date->FormValue) && $tbl_ga_stat->stat_date->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_ga_stat->stat_date->FldCaption();
		}
		if (!ew_CheckDate($tbl_ga_stat->stat_date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_ga_stat->stat_date->FldErrMsg();
		}
		if (!is_null($tbl_ga_stat->year->FormValue) && $tbl_ga_stat->year->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_ga_stat->year->FldCaption();
		}
		if (!ew_CheckInteger($tbl_ga_stat->year->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_ga_stat->year->FldErrMsg();
		}
		if (!is_null($tbl_ga_stat->month->FormValue) && $tbl_ga_stat->month->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_ga_stat->month->FldCaption();
		}
		if (!ew_CheckInteger($tbl_ga_stat->month->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_ga_stat->month->FldErrMsg();
		}
		if (!is_null($tbl_ga_stat->week->FormValue) && $tbl_ga_stat->week->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_ga_stat->week->FldCaption();
		}
		if (!ew_CheckInteger($tbl_ga_stat->week->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_ga_stat->week->FldErrMsg();
		}
		if (!is_null($tbl_ga_stat->hour->FormValue) && $tbl_ga_stat->hour->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_ga_stat->hour->FldCaption();
		}
		if (!ew_CheckTime($tbl_ga_stat->hour->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_ga_stat->hour->FldErrMsg();
		}
		if (!is_null($tbl_ga_stat->pageview->FormValue) && $tbl_ga_stat->pageview->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_ga_stat->pageview->FldCaption();
		}
		if (!ew_CheckInteger($tbl_ga_stat->pageview->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_ga_stat->pageview->FldErrMsg();
		}
		if (!is_null($tbl_ga_stat->visit->FormValue) && $tbl_ga_stat->visit->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_ga_stat->visit->FldCaption();
		}
		if (!ew_CheckInteger($tbl_ga_stat->visit->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_ga_stat->visit->FldErrMsg();
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
		global $conn, $Security, $Language, $tbl_ga_stat;
		$sFilter = $tbl_ga_stat->KeyFilter();
		$tbl_ga_stat->CurrentFilter = $sFilter;
		$sSql = $tbl_ga_stat->SQL();
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
			// stat_date
			// year

			$tbl_ga_stat->year->SetDbValueDef($rsnew, $tbl_ga_stat->year->CurrentValue, 0, FALSE);

			// month
			$tbl_ga_stat->month->SetDbValueDef($rsnew, $tbl_ga_stat->month->CurrentValue, 0, FALSE);

			// week
			$tbl_ga_stat->week->SetDbValueDef($rsnew, $tbl_ga_stat->week->CurrentValue, 0, FALSE);

			// day
			$tbl_ga_stat->day->SetDbValueDef($rsnew, $tbl_ga_stat->day->CurrentValue, "", FALSE);

			// hour
			// pageview

			$tbl_ga_stat->pageview->SetDbValueDef($rsnew, $tbl_ga_stat->pageview->CurrentValue, 0, FALSE);

			// visit
			$tbl_ga_stat->visit->SetDbValueDef($rsnew, $tbl_ga_stat->visit->CurrentValue, 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $tbl_ga_stat->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_ga_stat->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_ga_stat->CancelMessage <> "") {
					$this->setMessage($tbl_ga_stat->CancelMessage);
					$tbl_ga_stat->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_ga_stat->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $tbl_ga_stat;

		// Check if key value entered
		if ($tbl_ga_stat->id_profile->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check if key value entered
		if ($tbl_ga_stat->stat_date->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check if key value entered
		if ($tbl_ga_stat->hour->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $tbl_ga_stat->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $tbl_ga_stat->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// id_profile
		$tbl_ga_stat->id_profile->SetDbValueDef($rsnew, $tbl_ga_stat->id_profile->CurrentValue, 0, FALSE);

		// stat_date
		$tbl_ga_stat->stat_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($tbl_ga_stat->stat_date->CurrentValue, 5, FALSE), ew_CurrentDate());

		// year
		$tbl_ga_stat->year->SetDbValueDef($rsnew, $tbl_ga_stat->year->CurrentValue, 0, FALSE);

		// month
		$tbl_ga_stat->month->SetDbValueDef($rsnew, $tbl_ga_stat->month->CurrentValue, 0, FALSE);

		// week
		$tbl_ga_stat->week->SetDbValueDef($rsnew, $tbl_ga_stat->week->CurrentValue, 0, FALSE);

		// day
		$tbl_ga_stat->day->SetDbValueDef($rsnew, $tbl_ga_stat->day->CurrentValue, "", TRUE);

		// hour
		$tbl_ga_stat->hour->SetDbValueDef($rsnew, ew_FormatDateTime($tbl_ga_stat->hour->CurrentValue, 4), ew_CurrentTime(), FALSE);

		// pageview
		$tbl_ga_stat->pageview->SetDbValueDef($rsnew, $tbl_ga_stat->pageview->CurrentValue, 0, FALSE);

		// visit
		$tbl_ga_stat->visit->SetDbValueDef($rsnew, $tbl_ga_stat->visit->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$bInsertRow = $tbl_ga_stat->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tbl_ga_stat->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tbl_ga_stat->CancelMessage <> "") {
				$this->setMessage($tbl_ga_stat->CancelMessage);
				$tbl_ga_stat->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$tbl_ga_stat->Row_Inserted($rsnew);
		}
		return $AddRow;
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
