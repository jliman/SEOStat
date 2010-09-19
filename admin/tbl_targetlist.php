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
$tbl_target_list = new ctbl_target_list();
$Page =& $tbl_target_list;

// Page init
$tbl_target_list->Page_Init();

// Page main
$tbl_target_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_target->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_target_list = new ew_Page("tbl_target_list");

// page properties
tbl_target_list.PageID = "list"; // page ID
tbl_target_list.FormID = "ftbl_targetlist"; // form ID
var EW_PAGE_ID = tbl_target_list.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_target_list.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->id_profile->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->year->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_year"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->year->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->month->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_month"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->month->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_visit"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->visit->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_visit"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->visit->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_pageview"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->pageview->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pageview"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->pageview->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_alexarank"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->alexarank->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_alexarank"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->alexarank->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_googlepagerank"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->googlepagerank->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_googlepagerank"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->googlepagerank->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_googleindexedpage"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->googleindexedpage->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_googleindexedpage"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->googleindexedpage->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_yahooindexedpage"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->yahooindexedpage->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_yahooindexedpage"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->yahooindexedpage->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_bingindexedpage"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->bingindexedpage->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_bingindexedpage"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->bingindexedpage->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_twitterfollower"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->twitterfollower->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_twitterfollower"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->twitterfollower->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_facebookfan"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->facebookfan->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_facebookfan"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->facebookfan->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_yahoobacklink"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->yahoobacklink->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_yahoobacklink"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->yahoobacklink->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_blwbacklink"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->blwbacklink->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_blwbacklink"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->blwbacklink->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_blcbacklink"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_target->blcbacklink->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_blcbacklink"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_target->blcbacklink->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_target_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_target_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_target_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_target_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_target_list.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_target_list.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<?php if ($tbl_target->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$tbl_target_list->lTotalRecs = $tbl_target->SelectRecordCount();
	} else {
		if ($rs = $tbl_target_list->LoadRecordset())
			$tbl_target_list->lTotalRecs = $rs->RecordCount();
	}
	$tbl_target_list->lStartRec = 1;
	if ($tbl_target_list->lDisplayRecs <= 0 || ($tbl_target->Export <> "" && $tbl_target->ExportAll)) // Display all records
		$tbl_target_list->lDisplayRecs = $tbl_target_list->lTotalRecs;
	if (!($tbl_target->Export <> "" && $tbl_target->ExportAll))
		$tbl_target_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $tbl_target_list->LoadRecordset($tbl_target_list->lStartRec-1, $tbl_target_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_target->TableCaption() ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($tbl_target->Export == "" && $tbl_target->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(tbl_target_list);" style="text-decoration: none;"><img id="tbl_target_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="tbl_target_list_SearchPanel">
<form name="ftbl_targetlistsrch" id="ftbl_targetlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="tbl_target">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $tbl_target_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="tbl_targetsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
			<?php if ($tbl_target_list->sSrchWhere <> "" && $tbl_target_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(tbl_target_list, this, '<?php echo $tbl_target->HighlightName() ?>');"><?php echo $Language->Phrase("HideHighlight") ?></a>
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
$tbl_target_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($tbl_target->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($tbl_target->CurrentAction <> "gridadd" && $tbl_target->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_target_list->Pager)) $tbl_target_list->Pager = new cPrevNextPager($tbl_target_list->lStartRec, $tbl_target_list->lDisplayRecs, $tbl_target_list->lTotalRecs) ?>
<?php if ($tbl_target_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_target_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_target_list->PageUrl() ?>start=<?php echo $tbl_target_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_target_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_target_list->PageUrl() ?>start=<?php echo $tbl_target_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_target_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_target_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_target_list->PageUrl() ?>start=<?php echo $tbl_target_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_target_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_target_list->PageUrl() ?>start=<?php echo $tbl_target_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_target_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_target_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_target_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_target_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_target_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($tbl_target_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tbl_target">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="15"<?php if ($tbl_target_list->lDisplayRecs == 15) { ?> selected="selected"<?php } ?>>15</option>
<option value="30"<?php if ($tbl_target_list->lDisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="75"<?php if ($tbl_target_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($tbl_target_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($tbl_target->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_target_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $tbl_target_list->InlineAddUrl ?>"><?php echo $Language->Phrase("InlineAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($tbl_target_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftbl_targetlist, '<?php echo $tbl_target_list->MultiDeleteUrl ?>', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="ftbl_targetlist" id="ftbl_targetlist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="tbl_target">
<div id="gmp_tbl_target" class="ewGridMiddlePanel">
<?php if ($tbl_target_list->lTotalRecs > 0 || $tbl_target->CurrentAction == "add" || $tbl_target->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $tbl_target->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$tbl_target_list->RenderListOptions();

// Render list options (header, left)
$tbl_target_list->ListOptions->Render("header", "left");
?>
<?php if ($tbl_target->id_profile->Visible) { // id_profile ?>
	<?php if ($tbl_target->SortUrl($tbl_target->id_profile) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $tbl_target->id_profile->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_target->SortUrl($tbl_target->id_profile) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $tbl_target->id_profile->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_target->id_profile->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_target->id_profile->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_target->year->Visible) { // year ?>
	<?php if ($tbl_target->SortUrl($tbl_target->year) == "") { ?>
		<td><?php echo $tbl_target->year->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_target->SortUrl($tbl_target->year) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_target->year->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_target->year->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_target->year->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_target->month->Visible) { // month ?>
	<?php if ($tbl_target->SortUrl($tbl_target->month) == "") { ?>
		<td><?php echo $tbl_target->month->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_target->SortUrl($tbl_target->month) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_target->month->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_target->month->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_target->month->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_target->visit->Visible) { // visit ?>
	<?php if ($tbl_target->SortUrl($tbl_target->visit) == "") { ?>
		<td><?php echo $tbl_target->visit->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_target->SortUrl($tbl_target->visit) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_target->visit->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_target->visit->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_target->visit->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_target->pageview->Visible) { // pageview ?>
	<?php if ($tbl_target->SortUrl($tbl_target->pageview) == "") { ?>
		<td><?php echo $tbl_target->pageview->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_target->SortUrl($tbl_target->pageview) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_target->pageview->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_target->pageview->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_target->pageview->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_target->alexarank->Visible) { // alexarank ?>
	<?php if ($tbl_target->SortUrl($tbl_target->alexarank) == "") { ?>
		<td><?php echo $tbl_target->alexarank->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_target->SortUrl($tbl_target->alexarank) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_target->alexarank->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_target->alexarank->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_target->alexarank->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_target->googlepagerank->Visible) { // googlepagerank ?>
	<?php if ($tbl_target->SortUrl($tbl_target->googlepagerank) == "") { ?>
		<td><?php echo $tbl_target->googlepagerank->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_target->SortUrl($tbl_target->googlepagerank) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_target->googlepagerank->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_target->googlepagerank->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_target->googlepagerank->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_target->googleindexedpage->Visible) { // googleindexedpage ?>
	<?php if ($tbl_target->SortUrl($tbl_target->googleindexedpage) == "") { ?>
		<td><?php echo $tbl_target->googleindexedpage->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_target->SortUrl($tbl_target->googleindexedpage) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_target->googleindexedpage->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_target->googleindexedpage->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_target->googleindexedpage->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_target->yahooindexedpage->Visible) { // yahooindexedpage ?>
	<?php if ($tbl_target->SortUrl($tbl_target->yahooindexedpage) == "") { ?>
		<td><?php echo $tbl_target->yahooindexedpage->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_target->SortUrl($tbl_target->yahooindexedpage) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_target->yahooindexedpage->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_target->yahooindexedpage->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_target->yahooindexedpage->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_target->bingindexedpage->Visible) { // bingindexedpage ?>
	<?php if ($tbl_target->SortUrl($tbl_target->bingindexedpage) == "") { ?>
		<td><?php echo $tbl_target->bingindexedpage->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_target->SortUrl($tbl_target->bingindexedpage) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_target->bingindexedpage->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_target->bingindexedpage->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_target->bingindexedpage->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_target->twitterfollower->Visible) { // twitterfollower ?>
	<?php if ($tbl_target->SortUrl($tbl_target->twitterfollower) == "") { ?>
		<td><?php echo $tbl_target->twitterfollower->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_target->SortUrl($tbl_target->twitterfollower) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_target->twitterfollower->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_target->twitterfollower->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_target->twitterfollower->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_target->facebookfan->Visible) { // facebookfan ?>
	<?php if ($tbl_target->SortUrl($tbl_target->facebookfan) == "") { ?>
		<td><?php echo $tbl_target->facebookfan->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_target->SortUrl($tbl_target->facebookfan) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_target->facebookfan->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_target->facebookfan->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_target->facebookfan->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_target->yahoobacklink->Visible) { // yahoobacklink ?>
	<?php if ($tbl_target->SortUrl($tbl_target->yahoobacklink) == "") { ?>
		<td><?php echo $tbl_target->yahoobacklink->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_target->SortUrl($tbl_target->yahoobacklink) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_target->yahoobacklink->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_target->yahoobacklink->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_target->yahoobacklink->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_target->blwbacklink->Visible) { // blwbacklink ?>
	<?php if ($tbl_target->SortUrl($tbl_target->blwbacklink) == "") { ?>
		<td><?php echo $tbl_target->blwbacklink->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_target->SortUrl($tbl_target->blwbacklink) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_target->blwbacklink->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_target->blwbacklink->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_target->blwbacklink->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_target->blcbacklink->Visible) { // blcbacklink ?>
	<?php if ($tbl_target->SortUrl($tbl_target->blcbacklink) == "") { ?>
		<td><?php echo $tbl_target->blcbacklink->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_target->SortUrl($tbl_target->blcbacklink) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_target->blcbacklink->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_target->blcbacklink->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_target->blcbacklink->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$tbl_target_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
	if ($tbl_target->CurrentAction == "add" || $tbl_target->CurrentAction == "copy") {
		$tbl_target_list->lRowIndex = 1;
		if ($tbl_target->CurrentAction == "add")
			$tbl_target_list->LoadDefaultValues();
		if ($tbl_target->EventCancelled) // Insert failed
			$tbl_target_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$tbl_target->CssClass = "ewTableEditRow";
		$tbl_target->CssStyle = "";
		$tbl_target->RowAttrs = array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		$tbl_target->RowType = EW_ROWTYPE_ADD;

		// Render row
		$tbl_target_list->RenderRow();

		// Render list options
		$tbl_target_list->RenderListOptions();
?>
	<tr<?php echo $tbl_target->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_target_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_target->id_profile->Visible) { // id_profile ?>
		<td>
<select id="x<?php echo $tbl_target_list->lRowIndex ?>_id_profile" name="x<?php echo $tbl_target_list->lRowIndex ?>_id_profile" title="<?php echo $tbl_target->id_profile->FldTitle() ?>"<?php echo $tbl_target->id_profile->EditAttributes() ?>>
<?php
if (is_array($tbl_target->id_profile->EditValue)) {
	$arwrk = $tbl_target->id_profile->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_target->id_profile->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<?php if ($tbl_target->year->Visible) { // year ?>
		<td>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_year" id="x<?php echo $tbl_target_list->lRowIndex ?>_year" title="<?php echo $tbl_target->year->FldTitle() ?>" size="30" value="<?php echo $tbl_target->year->EditValue ?>"<?php echo $tbl_target->year->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_target->month->Visible) { // month ?>
		<td>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_month" id="x<?php echo $tbl_target_list->lRowIndex ?>_month" title="<?php echo $tbl_target->month->FldTitle() ?>" size="30" value="<?php echo $tbl_target->month->EditValue ?>"<?php echo $tbl_target->month->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_target->visit->Visible) { // visit ?>
		<td>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_visit" id="x<?php echo $tbl_target_list->lRowIndex ?>_visit" title="<?php echo $tbl_target->visit->FldTitle() ?>" size="30" value="<?php echo $tbl_target->visit->EditValue ?>"<?php echo $tbl_target->visit->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_target->pageview->Visible) { // pageview ?>
		<td>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_pageview" id="x<?php echo $tbl_target_list->lRowIndex ?>_pageview" title="<?php echo $tbl_target->pageview->FldTitle() ?>" size="30" value="<?php echo $tbl_target->pageview->EditValue ?>"<?php echo $tbl_target->pageview->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_target->alexarank->Visible) { // alexarank ?>
		<td>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_alexarank" id="x<?php echo $tbl_target_list->lRowIndex ?>_alexarank" title="<?php echo $tbl_target->alexarank->FldTitle() ?>" size="30" value="<?php echo $tbl_target->alexarank->EditValue ?>"<?php echo $tbl_target->alexarank->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_target->googlepagerank->Visible) { // googlepagerank ?>
		<td>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_googlepagerank" id="x<?php echo $tbl_target_list->lRowIndex ?>_googlepagerank" title="<?php echo $tbl_target->googlepagerank->FldTitle() ?>" size="30" value="<?php echo $tbl_target->googlepagerank->EditValue ?>"<?php echo $tbl_target->googlepagerank->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_target->googleindexedpage->Visible) { // googleindexedpage ?>
		<td>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_googleindexedpage" id="x<?php echo $tbl_target_list->lRowIndex ?>_googleindexedpage" title="<?php echo $tbl_target->googleindexedpage->FldTitle() ?>" size="30" value="<?php echo $tbl_target->googleindexedpage->EditValue ?>"<?php echo $tbl_target->googleindexedpage->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_target->yahooindexedpage->Visible) { // yahooindexedpage ?>
		<td>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_yahooindexedpage" id="x<?php echo $tbl_target_list->lRowIndex ?>_yahooindexedpage" title="<?php echo $tbl_target->yahooindexedpage->FldTitle() ?>" size="30" value="<?php echo $tbl_target->yahooindexedpage->EditValue ?>"<?php echo $tbl_target->yahooindexedpage->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_target->bingindexedpage->Visible) { // bingindexedpage ?>
		<td>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_bingindexedpage" id="x<?php echo $tbl_target_list->lRowIndex ?>_bingindexedpage" title="<?php echo $tbl_target->bingindexedpage->FldTitle() ?>" size="30" value="<?php echo $tbl_target->bingindexedpage->EditValue ?>"<?php echo $tbl_target->bingindexedpage->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_target->twitterfollower->Visible) { // twitterfollower ?>
		<td>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_twitterfollower" id="x<?php echo $tbl_target_list->lRowIndex ?>_twitterfollower" title="<?php echo $tbl_target->twitterfollower->FldTitle() ?>" size="30" value="<?php echo $tbl_target->twitterfollower->EditValue ?>"<?php echo $tbl_target->twitterfollower->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_target->facebookfan->Visible) { // facebookfan ?>
		<td>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_facebookfan" id="x<?php echo $tbl_target_list->lRowIndex ?>_facebookfan" title="<?php echo $tbl_target->facebookfan->FldTitle() ?>" size="30" value="<?php echo $tbl_target->facebookfan->EditValue ?>"<?php echo $tbl_target->facebookfan->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_target->yahoobacklink->Visible) { // yahoobacklink ?>
		<td>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_yahoobacklink" id="x<?php echo $tbl_target_list->lRowIndex ?>_yahoobacklink" title="<?php echo $tbl_target->yahoobacklink->FldTitle() ?>" size="30" value="<?php echo $tbl_target->yahoobacklink->EditValue ?>"<?php echo $tbl_target->yahoobacklink->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_target->blwbacklink->Visible) { // blwbacklink ?>
		<td>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_blwbacklink" id="x<?php echo $tbl_target_list->lRowIndex ?>_blwbacklink" title="<?php echo $tbl_target->blwbacklink->FldTitle() ?>" size="30" value="<?php echo $tbl_target->blwbacklink->EditValue ?>"<?php echo $tbl_target->blwbacklink->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_target->blcbacklink->Visible) { // blcbacklink ?>
		<td>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_blcbacklink" id="x<?php echo $tbl_target_list->lRowIndex ?>_blcbacklink" title="<?php echo $tbl_target->blcbacklink->FldTitle() ?>" size="30" value="<?php echo $tbl_target->blcbacklink->EditValue ?>"<?php echo $tbl_target->blcbacklink->EditAttributes() ?>>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_target_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
<?php
if ($tbl_target->ExportAll && $tbl_target->Export <> "") {
	$tbl_target_list->lStopRec = $tbl_target_list->lTotalRecs;
} else {
	$tbl_target_list->lStopRec = $tbl_target_list->lStartRec + $tbl_target_list->lDisplayRecs - 1; // Set the last record to display
}
$tbl_target_list->lRecCount = $tbl_target_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $tbl_target_list->lStartRec > 1)
		$rs->Move($tbl_target_list->lStartRec - 1);
}

// Initialize aggregate
$tbl_target->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tbl_target_list->RenderRow();
$tbl_target_list->lRowCnt = 0;
$tbl_target_list->lEditRowCnt = 0;
if ($tbl_target->CurrentAction == "edit")
	$tbl_target_list->lRowIndex = 1;
while (($tbl_target->CurrentAction == "gridadd" || !$rs->EOF) &&
	$tbl_target_list->lRecCount < $tbl_target_list->lStopRec) {
	$tbl_target_list->lRecCount++;
	if (intval($tbl_target_list->lRecCount) >= intval($tbl_target_list->lStartRec)) {
		$tbl_target_list->lRowCnt++;

	// Init row class and style
	$tbl_target->CssClass = "";
	$tbl_target->CssStyle = "";
	$tbl_target->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($tbl_target->CurrentAction == "gridadd") {
		$tbl_target_list->LoadDefaultValues(); // Load default values
	} else {
		$tbl_target_list->LoadRowValues($rs); // Load row values
	}
	$tbl_target->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($tbl_target->CurrentAction == "edit") {
		if ($tbl_target_list->CheckInlineEditKey() && $tbl_target_list->lEditRowCnt == 0) { // Inline edit
			$tbl_target->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
	}
	if ($tbl_target->RowType == EW_ROWTYPE_EDIT && $tbl_target->EventCancelled) { // Update failed
		if ($tbl_target->CurrentAction == "edit")
			$tbl_target_list->RestoreFormValues(); // Restore form values
	}
	if ($tbl_target->RowType == EW_ROWTYPE_EDIT) // Edit row
		$tbl_target_list->lEditRowCnt++;
	if ($tbl_target->RowType == EW_ROWTYPE_ADD || $tbl_target->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
		$tbl_target->RowAttrs = array_merge($tbl_target->RowAttrs, array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);'));
		$tbl_target->CssClass = "ewTableEditRow";
	}

	// Render row
	$tbl_target_list->RenderRow();

	// Render list options
	$tbl_target_list->RenderListOptions();
?>
	<tr<?php echo $tbl_target->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_target_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_target->id_profile->Visible) { // id_profile ?>
		<td<?php echo $tbl_target->id_profile->CellAttributes() ?>>
<?php if ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $tbl_target->id_profile->ViewAttributes() ?>><?php echo $tbl_target->id_profile->EditValue ?></div><input type="hidden" name="x<?php echo $tbl_target_list->lRowIndex ?>_id_profile" id="x<?php echo $tbl_target_list->lRowIndex ?>_id_profile" value="<?php echo ew_HtmlEncode($tbl_target->id_profile->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_target->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_target->id_profile->ViewAttributes() ?>><?php echo $tbl_target->id_profile->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_target->year->Visible) { // year ?>
		<td<?php echo $tbl_target->year->CellAttributes() ?>>
<?php if ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $tbl_target->year->ViewAttributes() ?>><?php echo $tbl_target->year->EditValue ?></div><input type="hidden" name="x<?php echo $tbl_target_list->lRowIndex ?>_year" id="x<?php echo $tbl_target_list->lRowIndex ?>_year" value="<?php echo ew_HtmlEncode($tbl_target->year->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_target->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_target->year->ViewAttributes() ?>><?php echo $tbl_target->year->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_target->month->Visible) { // month ?>
		<td<?php echo $tbl_target->month->CellAttributes() ?>>
<?php if ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $tbl_target->month->ViewAttributes() ?>><?php echo $tbl_target->month->EditValue ?></div><input type="hidden" name="x<?php echo $tbl_target_list->lRowIndex ?>_month" id="x<?php echo $tbl_target_list->lRowIndex ?>_month" value="<?php echo ew_HtmlEncode($tbl_target->month->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_target->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_target->month->ViewAttributes() ?>><?php echo $tbl_target->month->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_target->visit->Visible) { // visit ?>
		<td<?php echo $tbl_target->visit->CellAttributes() ?>>
<?php if ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_visit" id="x<?php echo $tbl_target_list->lRowIndex ?>_visit" title="<?php echo $tbl_target->visit->FldTitle() ?>" size="30" value="<?php echo $tbl_target->visit->EditValue ?>"<?php echo $tbl_target->visit->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_target->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_target->visit->ViewAttributes() ?>><?php echo $tbl_target->visit->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_target->pageview->Visible) { // pageview ?>
		<td<?php echo $tbl_target->pageview->CellAttributes() ?>>
<?php if ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_pageview" id="x<?php echo $tbl_target_list->lRowIndex ?>_pageview" title="<?php echo $tbl_target->pageview->FldTitle() ?>" size="30" value="<?php echo $tbl_target->pageview->EditValue ?>"<?php echo $tbl_target->pageview->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_target->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_target->pageview->ViewAttributes() ?>><?php echo $tbl_target->pageview->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_target->alexarank->Visible) { // alexarank ?>
		<td<?php echo $tbl_target->alexarank->CellAttributes() ?>>
<?php if ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_alexarank" id="x<?php echo $tbl_target_list->lRowIndex ?>_alexarank" title="<?php echo $tbl_target->alexarank->FldTitle() ?>" size="30" value="<?php echo $tbl_target->alexarank->EditValue ?>"<?php echo $tbl_target->alexarank->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_target->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_target->alexarank->ViewAttributes() ?>><?php echo $tbl_target->alexarank->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_target->googlepagerank->Visible) { // googlepagerank ?>
		<td<?php echo $tbl_target->googlepagerank->CellAttributes() ?>>
<?php if ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_googlepagerank" id="x<?php echo $tbl_target_list->lRowIndex ?>_googlepagerank" title="<?php echo $tbl_target->googlepagerank->FldTitle() ?>" size="30" value="<?php echo $tbl_target->googlepagerank->EditValue ?>"<?php echo $tbl_target->googlepagerank->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_target->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_target->googlepagerank->ViewAttributes() ?>><?php echo $tbl_target->googlepagerank->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_target->googleindexedpage->Visible) { // googleindexedpage ?>
		<td<?php echo $tbl_target->googleindexedpage->CellAttributes() ?>>
<?php if ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_googleindexedpage" id="x<?php echo $tbl_target_list->lRowIndex ?>_googleindexedpage" title="<?php echo $tbl_target->googleindexedpage->FldTitle() ?>" size="30" value="<?php echo $tbl_target->googleindexedpage->EditValue ?>"<?php echo $tbl_target->googleindexedpage->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_target->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_target->googleindexedpage->ViewAttributes() ?>><?php echo $tbl_target->googleindexedpage->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_target->yahooindexedpage->Visible) { // yahooindexedpage ?>
		<td<?php echo $tbl_target->yahooindexedpage->CellAttributes() ?>>
<?php if ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_yahooindexedpage" id="x<?php echo $tbl_target_list->lRowIndex ?>_yahooindexedpage" title="<?php echo $tbl_target->yahooindexedpage->FldTitle() ?>" size="30" value="<?php echo $tbl_target->yahooindexedpage->EditValue ?>"<?php echo $tbl_target->yahooindexedpage->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_target->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_target->yahooindexedpage->ViewAttributes() ?>><?php echo $tbl_target->yahooindexedpage->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_target->bingindexedpage->Visible) { // bingindexedpage ?>
		<td<?php echo $tbl_target->bingindexedpage->CellAttributes() ?>>
<?php if ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_bingindexedpage" id="x<?php echo $tbl_target_list->lRowIndex ?>_bingindexedpage" title="<?php echo $tbl_target->bingindexedpage->FldTitle() ?>" size="30" value="<?php echo $tbl_target->bingindexedpage->EditValue ?>"<?php echo $tbl_target->bingindexedpage->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_target->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_target->bingindexedpage->ViewAttributes() ?>><?php echo $tbl_target->bingindexedpage->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_target->twitterfollower->Visible) { // twitterfollower ?>
		<td<?php echo $tbl_target->twitterfollower->CellAttributes() ?>>
<?php if ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_twitterfollower" id="x<?php echo $tbl_target_list->lRowIndex ?>_twitterfollower" title="<?php echo $tbl_target->twitterfollower->FldTitle() ?>" size="30" value="<?php echo $tbl_target->twitterfollower->EditValue ?>"<?php echo $tbl_target->twitterfollower->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_target->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_target->twitterfollower->ViewAttributes() ?>><?php echo $tbl_target->twitterfollower->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_target->facebookfan->Visible) { // facebookfan ?>
		<td<?php echo $tbl_target->facebookfan->CellAttributes() ?>>
<?php if ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_facebookfan" id="x<?php echo $tbl_target_list->lRowIndex ?>_facebookfan" title="<?php echo $tbl_target->facebookfan->FldTitle() ?>" size="30" value="<?php echo $tbl_target->facebookfan->EditValue ?>"<?php echo $tbl_target->facebookfan->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_target->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_target->facebookfan->ViewAttributes() ?>><?php echo $tbl_target->facebookfan->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_target->yahoobacklink->Visible) { // yahoobacklink ?>
		<td<?php echo $tbl_target->yahoobacklink->CellAttributes() ?>>
<?php if ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_yahoobacklink" id="x<?php echo $tbl_target_list->lRowIndex ?>_yahoobacklink" title="<?php echo $tbl_target->yahoobacklink->FldTitle() ?>" size="30" value="<?php echo $tbl_target->yahoobacklink->EditValue ?>"<?php echo $tbl_target->yahoobacklink->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_target->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_target->yahoobacklink->ViewAttributes() ?>><?php echo $tbl_target->yahoobacklink->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_target->blwbacklink->Visible) { // blwbacklink ?>
		<td<?php echo $tbl_target->blwbacklink->CellAttributes() ?>>
<?php if ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_blwbacklink" id="x<?php echo $tbl_target_list->lRowIndex ?>_blwbacklink" title="<?php echo $tbl_target->blwbacklink->FldTitle() ?>" size="30" value="<?php echo $tbl_target->blwbacklink->EditValue ?>"<?php echo $tbl_target->blwbacklink->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_target->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_target->blwbacklink->ViewAttributes() ?>><?php echo $tbl_target->blwbacklink->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_target->blcbacklink->Visible) { // blcbacklink ?>
		<td<?php echo $tbl_target->blcbacklink->CellAttributes() ?>>
<?php if ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_target_list->lRowIndex ?>_blcbacklink" id="x<?php echo $tbl_target_list->lRowIndex ?>_blcbacklink" title="<?php echo $tbl_target->blcbacklink->FldTitle() ?>" size="30" value="<?php echo $tbl_target->blcbacklink->EditValue ?>"<?php echo $tbl_target->blcbacklink->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_target->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_target->blcbacklink->ViewAttributes() ?>><?php echo $tbl_target->blcbacklink->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_target_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($tbl_target->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($tbl_target->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($tbl_target->CurrentAction == "add" || $tbl_target->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $tbl_target_list->lRowIndex ?>">
<?php } ?>
<?php if ($tbl_target->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $tbl_target_list->lRowIndex ?>">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($tbl_target_list->lTotalRecs > 0) { ?>
<?php if ($tbl_target->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($tbl_target->CurrentAction <> "gridadd" && $tbl_target->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_target_list->Pager)) $tbl_target_list->Pager = new cPrevNextPager($tbl_target_list->lStartRec, $tbl_target_list->lDisplayRecs, $tbl_target_list->lTotalRecs) ?>
<?php if ($tbl_target_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_target_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_target_list->PageUrl() ?>start=<?php echo $tbl_target_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_target_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_target_list->PageUrl() ?>start=<?php echo $tbl_target_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_target_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_target_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_target_list->PageUrl() ?>start=<?php echo $tbl_target_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_target_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_target_list->PageUrl() ?>start=<?php echo $tbl_target_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_target_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_target_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_target_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_target_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_target_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($tbl_target_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tbl_target">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="15"<?php if ($tbl_target_list->lDisplayRecs == 15) { ?> selected="selected"<?php } ?>>15</option>
<option value="30"<?php if ($tbl_target_list->lDisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="75"<?php if ($tbl_target_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($tbl_target_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($tbl_target->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($tbl_target_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_target_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $tbl_target_list->InlineAddUrl ?>"><?php echo $Language->Phrase("InlineAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($tbl_target_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftbl_targetlist, '<?php echo $tbl_target_list->MultiDeleteUrl ?>', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($tbl_target->Export == "" && $tbl_target->CurrentAction == "") { ?>
<?php } ?>
<?php if ($tbl_target->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_target_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_target_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'tbl_target';

	// Page object name
	var $PageObjName = 'tbl_target_list';

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
	function ctbl_target_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_target)
		$GLOBALS["tbl_target"] = new ctbl_target();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["tbl_target"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tbl_targetdelete.php";
		$this->MultiUpdateUrl = "tbl_targetupdate.php";

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_target', TRUE);

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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Create form object
		$objForm = new cFormObj();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$tbl_target->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$tbl_target->Export = $_POST["exporttype"];
		} else {
			$tbl_target->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $tbl_target->Export; // Get export parameter, used in header
		$gsExportFile = $tbl_target->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $tbl_target;

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
				$tbl_target->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($tbl_target->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($tbl_target->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($tbl_target->CurrentAction == "add" || $tbl_target->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$tbl_target->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if (($tbl_target->CurrentAction == "update" || $tbl_target->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($tbl_target->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
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
			$tbl_target->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($tbl_target->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $tbl_target->getRecordsPerPage(); // Restore from Session
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
		$tbl_target->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$tbl_target->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$tbl_target->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $tbl_target->getSearchWhere();
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
		$tbl_target->setSessionWhere($sFilter);
		$tbl_target->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $tbl_target;
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
			$tbl_target->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$tbl_target->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $tbl_target;
		$tbl_target->setKey("id_profile", ""); // Clear inline edit key
		$tbl_target->setKey("year", ""); // Clear inline edit key
		$tbl_target->setKey("month", ""); // Clear inline edit key
		$tbl_target->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $tbl_target;
		if (!$Security->CanEdit())
			$this->Page_Terminate("login.php"); // Go to login page
		$bInlineEdit = TRUE;
		if (@$_GET["id_profile"] <> "") {
			$tbl_target->id_profile->setQueryStringValue($_GET["id_profile"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if (@$_GET["year"] <> "") {
			$tbl_target->year->setQueryStringValue($_GET["year"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if (@$_GET["month"] <> "") {
			$tbl_target->month->setQueryStringValue($_GET["month"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$tbl_target->setKey("id_profile", $tbl_target->id_profile->CurrentValue); // Set up inline edit key
				$tbl_target->setKey("year", $tbl_target->year->CurrentValue); // Set up inline edit key
				$tbl_target->setKey("month", $tbl_target->month->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError, $tbl_target;
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
				$tbl_target->SendEmail = TRUE; // Send email on update success
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
			$tbl_target->EventCancelled = TRUE; // Cancel event
			$tbl_target->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {
		global $tbl_target;

		//CheckInlineEditKey = True
		if (strval($tbl_target->getKey("id_profile")) <> strval($tbl_target->id_profile->CurrentValue))
			return FALSE;
		if (strval($tbl_target->getKey("year")) <> strval($tbl_target->year->CurrentValue))
			return FALSE;
		if (strval($tbl_target->getKey("month")) <> strval($tbl_target->month->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $tbl_target;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		$tbl_target->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to Inline Add/Copy record
	function InlineInsert() {
		global $Language, $objForm, $gsFormError, $tbl_target;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$tbl_target->EventCancelled = TRUE; // Set event cancelled
			$tbl_target->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$tbl_target->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage($Language->Phrase("AddSuccess")); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$tbl_target->EventCancelled = TRUE; // Set event cancelled
			$tbl_target->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $tbl_target;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $tbl_target->id_profile, FALSE); // id_profile
		$this->BuildSearchSql($sWhere, $tbl_target->year, FALSE); // year
		$this->BuildSearchSql($sWhere, $tbl_target->month, FALSE); // month
		$this->BuildSearchSql($sWhere, $tbl_target->visit, FALSE); // visit
		$this->BuildSearchSql($sWhere, $tbl_target->pageview, FALSE); // pageview
		$this->BuildSearchSql($sWhere, $tbl_target->alexarank, FALSE); // alexarank
		$this->BuildSearchSql($sWhere, $tbl_target->googlepagerank, FALSE); // googlepagerank
		$this->BuildSearchSql($sWhere, $tbl_target->googleindexedpage, FALSE); // googleindexedpage
		$this->BuildSearchSql($sWhere, $tbl_target->yahooindexedpage, FALSE); // yahooindexedpage
		$this->BuildSearchSql($sWhere, $tbl_target->bingindexedpage, FALSE); // bingindexedpage
		$this->BuildSearchSql($sWhere, $tbl_target->twitterfollower, FALSE); // twitterfollower
		$this->BuildSearchSql($sWhere, $tbl_target->facebookfan, FALSE); // facebookfan
		$this->BuildSearchSql($sWhere, $tbl_target->yahoobacklink, FALSE); // yahoobacklink
		$this->BuildSearchSql($sWhere, $tbl_target->blwbacklink, FALSE); // blwbacklink
		$this->BuildSearchSql($sWhere, $tbl_target->blcbacklink, FALSE); // blcbacklink

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($tbl_target->id_profile); // id_profile
			$this->SetSearchParm($tbl_target->year); // year
			$this->SetSearchParm($tbl_target->month); // month
			$this->SetSearchParm($tbl_target->visit); // visit
			$this->SetSearchParm($tbl_target->pageview); // pageview
			$this->SetSearchParm($tbl_target->alexarank); // alexarank
			$this->SetSearchParm($tbl_target->googlepagerank); // googlepagerank
			$this->SetSearchParm($tbl_target->googleindexedpage); // googleindexedpage
			$this->SetSearchParm($tbl_target->yahooindexedpage); // yahooindexedpage
			$this->SetSearchParm($tbl_target->bingindexedpage); // bingindexedpage
			$this->SetSearchParm($tbl_target->twitterfollower); // twitterfollower
			$this->SetSearchParm($tbl_target->facebookfan); // facebookfan
			$this->SetSearchParm($tbl_target->yahoobacklink); // yahoobacklink
			$this->SetSearchParm($tbl_target->blwbacklink); // blwbacklink
			$this->SetSearchParm($tbl_target->blcbacklink); // blcbacklink
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
		global $tbl_target;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$tbl_target->setAdvancedSearch("x_$FldParm", $FldVal);
		$tbl_target->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$tbl_target->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$tbl_target->setAdvancedSearch("y_$FldParm", $FldVal2);
		$tbl_target->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $tbl_target;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $tbl_target->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $tbl_target->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $tbl_target->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $tbl_target->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $tbl_target->GetAdvancedSearch("w_$FldParm");
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
		global $tbl_target;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$tbl_target->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $tbl_target;
		$tbl_target->setAdvancedSearch("x_id_profile", "");
		$tbl_target->setAdvancedSearch("x_year", "");
		$tbl_target->setAdvancedSearch("x_month", "");
		$tbl_target->setAdvancedSearch("x_visit", "");
		$tbl_target->setAdvancedSearch("x_pageview", "");
		$tbl_target->setAdvancedSearch("x_alexarank", "");
		$tbl_target->setAdvancedSearch("x_googlepagerank", "");
		$tbl_target->setAdvancedSearch("x_googleindexedpage", "");
		$tbl_target->setAdvancedSearch("x_yahooindexedpage", "");
		$tbl_target->setAdvancedSearch("x_bingindexedpage", "");
		$tbl_target->setAdvancedSearch("x_twitterfollower", "");
		$tbl_target->setAdvancedSearch("x_facebookfan", "");
		$tbl_target->setAdvancedSearch("x_yahoobacklink", "");
		$tbl_target->setAdvancedSearch("x_blwbacklink", "");
		$tbl_target->setAdvancedSearch("x_blcbacklink", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $tbl_target;
		$bRestore = TRUE;
		if (@$_GET["x_id_profile"] <> "") $bRestore = FALSE;
		if (@$_GET["x_year"] <> "") $bRestore = FALSE;
		if (@$_GET["x_month"] <> "") $bRestore = FALSE;
		if (@$_GET["x_visit"] <> "") $bRestore = FALSE;
		if (@$_GET["x_pageview"] <> "") $bRestore = FALSE;
		if (@$_GET["x_alexarank"] <> "") $bRestore = FALSE;
		if (@$_GET["x_googlepagerank"] <> "") $bRestore = FALSE;
		if (@$_GET["x_googleindexedpage"] <> "") $bRestore = FALSE;
		if (@$_GET["x_yahooindexedpage"] <> "") $bRestore = FALSE;
		if (@$_GET["x_bingindexedpage"] <> "") $bRestore = FALSE;
		if (@$_GET["x_twitterfollower"] <> "") $bRestore = FALSE;
		if (@$_GET["x_facebookfan"] <> "") $bRestore = FALSE;
		if (@$_GET["x_yahoobacklink"] <> "") $bRestore = FALSE;
		if (@$_GET["x_blwbacklink"] <> "") $bRestore = FALSE;
		if (@$_GET["x_blcbacklink"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($tbl_target->id_profile);
			$this->GetSearchParm($tbl_target->year);
			$this->GetSearchParm($tbl_target->month);
			$this->GetSearchParm($tbl_target->visit);
			$this->GetSearchParm($tbl_target->pageview);
			$this->GetSearchParm($tbl_target->alexarank);
			$this->GetSearchParm($tbl_target->googlepagerank);
			$this->GetSearchParm($tbl_target->googleindexedpage);
			$this->GetSearchParm($tbl_target->yahooindexedpage);
			$this->GetSearchParm($tbl_target->bingindexedpage);
			$this->GetSearchParm($tbl_target->twitterfollower);
			$this->GetSearchParm($tbl_target->facebookfan);
			$this->GetSearchParm($tbl_target->yahoobacklink);
			$this->GetSearchParm($tbl_target->blwbacklink);
			$this->GetSearchParm($tbl_target->blcbacklink);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $tbl_target;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$tbl_target->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$tbl_target->CurrentOrderType = @$_GET["ordertype"];
			$tbl_target->UpdateSort($tbl_target->id_profile); // id_profile
			$tbl_target->UpdateSort($tbl_target->year); // year
			$tbl_target->UpdateSort($tbl_target->month); // month
			$tbl_target->UpdateSort($tbl_target->visit); // visit
			$tbl_target->UpdateSort($tbl_target->pageview); // pageview
			$tbl_target->UpdateSort($tbl_target->alexarank); // alexarank
			$tbl_target->UpdateSort($tbl_target->googlepagerank); // googlepagerank
			$tbl_target->UpdateSort($tbl_target->googleindexedpage); // googleindexedpage
			$tbl_target->UpdateSort($tbl_target->yahooindexedpage); // yahooindexedpage
			$tbl_target->UpdateSort($tbl_target->bingindexedpage); // bingindexedpage
			$tbl_target->UpdateSort($tbl_target->twitterfollower); // twitterfollower
			$tbl_target->UpdateSort($tbl_target->facebookfan); // facebookfan
			$tbl_target->UpdateSort($tbl_target->yahoobacklink); // yahoobacklink
			$tbl_target->UpdateSort($tbl_target->blwbacklink); // blwbacklink
			$tbl_target->UpdateSort($tbl_target->blcbacklink); // blcbacklink
			$tbl_target->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $tbl_target;
		$sOrderBy = $tbl_target->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($tbl_target->SqlOrderBy() <> "") {
				$sOrderBy = $tbl_target->SqlOrderBy();
				$tbl_target->setSessionOrderBy($sOrderBy);
				$tbl_target->year->setSort("DESC");
				$tbl_target->month->setSort("DESC");
				$tbl_target->id_profile->setSort("ASC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $tbl_target;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$tbl_target->setSessionOrderBy($sOrderBy);
				$tbl_target->id_profile->setSort("");
				$tbl_target->year->setSort("");
				$tbl_target->month->setSort("");
				$tbl_target->visit->setSort("");
				$tbl_target->pageview->setSort("");
				$tbl_target->alexarank->setSort("");
				$tbl_target->googlepagerank->setSort("");
				$tbl_target->googleindexedpage->setSort("");
				$tbl_target->yahooindexedpage->setSort("");
				$tbl_target->bingindexedpage->setSort("");
				$tbl_target->twitterfollower->setSort("");
				$tbl_target->facebookfan->setSort("");
				$tbl_target->yahoobacklink->setSort("");
				$tbl_target->blwbacklink->setSort("");
				$tbl_target->blcbacklink->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$tbl_target->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $tbl_target;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"tbl_target_list.SelectAllKey(this);\">";
		$this->ListOptions->MoveItem("checkbox", 0); // Move to first column

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($tbl_target->Export <> "" ||
			$tbl_target->CurrentAction == "gridadd" ||
			$tbl_target->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $tbl_target;
		$this->ListOptions->LoadDefault();

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if (($tbl_target->CurrentAction == "add" || $tbl_target->CurrentAction == "copy") &&
			$tbl_target->RowType == EW_ROWTYPE_ADD) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
				"<a href=\"\" onclick=\"f=document.ftbl_targetlist;if(tbl_target_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("InsertLink") . "</a>&nbsp;" .
				"<a href=\"" . $this->PageUrl() . "a=cancel\">" . $Language->Phrase("CancelLink") . "</a>" .
				"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"insert\"></div>";
			return;
		}

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($tbl_target->CurrentAction == "edit" && $tbl_target->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a href=\"\" onclick=\"f=document.ftbl_targetlist;if(tbl_target_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($tbl_target->id_profile->CurrentValue . EW_COMPOSITE_KEY_SEPARATOR . $tbl_target->year->CurrentValue . EW_COMPOSITE_KEY_SEPARATOR . $tbl_target->month->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $tbl_target;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_target;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_target->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_target->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_target->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_target->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_target->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_target->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $tbl_target;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $tbl_target;

		// Load search values
		// id_profile

		$tbl_target->id_profile->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id_profile"]);
		$tbl_target->id_profile->AdvancedSearch->SearchOperator = @$_GET["z_id_profile"];

		// year
		$tbl_target->year->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_year"]);
		$tbl_target->year->AdvancedSearch->SearchOperator = @$_GET["z_year"];

		// month
		$tbl_target->month->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_month"]);
		$tbl_target->month->AdvancedSearch->SearchOperator = @$_GET["z_month"];

		// visit
		$tbl_target->visit->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_visit"]);
		$tbl_target->visit->AdvancedSearch->SearchOperator = @$_GET["z_visit"];

		// pageview
		$tbl_target->pageview->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_pageview"]);
		$tbl_target->pageview->AdvancedSearch->SearchOperator = @$_GET["z_pageview"];

		// alexarank
		$tbl_target->alexarank->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_alexarank"]);
		$tbl_target->alexarank->AdvancedSearch->SearchOperator = @$_GET["z_alexarank"];

		// googlepagerank
		$tbl_target->googlepagerank->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_googlepagerank"]);
		$tbl_target->googlepagerank->AdvancedSearch->SearchOperator = @$_GET["z_googlepagerank"];

		// googleindexedpage
		$tbl_target->googleindexedpage->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_googleindexedpage"]);
		$tbl_target->googleindexedpage->AdvancedSearch->SearchOperator = @$_GET["z_googleindexedpage"];

		// yahooindexedpage
		$tbl_target->yahooindexedpage->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_yahooindexedpage"]);
		$tbl_target->yahooindexedpage->AdvancedSearch->SearchOperator = @$_GET["z_yahooindexedpage"];

		// bingindexedpage
		$tbl_target->bingindexedpage->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_bingindexedpage"]);
		$tbl_target->bingindexedpage->AdvancedSearch->SearchOperator = @$_GET["z_bingindexedpage"];

		// twitterfollower
		$tbl_target->twitterfollower->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_twitterfollower"]);
		$tbl_target->twitterfollower->AdvancedSearch->SearchOperator = @$_GET["z_twitterfollower"];

		// facebookfan
		$tbl_target->facebookfan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_facebookfan"]);
		$tbl_target->facebookfan->AdvancedSearch->SearchOperator = @$_GET["z_facebookfan"];

		// yahoobacklink
		$tbl_target->yahoobacklink->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_yahoobacklink"]);
		$tbl_target->yahoobacklink->AdvancedSearch->SearchOperator = @$_GET["z_yahoobacklink"];

		// blwbacklink
		$tbl_target->blwbacklink->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_blwbacklink"]);
		$tbl_target->blwbacklink->AdvancedSearch->SearchOperator = @$_GET["z_blwbacklink"];

		// blcbacklink
		$tbl_target->blcbacklink->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_blcbacklink"]);
		$tbl_target->blcbacklink->AdvancedSearch->SearchOperator = @$_GET["z_blcbacklink"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_target;
		$tbl_target->id_profile->setFormValue($objForm->GetValue("x_id_profile"));
		$tbl_target->year->setFormValue($objForm->GetValue("x_year"));
		$tbl_target->month->setFormValue($objForm->GetValue("x_month"));
		$tbl_target->visit->setFormValue($objForm->GetValue("x_visit"));
		$tbl_target->pageview->setFormValue($objForm->GetValue("x_pageview"));
		$tbl_target->alexarank->setFormValue($objForm->GetValue("x_alexarank"));
		$tbl_target->googlepagerank->setFormValue($objForm->GetValue("x_googlepagerank"));
		$tbl_target->googleindexedpage->setFormValue($objForm->GetValue("x_googleindexedpage"));
		$tbl_target->yahooindexedpage->setFormValue($objForm->GetValue("x_yahooindexedpage"));
		$tbl_target->bingindexedpage->setFormValue($objForm->GetValue("x_bingindexedpage"));
		$tbl_target->twitterfollower->setFormValue($objForm->GetValue("x_twitterfollower"));
		$tbl_target->facebookfan->setFormValue($objForm->GetValue("x_facebookfan"));
		$tbl_target->yahoobacklink->setFormValue($objForm->GetValue("x_yahoobacklink"));
		$tbl_target->blwbacklink->setFormValue($objForm->GetValue("x_blwbacklink"));
		$tbl_target->blcbacklink->setFormValue($objForm->GetValue("x_blcbacklink"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_target;
		$tbl_target->id_profile->CurrentValue = $tbl_target->id_profile->FormValue;
		$tbl_target->year->CurrentValue = $tbl_target->year->FormValue;
		$tbl_target->month->CurrentValue = $tbl_target->month->FormValue;
		$tbl_target->visit->CurrentValue = $tbl_target->visit->FormValue;
		$tbl_target->pageview->CurrentValue = $tbl_target->pageview->FormValue;
		$tbl_target->alexarank->CurrentValue = $tbl_target->alexarank->FormValue;
		$tbl_target->googlepagerank->CurrentValue = $tbl_target->googlepagerank->FormValue;
		$tbl_target->googleindexedpage->CurrentValue = $tbl_target->googleindexedpage->FormValue;
		$tbl_target->yahooindexedpage->CurrentValue = $tbl_target->yahooindexedpage->FormValue;
		$tbl_target->bingindexedpage->CurrentValue = $tbl_target->bingindexedpage->FormValue;
		$tbl_target->twitterfollower->CurrentValue = $tbl_target->twitterfollower->FormValue;
		$tbl_target->facebookfan->CurrentValue = $tbl_target->facebookfan->FormValue;
		$tbl_target->yahoobacklink->CurrentValue = $tbl_target->yahoobacklink->FormValue;
		$tbl_target->blwbacklink->CurrentValue = $tbl_target->blwbacklink->FormValue;
		$tbl_target->blcbacklink->CurrentValue = $tbl_target->blcbacklink->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_target;

		// Call Recordset Selecting event
		$tbl_target->Recordset_Selecting($tbl_target->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_target->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_target->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_target;
		$sFilter = $tbl_target->KeyFilter();

		// Call Row Selecting event
		$tbl_target->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_target->CurrentFilter = $sFilter;
		$sSql = $tbl_target->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_target->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_target;
		$tbl_target->id_profile->setDbValue($rs->fields('id_profile'));
		$tbl_target->year->setDbValue($rs->fields('year'));
		$tbl_target->month->setDbValue($rs->fields('month'));
		$tbl_target->visit->setDbValue($rs->fields('visit'));
		$tbl_target->pageview->setDbValue($rs->fields('pageview'));
		$tbl_target->alexarank->setDbValue($rs->fields('alexarank'));
		$tbl_target->googlepagerank->setDbValue($rs->fields('googlepagerank'));
		$tbl_target->googleindexedpage->setDbValue($rs->fields('googleindexedpage'));
		$tbl_target->yahooindexedpage->setDbValue($rs->fields('yahooindexedpage'));
		$tbl_target->bingindexedpage->setDbValue($rs->fields('bingindexedpage'));
		$tbl_target->twitterfollower->setDbValue($rs->fields('twitterfollower'));
		$tbl_target->facebookfan->setDbValue($rs->fields('facebookfan'));
		$tbl_target->yahoobacklink->setDbValue($rs->fields('yahoobacklink'));
		$tbl_target->blwbacklink->setDbValue($rs->fields('blwbacklink'));
		$tbl_target->blcbacklink->setDbValue($rs->fields('blcbacklink'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_target;

		// Initialize URLs
		$this->ViewUrl = $tbl_target->ViewUrl();
		$this->EditUrl = $tbl_target->EditUrl();
		$this->InlineEditUrl = $tbl_target->InlineEditUrl();
		$this->CopyUrl = $tbl_target->CopyUrl();
		$this->InlineCopyUrl = $tbl_target->InlineCopyUrl();
		$this->DeleteUrl = $tbl_target->DeleteUrl();

		// Call Row_Rendering event
		$tbl_target->Row_Rendering();

		// Common render codes for all row types
		// id_profile

		$tbl_target->id_profile->CellCssStyle = "white-space: nowrap;"; $tbl_target->id_profile->CellCssClass = "";
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
		} elseif ($tbl_target->RowType == EW_ROWTYPE_ADD) { // Add row

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
			$tbl_target->year->EditValue = ew_HtmlEncode($tbl_target->year->CurrentValue);

			// month
			$tbl_target->month->EditCustomAttributes = "";
			$tbl_target->month->EditValue = ew_HtmlEncode($tbl_target->month->CurrentValue);

			// visit
			$tbl_target->visit->EditCustomAttributes = "";
			$tbl_target->visit->EditValue = ew_HtmlEncode($tbl_target->visit->CurrentValue);

			// pageview
			$tbl_target->pageview->EditCustomAttributes = "";
			$tbl_target->pageview->EditValue = ew_HtmlEncode($tbl_target->pageview->CurrentValue);

			// alexarank
			$tbl_target->alexarank->EditCustomAttributes = "";
			$tbl_target->alexarank->EditValue = ew_HtmlEncode($tbl_target->alexarank->CurrentValue);

			// googlepagerank
			$tbl_target->googlepagerank->EditCustomAttributes = "";
			$tbl_target->googlepagerank->EditValue = ew_HtmlEncode($tbl_target->googlepagerank->CurrentValue);

			// googleindexedpage
			$tbl_target->googleindexedpage->EditCustomAttributes = "";
			$tbl_target->googleindexedpage->EditValue = ew_HtmlEncode($tbl_target->googleindexedpage->CurrentValue);

			// yahooindexedpage
			$tbl_target->yahooindexedpage->EditCustomAttributes = "";
			$tbl_target->yahooindexedpage->EditValue = ew_HtmlEncode($tbl_target->yahooindexedpage->CurrentValue);

			// bingindexedpage
			$tbl_target->bingindexedpage->EditCustomAttributes = "";
			$tbl_target->bingindexedpage->EditValue = ew_HtmlEncode($tbl_target->bingindexedpage->CurrentValue);

			// twitterfollower
			$tbl_target->twitterfollower->EditCustomAttributes = "";
			$tbl_target->twitterfollower->EditValue = ew_HtmlEncode($tbl_target->twitterfollower->CurrentValue);

			// facebookfan
			$tbl_target->facebookfan->EditCustomAttributes = "";
			$tbl_target->facebookfan->EditValue = ew_HtmlEncode($tbl_target->facebookfan->CurrentValue);

			// yahoobacklink
			$tbl_target->yahoobacklink->EditCustomAttributes = "";
			$tbl_target->yahoobacklink->EditValue = ew_HtmlEncode($tbl_target->yahoobacklink->CurrentValue);

			// blwbacklink
			$tbl_target->blwbacklink->EditCustomAttributes = "";
			$tbl_target->blwbacklink->EditValue = ew_HtmlEncode($tbl_target->blwbacklink->CurrentValue);

			// blcbacklink
			$tbl_target->blcbacklink->EditCustomAttributes = "";
			$tbl_target->blcbacklink->EditValue = ew_HtmlEncode($tbl_target->blcbacklink->CurrentValue);
		} elseif ($tbl_target->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_profile
			$tbl_target->id_profile->EditCustomAttributes = "";
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
					$tbl_target->id_profile->EditValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_target->id_profile->EditValue = $tbl_target->id_profile->CurrentValue;
				}
			} else {
				$tbl_target->id_profile->EditValue = NULL;
			}
			$tbl_target->id_profile->CssStyle = "";
			$tbl_target->id_profile->CssClass = "";
			$tbl_target->id_profile->ViewCustomAttributes = "";

			// year
			$tbl_target->year->EditCustomAttributes = "";
			$tbl_target->year->EditValue = $tbl_target->year->CurrentValue;
			$tbl_target->year->CssStyle = "";
			$tbl_target->year->CssClass = "";
			$tbl_target->year->ViewCustomAttributes = "";

			// month
			$tbl_target->month->EditCustomAttributes = "";
			$tbl_target->month->EditValue = $tbl_target->month->CurrentValue;
			$tbl_target->month->CssStyle = "";
			$tbl_target->month->CssClass = "";
			$tbl_target->month->ViewCustomAttributes = "";

			// visit
			$tbl_target->visit->EditCustomAttributes = "";
			$tbl_target->visit->EditValue = ew_HtmlEncode($tbl_target->visit->CurrentValue);

			// pageview
			$tbl_target->pageview->EditCustomAttributes = "";
			$tbl_target->pageview->EditValue = ew_HtmlEncode($tbl_target->pageview->CurrentValue);

			// alexarank
			$tbl_target->alexarank->EditCustomAttributes = "";
			$tbl_target->alexarank->EditValue = ew_HtmlEncode($tbl_target->alexarank->CurrentValue);

			// googlepagerank
			$tbl_target->googlepagerank->EditCustomAttributes = "";
			$tbl_target->googlepagerank->EditValue = ew_HtmlEncode($tbl_target->googlepagerank->CurrentValue);

			// googleindexedpage
			$tbl_target->googleindexedpage->EditCustomAttributes = "";
			$tbl_target->googleindexedpage->EditValue = ew_HtmlEncode($tbl_target->googleindexedpage->CurrentValue);

			// yahooindexedpage
			$tbl_target->yahooindexedpage->EditCustomAttributes = "";
			$tbl_target->yahooindexedpage->EditValue = ew_HtmlEncode($tbl_target->yahooindexedpage->CurrentValue);

			// bingindexedpage
			$tbl_target->bingindexedpage->EditCustomAttributes = "";
			$tbl_target->bingindexedpage->EditValue = ew_HtmlEncode($tbl_target->bingindexedpage->CurrentValue);

			// twitterfollower
			$tbl_target->twitterfollower->EditCustomAttributes = "";
			$tbl_target->twitterfollower->EditValue = ew_HtmlEncode($tbl_target->twitterfollower->CurrentValue);

			// facebookfan
			$tbl_target->facebookfan->EditCustomAttributes = "";
			$tbl_target->facebookfan->EditValue = ew_HtmlEncode($tbl_target->facebookfan->CurrentValue);

			// yahoobacklink
			$tbl_target->yahoobacklink->EditCustomAttributes = "";
			$tbl_target->yahoobacklink->EditValue = ew_HtmlEncode($tbl_target->yahoobacklink->CurrentValue);

			// blwbacklink
			$tbl_target->blwbacklink->EditCustomAttributes = "";
			$tbl_target->blwbacklink->EditValue = ew_HtmlEncode($tbl_target->blwbacklink->CurrentValue);

			// blcbacklink
			$tbl_target->blcbacklink->EditCustomAttributes = "";
			$tbl_target->blcbacklink->EditValue = ew_HtmlEncode($tbl_target->blcbacklink->CurrentValue);

			// Edit refer script
			// id_profile

			$tbl_target->id_profile->HrefValue = "";

			// year
			$tbl_target->year->HrefValue = "";

			// month
			$tbl_target->month->HrefValue = "";

			// visit
			$tbl_target->visit->HrefValue = "";

			// pageview
			$tbl_target->pageview->HrefValue = "";

			// alexarank
			$tbl_target->alexarank->HrefValue = "";

			// googlepagerank
			$tbl_target->googlepagerank->HrefValue = "";

			// googleindexedpage
			$tbl_target->googleindexedpage->HrefValue = "";

			// yahooindexedpage
			$tbl_target->yahooindexedpage->HrefValue = "";

			// bingindexedpage
			$tbl_target->bingindexedpage->HrefValue = "";

			// twitterfollower
			$tbl_target->twitterfollower->HrefValue = "";

			// facebookfan
			$tbl_target->facebookfan->HrefValue = "";

			// yahoobacklink
			$tbl_target->yahoobacklink->HrefValue = "";

			// blwbacklink
			$tbl_target->blwbacklink->HrefValue = "";

			// blcbacklink
			$tbl_target->blcbacklink->HrefValue = "";
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
		global $Language, $gsFormError, $tbl_target;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_target->id_profile->FormValue) && $tbl_target->id_profile->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->id_profile->FldCaption();
		}
		if (!is_null($tbl_target->year->FormValue) && $tbl_target->year->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->year->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->year->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->year->FldErrMsg();
		}
		if (!is_null($tbl_target->month->FormValue) && $tbl_target->month->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->month->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->month->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->month->FldErrMsg();
		}
		if (!is_null($tbl_target->visit->FormValue) && $tbl_target->visit->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->visit->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->visit->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->visit->FldErrMsg();
		}
		if (!is_null($tbl_target->pageview->FormValue) && $tbl_target->pageview->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->pageview->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->pageview->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->pageview->FldErrMsg();
		}
		if (!is_null($tbl_target->alexarank->FormValue) && $tbl_target->alexarank->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->alexarank->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->alexarank->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->alexarank->FldErrMsg();
		}
		if (!is_null($tbl_target->googlepagerank->FormValue) && $tbl_target->googlepagerank->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->googlepagerank->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->googlepagerank->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->googlepagerank->FldErrMsg();
		}
		if (!is_null($tbl_target->googleindexedpage->FormValue) && $tbl_target->googleindexedpage->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->googleindexedpage->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->googleindexedpage->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->googleindexedpage->FldErrMsg();
		}
		if (!is_null($tbl_target->yahooindexedpage->FormValue) && $tbl_target->yahooindexedpage->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->yahooindexedpage->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->yahooindexedpage->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->yahooindexedpage->FldErrMsg();
		}
		if (!is_null($tbl_target->bingindexedpage->FormValue) && $tbl_target->bingindexedpage->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->bingindexedpage->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->bingindexedpage->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->bingindexedpage->FldErrMsg();
		}
		if (!is_null($tbl_target->twitterfollower->FormValue) && $tbl_target->twitterfollower->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->twitterfollower->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->twitterfollower->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->twitterfollower->FldErrMsg();
		}
		if (!is_null($tbl_target->facebookfan->FormValue) && $tbl_target->facebookfan->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->facebookfan->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->facebookfan->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->facebookfan->FldErrMsg();
		}
		if (!is_null($tbl_target->yahoobacklink->FormValue) && $tbl_target->yahoobacklink->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->yahoobacklink->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->yahoobacklink->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->yahoobacklink->FldErrMsg();
		}
		if (!is_null($tbl_target->blwbacklink->FormValue) && $tbl_target->blwbacklink->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->blwbacklink->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->blwbacklink->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->blwbacklink->FldErrMsg();
		}
		if (!is_null($tbl_target->blcbacklink->FormValue) && $tbl_target->blcbacklink->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_target->blcbacklink->FldCaption();
		}
		if (!ew_CheckInteger($tbl_target->blcbacklink->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_target->blcbacklink->FldErrMsg();
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
		global $conn, $Security, $Language, $tbl_target;
		$sFilter = $tbl_target->KeyFilter();
		$tbl_target->CurrentFilter = $sFilter;
		$sSql = $tbl_target->SQL();
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
			// year
			// month
			// visit

			$tbl_target->visit->SetDbValueDef($rsnew, $tbl_target->visit->CurrentValue, 0, FALSE);

			// pageview
			$tbl_target->pageview->SetDbValueDef($rsnew, $tbl_target->pageview->CurrentValue, 0, FALSE);

			// alexarank
			$tbl_target->alexarank->SetDbValueDef($rsnew, $tbl_target->alexarank->CurrentValue, 0, FALSE);

			// googlepagerank
			$tbl_target->googlepagerank->SetDbValueDef($rsnew, $tbl_target->googlepagerank->CurrentValue, 0, FALSE);

			// googleindexedpage
			$tbl_target->googleindexedpage->SetDbValueDef($rsnew, $tbl_target->googleindexedpage->CurrentValue, 0, FALSE);

			// yahooindexedpage
			$tbl_target->yahooindexedpage->SetDbValueDef($rsnew, $tbl_target->yahooindexedpage->CurrentValue, 0, FALSE);

			// bingindexedpage
			$tbl_target->bingindexedpage->SetDbValueDef($rsnew, $tbl_target->bingindexedpage->CurrentValue, 0, FALSE);

			// twitterfollower
			$tbl_target->twitterfollower->SetDbValueDef($rsnew, $tbl_target->twitterfollower->CurrentValue, 0, FALSE);

			// facebookfan
			$tbl_target->facebookfan->SetDbValueDef($rsnew, $tbl_target->facebookfan->CurrentValue, 0, FALSE);

			// yahoobacklink
			$tbl_target->yahoobacklink->SetDbValueDef($rsnew, $tbl_target->yahoobacklink->CurrentValue, 0, FALSE);

			// blwbacklink
			$tbl_target->blwbacklink->SetDbValueDef($rsnew, $tbl_target->blwbacklink->CurrentValue, 0, FALSE);

			// blcbacklink
			$tbl_target->blcbacklink->SetDbValueDef($rsnew, $tbl_target->blcbacklink->CurrentValue, 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $tbl_target->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_target->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_target->CancelMessage <> "") {
					$this->setMessage($tbl_target->CancelMessage);
					$tbl_target->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_target->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $tbl_target;

		// Check if key value entered
		if ($tbl_target->id_profile->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check if key value entered
		if ($tbl_target->year->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check if key value entered
		if ($tbl_target->month->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $tbl_target->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $tbl_target->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// id_profile
		$tbl_target->id_profile->SetDbValueDef($rsnew, $tbl_target->id_profile->CurrentValue, 0, FALSE);

		// year
		$tbl_target->year->SetDbValueDef($rsnew, $tbl_target->year->CurrentValue, 0, FALSE);

		// month
		$tbl_target->month->SetDbValueDef($rsnew, $tbl_target->month->CurrentValue, 0, FALSE);

		// visit
		$tbl_target->visit->SetDbValueDef($rsnew, $tbl_target->visit->CurrentValue, 0, FALSE);

		// pageview
		$tbl_target->pageview->SetDbValueDef($rsnew, $tbl_target->pageview->CurrentValue, 0, FALSE);

		// alexarank
		$tbl_target->alexarank->SetDbValueDef($rsnew, $tbl_target->alexarank->CurrentValue, 0, FALSE);

		// googlepagerank
		$tbl_target->googlepagerank->SetDbValueDef($rsnew, $tbl_target->googlepagerank->CurrentValue, 0, FALSE);

		// googleindexedpage
		$tbl_target->googleindexedpage->SetDbValueDef($rsnew, $tbl_target->googleindexedpage->CurrentValue, 0, FALSE);

		// yahooindexedpage
		$tbl_target->yahooindexedpage->SetDbValueDef($rsnew, $tbl_target->yahooindexedpage->CurrentValue, 0, FALSE);

		// bingindexedpage
		$tbl_target->bingindexedpage->SetDbValueDef($rsnew, $tbl_target->bingindexedpage->CurrentValue, 0, FALSE);

		// twitterfollower
		$tbl_target->twitterfollower->SetDbValueDef($rsnew, $tbl_target->twitterfollower->CurrentValue, 0, FALSE);

		// facebookfan
		$tbl_target->facebookfan->SetDbValueDef($rsnew, $tbl_target->facebookfan->CurrentValue, 0, FALSE);

		// yahoobacklink
		$tbl_target->yahoobacklink->SetDbValueDef($rsnew, $tbl_target->yahoobacklink->CurrentValue, 0, FALSE);

		// blwbacklink
		$tbl_target->blwbacklink->SetDbValueDef($rsnew, $tbl_target->blwbacklink->CurrentValue, 0, FALSE);

		// blcbacklink
		$tbl_target->blcbacklink->SetDbValueDef($rsnew, $tbl_target->blcbacklink->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$bInsertRow = $tbl_target->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tbl_target->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tbl_target->CancelMessage <> "") {
				$this->setMessage($tbl_target->CancelMessage);
				$tbl_target->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$tbl_target->Row_Inserted($rsnew);
		}
		return $AddRow;
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
