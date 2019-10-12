<?php
error_reporting(0);
error_reporting(E_ERROR);
session_start();
include_once "message.php";
//echo "my timezone is ".$_SESSION["Member"]["TimeZone"];
if (isset($_SESSION["Member"]["TimeZone"])) {
    date_default_timezone_set($_SESSION["Member"]["TimeZone"]);
} else {


    if (!ini_get('date.timezone')) {
        date_default_timezone_set("Asia/Dubai");
    }
}

date_default_timezone_set("Asia/Dubai");
function sec_session_start() {
$session_name = 'sec_session_id';   // Set a custom session name
$secure = SECURE;
// This stops JavaScript being able to access the session id.
$httponly = true;
// Forces sessions to only use cookies.
if (ini_set('session.use_only_cookies', 1) === FALSE) {
    header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
    exit();
}
// Gets current cookies params.
$cookieParams = session_get_cookie_params();
session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
// Sets the session name to the one set above.
session_name($session_name);
session_start();            // Start the PHP session 
session_regenerate_id();    // regenerated the session, delete the old one. 
}

$yr = gmdate('Y');
$mm = gmdate('m');
$dd = gmdate('d');
$todaydate = $yr . "-" . $mm . "-" . $dd;

$todaycaldate = $dd . "/" . $mm . "/" . $yr;


define('DATE_STAMP', $todaydate);
define('TIME_STAMP', time());
define('CONST_ACTIVE', 1);
define('CONST_INACTIVE', 2);

 
  //  Member Level Constants

define('CONST_ADMIN', 1);
define('CONST_OWNER', 2);
define('CONST_MANAGER', 3);
define('CONST_BASICUSER', 4);


  
define('SITE_URL', 'http://arthirsty.com');
define('SITE_ADMIN_URL', 'http://arthirsty.com/admin');

define('ROOT_DIR', dirname(__FILE__));
define('ROOT_URL', substr($_SERVER['PHP_SELF'], 0, - (strlen($_SERVER['SCRIPT_FILENAME']) - strlen(ROOT_DIR))));


define('FolderName' , '');

define ('ROOT_PATH' , $_SERVER['DOCUMENT_ROOT']);

//    CLASSES PATH
define ('DATABASE_PATH' , '/libraries/database.php');
define('DATEFUNCTION_PATH', '/libraries/datefunctions.php');
define('GENERAL_PATH', '/libraries/generalfunction.php');
define('SESSION_PATH', '/libraries/session.php');
define('CARBON_PATH', '/carbon/autoload.php');

 
define('COMPANY_PATH','/company/model/clsCompany.php');
define('MEMBER_PATH','/member/model/clsMember.php');
define('CONTACT_PATH','/contact/model/clsContact.php');
define('SERVICE_PATH','/products/model/clsService.php');
define('ORDER_PATH','/orders/model/clsOrder.php');
define('TASK_PATH','/task/model/clsTask.php');

define('TYPEINFO_PATH','/typeinfo/model/clsTypeInfo.php');


//include_once($_SERVER['DOCUMENT_ROOT']."/constant/user-constants.php");


define("ORDERPAGING",1);

define("CONSTCOMPANY",10);
define("CONSTCONTACT",20);
define("CONSTORDER",30);
define("CONSTTASK",40);

define("FIELD_TEXTBOX",10);
define("FIELD_SELECT",20);
define("FIELD_CHECKBOX",30);
define("FIELD_RADIO",40);


define("CONSTYES",1);
define("CONSTNO",2);

define("CONSTMALE",1);
define("CONSTFEMALE",2);

define("CONSTALL",10);
define("CONSTSELF",20);
define("CONSTNONE",30);


 //  DEFINE  STATUS 

define("CONSTNEW",1);
define("CONSTACTIVE",2);
define("CONSTINACTIVE",3);
define("CONSTPENDING",4);


define("THUMBNILIMAGE" ,"/member/attachment/memberpics/" );




include_once($_SERVER['DOCUMENT_ROOT']."/constant/all-constants.php");
include_once($_SERVER['DOCUMENT_ROOT']."/constant/newproject-config.php");


?>