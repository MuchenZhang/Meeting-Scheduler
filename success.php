<html>

<head>
  <title> meetings </title>
  <link href="css/add.css" type="text/css" rel="stylesheet">
</head>

<body>
	<div class="box">
		<h1>Successfully Inserted</h1>
    <p>Thank you for registering a meeting, you will receive an email if there is update to your meetings.</p>

	<a href = "index.php">
		<button class="button">back to home page</button>
	</a>
	<a href = "view.php">
		<button class="button">view meeting</button>
	</a>

	</div>
</body>

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
//getting the last input
$sql = "SELECT * FROM inputs ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

$mName = $row['mName'];
$meetingDate = $row['meetingDate'];
$startTime = $row['startTime'];
$endTime = $row['endTime'];
$mRoom = $row['mRoom'];
$priority = $row['priority'];
$user = $row['username'];

//select every row except the last row

$sql1 = "SELECT * FROM inputs WHERE id != (SELECT MAX(id) FROM inputs)";
$result1 = mysqli_query($conn, $sql1);

$conflict_count=0;
$conflict_array = array();
while($row1 = mysqli_fetch_array($result1))
 {
  $row_meetingDate = $row1['meetingDate'];
  $row_startTime = $row1['startTime'];
  $row_mRoom = $row1['mRoom'];
  $row_priority = $row1['priority'];
  $row_user = $row1['username'];
  if($meetingDate == $row_meetingDate && $startTime == $row_startTime && $mRoom == $row_mRoom){
    $row_mName = $row1['mName'];
    $conflict_array[] = $row_mName; //Store the name of conflicting meeting in an array.
    $conflict_count++;
  }
}

if($conflict_count!=0){

  $int_priority = (int)$priority;
  $int_row_priority = (int)$row_priority;

  if($int_priority <= $int_row_priority){
    $sql3 = "SELECT * FROM login WHERE username = '$user'";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_array($result3);
    $user_email = $row3['email'];
    echo "Your meeting is conflicted with another meeting registered in the database.";
    echo "<br>";
    echo "The meeting room is not available ";
    echo "<br>";

    require("recTime.php");
    $recTime = rec($mName, $startTime, $endTime, $meetingDate, $mRoom);
    echo $recTime;

  }

  else{
  $conflict_mName = $conflict_array[0];
  $sql2 = "SELECT * FROM inputs WHERE mName='$conflict_mName'";
  $result2 = mysqli_query($conn, $sql2);
  $row2 = mysqli_fetch_array($result2);
  $conflict_user = $row2['username'];
  $conflict_startTime = $row2['startTime'];
  $conflict_endTime = $row2['endTime'];
  $conflict_meetingDate = $row2['meetingDate'];
  $conflict_mRoom = $row2['mRoom'];

  $sql4 = "SELECT * FROM login WHERE username = '$conflict_user'";
  $result4 = mysqli_query($conn, $sql4);
  $row4 = mysqli_fetch_array($result4);
  $conflict_email = $row4['email'];

  //send email to conflict user
  require("PHPMailer/class.phpmailer.php");

  $mail = new PHPMailer();
  $mail->IsSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = "tls";
  $mail->Host = "smtp.gmail.com";
  $mail->Port = 587;
  $mail->Username = "muchen.zhang1022@gmail.com";   //gmail account
  $mail->Password = "Zmc_20031022";    //gmail password
  $mail->setFrom("muchen.zhang1022@gmail.com", "no-reply");
  $mail->AddAddress($conflict_email);
  $mail->Subject = "Meeting Update";
  $mail->isHTML(true);
  $mail->Body = "<html>
  <p>Dear $conflict_user,</p>
  <p>Your meeting $conflict_mName is conflicted with another meeting with a higher priority rating registered in the database.</p>
  <p>Please visit 'localhost:8080/IA/view.php' and change your meeting time.</p>
  <p>If you have any questions, please email the administrator at: admin-example@gmail.com</p>
  </html>";

  if ($mail->Send() == false)
  {
      die($mail->ErrInfo);
  }


  }
}


 ?>

</html>
