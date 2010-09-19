<?php

// Global variable for table object
$tbl_target = NULL;

//
// Table class for tbl_target
//
class ctbl_target {
	var $TableVar = 'tbl_target';
	var $TableName = 'tbl_target';
	var $TableType = 'TABLE';
	var $id_profile;
	var $year;
	var $month;
	var $visit;
	var $pageview;
	var $alexarank;
	var $googlepagerank;
	var $googleindexedpage;
	var $yahooindexedpage;
	var $bingindexedpage;
	var $twitterfollower;
	var $facebookfan;
	var $yahoobacklink;
	var $blwbacklink;
	var $blcbacklink;
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
	function ctbl_target() {
		global $Language;

		// id_profile
		$this->id_profile = new cField('tbl_target', 'tbl_target', 'x_id_profile', 'id_profile', '`id_profile`', 19, -1, FALSE, '`id_profile`', FALSE);
		$this->id_profile->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_profile'] =& $this->id_profile;

		// year
		$this->year = new cField('tbl_target', 'tbl_target', 'x_year', 'year', '`year`', 19, -1, FALSE, '`year`', FALSE);
		$this->year->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['year'] =& $this->year;

		// month
		$this->month = new cField('tbl_target', 'tbl_target', 'x_month', 'month', '`month`', 17, -1, FALSE, '`month`', FALSE);
		$this->month->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['month'] =& $this->month;

		// visit
		$this->visit = new cField('tbl_target', 'tbl_target', 'x_visit', 'visit', '`visit`', 19, -1, FALSE, '`visit`', FALSE);
		$this->visit->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['visit'] =& $this->visit;

		// pageview
		$this->pageview = new cField('tbl_target', 'tbl_target', 'x_pageview', 'pageview', '`pageview`', 19, -1, FALSE, '`pageview`', FALSE);
		$this->pageview->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pageview'] =& $this->pageview;

		// alexarank
		$this->alexarank = new cField('tbl_target', 'tbl_target', 'x_alexarank', 'alexarank', '`alexarank`', 19, -1, FALSE, '`alexarank`', FALSE);
		$this->alexarank->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['alexarank'] =& $this->alexarank;

		// googlepagerank
		$this->googlepagerank = new cField('tbl_target', 'tbl_target', 'x_googlepagerank', 'googlepagerank', '`googlepagerank`', 19, -1, FALSE, '`googlepagerank`', FALSE);
		$this->googlepagerank->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['googlepagerank'] =& $this->googlepagerank;

		// googleindexedpage
		$this->googleindexedpage = new cField('tbl_target', 'tbl_target', 'x_googleindexedpage', 'googleindexedpage', '`googleindexedpage`', 19, -1, FALSE, '`googleindexedpage`', FALSE);
		$this->googleindexedpage->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['googleindexedpage'] =& $this->googleindexedpage;

		// yahooindexedpage
		$this->yahooindexedpage = new cField('tbl_target', 'tbl_target', 'x_yahooindexedpage', 'yahooindexedpage', '`yahooindexedpage`', 19, -1, FALSE, '`yahooindexedpage`', FALSE);
		$this->yahooindexedpage->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['yahooindexedpage'] =& $this->yahooindexedpage;

		// bingindexedpage
		$this->bingindexedpage = new cField('tbl_target', 'tbl_target', 'x_bingindexedpage', 'bingindexedpage', '`bingindexedpage`', 19, -1, FALSE, '`bingindexedpage`', FALSE);
		$this->bingindexedpage->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['bingindexedpage'] =& $this->bingindexedpage;

		// twitterfollower
		$this->twitterfollower = new cField('tbl_target', 'tbl_target', 'x_twitterfollower', 'twitterfollower', '`twitterfollower`', 19, -1, FALSE, '`twitterfollower`', FALSE);
		$this->twitterfollower->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['twitterfollower'] =& $this->twitterfollower;

		// facebookfan
		$this->facebookfan = new cField('tbl_target', 'tbl_target', 'x_facebookfan', 'facebookfan', '`facebookfan`', 19, -1, FALSE, '`facebookfan`', FALSE);
		$this->facebookfan->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['facebookfan'] =& $this->facebookfan;

		// yahoobacklink
		$this->yahoobacklink = new cField('tbl_target', 'tbl_target', 'x_yahoobacklink', 'yahoobacklink', '`yahoobacklink`', 19, -1, FALSE, '`yahoobacklink`', FALSE);
		$this->yahoobacklink->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['yahoobacklink'] =& $this->yahoobacklink;

		// blwbacklink
		$this->blwbacklink = new cField('tbl_target', 'tbl_target', 'x_blwbacklink', 'blwbacklink', '`blwbacklink`', 19, -1, FALSE, '`blwbacklink`', FALSE);
		$this->blwbacklink->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['blwbacklink'] =& $this->blwbacklink;

		// blcbacklink
		$this->blcbacklink = new cField('tbl_target', 'tbl_target', 'x_blcbacklink', 'blcbacklink', '`blcbacklink`', 19, -1, FALSE, '`blcbacklink`', FALSE);
		$this->blcbacklink->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['blcbacklink'] =& $this->blcbacklink;
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
		return "tbl_target_Highlight";
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
		return "`tbl_target`";
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
		return "`year` DESC,`month` DESC,`id_profile` ASC";
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
		return "INSERT INTO `tbl_target` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `tbl_target` SET ";
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
		$SQL = "DELETE FROM `tbl_target` WHERE ";
		$SQL .= ew_QuotedName('id_profile') . '=' . ew_QuotedValue($rs['id_profile'], $this->id_profile->FldDataType) . ' AND ';
		$SQL .= ew_QuotedName('year') . '=' . ew_QuotedValue($rs['year'], $this->year->FldDataType) . ' AND ';
		$SQL .= ew_QuotedName('month') . '=' . ew_QuotedValue($rs['month'], $this->month->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id_profile` = @id_profile@ AND `year` = @year@ AND `month` = @month@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id_profile->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id_profile@", ew_AdjustSql($this->id_profile->CurrentValue), $sKeyFilter); // Replace key value
		if (!is_numeric($this->year->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@year@", ew_AdjustSql($this->year->CurrentValue), $sKeyFilter); // Replace key value
		if (!is_numeric($this->month->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@month@", ew_AdjustSql($this->month->CurrentValue), $sKeyFilter); // Replace key value
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
			return "tbl_targetlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "tbl_targetlist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("tbl_targetview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "tbl_targetadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("tbl_targetedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("tbl_targetadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("tbl_targetdelete.php", $this->UrlParm());
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
		if (!is_null($this->year->CurrentValue)) {
			$sUrl .= "&year=" . urlencode($this->year->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase(\"InvalidRecord\"));";
		}
		if (!is_null($this->month->CurrentValue)) {
			$sUrl .= "&month=" . urlencode($this->month->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=tbl_target" : "";
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
		$this->year->setDbValue($rs->fields('year'));
		$this->month->setDbValue($rs->fields('month'));
		$this->visit->setDbValue($rs->fields('visit'));
		$this->pageview->setDbValue($rs->fields('pageview'));
		$this->alexarank->setDbValue($rs->fields('alexarank'));
		$this->googlepagerank->setDbValue($rs->fields('googlepagerank'));
		$this->googleindexedpage->setDbValue($rs->fields('googleindexedpage'));
		$this->yahooindexedpage->setDbValue($rs->fields('yahooindexedpage'));
		$this->bingindexedpage->setDbValue($rs->fields('bingindexedpage'));
		$this->twitterfollower->setDbValue($rs->fields('twitterfollower'));
		$this->facebookfan->setDbValue($rs->fields('facebookfan'));
		$this->yahoobacklink->setDbValue($rs->fields('yahoobacklink'));
		$this->blwbacklink->setDbValue($rs->fields('blwbacklink'));
		$this->blcbacklink->setDbValue($rs->fields('blcbacklink'));
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

		// year
		$this->year->CellCssStyle = ""; $this->year->CellCssClass = "";
		$this->year->CellAttrs = array(); $this->year->ViewAttrs = array(); $this->year->EditAttrs = array();

		// month
		$this->month->CellCssStyle = ""; $this->month->CellCssClass = "";
		$this->month->CellAttrs = array(); $this->month->ViewAttrs = array(); $this->month->EditAttrs = array();

		// visit
		$this->visit->CellCssStyle = ""; $this->visit->CellCssClass = "";
		$this->visit->CellAttrs = array(); $this->visit->ViewAttrs = array(); $this->visit->EditAttrs = array();

		// pageview
		$this->pageview->CellCssStyle = ""; $this->pageview->CellCssClass = "";
		$this->pageview->CellAttrs = array(); $this->pageview->ViewAttrs = array(); $this->pageview->EditAttrs = array();

		// alexarank
		$this->alexarank->CellCssStyle = ""; $this->alexarank->CellCssClass = "";
		$this->alexarank->CellAttrs = array(); $this->alexarank->ViewAttrs = array(); $this->alexarank->EditAttrs = array();

		// googlepagerank
		$this->googlepagerank->CellCssStyle = ""; $this->googlepagerank->CellCssClass = "";
		$this->googlepagerank->CellAttrs = array(); $this->googlepagerank->ViewAttrs = array(); $this->googlepagerank->EditAttrs = array();

		// googleindexedpage
		$this->googleindexedpage->CellCssStyle = ""; $this->googleindexedpage->CellCssClass = "";
		$this->googleindexedpage->CellAttrs = array(); $this->googleindexedpage->ViewAttrs = array(); $this->googleindexedpage->EditAttrs = array();

		// yahooindexedpage
		$this->yahooindexedpage->CellCssStyle = ""; $this->yahooindexedpage->CellCssClass = "";
		$this->yahooindexedpage->CellAttrs = array(); $this->yahooindexedpage->ViewAttrs = array(); $this->yahooindexedpage->EditAttrs = array();

		// bingindexedpage
		$this->bingindexedpage->CellCssStyle = ""; $this->bingindexedpage->CellCssClass = "";
		$this->bingindexedpage->CellAttrs = array(); $this->bingindexedpage->ViewAttrs = array(); $this->bingindexedpage->EditAttrs = array();

		// twitterfollower
		$this->twitterfollower->CellCssStyle = ""; $this->twitterfollower->CellCssClass = "";
		$this->twitterfollower->CellAttrs = array(); $this->twitterfollower->ViewAttrs = array(); $this->twitterfollower->EditAttrs = array();

		// facebookfan
		$this->facebookfan->CellCssStyle = ""; $this->facebookfan->CellCssClass = "";
		$this->facebookfan->CellAttrs = array(); $this->facebookfan->ViewAttrs = array(); $this->facebookfan->EditAttrs = array();

		// yahoobacklink
		$this->yahoobacklink->CellCssStyle = ""; $this->yahoobacklink->CellCssClass = "";
		$this->yahoobacklink->CellAttrs = array(); $this->yahoobacklink->ViewAttrs = array(); $this->yahoobacklink->EditAttrs = array();

		// blwbacklink
		$this->blwbacklink->CellCssStyle = ""; $this->blwbacklink->CellCssClass = "";
		$this->blwbacklink->CellAttrs = array(); $this->blwbacklink->ViewAttrs = array(); $this->blwbacklink->EditAttrs = array();

		// blcbacklink
		$this->blcbacklink->CellCssStyle = ""; $this->blcbacklink->CellCssClass = "";
		$this->blcbacklink->CellAttrs = array(); $this->blcbacklink->ViewAttrs = array(); $this->blcbacklink->EditAttrs = array();

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

		// visit
		$this->visit->ViewValue = $this->visit->CurrentValue;
		$this->visit->CssStyle = "";
		$this->visit->CssClass = "";
		$this->visit->ViewCustomAttributes = "";

		// pageview
		$this->pageview->ViewValue = $this->pageview->CurrentValue;
		$this->pageview->CssStyle = "";
		$this->pageview->CssClass = "";
		$this->pageview->ViewCustomAttributes = "";

		// alexarank
		$this->alexarank->ViewValue = $this->alexarank->CurrentValue;
		$this->alexarank->CssStyle = "";
		$this->alexarank->CssClass = "";
		$this->alexarank->ViewCustomAttributes = "";

		// googlepagerank
		$this->googlepagerank->ViewValue = $this->googlepagerank->CurrentValue;
		$this->googlepagerank->CssStyle = "";
		$this->googlepagerank->CssClass = "";
		$this->googlepagerank->ViewCustomAttributes = "";

		// googleindexedpage
		$this->googleindexedpage->ViewValue = $this->googleindexedpage->CurrentValue;
		$this->googleindexedpage->CssStyle = "";
		$this->googleindexedpage->CssClass = "";
		$this->googleindexedpage->ViewCustomAttributes = "";

		// yahooindexedpage
		$this->yahooindexedpage->ViewValue = $this->yahooindexedpage->CurrentValue;
		$this->yahooindexedpage->CssStyle = "";
		$this->yahooindexedpage->CssClass = "";
		$this->yahooindexedpage->ViewCustomAttributes = "";

		// bingindexedpage
		$this->bingindexedpage->ViewValue = $this->bingindexedpage->CurrentValue;
		$this->bingindexedpage->CssStyle = "";
		$this->bingindexedpage->CssClass = "";
		$this->bingindexedpage->ViewCustomAttributes = "";

		// twitterfollower
		$this->twitterfollower->ViewValue = $this->twitterfollower->CurrentValue;
		$this->twitterfollower->CssStyle = "";
		$this->twitterfollower->CssClass = "";
		$this->twitterfollower->ViewCustomAttributes = "";

		// facebookfan
		$this->facebookfan->ViewValue = $this->facebookfan->CurrentValue;
		$this->facebookfan->CssStyle = "";
		$this->facebookfan->CssClass = "";
		$this->facebookfan->ViewCustomAttributes = "";

		// yahoobacklink
		$this->yahoobacklink->ViewValue = $this->yahoobacklink->CurrentValue;
		$this->yahoobacklink->CssStyle = "";
		$this->yahoobacklink->CssClass = "";
		$this->yahoobacklink->ViewCustomAttributes = "";

		// blwbacklink
		$this->blwbacklink->ViewValue = $this->blwbacklink->CurrentValue;
		$this->blwbacklink->CssStyle = "";
		$this->blwbacklink->CssClass = "";
		$this->blwbacklink->ViewCustomAttributes = "";

		// blcbacklink
		$this->blcbacklink->ViewValue = $this->blcbacklink->CurrentValue;
		$this->blcbacklink->CssStyle = "";
		$this->blcbacklink->CssClass = "";
		$this->blcbacklink->ViewCustomAttributes = "";

		// id_profile
		$this->id_profile->HrefValue = "";
		$this->id_profile->TooltipValue = "";

		// year
		$this->year->HrefValue = "";
		$this->year->TooltipValue = "";

		// month
		$this->month->HrefValue = "";
		$this->month->TooltipValue = "";

		// visit
		$this->visit->HrefValue = "";
		$this->visit->TooltipValue = "";

		// pageview
		$this->pageview->HrefValue = "";
		$this->pageview->TooltipValue = "";

		// alexarank
		$this->alexarank->HrefValue = "";
		$this->alexarank->TooltipValue = "";

		// googlepagerank
		$this->googlepagerank->HrefValue = "";
		$this->googlepagerank->TooltipValue = "";

		// googleindexedpage
		$this->googleindexedpage->HrefValue = "";
		$this->googleindexedpage->TooltipValue = "";

		// yahooindexedpage
		$this->yahooindexedpage->HrefValue = "";
		$this->yahooindexedpage->TooltipValue = "";

		// bingindexedpage
		$this->bingindexedpage->HrefValue = "";
		$this->bingindexedpage->TooltipValue = "";

		// twitterfollower
		$this->twitterfollower->HrefValue = "";
		$this->twitterfollower->TooltipValue = "";

		// facebookfan
		$this->facebookfan->HrefValue = "";
		$this->facebookfan->TooltipValue = "";

		// yahoobacklink
		$this->yahoobacklink->HrefValue = "";
		$this->yahoobacklink->TooltipValue = "";

		// blwbacklink
		$this->blwbacklink->HrefValue = "";
		$this->blwbacklink->TooltipValue = "";

		// blcbacklink
		$this->blcbacklink->HrefValue = "";
		$this->blcbacklink->TooltipValue = "";

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
