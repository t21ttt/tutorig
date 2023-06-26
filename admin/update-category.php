<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
    <h1>Update Category</h1> 
    <br><br>
<?php
//check the id is set
if(isset($_GET['id']))
{
 //get the id and all details
 $id=$_GET['id'];
 $sql="SELECT *FROM tbl_catagory WHERE id=$id";
 $res =mysqli_query($conn,$sql);
  //count rows

  $count = mysqli_num_rows($res);

  if($count==1)
  {
   $row = mysqli_fetch_assoc($res);
   $title=$row['title'];
   $current_image=$row['image_name'];
   $featured=$row['featured'];
   $active=$row['active'];

  }
  else
  {
$_SESSION['no-category-found'] = "<div class='error'>Category not found.</div>";
  header('location:'.SITEURL.'admin/manage-category.php');

}

}
else{
    header('location:'.SITEURL.'admin/manage-category.php');
}

?>




    <form action="" method="POST" enctype="multipart/form-data">
    <table class="tbl-30">
  <tr>
    <td>Title:</td>
    <td>
    
        <input type="text" name="title" value="<?php echo $title;?>">
    </td>
  </tr>
  <tr>
    <td>Current image:</td>
    <td>
      <?php
      if($current_image!="")
      {
        //Display the image
        ?>
        <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image;?>" width='150px'>
        <?php
      }
      else
      {
        //display the message
        echo "<div class='error'> Image Not Added.</div>";
      }
      
      
      
      ?>
    </td>
  </tr>
  <tr>
    <td>New Image:</td>
    <td>
        <input type="file" name="image" >
    </td>
  </tr>
  <tr>
    <td>Feactured:</td>
    <td>
        <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
        <input <?php if($featured=="NO"){echo "checked";} ?> type="radio" name="featured" value="NO">No
    </td>
  </tr>
  <tr>
    <td>Active:</td>
    <td>
    <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
    <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="NO">No
    </td>
  </tr>
  <tr>
    <td>
     
      <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
      <input type="hidden" name="id" value="<?php echo $id;?>">
      <input type="submit" value="Update Category" name="submit" class="btn-secondary">
    </td>
    
  </tr>
   </table>

    
</form>
   <?php
   if(isset($_POST['submit']))
   {
/// 1 get all the values from our form
  $id=$_POST['id'];
  $title=$_POST['title'];
  $current_image = $_POST['current_image'];
  $featured=$_POST['featured'];
  $active=$_POST['active'];

  //2. updating new image if selected
  //check whether the image is selected or not
  if(isset($_FILES['image']['name']))
  {
    //get the image details
    $image_name = $_FILES['image']['name'];
    //check the image is available or not
    if($image_name !="")
    {
      //image avalable
      //uploade the image
      $ext = end(explode('.',$image_name));
   //rename the image
   $image_name = "Food_Category".rand(000,999).'.'.$ext;//
   
    $source_path = $_FILES['image']['tmp_name'];
    $destination_path = "../images/category/".$image_name;
    //finally upload the  image
    $upload = move_uploaded_file($source_path,$destination_path);
    //check wrhether the image is uploaded or not
    //and if the image is not uploaded the we will stop the process and redirect with the error messages
    if($upload==false)
{
   //set image
   $_SESSION['upload'] = "<div class='error'>Failed to upload image.</div>";
   //redirect to add category page
   header('location:'.SITEURL.'admin/manage-category.php');
   //stop the process
   die();

}
      //remove the current image
      if($current_image!="")
      {
        $remove_path ="../images/category".$current_image;

        $remove = unlink( $remove_path);
        if($remove==false)
        {
         //faled to remove
         $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
         header('location:'.SITEURL.'admin/manage-category.php');
         die();//stop the process
        }
       
      }
      else
      {
        $image_name=$current_image;
  
      }
    
    }
    
  }
  else
  {
  
    $image_name=$current_image;
  }
  //3update the db
  $sql2 = "UPDATE tbl_catagory SET
  title = '$title',
  image_name='$image_name',
  featured = '$featured',
  active = '$active'
  WHERE id=$id
   ";
   //excute query
   $res2=mysqli_query($conn,$sql2);
  //4redirect

  if($res2==true)
  {
    //catagory uppdareted 
   $_SESSION['update'] = "<div class='success'> Category updated successfully.</div>";
   header('location:'.SITEURL.'admin/manage-category.php');
  }
  else
  {
    $_SESSION['update'] = "<div class='error'> failed to updated.</div>";
    header('location:'.SITEURL.'admin/manage-category.php');

  }
   }
   
   
   
   ?>
    
    </div>
</div>








<?php include('partials/footer.php'); ?>