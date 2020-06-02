<?php include 'header.php';?>
<?php 
if(isset($_SESSION['type']) && $_SESSION['type']=='seeker'){
	if(isset($_POST['add']))
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

            $query="INSERT INTO  `profiles`  SET name='$name', Address='$address',Email='$email', Website='$website',"
                    . " Phone=$phone, CSkills='$CSkill', Objective='$objective', Degree='$edu'"
                    . " , YOG=$BYOG , University='$Buni' , Country='$BCountry' , Cposition='$CPosition',"
                    . " YOJ=$YOJoin, Org='$organization', NOJob='$NOJob', PWExp='$PExp', PYOJ=$YOJoining,"
                    . " PYOL=$YOLeave, DSkills='$DS', SSkills='$SS', img='$path', sid=$sid";
            
            $result=mysqli_query($con,$query);
            
            if($result==1)
            {
                header("location:add.php?status=1");//this message is for correct inset command 
            }
            else {
                header("location:add.php?status=0?");//this message is for incorrect inset command
            }
            
        }
          }
          else {
              header("location:add.php?status=0?");//this message is for file upload error
          }
		
	}

?>
		<?php if(isset($_GET['status']) AND $_GET['status']==1) {?>
                <p>Item Added Successfully</p>
                <?php } else if(isset($_GET['status']) AND $_GET['status']==0) {?>
                <p>Item Cannot be added</p>
                <?php } else {?>
                <form name="add" action="add.php" method="POST" enctype="multipart/form-data">
                <table class="box"> 

		<tr><td><p>Name</p></td>   	<td><input type="text" name="Name" value="<?php echo $_SESSION['name']; ?>" /></td></tr>
		
		<tr><td><p> Address </p></td>   <td><input type="text" name="Address" required/></td></tr>
                
		<tr><td><p> Email </p></td>   <td><input type="email" name="Email" required/></td></tr>
                
                <tr><td><p>Website </p></td>   <td><input type="url" name="Website" required/></td></tr>
		
                <tr><td><p>Phone </p></td>	<td><input type="text" name="Phone" required/></td></tr>
		
		<tr><td><p>Computer Skill </p></td>	<td><input type="text" name="ComputerSk" required/></td></tr>
		
		<tr><td><p>Objective </p></td>	<td><input type="text" name="Objective" required/></td></tr>
		
		<tr><td><p>Education</p> </td> 
			<td><select name="Education">
				<option value="Bachelor">Bachelor</option>
				<option value="Masters">Masters</option>
				<option value="Doctorate">Doctorate</option>
			</select></td>
		
		<tr><td><p>Year of graduation </p></td>	<td><input type="text" name="BYOGrad" required/></td></tr>
		
		<tr><td><p>University </p></td>	<td><input type="text" name="BUniversity" required/></td></tr>
		
		<tr><td><p>Country </p></td>	<td><input type="text" name="BCountry" required/></td></tr>
		
		<tr><td><p>Current Position </p></td>	<td><input type="text" name="CPosition" required/></td></tr>
		
		<tr><td><p>Year of joining </p></td>	<td><input type="text" name="YOJoin" required/></td></tr>
		
		<tr><td><p>Organization </p></td>	<td><input type="text" name="Organization" required/></td></tr>
		
		<tr><td><p>Nature of job </p></td>	<td><input type="text" name="NOJob" required/></td></tr>
		
		<tr><td><p>Previous work experience </p></td>	<td><input type="text" name="PExp" required/></td></tr>
		
		<tr><td><p>Year of joining</p></td>	<td><input type="text" name="YOJoining" required/></td></tr>
		
		<tr><td><p>Year of Leaving</p></td>	<td><input type="text" name="YOLeave" required/></td></tr>
		
		<tr><td><p>Skills</p></td></tr>
		
		<tr><td><p>	Development Skills</p></td>	<td><input type="text" name="DS" required/></td></tr>
		
                <tr><td>	<p>Software Skills</p></td>	<td><input type="text" name="SS" required/></td></tr>
		
		  <tr><td><p>Upload Image</p></td>
		  	 <td> <input type="file" name="image" id="image"/>
                                <span style="font-size: 0.6em; font-style: italic;">(Maximum 500 KB)</span>
                            </td>
                        </tr>
		
	</table>
	
	<input type="submit" class="green button" value="Apply" name="add" method="POST" />
	</form>
	<?php } ?>
        <?php } else {
        echo 'you do not have privilege to access this page, please go back to homepage'
            . ' <a href="index.php" style="color:green">click here</a>';
                } ?>
                
	<?php include 'footer.php';?>
	


