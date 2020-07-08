<?php 

	require 'includes/db-inc.php';

	 $bid = $_GET['bid'];
	$sid = $_GET['sid'];

	 $Hajjo = "SELECT * FROM borrow where sid = '$sid' AND bid= '$bid' "; 

	$Hajjo = mysqli_query($conn, $Hajjo);
	if(mysqli_num_rows($Hajjo) > 0){
		header("Location: borrowedbooks.php");
		echo "<script>alert('This same student has borrowed the same book already')</script>"; 
	}else{


 $iCode = "INSERT INTO borrow (bid,sid) VALUES ('$bid', '$sid')"; 
	$iCode = mysqli_query($conn, $iCode);
	if($iCode) {
		header("Location: borrowedbooks.php");
		echo "<script>alert('Borrowed Successfully')</script>"; 
                } else{
       $error = true;
}
                }






?>

