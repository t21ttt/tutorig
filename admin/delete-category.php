

<?php
include('../config/constants.php');
//echo "Delete page";

//ccheck image name \and id is set or not
if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //echo "Get value and delete";
  $id=$_GET['id'];
  $image_name = $_GET['image_name'];
   
  if($image_name!="")
  {
    $path = "../images/category/".$image_name;
    //remove the image
    $remove = unlink($path);
    if($remove==false)//fail to remove
    {
     //set session message
   $_SESSION['remove'] = "<div class = 'error'> failed to remove category image.</div>";
  //redirect to mmanage category message
   header('location:'.SITEURL.'admin/manage-category.php');
   //stop process
   die();
     
    }
  }
  //deelete data from db
  $sql = "DELETE FROM tbl_catagory WHERE id=$id";
  //excute query
  $res = mysqli_query($conn,$sql);

  if($res==true)
  {
    $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";

//reiderect categrory
header('location:'.SITEURL.'admin/manage-category.php');

  }
  else{
    $_SESSION['delete'] = "<div class='error'>failed to Deleted categotry.</div>";

    //reiderect categrory
    header('location:'.SITEURL.'admin/manage-category.php');
    
  }
}
else{
header('location:'.SITEURL.'admin/manage-category.php');
}


?>