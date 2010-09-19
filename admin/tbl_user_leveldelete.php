<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "tbl_user_levelinfo.php" ?>
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
$tbl_user_level_delete = new ctbl_user_level_delete();
$Page =& $tbl_user_level_delete;

// Page init
$tbl_user_level_delete->Page_Init();

// Page main
$tbl_user_level_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_user_level_delete = new ew_Page("tbl_user_level_delete");

// page properties
tbl_user_level_delete.PageID = "delete"; // page ID
tbl_user_level_delete.FormID = "ftbl_user_leveldelete"; // form ID
var EW_PAGE_ID = tbl_user_level_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_user_level_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_user_level_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_user_level_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_user_level_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $tbl_user_level_delete->LoadRecordset())
	$tbl_user_level_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($tbl_user_level_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$tbl_user_level_delete->Page_Terminate("tbl_user_levellist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_user_level->TableCaption() ?><br><br>
<a href="<?php echo $tbl_user_level->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_user_level_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="tbl_user_level">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_user_level_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $tbl_user_level->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $tbl_user_level->userlevelid->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_user_level->userlevelname->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_user_level_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$tbl_user_level_delete->lRecCnt++;

	// Set row properties
	$tbl_user_level->CssClass = "";
	$tbl_user_level->CssStyle = "";
	$tbl_user_level->RowAttrs = array();
	$tbl_user_level->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_user_level_delete->LoadRowValues($rs);

	// Render row
	$tbl_user_level_delete->RenderRow();
?>
	<tr<?php echo $tbl_user_level->RowAttributes() ?>>
		<td<?php echo $tbl_user_level->userlevelid->CellAttributes() ?>>
<div<?php echo $tbl_user_level->userlevelid->ViewAttributes() ?>><?php echo $tbl_user_level->userlevelid->ListViewValue() ?></div></td>
		<td<?php echo $tbl_user_level->userlevelname->CellAttributes() ?>>
<div<?php echo $tbl_user_level->userlevelname->ViewAttributes() ?>><?php echo $tbl_user_level->userlevelname->ListViewValue() ?></div></td>
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
$tbl_user_level_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_user_level_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'tbl_user_level';

	// Page object name
	var $PageObjName = 'tbl_user_level_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $tbl_user_level;
		if ($tbl_user_level->UseTokenInUrl) $PageUrl .= "t=" . $tbl_user_level->TableVar . "&"; // Add page token
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
		global $objForm, $tbl_user_level;
		if ($tbl_user_level->UseTokenInUrl) {
			if ($objForm)
				return ($tbl_user_level->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($tbl_user_level->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctbl_user_level_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_user_level)
		$GLOBALS["tbl_user_level"] = new ctbl_user_level();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'tbl_user_level', TRUE);

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
		global $tbl_user_level;

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
		global $Language, $tbl_user_level;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["userlevelid"] <> "") {
			$tbl_user_level->userlevelid->setQueryStringValue($_GET["userlevelid"]);
			if (!is_numeric($tbl_user_level->userlevelid->QueryStringValue))
				$this->Page_Terminate("tbl_user_levellist.php"); // Prevent SQL injection, exit
			$sKey .= $tbl_user_level->userlevelid->QueryStringValue;
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
			$this->Page_Terminate("tbl_user_levellist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("tbl_user_levellist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`userlevelid`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_user_level class, tbl_user_levelinfo.php

		$tbl_user_level->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$tbl_user_level->CurrentAction = $_POST["a_delete"];
		} else {
			$tbl_user_level->CurrentAction = "D"; // Delete record directly
		}
		switch ($tbl_user_level->CurrentAction) {
			case "D": // Delete
				$tbl_user_level->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($tbl_user_level->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $tbl_user_level;
		$DeleteRows = TRUE;
		$sWrkFilter = $tbl_user_level->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in tbl_user_level class, tbl_user_levelinfo.php

		$tbl_user_level->CurrentFilter = $sWrkFilter;
		$sSql = $tbl_user_level->SQL();
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
				$DeleteRows = $tbl_user_level->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['userlevelid'];
				$x_userlevelid = $row['userlevelid']; // Get User Level id
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($tbl_user_level->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
				if (!is_null($x_userlevelid)) {
					$conn->Execute("DELETE FROM " . EW_USER_LEVEL_PRIV_TABLE . " WHERE " . EW_USER_LEVEL_PRIV_USER_LEVEL_ID_FIELD . " = " . $x_userlevelid); // Delete user rights as well
				}
			}
		} else {

			// Set up error message
			if ($tbl_user_level->CancelMessage <> "") {
				$this->setMessage($tbl_user_level->CancelMessage);
				$tbl_user_level->CancelMessage = "";
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
				$tbl_user_level->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $tbl_user_level;

		// Call Recordset Selecting event
		$tbl_user_level->Recordset_Selecting($tbl_user_level->CurrentFilter);

		// Load List page SQL
		$sSql = $tbl_user_level->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$tbl_user_level->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $tbl_user_level;
		$sFilter = $tbl_user_level->KeyFilter();

		// Call Row Selecting event
		$tbl_user_level->Row_Selecting($sFilter);

		// Load SQL based on filter
		$tbl_user_level->CurrentFilter = $sFilter;
		$sSql = $tbl_user_level->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$tbl_user_level->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $tbl_user_level;
		$tbl_user_level->userlevelid->setDbValue($rs->fields('userlevelid'));
		if (is_null($tbl_user_level->userlevelid->CurrentValue)) {
			$tbl_user_level->userlevelid->CurrentValue = 0;
		} else {
			$tbl_user_level->userlevelid->CurrentValue = intval($tbl_user_level->userlevelid->CurrentValue);
		}
		$tbl_user_level->userlevelname->setDbValue($rs->fields('userlevelname'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $tbl_user_level;

		// Initialize URLs
		// Call Row_Rendering event

		$tbl_user_level->Row_Rendering();

		// Common render codes for all row types
		// userlevelid

		$tbl_user_level->userlevelid->CellCssStyle = ""; $tbl_user_level->userlevelid->CellCssClass = "";
		$tbl_user_level->userlevelid->CellAttrs = array(); $tbl_user_level->userlevelid->ViewAttrs = array(); $tbl_user_level->userlevelid->EditAttrs = array();

		// userlevelname
		$tbl_user_level->userlevelname->CellCssStyle = ""; $tbl_user_level->userlevelname->CellCssClass = "";
		$tbl_user_level->userlevelname->CellAttrs = array(); $tbl_user_level->userlevelname->ViewAttrs = array(); $tbl_user_level->userlevelname->EditAttrs = array();
		if ($tbl_user_level->RowType == EW_ROWTYPE_VIEW) { // View row

			// userlevelid
			$tbl_user_level->userlevelid->ViewValue = $tbl_user_level->userlevelid->CurrentValue;
			$tbl_user_level->userlevelid->CssStyle = "";
			$tbl_user_level->userlevelid->CssClass = "";
			$tbl_user_level->userlevelid->ViewCustomAttributes = "";

			// userlevelname
			$tbl_user_level->userlevelname->ViewValue = $tbl_user_level->userlevelname->CurrentValue;
			$tbl_user_level->userlevelname->CssStyle = "";
			$tbl_user_level->userlevelname->CssClass = "";
			$tbl_user_level->userlevelname->ViewCustomAttributes = "";

			// userlevelid
			$tbl_user_level->userlevelid->HrefValue = "";
			$tbl_user_level->userlevelid->TooltipValue = "";

			// userlevelname
			$tbl_user_level->userlevelname->HrefValue = "";
			$tbl_user_level->userlevelname->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($tbl_user_level->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$tbl_user_level->Row_Rendered();
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
