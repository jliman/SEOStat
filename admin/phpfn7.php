<?php

/**
 * PHPMaker Common classes and functions
 * (C) 2002-2010 e.World Technology Limited. All rights reserved.
*/

/**
 * Export document class
 */

class cExportDocument {
	var $Table;
	var $Text;
	var $Line = "";
	var $Style = "h"; // "v"(Vertical) or "h"(Horizontal)
	var $Horizontal = TRUE; // Horizontal

	// Constructor
	function __construct(&$tbl, $style) {
		$this->Table = $tbl;
		if (strtolower($style) == "v")
			$this->Style = "v";
		$this->Horizontal = ($this->Table->Export <> "xml" && ($this->Style <> "v" || $this->Table->Export == "csv"));
	}

	// Header
	function ExportHeader() {
		switch ($this->Table->Export) {
			case "html":
			case "email":
				if (EW_EXPORT_CSS_STYLES)
					$this->Text .= "<style>" . ew_ReadFile(EW_PROJECT_STYLESHEET_FILENAME) . "</style>\r\n";
				$this->Text .= "<table class=\"ewExportTable\">";
				break;
			case "word":
			case "excel":
				$this->Text .= "<table>";
				break;
			case "csv":
				$this->Text .= "";
		}
	}

	// Field Caption
	function ExportCaption(&$fld) {
		$this->ExportValueEx($fld, $fld->ExportCaption(), FALSE);
	}

	// Field value
	function ExportValue(&$fld) {
		$this->ExportValueEx($fld, $fld->ExportValue($this->Table->Export, $this->Table->ExportOriginalValue), TRUE);
	}

	// Field aggregate
	function ExportAggregate(&$fld, $type) {
		if ($this->Horizontal) {
			global $Language;
			$val = "";
			if (in_array($type, array("TOTAL", "COUNT", "AVERAGE")))
				$val = $Language->Phrase($type) . ": " . $fld->ExportValue($this->Table->Export, $this->Table->ExportOriginalValue);
			$this->ExportValueEx($fld, $val, FALSE);
		}
	}

	// Export a value (caption, field value, or aggregate)
	function ExportValueEx(&$fld, $val, $usestyle) {
		switch ($this->Table->Export) {
			case "html":
			case "email":
			case "word":
			case "excel":
				$this->Text .= "<td" . (($usestyle && EW_EXPORT_CSS_STYLES) ? $fld->CellStyles() : "") . ">" . strval($val) . "</td>";
				break;
			case "csv":
				if ($this->Line <> "")
					$this->Line .= ",";
				$this->Line .= "\"" . str_replace("\"", "\"\"", strval($val)) . "\"";
		}
	}

	// Begin a row
	function BeginExportRow($usestyle = FALSE) {
		if ($this->Horizontal) {
			switch ($this->Table->Export) {
				case "html":
				case "email":
				case "word":
				case "excel":
					$this->Text .= "<tr" . (($usestyle && EW_EXPORT_CSS_STYLES) ? $this->Table->RowStyles() : "") . ">";
					break;
				case "csv":
					$this->Line = "";
			}
		}
	}

	// End a row
	function EndExportRow() {
		if ($this->Horizontal) {
			switch ($this->Table->Export) {
				case "html":
				case "email":
				case "word":
				case "excel":
					$this->Text .= "</tr>";
					break;
				case "csv":
					$this->Line .= "\r\n";
					$this->Text .= $this->Line;
			}
		}
	}

	// Export a field
	function ExportField(&$fld) {
		if ($this->Horizontal) {
			$this->ExportValue($fld);
		} else { // Vertical, export as a row
			$td = "<td" . ((EW_EXPORT_CSS_STYLES) ? $fld->CellStyles() : "") . ">";
			$this->Text .= "<tr><td>" . $fld->ExportCaption() . "</td>" . $td .
				$fld->ExportValue($this->Table->Export, $this->Table->ExportOriginalValue) .
				"</td></tr>";
		}
	}

	// Footer
	function ExportFooter() {
		switch ($this->Table->Export) {
			case "html":
			case "email":
			case "word":
			case "excel":
				$this->Text .= "</table>";
		}
	}
}

/**
 * QueryString class
 */

class cQueryString {
	var $values = array();
	var $Count;

	function __construct() {
		$ar = explode("&", ew_ServerVar("QUERY_STRING"));
		foreach ($ar as $p) {
			$arp = explode("=", $p);
			if (count($arp) == 2) $this->values[urldecode($arp[0])] = $arp[1];
		}
		$this->Count = count($this->values);
	}

	function getValue($name) {
		return (array_key_exists($name, $this->values)) ? $this->values[$name] : "";
	}

	function getUrlDecodedValue($name) {
		return urldecode($this->getValue($name));
	}

	function getRawUrlDecodedValue($name) {
		return rawurldecode($this->getValue($name));
	}

	function getConvertedValue($name) {
		return ew_ConvertFromUtf8($this->getRawUrlDecodedValue($name));
	}
}

/**
 * Email class
 */

class cEmail {

	// Class properties
	var $Sender = ""; // Sender
	var $Recipient = ""; // Recipient
	var $Cc = ""; // Cc
	var $Bcc = ""; // Bcc
	var $Subject = ""; // Subject
	var $Format = ""; // Format
	var $Content = ""; // Content
	var $Charset = ""; // Charset
	var $SendErrDescription; // Send error description

	// Method to load email from template
	function Load($fn) {
		$fn = ew_ScriptFolder() . EW_PATH_DELIMITER . $fn;
		$sWrk = ew_ReadFile($fn); // Load text file content
		if ($sWrk <> "") {

			// Locate Header & Mail Content
			if (EW_IS_WINDOWS) {
				$i = strpos($sWrk, "\r\n\r\n");
			} else {
				$i = strpos($sWrk, "\n\n");
				if ($i === FALSE) $i = strpos($sWrk, "\r\n\r\n");
			}
			if ($i > 0) {
				$sHeader = substr($sWrk, 0, $i);
				$this->Content = trim(substr($sWrk, $i, strlen($sWrk)));
				if (EW_IS_WINDOWS) {
					$arrHeader = explode("\r\n", $sHeader);
				} else {
					$arrHeader = explode("\n", $sHeader);
				}
				for ($j = 0; $j < count($arrHeader); $j++) {
					$i = strpos($arrHeader[$j], ":");
					if ($i > 0) {
						$sName = trim(substr($arrHeader[$j], 0, $i));
						$sValue = trim(substr($arrHeader[$j], $i+1, strlen($arrHeader[$j])));
						switch (strtolower($sName))
						{
							case "subject":
								$this->Subject = $sValue;
								break;
							case "from":
								$this->Sender = $sValue;
								break;
							case "to":
								$this->Recipient = $sValue;
								break;
							case "cc":
								$this->Cc = $sValue;
								break;
							case "bcc":
								$this->Bcc = $sValue;
								break;
							case "format":
								$this->Format = $sValue;
								break;
						}
					}
				}
			}
		}
	}

	// Method to replace sender
	function ReplaceSender($ASender) {
		$this->Sender = str_replace('<!--$From-->', $ASender, $this->Sender);
	}

	// Method to replace recipient
	function ReplaceRecipient($ARecipient) {
		$this->Recipient = str_replace('<!--$To-->', $ARecipient, $this->Recipient);
	}

	// Method to add Cc email
	function AddCc($ACc) {
		if ($ACc <> "") {
			if ($this->Cc <> "") $this->Cc .= ";";
			$this->Cc .= $ACc;
		}
	}

	// Method to add Bcc email
	function AddBcc($ABcc) {
		if ($ABcc <> "")  {
			if ($this->Bcc <> "") $this->Bcc .= ";";
			$this->Bcc .= $ABcc;
		}
	}

	// Method to replace subject
	function ReplaceSubject($ASubject) {
		$this->Subject = str_replace('<!--$Subject-->', $ASubject, $this->Subject);
	}

	// Method to replace content
	function ReplaceContent($Find, $ReplaceWith) {
		$this->Content = str_replace($Find, $ReplaceWith, $this->Content);
	}

	// Method to send email
	function Send() {
		global $gsEmailErrDesc;
		$result = ew_SendEmail($this->Sender, $this->Recipient, $this->Cc, $this->Bcc,
			$this->Subject, $this->Content, $this->Format, $this->Charset);
		$this->SendErrDescription = $gsEmailErrDesc;
		return $result;
	}
}

/**
 * Pager item class
 */

class cPagerItem {
	var $Start;
	var $Text;
	var $Enabled;
}

/**
 * Numeric pager class
 */

class cNumericPager {
	var $Items = array();
	var $Count, $FromIndex, $ToIndex, $RecordCount, $PageSize, $Range;
	var $FirstButton, $PrevButton, $NextButton, $LastButton;
	var $ButtonCount = 0;
	var $Visible = TRUE;

	function cNumericPager($StartRec, $DisplayRecs, $TotalRecs, $RecRange)
	{
		$this->FirstButton = new cPagerItem;
		$this->PrevButton = new cPagerItem;
		$this->NextButton = new cPagerItem;
		$this->LastButton = new cPagerItem;
    $this->FromIndex = intval($StartRec);
		$this->PageSize = intval($DisplayRecs);
		$this->RecordCount = intval($TotalRecs);
		$this->Range = intval($RecRange);
		if ($this->PageSize == 0) return;
		if ($this->FromIndex > $this->RecordCount)
			$this->FromIndex = $this->RecordCount;
		$this->ToIndex = $this->FromIndex + $this->PageSize - 1;
		if ($this->ToIndex > $this->RecordCount)
			$this->ToIndex = $this->RecordCount;

		// setup
		$this->SetupNumericPager();

		// update button count
		if ($this->FirstButton->Enabled) $this->ButtonCount++;
		if ($this->PrevButton->Enabled) $this->ButtonCount++;
		if ($this->NextButton->Enabled) $this->ButtonCount++;
		if ($this->LastButton->Enabled) $this->ButtonCount++;
		$this->ButtonCount += count($this->Items);
  }

	// Add pager item
	function AddPagerItem($StartIndex, $Text, $Enabled)
	{
		$Item = new cPagerItem;
		$Item->Start = $StartIndex;
		$Item->Text = $Text;
		$Item->Enabled = $Enabled;
		$this->Items[] = $Item;
	}

	// Setup pager items
	function SetupNumericPager()
	{
		if ($this->RecordCount > $this->PageSize) {
			$Eof = ($this->RecordCount < ($this->FromIndex + $this->PageSize));
			$HasPrev = ($this->FromIndex > 1);

			// First Button
			$TempIndex = 1;
			$this->FirstButton->Start = $TempIndex;
			$this->FirstButton->Enabled = ($this->FromIndex > $TempIndex);

			// Prev Button
			$TempIndex = $this->FromIndex - $this->PageSize;
			if ($TempIndex < 1) $TempIndex = 1;
			$this->PrevButton->Start = $TempIndex;
			$this->PrevButton->Enabled = $HasPrev;

			// Page links
			if ($HasPrev || !$Eof) {
				$x = 1;
				$y = 1;
				$dx1 = intval(($this->FromIndex-1)/($this->PageSize*$this->Range))*$this->PageSize*$this->Range + 1;
				$dy1 = intval(($this->FromIndex-1)/($this->PageSize*$this->Range))*$this->Range + 1;
				if (($dx1+$this->PageSize*$this->Range-1) > $this->RecordCount) {
					$dx2 = intval($this->RecordCount/$this->PageSize)*$this->PageSize + 1;
					$dy2 = intval($this->RecordCount/$this->PageSize) + 1;
				} else {
					$dx2 = $dx1 + $this->PageSize*$this->Range - 1;
					$dy2 = $dy1 + $this->Range - 1;
				}
				while ($x <= $this->RecordCount) {
					if ($x >= $dx1 && $x <= $dx2) {
						$this->AddPagerItem($x, $y, $this->FromIndex<>$x);
						$x += $this->PageSize;
						$y++;
					} elseif ($x >= ($dx1-$this->PageSize*$this->Range) && $x <= ($dx2+$this->PageSize*$this->Range)) {
						if ($x+$this->Range*$this->PageSize < $this->RecordCount) {
							$this->AddPagerItem($x, $y . "-" . ($y+$this->Range-1), TRUE);
						} else {
							$ny = intval(($this->RecordCount-1)/$this->PageSize) + 1;
							if ($ny == $y) {
								$this->AddPagerItem($x, $y, TRUE);
							} else {
								$this->AddPagerItem($x, $y . "-" . $ny, TRUE);
							}
						}
						$x += $this->Range*$this->PageSize;
						$y += $this->Range;
					} else {
						$x += $this->Range*$this->PageSize;
						$y += $this->Range;
					}
				}
			}

			// Next Button
			$TempIndex = $this->FromIndex + $this->PageSize;
			$this->NextButton->Start = $TempIndex;
			$this->NextButton->Enabled = !$Eof;

			// Last Button
			$TempIndex = intval(($this->RecordCount-1)/$this->PageSize)*$this->PageSize + 1;
			$this->LastButton->Start = $TempIndex;
			$this->LastButton->Enabled = ($this->FromIndex < $TempIndex);
		}
	}
}

/**
 * PrevNext pager class
 */

class cPrevNextPager {
	var $FirstButton, $PrevButton, $NextButton, $LastButton;
	var $CurrentPage, $PageCount, $FromIndex, $ToIndex, $RecordCount;
	var $Visible = TRUE;

	function cPrevNextPager($StartRec, $DisplayRecs, $TotalRecs)
	{
		$this->FirstButton = new cPagerItem;
		$this->PrevButton = new cPagerItem;
		$this->NextButton = new cPagerItem;
		$this->LastButton = new cPagerItem;
		$this->FromIndex = intval($StartRec);
		$this->PageSize = intval($DisplayRecs);
		$this->RecordCount = intval($TotalRecs);
		if ($this->PageSize == 0) return;
		$this->CurrentPage = intval(($this->FromIndex-1)/$this->PageSize) + 1;
		$this->PageCount = intval(($this->RecordCount-1)/$this->PageSize) + 1;
		if ($this->FromIndex > $this->RecordCount)
			$this->FromIndex = $this->RecordCount;
		$this->ToIndex = $this->FromIndex + $this->PageSize - 1;
		if ($this->ToIndex > $this->RecordCount)
			$this->ToIndex = $this->RecordCount;

		// First Button
		$TempIndex = 1;
		$this->FirstButton->Start = $TempIndex;
		$this->FirstButton->Enabled = ($TempIndex <> $this->FromIndex);

		// Prev Button
		$TempIndex = $this->FromIndex - $this->PageSize;
		if ($TempIndex < 1) $TempIndex = 1;
		$this->PrevButton->Start = $TempIndex;
		$this->PrevButton->Enabled = ($TempIndex <> $this->FromIndex);

		// Next Button
		$TempIndex = $this->FromIndex + $this->PageSize;
		if ($TempIndex > $this->RecordCount)
			$TempIndex = $this->FromIndex;
		$this->NextButton->Start = $TempIndex;
		$this->NextButton->Enabled = ($TempIndex <> $this->FromIndex);

		// Last Button
		$TempIndex = intval(($this->RecordCount-1)/$this->PageSize)*$this->PageSize + 1;
		$this->LastButton->Start = $TempIndex;
		$this->LastButton->Enabled = ($TempIndex <> $this->FromIndex);
  }
}

/**
 * Field class
 */

class cField {
	var $TblName; // Table name
	var $TblVar; // Table variable name
	var $FldName; // Field name
	var $FldVar; // Field variable name
	var $FldExpression; // Field expression (used in SQL)
	var $FldIsVirtual; // Virtual field
	var $FldVirtualExpression; // Virtual field expression (used in ListSQL)
	var $FldDefaultErrMsg; // Default error message
	var $VirtualValue; // Virtual field value
	var $TooltipValue; // Field tooltip value
	var $TooltipWidth = 0; // Field tooltip width
	var $FldType; // Field type
	var $FldDataType; // PHPMaker Field type
	var $AdvancedSearch; // AdvancedSearch Object
	var $Upload; // Upload Object
	var $FldDateTimeFormat; // Date time format
	var $CssStyle; // CSS style
	var $CssClass; // CSS class
	var $ImageAlt; // Image alt
	var $ImageWidth = 0; // Image width
	var $ImageHeight = 0; // Image height
	var $ViewCustomAttributes; // View custom attributes
	var $EditCustomAttributes; // Edit custom attributes
	var $Count; // Count
	var $Total; // Total
	var $TrueValue = '1';
	var $FalseValue = '0';
	var $Visible = TRUE; // Visible
	var $Disabled; // Disabled
	var $TruncateMemoRemoveHtml; // Remove HTML from memo field
	var $CustomMsg = ""; // Custom message
	var $RowAttributes = ""; // Row attributes
	var $CellCssClass = ""; // Cell CSS class
	var $CellCssStyle = ""; // Cell CSS style
	var $CellCustomAttributes = ""; // Cell custom attributes
	var $MultiUpdate; // Multi update
	var $OldValue; // Old Value
	var $ConfirmValue; // Confirm value
	var $CurrentValue; // Current value
	var $ViewValue; // View value
	var $EditValue; // Edit value
	var $EditValue2; // Edit value 2 (search)
	var $HrefValue; // Href value
	var $HrefValue2; // Href value 2 (confirm page upload control)
	var $FormValue; // Form value
	var $QueryStringValue; // QueryString value
	var $DbValue; // Database value
	var $Sortable = TRUE; // Sortable
	var $UploadPath = EW_UPLOAD_DEST_PATH; // Upload path
	var $CellAttrs = array(); // Cell custom attributes
	var $EditAttrs = array(); // Edit custom attributes
	var $ViewAttrs = array(); // View custom attributes

	// Constructor
	function cField($tblvar, $tblname, $fldvar, $fldname, $fldexp, $fldtype, $flddtfmt, $upload, $fldvirtualexp, $fldvirtual) {
		$this->TblVar = $tblvar;
		$this->TblName = $tblname;
		$this->FldVar = $fldvar;
		$this->FldName = $fldname;
		$this->FldExpression = $fldexp;
		$this->FldType = $fldtype;
		$this->FldDataType = ew_FieldDataType($fldtype);
		$this->FldDateTimeFormat = $flddtfmt;
		$this->AdvancedSearch = new cAdvancedSearch();
		if ($upload)
			$this->Upload = new cUpload($this->TblVar, $this->FldVar);
		$this->FldVirtualExpression = $fldvirtualexp;
		$this->FldIsVirtual = $fldvirtual;
	}

