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
$userpriv = new cuserpriv();
$Page =& $userpriv;

// Page init
$userpriv->Page_Init();

// Page main
$userpriv->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var userpriv = new ew_Page("userpriv");

// page properties
userpriv.PageID = "userpriv"; // page ID
userpriv.FormID = "ftbl_user_leveluserpriv"; // form ID
var EW_PAGE_ID = userpriv.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
userpriv.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
userpriv.SelectAllKey = function(elem) {
	ew_SelectAll(elem);
	ew_ClickAll(elem);
}
<?php if (EW_CLIENT_VALIDATE) { ?>
userpriv.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
userpriv.ValidateRequired = false; // no JavaScript validation
<?php } ?>

// search highlight properties
userpriv.ShowHighlightText = ewLanguage.Phrase("ShowHighlight"); 
userpriv.HideHighlightText = ewLanguage.Phrase("HideHighlight");

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("UserLevelPermission") ?><br><br>
<a href="tbl_user_levellist.php"><?php echo $Language->Phrase("BackToList") ?></a></span></p>
<p><span class="phpmaker"><?php echo $Language->Phrase("UserLevel") ?><?php echo $Security->GetUserLevelName($tbl_user_level->userlevelid->CurrentValue) ?>(<?php echo $tbl_user_level->userlevelid->CurrentValue ?>)</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$userpriv->ShowMessage();
?>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<form name="userpriv" id="userpriv" action="<?php echo ew_CurrentPage() ?>" method="post">
<input type="hidden" name="t" id="t" value="tbl_user_level">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<!-- hidden tag for User Level ID -->
<input type="hidden" name="x_userlevelid" id="x_userlevelid" value="<?php echo $tbl_user_level->userlevelid->CurrentValue ?>">
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
	<thead>
	<tr class="ewTableHeader">
		<td><?php echo $Language->Phrase("TableOrView") ?></td>
		<td><?php echo $Language->Phrase("PermissionAddCopy") ?><input type="checkbox" name="Add" id="Add" onclick="ew_SelectAll(this);"<?php echo $userpriv->sDisabled ?>></td>
		<td><?php echo $Language->Phrase("PermissionDelete") ?><input type="checkbox" name="Delete" id="Delete" onclick="ew_SelectAll(this);"<?php echo $userpriv->sDisabled ?>></td>
		<td><?php echo $Language->Phrase("PermissionEdit") ?><input type="checkbox" name="Edit" id="Edit" onclick="ew_SelectAll(this);"<?php echo $userpriv->sDisabled ?>></td>
