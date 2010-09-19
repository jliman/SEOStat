<?php

//
// Shared code for PHPMaker and PHP Report Maker
//

/**
 * Functions for converting encoding
 */
function ew_ConvertToUtf8($str) {
	return ew_Convert(EW_ENCODING, "UTF-8", $str);
}

function ew_ConvertFromUtf8($str) {
	return ew_Convert("UTF-8", EW_ENCODING, $str);
}

function ew_Convert($from, $to, $str) {
	if ($from != "" && $to != "" && strtoupper($from) != strtoupper($to)) {
		if (function_exists("iconv")) {
			return iconv($from, $to, $str);
		} elseif (function_exists("mb_convert_encoding")) {
			return mb_convert_encoding($str, $to, $from);
		} else {
			return $str;
		}
	} else {
		return $str;
	}
}

/**
 * Langauge class
 */
class cLanguage {
	var $LanguageId;
	var $Phrases = NULL;

	// Constructor
	function __construct() {
		global $gsLanguage;
		$this->LoadFileList(); // Set up file list
		if (@$_GET["language"] <> "") { // Set up language id
			$this->LanguageId = $_GET["language"];
			$_SESSION[EW_SESSION_LANGUAGE_ID] = $this->LanguageId;
		} elseif (@$_SESSION[EW_SESSION_LANGUAGE_ID] <> "") {
			$this->LanguageId = $_SESSION[EW_SESSION_LANGUAGE_ID];
		} else {
			$this->LanguageId = EW_LANGUAGE_DEFAULT_ID;
		}
		$gsLanguage = $this->LanguageId;
		$this->Load($this->LanguageId);
	}

	// Load language file list
	function LoadFileList() {
		global $EW_LANGUAGE_FILE;
		if (is_array($EW_LANGUAGE_FILE)) {
			$cnt = count($EW_LANGUAGE_FILE);
			for ($i = 0; $i < $cnt; $i++)
				$EW_LANGUAGE_FILE[$i][1] = $this->LoadFileDesc(EW_LANGUAGE_FOLDER . $EW_LANGUAGE_FILE[$i][2]);
		}
	}

	// Load language file description
	function LoadFileDesc($File) {
		if (EW_USE_DOM_XML) {
			$this->Phrases = new cXMLDocument();
			if ($this->Phrases->Load($File))
				return $this->GetNodeAtt($this->Phrases->DocumentElement(), "desc");
		} else {
			$ar =	ew_Xml2Array(substr(ew_ReadFile($File), 0, 512)); // Just read the first part
			return (is_array($ar)) ? @$ar['ew-language']['attr']['desc'] : "";
		}
	}

	// Load language file
	function Load($id) {
		$sFileName = $this->GetFileName($id);
		if ($sFileName == "")
			$sFileName = $this->GetFileName(EW_LANGUAGE_DEFAULT_ID);
		if ($sFileName == "")
			return;
		if (EW_USE_DOM_XML) {
			$this->Phrases = new cXMLDocument();
			$this->Phrases->Load($sFileName);
		} else {
			if (is_array(@$_SESSION[EW_PROJECT_NAME . "_" . $sFileName])) {
				$this->Phrases = $_SESSION[EW_PROJECT_NAME . "_" . $sFileName];
			} else {
				$this->Phrases = ew_Xml2Array(ew_ReadFile($sFileName));
			}
		}
	}

	// Get language file name
	function GetFileName($Id) {
		global $EW_LANGUAGE_FILE;
		if (is_array($EW_LANGUAGE_FILE)) {
			$cnt = count($EW_LANGUAGE_FILE);
			for ($i = 0; $i < $cnt; $i++)
				if ($EW_LANGUAGE_FILE[$i][0] == $Id) {
					return EW_LANGUAGE_FOLDER . $EW_LANGUAGE_FILE[$i][2];
			}
		}
		return "";
	}

	// Get node attribute
	function GetNodeAtt($Nodes, $Att) {
		$value = ($Nodes) ? $this->Phrases->GetAttribute($Nodes, $Att) : "";
		//return ew_ConvertFromUtf8($value);
		return $value;
	}

	// Get phrase
	function Phrase($Name) {
		if (is_object($this->Phrases)) {
			return $this->GetNodeAtt($this->Phrases->SelectSingleNode("//global/phrase[@id='" . strtolower($Name) . "']"), "value");
		} elseif (is_array($this->Phrases)) {
			return ew_ConvertFromUtf8(@$this->Phrases['ew-language']['global']['phrase'][strtolower($Name)]['attr']['value']);
		}
	}

