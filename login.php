<!doctype html>
<?php session_start();?>
<?php include('connection-db.php');?>

<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <?php
        if(isset($_POST['login']))
        {
            $user=$_POST['username'];
            $pass=$_POST['password'];
            
            $query="SELECT * FROM `user` WHERE `username`='$user';";
            $result=mysqli_query($con,$query);
            $row=mysqli_fetch_assoc($result);
            
            if($user == $row['username'] && md5($pass) == $row['password'])
            {
                $_SESSION['username']=$row['username'];
                $_SESSION['name']=$row['name'];
                $_SESSION['type']=$row['type'];
                $_SESSION['id']=$row['id'];
                header("location:index.php");
                
            }
            else {
                header("location:login.php?status=0");
            }  
        }
        ?>
        <div id="wrapper">
            <section id="login-container">
                <h1 style="font-size: 30px">Login</h1>
                
                <?php if(isset($_GET['status']) and $_GET['status']==0) { ?>
                <p class="error">Incorrect Login Details. Please try again. </p>
                <?php } ?>
                
                <form method="POST" action="login.php" name="add">
                    <label for="username">Username</label>
                    <input type="text" name="username" required/>
                    <br><br>
                    <label for="password">password</label>
                    <input type="password" name="password" required/>
                    <br><br>
                    <input type="submit" value="Login" name="login" method="POST" class="green button">
                </form>
                <a href="index.php">back to homepage</a>
            </section>
        </div>
    </body>
</html>