<?php 

	require 'includes/db-inc.php';

	$id = $_GET['id'];
	$status = "out";
	$checkoutTime =  date('h:i:sa');
	$sql_del = "UPDATE  checkin SET status = '$status' where id = $id"; 
        $error = false;
	$result = mysqli_query($conn,$sql_del);
			if ($result)
			{
        echo "<script>alert('Checked-Out Successfully')</script>"; 
		header("Location: index.php");
			}
	      else{
		      $error = true;
      }
?>

