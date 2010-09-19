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
$tbl_target_view = new ctbl_target_view();
$Page =& $tbl_target_view;

// Page init
$tbl_target_view->Page_Init();

// Page main
$tbl_target_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($tbl_target->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_target_view = new ew_Page("tbl_target_view");

// page properties
tbl_target_view.PageID = "view"; // page ID
tbl_target_view.FormID = "ftbl_targetview"; // form ID
var EW_PAGE_ID = tbl_target_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_target_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_target_view.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_target_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_target_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_target_view.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_target_view.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_target->TableCaption() ?>
<br><br>
<?php if ($tbl_target->Export == "") { ?>
<a href="<?php echo $tbl_target_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_target_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanEdit()) { ?>
<a href="<?php echo $tbl_target_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanAdd()) { ?>
<a href="<?php echo $tbl_target_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->CanDelete()) { ?>
<a onclick="return ew_Confirm(ewLanguage.Phrase('DeleteConfirmMsg'));" href="<?php echo $tbl_target_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_target_view->ShowMessage();
?>
<p>
<?php if ($tbl_target->Export == "") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_target_view->Pager)) $tbl_target_view->Pager = new cPrevNextPager($tbl_target_view->lStartRec, $tbl_target_view->lDisplayRecs, $tbl_target_view->lTotalRecs) ?>
<?php if ($tbl_target_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_target_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_target_view->PageUrl() ?>start=<?php echo $tbl_target_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_target_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_target_view->PageUrl() ?>start=<?php echo $tbl_target_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_target_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_target_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_target_view->PageUrl() ?>start=<?php echo $tbl_target_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_target_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_target_view->PageUrl() ?>start=<?php echo $tbl_target_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_target_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_target_view->sSrchWhere == "0=101") { ?>
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
<?php if ($tbl_target->id_profile->Visible) { // id_profile ?>
	<tr<?php echo $tbl_target->id_profile->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->id_profile->FldCaption() ?></td>
		<td<?php echo $tbl_target->id_profile->CellAttributes() ?>>
<div<?php echo $tbl_target->id_profile->ViewAttributes() ?>><?php echo $tbl_target->id_profile->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->year->Visible) { // year ?>
	<tr<?php echo $tbl_target->year->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->year->FldCaption() ?></td>
		<td<?php echo $tbl_target->year->CellAttributes() ?>>
<div<?php echo $tbl_target->year->ViewAttributes() ?>><?php echo $tbl_target->year->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->month->Visible) { // month ?>
	<tr<?php echo $tbl_target->month->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->month->FldCaption() ?></td>
		<td<?php echo $tbl_target->month->CellAttributes() ?>>
<div<?php echo $tbl_target->month->ViewAttributes() ?>><?php echo $tbl_target->month->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->visit->Visible) { // visit ?>
	<tr<?php echo $tbl_target->visit->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->visit->FldCaption() ?></td>
		<td<?php echo $tbl_target->visit->CellAttributes() ?>>
<div<?php echo $tbl_target->visit->ViewAttributes() ?>><?php echo $tbl_target->visit->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->pageview->Visible) { // pageview ?>
	<tr<?php echo $tbl_target->pageview->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->pageview->FldCaption() ?></td>
		<td<?php echo $tbl_target->pageview->CellAttributes() ?>>
<div<?php echo $tbl_target->pageview->ViewAttributes() ?>><?php echo $tbl_target->pageview->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->alexarank->Visible) { // alexarank ?>
	<tr<?php echo $tbl_target->alexarank->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->alexarank->FldCaption() ?></td>
		<td<?php echo $tbl_target->alexarank->CellAttributes() ?>>
<div<?php echo $tbl_target->alexarank->ViewAttributes() ?>><?php echo $tbl_target->alexarank->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->googlepagerank->Visible) { // googlepagerank ?>
	<tr<?php echo $tbl_target->googlepagerank->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->googlepagerank->FldCaption() ?></td>
		<td<?php echo $tbl_target->googlepagerank->CellAttributes() ?>>
<div<?php echo $tbl_target->googlepagerank->ViewAttributes() ?>><?php echo $tbl_target->googlepagerank->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->googleindexedpage->Visible) { // googleindexedpage ?>
	<tr<?php echo $tbl_target->googleindexedpage->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->googleindexedpage->FldCaption() ?></td>
		<td<?php echo $tbl_target->googleindexedpage->CellAttributes() ?>>
<div<?php echo $tbl_target->googleindexedpage->ViewAttributes() ?>><?php echo $tbl_target->googleindexedpage->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->yahooindexedpage->Visible) { // yahooindexedpage ?>
	<tr<?php echo $tbl_target->yahooindexedpage->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->yahooindexedpage->FldCaption() ?></td>
		<td<?php echo $tbl_target->yahooindexedpage->CellAttributes() ?>>
<div<?php echo $tbl_target->yahooindexedpage->ViewAttributes() ?>><?php echo $tbl_target->yahooindexedpage->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->bingindexedpage->Visible) { // bingindexedpage ?>
	<tr<?php echo $tbl_target->bingindexedpage->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->bingindexedpage->FldCaption() ?></td>
		<td<?php echo $tbl_target->bingindexedpage->CellAttributes() ?>>
<div<?php echo $tbl_target->bingindexedpage->ViewAttributes() ?>><?php echo $tbl_target->bingindexedpage->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->twitterfollower->Visible) { // twitterfollower ?>
	<tr<?php echo $tbl_target->twitterfollower->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->twitterfollower->FldCaption() ?></td>
		<td<?php echo $tbl_target->twitterfollower->CellAttributes() ?>>
<div<?php echo $tbl_target->twitterfollower->ViewAttributes() ?>><?php echo $tbl_target->twitterfollower->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->facebookfan->Visible) { // facebookfan ?>
	<tr<?php echo $tbl_target->facebookfan->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->facebookfan->FldCaption() ?></td>
		<td<?php echo $tbl_target->facebookfan->CellAttributes() ?>>
<div<?php echo $tbl_target->facebookfan->ViewAttributes() ?>><?php echo $tbl_target->facebookfan->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->yahoobacklink->Visible) { // yahoobacklink ?>
	<tr<?php echo $tbl_target->yahoobacklink->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->yahoobacklink->FldCaption() ?></td>
		<td<?php echo $tbl_target->yahoobacklink->CellAttributes() ?>>
<div<?php echo $tbl_target->yahoobacklink->ViewAttributes() ?>><?php echo $tbl_target->yahoobacklink->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->blwbacklink->Visible) { // blwbacklink ?>
	<tr<?php echo $tbl_target->blwbacklink->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->blwbacklink->FldCaption() ?></td>
		<td<?php echo $tbl_target->blwbacklink->CellAttributes() ?>>
<div<?php echo $tbl_target->blwbacklink->ViewAttributes() ?>><?php echo $tbl_target->blwbacklink->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($tbl_target->blcbacklink->Visible) { // blcbacklink ?>
	<tr<?php echo $tbl_target->blcbacklink->RowAttributes ?>>
		<td class="ewTableHeader"><?php echo $tbl_target->blcbacklink->FldCaption() ?></td>
		<td<?php echo $tbl_target->blcbacklink->CellAttributes() ?>>
<div<?php echo $tbl_target->blcbacklink->ViewAttributes() ?>><?php echo $tbl_target->blcbacklink->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<?php if ($tbl_target->Export == "") { ?>
<br>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($tbl_target_view->Pager)) $tbl_target_view->Pager = new cPrevNextPager($tbl_target_view->lStartRec, $tbl_target_view->lDisplayRecs, $tbl_target_view->lTotalRecs) ?>
<?php if ($tbl_target_view->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($tbl_target_view->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_target_view->PageUrl() ?>start=<?php echo $tbl_target_view->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($tbl_target_view->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_target_view->PageUrl() ?>start=<?php echo $tbl_target_view->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $tbl_target_view->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($tbl_target_view->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_target_view->PageUrl() ?>start=<?php echo $tbl_target_view->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($tbl_target_view->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $tbl_target_view->PageUrl() ?>start=<?php echo $tbl_target_view->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $tbl_target_view->Pager->PageCount ?></span></td>
	</tr></table>
<?php } else { ?>
	<?php if ($Security->CanList()) { ?>
	<?php if ($tbl_target_view->sSrchWhere == "0=101") { ?>
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
$tbl_target_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_target_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'tbl_target';

	// Page object name
	var $PageObjName = 'tbl_target_view';

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
	function ctbl_target_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_target)
		$GLOBALS["tbl_target"] = new ctbl_target();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_target', TRUE);

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
		if (!$Security->CanView()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("tbl_targetlist.php");
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
		global $Language, $tbl_target;

		// Load current record
		$bLoadCurrentRecord = FALSE;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id_profile"] <> "") {
				$tbl_target->id_profile->setQueryStringValue($_GET["id_profile"]);
				$this->arRecKey["id_profile"] = $tbl_target->id_profile->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}
			if (@$_GET["year"] <> "") {
				$tbl_target->year->setQueryStringValue($_GET["year"]);
				$this->arRecKey["year"] = $tbl_target->year->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}
			if (@$_GET["month"] <> "") {
				$tbl_target->month->setQueryStringValue($_GET["month"]);
				$this->arRecKey["month"] = $tbl_target->month->QueryStringValue;
			} else {
				$bLoadCurrentRecord = TRUE;
			}

			// Get action
			$tbl_target->CurrentAction = "I"; // Display form
			switch ($tbl_target->CurrentAction) {
				case "I": // Get a record to display
					$this->lStartRec = 1; // Initialize start position
					if ($rs = $this->LoadRecordset()) // Load records
						$this->lTotalRecs = $rs->RecordCount(); // Get record count
					if ($this->lTotalRecs <= 0) { // No record found
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$this->Page_Terminate("tbl_targetlist.php"); // Return to list page
					} elseif ($bLoadCurrentRecord) { // Load current record position
						$this->SetUpStartRec(); // Set up start record position

						// Point to current record
						if (intval($this->lStartRec) <= intval($this->lTotalRecs)) {
							$bMatchRecord = TRUE;
							$rs->Move($this->lStartRec-1);
						}
					} else { // Match key values
						while (!$rs->EOF) {
							if (strval($tbl_target->id_profile->CurrentValue) == strval($rs->fields('id_profile')) AND strval($tbl_target->year->CurrentValue) == strval($rs->fields('year')) AND strval($tbl_target->month->CurrentValue) == strval($rs->fields('month'))) {
								$tbl_target->setStartRecordNumber($this->lStartRec); // Save record position
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
						$sReturnUrl = "tbl_targetlist.php"; // No matching record, return to list
					} else {
						$this->LoadRowValues($rs); // Load row values
					}
			}
		} else {
			$sReturnUrl = "tbl_targetlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$tbl_target->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id_profile=" . urlencode($tbl_target->id_profile->CurrentValue) . "&year=" . urlencode($tbl_target->year->CurrentValue) . "&month=" . urlencode($tbl_target->month->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id_profile=" . urlencode($tbl_target->id_profile->CurrentValue) . "&year=" . urlencode($tbl_target->year->CurrentValue) . "&month=" . urlencode($tbl_target->month->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id_profile=" . urlencode($tbl_target->id_profile->CurrentValue) . "&year=" . urlencode($tbl_target->year->CurrentValue) . "&month=" . urlencode($tbl_target->month->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id_profile=" . urlencode($tbl_target->id_profile->CurrentValue) . "&year=" . urlencode($tbl_target->year->CurrentValue) . "&month=" . urlencode($tbl_target->month->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id_profile=" . urlencode($tbl_target->id_profile->CurrentValue) . "&year=" . urlencode($tbl_target->year->CurrentValue) . "&month=" . urlencode($tbl_target->month->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id_profile=" . urlencode($tbl_target->id_profile->CurrentValue) . "&year=" . urlencode($tbl_target->year->CurrentValue) . "&month=" . urlencode($tbl_target->month->CurrentValue);
		$this->AddUrl = $tbl_target->AddUrl();
		$this->EditUrl = $tbl_target->EditUrl();
		$this->CopyUrl = $tbl_target->CopyUrl();
		$this->DeleteUrl = $tbl_target->DeleteUrl();
		$this->ListUrl = $tbl_target->ListUrl();

		// Call Row_Rendering event
		$tbl_target->Row_Rendering();

		// Common render codes for all row types
		// id_profile

		$tbl_target->id_profile->CellCssStyle = ""; $tbl_target->id_profile->CellCssClass = "";
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
		}

		// Call Row Rendered event
		if ($tbl_target->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_target->Row_Rendered();
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
