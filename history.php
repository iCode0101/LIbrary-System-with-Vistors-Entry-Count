s<?php
	require 'includes/snippet.php';
	require 'includes/db-inc.php';
	include "includes/header.php";

	if (isset($_POST['submit'])) {
		$id = trim($_POST['del_btn']);
		$sql = "DELETE from students where id = '$id' ";
		$query = mysqli_query($conn, $sql);

		if ($query) {
			echo "<script>alert('Student Deleted!')</script>";
		}
	}

	?>

<br><br><br>
<img src="images/header.png" width="100%">
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
						<li ><a href="viewstudents.php">Students</a></li>
						<li class="active"><a href="history.php">History</a></li>
						<li><a href="borrowedbooks.php">Borrow books</a></li>
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

	<span style='font-size:400%; color: grey; text-align:right;'>
		<?php
		$sql2 = "SELECT * from students";
		$query2 = mysqli_query($conn, $sql2);
		$counter = 0;
		while ($row = mysqli_fetch_array($query2)) {
			$counter++;
		}
		echo "TOTAL NUMBER OF STUDENTS: " . $counter;
		?>
	</span>
</div>




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
										<th>Student Name</th>
										<th>Gender</th>
										<th>Reg. No</th>
										<th>Department</th>
										<th>Program</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Date Added</th>
										<th>Visits</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody bgcolor='lightgrey' style="font-size: 12px;">
									<?php
									$sql = "SELECT * FROM students ORDER BY ent DESC";
									$query = mysqli_query($conn, $sql);
									$counter = 1;

									while ($row = mysqli_fetch_assoc($query)) {
									?>
										<tr>
											<td></td>
											<td><?php echo $counter++; ?></td>
											<td> <a href="editstudent.php?id=<?php echo $row['id']; ?>"><?php echo $row['fullname']; ?> </a> </td>
											<td><?php echo $row['gender']; ?></td>
											<td><?php echo $row['regno']; ?></td>
											<td><?php echo $row['dept']; ?></td>
											<td><?php echo $row['prog']; ?></td>
											<td><?php echo $row['email']; ?></td>
											<td><?php echo "0" . $row['phone']; ?></td>
											<td><?php echo $row['sem']; ?></td>
											<td><?php echo $row['ent']; ?></td>
											<td>
												<form action="viewstudents.php" method="post">
													<input type="hidden" value="<?php echo $row['id']; ?>" name="del_btn">
													<button name="submit" class="btn btn-warning">DELETE</button>
												</form>
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