<?php
  include_once('inc/header.php');
  include_once('inc/connection.php');
  $id = $_GET['id'];
  $data = $conn->query("select * from member_info where id = $id");
  

  if(isset($_POST['submit'])){
  	$name = $_POST['name'];
  	$job = $_POST['job'];
  	$old_image = $_POST['old_image'];
  	$img_final_name = $old_image;
  	if(!empty($_FILES['image']['name'])){
  		$img_name = $_FILES['image']['name'];
	  	$img_tmp_name = $_FILES['image']['tmp_name'];
	  	$img_name_array = explode('.', $img_name);
	  	$img_ext = end($img_name_array);
	  	if(in_array($img_ext, ['jpg','png','gif','jpeg'])==false){
	  		$error= "image is invalid";
	  	}
	  	else{
	  		$img_final_name = time().md5($img_name).".".$img_ext;
		  	move_uploaded_file($img_tmp_name, 'images/'.$img_final_name);
	  		unlink("images/$old_image");
	  	}
	  	
  	
  	}
  	$desc= $_POST['desc'];
  	if(empty($name) || empty($job)||empty($desc)||empty($img_final_name)){
  		$error= "Field must not be empty";
  	}
  	else{
  		$conn->query("update member_info set name = '$name', image = '$img_final_name',job = '$job',description = '$desc'where id = $id ");
  		$success =  "data is updated successfully";
  		
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
		<?php while($dt = $data->fetch_assoc()) {?>
		<div class="form-group">
			<input type="text" class="form-control" name="name" placeholder="Enter member name" value="<?php echo $dt['name']?>">
		</div>
		<div class="form-group">
			<input type="text" class="form-control" name="job" placeholder="enter job title" value="<?php echo $dt['job']?>">
		</div>
		<div class="form-group">
			<input type="file" class="form-control" name="image">
			<input type="hidden" name ="old_image" value="<?php echo $dt['image'];?>">
			<img src="images/<?php echo $dt['image']?>" alt="" style="width: 50px; height: 50px">
		</div>
		<div class="form-group">
			<textarea name="desc" id=""class="form-control" rows="10" placeholder="enter description"><?php echo $dt['description']?></textarea>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-success" name="submit" value="update">
		</div>
		<?php }?>
	</form>
</div>






<?php include_once('inc/footer.php')?>