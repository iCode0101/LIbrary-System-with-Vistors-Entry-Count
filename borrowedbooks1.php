<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php";

?>

<br><br><br>
<img src="images/header.png" width="100%">
<div class="container">
	<?php include "includes/nav.php"; ?> <nav class="navbar navbar-inverse navbar-fixed-top">
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
						<li class="active"><a href="borrowedbooks.php">Borrow books</a></li>
						<li><a href="fines.php">Fines</a></li>
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
		<span class="glyphicon glyphicon-book"> </span> Books borrowed today (<strong style="color: green"><?php echo date('d/m/y');  ?></strong>) must be return on or before <strong style="color: red"><?php echo date('d/m/y', strtotime(' + 3 days')); ?> </strong>(3 Days), failure to comply will attract the fine of 100 Naira on each extra day.</span>
	</div>
</div>



<div class="container">
	<div class="panel panel-default">
		<!-- Default panel contents -->


		<?php

		if (isset($_POST['submit'])) {
			$sid = trim($_POST['sid']);
			$bid = trim($_POST['bid']);
			$bdate = date('d/m/y');
			$ddate = date('d/m/y', strtotime(' + 3 days'));
			$statusR = 'Borrowed';

			$Hajjo = "SELECT * FROM borrow where sid = '$sid' AND bid= '$bid'  AND statusR = !null || statusR = '$statusR'";

			$Hajjo = mysqli_query($conn, $Hajjo);
			if (mysqli_num_rows($Hajjo) > 0) {
				echo "<div class='alert alert-danger alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<strong style='text-align: center'> This same student has borrowed the same book already </strong></div>";
			} else {

				$sqlBook = "SELECT * FROM books where bookid= '$bid' ";
				$queryBook = mysqli_query($conn, $sqlBook);
				$rowBook = mysqli_fetch_array($queryBook);

				$bookQ = $rowBook['bookCopies'] - 1;
				$AV = 'NO';

				if ($bookQ < 4) {
					$sqlBook1 = "UPDATE books SET  available = '$AV', bookCopies = '$bookQ'  WHERE bookid = '$bid' ";
					$queryBook1 = mysqli_query($conn, $sqlBook1);

					$iCode = "INSERT INTO borrow (bid,sid,bdate,ddate,statusR) VALUES ('$bid', '$sid','$bdate','$ddate','$statusR')";
					$iCode = mysqli_query($conn, $iCode);
					if ($iCode) {

						echo "<div class='alert alert-success alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<strong style='text-align: center'>Borrowed Successfully </strong></div>";
					} else {
						$error = true;
					}
				} elseif ($bookQ > 3) {
					$sqlBook1 = "UPDATE books SET  bookCopies = '$bookQ' WHERE bookid = '$bid' ";
					$queryBook1 = mysqli_query($conn, $sqlBook1);


					$iCode = "INSERT INTO borrow (bid,sid,bdate,ddate,statusR) VALUES ('$bid', '$sid','$bdate','$ddate','$statusR')";
					$iCode = mysqli_query($conn, $iCode);
					if ($iCode) {

						echo "<div class='alert alert-success alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<strong style='text-align: center'>Borrowed Successfully </strong></div>";
					} else {
						$error = true;
					}
				}
			}
		}

		?>

		<!-- Static Table Start -->
		<div class="data-table-area mg-b-15">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="sparkline13-list">
							<div class="sparkline13-hd">
								<div class="main-sparkline13-hd">
								</div>
							</div>
							<div class="sparkline13-graph">
								<div class="datatable-dashv1-list custom-datatable-overright">
									<div id="toolbar">
										<select class="form-control dt-tb">
											<option value="">Export Basic</option>
											<option value="all">Export All</option>
											<option value="selected">Export Selected</option>
										</select>
									</div>
									<table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
										<thead bgcolor='purple' style='color:white;'>
											<tr>
												<th data-field="state" data-checkbox="true"></th>
												<th>S/N</th>
												<th>Full Name</th>
												<th>Reg. No.</th>
												<th>Department</th>
												<th>Program</th>
												<th>Semester</th>
												<th>Email</th>
												<th>Phone</th>
												<th>Total Visits</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody bgcolor='lightgrey'>
											<?php
											$sql2 = "SELECT * from students";
											$query2 = mysqli_query($conn, $sql2);
											$counter = 1;
											while ($row = mysqli_fetch_array($query2)) { ?>
												<tr>
													<td></td>
													<td><?php echo $counter++; ?></td>
													<td><?php echo $row['fullname']; ?></td>
													<td><?php echo $row['regno']; ?></td>
													<td><?php echo $row['dept']; ?></td>
													<td><?php echo $row['prog']; ?></td>
													<td><?php echo $row['sem']; ?></td>
													<td><?php echo $row['email']; ?></td>
													<td><?php echo $row['phone']; ?></td>
													<td><?php echo $row['ent']; ?></td>
													<td>
														<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
															<input type="hidden" name="bid" value="<?php echo $_GET['id']; ?>">
															<input type="hidden" name="sid" value="<?php echo $row['id']; ?>">
															<button type="submit" class="btn btn-success col-lg-15 fa fa-check" name="submit"> Borrow</button>
														</form>
													</td>
												</tr>
											<?php 	}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>




<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script>
	function Delete() {
		return confirm('Would you like to delete the news');
	}
</script>

<script src="../table/js/data-table/bootstrap-table.js"></script>
<script src="../table/js/data-table/tableExport.js"></script>
<script src="../table/js/data-table/data-table-active.js"></script>
<script src="../table/js/data-table/bootstrap-table-editable.js"></script>
<script src="../table/js/data-table/bootstrap-editable.js"></script>
<script src="../table/js/data-table/bootstrap-table-resizable.js"></script>
<script src="../table/js/data-table/colResizable-1.5.source.js"></script>
<script src="../table/js/data-table/bootstrap-table-export.js"></script>




</body>

</html>