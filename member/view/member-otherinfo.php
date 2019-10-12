<?php 
include_once($_SERVER['DOCUMENT_ROOT']."/constant/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . FolderName . MEMBER_PATH);
 
 include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-header.php");
 include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-navheader.php");

   $glbFOOTERJSFILE[] =  '/member/view/function.js';

    $objMember = new clsMember();

     $INMemUID = $_POST['MemberUID'];
     $INMemberName = $_POST['membername'];

     // echo "name is ---->".$INMemberName;
     
     $arrFilter['MemberUID'] = $INMemUID;

   $arrOtherInfoData = $objMember->getOtherInfoMember($arrFilter);      

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/basic.css">
<link rel="stylesheet" href=" https://rawgit.com/enyo/dropzone/master/dist/dropzone.css">


<div id="page-wrapper">
    <div class="row">
       <div class="col-lg-12">
          <h1 class="page-header"><? echo $INMemberName ?>'s&nbsp; Other Information </h1>
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

    <form id="frmOtherMemberInfo" name="frmEditMember" method="post" >
       
       <div class="form-group">
            <label>Contact no.</label>
              <input type="text" class="form-control" name="txtMemberContact" id="txtMemberContact" value="<?php echo $arrOtherInfoData[0]['memberinfo_contactno'] ?>" >    
        </div>


        <div class="form-group">
            <label>Join Date</label>
              <input type="text" class="form-control" name="txtMemberJoinDate" id="txtMemberJoinDate" value="<?php echo $arrOtherInfoData[0]['memberinfo_joindate'] ?>" >    
        </div>

        <div class="form-group">
            <label>Member Address</label>
              <textarea class="form-control" name="txtMemberAddress" id="txtMemberAddress" rows="2"><?php echo $arrOtherInfoData[0]['memberinfo_address'] ?></textarea>    
        </div>


         <div class="form-group">
            <label>City</label>
              <input type="text" class="form-control" name="txtMemberCity" id="txtMemberCity" value="<?php echo $arrOtherInfoData[0]['memberinfo_city'] ?>" >
        </div>

        <div class="form-group">
            <label>Member Salary</label>
              <input type="text" class="form-control" name="txtMemberSalary" id="txtMemberSalary" value="<?php echo $arrOtherInfoData[0]['memberinfo_salary'] ?>" >    
        </div>
        
        <div class="form-group">
            <label>Per Day Salary</label>
              <input type="text" class="form-control" name="txtMemberPerDaySalary" id="txtMemberPerDaySalary" value="<?php echo $arrOtherInfoData[0]['memberinfo_perdaysalary'] ?>" >
        </div>

        <?php if (!empty($arrOtherInfoData[0]['memberinfo_image']))  
             { ?>
      
         <div class="form-group">
             <?php
$arrUploadedFiles = explode("||", $arrOtherInfoData[0]['memberinfo_image']);
  foreach ($arrUploadedFiles as $singlefile) {
    echo "<span ><img src='" . THUMBNILIMAGE . "" . $singlefile . "'  class='img-responsive' width='190px;' height = '90px;'> <input type='hidden' name='hid_file[]' value='$singlefile' > </span><br/>";
  }
  ?>
         </div>
        
        <?php  
           } 
        ?>
         <div class="form-group ">
                  <label > Image </label>
                  <div id="myId" class="dropzone"></div>
         </div>
        
          <input type="hidden" name="hidMemberUID" value="<?php echo $INMemUID ?>">

         <input type="hidden" name="action" value="add-memberinfo">

         
           <button type="submit" align = "center" id="btnEditMember" class="btn btn-default">Submit</button>
         <button type="reset" align = "center" class="btn btn-default">Reset</button>
    
    </form>
</div>
 


 <?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-footer.php"); ?>

 <script src="/member/attachment/dropzone.js"></script>


 <script type="text/javascript">
    
  

    Dropzone.autoDiscover = false;
var myDropzone = new Dropzone("div#myId", {
   maxFiles: 1,
url: "../attachment/upload-file.php",
acceptedFiles: "image/* ,.pdf, .txt, .xls,.doc,.docx,.xlsx,.dwg ", /*is this correct?*/
init: function(){
  this.on("maxfilesexceeded", function(file){
        alert("You can only upload one logo");
        this.removeFile(file);
    });
this.on("sending", function(file, xhr, formData){
formData.append('userName', 'bob');
}),
this.on("success", function(file, response) {
});
this.on("removedfile", function(file) {
//   alert("remove"+JSON.stringify(file));
});
}
});
myDropzone.on("addedfile", function(file) {
//  alert("added");
// Create the remove button
var removeButton = Dropzone.createElement("<button class='btn btn-xs  btn-danger' style='margin-top:1em;margin-left:1.5em;'>Remove file</button>");
// Capture the Dropzone instance as closure.
var _this = this;
// Listen to the click event
removeButton.addEventListener("click", function(e) {
// Make sure the button click doesn't submit the form:
e.preventDefault();
e.stopPropagation();
var server_file = $(file.previewTemplate).children('.server_file').val();
// Do a post request and pass this path and use server-side language to delete the file
$.post("delete.php", { file_to_be_deleted: server_file } );
// Remove the file preview.
_this.removeFile(file);
// If you want to the delete the file on the server as well,
// you can do the AJAX request here.
});
// Add the button to the file preview element.
file.previewElement.appendChild(removeButton);
});
myDropzone.on("success", function(file, responseText) {
$(file.previewTemplate).append('<input type="hidden" name="hid_file[]"  class="server_file" id="'+responseText+'" value="'+responseText+'" />');
//  alert(responseText);
// Handle the responseText here. For example, add the text to the preview element:
//  file.previewTemplate.appendChild(document.createTextNode(responseText));
});




  </script>