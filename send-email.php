<        <?php
        require('fpdf/fpdf.php');//get the api (fpdf)
           $host="localhost";//here we creat the connction
        $user="root";
        $pwd="";
        $db="job_portal";
        
        $con=mysqli_connect($host,$user,$pwd,$db);
        
        if(mysqli_connect_errno($con))
        {
            echo mysqli_connect_error();
        }
        
                
          
           
            session_start();//here we start the session to get what we need like id,type
            if(isset($_SESSION['type']) && $_SESSION['type']=='seeker'){

            $sid = $_SESSION['id'];
            $query="select * from profiles WHERE sid=$sid";
            $result=mysqli_query($con,$query);
            
            while($row=mysqli_fetch_assoc($result))
            {
                $stuff=array();    
                $stuff[$row['sid']]=array("name"=>$row['Name']
                                          ,"address"=>$row['Address']
                                          ,"Email"=>$row['Email']
                                          ,"website"=>$row['Website']
                                          ,"phone"=>$row['Phone']
                                          ,"CSkills"=>$row['CSkills']
                                          ,"Objective"=>$row['Objective']
                                          ,"Degree"=>$row['Degree']
                                          ,"YOG"=>$row['YOG']
                                          ,"University"=>$row['University']
                                          ,"Country"=>$row['Country']
                                          ,"Cposition"=>$row['Cposition']
                                          ,"YOJ"=>$row['YOJ']
                                          ,"Org"=>$row['Org']
                                          ,"NOJob"=>$row['NOJob']
                                          ,"PWExp"=>$row['PWExp']
                                          ,"PYOJ"=>$row['PYOJ']
                                          ,"PYOL"=>$row['PYOL']
                                          ,"DSkills"=>$row['DSkills']
                                          ,"SSkills"=>$row['SSkills']
                                          ,"img"=>$row['img']);
            }
               $query1="select Name from profiles WHERE sid=$sid"; 
            $result1=mysqli_query($con,$query1);
        $row2= mysqli_fetch_assoc($result1);
        $name = $row2['Name'];//here we get the image name
class PDF extends FPDF
{

// Page header
function Header()
{   global $name;//here we get $name 
    // here we get the image 
    $this->Image("img/profiles/profile-$name.jpg",10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(70,10,'Online Job Portal',1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();//here we creat the page 
$pdf->SetFont('Times','',12);//here we chang the font style 

$pdf->Cell(0,10,"--------------------------------------------------------------------------------------------------------------------",0,1);
$pdf->Cell(0,10,"  Profile's infomation ",1,1); 





foreach($stuff as $i){
    $pdf->Cell(50,10,"Name:",1,0); //this useed to creat cell-size,thik,string,next 
    $pdf->Cell(50,10,$i['name'],1,0);
    
    $pdf->Cell(50,10,"Address:",1,0);
    $pdf->Cell(40,10,$i['address'],1,1);
    
    $pdf->Cell(50,10,"Email:",1,0); 
    $pdf->Cell(50,10,$i['Email'],1,0);
    
    $pdf->Cell(30,10,"website:",1,0); 
    $pdf->Cell(60,10,$i['website'],1,1);

    $pdf->Cell(50,10,"phone:",1,0);
    $pdf->Cell(50,10,$i['phone'],1,0);
    
    $pdf->Cell(50,10,"computer Skill:",1,0); 
    $pdf->Cell(40,10,$i['CSkills'],1,1);

    $pdf->Cell(50,10,"Objctive:",1,0);
    $pdf->Cell(50,10,$i['Objective'],1,1);
    
    $pdf->Cell(190,10,'',1,1);//here we skip
    
    $pdf->Cell(50,10,"Degree:",1,0); 
    $pdf->Cell(50,10,$i['Degree'],1,0);
    
    $pdf->Cell(40,10,"Year of graduation:",1,0); 
    $pdf->Cell(50,10,$i['YOG'],1,1);

    $pdf->Cell(50,10,"University:",1,0);
    $pdf->Cell(50,10,$i['University'],1,1);
    
    $pdf->Cell(50,10,"Country:",1,0); 
    $pdf->Cell(50,10,$i['Country'],1,1);
    
    
    $pdf->Cell(190,10,'',1,1);
    
    $pdf->Cell(50,10,"Current Position:",1,0);
    $pdf->Cell(50,10,$i['Cposition'],1,1);
    
    $pdf->Cell(50,10,"Year of joining:",1,0); 
    $pdf->Cell(50,10,$i['YOJ'],1,0);
    
    $pdf->Cell(50,10,"Organization:",1,0);
    $pdf->Cell(40,10,$i['Org'],1,1);
    
    $pdf->Cell(50,10,"Nature of job:",1,0); 
    $pdf->Cell(50,10,$i['NOJob'],1,0);
    
    $pdf->Cell(50,10,"Previous work experience:",1,0);
    $pdf->Cell(40,10,$i['PWExp'],1,1);
    
    $pdf->Cell(50,10,"Year of joining:",1,0); 
    $pdf->Cell(50,10,$i['PYOJ'],1,0);
    
    $pdf->Cell(50,10,"Year of Leaving:",1,0);
    $pdf->Cell(40,10,$i['PYOL'],1,1);
    
    $pdf->Cell(190,10,'',1,1);
    
    $pdf->Cell(50,10,"Development Skills:",1,0);
    $pdf->Cell(50,10,$i['DSkills'],1,1);
    
    $pdf->Cell(50,10,"Software Skills:",1,0); 
    $pdf->Cell(50,10,$i['SSkills'],1,0);
    
    
    
}
    
    $pdf->Output('Filename.pdf', 'F');
            }
            else {
        echo 'you do not have privilege to access this page, please go back to homepage'
            . ' <a href="index.php" style="color:green">click here</a>';
                }
            ?>
