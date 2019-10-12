<?php
session_start();
include_once($_SERVER['DOCUMENT_ROOT']."/constant/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . FolderName . SESSION_PATH);
 
 session_unset();
 session_destroy();

 header("location:/member/view/login-member.php");


?>