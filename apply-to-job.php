<?php include 'header.php'; ?>
<?php 
if(isset($_SESSION['username']) && $_SESSION['type']=='seeker'){
    if(isset($_GET['vid'])){
        $vid = $_GET['vid'];
        $sid = $_SESSION['id'];
        include ('connection-db.php');
        
        $query="SELECT enddate FROM vacancy WHERE id=$vid";
        $result= mysqli_query($con, $query);
        $row= mysqli_fetch_assoc($result);
        $enddate = $row['enddate'];
        $deadline = date("Y-m-d", time()-86400); //1 Day = 24*60*60 = 86400
        if($enddate<$deadline){ header("location:index.php"); }
        
        else{
            $query="INSERT INTO `recruit`(`vid`, `sid`) VALUES ($vid,$sid)";
            $result= mysqli_query($con, $query);
            if($result==1){
                $query="SELECT available FROM vacancy WHERE id=$vid";
                $result= mysqli_query($con, $query);
                $row= mysqli_fetch_row($result);
                $update=$row[0]-1;
                $query="UPDATE vacancy SET available=$update WHERE id=$vid";
                $result= mysqli_query($con, $query);
                header("location:apply-to-job.php?status=1");
            }
            else{
                header("location:apply-to-job.php?status=0");
            }
        }
    }
    if(isset($_GET['status']) AND $_GET['status']==1) {
        
        ?>
                <p>applied Successfully</p>
                <button type="button" class="green button" onclick="location.href='index.php'">back to home</button>
                <?php } else if(isset($_GET['status']) AND $_GET['status']==0) {?>
                <p class="error">it's Already applied</p>
                <button type="button" class="green button" onclick="location.href='index.php'">back to home</button>
<?php } }else{
         echo 'you do not have privilege to access this page, please go back to '
        . 'homepage <a href="index.php" style="color:green">click here</a>';
}
?>
<?php include 'footer.php'; ?>