	// Field caption
	function FldCaption() {
		global $Language;
		return $Language->FieldPhrase($this->TblVar, substr($this->FldVar, 2), "FldCaption");
	}

	// Field title
	function FldTitle() {
		global $Language;
		return $Language->FieldPhrase($this->TblVar, substr($this->FldVar, 2), "FldTitle");
	}

	// Field image alt
	function FldAlt() {
		global $Language;
		return $Language->FieldPhrase($this->TblVar, substr($this->FldVar, 2), "FldAlt");
	}

	// Field error message
	function FldErrMsg() {
		global $Language;
		$err = $Language->FieldPhrase($this->TblVar, substr($this->FldVar, 2), "FldErrMsg");
		if ($err == "") $err = $this->FldDefaultErrMsg . " - " . $this->FldCaption();
		return $err;
	}

	// View Attributes
	function ViewAttributes() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->ViewAttrs["style"] <> "")
			$sStyle .= " " . $this->ViewAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->ViewAttrs["class"] <> "")
			$sClass .= " " . $this->ViewAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		if (trim($this->ImageAlt) <> "")
			$this->ViewAttrs["alt"] = trim($this->ImageAlt);
		if (intval($this->ImageWidth) > 0)
			$this->ViewAttrs["width"] = intval($this->ImageWidth);
		if (intval($this->ImageHeight) > 0)
			$this->ViewAttrs["height"] = intval($this->ImageHeight);
		foreach ($this->ViewAttrs as $k => $v) {
			if ($k <> "style" && $k <> "class" && trim($v) <> "")
				$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
		}
		if (trim($this->ViewCustomAttributes) <> "")
			$sAtt .= " " . trim($this->ViewCustomAttributes);
		return $sAtt;
	}

	// Edit attributes
	function EditAttributes() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->EditAttrs["style"] <> "")
			$sStyle .= " " . $this->EditAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->EditAttrs["class"] <> "")
			$sClass .= " " . $this->EditAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if ($sClass <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		if ($this->Disabled)
			$this->EditAttrs["disabled"] = "disabled";
		foreach ($this->EditAttrs as $k => $v) {
			if ($k <> "style" && $k <> "class" && trim($v) <> "")
				$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
		}
		if (trim($this->EditCustomAttributes) <> "")
			$sAtt .= " " . trim($this->EditCustomAttributes);
		return $sAtt;
	}

	// Cell styles
	function CellStyles() {
		$sAtt = "";
		$sStyle = trim($this->CellCssStyle);
		if (@$this->CellAttrs["style"] <> "")
			$sStyle .= " " . $this->CellAttrs["style"];
		$sClass = trim($this->CellCssClass);
		if (@$this->CellAttrs["class"] <> "")
			$sClass .= " " . $this->CellAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Cell attributes
	function CellAttributes() {
		$sAtt = $this->CellStyles();
		foreach ($this->CellAttrs as $k => $v) {
			if ($k <> "style" && $k <> "class" && trim($v) <> "")
				$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
		}
		if (trim($this->CellCustomAttributes) <> "")
			$sAtt .= " " . trim($this->CellCustomAttributes);
		return $sAtt;
	}

	// Sort
	function getSort() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TblVar . "_" . EW_TABLE_SORT . "_" . $this->FldVar];
	}

	function setSort($v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TblVar . "_" . EW_TABLE_SORT . "_" . $this->FldVar] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TblVar . "_" . EW_TABLE_SORT . "_" . $this->FldVar] = $v;
		}
	}

	function ReverseSort() {
		return ($this->getSort() == "ASC") ? "DESC" : "ASC";
	}

	// List view value
	function ListViewValue() {
		if ($this->FldDataType == EW_DATATYPE_XML) {
			return $this->ViewValue . "&nbsp;";
		} else {
			$value = trim(strval($this->ViewValue));
			if ($value <> "") {
				$value2 = trim(preg_replace('/<[^img][^>]*>/i', '', strval($value)));
				return ($value2 <> "") ? $this->ViewValue : "&nbsp;";
			} else {
				return "&nbsp;";
			}
		}
	}

	// Export caption
	function ExportCaption() {
		return (EW_EXPORT_FIELD_CAPTION) ? $this->FldCaption() : $this->FldName;
	}

	// Export value
	function ExportValue($Export, $Original) {
		$ExportValue = ($Original) ? $this->CurrentValue : $this->ViewValue;
		if ($Export == "xml" && is_null($ExportValue))
			$ExportValue = "<Null>";
		return $ExportValue;
	}

	// Form value
	function setFormValue($v) {
		$this->FormValue = ew_StripSlashes($v);
		if (is_array($this->FormValue))
			$this->FormValue = implode(",", $this->FormValue);
		$this->CurrentValue = $this->FormValue;
	}

	// Old value (from $_POST)
	function setOldValue($v) {
		$this->OldValue = ew_StripSlashes($v);
		if (is_array($this->OldValue)) {
			$this->OldValue = implode(",", $this->OldValue);
		} else {
			$this->OldValue = $v;
		}
	}

	// QueryString value
	function setQueryStringValue($v) {
		$this->QueryStringValue = ew_StripSlashes($v);
		$this->CurrentValue = $this->QueryStringValue;
	}

	// Database value
	function setDbValue($v) {
		$this->DbValue = $v;
		$this->CurrentValue = $this->DbValue;
	}

	// Set database value with error default
	function SetDbValueDef(&$rs, $value, $default, $skip = FALSE) {
		if (($skip && strval($value) == "") || !$this->Visible || $this->Disabled)
			return;
		switch ($this->FldType) {
			case 2:
			case 3:
			case 16:
			case 17:
			case 18:  // Integer
				$value = trim($value);
				$DbValue = (is_numeric($value)) ? intval($value) : $default;
				break;
			case 19:
			case 20:
			case 21: // Big integer
				$value = trim($value);
				$DbValue = (is_numeric($value)) ? $value : $default;
				break;
			case 5:
			case 6:
			case 14:
			case 131: // Double
			case 139:
			case 4: // Single
				$value = trim($value);
				$value = ew_StrToFloat($value);
				$DbValue = (is_numeric($value)) ? $value : $default;
				break;
			case 7:
			case 133:
			case 134:
			case 135: // Date
			case 141: // XML
			case 145: // Time
			case 146: // DateTiemOffset
			case 201:
			case 203:
			case 129:
			case 130:
			case 200:
			case 202: // String
				$value = trim($value);
				$DbValue = ($value == "") ? $default : $value;
				break;
			case 128:
			case 204:
			case 205: // Binary
				$DbValue = (is_null($value)) ? $default : $value;
				break;
			case 72: // GUID
				$value = trim($value);
				$DbValue = ($value <> "" && ew_CheckGUID($value)) ? $value : $default;
				break;
			case 11: // Boolean
				$DbValue = (is_bool($value) || is_numeric($value)) ? $value : $default;
				break;
			default:
				$DbValue = $value;
		}
		$this->setDbValue($DbValue);
		$rs[$this->FldName] = $this->DbValue;
	}

	// Session value
	function getSessionValue() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TblVar . "_" . $this->FldVar . "_SessionValue"];
	}

	function setSessionValue($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TblVar . "_" . $this->FldVar . "_SessionValue"] = $v;
	}
}

/**
 * List option collection class
 */

class cListOptions {
	var $Items = array();
	var $CustomItem = "";

	// Add and return a new option (return-by-reference is for PHP 5 only)
	function &Add($Name) {
		$item = new cListOption($Name);
		$this->Items[$Name] = $item;
		return $item;
	}

	// Load default settings
	function LoadDefault() {
		$this->CustomItem = "";
		foreach ($this->Items as $key => $item)
			$this->Items[$key]->Body = "";
	}

	// Hide all options
	function HideAllOptions() {
		foreach ($this->Items as $key => $item)
			$this->Items[$key]->Visible = FALSE;
	}

	// Show all options
	function ShowAllOptions() {
		foreach ($this->Items as $key => $item)
			$this->Items[$key]->Visible = TRUE;
	}

	// Get item by name (return-by-reference is for PHP 5 only)
	// predefined names: view/edit/copy/delete/detail_<DetailTable>/userpermission/checkbox
	function &GetItem($Name) {
		$item = array_key_exists($Name, $this->Items) ? $this->Items[$Name] : NULL;
		return $item;
	}

	// Move item to position
	function MoveItem($Name, $Pos) {
		$cnt = count($this->Items);
		if ($Pos < 0 || $Pos >= $cnt)
			return;
		$item = $this->GetItem($Name);
   	if ($item) {
			$item = ew_Clone($item);
			unset($this->Items[$Name]);
			$this->Items = array_merge(array_slice($this->Items, 0, $Pos),
				array($Name => $item), array_slice($this->Items, $Pos));
   	}
	}

	// Render list options
	function Render($Part, $Pos) {
		$ShowTd = ($Pos <> "bottom");
		if ($this->CustomItem <> "") {
			$cnt = 0;
			foreach ($this->Items as $key => $item) {
				$item = $this->Items[$key];
				if ($item->Visible && $this->ShowPos($item->OnLeft, $Pos))
					$cnt++;
				if ($item->Name == $this->CustomItem)
					$opt = $item;
			}
			if (is_object($opt) && $cnt > 0) {
				if ($this->ShowPos($opt->OnLeft, $Pos)) {
					echo $opt->Render($Part, $ShowTd, $cnt);
				} else {
					echo $opt->Render("", $ShowTd, $cnt);
				}
			}
		} else {
			foreach ($this->Items as $key => $item) {
				$item = $this->Items[$key];
				if ($item->Visible && $this->ShowPos($item->OnLeft, $Pos))
					echo $item->Render($Part, $ShowTd);
			}
		}
	}

	function ShowPos($OnLeft, $Pos) {
		return ($OnLeft && $Pos == "left") || (!$OnLeft && $Pos == "right") || ($Pos == "bottom");
	}
}

/**
 * List option class
 */

class cListOption {
	var $Name;
	var $OnLeft;
	var $CssStyle;
	var $Visible = TRUE;
	var $Header;
	var $Body;
	var $Footer;

	function cListOption($Name) {
		$this->Name = $Name;
	}

	function Render($Part, $ShowTd, $ColSpan = 1) {
		if ($Part == "header") {
			$value = $this->Header;
		} elseif ($Part == "body") {
			$value = $this->Body;
		} elseif ($Part == "footer") {
			$value = $this->Footer;
		} else {
			$value = $Part;
		}
		$td = "";
		if ($ShowTd) {
			$td = "<td";
			if ($this->CssStyle <> "")
				$td .= " style=\"" . $this->CssStyle . "\"";
			if ($ColSpan > 1)
				$td .= " colspan=\"" . $ColSpan . "\"";
			$td .= ">";
		}
		$res = ($value <> "") ? $value : "&nbsp;";
		$res = "<span class=\"phpmaker\">" . $res . "</span>";
		if ($td <> "")
			$res = $td . $res . "</td>";
		return $res;
	}
}
?>
<?php

/**
 * Advanced Search class
 */

class cAdvancedSearch {
	var $SearchValue; // Search value
	var $SearchOperator; // Search operator
	var $SearchCondition; // Search condition
	var $SearchValue2; // Search value 2
	var $SearchOperator2; // Search operator 2
}
?>
<?php

/**
 * Upload class
 */

class cUpload {
	var $Index = 0; // Index for multiple form elements
	var $TblVar; // Table variable
	var $FldVar; // Field variable
	var $Message; // Error message
	var $DbValue; // Value from database
	var $Value = NULL; // Upload value
	var $Action; // Upload action
	var $FileName; // Upload file name
	var $FileSize; // Upload file size
	var $ContentType; // File content type
	var $ImageWidth; // Image width
	var $ImageHeight; // Image height
	var $Error; // Upload error

	// Constructor
	function cUpload($TblVar, $FldVar, $Binary = FALSE) {
		$this->TblVar = $TblVar;
		$this->FldVar = $FldVar;
	}

	function getSessionID() {
		return EW_PROJECT_NAME . "_" . $this->TblVar . "_" . $this->FldVar . "_" . $this->Index;
	}

	// Save value to Session
	function SaveDbToSession() {
		$sSessionID = $this->getSessionID();
		$_SESSION[$sSessionID . "_DbValue"] = $this->DbValue;
	}

	// Restore value from Session
	function RestoreDbFromSession() {
		$sSessionID = $this->getSessionID();
		$this->DbValue = @$_SESSION[$sSessionID . "_DbValue"];
	}

	// Remove value from Session
	function RemoveDbFromSession() {
		$sSessionID = $this->getSessionID();
		unset($_SESSION[$sSessionID . "_DbValue"]);
	}

	// Save upload values to Session
	function SaveToSession() {
		$sSessionID = $this->getSessionID();
		$_SESSION[$sSessionID . "_Action"] = $this->Action;
		$_SESSION[$sSessionID . "_FileSize"] = $this->FileSize;
		$_SESSION[$sSessionID . "_FileName"] = $this->FileName;
		$_SESSION[$sSessionID . "_ContentType"] = $this->ContentType;
		$_SESSION[$sSessionID . "_ImageWidth"] = $this->ImageWidth;
		$_SESSION[$sSessionID . "_ImageHeight"] = $this->ImageHeight;	
		$_SESSION[$sSessionID . "_Value"] = $this->Value;
		$_SESSION[$sSessionID . "_Error"] = $this->Error;
	}

	// Restore upload values from Session
	function RestoreFromSession() {
		$sSessionID = $this->getSessionID();
		$this->Action = @$_SESSION[$sSessionID . "_Action"];
		$this->FileSize = @$_SESSION[$sSessionID . "_FileSize"];
		$this->FileName = @$_SESSION[$sSessionID . "_FileName"];
		$this->ContentType = @$_SESSION[$sSessionID . "_ContentType"];
		$this->ImageWidth = @$_SESSION[$sSessionID . "_ImageWidth"];
		$this->ImageHeight = @$_SESSION[$sSessionID . "_ImageHeight"];
		$this->Value = @$_SESSION[$sSessionID . "_Value"];
		$this->Error = @$_SESSION[$sSessionID . "_Error"];
	}

	// Remove upload values from Session
	function RemoveFromSession() {
		$sSessionID = $this->getSessionID();
		unset($_SESSION[$sSessionID . "_Action"]);
		unset($_SESSION[$sSessionID . "_FileSize"]);
		unset($_SESSION[$sSessionID . "_FileName"]);
		unset($_SESSION[$sSessionID . "_ContentType"]);
		unset($_SESSION[$sSessionID . "_ImageWidth"]);
		unset($_SESSION[$sSessionID . "_ImageHeight"]);
		unset($_SESSION[$sSessionID . "_Value"]);
		unset($_SESSION[$sSessionID . "_Error"]);
	}

	// Check file type of the uploaded file
	function UploadAllowedFileExt($filename) {
		return ew_CheckFileType($filename);
	}

	// Get upload file
	function UploadFile() {
		global $objForm;
		$this->Value = NULL; // Reset first
		$gsFldVar = $this->FldVar;
		$gsFldVarAction = "a" . substr($gsFldVar, 1);
		$gsFldVarWidth = "wd" . substr($gsFldVar, 1);
		$gsFldVarHeight = "ht" . substr($gsFldVar, 1);

		// Get action
		$this->Action = $objForm->GetValue($gsFldVarAction);

		// Get and check the upload file size
		$this->FileSize = $objForm->GetUploadFileSize($gsFldVar);

		// Get and check the upload file type
		$this->FileName = $objForm->GetUploadFileName($gsFldVar);

		// Get upload file content type
		$this->ContentType = $objForm->GetUploadFileContentType($gsFldVar);

		// Get upload value
		$this->Value = $objForm->GetUploadFileData($gsFldVar);

		// Get upload error
		$this->Error = $objForm->GetUploadFileError($gsFldVar);

		// Get image width and height
		$this->ImageWidth = $objForm->GetUploadImageWidth($gsFldVar);
		$this->ImageHeight = $objForm->GetUploadImageHeight($gsFldVar);
		if ($this->ImageWidth < 0 || $this->ImageHeight < 0) {
			$this->ImageWidth = $objForm->GetValue($gsFldVarWidth);
			$this->ImageHeight = $objForm->GetValue($gsFldVarHeight);
		}
		return TRUE; // Normal return
	}

	// Resize image
	function Resize($width, $height, $quality) {
		if (!ew_Empty($this->Value)) {
			$wrkwidth = $width;
			$wrkheight = $height;
			if (ew_ResizeBinary($this->Value, $wrkwidth, $wrkheight, $quality)) { // P6
				$this->ImageWidth = $wrkwidth;
				$this->ImageHeight = $wrkheight;
				$this->FileSize = strlen($this->Value);
			}
		}
	}

	// Save uploaded data to file (Path relative to application root)
	function SaveToFile($Path, $NewFileName, $OverWrite) {
		if (!ew_Empty($this->Value)) {
			$Path = ew_UploadPathEx(TRUE, $Path);
			if (trim(strval($NewFileName)) == "") $NewFileName = $this->FileName;
			if ($OverWrite) {
				return ew_SaveFile($Path, $NewFileName, $this->Value);
			} else {
				return ew_SaveFile($Path, ew_UploadFileNameEx($Path, $NewFileName), $this->Value);
			}
		}
		return FALSE;
	}

	// Resize and save uploaded data to file (Path relative to application root)
	function ResizeAndSaveToFile($Width, $Height, $Quality, $Path, $NewFileName, $OverWrite) {
		$bResult = FALSE;
		if (!ew_Empty($this->Value)) {
			$OldValue = $this->Value;
			$this->Resize($Width, $Height, $Quality);
			$bResult = $this->SaveToFile($Path, $NewFileName, $OverWrite);
			$this->Value = $OldValue;
		}
		return $bResult;
	}
}
?>
<?php

/**
 * Advanced Security class
 */

class cAdvancedSecurity {
	var $UserLevel = array(); // All User Levels
	var $UserLevelPriv = array(); // All User Level permissions
	var $UserLevelID = array(); // User Level ID array
	var $UserID = array(); // User ID array
	var $CurrentUserLevelID;
	var $CurrentUserLevel; // Permissions
	var $CurrentUserID;
	var $CurrentParentUserID;

