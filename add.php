<html>

<head>
  <title> meetings </title>
  <link href="css/add.css" type="text/css" rel="stylesheet">
</head>

<body>

<?php
include 'detect.php';
$mNameErr = $meetingDateErr = $startTimeErr = $endTimeErr = $numPeopleErr = $mRoomErr = $priorityErr = $messageErr = $userErr = $passErr = "";
$mName = $meetingDate = $startTime = $endTime = $numPeople = $mRoom = $priority = $message = $user = $pass = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["mName"])) {
    $mNameErr = "required";
  } else {
    $mName = $_POST["mName"];
  }

  if (empty($_POST["meetingDate"])) {
    $meetingDateErr = "required";
  } else {
    $meetingDate = $_POST["meetingDate"];
  }

  if (empty($_POST["startTime"])) {
    $startTimeErr = "required";
  } else {
    $startTime = $_POST["startTime"];
  }

  if (empty($_POST["endTime"])) {
    $endTimeErr = "required";
  } else {
    $endTime = $_POST["endTime"];
  }

  if (empty($_POST["numPeople"])) {
    $numPeopleErr = "required";
  } else {
    $numPeople = $_POST["numPeople"];
  }

  if (empty($_POST["mRoom"])) {
    $mRoomErr = "required";
  } else {
    $mRoom = $_POST["mRoom"];
  }

  if (empty($_POST["priority"])) {
    $priorityErr = "required";
  } else {
    $priority = $_POST["priority"];
  }

  if (empty($_POST["message"])) {
    $messageErr = "";
  } else {
    $message = $_POST["message"];
  }

  if (empty($_POST["user"])) {
    $userErr = "required";
  }else{
    $user = $_POST["user"];
  }


  if (empty($_POST["pass"])) {
    $passErr = "required";
  } else{
    $pass = $_POST["pass"];
  }
}



  $servername = "localhost";
  $username = "muchen";
  $password = "0zXLUTjMC2wUz88P";
  $dbname = "meeting";

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error){
    die("Connection failed: ". $conn->connect_error);
  }

  $query = "SELECT * FROM login WHERE username='$user' ";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);

  if ($pass == $row[2] && $row[4]=="normal"){
      $sql = "INSERT INTO inputs (mName, meetingDate, startTime, endTime, numPeople, mRoom, priority, message, username)
      VALUES ('$mName', '$meetingDate', '$startTime', '$endTime', '$numPeople', '$mRoom', '$priority', '$message', '$user')";
        if(!mysqli_query($conn, $sql)){
          echo ("Error description: " . mysqli_error($conn));
        }
        else{
          header("refresh:0; url=success.php");
        }
    }
  elseif($pass==$row[2] && $row[4]=="admin"){
    echo "Administrators cannot add meetings";
  }
  else{
   echo "Invalid password";
  }

