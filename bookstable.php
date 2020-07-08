<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php";
?>

<!-- <br> -->
<br><br>
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
						<li class="active"><a href="bookstable.php">Books</a></li>
						<li><a href="users.php">Admins</a></li>
						<li><a href="viewstudents.php">Students</a></li>
						<li><a href="history.php">History</a></li>
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
	<!-- navbar ends -->
	<!-- info alert -->


	<span style='font-size:400%; color: grey; text-align:right;'>
		<?php
		$sql2 = "SELECT * from books";
		$query2 = mysqli_query($conn, $sql2);
		$counter = 0;
		while ($row = mysqli_fetch_array($query2)) {
			$counter++;
		}
		echo $counter . " Books";
		?>
	</span>



	<div class="alert alert-warning col-lg-7 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-0 col-sm-offset-1 col-xs-offset-0" style="margin-top:70px">

		<span class="glyphicon glyphicon-book"></span>
		<strong>Upload Book list (CSV that only)</strong>
		<div style="display: inline;">
			<frameset style="border: 3px;">

				<form action="importBook.php" method="post" enctype="multipart/form-data">
					<input type="file" class="form-control" name="file" required />

					<input type="submit" name="submitList" class="form-control btn btn-success col-lg-3 col-md-4 col-sm-11 col-xs-11 button" Value="Upload Students List"></p>
				</form>
			</frameset>
		</div>
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
				<a href="addbook.php"><button class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-xs-11 button" style="margin-left: 15px;margin-bottom: 5px"><span class="glyphicon glyphicon-plus-sign"></span> Add Book</button></a>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">

				</div><!-- /.col-lg-6 -->



			</div>
		</div>



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
												<th>Book Title</th>
												<th>Author</th>
												<th>ISBN</th>
												<th>Copies</th>
												<th>Publihser</th>
												<th>Year</th>
												<th>Availability</th>
												<th>Category</th>
												<th>Call Number</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody bgcolor='lightgrey'>
											<?php
											$sql2 = "SELECT * from books ORDER BY bookId desc";
											$query2 = mysqli_query($conn, $sql2);
											$counter = 1;
											while ($row = mysqli_fetch_array($query2)) { ?>
												<tr>
													<td></td>
													<td><?php echo $counter++; ?></td>
													<td><?php echo $row['bookTitle']; ?></td>
													<td><?php echo $row['author']; ?></td>
													<td><?php echo $row['ISBN']; ?></td>
													<td><?php echo $row['bookCopies']; ?></td>
													<td><?php echo $row['publisherName']; ?></td>
													<td><?php echo $row['year']; ?></td>
													<td><?php echo $row['available']; ?></td>
													<td><?php echo $row['categories']; ?></td>
													<td><?php echo $row['callNumber']; ?></td>
													<form method='post' action='bookstable.php'>
														<input type='hidden' value="<?php echo $row['bookId']; ?>" name='id'>
														<td class="datatable-ct"><a href="delBook.php?bookID=<?php echo $row['bookId']; ?>"> <i class="fa fa-times"></i> Delete</a></td>
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