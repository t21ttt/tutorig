<?php
include('partials/menu.php');

?>
<div class="main-content">
    <div class="wrapper">
      <h1>Manage Food </h1>
      <br/>
      <br/>
<?php
if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
?>


   <!-- button to add admin -->
   <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
   <br/>
    <br/>
   <table class="tbl-full">
        <tr>
            <th>S.N.</th>
            <th>Full Name </th>
            <th>Username</th>
            <th>Actions</th>
        </tr>
        <tr>
            <td>1</td>
            <td>Tefera Molla</td>
            <td>tefra</td>
            <td>
                <a href="#" class="btn-secondary">Update Admin</a>
                
                <a href="#" class="btn-danger">Delete Admin</a>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Tefera Molla</td>
            <td>tefra</td>
            <td>
               <a href="#" class="btn-secondary">Update Admin</a>
                
                <a href="#" class="btn-danger">Delete Admin</a>n
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Tefera Molla</td>
            <td>tefra</td>
            <td>
            <a href="#" class="btn-secondary">Update Admin</a>
                
                <a href="#" class="btn-danger">Delete Admin</a>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Tefera Molla</td>
            <td>tefra</td>
            <td>
            <a href="#" class="btn-secondary">Update Admin</a>
                
                <a href="#" class="btn-danger">Delete Admin</a>
            </td>
        </tr>
     </table>
    </div>

</div>


<?php
include('partials/footer.php');

?>