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
$tbl_group_view = new ctbl_group_view();
$Page =& $tbl_group_view;

// Page init
$tbl_group_view->Page_Init();

// Page main
$tbl_group_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_group->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_group_view = new ew_Page("tbl_group_view");

// page properties
tbl_group_view.PageID = "view"; // page ID
tbl_group_view.FormID = "ftbl_groupview"; // form ID
var EW_PAGE_ID = tbl_group_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_group_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_group_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_group_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_group_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_group_view.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_group_view.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_group->TableCaption() ?>
<br><br>
<?php if ($tbl_group->Export == "") { ?>
<a href="<?php echo $tbl_group_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_group_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $tbl_group_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_group_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a onclick="return ew_Confirm(ewLanguage.Phrase('DeleteConfirmMsg'));" href="<?php echo $tbl_group_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_group_view->ShowMessage();
?>
<p>
<?php if ($tbl_group->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_group_view->Pager)) $tbl_group_view->Pager = new cPrevNextPager($tbl_group_view->lStartRec, $tbl_group_view->lDisplayRecs, $tbl_group_view->lTotalRecs) ?>
<?php if ($tbl_group_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_group_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_view->PageUrl() ?>start=<?php echo $tbl_group_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_group_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_view->PageUrl() ?>start=<?php echo $tbl_group_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_group_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_group_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_view->PageUrl() ?>start=<?php echo $tbl_group_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_group_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_view->PageUrl() ?>start=<?php echo $tbl_group_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_group_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_group_view->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<br>
<?php } ?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($tbl_group->id->Visible) { // id ?>
	<tr<?php echo $tbl_group->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_group->id->FldCaption() ?></td>
		<td<?php echo $tbl_group->id->CellAttributes() ?>>
<div<?php echo $tbl_group->id->ViewAttributes() ?>><?php echo $tbl_group->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_group->name->Visible) { // name ?>
	<tr<?php echo $tbl_group->name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_group->name->FldCaption() ?></td>
		<td<?php echo $tbl_group->name->CellAttributes() ?>>
<div<?php echo $tbl_group->name->ViewAttributes() ?>><?php echo $tbl_group->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_group->is_active->Visible) { // is_active ?>
	<tr<?php echo $tbl_group->is_active->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_group->is_active->FldCaption() ?></td>
		<td<?php echo $tbl_group->is_active->CellAttributes() ?>>
<div<?php echo $tbl_group->is_active->ViewAttributes() ?>><?php echo $tbl_group->is_active->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($tbl_group->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_group_view->Pager)) $tbl_group_view->Pager = new cPrevNextPager($tbl_group_view->lStartRec, $tbl_group_view->lDisplayRecs, $tbl_group_view->lTotalRecs) ?>
<?php if ($tbl_group_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_group_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_view->PageUrl() ?>start=<?php echo $tbl_group_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_group_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_view->PageUrl() ?>start=<?php echo $tbl_group_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_group_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_group_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_view->PageUrl() ?>start=<?php echo $tbl_group_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_group_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_view->PageUrl() ?>start=<?php echo $tbl_group_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_group_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_group_view->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoPermission") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<p>
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
$tbl_group_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_group_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'tbl_group';

	// Page object name
	var $PageObjName = 'tbl_group_view';

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
	function ctbl_group_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_group)
		$GLOBALS["tbl_group"] = new ctbl_group();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_group', TRUE);

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
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("tbl_grouplist.php");
		}

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
	var $lDisplayRecs = 1;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $lRecCnt;
	var $arRecKey = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $tbl_group;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$tbl_group->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $tbl_group->id->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$tbl_group->CurrentAction = "I"; // Display form
			switch ($tbl_group->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					if ($rs = $this->LoadRecordset()) // Load records
						$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("tbl_grouplist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($tbl_group->id->CurrentValue) == strval($rs->fields('id'))) {
								$tbl_group->setStartRecordNumber($this->lStartRec); // Save record position
								$bMatchRecord = TRUE;
								break;
							} else {
								$this->lStartRec++;
								$rs->MoveNext();
							}
						}
					}
					if (!$bMatchRecord) {
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "tbl_grouplist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "tbl_grouplist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$tbl_group->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($tbl_group->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($tbl_group->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($tbl_group->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($tbl_group->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($tbl_group->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($tbl_group->id->CurrentValue);
		$this->AddUrl = $tbl_group->AddUrl();
		$this->EditUrl = $tbl_group->EditUrl();
		$this->CopyUrl = $tbl_group->CopyUrl();
		$this->DeleteUrl = $tbl_group->DeleteUrl();
		$this->ListUrl = $tbl_group->ListUrl();

		// Call Row_Rendering event
		$tbl_group->Row_Rendering();

		// Common render codes for all row types
		// id

		$tbl_group->id->CellCssStyle = ""; $tbl_group->id->CellCssClass = "";
		$tbl_group->id->CellAttrs = array(); $tbl_group->id->ViewAttrs = array(); $tbl_group->id->EditAttrs = array();

		// name
		$tbl_group->name->CellCssStyle = ""; $tbl_group->name->CellCssClass = "";
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

			// is_active
			$tbl_group->is_active->HrefValue = "";
			$tbl_group->is_active->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tbl_group->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_group->Row_Rendered();
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
}
?>
