<?php
    session_start();

    if(isset($_POST["reset"])){
        session_unset();
        session_destroy();
    }
    if(isset($_POST["add"])){
        $_SESSION["name"] = htmlspecialchars($_POST["name"]);;
        $product = htmlspecialchars($_POST["product"]);
        $quantity = htmlspecialchars($_POST["quantity"]);
        if (!isset($_SESSION[$product])) {
            $_SESSION[$product] = 0;
        }
        $_SESSION[$product] += $quantity;
        
    }
    if(isset($_POST["remove"])){
        $_SESSION["name"] = htmlspecialchars($_POST["name"]);;
        $product = htmlspecialchars($_POST["product"]);
        if (!isset($_SESSION[$product])) {
            $_SESSION[$product] = 0;
        }
        $quantity = htmlspecialchars($_POST["quantity"]);
        if ($_SESSION[$product] - $quantity < 0) {
            echo("Cannot have a product with less quantity than 0.<br>");
        }
        else{
            $_SESSION[$product] -= $quantity;
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <h1>Supermarket Managment</h1>
    <form action="" method="post">
        <label for="name">Worker name:</label>
        <input type="text" name="name" value="<?php echo isset($_SESSION["name"]) ? "{$_SESSION["name"]}" : ""; ?>" required>
        <h2>Choose Product:</h2>
        <select name="product" id="product">
            <option value="soft_drink">Soft Drink</option>
            <option value="milk">Milk</option>
        </select>
        <h2>Product quantity:</h2>
        <input type="number" name="quantity" id="quantity" min="0" value="0">
        <br>
        <br>
        <input type="submit" name="add" value="add">
        <input type="submit" name="remove" value="remove">
        <input type="submit" name="reset" value="reset">
    </form>
    <h2>Inventary: </h2>
    <?php
        echo isset($_SESSION["name"]) ? "Worker: {$_SESSION["name"]}<br>" : "Worker:<br>";
        echo isset($_SESSION["milk"]) ? "Units of Milk: {$_SESSION["milk"]}<br>" : "Units of Milk: 0<br>";
        echo isset($_SESSION["soft_drink"]) ? "Units of Soft Drinks: {$_SESSION["soft_drink"]}<br>" : "Units of Soft Drinks: 0<br>";
    ?>
</body>
</html>