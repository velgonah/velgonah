<?php
if (isset($_POST['submit'])) {
$Fullname=$_POST["Fullname"];
$Email=$_POST["Email"];
$Password=$_POST["Password"];


    // start database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hungers";


// create connection

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    

//check connection
     if (!$conn) {
     	die("connection failed: " . mysqli_connect_error());

     }else{
	echo"";
//End db connection	
}
if (empty($Fullname) && empty($Email) && empty($Password)) {
	echo"All fields are required";
	}else{
		$sql = "INSERT INTO `tbl_users`( `Fullname`, `Email`, `Password`) VALUES ('$Fullname','$Email','$Password')";
	}
	if (mysqli_query($conn, $sql)) {
		header("location:vel4.php");
		
		}else{
		echo "Something went wrong. please try again";
	}

}else{
	echo "please submit your form";
}
	



 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<img src='images/LOGO.png' id="meta"><br><br>
	<br>


	<form action="" method="POST">
		<div>
	<input type="text" name="Fullname" placeholder="Fullname" id="vel">
</div>
	<br>
	<br>
	<div>
		<input type="Email" name="Email" placeholder="Email" id="vel">
	</div>
		<br>
		<br>
		<div>
	<input type="password" name="Password" placeholder="Password" id="vel">
</div>
	<br>
	<br>
	<br>
	<br>
	<input type="submit" name="submit" value="submit" id="jay">
</form>

</body>
</html>
<style type='text/css'>
	body{
		text-align: center;
	}
	#jay{
		width: 50%;
		height:75px;
		background-color: #275F22;
		border-radius: 100px;
		font-size: 24px;
		color: white;
	}
	#vel{
		width: 50%;
		height: 45px;
		border-radius: 7px;
		border-color: blue;
	}
	#meta{
		width: 40%;
		height: 20%;
		margin-right: 30px;
	}
	

</style>