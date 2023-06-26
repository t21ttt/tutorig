<?php
include('../config/constants.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Food order system</title>
    <link rel="stylesheet" href="../css/admin.css>
</head>
<body>
 <div class="login">
    <h1 class="text-center">Login</h1>
    <br>
    <?php
    if(isset($_SESSION['login']))
    {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    if(isset($_SESSION['no-login-message'] ))
    {
      echo $_SESSION['no-login-message'];
      unset($_SESSION['no-login-message']);
    }
    
    ?>
 
<!-- login form started here -->
<form action="" method="POST" class="text-center">
    Username:<br>
    <input type="text" name="username" placeholder ="enter password"><br><br>
  password:<br>
  <input type="password" name="password" placeholder="enter password"><br><br>
    <input type="submit" name="submit" value="login" class="btn-primary">
</form>
<!-- login form enden here -->
    <p>Created By - <a href="www.tefera.com"> Tefera Molla</a></p>
 </div>

</body>
</html>


<?php
if(isset($_POST['submit']))
{
    //process for login
    //1. get the data from login form
  if($_POST['submit'])
  { 
    $username=$_POST['username'];
    $password=md5($_POST['password']);

     //3.sql to check whether user name and password exist or not

     $sql = "SELECT *FROM tbl_admin WHERE username='$username' AND password ='$password'";
     //3 excute query
     $res = mysqli_query($conn,$sql) ;
     //4 check whether the user exist or not
     $count = mysqli_num_rows($res);

     if($count==1)
     { 
        //login seccess
        $_SESSION['login']="<div class='success'>login Successfully.</div>";
   //redirect to hom page
         $_SESSION['user']=$username;//to check whether the user is logged in or not and logout will unset it
      header('location:'.SITEURL.'admin/');
     }
     else
     {
        //user not not availabe here
        $_SESSION['login']="<div class='error text-center'>Username or Password incorrect.</div>";
   //redirect to hom page

       header('location:'.SITEURL.'admin/login.php');
     }
  }
}



?>