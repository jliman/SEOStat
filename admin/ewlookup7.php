<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php
$lookup = new clookup;
$lookup->Page_Main();

//
// Page class for lookup
//
class clookup {

	// Page ID
	var $PageID = "lookup";

	// Page object name
	var $PageObjName = "lookup";

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		return ew_CurrentPage() . "?";
	}

	// Main
	function Page_Main() {
		$qs = new cQueryString();
		if ($qs->Count > 0) {
			$Sql = $qs->getValue("s");
			$Sql = TEAdecrypt($Sql, EW_RANDOM_KEY);
			if ($Sql <> "") {

				// Get the filter values (for "IN")
				$Value = ew_AdjustSql($qs->getConvertedValue("f"));
				if ($Value <> "") {
					$arValue = explode(",", $Value);
					$FldType = $qs->getValue("lft"); // Filter field data type
					if (is_numeric($FldType))
						$FldType = intval($FldType);
					$cnt = count($arValue);
					for ($i=0; $i<$cnt; $i++) {
						$arValue[$i] = ew_QuotedValue($arValue[$i], $FldType);
					}
					$Sql = str_replace("{filter_value}", implode(",", $arValue), $Sql);
				}

				// get the query value (for "LIKE" or "=")
				$Value = ew_AdjustSql($qs->getConvertedValue("q"));
				if ($Value <> "")
					$Sql = str_replace("{query_value}", $Value, $Sql);
				$this->GetLookupValues($Sql);
			}
		} else {
			die("Missing querystring.");
		}
	}

	// Get lookup values
	function GetLookupValues($Sql) {
		$rsarr = array();
		$rowcnt = 0;
		$conn = ew_Connect();
		if ($rs = $conn->Execute($Sql)) {
			$rowcnt = $rs->RecordCount();
			$fldcnt = $rs->FieldCount();
			$rsarr = $rs->GetRows();
			$rs->Close();
		}
		$conn->Close();

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			for ($i=0; $i<$rowcnt; $i++) {
				for ($j=0; $j<$fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = $this->RemoveDelimiters($str);
					echo ew_ConvertToUtf8($str . EW_FIELD_DELIMITER);
				}
				echo ew_ConvertToUtf8(EW_RECORD_DELIMITER);
			}
		}
	}

	// Process values
	function RemoveDelimiters($s) {
		$wrkstr = $s;
		if (strlen($wrkstr) > 0) {
			$wrkstr = str_replace("\r", " ", $wrkstr);
			$wrkstr = str_replace("\n", " ", $wrkstr);
			$wrkstr = str_replace(EW_RECORD_DELIMITER, "", $wrkstr);
			$wrkstr = str_replace(EW_FIELD_DELIMITER, " ", $wrkstr);
		}
		return $wrkstr;
	}
}
?>
