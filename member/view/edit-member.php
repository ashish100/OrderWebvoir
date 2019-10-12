<?php 
include_once($_SERVER['DOCUMENT_ROOT']."/constant/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . FolderName . MEMBER_PATH);
 
 include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-header.php");
 include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-navheader.php");

   $glbFOOTERJSFILE[] =  '/member/view/function.js';

    $objMember = new clsMember();

     $MemUID = $_GET['memberuid'];
     
     $arrFilter['MemberUID'] = $MemUID;

   $arrMemberData = $objMember->getAllMember($arrFilter);

      

?>

<div id="page-wrapper">
    <div class="row">
       <div class="col-lg-12">
          <h1 class="page-header">Update Member</h1>
        </div>
                <!-- /.col-lg-12 -->
     </div>
            <!-- /.row -->
   <div class="row">
     <div class="col-lg-12">
          <div class="panel panel-default">
             <div class="panel-heading">
                Update Member
          </div>
   <div class="panel-body">
     <div class="row">
 <div class="col-lg-6">

    <form id="frmEditMember" name="frmEditMember" method="post" >
       <div class="form-group">
            <label>Member Level </label>
              <select class="form-control" name="drpMemberLevel" id="drpMemberLevel"  >
                <option value="">Select Level </option>
                <option value="<?php echo  CONST_ADMIN ?>">Administrator</option>
                <option value="<?php echo  CONST_OWNER ?>">Owner</option>
                <option value="<?php echo  CONST_MANAGER ?>">Manager</option>
                <option value="<?php echo  CONST_BASICUSER ?>">Executive</option>
              </select>    
        </div>

        <div class="form-group">
            <label>Member Title</label>
              <input type="text" class="form-control" name="txtMemberTitle" id="txtMemberTitle" value="<?php echo $arrMemberData[0]['member_title'] ?>" >    
        </div>

        <div class="form-group">
            <label>Member Name</label>
              <input type="text" class="form-control" name="txtMemberName" id="txtMemberName" value="<?php echo $arrMemberData[0]['member_name'] ?>" >    
        </div>

         <div class="form-group">
            <label>Member Login id</label>
              <input type="text" class="form-control" name="txtMemberEmail" id="txtMemberEmail" value="<?php echo $arrMemberData[0]['member_loginid'] ?>" >    
        </div>

        <div class="form-group">
            <label>Member Password</label>
              <input type="password" class="form-control" name="txtMemberPassword" id="txtMemberPassword" value="<?php echo $arrMemberData[0]['member_password'] ?>" >    
        </div>
        
        <div class="form-group">
            <label>Member Designation</label>
              <input type="text" class="form-control" name="txtMemberDesignation" id="txtMemberDesignation" value="<?php echo $arrMemberData[0]['member_designation'] ?>" >
        </div>

        
        
        <div class="form-group">
            <label>Member Status</label>
              <select class="form-control" name="drpMemberStatus" id="drpMemberStatus"  >
                <option value="">Select Status </option>
                <option value="<?php echo CONSTMEMBERNEW ?>">New </option>
                <option value="<?php echo CONSTMEMBERPENDING ?>">Pending</option>
                <option value="<?php echo CONSTMEMBERACTIVE ?>">Active</option>
                <option value="<?php echo CONSTMEMBERINACTIVE ?>">InActive</option>
              </select>    
        </div>

          <input type="hidden" name="hidMemberUID" value="<?php echo $MemUID ?>">

         <input type="hidden" name="action" value="edit-member">

         
           <button type="submit" align = "center" id="btnEditMember" class="btn btn-default">Submit</button>
         <button type="reset" align = "center" class="btn btn-default">Reset</button>
    
    </form>
</div>
 


 <?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-footer.php"); ?>

 <script type="text/javascript">
    
   $(document).ready(function(){

    $("#drpMemberLevel").val('<?php echo $arrMemberData[0]['member_level'] ?>');
    $("#drpMemberStatus").val('<?php echo $arrMemberData[0]['member_status'] ?>');

   }); 

  </script>