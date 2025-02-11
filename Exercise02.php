<?php
        session_start();
        if (isset($_POST["reset"])) {
            session_unset();
            session_destroy();
        }
        $isAverage = false;
        if (!isset($_SESSION["array"])) {
            $_SESSION["array"] = array(10,20,30);
        }
        if (isset($_POST["modify"])) {
            $position = htmlspecialchars($_POST["position"]);
            $value = htmlspecialchars($_POST["value"]);
            $newArray = $_SESSION["array"];
            $newArray[$position] = $value;
            $_SESSION["array"] = $newArray; 
        }
        if (isset($_POST["average"])){
            $isAverage = true;
            $total = 0;
            foreach($_SESSION["array"] as $num){
                $total += $num;
            }
            $average = $total / count($_SESSION["array"]);
            $average = round($average, 2);
        }
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <h1>Modify array saved in session</h1>
    <form action="" method="post">
        <label for="position">Position to modify: </label>
        <select name="position" name="position" id="position">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
        </select>
        <br>
        <label for="value">New value: </label>
        <input type="number" name="value" id="value">
        <br>
        <input type="submit" name="modify" value="Modify">
        <input type="submit" name="average" value="Average">
        <input type="submit" name="reset" value="Reset">
    </form>
    <p>Current array: <?php foreach($_SESSION["array"] as $num){echo ("{$num}," );} ?></p>
    <?php
        echo "<br>";
        if($isAverage){
            echo "Average: {$average}";
        }
    ?>
</body>
</html>