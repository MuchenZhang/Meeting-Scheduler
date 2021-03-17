<?php

//already have
//come up with recommended meeting times. Optimal: same day, same room, different time.

function rec($mName, $startTime, $endTime, $meetingDate, $mRoom){
  //connect to db
  $servername = "localhost";
  $username = "muchen";
  $password = "0zXLUTjMC2wUz88P";
  $dbname = "meeting";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
  }


  //duration of the meeting, in minutes
  $timeDiff = ( strtotime($endTime) - strtotime($startTime) ) / 60;

  //select everything from input table where meeting date, meeting room is the same, except meeting name different
  $sql5 = "SELECT * FROM inputs WHERE meetingDate = '$meetingDate' && mRoom = '$mRoom'";
  $result5 = mysqli_query($conn, $sql5);

  $conflictMeeting_mName = array();
  $conflictMeeting_startTime = array();
  $conflictMeeting_endTime = array();

  while($row5 = mysqli_fetch_array($result5)){
    if($row5['mName'] != $mName){
      $conflictMeeting_mName[] = $row5['mName'];
      $conflictMeeting_startTime[] = $row5['startTime'];
      $conflictMeeting_endTime[] = $row5['endTime'];
    }
  }

  for($i=0; $i<count($conflictMeeting_startTime); $i++){
    $meeting_startTime = $conflictMeeting_startTime[$i];
    $meeting_endTime = $conflictMeeting_endTime[$i];
    echo "from ". $meeting_startTime. " to ".$meeting_endTime.", ";
    echo "<br>";
  }

  echo "on $meetingDate.";
  echo "<br>";
  echo "Please choose a different meeting time.";
}


//test: call function
/*$mName = "jh";
$startTime = "12:30";
$endTime = "14:30";
$meetingDate = "2021-02-05";
$mRoom = "2";
rec($mName, $startTime, $endTime, $meetingDate, $mRoom);*/
?>
