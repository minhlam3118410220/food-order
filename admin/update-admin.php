<?php include('partials/menu.php') ?>

    <div class="main-content">
        <div class="wrapper">
            <h1>Update Admin</h1>

            <br><br>

            <?php 
                //1.Get the ID of Selected Admin
                $id = $_GET['id'];

                //2.Create SQL Query to Get the details
                $sql = "SELECT * FROM tbl_admin WHERE id=$id";

                //Execute the Query
                $res=mysqli_query($conn ,$sql);

                //Check whether the data is available or not
                if($res==true)
                {
                    //Check whether the data is availblae or not
                    $count = mysqli_num_rows($res);
                    //Check whether we have admin data or not
                    if($count==1)
                    {
                        //get the details
                        //echo "Admin Available";
                        $row = mysqli_fetch_assoc($res);

                        $full_name = $row['full_name'];
                        $username = $row['username'];
    
                    }
                    else
                    {
                        //redirect 
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }



            ?>

            <br><br>

            <form action="" method="POST">
                <table class="tbl-30 ">
                    <tr>
                        <td>Full Name</td>
                        <td>
                            <input class="bor-n" type="text" name="full_name" value="<?php echo $full_name; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Username</td>
                        <td>
                            <input class="bor-n" type="text" name="username" value="<?php echo $username; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>


                </table>
            </form>
        </div>
    </div>

<?php 
    
    if(isset($_POST['submit']))
    {
        
         $id = $_POST['id'];
         $full_name = $_POST['full_name'];
         $username = $_POST['username'];

        
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username'
        WHERE id= '$id'
        ";

      
        $res = mysqli_query($conn , $sql);

        
        if($res==true)
        {
           
            $_SESSION['update'] = "<div class='success'>Admin Update Successfully.</div>";
            
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin .Try Again.</div>";
            header("location:".SITEURL.'admin/manage-admin.php');
        }


    }
?>

<?php include('partials/footer.php')?>  