	// Constructor
	function __construct() {

		// Init User Level
		$this->CurrentUserLevelID = $this->SessionUserLevelID();
		if (is_numeric($this->CurrentUserLevelID) && intval($this->CurrentUserLevelID) >= -1) {
			$this->UserLevelID[] = $this->CurrentUserLevelID;
		}

		// Init User ID
		$this->CurrentUserID = $this->SessionUserID();
		$this->CurrentParentUserID = $this->SessionParentUserID();

		// Load user level (for TablePermission_Loading event)
		$this->LoadUserLevel();
	}

	// Session User ID
	function SessionUserID() {
		return strval(@$_SESSION[EW_SESSION_USER_ID]);
	}

	function setSessionUserID($v) {
		$_SESSION[EW_SESSION_USER_ID] = $v;
		$this->CurrentUserID = $v;
	}

	// Session Parent User ID
	function SessionParentUserID() {
		return strval(@$_SESSION[EW_SESSION_PARENT_USER_ID]);
	}

	function setSessionParentUserID($v) {
		$_SESSION[EW_SESSION_PARENT_USER_ID] = $v;
		$this->CurrentParentUserID = $v;
	}

	// Session User Level ID
	function SessionUserLevelID() {
		return @$_SESSION[EW_SESSION_USER_LEVEL_ID];
	}

	function setSessionUserLevelID($v) {
		$_SESSION[EW_SESSION_USER_LEVEL_ID] = $v;
		$this->CurrentUserLevelID = $v;
		if (is_numeric($v) && $v >= -1)
			$this->UserLevelID = array($v);
	}

	// Session User Level value
	function SessionUserLevel() {
		return @$_SESSION[EW_SESSION_USER_LEVEL];
	}

	function setSessionUserLevel($v) {
		$_SESSION[EW_SESSION_USER_LEVEL] = $v;
		$this->CurrentUserLevel = $v;
	}

	// Current user name
	function getCurrentUserName() {
		return strval(@$_SESSION[EW_SESSION_USER_NAME]);
	}

	function setCurrentUserName($v) {
		$_SESSION[EW_SESSION_USER_NAME] = $v;
	}

	function CurrentUserName() {
		return $this->getCurrentUserName();
	}

	// Current User ID
	function CurrentUserID() {
		return $this->CurrentUserID;
	}

	// Current Parent User ID
	function CurrentParentUserID() {
		return $this->CurrentParentUserID;
	}

	// Current User Level ID
	function CurrentUserLevelID() {
		return $this->CurrentUserLevelID;
	}

	// Current User Level value
	function CurrentUserLevel() {
		return $this->CurrentUserLevel;
	}

	// Can add
	function CanAdd() {
		return (($this->CurrentUserLevel & EW_ALLOW_ADD) == EW_ALLOW_ADD);
	}

	function setCanAdd($b) {
		if ($b) {
			$this->CurrentUserLevel = ($this->CurrentUserLevel | EW_ALLOW_ADD);
		} else {
			$this->CurrentUserLevel = ($this->CurrentUserLevel & (~ EW_ALLOW_ADD));
		}
	}

	// Can delete
	function CanDelete() {
		return (($this->CurrentUserLevel & EW_ALLOW_DELETE) == EW_ALLOW_DELETE);
	}

	function setCanDelete($b) {
		if ($b) {
			$this->CurrentUserLevel = ($this->CurrentUserLevel | EW_ALLOW_DELETE);
		} else {
			$this->CurrentUserLevel = ($this->CurrentUserLevel & (~ EW_ALLOW_DELETE));
		}
	}

	// Can edit
	function CanEdit() {
		return (($this->CurrentUserLevel & EW_ALLOW_EDIT) == EW_ALLOW_EDIT);
	}

	function setCanEdit($b) {
		if ($b) {
			$this->CurrentUserLevel = ($this->CurrentUserLevel | EW_ALLOW_EDIT);
		} else {
			$this->CurrentUserLevel = ($this->CurrentUserLevel & (~ EW_ALLOW_EDIT));
		}
	}

	// Can view
	function CanView() {
		return (($this->CurrentUserLevel & EW_ALLOW_VIEW) == EW_ALLOW_VIEW);
	}

	function setCanView($b) {
		if ($b) {
			$this->CurrentUserLevel = ($this->CurrentUserLevel | EW_ALLOW_VIEW);
		} else {
			$this->CurrentUserLevel = ($this->CurrentUserLevel & (~ EW_ALLOW_VIEW));
		}
	}

	// Can list
	function CanList() {
		return (($this->CurrentUserLevel & EW_ALLOW_LIST) == EW_ALLOW_LIST);
	}

	function setCanList($b) {
		if ($b) {
			$this->CurrentUserLevel = ($this->CurrentUserLevel | EW_ALLOW_LIST);
		} else {
			$this->CurrentUserLevel = ($this->CurrentUserLevel & (~ EW_ALLOW_LIST));
		}
	}

	// Can report
	function CanReport() {
		return (($this->CurrentUserLevel & EW_ALLOW_REPORT) == EW_ALLOW_REPORT);
	}

	function setCanReport($b) {
		if ($b) {
			$this->CurrentUserLevel = ($this->CurrentUserLevel | EW_ALLOW_REPORT);
		} else {
			$this->CurrentUserLevel = ($this->CurrentUserLevel & (~ EW_ALLOW_REPORT));
		}
	}

	// Can search
	function CanSearch() {
		return (($this->CurrentUserLevel & EW_ALLOW_SEARCH) == EW_ALLOW_SEARCH);
	}

	function setCanSearch($b) {
		if ($b) {
			$this->CurrentUserLevel = ($this->CurrentUserLevel | EW_ALLOW_SEARCH);
		} else {
			$this->CurrentUserLevel = ($this->CurrentUserLevel & (~ EW_ALLOW_SEARCH));
		}
	}

	// Can admin
	function CanAdmin() {
		return (($this->CurrentUserLevel & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN);
	}

	function setCanAdmin($b) {
		if ($b) {
			$this->CurrentUserLevel = ($this->CurrentUserLevel | EW_ALLOW_ADMIN);
		} else {
			$this->CurrentUserLevel = ($this->CurrentUserLevel & (~ EW_ALLOW_ADMIN));
		}
	}

	// Last URL
	function LastUrl() {
		return @$_COOKIE[EW_PROJECT_NAME]['LastUrl'];
	}

	// Save last URL
	function SaveLastUrl() {
		$s = ew_ServerVar("SCRIPT_NAME");
		$q = ew_ServerVar("QUERY_STRING");
		if ($q <> "") $s .= "?" . $q;
		if ($this->LastUrl() == $s) $s = "";
		@setcookie(EW_PROJECT_NAME . '[LastUrl]', $s);
	}

	// Auto login
	function AutoLogin() {
		if (@$_COOKIE[EW_PROJECT_NAME]['AutoLogin'] == "autologin") {
			$usr = TEAdecrypt(@$_COOKIE[EW_PROJECT_NAME]['Username'], EW_RANDOM_KEY);
			$pwd = TEAdecrypt(@$_COOKIE[EW_PROJECT_NAME]['Password'], EW_RANDOM_KEY);
			$AutoLogin = $this->ValidateUser($usr, $pwd, TRUE);
		} else {
			$AutoLogin = FALSE;
		}
		return $AutoLogin;
	}

	// Validate user
	function ValidateUser($usr, $pwd, $autologin) {
		global $conn, $Language;
		global $tbl_user;
		$ValidateUser = FALSE;

		// Check hard coded admin first
		if (EW_CASE_SENSITIVE_PASSWORD) {
			$ValidateUser = (EW_ADMIN_USER_NAME == $usr && EW_ADMIN_PASSWORD == $pwd);
		} else {
			$ValidateUser = (strtolower(EW_ADMIN_USER_NAME) == strtolower($usr) &&
				strtolower(EW_ADMIN_PASSWORD) == strtolower($pwd));
		}
		if ($ValidateUser) {
			$_SESSION[EW_SESSION_STATUS] = "login";
			$_SESSION[EW_SESSION_SYS_ADMIN] = 1; // System Administrator
			$this->setCurrentUserName("Administrator"); // Load user name
			$this->setSessionUserLevelID(-1); // System Administrator
			$this->SetUpUserLevel();
		}

		// Check other users
		if (!$ValidateUser) {
			$sFilter = str_replace("%u", ew_AdjustSql($usr), EW_USER_NAME_FILTER);

			// Set up filter (SQL WHERE clause) and get return SQL
			// SQL constructor in <UseTable> class, <UserTable>info.php

			$sSql = $tbl_user->GetSQL($sFilter, "");
			if ($rs = $conn->Execute($sSql)) {
				if (!$rs->EOF) {
					if (EW_CASE_SENSITIVE_PASSWORD) {
						if (EW_MD5_PASSWORD) {
							$ValidateUser = ($rs->fields('passwd') == md5($pwd));
						} else {
							$ValidateUser = ($rs->fields('passwd') == $pwd);
						}
					} else {
						if (EW_MD5_PASSWORD) {
							$ValidateUser = ($rs->fields('passwd') == md5(strtolower($pwd)));
						} else {
							$ValidateUser = (strtolower($rs->fields('passwd')) == strtolower($pwd));
						}
					}
					if ($ValidateUser) {
						$_SESSION[EW_SESSION_STATUS] = "login";
						$_SESSION[EW_SESSION_SYS_ADMIN] = 0; // Non System Administrator
						$this->setCurrentUserName($rs->fields('username')); // Load user name
						if (is_null($rs->fields('id_userlevel'))) {
							$this->setSessionUserLevelID(0);
						} else {
							$this->setSessionUserLevelID(intval($rs->fields('id_userlevel'))); // Load User Level
						}
						$this->SetUpUserLevel();

						// Call User Validated event
						$this->User_Validated($rs);
					}
				}
				$rs->Close();
			}
		}
		if (!$ValidateUser)
			$_SESSION[EW_SESSION_STATUS] = ""; // Clear login status
		return $ValidateUser;
	}

	// Dynamic User Level security
	// Get User Level settings from database
	function SetUpUserLevel() {
		$this->SetUpUserLevelEx(); // Load all user levels

		// User Level loaded event
		$this->UserLevel_Loaded();

		// Save the User Level to Session variable
		$this->SaveUserLevel();
	}

	// Get all User Level settings from database
	function SetUpUserLevelEx() {
		global $conn;

		// Get the User Level definitions
		$sSql = "SELECT " . EW_USER_LEVEL_ID_FIELD . ", " . EW_USER_LEVEL_NAME_FIELD . " FROM " . EW_USER_LEVEL_TABLE;
		if ($rs = $conn->Execute($sSql)) {
			$this->UserLevel = $rs->GetRows();
			$rs->Close();
		}

		// Get the User Level privileges
		$sSql = "SELECT " . EW_USER_LEVEL_PRIV_TABLE_NAME_FIELD . ", " . EW_USER_LEVEL_PRIV_USER_LEVEL_ID_FIELD . ", " . EW_USER_LEVEL_PRIV_PRIV_FIELD . " FROM " . EW_USER_LEVEL_PRIV_TABLE;
		if ($rs = $conn->Execute($sSql)) {
			$this->UserLevelPriv = $rs->GetRows();
			$rs->Close();
		}
	}

	// Add user permission
	function AddUserPermission($UserLevelName, $TableName, $UserPermission) {

		// Get User Level ID from user name
		$UserLevelID = "";
		if (is_array($this->UserLevel)) {
			foreach ($this->UserLevel as $row) {
				list($levelid, $name) = $row;
				if (strval($UserLevelName) == strval($name)) {
					$UserLevelID = $levelid;
					break;
				}
			}
		}
		if (is_array($this->UserLevelPriv) && $UserLevelID <> "") {
			$cnt = count($this->UserLevelPriv);
			for ($i = 0; $i < $cnt; $i++) {
				list($table, $levelid, $priv) = $this->UserLevelPriv[$i];
				if (strtolower($table) == strtolower($TableName) && strval($levelid) == strval($UserLevelID)) {
					$this->UserLevelPriv[$i][2] = $priv | $UserPermission; // Add permission
					break;
				}
			}
		}
	}

	// Delete user permission
	function DeleteUserPermission($UserLevelName, $TableName, $UserPermission) {

		// Get User Level ID from user name
		$UserLevelID = "";
		if (is_array($this->UserLevel)) {
			foreach ($this->UserLevel as $row) {
				list($levelid, $name) = $row;
				if (strval($UserLevelName) == strval($name)) {
					$UserLevelID = $levelid;
					break;
				}
			}
		}
		if (is_array($this->UserLevelPriv) && $UserLevelID <> "") {
			$cnt = count($this->UserLevelPriv);
			for ($i = 0; $i < $cnt; $i++) {
				list($table, $levelid, $priv) = $this->UserLevelPriv[$i];
				if (strtolower($table) == strtolower($TableName) && strval($levelid) == strval($UserLevelID)) {
					$this->UserLevelPriv[$i][2] = $priv & (127 - $UserPermission); // Remove permission
					break;
				}
			}
		}
	}

	// Load current User Level
	function LoadCurrentUserLevel($Table) {
		$this->LoadUserLevel();
		$this->setSessionUserLevel($this->CurrentUserLevelPriv($Table));
	}

	// Get current user privilege
	function CurrentUserLevelPriv($TableName) {
		if ($this->IsLoggedIn()) {
			$Priv= 0;
			foreach ($this->UserLevelID as $UserLevelID)
				$Priv |= $this->GetUserLevelPrivEx($TableName, $UserLevelID);
			return $Priv;
		} else {
			return 0;
		}
	}

	// Get User Level ID by User Level name
	function GetUserLevelID($UserLevelName) {
		if (strval($UserLevelName) == "Administrator") {
			return -1;
		} elseif ($UserLevelName <> "") {
			if (is_array($this->UserLevel)) {
				foreach ($this->UserLevel as $row) {
					list($levelid, $name) = $row;
					if (strval($name) == strval($UserLevelName))
						return $levelid;
				}
			}
		}
		return -2;
	}

	// Add User Level (for use with UserLevel_Loading event)
	function AddUserLevel($UserLevelName) {
		if (strval($UserLevelName) == "") return;
		$UserLevelID = $this->GetUserLevelID($UserLevelName);
		if (!is_numeric($UserLevelID)) return;
		if ($UserLevelID < -1) return;
		if (!in_array($UserLevelID, $this->UserLevelID))
			$this->UserLevelID[] = $UserLevelID;
	}

	// Delete User Level (for use with UserLevel_Loading event)
	function DeleteUserLevel($UserLevelName) {
		if (strval($UserLevelName) == "") return;
		$UserLevelID = $this->GetUserLevelID($UserLevelName);
		if (!is_numeric($UserLevelID)) return;
		if ($UserLevelID < -1) return;
		$cnt = count($this->UserLevelID);
		for ($i = 0; $i < $cnt; $i++) {
			if ($this->UserLevelID[$i] == $UserLevelID) {
				unset($this->UserLevelID[$i]);
				break;
			}
		}
	}

	// User Level list
	function UserLevelList() {
		return implode(", ", $this->UserLevelID);
	}

	// User Level name list
	function UserLevelNameList() {
		$list = "";
		foreach ($this->UserLevelID as $UserLevelID) {
			if ($list <> "") $lList .= ", ";
			$list .= ew_QuotedValue($this->GetUserLevelName($UserLevelID), EW_DATATYPE_STRING);
		}
		return $list;
	}

	// Get user privilege based on table name and User Level
	function GetUserLevelPrivEx($TableName, $UserLevelID) {
		if (strval($UserLevelID) == "-1") { // System Administrator
			if (defined("EW_USER_LEVEL_COMPAT")) {
				return 31; // Use old User Level values
			} else {
				return 127; // Use new User Level values (separate View/Search)
			}
		} elseif ($UserLevelID >= 0) {
			if (is_array($this->UserLevelPriv)) {
				foreach ($this->UserLevelPriv as $row) {
					list($table, $levelid, $priv) = $row;
					if (strtolower($table) == strtolower($TableName) && strval($levelid) == strval($UserLevelID)) {
						if (is_null($priv) || !is_numeric($priv)) return 0;
						return intval($priv);
					}
				}
			}
		}
		return 0;
	}

	// Get current User Level name
	function CurrentUserLevelName() {
		return $this->GetUserLevelName($this->CurrentUserLevelID());
	}

	// Get User Level name based on User Level
	function GetUserLevelName($UserLevelID) {
		if (strval($UserLevelID) == "-1") {
			return "Administrator";
		} elseif ($UserLevelID >= 0) {
			if (is_array($this->UserLevel)) {
				foreach ($this->UserLevel as $row) {
					list($levelid, $name) = $row;
					if (strval($levelid) == strval($UserLevelID))
						return $name;
				}
			}
		}
		return "";
	}

	// Display all the User Level settings (for debug only)
	function ShowUserLevelInfo() {
		echo "<pre class=\"phpmaker\">";
		print_r($this->UserLevel);
		print_r($this->UserLevelPriv);
		echo "</pre>";
		echo "<p>Current User Level ID = " . $this->CurrentUserLevelID() . "</p>";
		echo "<p>Current User Level ID List = " . $this->UserLevelList() . "</p>";
	}

	// Check privilege for List page (for menu items)
	function AllowList($TableName) {
		return ($this->CurrentUserLevelPriv($TableName) & EW_ALLOW_LIST);
	}

	// Check privilege for Add page (for Allow-Add)
	function AllowAdd($TableName) {
		return ($this->CurrentUserLevelPriv($TableName) & EW_ALLOW_ADD);
	}

	// Check if user password expired
	function IsPasswordExpired() {
		return (@$_SESSION[EW_SESSION_STATUS] == "passwordexpired");
	}

	// Check if user is logging in (after changing password)
	function IsLoggingIn() {
		return (@$_SESSION[EW_SESSION_STATUS] == "loggingin");
	}

	// Check if user is logged in
	function IsLoggedIn() {
		return (@$_SESSION[EW_SESSION_STATUS] == "login");
	}

	// Check if user is system administrator
	function IsSysAdmin() {
		return (@$_SESSION[EW_SESSION_SYS_ADMIN] == 1);
	}

	// Check if user is administrator
	function IsAdmin() {
		$IsAdmin = $this->IsSysAdmin();
		if (!$IsAdmin)
			$IsAdmin = in_array(-1, $this->UserLevelID);
		return $IsAdmin;
  }

	// Save User Level to Session
	function SaveUserLevel() {
		$_SESSION[EW_SESSION_AR_USER_LEVEL] = $this->UserLevel;
		$_SESSION[EW_SESSION_AR_USER_LEVEL_PRIV] = $this->UserLevelPriv;
	}

	// Load User Level from Session
	function LoadUserLevel() {
		if (!is_array(@$_SESSION[EW_SESSION_AR_USER_LEVEL]) || !is_array(@$_SESSION[EW_SESSION_AR_USER_LEVEL_PRIV])) {
			$this->SetupUserLevel();
			$this->SaveUserLevel();
		} else {
			$this->UserLevel = $_SESSION[EW_SESSION_AR_USER_LEVEL];
			$this->UserLevelPriv = $_SESSION[EW_SESSION_AR_USER_LEVEL_PRIV];
		}
	}

	// function to get user email
	function CurrentUserEmail() {
		return $this->CurrentUserInfo("username");
	}

	// Get current user info
	function CurrentUserInfo($fieldname) {
		$info = NULL;
		return $info;
	}

	// UserID Loading event
	function UserID_Loading() {

		//echo "UserID Loading: " . $this->CurrentUserID() . "<br>";
	}

	// UserID Loaded event
	function UserID_Loaded() {

		//echo "UserID Loaded: " . $this->UserIDList() . "<br>";
	}

	// User Level Loaded event
	function UserLevel_Loaded() {

		//$this->AddUserPermission(<UserLevelName>, <TableName>, <UserPermission>);
		//$this->DeleteUserPermission(<UserLevelName>, <TableName>, <UserPermission>);

	}

	// Table Permission Loading event
	function TablePermission_Loading() {

		//echo "Table Permission Loading: " . $this->CurrentUserLevelID() . "<br>";
	}

	// Table Permission Loaded event
	function TablePermission_Loaded() {

		//echo "Table Permission Loaded: " . $this->CurrentUserLevel() . "<br>";
	}

	// User Validated event
	function User_Validated(&$rs) {

		// Example:
		//$_SESSION['UserEmail'] = $rs->fields('Email');

	}

	// User PasswordExpired event
	function User_PasswordExpired(&$rs) {

	  //echo "User_PasswordExpired";
	}
}
?>
<?php

/**
 * Common functions
 */

// Connection/Query error handler
function ew_ErrorFn($DbType, $ErrorType, $ErrorNo, $ErrorMsg, $Param1, $Param2, $Object) {
	if ($ErrorType == 'CONNECT') {
		$msg = "Failed to connect to $Param2 at $Param1. Error: " . $ErrorMsg;
	} elseif ($ErrorType == 'EXECUTE') {
		if (EW_DEBUG_ENABLED) {
			$msg = "Failed to execute SQL: $Param1. Error: " . $ErrorMsg;
		} else {
			$msg = "Failed to execute SQL. Error: " . $ErrorMsg;
		}
	} 
	$_SESSION[EW_SESSION_MESSAGE] = $msg;
}

// Connect to database
function &ew_Connect() {
	$GLOBALS["ADODB_FETCH_MODE"] = ADODB_FETCH_BOTH;
	$conn = new mysqlt_driver_ADOConnection();
	$conn->debug = EW_DEBUG_ENABLED;
	$conn->debug_echo = FALSE;
	$info = array("host" => EW_CONN_HOST, "port" => EW_CONN_PORT,
		"user" => EW_CONN_USER, "pass" => EW_CONN_PASS, "db" => EW_CONN_DB);

	// Database loading event
	Database_Connecting($info);
	$conn->port = intval($info["port"]);
	$conn->raiseErrorFn = 'ew_ErrorFn';
	$conn->Connect($info["host"], $info["user"], $info["pass"], $info["db"]);
	if (EW_MYSQL_CHARSET <> "")
		$conn->Execute("SET NAMES '" . EW_MYSQL_CHARSET . "'");
	$conn->raiseErrorFn = '';
	return $conn;
}

// Database Connecting event
function Database_Connecting(&$info) {

	// Example:
	//var_dump($info);
	//if (ew_CurrentUserIP() == "127.0.0.1") { // testing on local PC
	//	$info["host"] = "locahost";
	//	$info["user"] = "root";
	//	$info["pass"] = "";
	//}

}

// Check if HTTP POST
function ew_IsHttpPost() {
	$ct = ew_ServerVar("CONTENT_TYPE");
	if (empty($ct)) $ct = ew_ServerVar("HTTP_CONTENT_TYPE");
	return ($ct == "application/x-www-form-urlencoded");
}

// Get script name
function ew_ScriptName() {
	$sn = ew_ServerVar("PHP_SELF");
	if (empty($sn)) $sn = ew_ServerVar("SCRIPT_NAME");
	if (empty($sn)) $sn = ew_ServerVar("ORIG_PATH_INFO");
	if (empty($sn)) $sn = ew_ServerVar("ORIG_SCRIPT_NAME");
	if (empty($sn)) $sn = ew_ServerVar("REQUEST_URI");
	if (empty($sn)) $sn = ew_ServerVar("URL");
	if (empty($sn)) $sn = "UNKNOWN";
	return $sn;
}

// Return multi-value search SQL
function ew_GetMultiSearchSql(&$Fld, $FldVal) {
	$sWrk = "";
	$arVal = explode(",", $FldVal);
	foreach ($arVal as $sVal) {
		$sVal = trim($sVal);
		if (EW_IS_MYSQL) {
			$sSql = "FIND_IN_SET('" . ew_AdjustSql($sVal) . "', " . $Fld->FldExpression . ")";
		} else {
			if (count($arVal) == 1 || EW_SEARCH_MULTI_VALUE_OPTION == 3) {
				$sSql = $Fld->FldExpression . " = '" . ew_AdjustSql($sVal) . "' OR " . ew_GetMultiSearchSqlPart($Fld, $sVal);
			} else {
				$sSql = ew_GetMultiSearchSqlPart($Fld, $sVal);
			}
		}
		if ($sWrk <> "") {
			if (EW_SEARCH_MULTI_VALUE_OPTION == 2) {
				$sWrk .= " AND ";
			} elseif (EW_SEARCH_MULTI_VALUE_OPTION == 3) {
				$sWrk .= " OR ";
			}
		}
		$sWrk .= "($sSql)";
	}
	return $sWrk;
}

// Get multi search SQL part
function ew_GetMultiSearchSqlPart(&$Fld, $FldVal) {
	return $Fld->FldExpression . " LIKE '" . ew_AdjustSql($FldVal) . ",%' OR " .
		$Fld->FldExpression . " LIKE '%," . $FldVal . ",%' OR " .
		$Fld->FldExpression . " LIKE '%," . $FldVal . "'";
}

// Get search SQL
function ew_GetSearchSql(&$Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2) {
	$sSql = "";
	$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
	$FldDataType = $Fld->FldDataType;
	if ($Fld->FldIsVirtual)
		$FldDataType = EW_DATATYPE_STRING;
	if ($FldOpr == "BETWEEN") {
		$IsValidValue = ($FldDataType <> EW_DATATYPE_NUMBER) ||
			($FldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal) && is_numeric($FldVal2));
		if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue)
			$sSql = $sFldExpression . " BETWEEN " . ew_QuotedValue($FldVal, $FldDataType) .
				" AND " . ew_QuotedValue($FldVal2, $FldDataType);
	} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL") {
		$sSql = $sFldExpression . " " . $FldOpr;
	} else {
		$IsValidValue = ($FldDataType <> EW_DATATYPE_NUMBER) ||
			($FldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal));
		if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $FldDataType))
			$sSql = $sFldExpression . ew_SearchString($FldOpr, $FldVal, $FldDataType);
		$IsValidValue = ($FldDataType <> EW_DATATYPE_NUMBER) ||
			($FldDataType == EW_DATATYPE_NUMBER && is_numeric($FldVal2));
		if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $FldDataType)) {
			if ($sSql <> "")
				$sSql .= " " . (($FldCond == "OR") ? "OR" : "AND") . " ";
			$sSql = "(" . $sSql . $sFldExpression . ew_SearchString($FldOpr2, $FldVal2, $FldDataType) . ")";
		}
	}
	return $sSql;
}

