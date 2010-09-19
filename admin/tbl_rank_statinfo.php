<?php

// Global variable for table object
$tbl_rank_stat = NULL;

//
// Table class for tbl_rank_stat
//
class ctbl_rank_stat {
	var $TableVar = 'tbl_rank_stat';
	var $TableName = 'tbl_rank_stat';
	var $TableType = 'TABLE';
	var $id_profile;
	var $stat_date;
	var $year;
	var $month;
	var $week;
	var $alexa_rank;
	var $google_pagerank;
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
	function ctbl_rank_stat() {
		global $Language;

		// id_profile
		$this->id_profile = new cField('tbl_rank_stat', 'tbl_rank_stat', 'x_id_profile', 'id_profile', '`id_profile`', 19, -1, FALSE, '`id_profile`', FALSE);
		$this->id_profile->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_profile'] =& $this->id_profile;

		// stat_date
		$this->stat_date = new cField('tbl_rank_stat', 'tbl_rank_stat', 'x_stat_date', 'stat_date', '`stat_date`', 133, 5, FALSE, '`stat_date`', FALSE);
		$this->stat_date->FldDefaultErrMsg = str_replace("%s", "/", $Language->Phrase("IncorrectDateYMD"));
		$this->fields['stat_date'] =& $this->stat_date;

		// year
		$this->year = new cField('tbl_rank_stat', 'tbl_rank_stat', 'x_year', 'year', '`year`', 19, -1, FALSE, '`year`', FALSE);
		$this->year->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['year'] =& $this->year;

		// month
		$this->month = new cField('tbl_rank_stat', 'tbl_rank_stat', 'x_month', 'month', '`month`', 17, -1, FALSE, '`month`', FALSE);
		$this->month->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['month'] =& $this->month;

		// week
		$this->week = new cField('tbl_rank_stat', 'tbl_rank_stat', 'x_week', 'week', '`week`', 17, -1, FALSE, '`week`', FALSE);
		$this->week->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['week'] =& $this->week;

		// alexa_rank
		$this->alexa_rank = new cField('tbl_rank_stat', 'tbl_rank_stat', 'x_alexa_rank', 'alexa_rank', '`alexa_rank`', 19, -1, FALSE, '`alexa_rank`', FALSE);
		$this->alexa_rank->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['alexa_rank'] =& $this->alexa_rank;

		// google_pagerank
		$this->google_pagerank = new cField('tbl_rank_stat', 'tbl_rank_stat', 'x_google_pagerank', 'google_pagerank', '`google_pagerank`', 17, -1, FALSE, '`google_pagerank`', FALSE);
		$this->google_pagerank->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['google_pagerank'] =& $this->google_pagerank;
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
		return "tbl_rank_stat_Highlight";
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
		return "`tbl_rank_stat`";
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
		return "`stat_date` DESC";
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
		return "INSERT INTO `tbl_rank_stat` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `tbl_rank_stat` SET ";
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
		$SQL = "DELETE FROM `tbl_rank_stat` WHERE ";
		$SQL .= ew_QuotedName('id_profile') . '=' . ew_QuotedValue($rs['id_profile'], $this->id_profile->FldDataType) . ' AND ';
		$SQL .= ew_QuotedName('stat_date') . '=' . ew_QuotedValue($rs['stat_date'], $this->stat_date->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id_profile` = @id_profile@ AND `stat_date` = '@stat_date@'";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id_profile->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id_profile@", ew_AdjustSql($this->id_profile->CurrentValue), $sKeyFilter); // Replace key value
		$sKeyFilter = str_replace("@stat_date@", ew_AdjustSql(ew_UnFormatDateTime($this->stat_date->CurrentValue,5)), $sKeyFilter); // Replace key value
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
			return "tbl_rank_statlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "tbl_rank_statlist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("tbl_rank_statview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "tbl_rank_statadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("tbl_rank_statedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("tbl_rank_statadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("tbl_rank_statdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id_profile->CurrentValue)) {
			$sUrl .= "id_profile=" . urlencode($this->id_profile->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase(\"InvalidRecord\"));";
		}
		if (!is_null($this->stat_date->CurrentValue)) {
			$sUrl .= "&stat_date=" . urlencode($this->stat_date->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=tbl_rank_stat" : "";
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
		$this->id_profile->setDbValue($rs->fields('id_profile'));
		$this->stat_date->setDbValue($rs->fields('stat_date'));
		$this->year->setDbValue($rs->fields('year'));
		$this->month->setDbValue($rs->fields('month'));
		$this->week->setDbValue($rs->fields('week'));
		$this->alexa_rank->setDbValue($rs->fields('alexa_rank'));
		$this->google_pagerank->setDbValue($rs->fields('google_pagerank'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// id_profile

		$this->id_profile->CellCssStyle = "white-space: nowrap;"; $this->id_profile->CellCssClass = "";
		$this->id_profile->CellAttrs = array(); $this->id_profile->ViewAttrs = array(); $this->id_profile->EditAttrs = array();

		// stat_date
		$this->stat_date->CellCssStyle = ""; $this->stat_date->CellCssClass = "";
		$this->stat_date->CellAttrs = array(); $this->stat_date->ViewAttrs = array(); $this->stat_date->EditAttrs = array();

		// year
		$this->year->CellCssStyle = ""; $this->year->CellCssClass = "";
		$this->year->CellAttrs = array(); $this->year->ViewAttrs = array(); $this->year->EditAttrs = array();

		// month
		$this->month->CellCssStyle = ""; $this->month->CellCssClass = "";
		$this->month->CellAttrs = array(); $this->month->ViewAttrs = array(); $this->month->EditAttrs = array();

		// week
		$this->week->CellCssStyle = ""; $this->week->CellCssClass = "";
		$this->week->CellAttrs = array(); $this->week->ViewAttrs = array(); $this->week->EditAttrs = array();

		// alexa_rank
		$this->alexa_rank->CellCssStyle = ""; $this->alexa_rank->CellCssClass = "";
		$this->alexa_rank->CellAttrs = array(); $this->alexa_rank->ViewAttrs = array(); $this->alexa_rank->EditAttrs = array();

		// google_pagerank
		$this->google_pagerank->CellCssStyle = ""; $this->google_pagerank->CellCssClass = "";
		$this->google_pagerank->CellAttrs = array(); $this->google_pagerank->ViewAttrs = array(); $this->google_pagerank->EditAttrs = array();

		// id_profile
		if (strval($this->id_profile->CurrentValue) <> "") {
			$sFilterWrk = "`id` = " . ew_AdjustSql($this->id_profile->CurrentValue) . "";
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
				$this->id_profile->ViewValue = $rswrk->fields('name');
				$rswrk->Close();
			} else {
				$this->id_profile->ViewValue = $this->id_profile->CurrentValue;
			}
		} else {
			$this->id_profile->ViewValue = NULL;
		}
		$this->id_profile->CssStyle = "";
		$this->id_profile->CssClass = "";
		$this->id_profile->ViewCustomAttributes = "";

		// stat_date
		$this->stat_date->ViewValue = $this->stat_date->CurrentValue;
		$this->stat_date->ViewValue = ew_FormatDateTime($this->stat_date->ViewValue, 5);
		$this->stat_date->CssStyle = "";
		$this->stat_date->CssClass = "";
		$this->stat_date->ViewCustomAttributes = "";

		// year
		$this->year->ViewValue = $this->year->CurrentValue;
		$this->year->CssStyle = "";
		$this->year->CssClass = "";
		$this->year->ViewCustomAttributes = "";

		// month
		$this->month->ViewValue = $this->month->CurrentValue;
		$this->month->CssStyle = "";
		$this->month->CssClass = "";
		$this->month->ViewCustomAttributes = "";

		// week
		$this->week->ViewValue = $this->week->CurrentValue;
		$this->week->CssStyle = "";
		$this->week->CssClass = "";
		$this->week->ViewCustomAttributes = "";

		// alexa_rank
		$this->alexa_rank->ViewValue = $this->alexa_rank->CurrentValue;
		$this->alexa_rank->CssStyle = "";
		$this->alexa_rank->CssClass = "";
		$this->alexa_rank->ViewCustomAttributes = "";

		// google_pagerank
		$this->google_pagerank->ViewValue = $this->google_pagerank->CurrentValue;
		$this->google_pagerank->CssStyle = "";
		$this->google_pagerank->CssClass = "";
		$this->google_pagerank->ViewCustomAttributes = "";

		// id_profile
		$this->id_profile->HrefValue = "";
		$this->id_profile->TooltipValue = "";

		// stat_date
		$this->stat_date->HrefValue = "";
		$this->stat_date->TooltipValue = "";

		// year
		$this->year->HrefValue = "";
		$this->year->TooltipValue = "";

		// month
		$this->month->HrefValue = "";
		$this->month->TooltipValue = "";

		// week
		$this->week->HrefValue = "";
		$this->week->TooltipValue = "";

		// alexa_rank
		$this->alexa_rank->HrefValue = "";
		$this->alexa_rank->TooltipValue = "";

		// google_pagerank
		$this->google_pagerank->HrefValue = "";
		$this->google_pagerank->TooltipValue = "";

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
