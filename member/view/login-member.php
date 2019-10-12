<?php
 error_reporting(0); 
include_once($_SERVER['DOCUMENT_ROOT']."/constant/config.php");
include_once($_SERVER['DOCUMENT_ROOT'] . FolderName . SESSION_PATH);
 
 
   $glbFOOTERJSFILE[] =  '/member/view/function.js';

?>

 

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<?php

if (is_array($glbHEADERJSFILE))
{
  foreach ($glbHEADERJSFILE as $row)
  {
    echo '<script type="text/javascript"  src="'.$row.'"></script>';
  }
}
?>
    <!-- Bootstrap CSS -->
<!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
 -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" id='travelhub_fonts_url-css'  href='//fonts.googleapis.com/css?family=Karla%3A400%2C700%2C400italic%2C700italic&#038;ver=1.0.0' type='text/css' media='all' />


<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
   
   <!-- Bootstrap Core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  

    <link rel='stylesheet' type='text/css' href='/resources/css/style.css'>
     <!-- <link rel="stylesheet" href="/resources/css/datepicker.css"> -->
     <?php
if (is_array($glbHEADERCSSFILE))
{
    foreach ($glbHEADERCSSFILE as $row)
    {
        echo '<link rel="stylesheet" type="text/css"   href="'.$row.'" />';
    }
}
?>
     





<style>
html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-align: center;
  align-items: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>


 </head>
 <body>
 <div class="container-fluid " >
  <div class="row justify-content-lg-center">
    <div class="col-lg-4 text-center">
    
<form method="post" id="frmLoginMember" name="frmLoginMember" class="form-signin">
      <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
      <h1 class="h3 mb-3 font-weight-normal">Login Account Panel</h1>
   
    <div class="form-group">
      <label for="inputEmail" class="sr-only">Email ID:</label>
        <input type="text" name="txtLoginID" class="form-control" id="txtLoginID" placeholder="Email Address" >
     </div>   

   <div class="form-group">
      <label for="inputPassword" class="sr-only">Password</label>
      <input type="password" name="txtLoginPassword" class="form-control" id="txtLoginPassword" placeholder="Password" >
    </div>
      
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Login in</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2018-2019</p>

            <input type="hidden" name="action" value="login-member">
    </form>


 
</div>
</div>
</div>

 <?php include_once($_SERVER['DOCUMENT_ROOT']."/includes/include-footer.php"); ?>


</body></html>



 



<!-- <div id="page-wrapper">
    <div class="row">
       <div class="col-lg-12">
          <h1 class="page-header">Forms</h1>
        </div> -->
                <!-- /.col-lg-12 -->
     
     <!-- </div> -->

            <!-- /.row -->
   <!-- <div class="row">
     <div class="col-lg-12">
          <div class="panel panel-default">
             <div class="panel-heading">
                Login Member
          </div>
   <div class="panel-body">
     <div class="row">
 <div class="col-lg-6">
    <form id="frmMemberLogin" name="frmMemberLogin" method="post" >
        
         <div class="form-group">
            <label>Login Id</label>
              <input type="text" class="form-control" name="txtLoginID" id="txtLoginID" value="" >    
        </div>

        <div class="form-group">
            <label>Password</label>
              <input type="password" class="form-control" name="txtPassword" id="txtPassword" value="" >    
        </div>
 
         <input type="hidden" name="action" value="login-member">
        
           <button type="submit" align = "center" class="btn btn-default">Submit</button>
         <button type="reset" align = "center" class="btn btn-default">Reset</button>
    
    </form>
</div>
  -->
