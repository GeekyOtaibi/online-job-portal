<?php include 'header.php'; ?>

       <?php
       if(isset($_SESSION['type']) && $_SESSION['type']=='admin'){
       include ('connection-db.php');
       $query="Select * from vacancy ;";
       $result=  mysqli_query($con, $query);
       $user=array();
       while($row=  mysqli_fetch_assoc($result)){
           $user[$row['id']]=array("id"=>$row['id'],
                   "title"=>$row['title'],
                   "capacity"=>$row['capacity'],
                   "enddate"=>$row['enddate'],
                   "desc"=>$row['desc']
                   );
       }
       if(isset($_GET['delete']))
        {
            $id=$_GET['delete'];
            include ('connection-db.php');
            
            $query="Delete from recruit where vid=$id";
            $result=mysqli_query($con,$query);
            
            
            $query="DELETE FROM vacancy WHERE id=$id";
            $result=mysqli_query($con,$query);
              if($result==1)
            {
                header("location:admin-page1.php?status=1");//this message is for correct inset command 
            }
            else {
                header("location:admin-page1.php?status=0?");//this message is for incorrect inset command
            }
        } 
        ?><?php if(isset($_GET['status']) AND $_GET['status']==1) {?>
        
                           <p>"vacancy deleted successfully" </p>
                <?php } else if(isset($_GET['status']) AND $_GET['status']==0) {?>
                <p> wrong ID </p>
                <?php } else {?> 

 
                <h1 style="font-size: 30px" > Delete </h1>
                <form name="delete" method="Get">
                    <table align="CENTER" cellpadding="10px"  class="box" border="1">
                    <?php foreach ($user as $i){ ?>
                    <tr>
                        <td>id: <?php echo $i['id']; ?></td>
                        <td>title: <?php echo $i['title']; ?></td>
                        <td>capacity: <?php echo $i['capacity']; ?></td>
                        <td>enddate: <?php echo $i['enddate']; ?></td>
                        <td>desc: <?php echo $i['desc']; ?></td>
                        <td><a class="red button" href="admin-page1.php?delete=<?php echo $i['id']; ?>">remove</a></td>
                    </tr>
                    <?php } ?>
                    </table>
                    <br>
                </form>
      
 <?php }?>
                <?php } else {
     echo 'you do not have privilege to access this page, please go back to homepage <a href="index.php" style="color:green">click here</a>';
                } ?>
<?php include 'footer.php'; ?>