	// Get project phrase
	function ProjectPhrase($Id) {
		if (is_object($this->Phrases)) {
			return $this->GetNodeAtt($this->Phrases->SelectSingleNode("//project/phrase[@id='" . strtolower($Id) . "']"), "value");
		} elseif (is_array($this->Phrases)) {
			return ew_ConvertFromUtf8(@$this->Phrases['ew-language']['project']['phrase'][strtolower($Id)]['attr']['value']);
		}
	}

	// Get menu phrase
	function MenuPhrase($MenuId, $Id) {
		if (is_object($this->Phrases)) {
			return $this->GetNodeAtt($this->Phrases->SelectSingleNode("//project/menu[@id='" . $MenuId . "']/phrase[@id='" . strtolower($Id) . "']"), "value");
		} elseif (is_array($this->Phrases)) {
			return ew_ConvertFromUtf8(@$this->Phrases['ew-language']['project']['menu'][$MenuId]['phrase'][strtolower($Id)]['attr']['value']);
		}
	}

	// Get table phrase
	function TablePhrase($TblVar, $Id) {
		if (is_object($this->Phrases)) {
			return $this->GetNodeAtt($this->Phrases->SelectSingleNode("//project/table[@id='" . strtolower($TblVar) . "']/phrase[@id='" . strtolower($Id) . "']"), "value");
		} elseif (is_array($this->Phrases)) {
			return ew_ConvertFromUtf8(@$this->Phrases['ew-language']['project']['table'][strtolower($TblVar)]['phrase'][strtolower($Id)]['attr']['value']);
		}
	}

	// Get field phrase
	function FieldPhrase($TblVar, $FldVar, $Id) {
		if (is_object($this->Phrases)) {
			return $this->GetNodeAtt($this->Phrases->SelectSingleNode("//project/table[@id='" . strtolower($TblVar) . "']/field[@id='" . strtolower($FldVar) . "']/phrase[@id='" . strtolower($Id) . "']"), "value");
		} elseif (is_array($this->Phrases)) {
			return ew_ConvertFromUtf8(@$this->Phrases['ew-language']['project']['table'][strtolower($TblVar)]['field'][strtolower($FldVar)]['phrase'][strtolower($Id)]['attr']['value']);
		}
	}

	// Output XML as JSON
	function XmlToJSON($XPath) {
		$NodeList = $this->Phrases->SelectNodes($XPath);
		$Str = "{";
		foreach ($NodeList as $Node) {
			$Id = $this->GetNodeAtt($Node, "id");
			$Value = $this->GetNodeAtt($Node, "value");
			$Str .= "\"" . ew_JsEncode2($Id) . "\":\"" . ew_JsEncode2($Value) . "\",";
		}
		if (substr($Str, -1) == ",") $Str = substr($Str, 0, strlen($Str)-1);
		$Str .= "}";
		return $Str;
	}
	
	// Output array as JSON
	function ArrayToJSON($client) {
		$ar = @$this->Phrases['ew-language']['global']['phrase'];
		$Str = "{";
		if (is_array($ar)) {
			foreach ($ar as $id => $node) {
				$is_client = @$node['attr']['client'] == '1';
				$value = ew_ConvertFromUtf8(@$node['attr']['value']);
				if (!$client || ($client && $is_client))
					$Str .= "\"" . ew_JsEncode2($id) . "\":\"" . ew_JsEncode2($value) . "\",";
			}
		}
		if (substr($Str, -1) == ",") $Str = substr($Str, 0, strlen($Str)-1);
		$Str .= "}";
		return $Str;
	}

	// Output all phrases as JSON
	function AllToJSON() {
		if (is_object($this->Phrases)) {
			return "var ewLanguage = new ew_Language(" . $this->XmlToJSON("//global/phrase") . ");";
		} elseif (is_array($this->Phrases)) {
			return "var ewLanguage = new ew_Language(" . $this->ArrayToJSON(FALSE) . ");";
		}
	}

	// Output client phrases as JSON
	function ToJSON() {
		if (is_object($this->Phrases)) {
			return "var ewLanguage = new ew_Language(" . $this->XmlToJSON("//global/phrase[@client='1']") . ");";
		} elseif (is_array($this->Phrases)) {
			return "var ewLanguage = new ew_Language(" . $this->ArrayToJSON(TRUE) . ");";
		}
	}

}

