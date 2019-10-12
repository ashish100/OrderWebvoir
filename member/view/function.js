
$(document).ready(function(){

$("#frmAddMember").submit(function(){
  
      $("#btnAddMember").html("processing");
        $("#btnAddMember").attr("disabled", true);

    $.ajax({
          url:'/member/controller/memberAjax.php',
          type:'post',
          data:$("#frmAddMember").serialize(),
          success:function(info)
          {
               if (info.trim() != "1")
               {
                  alert("Error Found");
                   return false;
               }

             else
             {
                 //alert("Add Successfully");
                 $("#btnAddMember").html("Submit");
                  $("#btnAddMember").attr("disabled", false);
                window.location = "/member/view/all-members.php" ;
                   
             }

          }
  });

  return false;

}); 


 $("#frmOtherMemberInfo").submit(function(){

   $.ajax({
          url:'/member/controller/memberAjax.php',
          type:'post',
          data:$("#frmOtherMemberInfo").serialize(),
          success:function(info)
          {
               if (info.trim() != "1")
               {
                  alert("Error Found");
                   return false;
               }

             else
             {
                 alert("Add Successfully");
                  
                //window.location = "/member/view/all-members.php" ;
                   
             }

          }
  });

  return false;

 });


  //   LOGIN MEMBER

 $("#frmLoginMember").submit(function(){
  
    $.ajax({
          url:'/member/controller/memberAjax.php',
          type:'post',
          data:$("#frmLoginMember").serialize(),
          success:function(info)
          {
               if (info.trim() != "1")
               {
                  alert("Error Found");
                   return false;
               }

             else
             {
                // alert("login successfully");
                window.location = "/member/view/dashboard.php" ;
                   
             }

          }
  });

  return false;

}); 


//  Update Member


  $("#frmEditMember").submit(function(){
  
      $("#btnEditMember").html("processing");
        $("#btnEditMember").attr("disabled", true);

    $.ajax({
          url:'/member/controller/memberAjax.php',
          type:'post',
          data:$("#frmEditMember").serialize(),
          success:function(info)
          {
               if (info.trim()!= "1")
               {
                  alert("Error Found");
                   return false;
               }

             else
             {
                $("#btnEditMember").html("Submit");
                    $("#btnEditMember").attr("disabled", false);

                // alert("Update Successfully");
                window.location = "/member/view/all-members.php" ;
                   
             }

          }
  });

  return false;

}); 


//   FOR SAVING MEMBER PERMISSIONS

$("#frmMemberPermission").submit(function(){

     $("#btnPermit").html("processing");
        $("#btnPermit").attr("disabled", true);

    $.ajax({
          url:'/member/controller/memberAjax.php',
          type:'post',
          data:$("#frmMemberPermission").serialize(),
          success:function(info)
          {
               if (info.trim()!= "1")
               {
                  alert("Error Found");
                   return false;
               }

             else
             {
                $("#btnPermit").html("Submit");
                    $("#btnPermit").attr("disabled", false);

                 alert("Permitted Successfully");
               // window.location = "/member/view/all-members.php" ;
                   
             }

          }
  });

  return false;


});


//   FOR SEND MESSAGE 

 $("#frmSendMsg").submit(function(){

  $("#btnSendMsg").html("processing");
        $("#btnSendMsg").attr("disabled", true);

    $.ajax({
          url:'/member/controller/memberAjax.php',
          type:'post',
          data:$("#frmSendMsg").serialize(),
          success:function(info)
          {
               if (info.trim()!= "1")
               {
                  alert("Error Found");
                   return false;
               }

             else
             {
                $("#btnSendMsg").html("Submit");
                    $("#btnSendMsg").attr("disabled", false);

                 alert("Message Send Successfully");

               window.location.reload();
                   
             }

          }
  });

  return false;

    

 });








});                                             //  end of ready statment 

