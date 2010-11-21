<?php
require_once('../inc/conf.php');
/**
 * PHPMaker 7 configuration file
 */

// Show SQL for debug
define("EW_DEBUG_ENABLED", FALSE, TRUE); // TRUE to debug

// General
define("EW_IS_WINDOWS", (strtolower(substr(PHP_OS, 0, 3)) === 'win'), TRUE); // Is Windows OS
define("EW_IS_PHP5", (phpversion() >= "5.0.0"), TRUE); // Is PHP 5 or later
define("EW_PATH_DELIMITER", ((EW_IS_WINDOWS) ? "\\" : "/"), TRUE); // Physical path delimiter
define("EW_ROOT_RELATIVE_PATH", ".", TRUE); // Relative path of app root
define("EW_DEFAULT_DATE_FORMAT", "yyyy/mm/dd", TRUE); // Default date format
define("EW_DEFAULT_DATE_FORMAT_ID", "5", TRUE); // Default date format
define("EW_DATE_SEPARATOR", "/", TRUE); // Date separator
define("EW_PROJECT_NAME", "SEOStat", TRUE); // Project name
define("EW_RANDOM_KEY", '3FiiwhfLLnwl1fgi', TRUE); // Random key for encryption
define("EW_PROJECT_STYLESHEET_FILENAME", "seostat.css", TRUE); // Project stylesheet file name
define("EW_EMAIL_CHARSET", "", TRUE); // Email charset
define("EW_EMAIL_KEYWORD_SEPARATOR", "", TRUE); // Email keyword separator
define("EW_COMPOSITE_KEY_SEPARATOR", ",", TRUE); // Composite key separator
define("EW_HIGHLIGHT_COMPARE", TRUE, TRUE); // Highlight compare mode, TRUE(case-insensitive)|FALSE(case-sensitive)
define("EW_RECORD_DELIMITER", "\r", TRUE); // Record delimiter for Ajax
define("EW_FIELD_DELIMITER", "|", TRUE); // Field delimiter for Ajax
define('EW_USE_DOM_XML', FALSE, TRUE);
define('ADODB_OUTP', 'ew_SetDebugMsg', TRUE);

// Database connection info
define("EW_CONN_HOST", $dbhost, TRUE);
define("EW_CONN_PORT", 3306, TRUE);
define("EW_CONN_USER", $dbuser, TRUE);
define("EW_CONN_PASS", $dbpasswd, TRUE);
define("EW_CONN_DB", $dbname, TRUE);

// ADODB (Access/SQL Server)
define("EW_CODEPAGE", 0, TRUE); // Code page

/**
 * Character encoding
 * Note: If you use non English languages, you need to set character encoding
 * for some features. Make sure either iconv functions or multibyte string
 * functions are enabled and your encoding is supported. See PHP manual for
 * details.
 */
define("EW_ENCODING", "", TRUE); // Character encoding

// Database
define("EW_IS_MSACCESS", FALSE, TRUE); // Access
define("EW_IS_MSSQL", FALSE, TRUE); // SQL Server
define("EW_IS_MYSQL", TRUE, TRUE); // MySQL
define("EW_IS_POSTGRESQL", FALSE, TRUE); // PostgreSQL
define("EW_DB_QUOTE_START", "`", TRUE);
define("EW_DB_QUOTE_END", "`", TRUE);
define("EW_SELECT_LIMIT", (EW_IS_MYSQL || EW_IS_POSTGRESQL), TRUE);

/**
 * MySQL charset (for SET NAMES statement, not used by default)
 * Note: Read http://dev.mysql.com/doc/refman/5.0/en/charset-connection.html
 * before using this setting.
 */
define("EW_MYSQL_CHARSET", "", TRUE);

/**
 * Password (MD5 and case-sensitivity)
 * Note: If you enable MD5 password, make sure that the passwords in your
 * user table are stored as MD5 hash (32-character hexadecimal number) of the
 * clear text password. If you also use case-insensitive password, convert the
 * clear text passwords to lower case first before calculating MD5 hash.
 * Otherwise, existing users will not be able to login. MD5 hash is
 * irreversible, password will be reset during password recovery.
 */
