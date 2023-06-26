<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Change password</h1>
        <br>
        <br>
        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>
        <form action="" method="POST">
   <table class="tbl-30">
  <tr>
    <td>Current password:</td>
    <td>
    <input type="password" name="current_password" placeholder="current password"> <br>
   
</td>
</tr>

<tr>
<td>New password</td>
    <td>
        <input type="password" name="new_password" placeholder="new password">
    </td>
  
</tr>
  
  <tr>
    <td>Confirm password:</td>
    <td>
        <input type="password" name="confirm_password" placeholder="confirm password">
    </td>
  </tr>
  <tr>
    <td colspan="2">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="submit" name="submit" value="change password" class="btn-secondary">
    </td>
  </tr>
  
   </table>



        </form>
    </div>
</div>
<?php
//  Check whether the submit button is clicked clicked or not
if(isset($_POST['submit']))
{
   // echo "clicked";
   //1.get the data fromform
   $id=$_POST['id'];
   $current_password = md5($_POST['current_password']);
   $new_password = md5($_POST['new_password']);
   $confirm_password = md5($_POST['confirm_password']);

   //2. check whethe the user with curren id and current password exists or not
   $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password ='$current_password'";
   //excute the query
   $res = mysqli_query($conn,$sql);
   if($res==true)
   {
    //check whether data is available or not
    $count = mysqli_num_rows($res);
    if($count==1)
    {
// user exist and password can be changed
    //echo "user found";
    //check whether the new password and conifrm mach or not
    if($new_password==$confirm_password)
    {
        //update the password
       $sql2="UPDATE tbl_admin SET
       password='$new_password'
       WHERE id=$id";
       
       $res2 = mysqli_query($conn,$sql2);
       //check is the query is excuted
    
    if($res2==true)
    {
       // display success message
       $_SESSION['change-pwd'] = "<div class='success'>password Changed Successfully.</div>";
       //redirect user
       
        header('location:'.SITEURL.'admin/manage-admin.php');
    
    }

    }
    else
    {
  // display success message
  $_SESSION['change-pwd'] = "<div class='error'>fail to change password.</div>";
  //redirect user
  
   header('location:'.SITEURL.'admin/manage-admin.php');
    }
    }
    else
    {   
    $_SESSION['pwd-not-match'] = "<div class='error'>password did not match.</div>";
       //redirect user
       
        header('location:'.SITEURL.'admin/manage-admin.php');
    
    }
    }
    else{
        $_SESSION['user-not-found'] = "<div class='error'>user not found.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    
    }
}   
   //3check whether the new password and confirm match or not
   //4 change passwordif all above is true


?>



<?php include('partials/footer.php'); ?>