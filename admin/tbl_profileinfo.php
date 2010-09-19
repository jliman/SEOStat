<?php

// Global variable for table object
$tbl_profile = NULL;

//
// Table class for tbl_profile
//
class ctbl_profile {
	var $TableVar = 'tbl_profile';
	var $TableName = 'tbl_profile';
	var $TableType = 'TABLE';
	var $id;
	var $name;
	var $ga_username;
	var $ga_passwd;
	var $ga_profileid;
	var $url;
	var $fb_pageid;
	var $twitter_page;
	var $is_wordpress;
	var $is_blogger;
	var $is_active;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = TRUE;
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message

	//
	// Table class constructor
	//
	function ctbl_profile() {
		global $Language;

		// id
		$this->id = new cField('tbl_profile', 'tbl_profile', 'x_id', 'id', '`id`', 19, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// name
		$this->name = new cField('tbl_profile', 'tbl_profile', 'x_name', 'name', '`name`', 200, -1, FALSE, '`name`', FALSE);
		$this->fields['name'] =& $this->name;

		// ga_username
		$this->ga_username = new cField('tbl_profile', 'tbl_profile', 'x_ga_username', 'ga_username', '`ga_username`', 200, -1, FALSE, '`ga_username`', FALSE);
		$this->fields['ga_username'] =& $this->ga_username;

		// ga_passwd
		$this->ga_passwd = new cField('tbl_profile', 'tbl_profile', 'x_ga_passwd', 'ga_passwd', '`ga_passwd`', 200, -1, FALSE, '`ga_passwd`', FALSE);
		$this->fields['ga_passwd'] =& $this->ga_passwd;

		// ga_profileid
		$this->ga_profileid = new cField('tbl_profile', 'tbl_profile', 'x_ga_profileid', 'ga_profileid', '`ga_profileid`', 200, -1, FALSE, '`ga_profileid`', FALSE);
		$this->fields['ga_profileid'] =& $this->ga_profileid;

		// url
		$this->url = new cField('tbl_profile', 'tbl_profile', 'x_url', 'url', '`url`', 200, -1, FALSE, '`url`', FALSE);
		$this->fields['url'] =& $this->url;

		// fb_pageid
		$this->fb_pageid = new cField('tbl_profile', 'tbl_profile', 'x_fb_pageid', 'fb_pageid', '`fb_pageid`', 200, -1, FALSE, '`fb_pageid`', FALSE);
		$this->fields['fb_pageid'] =& $this->fb_pageid;

		// twitter_page
		$this->twitter_page = new cField('tbl_profile', 'tbl_profile', 'x_twitter_page', 'twitter_page', '`twitter_page`', 200, -1, FALSE, '`twitter_page`', FALSE);
		$this->fields['twitter_page'] =& $this->twitter_page;

		// is_wordpress
		$this->is_wordpress = new cField('tbl_profile', 'tbl_profile', 'x_is_wordpress', 'is_wordpress', '`is_wordpress`', 202, -1, FALSE, '`is_wordpress`', FALSE);
		$this->fields['is_wordpress'] =& $this->is_wordpress;

		// is_blogger
		$this->is_blogger = new cField('tbl_profile', 'tbl_profile', 'x_is_blogger', 'is_blogger', '`is_blogger`', 202, -1, FALSE, '`is_blogger`', FALSE);
		$this->fields['is_blogger'] =& $this->is_blogger;

		// is_active
		$this->is_active = new cField('tbl_profile', 'tbl_profile', 'x_is_active', 'is_active', '`is_active`', 202, -1, FALSE, '`is_active`', FALSE);
		$this->fields['is_active'] =& $this->is_active;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "tbl_profile_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`tbl_profile`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		if ($this->TableFilter <> "") {
			if ($sWhere <> "") $sWhere .= "(" . $sWhere . ") AND (";
			$sWhere .= "(" . $this->TableFilter . ")";
		}
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter = "(" . $sFilter . ") AND ";
			$sFilter .= "(" . $this->CurrentFilter . ")";
		}
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `tbl_profile` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `tbl_profile` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `tbl_profile` WHERE ";
		$SQL .= ew_QuotedName('id') . '=' . ew_QuotedValue($rs['id'], $this->id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id` = @id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "tbl_profilelist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "tbl_profilelist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("tbl_profileview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "tbl_profileadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("tbl_profileedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("tbl_profileadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("tbl_profiledelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase(\"InvalidRecord\"));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=tbl_profile" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->id->setDbValue($rs->fields('id'));
		$this->name->setDbValue($rs->fields('name'));
		$this->ga_username->setDbValue($rs->fields('ga_username'));
		$this->ga_passwd->setDbValue($rs->fields('ga_passwd'));
		$this->ga_profileid->setDbValue($rs->fields('ga_profileid'));
		$this->url->setDbValue($rs->fields('url'));
		$this->fb_pageid->setDbValue($rs->fields('fb_pageid'));
		$this->twitter_page->setDbValue($rs->fields('twitter_page'));
		$this->is_wordpress->setDbValue($rs->fields('is_wordpress'));
		$this->is_blogger->setDbValue($rs->fields('is_blogger'));
		$this->is_active->setDbValue($rs->fields('is_active'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// id

		$this->id->CellCssStyle = ""; $this->id->CellCssClass = "";
		$this->id->CellAttrs = array(); $this->id->ViewAttrs = array(); $this->id->EditAttrs = array();

		// name
		$this->name->CellCssStyle = "white-space: nowrap;"; $this->name->CellCssClass = "";
		$this->name->CellAttrs = array(); $this->name->ViewAttrs = array(); $this->name->EditAttrs = array();

		// ga_username
		$this->ga_username->CellCssStyle = ""; $this->ga_username->CellCssClass = "";
		$this->ga_username->CellAttrs = array(); $this->ga_username->ViewAttrs = array(); $this->ga_username->EditAttrs = array();

		// ga_passwd
		$this->ga_passwd->CellCssStyle = ""; $this->ga_passwd->CellCssClass = "";
		$this->ga_passwd->CellAttrs = array(); $this->ga_passwd->ViewAttrs = array(); $this->ga_passwd->EditAttrs = array();

		// ga_profileid
		$this->ga_profileid->CellCssStyle = ""; $this->ga_profileid->CellCssClass = "";
		$this->ga_profileid->CellAttrs = array(); $this->ga_profileid->ViewAttrs = array(); $this->ga_profileid->EditAttrs = array();

		// url
		$this->url->CellCssStyle = "white-space: nowrap;"; $this->url->CellCssClass = "";
		$this->url->CellAttrs = array(); $this->url->ViewAttrs = array(); $this->url->EditAttrs = array();

		// fb_pageid
		$this->fb_pageid->CellCssStyle = ""; $this->fb_pageid->CellCssClass = "";
		$this->fb_pageid->CellAttrs = array(); $this->fb_pageid->ViewAttrs = array(); $this->fb_pageid->EditAttrs = array();

		// twitter_page
		$this->twitter_page->CellCssStyle = ""; $this->twitter_page->CellCssClass = "";
		$this->twitter_page->CellAttrs = array(); $this->twitter_page->ViewAttrs = array(); $this->twitter_page->EditAttrs = array();

		// is_wordpress
		$this->is_wordpress->CellCssStyle = ""; $this->is_wordpress->CellCssClass = "";
		$this->is_wordpress->CellAttrs = array(); $this->is_wordpress->ViewAttrs = array(); $this->is_wordpress->EditAttrs = array();

		// is_blogger
		$this->is_blogger->CellCssStyle = ""; $this->is_blogger->CellCssClass = "";
		$this->is_blogger->CellAttrs = array(); $this->is_blogger->ViewAttrs = array(); $this->is_blogger->EditAttrs = array();

		// is_active
		$this->is_active->CellCssStyle = ""; $this->is_active->CellCssClass = "";
		$this->is_active->CellAttrs = array(); $this->is_active->ViewAttrs = array(); $this->is_active->EditAttrs = array();

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->CssStyle = "";
		$this->id->CssClass = "";
		$this->id->ViewCustomAttributes = "";

		// name
		$this->name->ViewValue = $this->name->CurrentValue;
		$this->name->CssStyle = "";
		$this->name->CssClass = "";
		$this->name->ViewCustomAttributes = "";

		// ga_username
		$this->ga_username->ViewValue = $this->ga_username->CurrentValue;
		$this->ga_username->CssStyle = "";
		$this->ga_username->CssClass = "";
		$this->ga_username->ViewCustomAttributes = "";

		// ga_passwd
		$this->ga_passwd->ViewValue = $this->ga_passwd->CurrentValue;
		$this->ga_passwd->CssStyle = "";
		$this->ga_passwd->CssClass = "";
		$this->ga_passwd->ViewCustomAttributes = "";

		// ga_profileid
		$this->ga_profileid->ViewValue = $this->ga_profileid->CurrentValue;
		$this->ga_profileid->CssStyle = "";
		$this->ga_profileid->CssClass = "";
		$this->ga_profileid->ViewCustomAttributes = "";

		// url
		$this->url->ViewValue = $this->url->CurrentValue;
		$this->url->CssStyle = "";
		$this->url->CssClass = "";
		$this->url->ViewCustomAttributes = "";

		// fb_pageid
		$this->fb_pageid->ViewValue = $this->fb_pageid->CurrentValue;
		$this->fb_pageid->CssStyle = "";
		$this->fb_pageid->CssClass = "";
		$this->fb_pageid->ViewCustomAttributes = "";

		// twitter_page
		$this->twitter_page->ViewValue = $this->twitter_page->CurrentValue;
		$this->twitter_page->CssStyle = "";
		$this->twitter_page->CssClass = "";
		$this->twitter_page->ViewCustomAttributes = "";

		// is_wordpress
		if (strval($this->is_wordpress->CurrentValue) <> "") {
			switch ($this->is_wordpress->CurrentValue) {
				case "0":
					$this->is_wordpress->ViewValue = "No";
					break;
				case "1":
					$this->is_wordpress->ViewValue = "Yes";
					break;
				default:
					$this->is_wordpress->ViewValue = $this->is_wordpress->CurrentValue;
			}
		} else {
			$this->is_wordpress->ViewValue = NULL;
		}
		$this->is_wordpress->CssStyle = "";
		$this->is_wordpress->CssClass = "";
		$this->is_wordpress->ViewCustomAttributes = "";

		// is_blogger
		if (strval($this->is_blogger->CurrentValue) <> "") {
			switch ($this->is_blogger->CurrentValue) {
				case "0":
					$this->is_blogger->ViewValue = "No";
					break;
				case "1":
					$this->is_blogger->ViewValue = "Yes";
					break;
				default:
					$this->is_blogger->ViewValue = $this->is_blogger->CurrentValue;
			}
		} else {
			$this->is_blogger->ViewValue = NULL;
		}
		$this->is_blogger->CssStyle = "";
		$this->is_blogger->CssClass = "";
		$this->is_blogger->ViewCustomAttributes = "";

		// is_active
		if (strval($this->is_active->CurrentValue) <> "") {
			switch ($this->is_active->CurrentValue) {
				case "0":
					$this->is_active->ViewValue = "No";
					break;
				case "1":
					$this->is_active->ViewValue = "Yes";
					break;
				default:
					$this->is_active->ViewValue = $this->is_active->CurrentValue;
			}
		} else {
			$this->is_active->ViewValue = NULL;
		}
		$this->is_active->CssStyle = "";
		$this->is_active->CssClass = "";
		$this->is_active->ViewCustomAttributes = "";

		// id
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// name
		$this->name->HrefValue = "";
		$this->name->TooltipValue = "";

		// ga_username
		$this->ga_username->HrefValue = "";
		$this->ga_username->TooltipValue = "";

		// ga_passwd
		$this->ga_passwd->HrefValue = "";
		$this->ga_passwd->TooltipValue = "";

		// ga_profileid
		$this->ga_profileid->HrefValue = "";
		$this->ga_profileid->TooltipValue = "";

		// url
		$this->url->HrefValue = "";
		$this->url->TooltipValue = "";

		// fb_pageid
		$this->fb_pageid->HrefValue = "";
		$this->fb_pageid->TooltipValue = "";

		// twitter_page
		$this->twitter_page->HrefValue = "";
		$this->twitter_page->TooltipValue = "";

		// is_wordpress
		$this->is_wordpress->HrefValue = "";
		$this->is_wordpress->TooltipValue = "";

		// is_blogger
		$this->is_blogger->HrefValue = "";
		$this->is_blogger->TooltipValue = "";

		// is_active
		$this->is_active->HrefValue = "";
		$this->is_active->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Row Inserting event
	function Row_Inserting(&$rs) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict(&$rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
