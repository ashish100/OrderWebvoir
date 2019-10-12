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
    $arrMemberPermData = $objMember->getMemberPermission($arrFilter)
    

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
                   <th>Company Permission</th>
                   <th>Contact Permission</th>
                   <th>Order Permission</th>
                  <!-- <th>Action</th> -->
                 
            </tr>
        </thead>
        <tbody>
             <?php 
       foreach($arrMemberPermData as $perm)
        {
           $CompanyPerm = $perm['permission_companypermission'];

           list($createcmp,$viewcmp,$editcmp) = explode('||', $CompanyPerm);

           $ContactPerm = $perm['permission_contactpermission'];

           list($createcont,$viewcont,$editcont) = explode('||', $ContactPerm);

           $OrderPerm = $perm['permission_orderpermission'];

           list($createorder,$vieworder,$editorder) = explode('||', $OrderPerm);

  
             	?>
            <tr>
                <td><?php echo $perm['member_name'] ?></td>
                <td><?php echo $objMember->getMemberLevel($perm['member_level']) ?></td>
                <td>Create : <?php echo $objMember->getPermName($createcmp) ?> <br/> 
                    View : <?php echo $objMember->getPermName($viewcmp) ?> <br/>
                    Update : <?php echo $objMember->getPermName($editcmp) ?> 
                </td>
                <td>Create : <?php echo $objMember->getPermName($createcont) ?> <br/> 
                    View : <?php echo $objMember->getPermName($viewcont) ?> <br/>
                    Update : <?php echo $objMember->getPermName($editcont) ?> 
                </td>
                <td>Create : <?php echo $objMember->getPermName($createorder) ?> <br/> 
                    View : <?php echo $objMember->getPermName($vieworder) ?> <br/>
                    Update : <?php echo $objMember->getPermName($editorder) ?> 
                </td>
                 
                <!-- <td><a href="edit-member.php?memberuid=<?php echo $member['member_uid'] ?>" > Update </a></td> -->

            </tr>
             <?php }   ?>
        </tbody>
    </table>

</div>