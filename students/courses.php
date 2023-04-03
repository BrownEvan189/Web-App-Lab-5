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
		<title>Courses - University System</title>
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

				$sql1="SELECT * FROM registration_tab WHERE stuid='".$row['stuid']."'";
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
			<h2>Your Courses</h2>
				<table border="1">
					<tr>
						<th style='padding: 15px;'>Course ID</th>
						<th style='padding: 15px;'>Course Name</th>
						<th style='padding: 15px;'>Faculty</th>
						<th style='padding: 15px;'>Semester</th>
						<th style='padding: 15px;'>Credits</th>
					</tr>
					<?php
						$count = 0;
						echo "<tr>";
						while($row1 = $result1->fetch_assoc()){
							$sql2="SELECT * FROM course_tab WHERE cid='".$row1['cid']."'";
							$result2=$connect->query($sql2);
							$row2 = $result2->fetch_assoc();
							
							$sql3="SELECT * FROM faculty_tab WHERE fid='".$row1['fid']."'";
							$result3=$connect->query($sql3);
							$row3 = $result3->fetch_assoc();
							
							echo "<td style='padding: 15px;'>".$row2['cid']."</td>";
							echo "<td style='padding: 15px;'>".$row2['name']."</td>";
							echo "<td style='padding: 15px;'>".$row3['name']."</td>";
							echo "<td style='padding: 15px;'>".$row2['sem']."</td>";
							echo "<td style='padding: 15px;'>".$row2['credits']."</td>";
							echo "</tr>";
						}
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