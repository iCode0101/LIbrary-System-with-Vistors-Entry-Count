<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php";


if (isset($_POST['pay'])) {
	$id = trim($_POST['borrower']);
	$msg = "Paid";
	$rdate =  date('d/m/y');
	$sql = "UPDATE borrow set status = '$msg', rdate = '$rdate' where id = '$id'";
	$query = mysqli_query($conn, $sql);


	$error = false;
	if ($query) {
		$error = true;
	}
}

if (isset($_POST['returnB'])) {
	$id = trim($_POST['borrower']);
	$bid = trim($_POST['bid']);
	$rdate =  date('d/m/y');

	$sql = "UPDATE borrow set rdate = '$rdate' where id = '$id'";
	$query = mysqli_query($conn, $sql);

	$sqlBOOK = "SELECT * FROM books WHERE bookId = '$bid'";
	$queryBOOK = mysqli_query($conn, $sqlBOOK);
	$ROW = mysqli_fetch_array($queryBOOK);

	$bc = $ROW['bookCopies'] + 1;
	$AVA = 'YES';
	$sqlB = "UPDATE books set bookCopies = '$bc', available = '$AVA' where bookId = '$id'";
	$queryB = mysqli_query($conn, $sqlB);

	$errorR = false;
	if ($queryB) {
		$errorR = true;
	}
}


?>


<div class="container">
	<?php include "includes/nav.php"; ?>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example">
					<span class="sr-only">:</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">KSITM | LIBRARY</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example">
				<ul class="nav navbar-nav">
					<?php if (isset($admin)) { ?>
						<li><a href="admin.php">Home</a></li>
						<li><a href="bookstable.php">Books</a></li>
						<li><a href="users.php">Admins</a></li>
						<li><a href="viewstudents.php">Students</a></li>
						<li><a href="history.php">History</a></li>
						<li><a href="borrowedbooks.php">Borrow books</a></li>
						<li class="active"><a href="fines.php">Fines</a></li>
					<?php } ?>
					<?php if (isset($student)) { ?>
						<li class="active"><a href="studentportal.php">Home</a></li>
						<li><a href="profile.php">View Profile</a></li>
						<li><a href="borrow-student.php">Borrow Books</a></li>
						<li><a href="fine-student.php">Fines</a></li>
				</ul>
			<?php } ?>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="logout.php">Logout</a></li>
			</ul>
			</div>
		</div>
	</nav>
	<!-- navbar ends -->
	<!-- info alert -->
	<div class="alert alert-warning col-lg-7 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-0 col-sm-offset-1 col-xs-offset-0" style="margin-top:70px">

		<span class="glyphicon glyphicon-book"></span>
		<strong>Fines</strong> Table
	</div>

</div>
<div class="container">
	<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading">
			<?php if (isset($error) === true) { ?>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Fine Paid Successfully!</strong>
				</div>
			<?php } ?>

			<?php if (isset($errorR) === true) { ?>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Book returned Successfully!</strong>
				</div>
			<?php } ?>

			<div class="row">
				<!--   <a><button class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-xs-11 button" style="margin-left: 15px;margin-bottom: 5px"> Fines</button></a> -->
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
					<!-- <form >
			  		<div class="input-group pull-right">
				      <span class="input-group-addon">
				        <label>Search</label> 
				      </span>
				      <input type="text" class="form-control">
			      </div>
			  	</form> -->

				</div><!-- /.col-lg-6 -->

			</div>
		</div>


		<table class="table table-bordered">
			<thead>
				<tr>
					<th>S/N</th>
					<th>Member Name</th>
					<th>Matric Number</th>
					<th>Book Name</th>
					<th>Borrow date</th>
					<th>Return Date</th>
					<th>Overdue Charges</th>
					<th>Status</th>

					</th>
					<th>ACTION</th>
				</tr>
			</thead>

			<?php
			$cntr = 1;
			$sql = "SELECT * FROM borrow";
			$query = mysqli_query($conn, $sql);
			$row = mysqli_fetch_assoc($query);

			if (date('d/m/y') - ($row['ddate']) < 1) {
				$overdue =  '0';
			} else {
				$overdue =  (date('d/m/y') - $row['ddate']);
			}

			while ($row = mysqli_fetch_assoc($query)) {
				$bid = $row['bid'];
				$sid = $row['sid'];

				$sql1 = "SELECT * FROM students WHERE id = '$sid'";
				$query1 = mysqli_query($conn, $sql1);
				$row1 = mysqli_fetch_assoc($query1);

				$sql11 = "SELECT * FROM books WHERE bookId = '$bid'";
				$query11 = mysqli_query($conn, $sql11);
				$row11 = mysqli_fetch_assoc($query11);
			?>

				<tbody>
					<tr>
						<td><?php echo $cntr; ?></td>
						<td><?php echo $row1['fullname']; ?></td>
						<td><?php echo $row1['regno']; ?></td>
						<td><?php echo $row11['bookTitle']; ?></td>
						<td><?php echo $row['bdate']; ?></td>
						<td><?php echo $row['rdate']; ?></td>
						<td style="color: red;"><?php echo $overdue * 100; ?></td>
						<td style="color: green;"><?php echo $row['status']; ?></td>
						<form action="fines.php" method="post">
							<input type="hidden" value="<?php echo $row['id']; ?>" name="borrower">
							<input type="hidden" value="<?php echo $row['bid']; ?>" name="bid">

							<?php if ($row['status'] == "Paid" || $overdue == 0) {
								echo '<td><button class="btn btn-warning" name="pay" disabled>Pay Fine</button></td>';
							} else {
								echo '<td><button class="btn btn-warning" name="pay">Pay Fine</button></td>';
							}
							echo '<td><button class="btn btn-warning" name="returnB" >Return Book</button></td>';

							?>
						</form>

					</tr>
				<?php $cntr++;
			}  ?>
				</tbody>
		</table>

	</div>
</div>
<div class="mod modal fade" id="popUpWindow">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- header begins here -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"> Warning</h3>
			</div>

			<!-- body begins here -->
			<div class="modal-body">
				<p>Are you sure you want to delete this book?</p>
			</div>

			<!-- button -->
			<div class="modal-footer ">
				<button class="col-lg-4 col-sm-4 col-xs-6 col-md-4 btn btn-warning pull-right" style="margin-left: 10px" class="close" data-dismiss="modal">
					No
				</button>&nbsp;
				<button class="col-lg-4 col-sm-4 col-xs-6 col-md-4 btn btn-success pull-right" class="close" data-dismiss="modal" data-toggle="modal" data-target="#info">
					Yes
				</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="info">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- header begins here -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title"> Warning</h3>
			</div>

			<!-- body begins here -->
			<div class="modal-body">
				<p>Book deleted <span class="glyphicon glyphicon-ok"></span></p>
			</div>

		</div>
	</div>
</div>





<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>