<?php
require 'includes/db-inc.php';

$bookID = $_GET['bookID'];
	$sql_del = "DELETE from books where BookId = $bookID";
	$error = false;
	$result = mysqli_query($conn, $sql_del);
			if ($result)
			{
        echo "<script>alert('Successfully deleted')</script>"; 
		header("Location: bookstable.php");
			}
	      else{
		      $error = true;
      }
