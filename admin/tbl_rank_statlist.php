<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_rank_statinfo.php" ?>
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
$tbl_rank_stat_list = new ctbl_rank_stat_list();
$Page =& $tbl_rank_stat_list;

// Page init
$tbl_rank_stat_list->Page_Init();

// Page main
$tbl_rank_stat_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_rank_stat->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_rank_stat_list = new ew_Page("tbl_rank_stat_list");

// page properties
tbl_rank_stat_list.PageID = "list"; // page ID
tbl_rank_stat_list.FormID = "ftbl_rank_statlist"; // form ID
var EW_PAGE_ID = tbl_rank_stat_list.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_rank_stat_list.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_rank_stat->id_profile->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_stat_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_rank_stat->stat_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_stat_date"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_rank_stat->stat_date->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_rank_stat->year->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_rank_stat->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_rank_stat->month->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_rank_stat->month->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_week"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_rank_stat->week->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_week"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_rank_stat->week->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_alexa_rank"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_rank_stat->alexa_rank->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_google_pagerank"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_rank_stat->google_pagerank->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_rank_stat_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_rank_stat_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_rank_stat_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_rank_stat_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_rank_stat_list.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_rank_stat_list.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<?php if ($tbl_rank_stat->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$tbl_rank_stat_list->lTotalRecs = $tbl_rank_stat->SelectRecordCount();
	} else {
		if ($rs = $tbl_rank_stat_list->LoadRecordset())
			$tbl_rank_stat_list->lTotalRecs = $rs->RecordCount();
	}
	$tbl_rank_stat_list->lStartRec = 1;
	if ($tbl_rank_stat_list->lDisplayRecs <= 0 || ($tbl_rank_stat->Export <> "" && $tbl_rank_stat->ExportAll)) // Display all records
		$tbl_rank_stat_list->lDisplayRecs = $tbl_rank_stat_list->lTotalRecs;
	if (!($tbl_rank_stat->Export <> "" && $tbl_rank_stat->ExportAll))
		$tbl_rank_stat_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $tbl_rank_stat_list->LoadRecordset($tbl_rank_stat_list->lStartRec-1, $tbl_rank_stat_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_rank_stat->TableCaption() ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($tbl_rank_stat->Export == "" && $tbl_rank_stat->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(tbl_rank_stat_list);" style="text-decoration: none;"><img id="tbl_rank_stat_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="tbl_rank_stat_list_SearchPanel">
<form name="ftbl_rank_statlistsrch" id="ftbl_rank_statlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="tbl_rank_stat">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $tbl_rank_stat_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="tbl_rank_statsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
			<?php if ($tbl_rank_stat_list->sSrchWhere <> "" && $tbl_rank_stat_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(tbl_rank_stat_list, this, '<?php echo $tbl_rank_stat->HighlightName() ?>');"><?php echo $Language->Phrase("HideHighlight") ?></a>
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
$tbl_rank_stat_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($tbl_rank_stat->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($tbl_rank_stat->CurrentAction <> "gridadd" && $tbl_rank_stat->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_rank_stat_list->Pager)) $tbl_rank_stat_list->Pager = new cPrevNextPager($tbl_rank_stat_list->lStartRec, $tbl_rank_stat_list->lDisplayRecs, $tbl_rank_stat_list->lTotalRecs) ?>
<?php if ($tbl_rank_stat_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_rank_stat_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_rank_stat_list->PageUrl() ?>start=<?php echo $tbl_rank_stat_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_rank_stat_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_rank_stat_list->PageUrl() ?>start=<?php echo $tbl_rank_stat_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_rank_stat_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_rank_stat_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_rank_stat_list->PageUrl() ?>start=<?php echo $tbl_rank_stat_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_rank_stat_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_rank_stat_list->PageUrl() ?>start=<?php echo $tbl_rank_stat_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_rank_stat_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_rank_stat_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_rank_stat_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_rank_stat_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_rank_stat_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($tbl_rank_stat_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tbl_rank_stat">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="15"<?php if ($tbl_rank_stat_list->lDisplayRecs == 15) { ?> selected="selected"<?php } ?>>15</option>
<option value="30"<?php if ($tbl_rank_stat_list->lDisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="75"<?php if ($tbl_rank_stat_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($tbl_rank_stat_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($tbl_rank_stat->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_rank_stat_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $tbl_rank_stat_list->InlineAddUrl ?>"><?php echo $Language->Phrase("InlineAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($tbl_rank_stat_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftbl_rank_statlist, '<?php echo $tbl_rank_stat_list->MultiDeleteUrl ?>', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="ftbl_rank_statlist" id="ftbl_rank_statlist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="tbl_rank_stat">
<div id="gmp_tbl_rank_stat" class="ewGridMiddlePanel">
<?php if ($tbl_rank_stat_list->lTotalRecs > 0 || $tbl_rank_stat->CurrentAction == "add" || $tbl_rank_stat->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $tbl_rank_stat->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$tbl_rank_stat_list->RenderListOptions();

// Render list options (header, left)
$tbl_rank_stat_list->ListOptions->Render("header", "left");
?>
<?php if ($tbl_rank_stat->id_profile->Visible) { // id_profile ?>
	<?php if ($tbl_rank_stat->SortUrl($tbl_rank_stat->id_profile) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $tbl_rank_stat->id_profile->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_rank_stat->SortUrl($tbl_rank_stat->id_profile) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $tbl_rank_stat->id_profile->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_rank_stat->id_profile->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_rank_stat->id_profile->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_rank_stat->stat_date->Visible) { // stat_date ?>
	<?php if ($tbl_rank_stat->SortUrl($tbl_rank_stat->stat_date) == "") { ?>
		<td><?php echo $tbl_rank_stat->stat_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_rank_stat->SortUrl($tbl_rank_stat->stat_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_rank_stat->stat_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_rank_stat->stat_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_rank_stat->stat_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_rank_stat->year->Visible) { // year ?>
	<?php if ($tbl_rank_stat->SortUrl($tbl_rank_stat->year) == "") { ?>
		<td><?php echo $tbl_rank_stat->year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_rank_stat->SortUrl($tbl_rank_stat->year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_rank_stat->year->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_rank_stat->year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_rank_stat->year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_rank_stat->month->Visible) { // month ?>
	<?php if ($tbl_rank_stat->SortUrl($tbl_rank_stat->month) == "") { ?>
		<td><?php echo $tbl_rank_stat->month->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_rank_stat->SortUrl($tbl_rank_stat->month) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_rank_stat->month->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_rank_stat->month->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_rank_stat->month->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_rank_stat->week->Visible) { // week ?>
	<?php if ($tbl_rank_stat->SortUrl($tbl_rank_stat->week) == "") { ?>
		<td><?php echo $tbl_rank_stat->week->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_rank_stat->SortUrl($tbl_rank_stat->week) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_rank_stat->week->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_rank_stat->week->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_rank_stat->week->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_rank_stat->alexa_rank->Visible) { // alexa_rank ?>
	<?php if ($tbl_rank_stat->SortUrl($tbl_rank_stat->alexa_rank) == "") { ?>
		<td><?php echo $tbl_rank_stat->alexa_rank->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_rank_stat->SortUrl($tbl_rank_stat->alexa_rank) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_rank_stat->alexa_rank->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_rank_stat->alexa_rank->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_rank_stat->alexa_rank->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_rank_stat->google_pagerank->Visible) { // google_pagerank ?>
	<?php if ($tbl_rank_stat->SortUrl($tbl_rank_stat->google_pagerank) == "") { ?>
		<td><?php echo $tbl_rank_stat->google_pagerank->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_rank_stat->SortUrl($tbl_rank_stat->google_pagerank) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_rank_stat->google_pagerank->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_rank_stat->google_pagerank->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_rank_stat->google_pagerank->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$tbl_rank_stat_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
	if ($tbl_rank_stat->CurrentAction == "add" || $tbl_rank_stat->CurrentAction == "copy") {
		$tbl_rank_stat_list->lRowIndex = 1;
		if ($tbl_rank_stat->CurrentAction == "add")
			$tbl_rank_stat_list->LoadDefaultValues();
		if ($tbl_rank_stat->EventCancelled) // Insert failed
			$tbl_rank_stat_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$tbl_rank_stat->CssClass = "ewTableEditRow";
		$tbl_rank_stat->CssStyle = "";
		$tbl_rank_stat->RowAttrs = array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		$tbl_rank_stat->RowType = EW_ROWTYPE_ADD;

		// Render row
		$tbl_rank_stat_list->RenderRow();

		// Render list options
		$tbl_rank_stat_list->RenderListOptions();
?>
	<tr<?php echo $tbl_rank_stat->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_rank_stat_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_rank_stat->id_profile->Visible) { // id_profile ?>
		<td>
<select id="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_id_profile" name="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_id_profile" title="<?php echo $tbl_rank_stat->id_profile->FldTitle() ?>"<?php echo $tbl_rank_stat->id_profile->EditAttributes() ?>>
<?php
if (is_array($tbl_rank_stat->id_profile->EditValue)) {
	$arwrk = $tbl_rank_stat->id_profile->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_rank_stat->id_profile->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<?php if ($tbl_rank_stat->stat_date->Visible) { // stat_date ?>
		<td>
<input type="text" name="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_stat_date" id="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_stat_date" title="<?php echo $tbl_rank_stat->stat_date->FldTitle() ?>" value="<?php echo $tbl_rank_stat->stat_date->EditValue ?>"<?php echo $tbl_rank_stat->stat_date->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_rank_stat->year->Visible) { // year ?>
		<td>
<input type="text" name="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_year" id="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_year" title="<?php echo $tbl_rank_stat->year->FldTitle() ?>" size="30" value="<?php echo $tbl_rank_stat->year->EditValue ?>"<?php echo $tbl_rank_stat->year->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_rank_stat->month->Visible) { // month ?>
		<td>
<input type="text" name="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_month" id="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_month" title="<?php echo $tbl_rank_stat->month->FldTitle() ?>" size="30" value="<?php echo $tbl_rank_stat->month->EditValue ?>"<?php echo $tbl_rank_stat->month->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_rank_stat->week->Visible) { // week ?>
		<td>
<input type="text" name="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_week" id="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_week" title="<?php echo $tbl_rank_stat->week->FldTitle() ?>" size="30" value="<?php echo $tbl_rank_stat->week->EditValue ?>"<?php echo $tbl_rank_stat->week->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_rank_stat->alexa_rank->Visible) { // alexa_rank ?>
		<td>
<input type="text" name="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_alexa_rank" id="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_alexa_rank" title="<?php echo $tbl_rank_stat->alexa_rank->FldTitle() ?>" size="30" value="<?php echo $tbl_rank_stat->alexa_rank->EditValue ?>"<?php echo $tbl_rank_stat->alexa_rank->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_rank_stat->google_pagerank->Visible) { // google_pagerank ?>
		<td>
<input type="text" name="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_google_pagerank" id="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_google_pagerank" title="<?php echo $tbl_rank_stat->google_pagerank->FldTitle() ?>" size="30" value="<?php echo $tbl_rank_stat->google_pagerank->EditValue ?>"<?php echo $tbl_rank_stat->google_pagerank->EditAttributes() ?>>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_rank_stat_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
<?php
if ($tbl_rank_stat->ExportAll && $tbl_rank_stat->Export <> "") {
	$tbl_rank_stat_list->lStopRec = $tbl_rank_stat_list->lTotalRecs;
} else {
	$tbl_rank_stat_list->lStopRec = $tbl_rank_stat_list->lStartRec + $tbl_rank_stat_list->lDisplayRecs - 1; // Set the last record to display
}
$tbl_rank_stat_list->lRecCount = $tbl_rank_stat_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $tbl_rank_stat_list->lStartRec > 1)
		$rs->Move($tbl_rank_stat_list->lStartRec - 1);
}

// Initialize aggregate
$tbl_rank_stat->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tbl_rank_stat_list->RenderRow();
$tbl_rank_stat_list->lRowCnt = 0;
$tbl_rank_stat_list->lEditRowCnt = 0;
if ($tbl_rank_stat->CurrentAction == "edit")
	$tbl_rank_stat_list->lRowIndex = 1;
while (($tbl_rank_stat->CurrentAction == "gridadd" || !$rs->EOF) &&
	$tbl_rank_stat_list->lRecCount < $tbl_rank_stat_list->lStopRec) {
	$tbl_rank_stat_list->lRecCount++;
	if (intval($tbl_rank_stat_list->lRecCount) >= intval($tbl_rank_stat_list->lStartRec)) {
		$tbl_rank_stat_list->lRowCnt++;

	// Init row class and style
	$tbl_rank_stat->CssClass = "";
	$tbl_rank_stat->CssStyle = "";
	$tbl_rank_stat->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($tbl_rank_stat->CurrentAction == "gridadd") {
		$tbl_rank_stat_list->LoadDefaultValues(); // Load default values
	} else {
		$tbl_rank_stat_list->LoadRowValues($rs); // Load row values
	}
	$tbl_rank_stat->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($tbl_rank_stat->CurrentAction == "edit") {
		if ($tbl_rank_stat_list->CheckInlineEditKey() && $tbl_rank_stat_list->lEditRowCnt == 0) { // Inline edit
			$tbl_rank_stat->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
	}
	if ($tbl_rank_stat->RowType == EW_ROWTYPE_EDIT && $tbl_rank_stat->EventCancelled) { // Update failed
		if ($tbl_rank_stat->CurrentAction == "edit")
			$tbl_rank_stat_list->RestoreFormValues(); // Restore form values
	}
	if ($tbl_rank_stat->RowType == EW_ROWTYPE_EDIT) // Edit row
		$tbl_rank_stat_list->lEditRowCnt++;
	if ($tbl_rank_stat->RowType == EW_ROWTYPE_ADD || $tbl_rank_stat->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
		$tbl_rank_stat->RowAttrs = array_merge($tbl_rank_stat->RowAttrs, array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);'));
		$tbl_rank_stat->CssClass = "ewTableEditRow";
	}

	// Render row
	$tbl_rank_stat_list->RenderRow();

	// Render list options
	$tbl_rank_stat_list->RenderListOptions();
?>
	<tr<?php echo $tbl_rank_stat->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_rank_stat_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_rank_stat->id_profile->Visible) { // id_profile ?>
		<td<?php echo $tbl_rank_stat->id_profile->CellAttributes() ?>>
<?php if ($tbl_rank_stat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $tbl_rank_stat->id_profile->ViewAttributes() ?>><?php echo $tbl_rank_stat->id_profile->EditValue ?></div><input type="hidden" name="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_id_profile" id="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_id_profile" value="<?php echo ew_HtmlEncode($tbl_rank_stat->id_profile->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_rank_stat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_rank_stat->id_profile->ViewAttributes() ?>><?php echo $tbl_rank_stat->id_profile->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_rank_stat->stat_date->Visible) { // stat_date ?>
		<td<?php echo $tbl_rank_stat->stat_date->CellAttributes() ?>>
<?php if ($tbl_rank_stat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $tbl_rank_stat->stat_date->ViewAttributes() ?>><?php echo $tbl_rank_stat->stat_date->EditValue ?></div><input type="hidden" name="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_stat_date" id="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_stat_date" value="<?php echo ew_HtmlEncode($tbl_rank_stat->stat_date->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_rank_stat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_rank_stat->stat_date->ViewAttributes() ?>><?php echo $tbl_rank_stat->stat_date->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_rank_stat->year->Visible) { // year ?>
		<td<?php echo $tbl_rank_stat->year->CellAttributes() ?>>
<?php if ($tbl_rank_stat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_year" id="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_year" title="<?php echo $tbl_rank_stat->year->FldTitle() ?>" size="30" value="<?php echo $tbl_rank_stat->year->EditValue ?>"<?php echo $tbl_rank_stat->year->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_rank_stat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_rank_stat->year->ViewAttributes() ?>><?php echo $tbl_rank_stat->year->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_rank_stat->month->Visible) { // month ?>
		<td<?php echo $tbl_rank_stat->month->CellAttributes() ?>>
<?php if ($tbl_rank_stat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_month" id="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_month" title="<?php echo $tbl_rank_stat->month->FldTitle() ?>" size="30" value="<?php echo $tbl_rank_stat->month->EditValue ?>"<?php echo $tbl_rank_stat->month->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_rank_stat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_rank_stat->month->ViewAttributes() ?>><?php echo $tbl_rank_stat->month->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_rank_stat->week->Visible) { // week ?>
		<td<?php echo $tbl_rank_stat->week->CellAttributes() ?>>
<?php if ($tbl_rank_stat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_week" id="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_week" title="<?php echo $tbl_rank_stat->week->FldTitle() ?>" size="30" value="<?php echo $tbl_rank_stat->week->EditValue ?>"<?php echo $tbl_rank_stat->week->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_rank_stat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_rank_stat->week->ViewAttributes() ?>><?php echo $tbl_rank_stat->week->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_rank_stat->alexa_rank->Visible) { // alexa_rank ?>
		<td<?php echo $tbl_rank_stat->alexa_rank->CellAttributes() ?>>
<?php if ($tbl_rank_stat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_alexa_rank" id="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_alexa_rank" title="<?php echo $tbl_rank_stat->alexa_rank->FldTitle() ?>" size="30" value="<?php echo $tbl_rank_stat->alexa_rank->EditValue ?>"<?php echo $tbl_rank_stat->alexa_rank->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_rank_stat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_rank_stat->alexa_rank->ViewAttributes() ?>><?php echo $tbl_rank_stat->alexa_rank->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_rank_stat->google_pagerank->Visible) { // google_pagerank ?>
		<td<?php echo $tbl_rank_stat->google_pagerank->CellAttributes() ?>>
<?php if ($tbl_rank_stat->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_google_pagerank" id="x<?php echo $tbl_rank_stat_list->lRowIndex ?>_google_pagerank" title="<?php echo $tbl_rank_stat->google_pagerank->FldTitle() ?>" size="30" value="<?php echo $tbl_rank_stat->google_pagerank->EditValue ?>"<?php echo $tbl_rank_stat->google_pagerank->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_rank_stat->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_rank_stat->google_pagerank->ViewAttributes() ?>><?php echo $tbl_rank_stat->google_pagerank->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_rank_stat_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($tbl_rank_stat->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($tbl_rank_stat->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($tbl_rank_stat->CurrentAction == "add" || $tbl_rank_stat->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $tbl_rank_stat_list->lRowIndex ?>">
<?php } ?>
<?php if ($tbl_rank_stat->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $tbl_rank_stat_list->lRowIndex ?>">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($tbl_rank_stat_list->lTotalRecs > 0) { ?>
<?php if ($tbl_rank_stat->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($tbl_rank_stat->CurrentAction <> "gridadd" && $tbl_rank_stat->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_rank_stat_list->Pager)) $tbl_rank_stat_list->Pager = new cPrevNextPager($tbl_rank_stat_list->lStartRec, $tbl_rank_stat_list->lDisplayRecs, $tbl_rank_stat_list->lTotalRecs) ?>
<?php if ($tbl_rank_stat_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_rank_stat_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_rank_stat_list->PageUrl() ?>start=<?php echo $tbl_rank_stat_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_rank_stat_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_rank_stat_list->PageUrl() ?>start=<?php echo $tbl_rank_stat_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_rank_stat_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_rank_stat_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_rank_stat_list->PageUrl() ?>start=<?php echo $tbl_rank_stat_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_rank_stat_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_rank_stat_list->PageUrl() ?>start=<?php echo $tbl_rank_stat_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_rank_stat_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_rank_stat_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_rank_stat_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_rank_stat_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_rank_stat_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($tbl_rank_stat_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tbl_rank_stat">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="15"<?php if ($tbl_rank_stat_list->lDisplayRecs == 15) { ?> selected="selected"<?php } ?>>15</option>
<option value="30"<?php if ($tbl_rank_stat_list->lDisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="75"<?php if ($tbl_rank_stat_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($tbl_rank_stat_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($tbl_rank_stat->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($tbl_rank_stat_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_rank_stat_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $tbl_rank_stat_list->InlineAddUrl ?>"><?php echo $Language->Phrase("InlineAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($tbl_rank_stat_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftbl_rank_statlist, '<?php echo $tbl_rank_stat_list->MultiDeleteUrl ?>', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($tbl_rank_stat->Export == "" && $tbl_rank_stat->CurrentAction == "") { ?>
<?php } ?>
<?php if ($tbl_rank_stat->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_rank_stat_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_rank_stat_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'tbl_rank_stat';

	// Page object name
	var $PageObjName = 'tbl_rank_stat_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_rank_stat;
		if ($tbl_rank_stat->UseTokenInUrl) $PageUrl .= "t=" . $tbl_rank_stat->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_rank_stat;
		if ($tbl_rank_stat->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_rank_stat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_rank_stat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_rank_stat_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_rank_stat)
		$GLOBALS["tbl_rank_stat"] = new ctbl_rank_stat();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["tbl_rank_stat"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tbl_rank_statdelete.php";
		$this->MultiUpdateUrl = "tbl_rank_statupdate.php";

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_rank_stat', TRUE);

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
		global $tbl_rank_stat;

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
			$tbl_rank_stat->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$tbl_rank_stat->Export = $_POST["exporttype"];
		} else {
			$tbl_rank_stat->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $tbl_rank_stat->Export; // Get export parameter, used in header
		$gsExportFile = $tbl_rank_stat->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $tbl_rank_stat;

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
				$tbl_rank_stat->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($tbl_rank_stat->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($tbl_rank_stat->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($tbl_rank_stat->CurrentAction == "add" || $tbl_rank_stat->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$tbl_rank_stat->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if (($tbl_rank_stat->CurrentAction == "update" || $tbl_rank_stat->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($tbl_rank_stat->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
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
			$tbl_rank_stat->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($tbl_rank_stat->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $tbl_rank_stat->getRecordsPerPage(); // Restore from Session
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
		$tbl_rank_stat->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$tbl_rank_stat->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$tbl_rank_stat->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $tbl_rank_stat->getSearchWhere();
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
		$tbl_rank_stat->setSessionWhere($sFilter);
		$tbl_rank_stat->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $tbl_rank_stat;
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
			$tbl_rank_stat->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$tbl_rank_stat->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $tbl_rank_stat;
		$tbl_rank_stat->setKey("id_profile", ""); // Clear inline edit key
		$tbl_rank_stat->setKey("stat_date", ""); // Clear inline edit key
		$tbl_rank_stat->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $tbl_rank_stat;
		if (!$Security->CanEdit())
			$this->Page_Terminate("login.php"); // Go to login page
		$bInlineEdit = TRUE;
		if (@$_GET["id_profile"] <> "") {
			$tbl_rank_stat->id_profile->setQueryStringValue($_GET["id_profile"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if (@$_GET["stat_date"] <> "") {
			$tbl_rank_stat->stat_date->setQueryStringValue($_GET["stat_date"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$tbl_rank_stat->setKey("id_profile", $tbl_rank_stat->id_profile->CurrentValue); // Set up inline edit key
				$tbl_rank_stat->setKey("stat_date", $tbl_rank_stat->stat_date->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError, $tbl_rank_stat;
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
				$tbl_rank_stat->SendEmail = TRUE; // Send email on update success
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
			$tbl_rank_stat->EventCancelled = TRUE; // Cancel event
			$tbl_rank_stat->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {
		global $tbl_rank_stat;

		//CheckInlineEditKey = True
		if (strval($tbl_rank_stat->getKey("id_profile")) <> strval($tbl_rank_stat->id_profile->CurrentValue))
			return FALSE;
		if (strval($tbl_rank_stat->getKey("stat_date")) <> strval($tbl_rank_stat->stat_date->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $tbl_rank_stat;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		$tbl_rank_stat->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to Inline Add/Copy record
	function InlineInsert() {
		global $Language, $objForm, $gsFormError, $tbl_rank_stat;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$tbl_rank_stat->EventCancelled = TRUE; // Set event cancelled
			$tbl_rank_stat->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$tbl_rank_stat->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage($Language->Phrase("AddSuccess")); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$tbl_rank_stat->EventCancelled = TRUE; // Set event cancelled
			$tbl_rank_stat->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $tbl_rank_stat;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $tbl_rank_stat->id_profile, FALSE); // id_profile
		$this->BuildSearchSql($sWhere, $tbl_rank_stat->stat_date, FALSE); // stat_date
		$this->BuildSearchSql($sWhere, $tbl_rank_stat->year, FALSE); // year
		$this->BuildSearchSql($sWhere, $tbl_rank_stat->month, FALSE); // month
		$this->BuildSearchSql($sWhere, $tbl_rank_stat->week, FALSE); // week
		$this->BuildSearchSql($sWhere, $tbl_rank_stat->alexa_rank, FALSE); // alexa_rank
		$this->BuildSearchSql($sWhere, $tbl_rank_stat->google_pagerank, FALSE); // google_pagerank

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($tbl_rank_stat->id_profile); // id_profile
			$this->SetSearchParm($tbl_rank_stat->stat_date); // stat_date
			$this->SetSearchParm($tbl_rank_stat->year); // year
			$this->SetSearchParm($tbl_rank_stat->month); // month
			$this->SetSearchParm($tbl_rank_stat->week); // week
			$this->SetSearchParm($tbl_rank_stat->alexa_rank); // alexa_rank
			$this->SetSearchParm($tbl_rank_stat->google_pagerank); // google_pagerank
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
		global $tbl_rank_stat;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$tbl_rank_stat->setAdvancedSearch("x_$FldParm", $FldVal);
		$tbl_rank_stat->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$tbl_rank_stat->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$tbl_rank_stat->setAdvancedSearch("y_$FldParm", $FldVal2);
		$tbl_rank_stat->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $tbl_rank_stat;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $tbl_rank_stat->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $tbl_rank_stat->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $tbl_rank_stat->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $tbl_rank_stat->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $tbl_rank_stat->GetAdvancedSearch("w_$FldParm");
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
		global $tbl_rank_stat;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$tbl_rank_stat->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $tbl_rank_stat;
		$tbl_rank_stat->setAdvancedSearch("x_id_profile", "");
		$tbl_rank_stat->setAdvancedSearch("x_stat_date", "");
		$tbl_rank_stat->setAdvancedSearch("x_year", "");
		$tbl_rank_stat->setAdvancedSearch("x_month", "");
		$tbl_rank_stat->setAdvancedSearch("x_week", "");
		$tbl_rank_stat->setAdvancedSearch("x_alexa_rank", "");
		$tbl_rank_stat->setAdvancedSearch("x_google_pagerank", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $tbl_rank_stat;
		$bRestore = TRUE;
		if (@$_GET["x_id_profile"] <> "") $bRestore = FALSE;
		if (@$_GET["x_stat_date"] <> "") $bRestore = FALSE;
		if (@$_GET["x_year"] <> "") $bRestore = FALSE;
		if (@$_GET["x_month"] <> "") $bRestore = FALSE;
		if (@$_GET["x_week"] <> "") $bRestore = FALSE;
		if (@$_GET["x_alexa_rank"] <> "") $bRestore = FALSE;
		if (@$_GET["x_google_pagerank"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($tbl_rank_stat->id_profile);
			$this->GetSearchParm($tbl_rank_stat->stat_date);
			$this->GetSearchParm($tbl_rank_stat->year);
			$this->GetSearchParm($tbl_rank_stat->month);
			$this->GetSearchParm($tbl_rank_stat->week);
			$this->GetSearchParm($tbl_rank_stat->alexa_rank);
			$this->GetSearchParm($tbl_rank_stat->google_pagerank);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $tbl_rank_stat;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$tbl_rank_stat->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$tbl_rank_stat->CurrentOrderType = @$_GET["ordertype"];
			$tbl_rank_stat->UpdateSort($tbl_rank_stat->id_profile); // id_profile
			$tbl_rank_stat->UpdateSort($tbl_rank_stat->stat_date); // stat_date
			$tbl_rank_stat->UpdateSort($tbl_rank_stat->year); // year
			$tbl_rank_stat->UpdateSort($tbl_rank_stat->month); // month
			$tbl_rank_stat->UpdateSort($tbl_rank_stat->week); // week
			$tbl_rank_stat->UpdateSort($tbl_rank_stat->alexa_rank); // alexa_rank
			$tbl_rank_stat->UpdateSort($tbl_rank_stat->google_pagerank); // google_pagerank
			$tbl_rank_stat->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $tbl_rank_stat;
		$sOrderBy = $tbl_rank_stat->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($tbl_rank_stat->SqlOrderBy() <> "") {
				$sOrderBy = $tbl_rank_stat->SqlOrderBy();
				$tbl_rank_stat->setSessionOrderBy($sOrderBy);
				$tbl_rank_stat->stat_date->setSort("DESC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $tbl_rank_stat;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$tbl_rank_stat->setSessionOrderBy($sOrderBy);
				$tbl_rank_stat->id_profile->setSort("");
				$tbl_rank_stat->stat_date->setSort("");
				$tbl_rank_stat->year->setSort("");
				$tbl_rank_stat->month->setSort("");
				$tbl_rank_stat->week->setSort("");
				$tbl_rank_stat->alexa_rank->setSort("");
				$tbl_rank_stat->google_pagerank->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$tbl_rank_stat->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $tbl_rank_stat;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"tbl_rank_stat_list.SelectAllKey(this);\">";
		$this->ListOptions->MoveItem("checkbox", 0); // Move to first column

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($tbl_rank_stat->Export <> "" ||
			$tbl_rank_stat->CurrentAction == "gridadd" ||
			$tbl_rank_stat->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $tbl_rank_stat;
		$this->ListOptions->LoadDefault();

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if (($tbl_rank_stat->CurrentAction == "add" || $tbl_rank_stat->CurrentAction == "copy") &&
			$tbl_rank_stat->RowType == EW_ROWTYPE_ADD) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
				"<a href=\"\" onclick=\"f=document.ftbl_rank_statlist;if(tbl_rank_stat_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("InsertLink") . "</a>&nbsp;" .
				"<a href=\"" . $this->PageUrl() . "a=cancel\">" . $Language->Phrase("CancelLink") . "</a>" .
				"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"insert\"></div>";
			return;
		}

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($tbl_rank_stat->CurrentAction == "edit" && $tbl_rank_stat->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a href=\"\" onclick=\"f=document.ftbl_rank_statlist;if(tbl_rank_stat_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($tbl_rank_stat->id_profile->CurrentValue . EW_COMPOSITE_KEY_SEPARATOR . $tbl_rank_stat->stat_date->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $tbl_rank_stat;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_rank_stat;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_rank_stat->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_rank_stat->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_rank_stat->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_rank_stat->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_rank_stat->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_rank_stat->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $tbl_rank_stat;
		$tbl_rank_stat->alexa_rank->CurrentValue = 0;
		$tbl_rank_stat->google_pagerank->CurrentValue = 0;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $tbl_rank_stat;

		// Load search values
		// id_profile

		$tbl_rank_stat->id_profile->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id_profile"]);
		$tbl_rank_stat->id_profile->AdvancedSearch->SearchOperator = @$_GET["z_id_profile"];

		// stat_date
		$tbl_rank_stat->stat_date->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_stat_date"]);
		$tbl_rank_stat->stat_date->AdvancedSearch->SearchOperator = @$_GET["z_stat_date"];

		// year
		$tbl_rank_stat->year->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_year"]);
		$tbl_rank_stat->year->AdvancedSearch->SearchOperator = @$_GET["z_year"];

		// month
		$tbl_rank_stat->month->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_month"]);
		$tbl_rank_stat->month->AdvancedSearch->SearchOperator = @$_GET["z_month"];

		// week
		$tbl_rank_stat->week->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_week"]);
		$tbl_rank_stat->week->AdvancedSearch->SearchOperator = @$_GET["z_week"];

		// alexa_rank
		$tbl_rank_stat->alexa_rank->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_alexa_rank"]);
		$tbl_rank_stat->alexa_rank->AdvancedSearch->SearchOperator = @$_GET["z_alexa_rank"];

		// google_pagerank
		$tbl_rank_stat->google_pagerank->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_google_pagerank"]);
		$tbl_rank_stat->google_pagerank->AdvancedSearch->SearchOperator = @$_GET["z_google_pagerank"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_rank_stat;
		$tbl_rank_stat->id_profile->setFormValue($objForm->GetValue("x_id_profile"));
		$tbl_rank_stat->stat_date->setFormValue($objForm->GetValue("x_stat_date"));
		$tbl_rank_stat->stat_date->CurrentValue = ew_UnFormatDateTime($tbl_rank_stat->stat_date->CurrentValue, 5);
		$tbl_rank_stat->year->setFormValue($objForm->GetValue("x_year"));
		$tbl_rank_stat->month->setFormValue($objForm->GetValue("x_month"));
		$tbl_rank_stat->week->setFormValue($objForm->GetValue("x_week"));
		$tbl_rank_stat->alexa_rank->setFormValue($objForm->GetValue("x_alexa_rank"));
		$tbl_rank_stat->google_pagerank->setFormValue($objForm->GetValue("x_google_pagerank"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_rank_stat;
		$tbl_rank_stat->id_profile->CurrentValue = $tbl_rank_stat->id_profile->FormValue;
		$tbl_rank_stat->stat_date->CurrentValue = $tbl_rank_stat->stat_date->FormValue;
		$tbl_rank_stat->stat_date->CurrentValue = ew_UnFormatDateTime($tbl_rank_stat->stat_date->CurrentValue, 5);
		$tbl_rank_stat->year->CurrentValue = $tbl_rank_stat->year->FormValue;
		$tbl_rank_stat->month->CurrentValue = $tbl_rank_stat->month->FormValue;
		$tbl_rank_stat->week->CurrentValue = $tbl_rank_stat->week->FormValue;
		$tbl_rank_stat->alexa_rank->CurrentValue = $tbl_rank_stat->alexa_rank->FormValue;
		$tbl_rank_stat->google_pagerank->CurrentValue = $tbl_rank_stat->google_pagerank->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_rank_stat;

		// Call Recordset Selecting event
		$tbl_rank_stat->Recordset_Selecting($tbl_rank_stat->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_rank_stat->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_rank_stat->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_rank_stat;
		$sFilter = $tbl_rank_stat->KeyFilter();

		// Call Row Selecting event
		$tbl_rank_stat->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_rank_stat->CurrentFilter = $sFilter;
		$sSql = $tbl_rank_stat->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_rank_stat->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_rank_stat;
		$tbl_rank_stat->id_profile->setDbValue($rs->fields('id_profile'));
		$tbl_rank_stat->stat_date->setDbValue($rs->fields('stat_date'));
		$tbl_rank_stat->year->setDbValue($rs->fields('year'));
		$tbl_rank_stat->month->setDbValue($rs->fields('month'));
		$tbl_rank_stat->week->setDbValue($rs->fields('week'));
		$tbl_rank_stat->alexa_rank->setDbValue($rs->fields('alexa_rank'));
		$tbl_rank_stat->google_pagerank->setDbValue($rs->fields('google_pagerank'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_rank_stat;

		// Initialize URLs
		$this->ViewUrl = $tbl_rank_stat->ViewUrl();
		$this->EditUrl = $tbl_rank_stat->EditUrl();
		$this->InlineEditUrl = $tbl_rank_stat->InlineEditUrl();
		$this->CopyUrl = $tbl_rank_stat->CopyUrl();
		$this->InlineCopyUrl = $tbl_rank_stat->InlineCopyUrl();
		$this->DeleteUrl = $tbl_rank_stat->DeleteUrl();

		// Call Row_Rendering event
		$tbl_rank_stat->Row_Rendering();

		// Common render codes for all row types
		// id_profile

		$tbl_rank_stat->id_profile->CellCssStyle = "white-space: nowrap;"; $tbl_rank_stat->id_profile->CellCssClass = "";
		$tbl_rank_stat->id_profile->CellAttrs = array(); $tbl_rank_stat->id_profile->ViewAttrs = array(); $tbl_rank_stat->id_profile->EditAttrs = array();

		// stat_date
		$tbl_rank_stat->stat_date->CellCssStyle = ""; $tbl_rank_stat->stat_date->CellCssClass = "";
		$tbl_rank_stat->stat_date->CellAttrs = array(); $tbl_rank_stat->stat_date->ViewAttrs = array(); $tbl_rank_stat->stat_date->EditAttrs = array();

		// year
		$tbl_rank_stat->year->CellCssStyle = ""; $tbl_rank_stat->year->CellCssClass = "";
		$tbl_rank_stat->year->CellAttrs = array(); $tbl_rank_stat->year->ViewAttrs = array(); $tbl_rank_stat->year->EditAttrs = array();

		// month
		$tbl_rank_stat->month->CellCssStyle = ""; $tbl_rank_stat->month->CellCssClass = "";
		$tbl_rank_stat->month->CellAttrs = array(); $tbl_rank_stat->month->ViewAttrs = array(); $tbl_rank_stat->month->EditAttrs = array();

		// week
		$tbl_rank_stat->week->CellCssStyle = ""; $tbl_rank_stat->week->CellCssClass = "";
		$tbl_rank_stat->week->CellAttrs = array(); $tbl_rank_stat->week->ViewAttrs = array(); $tbl_rank_stat->week->EditAttrs = array();

		// alexa_rank
		$tbl_rank_stat->alexa_rank->CellCssStyle = ""; $tbl_rank_stat->alexa_rank->CellCssClass = "";
		$tbl_rank_stat->alexa_rank->CellAttrs = array(); $tbl_rank_stat->alexa_rank->ViewAttrs = array(); $tbl_rank_stat->alexa_rank->EditAttrs = array();

		// google_pagerank
		$tbl_rank_stat->google_pagerank->CellCssStyle = ""; $tbl_rank_stat->google_pagerank->CellCssClass = "";
		$tbl_rank_stat->google_pagerank->CellAttrs = array(); $tbl_rank_stat->google_pagerank->ViewAttrs = array(); $tbl_rank_stat->google_pagerank->EditAttrs = array();
		if ($tbl_rank_stat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_profile
			if (strval($tbl_rank_stat->id_profile->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_rank_stat->id_profile->CurrentValue) . "";
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
					$tbl_rank_stat->id_profile->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_rank_stat->id_profile->ViewValue = $tbl_rank_stat->id_profile->CurrentValue;
				}
			} else {
				$tbl_rank_stat->id_profile->ViewValue = NULL;
			}
			$tbl_rank_stat->id_profile->CssStyle = "";
			$tbl_rank_stat->id_profile->CssClass = "";
			$tbl_rank_stat->id_profile->ViewCustomAttributes = "";

			// stat_date
			$tbl_rank_stat->stat_date->ViewValue = $tbl_rank_stat->stat_date->CurrentValue;
			$tbl_rank_stat->stat_date->ViewValue = ew_FormatDateTime($tbl_rank_stat->stat_date->ViewValue, 5);
			$tbl_rank_stat->stat_date->CssStyle = "";
			$tbl_rank_stat->stat_date->CssClass = "";
			$tbl_rank_stat->stat_date->ViewCustomAttributes = "";

			// year
			$tbl_rank_stat->year->ViewValue = $tbl_rank_stat->year->CurrentValue;
			$tbl_rank_stat->year->CssStyle = "";
			$tbl_rank_stat->year->CssClass = "";
			$tbl_rank_stat->year->ViewCustomAttributes = "";

			// month
			$tbl_rank_stat->month->ViewValue = $tbl_rank_stat->month->CurrentValue;
			$tbl_rank_stat->month->CssStyle = "";
			$tbl_rank_stat->month->CssClass = "";
			$tbl_rank_stat->month->ViewCustomAttributes = "";

			// week
			$tbl_rank_stat->week->ViewValue = $tbl_rank_stat->week->CurrentValue;
			$tbl_rank_stat->week->CssStyle = "";
			$tbl_rank_stat->week->CssClass = "";
			$tbl_rank_stat->week->ViewCustomAttributes = "";

			// alexa_rank
			$tbl_rank_stat->alexa_rank->ViewValue = $tbl_rank_stat->alexa_rank->CurrentValue;
			$tbl_rank_stat->alexa_rank->CssStyle = "";
			$tbl_rank_stat->alexa_rank->CssClass = "";
			$tbl_rank_stat->alexa_rank->ViewCustomAttributes = "";

			// google_pagerank
			$tbl_rank_stat->google_pagerank->ViewValue = $tbl_rank_stat->google_pagerank->CurrentValue;
			$tbl_rank_stat->google_pagerank->CssStyle = "";
			$tbl_rank_stat->google_pagerank->CssClass = "";
			$tbl_rank_stat->google_pagerank->ViewCustomAttributes = "";

			// id_profile
			$tbl_rank_stat->id_profile->HrefValue = "";
			$tbl_rank_stat->id_profile->TooltipValue = "";

			// stat_date
			$tbl_rank_stat->stat_date->HrefValue = "";
			$tbl_rank_stat->stat_date->TooltipValue = "";

			// year
			$tbl_rank_stat->year->HrefValue = "";
			$tbl_rank_stat->year->TooltipValue = "";

			// month
			$tbl_rank_stat->month->HrefValue = "";
			$tbl_rank_stat->month->TooltipValue = "";

			// week
			$tbl_rank_stat->week->HrefValue = "";
			$tbl_rank_stat->week->TooltipValue = "";

			// alexa_rank
			$tbl_rank_stat->alexa_rank->HrefValue = "";
			$tbl_rank_stat->alexa_rank->TooltipValue = "";

			// google_pagerank
			$tbl_rank_stat->google_pagerank->HrefValue = "";
			$tbl_rank_stat->google_pagerank->TooltipValue = "";
		} elseif ($tbl_rank_stat->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_profile
			$tbl_rank_stat->id_profile->EditCustomAttributes = "";
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
			$tbl_rank_stat->id_profile->EditValue = $arwrk;

			// stat_date
			$tbl_rank_stat->stat_date->EditCustomAttributes = "";
			$tbl_rank_stat->stat_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($tbl_rank_stat->stat_date->CurrentValue, 5));

			// year
			$tbl_rank_stat->year->EditCustomAttributes = "";
			$tbl_rank_stat->year->EditValue = ew_HtmlEncode($tbl_rank_stat->year->CurrentValue);

			// month
			$tbl_rank_stat->month->EditCustomAttributes = "";
			$tbl_rank_stat->month->EditValue = ew_HtmlEncode($tbl_rank_stat->month->CurrentValue);

			// week
			$tbl_rank_stat->week->EditCustomAttributes = "";
			$tbl_rank_stat->week->EditValue = ew_HtmlEncode($tbl_rank_stat->week->CurrentValue);

			// alexa_rank
			$tbl_rank_stat->alexa_rank->EditCustomAttributes = "";
			$tbl_rank_stat->alexa_rank->EditValue = ew_HtmlEncode($tbl_rank_stat->alexa_rank->CurrentValue);

			// google_pagerank
			$tbl_rank_stat->google_pagerank->EditCustomAttributes = "";
			$tbl_rank_stat->google_pagerank->EditValue = ew_HtmlEncode($tbl_rank_stat->google_pagerank->CurrentValue);
		} elseif ($tbl_rank_stat->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_profile
			$tbl_rank_stat->id_profile->EditCustomAttributes = "";
			if (strval($tbl_rank_stat->id_profile->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_rank_stat->id_profile->CurrentValue) . "";
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
					$tbl_rank_stat->id_profile->EditValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_rank_stat->id_profile->EditValue = $tbl_rank_stat->id_profile->CurrentValue;
				}
			} else {
				$tbl_rank_stat->id_profile->EditValue = NULL;
			}
			$tbl_rank_stat->id_profile->CssStyle = "";
			$tbl_rank_stat->id_profile->CssClass = "";
			$tbl_rank_stat->id_profile->ViewCustomAttributes = "";

			// stat_date
			$tbl_rank_stat->stat_date->EditCustomAttributes = "";
			$tbl_rank_stat->stat_date->EditValue = $tbl_rank_stat->stat_date->CurrentValue;
			$tbl_rank_stat->stat_date->EditValue = ew_FormatDateTime($tbl_rank_stat->stat_date->EditValue, 5);
			$tbl_rank_stat->stat_date->CssStyle = "";
			$tbl_rank_stat->stat_date->CssClass = "";
			$tbl_rank_stat->stat_date->ViewCustomAttributes = "";

			// year
			$tbl_rank_stat->year->EditCustomAttributes = "";
			$tbl_rank_stat->year->EditValue = ew_HtmlEncode($tbl_rank_stat->year->CurrentValue);

			// month
			$tbl_rank_stat->month->EditCustomAttributes = "";
			$tbl_rank_stat->month->EditValue = ew_HtmlEncode($tbl_rank_stat->month->CurrentValue);

			// week
			$tbl_rank_stat->week->EditCustomAttributes = "";
			$tbl_rank_stat->week->EditValue = ew_HtmlEncode($tbl_rank_stat->week->CurrentValue);

			// alexa_rank
			$tbl_rank_stat->alexa_rank->EditCustomAttributes = "";
			$tbl_rank_stat->alexa_rank->EditValue = ew_HtmlEncode($tbl_rank_stat->alexa_rank->CurrentValue);

			// google_pagerank
			$tbl_rank_stat->google_pagerank->EditCustomAttributes = "";
			$tbl_rank_stat->google_pagerank->EditValue = ew_HtmlEncode($tbl_rank_stat->google_pagerank->CurrentValue);

			// Edit refer script
			// id_profile

			$tbl_rank_stat->id_profile->HrefValue = "";

			// stat_date
			$tbl_rank_stat->stat_date->HrefValue = "";

			// year
			$tbl_rank_stat->year->HrefValue = "";

			// month
			$tbl_rank_stat->month->HrefValue = "";

			// week
			$tbl_rank_stat->week->HrefValue = "";

			// alexa_rank
			$tbl_rank_stat->alexa_rank->HrefValue = "";

			// google_pagerank
			$tbl_rank_stat->google_pagerank->HrefValue = "";
		}

		// Call Row Rendered event
		if ($tbl_rank_stat->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_rank_stat->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $tbl_rank_stat;

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
		global $Language, $gsFormError, $tbl_rank_stat;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_rank_stat->id_profile->FormValue) && $tbl_rank_stat->id_profile->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_rank_stat->id_profile->FldCaption();
		}
		if (!is_null($tbl_rank_stat->stat_date->FormValue) && $tbl_rank_stat->stat_date->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_rank_stat->stat_date->FldCaption();
		}
		if (!ew_CheckDate($tbl_rank_stat->stat_date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_rank_stat->stat_date->FldErrMsg();
		}
		if (!is_null($tbl_rank_stat->year->FormValue) && $tbl_rank_stat->year->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_rank_stat->year->FldCaption();
		}
		if (!ew_CheckInteger($tbl_rank_stat->year->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_rank_stat->year->FldErrMsg();
		}
		if (!is_null($tbl_rank_stat->month->FormValue) && $tbl_rank_stat->month->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_rank_stat->month->FldCaption();
		}
		if (!ew_CheckInteger($tbl_rank_stat->month->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_rank_stat->month->FldErrMsg();
		}
		if (!is_null($tbl_rank_stat->week->FormValue) && $tbl_rank_stat->week->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_rank_stat->week->FldCaption();
		}
		if (!ew_CheckInteger($tbl_rank_stat->week->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_rank_stat->week->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_rank_stat->alexa_rank->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_rank_stat->alexa_rank->FldErrMsg();
		}
		if (!ew_CheckInteger($tbl_rank_stat->google_pagerank->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_rank_stat->google_pagerank->FldErrMsg();
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
		global $conn, $Security, $Language, $tbl_rank_stat;
		$sFilter = $tbl_rank_stat->KeyFilter();
		$tbl_rank_stat->CurrentFilter = $sFilter;
		$sSql = $tbl_rank_stat->SQL();
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

			$tbl_rank_stat->year->SetDbValueDef($rsnew, $tbl_rank_stat->year->CurrentValue, 0, FALSE);

			// month
			$tbl_rank_stat->month->SetDbValueDef($rsnew, $tbl_rank_stat->month->CurrentValue, 0, FALSE);

			// week
			$tbl_rank_stat->week->SetDbValueDef($rsnew, $tbl_rank_stat->week->CurrentValue, 0, FALSE);

			// alexa_rank
			$tbl_rank_stat->alexa_rank->SetDbValueDef($rsnew, $tbl_rank_stat->alexa_rank->CurrentValue, 0, FALSE);

			// google_pagerank
			$tbl_rank_stat->google_pagerank->SetDbValueDef($rsnew, $tbl_rank_stat->google_pagerank->CurrentValue, 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $tbl_rank_stat->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_rank_stat->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_rank_stat->CancelMessage <> "") {
					$this->setMessage($tbl_rank_stat->CancelMessage);
					$tbl_rank_stat->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_rank_stat->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $tbl_rank_stat;

		// Check if key value entered
		if ($tbl_rank_stat->id_profile->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check if key value entered
		if ($tbl_rank_stat->stat_date->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $tbl_rank_stat->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $tbl_rank_stat->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// id_profile
		$tbl_rank_stat->id_profile->SetDbValueDef($rsnew, $tbl_rank_stat->id_profile->CurrentValue, 0, FALSE);

		// stat_date
		$tbl_rank_stat->stat_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($tbl_rank_stat->stat_date->CurrentValue, 5, FALSE), ew_CurrentDate());

		// year
		$tbl_rank_stat->year->SetDbValueDef($rsnew, $tbl_rank_stat->year->CurrentValue, 0, FALSE);

		// month
		$tbl_rank_stat->month->SetDbValueDef($rsnew, $tbl_rank_stat->month->CurrentValue, 0, FALSE);

		// week
		$tbl_rank_stat->week->SetDbValueDef($rsnew, $tbl_rank_stat->week->CurrentValue, 0, FALSE);

		// alexa_rank
		$tbl_rank_stat->alexa_rank->SetDbValueDef($rsnew, $tbl_rank_stat->alexa_rank->CurrentValue, 0, TRUE);

		// google_pagerank
		$tbl_rank_stat->google_pagerank->SetDbValueDef($rsnew, $tbl_rank_stat->google_pagerank->CurrentValue, 0, TRUE);

		// Call Row Inserting event
		$bInsertRow = $tbl_rank_stat->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tbl_rank_stat->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tbl_rank_stat->CancelMessage <> "") {
				$this->setMessage($tbl_rank_stat->CancelMessage);
				$tbl_rank_stat->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$tbl_rank_stat->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $tbl_rank_stat;
		$tbl_rank_stat->id_profile->AdvancedSearch->SearchValue = $tbl_rank_stat->getAdvancedSearch("x_id_profile");
		$tbl_rank_stat->stat_date->AdvancedSearch->SearchValue = $tbl_rank_stat->getAdvancedSearch("x_stat_date");
		$tbl_rank_stat->year->AdvancedSearch->SearchValue = $tbl_rank_stat->getAdvancedSearch("x_year");
		$tbl_rank_stat->month->AdvancedSearch->SearchValue = $tbl_rank_stat->getAdvancedSearch("x_month");
		$tbl_rank_stat->week->AdvancedSearch->SearchValue = $tbl_rank_stat->getAdvancedSearch("x_week");
		$tbl_rank_stat->alexa_rank->AdvancedSearch->SearchValue = $tbl_rank_stat->getAdvancedSearch("x_alexa_rank");
		$tbl_rank_stat->google_pagerank->AdvancedSearch->SearchValue = $tbl_rank_stat->getAdvancedSearch("x_google_pagerank");
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
