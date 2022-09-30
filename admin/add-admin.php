<?php include('partials/menu.php'); ?>
   <div class="main-container">
       <div class="wrapper">
          <br/><br/>
          <h1>Add Admin</h1>
          <br/><br/>
          <form action="" method="POST">
            <table class='tbl-30'>
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                </tr>
            </table>
          </form>
       </div>
   </div>
<?php include('partials/footer.php'); ?>    
<?php
    //1. Get the Data from form
           $full_name = $_POST['full_name'];
           $username = $_POST['username'];
           $password = md5($_POST['password']);    
    //2. Sql Query to save the data into database
    $sql = "INSERT INTO tbl_admin SET
         full_name ='$full_name',
         username ='$username',
         password ='$password'
    ";
    //3. Executing Query and Saving Data into database
    $res = mysqli_query($conn,$sql) or die(mysqli_error());
    //4. Check whether the (Query is executed) data is inserted or not and display apporimate message
    if($res==TRUE){
        //Create a Session Variables to Display Message
        $_SESSION['add'] = "Admin Added Successfully";
        //Redirect Page
        header("loaction:".SITEURL.'admin/manage-admin.php');
    }else{
         //Create a Session Variables to Display Message
         $_SESSION['add'] = "Admin Added Unsuccessfully";
         //Redirect Page
         header("loaction:".SITEURL.'admin/add-admin.php');
    }
    
?>