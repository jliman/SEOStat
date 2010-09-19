<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php

// Get resize parameters
$resize = (@$_GET["resize"] <> "");
$width = (@$_GET["width"] <> "") ? $_GET["width"] : 0;
$height = (@$_GET["height"] <> "") ? $_GET["height"] : 0;
if (@$_GET["width"] == "" && @$_GET["height"] == "") {
	$width = EW_THUMBNAIL_DEFAULT_WIDTH;
	$height = EW_THUMBNAIL_DEFAULT_HEIGHT;
}
$quality = (@$_GET["quality"] <> "") ? $_GET["quality"] : EW_THUMBNAIL_DEFAULT_QUALITY;

// Resize image from physical file
if (@$_GET["fn"] <> "") {
	$fn = ew_StripSlashes($_GET["fn"]);
	$fn = str_replace("\0", "", $fn);
	$fn = ew_PathCombine(ew_AppRoot(), $fn, TRUE); // P7
	if (file_exists($fn)) {
		$pathinfo = pathinfo($fn);
		$ext = strtolower($pathinfo['extension']);
		if (in_array($ext, explode(',', EW_IMAGE_ALLOWED_FILE_EXT))) {
			$size = getimagesize($fn);
			if ($size)
				header("Content-type: {$size['mime']}");
			echo ew_ResizeFileToBinary($fn, $width, $height, $quality);
		}
	}
	exit();
} else { // Display image from Session
	if (@$_GET["tbl"] <> "") {
		$tbl = $_GET["tbl"];
	} else {
		exit();
	}
	if (@$_GET["fld"] <> "") {
		$fld = $_GET["fld"];
	} else {
		exit();
	}

	// Get blob field
	$obj = new cUpload($tbl, $fld);
	$obj->RestoreFromSession();
	if (is_null($obj->Value))
		exit();

	// If not IE, get the content type
	if (strpos(ew_ServerVar("HTTP_USER_AGENT"), "MSIE") === FALSE) {
		$tmpfname = tempnam(ew_TmpFolder(), 'tmp');
		$handle = fopen($tmpfname, "w");
		fwrite($handle, $obj->Value);
		fclose($handle);
		$size = getimagesize($tmpfname);
		if ($size)
			header("Content-type: {$size['mime']}");
		@unlink($tmpfname);
	}
	if ($resize)
		$obj->Resize($width, $height, $quality);
	echo $obj->Value;
	exit();
}
?>
