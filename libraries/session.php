<?php
session_start();
 


class clsSession
{

   
   function setMemberSession($arrFilter)
   {
   	  $_SESSION['order']['memberuid'] = $arrFilter['uid'];
	    $_SESSION['order']['memberemail'] = $arrFilter['email'];
	    $_SESSION['order']['memberlevel'] = $arrFilter['level'];
      $_SESSION['order']['membername'] = $arrFilter['name'];
      $_SESSION['order']['memberdesignation'] = $arrFilter['designation'];

      list($MemProject,$MemCarID) = explode("||",$arrFilter['ProjectInfo']);
      
       $arrMemProjInfo = array('ProjectUniq'=>$MemProject,'CarId'=>$MemCarID );

     $_SESSION['order']['memberproject'] = $arrMemProjInfo;
     $_SESSION['order']['memberexpenadvance'] = $arrFilter['PreExpenAdvance'];
    
     // $_SESSION['order']['cmppermission'] = $arrFilter['cmpPermission'];    //   with extension of || 
     // $_SESSION['order']['contpermission'] = $arrFilter['contPermission'];
     // $_SESSION['order']['orderpermission'] = $arrFilter['orderPermission'];

    list($cmpAddPerm,$cmpViewPerm,$cmpEditPerm) = explode("||",$arrFilter['cmpPermission']);
    list($contAddPerm,$contViewPerm,$contEditPerm) = explode("||",$arrFilter['contPermission']);
    list($orderAddPerm,$orderViewPerm,$orderEditPerm) = explode("||",$arrFilter['orderPermission']);

       $arrPermissions = array("compCreate"=>$cmpAddPerm,"compView"=>$cmpViewPerm,"compEdit"=>$cmpEditPerm ,"contCreate"=>$contAddPerm,"contView"=>$contViewPerm,"contEdit"=>$contEditPerm,"orderAdd"=>$orderAddPerm,"orderView"=>$orderViewPerm,"orderEdit"=>$orderEditPerm );

      $_SESSION['order']['permissions'] = $arrPermissions;

   }

    function getMemberUID()
    {
    	return $_SESSION['order']['memberuid'] ;
    }

    function getMemberLevel()
    {
    	return $_SESSION['order']['memberlevel'] ;
    }

   function getMemberName()
   {
    	return $_SESSION['order']['membername'] ;
   }

    function getMemberEmail()
    {
    	return $_SESSION['order']['memberemail'] ;
    }


   function getPermissionArray()
   {
     return $_SESSION['order']['permissions'];
   }


   function getMemberProjectInfo()
   {
       return $_SESSION['order']['memberproject'];
   }


    function getMemberPreAdvance()
    {
       return $_SESSION['order']['memberexpenadvance'];
    }

    

  //  COMPANY PERMISSION

   // function getCompCreatePermission()               
   // {
   //    return  $_SESSION['order']['compCreatePermission'];
   // }

   // function getCompViewPermission()               
   // {
   //    return  $_SESSION['order']['compViewPermission'];   
   // }

   // function getCompUpdatePermission()               
   // {
   //    return  $_SESSION['order']['compEditPermission'];   
   // }

//    CONTACT PERMISSIONS

   // function getContCreatePermission()               
   // {
   //    return  $_SESSION['order']['contCreatePermission'];
   // }

   //  function getContViewPermission()               
   // {
   //    return  $_SESSION['order']['contViewPermission'];   
   // }

   // function getContUpdatePermission()               
   // {
   //    return  $_SESSION['order']['contEditPermission'];   
   // }


//  ORDER PERMISSIONS

   // function getOrderCreatePermission()               
   // {
   //    return  $_SESSION['order']['orderCreatePermission'];
   // }

   //  function getOrderViewPermission()               
   // {
   //    return  $_SESSION['order']['orderViewPermission'];   
   // }

   // function getOrderUpdatePermission()               
   // {
   //    return  $_SESSION['order']['orderEditPermission'];   
   // }



  
  function chkLoggedIN()
  {
     if (isset($_SESSION['order']['memberuid'])) 
     {
        return true;
     }
        return false;
  }





}           //  end of class