<?php if (defined("EW_USER_LEVEL_COMPAT")) { ?>
		<td><?php echo $Language->Phrase("PermissionListSearchView") ?><input type="checkbox" name="List" id="List" onclick="ew_SelectAll(this);"<?php echo $userpriv->sDisabled ?>></td>
<?php } else { ?>
		<td><?php echo $Language->Phrase("PermissionList") ?><input type="checkbox" name="List" id="List" onclick="ew_SelectAll(this);"<?php echo $userpriv->sDisabled ?>></td>
		<td><?php echo $Language->Phrase("PermissionView") ?><input type="checkbox" name="View" id="View" onclick="ew_SelectAll(this);"<?php echo $userpriv->sDisabled ?>></td>
		<td><?php echo $Language->Phrase("PermissionSearch") ?><input type="checkbox" name="Search" id="Search" onclick="ew_SelectAll(this);"<?php echo $userpriv->sDisabled ?>></td>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
for ($i = 0; $i < $userpriv->TableNameCount; $i++) {
	$userpriv->TempPriv = $Security->GetUserLevelPrivEx($EW_USER_LEVEL_TABLE_NAME[$i], $tbl_user_level->userlevelid->CurrentValue);

	// Set row properties
	$tbl_user_level->CssClass = "";
	$tbl_user_level->CssStyle = "";
	$tbl_user_level->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
?>
	<tr<?php echo $tbl_user_level->RowAttributes() ?>>
		<td><span class="phpmaker"><?php echo $userpriv->GetTableCaption($i) ?></span></td>
		<td align="center"><input type="checkbox" name="Add_<?php echo $i ?>" id="Add_<?php echo $i ?>" value="1"<?php if (($userpriv->TempPriv & EW_ALLOW_ADD) == EW_ALLOW_ADD) { ?> checked="checked"<?php } ?><?php echo $userpriv->sDisabled ?>></td>
		<td align="center"><input type="checkbox" name="Delete_<?php echo $i ?>" id="Delete_<?php echo $i ?>" value="2"<?php if (($userpriv->TempPriv & EW_ALLOW_DELETE) == EW_ALLOW_DELETE) { ?> checked="checked"<?php } ?><?php echo $userpriv->sDisabled ?>></td>
		<td align="center"><input type="checkbox" name="Edit_<?php echo $i ?>" id="Edit_<?php echo $i ?>" value="4"<?php if (($userpriv->TempPriv & EW_ALLOW_EDIT) == EW_ALLOW_EDIT) { ?> checked="checked"<?php } ?><?php echo $userpriv->sDisabled ?>></td>
<?php if (defined("EW_USER_LEVEL_COMPAT")) { ?>
		<td align="center"><input type="checkbox" name="List_<?php echo $i ?>" id="List_<?php echo $i ?>" value="8"<?php if (($userpriv->TempPriv & EW_ALLOW_LIST) == EW_ALLOW_LIST) { ?> checked="checked"<?php } ?><?php echo $userpriv->sDisabled ?>></td>
<?php } else { ?>
		<td align="center"><input type="checkbox" name="List_<?php echo $i ?>" id="List_<?php echo $i ?>" value="8"<?php if (($userpriv->TempPriv & EW_ALLOW_LIST) == EW_ALLOW_LIST) { ?> checked="checked"<?php } ?><?php echo $userpriv->sDisabled ?>></td>
		<td align="center"><input type="checkbox" name="View_<?php echo $i ?>" id="View_<?php echo $i ?>" value="32"<?php if (($userpriv->TempPriv & EW_ALLOW_VIEW) == EW_ALLOW_VIEW) { ?> checked="checked"<?php } ?><?php echo $userpriv->sDisabled ?>></td>
		<td align="center"><input type="checkbox" name="Search_<?php echo $i ?>" id="Search_<?php echo $i ?>" value="64"<?php if (($userpriv->TempPriv & EW_ALLOW_SEARCH) == EW_ALLOW_SEARCH) { ?> checked="checked"<?php } ?><?php echo $userpriv->sDisabled ?>></td>
<?php } ?>
	</tr>
<?php } ?>
	</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnSubmit" id="btnSubmit" value="<?php echo ew_BtnCaption($Language->Phrase("Update")) ?>"<?php echo $userpriv->sDisabled ?>>
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$userpriv->Page_Terminate();
?>
<?php

//
// Page class
//
class cuserpriv {

	// Page ID
	var $PageID = 'userpriv';

	// Page object name
	var $PageObjName = 'userpriv';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
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
		return TRUE;
	}

	//
	// Page class constructor
	//
	function cuserpriv() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (tbl_user_level)
		$GLOBALS["tbl_user_level"] = new ctbl_user_level();

	  // User table object (tbl_user)
		$GLOBALS["tbl_user"] = new ctbl_user;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'userpriv', TRUE);

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
		$Security->LoadCurrentUserLevel('tbl_user_level');
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
	var $TempPriv;
	var $sDisabled;
	var $arPriv;
	var $TableNameCount;

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language, $tbl_user_level;
		if (!is_array($GLOBALS["EW_USER_LEVEL_TABLE_NAME"])) {
		  $this->setMessage($Language->Phrase("NoTableGenerated"));
			$this->Page_Terminate("tbl_user_levellist.php"); // Return to list
		}
		$this->TableNameCount = count($GLOBALS["EW_USER_LEVEL_TABLE_NAME"]);
		$this->TableCaptionCount = count($GLOBALS["EW_USER_LEVEL_TABLE_CAPTION"]);
		$this->arPriv =& ew_InitArray($this->TableNameCount, 0);

		// Get action
		if (@$_POST["a_edit"] == "") {
			$tbl_user_level->CurrentAction = "I"; // Display with input box

			// Load key from QueryString
			if (@$_GET["userlevelid"] <> "") {
				$tbl_user_level->userlevelid->setQueryStringValue($_GET["userlevelid"]);
			} else {
				$this->Page_Terminate("tbl_user_levellist.php"); // Return to list
			}
			if ($tbl_user_level->userlevelid->QueryStringValue == "-1") {
				$this->sDisabled = " disabled=\"disabled\"";
			} else {
				$this->sDisabled = "";
			}
		} else {
			$tbl_user_level->CurrentAction = $_POST["a_edit"];

			// Get fields from form
			$tbl_user_level->userlevelid->setFormValue($_POST["x_userlevelid"]);
			for ($i = 0; $i < $this->TableNameCount; $i++) {
				if (defined("EW_USER_LEVEL_COMPAT")) {
					$this->arPriv[$i] = intval(@$_POST["Add_" . $i]) + 
						intval(@$_POST["Delete_" . $i]) + intval(@$_POST["Edit_" . $i]) +
						intval(@$_POST["List_" . $i]);
				} else {
					$this->arPriv[$i] = intval(@$_POST["Add_" . $i]) +
						intval(@$_POST["Delete_" . $i]) + intval(@$_POST["Edit_" . $i]) +
						intval(@$_POST["List_" . $i]) + intval(@$_POST["View_" . $i]) +
						intval(@$_POST["Search_" . $i]);
				}
			}
		}
		switch ($tbl_user_level->CurrentAction) {
			case "I": // Display
				$Security->SetUpUserLevelEx(); // Get all User Level info
				break;
			case "U": // Update
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Set update success message

					// Alternatively, comment out the following line to go back to this page
					$this->Page_Terminate("tbl_user_levellist.php"); // Return to list
				}
		}
	}

	// Update privileges
	function EditRow() {
		global $conn, $EW_USER_LEVEL_TABLE_NAME, $tbl_user_level;
		for ($i = 0; $i < $this->TableNameCount; $i++) {
			$Sql = "SELECT * FROM " . EW_USER_LEVEL_PRIV_TABLE . " WHERE " . 
				EW_USER_LEVEL_PRIV_TABLE_NAME_FIELD . " = '" . ew_AdjustSql($EW_USER_LEVEL_TABLE_NAME[$i]) . "' AND " .
				EW_USER_LEVEL_PRIV_USER_LEVEL_ID_FIELD . " = " . $tbl_user_level->userlevelid->CurrentValue;
			$rs = $conn->Execute($Sql);
			if ($rs && !$rs->EOF) {
				$Sql = "UPDATE " . EW_USER_LEVEL_PRIV_TABLE . " SET " . EW_USER_LEVEL_PRIV_PRIV_FIELD . " = " . $this->arPriv[$i] . " WHERE " .
					EW_USER_LEVEL_PRIV_TABLE_NAME_FIELD . " = '" . ew_AdjustSql($EW_USER_LEVEL_TABLE_NAME[$i]) . "' AND " .
					EW_USER_LEVEL_PRIV_USER_LEVEL_ID_FIELD . " = " . $tbl_user_level->userlevelid->CurrentValue;
				$conn->Execute($Sql);
			} else {
				$Sql = "INSERT INTO " . EW_USER_LEVEL_PRIV_TABLE . " (" . EW_USER_LEVEL_PRIV_TABLE_NAME_FIELD . ", " . EW_USER_LEVEL_PRIV_USER_LEVEL_ID_FIELD . ", " . EW_USER_LEVEL_PRIV_PRIV_FIELD . ") VALUES ('" . ew_AdjustSql($EW_USER_LEVEL_TABLE_NAME[$i]) . "', " . $tbl_user_level->userlevelid->CurrentValue . ", " . $this->arPriv[$i] . ")";
				$conn->Execute($Sql);
			}
			if ($rs)
				$rs->Close();
		}
		return TRUE;
	}

	// Get table caption
	function GetTableCaption($i) {
		global $Language;
		$caption = "";
		if ($i < $this->TableNameCount) {
			$caption = $Language->TablePhrase(@$GLOBALS["EW_USER_LEVEL_TABLE_VAR"][$i], "TblCaption");
			if ($caption == "" && $i < $this->TableCaptionCount)
				$caption = $GLOBALS["EW_USER_LEVEL_TABLE_CAPTION"][$i];
			$report = defined("EW_REPORT_TABLE_PREFIX") &&
				substr($GLOBALS["EW_USER_LEVEL_TABLE_NAME"][$i], 0, strlen(EW_REPORT_TABLE_PREFIX)) == EW_REPORT_TABLE_PREFIX;
			if ($caption == "") {
				$caption = $GLOBALS["EW_USER_LEVEL_TABLE_NAME"][$i];
				if ($report)
					$caption = substr($caption, strlen(EW_REPORT_TABLE_PREFIX));
			}
			if ($report)
				$caption .= "&nbsp;(" . $Language->Phrase("Report") . ")";
		}
		return $caption;
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
