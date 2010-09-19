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
$tbl_user_level_permissions_delete = new ctbl_user_level_permissions_delete();
$Page =& $tbl_user_level_permissions_delete;

// Page init
$tbl_user_level_permissions_delete->Page_Init();

// Page main
$tbl_user_level_permissions_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_user_level_permissions_delete = new ew_Page("tbl_user_level_permissions_delete");

// page properties
tbl_user_level_permissions_delete.PageID = "delete"; // page ID
tbl_user_level_permissions_delete.FormID = "ftbl_user_level_permissionsdelete"; // form ID
var EW_PAGE_ID = tbl_user_level_permissions_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_user_level_permissions_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_user_level_permissions_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_user_level_permissions_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_user_level_permissions_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

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
if ($rs = $tbl_user_level_permissions_delete->LoadRecordset())
	$tbl_user_level_permissions_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($tbl_user_level_permissions_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$tbl_user_level_permissions_delete->Page_Terminate("tbl_user_level_permissionslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_user_level_permissions->TableCaption() ?><br><br>
<a href="<?php echo $tbl_user_level_permissions->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_user_level_permissions_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="tbl_user_level_permissions">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_user_level_permissions_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $tbl_user_level_permissions->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $tbl_user_level_permissions->userlevelid->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_user_level_permissions->ztablename->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_user_level_permissions->permission->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_user_level_permissions_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$tbl_user_level_permissions_delete->lRecCnt++;

	// Set row properties
	$tbl_user_level_permissions->CssClass = "";
	$tbl_user_level_permissions->CssStyle = "";
	$tbl_user_level_permissions->RowAttrs = array();
	$tbl_user_level_permissions->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_user_level_permissions_delete->LoadRowValues($rs);

	// Render row
	$tbl_user_level_permissions_delete->RenderRow();
?>
	<tr<?php echo $tbl_user_level_permissions->RowAttributes() ?>>
		<td<?php echo $tbl_user_level_permissions->userlevelid->CellAttributes() ?>>
<div<?php echo $tbl_user_level_permissions->userlevelid->ViewAttributes() ?>><?php echo $tbl_user_level_permissions->userlevelid->ListViewValue() ?></div></td>
		<td<?php echo $tbl_user_level_permissions->ztablename->CellAttributes() ?>>
<div<?php echo $tbl_user_level_permissions->ztablename->ViewAttributes() ?>><?php echo $tbl_user_level_permissions->ztablename->ListViewValue() ?></div></td>
		<td<?php echo $tbl_user_level_permissions->permission->CellAttributes() ?>>
<div<?php echo $tbl_user_level_permissions->permission->ViewAttributes() ?>><?php echo $tbl_user_level_permissions->permission->ListViewValue() ?></div></td>
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
$tbl_user_level_permissions_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_user_level_permissions_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'tbl_user_level_permissions';

	// Page object name
	var $PageObjName = 'tbl_user_level_permissions_delete';

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
	function ctbl_user_level_permissions_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_user_level_permissions)
		$GLOBALS["tbl_user_level_permissions"] = new ctbl_user_level_permissions();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_user_level_permissions', TRUE);

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
		global $Language, $tbl_user_level_permissions;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["userlevelid"] <> "") {
			$tbl_user_level_permissions->userlevelid->setQueryStringValue($_GET["userlevelid"]);
			if (!is_numeric($tbl_user_level_permissions->userlevelid->QueryStringValue))
				$this->Page_Terminate("tbl_user_level_permissionslist.php"); // Prevent SQL injection, exit
			$sKey .= $tbl_user_level_permissions->userlevelid->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if (@$_GET["ztablename"] <> "") {
			$tbl_user_level_permissions->ztablename->setQueryStringValue($_GET["ztablename"]);
			if ($sKey <> "") $sKey .= EW_COMPOSITE_KEY_SEPARATOR;
			$sKey .= $tbl_user_level_permissions->ztablename->QueryStringValue;
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
			$this->Page_Terminate("tbl_user_level_permissionslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";
			$arKeyFlds = explode(EW_COMPOSITE_KEY_SEPARATOR, trim($sKey)); // Split key by separator
			if (count($arKeyFlds) <> 2)
				$this->Page_Terminate($tbl_user_level_permissions->getReturnUrl()); // Invalid key, exit

			// Set up key field
			$sKeyFld = $arKeyFlds[0];
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("tbl_user_level_permissionslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`userlevelid`=" . ew_AdjustSql($sKeyFld) . " AND ";

			// Set up key field
			$sKeyFld = $arKeyFlds[1];
			$sFilter .= "`tablename`='" . ew_AdjustSql($sKeyFld) . "' AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_user_level_permissions class, tbl_user_level_permissionsinfo.php

		$tbl_user_level_permissions->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$tbl_user_level_permissions->CurrentAction = $_POST["a_delete"];
		} else {
			$tbl_user_level_permissions->CurrentAction = "D"; // Delete record directly
		}
		switch ($tbl_user_level_permissions->CurrentAction) {
			case "D": // Delete
				$tbl_user_level_permissions->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($tbl_user_level_permissions->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $tbl_user_level_permissions;
		$DeleteRows = TRUE;
		$sWrkFilter = $tbl_user_level_permissions->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in tbl_user_level_permissions class, tbl_user_level_permissionsinfo.php

		$tbl_user_level_permissions->CurrentFilter = $sWrkFilter;
		$sSql = $tbl_user_level_permissions->SQL();
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
				$DeleteRows = $tbl_user_level_permissions->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['userlevelid'];
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['tablename'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($tbl_user_level_permissions->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($tbl_user_level_permissions->CancelMessage <> "") {
				$this->setMessage($tbl_user_level_permissions->CancelMessage);
				$tbl_user_level_permissions->CancelMessage = "";
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
				$tbl_user_level_permissions->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
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
}
?>
