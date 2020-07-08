<?php
// session_start(); 
// session_destroy();
// if (!(isset($_SESSION['auth']) && $_SESSION['auth'] === true)) {
// 	header("Location: admin.php?access=false");
// 	exit();
// }
// else {
// $admin = $_SESSION['admin'];
// }
require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php";

if (isset($_POST['checkin'])) {

	$fullname = sanitize(trim($_POST['fullname']));
	$regno = sanitize(trim($_POST['regno']));
	$dept = sanitize(trim($_POST['dept']));
	$prog = sanitize(trim($_POST['prog']));
	$belongings  = sanitize(trim($_POST['belongings']));
	$ent = sanitize(trim($_POST['ent']));
	$chkday = sanitize(trim($_POST['chkday']));
	$chkdate = sanitize(trim($_POST['chkdate']));
	$chktime = sanitize(trim($_POST['chktime']));
	$status = "in";
	$ent++;

	$sqla = "SELECT * FROM checkin where status = '$status' AND regno= '$regno' ";

	$querya = mysqli_query($conn, $sqla);
	$row = mysqli_fetch_assoc($querya);
	if (mysqli_num_rows($querya) > 0) {
		echo "<div class='alert alert-danger alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<strong style='text-align: center'> $fullname is already inside the Library</strong> </div>";
		echo "<script>alert('$fullname is already inside the Library') </script>";
	} else {

		$sqlu = "UPDATE  students SET ent = '$ent'  where regno = '$regno'";
		$queryu = mysqli_query($conn, $sqlu);

		$sql = "INSERT INTO checkin (fullname, regno, dept, prog, belongings, chkday, chkdate, chktime, status)
                           VALUES ('$fullname', '$regno', '$dept', '$prog', '$belongings', '$chkday', '$chkdate', '$chktime', '$status') ";

		$query = mysqli_query($conn, $sql);
		$error = false;
		if ($query) {
			echo "<script>alert('Checked-In Successfully');
                    </script>";
		} else {

			$error = true;
		}
	}
}


?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css"> -->
	<link rel="stylesheet" type="text/css" href="font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="flickity/flickity.css">

	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
	<link rel="stylesheet" href="table/css/bootstrap.min.css">
	<link rel="stylesheet" href="table/css/data-table/bootstrap-table.css">
	<link rel="stylesheet" href="table/css/data-table/bootstrap-editable.css">



	<title>KSITM Library</title>
	<style type="text/css">
		label {
			color: white;
		}
	</style>

</head>
<!-- <body background="images/bkg.png"> -->
<div class="container">
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example">
					<span class="sr-only">:</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Institute Library</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example">
				<ul class="nav navbar-nav">
					<li class="active"><a href="#">Home</a></li>

				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="login.php">Login</a></li>
				</ul>
			</div>
		</div>
	</nav>

</div>

<br><br>
<a href="index.php" title="Click here to refresh this page"><img src="images/header.png" width="100%"></a>

<!-- Default panel contents -->






</div>
</div>



<?php
if (isset($_POST['submit'])) {
	$cardno = trim($_POST['regno']);
	$sqlCheck = "SELECT * FROM students WHERE regno = '$cardno'";
	$queryCheck = mysqli_query($conn, $sqlCheck);
	$row = mysqli_fetch_assoc($queryCheck);
	if (mysqli_num_rows($queryCheck) > 0) {

		$objDateTime = new DateTime('Now');

		echo "<div style='width:30%; margin-left:40%;' class='alert alert-success alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times; Cancel</button>
						<strong style='text-align: center'>"; ?>

		<label style="color: purple">Full Name:</label><span> <?php echo $row['fullname']; ?> </span> <br>
		<label style="color: purple">Registration Number:</label><span> <?php echo $row['regno']; ?> </span> <br>
		<label style="color: purple">Department:</label><span> <?php echo $row['dept']; ?> </span> <br>
		<label style="color: purple">Program:</label><span> <?php echo $row['prog']; ?> </span>
		<label style="color: purple">Day:</label><span> <?php echo date('l'); ?> </span>
		<label style="color: purple">Date:</label><span> <?php echo date('d/m/y'); ?> </span>
		<label style="color: purple">Time:</label><span> <?php echo date('h:i:sa'); ?> </span> <br>

		<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
			<label style="color: grey;">Mention student belongings here (if any...)</label><br><textarea name="belongings" style="border-radius: 100px; text-align: center; padding: 5px" class="form-control"></textarea><br>
			<input type="submit" name="checkin" value="Check-in to the Library" class="btn btn-info">
			<input type="hidden" name="fullname" value="<?php echo $row['fullname']; ?>">
			<input type="hidden" name="regno" value="<?php echo $row['regno']; ?>">
			<input type="hidden" name="dept" value="<?php echo $row['dept']; ?>">
			<input type="hidden" name="prog" value="<?php echo $row['prog']; ?>">
			<input type="hidden" name="ent" value="<?php echo $row['ent']; ?>">
			<input type="hidden" name="chkday" value="<?php echo date('l'); ?>">
			<input type="hidden" name="chkdate" value="<?php echo date('d/m/y'); ?>">
			<input type="hidden" name="chktime" value="<?php echo date('h:i:sa'); ?>">
		</form>
<?php echo  "</strong></div>";
	} else {

		echo "<div class='alert alert-danger alert-dismissable'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<strong style='text-align: center'> Record Not Found.</strong>
				  </div>";
	}
}
?>

