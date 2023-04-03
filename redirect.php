<?php 
session_start();

if(($_POST["vercode"] != $_SESSION["vercode"] AND $_SESSION["vercode"]=='') )
{
  echo "Captcha Failed. <a href='login.php' >Login Again</a> ";
}
else
{
?>
<!DOCTYPE html>
<html>


<body>

<?php

include ("db_connection.php");

	$uid = $_SESSION['uid'];
	$pwd = $_SESSION['pwd'];

	$sql="SELECT * FROM users_tab WHERE uid='$uid' AND pwd='$pwd'";
	$result=$connect->query($sql);
	$row = $result->fetch_assoc(); 
 
      if($row['role']=='s')  //Students
      {
		$_SESSION['role'] = "S";
        header('location: students/index.php');
		 
     }
	 elseif($row['role']=='f')  //Faculty
      {
		$_SESSION['role'] = "F";
         header('location: faculty/index.php');
		 
     }
	 elseif($row['role']=='a')  //Admin
      {
		$_SESSION['role'] = "A";
         header('location: admin/index.php');
		 
     }

     
	 else
	 {
		   header('location: login-error.php');
	 }
}
 

//-------------------------------Login Failed---------------------
     


?>




</html>