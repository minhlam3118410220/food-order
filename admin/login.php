<?php include('../config/constants.php') ?>


<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center" width="250px">Login</h1>
            <br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            
            <br> 
            <!--Login form start-->
            <form  action="" method="POST" class="text-center">
                Username: <br>
                <input type="text" name="username" placeholder="Enter Username"> <br> <br>
                Password: <br>
                <input type="password" name="password" placeholder="Enter Password"> <br> <br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
            </form>
            <!--Login form end-->


            
        </div>
    </body>

</html>


<?php 
    if(isset($_POST['submit']))
    {
        
         //$username = $_POST['username'];
         //$password = md5($_POST['password']);

         $username = mysqli_real_escape_string($conn,$_POST['username']) ;
         $raw_password = md5($_POST['password']);
         $password = mysqli_real_escape_string($conn,$raw_password);

  
        $sql = "SELECT * FROM tbl_admin WHERE username ='$username' and password ='$password'";
        
      
        $res = mysqli_query($conn ,$sql);

        
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login'] = "<div class='success'>Login Success</div>";
            $_SESSION['user'] = $username;

            header('location:'.SITEURL.'admin/');
        }
        else
        {
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match</div>";
            header('location:'.SITEURL.'admin/login.php');
        }

    }
?>