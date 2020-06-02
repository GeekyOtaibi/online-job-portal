<?php include('header.php'); ?>
<?php
include('connection-db.php');
    if(isset($_GET['sid']) && isset($_GET['vid']))
    {
        $sid=$_GET['sid'];
        $vid=$_GET['vid'];
        $page=$_GET['page'];
        
        $query="DELETE FROM `recruit` WHERE `recruit`.`vid` = $vid AND `recruit`.`sid` = $sid";
        $result=mysqli_query($con,$query);
        if($result==1)
        {
            $query="SELECT available FROM vacancy WHERE id=$vid";
                $result= mysqli_query($con, $query);
                $row= mysqli_fetch_row($result);
                $update=$row[0]+1;
                $query="UPDATE vacancy SET available=$update WHERE id=$vid";
                $result= mysqli_query($con, $query);
            header("location:check-vacancies.php?page=$page&error=0");
        }
        else {
            header("location:check-vacancies.php?page=$page&error=1");
        }
    }
?>

	<?php include('footer.php'); ?>

