<?php
  include_once('inc/header.php');
  include_once('inc/connection.php');
  $data = $conn->query("select * from member_info");
?>
<div class="container mt-5">
	<h2 class="text-center my-3">Our Team members</h2>
  <div class="row">
    <?php while($dt = $data->fetch_assoc()){?>

  	<div class="col-md-4">
  		<div class="card">
  			<img src="images/<?php echo $dt['image']?>" alt="" style="height: 300px;">
  			<div class="card-header">
  				<h2 class="card-title"><?php echo $dt['name']?></h2>
  				<h3 class="card-subtitle"><?php echo $dt['job']?></h3>
  			</div>
  			<div class="card-body">
  				<p><?php echo $dt['description']?></p>
  			</div>
  		</div>
  	</div>
    <?php }?>




  	</div>
  </div>



</div>





















<?php include_once('inc/footer.php')?>