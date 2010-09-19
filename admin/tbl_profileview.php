<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_profileinfo.php" ?>
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
$tbl_profile_view = new ctbl_profile_view();
$Page =& $tbl_profile_view;

// Page init
$tbl_profile_view->Page_Init();

// Page main
$tbl_profile_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_profile->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_profile_view = new ew_Page("tbl_profile_view");

// page properties
tbl_profile_view.PageID = "view"; // page ID
tbl_profile_view.FormID = "ftbl_profileview"; // form ID
var EW_PAGE_ID = tbl_profile_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_profile_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_profile_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_profile_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_profile_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_profile_view.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_profile_view.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_profile->TableCaption() ?>
<br><br>
<?php if ($tbl_profile->Export == "") { ?>
<a href="<?php echo $tbl_profile_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_profile_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $tbl_profile_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_profile_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a onclick="return ew_Confirm(ewLanguage.Phrase('DeleteConfirmMsg'));" href="<?php echo $tbl_profile_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_profile_view->ShowMessage();
?>
<p>
<?php if ($tbl_profile->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_profile_view->Pager)) $tbl_profile_view->Pager = new cPrevNextPager($tbl_profile_view->lStartRec, $tbl_profile_view->lDisplayRecs, $tbl_profile_view->lTotalRecs) ?>
<?php if ($tbl_profile_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_profile_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_profile_view->PageUrl() ?>start=<?php echo $tbl_profile_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_profile_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_profile_view->PageUrl() ?>start=<?php echo $tbl_profile_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_profile_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_profile_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_profile_view->PageUrl() ?>start=<?php echo $tbl_profile_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_profile_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_profile_view->PageUrl() ?>start=<?php echo $tbl_profile_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_profile_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_profile_view->sSrchWhere == "0=101") { ?>
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
<?php if ($tbl_profile->id->Visible) { // id ?>
	<tr<?php echo $tbl_profile->id->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->id->FldCaption() ?></td>
		<td<?php echo $tbl_profile->id->CellAttributes() ?>>
<div<?php echo $tbl_profile->id->ViewAttributes() ?>><?php echo $tbl_profile->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->name->Visible) { // name ?>
	<tr<?php echo $tbl_profile->name->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->name->FldCaption() ?></td>
		<td<?php echo $tbl_profile->name->CellAttributes() ?>>
<div<?php echo $tbl_profile->name->ViewAttributes() ?>><?php echo $tbl_profile->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->ga_username->Visible) { // ga_username ?>
	<tr<?php echo $tbl_profile->ga_username->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->ga_username->FldCaption() ?></td>
		<td<?php echo $tbl_profile->ga_username->CellAttributes() ?>>
<div<?php echo $tbl_profile->ga_username->ViewAttributes() ?>><?php echo $tbl_profile->ga_username->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->ga_passwd->Visible) { // ga_passwd ?>
	<tr<?php echo $tbl_profile->ga_passwd->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->ga_passwd->FldCaption() ?></td>
		<td<?php echo $tbl_profile->ga_passwd->CellAttributes() ?>>
<div<?php echo $tbl_profile->ga_passwd->ViewAttributes() ?>><?php echo $tbl_profile->ga_passwd->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->ga_profileid->Visible) { // ga_profileid ?>
	<tr<?php echo $tbl_profile->ga_profileid->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->ga_profileid->FldCaption() ?></td>
		<td<?php echo $tbl_profile->ga_profileid->CellAttributes() ?>>
<div<?php echo $tbl_profile->ga_profileid->ViewAttributes() ?>><?php echo $tbl_profile->ga_profileid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->url->Visible) { // url ?>
	<tr<?php echo $tbl_profile->url->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->url->FldCaption() ?></td>
		<td<?php echo $tbl_profile->url->CellAttributes() ?>>
<div<?php echo $tbl_profile->url->ViewAttributes() ?>><?php echo $tbl_profile->url->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->fb_pageid->Visible) { // fb_pageid ?>
	<tr<?php echo $tbl_profile->fb_pageid->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->fb_pageid->FldCaption() ?></td>
		<td<?php echo $tbl_profile->fb_pageid->CellAttributes() ?>>
<div<?php echo $tbl_profile->fb_pageid->ViewAttributes() ?>><?php echo $tbl_profile->fb_pageid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->twitter_page->Visible) { // twitter_page ?>
	<tr<?php echo $tbl_profile->twitter_page->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->twitter_page->FldCaption() ?></td>
		<td<?php echo $tbl_profile->twitter_page->CellAttributes() ?>>
<div<?php echo $tbl_profile->twitter_page->ViewAttributes() ?>><?php echo $tbl_profile->twitter_page->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->is_wordpress->Visible) { // is_wordpress ?>
	<tr<?php echo $tbl_profile->is_wordpress->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->is_wordpress->FldCaption() ?></td>
		<td<?php echo $tbl_profile->is_wordpress->CellAttributes() ?>>
<div<?php echo $tbl_profile->is_wordpress->ViewAttributes() ?>><?php echo $tbl_profile->is_wordpress->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->is_blogger->Visible) { // is_blogger ?>
	<tr<?php echo $tbl_profile->is_blogger->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->is_blogger->FldCaption() ?></td>
		<td<?php echo $tbl_profile->is_blogger->CellAttributes() ?>>
<div<?php echo $tbl_profile->is_blogger->ViewAttributes() ?>><?php echo $tbl_profile->is_blogger->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_profile->is_active->Visible) { // is_active ?>
	<tr<?php echo $tbl_profile->is_active->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_profile->is_active->FldCaption() ?></td>
		<td<?php echo $tbl_profile->is_active->CellAttributes() ?>>
<div<?php echo $tbl_profile->is_active->ViewAttributes() ?>><?php echo $tbl_profile->is_active->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($tbl_profile->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_profile_view->Pager)) $tbl_profile_view->Pager = new cPrevNextPager($tbl_profile_view->lStartRec, $tbl_profile_view->lDisplayRecs, $tbl_profile_view->lTotalRecs) ?>
<?php if ($tbl_profile_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_profile_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_profile_view->PageUrl() ?>start=<?php echo $tbl_profile_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_profile_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_profile_view->PageUrl() ?>start=<?php echo $tbl_profile_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_profile_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_profile_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_profile_view->PageUrl() ?>start=<?php echo $tbl_profile_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_profile_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_profile_view->PageUrl() ?>start=<?php echo $tbl_profile_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_profile_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_profile_view->sSrchWhere == "0=101") { ?>
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
<?php if ($tbl_profile->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$tbl_profile_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_profile_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'tbl_profile';

	// Page object name
	var $PageObjName = 'tbl_profile_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_profile;
		if ($tbl_profile->UseTokenInUrl) $PageUrl .= "t=" . $tbl_profile->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_profile;
		if ($tbl_profile->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_profile->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_profile->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_profile_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_profile)
		$GLOBALS["tbl_profile"] = new ctbl_profile();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_profile', TRUE);

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
		global $tbl_profile;

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
			$this->Page_Terminate("tbl_profilelist.php");
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
		global $Language, $tbl_profile;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$tbl_profile->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $tbl_profile->id->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$tbl_profile->CurrentAction = "I"; // Display form
			switch ($tbl_profile->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					if ($rs = $this->LoadRecordset()) // Load records
						$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("tbl_profilelist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($tbl_profile->id->CurrentValue) == strval($rs->fields('id'))) {
								$tbl_profile->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "tbl_profilelist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "tbl_profilelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$tbl_profile->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $tbl_profile;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$tbl_profile->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$tbl_profile->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $tbl_profile->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$tbl_profile->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$tbl_profile->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$tbl_profile->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_profile;

		// Call Recordset Selecting event
		$tbl_profile->Recordset_Selecting($tbl_profile->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_profile->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_profile->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_profile;
		$sFilter = $tbl_profile->KeyFilter();

		// Call Row Selecting event
		$tbl_profile->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_profile->CurrentFilter = $sFilter;
		$sSql = $tbl_profile->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_profile->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_profile;
		$tbl_profile->id->setDbValue($rs->fields('id'));
		$tbl_profile->name->setDbValue($rs->fields('name'));
		$tbl_profile->ga_username->setDbValue($rs->fields('ga_username'));
		$tbl_profile->ga_passwd->setDbValue($rs->fields('ga_passwd'));
		$tbl_profile->ga_profileid->setDbValue($rs->fields('ga_profileid'));
		$tbl_profile->url->setDbValue($rs->fields('url'));
		$tbl_profile->fb_pageid->setDbValue($rs->fields('fb_pageid'));
		$tbl_profile->twitter_page->setDbValue($rs->fields('twitter_page'));
		$tbl_profile->is_wordpress->setDbValue($rs->fields('is_wordpress'));
		$tbl_profile->is_blogger->setDbValue($rs->fields('is_blogger'));
		$tbl_profile->is_active->setDbValue($rs->fields('is_active'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_profile;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($tbl_profile->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($tbl_profile->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($tbl_profile->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($tbl_profile->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($tbl_profile->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($tbl_profile->id->CurrentValue);
		$this->AddUrl = $tbl_profile->AddUrl();
		$this->EditUrl = $tbl_profile->EditUrl();
		$this->CopyUrl = $tbl_profile->CopyUrl();
		$this->DeleteUrl = $tbl_profile->DeleteUrl();
		$this->ListUrl = $tbl_profile->ListUrl();

		// Call Row_Rendering event
		$tbl_profile->Row_Rendering();

		// Common render codes for all row types
		// id

		$tbl_profile->id->CellCssStyle = ""; $tbl_profile->id->CellCssClass = "";
		$tbl_profile->id->CellAttrs = array(); $tbl_profile->id->ViewAttrs = array(); $tbl_profile->id->EditAttrs = array();

		// name
		$tbl_profile->name->CellCssStyle = ""; $tbl_profile->name->CellCssClass = "";
		$tbl_profile->name->CellAttrs = array(); $tbl_profile->name->ViewAttrs = array(); $tbl_profile->name->EditAttrs = array();

		// ga_username
		$tbl_profile->ga_username->CellCssStyle = ""; $tbl_profile->ga_username->CellCssClass = "";
		$tbl_profile->ga_username->CellAttrs = array(); $tbl_profile->ga_username->ViewAttrs = array(); $tbl_profile->ga_username->EditAttrs = array();

		// ga_passwd
		$tbl_profile->ga_passwd->CellCssStyle = ""; $tbl_profile->ga_passwd->CellCssClass = "";
		$tbl_profile->ga_passwd->CellAttrs = array(); $tbl_profile->ga_passwd->ViewAttrs = array(); $tbl_profile->ga_passwd->EditAttrs = array();

		// ga_profileid
		$tbl_profile->ga_profileid->CellCssStyle = ""; $tbl_profile->ga_profileid->CellCssClass = "";
		$tbl_profile->ga_profileid->CellAttrs = array(); $tbl_profile->ga_profileid->ViewAttrs = array(); $tbl_profile->ga_profileid->EditAttrs = array();

		// url
		$tbl_profile->url->CellCssStyle = ""; $tbl_profile->url->CellCssClass = "";
		$tbl_profile->url->CellAttrs = array(); $tbl_profile->url->ViewAttrs = array(); $tbl_profile->url->EditAttrs = array();

		// fb_pageid
		$tbl_profile->fb_pageid->CellCssStyle = ""; $tbl_profile->fb_pageid->CellCssClass = "";
		$tbl_profile->fb_pageid->CellAttrs = array(); $tbl_profile->fb_pageid->ViewAttrs = array(); $tbl_profile->fb_pageid->EditAttrs = array();

		// twitter_page
		$tbl_profile->twitter_page->CellCssStyle = ""; $tbl_profile->twitter_page->CellCssClass = "";
		$tbl_profile->twitter_page->CellAttrs = array(); $tbl_profile->twitter_page->ViewAttrs = array(); $tbl_profile->twitter_page->EditAttrs = array();

		// is_wordpress
		$tbl_profile->is_wordpress->CellCssStyle = ""; $tbl_profile->is_wordpress->CellCssClass = "";
		$tbl_profile->is_wordpress->CellAttrs = array(); $tbl_profile->is_wordpress->ViewAttrs = array(); $tbl_profile->is_wordpress->EditAttrs = array();

		// is_blogger
		$tbl_profile->is_blogger->CellCssStyle = ""; $tbl_profile->is_blogger->CellCssClass = "";
		$tbl_profile->is_blogger->CellAttrs = array(); $tbl_profile->is_blogger->ViewAttrs = array(); $tbl_profile->is_blogger->EditAttrs = array();

		// is_active
		$tbl_profile->is_active->CellCssStyle = ""; $tbl_profile->is_active->CellCssClass = "";
		$tbl_profile->is_active->CellAttrs = array(); $tbl_profile->is_active->ViewAttrs = array(); $tbl_profile->is_active->EditAttrs = array();
		if ($tbl_profile->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$tbl_profile->id->ViewValue = $tbl_profile->id->CurrentValue;
			$tbl_profile->id->CssStyle = "";
			$tbl_profile->id->CssClass = "";
			$tbl_profile->id->ViewCustomAttributes = "";

			// name
			$tbl_profile->name->ViewValue = $tbl_profile->name->CurrentValue;
			$tbl_profile->name->CssStyle = "";
			$tbl_profile->name->CssClass = "";
			$tbl_profile->name->ViewCustomAttributes = "";

			// ga_username
			$tbl_profile->ga_username->ViewValue = $tbl_profile->ga_username->CurrentValue;
			$tbl_profile->ga_username->CssStyle = "";
			$tbl_profile->ga_username->CssClass = "";
			$tbl_profile->ga_username->ViewCustomAttributes = "";

			// ga_passwd
			$tbl_profile->ga_passwd->ViewValue = $tbl_profile->ga_passwd->CurrentValue;
			$tbl_profile->ga_passwd->CssStyle = "";
			$tbl_profile->ga_passwd->CssClass = "";
			$tbl_profile->ga_passwd->ViewCustomAttributes = "";

			// ga_profileid
			$tbl_profile->ga_profileid->ViewValue = $tbl_profile->ga_profileid->CurrentValue;
			$tbl_profile->ga_profileid->CssStyle = "";
			$tbl_profile->ga_profileid->CssClass = "";
			$tbl_profile->ga_profileid->ViewCustomAttributes = "";

			// url
			$tbl_profile->url->ViewValue = $tbl_profile->url->CurrentValue;
			$tbl_profile->url->CssStyle = "";
			$tbl_profile->url->CssClass = "";
			$tbl_profile->url->ViewCustomAttributes = "";

			// fb_pageid
			$tbl_profile->fb_pageid->ViewValue = $tbl_profile->fb_pageid->CurrentValue;
			$tbl_profile->fb_pageid->CssStyle = "";
			$tbl_profile->fb_pageid->CssClass = "";
			$tbl_profile->fb_pageid->ViewCustomAttributes = "";

			// twitter_page
			$tbl_profile->twitter_page->ViewValue = $tbl_profile->twitter_page->CurrentValue;
			$tbl_profile->twitter_page->CssStyle = "";
			$tbl_profile->twitter_page->CssClass = "";
			$tbl_profile->twitter_page->ViewCustomAttributes = "";

			// is_wordpress
			if (strval($tbl_profile->is_wordpress->CurrentValue) <> "") {
				switch ($tbl_profile->is_wordpress->CurrentValue) {
					case "0":
						$tbl_profile->is_wordpress->ViewValue = "No";
						break;
					case "1":
						$tbl_profile->is_wordpress->ViewValue = "Yes";
						break;
					default:
						$tbl_profile->is_wordpress->ViewValue = $tbl_profile->is_wordpress->CurrentValue;
				}
			} else {
				$tbl_profile->is_wordpress->ViewValue = NULL;
			}
			$tbl_profile->is_wordpress->CssStyle = "";
			$tbl_profile->is_wordpress->CssClass = "";
			$tbl_profile->is_wordpress->ViewCustomAttributes = "";

			// is_blogger
			if (strval($tbl_profile->is_blogger->CurrentValue) <> "") {
				switch ($tbl_profile->is_blogger->CurrentValue) {
					case "0":
						$tbl_profile->is_blogger->ViewValue = "No";
						break;
					case "1":
						$tbl_profile->is_blogger->ViewValue = "Yes";
						break;
					default:
						$tbl_profile->is_blogger->ViewValue = $tbl_profile->is_blogger->CurrentValue;
				}
			} else {
				$tbl_profile->is_blogger->ViewValue = NULL;
			}
			$tbl_profile->is_blogger->CssStyle = "";
			$tbl_profile->is_blogger->CssClass = "";
			$tbl_profile->is_blogger->ViewCustomAttributes = "";

			// is_active
			if (strval($tbl_profile->is_active->CurrentValue) <> "") {
				switch ($tbl_profile->is_active->CurrentValue) {
					case "0":
						$tbl_profile->is_active->ViewValue = "No";
						break;
					case "1":
						$tbl_profile->is_active->ViewValue = "Yes";
						break;
					default:
						$tbl_profile->is_active->ViewValue = $tbl_profile->is_active->CurrentValue;
				}
			} else {
				$tbl_profile->is_active->ViewValue = NULL;
			}
			$tbl_profile->is_active->CssStyle = "";
			$tbl_profile->is_active->CssClass = "";
			$tbl_profile->is_active->ViewCustomAttributes = "";

			// id
			$tbl_profile->id->HrefValue = "";
			$tbl_profile->id->TooltipValue = "";

			// name
			$tbl_profile->name->HrefValue = "";
			$tbl_profile->name->TooltipValue = "";

			// ga_username
			$tbl_profile->ga_username->HrefValue = "";
			$tbl_profile->ga_username->TooltipValue = "";

			// ga_passwd
			$tbl_profile->ga_passwd->HrefValue = "";
			$tbl_profile->ga_passwd->TooltipValue = "";

			// ga_profileid
			$tbl_profile->ga_profileid->HrefValue = "";
			$tbl_profile->ga_profileid->TooltipValue = "";

			// url
			$tbl_profile->url->HrefValue = "";
			$tbl_profile->url->TooltipValue = "";

			// fb_pageid
			$tbl_profile->fb_pageid->HrefValue = "";
			$tbl_profile->fb_pageid->TooltipValue = "";

			// twitter_page
			$tbl_profile->twitter_page->HrefValue = "";
			$tbl_profile->twitter_page->TooltipValue = "";

			// is_wordpress
			$tbl_profile->is_wordpress->HrefValue = "";
			$tbl_profile->is_wordpress->TooltipValue = "";

			// is_blogger
			$tbl_profile->is_blogger->HrefValue = "";
			$tbl_profile->is_blogger->TooltipValue = "";

			// is_active
			$tbl_profile->is_active->HrefValue = "";
			$tbl_profile->is_active->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tbl_profile->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_profile->Row_Rendered();
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
