<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php";

if (isset($_POST['del'])) {

	$id = sanitize(trim($_POST['id']));
	// echo $id;

	$sql_del = "DELETE from admin where adminId = $id";
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
						<li class="active"><a href="users.php">Admins</a></li>
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
	<div class="alert alert-warning col-lg-7 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-0 col-sm-offset-1 col-xs-offset-0" style="margin-top:70px">

		<h4 class="center-block"><span class="admin_name" style="color: purple;">System Administrators</span> </h4>
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
				<a href="adduser.php"><button class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-xs-11 button" style="margin-left: 15px;margin-bottom: 5px"><span class="glyphicon glyphicon-plus-sign"></span> Add User</button></a>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right">
					<!-- <form action="users.php" method="post" enctype="multipart / form-data">
			  		<div class="input-group pull-right">
				      <span class="input-group-addon">
					  <button class="btn btn-success" name="search">Search</button> 
				      </span>
				      <input type="text" class="form-control" class="text" name="text" id="text">
			      </div>
			  	</form> -->

				</div>
			</div>
		</div>
		<table class="table table-bordered">

			<thead>
				<tr>
					<th>S/N</th>
					<th>Name</th>
					<th>Username</th>
					<th>Password</th>
					<th>Email</th>
					<th>Action</th>
				</tr>
			</thead>

			<?php
			$sql = "SELECT * from admin";

			$query = mysqli_query($conn, $sql);
			$counter = 1;
			while ($row = mysqli_fetch_array($query)) { ?>
				<tbody>
					<td> <?php echo $counter++ ?></td>
					<td> <?php echo $row['adminName'] ?></td>
					<td> <?php echo $row['username'] ?></td>
					<td>**********</td>
					<td> <?php echo $row['email'] ?></td>
					<form method='post' action='users.php'>
						<input type='hidden' value="<?php echo $row['adminId']; ?>" name='id'>
						<td><button name='del' type='submit' value='Delete' class='btn btn-warning' onclick='return Delete()'>DELETE</button></td>
					</form>
				</tbody>

			<?php } ?>

		</table>

	</div>


</div>

<!-- Confirm delete modal begins here -->
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
<!-- Confirm delete modal ends here -->
<!-- delete message modal starts here -->
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
<!-- delete message modal ends here -->
<!-- update modal begins here -->
<div class="modal fade" id="update">
	<div class="modal-dialog">
		<div class="modal-content">

			<!-- header begins here -->
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h2 class="modal-title"> Update</h2>
			</div>

			<!-- body begins here -->
			<div class="modal-body">
				<form role="form">
					<div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<span class="input-group-addon">ID</span>
						<input type="Username" class="form-control" name="id" value="1" contenteditable="disabled">

					</div><br>
					<div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<span class="input-group-addon">Username</span>
						<input type="Username" class="form-control" name="id" value="1" contenteditable="disabled">

					</div><br>
					<div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<span class="input-group-addon">Password</span>
						<input type="Username" class="form-control" name="id" value="1" contenteditable="disabled">

					</div><br>


				</form>
			</div>

			<!-- button -->
			<div class="modal-footer">
				<button class="col-lg-12 col-sm-12 col-xs-12 col-md-12 btn btn-success" data-target="alert">
					UPDATE
				</button>
			</div>
		</div>
	</div>
</div>
<!-- update modal ends here -->





<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript">
	function Delete() {
		return confirm('Would you like to delete the user');
	}


	function search() {
		alert("Hello Wildling!");
	}
</script>
</body>

</html>