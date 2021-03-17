<html>

<head>
  <title> View Meetings </title>
  <link href="css/add.css" type="text/css" rel="stylesheet">
  <script src="//code.jquery.com/jquery.min.js"></script>
  <script src="js/jquery-collapsible-fieldset.js"></script>

  <!--<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>-->
  <style>
    table{
      position: relative;
      transform: scale(1.1);
      border-radius: 40px;
      margin: auto;
      border-collapse: collapse;
      margin-top: 10%;
    }

    td, th {
      padding: 1rem;
      border: 2px solid white;
      font-family: 'Gilmer-medium', sans-serif;
      font-size: 1.2rem;
    }

    h2{
      text-align: center;
      font-size: 200%;
    }

    #button{
      text-align: center;
    }
    a{
      text-decoration: none;
      color: black;
    }

    * {box-sizing: border-box;}


/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: white;
  color: white;
}

/* The popup form - hidden by default */
.form-popup {
  /*display: none;*/
  position: fixed;
  top: 0%;

  font-size: 70%;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  width: 400px;
  padding: 10px;
  background-color: transparent;
  margin-left: 0%;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 70%;
  padding: 9px;
  margin: 5px 0 10px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

#frm{
  border: solid gray 1px;
  width: 40%;
  border-radius: 1px;
  margin: 20px auto;
  background: white;
  padding: 20px;
}

#btn{
  color: black;
  background: #e5e5e5;
  padding: 5px;
  margin-left: 80%;
}

.collapsible, .collapsible.expanded {

}

.collapsible.collapsed {

}

.collapsible legend {
  font-weight: bold;
  cursor: pointer;
  padding-left: 10px;
}

.collapsible legend, .collapsible.expanded legend {
  background: transparent url("collapse/img/expanded.gif") no-repeat center left;
}

.collapsible.collapsed legend {
  background: transparent url("collapse/img/collapsed.gif") no-repeat center left;
}

  </style>
</head>

<body>
  <div id="title">
    <h2>View meetings</h2>
  </div>


  <div id="box">

    <div id="frm">

    <form action="view.php" method="POST">
      <p>
        <label style="/*position: relative; left: -120%;">Username: </label>
        <input type="text" id="user" name="user" > <!-- style="position: relative; left: -100%;" -->
      </p>
      <p>
        <label style="/*position: relative; left: -120%;">Password: </label>
        <input type="password" id="pass" name="pass" >
      </p>
      <p>
        <input type="submit" id="btn" value="Login" >
      </p>
    </form>
  </div>

  <br><br>
  <div id="button">
       <a href="index.php">Return to home page</a>
  </div>

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

    //normal user
    if($row[4] == "normal"){
      $sql = "SELECT * FROM `inputs` WHERE username = '$loginusername' ORDER BY meetingDate ASC";
      if($result = mysqli_query($conn, $sql)){
          if(mysqli_num_rows($result) > 0){
            echo "<table border='1' id='table'>";
              echo "<tr>";
                echo "<th>Meeting Name</th>";
                echo "<th>Date</th>";
                echo "<th>Start Time</th>";
                echo "<th>End Time</th>";
                echo "<th>Room</th>";
                echo "<th>Message</th>";
                echo "<th>Action</th>";
              echo "</tr>";
              while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                  echo "<td>" . $row['mName'] . "</td>";
                  echo "<td>" . $row['meetingDate'] . "</td>";
                  echo "<td>" . $row['startTime'] . "</td>";
                  echo "<td>" . $row['endTime'] . "</td>";
                  echo "<td>" . $row['mRoom'] . "</td>";
                  echo "<td>" . $row['message'] . "</td>";
                  echo "<td>";
                  include ("include.php");
                  "</td>";
                echo "</tr>";
              }
            echo "</table>";
            // Free result set
            mysqli_free_result($result);
          } else{
              echo "No records matching your query were found.";
          }
    }else{
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
      }
  }

//admin user
if($row[4] == "admin"){
    $sql = "SELECT * FROM `inputs` ORDER BY meetingDate ASC";
    if($result = mysqli_query($conn, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table border='1' id='table'>";
            echo "<tr>";
                echo "<th>Meeting Name</th>";
                echo "<th>Date</th>";
                echo "<th>Start Time</th>";
                echo "<th>End Time</th>";
                echo "<th>Room</th>";
                echo "<th>Priority</th>";
                echo "<th>Message</th>";
                echo "<th>User</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['mName'] . "</td>";
                echo "<td>" . $row['meetingDate'] . "</td>";
                echo "<td>" . $row['startTime'] . "</td>";
                echo "<td>" . $row['endTime'] . "</td>";
                echo "<td>" . $row['mRoom'] . "</td>";
                echo "<td>" . $row['priority'] . "</td>";
                echo "<td>" . $row['message'] . "</td>";
                echo "<td>" . $row['username'] . "</td>";
                "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
          } else{
              echo "No records matching your query were found.";
          }
         }else{
          echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
      }
    }

// Close connection
mysqli_close($conn);
  }
  else{

    echo "Falied to login";
  }

  ?>


  </div>
 </div>

</body>
</html>
