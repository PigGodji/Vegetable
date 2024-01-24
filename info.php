<?php
$gender = $_POST['gender'];
$weight = $_POST['weight'];
$likemenu = $_POST['likemenu'];
$unlikemenu = $_POST['unlikemenu'];
if (!empty($gender) || !empty($weight) || !empty($likemenu) || !empty($unlikemenu)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "user_information";
    //Create connection
    $conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);
    if(isset($_POST['submit'])) {
        $gender = mysqli_real_escape_string($con,$_POST['gender']);
        $weight = mysqli_real_escape_string($con,$_POST['weight']);
        $likemenu = mysqli_real_escape_string($con,$_POST['likemenu']);
        $unlikemenu = mysqli_real_escape_string($con,$_POST['unlikemenu']);

        $result = mysqli_query($con,"SELECT * FROM user_information WHERE likemenu='$likemenu' AND unlikemenu='$unlikemenu' ") or die("Select Error");
        $row = mysqli_fetch_assoc($result);

        if(is_array($row) && !empty($row)){
            $_SESSION['valid'] = $row['likemenu'];
            $_SESSION['unlikemenu'] = $row['unlikemenu'];
            $_SESSION['id'] = $row['Id'];
        }else{
            echo "<div class='message'>
              <p>Wrong Username or Password</p>
               </div> <br>";
           echo "<a href='index.php'><button class='btn'>Go Back</button>";
 
        }
        if(isset($_SESSION['valid'])){
            header("Location: home.php");
        }
    }
}
?>