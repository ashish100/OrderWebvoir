<?php 
include_once($_SERVER['DOCUMENT_ROOT']."/constant/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . FolderName . MEMBER_PATH);
include_once($_SERVER['DOCUMENT_ROOT'] . FolderName . DATEFUNCTION_PATH);
include_once($_SERVER['DOCUMENT_ROOT'] . FolderName . GENERAL_PATH);

 include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-header.php");
 include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-navheader.php");

    
  $objDate = new objDate();
  $objMember = new clsMember();
  $objGeneral = new objGeneral();

  $arrFilter = array();
    $arrMemberData = $objMember->getAllMember($arrFilter);

?>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
     <h1 class="page-header">Member</h1>
    </div>
  <!-- /.col-lg-12 -->

   <div class="pull-right" style="margin-right:20px;margin-bottom: 20px;" >
       <a href="add-member.php" class="btn btn-sm btn-primary">Add Member</a>
</div>


 </div>
     <!-- /.row -->
   <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
             <h3>Members</h3>
            
  <div class="table-responsive">
       <table class="table table-bordered table-striped">
          <thead>
              <tr>
                  <th>Member</th>
                  <th>Level</th>
                   <th>Email</th>
                   <th>Designation</th>
                  <th>Added Date</th>  
                  <th>Status</th>
                  <th>Action</th>
                 
            </tr>
        </thead>
        <tbody>
             <?php foreach($arrMemberData as $member)  {  
             	?>
            <tr>
              <td> <a href="member-detail.php?memberuid=<?php echo $member['member_uid'] ?>" > <?php echo $member['member_name'] ?> </a> </td>
                <td><?php echo $objMember->getMemberLevel($member['member_level']) ?></td>
                <td><?php echo $member['member_loginid'] ?></td>
                <td><?php echo $member['member_designation'] ?></td>
                <td><?php echo $objDate->createdisplaydate($member['member_addeddate']) ?></td>
                <td><?php echo $objGeneral->getStatusType($member['member_status']) ?></td>
                <td><a href="javascript:void(0)" class="clsOtherInfo" id="<?php echo $member['member_uid'] ?>" dataid="<?php echo $member['member_name'] ?>" > Other Info </a> &nbsp;&nbsp;
                  <a href="edit-member.php?memberuid=<?php echo $member['member_uid'] ?>" > Update </a></td>
            </tr>
             <?php }   ?>
        </tbody>
    </table>
            
      <form id="frmOtherInfoID" method="post"  action="member-otherinfo.php" >
         <input type="hidden"  name="MemberUID" id="memberUID" >
         <input type="hidden" name="membername" id="membername" >
      </form>
</div>
</div>
</div>
</div>
</div>
</div>


 <?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-footer.php"); ?>

  <script type="text/javascript">
    
  $(document).ready(function(){

       $(".clsOtherInfo").click(function(){

            var MemberUNIQ = $(this).attr('id');
            var MemberName = $(this).attr('dataid');

         //alert(MemberName);

            $("#memberUID").val(MemberUNIQ);
            $("#membername").val(MemberName);

            $("#frmOtherInfoID").submit();

       });

  });


  </script>
