<?php
	include_once('inc/connection.php');
	$id =  $_GET['id'];
	$data= $conn->query("select * from member_info where id=$id ");
	while($dt = $data->fetch_assoc()){
		$oldImage = $dt['image'];
	}
	unlink("images/$oldImage");
	$conn->query("delete from member_info where id= $id");
	header("location:info.php");
	
	
	
?>