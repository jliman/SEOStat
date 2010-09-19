<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_group_profileinfo.php" ?>
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
$tbl_group_profile_list = new ctbl_group_profile_list();
$Page =& $tbl_group_profile_list;

// Page init
$tbl_group_profile_list->Page_Init();

// Page main
$tbl_group_profile_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_group_profile->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_group_profile_list = new ew_Page("tbl_group_profile_list");

// page properties
tbl_group_profile_list.PageID = "list"; // page ID
tbl_group_profile_list.FormID = "ftbl_group_profilelist"; // form ID
var EW_PAGE_ID = tbl_group_profile_list.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_group_profile_list.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_id_group"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_group_profile->id_group->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_profile"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_group_profile->id_profile->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_group_profile_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_group_profile_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_group_profile_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_group_profile_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_group_profile_list.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_group_profile_list.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<?php if ($tbl_group_profile->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$tbl_group_profile_list->lTotalRecs = $tbl_group_profile->SelectRecordCount();
	} else {
		if ($rs = $tbl_group_profile_list->LoadRecordset())
			$tbl_group_profile_list->lTotalRecs = $rs->RecordCount();
	}
	$tbl_group_profile_list->lStartRec = 1;
	if ($tbl_group_profile_list->lDisplayRecs <= 0 || ($tbl_group_profile->Export <> "" && $tbl_group_profile->ExportAll)) // Display all records
		$tbl_group_profile_list->lDisplayRecs = $tbl_group_profile_list->lTotalRecs;
	if (!($tbl_group_profile->Export <> "" && $tbl_group_profile->ExportAll))
		$tbl_group_profile_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $tbl_group_profile_list->LoadRecordset($tbl_group_profile_list->lStartRec-1, $tbl_group_profile_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_group_profile->TableCaption() ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($tbl_group_profile->Export == "" && $tbl_group_profile->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(tbl_group_profile_list);" style="text-decoration: none;"><img id="tbl_group_profile_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="tbl_group_profile_list_SearchPanel">
<form name="ftbl_group_profilelistsrch" id="ftbl_group_profilelistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="tbl_group_profile">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<a href="<?php echo $tbl_group_profile_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="tbl_group_profilesrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
			<?php if ($tbl_group_profile_list->sSrchWhere <> "" && $tbl_group_profile_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(tbl_group_profile_list, this, '<?php echo $tbl_group_profile->HighlightName() ?>');"><?php echo $Language->Phrase("HideHighlight") ?></a>
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
$tbl_group_profile_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($tbl_group_profile->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($tbl_group_profile->CurrentAction <> "gridadd" && $tbl_group_profile->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_group_profile_list->Pager)) $tbl_group_profile_list->Pager = new cPrevNextPager($tbl_group_profile_list->lStartRec, $tbl_group_profile_list->lDisplayRecs, $tbl_group_profile_list->lTotalRecs) ?>
<?php if ($tbl_group_profile_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_group_profile_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_profile_list->PageUrl() ?>start=<?php echo $tbl_group_profile_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_group_profile_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_profile_list->PageUrl() ?>start=<?php echo $tbl_group_profile_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_group_profile_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_group_profile_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_profile_list->PageUrl() ?>start=<?php echo $tbl_group_profile_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_group_profile_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_profile_list->PageUrl() ?>start=<?php echo $tbl_group_profile_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_group_profile_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_group_profile_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_group_profile_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_group_profile_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_group_profile_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($tbl_group_profile_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tbl_group_profile">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="15"<?php if ($tbl_group_profile_list->lDisplayRecs == 15) { ?> selected="selected"<?php } ?>>15</option>
<option value="30"<?php if ($tbl_group_profile_list->lDisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="75"<?php if ($tbl_group_profile_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($tbl_group_profile_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($tbl_group_profile->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_group_profile_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $tbl_group_profile_list->InlineAddUrl ?>"><?php echo $Language->Phrase("InlineAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($tbl_group_profile_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftbl_group_profilelist, '<?php echo $tbl_group_profile_list->MultiDeleteUrl ?>', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="ftbl_group_profilelist" id="ftbl_group_profilelist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="tbl_group_profile">
<div id="gmp_tbl_group_profile" class="ewGridMiddlePanel">
<?php if ($tbl_group_profile_list->lTotalRecs > 0 || $tbl_group_profile->CurrentAction == "add" || $tbl_group_profile->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $tbl_group_profile->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$tbl_group_profile_list->RenderListOptions();

// Render list options (header, left)
$tbl_group_profile_list->ListOptions->Render("header", "left");
?>
<?php if ($tbl_group_profile->id_group->Visible) { // id_group ?>
	<?php if ($tbl_group_profile->SortUrl($tbl_group_profile->id_group) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $tbl_group_profile->id_group->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_group_profile->SortUrl($tbl_group_profile->id_group) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $tbl_group_profile->id_group->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_group_profile->id_group->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_group_profile->id_group->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_group_profile->id_profile->Visible) { // id_profile ?>
	<?php if ($tbl_group_profile->SortUrl($tbl_group_profile->id_profile) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $tbl_group_profile->id_profile->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_group_profile->SortUrl($tbl_group_profile->id_profile) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $tbl_group_profile->id_profile->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_group_profile->id_profile->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_group_profile->id_profile->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$tbl_group_profile_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
	if ($tbl_group_profile->CurrentAction == "add" || $tbl_group_profile->CurrentAction == "copy") {
		$tbl_group_profile_list->lRowIndex = 1;
		if ($tbl_group_profile->CurrentAction == "add")
			$tbl_group_profile_list->LoadDefaultValues();
		if ($tbl_group_profile->EventCancelled) // Insert failed
			$tbl_group_profile_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$tbl_group_profile->CssClass = "ewTableEditRow";
		$tbl_group_profile->CssStyle = "";
		$tbl_group_profile->RowAttrs = array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		$tbl_group_profile->RowType = EW_ROWTYPE_ADD;

		// Render row
		$tbl_group_profile_list->RenderRow();

		// Render list options
		$tbl_group_profile_list->RenderListOptions();
?>
	<tr<?php echo $tbl_group_profile->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_group_profile_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_group_profile->id_group->Visible) { // id_group ?>
		<td>
<select id="x<?php echo $tbl_group_profile_list->lRowIndex ?>_id_group" name="x<?php echo $tbl_group_profile_list->lRowIndex ?>_id_group" title="<?php echo $tbl_group_profile->id_group->FldTitle() ?>"<?php echo $tbl_group_profile->id_group->EditAttributes() ?>>
<?php
if (is_array($tbl_group_profile->id_group->EditValue)) {
	$arwrk = $tbl_group_profile->id_group->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_group_profile->id_group->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
	<?php if ($tbl_group_profile->id_profile->Visible) { // id_profile ?>
		<td>
<select id="x<?php echo $tbl_group_profile_list->lRowIndex ?>_id_profile" name="x<?php echo $tbl_group_profile_list->lRowIndex ?>_id_profile" title="<?php echo $tbl_group_profile->id_profile->FldTitle() ?>"<?php echo $tbl_group_profile->id_profile->EditAttributes() ?>>
<?php
if (is_array($tbl_group_profile->id_profile->EditValue)) {
	$arwrk = $tbl_group_profile->id_profile->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_group_profile->id_profile->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php

// Render list options (body, right)
$tbl_group_profile_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
<?php
if ($tbl_group_profile->ExportAll && $tbl_group_profile->Export <> "") {
	$tbl_group_profile_list->lStopRec = $tbl_group_profile_list->lTotalRecs;
} else {
	$tbl_group_profile_list->lStopRec = $tbl_group_profile_list->lStartRec + $tbl_group_profile_list->lDisplayRecs - 1; // Set the last record to display
}
$tbl_group_profile_list->lRecCount = $tbl_group_profile_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $tbl_group_profile_list->lStartRec > 1)
		$rs->Move($tbl_group_profile_list->lStartRec - 1);
}

// Initialize aggregate
$tbl_group_profile->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tbl_group_profile_list->RenderRow();
$tbl_group_profile_list->lRowCnt = 0;
$tbl_group_profile_list->lEditRowCnt = 0;
if ($tbl_group_profile->CurrentAction == "edit")
	$tbl_group_profile_list->lRowIndex = 1;
while (($tbl_group_profile->CurrentAction == "gridadd" || !$rs->EOF) &&
	$tbl_group_profile_list->lRecCount < $tbl_group_profile_list->lStopRec) {
	$tbl_group_profile_list->lRecCount++;
	if (intval($tbl_group_profile_list->lRecCount) >= intval($tbl_group_profile_list->lStartRec)) {
		$tbl_group_profile_list->lRowCnt++;

	// Init row class and style
	$tbl_group_profile->CssClass = "";
	$tbl_group_profile->CssStyle = "";
	$tbl_group_profile->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($tbl_group_profile->CurrentAction == "gridadd") {
		$tbl_group_profile_list->LoadDefaultValues(); // Load default values
	} else {
		$tbl_group_profile_list->LoadRowValues($rs); // Load row values
	}
	$tbl_group_profile->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($tbl_group_profile->CurrentAction == "edit") {
		if ($tbl_group_profile_list->CheckInlineEditKey() && $tbl_group_profile_list->lEditRowCnt == 0) { // Inline edit
			$tbl_group_profile->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
	}
	if ($tbl_group_profile->RowType == EW_ROWTYPE_EDIT && $tbl_group_profile->EventCancelled) { // Update failed
		if ($tbl_group_profile->CurrentAction == "edit")
			$tbl_group_profile_list->RestoreFormValues(); // Restore form values
	}
	if ($tbl_group_profile->RowType == EW_ROWTYPE_EDIT) // Edit row
		$tbl_group_profile_list->lEditRowCnt++;
	if ($tbl_group_profile->RowType == EW_ROWTYPE_ADD || $tbl_group_profile->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
		$tbl_group_profile->RowAttrs = array_merge($tbl_group_profile->RowAttrs, array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);'));
		$tbl_group_profile->CssClass = "ewTableEditRow";
	}

	// Render row
	$tbl_group_profile_list->RenderRow();

	// Render list options
	$tbl_group_profile_list->RenderListOptions();
?>
	<tr<?php echo $tbl_group_profile->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_group_profile_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_group_profile->id_group->Visible) { // id_group ?>
		<td<?php echo $tbl_group_profile->id_group->CellAttributes() ?>>
<?php if ($tbl_group_profile->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $tbl_group_profile->id_group->ViewAttributes() ?>><?php echo $tbl_group_profile->id_group->EditValue ?></div><input type="hidden" name="x<?php echo $tbl_group_profile_list->lRowIndex ?>_id_group" id="x<?php echo $tbl_group_profile_list->lRowIndex ?>_id_group" value="<?php echo ew_HtmlEncode($tbl_group_profile->id_group->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_group_profile->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_group_profile->id_group->ViewAttributes() ?>><?php echo $tbl_group_profile->id_group->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_group_profile->id_profile->Visible) { // id_profile ?>
		<td<?php echo $tbl_group_profile->id_profile->CellAttributes() ?>>
<?php if ($tbl_group_profile->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $tbl_group_profile->id_profile->ViewAttributes() ?>><?php echo $tbl_group_profile->id_profile->EditValue ?></div><input type="hidden" name="x<?php echo $tbl_group_profile_list->lRowIndex ?>_id_profile" id="x<?php echo $tbl_group_profile_list->lRowIndex ?>_id_profile" value="<?php echo ew_HtmlEncode($tbl_group_profile->id_profile->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_group_profile->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_group_profile->id_profile->ViewAttributes() ?>><?php echo $tbl_group_profile->id_profile->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_group_profile_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($tbl_group_profile->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($tbl_group_profile->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($tbl_group_profile->CurrentAction == "add" || $tbl_group_profile->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $tbl_group_profile_list->lRowIndex ?>">
<?php } ?>
<?php if ($tbl_group_profile->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $tbl_group_profile_list->lRowIndex ?>">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($tbl_group_profile_list->lTotalRecs > 0) { ?>
<?php if ($tbl_group_profile->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($tbl_group_profile->CurrentAction <> "gridadd" && $tbl_group_profile->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_group_profile_list->Pager)) $tbl_group_profile_list->Pager = new cPrevNextPager($tbl_group_profile_list->lStartRec, $tbl_group_profile_list->lDisplayRecs, $tbl_group_profile_list->lTotalRecs) ?>
<?php if ($tbl_group_profile_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_group_profile_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_profile_list->PageUrl() ?>start=<?php echo $tbl_group_profile_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_group_profile_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_profile_list->PageUrl() ?>start=<?php echo $tbl_group_profile_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_group_profile_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_group_profile_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_profile_list->PageUrl() ?>start=<?php echo $tbl_group_profile_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_group_profile_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_profile_list->PageUrl() ?>start=<?php echo $tbl_group_profile_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_group_profile_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_group_profile_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_group_profile_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_group_profile_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_group_profile_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($tbl_group_profile_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tbl_group_profile">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="15"<?php if ($tbl_group_profile_list->lDisplayRecs == 15) { ?> selected="selected"<?php } ?>>15</option>
<option value="30"<?php if ($tbl_group_profile_list->lDisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="75"<?php if ($tbl_group_profile_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($tbl_group_profile_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($tbl_group_profile->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($tbl_group_profile_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_group_profile_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $tbl_group_profile_list->InlineAddUrl ?>"><?php echo $Language->Phrase("InlineAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($tbl_group_profile_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftbl_group_profilelist, '<?php echo $tbl_group_profile_list->MultiDeleteUrl ?>', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($tbl_group_profile->Export == "" && $tbl_group_profile->CurrentAction == "") { ?>
<?php } ?>
<?php if ($tbl_group_profile->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_group_profile_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_group_profile_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'tbl_group_profile';

	// Page object name
	var $PageObjName = 'tbl_group_profile_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_group_profile;
		if ($tbl_group_profile->UseTokenInUrl) $PageUrl .= "t=" . $tbl_group_profile->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_group_profile;
		if ($tbl_group_profile->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_group_profile->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_group_profile->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_group_profile_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_group_profile)
		$GLOBALS["tbl_group_profile"] = new ctbl_group_profile();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["tbl_group_profile"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tbl_group_profiledelete.php";
		$this->MultiUpdateUrl = "tbl_group_profileupdate.php";

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_group_profile', TRUE);

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
		global $tbl_group_profile;

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
			$tbl_group_profile->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$tbl_group_profile->Export = $_POST["exporttype"];
		} else {
			$tbl_group_profile->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $tbl_group_profile->Export; // Get export parameter, used in header
		$gsExportFile = $tbl_group_profile->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $tbl_group_profile;

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
				$tbl_group_profile->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($tbl_group_profile->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($tbl_group_profile->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($tbl_group_profile->CurrentAction == "add" || $tbl_group_profile->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$tbl_group_profile->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if (($tbl_group_profile->CurrentAction == "update" || $tbl_group_profile->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($tbl_group_profile->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
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
			$tbl_group_profile->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($tbl_group_profile->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $tbl_group_profile->getRecordsPerPage(); // Restore from Session
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
		$tbl_group_profile->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$tbl_group_profile->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$tbl_group_profile->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $tbl_group_profile->getSearchWhere();
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
		$tbl_group_profile->setSessionWhere($sFilter);
		$tbl_group_profile->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $tbl_group_profile;
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
			$tbl_group_profile->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$tbl_group_profile->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $tbl_group_profile;
		$tbl_group_profile->setKey("id_group", ""); // Clear inline edit key
		$tbl_group_profile->setKey("id_profile", ""); // Clear inline edit key
		$tbl_group_profile->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $tbl_group_profile;
		if (!$Security->CanEdit())
			$this->Page_Terminate("login.php"); // Go to login page
		$bInlineEdit = TRUE;
		if (@$_GET["id_group"] <> "") {
			$tbl_group_profile->id_group->setQueryStringValue($_GET["id_group"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if (@$_GET["id_profile"] <> "") {
			$tbl_group_profile->id_profile->setQueryStringValue($_GET["id_profile"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$tbl_group_profile->setKey("id_group", $tbl_group_profile->id_group->CurrentValue); // Set up inline edit key
				$tbl_group_profile->setKey("id_profile", $tbl_group_profile->id_profile->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError, $tbl_group_profile;
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
				$tbl_group_profile->SendEmail = TRUE; // Send email on update success
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
			$tbl_group_profile->EventCancelled = TRUE; // Cancel event
			$tbl_group_profile->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {
		global $tbl_group_profile;

		//CheckInlineEditKey = True
		if (strval($tbl_group_profile->getKey("id_group")) <> strval($tbl_group_profile->id_group->CurrentValue))
			return FALSE;
		if (strval($tbl_group_profile->getKey("id_profile")) <> strval($tbl_group_profile->id_profile->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $tbl_group_profile;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		$tbl_group_profile->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to Inline Add/Copy record
	function InlineInsert() {
		global $Language, $objForm, $gsFormError, $tbl_group_profile;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$tbl_group_profile->EventCancelled = TRUE; // Set event cancelled
			$tbl_group_profile->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$tbl_group_profile->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage($Language->Phrase("AddSuccess")); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$tbl_group_profile->EventCancelled = TRUE; // Set event cancelled
			$tbl_group_profile->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $tbl_group_profile;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $tbl_group_profile->id_group, FALSE); // id_group
		$this->BuildSearchSql($sWhere, $tbl_group_profile->id_profile, FALSE); // id_profile

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($tbl_group_profile->id_group); // id_group
			$this->SetSearchParm($tbl_group_profile->id_profile); // id_profile
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
		global $tbl_group_profile;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$tbl_group_profile->setAdvancedSearch("x_$FldParm", $FldVal);
		$tbl_group_profile->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$tbl_group_profile->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$tbl_group_profile->setAdvancedSearch("y_$FldParm", $FldVal2);
		$tbl_group_profile->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $tbl_group_profile;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $tbl_group_profile->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $tbl_group_profile->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $tbl_group_profile->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $tbl_group_profile->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $tbl_group_profile->GetAdvancedSearch("w_$FldParm");
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
		global $tbl_group_profile;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$tbl_group_profile->setSearchWhere($this->sSrchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $tbl_group_profile;
		$tbl_group_profile->setAdvancedSearch("x_id_group", "");
		$tbl_group_profile->setAdvancedSearch("x_id_profile", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $tbl_group_profile;
		$bRestore = TRUE;
		if (@$_GET["x_id_group"] <> "") $bRestore = FALSE;
		if (@$_GET["x_id_profile"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore advanced search values
			$this->GetSearchParm($tbl_group_profile->id_group);
			$this->GetSearchParm($tbl_group_profile->id_profile);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $tbl_group_profile;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$tbl_group_profile->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$tbl_group_profile->CurrentOrderType = @$_GET["ordertype"];
			$tbl_group_profile->UpdateSort($tbl_group_profile->id_group); // id_group
			$tbl_group_profile->UpdateSort($tbl_group_profile->id_profile); // id_profile
			$tbl_group_profile->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $tbl_group_profile;
		$sOrderBy = $tbl_group_profile->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($tbl_group_profile->SqlOrderBy() <> "") {
				$sOrderBy = $tbl_group_profile->SqlOrderBy();
				$tbl_group_profile->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $tbl_group_profile;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$tbl_group_profile->setSessionOrderBy($sOrderBy);
				$tbl_group_profile->id_group->setSort("");
				$tbl_group_profile->id_profile->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$tbl_group_profile->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $tbl_group_profile;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"tbl_group_profile_list.SelectAllKey(this);\">";
		$this->ListOptions->MoveItem("checkbox", 0); // Move to first column

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($tbl_group_profile->Export <> "" ||
			$tbl_group_profile->CurrentAction == "gridadd" ||
			$tbl_group_profile->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $tbl_group_profile;
		$this->ListOptions->LoadDefault();

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if (($tbl_group_profile->CurrentAction == "add" || $tbl_group_profile->CurrentAction == "copy") &&
			$tbl_group_profile->RowType == EW_ROWTYPE_ADD) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
				"<a href=\"\" onclick=\"f=document.ftbl_group_profilelist;if(tbl_group_profile_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("InsertLink") . "</a>&nbsp;" .
				"<a href=\"" . $this->PageUrl() . "a=cancel\">" . $Language->Phrase("CancelLink") . "</a>" .
				"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"insert\"></div>";
			return;
		}

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($tbl_group_profile->CurrentAction == "edit" && $tbl_group_profile->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a href=\"\" onclick=\"f=document.ftbl_group_profilelist;if(tbl_group_profile_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($tbl_group_profile->id_group->CurrentValue . EW_COMPOSITE_KEY_SEPARATOR . $tbl_group_profile->id_profile->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $tbl_group_profile;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_group_profile;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_group_profile->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_group_profile->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_group_profile->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_group_profile->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_group_profile->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_group_profile->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $tbl_group_profile;
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $tbl_group_profile;

		// Load search values
		// id_group

		$tbl_group_profile->id_group->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id_group"]);
		$tbl_group_profile->id_group->AdvancedSearch->SearchOperator = @$_GET["z_id_group"];

		// id_profile
		$tbl_group_profile->id_profile->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id_profile"]);
		$tbl_group_profile->id_profile->AdvancedSearch->SearchOperator = @$_GET["z_id_profile"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_group_profile;
		$tbl_group_profile->id_group->setFormValue($objForm->GetValue("x_id_group"));
		$tbl_group_profile->id_profile->setFormValue($objForm->GetValue("x_id_profile"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_group_profile;
		$tbl_group_profile->id_group->CurrentValue = $tbl_group_profile->id_group->FormValue;
		$tbl_group_profile->id_profile->CurrentValue = $tbl_group_profile->id_profile->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_group_profile;

		// Call Recordset Selecting event
		$tbl_group_profile->Recordset_Selecting($tbl_group_profile->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_group_profile->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_group_profile->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_group_profile;
		$sFilter = $tbl_group_profile->KeyFilter();

		// Call Row Selecting event
		$tbl_group_profile->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_group_profile->CurrentFilter = $sFilter;
		$sSql = $tbl_group_profile->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_group_profile->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_group_profile;
		$tbl_group_profile->id_group->setDbValue($rs->fields('id_group'));
		$tbl_group_profile->id_profile->setDbValue($rs->fields('id_profile'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_group_profile;

		// Initialize URLs
		$this->ViewUrl = $tbl_group_profile->ViewUrl();
		$this->EditUrl = $tbl_group_profile->EditUrl();
		$this->InlineEditUrl = $tbl_group_profile->InlineEditUrl();
		$this->CopyUrl = $tbl_group_profile->CopyUrl();
		$this->InlineCopyUrl = $tbl_group_profile->InlineCopyUrl();
		$this->DeleteUrl = $tbl_group_profile->DeleteUrl();

		// Call Row_Rendering event
		$tbl_group_profile->Row_Rendering();

		// Common render codes for all row types
		// id_group

		$tbl_group_profile->id_group->CellCssStyle = "white-space: nowrap;"; $tbl_group_profile->id_group->CellCssClass = "";
		$tbl_group_profile->id_group->CellAttrs = array(); $tbl_group_profile->id_group->ViewAttrs = array(); $tbl_group_profile->id_group->EditAttrs = array();

		// id_profile
		$tbl_group_profile->id_profile->CellCssStyle = "white-space: nowrap;"; $tbl_group_profile->id_profile->CellCssClass = "";
		$tbl_group_profile->id_profile->CellAttrs = array(); $tbl_group_profile->id_profile->ViewAttrs = array(); $tbl_group_profile->id_profile->EditAttrs = array();
		if ($tbl_group_profile->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_group
			if (strval($tbl_group_profile->id_group->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_group_profile->id_group->CurrentValue) . "";
			$sSqlWrk = "SELECT DISTINCT `name` FROM `tbl_group`";
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
					$tbl_group_profile->id_group->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_group_profile->id_group->ViewValue = $tbl_group_profile->id_group->CurrentValue;
				}
			} else {
				$tbl_group_profile->id_group->ViewValue = NULL;
			}
			$tbl_group_profile->id_group->CssStyle = "";
			$tbl_group_profile->id_group->CssClass = "";
			$tbl_group_profile->id_group->ViewCustomAttributes = "";

			// id_profile
			if (strval($tbl_group_profile->id_profile->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_group_profile->id_profile->CurrentValue) . "";
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
					$tbl_group_profile->id_profile->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_group_profile->id_profile->ViewValue = $tbl_group_profile->id_profile->CurrentValue;
				}
			} else {
				$tbl_group_profile->id_profile->ViewValue = NULL;
			}
			$tbl_group_profile->id_profile->CssStyle = "";
			$tbl_group_profile->id_profile->CssClass = "";
			$tbl_group_profile->id_profile->ViewCustomAttributes = "";

			// id_group
			$tbl_group_profile->id_group->HrefValue = "";
			$tbl_group_profile->id_group->TooltipValue = "";

			// id_profile
			$tbl_group_profile->id_profile->HrefValue = "";
			$tbl_group_profile->id_profile->TooltipValue = "";
		} elseif ($tbl_group_profile->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_group
			$tbl_group_profile->id_group->EditCustomAttributes = "";
				$sFilterWrk = "";
			$sSqlWrk = "SELECT DISTINCT `id`, `name`, '' AS Disp2Fld, '' AS SelectFilterFld FROM `tbl_group`";
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
			$tbl_group_profile->id_group->EditValue = $arwrk;

			// id_profile
			$tbl_group_profile->id_profile->EditCustomAttributes = "";
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
			$tbl_group_profile->id_profile->EditValue = $arwrk;
		} elseif ($tbl_group_profile->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_group
			$tbl_group_profile->id_group->EditCustomAttributes = "";
			if (strval($tbl_group_profile->id_group->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_group_profile->id_group->CurrentValue) . "";
			$sSqlWrk = "SELECT DISTINCT `name` FROM `tbl_group`";
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
					$tbl_group_profile->id_group->EditValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_group_profile->id_group->EditValue = $tbl_group_profile->id_group->CurrentValue;
				}
			} else {
				$tbl_group_profile->id_group->EditValue = NULL;
			}
			$tbl_group_profile->id_group->CssStyle = "";
			$tbl_group_profile->id_group->CssClass = "";
			$tbl_group_profile->id_group->ViewCustomAttributes = "";

			// id_profile
			$tbl_group_profile->id_profile->EditCustomAttributes = "";
			if (strval($tbl_group_profile->id_profile->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_group_profile->id_profile->CurrentValue) . "";
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
					$tbl_group_profile->id_profile->EditValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_group_profile->id_profile->EditValue = $tbl_group_profile->id_profile->CurrentValue;
				}
			} else {
				$tbl_group_profile->id_profile->EditValue = NULL;
			}
			$tbl_group_profile->id_profile->CssStyle = "";
			$tbl_group_profile->id_profile->CssClass = "";
			$tbl_group_profile->id_profile->ViewCustomAttributes = "";

			// Edit refer script
			// id_group

			$tbl_group_profile->id_group->HrefValue = "";

			// id_profile
			$tbl_group_profile->id_profile->HrefValue = "";
		}

		// Call Row Rendered event
		if ($tbl_group_profile->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_group_profile->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $tbl_group_profile;

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
		global $Language, $gsFormError, $tbl_group_profile;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_group_profile->id_group->FormValue) && $tbl_group_profile->id_group->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_group_profile->id_group->FldCaption();
		}
		if (!is_null($tbl_group_profile->id_profile->FormValue) && $tbl_group_profile->id_profile->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_group_profile->id_profile->FldCaption();
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
		global $conn, $Security, $Language, $tbl_group_profile;
		$sFilter = $tbl_group_profile->KeyFilter();
		$tbl_group_profile->CurrentFilter = $sFilter;
		$sSql = $tbl_group_profile->SQL();
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

			// id_group
			// id_profile
			// Call Row Updating event

			$bUpdateRow = $tbl_group_profile->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_group_profile->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_group_profile->CancelMessage <> "") {
					$this->setMessage($tbl_group_profile->CancelMessage);
					$tbl_group_profile->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_group_profile->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $tbl_group_profile;

		// Check if key value entered
		if ($tbl_group_profile->id_group->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check if key value entered
		if ($tbl_group_profile->id_profile->CurrentValue == "") {
			$this->setMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $tbl_group_profile->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $tbl_group_profile->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// id_group
		$tbl_group_profile->id_group->SetDbValueDef($rsnew, $tbl_group_profile->id_group->CurrentValue, 0, FALSE);

		// id_profile
		$tbl_group_profile->id_profile->SetDbValueDef($rsnew, $tbl_group_profile->id_profile->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$bInsertRow = $tbl_group_profile->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tbl_group_profile->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tbl_group_profile->CancelMessage <> "") {
				$this->setMessage($tbl_group_profile->CancelMessage);
				$tbl_group_profile->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$tbl_group_profile->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $tbl_group_profile;
		$tbl_group_profile->id_group->AdvancedSearch->SearchValue = $tbl_group_profile->getAdvancedSearch("x_id_group");
		$tbl_group_profile->id_profile->AdvancedSearch->SearchValue = $tbl_group_profile->getAdvancedSearch("x_id_profile");
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
