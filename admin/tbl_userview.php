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
$tbl_user_view = new ctbl_user_view();
$Page =& $tbl_user_view;

// Page init
$tbl_user_view->Page_Init();

// Page main
$tbl_user_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_user->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_user_view = new ew_Page("tbl_user_view");

// page properties
tbl_user_view.PageID = "view"; // page ID
tbl_user_view.FormID = "ftbl_userview"; // form ID
var EW_PAGE_ID = tbl_user_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_user_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_user_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_user_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_user_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_user_view.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_user_view.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_user->TableCaption() ?>
<br><br>
<?php if ($tbl_user->Export == "") { ?>
<a href="<?php echo $tbl_user_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_user_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $tbl_user_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_user_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a onclick="return ew_Confirm(ewLanguage.Phrase('DeleteConfirmMsg'));" href="<?php echo $tbl_user_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_user_view->ShowMessage();
?>
<p>
<?php if ($tbl_user->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_user_view->Pager)) $tbl_user_view->Pager = new cPrevNextPager($tbl_user_view->lStartRec, $tbl_user_view->lDisplayRecs, $tbl_user_view->lTotalRecs) ?>
<?php if ($tbl_user_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_user_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_view->PageUrl() ?>start=<?php echo $tbl_user_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_user_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_view->PageUrl() ?>start=<?php echo $tbl_user_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_user_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_user_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_view->PageUrl() ?>start=<?php echo $tbl_user_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_user_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_view->PageUrl() ?>start=<?php echo $tbl_user_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_user_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_user_view->sSrchWhere == "0=101") { ?>
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
<?php if ($tbl_user->id_user->Visible) { // id_user ?>
	<tr<?php echo $tbl_user->id_user->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_user->id_user->FldCaption() ?></td>
		<td<?php echo $tbl_user->id_user->CellAttributes() ?>>
<div<?php echo $tbl_user->id_user->ViewAttributes() ?>><?php echo $tbl_user->id_user->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_user->username->Visible) { // username ?>
	<tr<?php echo $tbl_user->username->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_user->username->FldCaption() ?></td>
		<td<?php echo $tbl_user->username->CellAttributes() ?>>
<div<?php echo $tbl_user->username->ViewAttributes() ?>><?php echo $tbl_user->username->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_user->passwd->Visible) { // passwd ?>
	<tr<?php echo $tbl_user->passwd->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_user->passwd->FldCaption() ?></td>
		<td<?php echo $tbl_user->passwd->CellAttributes() ?>>
<div<?php echo $tbl_user->passwd->ViewAttributes() ?>><?php echo $tbl_user->passwd->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_user->id_userlevel->Visible) { // id_userlevel ?>
	<tr<?php echo $tbl_user->id_userlevel->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_user->id_userlevel->FldCaption() ?></td>
		<td<?php echo $tbl_user->id_userlevel->CellAttributes() ?>>
<div<?php echo $tbl_user->id_userlevel->ViewAttributes() ?>><?php echo $tbl_user->id_userlevel->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($tbl_user->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_user_view->Pager)) $tbl_user_view->Pager = new cPrevNextPager($tbl_user_view->lStartRec, $tbl_user_view->lDisplayRecs, $tbl_user_view->lTotalRecs) ?>
<?php if ($tbl_user_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_user_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_view->PageUrl() ?>start=<?php echo $tbl_user_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_user_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_view->PageUrl() ?>start=<?php echo $tbl_user_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_user_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_user_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_view->PageUrl() ?>start=<?php echo $tbl_user_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_user_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_user_view->PageUrl() ?>start=<?php echo $tbl_user_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_user_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_user_view->sSrchWhere == "0=101") { ?>
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
$tbl_user_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_user_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'tbl_user';

	// Page object name
	var $PageObjName = 'tbl_user_view';

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
	function ctbl_user_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_user)
		$GLOBALS["tbl_user"] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_user', TRUE);

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
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("tbl_userlist.php");
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
		global $Language, $tbl_user;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_user"] <> "") {
				$tbl_user->id_user->setQueryStringValue($_GET["id_user"]);
				$this->arRecKey["id_user"] = $tbl_user->id_user->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$tbl_user->CurrentAction = "I"; // Display form
			switch ($tbl_user->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					if ($rs = $this->LoadRecordset()) // Load records
						$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("tbl_userlist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($tbl_user->id_user->CurrentValue) == strval($rs->fields('id_user'))) {
								$tbl_user->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "tbl_userlist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "tbl_userlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$tbl_user->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id_user=" . urlencode($tbl_user->id_user->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id_user=" . urlencode($tbl_user->id_user->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id_user=" . urlencode($tbl_user->id_user->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id_user=" . urlencode($tbl_user->id_user->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id_user=" . urlencode($tbl_user->id_user->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id_user=" . urlencode($tbl_user->id_user->CurrentValue);
		$this->AddUrl = $tbl_user->AddUrl();
		$this->EditUrl = $tbl_user->EditUrl();
		$this->CopyUrl = $tbl_user->CopyUrl();
		$this->DeleteUrl = $tbl_user->DeleteUrl();
		$this->ListUrl = $tbl_user->ListUrl();

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

			// passwd
			$tbl_user->passwd->HrefValue = "";
			$tbl_user->passwd->TooltipValue = "";

			// id_userlevel
			$tbl_user->id_userlevel->HrefValue = "";
			$tbl_user->id_userlevel->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tbl_user->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_user->Row_Rendered();
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
