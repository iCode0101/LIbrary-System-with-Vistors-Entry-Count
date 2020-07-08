<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php";


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
						<li><a href="viewstudents.php">Students</a></li>
						<li><a href="history.php">History</a></li>
						<li><a href="borrowedbooks.php">Borrow books</a></li>
						<li class="active"><a href="reports.php">Reports</a></li>
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
		<span class="glyphicon glyphicon-book"> </span>Student Reports</span>
	</div>


</div>
<div class="container">
	<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading">
			<?php if (isset($error) === true) { ?>
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Record Deleted Successfully!</strong>
				</div>
			<?php } ?>
			<div class="row">

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
					<form method="post" action="reports.php" enctype="multipart/form-data">
						<div class="input-group pull-right">
							<select class="form-control" name="text" required="">
								<option> - - - Search by Department - - -</option>
								<option>Banking Operations</option>
								<option>Multimedia Technology</option>
								<option>Networking and System Security</option>
								<option>Computer Software Engineering</option>
							</select>
							<span class="input-group-addon">
								<button class="btn btn-success" name="search">Search</button>
							</span>
						</div>
					</form>

				</div><!-- /.col-lg-6 -->

			</div>
		</div>

		<table class="table table-bordered">

			<thead>
				<tr>
					<th>S/N</th>
					<th>Full Name</th>
					<th>Reg No.</th>
					<th>Dept.</th>
					<th>Program</th>
					<th>Semester</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Visits</th>
				</tr>
			</thead>

			<?php


			if (isset($_POST['search'])) {



				$Mukhtar = sanitize(trim($_POST['text']));
				$sql = " SELECT * FROM students WHERE dept = '$Mukhtar' ORDER BY regno";
				$query = mysqli_query($conn, $sql);
				$counter = 1;

				while ($row = mysqli_fetch_array($query)) { ?>
					<tbody>

						<td><?php echo $counter++; ?></td>
						<td><?php echo $row['fullname']; ?></td>
						<td><?php echo $row['regno']; ?></td>
						<td><?php echo $row['dept']; ?></td>
						<td><?php echo $row['prog']; ?></td>
						<td><?php echo $row['sem']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo "0" . $row['phone']; ?></td>
						<td><?php echo $row['ent']; ?></td>
					</tbody>
				<?php  }
			} else {
				$sql2 = "SELECT * from students ORDER BY regno";

				$query2 = mysqli_query($conn, $sql2);
				$counter = 1;
				while ($row = mysqli_fetch_array($query2)) { ?>
					<tbody>
						<td><?php echo $counter++; ?></td>
						<td><?php echo $row['fullname']; ?></td>
						<td><?php echo $row['regno']; ?></td>
						<td><?php echo $row['dept']; ?></td>
						<td><?php echo $row['prog']; ?></td>
						<td><?php echo $row['sem']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo "0" . $row['phone']; ?></td>
						<td><?php echo $row['ent']; ?></td>
					</tbody>

			<?php 	}
			}

			?>
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
<script>
	function Delete() {
		return confirm('Would you like to delete the news');
	}
</script>
</body>

</html>