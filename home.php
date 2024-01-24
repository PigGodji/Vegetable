<?php 
   session_start();

   include("config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: index_reg.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body>

    <div class="top-bar">
        <a href="#">About us</a>
        <a href="info.html">Plan</a>
        <a href="index.html">Home</a>

        <div class="right-links">
            <a href="logout.php"> <button class="btn">Log Out</button> </a>
            

        </div>
    </div>
    <main>

        <div class="info-form">
            <form method="post" name="myForm">
                <label for="gender">Gender</label>
                <select id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
                <label for="weight">Weight</label>
                <input type="number" id="weight" name="weight" min="0" max="200">
                <label for="likemenu">Menu that you like</label>
                <input type="text" id="likemenu" name="likemenu">
                <label for="unlikemenu">Menu that you don't like</label>
                <input type="text" id="unlikemenu" name="unlikemenu">
                <button type="submit" name="submit" value="save">Done</button>
            </form>
        </div>
        <script>
            const scriptURL = 'https://script.google.com/macros/s/AKfycbxh75CgizBcz2TZr8MR5LPydFrgJ5SR3WMLlSfJKnzdZ0AldHd4CWjZlkY09xnvNULt/exec'
            const form = document.forms['myForm']
            form.addEventListener('submit', e => {
                e.preventDefault()
                fetch(scriptURL, { method: 'POST', body: new FormData(form) })
                    .then(response => Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Success',
                        showConfirmButton: false,
                        timer: 1500
                    }))
                    .catch(error => console.error('Error!', error.message))
                    .catch.contact - form.reset();
            })
        </script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        
       </div>

    </main>
</body>
</html>
