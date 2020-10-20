<?php
  include_once('inc/bootstrap.php');
  include_once('inc/connection.php');
  if(isset($_POST['submit'])){
  	session_start();
  	$pass= $_POST['pass'];
  	$email= $_POST['email'];
  	$data = $conn->query("select * from reg_info where email = '$email' and pass = '$pass'");
  	$row = $data->num_rows;
  	if(empty($email) || empty($pass )){
  		$error= "Field must not be empty";
  	}
  	else if($row==1){
  		$_SESSION['email'] = $email;
  		$_SESSION['pass'] = $pass;
  		header('location:./index.php');
  	}
  	else{
  		header('location:login.php');
  		$error = "user is not found! please check email or password";
  	}
  	
  	
  }
 	
?>

<div class="container mt-5">
	<?php
		if(isset($error)){
			echo "<h3 class='alert alert-danger text-center'>$error</h3>";
		}
		if(isset($success)){
			echo "<h3 class='alert alert-success text-center'>$success</h3>";
		}

	?>
	<h4 class="text-center">Log In</h4>
	<form action="" class="w-50 m-auto" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<input type="email" class="form-control" name="email" placeholder="Email Address">
		</div>
		<div class="form-group">
			<input type="password" class="form-control" name="pass" placeholder="Enter Password">
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-success" name="submit" value="login">
			<a href="reg.php" class="btn btn-primary">Registration</a>
		</div>
	</form>
</div>






<?php include_once('inc/footer.php')?>