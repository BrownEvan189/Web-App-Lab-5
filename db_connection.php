<?php
	$connect = new mysqli("localHost", "root", "", "ems_db");
	
	if($connect->connect_errno) {
		die('Could not connect: ' . $connect->connect_errno);
	}
?>