/**
 * XML document class
 */
class cXMLDocument {
	var $Encoding = "utf-8";
	var $RootTagName;
	var $RowTagName;
	var $XmlDoc = FALSE;
	var $XmlTbl;
	var $XmlRow;
	var $NullValue = 'NULL';

	function __construct($encoding = "") {
		if ($encoding <> "")
			$this->Encoding = $encoding;
		if (EW_IS_PHP5) {
			if ($this->Encoding <> "") {
				$this->XmlDoc = new DOMDocument("1.0", strval($this->Encoding));
			} else {
				$this->XmlDoc = new DOMDocument("1.0");
			}
		} else {
			if (function_exists("domxml_new_doc"))
				$this->XmlDoc = domxml_new_doc("1.0");
		}
	}

	function Load($filename) {
		$filepath = realpath($filename);
		if (EW_IS_PHP5) {
			return $this->XmlDoc->load($filepath);
		} else {
			if (function_exists("domxml_open_file"))
				$this->XmlDoc = domxml_open_file($filepath);
			return $this->XmlDoc;
		}
	}
	
	function &DocumentElement() {
		if (EW_IS_PHP5) {
			$de = $this->XmlDoc->documentElement;
		} else {
			$de = $this->XmlDoc->document_element();
		}
		return $de;
	}
	
	function GetAttribute($element, $name) {
		if (EW_IS_PHP5) {
			return ($element) ? ew_ConvertFromUtf8($element->getAttribute($name)) : "";
		} else {
			return ($element) ? ew_ConvertFromUtf8($element->get_attribute($name)) : "";
		}
	}
	
	function SelectSingleNode($query) {
		$elements = $this->SelectNodes($query);
		if (EW_IS_PHP5) {
			return ($elements->length > 0) ? $elements->item(0) : NULL;
		} else {
			return (count($elements) > 0) ? $elements[0] : NULL;
		}
	}
	
	function SelectNodes($query) {
		if (EW_IS_PHP5) {
			$xpath = new DOMXPath($this->XmlDoc);
			return $xpath->query($query);
		} else {
			$xpath = xpath_new_context($this->XmlDoc);
			$xpathobj = xpath_eval_expression($xpath, $query);
			return $xpathobj->nodeset;
		}
	}
	
	function AddRoot($roottagname = 'table') {
		$this->RootTagName = $roottagname;
		if (EW_IS_PHP5) {
			$this->XmlTbl = $this->XmlDoc->createElement($this->RootTagName);
			$this->XmlDoc->appendChild($this->XmlTbl);
		} else {
			$this->XmlTbl = $this->XmlDoc->create_element($this->RootTagName);
			$this->XmlDoc->append_child($this->XmlTbl);
		}
	}

	function AddRow($rowtagname = 'row') {
		$this->RowTagName = $rowtagname;
		if (EW_IS_PHP5) {
			$this->XmlRow = $this->XmlDoc->createElement($this->RowTagName);
			if ($this->XmlTbl)
				$this->XmlTbl->appendChild($this->XmlRow);
		} else {
			$this->XmlRow = $this->XmlDoc->create_element($this->RowTagName);
			if ($this->XmlTbl)
				$this->XmlTbl->append_child($this->XmlRow);
		}
	}

	function AddField($name, $value) {
		if (is_null($value)) $value = $this->NullValue;
		$value = ew_ConvertToUtf8($value); // Convert to UTF-8
		if (EW_IS_PHP5) {
			$xmlfld = $this->XmlDoc->createElement($name);
			$this->XmlRow->appendChild($xmlfld);
			$xmlfld->appendChild($this->XmlDoc->createTextNode($value));
		} else {
			$xmlfld = $this->XmlDoc->create_element($name);
			$this->XmlRow->append_child($xmlfld);
			$xmlfld->append_child($this->XmlDoc->create_text_node($value));
		}
	}

	function XML() {
		if (EW_IS_PHP5) {
			return $this->XmlDoc->saveXML();
		} else {
			if (phpversion() >= "4.3.0") {
				return $this->XmlDoc->dump_mem(TRUE, $this->Encoding);
			} else {
				return $this->XmlDoc->dump_mem($this->Encoding);
			}
		}
	}

}

/**
 * Menu class
 */
class cMenu {

	var $Id;
	var $IsRoot = FALSE;
	var $NoItem = NULL;
	var $ItemData = array();
	
