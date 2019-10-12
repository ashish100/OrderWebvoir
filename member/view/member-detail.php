<?php 
include_once($_SERVER['DOCUMENT_ROOT']."/constant/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . FolderName . MEMBER_PATH);
include_once($_SERVER['DOCUMENT_ROOT'] . FolderName . DATEFUNCTION_PATH);

 
 include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-header.php");
 include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-navheader.php");

   
    $objMember = new clsMember();
    $objDate = new objDate();

     $INMemUID = $_GET['memberuid'];
      
     $arrFilter['MemberUID'] = $INMemUID;

   $arrOtherInfoData = $objMember->getAllMember($arrFilter);      

         list($MemberProject,$MemberCar) = explode("||",$arrOtherInfoData[0]['member_projectinfo']);


?>




<div id="page-wrapper">
    <div class="row">
       <div class="col-lg-12">
          <h1 class="page-header">Company Detail</h1>
        </div>
                <!-- /.col-lg-12 -->
     </div>
            <!-- /.row -->

  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
   
 <div class="pull-right" style="margin-right:20px;" >
       <a href="/member/view/all-members.php"  class="btn btn-sm btn-primary" > Member </a>
  </div>

  <div class="pull-right" style="margin-right:20px;" >
       <a href="/member/view/edit-member.php?compUniq=<?php echo $INCompUID ?>" class="btn btn-sm btn-primary">Update Member</a>
  </div>

    
  
   </div>

<div class="clearfix"></div>

   <div class="row" style="margin-top: 20px;">

     <div class="col-lg-2 col-md-2 col-xs-4 col-sm-4">
           
       <ul class="list-group list-info">

            <li class="list-group-item"><strong>Profie Image
                : </strong>   
                 
              <?php
       $singlefile = $arrOtherInfoData[0]['memberinfo_image'];
  
    echo "<span ><img src='" . THUMBNILIMAGE . "" . $singlefile . "'  class='img-responsive' width='190px;' height = '90px;'>  </span>";
  
  ?>

       </li>     

        </ul>
     	 
     
   </div>   <!--  end of div of col-md-4    -->


    <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
          <div class="panel panel-default">
             <div class="panel-heading">
               Member Detail
          </div>
   <div class="panel-body">
     <div class="row">

       <ul class="list-group list-info">

            <li class="list-group-item"><strong> Name
                : </strong>  <?php echo $arrOtherInfoData[0]['member_name'] ?>
            </li>

            <li class="list-group-item"><strong>Email Address
                : </strong>  <?php echo $arrOtherInfoData[0]['member_loginid'] ?>
            </li>

            <li class="list-group-item"><strong> Designation
                : </strong>  <?php echo $arrOtherInfoData[0]['member_designation'] ?>
            </li>

            <li class="list-group-item"><strong>Contact no. 
                : </strong>  <?php echo $arrOtherInfoData[0]['memberinfo_contactno'] ?>
            </li>

            <li class="list-group-item"><strong>Address
                : </strong>  <?php echo  $arrOtherInfoData[0]['memberinfo_address'] ?>
            </li>

            <li class="list-group-item"><strong>City 
                : </strong>  <?php echo $arrOtherInfoData[0]['memberinfo_city'] ?>
            </li>

            <li class="list-group-item"><strong>Join Date
                : </strong>  <?php echo $objDate->createdisplaydate($arrOtherInfoData[0]['memberinfo_joindate']) ?>
            </li>

             

        </ul>
      </div>
     </div>
    </div> 
   </div>   <!--  endi div of col-md-4    -->



   <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
          <div class="panel panel-default">
             <div class="panel-heading">
               Member Other Detail
          </div>
   <div class="panel-body">
     <div class="row">

       <ul class="list-group list-info">

           <li class="list-group-item"><strong> Title
                : </strong>  <?php echo $arrOtherInfoData[0]['member_title'] ?>
            </li>

           <li class="list-group-item"><strong> Salary
                : </strong>  <?php echo $arrOtherInfoData[0]['memberinfo_salary'] ?>
            </li>

            <li class="list-group-item"><strong> Status
                : </strong>  <?php echo $objMember->getMemberStatusType($arrOtherInfoData[0]['member_status']) ?>
            </li>

            <li class="list-group-item"><strong>Project Name
                : </strong>  <?php echo $arrOtherInfoData[0]['project_title']   ?>
            </li>

           <li class="list-group-item"><strong>Car Status
                : </strong>  <?php echo $arrOtherInfoData[0]['member_assignstatus'] == AVAILCARYES ? "Yes" : "No" ?>
            </li>

          <li class="list-group-item"><strong>Assigned Car
                : </strong>  <?php echo $MemberCar ?>
            </li>
            
            

        </ul>
      </div>
     </div>
    </div> 
   </div>   <!--  endi div of col-md-4    -->

   </div>    <!-- end of row  -->
