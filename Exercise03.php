<!DOCTYPE html>
<html>
    <?php
        session_start();
        $name = "";
        $error = "";
        $message = "";

        isset($_SESSION['list']) ? $index = count(($_SESSION['list'])) : $index = 0;
        $totalValue = 0;

        if (isset($_POST['edit'])) {
            $name = htmlspecialchars($_POST['name']);
            $quantity = htmlspecialchars($_POST['quantity']);
            $price = htmlspecialchars($_POST['price']);
        }
    ?>

    <head>
        <title>Shopping list</title>
        <style>
            table,
            th,
            td {
                border: 1px solid black;
                border-collapse: collapse;
            }

            th,
            td {
                padding: 5px;
            }

            input[type=submit] {
                margin-top: 10px;
            }
        </style>
    </head>

    <body>
        <h1>Shopping list</h1>
        <form method="post">
            <label for="name">name:</label>
            <input type="text" name="name" id="name" value="<?php echo $name; ?>">
            <br>
            <label for="quantity">quantity:</label>
            <input type="number" name="quantity" id="quantity" min="0" value="<?php echo $quantity; ?>">
            <br>
            <label for="price">price:</label>
            <input type="number" name="price" id="price" min="0" value="<?php echo $price; ?>">
            <br>
            <input type="hidden" name="index" value="<?php echo $index; ?>">
            <input type="submit" name="add" value="Add">
            <input type="submit" name="update" value="Update">
            <input type="submit" name="reset" value="Reset">
        </form>
        <?php

            // logica de add, update y reset

            // primero el add al formulario, calculateTotal, delete

            // ultimo el update que es que se aprieta el edit en el formulario y se pone en el primer formulario 
            // en el que te lo muestra y lo modifica ahi.
            
                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    if(isset($_POST['add']) || isset($_POST['update'])){
                        $name = htmlspecialchars($_POST['name']);
                        $quantity = htmlspecialchars($_POST['quantity']);
                        $price = htmlspecialchars($_POST['price']);
                        if(isset($_POST['add'])){
                            $_SESSION['list'][$index] = array('name' => $name, 'quantity' => $quantity, 'price' => $price);
                            $message = "Item added properly.";
                        }
                        if(isset($_POST['update'])){
                            
                        }
                    }
                    var_dump($_SESSION['list']);
                }

                if(isset($_POST['delete'])){
                    $index = htmlspecialchars($_POST['index']);
                    unset($_SESSION['list'][$index]);
                    $message = "Item deleted properly.";
            }
            if(isset($_POST['total'])){
                foreach($_SESSION['list'] as $index => $item){
                    $totalValue += $item['quantity'] * $item['price'];
                }
            }
        ?>

        <!-- error message -->
        <p style="color:red;"><?php echo $error; ?></p>

        <!-- item added properly -->
        <p style="color:green;"><?php echo $message; ?></p>

        <table>
            <thead>
                <tr>
                    <th>name</th>
                    <th>quantity</th>
                    <th>price</th>
                    <th>cost</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['list'] as $index => $item) { ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td><?php echo $item['price']; ?></td>
                        <td><?php echo $item['quantity'] * $item['price']; ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="name" value="<?php echo $item['name']; ?>">
                                <input type="hidden" name="quantity" value="<?php echo $item['quantity']; ?>">
                                <input type="hidden" name="price" value="<?php echo $item['price']; ?>">
                                <input type="hidden" name="index" value="<?php echo $index; ?>">
                                <input type="submit" name="edit" value="Edit">
                                <input type="submit" name="delete" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="3" align="right"><strong>Total:</strong></td>
                    <td><?php echo "{$totalValue}" ?></td>
                    <td>
                        <form method="post">
                            <input type="submit" name="total" value="Calculate total">
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </body>
</html>