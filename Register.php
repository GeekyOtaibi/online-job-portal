<?php include 'header.php'; ?>       
<html>
    <head>
        <title></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">    
    </head>
    <body>
        <?php
        if(isset($_POST['add']))
        {
            include ('connection-db.php');

            $username=$_POST['username'];
            $pass=$_POST['password'];
            $pass1=$_POST['password1'];
            $name=$_POST['name'];
            $type=$_POST['type'];
            
            $error_username=0;
            $error_password=0;
            
            $query="SELECT * FROM `user` WHERE username='$username'";
            $result= mysqli_query($con, $query);
            if(mysqli_num_rows($result)){
               $error_username=1;
            }
            if($pass!=$pass1){
                $error_password=1;
            }
            
            
            if($error_password==0 AND $error_username==0)
            {
                $query="INSERT INTO `user`( `username`, `password`, `name`, `type`) VALUES ('$username',md5($pass),'$name','$type')" ;
                $result=mysqli_query($con,$query);
                header("location:Register.php?status=1");//this message is for correct inset command 
               
            }
            else {
                header("location:Register.php?euser=$error_username&epass=$error_password");//this message is for incorrect inset command
            }
        }
        
        if(isset($_GET['status']) AND $_GET['status']==1) { ?>
        <p>accepted and saved in database</p>
                
            <?php } else {?> 
                
            
                <h1 style="font-size: 30px" > Register </h1>
                <form name="add" method="post" onsubmit="return Register()">
                    <table align="CENTER" cellspacing="30"  class="box">
                        
                        <tbody>
                      
                    <tr>
                    <td><label for="username">Username :</label></td>
                    <td><input type="text" name="username"/>
                                                
                    <?php if(isset($_GET['euser']) AND $_GET['euser']==1) { ?>
                        <span class="error">username is taken</span>
                    <?php } ?>
                        
                    </td>
                    </tr>
                    <tr>
                    <td><label for="password">password :</label></td>
                    <td><input type="password" name="password" />
                        
                    <?php if(isset($_GET['epass']) AND $_GET['epass']==1) { ?>
                        <span class="error">password not equal</span>
                    <?php } ?>
                        
                    </td>
                    </tr>
                    <tr>
                    <td><label for="password1"> confirm password :</label></td>
                    <td><input type="password" name="password1" /></td>
                    </tr>
                    <tr>
                    <td><label for="name"> Full Name :</label></td>
                    <td><input type="text" name="name" /></td>
                    </tr>
                    <td><label for="type">Type :</label></td>
                    <td><input type="radio" name="type" value="seeker" checked/> seeker 
                        <input type="radio" name="type" value="recruiter" /> recruiter
                    </td>
                  
                    </tbody>
                    </table>
                    <br>
                    <input type="submit" value="Register" class="blue button" name="add" method="post" >
                </form>
                <script src="js/Register.js"></script>
    </body> 
    <?php }?>
<?php include 'footer.php'; ?>