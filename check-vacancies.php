<?php include 'header.php'; ?>
<?php
if(!isset($_GET['page'])){
    header("location:check-vacancies.php?page=0");
}
if(isset($_SESSION['type']) && $_SESSION['type']=='recruiter'){
    include('connection-db.php');
    $rid=$_SESSION['id'];
    $query="SELECT * FROM vacancy WHERE rid=$rid";
    $result= mysqli_query($con, $query);
    
    if(mysqli_num_rows($result)==0){
        echo 'vacancy is empty';
        exit;
    }
    
    $vacancy = Array();
        $i=0;
        while($row= mysqli_fetch_assoc($result)){
        $vacancy[$i]=array("id"=>$row['id']
                ,"title"=>$row['title']
                ,"capacity"=>$row['capacity']
                ,"available"=>$row['available']
                ,"enddate"=>$row['enddate']
                ,"desc"=>$row['desc']);
        $i++;
        }
    $current_page = $_GET['page'];
    $next_page = $current_page + 1;
    $prev_page = $current_page - 1;
    $first_page = 0;
    $last_page = mysqli_num_rows($result)-1;
        if($prev_page<$first_page){
            $prev_page=$first_page;
        }
        if($next_page>$last_page){
            $next_page=$last_page;
        }
?>
<h1>Check Vacancies</h1>
<?php if(isset($_GET['error']) && $_GET['error']==1) { ?>
<p class="error">error occur</p>
<?php } ?>
    <table class="box" border="1px" cellpadding="10px">
        <tr>
            <td>id: <?php echo $vacancy[$current_page]['id']; ?></td>
            <td>title: <?php echo $vacancy[$current_page]['title']; ?></td>
            <td>capacity: <?php echo $vacancy[$current_page]['capacity']; ?></td>
            <td>available: <?php echo $vacancy[$current_page]['available']; ?></td>
            <td>deadline: <?php echo $vacancy[$current_page]['enddate']; ?></td>
        </tr>
        <tr><td colspan="5"><br/>description: <?php echo $vacancy[$current_page]['desc']; ?><br/></td></tr>
        <?php 
        $query="SELECT sid FROM recruit WHERE vid=".$vacancy[$current_page]['id'];
        $result= mysqli_query($con, $query);
        $sid = Array();
        while($row= mysqli_fetch_assoc($result)){
        $sid[$row['sid']]=array("sid"=>$row['sid']);
        }
        
        foreach($sid as $j){
        $query="select name from user where id=".$j['sid'];
        $result= mysqli_query($con, $query);
        $seeker= mysqli_fetch_assoc($result);
        ?>
        <tr>
            <td colspan="3"><?php echo $seeker['name']; ?></td>
            <td><a class="green button" 
                           style="display:block;text-align: center;"
                           href="#"
                           >view profile</a></td>
            <td><a class="red button" 
                           style="display:block;text-align: center;"
                           href="unrecruit.php?page=<?php echo $current_page; ?>&vid=<?php echo $vacancy[$current_page]['id']; ?>&sid=<?php echo $j['sid']; ?>"
                           >remove</a></td>
        </tr>
        <?php } ?>
    </table>
    <nav align="center"> 
                <a class="blue button" href="?page=<?php echo $first_page ?>" > First</a>
                <a class="blue button" href="?page=<?php echo $prev_page ?>" > Previous</a>
                <a class="blue button" href="?page=<?php echo $next_page ?>" > Next</a>
                <a class="blue button" href="?page=<?php echo $last_page ?>" > Last</a>
            </nav>
<?php } else {
     echo 'you do not have privilege to access this page, please go back to homepage <a href="index.php" style="color:green">click here</a>';
                } ?>
                
<?php include 'footer.php'; ?>