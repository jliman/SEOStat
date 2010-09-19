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
$tbl_group_profile_view = new ctbl_group_profile_view();
$Page =& $tbl_group_profile_view;

// Page init
$tbl_group_profile_view->Page_Init();

// Page main
$tbl_group_profile_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_group_profile->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_group_profile_view = new ew_Page("tbl_group_profile_view");

// page properties
tbl_group_profile_view.PageID = "view"; // page ID
tbl_group_profile_view.FormID = "ftbl_group_profileview"; // form ID
var EW_PAGE_ID = tbl_group_profile_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_group_profile_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_group_profile_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_group_profile_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_group_profile_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_group_profile_view.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_group_profile_view.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_group_profile->TableCaption() ?>
<br><br>
<?php if ($tbl_group_profile->Export == "") { ?>
<a href="<?php echo $tbl_group_profile_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_group_profile_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $tbl_group_profile_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_group_profile_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a onclick="return ew_Confirm(ewLanguage.Phrase('DeleteConfirmMsg'));" href="<?php echo $tbl_group_profile_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_group_profile_view->ShowMessage();
?>
<p>
<?php if ($tbl_group_profile->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_group_profile_view->Pager)) $tbl_group_profile_view->Pager = new cPrevNextPager($tbl_group_profile_view->lStartRec, $tbl_group_profile_view->lDisplayRecs, $tbl_group_profile_view->lTotalRecs) ?>
<?php if ($tbl_group_profile_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_group_profile_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_profile_view->PageUrl() ?>start=<?php echo $tbl_group_profile_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_group_profile_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_profile_view->PageUrl() ?>start=<?php echo $tbl_group_profile_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_group_profile_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_group_profile_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_profile_view->PageUrl() ?>start=<?php echo $tbl_group_profile_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_group_profile_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_profile_view->PageUrl() ?>start=<?php echo $tbl_group_profile_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_group_profile_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_group_profile_view->sSrchWhere == "0=101") { ?>
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
<?php if ($tbl_group_profile->id_group->Visible) { // id_group ?>
	<tr<?php echo $tbl_group_profile->id_group->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_group_profile->id_group->FldCaption() ?></td>
		<td<?php echo $tbl_group_profile->id_group->CellAttributes() ?>>
<div<?php echo $tbl_group_profile->id_group->ViewAttributes() ?>><?php echo $tbl_group_profile->id_group->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_group_profile->id_profile->Visible) { // id_profile ?>
	<tr<?php echo $tbl_group_profile->id_profile->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_group_profile->id_profile->FldCaption() ?></td>
		<td<?php echo $tbl_group_profile->id_profile->CellAttributes() ?>>
<div<?php echo $tbl_group_profile->id_profile->ViewAttributes() ?>><?php echo $tbl_group_profile->id_profile->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($tbl_group_profile->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_group_profile_view->Pager)) $tbl_group_profile_view->Pager = new cPrevNextPager($tbl_group_profile_view->lStartRec, $tbl_group_profile_view->lDisplayRecs, $tbl_group_profile_view->lTotalRecs) ?>
<?php if ($tbl_group_profile_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_group_profile_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_profile_view->PageUrl() ?>start=<?php echo $tbl_group_profile_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_group_profile_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_profile_view->PageUrl() ?>start=<?php echo $tbl_group_profile_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_group_profile_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_group_profile_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_profile_view->PageUrl() ?>start=<?php echo $tbl_group_profile_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_group_profile_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_group_profile_view->PageUrl() ?>start=<?php echo $tbl_group_profile_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_group_profile_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_group_profile_view->sSrchWhere == "0=101") { ?>
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
$tbl_group_profile_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_group_profile_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'tbl_group_profile';

	// Page object name
	var $PageObjName = 'tbl_group_profile_view';

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
	function ctbl_group_profile_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_group_profile)
		$GLOBALS["tbl_group_profile"] = new ctbl_group_profile();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_group_profile', TRUE);

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
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("tbl_group_profilelist.php");
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
		global $Language, $tbl_group_profile;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_group"] <> "") {
				$tbl_group_profile->id_group->setQueryStringValue($_GET["id_group"]);
				$this->arRecKey["id_group"] = $tbl_group_profile->id_group->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}
			if (@$_GET["id_profile"] <> "") {
				$tbl_group_profile->id_profile->setQueryStringValue($_GET["id_profile"]);
				$this->arRecKey["id_profile"] = $tbl_group_profile->id_profile->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$tbl_group_profile->CurrentAction = "I"; // Display form
			switch ($tbl_group_profile->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					if ($rs = $this->LoadRecordset()) // Load records
						$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("tbl_group_profilelist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($tbl_group_profile->id_group->CurrentValue) == strval($rs->fields('id_group')) AND strval($tbl_group_profile->id_profile->CurrentValue) == strval($rs->fields('id_profile'))) {
								$tbl_group_profile->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "tbl_group_profilelist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "tbl_group_profilelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$tbl_group_profile->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id_group=" . urlencode($tbl_group_profile->id_group->CurrentValue) . "&id_profile=" . urlencode($tbl_group_profile->id_profile->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id_group=" . urlencode($tbl_group_profile->id_group->CurrentValue) . "&id_profile=" . urlencode($tbl_group_profile->id_profile->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id_group=" . urlencode($tbl_group_profile->id_group->CurrentValue) . "&id_profile=" . urlencode($tbl_group_profile->id_profile->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id_group=" . urlencode($tbl_group_profile->id_group->CurrentValue) . "&id_profile=" . urlencode($tbl_group_profile->id_profile->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id_group=" . urlencode($tbl_group_profile->id_group->CurrentValue) . "&id_profile=" . urlencode($tbl_group_profile->id_profile->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id_group=" . urlencode($tbl_group_profile->id_group->CurrentValue) . "&id_profile=" . urlencode($tbl_group_profile->id_profile->CurrentValue);
		$this->AddUrl = $tbl_group_profile->AddUrl();
		$this->EditUrl = $tbl_group_profile->EditUrl();
		$this->CopyUrl = $tbl_group_profile->CopyUrl();
		$this->DeleteUrl = $tbl_group_profile->DeleteUrl();
		$this->ListUrl = $tbl_group_profile->ListUrl();

		// Call Row_Rendering event
		$tbl_group_profile->Row_Rendering();

		// Common render codes for all row types
		// id_group

		$tbl_group_profile->id_group->CellCssStyle = ""; $tbl_group_profile->id_group->CellCssClass = "";
		$tbl_group_profile->id_group->CellAttrs = array(); $tbl_group_profile->id_group->ViewAttrs = array(); $tbl_group_profile->id_group->EditAttrs = array();

		// id_profile
		$tbl_group_profile->id_profile->CellCssStyle = ""; $tbl_group_profile->id_profile->CellCssClass = "";
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
		}

		// Call Row Rendered event
		if ($tbl_group_profile->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_group_profile->Row_Rendered();
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
