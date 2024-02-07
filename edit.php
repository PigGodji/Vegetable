<?php
session_start();
include("config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Change Profile</title>
</head>

<body>
    <div class="top-bar">
        <img src="logo.png">
        <p>Plantner</p>
        <div class="right-links">
            <a href="edit.php"> <button class="btn">Change profile</button> </a>
            <a href="logout.php"> <button class="btn">Log Out</button> </a>
        </div>
        <a href="index.html">HOME</a>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $weight = $_POST['weight'];
        $gender = $_POST['gender'];
        $likemenu = $_POST['likemenu'];
        $unlikeingredient = $_POST['unlikeingredient'];

        $id = $_SESSION['id'];

        $edit_query = mysqli_query($con, "UPDATE users SET Username='$username', Email='$email', Weight='$weight',Gender='$gender',Likemenu='$likemenu',Unlikeingredient='$unlikeingredient' WHERE Id=$id ") or die("error occurred");

        if ($edit_query) {
            echo "<div class='message'> <p>Profile Updated!</p> </div> <br>
            <div class='main-box'>
                    <div class='top'>
                        <div class='box'>
                            <p>Hello <b>  $username </b>, Welcome</p>
                            <p>Your email is <b> $email </b>.</p>
                            <p>Your weight is <b> $weight </b>kg</p>
                            <p>Your gender is <b> $gender</b>.</p>
                            <p>เมนูที่ชอบ คือ <b> $likemenu </b>.</p>
                            <p>วัตถุดิบที่แพ้/ไม่ชอบ คือ <b> $unlikeingredient </b>.</p>
                        </div>
                    </div>
                    <a href='match.php'> <button class='btn'>Match</button> </a>
            </div>";
        }
    }
    else {
        $id = $_SESSION['id'];
        $query = mysqli_query($con, "SELECT * FROM users WHERE Id = $id");

        while ($result = mysqli_fetch_assoc($query)) {
            $res_username = $result['Username'];
            $res_email = $result['Email'];
            $res_weight = $result['Weight'];
            $res_gender = $result['Gender'];
            $res_likemunu = $result['Likemenu'];
            $res_unlikeingredient = $result['Unlikeingredient'];
        }
        ?>

        <div class="container">
            <div class="box form-box">
                <header>Change Profile</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?php echo $res_username; ?>" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="<?php echo $res_email; ?>" autocomplete="off" required>
                    </div>

                    <div class="weight input">
                        <label for="weight">Weight (kg)</label>
                        <input type="number" name="weight" id="weight" value="<?php echo $res_weight; ?>" autocomplete="off" required>
                    </div>

                    <div class="gender">
                        <div class="head">
                            <label for="gender">Gender</label>
                        </div>
                        <select class="field input " name="gender" id="gender" value="<?php echo $res_gender; ?>" autocomplete="off" required>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    <div class="field input">
                        <label for="likemenu">เมนูที่ชอบ</label>
                        <input type="text" name="likemenu" id="likemenu" value="<?php echo $res_likemunu; ?>" autocomplete="off" required>
                    </div>

                    <div class="field input">
                        <label for="unlikeingredient">วัตถุดิบที่แพ้/ไม่ชอบ</label>
                        <input type="text" name="unlikeingredient" id="unlikeingredient" value="<?php echo $res_unlikeingredient; ?>" autocomplete="off" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Update" required>
                    </div>
                </form>
        </div>
        <?php } ?>
    </div>
</body>

</html>