	function __construct($id) {
		$this->Id = $id;
	}

	// Add a menu item
	function AddMenuItem($id, $text, $url, $parentid, $src, $allowed = TRUE) {
		$item = new cMenuItem($id, $text, $url, $parentid, $src, $allowed);

		// Fire MenuItem_Adding event
		if (function_exists("MenuItem_Adding") && !MenuItem_Adding($item))
			return;

		if ($item->ParentId < 0) {
			$this->AddItem($item);
		} else {
			if ($oParentMenu =& $this->FindItem($item->ParentId))
				$oParentMenu->AddItem($item);
		}
	}

	// Add item to internal array
	function AddItem($item) {
		$this->ItemData[] = $item;
	}

	// Find item
	function &FindItem($id) {
		$cnt = count($this->ItemData);
		for ($i = 0; $i < $cnt; $i++) {
			$item =& $this->ItemData[$i];
			if ($item->Id == $id) {
				return $item;
			} elseif (!is_null($item->SubMenu)) {
				if ($subitem =& $item->SubMenu->FindItem($id))
					return $subitem;
			}
		}
		return $this->NoItem;
	}

	// Check if a menu item should be shown
	function RenderItem($item) {
		if (!is_null($item->SubMenu)) {
			foreach ($item->SubMenu->ItemData as $subitem) {
				if ($item->SubMenu->RenderItem($subitem))
					return TRUE;
			}
		}
		return ($item->Allowed && $item->Url <> "");
	}
	
	// Check if this menu should be rendered
	function RenderMenu() {
		foreach ($this->ItemData as $item) {
			if ($this->RenderItem($item))
				return TRUE;
		}
		return FALSE;
	}

	// Render the menu
	function Render() {
		if (!$this->RenderMenu())
			return;
		echo "<ul";
		if ($this->Id <> "") {
			if (is_numeric($this->Id)) {
				echo " id=\"menu_" . $this->Id . "\"";
			} else {
				echo " id=\"" . $this->Id . "\"";
			}
		}
		if ($this->IsRoot)
			echo " class=\"" . EW_MENUBAR_CLASSNAME . "\"";
		echo ">\n";
		foreach ($this->ItemData as $item) {
			if ($this->RenderItem($item)) {
				echo "<li><a";
				if (!is_null($item->SubMenu) && $item->SubMenu->RenderMenu())
					echo " class=\"" . EW_MENUBAR_SUBMENU_CLASSNAME . "\"";
				if ($item->Url <> "")
					echo " href=\"" . htmlspecialchars(strval($item->Url)) . "\"";
				if ($item->Target <> "")
					echo " target=\"" . $item->Target . "\"";
				echo ">" . $item->Text . "</a>\n";
				if (!is_null($item->SubMenu))
					$item->SubMenu->Render();
				echo "</li>\n";
			}
		}
		echo "</ul>\n";
	}

}

// Menu item class
class cMenuItem {

	var $Id;
	var $Text;
	var $Url;
	var $ParentId; 
	var $SubMenu = NULL; // Data type = cMenu
	var $Source;
	var $Allowed = TRUE;
	var $Target;

	function __construct($id, $text, $url, $parentid, $src, $allowed) {
		$this->Id = $id;
		$this->Text = $text;
		$this->Url = $url;
		$this->ParentId = $parentid;
		$this->Source = $src;
		$this->Allowed = $allowed;
	}

	function AddItem($item) { // Add submenu item
		if (is_null($this->SubMenu))
			$this->SubMenu = new cMenu($this->Id);
		$this->SubMenu->AddItem($item);
	}

}

// Debug timer
class cTimer {
	var $StartTime;
	var $EndTime;
	
	function __construct($start = TRUE) {
		if ($start)
			$this->Start();
	}
	
	function GetTime() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
	
	// Get script start time
	function Start() {
		if (EW_DEBUG_ENABLED)
			$this->StartTime = $this->GetTime();
	}
	
	// display elapsed time (in seconds)
	function Stop() {
		if (EW_DEBUG_ENABLED)
			$this->EndTime = $this->GetTime();
		if (isset($this->EndTime) && isset($this->StartTime) &&
			$this->EndTime > $this->StartTime)
			echo '<p>Page processing time: ' . ($this->EndTime - $this->StartTime) . ' seconds</p>';
	}

}

