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
$tbl_profile_delete = new ctbl_profile_delete();
$Page =& $tbl_profile_delete;

// Page init
$tbl_profile_delete->Page_Init();

// Page main
$tbl_profile_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var tbl_profile_delete = new ew_Page("tbl_profile_delete");

// page properties
tbl_profile_delete.PageID = "delete"; // page ID
tbl_profile_delete.FormID = "ftbl_profiledelete"; // form ID
var EW_PAGE_ID = tbl_profile_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
tbl_profile_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
tbl_profile_delete.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
tbl_profile_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
tbl_profile_delete.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
tbl_profile_delete.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
tbl_profile_delete.HideHighlightText = ewLanguage.Phrase("HideHighlight");

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
if ($rs = $tbl_profile_delete->LoadRecordset())
	$tbl_profile_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($tbl_profile_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$tbl_profile_delete->Page_Terminate("tbl_profilelist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $tbl_profile->TableCaption() ?><br><br>
<a href="<?php echo $tbl_profile->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$tbl_profile_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="tbl_profile">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($tbl_profile_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $tbl_profile->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $tbl_profile->id->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_profile->name->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_profile->ga_username->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_profile->ga_passwd->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_profile->ga_profileid->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_profile->url->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_profile->fb_pageid->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_profile->twitter_page->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_profile->is_wordpress->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_profile->is_blogger->FldCaption() ?></td>
		<td valign="top"><?php echo $tbl_profile->is_active->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$tbl_profile_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$tbl_profile_delete->lRecCnt++;

	// Set row properties
	$tbl_profile->CssClass = "";
	$tbl_profile->CssStyle = "";
	$tbl_profile->RowAttrs = array();
	$tbl_profile->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$tbl_profile_delete->LoadRowValues($rs);

	// Render row
	$tbl_profile_delete->RenderRow();
?>
	<tr<?php echo $tbl_profile->RowAttributes() ?>>
		<td<?php echo $tbl_profile->id->CellAttributes() ?>>
<div<?php echo $tbl_profile->id->ViewAttributes() ?>><?php echo $tbl_profile->id->ListViewValue() ?></div></td>
		<td<?php echo $tbl_profile->name->CellAttributes() ?>>
<div<?php echo $tbl_profile->name->ViewAttributes() ?>><?php echo $tbl_profile->name->ListViewValue() ?></div></td>
		<td<?php echo $tbl_profile->ga_username->CellAttributes() ?>>
<div<?php echo $tbl_profile->ga_username->ViewAttributes() ?>><?php echo $tbl_profile->ga_username->ListViewValue() ?></div></td>
		<td<?php echo $tbl_profile->ga_passwd->CellAttributes() ?>>
<div<?php echo $tbl_profile->ga_passwd->ViewAttributes() ?>><?php echo $tbl_profile->ga_passwd->ListViewValue() ?></div></td>
		<td<?php echo $tbl_profile->ga_profileid->CellAttributes() ?>>
<div<?php echo $tbl_profile->ga_profileid->ViewAttributes() ?>><?php echo $tbl_profile->ga_profileid->ListViewValue() ?></div></td>
		<td<?php echo $tbl_profile->url->CellAttributes() ?>>
<div<?php echo $tbl_profile->url->ViewAttributes() ?>><?php echo $tbl_profile->url->ListViewValue() ?></div></td>
		<td<?php echo $tbl_profile->fb_pageid->CellAttributes() ?>>
<div<?php echo $tbl_profile->fb_pageid->ViewAttributes() ?>><?php echo $tbl_profile->fb_pageid->ListViewValue() ?></div></td>
		<td<?php echo $tbl_profile->twitter_page->CellAttributes() ?>>
<div<?php echo $tbl_profile->twitter_page->ViewAttributes() ?>><?php echo $tbl_profile->twitter_page->ListViewValue() ?></div></td>
		<td<?php echo $tbl_profile->is_wordpress->CellAttributes() ?>>
<div<?php echo $tbl_profile->is_wordpress->ViewAttributes() ?>><?php echo $tbl_profile->is_wordpress->ListViewValue() ?></div></td>
		<td<?php echo $tbl_profile->is_blogger->CellAttributes() ?>>
<div<?php echo $tbl_profile->is_blogger->ViewAttributes() ?>><?php echo $tbl_profile->is_blogger->ListViewValue() ?></div></td>
		<td<?php echo $tbl_profile->is_active->CellAttributes() ?>>
<div<?php echo $tbl_profile->is_active->ViewAttributes() ?>><?php echo $tbl_profile->is_active->ListViewValue() ?></div></td>
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
$tbl_profile_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ctbl_profile_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'tbl_profile';

	// Page object name
	var $PageObjName = 'tbl_profile_delete';

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
	function ctbl_profile_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_profile)
		$GLOBALS["tbl_profile"] = new ctbl_profile();

		// Table object (tbl_user)
		$GLOBALS['tbl_user'] = new ctbl_user();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
		if (!$Security->CanDelete()) {
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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $tbl_profile;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$tbl_profile->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($tbl_profile->id->QueryStringValue))
				$this->Page_Terminate("tbl_profilelist.php"); // Prevent SQL injection, exit
			$sKey .= $tbl_profile->id->QueryStringValue;
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
			$this->Page_Terminate("tbl_profilelist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("tbl_profilelist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in tbl_profile class, tbl_profileinfo.php

		$tbl_profile->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$tbl_profile->CurrentAction = $_POST["a_delete"];
		} else {
			$tbl_profile->CurrentAction = "D"; // Delete record directly
		}
		switch ($tbl_profile->CurrentAction) {
			case "D": // Delete
				$tbl_profile->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($tbl_profile->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $tbl_profile;
		$DeleteRows = TRUE;
		$sWrkFilter = $tbl_profile->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in tbl_profile class, tbl_profileinfo.php

		$tbl_profile->CurrentFilter = $sWrkFilter;
		$sSql = $tbl_profile->SQL();
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
				$DeleteRows = $tbl_profile->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($tbl_profile->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($tbl_profile->CancelMessage <> "") {
				$this->setMessage($tbl_profile->CancelMessage);
				$tbl_profile->CancelMessage = "";
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
				$tbl_profile->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
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
		// Call Row_Rendering event

		$tbl_profile->Row_Rendering();

		// Common render codes for all row types
		// id

		$tbl_profile->id->CellCssStyle = ""; $tbl_profile->id->CellCssClass = "";
		$tbl_profile->id->CellAttrs = array(); $tbl_profile->id->ViewAttrs = array(); $tbl_profile->id->EditAttrs = array();

		// name
		$tbl_profile->name->CellCssStyle = "white-space: nowrap;"; $tbl_profile->name->CellCssClass = "";
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
		$tbl_profile->url->CellCssStyle = "white-space: nowrap;"; $tbl_profile->url->CellCssClass = "";
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
