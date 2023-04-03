<!DOCTYPE html>
<?php
	session_start();

	if(($_SESSION['role'] !="S")) {
		echo "You are trying to access a BAD Page. <a href='/ems/login.php' >Login Again</a> ";
		session_destroy();
	} else {
?>
<html>
	<head>
		<title>Department Faculty - University System</title>
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

				$sql="SELECT * FROM student_tab WHERE stuid='$uid'";
				$result=$connect->query($sql);
				$row = $result->fetch_assoc();

				$sql1="SELECT * FROM faculty_tab WHERE department='".$row['major']."'";
				$result1 = $connect->query($sql1);
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
			  <p><a href="department_faculty.php">Department Faculty</a></p>
			  <p><a href="courses.php">Courses</a></p>
			  <p><a href="account.php">Account Details</a></p>
			</div>
			<div class="col-sm-8 text-left"> 
			<br>
			<h2>Faculty for <?php echo $row['major']; ?></h2>
				<table border="1">
					<?php
						$count = 0;
						echo "<tr>";
						while($row1 = $result1->fetch_assoc()){
							echo "<td style='padding: 15px;'>".$row1['name']."</td>";
							echo "<td style='padding: 15px;'>".$row1['fid']."@university.edu</td>";
							echo "<td style='width: 10px'></td>";
							$count = fmod($count + 1, 4);
							if($count == 0) {
								echo "</tr><tr>";
							}
						}
						echo "</tr>";
					?>
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