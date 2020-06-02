<!DOCTYPE html>
<?php session_start();?>
<html>
<head>
    <title>Job Portal</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="wrapper">
    <header>
    <div id="top-bar">
        <?php if(isset($_SESSION['username'])){ ?>
        <div id="top-profile">
            <a style="font-size:20px;">welcome, <strong><?php echo $_SESSION['name']; ?></strong></a><br>
                <?php if(isset($_SESSION['type']) && $_SESSION['type']=='seeker'){
                        include('connection-db.php');
                        $sid=$_SESSION['id'];
                        $query ="Select * from profiles where sid=$sid";
                        $result= mysqli_query($con, $query);
                        if(mysqli_num_rows($result)){
                    ?>
                    <a href="view-profile.php">View Profile</a>
                    <a href="update.php">Update Profile</a>
                <?php }} ?>
                <?php if(isset($_SESSION['type']) && $_SESSION['type']=='recruiter'){ ?>
                    <a href="post-vacancy.php">Post Vacancy</a>
                    <a href="check-vacancies.php">Check Vacancies</a>
                <?php } ?>
                <?php if(isset($_SESSION['type']) && $_SESSION['type']=='admin'){ ?>
                    <a href="admin.php">Admin View</a>
                <?php } ?>
        </div>
        <?php } ?>
        <div  id="top-logo"  >
        <a href="index.php?page=0">
            <h1 align="center">Job Portal</h1>
            <p>easy way for job seeker and recruiter to communicate</p>            
        </a>
            </div>
        <div id="top-user-buttons">
            <?php if(!isset($_SESSION['username'])){ ?>
            <button type="button" class="green button" id="login-button" onclick="location.href='login.php';" >Login</button>
            <button type="button" class="blue button" id="register-button"onclick="location.href='Register.php';">Register</button>
            <?php } ?>
            <?php if(isset($_SESSION['username'])){ ?>
            <button type="button" class="red button" id="logout-button" onclick="location.href='logout.php';">Logout</button>
            <?php } ?>
        </div>
    </div>
    </header>
        <section id="container">
    