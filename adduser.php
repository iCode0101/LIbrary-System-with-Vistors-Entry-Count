<?php 
		require 'includes/snippet.php';
	require 'includes/db-inc.php';
	include "includes/header.php";

	// echo "Hello Uche";

	if (isset($_POST['submit'])) {
		//Getting the values from the forms
		$name = sanitize(trim($_POST['name']));
		$username = sanitize(trim($_POST['username']));
		$password1 = sanitize(trim($_POST['password1']));
		$password2 = sanitize(trim($_POST['password2']));
		$email = sanitize(trim($_POST['email']));
			 		
		// $img_picture = upload_image($_FILES['postimg']);
		// if($img_picture != false ){
		// 	$img_picture_path = $img_picture;
		// }

		  //Process the image that is uploaded by the user
    // $target_dir = "uploads/";
    // $target_file = $target_dir . basename($_FILES["imageUpload"]["name"]);
    // $uploadOk = 1;
    // $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    // if (move_uploaded_file($_FILES["imageUpload"]["tmp_name"], $target_file)) {
    //     echo "The file ". basename( $_FILES["imageUpload"]["name"]). " has been uploaded.";
    // } else {
    //     echo "Sorry, there was an error uploading your file.";
    // }

    // $image=basename( $_FILES["imageUpload"]["name"],".jpg"); // used to store the filename in a variable


	// if (isset($_FILES['postimg'])) {
	//         $img_size = $_FILES['postimg']['size'];
	//         $temp = $_FILES['postimg']['tmp_name'];
	//         $img_type = $_FILES['postimg']['type'];
	//         $img_name = $_FILES['postimg']['name'];

	//         if ($img_size > 500000) {
	//             $err_flag = true;
	//             $error = "Your image size is too big... Try again.";
	//         }

	//         $extensions = array('jpg', 'jpeg', 'png', 'gif');
	//         $img_ext = explode('/', $img_type);
	//         $img_ext = end($img_ext);
	//         $img_ext = strtolower($img_ext);
	//         if (!(in_array($img_ext, $extensions))) {
	//             $err_flag = true;
	//             $error = "Unwanted image file type... Only jpg,jpeg,png and gif allowed";
	//         }
 //        // Prepare image folder in the server
  //      $imgFile = 'posts-images/';
		
		// $filepath = $imgFile . basename($img_name);
		// $thumb_path = "";
		// if (!isset($err_flag) && $err_flag === false) {
		// 	$result = move_uploaded_file($temp, $filepath);
		// 	if ($result) {
		// 		$magicianObj = new imageLib($filepath);
	 //            $magicianObj -> resizeImage(150, 150);
	 //            $magicianObj -> saveImage($imgFile . 'thumbnails/', 100);
		// 		$img_path = $imgFile.$filepath;
		// 		$thumb_path = $imgFile . 'thumbnails/' . $filepath;
		// 	}
		// }

		// $upload_dir = 'posts-images/';
		// $img_path = "";
		// $img_path = $upload_dir.time().mt_rand(10,99).'.'.$img_ext;

		// if (!isset($err_flag)) {
		// 	$send = move_uploaded_file($temp, $img_path);
		// 	if($send){
		// 		echo "<script>alert('File uploaded')</script>";
		// 		return $img_path;
		// 	} else {
		// 		return false;
		// 	}
		// }
    // }





//Check if the password matches
		if ($password1 == $password2) {
			//create an sql statement
		$sql =
		 "INSERT into admin (adminName, password, username, email) values ('$name', '$password1', '$username', '$email')";
		 
		  // echo $img_picture;

		//query the database
		$query = mysqli_query($conn, $sql);
		$error = false;

		if ($query) {
		$error = true;


		}
		else {
		echo "<script>alert('Admin not added!');
					</script>";	
		}

		}

		else {
			echo  "<script>alert('Password mismatched!')</script>";
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
                <?php if(isset($admin)) { ?>  
                <li ><a href="admin.php">Home</a></li>
                <li><a href="bookstable.php">Books</a></li>
                <li class="active"><a href="users.php">Admins</a></li>
                <li><a href="viewstudents.php">Students</a></li>
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
	<div class="container  col-lg-9 col-md-11 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1 col-sm-offset-0 col-xs-offset-0  " style="margin-top: 30px">
		<div class="jumbotron login col-lg-10 col-md-11 col-sm-12 col-xs-12">
			<?php if(isset($error)) { ?>
		<div class="alert alert-success alert-dismissable">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				  <strong>Record Added Successfully!</strong>
			</div>
			<?php } ?>
			<p class="page-header" style="text-align: center">ADD ADMIN</p>

			<div class="container">
				<form class="form-horizontal" role="form" method="post" action="adduser.php" enctype="multipart/form-data">
				<div class="form-group">
						<label for="Name" class="col-sm-2 control-label">Full Name</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="name" placeholder="Enter Full Name" id="name" required>
						</div>		
					</div>
					<div class="form-group">
						<label for="Username" class="col-sm-2 control-label">Username</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" name="username" placeholder="Enter Username" id="username" required>
						</div>		
					</div>
					<div class="form-group">
						<label for="Password" class="col-sm-2 control-label">Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password1" placeholder="Enter Password" id="password" required>
						</div>		
					</div>
					<div class="form-group">
						<label for="Password" class="col-sm-2 control-label">Confirm Password</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" name="password2" placeholder="Enter Password" id="password" required>
						</div>		
					</div>
          <div class="form-group">
            <label for="Password" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" name="email" placeholder="Enter email" id="email" required>
            </div>
          </div>
<!--           <div class="form-group">
            <label class="col-sm-2 control-label">IMAGE</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" name="postimg" placeholder="Enter image" id="password" style="padding: 0" required>
            </div>
          </div> -->
					
					<div class="form-group ">
						<div class="col-sm-offset-2 col-sm-10 ">
							<button type="submit" class="btn btn-info col-lg-4 " name="submit">
								Submit
							</button>
							
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	
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