<div class='alert alert-succ alert-dismissable'>
	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>Close Search</button>
	<strong style='text-align: center'>
		<div class="container">
			<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="Name" class="col-sm-2 control-label"></label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="regno" placeholder="Enter Student's Registration number here..." id="name" required> <br>
						<button type="submit" class="form-control btn btn-success col-lg-3 col-md-4 col-sm-11 col-xs-11 button" name="submit">Search Student</button>
					</div>
				</div>

			</form>
		</div>
	</strong> </div>



<div class='alert alert-succ alert-dismissable'>
	<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>Hide List</button>




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
											<th width="13%">Full Name</th>
											<th width="10%">Reg. No.:</th>
											<th width="13%">Department</th>
											<th width="5%">Program</th>
											<th width="5%">Day</th>
											<th width="5%">Date</th>
											<th width="6%">Time</th>
											<th width="23%">Belongings</th>
											<th width="4%">Visits</th>
											<th width="7%">Action</th>
										</tr>
									</thead>
									<tbody bgcolor='lightgrey'>

										<?php
										$status = "in";
										$sql = "SELECT * FROM checkin WHERE status = '$status' ORDER BY chktime DESC";
										$query = mysqli_query($conn, $sql);
										$counter = 1;
										while ($row = mysqli_fetch_array($query)) {
											$kati = $row['regno'];
											$sql1 = "SELECT * FROM students WHERE regno = '$kati' ";
											$query1 = mysqli_query($conn, $sql1); ?>
											<?php
											while ($row1 = mysqli_fetch_array($query1)) { ?>
												<tr '>
													<td></td>
													<td><?php echo $counter++; ?></td>
													<td><?php echo $row['fullname']; ?></td>
													<td><?php echo $row['regno']; ?></td>
													<td><?php echo $row['dept']; ?></td>
													<td><?php echo $row['prog']; ?></td>
													<td><?php echo $row['chkday']; ?></td>
													<td><?php echo $row['chkdate']; ?></td>
													<td><?php echo $row['chktime']; ?></td>
													<td><?php echo $row['belongings']; ?></td>
													<td><?php echo $row1['ent']; ?></td>
													<td class="datatable-ct"><a href="out.php?id=<?php echo $row['id']; ?>"> <i class="fa fa-check"></i> Check Out</a></td>
												</tr>
										<?php }
										}
										// $counter++;
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


	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script>
		function Delete() {
			return confirm(' Would you like to Check out'); } </script> <!-- jquery data table JS============================================-->
													<script src="table/js/data-table/bootstrap-table.js"></script>
													<script src="table/js/data-table/tableExport.js"></script>
													<script src="table/js/data-table/data-table-active.js"></script>
													<script src="table/js/data-table/bootstrap-table-editable.js"></script>
													<script src="table/js/data-table/bootstrap-editable.js"></script>
													<script src="table/js/data-table/bootstrap-table-resizable.js"></script>
													<script src="table/js/data-table/colResizable-1.5.source.js"></script>
													<script src="table/js/data-table/bootstrap-table-export.js"></script>


													</body>

</html>