define("EW_MD5_PASSWORD", TRUE, TRUE); // Use MD5 password
define("EW_CASE_SENSITIVE_PASSWORD", FALSE, TRUE); // Case-sensitive password

/**
 * Remove XSS
 * Note: If you want to allow these keywords, remove them from the following EW_XSS_ARRAY at your own risks.
*/
define("EW_REMOVE_XSS", TRUE, TRUE);
$EW_XSS_ARRAY = array('javascript', 'vbscript', 'expression', '<applet', '<meta', '<xml', '<blink', '<link', '<style', '<script', '<embed', '<object', '<iframe', '<frame', '<frameset', '<ilayer', '<layer', '<bgsound', '<title', '<base',
'onabort', 'onactivate', 'onafterprint', 'onafterupdate', 'onbeforeactivate', 'onbeforecopy', 'onbeforecut', 'onbeforedeactivate', 'onbeforeeditfocus', 'onbeforepaste', 'onbeforeprint', 'onbeforeunload', 'onbeforeupdate', 'onblur', 'onbounce', 'oncellchange', 'onchange', 'onclick', 'oncontextmenu', 'oncontrolselect', 'oncopy', 'oncut', 'ondataavailable', 'ondatasetchanged', 'ondatasetcomplete', 'ondblclick', 'ondeactivate', 'ondrag', 'ondragend', 'ondragenter', 'ondragleave', 'ondragover', 'ondragstart', 'ondrop', 'onerror', 'onerrorupdate', 'onfilterchange', 'onfinish', 'onfocus', 'onfocusin', 'onfocusout', 'onhelp', 'onkeydown', 'onkeypress', 'onkeyup', 'onlayoutcomplete', 'onload', 'onlosecapture', 'onmousedown', 'onmouseenter', 'onmouseleave', 'onmousemove', 'onmouseout', 'onmouseover', 'onmouseup', 'onmousewheel', 'onmove', 'onmoveend', 'onmovestart', 'onpaste', 'onpropertychange', 'onreadystatechange', 'onreset', 'onresize', 'onresizeend', 'onresizestart', 'onrowenter', 'onrowexit', 'onrowsdelete', 'onrowsinserted', 'onscroll', 'onselect', 'onselectionchange', 'onselectstart', 'onstart', 'onstop', 'onsubmit', 'onunload');

// Session names
define("EW_SESSION_STATUS", EW_PROJECT_NAME . "_status", TRUE); // Login status
define("EW_SESSION_USER_NAME", EW_SESSION_STATUS . "_UserName", TRUE); // User name
define("EW_SESSION_USER_ID", EW_SESSION_STATUS . "_UserID", TRUE); // User ID
define("EW_SESSION_USER_PROFILE", EW_SESSION_STATUS . "_UserProfile", TRUE); // User profile
define("EW_SESSION_USER_PROFILE_USER_NAME", EW_SESSION_USER_PROFILE . "_UserName", TRUE);
define("EW_SESSION_USER_PROFILE_PASSWORD", EW_SESSION_USER_PROFILE . "_Password", TRUE);
define("EW_SESSION_USER_PROFILE_LOGIN_TYPE", EW_SESSION_USER_PROFILE . "_LoginType", TRUE);
define("EW_SESSION_USER_LEVEL_ID", EW_SESSION_STATUS . "_UserLevel", TRUE); // User Level ID
@define("EW_SESSION_USER_LEVEL", EW_SESSION_STATUS . "_UserLevelValue", TRUE); // User Level
define("EW_SESSION_PARENT_USER_ID", EW_SESSION_STATUS . "_ParentUserID", TRUE); // Parent User ID
define("EW_SESSION_SYS_ADMIN", EW_PROJECT_NAME . "_SysAdmin", TRUE); // System admin
define("EW_SESSION_AR_USER_LEVEL", EW_PROJECT_NAME . "_arUserLevel", TRUE); // User Level array
define("EW_SESSION_AR_USER_LEVEL_PRIV", EW_PROJECT_NAME . "_arUserLevelPriv", TRUE); // User Level privilege array
define("EW_SESSION_SECURITY", EW_PROJECT_NAME . "_Security", TRUE); // Security array
define("EW_SESSION_MESSAGE", EW_PROJECT_NAME . "_Message", TRUE); // System message
define("EW_SESSION_INLINE_MODE", EW_PROJECT_NAME . "_InlineMode", TRUE); // Inline mode

