<?php
  include_once('inc/header.php');
  include_once('inc/connection.php');
  if(isset($_POST['submit'])){
  	$name = $_POST['name'];
  	$job = $_POST['job'];
  	$img_name = $_FILES['image']['name'];
  	$img_tmp_name = $_FILES['image']['tmp_name'];
  	$img_name_array = explode('.', $img_name);
  	$img_ext = end($img_name_array);
  	$img_final_name = time().md5($img_name).".".$img_ext;
  	$desc= $_POST['desc'];
  	if(empty($name) || empty($job) || empty($img_name )||empty($desc)){
  		$error= "Field must not be empty";
  	}
  	elseif(in_array($img_ext, ['jpg','png','gif','jpeg'])==false){
  		$error= "image is invalid";
  	}
  	else{
  		$conn->query("insert into member_info(name,image,job,description) values('$name','$img_final_name','$job','$desc')");
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
	<form action="" class="w-50 m-auto" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<input type="text" class="form-control" name="name" placeholder="Enter member name">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" name="job" placeholder="enter job title">
		</div>
		<div class="form-group">
			<input type="file" class="form-control" name="image">
		</div>
		<div class="form-group">
			<textarea name="desc" id=""class="form-control" rows="10" placeholder="enter description"></textarea>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-success" name="submit">
		</div>
	</form>
</div>






<?php include_once('inc/footer.php')?>