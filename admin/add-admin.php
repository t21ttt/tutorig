<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add admin</h1>
        <br>
        <br>
     <?php
if((isset($_SESSION['add'])))//checking whether the session is set or not
     {
        echo $_SESSION['add']; //Displaying the session message if set
        unset($_SESSION['add']);//REMOVE session
     }
     
     ?>
        <form action="" method="POST">
        <table class="tbl-30">
        <tr>
            <td>Full Name:</td>
            <td><input type="text" name="full-name" placeholder="enter your name"> </td>
        </tr>
        <tr>
            <td>Username:</td>
            <td><input type="text" name="username" placeholder="enter your username"> </td>
        </tr>
        <tr>
            <td>password:</td>
            <td><input type="password" name="password" placeholder="enter your password"> </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
            </td>
        </tr>
     </table>
        </form>
    </div>
</div>


<?php
include('partials/footer.php');
?>
<?php
//process the value from form and save it in in database
//check whether the button is clicked or not
if(isset($_POST['submit'])){
//button clicked
//echo "Button Clicked"
//1. GET THE DATA FROM FORM
 $full_name = $_POST['full-name'];
 $username = $_POST['username'];
  $password = md5($_POST['password']);//password encription with MD5
  //2. SQL Query to save the data into database
  $sql = "INSERT INTO tbl_admin SET 
  full_name='$full_name',
  username ='$username',
  password='$password'
  
  ";
//3 Executing query ad saving data into database
$res = mysqli_query($conn,$sql) or die(mysqli_error());

//4. check whether(query excuted or not) the data is inserted or not
if($res==TRUE){
    //DATA INSERTED
     //echo "Data Inserted";
     //create a session variable to display message
     $_SESSION['add']="Admin Added Succefully";
     //redirect TO MANAGER ADMIN
     header("location:".SITEURL.'admin/manage-admin.php');
}
else{
    //Failed to inser data
    //echo "Failed to inserted data";
    //create a session variable to display message
    $_SESSION['add']="fail to add admin";
    //redirect to add admin
    header("location:".SITEURL.'admin/add-admin.php');
}
}

?>











