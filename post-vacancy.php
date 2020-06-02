<?php include 'header.php'; ?>

<?php
if(isset($_SESSION['type']) && $_SESSION['type']=='recruiter'){
    if (isset($_POST['add'])) {
        $title=$_POST['title'];
        $capacity=$_POST['capacity'];
        $enddate=$_POST['enddate'];
        $desc=$_POST['desc'];
        $rid=$_SESSION['id'];
        
        $enddate=date('Y-m-d',strtotime($enddate));
        if($enddate<date("Y-m-d")){
            header("location:post-vacancy.php?status=0?error=time");
        }
        
        else{
        include ('connection-db.php');
        $query="INSERT INTO `vacancy`(`title`, `capacity`,`available`, `enddate`, `desc`, `rid`, `ptime`)"
        . " VALUES ('$title',$capacity,$capacity,'$enddate','$desc',$rid,now())";
        $result=mysqli_query($con,$query);
        
            if($result==1){ 
                header("location:post-vacancy.php?status=1");
                
            }
            else {
                header("location:post-vacancy.php?status=0");
            }
        }
}
?>
<h1>Post Vacancy</h1>

<?php if(isset($_GET['status']) AND $_GET['status']==1) {?>
                <p>post Added Successfully</p>
                <button type="button" class="green button" onclick="location.href='post-vacancy.php'">Post More</button>
                
                <?php } else if(isset($_GET['status']) AND $_GET['status']==0) {?>
                <p class="error">post cannot be added</p>
                <button type="button" class="green button" onclick="location.href='post-vacancy.php'">Try Again</button>
                <?php } else {?>
                
<form name="add" method="POST" action="post-vacancy.php">
    <table class="box">
        <tr>
            <td><p>Job's Title</p></td>
            <td><input type="text" name="title" required/></td>
        </tr>
        <tr>
            <td><p>Capacity</p></td>
            <td><input type="text" name="capacity" required/></td>
        </tr>
        <tr>
            <td><p>deadline's date</p></td>
            <td>
                <input type="date" name="enddate" required/>
            </td>
        </tr>
        <tr>
            <td><p>Description</p></td>
            <td><textarea rows="10" cols="75" name="desc" required></textarea></td>
        </tr>
    </table>
    <input type="submit" class="green button" value="Post Vacancy" name="add">
</form>
                <?php } ?>
<?php } else {
     echo 'you do not have privilege to access this page, please go back to homepage <a href="index.php" style="color:green">click here</a>';
                } ?>
                
<?php include 'footer.php'; ?>