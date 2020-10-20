<?php
  include_once('inc/header.php');
  include_once('inc/connection.php');
  $data = $conn->query("select * from member_info");
?>
<div class="container">
	<h2 class="my-3 text-center text-success">Member Information</h2>
	<hr>
	<table class="table table-striped">
		<tr>
			<th>Sl</th>
			<th>Name</th>
			<th>Image</th>
			<th>Job Title</th>
			<th>Description</th>
			<th>Action</th>
		</tr>
		<?php
		$i=1;
		 while($dt = $data->fetch_assoc()) {
		 	?>
		<tr>
			<td><?php echo $i++;?></td>
			<td><?php echo $dt['name']?></td>
			<td><img src="images/<?php echo $dt['image']?>" alt="" style="width: 100px; height: 100px"></td>
			<td><?php echo $dt['job']?></td>
			<td class="py-4"><?php echo $dt['description']?></td>
			<td>
				<a href="edit.php?id=<?php echo $dt['id']?>" class="btn btn-success">edit</a>
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?php echo $dt['id']?>">Delete</button>
				
			</td>
		</tr>

		<!-- Button trigger modal -->
		

		<!-- Modal -->
		<div class="modal fade" id="exampleModal<?php echo $dt['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Are You Sure?</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        Delete Permanently
		      </div>
		      <div class="modal-footer">
		        <a href="delete.php?id=<?php echo $dt['id']?>"class="btn btn-danger">Yes</a>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
		       
		      </div>
		    </div>
		  </div>
		</div>
		<?php } ?>
	</table>
</div>



<?php include_once('inc/footer.php')?>