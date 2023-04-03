<!DOCTYPE html>
<?php
	session_start();

	if(($_SESSION['role'] !="F")) {
		echo "You are trying to access a BAD Page. <a href='/ems/login.php' >Login Again</a> ";
		session_destroy();
	} else {
?>
<html>
	<head>
		<title>Account Details - University System</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="../css/style.css">
	</head>
	<body>
	<?php 
			$uid=($_SESSION['uid']);
			
			if(isset($_SESSION['uid']))

			{
				include ("../db_connection.php");

				$sql="SELECT * FROM faculty_tab WHERE fid='$uid'";
				$result=$connect->query($sql);
				$row = $result->fetch_assoc();
			}
			else
			{
			   echo "session expired";

			}
			
			include("../header.php");
	?>  
  
		<div class="container-fluid text-center">    
		  <div class="row content">
			<div class="col-sm-2 sidenav">
			  <p><a href="courses.php">Courses</a></p>
			  <p><a href="account.php">Account Details</a></p>
			</div>
			<div class="col-sm-8 text-left"> 
			<br>
			<h2>Your Courses</h2>
				<table border="1">
					<tr>
						<th style='padding: 15px;'>Faculty ID</th>
						<th style='padding: 15px;'>Name</th>
						<th style='padding: 15px;'>Joining Date</th>
						<th style='padding: 15px;'>Department</th>
					</tr>
					<tr>
					<?php
						echo "<td style='padding: 15px;'>".$row['fid']."</td>";
						echo "<td style='padding: 15px;'>".$row['name']."</td>";
						echo "<td style='padding: 15px;'>".$row['join_date']."</td>";
						echo "<td style='padding: 15px;'>".$row['department']."</td>";
						echo "</tr>";
					?>
					</tr>
				</table>
			</div>
			
		  </div>
		</div>
    </body>
<?php
		include("../footer.php");
	}
?>
</html>