// Return search string
function ew_SearchString($FldOpr, $FldVal, $FldType) {
	if ($FldOpr == "LIKE" || $FldOpr == "NOT LIKE") {
		return " $FldOpr " . ew_QuotedValue("%$FldVal%", $FldType);
	} elseif ($FldOpr == "STARTS WITH") {
		return " LIKE " . ew_QuotedValue("$FldVal%", $FldType);
	} else {
		return " $FldOpr " . ew_QuotedValue($FldVal, $FldType);
	}
}

// Check if valid operator
function ew_IsValidOpr($Opr, $FldType) {
	$Valid = ($Opr == "=" || $Opr == "<" || $Opr == "<=" ||
		$Opr == ">" || $Opr == ">=" || $Opr == "<>");
	if ($FldType == EW_DATATYPE_STRING || $FldType == EW_DATATYPE_MEMO || $FldType == EW_DATATYPE_XML)
		$Valid = ($Valid || $Opr == "LIKE" || $Opr == "NOT LIKE" ||	$Opr == "STARTS WITH");
	return $Valid; 
}

// Quote table/field name
function ew_QuotedName($Name) {
	$Name = str_replace(EW_DB_QUOTE_END, EW_DB_QUOTE_END . EW_DB_QUOTE_END, $Name);
	return EW_DB_QUOTE_START . $Name . EW_DB_QUOTE_END;
}

// Quote field value
function ew_QuotedValue($Value, $FldType) {
	if (is_null($Value)) return "NULL";
	switch ($FldType) {
	case EW_DATATYPE_STRING:
	case EW_DATATYPE_MEMO:
	case EW_DATATYPE_TIME:
		if (EW_REMOVE_XSS) {
			return "'" . ew_AdjustSql(ew_RemoveXSS($Value)) . "'";
		} else {
			return "'" . ew_AdjustSql($Value) . "'";
		}
	case EW_DATATYPE_XML:
		return "'" . ew_AdjustSql($Value) . "'";
	case EW_DATATYPE_BLOB:
		return "'" . ew_AdjustSql($Value) . "'";
	case EW_DATATYPE_DATE:
		return "'" . ew_AdjustSql($Value) . "'";
	case EW_DATATYPE_GUID:
		return "'" . $Value . "'";
	case EW_DATATYPE_BOOLEAN:
		return "'" . $Value . "'"; // 'Y'|'N' or 'y'|'n' or '1'|'0' or 't'|'f'
	default:
		return $Value;
	}
}

// Convert different data type value
function ew_Conv($v, $t) {
	switch ($t) {
	case 2:
	case 3:
	case 16:
	case 17:
	case 18:
	case 19: // adSmallInt/adInteger/adTinyInt/adUnsignedTinyInt/adUnsignedSmallInt
		return (is_null($v)) ? NULL : intval($v);
	case 4:
	Case 5:
	case 6:
	case 131:
	case 139: // adSingle/adDouble/adCurrency/adNumeric/adVarNumeric
		return (is_null($v)) ? NULL : (float)$v;
	default:
		return (is_null($v)) ? NULL : $v;
	}
}

// Convert string to float
function ew_StrToFloat($v) {
	$v = str_replace(" ", "", $v);	
	if (!EW_USE_DEFAULT_LOCALE) extract(localeconv()); // PHP 4 >= 4.0.5
	if (empty($decimal_point)) $decimal_point = DEFAULT_DECIMAL_POINT;
	$v = str_replace($decimal_point, ".", $v);
	return $v;
}

// Write message to debug file
function ew_Trace($msg) {
	$filename = "debug.txt";
	if (!$handle = fopen($filename, 'a')) exit;
	if (is_writable($filename)) fwrite($handle, $msg . "\n");
	fclose($handle);
}

// Compare values with special handling for null values
function ew_CompareValue($v1, $v2) {
	if (is_null($v1) && is_null($v2)) {
		return TRUE;
	} elseif (is_null($v1) || is_null($v2)) {
		return FALSE;

//	} elseif (is_float($v1) || is_float($v2)) {
//		return (float)$v1 == (float)$v2;

	} else {
		return ($v1 == $v2);
	}
}

// Check if boolean value is TRUE
function ew_ConvertToBool($value) {
	return ($value === TRUE || strval($value) == "1" ||
		strtolower(strval($value)) == "y" || strtolower(strval($value)) == "t");
}

// Strip slashes
function ew_StripSlashes($value) {
	if (!get_magic_quotes_gpc()) return $value;
	if (is_array($value)) { 
		return array_map('ew_StripSlashes', $value);
	} else {
		return stripslashes($value);
	}
}

// Add slashes for SQL
function ew_AdjustSql($val) {
	$val = addslashes(trim($val));
	return $val;
}

// Build SELECT SQL based on different sql part
function ew_BuildSelectSql($sSelect, $sWhere, $sGroupBy, $sHaving, $sOrderBy, $sFilter, $sSort) {
	$sDbWhere = $sWhere;
	if ($sDbWhere <> "") {
		if ($sFilter <> "")	$sDbWhere = "(" . $sDbWhere . ") AND (" . $sFilter . ")";
	} else {
		$sDbWhere = $sFilter;
	}
	$sDbOrderBy = $sOrderBy;
	if ($sSort <> "") $sDbOrderBy = $sSort;
	$sSql = $sSelect;
	if ($sDbWhere <> "") $sSql .= " WHERE " . $sDbWhere;
	if ($sGroupBy <> "") $sSql .= " GROUP BY " . $sGroupBy;
	if ($sHaving <> "") $sSql .= " HAVING " . $sHaving;
	if ($sDbOrderBy <> "") $sSql .= " ORDER BY " . $sDbOrderBy;
	return $sSql;
}

// Load recordset
function &ew_LoadRecordset($SQL) {
	global $conn;
	$conn->raiseErrorFn = 'ew_ErrorFn';
	$rs = $conn->Execute($SQL);
	$conn->raiseErrorFn = '';
	return $rs;
}

// Executes the query, and returns the first column of the first row
function ew_ExecuteScalar($SQL) {
	$res = FALSE;
	$rs = ew_LoadRecordset($SQL);
	if ($rs && !$rs->EOF && $rs->FieldCount() > 0) {
		$res = $rs->fields[0];
		$rs->Close();
	}
	return $res;
}

// Executes the query, and returns the first row
function ew_ExecuteRow($SQL) {
	$res = FALSE;
	$rs = ew_LoadRecordset($SQL);
	if ($rs && !$rs->EOF) {
		$res = $rs->fields;
		$rs->Close();
	}
	return $res;
}

// Write audit trail (login/logout)
function ew_WriteAuditTrailOnLogInOut($usr, $logtype) {
	ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $logtype, ew_CurrentUserIP(), "", "", "", "");
}

// Write audit trail
function ew_WriteAuditTrail($pfx, $dt, $script, $usr, $action, $table, $field, $keyvalue, $oldvalue, $newvalue) {
	$usrwrk = $usr;
	if ($usrwrk == "") $usrwrk = "-1"; // Assume Administrator if no user
	if (EW_AUDIT_TRAIL_TO_DATABASE) {
		global $conn;
		$sAuditSql = "INSERT INTO " . ew_QuotedName(EW_AUDIT_TRAIL_TABLE_NAME) .
			" (" . ew_QuotedName(EW_AUDIT_TRAIL_FIELD_NAME_DATETIME) . ", " .
			ew_QuotedName(EW_AUDIT_TRAIL_FIELD_NAME_SCRIPT) . ", " .
			ew_QuotedName(EW_AUDIT_TRAIL_FIELD_NAME_USER) . ", " .
			ew_QuotedName(EW_AUDIT_TRAIL_FIELD_NAME_ACTION) . ", " .
			ew_QuotedName(EW_AUDIT_TRAIL_FIELD_NAME_TABLE) . ", " .
			ew_QuotedName(EW_AUDIT_TRAIL_FIELD_NAME_FIELD) . ", " .
			ew_QuotedName(EW_AUDIT_TRAIL_FIELD_NAME_KEYVALUE) . ", " .
			ew_QuotedName(EW_AUDIT_TRAIL_FIELD_NAME_OLDVALUE) . ", " .
			ew_QuotedName(EW_AUDIT_TRAIL_FIELD_NAME_NEWVALUE) . ") VALUES (" .
			ew_QuotedValue($dt, EW_DATATYPE_DATE) . ", " .
			ew_QuotedValue($script, EW_DATATYPE_STRING) . ", " .
			ew_QuotedValue($usrwrk, EW_DATATYPE_STRING) . ", " .
			ew_QuotedValue($action, EW_DATATYPE_STRING) . ", " .
			ew_QuotedValue($table, EW_DATATYPE_STRING) . ", " .
			ew_QuotedValue($field, EW_DATATYPE_STRING) . ", " .
			ew_QuotedValue($keyvalue, EW_DATATYPE_STRING) . ", " .
			ew_QuotedValue($oldvalue, EW_DATATYPE_STRING) . ", " .
			ew_QuotedValue($newvalue, EW_DATATYPE_STRING) . ")";
		$conn->Execute($sAuditSql);
	} else {
		$sTab = "\t";
		$sHeader = "date/time" . $sTab . "script" . $sTab .	"user" . $sTab .
			"action" . $sTab . "table" . $sTab . "field" . $sTab .
			"key value" . $sTab . "old value" . $sTab . "new value";
		$sMsg = $dt . $sTab . $script . $sTab . $usrwrk . $sTab . 
				$action . $sTab . $table . $sTab . $field . $sTab .
				$keyvalue . $sTab . $oldvalue . $sTab . $newvalue;
		$sFolder = EW_AUDIT_TRAIL_PATH;
		$sFn = $pfx . "_" . date("Ymd") . ".txt";
		$filename = ew_UploadPathEx(TRUE, $sFolder) . $sFn;
		if (file_exists($filename)) {
			$fileHandler = fopen($filename, "a+b");
		} else {
			$fileHandler = fopen($filename, "a+b");
			fwrite($fileHandler,$sHeader."\r\n");
		}
		fwrite($fileHandler, $sMsg."\r\n");
		fclose($fileHandler);
	}
}

