<!--<html>
<body>

<a href = "../home.php">
		<button class="button">home page</button>
	</a>
</body>
</html>-->

<?php
//get input from user
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
		echo "<script>";
   		echo '<BODY onLoad="showTable()">';
   		echo "</script>";
		?>
	<script>
		function showTable() {
          var x = document.getElementById("frm");
          var y = document.getElementById("table");
          y.style.display = "block";
          x.style.display = "none";
	</script>
	<?php
	}
	else{
		echo "Falied to login";
	}
?>