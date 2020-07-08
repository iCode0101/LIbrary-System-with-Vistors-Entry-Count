<?php
require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php";

if (isset($_POST['submit'])) {



    $bookTitle = sanitize(trim($_POST['bookTitle']));
    $author = sanitize(trim($_POST['author']));
    $ISBN = sanitize(trim($_POST['ISBN']));
    $bookCopies = sanitize(trim($_POST['bookCopies']));
    $publisherName = sanitize(trim($_POST['publisherName']));
    $available = "YES";
    $categories = sanitize(trim($_POST['categories']));
    $year = sanitize(trim($_POST['year']));
    $callNumber = sanitize(trim($_POST['callNumber']));





    $sql = "INSERT INTO books(bookTitle, author, ISBN, bookCopies, publisherName, available, categories, year, callNumber)
                 values ('$bookTitle', '$author', '$ISBN', '$bookCopies', '$publisherName', '$available', '$categories', '$year', '$callNumber')";

    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "<script>alert('New Book has been added ');
					location.href ='bookstable.php';
					</script>";
    } else {
        echo "<script>alert('Book not added!');
					</script>";
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
    <div class="container  col-lg-9 col-md-11 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1 col-sm-offset-0 col-xs-offset-0  " style="margin-top: 20px">
        <div class="jumbotron login2 col-lg-10 col-md-11 col-sm-12 col-xs-12">

            <p class="page-header" style="text-align: center">ADD BOOK</p>
            <div class="container">
                <form class="form-horizontal" role="form" enctype="multipart/form-data" action="addbook.php" method="post">
                    <div class="form-group">
                        <label for="Title" class="col-sm-2 control-label">BOOK TITLE</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="bookTitle" placeholder="Enter Title" id="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Author" class="col-sm-2 control-label">AUTHOR</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="author" placeholder="Enter Author" id="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="ISBN" class="col-sm-2 control-label">ISBN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ISBN" maxlength="13" placeholder="Enter International Standard Book Number" id="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Book Copies" class="col-sm-2 control-label">BOOK COPIES</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="bookCopies" placeholder="Enter number of copies" id="password" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Publisher" class="col-sm-2 control-label">PUBLISHER</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="publisherName" placeholder="Enter name of publisher" id="password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="Publisher" class="col-sm-2 control-label">YEAR</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="year" placeholder="Enter Publishing year" id="password" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="Publisher" class="col-sm-2 control-label">CATEGORY</label>
                        <div class="col-sm-10">
                            <select class="form-control" custom-select custom-select-lg name="categories" required>
                                <option>Select Book Category</option>
                                <option>Banking Operations</option>
                                <option>Computer Software Engineering</option>
                                <option>Multimedia Technology</option>
                                <option>Networking and System Security</option>
                                <option>Computer Hardware Engineering Technology</option>
                                <option>Security Management and Technology</option>
                                <option>Telecommunications Technology</option>
                                <option>Electrical/Electronic Engineering</option>
                                <option>Business Informatics</option>
                                <option>Islamic Banking and Finance</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Publisher" class="col-sm-2 control-label">CALL NUMBER</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="callNumber" placeholder="Enter call number" id="password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button name="submit" class="btn btn-info col-lg-12" data-toggle="modal" data-target="#info">
                                ADD BOOK
                            </button>

                        </div>
                    </div>


                </form>
            </div>
        </div>

    </div>




    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript">
        window.onload = function() {
            var input = document.getElementById('title').focus();
        }
    </script>
    </body>

    </html>