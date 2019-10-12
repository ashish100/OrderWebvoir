<?php 
include_once($_SERVER['DOCUMENT_ROOT']."/constant/config.php");
//include_once($_SERVER['DOCUMENT_ROOT'] . FolderName . GENERAL_PATH);
 
 include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-header.php");
 include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-navheader.php");

   $glbFOOTERJSFILE[] =  '/member/view/function.js';

?>

<div id="page-wrapper">
    <div class="row">
       <div class="col-lg-12">
          <h1 class="page-header">Add Member</h1>
        </div>
                <!-- /.col-lg-12 -->
     </div>
            <!-- /.row -->
   <div class="row">
     <div class="col-lg-12">
          <div class="panel panel-default">
             <div class="panel-heading">
                Add Member
          </div>
   <div class="panel-body">
     <div class="row">
 <div class="col-lg-6">
    <form id="frmAddMember" name="frmAddMember" method="post" >
       <div class="form-group">
            <label>Member Level </label>
              <select class="form-control" name="drpMemberLevel" id="drpMemberLevel"  >
                <option value="">Select Level </option>
                <option value="<?php echo  CONST_ADMIN ?>">Admin</option>
                <option value="<?php echo  CONST_OWNER ?>">Owner</option>
                <option value="<?php echo  CONST_MANAGER ?>">Manager</option>
                <option value="<?php echo  CONST_BASICUSER ?>">Executive</option>
              </select>    
        </div>

        <div class="form-group">
            <label>Member Title</label>
              <input type="text" class="form-control" name="txtMemberTitle" id="txtMemberTitle" value="" >    
        </div>

        <div class="form-group">
            <label>Member Name</label>
              <input type="text" class="form-control" name="txtMemberName" id="txtMemberName" value="" >    
        </div>

         <div class="form-group">
            <label>Member Login id</label>
              <input type="text" class="form-control" name="txtMemberEmail" id="txtMemberEmail" value="" >    
        </div>

        <div class="form-group">
            <label>Member Password</label>
              <input type="password" class="form-control" name="txtMemberPassword" id="txtMemberPassword" value="" >    
        </div>
        
        <div class="form-group">
            <label>Member Designation</label>
              <input type="text" class="form-control" name="txtMemberDesignation" id="txtMemberDesignation" value="" >
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

         

         <input type="hidden" name="action" value="add-member">

         
           <button type="submit" align = "center" id="btnAddMember" class="btn btn-default">Submit</button>
         <button type="reset" align = "center" class="btn btn-default">Reset</button>
    
    </form>
</div>
 

 <?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-footer.php"); ?>