// Language settings
define("EW_LANGUAGE_FOLDER", "lang/", TRUE);
$EW_LANGUAGE_FILE = array();
$EW_LANGUAGE_FILE[] = array("en", "", "english.xml");
define("EW_LANGUAGE_DEFAULT_ID", "en", TRUE);
define("EW_SESSION_LANGUAGE_ID", EW_PROJECT_NAME . "_LanguageId", TRUE); // Language ID

// Data types
define("EW_DATATYPE_NUMBER", 1, TRUE);
define("EW_DATATYPE_DATE", 2, TRUE);
define("EW_DATATYPE_STRING", 3, TRUE);
define("EW_DATATYPE_BOOLEAN", 4, TRUE);
define("EW_DATATYPE_MEMO", 5, TRUE);
define("EW_DATATYPE_BLOB", 6, TRUE);
define("EW_DATATYPE_TIME", 7, TRUE);
define("EW_DATATYPE_GUID", 8, TRUE);
define("EW_DATATYPE_XML", 9, TRUE);
define("EW_DATATYPE_OTHER", 10, TRUE);

// Row types
define("EW_ROWTYPE_VIEW", 1, TRUE); // Row type view
define("EW_ROWTYPE_ADD", 2, TRUE); // Row type add
define("EW_ROWTYPE_EDIT", 3, TRUE); // Row type edit
define("EW_ROWTYPE_SEARCH", 4, TRUE); // Row type search
define("EW_ROWTYPE_MASTER", 5, TRUE);  // Row type master record
define("EW_ROWTYPE_AGGREGATEINIT", 6, TRUE); // Row type aggregate init
define("EW_ROWTYPE_AGGREGATE", 7, TRUE); // Row type aggregate

// Table parameters
define("EW_TABLE_REC_PER_PAGE", "RecPerPage", TRUE); // Records per page
define("EW_TABLE_START_REC", "start", TRUE); // Start record
define("EW_TABLE_PAGE_NO", "pageno", TRUE); // Page number
define("EW_TABLE_BASIC_SEARCH", "psearch", TRUE); // Basic search keyword
define("EW_TABLE_BASIC_SEARCH_TYPE","psearchtype", TRUE); // Basic search type
define("EW_TABLE_ADVANCED_SEARCH", "advsrch", TRUE); // Advanced search
define("EW_TABLE_SEARCH_WHERE", "searchwhere", TRUE); // Search where clause
define("EW_TABLE_WHERE", "where", TRUE); // Table where
define("EW_TABLE_WHERE_LIST", "where_list", TRUE); // Table where (list page)
define("EW_TABLE_ORDER_BY", "orderby", TRUE); // Table order by
define("EW_TABLE_ORDER_BY_LIST", "orderby_list", TRUE); // Table order by (list page)
define("EW_TABLE_SORT", "sort", TRUE); // Table sort
define("EW_TABLE_KEY", "key", TRUE); // Table key
define("EW_TABLE_SHOW_MASTER", "showmaster", TRUE); // Table show master
define("EW_TABLE_MASTER_TABLE", "MasterTable", TRUE); // Master table
define("EW_TABLE_MASTER_FILTER", "MasterFilter", TRUE); // Master filter
define("EW_TABLE_DETAIL_FILTER", "DetailFilter", TRUE); // Detail filter
define("EW_TABLE_RETURN_URL", "return", TRUE); // Return URL
define("EW_TABLE_EXPORT_RETURN_URL", "exportreturn", TRUE); // Export return URL

