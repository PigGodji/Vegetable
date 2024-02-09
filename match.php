<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="match.css">
    <title>Document</title>
</head>
<body>
<div class="top-bar">
        <img src="logo.png">
        <p>Plantner</p>
        <div class="right-links">
            <a href="edit.php"> <button class="btn">Change profile</button> </a>
            <a href="logout.php"> <button class="btn">Log Out</button> </a>
        </div>
        <a href="index.html" id='home'>HOME</a>
    </div>

    <?php
        include("config.php");
        $id = $_SESSION['id'];
        $match = $_POST['match'];
        $user_sql = "SELECT Id, Username, Likemenu, Unlikeingredient FROM users WHERE id = '$id'";
        $user_result = $con -> query($user_sql);
        $user_row = $user_result -> fetch_assoc();

        $likemenu = $user_row['Likemenu'];
        $likemenu_sql = "SELECT * FROM menu WHERE name = '$likemenu'";
        $likemenu_result = $con -> query($likemenu_sql);
        $likemenu_row = $likemenu_result -> fetch_assoc();

        $menu = array();
        if ($user_result -> num_rows > 0 && $likemenu_result -> num_rows > 0) {
            $menu[] = $likemenu_row;
        }
        $randmenu_sql = "SELECT * FROM menu ORDER BY RAND() LIMIT 2";
        $randmenu_result = $con -> query($randmenu_sql);
        while ($randmenu_row = $randmenu_result -> fetch_assoc()) {
            $menu[] = $randmenu_row;
        }

        if (count($menu) > 0) {
            $breakfast = array_shift($menu);
            echo "<h1>มื้อเช้า</h1>";
            $breakfast_menu = " <div class='menubox'>
                                    <h2>เมนู: {$breakfast['Name']}</h2>
                                    <div class='menuinfo'>
                                        วัตถุดิบ: {$breakfast['Ingredients']}<br> 
                                        Calorie: {$breakfast['Calorie']}<br>
                                        Carbohydrate: {$breakfast['Carbohydrate']}<br> 
                                         Protein: {$breakfast['Protein']}<br>
                                        Fat: {$breakfast['Fat']}<br>
                                        Vitamin: {$breakfast['Vitamin']}<br>
                                        Sodium: {$breakfast['Sodium']}
                                    </div>
                                </div>
                                
                                <form method='post' action='match.php'> <button type='submit' name='match' value='yes-breakfast' class='match' id='breakfast' onclick='BhideButton'>yes</button> <button type='submit' name='match' value='no-breakfast' class='re' id='breakfast'>no</button> </form><br>";
            echo $breakfast_menu;
            $lunch = array_shift($menu);
            echo "<h1>มื้อกลางวัน</h1>";
            $lunch_menu = "<div class='menubox'>
                                <h2>เมนู: {$lunch['Name']}</h2>
                                <div class='menuinfo'>
                                    วัตถุดิบ: {$lunch['Ingredients']}<br>
                                    Calorie: {$lunch['Calorie']} <br>
                                    Carbohydrate: {$lunch['Carbohydrate']}<br>
                                    Protein: {$lunch['Protein']}<br>
                                    Fat: {$lunch['Fat']}<br>
                                    Vitamin: {$lunch['Vitamin']}<br>
                                    Sodium: {$lunch['Sodium']}<br>
                                </div>
                            
                            </div>
                            <form method='post' action='match.php'> <button type='submit' name='match' value='yes-lunch' class='match' id='lunch' onclick='LhideButton'>yes</button> <button type='submit' name='match' value='no-lunch' class='re' id='lunch'>no</button> </form><br>";
            echo $lunch_menu;
            $dinner = array_shift($menu);
            echo "<h1>มื้อเย็น</h1>";
            $dinner_menu = "<div class='menubox'>
                                <h2>เมนู: {$dinner['Name']}</h2>
                                <div class='menuinfo'>
                                    วัตถุดิบ: {$dinner['Ingredients']}<br>
                                    Calorie: {$dinner['Calorie']}<br> 
                                    Carbohydrate: {$dinner['Carbohydrate']}<br> 
                                    Protein: {$dinner['Protein']}<br> 
                                    Fat: {$dinner['Fat']}<br> 
                                    Vitamin: {$dinner['Vitamin']}<br> 
                                    Sodium: {$dinner['Sodium']}<br> 
                                </div>
                            </div>
                            <form method='post' action='match.php'> <button type='submit' name='match' value='yes-dinner' class='match' id=''dinner onclick='DhideButton'>yes</button> <button type='submit' name='match' value='no-dinner' class='re' id='dinner'>no</button> </form><br>";
            echo $dinner_menu;
        } else {
            echo "No matching data found";
        }
        
        if ($match == 'yes-breakfast') {
            echo "<p>คุณเลือกมื้อเช้าเป็น: {$breakfast['Name']}</p>";
        }
        if ($match == 'yes-lunch') {
            echo "<p>คุณเลือกมื้อเที่ยงเป็น: {$lunch['Name']}</p>";
        }
        if ($match == 'yes-dinner') {
            echo "<p>คุณเลือกมื้อเย็นเป็น: {$dinner['Name']}</p>";
        }

        if ($match == 'no-breakfast') {
            foreach ($menu as $menu_row) {
                $breakfast_menu = "<h2>เมนู: {$menu_row['Name']}</h2>วัตถุดิบ: {$menu_row['Ingredients']} Calorie: {$menu_row['Calorie']} Carbohydrate: {$menu_row['Carbohydrate']} Protein: {$menu_row['Protein']} Fat: {$menu_row['Fat']} Vitamin: {$menu_row['Vitamin']} Sodium: {$menu_row['Sodium']} <form method='post' action='match.php'> <button type='submit' name='match' value='yes-breakfast'>เอาอันนี้</button> <button type='submit' name='match' value='no-breakfast'>แหวะ</button> </form><br>";
            }
        }
    ?>
    <script>
        function BhideButton (){
            var button = document.getElementById('breakfast')
            button.style.display = 'none'
        }

        function LhideButton (){
            var button = document.getElementById('lunch')
            button.style.display = 'none'
        }

        function DhideButton (){
            var button = document.getElementById('dinner')
            button.style.display = 'none'
        }
    </script>
</body>
</html>