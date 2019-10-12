<?php
$SiteDbName = "webvotsk_orderdb";
$SiteDbUser = "webvotsk_aboutu";
$SiteDbPassword = "about234@#";
$SiteUrl ="http://order.webvoir.com /";
$yr = gmdate('Y');
$mm = gmdate('m');
$dd = gmdate('d');
$curcaldate = $yr."-".$mm."-".$dd;
$mysqli = new mysqli("localhost", $SiteDbUser,$SiteDbPassword, $SiteDbName);
//echo "error number " .$mysqli->connect_errno;
$txt = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
$dbdate =  date('l jS \of F Y h:i:s A');
if($mysqli->connect_errno > 0){
    $txt =  $txt."  ipadress ".$_SERVER['REMOTE_ADDR']." error page ".$dbdate."--error--".$mysqli->connect_error ."<br/>";
    $myfile = file_put_contents('salesdesklogs.txt', $txt.PHP_EOL , FILE_APPEND);
   echo "<script>  window.location.reload();</script>";
 
    exit();
    //die('Unable to connect to database [' . $mysqli->connect_error . ']');
}else
{
    $txt =  $txt."  ipadress ".$_SERVER['REMOTE_ADDR']." dbdate  ".$dbdate ;
    $myfile = file_put_contents('salesdesklogs.txt', $txt.PHP_EOL , FILE_APPEND);
}




$db = new PDO("mysql:host=localhost;dbname=$SiteDbName;charset=utf8","$SiteDbUser", "$SiteDbPassword");

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);




?>