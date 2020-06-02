<?php include 'header.php';?>
<?php 

if(isset($_SESSION['type']) && $_SESSION['type']=='seeker'){
	   	if(isset($_SESSION['id'])){
	   $sid = $_SESSION['id'];
         $query="SELECT * FROM profiles WHERE sid=$sid";
         $result=mysqli_query($con,$query);
         $row=mysqli_fetch_assoc($result);
         
                }
	
	if(isset($_POST['update']))
	{
		
		$name = $_POST['Name'];
		
		$address = $_POST['Address'];
                $email = $_POST['Email'];
		$website = $_POST['Website'];
		$phone = $_POST['Phone'];
		$CSkill = $_POST['ComputerSk'];
		$objective = $_POST['Objective'];
                
		$edu = $_POST['Education'];
		$BYOG = $_POST['BYOGrad'];
		$Buni = $_POST['BUniversity'];
		$BCountry = $_POST['BCountry'];
                
		$CPosition = $_POST['CPosition'];
		$YOJoin = $_POST['YOJoin'];
		$organization = $_POST['Organization'];
		$NOJob = $_POST['NOJob'];
		$PExp = $_POST['PExp'];
		$YOJoining = $_POST['YOJoining'];
		$YOLeave = $_POST['YOLeave'];
		
		$DS = $_POST['DS'];
		$SS = $_POST['SS'];
		include ('connection-db.php');
                if($_FILES['image']['name']=="")
            {
                $path=$_POST['file'];
                $query="UPDATE `profiles`  SET name='$name', Address='$address', Email='$email', Website='$website',"
                        . " Phone=$phone, CSkills='$CSkill', Objective='$objective', Degree='$edu'"
                        . " , YOG=$BYOG , University='$Buni' , Country='$BCountry' , Cposition='$CPosition',"
                        . " YOJ=$YOJoin, Org='$organization', NOJob='$NOJob', PWExp='$PExp', PYOJ=$YOJoining,"
                        . " PYOL=$YOLeave, DSkills='$DS', SSkills='$SS' WHERE sid='$sid'";
                $result=mysqli_query($con,$query);
                if($result==1)
                {
                    header("location:update.php?status=1");
                   
                }
                else {
                    header("location:update.php?status=0");
                }
            }
	
           $location="img/profiles/"; //folder location
                     
           $filename=$_FILES['image']['name'];//get the file name with e
           $ext=end(explode('.', $filename));//get only the extension
           $final_name="profile-".$name.'.'.$ext;//final name of the image
           
           
           $path=$location.$final_name;//end location and filename which appears in DB
           
           $extensions=array('jpg','jpeg','JPEG');//extensions allowed to be uploaded
           $type=in_array($ext, $extensions);//check the extension of uploaded file

          
          if( $_FILES['image']['size']<10000000 && $type && $_FILES['image']['error']==0)//check the size,type,error(which should be 0(zer0))
          {
              $out=move_uploaded_file($_FILES["image"]["tmp_name"], $path);//move the file to the final location
           
          
            if($out)
                     {      
                $sid=$_SESSION['id'];

                $query="UPDATE `profiles`  SET name='$name', Address='$address',Email='$email', Website='$website',"
                        . " Phone=$phone, CSkills='$CSkill', Objective='$objective', Degree='$edu'"
                        . " , YOG=$BYOG , University='$Buni' , Country='$BCountry' , Cposition='$CPosition',"
                        . " YOJ=$YOJoin, Org='$organization', NOJob='$NOJob', PWExp='$PExp', PYOJ=$YOJoining,"
                        . " PYOL=$YOLeave, DSkills='$DS', SSkills='$SS', img='$path' WHERE sid='$sid'";

                $result=mysqli_query($con,$query);

                if($result==1)
                {
                    header("location:update.php?status=1");//this message is for correct inset command 
                }
                else {
                    header("location:update.php?status=0?");//this message is for incorrect inset command
                }
            }
          }
          else {
              
             $query="UPDATE `profiles`  SET name='$name', Address='$address',Email='$email', Website='$website',"
                        . " Phone=$phone, CSkills='$CSkill', Objective='$objective', Degree='$edu'"
                        . " , YOG=$BYOG , University='$Buni' , Country='$BCountry' , Cposition='$CPosition',"
                        . " YOJ=$YOJoin, Org='$organization', NOJob='$NOJob', PWExp='$PExp', PYOJ=$YOJoining,"
                        . " PYOL=$YOLeave, DSkills='$DS', SSkills='$SS' WHERE sid='$sid'";
                $result=mysqli_query($con,$query);
                
          }
		
	}
?>

		<?php if(isset($_GET['status']) AND $_GET['status']==1) {?>
                <p>Item Updated Successfully</p>
                <?php } else if(isset($_GET['status']) AND $_GET['status']==0) {?>
                <p>Item Cannot be Updated</p>
                <?php } else {?>
                	
					  
					
                <form name="update" action="update.php" method="POST" enctype="multipart/form-data" onload="element()">
                <table class="box"> 

                    <tr><td><p>Name</p></td>   	<td><input required type="text" name="Name"  value="<?php echo $_SESSION['name']; ?>" /></td></tr>
		
		<tr><td><p> Address </p></td>   <td><input required type="text" name="Address" value="<?php echo $row['Address'];?>"/></td></tr>
		
                <tr><td><p> Email </p></td>   <td><input required type="email" name="Email" value="<?php echo $row['Email'];?>"/></td></tr>
                
		<tr><td><p>Website </p></td>   <td><input required type="url" name="Website" value="<?php echo $row['Website'];?>"/></td></tr>
		
		<tr><td><p>Phone </p></td>	<td><input required type="text" name="Phone" value="<?php echo $row['Phone'];?>"/></td></tr>
		
		<tr><td><p>Computer Skill </p></td>	<td><input required type="text" name="ComputerSk" value="<?php echo $row['CSkills'];?>"/></td></tr>
		
		<tr><td><p>Objective </p></td>	<td><input required type="text" name="Objective" value="<?php echo $row['Objective'];?>"/></td></tr>
		
		<tr><td><p>Education</p> </td> 
			<td><select name="Education">
				<option value="Bachelor" <?=$row['Degree']=="Bachelor" ? 'selected = "selected"' : '';?>>Bachelor</option>
				<option value="Masters" <?= $row['Degree']=="Masters" ? 'selected = "selected"' : '';?>>Masters</option>
				<option value="Doctorate" <?= $row['Degree']=="Doctorate" ? 'selected = "selected"' : '';?>>>Doctorate</option>
			</select></td>
		
		<tr><td><p>Year of graduation </p></td>	<td><input required type="text" name="BYOGrad" value="<?php echo $row['YOG'];?>"/></td></tr>
		
		<tr><td><p>University </p></td>	<td><input required type="text" name="BUniversity" value="<?php echo $row['University'];?>"/></td></tr>
		
		<tr><td><p>Country </p></td>	<td><input required type="text" name="BCountry" value="<?php echo $row['Country'];?>"/></td></tr>
		
		<tr><td><p>Current Position </p></td>	<td><input required type="text" name="CPosition" value="<?php echo $row['Cposition'];?>"/></td></tr>
		
		<tr><td><p>Year of joining </p></td>	<td><input required type="text" name="YOJoin" value="<?php echo $row['YOJ'];?>"/></td></tr>
		
		<tr><td><p>Organization </p></td>	<td><input required type="text" name="Organization" value="<?php echo $row['Org'];?> "/></td></tr>
		
		<tr><td><p>Nature of job </p></td>	<td><input required type="text" name="NOJob" value="<?php echo $row['NOJob'];?> "/></td></tr>
		
		<tr><td><p>Previous work experience </p></td>	<td><input required type="text" name="PExp" value="<?php echo $row['PWExp'];?>"/></td></tr>
		
		<tr><td><p>Year of joining</p></td>	<td><input required type="text" name="YOJoining" value="<?php echo $row['PYOJ'];?>"/></td></tr>
		
		<tr><td><p>Year of Leaving</p></td>	<td><input required type="text" name="YOLeave" value="<?php echo $row['PYOL'];?>"/></td></tr>
		
		<tr><td><p>Skills</p></td></tr>
		
		<tr><td><p>	Development Skills</p></td>	<td><input required type="text" name="DS" value="<?php echo $row['DSkills'];?>"/></td></tr>
		
		<tr><td>	<p>Software Skills</p></td>	<td><input required type="text" name="SS" value="<?php echo $row['SSkills'];?> "/></td></tr>
		
		  <tr><td><p>Upload Image</p></td>
		  	 <td>   <img src="<?php echo $row['img'];?>" width="150" height="100"/>
                                <input type="file" name="image" id="image">
                                <input type="hidden" name="file" value="<?php echo $row['img'];?>"/>
                                <span style="font-size: 0.6em; font-style: italic;">(Maximum 500 KB)</span>
                            </td>
                        </tr>
	</table>
	
	<input type="submit" class="green button" value="Apply" name="update" method="POST" />
        <input type="button" class="red button" value="Cancel" onclick="location.href='index.php'" />
	</form>

	<?php } ?>
        <?php } else {
        echo 'you do not have privilege to access this page, please go back to homepage'
            . ' <a href="index.php" style="color:green">click here</a>';
                } ?>
                
	<?php include 'footer.php';?>
	