// Unformat date time based on format type
function ew_UnFormatDateTime($dt, $namedformat) {
	$dt = trim($dt);
	while (strpos($dt, "  ") !== FALSE) $dt = str_replace("  ", " ", $dt);
	$arDateTime = explode(" ", $dt);
	if (count($arDateTime) == 0) return $dt;
	if ($namedformat == 0 || $namedformat == 1 || $namedformat == 2 || $namedformat == 8) {
		$arDefFmt = explode(EW_DATE_SEPARATOR, EW_DEFAULT_DATE_FORMAT);
		if ($arDefFmt[0] == "yyyy") {
			$namedformat = 9;
		} elseif ($arDefFmt[0] == "mm") {
			$namedformat = 10;
		} elseif ($arDefFmt[0] == "dd") {
			$namedformat = 11;
		}
	}
	$arDatePt = explode(EW_DATE_SEPARATOR, $arDateTime[0]);
	if (count($arDatePt) == 3) {
		switch ($namedformat) {
		case 5:
		case 9: //yyyymmdd
			if (ew_CheckDate($arDateTime[0])) {
				list($year, $month, $day) = $arDatePt;
				break;
			} else {
				return $dt;
			}
		case 6:
		case 10: //mmddyyyy
			if (ew_CheckUSDate($arDateTime[0])) {
				list($month, $day, $year) = $arDatePt;
				break;
			} else {
				return $dt;
			}
		case 7:
		case 11: //ddmmyyyy
			if (ew_CheckEuroDate($arDateTime[0])) {
				list($day, $month, $year) = $arDatePt;
				break;
			} else {
				return $dt;
			}
		default:
			return $dt;
		}
		return $year . "-" . str_pad($month, 2, "0", STR_PAD_LEFT) . "-" .
			str_pad($day, 2, "0", STR_PAD_LEFT) .
			((count($arDateTime) > 1) ? " " . $arDateTime[1] : "");
	} else {
		return $dt;
	}
}

// Format a timestamp, datetime, date or time field from MySQL
// $namedformat:
// 0 - General Date
// 1 - Long Date
// 2 - Short Date (Default)
// 3 - Long Time
// 4 - Short Time (hh:mm:ss)
// 5 - Short Date (yyyy/mm/dd)
// 6 - Short Date (mm/dd/yyyy)
// 7 - Short Date (dd/mm/yyyy)
// 8 - Short Date (Default) + Short Time (if not 00:00:00)
// 9 - Short Date (yyyy/mm/dd) + Short Time (hh:mm:ss)
// 10 - Short Date (mm/dd/yyyy) + Short Time (hh:mm:ss)
// 11 - Short Date (dd/mm/yyyy) + Short Time (hh:mm:ss)
function ew_FormatDateTime($ts, $namedformat) {
	$DefDateFormat = str_replace("yyyy", "%Y", EW_DEFAULT_DATE_FORMAT);
	$DefDateFormat = str_replace("mm", "%m", $DefDateFormat);
	$DefDateFormat = str_replace("dd", "%d", $DefDateFormat);
	if (is_numeric($ts)) // timestamp
	{
		switch (strlen($ts)) {
			case 14:
				$patt = '/(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/';
				break;
			case 12:
				$patt = '/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/';
				break;
			case 10:
				$patt = '/(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})/';
				break;
			case 8:
				$patt = '/(\d{4})(\d{2})(\d{2})/';
				break;
			case 6:
				$patt = '/(\d{2})(\d{2})(\d{2})/';
				break;
			case 4:
				$patt = '/(\d{2})(\d{2})/';
				break;
			case 2:
				$patt = '/(\d{2})/';
				break;
			default:
				return $ts;
		}
		if ((isset($patt))&&(preg_match($patt, $ts, $matches)))
		{
			$year = $matches[1];
			$month = @$matches[2];
			$day = @$matches[3];
			$hour = @$matches[4];
			$min = @$matches[5];
			$sec = @$matches[6];
		}
		if (($namedformat==0)&&(strlen($ts)<10)) $namedformat = 2;
	}
	elseif (is_string($ts))
	{
		if (preg_match('/(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})/', $ts, $matches)) // datetime
		{
			$year = $matches[1];
			$month = $matches[2];
			$day = $matches[3];
			$hour = $matches[4];
			$min = $matches[5];
			$sec = $matches[6];
		}
		elseif (preg_match('/(\d{4})-(\d{2})-(\d{2})/', $ts, $matches)) // date
		{
			$year = $matches[1];
			$month = $matches[2];
			$day = $matches[3];
			if ($namedformat==0) $namedformat = 2;
		}
		elseif (preg_match('/(^|\s)(\d{2}):(\d{2}):(\d{2})/', $ts, $matches)) // time
		{
			$hour = $matches[2];
			$min = $matches[3];
			$sec = $matches[4];
			if (($namedformat==0)||($namedformat==1)) $namedformat = 3;
			if ($namedformat==2) $namedformat = 4;
		}
		else
		{
			return $ts;
		}
	}
	else
	{
		return $ts;
	}
	if (!isset($year)) $year = 0; // dummy value for times
	if (!isset($month)) $month = 1;
	if (!isset($day)) $day = 1;
	if (!isset($hour)) $hour = 0;
	if (!isset($min)) $min = 0;
	if (!isset($sec)) $sec = 0;
	$uts = @mktime($hour, $min, $sec, $month, $day, $year);
	if ($uts < 0 || $uts == FALSE || // failed to convert
		(intval($year) == 0 && intval($month) == 0 && intval($day) == 0)) {
		$year = substr_replace("0000", $year, -1 * strlen($year));
		$month = substr_replace("00", $month, -1 * strlen($month));
		$day = substr_replace("00", $day, -1 * strlen($day));
		$hour = substr_replace("00", $hour, -1 * strlen($hour));
		$min = substr_replace("00", $min, -1 * strlen($min));
		$sec = substr_replace("00", $sec, -1 * strlen($sec));
		$DefDateFormat = str_replace("yyyy", $year, EW_DEFAULT_DATE_FORMAT);
		$DefDateFormat = str_replace("mm", $month, $DefDateFormat);
		$DefDateFormat = str_replace("dd", $day, $DefDateFormat);
		switch ($namedformat) {
			case 0:
				return $DefDateFormat." $hour:$min:$sec";
				break;
			case 1://unsupported, return general date
				return $DefDateFormat." $hour:$min:$sec";
				break;
			case 2:
				return $DefDateFormat;
				break;
			case 3:
				if (intval($hour)==0)
					return "12:$min:$sec AM";
				elseif (intval($hour)>0 && intval($hour)<12)
					return "$hour:$min:$sec AM";
				elseif (intval($hour)==12)
					return "$hour:$min:$sec PM";
				elseif (intval($hour)>12 && intval($hour)<=23)
					return (intval($hour)-12).":$min:$sec PM";
				else
					return "$hour:$min:$sec";
				break;
			case 4:
				return "$hour:$min:$sec";
				break;
			case 5:
				return "$year". EW_DATE_SEPARATOR . "$month" . EW_DATE_SEPARATOR . "$day";
				break;
			case 6:
				return "$month". EW_DATE_SEPARATOR ."$day" . EW_DATE_SEPARATOR . "$year";
				break;
			case 7:
				return "$day" . EW_DATE_SEPARATOR ."$month" . EW_DATE_SEPARATOR . "$year";
				break;
			case 8:
				return $DefDateFormat . (($hour == 0 && $min == 0 && $sec == 0) ? "" : " $hour:$min:$sec");
				break;
			case 9:
				return "$year". EW_DATE_SEPARATOR . "$month" . EW_DATE_SEPARATOR . "$day $hour:$min:$sec";
				break;
			case 10:
				return "$month". EW_DATE_SEPARATOR ."$day" . EW_DATE_SEPARATOR . "$year $hour:$min:$sec";
				break;
			case 11:
				return "$day" . EW_DATE_SEPARATOR ."$month" . EW_DATE_SEPARATOR . "$year $hour:$min:$sec";
				break;
		}
	} else {
		switch ($namedformat) {
			case 0:
				return strftime($DefDateFormat." %H:%M:%S", $uts);
				break;
			case 1:
				return strftime("%A, %B %d, %Y", $uts);
				break;
			case 2:
				return strftime($DefDateFormat, $uts);
				break;
			case 3:
				return strftime("%I:%M:%S %p", $uts);
				break;
			case 4:
				return strftime("%H:%M:%S", $uts);
				break;
			case 5:
				return strftime("%Y" . EW_DATE_SEPARATOR . "%m" . EW_DATE_SEPARATOR . "%d", $uts);
				break;
			case 6:
				return strftime("%m" . EW_DATE_SEPARATOR . "%d" . EW_DATE_SEPARATOR . "%Y", $uts);
				break;
			case 7:
				return strftime("%d" . EW_DATE_SEPARATOR . "%m" . EW_DATE_SEPARATOR . "%Y", $uts);
				break;
			case 8:
				return strftime($DefDateFormat . (($hour == 0 && $min == 0 && $sec == 0) ? "" : " %H:%M:%S"), $uts);
				break;
			case 9:
				return strftime("%Y" . EW_DATE_SEPARATOR . "%m" . EW_DATE_SEPARATOR . "%d %H:%M:%S", $uts);
				break;
			case 10:
				return strftime("%m" . EW_DATE_SEPARATOR . "%d" . EW_DATE_SEPARATOR . "%Y %H:%M:%S", $uts);
				break;
			case 11:
				return strftime("%d" . EW_DATE_SEPARATOR . "%m" . EW_DATE_SEPARATOR . "%Y %H:%M:%S", $uts);
				break;
		}
	}
}

// Format currency
// Arguments: Expression [,NumDigitsAfterDecimal [,IncludeLeadingDigit [,UseParensForNegativeNumbers [,GroupDigits]]]])
// NumDigitsAfterDecimal is the numeric value indicating how many places to the
// right of the decimal are displayed
// -1 Use Default
// The IncludeLeadingDigit, UseParensForNegativeNumbers, and GroupDigits
// arguments have the following settings:
// -1 True
// 0 False
// -2 Use Default
function ew_FormatCurrency($amount, $NumDigitsAfterDecimal, $IncludeLeadingDigit = -2, $UseParensForNegativeNumbers = -2, $GroupDigits = -2) {

	// export the values returned by localeconv into the local scope
	if (!EW_USE_DEFAULT_LOCALE) extract(localeconv()); // PHP 4 >= 4.0.5

	// set defaults if locale is not set
	if (empty($decimal_point)) $decimal_point = DEFAULT_DECIMAL_POINT;
	if (empty($thousands_sep)) $thousands_sep = DEFAULT_THOUSANDS_SEP;
	if (empty($currency_symbol)) $currency_symbol = DEFAULT_CURRENCY_SYMBOL;
	if (empty($mon_decimal_point)) $mon_decimal_point = DEFAULT_MON_DECIMAL_POINT;
	if (empty($mon_thousands_sep)) $mon_thousands_sep = DEFAULT_MON_THOUSANDS_SEP;
	if (empty($positive_sign)) $positive_sign = DEFAULT_POSITIVE_SIGN;
	if (empty($negative_sign)) $negative_sign = DEFAULT_NEGATIVE_SIGN;
	if (empty($frac_digits) || $frac_digits == CHAR_MAX) $frac_digits = DEFAULT_FRAC_DIGITS;
	if (empty($p_cs_precedes) || $p_cs_precedes == CHAR_MAX) $p_cs_precedes = DEFAULT_P_CS_PRECEDES;
	if (empty($p_sep_by_space) || $p_sep_by_space == CHAR_MAX) $p_sep_by_space = DEFAULT_P_SEP_BY_SPACE;
	if (empty($n_cs_precedes) || $n_cs_precedes == CHAR_MAX) $n_cs_precedes = DEFAULT_N_CS_PRECEDES;
	if (empty($n_sep_by_space) || $n_sep_by_space == CHAR_MAX) $n_sep_by_space = DEFAULT_N_SEP_BY_SPACE;
	if (empty($p_sign_posn) || $p_sign_posn == CHAR_MAX) $p_sign_posn = DEFAULT_P_SIGN_POSN;
	if (empty($n_sign_posn) || $n_sign_posn == CHAR_MAX) $n_sign_posn = DEFAULT_N_SIGN_POSN;

	// check $NumDigitsAfterDecimal
	if ($NumDigitsAfterDecimal > -1)
		$frac_digits = $NumDigitsAfterDecimal;

	// check $UseParensForNegativeNumbers
	if ($UseParensForNegativeNumbers == -1) {
		$n_sign_posn = 0;
		if ($p_sign_posn == 0) {
			if (DEFAULT_P_SIGN_POSN != 0)
				$p_sign_posn = DEFAULT_P_SIGN_POSN;
			else
				$p_sign_posn = 3;
		}
	} elseif ($UseParensForNegativeNumbers == 0) {
		if ($n_sign_posn == 0)
			if (DEFAULT_P_SIGN_POSN != 0)
				$n_sign_posn = DEFAULT_P_SIGN_POSN;
			else
				$n_sign_posn = 3;
	}

	// check $GroupDigits
	if ($GroupDigits == -1) {
		$mon_thousands_sep = DEFAULT_MON_THOUSANDS_SEP;
	} elseif ($GroupDigits == 0) {
		$mon_thousands_sep = "";
	}

	// start by formatting the unsigned number
	$number = number_format(abs($amount),
							$frac_digits,
							$mon_decimal_point,
							$mon_thousands_sep);

	// check $IncludeLeadingDigit
	if ($IncludeLeadingDigit == 0) {
		if (substr($number, 0, 2) == "0.")
			$number = substr($number, 1, strlen($number)-1);
	}
	if ($amount < 0) {
		$sign = $negative_sign;

		// "extracts" the boolean value as an integer
		$n_cs_precedes  = intval($n_cs_precedes  == true);
		$n_sep_by_space = intval($n_sep_by_space == true);
		$key = $n_cs_precedes . $n_sep_by_space . $n_sign_posn;
	} else {
		$sign = $positive_sign;
		$p_cs_precedes  = intval($p_cs_precedes  == true);
		$p_sep_by_space = intval($p_sep_by_space == true);
		$key = $p_cs_precedes . $p_sep_by_space . $p_sign_posn;
	}
	$formats = array(

	  // currency symbol is after amount
	  // no space between amount and sign

	  '000' => '(%s' . $currency_symbol . ')',
	  '001' => $sign . '%s ' . $currency_symbol,
	  '002' => '%s' . $currency_symbol . $sign,
	  '003' => '%s' . $sign . $currency_symbol,
	  '004' => '%s' . $sign . $currency_symbol,

	  // one space between amount and sign
	  '010' => '(%s ' . $currency_symbol . ')',
	  '011' => $sign . '%s ' . $currency_symbol,
	  '012' => '%s ' . $currency_symbol . $sign,
	  '013' => '%s ' . $sign . $currency_symbol,
	  '014' => '%s ' . $sign . $currency_symbol,

	  // currency symbol is before amount
	  // no space between amount and sign

	  '100' => '(' . $currency_symbol . '%s)',
	  '101' => $sign . $currency_symbol . '%s',
	  '102' => $currency_symbol . '%s' . $sign,
	  '103' => $sign . $currency_symbol . '%s',
	  '104' => $currency_symbol . $sign . '%s',

	  // one space between amount and sign
	  '110' => '(' . $currency_symbol . ' %s)',
	  '111' => $sign . $currency_symbol . ' %s',
	  '112' => $currency_symbol . ' %s' . $sign,
	  '113' => $sign . $currency_symbol . ' %s',
	  '114' => $currency_symbol . ' ' . $sign . '%s');

  // lookup the key in the above array
	return sprintf($formats[$key], $number);
}

// Format number
// Arguments: Expression [,NumDigitsAfterDecimal [,IncludeLeadingDigit [,UseParensForNegativeNumbers [,GroupDigits]]]])
// NumDigitsAfterDecimal is the numeric value indicating how many places to the
// right of the decimal are displayed
// -1 Use Default
// The IncludeLeadingDigit, UseParensForNegativeNumbers, and GroupDigits
// arguments have the following settings:
// -1 True
// 0 False
// -2 Use Default
function ew_FormatNumber($amount, $NumDigitsAfterDecimal, $IncludeLeadingDigit = -2, $UseParensForNegativeNumbers = -2, $GroupDigits = -2) {

	// export the values returned by localeconv into the local scope
	if (!EW_USE_DEFAULT_LOCALE) extract(localeconv()); // PHP 4 >= 4.0.5

	// set defaults if locale is not set
	if (empty($decimal_point)) $decimal_point = DEFAULT_DECIMAL_POINT;
	if (empty($thousands_sep)) $thousands_sep = DEFAULT_THOUSANDS_SEP;
	if (empty($currency_symbol)) $currency_symbol = DEFAULT_CURRENCY_SYMBOL;
	if (empty($mon_decimal_point)) $mon_decimal_point = DEFAULT_MON_DECIMAL_POINT;
	if (empty($mon_thousands_sep)) $mon_thousands_sep = DEFAULT_MON_THOUSANDS_SEP;
	if (empty($positive_sign)) $positive_sign = DEFAULT_POSITIVE_SIGN;
	if (empty($negative_sign)) $negative_sign = DEFAULT_NEGATIVE_SIGN;
	if (empty($frac_digits) || $frac_digits == CHAR_MAX) $frac_digits = DEFAULT_FRAC_DIGITS;
	if (empty($p_cs_precedes) || $p_cs_precedes == CHAR_MAX) $p_cs_precedes = DEFAULT_P_CS_PRECEDES;
	if (empty($p_sep_by_space) || $p_sep_by_space == CHAR_MAX) $p_sep_by_space = DEFAULT_P_SEP_BY_SPACE;
	if (empty($n_cs_precedes) || $n_cs_precedes == CHAR_MAX) $n_cs_precedes = DEFAULT_N_CS_PRECEDES;
	if (empty($n_sep_by_space) || $n_sep_by_space == CHAR_MAX) $n_sep_by_space = DEFAULT_N_SEP_BY_SPACE;
	if (empty($p_sign_posn) || $p_sign_posn == CHAR_MAX) $p_sign_posn = DEFAULT_P_SIGN_POSN;
	if (empty($n_sign_posn) || $n_sign_posn == CHAR_MAX) $n_sign_posn = DEFAULT_N_SIGN_POSN;

	// check $NumDigitsAfterDecimal
	if ($NumDigitsAfterDecimal > -1)
		$frac_digits = $NumDigitsAfterDecimal;

	// check $UseParensForNegativeNumbers
	if ($UseParensForNegativeNumbers == -1) {
		$n_sign_posn = 0;
		if ($p_sign_posn == 0) {
			if (DEFAULT_P_SIGN_POSN != 0)
				$p_sign_posn = DEFAULT_P_SIGN_POSN;
			else
				$p_sign_posn = 3;
		}
	} elseif ($UseParensForNegativeNumbers == 0) {
		if ($n_sign_posn == 0)
			if (DEFAULT_P_SIGN_POSN != 0)
				$n_sign_posn = DEFAULT_P_SIGN_POSN;
			else
				$n_sign_posn = 3;
	}

	// check $GroupDigits
	if ($GroupDigits == -1) {
		$thousands_sep = DEFAULT_THOUSANDS_SEP;
	} elseif ($GroupDigits == 0) {
		$thousands_sep = "";
	}

	// start by formatting the unsigned number
	$number = number_format(abs($amount),
						  $frac_digits,
						  $decimal_point,
						  $thousands_sep);

	// check $IncludeLeadingDigit
	if ($IncludeLeadingDigit == 0) {
		if (substr($number, 0, 2) == "0.")
			$number = substr($number, 1, strlen($number)-1);
	}
	if ($amount < 0) {
		$sign = $negative_sign;
		$key = $n_sign_posn;
	} else {
		$sign = $positive_sign;
		$key = $p_sign_posn;
	}
	$formats = array(
		'0' => '(%s)',
		'1' => $sign . '%s',
		'2' => $sign . '%s',
		'3' => $sign . '%s',
		'4' => $sign . '%s');

	// lookup the key in the above array
	return sprintf($formats[$key], $number);
}

