<?php
require 'includes/db-inc.php';
if(isset($_POST["submitList"]))
{
 $file = $_FILES['file']['tmp_name'];
 $handle = fopen($file, "r");

 $countR = 0;
 $countR2 = 0;

 while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
 {

$name  = trim($filesop[0]);
 $regno = trim($filesop[1]);
 switch (substr($regno, 0, 7)) {
 	case 'NID/BOP':
 		$deptt = "Banking Operations";
 		break;
 	case 'NID/CSE':
 		$deptt = "Computer Software Engineering";
 		break;
 	case 'NID/MMP':
 		$deptt = "Multimedia Technology";
 		break;
 	case 'NID/NSS':
 		$deptt = "Networking and System Security";
 		break; 
 	case 'NID/CHE':
 		$deptt = "Computer Hardware Engineering Technology";
 		break;
 	case 'NID/SMT':
 		$deptt = "Security Management and Technology";
 		break;
 	case 'NID/TCT':
 		$deptt = "Telecommunications Technology";
 		break;
 	case 'NID/EEE':
 		$deptt = "Electrical/Electronic Engineering";
 		break; 
 	case 'NID/BIM':
 		$deptt = "Business Informatics";
 		break;
 	case 'NID/IBF':
 		$deptt = "Islamic Banking and Finance";
 		break; 						

 }
 $prog = trim($filesop[2]);
 $sem = date('yy-m-d'); 
 $email = trim($filesop[3]);
 $phone = trim($filesop[4]);
 $gender = trim($filesop[5]);
 
	$checkReg = "SELECT * from students where regno = '$regno'";
	$queryReg = mysqli_query($conn, $checkReg);
	if (mysqli_num_rows($queryReg) > 0){

$countR2 ++;
			
 }else{
 	      $sql = "INSERT INTO students( fullname, regno,  dept, prog, sem, email, phone, gender)
                           VALUES ('$name', '$regno', '$deptt', '$prog', '$sem', '$email', '$phone', '$gender') ";
      $query = mysqli_query($conn, $sql);
$countR ++;
      
  }}

 if($sql){
 	?>
 	<script type="text/javascript"> alert("<?php  echo $countR; ?>" + " Students(s) Uploaded, " + "<?php  echo $countR2; ?>" + " Students already exist in the Archive" )</script>
			<script type="text/javascript">  window.location = 'viewstudents.php';  </script>
	<?php
 }else{
 ?>
 	<script type="text/javascript"> alert("Error during upload, please upload a valid file")</script>
			<script type="text/javascript">  window.location = 'viewstudents.php';  </script>
<?php

 }
}
?>