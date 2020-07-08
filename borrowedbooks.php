<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php";




if (isset($_POST['del'])) {

	$id = sanitize(trim($_POST['id']));

	$sql_del = "DELETE from books where BookId = $id";
	$error = false;
	$result = mysqli_query($conn, $sql_del);
	if ($result) {
		$error = true;
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
												<th>Publisher</th>
												<th>Available</th>
												<th>Categories</th>
												<th>Delete</th>
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
													<td><?php echo $row['available']; ?></td>
													<td><?php echo $row['categories']; ?></td>
													<td><?php echo $row['callNumber']; ?></td>
													<?php if ($row['available'] != 'YES') { ?>
														<td><img src="images/nav.png" width="40%" height="40%"></td>
													<?php } else { ?>
														<td class="datatable-ct"><a href="borrowedbooks1.php?id=<?php echo $row['bookId']; ?>"><i class="fa fa-check"></i> Borrow this book out</a></td>
													<?php } ?>
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
		return confirm('Would you like to delete this book');
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