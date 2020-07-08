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
	$statusR = "Returned";
	$sql = "UPDATE borrow set rdate = '$rdate', statusR = '$statusR' where id = '$id'";
	$query = mysqli_query($conn, $sql);

	$sqlBOOK = "SELECT * FROM books WHERE bookId = '$bid'";
	$queryBOOK = mysqli_query($conn, $sqlBOOK);
	$ROW = mysqli_fetch_array($queryBOOK);

	$bc = $ROW['bookCopies'] + 1;
	$AVA = 'YES';
	$sqlB = "UPDATE books set bookCopies = bookCopies + 1, available = '$AVA' where bookId = '$bid'";
	$queryB = mysqli_query($conn, $sqlB);
	$errorR = false;
	if ($queryB) {
		$errorR = true;
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
		<strong>Fines</strong> Total amount of Paid Fines:
		<!-- 
					<?php
					//   $sql = "SELECT * FROM borrow WHERE status = 'Paid'";
					//   $query = mysqli_query($conn, $sql);
					//   $counter = 1;
					//   while ( $row = mysqli_fetch_assoc($query)) { 
					// 	  $fINE = 100;
					// 	  echo $fINE + 100;
					//   } -->

					?>
-->
	</div>

</div>
<div class="container">
	<div class="panel panel-default">
		<!-- Default panel contents  -->
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

				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
					<form method="post" enctype="multipart/form-data">
						<div class="input-group pull-right">
							<select class="form-control" name="text" required="">
								<option> - - - Select Search term - - -</option>
								<option>All Record</option>
								<option>Returned not Fined</option>
								<option>Fined Students</option>
								<option>Paid and Returned</option>
							</select>
							<span class="input-group-addon">
								<button class="btn btn-success" name="search">Search</button>
							</span>
						</div>
					</form>

				</div>

			</div>
		</div>
		<!-- All Data -->

		<!--End of all Data  -->

		<?php
		if (isset($_POST['search'])) {
			$TEXT = trim($_POST['text']);

			if ($TEXT == "All Record") { ?>
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
														<th>STUDENT NAME</th>
														<th>REG. NO.</th>
														<th>BOOK TITLE</th>
														<th>BORROW DATE</th>
														<th>DUE DATE</th>
														<th>RETURN DATE</th>
														<th>OVERDUE FINE</th>
														<th>STATUS</th>
														<th>ACTION</th>
													</tr>
												</thead>
												<tbody bgcolor='lightgrey'>
													<?php $sql = "SELECT * FROM borrow";
													$query = mysqli_query($conn, $sql);
													$counter = 1;
													while ($row = mysqli_fetch_assoc($query)) {
														if (date('d/m/y') - ($row['ddate']) < 1) {
															$overdue =  '0';
														} else {
															$overdue =  (date('d/m/y') - $row['ddate']);
														} ?>
														<tr>
															<td></td>
															<td><?php echo $counter++; ?></td>
															<td><?php
																$SID = $row['sid'];
																$sqlSTD = "SELECT * FROM students WHERE id = '$SID'";
																$queSTD = mysqli_query($conn, $sqlSTD);
																$rowSTD = mysqli_fetch_assoc($queSTD);
																echo $rowSTD['fullname']; ?></td>
															<td><?php echo $rowSTD['regno']; ?></td>
															<td><?php
																$BID = $row['bid'];
																$sqlBID = "SELECT * FROM books WHERE bookId = '$BID'";
																$queBID = mysqli_query($conn, $sqlBID);
																$rowBID = mysqli_fetch_assoc($queBID);
																echo $rowBID['bookTitle']; ?></td>
															<td><?php echo $row['bdate']; ?></td>
															<td><?php echo $row['ddate']; ?></td>
															<td><?php echo $row['rdate']; ?></td>
															<?php
															$TDAY = date('d/m/y');
															$DUEDATE =  $row['ddate'];
															$REDATE =  $row['rdate'];
															$DUE1 = '<td style = "color:green;">' . 'No Fine' . '</td>';
															$DUE2 = '<td>' . $overdue * 100 . '</td>';
															if ($REDATE == !null and $REDATE == $DUEDATE || $REDATE < $DUEDATE) {
																echo $DUE1;
																echo '<td style = "color:green;">' . 'No Fine' . '</td>';
																$TrueFalse = false;
															} else {
																echo $DUE2;
																echo '<td style="color: green;" >' . $row['status'] . '</td>';
																$TrueFalse = true;
															}
															?>
															<form action="fines.php" method="post">
																<input type="hidden" value="<?php echo $row['id']; ?>" name="borrower">
																<input type="hidden" value="<?php echo $row['bid']; ?>" name="bid">
																<?php
																if ($TDAY == $DUEDATE || $TDAY < $DUEDATE) {
																	echo '<td> <span  style = "color:green;">No Fine</span></td>';
																} else {
																	if ($REDATE == !null and $row['status'] == !null || $row['status'] == "Paid") {
																		echo '<td><button class="btn btn-warning" name="pay" disabled>Pay Fine</button></td>';
																	} elseif ($TrueFalse == false) {
																		echo '<td style = "color:green;">' . 'No Fine' . '</td>';
																	} else {
																		echo '<td><button class="btn btn-warning" name="pay">Pay Fine</button></td>';
																	}
																}
																if ($REDATE == !null) {
																	echo '<td><button class="btn btn-warning" name="returnB" disabled>Return Book</button></td>';
																} else {
																	echo '<td><button class="btn btn-warning" name="returnB" >Return Book</button></td>';
																}
																?>
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

<?php	} elseif ($TEXT == "Fined Students") { ?>
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
											<th>STUDENT NAME</th>
											<th>REG. NO.</th>
											<th>BOOK TITLE</th>
											<th>BORROW DATE</th>
											<th>DUE DATE</th>
											<th>RETURN DATE</th>
											<th>OVERDUE FINE</th>
											<th>STATUS</th>
											<th>ACTION</th>
										</tr>
									</thead>
									<tbody bgcolor='lightgrey'>
										<?php
										$rdate = !null;
										$status = null;
										$sql = "SELECT * FROM borrow WHERE rdate  > ddate";
										$query = mysqli_query($conn, $sql);
										$counter = 1;
										while ($row = mysqli_fetch_assoc($query)) {
											if (date('d/m/y') - ($row['ddate']) < 1) {
												$overdue =  '0';
											} else {
												$overdue =  (date('d/m/y') - $row['ddate']);
											}
										?>
											<tr>
												<td></td>
												<td><?php echo $counter++; ?></td>
												<td><?php
													$SID = $row['sid'];
													$sqlSTD = "SELECT * FROM students WHERE id = '$SID'";
													$queSTD = mysqli_query($conn, $sqlSTD);
													$rowSTD = mysqli_fetch_assoc($queSTD);
													echo $rowSTD['fullname']; ?></td>
												<td><?php echo $rowSTD['regno']; ?></td>
												<td><?php
													$BID = $row['bid'];
													$sqlBID = "SELECT * FROM books WHERE bookId = '$BID'";
													$queBID = mysqli_query($conn, $sqlBID);
													$rowBID = mysqli_fetch_assoc($queBID);
													echo $rowBID['bookTitle']; ?></td>
												<td><?php echo $row['bdate']; ?></td>
												<td><?php echo $row['ddate']; ?></td>
												<td><?php echo $row['rdate']; ?></td>
												<?php
												$TDAY = date('d/m/y');
												$DUEDATE =  $row['ddate'];
												$REDATE =  $row['rdate'];
												$DUE1 = '<td style = "color:green;">' . 'No Fine' . '</td>';
												$DUE2 = '<td>' . $overdue * 100 . '</td>';
												if ($REDATE == !null and $REDATE == $DUEDATE || $REDATE < $DUEDATE) {
													echo $DUE1;
													echo '<td style = "color:green;">' . 'No Fine' . '</td>';
													$TrueFalse = false;
												} else {
													echo $DUE2;
													echo '<td style="color: green;" >' . $row['status'] . '</td>';
													$TrueFalse = true;
												}
												?>
												<form action="fines.php" method="post">
													<input type="hidden" value="<?php echo $row['id']; ?>" name="borrower">
													<input type="hidden" value="<?php echo $row['bid']; ?>" name="bid">
													<?php
													if ($TDAY == $DUEDATE || $TDAY < $DUEDATE) {
														echo '<td> <span  style = "color:green;">No Fine</span></td>';
													} else {
														if ($REDATE == !null and $row['status'] == !null || $row['status'] == "Paid") {
															echo '<td><button class="btn btn-warning" name="pay" disabled>Pay Fine</button></td>';
														} elseif ($TrueFalse == false) {
															echo '<td style = "color:green;">' . 'No Fine' . '</td>';
														} else {
															echo '<td><button class="btn btn-warning" name="pay">Pay Fine</button></td>';
														}
													}
													if ($REDATE == !null) {
														echo '<td><button class="btn btn-warning" name="returnB" disabled>Return Book</button></td>';
													} else {
														echo '<td><button class="btn btn-warning" name="returnB" >Return Book</button></td>';
													}
													?>
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

<?php	} elseif ($TEXT == "Returned not Fined") { ?>
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
											<th>STUDENT NAME</th>
											<th>REG. NO.</th>
											<th>BOOK TITLE</th>
											<th>BORROW DATE</th>
											<th>DUE DATE</th>
											<th>RETURN DATE</th>
											<th>OVERDUE FINE</th>
											<th>STATUS</th>
											<th>ACTION</th>
										</tr>
									</thead>
									<tbody bgcolor='lightgrey'>
										<?php
										$rt = "Returned";
										$status = null;
										$sql = "SELECT * FROM borrow WHERE statusR  = '$rt'";
										$query = mysqli_query($conn, $sql);
										$counter = 1;
										while ($row = mysqli_fetch_assoc($query)) {
											if (date('d/m/y') - ($row['ddate']) < 1) {
												$overdue =  '0';
											} else {
												$overdue =  (date('d/m/y') - $row['ddate']);
											}
										?>
											<tr>
												<td></td>
												<td><?php echo $counter++; ?></td>
												<td><?php
													$SID = $row['sid'];
													$sqlSTD = "SELECT * FROM students WHERE id = '$SID'";
													$queSTD = mysqli_query($conn, $sqlSTD);
													$rowSTD = mysqli_fetch_assoc($queSTD);
													echo $rowSTD['fullname']; ?></td>
												<td><?php echo $rowSTD['regno']; ?></td>
												<td><?php
													$BID = $row['bid'];
													$sqlBID = "SELECT * FROM books WHERE bookId = '$BID'";
													$queBID = mysqli_query($conn, $sqlBID);
													$rowBID = mysqli_fetch_assoc($queBID);
													echo $rowBID['bookTitle']; ?></td>
												<td><?php echo $row['bdate']; ?></td>
												<td><?php echo $row['ddate']; ?></td>
												<td><?php echo $row['rdate']; ?></td>
												<?php
												$TDAY = date('d/m/y');
												$DUEDATE =  $row['ddate'];
												$REDATE =  $row['rdate'];
												$DUE1 = '<td style = "color:green;">' . 'No Fine' . '</td>';
												$DUE2 = '<td>' . $overdue * 100 . '</td>';
												if ($REDATE == !null and $REDATE == $DUEDATE || $REDATE < $DUEDATE) {
													echo $DUE1;
													echo '<td style = "color:green;">' . 'No Fine' . '</td>';
													$TrueFalse = false;
												} else {
													echo $DUE2;
													echo '<td style="color: green;" >' . $row['status'] . '</td>';
													$TrueFalse = true;
												}
												?>
												<form action="fines.php" method="post">
													<input type="hidden" value="<?php echo $row['id']; ?>" name="borrower">
													<input type="hidden" value="<?php echo $row['bid']; ?>" name="bid">
													<?php
													if ($TDAY == $DUEDATE || $TDAY < $DUEDATE) {
														echo '<td> <span  style = "color:green;">No Fine</span></td>';
													} else {
														if ($REDATE == !null and $row['status'] == !null || $row['status'] == "Paid") {
															echo '<td><button class="btn btn-warning" name="pay" disabled>Pay Fine</button></td>';
														} elseif ($TrueFalse == false) {
															echo '<td style = "color:green;">' . 'No Fine' . '</td>';
														} else {
															echo '<td><button class="btn btn-warning" name="pay">Pay Fine</button></td>';
														}
													}
													if ($REDATE == !null) {
														echo '<td><button class="btn btn-warning" name="returnB" disabled>Return Book</button></td>';
													} else {
														echo '<td><button class="btn btn-warning" name="returnB" >Return Book</button></td>';
													}
													?>
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


<?php } elseif ($TEXT == "Paid and Returned") { ?>

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
											<th>STUDENT NAME</th>
											<th>REG. NO.</th>
											<th>BOOK TITLE</th>
											<th>BORROW DATE</th>
											<th>DUE DATE</th>
											<th>RETURN DATE</th>
											<th>OVERDUE FINE</th>
											<th>STATUS</th>
											<th>ACTION</th>
										</tr>
									</thead>
									<tbody bgcolor='lightgrey'>
										<?php
										$Y = !null;
										$P = "Paid";
										$sql = "SELECT * FROM borrow WHERE status = '$P'";
										$query = mysqli_query($conn, $sql);
										$counter = 1;
										while ($row = mysqli_fetch_assoc($query)) {
											if (date('d/m/y') - ($row['ddate']) < 1) {
												$overdue =  '0';
											} else {
												$overdue =  (date('d/m/y') - $row['ddate']);
											}
										?>
											<tr>
												<td></td>
												<td><?php echo $counter++; ?></td>
												<td><?php
													$SID = $row['sid'];
													$sqlSTD = "SELECT * FROM students WHERE id = '$SID'";
													$queSTD = mysqli_query($conn, $sqlSTD);
													$rowSTD = mysqli_fetch_assoc($queSTD);
													echo $rowSTD['fullname']; ?></td>
												<td><?php echo $rowSTD['regno']; ?></td>
												<td><?php
													$BID = $row['bid'];
													$sqlBID = "SELECT * FROM books WHERE bookId = '$BID'";
													$queBID = mysqli_query($conn, $sqlBID);
													$rowBID = mysqli_fetch_assoc($queBID);
													echo $rowBID['bookTitle']; ?></td>
												<td><?php echo $row['bdate']; ?></td>
												<td><?php echo $row['ddate']; ?></td>
												<td><?php echo $row['rdate']; ?></td>
												<?php
												$TDAY = date('d/m/y');
												$DUEDATE =  $row['ddate'];
												$REDATE =  $row['rdate'];
												$DUE1 = '<td style = "color:green;">' . 'No Fine' . '</td>';
												$DUE2 = '<td>' . $overdue * 100 . '</td>';
												if ($REDATE == !null and $REDATE == $DUEDATE || $REDATE < $DUEDATE) {
													echo $DUE1;
													echo '<td style = "color:green;">' . 'No Fine' . '</td>';
													$TrueFalse = false;
												} else {
													echo $DUE2;
													echo '<td style="color: green;" >' . $row['status'] . '</td>';
													$TrueFalse = true;
												}
												?>


												<form action="fines.php" method="post">
													<input type="hidden" value="<?php echo $row['id']; ?>" name="borrower">
													<input type="hidden" value="<?php echo $row['bid']; ?>" name="bid">
													<?php
													if ($TDAY == $DUEDATE || $TDAY < $DUEDATE) {
														echo '<td> <span  style = "color:green;">No Fine</span></td>';
													} else {
														if ($REDATE == !null and $row['status'] == !null || $row['status'] == "Paid") {
															echo '<td><button class="btn btn-warning" name="pay" disabled>Pay Fine</button></td>';
														} elseif ($TrueFalse == false) {
															echo '<td style = "color:green;">' . 'No Fine' . '</td>';
														} else {
															echo '<td><button class="btn btn-warning" name="pay">Pay Fine</button></td>';
														}
													}
													if ($REDATE == !null) {
														echo '<td><button class="btn btn-warning" name="returnB" disabled>Return Book</button></td>';
													} else {
														echo '<td><button class="btn btn-warning" name="returnB" >Return Book</button></td>';
													}
													?>
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

<?php
			}
		}

?>




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