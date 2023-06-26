<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br>
        <br>
        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload']  ;
            unset($_SESSION['upload'])   ;
        }
        
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Title of the Food">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" id="" cols="30" rows="5" placeholder="Description of the Food."></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>

                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" id="">
                            <?php
                            //create php code to display category form db
                            //1. create sql to get all active categories from db
                            $sql="SELECT *FROM tbl_catagory";
                            $res = mysqli_query($conn,$sql);
                            //count rows to check we have categories or not
                            $count = mysqli_num_rows($res);
                            
                            if($count>0)
                            {
                          while($row=mysqli_fetch_assoc($res))
                          {
                            //get the detalails of category
                            $id = $row['id'];
                            $title = $row['title'];
                            ?>
                            <option value="<?php echo $id;?>"<?php echo $title; ?></option>
                            <option value="food">food</option>
                            <?php
                        
                          }


                            }
                            else
                            {
                           ?>
                            
                           <option value="0">No Category Found</option>
                           <?php
                            }
                            ?>
                            
                        </select>
                    </td>

                    
                </tr>
                <tr>
                    <td>featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes">Yes
                        <input type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                   <td colspan="2">
                    <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                   </td> 
                </tr>
            </table>
      
 </form>
 <?php
   //check tjhe button is clickked
   if(isset($_POST['submit']))
   {
    //add food in db
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
   }

   //check the radio button is checked or not

   if(isset($_POST['featured']))

{
    $featured = $_POST['featured'];
}
else 
{
    $featured = "No";
}
if(isset($_POST['active']))
{
    $active = "Yes";
}
else 
{
    $active = "No";
}
//2. upload the image if  selected
//check whether the  selected image is clicked or not and upload the image only if the image is selected
if(isset($_FILES['image']['name']))
{
   // get the details of the selected image
   $image_name =$_FILES['image']['name'];

    
if($image_name!="")
{
    //image is selected
    //get the extension of the selected image
    $ext = end(explode('.',$image_name));
    $image_name = "Food-Name-".rand(0000,9999).".". $ext;//

    //source path is the current location of the image
    $src = $_FILES['image']['tmp_name'];

    //destination path for the image to be uploaded
$des = "../images/food/".$image_name;
$upload = move_uploaded_file($src,$des);
//check the image is uploadd or not
if($upload==false)
{
    //falide to upload
    //redirect to aadd fooo page with
  //  error intl_get_error_message
  $_SESSION['upload'] ="<div class='error'>Failed to upload image.</div>";
  header('location:'.SITEURL.'admin/add-food.php');
  //stop the process
  die();
}

}

}
else
{
    $image_name ="";//setting default value ads blank
}
//3.inser into database
//create sql query to insert data to the database
$sql2 = "INSERT INTO tbl_food SET
title='$title',
description = '$description',
price=$price,
image_name='$image_name',
category_id = 10,
feactured = '$featured',
active = '$active'
";
//excuten auery
$res = mysqli_query($conn,$sql2);

if($res2 == true)
{
    //inserted successfully
    $_SESSION['add'] = "<div class='success'>Food Added succussfully.</div>";
    header('location:'.SITEURL.'admin/manage-food.php');
}
else
{
    //failed to insert succefully
    $_SESSION['add'] = "<div class='error'> Failed to add food..</div>";
    header('location:'.SITEURL.'admin/manage-food.php');

}
//4 redirect manage food page

?>

    </div>
</div>








<?php include('partials/footer.php')?>
