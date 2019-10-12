<?php 
include_once($_SERVER['DOCUMENT_ROOT']."/constant/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . FolderName . MEMBER_PATH);
 
 
 $objMember = new clsMember();

  // echo "ajax file";
  //  exit();  

if ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')
{

   if ($_POST['action'] == "add-member")
   {
	   echo $objMember->addMember($_POST);
   }

  if ($_POST['action'] == "login-member")
   {
	   echo $objMember->loginMember($_POST);
   }

   if ($_POST['action'] == "edit-member")
   {
	   echo $objMember->editMember($_POST);
   }

  if ($_POST['action'] == "add-permission")
   {
      // echo "ajax file";
      // exit();
     echo $objMember->addMemberPermission($_POST);
   }   

  if ($_POST['action'] == "send-message")
   {
     echo $objMember->SaveMessage($_POST);
   }   



 if ($_POST['action'] == "add-memberinfo")
   {
     echo $objMember->addMemberInfo($_POST);
   }
 

 

}                                                     // end of server xml statment


?>