// Format percent
// Arguments: Expression [,NumDigitsAfterDecimal [,IncludeLeadingDigit	[,UseParensForNegativeNumbers [,GroupDigits]]]])
// NumDigitsAfterDecimal is the numeric value indicating how many places to the
// right of the decimal are displayed
// -1 Use Default
// The IncludeLeadingDigit, UseParensForNegativeNumbers, and GroupDigits
// arguments have the following settings:
// -1 True
// 0 False
// -2 Use Default
function ew_FormatPercent($amount, $NumDigitsAfterDecimal, $IncludeLeadingDigit = -2, $UseParensForNegativeNumbers = -2, $GroupDigits = -2) {

	// export the values returned by localeconv into the local scope
	if (!EW_USE_DEFAULT_LOCALE) extract(localeconv()); // PHP 4 >= 4.0.5

	// set defaults if locale is not set
	if (empty($decimal_point)) $decimal_point = DEFAULT_DECIMAL_POINT;
	if (empty($thousands_sep)) $thousands_sep = DEFAULT_THOUSANDS_SEP;
	if (empty($currency_symbol)) $currency_symbol = DEFAULT_CURRENCY_SYMBOL;
	if (empty($mon_decimal_point)) $mon_decimal_point = DEFAULT_MON_DECIMAL_POINT;
	if (empty($mon_thousands_sep)) $mon_thousands_sep = DEFAULT_MON_THOUSANDS_SEP;
	if (empty($positive_sign)) $positive_sign = DEFAULT_POSITIVE_SIGN;
	if (empty($negative_sign)) $negative_sign = DEFAULT_NEGATIVE_SIGN;
	if (empty($frac_digits) || $frac_digits == CHAR_MAX) $frac_digits = DEFAULT_FRAC_DIGITS;
	if (empty($p_cs_precedes) || $p_cs_precedes == CHAR_MAX) $p_cs_precedes = DEFAULT_P_CS_PRECEDES;
	if (empty($p_sep_by_space) || $p_sep_by_space == CHAR_MAX) $p_sep_by_space = DEFAULT_P_SEP_BY_SPACE;
	if (empty($n_cs_precedes) || $n_cs_precedes == CHAR_MAX) $n_cs_precedes = DEFAULT_N_CS_PRECEDES;
	if (empty($n_sep_by_space) || $n_sep_by_space == CHAR_MAX) $n_sep_by_space = DEFAULT_N_SEP_BY_SPACE;
	if (empty($p_sign_posn) || $p_sign_posn == CHAR_MAX) $p_sign_posn = DEFAULT_P_SIGN_POSN;
	if (empty($n_sign_posn) || $n_sign_posn == CHAR_MAX) $n_sign_posn = DEFAULT_N_SIGN_POSN;

	// check $NumDigitsAfterDecimal
	if ($NumDigitsAfterDecimal > -1)
		$frac_digits = $NumDigitsAfterDecimal;

	// check $UseParensForNegativeNumbers
	if ($UseParensForNegativeNumbers == -1) {
		$n_sign_posn = 0;
		if ($p_sign_posn == 0) {
			if (DEFAULT_P_SIGN_POSN != 0)
				$p_sign_posn = DEFAULT_P_SIGN_POSN;
			else
				$p_sign_posn = 3;
		}
	} elseif ($UseParensForNegativeNumbers == 0) {
		if ($n_sign_posn == 0)
			if (DEFAULT_P_SIGN_POSN != 0)
				$n_sign_posn = DEFAULT_P_SIGN_POSN;
			else
				$n_sign_posn = 3;
	}

	// check $GroupDigits
	if ($GroupDigits == -1) {
		$thousands_sep = DEFAULT_THOUSANDS_SEP;
	} elseif ($GroupDigits == 0) {
		$thousands_sep = "";
	}

	// start by formatting the unsigned number
	$number = number_format(abs($amount)*100,
							$frac_digits,
							$decimal_point,
							$thousands_sep);

	// check $IncludeLeadingDigit
	if ($IncludeLeadingDigit == 0) {
		if (substr($number, 0, 2) == "0.")
			$number = substr($number, 1, strlen($number)-1);
	}
	if ($amount < 0) {
		$sign = $negative_sign;
		$key = $n_sign_posn;
	} else {
		$sign = $positive_sign;
		$key = $p_sign_posn;
	}
	$formats = array(
		'0' => '(%s%%)',
		'1' => $sign . '%s%%',
		'2' => $sign . '%s%%',
		'3' => $sign . '%s%%',
		'4' => $sign . '%s%%');

	// lookup the key in the above array
	return sprintf($formats[$key], $number);
}

// Encode html
function ew_HtmlEncode($exp) {
	return htmlspecialchars(strval($exp));
}

// Encode value for single-quoted JavaScript string
function ew_JsEncode($val) {
	$val = str_replace("\\", "\\\\", strval($val));
	$val = str_replace("'", "\\'", $val);
	$val = str_replace("\r\n", "<br>", $val);
	$val = str_replace("\r", "<br>", $val);
	$val = str_replace("\n", "<br>", $val);
	return $val;
}

// Generate Value Separator based on current row count
// rowcnt - zero based row count
function ew_ValueSeparator($rowcnt) {
	return ", ";
}

// Generate View Option Separator based on current row count (Multi-Select / CheckBox)
// rowcnt - zero based row count
function ew_ViewOptionSeparator($rowcnt) {
	$sep = ", ";

	// Sample code to adjust 2 options per row
	//if (($rowcnt + 1) % 2 == 0) { // 2 options per row
		//return $sep += "<br>";
	//}

	return $sep;
}

// Move uploaded file
function ew_MoveUploadFile($srcfile, $destfile) {
	$res = move_uploaded_file($srcfile, $destfile);
	if ($res) chmod($destfile, EW_UPLOADED_FILE_MODE);
	return $res;
}

// Render repeat column table
// $rowcnt - zero based row count
function ew_RepeatColumnTable($totcnt, $rowcnt, $repeatcnt, $rendertype) {
	$sWrk = "";
	if ($rendertype == 1) { // Render control start
		if ($rowcnt == 0) $sWrk .= "<table class=\"" . EW_ITEM_TABLE_CLASSNAME . "\">";
		if ($rowcnt % $repeatcnt == 0) $sWrk .= "<tr>";
		$sWrk .= "<td>";
	} elseif ($rendertype == 2) { // Render control end
		$sWrk .= "</td>";
		if ($rowcnt % $repeatcnt == $repeatcnt - 1) {
			$sWrk .= "</tr>";
		} elseif ($rowcnt == $totcnt - 1) {
			for ($i = ($rowcnt % $repeatcnt) + 1; $i < $repeatcnt; $i++) {
				$sWrk .= "<td>&nbsp;</td>";
			}
			$sWrk .= "</tr>";
		}
		if ($rowcnt == $totcnt - 1) $sWrk .= "</table>";
	}
	return $sWrk;
}

// Truncate Memo Field based on specified length, string truncated to nearest space or CrLf
function ew_TruncateMemo($memostr, $ln, $removehtml) {
	$str = ($removehtml) ? ew_RemoveHtml($memostr) : $memostr;
	if (strlen($str) > 0 && strlen($str) > $ln) {
		$k = 0;
		while ($k >= 0 && $k < strlen($str)) {
			$i = strpos($str, " ", $k);
			$j = strpos($str, chr(10), $k);
			if ($i === FALSE && $j === FALSE) { // Not able to truncate
				return $str;
			} else {

				// Get nearest space or CrLf
				if ($i > 0 && $j > 0) {
					if ($i < $j) {
						$k = $i;
					} else {
						$k = $j;
					}
				} elseif ($i > 0) {
					$k = $i;
				} elseif ($j > 0) {
					$k = $j;
				}

				// Get truncated text
				if ($k >= $ln) {
					return substr($str, 0, $k) . "...";
				} else {
					$k++;
				}
			}
		}
	} else {
		return $str;
	}
}

// Remove HTML tags from text
function ew_RemoveHtml($str) {
	return preg_replace('/<[^>]*>/', '', strval($str));
}

// Send notify email
function ew_SendNotifyEmail($sFn, $sSubject, $sTable, $sKey, $sAction) {

	// Send Email
	if (EW_SENDER_EMAIL <> "" && EW_RECIPIENT_EMAIL <> "") {
		return ew_SendTemplateEmail($sFn, EW_SENDER_EMAIL, EW_RECIPIENT_EMAIL, "", "",
			$sSubject, array("<!--table-->" => $sTable, "<!--key-->" => $sKey, "<!--action-->" => $sAction));
	}
}

// Send email by template
Function ew_SendTemplateEmail($sTemplate, $sSender, $sRecipient, $sCcEmail, $sBccEmail, $sSubject, $arContent) {
	if ($sSender <> "" && $sRecipient <> "") {
		$Email = new cEmail;
		$Email->Load($sTemplate);
		$Email->ReplaceSender($sSender); // Replace Sender
		$Email->ReplaceRecipient($sRecipient); // Replace Recipient
		if ($sCcEmail <> "") $Email->AddCc($sCcEmail); // Add Cc
		if ($sBccEmail <> "") $Email->AddBcc($sBccEmail); // Add Bcc
		if ($sSubject <> "") $Email->ReplaceSubject($sSubject); // Replace subject
		if (is_array($arContent)) {
			foreach ($arContent as $key => $value)
				$Email->ReplaceContent($key, $value);
		}
		return $Email->Send();
	}
	return FALSE;
}

// Include PHPMailer class if selected
if (EW_EMAIL_COMPONENT == "PHPMAILER") {
	include("phpmailer" . EW_PATH_DELIMITER . ((EW_IS_PHP5) ? "php5" : "php4") . EW_PATH_DELIMITER . "class.phpmailer.php");
}

// Function to send email
function ew_SendEmail($sFrEmail, $sToEmail, $sCcEmail, $sBccEmail, $sSubject, $sMail, $sFormat, $sCharset) {
	global $Language, $gsEmailErrDesc;
	$res = FALSE;
	if (EW_EMAIL_COMPONENT == "PHPMAILER") {
		$mail = new PHPMailer();
		$mail->IsSMTP(); 
		$mail->Host = EW_SMTP_SERVER;
		$mail->SMTPAuth = (EW_SMTP_SERVER_USERNAME <> "" && EW_SMTP_SERVER_PASSWORD <> "");
		$mail->Username = EW_SMTP_SERVER_USERNAME;
		$mail->Password = EW_SMTP_SERVER_PASSWORD;
		$mail->Port = EW_SMTP_SERVER_PORT;
		$mail->From = $sFrEmail;
		$mail->FromName = $sFrEmail;
		$mail->Subject = $sSubject;
		$mail->Body = $sMail;
		if ($sCharset <> "" && strtolower($sCharset) <> "iso-8859-1")
			$mail->Charset = $sCharset;
		$sToEmail = str_replace(";", ",", $sToEmail);
		$arrTo = explode(",", $sToEmail);
		foreach ($arrTo as $sTo) {
			$mail->AddAddress(trim($sTo));
		}
		if ($sCcEmail <> "") {
			$sCcEmail = str_replace(";", ",", $sCcEmail);
			$arrCc = explode(",", $sCcEmail);
			foreach ($arrCc as $sCc) {
				$mail->AddCC(trim($sCc));
			}
		}
		if ($sBccEmail <> "") {
			$sBccEmail = str_replace(";", ",", $sBccEmail);
			$arrBcc = explode(",", $sBccEmail);
			foreach ($arrBcc as $sBcc) {
				$mail->AddBCC(trim($sBcc));
			}
		}
		if (strtolower($sFormat) == "html") {
			$mail->ContentType = "text/html";
		} else {
			$mail->ContentType = "text/plain";
		}
		$res = $mail->Send();
		$gsEmailErrDesc = $mail->ErrorInfo;

		// Uncomment to debug
//		var_dump($mail); exit();

	} else {
		$to  = $sToEmail;
		$subject = $sSubject;
		$message = $sMail;

		// header
		$content_type = (strtolower($sFormat) == "html") ? "text/html" : "text/plain";
		if ($sCharset <> "")
			$content_type .= "; charset=" . $sCharset;
		$headers = "Content-type: " . $content_type . "\r\n";
		$headers .= "From: " . str_replace(";", ",", $sFrEmail) . "\r\n";
		if ($sCcEmail <> "")
			$headers .= "Cc: " . str_replace(";", ",", $sCcEmail) . "\r\n";
		if ($sBccEmail <>"")
			$headers .= "Bcc: " . str_replace(";", ",", $sBccEmail) . "\r\n";
		if (EW_IS_WINDOWS) {
			if (EW_SMTP_SERVER <> "")
				ini_set("SMTP", EW_SMTP_SERVER);
			if (is_int(EW_SMTP_SERVER_PORT))
				ini_set("smtp_port", EW_SMTP_SERVER_PORT);
		}
		ini_set("sendmail_from", $sFrEmail);
		$res = mail($to, $subject, $message, $headers);
		$gsEmailErrDesc = ($res) ? $Language->Phrase("FailedToSendMail") : "";

		// Uncomment to debug
//		echo "Header: " . $headers . "<br>" . "Subject: " . $subject . "<br>" .
//			"To: " . $to . "<br>" .	"Body: " . $message . "<br>";	exit();

	}
	return $res;
}

// Load content at URL
// Arguments:
// url: URL to send reqeust
// method: "GET" or "POST"
// postdata: POST data
// Note: CURL must be enabled
function ew_LoadContentFromUrl($url, $method = "GET", $postdata = "") {
	$fp = "";
	if (function_exists("curl_init")) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		if (strtoupper(trim($method)) == "POST")
			curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$fp = curl_exec($ch);
		curl_close($ch);
	}
	return trim($fp);
}

// Field data type
function ew_FieldDataType($fldtype) {
	switch ($fldtype) {
		case 20:
		case 3:
		case 2:
		case 16:
		case 4:
		case 5:
		case 131:
		case 139:
		case 6:
		case 17:
		case 18:
		case 19:
		case 21: // Numeric
			return EW_DATATYPE_NUMBER;
		case 7:
		case 133:
		case 135: // Date
		case 146: // DateTiemOffset
			return EW_DATATYPE_DATE;
		case 134: // Time
		case 145: // Time
			return EW_DATATYPE_TIME;
		case 201:
		case 203: // Memo
			return EW_DATATYPE_MEMO;
		case 129:
		case 130:
		case 200:
		case 202: // String
			return EW_DATATYPE_STRING;
		case 11: // Boolean
			return EW_DATATYPE_BOOLEAN;
		case 72: // GUID
			return EW_DATATYPE_GUID;
		case 128:
		case 204:
		case 205: // Binary
			return EW_DATATYPE_BLOB;
		case 141: // XML
			return EW_DATATYPE_XML;
		default:
			return EW_DATATYPE_OTHER;
	}
}

// Application root
function ew_AppRoot() {

	// 1. use root relative path
	if (EW_ROOT_RELATIVE_PATH <> "") {
		$Path = realpath(EW_ROOT_RELATIVE_PATH);
		$Path = str_replace("\\\\", EW_PATH_DELIMITER, $Path);
	}

	// 2. if empty, use the document root if available
	if (empty($Path))
		$Path = ew_ServerVar("APPL_PHYSICAL_PATH"); // IIS
	if (empty($Path))
		$Path = ew_ServerVar("DOCUMENT_ROOT");

	// 3. if empty, use current folder
	if (empty($Path))
		$Path = realpath(".");

	// 4. use custom path, uncomment the following line and enter your path
	// e.g. $Path = 'C:\Inetpub\wwwroot\MyWebRoot'; // Windows
	//$Path = 'enter your path here';

	if (empty($Path))
		die("Path of website root unknown.");
	return ew_IncludeTrailingDelimiter($Path, TRUE);
}

// Get path relative to application root
function ew_ServerMapPath($Path) {
	return ew_PathCombine(ew_AppRoot(), $Path, TRUE);
}

