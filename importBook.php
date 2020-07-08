<?php
require 'includes/db-inc.php';
if(isset($_POST["submitList"]))
{
 $file = $_FILES['file']['tmp_name'];
 $handle = fopen($file, "r");

$countR = 0;
$countR2 = 0;
fgets($handle); 
 while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
 {

$bookTitle = trim($filesop[0]);
$author = trim($filesop[1]);
$ISBN = trim($filesop[2]);
$bookCopies = trim($filesop[3]);
$publisherName = trim($filesop[4]);
$year = trim($filesop[5]);
$available = "YES";
$categories = trim($filesop[6]);
$callNumber = trim($filesop[7]);

	$checkReg = "SELECT * from books where ISBN = '$ISBN'";
	$queryReg = mysqli_query($conn, $checkReg);
	if (mysqli_num_rows($queryReg) > 0){
$countR2 ++;
			
 }else{

$sql = "INSERT INTO books(bookTitle, author, ISBN, bookCopies, publisherName, year, available, categories, callNumber)
                values ('$bookTitle', '$author', '$ISBN', '$bookCopies', '$publisherName','$year', '$available', '$categories', '$callNumber')";
$countR ++;
    $query = mysqli_query($conn, $sql);

 }}

 if($sql){
 	?>
 	<script type="text/javascript"> alert("<?php  echo $countR; ?>" + " Book(s) Uploaded, " + "<?php  echo $countR2; ?>" + " Books already exist in the Archive" )</script>
			<script type="text/javascript">  window.location = 'bookstable.php';  </script>
	<?php
 }else{
 ?>
 	<script type="text/javascript"> alert("Error during upload, please upload a valid file")</script>
			<script type="text/javascript">  window.location = 'bookstable.php';  </script>
<?php

 }
}
?>