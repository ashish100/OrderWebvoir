<?php 
include_once($_SERVER['DOCUMENT_ROOT']."/constant/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . FolderName . MEMBER_PATH);
 
 include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-header.php");
 include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-navheader.php");

   $glbFOOTERJSFILE[] =  '/member/view/function.js';

  $objMember = new clsMember();
   
  $arrFilter = array();

   $arrFilter['level'] = CONST_ADMIN; 
    $arrMemberData = $objMember->getAllMember($arrFilter);
   
   foreach ($arrMemberData as $member)
 {
   $strMember .= '<option value="'.$member[member_uid].'">'.$member["member_name"].'</option> ';
 }


$arrFilter = array();

  if (isset($_POST['drpMembers']))
  {
     $INMemberUID = $_POST['drpMembers'];
      $arrFilter['memberUID'] = $INMemberUID;
  } 

   $arrMemberPermData = $objMember->getMemberPermission($arrFilter);
    
    $countMemberPerm = count($arrMemberPermData);

    if ($countMemberPerm > 0 )
    {
        foreach($arrMemberPermData as $perm)
        {
           $CompanyPerm = $perm['permission_companypermission'];

           list($createcmp,$viewcmp,$editcmp) = explode('||', $CompanyPerm);

           $ContactPerm = $perm['permission_contactpermission'];

           list($createcont,$viewcont,$editcont) = explode('||', $ContactPerm);

           $OrderPerm = $perm['permission_orderpermission'];

           list($createorder,$vieworder,$editorder) = explode('||', $OrderPerm);


        }

    }
  
   // echo "orderperm --->&nbsp;" .$createorder ."&nbsp;----->&nbsp;".$vieworder."&nbsp;---->&nbsp;" .$editorder;

?>

<div id="page-wrapper">
    <div class="row">
       <div class="col-lg-12">
          <h1 class="page-header">Member</h1>
        </div>
                <!-- /.col-lg-12 -->
     </div>
            <!-- /.row -->
   <div class="row">
     <div class="col-lg-12">
          <div class="panel panel-default">
             <div class="panel-heading">
                 Member Permission
          </div>
   <div class="panel-body">
     <div class="row">
 <div class="col-lg-6">
    <form id="frmMemberPermission" name="frmMemberPermission" method="post" >
       <div class="form-group">
            <label>Members </label>
              <select class="form-control" name="drpMembers" id="drpMembers"  onchange="this.form.submit()" >
                <option value="">Select Member </option>
                  <?php echo $strMember ?>
              </select>    
        </div>
 
   Company Permission
     <div class="modal-body">
        <div class="form-group">
            <label for="inputEmail3" class="col-md-4 col-lg-4 col-xs-12 col-sm-12 control-label ">Create Company </label>
            <div class="col-md-8 col-lg-8  col-xs-12 col-sm-12">
              <select class="form-control" name="drpCmpCreate" id="drpCmpCreate"  >
                <option value="">Select  </option>
                <option value="<?php echo CONSTYES ?>"> Yes </option>
                <option value="<?php echo CONSTNO ?>"> No </option> 
              </select>    
        </div>
      </div>
     </div>

     <div class="modal-body">   
        <div class="form-group">
          <label for="inputEmail3" class="col-md-4 col-lg-4 col-xs-12 col-sm-12 control-label ">View Company </label>
            <div class="col-md-8 col-lg-8  col-xs-12 col-sm-12"> 
              <select class="form-control" name="drpCmpView" id="drpCmpView"  >
                <option value="">Select  </option>
                <option value="<?php echo CONSTALL ?>"> All </option>
                <option value="<?php echo CONSTSELF ?>"> Self </option>
                <option value="<?php echo CONSTNONE ?>"> None </option> 
              </select> 
            </div>
        </div>
     </div>

      <div class="modal-body ">
        <div class="form-group">
            <label for="inputEmail3" class="col-md-4 col-lg-4 col-xs-12 col-sm-12 control-label ">Update Company </label>
            <div class="col-md-8 col-lg-8  col-xs-12 col-sm-12"> 
              <select class="form-control" name="drpCmpUpdate" id="drpCmpUpdate"  >
                <option value="">Select  </option>
                <option value="<?php echo CONSTALL ?>"> All </option>
                <option value="<?php echo CONSTSELF ?>"> Self </option>
                <option value="<?php echo CONSTNONE ?>"> None </option> 
              </select> 
        </div>
      </div> 
   </div>      

<br/> Contact Permission
   
     <div class="modal-body">
        <div class="form-group">
            <label for="inputEmail3" class="col-md-4 col-lg-4 col-xs-12 col-sm-12 control-label ">Create Contact </label>
            <div class="col-md-8 col-lg-8  col-xs-12 col-sm-12">
              <select class="form-control" name="drpContCreate" id="drpContCreate"  >
                <option value="">Select  </option>
                <option value="<?php echo CONSTYES ?>"> Yes </option>
                <option value="<?php echo CONSTNO ?>"> No </option> 
              </select>    
        </div>
      </div>
     </div>

     <div class="modal-body">   
        <div class="form-group">
          <label for="inputEmail3" class="col-md-4 col-lg-4 col-xs-12 col-sm-12 control-label ">View Contact </label>
            <div class="col-md-8 col-lg-8  col-xs-12 col-sm-12"> 
              <select class="form-control" name="drpContView" id="drpContView"  >
                <option value="">Select  </option>
                <option value="<?php echo CONSTALL ?>"> All </option>
                <option value="<?php echo CONSTSELF ?>"> Self </option>
                <option value="<?php echo CONSTNONE ?>"> None </option> 
              </select> 
            </div>
        </div>
     </div>

      <div class="modal-body ">
        <div class="form-group">
            <label for="inputEmail3" class="col-md-4 col-lg-4 col-xs-12 col-sm-12 control-label ">Update Contact </label>
            <div class="col-md-8 col-lg-8  col-xs-12 col-sm-12"> 
              <select class="form-control" name="drpContUpdate" id="drpContUpdate"  >
                <option value="">Select  </option>
                <option value="<?php echo CONSTALL ?>"> All </option>
                <option value="<?php echo CONSTSELF ?>"> Self </option>
                <option value="<?php echo CONSTNONE ?>"> None </option> 
              </select> 
        </div>
      </div> 
   </div>      


 <br/>  Order Permission
     <div class="modal-body">
        <div class="form-group">
            <label for="inputEmail3" class="col-md-4 col-lg-4 col-xs-12 col-sm-12 control-label ">Create Order </label>
            <div class="col-md-8 col-lg-8  col-xs-12 col-sm-12">
              <select class="form-control" name="drpOrderCreate" id="drpOrderCreate"  >
                <option value="">Select  </option>
                <option value="<?php echo CONSTYES ?>"> Yes </option>
                <option value="<?php echo CONSTNO ?>"> No </option> 
              </select>    
        </div>
      </div>
     </div>

     <div class="modal-body">   
        <div class="form-group">
          <label for="inputEmail3" class="col-md-4 col-lg-4 col-xs-12 col-sm-12 control-label ">View Order </label>
            <div class="col-md-8 col-lg-8  col-xs-12 col-sm-12"> 
              <select class="form-control" name="drpOrderView" id="drpOrderView"  >
                <option value="">Select  </option>
                <option value="<?php echo CONSTALL ?>"> All </option>
                <option value="<?php echo CONSTSELF ?>"> Self </option>
                <option value="<?php echo CONSTNONE ?>"> None </option> 
              </select> 
            </div>
        </div>
     </div>

      <div class="modal-body ">
        <div class="form-group">
            <label for="inputEmail3" class="col-md-4 col-lg-4 col-xs-12 col-sm-12 control-label ">Update Order </label>
            <div class="col-md-8 col-lg-8  col-xs-12 col-sm-12"> 
              <select class="form-control" name="drpOrderUpdate" id="drpOrderUpdate"  >
                <option value="">Select  </option>
                <option value="<?php echo CONSTALL ?>"> All </option>
                <option value="<?php echo CONSTSELF ?>"> Self </option>
                <option value="<?php echo CONSTNONE ?>"> None </option> 
              </select> 
        </div>
      </div> 
   </div> 


   <div class="modal-body ">
        <div class="form-group">
            <label for="inputEmail3" class="col-md-4 col-lg-4 col-xs-12 col-sm-12 control-label ">Other Permission </label>
            <div class="col-md-8 col-lg-8  col-xs-12 col-sm-12"> 
              <select class="form-control" name="drpOtherPerm" id="drpOtherPerm"  >
                <option value="">Select  </option>
                <option value="10">Other Permission1 </option>
                <option value="20">Other Permission2 </option>
                <option value="30">Other Permission3 </option> 
              </select> 
        </div>
      </div> 
   </div>      


           <input type="hidden" name="action" value="add-permission">

         

         <div class="row">
           
<div class="col-lg-12 text-center" style="margin-top: 40px;">
        <button type="submit" align = "center" id="btnPermit" class="btn btn-default">Submit</button>
         <button type="reset" align = "center" class="btn btn-default">Reset</button>
       </div> 
     </div>

    </form>
</div>
 

 <?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-footer.php"); ?>

  <script type="text/javascript">
    
 $(document).ready(function(){

    $("#drpMembers").val('<?php echo $INMemberUID ?>');
     
     $("#drpCmpCreate").val('<?php echo $createcmp ?>');
     $("#drpCmpView").val('<?php echo $viewcmp ?>');
     $("#drpCmpUpdate").val('<?php echo $editcmp ?>');
     $("#drpContCreate").val('<?php echo $createcont ?>');
     $("#drpContView").val('<?php echo $viewcont ?>');
     $("#drpContUpdate").val('<?php echo $editcont ?>');
     $("#drpOrderCreate").val('<?php echo $createorder ?>');
     $("#drpOrderView").val('<?php echo $vieworder ?>');
     $("#drpOrderUpdate").val('<?php echo $editorder ?>');  


 });


  </script>


