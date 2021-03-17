<html>
<body>
<?php
$loginusername = $_POST['user'];
$loginpassword = $_POST['pass'];

//conn to db
	$servername = "localhost";
	$username = "muchen";
	$password = "0zXLUTjMC2wUz88P";
	$dbname = "meeting";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error){
 	 die("Connection failed: ". $conn->connect_error);
	}


	$query = "SELECT * FROM login WHERE username='$loginusername' ";
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);

	if ($loginpassword == $row[2] && !empty($_POST["user"])){
		/*header("refresh:0; url=../home.php");*/
		echo "<div style='opacity: 0;'>Logged in</div>";
		header("refresh:0; url=../view.php");
	}
	else{
		echo "<div style='opacity: 0;'>Failed to log in</div>";
	}

?>
<!--<a href = "../home.php">
		<button class="button">go to home page</button>
</a>-->
</body>
</html>