// Audit Trail
define("EW_AUDIT_TRAIL_TO_DATABASE", FALSE, TRUE); // Write audit trail to DB
define("EW_AUDIT_TRAIL_TABLE_NAME", "", TRUE); // Audit trail table name
define("EW_AUDIT_TRAIL_FIELD_NAME_DATETIME", "", TRUE); // Audit trail DateTime field name
define("EW_AUDIT_TRAIL_FIELD_NAME_SCRIPT", "", TRUE); // Audit trail Script field name
define("EW_AUDIT_TRAIL_FIELD_NAME_USER", "", TRUE); // Audit trail User field name
define("EW_AUDIT_TRAIL_FIELD_NAME_ACTION", "", TRUE); // Audit trail Action field name
define("EW_AUDIT_TRAIL_FIELD_NAME_TABLE", "", TRUE); // Audit trail Table field name
define("EW_AUDIT_TRAIL_FIELD_NAME_FIELD", "", TRUE); // Audit trail Field field name
define("EW_AUDIT_TRAIL_FIELD_NAME_KEYVALUE", "", TRUE); // Audit trail Key Value field name
define("EW_AUDIT_TRAIL_FIELD_NAME_OLDVALUE", "", TRUE); // Audit trail Old Value field name
define("EW_AUDIT_TRAIL_FIELD_NAME_NEWVALUE", "", TRUE); // Audit trail New Value field name

// Security
define("EW_ADMIN_USER_NAME", $admin_username, TRUE); // Administrator user name
define("EW_ADMIN_PASSWORD", $admin_passwd, TRUE); // Administrator password

// Dynamic User Level tables
$EW_USER_LEVEL_TABLE_NAME = array();
$EW_USER_LEVEL_TABLE_CAPTION = array(); // For compatibility with PHP Report Maker 3 only
$EW_USER_LEVEL_TABLE_NAME[] = 'tbl_backlink_stat';
$EW_USER_LEVEL_TABLE_VAR[] = 'tbl_backlink_stat';
$EW_USER_LEVEL_TABLE_NAME[] = 'tbl_facebook_stat';
$EW_USER_LEVEL_TABLE_VAR[] = 'tbl_facebook_stat';
$EW_USER_LEVEL_TABLE_NAME[] = 'tbl_ga_stat';
$EW_USER_LEVEL_TABLE_VAR[] = 'tbl_ga_stat';
$EW_USER_LEVEL_TABLE_NAME[] = 'tbl_group';
$EW_USER_LEVEL_TABLE_VAR[] = 'tbl_group';
$EW_USER_LEVEL_TABLE_NAME[] = 'tbl_group_profile';
$EW_USER_LEVEL_TABLE_VAR[] = 'tbl_group_profile';
$EW_USER_LEVEL_TABLE_NAME[] = 'tbl_index_stat';
$EW_USER_LEVEL_TABLE_VAR[] = 'tbl_index_stat';
$EW_USER_LEVEL_TABLE_NAME[] = 'tbl_profile';
$EW_USER_LEVEL_TABLE_VAR[] = 'tbl_profile';
$EW_USER_LEVEL_TABLE_NAME[] = 'tbl_rank_stat';
$EW_USER_LEVEL_TABLE_VAR[] = 'tbl_rank_stat';
$EW_USER_LEVEL_TABLE_NAME[] = 'tbl_target';
$EW_USER_LEVEL_TABLE_VAR[] = 'tbl_target';
$EW_USER_LEVEL_TABLE_NAME[] = 'tbl_twitter_stat';
$EW_USER_LEVEL_TABLE_VAR[] = 'tbl_twitter_stat';
$EW_USER_LEVEL_TABLE_NAME[] = 'v_backlink_before_last_date';
$EW_USER_LEVEL_TABLE_VAR[] = 'v_backlink_before_last_date';
$EW_USER_LEVEL_TABLE_NAME[] = 'v_backlink_last_date';
$EW_USER_LEVEL_TABLE_VAR[] = 'v_backlink_last_date';
$EW_USER_LEVEL_TABLE_NAME[] = 'v_dashboard';
$EW_USER_LEVEL_TABLE_VAR[] = 'v_dashboard';
$EW_USER_LEVEL_TABLE_NAME[] = 'v_facebook_before_last_date';
$EW_USER_LEVEL_TABLE_VAR[] = 'v_facebook_before_last_date';
$EW_USER_LEVEL_TABLE_NAME[] = 'v_facebook_last_date';
$EW_USER_LEVEL_TABLE_VAR[] = 'v_facebook_last_date';
$EW_USER_LEVEL_TABLE_NAME[] = 'v_ga_before_last_date';
$EW_USER_LEVEL_TABLE_VAR[] = 'v_ga_before_last_date';
$EW_USER_LEVEL_TABLE_NAME[] = 'v_ga_last_date';
$EW_USER_LEVEL_TABLE_VAR[] = 'v_ga_last_date';
$EW_USER_LEVEL_TABLE_NAME[] = 'v_ga_stat_daily';
$EW_USER_LEVEL_TABLE_VAR[] = 'v_ga_stat_daily';
$EW_USER_LEVEL_TABLE_NAME[] = 'v_index_before_last_date';
$EW_USER_LEVEL_TABLE_VAR[] = 'v_index_before_last_date';
$EW_USER_LEVEL_TABLE_NAME[] = 'v_index_last_date';
$EW_USER_LEVEL_TABLE_VAR[] = 'v_index_last_date';
$EW_USER_LEVEL_TABLE_NAME[] = 'v_rank_before_last_date';
$EW_USER_LEVEL_TABLE_VAR[] = 'v_rank_before_last_date';
$EW_USER_LEVEL_TABLE_NAME[] = 'v_rank_last_date';
$EW_USER_LEVEL_TABLE_VAR[] = 'v_rank_last_date';
$EW_USER_LEVEL_TABLE_NAME[] = 'v_twitter_before_last_date';
$EW_USER_LEVEL_TABLE_VAR[] = 'v_twitter_before_last_date';
$EW_USER_LEVEL_TABLE_NAME[] = 'v_twitter_last_date';
$EW_USER_LEVEL_TABLE_VAR[] = 'v_twitter_last_date';
$EW_USER_LEVEL_TABLE_NAME[] = 'tbl_user';
$EW_USER_LEVEL_TABLE_VAR[] = 'tbl_user';
for ($i = 0; $i < 25; $i++)
	$EW_USER_LEVEL_TABLE_CAPTION[] = ''; // Blank, use $Language object

