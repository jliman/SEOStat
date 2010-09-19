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
$tbl_target_delete = new ctbl_target_delete();
$Page =& $tbl_target_delete;

// Page init
$tbl_target_delete->Page_Init();

// Page main
$tbl_target_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_target_delete = new ew_Page("tbl_target_delete");

// page properties
tbl_target_delete.PageID = "delete"; // page ID
tbl_target_delete.FormID = "ftbl_targetdelete"; // form ID
var EW_PAGE_ID = tbl_target_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_target_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_target_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_target_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_target_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_target_delete.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_target_delete.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php

// Load records for display
if ($rs = $tbl_target_delete->LoadRecordset())
	$tbl_target_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($tbl_target_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$tbl_target_delete->Page_Terminate("tbl_targetlist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_target->TableCaption() ?><br><br>
<a href="<?php echo $tbl_target->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_target_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="tbl_target">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_target_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $tbl_target->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $tbl_target->id_profile->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_target->year->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_target->month->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_target->visit->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_target->pageview->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_target->alexarank->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_target->googlepagerank->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_target->googleindexedpage->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_target->yahooindexedpage->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_target->bingindexedpage->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_target->twitterfollower->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_target->facebookfan->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_target->yahoobacklink->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_target->blwbacklink->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_target->blcbacklink->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_target_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$tbl_target_delete->lRecCnt++;

	// Set row properties
	$tbl_target->CssClass = "";
	$tbl_target->CssStyle = "";
	$tbl_target->RowAttrs = array();
	$tbl_target->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_target_delete->LoadRowValues($rs);

	// Render row
	$tbl_target_delete->RenderRow();
?>
	<tr<?php echo $tbl_target->RowAttributes() ?>>
		<td<?php echo $tbl_target->id_profile->CellAttributes() ?>>
<div<?php echo $tbl_target->id_profile->ViewAttributes() ?>><?php echo $tbl_target->id_profile->ListViewValue() ?></div></td>
		<td<?php echo $tbl_target->year->CellAttributes() ?>>
<div<?php echo $tbl_target->year->ViewAttributes() ?>><?php echo $tbl_target->year->ListViewValue() ?></div></td>
		<td<?php echo $tbl_target->month->CellAttributes() ?>>
<div<?php echo $tbl_target->month->ViewAttributes() ?>><?php echo $tbl_target->month->ListViewValue() ?></div></td>
		<td<?php echo $tbl_target->visit->CellAttributes() ?>>
<div<?php echo $tbl_target->visit->ViewAttributes() ?>><?php echo $tbl_target->visit->ListViewValue() ?></div></td>
		<td<?php echo $tbl_target->pageview->CellAttributes() ?>>
<div<?php echo $tbl_target->pageview->ViewAttributes() ?>><?php echo $tbl_target->pageview->ListViewValue() ?></div></td>
		<td<?php echo $tbl_target->alexarank->CellAttributes() ?>>
<div<?php echo $tbl_target->alexarank->ViewAttributes() ?>><?php echo $tbl_target->alexarank->ListViewValue() ?></div></td>
		<td<?php echo $tbl_target->googlepagerank->CellAttributes() ?>>
<div<?php echo $tbl_target->googlepagerank->ViewAttributes() ?>><?php echo $tbl_target->googlepagerank->ListViewValue() ?></div></td>
		<td<?php echo $tbl_target->googleindexedpage->CellAttributes() ?>>
<div<?php echo $tbl_target->googleindexedpage->ViewAttributes() ?>><?php echo $tbl_target->googleindexedpage->ListViewValue() ?></div></td>
		<td<?php echo $tbl_target->yahooindexedpage->CellAttributes() ?>>
<div<?php echo $tbl_target->yahooindexedpage->ViewAttributes() ?>><?php echo $tbl_target->yahooindexedpage->ListViewValue() ?></div></td>
		<td<?php echo $tbl_target->bingindexedpage->CellAttributes() ?>>
<div<?php echo $tbl_target->bingindexedpage->ViewAttributes() ?>><?php echo $tbl_target->bingindexedpage->ListViewValue() ?></div></td>
		<td<?php echo $tbl_target->twitterfollower->CellAttributes() ?>>
<div<?php echo $tbl_target->twitterfollower->ViewAttributes() ?>><?php echo $tbl_target->twitterfollower->ListViewValue() ?></div></td>
		<td<?php echo $tbl_target->facebookfan->CellAttributes() ?>>
<div<?php echo $tbl_target->facebookfan->ViewAttributes() ?>><?php echo $tbl_target->facebookfan->ListViewValue() ?></div></td>
		<td<?php echo $tbl_target->yahoobacklink->CellAttributes() ?>>
<div<?php echo $tbl_target->yahoobacklink->ViewAttributes() ?>><?php echo $tbl_target->yahoobacklink->ListViewValue() ?></div></td>
		<td<?php echo $tbl_target->blwbacklink->CellAttributes() ?>>
<div<?php echo $tbl_target->blwbacklink->ViewAttributes() ?>><?php echo $tbl_target->blwbacklink->ListViewValue() ?></div></td>
		<td<?php echo $tbl_target->blcbacklink->CellAttributes() ?>>
<div<?php echo $tbl_target->blcbacklink->ViewAttributes() ?>><?php echo $tbl_target->blcbacklink->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$tbl_target_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_target_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'tbl_target';

	// Page object name
	var $PageObjName = 'tbl_target_delete';

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
	function ctbl_target_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_target)
		$GLOBALS["tbl_target"] = new ctbl_target();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
		if (!$Security->CanDelete()) {
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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $tbl_target;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id_profile"] <> "") {
			$tbl_target->id_profile->setQueryStringValue($_GET["id_profile"]);
			if (!is_numeric($tbl_target->id_profile->QueryStringValue))
				$this->Page_Terminate("tbl_targetlist.php"); // Prevent SQL injection, exit
			$sKey .= $tbl_target->id_profile->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if (@$_GET["year"] <> "") {
			$tbl_target->year->setQueryStringValue($_GET["year"]);
			if (!is_numeric($tbl_target->year->QueryStringValue))
				$this->Page_Terminate("tbl_targetlist.php"); // Prevent SQL injection, exit
			if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
			$sKey .= $tbl_target->year->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if (@$_GET["month"] <> "") {
			$tbl_target->month->setQueryStringValue($_GET["month"]);
			if (!is_numeric($tbl_target->month->QueryStringValue))
				$this->Page_Terminate("tbl_targetlist.php"); // Prevent SQL injection, exit
			if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
			$sKey .= $tbl_target->month->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("tbl_targetlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";
			$arKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, trim($sKey)); // Split key by separator
			if (count($arKeyFlds) <> 3)
				$this->Page_Terminate($tbl_target->getReturnUrl()); // Invalid key, exit

			// Set up key field
			$sKeyFld = $arKeyFlds[0];
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("tbl_targetlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id_profile`=" . ew_AdjustSql($sKeyFld) . " AND ";

			// Set up key field
			$sKeyFld = $arKeyFlds[1];
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("tbl_targetlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`year`=" . ew_AdjustSql($sKeyFld) . " AND ";

			// Set up key field
			$sKeyFld = $arKeyFlds[2];
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("tbl_targetlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`month`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_target class, tbl_targetinfo.php

		$tbl_target->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$tbl_target->CurrentAction = $_POST["a_delete"];
		} else {
			$tbl_target->CurrentAction = "D"; // Delete record directly
		}
		switch ($tbl_target->CurrentAction) {
			case "D": // Delete
				$tbl_target->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($tbl_target->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $tbl_target;
		$DeleteRows = TRUE;
		$sWrkFilter = $tbl_target->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in tbl_target class, tbl_targetinfo.php

		$tbl_target->CurrentFilter = $sWrkFilter;
		$sSql = $tbl_target->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $tbl_target->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_profile'];
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['year'];
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['month'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($tbl_target->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($tbl_target->CancelMessage <> "") {
				$this->setMessage($tbl_target->CancelMessage);
				$tbl_target->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$tbl_target->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
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
