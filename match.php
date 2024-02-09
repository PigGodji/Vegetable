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
    <?php
        include("config.php");
        $id = $_SESSION['id'];
        // $match = $_POST['match'];
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
            echo "<h2>Match</h2>";
            $breakfast = array_shift($menu);
            echo "<h1>มื้อเช้า</h1>";
            $breakfast_menu = "<h2>เมนู: {$breakfast['Name']}</h2>วัตถุดิบ: {$breakfast['Ingredients']} Calorie: {$breakfast['Calorie']} Carbohydrate: {$breakfast['Carbohydrate']} Protein: {$breakfast['Protein']} Fat: {$breakfast['Fat']} Vitamin: {$breakfast['Vitamin']} Sodium: {$breakfast['Sodium']} <form method='post' action='match.php'> <button type='submit' name='match' value='yes-breakfast'>เอาอันนี้</button> <button type='submit' name='match' value='no-breakfast'>แหวะ</button> </form><br>";
            echo $breakfast_menu;
            $lunch = array_shift($menu);
            echo "<h1>มื้อกลางวัน</h1>";
            $lunch_menu = "<h2>เมนู: {$lunch['Name']}</h2>วัตถุดิบ: {$lunch['Ingredients']} Calorie: {$lunch['Calorie']} Carbohydrate: {$lunch['Carbohydrate']} Protein: {$lunch['Protein']} Fat: {$lunch['Fat']} Vitamin: {$lunch['Vitamin']} Sodium: {$lunch['Sodium']} <form method='post' action='match.php'> <button type='submit' name='match' value='yes-lunch'>เอาอันนี้</button> <button type='submit' name='match' value='no-lunch'>แหวะ</button> </form><br>";
            echo $lunch_menu;
            $dinner = array_shift($menu);
            echo "<h1>มื้อเย็น</h1>";
            $dinner_menu = "<h2>เมนู: {$dinner['Name']}</h2>วัตถุดิบ: {$dinner['Ingredients']} Calorie: {$dinner['Calorie']} Carbohydrate: {$dinner['Carbohydrate']} Protein: {$dinner['Protein']} Fat: {$dinner['Fat']} Vitamin: {$dinner['Vitamin']} Sodium: {$dinner['Sodium']} <form method='post' action='match.php'> <button type='submit' name='match' value='yes-dinner'>เอาอันนี้</button> <button type='submit' name='match' value='no-dinner'>แหวะ</button> </form><br>";
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
</body>
</html>