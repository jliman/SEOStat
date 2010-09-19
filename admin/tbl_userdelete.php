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
$tbl_user_delete = new ctbl_user_delete();
$Page =& $tbl_user_delete;

// Page init
$tbl_user_delete->Page_Init();

// Page main
$tbl_user_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_user_delete = new ew_Page("tbl_user_delete");

// page properties
tbl_user_delete.PageID = "delete"; // page ID
tbl_user_delete.FormID = "ftbl_userdelete"; // form ID
var EW_PAGE_ID = tbl_user_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_user_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_user_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_user_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_user_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_user_delete.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_user_delete.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
if ($rs = $tbl_user_delete->LoadRecordset())
	$tbl_user_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($tbl_user_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$tbl_user_delete->Page_Terminate("tbl_userlist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_user->TableCaption() ?><br><br>
<a href="<?php echo $tbl_user->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_user_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="tbl_user">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_user_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $tbl_user->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $tbl_user->id_user->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_user->username->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_user->passwd->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_user->id_userlevel->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_user_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$tbl_user_delete->lRecCnt++;

	// Set row properties
	$tbl_user->CssClass = "";
	$tbl_user->CssStyle = "";
	$tbl_user->RowAttrs = array();
	$tbl_user->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_user_delete->LoadRowValues($rs);

	// Render row
	$tbl_user_delete->RenderRow();
?>
	<tr<?php echo $tbl_user->RowAttributes() ?>>
		<td<?php echo $tbl_user->id_user->CellAttributes() ?>>
<div<?php echo $tbl_user->id_user->ViewAttributes() ?>><?php echo $tbl_user->id_user->ListViewValue() ?></div></td>
		<td<?php echo $tbl_user->username->CellAttributes() ?>>
<div<?php echo $tbl_user->username->ViewAttributes() ?>><?php echo $tbl_user->username->ListViewValue() ?></div></td>
		<td<?php echo $tbl_user->passwd->CellAttributes() ?>>
<div<?php echo $tbl_user->passwd->ViewAttributes() ?>><?php echo $tbl_user->passwd->ListViewValue() ?></div></td>
		<td<?php echo $tbl_user->id_userlevel->CellAttributes() ?>>
<div<?php echo $tbl_user->id_userlevel->ViewAttributes() ?>><?php echo $tbl_user->id_userlevel->ListViewValue() ?></div></td>
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
$tbl_user_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_user_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'tbl_user';

	// Page object name
	var $PageObjName = 'tbl_user_delete';

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
	function ctbl_user_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_user)
		$GLOBALS["tbl_user"] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
		if (!$Security->CanDelete()) {
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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $tbl_user;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id_user"] <> "") {
			$tbl_user->id_user->setQueryStringValue($_GET["id_user"]);
			if (!is_numeric($tbl_user->id_user->QueryStringValue))
				$this->Page_Terminate("tbl_userlist.php"); // Prevent SQL injection, exit
			$sKey .= $tbl_user->id_user->QueryStringValue;
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
			$this->Page_Terminate("tbl_userlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("tbl_userlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id_user`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_user class, tbl_userinfo.php

		$tbl_user->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$tbl_user->CurrentAction = $_POST["a_delete"];
		} else {
			$tbl_user->CurrentAction = "D"; // Delete record directly
		}
		switch ($tbl_user->CurrentAction) {
			case "D": // Delete
				$tbl_user->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($tbl_user->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $tbl_user;
		$DeleteRows = TRUE;
		$sWrkFilter = $tbl_user->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in tbl_user class, tbl_userinfo.php

		$tbl_user->CurrentFilter = $sWrkFilter;
		$sSql = $tbl_user->SQL();
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
				$DeleteRows = $tbl_user->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id_user'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($tbl_user->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($tbl_user->CancelMessage <> "") {
				$this->setMessage($tbl_user->CancelMessage);
				$tbl_user->CancelMessage = "";
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
				$tbl_user->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
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
