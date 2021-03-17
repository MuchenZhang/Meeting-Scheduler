<?php


    //UPDATE Button
    if(isset($_POST['update']))
    {
        $servername = "localhost";
        $username = "muchen";
        $password = "0zXLUTjMC2wUz88P";
        $dbname = "meeting";

        $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error){
            die("Connection failed: ". $conn->connect_error);
        }

        $mName = $_POST['view_mName'];
        $meetingDate = $_POST['view_meetingDate'];
        $startTime = $_POST['view_startTime'];
        $endTime = $_POST['view_endTime'];
        $numPeople = $_POST['view_numPeople'];
        $mRoom = $_POST['view_mRoom'];
        $priority = $_POST['view_priority'];
        $message = $_POST['view_message'];


        $query = "UPDATE inputs SET meetingDate='$meetingDate', startTime='$startTime', endTime='$endTime', numPeople='$numPeople', mRoom='$mRoom', priority='$priority', message='$message' WHERE mName='$mName' ";
        $query_run = mysqli_query($conn, $query);

        if($query_run){
            echo '<script type="text/javascript"> alert("Successfully Updated") </script>';
        }
        else{
            echo '<script type="text/javascript"> alert("ERROR, unsuccessful") </script>';
        }
    }

    //DELETE Button
    elseif (isset($_POST['delete'])){
    	$servername = "localhost";
        $username = "muchen";
        $password = "0zXLUTjMC2wUz88P";
        $dbname = "meeting";

        $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error){
            die("Connection failed: ". $conn->connect_error);
        }

        $query2 = "DELETE FROM inputs WHERE mName='$_POST[view_mName]' ";
        $query_run2 = mysqli_query($conn, $query2);
        if($query_run2){
            echo '<script type="text/javascript"> alert("Successfully Deleted") </script>';
        }
        else{
            echo '<script type="text/javascript"> alert("ERROR, unsuccessful deletion") </script>';
        }
    }

header("refresh:0; url=view.php");

?>