// Compatibility with PHP Report Maker 3 only
define("EW_REPORT_USER_LEVEL_INCLUDE_FILE", "ewruserlevel.php", TRUE);
if (file_exists(EW_REPORT_USER_LEVEL_INCLUDE_FILE)) {
	$rptuserlevel = '';
	if ($handle = @fopen(EW_REPORT_USER_LEVEL_INCLUDE_FILE, 'r')) {
		$rptuserlevel = fread($handle, filesize(EW_REPORT_USER_LEVEL_INCLUDE_FILE));
		fclose($handle);
	}
	$rptuserlevel = str_replace(array('<?php', '?>'), array('', ''), $rptuserlevel);
	if (defined("EW_REPORT_TABLE_PREFIX"))
		$rptuserlevel = preg_replace('/define\("EW_REPORT_TABLE_PREFIX".*\);/i', '', $rptuserlevel);
	eval($rptuserlevel);
}

// Dynamic User Level settings
// User level definition table/field names

@define("EW_USER_LEVEL_TABLE", "`tbl_user_level`", TRUE);
@define("EW_USER_LEVEL_ID_FIELD", "`userlevelid`", TRUE);
@define("EW_USER_LEVEL_NAME_FIELD", "`userlevelname`", TRUE);

// User Level privileges table/field names
@define("EW_USER_LEVEL_PRIV_TABLE", "`tbl_user_level_permissions`", TRUE);
@define("EW_USER_LEVEL_PRIV_TABLE_NAME_FIELD", "`tablename`", TRUE);
@define("EW_USER_LEVEL_PRIV_USER_LEVEL_ID_FIELD", "`userlevelid`", TRUE);
@define("EW_USER_LEVEL_PRIV_PRIV_FIELD", "`permission`", TRUE);

// User level constants
define("EW_USER_LEVEL_COMPAT", TRUE, TRUE); // Use old User Level values. Comment out to use new User Level values (separate values for View/Search).
define("EW_ALLOW_ADD", 1, TRUE); // Add
define("EW_ALLOW_DELETE", 2, TRUE); // Delete
define("EW_ALLOW_EDIT", 4, TRUE); // Edit
@define("EW_ALLOW_LIST", 8, TRUE); // List
if (defined("EW_USER_LEVEL_COMPAT")) {
	define("EW_ALLOW_VIEW", 8, TRUE); // View
	define("EW_ALLOW_SEARCH", 8, TRUE); // Search
} else {
	define("EW_ALLOW_VIEW", 32, TRUE); // View
	define("EW_ALLOW_SEARCH", 64, TRUE); // Search
}
@define("EW_ALLOW_REPORT", 8, TRUE); // Report
@define("EW_ALLOW_ADMIN", 16, TRUE); // Admin

