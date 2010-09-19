<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_user_level_permissionsinfo.php" ?>
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
$tbl_user_level_permissions_list = new ctbl_user_level_permissions_list();
$Page =& $tbl_user_level_permissions_list;

// Page init
$tbl_user_level_permissions_list->Page_Init();

// Page main
$tbl_user_level_permissions_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_user_level_permissions->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_user_level_permissions_list = new ew_Page("tbl_user_level_permissions_list");

// page properties
tbl_user_level_permissions_list.PageID = "list"; // page ID
tbl_user_level_permissions_list.FormID = "ftbl_user_level_permissionslist"; // form ID
var EW_PAGE_ID = tbl_user_level_permissions_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_user_level_permissions_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_user_level_permissions_list.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_user_level_permissions_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_user_level_permissions_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

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
<?php if ($tbl_user_level_permissions->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$tbl_user_level_permissions_list->lTotalRecs = $tbl_user_level_permissions->SelectRecordCount();
	} else {
		if ($rs = $tbl_user_level_permissions_list->LoadRecordset())
			$tbl_user_level_permissions_list->lTotalRecs = $rs->RecordCount();
	}
	$tbl_user_level_permissions_list->lStartRec = 1;
	if ($tbl_user_level_permissions_list->lDisplayRecs <= 0 || ($tbl_user_level_permissions->Export <> "" && $tbl_user_level_permissions->ExportAll)) // Display all records
		$tbl_user_level_permissions_list->lDisplayRecs = $tbl_user_level_permissions_list->lTotalRecs;
	if (!($tbl_user_level_permissions->Export <> "" && $tbl_user_level_permissions->ExportAll))
		$tbl_user_level_permissions_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $tbl_user_level_permissions_list->LoadRecordset($tbl_user_level_permissions_list->lStartRec-1, $tbl_user_level_permissions_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_user_level_permissions->TableCaption() ?>
</span></p>
<?php if ($Security->CanSearch()) { ?>
<?php if ($tbl_user_level_permissions->Export == "" && $tbl_user_level_permissions->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(tbl_user_level_permissions_list);" style="text-decoration: none;"><img id="tbl_user_level_permissions_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="tbl_user_level_permissions_list_SearchPanel">
<form name="ftbl_user_level_permissionslistsrch" id="ftbl_user_level_permissionslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="tbl_user_level_permissions">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($tbl_user_level_permissions->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $tbl_user_level_permissions_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($tbl_user_level_permissions->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($tbl_user_level_permissions->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($tbl_user_level_permissions->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_user_level_permissions_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<?php if ($tbl_user_level_permissions->Export == "") { ?>
<div class="ewGridUpperPanel">
<?php if ($tbl_user_level_permissions->CurrentAction <> "gridadd" && $tbl_user_level_permissions->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_user_level_permissions_list->Pager)) $tbl_user_level_permissions_list->Pager = new cPrevNextPager($tbl_user_level_permissions_list->lStartRec, $tbl_user_level_permissions_list->lDisplayRecs, $tbl_user_level_permissions_list->lTotalRecs) ?>
<?php if ($tbl_user_level_permissions_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_user_level_permissions_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_level_permissions_list->PageUrl() ?>start=<?php echo $tbl_user_level_permissions_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_user_level_permissions_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_level_permissions_list->PageUrl() ?>start=<?php echo $tbl_user_level_permissions_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_user_level_permissions_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_user_level_permissions_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_level_permissions_list->PageUrl() ?>start=<?php echo $tbl_user_level_permissions_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_user_level_permissions_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_level_permissions_list->PageUrl() ?>start=<?php echo $tbl_user_level_permissions_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_user_level_permissions_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_user_level_permissions_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_user_level_permissions_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_user_level_permissions_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_user_level_permissions_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($tbl_user_level_permissions_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tbl_user_level_permissions">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($tbl_user_level_permissions_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($tbl_user_level_permissions_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($tbl_user_level_permissions_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($tbl_user_level_permissions->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_user_level_permissions_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($tbl_user_level_permissions_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftbl_user_level_permissionslist, '<?php echo $tbl_user_level_permissions_list->MultiDeleteUrl ?>', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
</div>
<?php } ?>
<form name="ftbl_user_level_permissionslist" id="ftbl_user_level_permissionslist" class="ewForm" action="" method="post">
<div id="gmp_tbl_user_level_permissions" class="ewGridMiddlePanel">
<?php if ($tbl_user_level_permissions_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $tbl_user_level_permissions->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$tbl_user_level_permissions_list->RenderListOptions();

// Render list options (header, left)
$tbl_user_level_permissions_list->ListOptions->Render("header", "left");
?>
<?php if ($tbl_user_level_permissions->userlevelid->Visible) { // userlevelid ?>
	<?php if ($tbl_user_level_permissions->SortUrl($tbl_user_level_permissions->userlevelid) == "") { ?>
		<td><?php echo $tbl_user_level_permissions->userlevelid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_user_level_permissions->SortUrl($tbl_user_level_permissions->userlevelid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_user_level_permissions->userlevelid->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_user_level_permissions->userlevelid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_user_level_permissions->userlevelid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_user_level_permissions->ztablename->Visible) { // tablename ?>
	<?php if ($tbl_user_level_permissions->SortUrl($tbl_user_level_permissions->ztablename) == "") { ?>
		<td><?php echo $tbl_user_level_permissions->ztablename->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_user_level_permissions->SortUrl($tbl_user_level_permissions->ztablename) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_user_level_permissions->ztablename->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($tbl_user_level_permissions->ztablename->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_user_level_permissions->ztablename->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($tbl_user_level_permissions->permission->Visible) { // permission ?>
	<?php if ($tbl_user_level_permissions->SortUrl($tbl_user_level_permissions->permission) == "") { ?>
		<td><?php echo $tbl_user_level_permissions->permission->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $tbl_user_level_permissions->SortUrl($tbl_user_level_permissions->permission) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $tbl_user_level_permissions->permission->FldCaption() ?></td><td style="width: 10px;"><?php if ($tbl_user_level_permissions->permission->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($tbl_user_level_permissions->permission->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$tbl_user_level_permissions_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($tbl_user_level_permissions->ExportAll && $tbl_user_level_permissions->Export <> "") {
	$tbl_user_level_permissions_list->lStopRec = $tbl_user_level_permissions_list->lTotalRecs;
} else {
	$tbl_user_level_permissions_list->lStopRec = $tbl_user_level_permissions_list->lStartRec + $tbl_user_level_permissions_list->lDisplayRecs - 1; // Set the last record to display
}
$tbl_user_level_permissions_list->lRecCount = $tbl_user_level_permissions_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $tbl_user_level_permissions_list->lStartRec > 1)
		$rs->Move($tbl_user_level_permissions_list->lStartRec - 1);
}

// Initialize aggregate
$tbl_user_level_permissions->RowType = EW_ROWTYPE_AGGREGATEINIT;
$tbl_user_level_permissions_list->RenderRow();
$tbl_user_level_permissions_list->lRowCnt = 0;
while (($tbl_user_level_permissions->CurrentAction == "gridadd" || !$rs->EOF) &&
	$tbl_user_level_permissions_list->lRecCount < $tbl_user_level_permissions_list->lStopRec) {
	$tbl_user_level_permissions_list->lRecCount++;
	if (intval($tbl_user_level_permissions_list->lRecCount) >= intval($tbl_user_level_permissions_list->lStartRec)) {
		$tbl_user_level_permissions_list->lRowCnt++;

	// Init row class and style
	$tbl_user_level_permissions->CssClass = "";
	$tbl_user_level_permissions->CssStyle = "";
	$tbl_user_level_permissions->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($tbl_user_level_permissions->CurrentAction == "gridadd") {
		$tbl_user_level_permissions_list->LoadDefaultValues(); // Load default values
	} else {
		$tbl_user_level_permissions_list->LoadRowValues($rs); // Load row values
	}
	$tbl_user_level_permissions->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$tbl_user_level_permissions_list->RenderRow();

	// Render list options
	$tbl_user_level_permissions_list->RenderListOptions();
?>
	<tr<?php echo $tbl_user_level_permissions->RowAttributes() ?>>
<?php

// Render list options (body, left)
$tbl_user_level_permissions_list->ListOptions->Render("body", "left");
?>
	<?php if ($tbl_user_level_permissions->userlevelid->Visible) { // userlevelid ?>
		<td<?php echo $tbl_user_level_permissions->userlevelid->CellAttributes() ?>>
<div<?php echo $tbl_user_level_permissions->userlevelid->ViewAttributes() ?>><?php echo $tbl_user_level_permissions->userlevelid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tbl_user_level_permissions->ztablename->Visible) { // tablename ?>
		<td<?php echo $tbl_user_level_permissions->ztablename->CellAttributes() ?>>
<div<?php echo $tbl_user_level_permissions->ztablename->ViewAttributes() ?>><?php echo $tbl_user_level_permissions->ztablename->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($tbl_user_level_permissions->permission->Visible) { // permission ?>
		<td<?php echo $tbl_user_level_permissions->permission->CellAttributes() ?>>
<div<?php echo $tbl_user_level_permissions->permission->ViewAttributes() ?>><?php echo $tbl_user_level_permissions->permission->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tbl_user_level_permissions_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($tbl_user_level_permissions->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($tbl_user_level_permissions_list->lTotalRecs > 0) { ?>
<?php if ($tbl_user_level_permissions->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($tbl_user_level_permissions->CurrentAction <> "gridadd" && $tbl_user_level_permissions->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_user_level_permissions_list->Pager)) $tbl_user_level_permissions_list->Pager = new cPrevNextPager($tbl_user_level_permissions_list->lStartRec, $tbl_user_level_permissions_list->lDisplayRecs, $tbl_user_level_permissions_list->lTotalRecs) ?>
<?php if ($tbl_user_level_permissions_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_user_level_permissions_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_level_permissions_list->PageUrl() ?>start=<?php echo $tbl_user_level_permissions_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_user_level_permissions_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_level_permissions_list->PageUrl() ?>start=<?php echo $tbl_user_level_permissions_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_user_level_permissions_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_user_level_permissions_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_level_permissions_list->PageUrl() ?>start=<?php echo $tbl_user_level_permissions_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_user_level_permissions_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_level_permissions_list->PageUrl() ?>start=<?php echo $tbl_user_level_permissions_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_user_level_permissions_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $tbl_user_level_permissions_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $tbl_user_level_permissions_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $tbl_user_level_permissions_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_user_level_permissions_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
<?php if ($tbl_user_level_permissions_list->lTotalRecs > 0) { ?>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		<td><table border="0" cellspacing="0" cellpadding="0"><tr><td><?php echo $Language->Phrase("RecordsPerPage") ?>&nbsp;</td><td>
<input type="hidden" id="t" name="t" value="tbl_user_level_permissions">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" id="<?php echo EW_TABLE_REC_PER_PAGE ?>" onchange="this.form.submit();" class="phpmaker">
<option value="20"<?php if ($tbl_user_level_permissions_list->lDisplayRecs == 20) { ?> selected="selected"<?php } ?>>20</option>
<option value="50"<?php if ($tbl_user_level_permissions_list->lDisplayRecs == 50) { ?> selected="selected"<?php } ?>>50</option>
<option value="100"<?php if ($tbl_user_level_permissions_list->lDisplayRecs == 100) { ?> selected="selected"<?php } ?>>100</option>
<option value="ALL"<?php if ($tbl_user_level_permissions->getRecordsPerPage() == -1) { ?> selected="selected"<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select></td></tr></table>
		</td>
<?php } ?>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($tbl_user_level_permissions_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_user_level_permissions_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php if ($tbl_user_level_permissions_list->lTotalRecs > 0) { ?>
<?php if ($Security->CanDelete()) { ?>
<a href="" onclick="ew_SubmitSelected(document.ftbl_user_level_permissionslist, '<?php echo $tbl_user_level_permissions_list->MultiDeleteUrl ?>', ewLanguage.Phrase('DeleteMultiConfirmMsg'));return false;"><?php echo $Language->Phrase("DeleteSelectedLink") ?></a>&nbsp;&nbsp;
<?php } ?>
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
<?php } ?>
</td></tr></table>
<?php if ($tbl_user_level_permissions->Export == "" && $tbl_user_level_permissions->CurrentAction == "") { ?>
<?php } ?>
<?php if ($tbl_user_level_permissions->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_user_level_permissions_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_user_level_permissions_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'tbl_user_level_permissions';

	// Page object name
	var $PageObjName = 'tbl_user_level_permissions_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_user_level_permissions;
		if ($tbl_user_level_permissions->UseTokenInUrl) $PageUrl .= "t=" . $tbl_user_level_permissions->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_user_level_permissions;
		if ($tbl_user_level_permissions->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_user_level_permissions->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_user_level_permissions->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_user_level_permissions_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_user_level_permissions)
		$GLOBALS["tbl_user_level_permissions"] = new ctbl_user_level_permissions();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["tbl_user_level_permissions"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "tbl_user_level_permissionsdelete.php";
		$this->MultiUpdateUrl = "tbl_user_level_permissionsupdate.php";

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_user_level_permissions', TRUE);

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
		global $tbl_user_level_permissions;

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
		if (!$Security->CanAdmin()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$tbl_user_level_permissions->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$tbl_user_level_permissions->Export = $_POST["exporttype"];
		} else {
			$tbl_user_level_permissions->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $tbl_user_level_permissions->Export; // Get export parameter, used in header
		$gsExportFile = $tbl_user_level_permissions->TableVar; // Get export file, used in header

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
	var $lDisplayRecs = 20;
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
		global $objForm, $Language, $gsSearchError, $Security, $tbl_user_level_permissions;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Set up records per page
			$this->SetUpDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$tbl_user_level_permissions->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($tbl_user_level_permissions->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $tbl_user_level_permissions->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$tbl_user_level_permissions->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$tbl_user_level_permissions->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$tbl_user_level_permissions->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $tbl_user_level_permissions->getSearchWhere();
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
		$tbl_user_level_permissions->setSessionWhere($sFilter);
		$tbl_user_level_permissions->CurrentFilter = "";
	}

	// Set up number of records displayed per page
	function SetUpDisplayRecs() {
		global $tbl_user_level_permissions;
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->lDisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->lDisplayRecs = -1;
				} else {
					$this->lDisplayRecs = 20; // Non-numeric, load default
				}
			}
			$tbl_user_level_permissions->setRecordsPerPage($this->lDisplayRecs); // Save to Session

			// Reset start position
			$this->lStartRec = 1;
			$tbl_user_level_permissions->setStartRecordNumber($this->lStartRec);
		}
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $tbl_user_level_permissions;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $tbl_user_level_permissions->ztablename, $Keyword);
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
		global $Security, $tbl_user_level_permissions;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = $tbl_user_level_permissions->BasicSearchKeyword;
		$sSearchType = $tbl_user_level_permissions->BasicSearchType;
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
			$tbl_user_level_permissions->setSessionBasicSearchKeyword($sSearchKeyword);
			$tbl_user_level_permissions->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $tbl_user_level_permissions;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$tbl_user_level_permissions->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $tbl_user_level_permissions;
		$tbl_user_level_permissions->setSessionBasicSearchKeyword("");
		$tbl_user_level_permissions->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $tbl_user_level_permissions;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$tbl_user_level_permissions->BasicSearchKeyword = $tbl_user_level_permissions->getSessionBasicSearchKeyword();
			$tbl_user_level_permissions->BasicSearchType = $tbl_user_level_permissions->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $tbl_user_level_permissions;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$tbl_user_level_permissions->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$tbl_user_level_permissions->CurrentOrderType = @$_GET["ordertype"];
			$tbl_user_level_permissions->UpdateSort($tbl_user_level_permissions->userlevelid); // userlevelid
			$tbl_user_level_permissions->UpdateSort($tbl_user_level_permissions->ztablename); // tablename
			$tbl_user_level_permissions->UpdateSort($tbl_user_level_permissions->permission); // permission
			$tbl_user_level_permissions->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $tbl_user_level_permissions;
		$sOrderBy = $tbl_user_level_permissions->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($tbl_user_level_permissions->SqlOrderBy() <> "") {
				$sOrderBy = $tbl_user_level_permissions->SqlOrderBy();
				$tbl_user_level_permissions->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $tbl_user_level_permissions;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$tbl_user_level_permissions->setSessionOrderBy($sOrderBy);
				$tbl_user_level_permissions->userlevelid->setSort("");
				$tbl_user_level_permissions->ztablename->setSort("");
				$tbl_user_level_permissions->permission->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$tbl_user_level_permissions->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $tbl_user_level_permissions;

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
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" class=\"phpmaker\" onclick=\"tbl_user_level_permissions_list.SelectAllKey(this);\">";
		$this->ListOptions->MoveItem("checkbox", 0); // Move to first column

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($tbl_user_level_permissions->Export <> "" ||
			$tbl_user_level_permissions->CurrentAction == "gridadd" ||
			$tbl_user_level_permissions->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $tbl_user_level_permissions;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->CanView() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->CanEdit() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->CanAdd() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
		}

		// "checkbox"
		$oListOpt =& $this->ListOptions->Items["checkbox"];
		if ($Security->CanDelete() && $oListOpt->Visible)
			$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" id=\"key_m[]\" value=\"" . ew_HtmlEncode($tbl_user_level_permissions->userlevelid->CurrentValue . EW_COMPOSITE_KEY_SEPARATOR . $tbl_user_level_permissions->ztablename->CurrentValue) . "\" class=\"phpmaker\" onclick='ew_ClickMultiCheckbox(this);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $tbl_user_level_permissions;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_user_level_permissions;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_user_level_permissions->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_user_level_permissions->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_user_level_permissions->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_user_level_permissions->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_user_level_permissions->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_user_level_permissions->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $tbl_user_level_permissions;
		$tbl_user_level_permissions->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$tbl_user_level_permissions->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_user_level_permissions;

		// Call Recordset Selecting event
		$tbl_user_level_permissions->Recordset_Selecting($tbl_user_level_permissions->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_user_level_permissions->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_user_level_permissions->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_user_level_permissions;
		$sFilter = $tbl_user_level_permissions->KeyFilter();

		// Call Row Selecting event
		$tbl_user_level_permissions->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_user_level_permissions->CurrentFilter = $sFilter;
		$sSql = $tbl_user_level_permissions->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_user_level_permissions->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_user_level_permissions;
		$tbl_user_level_permissions->userlevelid->setDbValue($rs->fields('userlevelid'));
		$tbl_user_level_permissions->ztablename->setDbValue($rs->fields('tablename'));
		$tbl_user_level_permissions->permission->setDbValue($rs->fields('permission'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_user_level_permissions;

		// Initialize URLs
		$this->ViewUrl = $tbl_user_level_permissions->ViewUrl();
		$this->EditUrl = $tbl_user_level_permissions->EditUrl();
		$this->InlineEditUrl = $tbl_user_level_permissions->InlineEditUrl();
		$this->CopyUrl = $tbl_user_level_permissions->CopyUrl();
		$this->InlineCopyUrl = $tbl_user_level_permissions->InlineCopyUrl();
		$this->DeleteUrl = $tbl_user_level_permissions->DeleteUrl();

		// Call Row_Rendering event
		$tbl_user_level_permissions->Row_Rendering();

		// Common render codes for all row types
		// userlevelid

		$tbl_user_level_permissions->userlevelid->CellCssStyle = ""; $tbl_user_level_permissions->userlevelid->CellCssClass = "";
		$tbl_user_level_permissions->userlevelid->CellAttrs = array(); $tbl_user_level_permissions->userlevelid->ViewAttrs = array(); $tbl_user_level_permissions->userlevelid->EditAttrs = array();

		// tablename
		$tbl_user_level_permissions->ztablename->CellCssStyle = ""; $tbl_user_level_permissions->ztablename->CellCssClass = "";
		$tbl_user_level_permissions->ztablename->CellAttrs = array(); $tbl_user_level_permissions->ztablename->ViewAttrs = array(); $tbl_user_level_permissions->ztablename->EditAttrs = array();

		// permission
		$tbl_user_level_permissions->permission->CellCssStyle = ""; $tbl_user_level_permissions->permission->CellCssClass = "";
		$tbl_user_level_permissions->permission->CellAttrs = array(); $tbl_user_level_permissions->permission->ViewAttrs = array(); $tbl_user_level_permissions->permission->EditAttrs = array();
		if ($tbl_user_level_permissions->RowType == EW_ROWTYPE_VIEW) { // View row

			// userlevelid
			$tbl_user_level_permissions->userlevelid->ViewValue = $tbl_user_level_permissions->userlevelid->CurrentValue;
			$tbl_user_level_permissions->userlevelid->CssStyle = "";
			$tbl_user_level_permissions->userlevelid->CssClass = "";
			$tbl_user_level_permissions->userlevelid->ViewCustomAttributes = "";

			// tablename
			$tbl_user_level_permissions->ztablename->ViewValue = $tbl_user_level_permissions->ztablename->CurrentValue;
			$tbl_user_level_permissions->ztablename->CssStyle = "";
			$tbl_user_level_permissions->ztablename->CssClass = "";
			$tbl_user_level_permissions->ztablename->ViewCustomAttributes = "";

			// permission
			$tbl_user_level_permissions->permission->ViewValue = $tbl_user_level_permissions->permission->CurrentValue;
			$tbl_user_level_permissions->permission->CssStyle = "";
			$tbl_user_level_permissions->permission->CssClass = "";
			$tbl_user_level_permissions->permission->ViewCustomAttributes = "";

			// userlevelid
			$tbl_user_level_permissions->userlevelid->HrefValue = "";
			$tbl_user_level_permissions->userlevelid->TooltipValue = "";

			// tablename
			$tbl_user_level_permissions->ztablename->HrefValue = "";
			$tbl_user_level_permissions->ztablename->TooltipValue = "";

			// permission
			$tbl_user_level_permissions->permission->HrefValue = "";
			$tbl_user_level_permissions->permission->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tbl_user_level_permissions->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_user_level_permissions->Row_Rendered();
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
