<html>

<!--<head>
  <title> meetings </title>
  <link href="css/add.css" type="text/css" rel="stylesheet">
</head>

<body>
	<div class="box">
		<h1>Successfully Inserted</h1>
    <h3>We will notify you via email if you need to update your meeting information</h3>


	<a href = "index.php">
		<button class="button">back to home page</button>
	</a>
	<a href = "view.php">
		<button class="button">view meeting</button>
	</a>

	</div>
</body>
-->

<?php
/*Code will be able to detect conflicting meetings and send an email notification to the user with a lower priority
with recommended dates. The users can then come to the website and update/delete their meetings. If they are not happy
with the recommended meeting times, they shall contact the admin and arrange a new time.
*/

//function will be called once a user adds/updates a meeting.
//function will compare the meeting date, time, and meeting room with other meetings in the db.

$servername = "localhost";
$username = "muchen";
$password = "0zXLUTjMC2wUz88P";
$dbname = "meeting";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
  die("Connection failed: ". $conn->connect_error);
}

//detecting
$sql = "SELECT * FROM inputs ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
echo $row['meetingDate'];
/*$newQuery = "SELECT * FROM inputs WHERE meetingTime = '$meetingTime' AND startTime = '$startTime' AND mRoom = '$mRoom'";*/

//new function
//come up with recommended meeting times. Optimal: same day, same room, different time.

 ?>

</html>