// Hierarchical User ID
@define("EW_USER_ID_IS_HIERARCHICAL", TRUE, TRUE); // Change to FALSE to show one level only

// Use subquery for master/detail
define("EW_USE_SUBQUERY_FOR_MASTER_USER_ID", FALSE, TRUE);

// User table filters
define("EW_USER_NAME_FILTER", "(`username` = '%u')",  TRUE);
define("EW_USER_ID_FILTER", "",  TRUE);
define("EW_USER_EMAIL_FILTER", "(`username` = '%e')",  TRUE);
define("EW_USER_ACTIVATE_FILTER", "",  TRUE);
define("EW_USER_PROFILE_FIELD_NAME", "",  TRUE);

// User Profile Constants
define("EW_USER_PROFILE_KEY_SEPARATOR", "=", TRUE);
define("EW_USER_PROFILE_FIELD_SEPARATOR", ",", TRUE);
define("EW_USER_PROFILE_SESSION_ID", "SessionID", TRUE);
define("EW_USER_PROFILE_LAST_ACCESSED_DATE_TIME", "LastAccessedDateTime", TRUE);
define("EW_USER_PROFILE_SESSION_TIMEOUT", 20, TRUE);
define("EW_USER_PROFILE_LOGIN_RETRY_COUNT", "LoginRetryCount", TRUE);
define("EW_USER_PROFILE_LAST_BAD_LOGIN_DATE_TIME", "LastBadLoginDateTime", TRUE);
define("EW_USER_PROFILE_MAX_RETRY", 3, TRUE);
define("EW_USER_PROFILE_RETRY_LOCKOUT", 20, TRUE);
define("EW_USER_PROFILE_LAST_PASSWORD_CHANGED_DATE", "LastPasswordChangedDate", TRUE);
define("EW_USER_PROFILE_PASSWORD_EXPIRE", 90, TRUE);

// Email
define("EW_EMAIL_COMPONENT", strtoupper("PHP"), TRUE);
define("EW_SMTP_SERVER", "localhost", TRUE); // SMTP server
define("EW_SMTP_SERVER_PORT", 25, TRUE); // SMTP server port
define("EW_SMTP_SERVER_USERNAME", "", TRUE); // SMTP server user name
define("EW_SMTP_SERVER_PASSWORD", "", TRUE); // SMTP server password
define("EW_SENDER_EMAIL", "", TRUE); // Sender email address
define("EW_RECIPIENT_EMAIL", "", TRUE); // Recipient email address
define("EW_MAX_EMAIL_RECIPIENT", 3, TRUE);
define("EW_MAX_EMAIL_SENT_COUNT", 3, TRUE);
define("EW_EXPORT_EMAIL_COUNTER", EW_SESSION_STATUS . "_EmailCounter", TRUE);

// File upload
define("EW_UPLOAD_DEST_PATH", "", TRUE); // Upload destination path (relative to app root)
define("EW_UPLOAD_ALLOWED_FILE_EXT", "gif,jpg,jpeg,bmp,png,doc,xls,pdf,zip", TRUE); // Allowed file extensions
define("EW_IMAGE_ALLOWED_FILE_EXT", "gif,jpg,png,bmp", TRUE); // Allowed file extensions for images
define("EW_MAX_FILE_SIZE", 2000000, TRUE); // Max file size
define("EW_THUMBNAIL_DEFAULT_WIDTH", 0, TRUE); // Thumbnail default width
define("EW_THUMBNAIL_DEFAULT_HEIGHT", 0, TRUE); // Thumbnail default height
define("EW_THUMBNAIL_DEFAULT_QUALITY", 75, TRUE); // Thumbnail default qualtity (JPEG)
define("EW_UPLOADED_FILE_MODE", 0666, TRUE); // Uploaded file mode
define("EW_UPLOAD_TMP_PATH", "", TRUE); // User upload temp path (relative to app root) e.g. "tmp/"

// Audit trail
define("EW_AUDIT_TRAIL_PATH", "", TRUE); // Audit trail path (relative to app root)

