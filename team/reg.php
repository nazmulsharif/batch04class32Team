<?php
  include_once('inc/bootstrap.php');
  include_once('inc/connection.php');
  if(isset($_POST['submit'])){
  	$name = $_POST['name'];
  	$email = $_POST['email'];
  	$img_name = $_FILES['image']['name'];
  	$img_tmp_name = $_FILES['image']['tmp_name'];
  	$img_name_array = explode('.', $img_name);
  	$img_ext = end($img_name_array);
  	$img_final_name = time().md5($img_name).".".$img_ext;
  	$pass= $_POST['pass'];
  	$conpass= $_POST['conpass'];
  	if(empty($name) || empty($email) || empty($pass )||empty($conpass)|| empty($img_name)){
  		$error= "Field must not be empty";
  	}
  	elseif(in_array($img_ext, ['jpg','png','gif','jpeg'])==false){
  		$error= "image is invalid";
  	}
  	elseif($pass != $conpass){
  		$error = "Password doesn't match";
  	}
  	else{
  		$conn->query("insert into reg_info(name,email,image,pass,conpass) values('$name','$email','$img_final_name','$pass','$conpass')");
  		move_uploaded_file($img_tmp_name, 'images/'.$img_final_name);
  		$success =  "data is inserted successfully";
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
	<h4 class="text-center">Registration Form</h4>
	<form action="" class="w-50 m-auto" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<input type="text" class="form-control" name="name" placeholder="User Name">
		</div>
		<div class="form-group">
			<input type="email" class="form-control" name="email" placeholder="Email Address">
		</div>
		<div class="form-group">
			<input type="file" class="form-control" name="image">
		</div>
		<div class="form-group">
			<input type="password" class="form-control" name="pass" placeholder="Enter Password">
		</div>
		<div class="form-group">
			<input type="password" class="form-control" name="conpass" placeholder="Confirm Password">
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-success" name="submit">
			<a href="login.php" class="btn btn-primary">Login</a>
		</div>
	</form>
</div>






<?php include_once('inc/footer.php')?>