// Get path relative to a base path
function ew_PathCombine($BasePath, $RelPath, $PhyPath) {
	$BasePath = ew_RemoveTrailingDelimiter($BasePath, $PhyPath);
	if ($PhyPath) {
		$Delimiter = EW_PATH_DELIMITER;
		$RelPath = str_replace('/', EW_PATH_DELIMITER, $RelPath);
		$RelPath = str_replace('\\', EW_PATH_DELIMITER, $RelPath);
	} else {
		$Delimiter = '/';
		$RelPath = str_replace('\\', '/', $RelPath);
	}
	if ($RelPath == '.' || $RelPath == '..') $RelPath .= $Delimiter;
	$p1 = strpos($RelPath, $Delimiter);
	$Path2 = "";
	while ($p1 !== FALSE) {
		$Path = substr($RelPath, 0, $p1 + 1);
		if ($Path == $Delimiter || $Path == ".$Delimiter") {

			// Skip
		} elseif ($Path == "..$Delimiter") {
			$p2 = strrpos($BasePath, $Delimiter);
			if ($p2 !== FALSE) $BasePath = substr($BasePath, 0, $p2);
		} else {
			$Path2 .= $Path;
		}
		$RelPath = substr($RelPath, $p1+1);
		if ($RelPath === FALSE) {
			$RelPath = "";
		} elseif ($RelPath == '.' || $RelPath == '..') {
			$RelPath .= $Delimiter;
		}
		$p1 = strpos($RelPath, $Delimiter);
	}
	return ew_IncludeTrailingDelimiter($BasePath, $PhyPath) . $Path2 . $RelPath;
}

// Remove the last delimiter for a path
function ew_RemoveTrailingDelimiter($Path, $PhyPath) {
	$Delimiter = ($PhyPath) ? EW_PATH_DELIMITER : '/';
	while (substr($Path, -1) == $Delimiter)
		$Path = substr($Path, 0, strlen($Path)-1);
	return $Path;
}

// Include the last delimiter for a path
function ew_IncludeTrailingDelimiter($Path, $PhyPath) {
	$Path = ew_RemoveTrailingDelimiter($Path, $PhyPath);
	$Delimiter = ($PhyPath) ? EW_PATH_DELIMITER : '/';
	return $Path . $Delimiter;
}

// Write the paths for config/debug only
function ew_WritePaths() {
	echo 'DOCUMENT_ROOT=' . ew_ServerVar("DOCUMENT_ROOT") . "<br>";
	echo 'EW_ROOT_RELATIVE_PATH=' . EW_ROOT_RELATIVE_PATH . "<br>";
	echo 'ew_AppRoot()=' . ew_AppRoot() . "<br>";
	echo 'realpath(".")=' . realpath(".") . "<br>";
	echo '__FILE__=' . __FILE__ . "<br>";
}

// Upload path
// If PhyPath is TRUE(1), return physical path on the server
// If PhyPath is FALSE(0), return relative URL
function ew_UploadPathEx($PhyPath, $DestPath) {
	if ($PhyPath) {
		$Path = ew_PathCombine(ew_AppRoot(), str_replace("/", EW_PATH_DELIMITER, $DestPath), TRUE);
	} else {
		$Path = ew_ScriptName();
		$Path = substr($Path, 0, strrpos($Path, "/"));
		$Path = ew_PathCombine($Path, EW_ROOT_RELATIVE_PATH, FALSE);
		$Path = ew_PathCombine(ew_IncludeTrailingDelimiter($Path, FALSE), $DestPath, FALSE);
	}
	return ew_IncludeTrailingDelimiter($Path, $PhyPath);
}

// Global upload path
// If PhyPath is TRUE(1), return physical path on the server
// If PhyPath is FALSE(0), return relative URL
function ew_UploadPath($PhyPath) {
	return ew_UploadPathEx($PhyPath, EW_UPLOAD_DEST_PATH);
}

// Upload file name
function ew_UploadFileNameEx($folder, $sFileName) {

	// By default, ew_UniqueFileName() is used to get an unique file name,
	// you can change the logic here

	$sOutFileName = ew_UniqueFilename($folder, $sFileName);

	// Return computed output file name
	return $sOutFileName;
}

// Generate an unique file name (filename(n).ext)
function ew_UniqueFilename($folder, $oriFilename) {
	if ($oriFilename == "") $oriFilename = ew_DefaultFileName();
	$oriFilename = str_replace(" ", "_", $oriFilename);
	$oriFilename = strtolower(basename($oriFilename));
	$destFullPath = $folder . $oriFilename;
	$newFilename = $oriFilename;
	$i = 1;
	if (!file_exists($folder)) {
		if (!ew_CreateFolder($folder)) {
			die("Folder does not exist: " . $folder);
		}
	}
	while (file_exists($destFullPath)) {
		$file_extension  = strtolower(strrchr($oriFilename, "."));
		$file_name = basename($oriFilename, $file_extension);
		$newFilename = $file_name . "($i)" . $file_extension;
		$destFullPath = $folder . $newFilename;
		$i++;
  }
	return $newFilename;
}

// Create a default file name(yyyymmddhhmmss.bin)
function ew_DefaultFileName() {
	return date("YmdHis") . ".bin";
}

// Get refer page name
function ew_ReferPage() {
	return ew_GetPageName(ew_ServerVar("HTTP_REFERER"));
}

// Get script physical folder
function ew_ScriptFolder() {
	$folder = "";
	$path = ew_ServerVar("SCRIPT_FILENAME");
	$p = strrpos($path, EW_PATH_DELIMITER);
	if ($p !== FALSE)
		$folder = substr($path, 0, $p);
	return ($folder <> "") ? $folder : realpath(".");
}

// Get a temp folder for temp file
function ew_TmpFolder() {
	$tmpfolder = NULL;
  $folders = array();
  if (EW_IS_WINDOWS) {
    $folders[] = ew_ServerVar("TEMP");
    $folders[] = ew_ServerVar("TMP");
  } else {
		if (EW_UPLOAD_TMP_PATH <> "") $folders[] = ew_AppRoot() . str_replace("/", EW_PATH_DELIMITER, EW_UPLOAD_TMP_PATH);
    $folders[] = '/tmp';
  }
	if (ini_get('upload_tmp_dir')) {
    $folders[] = ini_get('upload_tmp_dir');
  }
  foreach ($folders as $folder) {
    if (!$tmpfolder && is_dir($folder)) {
      $tmpfolder = $folder;
    }
  }

	//if ($tmpfolder) $tmpfolder = ew_IncludeTrailingDelimiter($tmpfolder, TRUE);
  return $tmpfolder;
}

// Create folder
function ew_CreateFolder($dir, $mode = 0777) {
  if (is_dir($dir) || @mkdir($dir, $mode))
		return TRUE;
  if (!ew_CreateFolder(dirname($dir), $mode))
		return FALSE;
  return @mkdir($dir, $mode);
}

// Save file
function ew_SaveFile($folder, $fn, $filedata) {
	$res = FALSE;
	if (ew_CreateFolder($folder)) {
		if ($handle = fopen($folder . $fn, 'w')) { // P6
			$res = fwrite($handle, $filedata);
    	fclose($handle);
		}
		if ($res)
			chmod($folder . $fn, EW_UPLOADED_FILE_MODE);
	}
	return $res;
}

// function to generate random number
function ew_Random() {
	if (phpversion() < "4.2.0") {
	  list($usec, $sec) = explode(' ', microtime());
	  $seed = (float) $sec + ((float) $usec * 100000);
		mt_srand($seed);
	}
	return mt_rand();
}

// function to remove CR and LF
function ew_RemoveCrLf($s) {
	if (strlen($s) > 0) {
		$s = str_replace("\n", " ", $s);
		$s = str_replace("\r", " ", $s);
		$s = str_replace("\l", " ", $s);
	}
	return $s;
}

// Calculate hash for recordset
function ew_GetRsHash(&$rs, $fldname) {
	return md5(ew_GetFldValueAsString($rs->fields($fldname)));
}

// Get field value as string
function ew_GetFldValueAsString($value) {
	if (is_null($value)) {
		return "";
	} else {
		if (strlen($value) > 65535) { // BLOB/TEXT
			if (EW_BLOB_FIELD_BYTE_COUNT > 0) {
				return substr($value, 0, EW_BLOB_FIELD_BYTE_COUNT);
			} else {
				return $value;
			}
		} else {
			return strval($value);
		}
	}
}

// Convert byte array to binary string
function ew_BytesToStr($bytes) {
	$str = "";
	foreach ($bytes as $byte)
		$str .= chr($byte);
	return $str;
}

// Convert binary string to byte array
function ew_StrToBytes($str) {
	$cnt = strlen($str);
	$bytes = array();
	for ($i = 0; $i < $cnt; $i++)
		$bytes[] = ord($str[$i]);
	return $bytes;
}
?>
<?php

/**
 * Form class
 */

class cFormObj {
	var $Index;

	// Constructor
	function cFormObj() {
		$this->Index = 0;
	}

	// Get form element name based on index
	function GetIndexedName($name) {
		if ($this->Index <= 0) {
			return $name;
		} else {
			return substr($name, 0, 1) . $this->Index . substr($name, 1);
		}
	}

	// Get value for form element
	function GetValue($name) {
		$wrkname = $this->GetIndexedName($name);
		return @$_POST[$wrkname];
	}

	// Get upload file size
	function GetUploadFileSize($name) {
		$wrkname = $this->GetIndexedName($name);
		return @$_FILES[$wrkname]['size'];
	}

	// Get upload file name
	function GetUploadFileName($name) {
		$wrkname = $this->GetIndexedName($name);
		return @$_FILES[$wrkname]['name'];
	}

	// Get file content type
	function GetUploadFileContentType($name) {
		$wrkname = $this->GetIndexedName($name);
		return @$_FILES[$wrkname]['type'];
	}

	// Get file error
	function GetUploadFileError($name) {
		$wrkname = $this->GetIndexedName($name);
		return @$_FILES[$wrkname]['error'];
	}

	// Get file temp name
	function GetUploadFileTmpName($name) {
		$wrkname = $this->GetIndexedName($name);
		return @$_FILES[$wrkname]['tmp_name'];
	}

	// Check if is upload file
	function IsUploadedFile($name) {
		$wrkname = $this->GetIndexedName($name);
		return is_uploaded_file(@$_FILES[$wrkname]["tmp_name"]);
	}

	// Get upload file data
	function GetUploadFileData($name) {
		if ($this->IsUploadedFile($name)) {
			$wrkname = $this->GetIndexedName($name);
			return ew_ReadFile($_FILES[$wrkname]["tmp_name"]);
		} else {
			return NULL;
		}
	}

	// Get image sizes
	var $size;

	function GetImageDimension($name) {
		if (!isset($this->size)) {
			$wrkname = $this->GetIndexedName($name);
			$this->size = @getimagesize($_FILES[$wrkname]['tmp_name']);
		}
	}

	// Get file image width
	function GetUploadImageWidth($name) {
		$this->GetImageDimension($name);
		return $this->size[0];
	}

	// Get file image height
	function GetUploadImageHeight($name) {
		$this->GetImageDimension($name);
		return $this->size[1];
	}
}
?>
<?php

/**
 * Functions for image resize
 */

// Resize binary to thumbnail
function ew_ResizeBinary($filedata, &$width, &$height, $quality) {
	return TRUE; // No resize
}

// Resize file to thumbnail file
function ew_ResizeFile($fn, $tn, &$width, &$height, $quality) {
	if (file_exists($fn)) { // Copy only
		return ($fn <> $tn) ? copy($fn, $tn) : TRUE;
	} else {
		return FALSE;
	}
}

// Resize file to binary
function ew_ResizeFileToBinary($fn, &$width, &$height, $quality) {
	return ew_ReadFile($fn); // Return original file content only
}
?>
<?php

/**
 * Functions for search
 */

// Highlight value based on basic search / advanced search keywords
function ew_Highlight($name, $src, $bkw, $bkwtype, $akw) {
	$outstr = "";
	if (strlen($src) > 0 && (strlen($bkw) > 0 || strlen($akw) > 0)) {
		$xx = 0;
		$yy = strpos($src, "<", $xx);
		if ($yy === FALSE) $yy = strlen($src);
		while ($yy >= 0) {
			if ($yy > $xx) {
				$wrksrc = substr($src, $xx, $yy - $xx);
				$kwstr = trim($bkw);
				if (strlen($bkw) > 0 && strlen($bkwtype) == 0) { // check for exact phase
        	$kwlist = array($kwstr); // use single array element
        } else {
					$kwlist = explode(" ", $kwstr);
				}
				if (strlen($akw) > 0)
					$kwlist[] = $akw;
				$x = 0;
				ew_GetKeyword($wrksrc, $kwlist, $x, $y, $kw);
				while ($y >= 0) {
					$outstr .= substr($wrksrc, $x, $y-$x) .
						"<span name=\"$name\" id=\"$name\" class=\"ewHighlightSearch\">" .
						substr($wrksrc, $y, strlen($kw)) . "</span>";
					$x = $y + strlen($kw);
					ew_GetKeyword($wrksrc, $kwlist, $x, $y, $kw);
				}
				$outstr .= substr($wrksrc, $x);
				$xx += strlen($wrksrc);
			}
			if ($xx < strlen($src)) {
				$yy = strpos($src, ">", $xx);
				if ($yy !== FALSE) {
					$outstr .= substr($src, $xx, $yy - $xx + 1);
					$xx = $yy + 1;
					$yy = strpos($src, "<", $xx);
					if ($yy === FALSE) $yy = strlen($src);
				} else {
					$outstr .= substr($src, $xx);
					$yy = -1;
				}
			} else {
				$yy = -1;
			}
		}	
	} else {
		$outstr = $src;
	}
	return $outstr;
}

// Get keyword
function ew_GetKeyword(&$src, &$kwlist, &$x, &$y, &$kw) {
	$thisy = -1;
	$thiskw = "";
	foreach ($kwlist as $wrkkw) {
		$wrkkw = trim($wrkkw);
		if ($wrkkw <> "") {
			if (EW_HIGHLIGHT_COMPARE) { // Case-insensitive
				if (function_exists('stripos')) { // PHP 5
					$wrky = stripos($src, $wrkkw, $x);
				} else {
					$wrky = strpos(strtoupper($src), strtoupper($wrkkw), $x);
				}
			} else {
				$wrky = strpos($src, $wrkkw, $x);
			}
			if ($wrky !== FALSE) {
				if ($thisy == -1) {
					$thisy = $wrky;
					$thiskw = $wrkkw;
				} elseif ($wrky < $thisy) {
					$thisy = $wrky;
					$thiskw = $wrkkw;
				}
			}
		}
	}
	$y = $thisy;
	$kw = $thiskw;
}
?>
<?php

/**
 * Functions for Auto-Update fields
 */

// Get user IP
function ew_CurrentUserIP() {
	return ew_ServerVar("REMOTE_ADDR");
}

// Get current host name, e.g. "www.mycompany.com"
function ew_CurrentHost() {
	return ew_ServerVar("HTTP_HOST");
}

// Get current date in default date format
// $namedformat = -1|5|6|7 (see comment for ew_FormatDateTime)
function ew_CurrentDate($namedformat = -1) {
	if ($namedformat > -1) {
		if ($namedformat == 6 || $namedformat == 7) {
			return ew_FormatDateTime(date('Y-m-d'), $namedformat);
		} else {
			return ew_FormatDateTime(date('Y-m-d'), 5);
	  }
	} else {
		return date('Y-m-d');
	}
}

// Get current time in hh:mm:ss format
function ew_CurrentTime() {
	return date("H:i:s");
}

// Get current date in default date format with time in hh:mm:ss format
// $namedformat = -1, 5-7, 9-11 (see comment for ew_FormatDateTime)
function ew_CurrentDateTime($namedformat = -1) {
	if (in_array($namedformat, array(5, 6, 7, 9, 10, 11))) {
		if ($namedformat == 5 || $namedformat == 9) {
			return ew_FormatDateTime(date('Y-m-d H:i:s'), 9);
		} elseif ($namedformat == 6 || $namedformat == 10) {
			return ew_FormatDateTime(date('Y-m-d H:i:s'), 10);
		} else {
			return ew_FormatDateTime(date('Y-m-d H:i:s'), 11);
	  }
	} else {
		return date('Y-m-d H:i:s');
	}
}

// Get current date in standard format (yyyy/mm/dd)
function ew_StdCurrentDate() {
	return date('Y/m/d');
}

// Get date in standard format (yyyy/mm/dd)
function ew_StdDate($ts) {
	return date('Y/m/d', $ts);
}

// Get current date and time in standard format (yyyy/mm/dd hh:mm:ss)
function ew_StdCurrentDateTime() {
	return date('Y/m/d H:i:s');
}

// Get date/time in standard format (yyyy/mm/dd hh:mm:ss)
function ew_StdDateTime($ts) {
	return date('Y/m/d H:i:s', $ts);
}

// Clone an object
function ew_Clone($obj) {
	return $obj;
}

/**
 * Functions for backward compatibilty
 */

// Get current user name
function CurrentUserName() {
	global $Security;
	return (isset($Security)) ? $Security->CurrentUserName() : strval(@$_SESSION[EW_SESSION_USER_NAME]);
}

// Get current user ID
function CurrentUserID() {
	global $Security;
	return (isset($Security)) ? $Security->CurrentUserID() : strval(@$_SESSION[EW_SESSION_USER_ID]);
}

// Get current parent user ID
function CurrentParentUserID() {
	global $Security;
	return (isset($Security)) ? $Security->CurrentParentUserID() : strval(@$_SESSION[EW_SESSION_PARENT_USER_ID]);
}

// Get current user level
function CurrentUserLevel() {
	global $Security;
	return (isset($Security)) ? $Security->CurrentUserLevelID() : @$_SESSION[EW_SESSION_USER_LEVEL_ID];
}

// Get current user level list
function CurrentUserLevelList() {
	global $Security;
	return (isset($Security)) ? $Security->UserLevelList() : strval(@$_SESSION[EW_SESSION_USER_LEVEL_ID]);
}

// Allow list
function AllowList($TableName) {
	global $Security;
	return $Security->AllowList($TableName);
}

// Allow add
function AllowAdd($TableName) {
	global $Security;
	return $Security->AllowAdd($TableName);
}

// Is password expired
function IsPasswordExpired() {
	global $Security;
	return (isset($Security)) ? $Security->IsPasswordExpired() : ($_SESSION[EW_SESSION_STATUS] == "passwordexpired");
}

// Is logging in
function IsLoggingIn() {
	global $Security;
	return (isset($Security)) ? $Security->IsLoggingIn() : ($_SESSION[EW_SESSION_STATUS] == "loggingin");
}

// Is logged in
function IsLoggedIn() {
	global $Security;
	return (isset($Security)) ? $Security->IsLoggedIn() : ($_SESSION[EW_SESSION_STATUS] == "login");
}

