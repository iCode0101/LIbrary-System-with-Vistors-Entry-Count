<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php";

$stdid = $_GET['id'];
$sql = " SELECT * FROM students WHERE id = '$stdid' ";
$query = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($query);

if (isset($_POST['submit'])) {

    $fullname  = sanitize(trim($_POST['fullname']));
    $regno = sanitize(trim($_POST['regno']));
    $gender = sanitize(trim($_POST['gender']));
    $dept = sanitize(trim($_POST['dept']));
    $prog = sanitize(trim($_POST['prog']));
    $email = sanitize(trim($_POST['email']));
    $phone = sanitize(trim($_POST['phone']));
    $stdid = sanitize(trim($_POST['stdid']));

    $sql = "UPDATE students SET fullname = '$fullname', regno = '$regno', gender = '$gender',  dept = '$dept', prog = '$prog',  email = '$email', phone = '$phone' where id = '$stdid'";
    $query = mysqli_query($conn, $sql);

    $error = false;
    if ($query) {
        $error = true;
        echo "<script>location.href ='viewstudents.php'</script>";
    } else {
        echo "<script>alert(--'Not Edited successful!! Try again.')</script>";
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
                        <li class="active"><a href="viewstudents.php">Students</a></li>
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

    <!-- <div class="container  col-lg-9 col-md-11 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1 col-sm-offset-0 col-xs-offset-0  " style="margin-top: 20px"> -->
    <div class="jumbotron login3 col-lg-10 col-md-11 col-sm-12 col-xs-12">

        <?php if (isset($error) === true) {

            $fullname  + " " + $regno + " " + $gender + " " + $cardno  + " " + $dept  + " " + $prog  + " " + $sem  + " " + $email  + " " + $phone + " " + $stdid;

        ?>
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Record Updated Successfully!</strong>
            </div>
        <?php } ?>

        <br><br>
        <p class="page-header" style="text-align: center">EDIT STUDENT DETAILS </p>
        <div class="container">
            <form class="form-horizontal" role="form" action="editstudent.php?id=<?php echo $row['id']; ?>" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="Username" class="col-sm-2 control-label">Student Full_Name:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="fullname" placeholder="Full name" id="name" value="<?php echo $row['fullname']; ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender" class="col-sm-2 control-label">Gender:</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="gender" id="gender" required>
                            <option><?php echo $row['gender']; ?></option>
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Password" class="col-sm-2 control-label">Reg. No.:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="regno" placeholder="Matric Number" id="password" value="<?php echo $row['regno']; ?>" readonly required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Password" class="col-sm-2 control-label">Department:</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $row['dept']; ?>" class="form-control" name="dept" id="Address" required readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="Password" class="col-sm-2 control-label">Program:</label>
                    <div class="col-sm-10">
                        <input type="text" value="<?php echo $row['prog']; ?>" class="form-control" name="prog" id="Address" required readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Password" class="col-sm-2 control-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email" placeholder="Enter Email Address " id="password" value="<?php echo $row['email']; ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="Password" class="col-sm-2 control-label">Phone Number:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" id="password" value="<?php echo $row['phone']; ?>" required>
                    </div>
                </div>


                <!-- <div class="form-group">
                        <label class="col-sm-2 control-label">Passport:</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="postimg" placeholder="Browse Passport" id="password" style="padding: 0" required>
                        </div>      
                    </div> -->


                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <input type="hidden" name="stdid" value="<?php echo $_GET['id']; ?>">
                        <button class="btn btn-info col-lg-12" data-toggle="modal" data-target="#info" name="submit">
                            Update Student Details
                        </button>

                    </div>
                </div>

            </form>
        </div>
    </div>

    <!-- </div> -->
</div>



<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript">
    window.onload = function() {
        var input = document.getElementById('name').focus();
    }
</script>
</body>

</html>