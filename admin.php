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

// if(isset($_SESSION['admin'])){
// 	$admin = $_SESSION['admin'];
// 	// echo "Hello $user";
// }

if (isset($_POST['submit'])) {

    $news = sanitize(trim($_POST['news']));

    $sql = "INSERT into news (announcement) values ('$news')";

    $query = mysqli_query($conn, $sql);
    $error = false;

    if ($query) {
        $error = true;
    } else {
        echo "<script>alert('Not successful!! Try again.');
                    </script>";
    }
}

if (isset($_POST['UpDat'])) {
    $id = sanitize(trim($_POST['id']));
    $text = sanitize(trim($_POST['text']));

    $sql_up = "UPDATE news set announcement = '$text' where newsId = '$id'";
    echo mysqli_error($sql_up);
    $result = mysqli_query($conn, $sql_del);
    if ($result) {
        echo "<script>
            
           
                   alert('Update successful');

         </script>";
    }
}

if (isset($_POST['del'])) {

    $id = sanitize(trim($_POST['id']));

    $sql_del = "DELETE from news where newsId = $id";

    $result = mysqli_query($conn, $sql_del);
    if ($result) {
        //            echo "<script>

        //    var response = confirm('Would you like to delete the user');
        //    if (response == true) {
        //        alert('User was successfully deleted from the database');
        //            location.href ='admin.php';
        //    }   

        //    else
        //        {
        //            alert('Could not delete user');
        //        }


        // </script>";
    }
}






?>

<body background="images/bkg.png">
    <br><br>
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
                            <li class="active"><a href="admin.php">Home</a></li>
                            <li><a href="bookstable.php">Books</a></li>
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
        <img src="images/bkg2.png" width="100%">
</body>

</html>