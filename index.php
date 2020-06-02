<?php include 'header.php'; ?>
<?php 
    if(!isset($_GET['page'])){
        header("location:index.php?page=0");
    }
    include('connection-db.php');
        if(isset($_SESSION['type']) && $_SESSION['type']=='seeker'){
            $sid=$_SESSION['id'];
            $query ="Select * from profiles where sid=$sid";
            $result= mysqli_query($con, $query);
            if(!mysqli_num_rows($result)){
                header("location:add.php");
            }
        }
        
        $query ="SELECT vacancy.id, vacancy.title,"
                . " vacancy.capacity,"
                . " vacancy.enddate, vacancy.desc, user.name"
                . " FROM vacancy INNER JOIN user ON vacancy.rid=user.id";
        
        $result = mysqli_query($con, $query);
        $total_records = mysqli_num_rows($result) ;
        $deadline = date("Y-m-d", time()-86400); //1 Day = 24*60*60 = 86400
        $current_page = $_GET['page'];
        $per_page = 5;
        $first_page = 0;
        $page_count = ceil($total_records / $per_page) ;
        $idle_last = $page_count * $per_page;
        $last_page = ($idle_last - ($idle_last - $total_records))-5;
        $next_page = $current_page + 5;
        $prev_page = $current_page - 5;
        
        if($prev_page<$first_page){
            $prev_page=$first_page;
        }
        if($next_page>$last_page){
            $next_page=$last_page;
        }
             $query ="SELECT vacancy.id, vacancy.title,"
                . " vacancy.capacity,vacancy.available,"
                . " vacancy.enddate, vacancy.desc, user.name"
                . " FROM vacancy INNER JOIN user ON vacancy.rid=user.id"
                . " ORDER BY ptime DESC LIMIT $current_page,$per_page";
        $result = mysqli_query($con, $query);
        
        $vacancy = Array();
        while($row= mysqli_fetch_assoc($result)){
        $vacancy[$row['id']]=array("id"=>$row['id']
                ,"title"=>$row['title']
                ,"capacity"=>$row['capacity']
                ,"available"=>$row['available']
                ,"enddate"=>$row['enddate']
                ,"desc"=>$row['desc']
                ,"recruiter"=>$row['name']);
        }
    
?>
        <h1>Vacancy list available</h1>
        <form id="Vacancies-list" name="vacancy" action="index.php">
            <?php if(isset($_GET['status']) && $_GET['status']=='send'){ ?>
            <p>email is sended</p>
            
            <?php }foreach($vacancy as $i) {?>
            <table class="box">
                <tr>
                    <td class="vacancy-img"><img src="img/vacancy.jpg" alt="vacancy"/></td>
                    <td class="job-info">   
                        <ul>
                            <li><?php echo $i['id']; ?></li>
                            <li><?php echo $i['recruiter']; ?></li>
                            <li><?php echo $i['title']; ?></li>
                            <li> capacity: <?php echo $i['available']."/".$i['capacity']; ?></li>
                            <li>Deadline: <br><?php echo $i['enddate']; ?></li>
                        </ul>
                    </td>
                    <td class="job-description">
                        <?php echo $i['desc']; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <?php if(isset($_SESSION['type']) && $_SESSION['type']=='seeker'
                                && $i['available']!=0 && $i['enddate']>$deadline){ ?>
                        <a class="button" 
                           style="display: block;text-align: center;"
                           href="apply-to-job.php?vid=<?php echo $i['id'];?>"
                           >Apply</a>
                        <?php } ?>
                       
                    </td>
                </tr>
            </table>
            <?php }
            if($total_records>5){    ?>
            <nav align="center"> 
                <a class="blue button" href="?page=<?php echo $first_page ?>" > First</a>
                <a class="blue button" href="?page=<?php echo $prev_page ?>" > Previous</a>
                <a class="blue button" href="?page=<?php echo $next_page ?>" > Next</a>
                <a class="blue button" href="?page=<?php echo $last_page ?>" > Last</a>
            </nav>
            <?php } ?>
        </form>
<?php include 'footer.php'; ?>
