<?php
//include constant.php file here
include('../config/constants.php');

//1. get the ID of admin to be deleted

$id = $_GET['id'];
 
//2. create sql query to be deleted admin
$sql = "DELETE FROM tbl_admin WHERE id = $id";
 //execute the query

 $res = mysqli_query($conn,$sql);


// //check whether the query excuted successfully or not
if($res ==true)
{
//     //query excuted successfully and admin deleted
   //create session variable to be display message
     $_SESSION["delete"] = "<div class='success'>Admin Deleted Succeffully</div>";
//     //redirect to manage admin page
     header('location:'.SITEURL.'admin/manage-admin.php');

 }
 else
{
//     //failed to delete admin
  $_SESSION['delete'] = "<div class='error'>Failed to delete Admin. Try aqain later.</div>";
 header('location:'.SITEURL.'admin/manage-admin.php');
 }

// //3. Redirect to manage admin page with message(success/error)


?>