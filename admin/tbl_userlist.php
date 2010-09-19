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
$tbl_user_list = new ctbl_user_list();
$Page =& $tbl_user_list;

// Page init
$tbl_user_list->Page_Init();

// Page main
$tbl_user_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_user->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_user_list = new ew_Page("tbl_user_list");

// page properties
tbl_user_list.PageID = "list"; // page ID
tbl_user_list.FormID = "ftbl_userlist"; // form ID
var EW_PAGE_ID = tbl_user_list.PageID; // for backward compatibility

// extend page with ValidateForm function
tbl_user_list.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_username"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_user->username->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_username"];
		if (elm && !ew_CheckEmail(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($tbl_user->username->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_passwd"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_user->passwd->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_id_userlevel"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($tbl_user->id_userlevel->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
tbl_user_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_user_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_user_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_user_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_user_list.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_user_list.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<?php if ($tbl_user->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$tbl_user_list->lTotalRecs = $tbl_user->SelectRecordCount();
	} else {
		if ($rs = $tbl_user_list->LoadRecordset())
			$tbl_user_list->lTotalRecs = $rs->RecordCount();
	}
	$tbl_user_list->lStartRec = 1;
	if ($tbl_user_list->lDisplayRecs <= 0 || ($tbl_user->Export <> "" && $tbl_user->ExportAll)) // Display all records
		$tbl_user_list->lDisplayRecs = $tbl_user_list->lTotalRecs;
	if (!($tbl_user->Export <> "" && $tbl_user->ExportAll))
		$tbl_user_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $tbl_user_list->LoadRecordset($tbl_user_list->lStartRec-1, $tbl_user_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_user->TableCaption() ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($tbl_user->Export == "" && $tbl_user->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(tbl_user_list);" style="text-decoration: none;"><img id="tbl_user_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="tbl_user_list_SearchPanel">
<form name="ftbl_userlistsrch" id="ftbl_userlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="tbl_user">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($tbl_user->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $tbl_user_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
			<a href="tbl_usersrch.php"><?php echo $Language->Phrase("AdvancedSearch") ?></a>&nbsp;
			<?php if ($tbl_user_list->sSrchWhere <> "" && $tbl_user_list->lTotalRecs > 0) { ?>
			<a href="javascript:void(0);" onclick="ew_ToggleHighlight(tbl_user_list, this, '<?php echo $tbl_user->HighlightName() ?>');"><?php echo $Language->Phrase("HideHighlight") ?></a>
			<?php } ?>
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($tbl_user->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($tbl_user->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($tbl_user->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_user_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($tbl_user->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($tbl_user->CurrentAction <> "gridadd" && $tbl_user->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_user_list->Pager)) $tbl_user_list->Pager = new cPrevNextPager($tbl_user_list->lStartRec, $tbl_user_list->lDisplayRecs, $tbl_user_list->lTotalRecs) ?>
<?php if ($tbl_user_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_user_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_list->PageUrl() ?>start=<?php echo $tbl_user_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_user_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_list->PageUrl() ?>start=<?php echo $tbl_user_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_user_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_user_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_list->PageUrl() ?>start=<?php echo $tbl_user_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_user_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_list->PageUrl() ?>start=<?php echo $tbl_user_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_user_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_user_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_user_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_user_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_user_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($tbl_user_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tbl_user">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="15"<?php if ($tbl_user_list->lDisplayRecs == 15) { ?> selected="selected"<?php } ?>>15</option>
<option value="30"<?php if ($tbl_user_list->lDisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="75"<?php if ($tbl_user_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($tbl_user_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($tbl_user->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_user_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $tbl_user_list->InlineAddUrl ?>"><?php echo $Language->Phrase("InlineAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($tbl_user_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftbl_userlist, '<?php echo $tbl_user_list->MultiDeleteUrl ?>', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="ftbl_userlist" id="ftbl_userlist" class="ewForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="tbl_user">
<div id="gmp_tbl_user" class="ewGridMiddlePanel">
<?php if ($tbl_user_list->lTotalRecs > 0 || $tbl_user->CurrentAction == "add" || $tbl_user->CurrentAction == "copy") { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $tbl_user->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$tbl_user_list->RenderListOptions();

// Render list options (header, left)
$tbl_user_list->ListOptions->Render("header", "left");
?>
<?php if ($tbl_user->id_user->Visible) { // id_user ?>
	<?php if ($tbl_user->SortUrl($tbl_user->id_user) == "") { ?>
		<td><?php echo $tbl_user->id_user->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_user->SortUrl($tbl_user->id_user) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_user->id_user->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_user->id_user->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_user->id_user->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_user->username->Visible) { // username ?>
	<?php if ($tbl_user->SortUrl($tbl_user->username) == "") { ?>
		<td><?php echo $tbl_user->username->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_user->SortUrl($tbl_user->username) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_user->username->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_user->username->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_user->username->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_user->passwd->Visible) { // passwd ?>
	<?php if ($tbl_user->SortUrl($tbl_user->passwd) == "") { ?>
		<td><?php echo $tbl_user->passwd->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_user->SortUrl($tbl_user->passwd) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_user->passwd->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_user->passwd->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_user->passwd->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_user->id_userlevel->Visible) { // id_userlevel ?>
	<?php if ($tbl_user->SortUrl($tbl_user->id_userlevel) == "") { ?>
		<td><?php echo $tbl_user->id_userlevel->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_user->SortUrl($tbl_user->id_userlevel) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_user->id_userlevel->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_user->id_userlevel->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_user->id_userlevel->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$tbl_user_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
	if ($tbl_user->CurrentAction == "add" || $tbl_user->CurrentAction == "copy") {
		$tbl_user_list->lRowIndex = 1;
		if ($tbl_user->CurrentAction == "add")
			$tbl_user_list->LoadDefaultValues();
		if ($tbl_user->EventCancelled) // Insert failed
			$tbl_user_list->RestoreFormValues(); // Restore form values

		// Set row properties
		$tbl_user->CssClass = "ewTableEditRow";
		$tbl_user->CssStyle = "";
		$tbl_user->RowAttrs = array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		$tbl_user->RowType = EW_ROWTYPE_ADD;

		// Render row
		$tbl_user_list->RenderRow();

		// Render list options
		$tbl_user_list->RenderListOptions();
?>
	<tr<?php echo $tbl_user->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_user_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_user->id_user->Visible) { // id_user ?>
		<td>&nbsp;</td>
	<?php } ?>
	<?php if ($tbl_user->username->Visible) { // username ?>
		<td>
<input type="text" name="x<?php echo $tbl_user_list->lRowIndex ?>_username" id="x<?php echo $tbl_user_list->lRowIndex ?>_username" title="<?php echo $tbl_user->username->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $tbl_user->username->EditValue ?>"<?php echo $tbl_user->username->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_user->passwd->Visible) { // passwd ?>
		<td>
<input type="text" name="x<?php echo $tbl_user_list->lRowIndex ?>_passwd" id="x<?php echo $tbl_user_list->lRowIndex ?>_passwd" title="<?php echo $tbl_user->passwd->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_user->passwd->EditValue ?>"<?php echo $tbl_user->passwd->EditAttributes() ?>>
</td>
	<?php } ?>
	<?php if ($tbl_user->id_userlevel->Visible) { // id_userlevel ?>
		<td>
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<div<?php echo $tbl_user->id_userlevel->ViewAttributes() ?>><?php echo $tbl_user->id_userlevel->EditValue ?></div>
<?php } else { ?>
<select id="x<?php echo $tbl_user_list->lRowIndex ?>_id_userlevel" name="x<?php echo $tbl_user_list->lRowIndex ?>_id_userlevel" title="<?php echo $tbl_user->id_userlevel->FldTitle() ?>"<?php echo $tbl_user->id_userlevel->EditAttributes() ?>>
<?php
if (is_array($tbl_user->id_userlevel->EditValue)) {
	$arwrk = $tbl_user->id_userlevel->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_user->id_userlevel->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_user_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
}
?>
<?php
if ($tbl_user->ExportAll && $tbl_user->Export <> "") {
	$tbl_user_list->lStopRec = $tbl_user_list->lTotalRecs;
} else {
	$tbl_user_list->lStopRec = $tbl_user_list->lStartRec + $tbl_user_list->lDisplayRecs - 1; // Set the last record to display
}
$tbl_user_list->lRecCount = $tbl_user_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $tbl_user_list->lStartRec > 1)
		$rs->Move($tbl_user_list->lStartRec - 1);
}

// Initialize aggregate
$tbl_user->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tbl_user_list->RenderRow();
$tbl_user_list->lRowCnt = 0;
$tbl_user_list->lEditRowCnt = 0;
if ($tbl_user->CurrentAction == "edit")
	$tbl_user_list->lRowIndex = 1;
while (($tbl_user->CurrentAction == "gridadd" || !$rs->EOF) &&
	$tbl_user_list->lRecCount < $tbl_user_list->lStopRec) {
	$tbl_user_list->lRecCount++;
	if (intval($tbl_user_list->lRecCount) >= intval($tbl_user_list->lStartRec)) {
		$tbl_user_list->lRowCnt++;

	// Init row class and style
	$tbl_user->CssClass = "";
	$tbl_user->CssStyle = "";
	$tbl_user->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($tbl_user->CurrentAction == "gridadd") {
		$tbl_user_list->LoadDefaultValues(); // Load default values
	} else {
		$tbl_user_list->LoadRowValues($rs); // Load row values
	}
	$tbl_user->RowType = EW_ROWTYPE_VIEW; // Render view
	if ($tbl_user->CurrentAction == "edit") {
		if ($tbl_user_list->CheckInlineEditKey() && $tbl_user_list->lEditRowCnt == 0) { // Inline edit
			$tbl_user->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
	}
	if ($tbl_user->RowType == EW_ROWTYPE_EDIT && $tbl_user->EventCancelled) { // Update failed
		if ($tbl_user->CurrentAction == "edit")
			$tbl_user_list->RestoreFormValues(); // Restore form values
	}
	if ($tbl_user->RowType == EW_ROWTYPE_EDIT) // Edit row
		$tbl_user_list->lEditRowCnt++;
	if ($tbl_user->RowType == EW_ROWTYPE_ADD || $tbl_user->RowType == EW_ROWTYPE_EDIT) { // Add / Edit row
		$tbl_user->RowAttrs = array_merge($tbl_user->RowAttrs, array('onmouseover'=>'this.edit=true;ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);'));
		$tbl_user->CssClass = "ewTableEditRow";
	}

	// Render row
	$tbl_user_list->RenderRow();

	// Render list options
	$tbl_user_list->RenderListOptions();
?>
	<tr<?php echo $tbl_user->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_user_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_user->id_user->Visible) { // id_user ?>
		<td<?php echo $tbl_user->id_user->CellAttributes() ?>>
<?php if ($tbl_user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<div<?php echo $tbl_user->id_user->ViewAttributes() ?>><?php echo $tbl_user->id_user->EditValue ?></div><input type="hidden" name="x<?php echo $tbl_user_list->lRowIndex ?>_id_user" id="x<?php echo $tbl_user_list->lRowIndex ?>_id_user" value="<?php echo ew_HtmlEncode($tbl_user->id_user->CurrentValue) ?>">
<?php } ?>
<?php if ($tbl_user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_user->id_user->ViewAttributes() ?>><?php echo $tbl_user->id_user->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_user->username->Visible) { // username ?>
		<td<?php echo $tbl_user->username->CellAttributes() ?>>
<?php if ($tbl_user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_user_list->lRowIndex ?>_username" id="x<?php echo $tbl_user_list->lRowIndex ?>_username" title="<?php echo $tbl_user->username->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $tbl_user->username->EditValue ?>"<?php echo $tbl_user->username->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_user->username->ViewAttributes() ?>><?php echo $tbl_user->username->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_user->passwd->Visible) { // passwd ?>
		<td<?php echo $tbl_user->passwd->CellAttributes() ?>>
<?php if ($tbl_user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<input type="text" name="x<?php echo $tbl_user_list->lRowIndex ?>_passwd" id="x<?php echo $tbl_user_list->lRowIndex ?>_passwd" title="<?php echo $tbl_user->passwd->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $tbl_user->passwd->EditValue ?>"<?php echo $tbl_user->passwd->EditAttributes() ?>>
<?php } ?>
<?php if ($tbl_user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_user->passwd->ViewAttributes() ?>><?php echo $tbl_user->passwd->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($tbl_user->id_userlevel->Visible) { // id_userlevel ?>
		<td<?php echo $tbl_user->id_userlevel->CellAttributes() ?>>
<?php if ($tbl_user->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<div<?php echo $tbl_user->id_userlevel->ViewAttributes() ?>><?php echo $tbl_user->id_userlevel->EditValue ?></div>
<?php } else { ?>
<select id="x<?php echo $tbl_user_list->lRowIndex ?>_id_userlevel" name="x<?php echo $tbl_user_list->lRowIndex ?>_id_userlevel" title="<?php echo $tbl_user->id_userlevel->FldTitle() ?>"<?php echo $tbl_user->id_userlevel->EditAttributes() ?>>
<?php
if (is_array($tbl_user->id_userlevel->EditValue)) {
	$arwrk = $tbl_user->id_userlevel->EditValue;
	$rowswrk = count($arwrk);
	$emptywrk = TRUE;
	for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
		$selwrk = (strval($tbl_user->id_userlevel->CurrentValue) == strval($arwrk[$rowcntwrk][0])) ? " selected=\"selected\"" : "";
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
<?php } ?>
<?php if ($tbl_user->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<div<?php echo $tbl_user->id_userlevel->ViewAttributes() ?>><?php echo $tbl_user->id_userlevel->ListViewValue() ?></div>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_user_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php if ($tbl_user->RowType == EW_ROWTYPE_EDIT) { ?>
<?php } ?>
<?php
	}
	if ($tbl_user->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($tbl_user->CurrentAction == "add" || $tbl_user->CurrentAction == "copy") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $tbl_user_list->lRowIndex ?>">
<?php } ?>
<?php if ($tbl_user->CurrentAction == "edit") { ?>
<input type="hidden" name="key_count" id="key_count" value="<?php echo $tbl_user_list->lRowIndex ?>">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($tbl_user_list->lTotalRecs > 0) { ?>
<?php if ($tbl_user->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($tbl_user->CurrentAction <> "gridadd" && $tbl_user->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_user_list->Pager)) $tbl_user_list->Pager = new cPrevNextPager($tbl_user_list->lStartRec, $tbl_user_list->lDisplayRecs, $tbl_user_list->lTotalRecs) ?>
<?php if ($tbl_user_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_user_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_list->PageUrl() ?>start=<?php echo $tbl_user_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_user_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_list->PageUrl() ?>start=<?php echo $tbl_user_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_user_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_user_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_list->PageUrl() ?>start=<?php echo $tbl_user_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_user_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_list->PageUrl() ?>start=<?php echo $tbl_user_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_user_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_user_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_user_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_user_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_user_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($tbl_user_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tbl_user">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="15"<?php if ($tbl_user_list->lDisplayRecs == 15) { ?> selected="selected"<?php } ?>>15</option>
<option value="30"<?php if ($tbl_user_list->lDisplayRecs == 30) { ?> selected="selected"<?php } ?>>30</option>
<option value="75"<?php if ($tbl_user_list->lDisplayRecs == 75) { ?> selected="selected"<?php } ?>>75</option>
<option value="100"<?php if ($tbl_user_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($tbl_user->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($tbl_user_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_user_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<a href="<?php echo $tbl_user_list->InlineAddUrl ?>"><?php echo $Language->Phrase("InlineAddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($tbl_user_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftbl_userlist, '<?php echo $tbl_user_list->MultiDeleteUrl ?>', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($tbl_user->Export == "" && $tbl_user->CurrentAction == "") { ?>
<?php } ?>
<?php if ($tbl_user->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_user_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_user_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'tbl_user';

	// Page object name
	var $PageObjName = 'tbl_user_list';

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
	function ctbl_user_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_user)
		$GLOBALS["tbl_user"] = new ctbl_user();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["tbl_user"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tbl_userdelete.php";
		$this->MultiUpdateUrl = "tbl_userupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_user', TRUE);

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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Create form object
		$objForm = new cFormObj();

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$tbl_user->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$tbl_user->Export = $_POST["exporttype"];
		} else {
			$tbl_user->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $tbl_user->Export; // Get export parameter, used in header
		$gsExportFile = $tbl_user->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $tbl_user;

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
				$tbl_user->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($tbl_user->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($tbl_user->CurrentAction == "edit")
					$this->InlineEditMode();

				// Switch to inline add mode
				if ($tbl_user->CurrentAction == "add" || $tbl_user->CurrentAction == "copy")
					$this->InlineAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$tbl_user->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if (($tbl_user->CurrentAction == "update" || $tbl_user->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();

					// Insert Inline
					if ($tbl_user->CurrentAction == "insert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "add")
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
			$tbl_user->Recordset_SearchValidated();

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
		if ($tbl_user->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $tbl_user->getRecordsPerPage(); // Restore from Session
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
		$tbl_user->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			if ($sSrchAdvanced == "")
				$this->ResetAdvancedSearchParms();
			$tbl_user->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$tbl_user->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $tbl_user->getSearchWhere();
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
		$tbl_user->setSessionWhere($sFilter);
		$tbl_user->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $tbl_user;
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
			$tbl_user->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$tbl_user->setStartRecordNumber($this->lStartRec);
		}
	}

	//  Exit inline mode
	function ClearInlineMode() {
		global $tbl_user;
		$tbl_user->setKey("id_user", ""); // Clear inline edit key
		$tbl_user->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $tbl_user;
		if (!$Security->CanEdit())
			$this->Page_Terminate("login.php"); // Go to login page
		$bInlineEdit = TRUE;
		if (@$_GET["id_user"] <> "") {
			$tbl_user->id_user->setQueryStringValue($_GET["id_user"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$tbl_user->setKey("id_user", $tbl_user->id_user->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError, $tbl_user;
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
				$tbl_user->SendEmail = TRUE; // Send email on update success
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
			$tbl_user->EventCancelled = TRUE; // Cancel event
			$tbl_user->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {
		global $tbl_user;

		//CheckInlineEditKey = True
		if (strval($tbl_user->getKey("id_user")) <> strval($tbl_user->id_user->CurrentValue))
			return FALSE;
		return TRUE;
	}

	// Switch to Inline Add mode
	function InlineAddMode() {
		global $Security, $tbl_user;
		if (!$Security->CanAdd())
			$this->Page_Terminate("login.php"); // Return to login page
		$tbl_user->CurrentAction = "add";
		$_SESSION[EW_SESSION_INLINE_MODE] = "add"; // Enable inline add
	}

	// Perform update to Inline Add/Copy record
	function InlineInsert() {
		global $Language, $objForm, $gsFormError, $tbl_user;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate form
		if (!$this->ValidateForm()) {
			$this->setMessage($gsFormError); // Set validation error message
			$tbl_user->EventCancelled = TRUE; // Set event cancelled
			$tbl_user->CurrentAction = "add"; // Stay in add mode
			return;
		}
		$tbl_user->SendEmail = TRUE; // Send email on add success
		if ($this->AddRow()) { // Add record
			$this->setMessage($Language->Phrase("AddSuccess")); // Set add success message
			$this->ClearInlineMode(); // Clear inline add mode
		} else { // Add failed
			$tbl_user->EventCancelled = TRUE; // Set event cancelled
			$tbl_user->CurrentAction = "add"; // Stay in add mode
		}
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere() {
		global $Security, $tbl_user;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $tbl_user->id_user, FALSE); // id_user
		$this->BuildSearchSql($sWhere, $tbl_user->username, FALSE); // username
		$this->BuildSearchSql($sWhere, $tbl_user->passwd, FALSE); // passwd
		$this->BuildSearchSql($sWhere, $tbl_user->id_userlevel, FALSE); // id_userlevel

		// Set up search parm
		if ($sWhere <> "") {
			$this->SetSearchParm($tbl_user->id_user); // id_user
			$this->SetSearchParm($tbl_user->username); // username
			$this->SetSearchParm($tbl_user->passwd); // passwd
			$this->SetSearchParm($tbl_user->id_userlevel); // id_userlevel
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
		global $tbl_user;
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$tbl_user->setAdvancedSearch("x_$FldParm", $FldVal);
		$tbl_user->setAdvancedSearch("z_$FldParm", $Fld->AdvancedSearch->SearchOperator); // @$_GET["z_$FldParm"]
		$tbl_user->setAdvancedSearch("v_$FldParm", $Fld->AdvancedSearch->SearchCondition); // @$_GET["v_$FldParm"]
		$tbl_user->setAdvancedSearch("y_$FldParm", $FldVal2);
		$tbl_user->setAdvancedSearch("w_$FldParm", $Fld->AdvancedSearch->SearchOperator2); // @$_GET["w_$FldParm"]
	}

	// Get search parameters
	function GetSearchParm(&$Fld) {
		global $tbl_user;
		$FldParm = substr($Fld->FldVar, 2);
		$Fld->AdvancedSearch->SearchValue = $tbl_user->GetAdvancedSearch("x_$FldParm");
		$Fld->AdvancedSearch->SearchOperator = $tbl_user->GetAdvancedSearch("z_$FldParm");
		$Fld->AdvancedSearch->SearchCondition = $tbl_user->GetAdvancedSearch("v_$FldParm");
		$Fld->AdvancedSearch->SearchValue2 = $tbl_user->GetAdvancedSearch("y_$FldParm");
		$Fld->AdvancedSearch->SearchOperator2 = $tbl_user->GetAdvancedSearch("w_$FldParm");
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
		global $tbl_user;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $tbl_user->username, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $tbl_user->passwd, $Keyword);
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
		global $Security, $tbl_user;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $tbl_user->BasicSearchKeyword;
		$sSearchType = $tbl_user->BasicSearchType;
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
			$tbl_user->setSessionBasicSearchKeyword($sSearchKeyword);
			$tbl_user->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $tbl_user;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$tbl_user->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $tbl_user;
		$tbl_user->setSessionBasicSearchKeyword("");
		$tbl_user->setSessionBasicSearchType("");
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		global $tbl_user;
		$tbl_user->setAdvancedSearch("x_id_user", "");
		$tbl_user->setAdvancedSearch("x_username", "");
		$tbl_user->setAdvancedSearch("x_passwd", "");
		$tbl_user->setAdvancedSearch("x_id_userlevel", "");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $tbl_user;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		if (@$_GET["x_id_user"] <> "") $bRestore = FALSE;
		if (@$_GET["x_username"] <> "") $bRestore = FALSE;
		if (@$_GET["x_passwd"] <> "") $bRestore = FALSE;
		if (@$_GET["x_id_userlevel"] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$tbl_user->BasicSearchKeyword = $tbl_user->getSessionBasicSearchKeyword();
			$tbl_user->BasicSearchType = $tbl_user->getSessionBasicSearchType();

			// Restore advanced search values
			$this->GetSearchParm($tbl_user->id_user);
			$this->GetSearchParm($tbl_user->username);
			$this->GetSearchParm($tbl_user->passwd);
			$this->GetSearchParm($tbl_user->id_userlevel);
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $tbl_user;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$tbl_user->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$tbl_user->CurrentOrderType = @$_GET["ordertype"];
			$tbl_user->UpdateSort($tbl_user->id_user); // id_user
			$tbl_user->UpdateSort($tbl_user->username); // username
			$tbl_user->UpdateSort($tbl_user->passwd); // passwd
			$tbl_user->UpdateSort($tbl_user->id_userlevel); // id_userlevel
			$tbl_user->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $tbl_user;
		$sOrderBy = $tbl_user->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($tbl_user->SqlOrderBy() <> "") {
				$sOrderBy = $tbl_user->SqlOrderBy();
				$tbl_user->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $tbl_user;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$tbl_user->setSessionOrderBy($sOrderBy);
				$tbl_user->id_user->setSort("");
				$tbl_user->username->setSort("");
				$tbl_user->passwd->setSort("");
				$tbl_user->id_userlevel->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$tbl_user->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $tbl_user;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"tbl_user_list.SelectAllKey(this);\">";
		$this->ListOptions->MoveItem("checkbox", 0); // Move to first column

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($tbl_user->Export <> "" ||
			$tbl_user->CurrentAction == "gridadd" ||
			$tbl_user->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $tbl_user;
		$this->ListOptions->LoadDefault();

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if (($tbl_user->CurrentAction == "add" || $tbl_user->CurrentAction == "copy") &&
			$tbl_user->RowType == EW_ROWTYPE_ADD) { // Inline Add/Copy
			$this->ListOptions->CustomItem = "copy"; // Show copy column only
			$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
				"<a href=\"\" onclick=\"f=document.ftbl_userlist;if(tbl_user_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("InsertLink") . "</a>&nbsp;" .
				"<a href=\"" . $this->PageUrl() . "a=cancel\">" . $Language->Phrase("CancelLink") . "</a>" .
				"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"insert\"></div>";
			return;
		}

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($tbl_user->CurrentAction == "edit" && $tbl_user->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a name=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\" id=\"" . $this->PageObjName . "_row_" . $this->lRowCnt . "\"></a>" .
					"<a href=\"\" onclick=\"f=document.ftbl_userlist;if(tbl_user_list.ValidateForm(f))f.submit();return false;\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
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
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($tbl_user->id_user->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $tbl_user;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_user;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_user->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_user->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_user->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_user->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_user->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_user->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load default values
	function LoadDefaultValues() {
		global $tbl_user;
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $tbl_user;
		$tbl_user->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$tbl_user->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	//  Load search values for validation
	function LoadSearchValues() {
		global $objForm, $tbl_user;

		// Load search values
		// id_user

		$tbl_user->id_user->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id_user"]);
		$tbl_user->id_user->AdvancedSearch->SearchOperator = @$_GET["z_id_user"];

		// username
		$tbl_user->username->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_username"]);
		$tbl_user->username->AdvancedSearch->SearchOperator = @$_GET["z_username"];

		// passwd
		$tbl_user->passwd->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_passwd"]);
		$tbl_user->passwd->AdvancedSearch->SearchOperator = @$_GET["z_passwd"];

		// id_userlevel
		$tbl_user->id_userlevel->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id_userlevel"]);
		$tbl_user->id_userlevel->AdvancedSearch->SearchOperator = @$_GET["z_id_userlevel"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $tbl_user;
		$tbl_user->id_user->setFormValue($objForm->GetValue("x_id_user"));
		$tbl_user->username->setFormValue($objForm->GetValue("x_username"));
		$tbl_user->passwd->setFormValue($objForm->GetValue("x_passwd"));
		$tbl_user->id_userlevel->setFormValue($objForm->GetValue("x_id_userlevel"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $tbl_user;
		$tbl_user->id_user->CurrentValue = $tbl_user->id_user->FormValue;
		$tbl_user->username->CurrentValue = $tbl_user->username->FormValue;
		$tbl_user->passwd->CurrentValue = $tbl_user->passwd->FormValue;
		$tbl_user->id_userlevel->CurrentValue = $tbl_user->id_userlevel->FormValue;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_user;

		// Call Recordset Selecting event
		$tbl_user->Recordset_Selecting($tbl_user->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_user->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_user->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_user;
		$sFilter = $tbl_user->KeyFilter();

		// Call Row Selecting event
		$tbl_user->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_user->CurrentFilter = $sFilter;
		$sSql = $tbl_user->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_user->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_user;
		$tbl_user->id_user->setDbValue($rs->fields('id_user'));
		$tbl_user->username->setDbValue($rs->fields('username'));
		$tbl_user->passwd->setDbValue($rs->fields('passwd'));
		$tbl_user->id_userlevel->setDbValue($rs->fields('id_userlevel'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_user;

		// Initialize URLs
		$this->ViewUrl = $tbl_user->ViewUrl();
		$this->EditUrl = $tbl_user->EditUrl();
		$this->InlineEditUrl = $tbl_user->InlineEditUrl();
		$this->CopyUrl = $tbl_user->CopyUrl();
		$this->InlineCopyUrl = $tbl_user->InlineCopyUrl();
		$this->DeleteUrl = $tbl_user->DeleteUrl();

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
			if ($tbl_user->Export == "")
				$tbl_user->username->ViewValue = ew_Highlight($tbl_user->HighlightName(), $tbl_user->username->ViewValue, $tbl_user->getSessionBasicSearchKeyword(), $tbl_user->getSessionBasicSearchType(), $tbl_user->getAdvancedSearch("x_username"));

			// passwd
			$tbl_user->passwd->HrefValue = "";
			$tbl_user->passwd->TooltipValue = "";
			if ($tbl_user->Export == "")
				$tbl_user->passwd->ViewValue = ew_Highlight($tbl_user->HighlightName(), $tbl_user->passwd->ViewValue, $tbl_user->getSessionBasicSearchKeyword(), $tbl_user->getSessionBasicSearchType(), $tbl_user->getAdvancedSearch("x_passwd"));

			// id_userlevel
			$tbl_user->id_userlevel->HrefValue = "";
			$tbl_user->id_userlevel->TooltipValue = "";
		} elseif ($tbl_user->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_user
			// username

			$tbl_user->username->EditCustomAttributes = "";
			$tbl_user->username->EditValue = ew_HtmlEncode($tbl_user->username->CurrentValue);

			// passwd
			$tbl_user->passwd->EditCustomAttributes = "";
			$tbl_user->passwd->EditValue = ew_HtmlEncode($tbl_user->passwd->CurrentValue);

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
		} elseif ($tbl_user->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_user
			$tbl_user->id_user->EditCustomAttributes = "";
			$tbl_user->id_user->EditValue = $tbl_user->id_user->CurrentValue;
			$tbl_user->id_user->CssStyle = "";
			$tbl_user->id_user->CssClass = "";
			$tbl_user->id_user->ViewCustomAttributes = "";

			// username
			$tbl_user->username->EditCustomAttributes = "";
			$tbl_user->username->EditValue = ew_HtmlEncode($tbl_user->username->CurrentValue);

			// passwd
			$tbl_user->passwd->EditCustomAttributes = "";
			$tbl_user->passwd->EditValue = ew_HtmlEncode($tbl_user->passwd->CurrentValue);

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

			// Edit refer script
			// id_user

			$tbl_user->id_user->HrefValue = "";

			// username
			$tbl_user->username->HrefValue = "";

			// passwd
			$tbl_user->passwd->HrefValue = "";

			// id_userlevel
			$tbl_user->id_userlevel->HrefValue = "";
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
		global $Language, $gsFormError, $tbl_user;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($tbl_user->username->FormValue) && $tbl_user->username->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_user->username->FldCaption();
		}
		if (!ew_CheckEmail($tbl_user->username->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $tbl_user->username->FldErrMsg();
		}
		if (!is_null($tbl_user->passwd->FormValue) && $tbl_user->passwd->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_user->passwd->FldCaption();
		}
		if (!is_null($tbl_user->id_userlevel->FormValue) && $tbl_user->id_userlevel->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $tbl_user->id_userlevel->FldCaption();
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
		global $conn, $Security, $Language, $tbl_user;
		$sFilter = $tbl_user->KeyFilter();
		$tbl_user->CurrentFilter = $sFilter;
		$sSql = $tbl_user->SQL();
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

			// username
			$tbl_user->username->SetDbValueDef($rsnew, $tbl_user->username->CurrentValue, "", FALSE);

			// passwd
						if ($rs->fields('passwd') <> $tbl_user->passwd->CurrentValue) {
			$tbl_user->passwd->SetDbValueDef($rsnew, $tbl_user->passwd->CurrentValue, "", FALSE);
			}

			// id_userlevel
						if ($Security->CanAdmin()) { // System admin
			$tbl_user->id_userlevel->SetDbValueDef($rsnew, $tbl_user->id_userlevel->CurrentValue, 0, FALSE);
			}

			// Call Row Updating event
			$bUpdateRow = $tbl_user->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($tbl_user->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($tbl_user->CancelMessage <> "") {
					$this->setMessage($tbl_user->CancelMessage);
					$tbl_user->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$tbl_user->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $tbl_user;
		$rsnew = array();

		// username
		$tbl_user->username->SetDbValueDef($rsnew, $tbl_user->username->CurrentValue, "", FALSE);

		// passwd
		$tbl_user->passwd->SetDbValueDef($rsnew, $tbl_user->passwd->CurrentValue, "", FALSE);

		// id_userlevel
				if ($Security->CanAdmin()) { // System admin
		$tbl_user->id_userlevel->SetDbValueDef($rsnew, $tbl_user->id_userlevel->CurrentValue, 0, FALSE);
		}

		// Call Row Inserting event
		$bInsertRow = $tbl_user->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($tbl_user->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($tbl_user->CancelMessage <> "") {
				$this->setMessage($tbl_user->CancelMessage);
				$tbl_user->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$tbl_user->id_user->setDbValue($conn->Insert_ID());
			$rsnew['id_user'] = $tbl_user->id_user->DbValue;

			// Call Row Inserted event
			$tbl_user->Row_Inserted($rsnew);
		}
		return $AddRow;
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
