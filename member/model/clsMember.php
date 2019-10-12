<?php 
include_once($_SERVER['DOCUMENT_ROOT']."/constant/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . FolderName . DATABASE_PATH);
include_once($_SERVER['DOCUMENT_ROOT'] . FolderName . GENERAL_PATH);
include_once($_SERVER['DOCUMENT_ROOT'] . FolderName . SESSION_PATH);


class clsMember
{
  public $DB;
  public $general;
  public $session; 

  function  __construct()
  {
      global $db;
   $this->DB = $db;
   $this->general = new objGeneral();
   $this->session = new clsSession();

}


function addMember($form)
{

   $arr = array();

 $MemberUID = $this->general->getUniqueID();
   
$Query = "insert into tbl_member(`member_name`,`member_uid`,`member_loginid`,`member_password`,`member_level`,`member_addeddate`,`member_designation`,`member_title`,`member_status`,`member_assignstatus`) values(:INMemberName,:INMemberUID,:INMemberEmail,:INMemberPassword,:INMemberLevel,:INMemberAddedDate,:INMemberDesignat,:INMemberTitle,:INMemberStatus,:INMemberAssignStatus ) ";

 $stmt = $this->DB->prepare($Query);

  $arr['INMemberName'] = trim($form['txtMemberName']);
  $arr['INMemberUID'] = trim($MemberUID);
  $arr['INMemberEmail'] = trim($form['txtMemberEmail']);
  $arr['INMemberPassword'] = trim($form['txtMemberPassword']);
  $arr['INMemberLevel'] = $form['drpMemberLevel'];
  $arr['INMemberAddedDate'] = date("Y-m-d");
  $arr['INMemberDesignat'] =  trim($form['txtMemberDesignation']);
  $arr['INMemberTitle'] = trim($form['txtMemberTitle']);
  $arr['INMemberStatus'] = trim($form['drpMemberStatus']);

  $arr['INMemberAssignStatus'] = AVAILCARYES;     //  MEMBER AVAILIABLE (ASSIGNED) STATUS 
   
   $stmt->execute($arr);
    
     return "1";

}



function getAllMember($arrFilter)
{

  $arr = array();

 $Query = "select member_id,`member_name`,`member_uid`,`member_loginid`,`member_password`,`member_level`,`member_addeddate`,`member_designation`,`member_title`,`member_status`,member_assignstatus ,member_projectinfo,member_expenseadvance, `memberinfo_memberuid`,`memberinfo_contactno`,`memberinfo_address`,`memberinfo_city`,`memberinfo_joindate`,`memberinfo_salary`,`memberinfo_perdaysalary`,`memberinfo_image`,project_title from tbl_member 
 left join tbl_memberinfo on member_uid = memberinfo_memberuid 
 left join tbl_projects on member_uid = project_owneruid 
   where 1=1";


  if (!empty($arrFilter['MemberUID']))
  {
     $Query .= "  and member_uid = :INMemberUID ";
     $arr['INMemberUID'] = $arrFilter['MemberUID'];
  }

  if (!empty($arrFilter['level']))
  {
     $Query .= "  and member_level != :INMemberLevel ";
     $arr['INMemberLevel'] = $arrFilter['level'];
  }


  if (!empty($arrFilter['assignStatus']))
  {
     $Query .= "   and member_assignstatus = :INMemberAssignStatus ";
      $arr['INMemberAssignStatus'] = $arrFilter['assignStatus'];
  }
  

   $stmt = $this->DB->prepare($Query);

//echo  $this->general->interpolateQuery($Query,  $arr);

   $stmt->execute($arr);

    $result = $stmt->fetchAll();

    return $result;


}


 function getMemberLevel($typeid)
 {
     $key = -1;
     $arr = array("Admin" => CONST_ADMIN , "Owner" => CONST_OWNER, "Manager" => CONST_MANAGER,"Executive" => CONST_BASICUSER );

    $key = array_search($typeid, $arr);

    if($key == -1)
    {
      $key = "--"; 
    }
  
  return $key;

}


function loginMember($form)
{
  
 $arr = array(); 

 $Query = "select member_name,member_uid,member_loginid,member_level,member_designation,member_title,permission_companypermission,permission_contactpermission,permission_orderpermission,member_projectinfo,member_expenseadvance  from tbl_member left join tbl_memberpermission on member_uid = permission_memberuid 
   where member_loginid = :INMemberEmail and member_password = :INMemberPassword  ";

     $stmt = $this->DB->prepare($Query);
      
      $arr['INMemberEmail'] = trim($form["txtLoginID"]);
      $arr['INMemberPassword'] = $form["txtLoginPassword"];

     $stmt->execute($arr); 

     $result = $stmt->fetchAll();

     $counthere = $stmt->rowCount();
 
          //$arrFilter['password'] = $result[0]['member_password'];

         $arrFilter['name'] = $result[0]['member_name'];
         $arrFilter['email'] = $result[0]['member_email'];
         $arrFilter['designation'] = $result[0]['member_designation'];  
         $arrFilter['uid'] = $result[0]['member_uid']; 
          $arrFilter['level'] = $result[0]['member_level'];
          $arrFilter['cmpPermission'] = $result[0]['permission_companypermission'];
          $arrFilter['contPermission'] = $result[0]['permission_contactpermission'];
          $arrFilter['orderPermission'] = $result[0]['permission_orderpermission'];
          $arrFilter['ProjectInfo'] = $result[0]['member_projectinfo'];
          $arrFilter['PreExpenAdvance'] = $result[0]['member_expenseadvance'];
               
                //print_r($arrFilter);

        
      if ($counthere > 0)
      {
            //print_r($arrFilter);

            $this->session->setMemberSession($arrFilter);
           
             return "1";    
      }

       else
       {
          return  $msg = "Login Details are Mismatch";

       }


}


   function editMember($form)
   {
      $arr = array();

  $Query = "update tbl_member set member_name = :INMemberName,member_title = :INMemberTitle,member_level = :INMemberLevel,member_designation = :INMemberDesignat,member_password = :INMemberPassword,member_loginid = :INMemberLoginID , member_status = :INMemberStatus where member_uid = :INMemberUID ";

     $stmt = $this->DB->prepare($Query);

      $arr['INMemberName'] = trim($form['txtMemberName']);
      $arr['INMemberTitle'] = trim($form['txtMemberTitle']);
      $arr['INMemberLevel'] = trim($form['drpMemberLevel']);
      $arr['INMemberDesignat'] = trim($form['txtMemberDesignation']);
      $arr['INMemberPassword'] = trim($form['txtMemberPassword']);
      $arr['INMemberLoginID'] = trim($form['txtMemberEmail']);
      $arr['INMemberStatus'] = trim($form['drpMemberStatus']);
      $arr['INMemberUID'] = trim($form['hidMemberUID']);

        $stmt->execute($arr);

        return "1";

   }


  function addMemberPermission($form)
  {
    $arr = array();
  
   $Query = "select `permission_memberuid`,`permission_companypermission`,`permission_contactpermission`,`permission_orderpermission`,`permission_addedby`,`permission_addeddate`,permission_otherpermission from tbl_memberpermission where 1=1 ";

      if (!empty($arrFilter['memberUID']))
      {
         $Query .= "   and permission_memberuid = :INPermMemberUNIQ";
          $arr['INPermMemberUNIQ'] = $arrFilter['memberUID'];
      }

     $stmt = $this->DB->prepare($Query);

       $stmt->execute($arr);

     $result = $stmt->fetchAll();
   
       $CountResult = $stmt->rowCount();

          
   if ($CountResult > 0)
   {

      $arr = array();

    $CompanyPerm = $form['drpCmpCreate'] ."||". $form['drpCmpView'] ."||". $form['drpCmpUpdate'];
    $ContactPerm = $form['drpContCreate'] ."||". $form['drpContView'] ."||". $form['drpContUpdate'];
    $OrderPerm = $form['drpOrderCreate'] ."||". $form['drpOrderView'] ."||". $form['drpOrderUpdate'];

  $Query = "update tbl_memberpermission set permission_companypermission = :INCompPermission ,permission_contactpermission = :INContPermission, permission_orderpermission = :INOrderPermission, permission_addedby = :INPermAddedBy, permission_addeddate = :INPermAddedDate, permission_otherpermission = :INOtherPermission where permission_memberuid = :INPermMemberUID ";

   $stmt = $this->DB->prepare($Query);
    
    $arr['INPermMemberUID'] = trim($form['drpMembers']);
    $arr['INCompPermission'] = trim($CompanyPerm);
    $arr['INContPermission'] = trim($ContactPerm);
    $arr['INOrderPermission'] = trim($OrderPerm);
    $arr['INOtherPermission'] = trim($form['drpOtherPerm']);
    $arr['INPermAddedBy'] = trim($this->session->getMemberUID());
    $arr['INPermAddedDate'] = date('Y-m-d');
    
      $stmt->execute($arr);
     
     return "1";

   }

  else{

    $arr = array();

    $CompanyPerm = $form['drpCmpCreate'] ."||". $form['drpCmpView'] ."||". $form['drpCmpUpdate'];
    $ContactPerm = $form['drpContCreate'] ."||". $form['drpContView'] ."||". $form['drpContUpdate'];
    $OrderPerm = $form['drpOrderCreate'] ."||". $form['drpOrderView'] ."||". $form['drpOrderUpdate'];

  $Query = "insert into tbl_memberpermission(`permission_memberuid`,`permission_companypermission`,`permission_contactpermission`,`permission_orderpermission`,`permission_addedby`,`permission_addeddate`,`permission_otherpermission`)  values(:INPermMemberUID , :INCompPermission,:INContPermission,:INOrderPermission,:INPermAddedBy,:INPermAddedDate , :INOtherPermission ) ";

   $stmt = $this->DB->prepare($Query);
    
    $arr['INPermMemberUID'] = trim($form['drpMembers']);
    $arr['INCompPermission'] = trim($CompanyPerm);
    $arr['INContPermission'] = trim($ContactPerm);
    $arr['INOrderPermission'] = trim($OrderPerm);
    $arr['INOtherPermission'] = trim($form['drpOtherPerm']);
    $arr['INPermAddedBy'] = trim($this->session->getMemberUID());
    $arr['INPermAddedDate'] = date('Y-m-d');
    
      $stmt->execute($arr);
     
     return "1";
 
   }
 

 }


 function getMemberPermission($arrFilter)
 {
    $arr = array();

    $Query = "select member_name,member_uid,member_level,`permission_memberuid`,`permission_companypermission`,`permission_contactpermission`,`permission_orderpermission`,`permission_addedby`,`permission_addeddate` from tbl_memberpermission left join tbl_member on permission_memberuid = member_uid where 1=1 ";

      if (!empty($arrFilter['memberUID']))
      {
         $Query .= "   and permission_memberuid = :INPermMemberUNIQ";
          $arr['INPermMemberUNIQ'] = $arrFilter['memberUID'];
      }

     $stmt = $this->DB->prepare($Query);

       $stmt->execute($arr);

     $result = $stmt->fetchAll();

       return $result;

 }



 function SaveMessage($form)
 {

  $arr = array();
 
  $Query = "insert into tbl_messages(`msg_title`,`msg_messagedata`,`msg_receiveruid`,`msg_senderuid`,`msg_objectuid`,`msg_objtype`,`msg_status`,`msg_sendingdate`)  values(:INMsgTitle , :INMsgText,:INMsgReceiverUID,:INMsgSenderUID,:INMsgObjUID,:INMsgObjType,:INMsgStatus,:INMsgSendDate)";

   $stmt = $this->DB->prepare($Query);
    
    $arr['INMsgTitle'] = trim($form['txtMsgTitle']);
    $arr['INMsgText'] = trim($form['txtMsgText']);
    $arr['INMsgReceiverUID'] = trim($form['hidReciverUniqID']);
    $arr['INMsgSenderUID'] = trim($this->session->getMemberUID());
    $arr['INMsgSendDate'] = date('Y-m-d');
     $arr['INMsgObjUID'] = trim($form['hidObjUniqID']);
    $arr['INMsgObjType'] = trim($form['hidObjType']);
    $arr['INMsgStatus'] =  10;
    
      $stmt->execute($arr);
     
     return "1";



 }


function viewMessage($arrFilter)
 {
    $arr = array();

    $Query = "select `msg_title`,`msg_messagedata`,`msg_receiveruid`,`msg_senderuid`,`msg_objectuid`,`msg_objtype`,`msg_status`,`msg_sendingdate`,member_name from tbl_messages left join tbl_member on msg_senderuid = member_uid where 1=1 ";

      if (!empty($arrFilter['ObjUniqID']))
      {
         $Query .= "   and msg_objectuid = :INObjUNIQID";
          $arr['INObjUNIQID'] = $arrFilter['ObjUniqID'];
      }

      // if (!empty($arrFilter['ObjType']))
      // {
      //    $Query .= "   and msg_objtype = :INObjTYPE";
      //     $arr['INObjTYPE'] = $arrFilter['ObjType'];
      // }

     $stmt = $this->DB->prepare($Query);

       $stmt->execute($arr);

     $result = $stmt->fetchAll();

       return $result;

 }


function getPermName($typeid)
 {
     $key = -1;
     $arr = array("All" => CONSTALL , "Self" => CONSTSELF, "None" => CONSTNONE,"Yes" => CONSTYES,"No" => CONSTNO);

    $key = array_search($typeid, $arr);

    if($key == -1)
    {
      $key = "--"; 
    }
  
  return $key;

}



function getMemberLevelType($typeid)
 {
     $key = -1;
     $arr = array("Level1" => CONSTNEWLEVEL1 , "Level2" => CONSTNEWLEVEL2, "Level3" => CONSTNEWLEVEL3, "Level4" => CONSTNEWLEVEL4 );

    $key = array_search($typeid, $arr);

    if($key == -1)
    {
      $key = "--"; 
    }
  
  return $key;

}



function getMemberStatusType($typeid)
 {
     $key = -1;
     $arr = array("Active" => CONSTMEMBERACTIVE , "InActive" => CONSTMEMBERINACTIVE,"Pending" => CONSTMEMBERPENDING , "Complete" => CONSTMEMBERCOMPLETE,"New" => CONSTMEMBERNEW );

    $key = array_search($typeid, $arr);

    if($key == -1)
    {
      $key = "--"; 
    }
  
  return $key;

}


 function getOtherInfoMember($arrFilter)
 {
   $arr = array();

   $Query = "select `memberinfo_memberuid`,`memberinfo_contactno`,`memberinfo_address`,`memberinfo_city`,`memberinfo_joindate`,`memberinfo_salary`,`memberinfo_perdaysalary`,`memberinfo_image`,`memberinfo_addedby`,`memberinfo_addeddate` from tbl_memberinfo where 1=1 ";

  
       if (!empty($arrFilter['MemberUID']))
       {
          $Query .= "   and memberinfo_memberuid = :INMemberUNIQ  ";
          $arr['INMemberUNIQ'] = trim($arrFilter['MemberUID']);
       }

      $stmt = $this->DB->prepare($Query);
  
  // echo  $this->general->interpolateQuery($Query,  $arr);
    
      $stmt->execute($arr);

   $result =  $stmt->fetchAll();

      return $result;


 }




function addMemberInfo($form)
{
   $arr = array();  

    if (!empty($form['hid_file'])) {
        foreach ($form['hid_file'] as $FileName) {
          $logoFiles .= $FileName . "||";
        }
        $logoFiles = rtrim($logoFiles, "||");
      } else {
        $logoFiles = "";
      }

   
      $arrFilter['MemberUID'] = trim($form['hidMemberUID']);

     $arrMemberInfo = $this->getOtherInfoMember($arrFilter);

      $countInfo = count($arrMemberInfo);

  if ($countInfo > 0)
  {
       $Query = "update tbl_memberinfo set memberinfo_contactno = :INInfoMemberContact,memberinfo_address = :INInfoMemberAddress,memberinfo_city = :INInfoCity,memberinfo_joindate = :INInfoJoinDate,memberinfo_salary = :INInfoSalary,memberinfo_perdaysalary = :INInfoPerDaySalary,memberinfo_image = :INInfoImage,memberinfo_addedby = :INInfoAddedBy,memberinfo_addeddate = :INInfoAddedDate  where memberinfo_memberuid = :INInfoMemberUID ";

        $stmt = $this->DB->prepare($Query);

  }

  else{
  
  $Query = "insert into tbl_memberinfo(`memberinfo_memberuid`,`memberinfo_contactno`,`memberinfo_address`,`memberinfo_city`,`memberinfo_joindate`,`memberinfo_salary`,`memberinfo_perdaysalary`,`memberinfo_image`,`memberinfo_addedby`,`memberinfo_addeddate`) values(:INInfoMemberUID,:INInfoMemberContact,:INInfoMemberAddress,:INInfoCity,:INInfoJoinDate,:INInfoSalary,:INInfoPerDaySalary,:INInfoImage,:INInfoAddedBy,:INInfoAddedDate) ";


     $stmt = $this->DB->prepare($Query);
   
   }

      $arr['INInfoMemberUID'] = trim($form['hidMemberUID']);
      $arr['INInfoMemberContact'] = trim($form['txtMemberContact']);
      $arr['INInfoMemberAddress'] = trim($form['txtMemberAddress']);
      $arr['INInfoCity'] = trim($form['txtMemberCity']); 
      $arr['INInfoJoinDate'] = trim($form['txtMemberJoinDate']);
      $arr['INInfoSalary'] = trim($form['txtMemberSalary']);
      $arr['INInfoPerDaySalary'] = trim($form['txtMemberPerDaySalary']);
      $arr['INInfoImage'] = trim($logoFiles);
      $arr['INInfoAddedBy'] = trim($this->session->getMemberUID()) ;
      $arr['INInfoAddedDate'] = date('Y-m-d');

          $stmt->execute($arr);

          return "1";

   

          



}










}                          //  end of class

?>