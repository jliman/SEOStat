<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_groupinfo.php" ?>
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
$tbl_group_list = new ctbl_group_list();
$Page =& $tbl_group_list;

// Page init
$tbl_group_list->Page_Init();

// Page main
$tbl_group_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_group->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_group_list = new ew_Page("tbl_group_list");

// page properties
tbl_group_list.PageID = "list"; // page ID
tbl_group_list.FormID = "ftbl_grouplist"; // form ID
var EW_PAGE_ID = tbl_group_list.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_group_list.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_group->name->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_group_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_group_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_group_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_group_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_group_list.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_group_list.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<?php if ($tbl_group->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$tbl_group_list->lTotalRecs = $tbl_group->SelectRecordCount();
	} else {
		if ($rs = $tbl_group_list->LoadRecordset())
			$tbl_group_list->lTotalRecs = $rs->RecordCount();
	}
	$tbl_group_list->lStartRec = 1;
	if ($tbl_group_list->lDisplayRecs <= 0 || ($tbl_group->Export <> "" && $tbl_group->ExportAll)) // Display all records
		$tbl_group_list->lDisplayRecs = $tbl_group_list->lTotalRecs;
	if (!($tbl_group->Export <> "" && $tbl_group->ExportAll))
		$tbl_group_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $tbl_group_list->LoadRecordset($tbl_group_list->lStartRec-1, $tbl_group_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_group->TableCaption() ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($tbl_group->Export == "" && $tbl_group->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(tbl_group_list);" style="text-decoration: none;"><img id="tbl_group_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="tbl_group_list_SearchPanel">
<form name="ftbl_grouplistsrch" id="ftbl_grouplistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="tbl_group">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($tbl_group->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $tbl_group_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="tbl_groupsrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
			<?php if ($tbl_group_list->sSrchWhere <> "" && $tbl_group_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(tbl_group_list, this, '<?php echo $tbl_group->HighlightName() ?>');"><?php echo $Language->Phrase("HideHighlight") ?></a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($tbl_group->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($tbl_group->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($tbl_group->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_group_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($tbl_group->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($tbl_group->CurrentAction <> "gridadd" && $tbl_group->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_group_list->Pager)) $tbl_group_list->Pager = new cPrevNextPager($tbl_group_list->lStartRec, $tbl_group_list->lDisplayRecs, $tbl_group_list->lTotalRecs) ?>
<?php if ($tbl_group_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_group_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_list->PageUrl() ?>start=<?php echo $tbl_group_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_group_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_list->PageUrl() ?>start=<?php echo $tbl_group_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_group_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_group_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_list->PageUrl() ?>start=<?php echo $tbl_group_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_group_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_list->PageUrl() ?>start=<?php echo $tbl_group_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_group_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_group_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_group_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_group_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_group_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($tbl_group_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tbl_group">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="15"<?php if ($tbl_group_list->lDisplayRecs == 15) { ?> selected="selected"<?php } ?>>15</option>
<option value="30"<?php if ($tbl_group_list->lDisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="75"<?php if ($tbl_group_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($tbl_group_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($tbl_group->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_group_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $tbl_group_list->InlineAddUrl ?>"><?php echo $Language->Phrase("InlineAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($tbl_group_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftbl_grouplist, '<?php echo $tbl_group_list->MultiDeleteUrl ?>', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="ftbl_grouplist" id="ftbl_grouplist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="tbl_group">
<div id="gmp_tbl_group" class="ewGridMiddlePanel">
<?php if ($tbl_group_list->lTotalRecs > 0 || $tbl_group->CurrentAction == "add" || $tbl_group->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $tbl_group->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$tbl_group_list->RenderListOptions();

// Render list options (header, left)
$tbl_group_list->ListOptions->Render("header", "left");
?>
<?php if ($tbl_group->id->Visible) { // id ?>
	<?php if ($tbl_group->SortUrl($tbl_group->id) == "") { ?>
		<td><?php echo $tbl_group->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_group->SortUrl($tbl_group->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_group->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_group->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_group->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_group->name->Visible) { // name ?>
	<?php if ($tbl_group->SortUrl($tbl_group->name) == "") { ?>
		<td style="white-space: nowrap;"><?php echo $tbl_group->name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_group->SortUrl($tbl_group->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn" style="white-space: nowrap;"><thead><tr><td><?php echo $tbl_group->name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_group->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_group->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_group->is_active->Visible) { // is_active ?>
	<?php if ($tbl_group->SortUrl($tbl_group->is_active) == "") { ?>
		<td><?php echo $tbl_group->is_active->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_group->SortUrl($tbl_group->is_active) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_group->is_active->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_group->is_active->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_group->is_active->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$tbl_group_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
	if ($tbl_group->CurrentAction == "add" || $tbl_group->CurrentAction == "copy") {
		$tbl_group_list->lRowIndex = 1;
		if ($tbl_group->CurrentAction == "add")
			$tbl_group_list->LoadDefaultValues();
		if ($tbl_group->EventCancelled) // Insert failed
			$tbl_group_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$tbl_group->CssClass = "ewTableEditRow";
		$tbl_group->CssStyle = "";
		$tbl_group->RowAttrs = array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		$tbl_group->RowType = EW_ROWTYPE_ADD;

		// Render row
		$tbl_group_list->RenderRow();

		// Render list options
		$tbl_group_list->RenderListOptions();
?>
	<tr<?php echo $tbl_group->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_group_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_group->id->Visible) { // id ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($tbl_group->name->Visible) { // name ?>
		<td>
<input type="text" name="x<?php echo $tbl_group_list->lRowIndex ?>_name" id="x<?php echo $tbl_group_list->lRowIndex ?>_name" title="<?php echo $tbl_group->name->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_group->name->EditValue ?>"<?php echo $tbl_group->name->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_group->is_active->Visible) { // is_active ?>
		<td>
<div id="tp_x<?php echo $tbl_group_list->lRowIndex ?>_is_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x<?php echo $tbl_group_list->lRowIndex ?>_is_active" id="x<?php echo $tbl_group_list->lRowIndex ?>_is_active" title="<?php echo $tbl_group->is_active->FldTitle() ?>" value="{value}"<?php echo $tbl_group->is_active->EditAttributes() ?>></label></div>
<div id="dsl_x<?php echo $tbl_group_list->lRowIndex ?>_is_active" repeatcolumn="5">
<?php
$arwrk = $tbl_group->is_active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_group->is_active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $tbl_group_list->lRowIndex ?>_is_active" id="x<?php echo $tbl_group_list->lRowIndex ?>_is_active" title="<?php echo $tbl_group->is_active->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_group->is_active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
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
$tbl_group_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
<?php
if ($tbl_group->ExportAll && $tbl_group->Export <> "") {
	$tbl_group_list->lStopRec = $tbl_group_list->lTotalRecs;
} else {
	$tbl_group_list->lStopRec = $tbl_group_list->lStartRec + $tbl_group_list->lDisplayRecs - 1; // Set the last record to display
}
$tbl_group_list->lRecCount = $tbl_group_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $tbl_group_list->lStartRec > 1)
		$rs->Move($tbl_group_list->lStartRec - 1);
}

// Initialize aggregate
$tbl_group->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tbl_group_list->RenderRow();
$tbl_group_list->lRowCnt = 0;
$tbl_group_list->lEditRowCnt = 0;
if ($tbl_group->CurrentAction == "edit")
	$tbl_group_list->lRowIndex = 1;
while (($tbl_group->CurrentAction == "gridadd" || !$rs->EOF) &&
	$tbl_group_list->lRecCount < $tbl_group_list->lStopRec) {
	$tbl_group_list->lRecCount++;
	if (intval($tbl_group_list->lRecCount) >= intval($tbl_group_list->lStartRec)) {
		$tbl_group_list->lRowCnt++;

	// Init row class and style
	$tbl_group->CssClass = "";
	$tbl_group->CssStyle = "";
	$tbl_group->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($tbl_group->CurrentAction == "gridadd") {
		$tbl_group_list->LoadDefaultValues(); // Load default values
	} else {
		$tbl_group_list->LoadRowValues($rs); // Load row values
	}
	$tbl_group->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($tbl_group->CurrentAction == "edit") {
		if ($tbl_group_list->CheckInlineEditKey() && $tbl_group_list->lEditRowCnt == 0) { // Inline edit
			$tbl_group->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
	}
	if ($tbl_group->RowType == EW_ROWTYPE_EDIT && $tbl_group->EventCancelled) { // Update failed
		if ($tbl_group->CurrentAction == "edit")
			$tbl_group_list->RestoreFormValues(); // Restore form values
	}
	if ($tbl_group->RowType == EW_ROWTYPE_EDIT) // Edit row
		$tbl_group_list->lEditRowCnt++;
	if ($tbl_group->RowType == EW_ROWTYPE_ADD || $tbl_group->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
		$tbl_group->RowAttrs = array_merge($tbl_group->RowAttrs, array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);'));
		$tbl_group->CssClass = "ewTableEditRow";
	}

	// Render row
	$tbl_group_list->RenderRow();

	// Render list options
	$tbl_group_list->RenderListOptions();
?>
	<tr<?php echo $tbl_group->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_group_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_group->id->Visible) { // id ?>
		<td<?php echo $tbl_group->id->CellAttributes() ?>>
<?php if ($tbl_group->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $tbl_group->id->ViewAttributes() ?>><?php echo $tbl_group->id->EditValue ?></div><input type="hidden" name="x<?php echo $tbl_group_list->lRowIndex ?>_id" id="x<?php echo $tbl_group_list->lRowIndex ?>_id" value="<?php echo ew_HtmlEncode($tbl_group->id->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_group->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_group->id->ViewAttributes() ?>><?php echo $tbl_group->id->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_group->name->Visible) { // name ?>
		<td<?php echo $tbl_group->name->CellAttributes() ?>>
<?php if ($tbl_group->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_group_list->lRowIndex ?>_name" id="x<?php echo $tbl_group_list->lRowIndex ?>_name" title="<?php echo $tbl_group->name->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_group->name->EditValue ?>"<?php echo $tbl_group->name->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_group->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_group->name->ViewAttributes() ?>><?php echo $tbl_group->name->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_group->is_active->Visible) { // is_active ?>
		<td<?php echo $tbl_group->is_active->CellAttributes() ?>>
<?php if ($tbl_group->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div id="tp_x<?php echo $tbl_group_list->lRowIndex ?>_is_active" class="<?php echo EW_ITEM_TEMPLATE_CLASSNAME ?>"><label><input type="radio" name="x<?php echo $tbl_group_list->lRowIndex ?>_is_active" id="x<?php echo $tbl_group_list->lRowIndex ?>_is_active" title="<?php echo $tbl_group->is_active->FldTitle() ?>" value="{value}"<?php echo $tbl_group->is_active->EditAttributes() ?>></label></div>
<div id="dsl_x<?php echo $tbl_group_list->lRowIndex ?>_is_active" repeatcolumn="5">
<?php
$arwrk = $tbl_group->is_active->EditValue;
if (is_array($arwrk)) {
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_group->is_active->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " checked=\"checked\"" : "";
		if ($selwrk <> "") $emptywrk = FALSE;

		// Note: No spacing within the LABEL tag
?>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 1) ?>
<label><input type="radio" name="x<?php echo $tbl_group_list->lRowIndex ?>_is_active" id="x<?php echo $tbl_group_list->lRowIndex ?>_is_active" title="<?php echo $tbl_group->is_active->FldTitle() ?>" value="<?php echo ew_HtmlEncode($arwrk[$rowcntwrk][0]) ?>"<?php echo $selwrk ?><?php echo $tbl_group->is_active->EditAttributes() ?>><?php echo $arwrk[$rowcntwrk][1] ?></label>
<?php echo ew_RepeatColumnTable($rowswrk, $rowcntwrk, 5, 2) ?>
<?php
	}
}
?>
</div>
<?php } ?>
<?php if ($tbl_group->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_group->is_active->ViewAttributes() ?>><?php echo $tbl_group->is_active->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_group_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($tbl_group->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($tbl_group->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($tbl_group->CurrentAction == "add" || $tbl_group->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $tbl_group_list->lRowIndex ?>">
<?php } ?>
<?php if ($tbl_group->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $tbl_group_list->lRowIndex ?>">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($tbl_group_list->lTotalRecs > 0) { ?>
<?php if ($tbl_group->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($tbl_group->CurrentAction <> "gridadd" && $tbl_group->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_group_list->Pager)) $tbl_group_list->Pager = new cPrevNextPager($tbl_group_list->lStartRec, $tbl_group_list->lDisplayRecs, $tbl_group_list->lTotalRecs) ?>
<?php if ($tbl_group_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_group_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_list->PageUrl() ?>start=<?php echo $tbl_group_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_group_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_list->PageUrl() ?>start=<?php echo $tbl_group_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_group_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_group_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_list->PageUrl() ?>start=<?php echo $tbl_group_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_group_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_list->PageUrl() ?>start=<?php echo $tbl_group_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_group_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_group_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_group_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_group_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_group_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($tbl_group_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tbl_group">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="15"<?php if ($tbl_group_list->lDisplayRecs == 15) { ?> selected="selected"<?php } ?>>15</option>
<option value="30"<?php if ($tbl_group_list->lDisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="75"<?php if ($tbl_group_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($tbl_group_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($tbl_group->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($tbl_group_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_group_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $tbl_group_list->InlineAddUrl ?>"><?php echo $Language->Phrase("InlineAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($tbl_group_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftbl_grouplist, '<?php echo $tbl_group_list->MultiDeleteUrl ?>', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($tbl_group->Export == "" && $tbl_group->CurrentAction == "") { ?>
<?php } ?>
<?php if ($tbl_group->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_group_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_group_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'tbl_group';

	// Page object name
	var $PageObjName = 'tbl_group_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_group;
		if ($tbl_group->UseTokenInUrl) $PageUrl .= "t=" . $tbl_group->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_group;
		if ($tbl_group->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_group->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_group->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_group_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_group)
		$GLOBALS["tbl_group"] = new ctbl_group();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["tbl_group"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tbl_groupdelete.php";
		$this->MultiUpdateUrl = "tbl_groupupdate.php";

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_group', TRUE);

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
		global $tbl_group;

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
			$tbl_group->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$tbl_group->Export = $_POST["exporttype"];
		} else {
			$tbl_group->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $tbl_group->Export; // Get export parameter, used in header
		$gsExportFile = $tbl_group->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $tbl_group;

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
				$tbl_group->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($tbl_group->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($tbl_group->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($tbl_group->CurrentAction == "add" || $tbl_group->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$tbl_group->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if (($tbl_group->CurrentAction == "update" || $tbl_group->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($tbl_group->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
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
			$tbl_group->Recordset_SearchValidated();

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
		if ($tbl_group->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $tbl_group->getRecordsPerPage(); // Restore from Session
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
		$tbl_group->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$tbl_group->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$tbl_group->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $tbl_group->getSearchWhere();
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
		$tbl_group->setSessionWhere($sFilter);
		$tbl_group->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $tbl_group;
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
			$tbl_group->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$tbl_group->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $tbl_group;
		$tbl_group->setKey("id", ""); // Clear inline edit key
		$tbl_group->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $tbl_group;
		if (!$Security->CanEdit())
			$this->Page_Terminate("login.php"); // Go to login page
		$bInlineEdit = TRUE;
		if (@$_GET["id"] <> "") {
			$tbl_group->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$tbl_group->setKey("id", $tbl_group->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError, $tbl_group;
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
				$tbl_group->SendEmail = TRUE; // Send email on update success
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
			$tbl_group->EventCancelled = TRUE; // Cancel event
			$tbl_group->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {
		global $tbl_group;

		//CheckInlineEditKey = True
		if (strval($tbl_group->getKey("id")) <> strval($tbl_group->id->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $tbl_group;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		$tbl_group->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to Inline Add/Copy record
	function InlineInsert() {
		global $Language, $objForm, $gsFormError, $tbl_group;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$tbl_group->EventCancelled = TRUE; // Set event cancelled
			$tbl_group->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$tbl_group->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage($Language->Phrase("AddSuccess")); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$tbl_group->EventCancelled = TRUE; // Set event cancelled
			$tbl_group->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $tbl_group;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $tbl_group->id, FALSE); // id
		$this->BuildSearchSql($sWhere, $tbl_group->name, FALSE); // name
		$this->BuildSearchSql($sWhere, $tbl_group->is_active, FALSE); // is_active

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($tbl_group->id); // id
			$this->SetSearchParm($tbl_group->name); // name
			$this->SetSearchParm($tbl_group->is_active); // is_active
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
		global $tbl_group;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$tbl_group->setAdvancedSearch("x_$FldParm", $FldVal);
		$tbl_group->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$tbl_group->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$tbl_group->setAdvancedSearch("y_$FldParm", $FldVal2);
		$tbl_group->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $tbl_group;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $tbl_group->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $tbl_group->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $tbl_group->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $tbl_group->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $tbl_group->GetAdvancedSearch("w_$FldParm");
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
		global $tbl_group;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $tbl_group->name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_group->is_active, $Keyword);
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
		global $Security, $tbl_group;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $tbl_group->BasicSearchKeyword;
		$sSearchType = $tbl_group->BasicSearchType;
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
			$tbl_group->setSessionBasicSearchKeyword($sSearchKeyword);
			$tbl_group->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $tbl_group;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$tbl_group->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $tbl_group;
		$tbl_group->setSessionBasicSearchKeyword("");
		$tbl_group->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $tbl_group;
		$tbl_group->setAdvancedSearch("x_id", "");
		$tbl_group->setAdvancedSearch("x_name", "");
		$tbl_group->setAdvancedSearch("x_is_active", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $tbl_group;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_id"] <> "") $bRestore = FALSE;
		if (@$_GET["x_name"] <> "") $bRestore = FALSE;
		if (@$_GET["x_is_active"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$tbl_group->BasicSearchKeyword = $tbl_group->getSessionBasicSearchKeyword();
			$tbl_group->BasicSearchType = $tbl_group->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($tbl_group->id);
			$this->GetSearchParm($tbl_group->name);
			$this->GetSearchParm($tbl_group->is_active);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $tbl_group;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$tbl_group->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$tbl_group->CurrentOrderType = @$_GET["ordertype"];
			$tbl_group->UpdateSort($tbl_group->id); // id
			$tbl_group->UpdateSort($tbl_group->name); // name
			$tbl_group->UpdateSort($tbl_group->is_active); // is_active
			$tbl_group->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $tbl_group;
		$sOrderBy = $tbl_group->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($tbl_group->SqlOrderBy() <> "") {
				$sOrderBy = $tbl_group->SqlOrderBy();
				$tbl_group->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $tbl_group;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$tbl_group->setSessionOrderBy($sOrderBy);
				$tbl_group->id->setSort("");
				$tbl_group->name->setSort("");
				$tbl_group->is_active->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$tbl_group->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $tbl_group;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"tbl_group_list.SelectAllKey(this);\">";
		$this->ListOptions->MoveItem("checkbox", 0); // Move to first column

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($tbl_group->Export <> "" ||
			$tbl_group->CurrentAction == "gridadd" ||
			$tbl_group->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $tbl_group;
		$this->ListOptions->LoadDefault();

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if (($tbl_group->CurrentAction == "add" || $tbl_group->CurrentAction == "copy") &&
			$tbl_group->RowType == EW_ROWTYPE_ADD) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
				"<a href=\"\" onclick=\"f=document.ftbl_grouplist;if(tbl_group_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("InsertLink") . "</a>&nbsp;" .
				"<a href=\"" . $this->PageUrl() . "a=cancel\">" . $Language->Phrase("CancelLink") . "</a>" .
				"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"insert\"></div>";
			return;
		}

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($tbl_group->CurrentAction == "edit" && $tbl_group->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a href=\"\" onclick=\"f=document.ftbl_grouplist;if(tbl_group_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($tbl_group->id->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $tbl_group;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_group;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_group->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_group->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_group->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_group->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_group->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_group->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $tbl_group;
		$tbl_group->is_active->CurrentValue = "1";
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $tbl_group;
		$tbl_group->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$tbl_group->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $tbl_group;

		// Load search values
		// id

		$tbl_group->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		$tbl_group->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// name
		$tbl_group->name->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_name"]);
		$tbl_group->name->AdvancedSearch->SearchOperator = @$_GET["z_name"];

		// is_active
		$tbl_group->is_active->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_is_active"]);
		$tbl_group->is_active->AdvancedSearch->SearchOperator = @$_GET["z_is_active"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_group;
		$tbl_group->id->setFormValue($objForm->GetValue("x_id"));
		$tbl_group->name->setFormValue($objForm->GetValue("x_name"));
		$tbl_group->is_active->setFormValue($objForm->GetValue("x_is_active"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_group;
		$tbl_group->id->CurrentValue = $tbl_group->id->FormValue;
		$tbl_group->name->CurrentValue = $tbl_group->name->FormValue;
		$tbl_group->is_active->CurrentValue = $tbl_group->is_active->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_group;

		// Call Recordset Selecting event
		$tbl_group->Recordset_Selecting($tbl_group->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_group->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_group->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_group;
		$sFilter = $tbl_group->KeyFilter();

		// Call Row Selecting event
		$tbl_group->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_group->CurrentFilter = $sFilter;
		$sSql = $tbl_group->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_group->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_group;
		$tbl_group->id->setDbValue($rs->fields('id'));
		$tbl_group->name->setDbValue($rs->fields('name'));
		$tbl_group->is_active->setDbValue($rs->fields('is_active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_group;

		// Initialize URLs
		$this->ViewUrl = $tbl_group->ViewUrl();
		$this->EditUrl = $tbl_group->EditUrl();
		$this->InlineEditUrl = $tbl_group->InlineEditUrl();
		$this->CopyUrl = $tbl_group->CopyUrl();
		$this->InlineCopyUrl = $tbl_group->InlineCopyUrl();
		$this->DeleteUrl = $tbl_group->DeleteUrl();

		// Call Row_Rendering event
		$tbl_group->Row_Rendering();

		// Common render codes for all row types
		// id

		$tbl_group->id->CellCssStyle = ""; $tbl_group->id->CellCssClass = "";
		$tbl_group->id->CellAttrs = array(); $tbl_group->id->ViewAttrs = array(); $tbl_group->id->EditAttrs = array();

		// name
		$tbl_group->name->CellCssStyle = "white-space: nowrap;"; $tbl_group->name->CellCssClass = "";
		$tbl_group->name->CellAttrs = array(); $tbl_group->name->ViewAttrs = array(); $tbl_group->name->EditAttrs = array();

		// is_active
		$tbl_group->is_active->CellCssStyle = ""; $tbl_group->is_active->CellCssClass = "";
		$tbl_group->is_active->CellAttrs = array(); $tbl_group->is_active->ViewAttrs = array(); $tbl_group->is_active->EditAttrs = array();
		if ($tbl_group->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$tbl_group->id->ViewValue = $tbl_group->id->CurrentValue;
			$tbl_group->id->CssStyle = "";
			$tbl_group->id->CssClass = "";
			$tbl_group->id->ViewCustomAttributes = "";

			// name
			$tbl_group->name->ViewValue = $tbl_group->name->CurrentValue;
			$tbl_group->name->CssStyle = "";
			$tbl_group->name->CssClass = "";
			$tbl_group->name->ViewCustomAttributes = "";

			// is_active
			if (ew_ConvertToBool($tbl_group->is_active->CurrentValue)) {
				$tbl_group->is_active->ViewValue = "Yes";
			} else {
				$tbl_group->is_active->ViewValue = "No";
			}
			$tbl_group->is_active->CssStyle = "";
			$tbl_group->is_active->CssClass = "";
			$tbl_group->is_active->ViewCustomAttributes = "";

			// id
			$tbl_group->id->HrefValue = "";
			$tbl_group->id->TooltipValue = "";

			// name
			$tbl_group->name->HrefValue = "";
			$tbl_group->name->TooltipValue = "";
			if ($tbl_group->Export == "")
				$tbl_group->name->ViewValue = ew_Highlight($tbl_group->HighlightName(), $tbl_group->name->ViewValue, $tbl_group->getSessionBasicSearchKeyword(), $tbl_group->getSessionBasicSearchType(), $tbl_group->getAdvancedSearch("x_name"));

			// is_active
			$tbl_group->is_active->HrefValue = "";
			$tbl_group->is_active->TooltipValue = "";
		} elseif ($tbl_group->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// name

			$tbl_group->name->EditCustomAttributes = "";
			$tbl_group->name->EditValue = ew_HtmlEncode($tbl_group->name->CurrentValue);

			// is_active
			$tbl_group->is_active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Yes");
			$arwrk[] = array("0", "No");
			$tbl_group->is_active->EditValue = $arwrk;
		} elseif ($tbl_group->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$tbl_group->id->EditCustomAttributes = "";
			$tbl_group->id->EditValue = $tbl_group->id->CurrentValue;
			$tbl_group->id->CssStyle = "";
			$tbl_group->id->CssClass = "";
			$tbl_group->id->ViewCustomAttributes = "";

			// name
			$tbl_group->name->EditCustomAttributes = "";
			$tbl_group->name->EditValue = ew_HtmlEncode($tbl_group->name->CurrentValue);

			// is_active
			$tbl_group->is_active->EditCustomAttributes = "";
			$arwrk = array();
			$arwrk[] = array("1", "Yes");
			$arwrk[] = array("0", "No");
			$tbl_group->is_active->EditValue = $arwrk;

			// Edit refer script
			// id

			$tbl_group->id->HrefValue = "";

			// name
			$tbl_group->name->HrefValue = "";

			// is_active
			$tbl_group->is_active->HrefValue = "";
		}

		// Call Row Rendered event
		if ($tbl_group->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_group->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError, $tbl_group;

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
		global $Language, $gsFormError, $tbl_group;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_group->name->FormValue) && $tbl_group->name->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_group->name->FldCaption();
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
		global $conn, $Security, $Language, $tbl_group;
		$sFilter = $tbl_group->KeyFilter();
		$tbl_group->CurrentFilter = $sFilter;
		$sSql = $tbl_group->SQL();
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
			$tbl_group->name->SetDbValueDef($rsnew, $tbl_group->name->CurrentValue, "", FALSE);

			// is_active
			$tbl_group->is_active->SetDbValueDef($rsnew, ((strval($tbl_group->is_active->CurrentValue) == "1") ? "1" : "0"), 0, FALSE);

			// Call Row Updating event
			$bUpdateRow = $tbl_group->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_group->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_group->CancelMessage <> "") {
					$this->setMessage($tbl_group->CancelMessage);
					$tbl_group->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_group->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $tbl_group;
		$rsnew = array();

		// name
		$tbl_group->name->SetDbValueDef($rsnew, $tbl_group->name->CurrentValue, "", FALSE);

		// is_active
		$tbl_group->is_active->SetDbValueDef($rsnew, ((strval($tbl_group->is_active->CurrentValue) == "1") ? "1" : "0"), 0, TRUE);

		// Call Row Inserting event
		$bInsertRow = $tbl_group->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tbl_group->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tbl_group->CancelMessage <> "") {
				$this->setMessage($tbl_group->CancelMessage);
				$tbl_group->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$tbl_group->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $tbl_group->id->DbValue;

			// Call Row Inserted event
			$tbl_group->Row_Inserted($rsnew);
		}
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		global $tbl_group;
		$tbl_group->id->AdvancedSearch->SearchValue = $tbl_group->getAdvancedSearch("x_id");
		$tbl_group->name->AdvancedSearch->SearchValue = $tbl_group->getAdvancedSearch("x_name");
		$tbl_group->is_active->AdvancedSearch->SearchValue = $tbl_group->getAdvancedSearch("x_is_active");
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
