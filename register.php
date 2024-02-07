
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
</head>
<body>
    <div class="top-bar">
        <img src="logo.png">
        <p>Plantner</p>
        <a href="index.html">HOME</a>
    </div>
      <div class="container">
        <div class="box form-box">
        <?php 
         
         include("config.php");
         if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $weight = $_POST['weight'];
            $gender = $_POST['gender'];
            $likemenu = $_POST['likemenu'];
            $unlikeingredient = $_POST['unlikeingredient'];
            
         //verifying the unique email

         $verify_query = mysqli_query($con,"SELECT Email FROM users WHERE Email='$email'");

         if(mysqli_num_rows($verify_query) !=0 ){
            echo "<div class='message_error'>
                      <p>This email is used, Try another One Please!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
         }
         else{

            mysqli_query($con,"INSERT INTO users(Username,Email,Password,Weight,Gender,Likemenu,Unlikeingredient) VALUES('$username','$email','$password','$weight','$gender','$likemenu','$unlikeingredient')") or die("Error Occured");

            echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
            echo "<a href='index.php'><button class='btn'>Login Now</button>";
         

         }

         }else{
         
        ?>

            <header>Sign Up</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="weight input">
                    <label for="weight">Weight (kg)</label>
                    <input type="number" name="weight" id="weight" autocomplete="off" required>
                </div>
                <div class="gender">
                    <div class="head">
                        <label for="gender">Gender</label>
                    </div>
                    <select class="field input "name="gender">
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="field input">
                    <label for="likemenu">เมนูที่ชอบ</label>
                    <input type="text" pattern="[ก-๙]+" name="likemenu" id="likemenu" autocomplete="off" required>
                </div>
                
                <div class="field input">
                    <label for="unlikeingredient">วัตถุดิบที่แพ้/ไม่ชอบ</label>
                    <input type="text" pattern="[ก-๙]+" name="unlikeingredient" id="unlikeingredient" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="index.php">Sign In</a>
                </div>
                
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>