<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_ga_statinfo.php" ?>
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
$tbl_ga_stat_delete = new ctbl_ga_stat_delete();
$Page =& $tbl_ga_stat_delete;

// Page init
$tbl_ga_stat_delete->Page_Init();

// Page main
$tbl_ga_stat_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_ga_stat_delete = new ew_Page("tbl_ga_stat_delete");

// page properties
tbl_ga_stat_delete.PageID = "delete"; // page ID
tbl_ga_stat_delete.FormID = "ftbl_ga_statdelete"; // form ID
var EW_PAGE_ID = tbl_ga_stat_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_ga_stat_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_ga_stat_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_ga_stat_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_ga_stat_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_ga_stat_delete.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_ga_stat_delete.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
if ($rs = $tbl_ga_stat_delete->LoadRecordset())
	$tbl_ga_stat_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($tbl_ga_stat_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$tbl_ga_stat_delete->Page_Terminate("tbl_ga_statlist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_ga_stat->TableCaption() ?><br><br>
<a href="<?php echo $tbl_ga_stat->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_ga_stat_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="tbl_ga_stat">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_ga_stat_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $tbl_ga_stat->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $tbl_ga_stat->id_profile->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_ga_stat->stat_date->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_ga_stat->year->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_ga_stat->month->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_ga_stat->week->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_ga_stat->day->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_ga_stat->hour->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_ga_stat->pageview->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_ga_stat->visit->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_ga_stat_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$tbl_ga_stat_delete->lRecCnt++;

	// Set row properties
	$tbl_ga_stat->CssClass = "";
	$tbl_ga_stat->CssStyle = "";
	$tbl_ga_stat->RowAttrs = array();
	$tbl_ga_stat->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_ga_stat_delete->LoadRowValues($rs);

	// Render row
	$tbl_ga_stat_delete->RenderRow();
?>
	<tr<?php echo $tbl_ga_stat->RowAttributes() ?>>
		<td<?php echo $tbl_ga_stat->id_profile->CellAttributes() ?>>
<div<?php echo $tbl_ga_stat->id_profile->ViewAttributes() ?>><?php echo $tbl_ga_stat->id_profile->ListViewValue() ?></div></td>
		<td<?php echo $tbl_ga_stat->stat_date->CellAttributes() ?>>
<div<?php echo $tbl_ga_stat->stat_date->ViewAttributes() ?>><?php echo $tbl_ga_stat->stat_date->ListViewValue() ?></div></td>
		<td<?php echo $tbl_ga_stat->year->CellAttributes() ?>>
<div<?php echo $tbl_ga_stat->year->ViewAttributes() ?>><?php echo $tbl_ga_stat->year->ListViewValue() ?></div></td>
		<td<?php echo $tbl_ga_stat->month->CellAttributes() ?>>
<div<?php echo $tbl_ga_stat->month->ViewAttributes() ?>><?php echo $tbl_ga_stat->month->ListViewValue() ?></div></td>
		<td<?php echo $tbl_ga_stat->week->CellAttributes() ?>>
<div<?php echo $tbl_ga_stat->week->ViewAttributes() ?>><?php echo $tbl_ga_stat->week->ListViewValue() ?></div></td>
		<td<?php echo $tbl_ga_stat->day->CellAttributes() ?>>
<div<?php echo $tbl_ga_stat->day->ViewAttributes() ?>><?php echo $tbl_ga_stat->day->ListViewValue() ?></div></td>
		<td<?php echo $tbl_ga_stat->hour->CellAttributes() ?>>
<div<?php echo $tbl_ga_stat->hour->ViewAttributes() ?>><?php echo $tbl_ga_stat->hour->ListViewValue() ?></div></td>
		<td<?php echo $tbl_ga_stat->pageview->CellAttributes() ?>>
<div<?php echo $tbl_ga_stat->pageview->ViewAttributes() ?>><?php echo $tbl_ga_stat->pageview->ListViewValue() ?></div></td>
		<td<?php echo $tbl_ga_stat->visit->CellAttributes() ?>>
<div<?php echo $tbl_ga_stat->visit->ViewAttributes() ?>><?php echo $tbl_ga_stat->visit->ListViewValue() ?></div></td>
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
$tbl_ga_stat_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_ga_stat_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'tbl_ga_stat';

	// Page object name
	var $PageObjName = 'tbl_ga_stat_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_ga_stat;
		if ($tbl_ga_stat->UseTokenInUrl) $PageUrl .= "t=" . $tbl_ga_stat->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_ga_stat;
		if ($tbl_ga_stat->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_ga_stat->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_ga_stat->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_ga_stat_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_ga_stat)
		$GLOBALS["tbl_ga_stat"] = new ctbl_ga_stat();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_ga_stat', TRUE);

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
		global $tbl_ga_stat;

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
			$this->Page_Terminate("tbl_ga_statlist.php");
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
		global $Language, $tbl_ga_stat;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id_profile"] <> "") {
			$tbl_ga_stat->id_profile->setQueryStringValue($_GET["id_profile"]);
			if (!is_numeric($tbl_ga_stat->id_profile->QueryStringValue))
				$this->Page_Terminate("tbl_ga_statlist.php"); // Prevent SQL injection, exit
			$sKey .= $tbl_ga_stat->id_profile->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if (@$_GET["stat_date"] <> "") {
			$tbl_ga_stat->stat_date->setQueryStringValue($_GET["stat_date"]);
			if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
			$sKey .= $tbl_ga_stat->stat_date->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if (@$_GET["hour"] <> "") {
			$tbl_ga_stat->hour->setQueryStringValue($_GET["hour"]);
			if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
			$sKey .= $tbl_ga_stat->hour->QueryStringValue;
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
			$this->Page_Terminate("tbl_ga_statlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";
			$arKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, trim($sKey)); // Split key by separator
			if (count($arKeyFlds) <> 3)
				$this->Page_Terminate($tbl_ga_stat->getReturnUrl()); // Invalid key, exit

			// Set up key field
			$sKeyFld = $arKeyFlds[0];
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("tbl_ga_statlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id_profile`=" . ew_AdjustSql($sKeyFld) . " AND ";

			// Set up key field
			$sKeyFld = $arKeyFlds[1];
			$sFilter .= "`stat_date`='" . ew_AdjustSql($sKeyFld) . "' AND ";

			// Set up key field
			$sKeyFld = $arKeyFlds[2];
			$sFilter .= "`hour`='" . ew_AdjustSql($sKeyFld) . "' AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_ga_stat class, tbl_ga_statinfo.php

		$tbl_ga_stat->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$tbl_ga_stat->CurrentAction = $_POST["a_delete"];
		} else {
			$tbl_ga_stat->CurrentAction = "D"; // Delete record directly
		}
		switch ($tbl_ga_stat->CurrentAction) {
			case "D": // Delete
				$tbl_ga_stat->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($tbl_ga_stat->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $tbl_ga_stat;
		$DeleteRows = TRUE;
		$sWrkFilter = $tbl_ga_stat->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in tbl_ga_stat class, tbl_ga_statinfo.php

		$tbl_ga_stat->CurrentFilter = $sWrkFilter;
		$sSql = $tbl_ga_stat->SQL();
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
				$DeleteRows = $tbl_ga_stat->Row_Deleting($row);
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
				$sThisKey .= $row['stat_date'];
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['hour'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($tbl_ga_stat->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($tbl_ga_stat->CancelMessage <> "") {
				$this->setMessage($tbl_ga_stat->CancelMessage);
				$tbl_ga_stat->CancelMessage = "";
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
				$tbl_ga_stat->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_ga_stat;

		// Call Recordset Selecting event
		$tbl_ga_stat->Recordset_Selecting($tbl_ga_stat->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_ga_stat->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_ga_stat->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_ga_stat;
		$sFilter = $tbl_ga_stat->KeyFilter();

		// Call Row Selecting event
		$tbl_ga_stat->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_ga_stat->CurrentFilter = $sFilter;
		$sSql = $tbl_ga_stat->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_ga_stat->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_ga_stat;
		$tbl_ga_stat->id_profile->setDbValue($rs->fields('id_profile'));
		$tbl_ga_stat->stat_date->setDbValue($rs->fields('stat_date'));
		$tbl_ga_stat->year->setDbValue($rs->fields('year'));
		$tbl_ga_stat->month->setDbValue($rs->fields('month'));
		$tbl_ga_stat->week->setDbValue($rs->fields('week'));
		$tbl_ga_stat->day->setDbValue($rs->fields('day'));
		$tbl_ga_stat->hour->setDbValue($rs->fields('hour'));
		$tbl_ga_stat->pageview->setDbValue($rs->fields('pageview'));
		$tbl_ga_stat->visit->setDbValue($rs->fields('visit'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_ga_stat;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_ga_stat->Row_Rendering();

		// Common render codes for all row types
		// id_profile

		$tbl_ga_stat->id_profile->CellCssStyle = "white-space: nowrap;"; $tbl_ga_stat->id_profile->CellCssClass = "";
		$tbl_ga_stat->id_profile->CellAttrs = array(); $tbl_ga_stat->id_profile->ViewAttrs = array(); $tbl_ga_stat->id_profile->EditAttrs = array();

		// stat_date
		$tbl_ga_stat->stat_date->CellCssStyle = ""; $tbl_ga_stat->stat_date->CellCssClass = "";
		$tbl_ga_stat->stat_date->CellAttrs = array(); $tbl_ga_stat->stat_date->ViewAttrs = array(); $tbl_ga_stat->stat_date->EditAttrs = array();

		// year
		$tbl_ga_stat->year->CellCssStyle = ""; $tbl_ga_stat->year->CellCssClass = "";
		$tbl_ga_stat->year->CellAttrs = array(); $tbl_ga_stat->year->ViewAttrs = array(); $tbl_ga_stat->year->EditAttrs = array();

		// month
		$tbl_ga_stat->month->CellCssStyle = ""; $tbl_ga_stat->month->CellCssClass = "";
		$tbl_ga_stat->month->CellAttrs = array(); $tbl_ga_stat->month->ViewAttrs = array(); $tbl_ga_stat->month->EditAttrs = array();

		// week
		$tbl_ga_stat->week->CellCssStyle = ""; $tbl_ga_stat->week->CellCssClass = "";
		$tbl_ga_stat->week->CellAttrs = array(); $tbl_ga_stat->week->ViewAttrs = array(); $tbl_ga_stat->week->EditAttrs = array();

		// day
		$tbl_ga_stat->day->CellCssStyle = ""; $tbl_ga_stat->day->CellCssClass = "";
		$tbl_ga_stat->day->CellAttrs = array(); $tbl_ga_stat->day->ViewAttrs = array(); $tbl_ga_stat->day->EditAttrs = array();

		// hour
		$tbl_ga_stat->hour->CellCssStyle = ""; $tbl_ga_stat->hour->CellCssClass = "";
		$tbl_ga_stat->hour->CellAttrs = array(); $tbl_ga_stat->hour->ViewAttrs = array(); $tbl_ga_stat->hour->EditAttrs = array();

		// pageview
		$tbl_ga_stat->pageview->CellCssStyle = ""; $tbl_ga_stat->pageview->CellCssClass = "";
		$tbl_ga_stat->pageview->CellAttrs = array(); $tbl_ga_stat->pageview->ViewAttrs = array(); $tbl_ga_stat->pageview->EditAttrs = array();

		// visit
		$tbl_ga_stat->visit->CellCssStyle = ""; $tbl_ga_stat->visit->CellCssClass = "";
		$tbl_ga_stat->visit->CellAttrs = array(); $tbl_ga_stat->visit->ViewAttrs = array(); $tbl_ga_stat->visit->EditAttrs = array();
		if ($tbl_ga_stat->RowType == EW_ROWTYPE_VIEW) { // View row

			// id_profile
			if (strval($tbl_ga_stat->id_profile->CurrentValue) <> "") {
				$sFilterWrk = "`id` = " . ew_AdjustSql($tbl_ga_stat->id_profile->CurrentValue) . "";
			$sSqlWrk = "SELECT DISTINCT `name` FROM `tbl_profile`";
			$sWhereWrk = "";
			if ($sFilterWrk <> "") {
				if ($sWhereWrk <> "") $sWhereWrk .= " AND ";
				$sWhereWrk .= "(" . $sFilterWrk . ")";
			}
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " ORDER BY `name` Asc";
				$rswrk = $conn->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$tbl_ga_stat->id_profile->ViewValue = $rswrk->fields('name');
					$rswrk->Close();
				} else {
					$tbl_ga_stat->id_profile->ViewValue = $tbl_ga_stat->id_profile->CurrentValue;
				}
			} else {
				$tbl_ga_stat->id_profile->ViewValue = NULL;
			}
			$tbl_ga_stat->id_profile->CssStyle = "";
			$tbl_ga_stat->id_profile->CssClass = "";
			$tbl_ga_stat->id_profile->ViewCustomAttributes = "";

			// stat_date
			$tbl_ga_stat->stat_date->ViewValue = $tbl_ga_stat->stat_date->CurrentValue;
			$tbl_ga_stat->stat_date->ViewValue = ew_FormatDateTime($tbl_ga_stat->stat_date->ViewValue, 5);
			$tbl_ga_stat->stat_date->CssStyle = "";
			$tbl_ga_stat->stat_date->CssClass = "";
			$tbl_ga_stat->stat_date->ViewCustomAttributes = "";

			// year
			$tbl_ga_stat->year->ViewValue = $tbl_ga_stat->year->CurrentValue;
			$tbl_ga_stat->year->CssStyle = "";
			$tbl_ga_stat->year->CssClass = "";
			$tbl_ga_stat->year->ViewCustomAttributes = "";

			// month
			$tbl_ga_stat->month->ViewValue = $tbl_ga_stat->month->CurrentValue;
			$tbl_ga_stat->month->CssStyle = "";
			$tbl_ga_stat->month->CssClass = "";
			$tbl_ga_stat->month->ViewCustomAttributes = "";

			// week
			$tbl_ga_stat->week->ViewValue = $tbl_ga_stat->week->CurrentValue;
			$tbl_ga_stat->week->CssStyle = "";
			$tbl_ga_stat->week->CssClass = "";
			$tbl_ga_stat->week->ViewCustomAttributes = "";

			// day
			if (strval($tbl_ga_stat->day->CurrentValue) <> "") {
				switch ($tbl_ga_stat->day->CurrentValue) {
					case "1":
						$tbl_ga_stat->day->ViewValue = "1";
						break;
					case "2":
						$tbl_ga_stat->day->ViewValue = "2";
						break;
					case "3":
						$tbl_ga_stat->day->ViewValue = "3";
						break;
					case "4":
						$tbl_ga_stat->day->ViewValue = "4";
						break;
					case "5":
						$tbl_ga_stat->day->ViewValue = "5";
						break;
					case "6":
						$tbl_ga_stat->day->ViewValue = "6";
						break;
					case "7":
						$tbl_ga_stat->day->ViewValue = "7";
						break;
					default:
						$tbl_ga_stat->day->ViewValue = $tbl_ga_stat->day->CurrentValue;
				}
			} else {
				$tbl_ga_stat->day->ViewValue = NULL;
			}
			$tbl_ga_stat->day->CssStyle = "";
			$tbl_ga_stat->day->CssClass = "";
			$tbl_ga_stat->day->ViewCustomAttributes = "";

			// hour
			$tbl_ga_stat->hour->ViewValue = $tbl_ga_stat->hour->CurrentValue;
			$tbl_ga_stat->hour->ViewValue = ew_FormatDateTime($tbl_ga_stat->hour->ViewValue, 4);
			$tbl_ga_stat->hour->CssStyle = "";
			$tbl_ga_stat->hour->CssClass = "";
			$tbl_ga_stat->hour->ViewCustomAttributes = "";

			// pageview
			$tbl_ga_stat->pageview->ViewValue = $tbl_ga_stat->pageview->CurrentValue;
			$tbl_ga_stat->pageview->CssStyle = "";
			$tbl_ga_stat->pageview->CssClass = "";
			$tbl_ga_stat->pageview->ViewCustomAttributes = "";

			// visit
			$tbl_ga_stat->visit->ViewValue = $tbl_ga_stat->visit->CurrentValue;
			$tbl_ga_stat->visit->CssStyle = "";
			$tbl_ga_stat->visit->CssClass = "";
			$tbl_ga_stat->visit->ViewCustomAttributes = "";

			// id_profile
			$tbl_ga_stat->id_profile->HrefValue = "";
			$tbl_ga_stat->id_profile->TooltipValue = "";

			// stat_date
			$tbl_ga_stat->stat_date->HrefValue = "";
			$tbl_ga_stat->stat_date->TooltipValue = "";

			// year
			$tbl_ga_stat->year->HrefValue = "";
			$tbl_ga_stat->year->TooltipValue = "";

			// month
			$tbl_ga_stat->month->HrefValue = "";
			$tbl_ga_stat->month->TooltipValue = "";

			// week
			$tbl_ga_stat->week->HrefValue = "";
			$tbl_ga_stat->week->TooltipValue = "";

			// day
			$tbl_ga_stat->day->HrefValue = "";
			$tbl_ga_stat->day->TooltipValue = "";

			// hour
			$tbl_ga_stat->hour->HrefValue = "";
			$tbl_ga_stat->hour->TooltipValue = "";

			// pageview
			$tbl_ga_stat->pageview->HrefValue = "";
			$tbl_ga_stat->pageview->TooltipValue = "";

			// visit
			$tbl_ga_stat->visit->HrefValue = "";
			$tbl_ga_stat->visit->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tbl_ga_stat->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_ga_stat->Row_Rendered();
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