// Export records
define("EW_EXPORT_ALL", TRUE, TRUE); // Export all records
define("EW_XML_ENCODING", "utf-8", TRUE); // Encoding for Export to XML
define("EW_EXPORT_ORIGINAL_VALUE", FALSE, TRUE);
define("EW_EXPORT_FIELD_CAPTION", FALSE, TRUE); // TRUE to export field caption
define("EW_EXPORT_CSS_STYLES", TRUE, TRUE); // TRUE to export CSS styles

// Use token in URL (reserved, not used, do NOT change!)
define("EW_USE_TOKEN_IN_URL", FALSE, TRUE);

/**
 * Search multi value option
 * 1 - no multi value
 * 2 - AND all multi values
 * 3 - OR all multi values
*/
define("EW_SEARCH_MULTI_VALUE_OPTION", 3, TRUE);

// Validate option
define("EW_CLIENT_VALIDATE", TRUE, TRUE);
define("EW_SERVER_VALIDATE", FALSE, TRUE);

// Blob field byte count for hash value calculation
define("EW_BLOB_FIELD_BYTE_COUNT", 200, TRUE);

// Checkbox and radio button groups
define("EW_ITEM_TEMPLATE_CLASSNAME", "ewTemplate", TRUE);
define("EW_ITEM_TABLE_CLASSNAME", "ewItemTable", TRUE);

/**
 * Numeric and monetary formatting options
 * Set EW_USE_DEFAULT_LOCALE to TRUE to override localeconv and use the
 * following constants for ew_FormatCurrency/Number/Percent functions
 * Also read http://www.php.net/localeconv for description of the constants
*/
@define("EW_USE_DEFAULT_LOCALE", FALSE, TRUE);
@define("DEFAULT_DECIMAL_POINT", ".", TRUE);
@define("DEFAULT_THOUSANDS_SEP", ",", TRUE);
@define("DEFAULT_CURRENCY_SYMBOL", "$", TRUE);
@define("DEFAULT_MON_DECIMAL_POINT", ".", TRUE);
@define("DEFAULT_MON_THOUSANDS_SEP", ",", TRUE);
@define("DEFAULT_POSITIVE_SIGN", "", TRUE);
@define("DEFAULT_NEGATIVE_SIGN", "-", TRUE);
@define("DEFAULT_FRAC_DIGITS", 2, TRUE);
@define("DEFAULT_P_CS_PRECEDES", TRUE, TRUE);
@define("DEFAULT_P_SEP_BY_SPACE", FALSE, TRUE);
@define("DEFAULT_N_CS_PRECEDES", TRUE, TRUE);
@define("DEFAULT_N_SEP_BY_SPACE", FALSE, TRUE);
@define("DEFAULT_P_SIGN_POSN", 3, TRUE);
@define("DEFAULT_N_SIGN_POSN", 3, TRUE);

// Cookies
define("EW_COOKIE_EXPIRY_TIME", time() + 365*24*60*60, TRUE); // Change cookie expiry time here

/**
 * Time zone (Note: Requires PHP 5 >= 5.1.0)
 * Read http://www.php.net/date_default_timezone_set for details
 * and http://www.php.net/timezones for supported time zones
*/
if (function_exists("date_default_timezone_set"))
	date_default_timezone_set("GMT"); // Note: Change the timezone_identifier here

//
// Global variables
//

if (!isset($conn)) {

	// Common objects
	$conn = NULL; // Connection
	$rs = NULL; // Recordset
	$Page = NULL; // Page
	$Language = NULL; // Language	
	$rsdtl = NULL;
	$Security = NULL; // Security
	$UserProfile = NULL; // User profile
	$objForm = NULL; // Form
	$ListOptions = NULL; // List options

	// Current language
	$gsLanguage = "";

	// Used by ValidateForm/ValidateSearch
	$gsFormError = ""; // Form error message
	$gsSearchError = ""; // Search form error message

	// Used by *master.php
	$gsMasterReturnUrl = "";

	// Used by header.php, export checking
	$gsExport = "";
	$gsExportFile = "";

	// Email error message
	$gsEmailErrDesc = "";

	// Debug message
	$gsDebugMsg = "";

	// Debug timer
	$gsTimer = NULL;
}
?>