// Is system admin
function IsSysAdmin() {
	global $Security;
	return (isset($Security)) ? $Security->IsSysAdmin() : ($_SESSION[EW_SESSION_SYS_ADMIN] == 1);
}

/**
 * Functions for TEA encryption/decryption
 */

function long2str($v, $w) {
	$len = count($v);
	$s = array();
	for ($i = 0; $i < $len; $i++)
	{
		$s[$i] = pack("V", $v[$i]);
	}
	if ($w) {
		return substr(join('', $s), 0, $v[$len - 1]);
	}	else {
		return join('', $s);
	}
}

function str2long($s, $w) {
	$v = unpack("V*", $s. str_repeat("\0", (4 - strlen($s) % 4) & 3));
	$v = array_values($v);
	if ($w) {
		$v[count($v)] = strlen($s);
	}
	return $v;
}

// encrypt
function TEAencrypt($str, $key) {
	if ($str == "") {
		return "";
	}
	$v = str2long($str, true);
	$k = str2long($key, false);
	if (count($k) < 4) {
		for ($i = count($k); $i < 4; $i++) {
			$k[$i] = 0;
		}
	}
	$n = count($v) - 1;
	$z = $v[$n];
	$y = $v[0];
	$delta = 0x9E3779B9;
	$q = floor(6 + 52 / ($n + 1));
	$sum = 0;
	while (0 < $q--) {
		$sum = int32($sum + $delta);
		$e = $sum >> 2 & 3;
		for ($p = 0; $p < $n; $p++) {
			$y = $v[$p + 1];
			$mx = int32((($z >> 5 & 0x07ffffff) ^ $y << 2) + (($y >> 3 & 0x1fffffff) ^ $z << 4)) ^ int32(($sum ^ $y) + ($k[$p & 3 ^ $e] ^ $z));
			$z = $v[$p] = int32($v[$p] + $mx);
		}
		$y = $v[0];
		$mx = int32((($z >> 5 & 0x07ffffff) ^ $y << 2) + (($y >> 3 & 0x1fffffff) ^ $z << 4)) ^ int32(($sum ^ $y) + ($k[$p & 3 ^ $e] ^ $z));
		$z = $v[$n] = int32($v[$n] + $mx);
	}
	return ew_UrlEncode(long2str($v, false));
}

// decrypt
function TEAdecrypt($str, $key) {
	$str = ew_UrlDecode($str);
	if ($str == "") {
		return "";
	}
	$v = str2long($str, false);
	$k = str2long($key, false);
	if (count($k) < 4) {
		for ($i = count($k); $i < 4; $i++) {
			$k[$i] = 0;
		}
	}
	$n = count($v) - 1;
	$z = $v[$n];
	$y = $v[0];
	$delta = 0x9E3779B9;
	$q = floor(6 + 52 / ($n + 1));
	$sum = int32($q * $delta);
	while ($sum != 0) {
		$e = $sum >> 2 & 3;
		for ($p = $n; $p > 0; $p--) {
			$z = $v[$p - 1];
			$mx = int32((($z >> 5 & 0x07ffffff) ^ $y << 2) + (($y >> 3 & 0x1fffffff) ^ $z << 4)) ^ int32(($sum ^ $y) + ($k[$p & 3 ^ $e] ^ $z));
			$y = $v[$p] = int32($v[$p] - $mx);
		}
		$z = $v[$n];
		$mx = int32((($z >> 5 & 0x07ffffff) ^ $y << 2) + (($y >> 3 & 0x1fffffff) ^ $z << 4)) ^ int32(($sum ^ $y) + ($k[$p & 3 ^ $e] ^ $z));
		$y = $v[0] = int32($v[0] - $mx);
		$sum = int32($sum - $delta);
	}
	return long2str($v, true);
}

function int32($n) {
	while ($n >= 2147483648) $n -= 4294967296;
	while ($n <= -2147483649) $n += 4294967296;
	return (int)$n;
}

function ew_UrlEncode($string) {
	$data = base64_encode($string);
	return str_replace(array('+','/','='), array('-','_','.'), $data);
}

function ew_UrlDecode($string) {
	$data = str_replace(array('-','_','.'), array('+','/','='), $string);
	return base64_decode($data);
}

// Remove XSS
function ew_RemoveXSS($val) {

	// remove all non-printable characters. CR(0a) and LF(0b) and TAB(9) are allowed 
	// this prevents some character re-spacing such as <java\0script> 
	// note that you have to handle splits with \n, \r, and \t later since they *are* allowed in some inputs 

	$val = preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $val); 

	// straight replacements, the user should never need these since they're normal characters 
	// this prevents like <IMG SRC=&#X40&#X61&#X76&#X61&#X73&#X63&#X72&#X69&#X70&#X74&#X3A&#X61&#X6C&#X65&#X72&#X74&#X28&#X27&#X58&#X53&#X53&#X27&#X29> 

	$search = 'abcdefghijklmnopqrstuvwxyz'; 
	$search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	$search .= '1234567890!@#$%^&*()'; 
	$search .= '~`";:?+/={}[]-_|\'\\'; 
	for ($i = 0; $i < strlen($search); $i++) { 

	   // ;? matches the ;, which is optional 
	   // 0{0,7} matches any padded zeros, which are optional and go up to 8 chars 
	   // &#x0040 @ search for the hex values 

	   $val = preg_replace('/(&#[x|X]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val); // with a ; 

	   // &#00064 @ 0{0,7} matches '0' zero to seven times 
	   $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val); // with a ; 
	} 

	// now the only remaining whitespace attacks are \t, \n, and \r 
	$ra = $GLOBALS["EW_XSS_ARRAY"]; // Note: Customize $EW_XSS_ARRAY in ewcfg*.php
	$found = true; // keep replacing as long as the previous round replaced something 
	while ($found == true) { 
	   $val_before = $val; 
	   for ($i = 0; $i < sizeof($ra); $i++) { 
	      $pattern = '/'; 
	      for ($j = 0; $j < strlen($ra[$i]); $j++) { 
	         if ($j > 0) { 
	            $pattern .= '('; 
	            $pattern .= '(&#[x|X]0{0,8}([9][a][b]);?)?'; 
	            $pattern .= '|(&#0{0,8}([9][10][13]);?)?'; 
	            $pattern .= ')?'; 
	         } 
	         $pattern .= $ra[$i][$j]; 
	      } 
	      $pattern .= '/i'; 
	      $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2); // add in <> to nerf the tag 
	      $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags 
	      if ($val_before == $val) { 

	         // no replacements were made, so exit the loop 
	         $found = false; 
	      } 
	   } 
	} 
	return $val; 
}

// Calculate date difference
function ew_DateDiff($dateTimeBegin, $dateTimeEnd, $interval = "d") {
	$dateTimeBegin = strtotime($dateTimeBegin);
	if ($dateTimeBegin === -1 || $dateTimeBegin === FALSE)
		return FALSE;
	$dateTimeEnd = strtotime($dateTimeEnd);
	if($dateTimeEnd === -1 || $dateTimeEnd === FALSE)
		return FALSE;
	$dif = $dateTimeEnd - $dateTimeBegin;	
	$arBegin = getdate($dateTimeBegin);
	$dateBegin = mktime(0, 0, 0, $arBegin["mon"], $arBegin["mday"], $arBegin["year"]);
	$arEnd = getdate($dateTimeEnd);
	$dateEnd = mktime(0, 0, 0, $arEnd["mon"], $arEnd["mday"], $arEnd["year"]);
	$difDate = $dateEnd - $dateBegin;
	switch ($interval) {
		case "s": // seconds
			return $dif;
		case "n": // minutes
			return ($dif > 0) ? floor($dif/60) : ceil($dif/60);
		case "h": // hours
			return ($dif > 0) ? floor($dif/3600) : ceil($dif/3600);
		case "d": // days
			return ($difDate > 0) ? floor($difDate/86400) : ceil($difDate/86400);
		case "w": // weeks
			return ($difDate > 0) ? floor($difDate/604800) : ceil($difDate/604800);
		case "ww": // calendar weeks
			$difWeek = (($dateEnd - $arEnd["wday"]*86400) - ($dateBegin - $arBegin["wday"]*86400))/604800;
			return ($difWeek > 0) ? floor($difWeek) : ceil($difWeek);
		case "m": // months
			return (($arEnd["year"]*12 + $arEnd["mon"]) -	($arBegin["year"]*12 + $arBegin["mon"]));
		case "yyyy": // years
			return ($arEnd["year"] - $arBegin["year"]);
	}
}

// Write global debug message
function ew_DebugMsg() {
	global $gsDebugMsg;
	$msg = $gsDebugMsg;
	$gsDebugMsg = "";
	return ($msg <> "") ? "<p>" . $msg . "</p>" : "";
}

// Write global debug message
function ew_SetDebugMsg($v, $newline = TRUE) {
	global $gsDebugMsg;
	if ($newline && $gsDebugMsg <> "")
		$gsDebugMsg .= "<br>";
	$gsDebugMsg .=  $v;
}

// Init array
function &ew_InitArray($len, $value) {
	if (function_exists('array_fill') && $len > 0) { // PHP 4 >= 4.2.0
		$ar = array_fill(0, $len, $value);
	} else {
		$ar = array();
		for ($i = 0; $i < $len; $i++)
			$ar[] = $value;
	}
	return $ar;
}

// Init 2D array
function &ew_Init2DArray($len1, $len2, $value) {
	return ew_InitArray($len1, ew_InitArray($len2, $value));
}

/**
 * Validation functions
 */

// Check date format
// format: std/us/euro
function ew_CheckDateEx($value, $format, $sep) {
	if (strval($value) == "")	return TRUE;
	while (strpos($value, "  ") !== FALSE)
		$value = str_replace("  ", " ", $value);
	$value = trim($value);
	$arDT = explode(" ", $value);
	if (count($arDT) > 0) {
		$sep = "\\$sep";
		switch ($format) {
			case "std":
				$pattern = '/^([0-9]{4})' . $sep . '([0]?[1-9]|[1][0-2])' . $sep . '([0]?[1-9]|[1|2][0-9]|[3][0|1])$/';
				break;
			case "us":
				$pattern = '/^([0]?[1-9]|[1][0-2])' . $sep . '([0]?[1-9]|[1|2][0-9]|[3][0|1])' . $sep . '([0-9]{4})$/';
				break;
			case "euro":
				$pattern = '/^([0]?[1-9]|[1|2][0-9]|[3][0|1])' . $sep . '([0]?[1-9]|[1][0-2])' . $sep . '([0-9]{4})$/';
				break;
		}
		if (!preg_match($pattern, $arDT[0])) return FALSE;
		$arD = explode(EW_DATE_SEPARATOR, $arDT[0]);
		switch ($format) {
			case "std":
				$sYear = $arD[0];
				$sMonth = $arD[1];
				$sDay = $arD[2];
				break;
			case "us":
				$sYear = $arD[2];
				$sMonth = $arD[0];
				$sDay = $arD[1];
				break;
			case "euro":
				$sYear = $arD[2];
				$sMonth = $arD[1];
				$sDay = $arD[0];
				break;
		}
		if (!ew_CheckDay($sYear, $sMonth, $sDay)) return FALSE;
	}
	if (count($arDT) > 1 && !ew_CheckTime($arDT[1])) return FALSE;
	return TRUE;
}

// Check Date format (yyyy/mm/dd)
function ew_CheckDate($value) {
	return ew_CheckDateEx($value, "std", EW_DATE_SEPARATOR);
}

// Check US Date format (mm/dd/yyyy)
function ew_CheckUSDate($value) {
	return ew_CheckDateEx($value, "us", EW_DATE_SEPARATOR);
}

// Check Euro Date format (dd/mm/yyyy)
function ew_CheckEuroDate($value) {
	return ew_CheckDateEx($value, "euro", EW_DATE_SEPARATOR);
}

// Check day
function ew_CheckDay($checkYear, $checkMonth, $checkDay) {
	$maxDay = 31;
	if ($checkMonth == 4 || $checkMonth == 6 ||	$checkMonth == 9 || $checkMonth == 11) {
		$maxDay = 30;
	} elseif ($checkMonth == 2)	{
		if ($checkYear % 4 > 0) {
			$maxDay = 28;
		} elseif ($checkYear % 100 == 0 && $checkYear % 400 > 0) {
			$maxDay = 28;
		} else {
			$maxDay = 29;
		}
	}
	return ew_CheckRange($checkDay, 1, $maxDay);
}

// Check integer
function ew_CheckInteger($value) {
	if (strval($value) == "")	return TRUE;
	return preg_match('/^\-?\+?[0-9]+$/', $value);
}

// Check number range
function ew_NumberRange($value, $min, $max) {
	if ((!is_null($min) && $value < $min) ||
		(!is_null($max) && $value > $max))
		return FALSE;
	return TRUE;
}

// Check number
function ew_CheckNumber($value) {
	if (strval($value) == "")	return TRUE;
	return is_numeric(trim($value));
}

// Check range
function ew_CheckRange($value, $min, $max) {
	if (strval($value) == "")	return TRUE;
	if (!ew_CheckNumber($value)) return FALSE;
	return ew_NumberRange($value, $min, $max);
}

// Check time
function ew_CheckTime($value) {
	if (strval($value) == "")	return TRUE;
	return preg_match('/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/', $value);
}

// Check US phone number
function ew_CheckPhone($value) {
	if (strval($value) == "")	return TRUE;
	return preg_match('/^\(\d{3}\) ?\d{3}( |-)?\d{4}|^\d{3}( |-)?\d{3}( |-)?\d{4}$/', $value);
}

// Check US zip code
function ew_CheckZip($value) {
	if (strval($value) == "")	return TRUE;
	return preg_match('/^\d{5}$|^\d{5}-\d{4}$/', $value);
}

// Check credit card
function ew_CheckCreditCard($value, $type="") {
	if (strval($value) == "")	return TRUE;
	$creditcard = array("visa" => "/^4\d{3}[ -]?\d{4}[ -]?\d{4}[ -]?\d{4}$/",
		"mastercard" => "/^5[1-5]\d{2}[ -]?\d{4}[ -]?\d{4}[ -]?\d{4}$/",
		"discover" => "/^6011[ -]?\d{4}[ -]?\d{4}[ -]?\d{4}$/",
		"amex" => "/^3[4,7]\d{13}$/",
		"diners" => "/^3[0,6,8]\d{12}$/",
		"bankcard" => "/^5610[ -]?\d{4}[ -]?\d{4}[ -]?\d{4}$/",
		"jcb" => "/^[3088|3096|3112|3158|3337|3528]\d{12}$/",
		"enroute" => "/^[2014|2149]\d{11}$/",
		"switch" => "/^[4903|4911|4936|5641|6333|6759|6334|6767]\d{12}$/");
	if (empty($type))	{
		$match = FALSE;
		foreach ($creditcard as $type => $pattern) {
			if (@preg_match($pattern, $value) == 1) {
				$match = TRUE;
				break;
			}
		}
		return ($match) ? ew_CheckSum($value) : FALSE;
	}	else {
		if (!preg_match($creditcard[strtolower(trim($type))], $value)) return FALSE;
		return ew_CheckSum($value);
	}
}

// Check sum
function ew_CheckSum($value) {
	$value = str_replace(array('-',' '), array('',''), $value);
	$checksum = 0;
	for ($i=(2-(strlen($value) % 2)); $i<=strlen($value); $i+=2)
		$checksum += (int)($value[$i-1]);
  for ($i=(strlen($value)%2)+1; $i <strlen($value); $i+=2) {
	  $digit = (int)($value[$i-1]) * 2;
		$checksum += ($digit < 10) ? $digit : ($digit-9);
  }
	return ($checksum % 10 == 0);
}

// Check US social security number
function ew_CheckSSC($value) {
	if (strval($value) == "")	return TRUE;
	return preg_match('/^(?!000)([0-6]\d{2}|7([0-6]\d|7[012]))([ -]?)(?!00)\d\d\3(?!0000)\d{4}$/', $value);
}

// Check emails
function ew_CheckEmailList($value, $email_cnt) {
	if (strval($value) == "")	return TRUE;
	$emailList = str_replace(",", ";", $value);
	$arEmails = explode(";", $emailList);
	$cnt = count($arEmails);
	if ($cnt > $email_cnt && $email_cnt > 0)
		return FALSE;
	foreach ($arEmails as $email) {
		if (!ew_CheckEmail($email))
			return FALSE;
	}
	return TRUE;
}

// Check email
function ew_CheckEmail($value) {
	if (strval($value) == "")	return TRUE;

	//return preg_match('/^[A-Za-z0-9\._\-+]+@[A-Za-z0-9_\-+]+(\.[A-Za-z0-9_\-+]+)+$/', trim($value));
	return preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$/i', trim($value));
}

// Check GUID
function ew_CheckGUID($value) {
	if (strval($value) == "")	return TRUE;
	$p1 = '/^{{1}([0-9a-fA-F]){8}-([0-9a-fA-F]){4}-([0-9a-fA-F]){4}-([0-9a-fA-F]){4}-([0-9a-fA-F]){12}}{1}$/';
	$p2 = '/^([0-9a-fA-F]){8}-([0-9a-fA-F]){4}-([0-9a-fA-F]){4}-([0-9a-fA-F]){4}-([0-9a-fA-F]){12}$/';
	return preg_match($p1, $value) || preg_match($p2, $value);
}

// Check file extension
function ew_CheckFileType($value) {
	if (strval($value) == "") return TRUE;
	$extension = substr(strtolower(strrchr($value, ".")), 1);
	$allowExt = explode(",", strtolower(EW_UPLOAD_ALLOWED_FILE_EXT));
	return (in_array($extension, $allowExt) || trim(EW_UPLOAD_ALLOWED_FILE_EXT) == "");
}

// Check empty string
function ew_EmptyStr($value) {
	$str = strval($value);
	$str = str_replace("&nbsp;", "", $str);
	return (trim($str) == "");
}

// Check empty file
function ew_Empty($value) {
	return is_null($value);
}

// Check by preg
function ew_CheckByRegEx($value, $pattern) {
	if (strval($value) == "")	return TRUE;
	return preg_match($pattern, $value);
}

// include shared code
include "ewshared7.php";
?>
