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
$tbl_group_delete = new ctbl_group_delete();
$Page =& $tbl_group_delete;

// Page init
$tbl_group_delete->Page_Init();

// Page main
$tbl_group_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_group_delete = new ew_Page("tbl_group_delete");

// page properties
tbl_group_delete.PageID = "delete"; // page ID
tbl_group_delete.FormID = "ftbl_groupdelete"; // form ID
var EW_PAGE_ID = tbl_group_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_group_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_group_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_group_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_group_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_group_delete.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_group_delete.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
if ($rs = $tbl_group_delete->LoadRecordset())
	$tbl_group_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($tbl_group_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$tbl_group_delete->Page_Terminate("tbl_grouplist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_group->TableCaption() ?><br><br>
<a href="<?php echo $tbl_group->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_group_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="tbl_group">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_group_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $tbl_group->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $tbl_group->id->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_group->name->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_group->is_active->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_group_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$tbl_group_delete->lRecCnt++;

	// Set row properties
	$tbl_group->CssClass = "";
	$tbl_group->CssStyle = "";
	$tbl_group->RowAttrs = array();
	$tbl_group->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_group_delete->LoadRowValues($rs);

	// Render row
	$tbl_group_delete->RenderRow();
?>
	<tr<?php echo $tbl_group->RowAttributes() ?>>
		<td<?php echo $tbl_group->id->CellAttributes() ?>>
<div<?php echo $tbl_group->id->ViewAttributes() ?>><?php echo $tbl_group->id->ListViewValue() ?></div></td>
		<td<?php echo $tbl_group->name->CellAttributes() ?>>
<div<?php echo $tbl_group->name->ViewAttributes() ?>><?php echo $tbl_group->name->ListViewValue() ?></div></td>
		<td<?php echo $tbl_group->is_active->CellAttributes() ?>>
<div<?php echo $tbl_group->is_active->ViewAttributes() ?>><?php echo $tbl_group->is_active->ListViewValue() ?></div></td>
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
$tbl_group_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_group_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'tbl_group';

	// Page object name
	var $PageObjName = 'tbl_group_delete';

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
	function ctbl_group_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_group)
		$GLOBALS["tbl_group"] = new ctbl_group();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
		if (!$Security->CanDelete()) {
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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $tbl_group;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$tbl_group->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($tbl_group->id->QueryStringValue))
				$this->Page_Terminate("tbl_grouplist.php"); // Prevent SQL injection, exit
			$sKey .= $tbl_group->id->QueryStringValue;
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
			$this->Page_Terminate("tbl_grouplist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("tbl_grouplist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_group class, tbl_groupinfo.php

		$tbl_group->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$tbl_group->CurrentAction = $_POST["a_delete"];
		} else {
			$tbl_group->CurrentAction = "D"; // Delete record directly
		}
		switch ($tbl_group->CurrentAction) {
			case "D": // Delete
				$tbl_group->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($tbl_group->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $tbl_group;
		$DeleteRows = TRUE;
		$sWrkFilter = $tbl_group->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in tbl_group class, tbl_groupinfo.php

		$tbl_group->CurrentFilter = $sWrkFilter;
		$sSql = $tbl_group->SQL();
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
				$DeleteRows = $tbl_group->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($tbl_group->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($tbl_group->CancelMessage <> "") {
				$this->setMessage($tbl_group->CancelMessage);
				$tbl_group->CancelMessage = "";
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
				$tbl_group->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
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