?>

	<div>
		<form id="regform" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
         <p><span class="error">* required field</span></p>

      <p>
        <label for="user">Username: </label>
        <input type="text" id="user" name="user">
        <span class="error">* <?php echo $userErr;?></span>
      </p>
      <p>
        <label for="pass">Password: </label>
        <input type="password" id="pass" name="pass">
        <span class="error">* <?php echo $passErr;?></span>
      </p><br><br>


			<label for="meetingName">Name of Meeting</label>
			<input type="text" id="mName" name="mName" value="<?php echo isset($_POST['mName']) ? $_POST['mName'] : ''; ?>" >
         <span class="error">* <?php echo $mNameErr;?></span>
         <br><br>

			<label for="meetingDate">Meeting Date</label>
			<input type="date" name="meetingDate" id="meetingDate" value="<?php echo isset($_POST['meetingDate']) ? $_POST['meetingDate'] : ''; ?>">
         <span class="error">* <?php echo $meetingDateErr;?></span>
         <br><br>

			<label for="startTime">Start Time</label>
			<input type="text" id="timePicker" name="startTime" value="<?php echo isset($_POST['startTime']) ? $_POST['startTime'] : ''; ?>">
         <span class="error">* <?php echo $startTimeErr;?></span>
         <br><br>

			<label for="endTime">End Time</label>
			<input type="text" id="timePicker1" name="endTime" value="<?php echo isset($_POST['endTime']) ? $_POST['endTime'] : ''; ?>" >
         <span class="error">* <?php echo $endTimeErr;?></span>
         <br><br>

			<label for="numPeople">Number of People</label>
			<input type="number" id="numPeople" name="numPeople" value="<?php echo isset($_POST['numPeople']) ? $_POST['numPeople'] : ''; ?>">
         <span class="error">* <?php echo $numPeopleErr;?></span>
         <br><br>


			<label>Meeting Room</label>
         <span class="error">* <?php echo $mRoomErr;?></span><br>
         <input type="radio" name="mRoom" value="1"/>Meeting Room 1<br>
         <input type="radio" name="mRoom" value="2"/>Meeting Room 2<br><br>


 		 	<label for="priority">Priority</label>
         <span class="error">* <?php echo $priorityErr;?></span><br>
			<input type="radio" name="priority" value="1">
  			<label for="1">Weekly meeting</label><br>
  			<input type="radio" name="priority" value="2">
 		 	<label for="2">Monthly meeting</label><br>
 		 	<input type="radio" name="priority" value="3">
 		 	<label for="3">International meeting</label>
         <br><br>

 		 	<textarea name="message" rows="10" cols="30" spellcheck="false" placeholder="Additional requirements..."></textarea><br><br>

 		 	<input type="submit" name="submit" value="Submit">

		</form>
	</div>

<script>
function timePicker(id){
   var input = document.getElementById(id);
   var timePicker = document.createElement('div');
   timePicker.classList.add('time-picker');
   input.value = '08:30';

   //open timepicker
   input.onclick= function(){
      timePicker.classList.toggle('open');

      this.setAttribute('disabled','disabled');
      timePicker.innerHTML +=`
      <div class="set-time">
         <div class="label">
            <a id="plusH" >+</a>
            <input class="set" type="text" id="hour" value="08">
            <a id="minusH">-</a>
         </div>
         <div class="label">
            <a id="plusM">+</a>
            <input class="set" type="text" id="minute" value="30">
            <a id="minusM">-</a>
         </div>
      </div>
      <div id="submitTime">Set time</div>`;
      this.after(timePicker);
      var plusH = document.getElementById('plusH');
      var minusH = document.getElementById('minusH');
      var plusM = document.getElementById('plusM');
      var minusM = document.getElementById('minusM');
      var h = parseInt(document.getElementById('hour').value);
      var m = parseInt(document.getElementById('minute').value);
     //increment hour
      plusH.onclick = function(){
         h = isNaN(h) ? 0 : h;
         if(h===23){
            h =-1;
         }
          h++;
         document.getElementById('hour').value = (h<10?'0':0)+h;
      }
      //decrement hour
      minusH.onclick = function(){
         h = isNaN(h) ? 0 : h;
         if(h===0){
            h =24;
         }
         h--;
         document.getElementById('hour').value = (h<10?'0':0)+h;
      }
      //increment hour
      plusM.onclick = function(){
         m = isNaN(m) ? 0 : m;
         if(m===45){
            m =-15;
         }
          m = m+15;
         document.getElementById('minute').value = (m<10?'0':0)+m;
      }
      //decrement hour
      minusM.onclick = function(){
        m = isNaN(m) ? 0 : m;
         if(m===0){
            m =60;
         }
         m = m-15;
         document.getElementById('minute').value = (m<10?'0':0)+m;
      }

      //submit timepicker
      var submit = document.getElementById("submitTime");
      submit.onclick = function(){
        input.value = document.getElementById('hour').value+':'+document.getElementById('minute').value;
         input.removeAttribute('disabled');
         timePicker.classList.toggle('open');
         timePicker.innerHTML = '';
      }
   }
}

timePicker('timePicker');

timePicker('timePicker1');


</script>

</body>

</html>