// Convert XML to array
function ew_Xml2Array($contents) {
	if (!$contents) return array(); 
	
	if (!function_exists('xml_parser_create')) return FALSE;
	
	$get_attributes = 1; // Always get attributes. DO NOT CHANGE!

	// Get the XML Parser of PHP
	$parser = xml_parser_create();
	xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8"); // Always return in utf-8
	xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
	xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
	xml_parse_into_struct($parser, trim($contents), $xml_values);
	xml_parser_free($parser);
	
	if (!$xml_values) return;
	
	$xml_array = array();
	$parents = array();
	$opened_tags = array();
	$arr = array();
	
	$current = &$xml_array;
	
	$repeated_tag_index = array(); // Multiple tags with same name will be turned into an array
	
	foreach ($xml_values as $data) {
	
		unset($attributes, $value); // Remove existing values
		
		// Extract these variables into the foreach scope
		// tag(string), type(string), level(int), attributes(array)
		extract($data);
		
		$result = array();
		 
		if (isset($value))
			$result['value'] = $value; // Put the value in a assoc array
		
		// Set the attributes
		if (isset($attributes) and $get_attributes) {
			foreach ($attributes as $attr => $val)
				$result['attr'][$attr] = $val; // Set all the attributes in a array called 'attr'
		} 
		
		// See tag status and do the needed
		if ($type == "open") { // The starting of the tag '<tag>'
		
			$parent[$level-1] = &$current;
			if (!is_array($current) || !in_array($tag, array_keys($current))) { // Insert New tag
				if ($tag <> 'ew-language' && @$result['attr']['id'] <> '') { // 
					$last_item_index = $result['attr']['id'];
					$current[$tag][$last_item_index] = $result;
					$repeated_tag_index[$tag.'_'.$level] = 1;
					$current = &$current[$tag][$last_item_index];
				} else {
					$current[$tag] = $result;
					$repeated_tag_index[$tag.'_'.$level] = 0;
					$current = &$current[$tag];
				}
			} else { // Another element with the same tag name
				if ($repeated_tag_index[$tag.'_'.$level] > 0) { // If there is a 0th element it is already an array
					if (@$result['attr']['id'] <> '') {
						$last_item_index = $result['attr']['id'];
					} else {
						$last_item_index = $repeated_tag_index[$tag.'_'.$level];
					}
					$current[$tag][$last_item_index] = $result;
					$repeated_tag_index[$tag.'_'.$level]++;
				} else { // Make the value an array if multiple tags with the same name appear together
					$temp = $current[$tag];
					$current[$tag] = array();
					if (@$temp['attr']['id'] <> '') {
						$current[$tag][$temp['attr']['id']] = $temp;
					} else {
						$current[$tag][] = $temp;
					}
					if (@$result['attr']['id'] <> '') {
						$last_item_index = $result['attr']['id'];
					} else {
						$last_item_index = 1;
					}
					$current[$tag][$last_item_index] = $result;
					$repeated_tag_index[$tag.'_'.$level] = 2;
				} 
				$current = &$current[$tag][$last_item_index];
			}
		
		} elseif ($type == "complete") { // Tags that ends in one line '<tag />'
		
			if (!isset($current[$tag])) { // New key
				$current[$tag] = array(); // Always use array for "complete" type
				if (@$result['attr']['id'] <> '') {
					$current[$tag][$result['attr']['id']] = $result;
				} else {
					$current[$tag][] = $result;
				}
				$repeated_tag_index[$tag.'_'.$level] = 1;
			} else { // Existing key
				if (@$result['attr']['id'] <> '') {
			  	$current[$tag][$result['attr']['id']] = $result;
				} else {
					$current[$tag][$repeated_tag_index[$tag.'_'.$level]] = $result;
				}
			  $repeated_tag_index[$tag.'_'.$level]++;
			}
		
		} elseif ($type == 'close') { // End of tag '</tag>' 
			$current = &$parent[$level-1];
		}
	}
	 
	return($xml_array);
}

// Load file data
function ew_ReadFile($file) {
	$content = '';
	if (function_exists("file_get_contents")) {
		$content = file_get_contents($file);
	} else {
		if ($handle = @fopen($file, 'r')) {
			$content = fread($handle, filesize($file));
			fclose($handle);
		}
	}
	return $content;
}

// Encode value for double-quoted Javascript string
function ew_JsEncode2($val) {
	$val = str_replace("\\", "\\\\", strval($val));
	$val = str_replace("\"", "\\\"", $val);
	$val = str_replace("\r\n", "<br>", $val);
	$val = str_replace("\r", "<br>", $val);
	$val = str_replace("\n", "<br>", $val);
	return $val;
}

