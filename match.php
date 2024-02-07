<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include("config.php");
        $id = $_SESSION['id'];
        $user_sql = "SELECT Id, Username, Likemenu FROM users WHERE id = '$id'";
        $user_result = $con->query($user_sql);
        $user_row = $user_result->fetch_assoc();
        $likemenu = $user_row['Likemenu'];
        $menu_sql = "SELECT * FROM menu WHERE name = '$likemenu'";
        $menu_result = $con->query($menu_sql);
        $menu_row = $menu_result->fetch_assoc();
        $menu = array();
        if ($user_result->num_rows > 0 && $menu_result->num_rows > 0) {
            $menu[] = $menu_row;
        }
        $randmenu_sql = "SELECT * FROM menu ORDER BY RAND() LIMIT 3";
        $randmenu_result = $con->query($randmenu_sql);
        while ($randmenu_row = $randmenu_result->fetch_assoc()) {
            $menu[] = $randmenu_row;
        }
        if (count($menu) > 0) {
            echo "<h2>Matched Data:</h2>";
            $breakfast = array_shift($menu);
            echo "<h1>มื้อเช้า</h1>";
            echo "<h2>เมนู: {$breakfast['Name']}</h2>Ingredients: {$breakfast['Ingredients']} Calorie: {$breakfast['Calorie']} Carbohydrate: {$breakfast['Carbohydrate']} Protein: {$breakfast['Protein']} Fat: {$breakfast['Fat']} Vitamin: {$breakfast['Vitamin']} Sodium: {$breakfast['Sodium']}<br>";
            $lunch = array_shift($menu);
            echo "<h1>มื้อกลางวัน</h1>";
            echo "<h2>เมนู: {$lunch['Name']}</h2>Ingredients: {$lunch['Ingredients']} Calorie: {$lunch['Calorie']} Carbohydrate: {$lunch['Carbohydrate']} Protein: {$lunch['Protein']} Fat: {$lunch['Fat']} Vitamin: {$lunch['Vitamin']} Sodium: {$lunch['Sodium']}<br>";
            foreach ($menu as $menu_row) {
                echo "<h1>มื้อเย็น</h1>";
                echo "<h2>เมนู: {$menu_row['Name']}</h2>Ingredients: {$menu_row['Ingredients']} Calorie: {$menu_row['Calorie']} Carbohydrate: {$menu_row['Carbohydrate']} Protein: {$menu_row['Protein']} Fat: {$menu_row['Fat']} Vitamin: {$menu_row['Vitamin']} Sodium: {$menu_row['Sodium']}<br>";
            }
        } else {
            echo "No matching data found";
        }
    ?>
</body>
</html>