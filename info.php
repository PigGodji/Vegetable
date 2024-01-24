<?php
$gender = $_POST['gender'];
$weight = $_POST['weight'];
$likemenu = $_POST['likemenu'];
$unlikemenu = $_POST['unlikemenu'];

if (!empty($gender) || !empty($weight) || !empty($likemenu) || !empty($unlikemenu)) {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "user_info";

    // Create connection
    $conn = mysqli_connect($host, $dbUsername, $dbPassword, $dbname);

    if ($conn) {
        $gender = mysqli_real_escape_string($conn, $gender);
        $weight = mysqli_real_escape_string($conn, $weight);
        $likemenu = mysqli_real_escape_string($conn, $likemenu);
        $unlikemenu = mysqli_real_escape_string($conn, $unlikemenu);

        $mysql = "INSERT INTO users_info (gender, weight, likemenu, unlikemenu)
        VALUES ('$gender', '$weight', '$likemenu', '$unlikemenu')";

        $result = mysqli_query($conn, $mysql);

        header("Location: home.php");

        mysqli_close($conn);
    } else {
        echo "Connection failed!";
    }
}
?>