// Encode value to single-quoted Javascript string for HTML attributes
function ew_JsEncode3($val) {
	$val = str_replace("\\", "\\\\", strval($val));
	$val = str_replace("'", "\\'", $val);
	$val = str_replace("\"", "&quot;", $val);
	return $val;
}

// Convert array to JSON for HTML attributes
function ew_ArrayToJsonAttr($ar) {
	$Str = "{";
	foreach ($ar as $key => $val)
		$Str .= $key . ":'" . ew_JsEncode3($val) . "',";
	if (substr($Str, -1) == ",") $Str = substr($Str, 0, strlen($Str)-1);
	$Str .= "}";
	return $Str;
}

// Get current page name
function ew_CurrentPage() {
	return ew_GetPageName(ew_ScriptName());
}

// Get page name
function ew_GetPageName($url) {
	$PageName = "";
	if ($url <> "") {
		$PageName = $url;
		$p = strpos($PageName, "?");
		if ($p !== FALSE)
			$PageName = substr($PageName, 0, $p); // Remove QueryString
		$p = strrpos($PageName, "/");
		if ($p !== FALSE)
			$PageName = substr($PageName, $p+1); // Remove path
	}
	return $PageName;
}

// Adjust text for caption
function ew_BtnCaption($Caption) {
	$Min = 10;
	if (strlen($Caption) < $Min) {
		$Pad = abs(intval(($Min - strlen($Caption))/2*-1));
		$Caption = str_repeat(" ", $Pad) . $Caption . str_repeat(" ", $Pad);
	}
	return $Caption;
}

// Get current user levels as array of user level IDs
function CurrentUserLevels() {
	global $Security;
	if (isset($Security)) {
		return $Security->UserLevelID;
	} else {
		if (isset($_SESSION[EW_SESSION_USER_LEVEL_ID])) {
			return array($_SESSION[EW_SESSION_USER_LEVEL_ID]);
		} else {
			return array();
		}
	}
}

// Check if menu item is allowed for current user level
function AllowListMenu($TableName) {
	$userlevels = CurrentUserLevels(); // Get user level ID list as array
	if (IsLoggedIn()) {
		if (in_array("-1", $userlevels)) {
			return TRUE;
		} else {
			$priv = 0;
			if (is_array(@$_SESSION[EW_SESSION_AR_USER_LEVEL_PRIV])) {
				foreach ($_SESSION[EW_SESSION_AR_USER_LEVEL_PRIV] as $row) {
					if (strval($row[0]) == strval($TableName) &&
						in_array($row[1], $userlevels)) {
						$thispriv = $row[2];
						if (is_null($thispriv))
							$thispriv = 0;
						$thispriv = intval($thispriv);
						$priv = $priv | $thispriv;
					}
				}
			}
			return ($priv & EW_ALLOW_LIST);
		}
	} else {
		return FALSE;
	}
}

// Get server variable by name
function ew_ServerVar($Name) {
	$str = @$_SERVER[$Name];
	if (empty($str)) $str = @$_ENV[$Name];
	return $str;
}

// Get domain URL
function ew_DomainUrl() {
	$sUrl = "http";
	$bSSL = (ew_ServerVar("HTTPS") <> "" && ew_ServerVar("HTTPS") <> "off");
	$sPort = strval(ew_ServerVar("SERVER_PORT"));
	$defPort = ($bSSL) ? "443" : "80";
	$sPort = ($sPort == $defPort) ? "" : ":$sPort";
	$sUrl .= ($bSSL) ? "s" : "";
	$sUrl .= "://";
	$sUrl .= ew_ServerVar("SERVER_NAME") . $sPort;
	return $sUrl;
}

// Get full URL
function ew_FullUrl() {
	return ew_DomainUrl() . ew_ScriptName();
}

// Get current URL
function ew_CurrentUrl() {
	$s = ew_ScriptName();
	$q = ew_ServerVar("QUERY_STRING");
	if ($q <> "") $s .= "?" . $q;
	return $s;
}

// Convert to full URL
function ew_ConvertFullUrl($url) {
	if ($url == "") return "";
	$sUrl = ew_FullUrl();
	return substr($sUrl, 0, strrpos($sUrl, "/")+1) . $url;
}

?>
