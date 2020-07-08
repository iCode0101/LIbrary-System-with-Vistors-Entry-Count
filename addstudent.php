<?php 
require 'includes/snippet.php';
    require 'includes/db-inc.php';
include "includes/header.php"; 

if(isset($_POST['submit'])) {

 $name  = sanitize(trim($_POST['name']));
 $regno = sanitize(trim($_POST['regno'])); 
 $gender = sanitize(trim($_POST['gender'])); 
 $cardno = sanitize(trim($_POST['cardno'])); 
 $dept = sanitize(trim($_POST['dept'])); 
 $prog = sanitize(trim($_POST['prog'])); 
 $sem = sanitize(trim($_POST['sem'])); 
 $email = sanitize(trim($_POST['email'])); 
 $phone = sanitize(trim($_POST['phone']));  
 

      $sql = "INSERT INTO students( fullname, regno, dept, prog, sem, email, phone, gender)
                           VALUES ('$name', '$regno',  '$dept', '$prog', '$sem', '$email', '$phone', '$gender') ";

      $query = mysqli_query($conn, $sql);
      $error = false;
      if($query){
       $error = true;
      }
      else{
        echo "<script>alert('Not Registered successful!! Try again.');
                    </script>"; 
      }
   }
   
    


?>


<div class="container">
    <?php  include "includes/nav.php"; ?>
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
                <?php if(isset($admin)) { ?>  
                <li ><a href="admin.php">Home</a></li>
                <li><a href="bookstable.php">Books</a></li>
                <li><a href="users.php">Admins</a></li>
                <li class="active"><a href="viewstudents.php">Students</a></li>
                <li><a href="borrowedbooks.php">Borrow books</a></li>
                <li ><a href="fines.php">Fines</a></li>
                <?php } ?>
                <?php if(isset($student)) { ?>
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

              <?php if(isset($error)===true) { ?>
        <div class="alert alert-success alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>Record Added Successfully!</strong>
            </div>
            <?php } ?>
        <br><br>
            <p class="page-header" style="text-align: center">ADD STUDENTS</p>

            <div class="container">
                <form class="form-horizontal" role="form" action="addstudent.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="Username" class="col-sm-2 control-label">Student Full_Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Full name" id="name" required>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label for="gender" class="col-sm-2 control-label">Gender:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="gender"  id="gender" required>
                                <option> - - -Please Select Gender - - - </option>
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label for="Password" class="col-sm-2 control-label">Reg. No.:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="regno" placeholder="Matric Number" id="password" required>
                        </div>      
                    </div>
                 
                    <div class="form-group">
                        <label for="Password" class="col-sm-2 control-label">Department:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="dept"  id="Address" required>
                                <option> - - -Please Select Department - - - </option>
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
                        <label for="Password" class="col-sm-2 control-label">Program:</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="prog"  id="Address" required>
                                <option> - - -Please Select Program - - - </option>
                                <option>NID</option>
                                <option>Special Program</option>
                            </select>
                        </div>      
                    </div>
                    <div class="form-group">
                        <label for="Password" class="col-sm-2 control-label">Date:</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="sem"  id="Address" type="date" required>
                           
                        </div>      
                    </div>
                    <div class="form-group">
                        <label for="Password" class="col-sm-2 control-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Enter Email Address " id="password" required>
                        </div>      
                    </div>
      
                    <div class="form-group">
                        <label for="Password" class="col-sm-2 control-label">Phone Number:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" id="password" required>
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
                            <button  class="btn btn-info col-lg-12" data-toggle="modal" data-target="#info" name="submit">
                                Add Student
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
 	window.onload = function () {
		var input = document.getElementById('name').focus();
	}
 </script>
</body>
</html>