<?php
session_start();

if(isset($_SESSION['uid'])) {
	echo "You were successfully logged out";
	session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login - University System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
  <?php
	$status = '';
	if ( isset($_POST['captcha']) && ($_POST['captcha']!="") ){
		if(strcasecmp($_SESSION['captcha'], $_POST['captcha']) != 0){
			echo "Entered captcha code does not match! Kindly try again.";
		}else{
			$_SESSION['uid']=$_POST['uid'];
			$_SESSION['pwd']=$_POST['pwd'];
			header('location: redirect.php');
		}
	}
	?>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Projects</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
    </div>
    <div class="col-sm-8 text-left"> 
      <center><h2>Please login here</h2></center><br/><br/><br/>
	  
		<form name="login-form" method="POST" action="" >
			<table border="1" align="center">
				<tr>
					<td>Enter your Email ID</td>
					<td><input type="text" id="uid" name="uid"</td>
				</tr>
				<tr>
					<td>Enter your Password</td>
					<td><input type="password" name="pwd" id="pwd" value = ""/></td>
				</tr>
			</table>
			<center>
			<label><strong>Enter Captcha:</strong></label><br />
			<input type="text" name="captcha" />
			<p><br />
			<img src="captcha.php" id='captcha_image'>
			</p>
			<p>Can't read the image?
			<a href='javascript: refreshCaptcha();'>click here</a>
			to refresh</p>
			<input type="submit" name="submit" value="Submit">
			</center>
		</form>
    </div>
  </div>
</div>
<script>
//Refresh Captcha
function refreshCaptcha(){
    var img = document.images['captcha_image'];
    img.src = "captcha.php";
}
</script>
<footer class="container-fluid text-center">
  <p>Footer Text</p>
</footer>

</body>
</html>
