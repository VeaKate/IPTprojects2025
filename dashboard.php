<?php
    session_start();
    include("header.php");
    include("dataBase.php");

    if (!isset($_SESSION['product_name'])) {
        $_SESSION['product_name'] = [];
    }
    if (!isset($_SESSION['stock'])) {
        $_SESSION['stock'] = [];
    }
    if (!isset($_SESSION['price'])) {
        $_SESSION['price'] = [];
    }
    if (!isset($_SESSION['sold'])) {
        $_SESSION['sold'] = [];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["reg"])) {
        if($_POST["sold"] >= $_POST["stock"]) {
            echo "Sold cannot be greater than to stock";
        } else {
            $user_input = trim($_POST['product_name']);
            $price = trim($_POST['price']);
            $stock = trim($_POST['stock']);
            $sold = trim($_POST['sold']);
            header("location: dashboard.php");
            if($sold >  $stock) {
                echo "Sold cannot be greater than stock!";
        }
    }
    }
        if (!empty($user_input) && !empty($price) && !empty($stock)
            && !empty($sold)) {
            $_SESSION['product_name'][] = $user_input;
            $_SESSION['price'][] = $price;
            $_SESSION['stock'][] = $stock;
            $_SESSION['sold'][] =  $sold;
            header("location: dashboard.php");
            }

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_input'])) {
    $index_to_delete = intval($_POST['index']);
    if (isset($_SESSION['product_name'][$index_to_delete])) {
        unset($_SESSION['product_name'][$index_to_delete]);
        unset($_SESSION['price'][$index_to_delete]);
        unset($_SESSION['stock'][$index_to_delete]);
        unset($_SESSION['sold'][$index_to_delete]);
        $_SESSION['product_name'] = array_values($_SESSION['product_name']);
        $_SESSION['price'] = array_values($_SESSION['price']);
        $_SESSION['stock'] = array_values($_SESSION['stock']);
        $_SESSION['sold'] = array_values($_SESSION['sold']);
        header("location: dashboard.php");
    }
}  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 >Tally Sheet Table</h1>
    <main class="right-con">
        <aside class="ass">
        <h6>Please Fill Out The Following:</h6>
        <form action="dashboard.php" method="post">
        <input type="text" class="input" placeholder="Enter Product Name...."
        name="product_name"><br><br>
        <input type="number" class="input" placeholder="Stock...." 
        name="stock"><br><br>
        <input type="number" step ="0.01" class="input" placeholder="Product Price...." name="price"><br><br>
        <input type="number" class="input" placeholder="Sold Out...." name="sold"><br><br>
        <button id="button" type="submit" class="input" name="reg">Register</button>
        </aside>
        <div class="tabs">
            <table>
                <tr align="center">
                    <th width="150" >Product Name</th><t></t>
                    <th width="150" >Stock</th>
                    <th width="150" >Product Price</th>
                    <th width="150" >Sold Out</th>
                    <th width="150" ></th>
                </tr>
                <tr align="center">
                    <td class="data" name="table-data"><?php foreach ($_SESSION['product_name'] as $input) {
            echo "<h6>" . htmlspecialchars($input) . "</h6>";
        }
        ?></td>
                    <td  class="data" name="table-data"><?php foreach ($_SESSION['stock'] as $input) {
            echo "<h6>" . htmlspecialchars($input) . "</h6>";
            }
            ?></td>
                    <td  class="data" name="table-data"> <?php foreach ($_SESSION['price'] as $input) {
            echo "<h6>₱" . htmlspecialchars($input) . "</h6>";
        }
        ?></td>
                    <td  class="data"><?php 
                     foreach ($_SESSION['sold'] as $input) {
            echo "<h6>" . htmlspecialchars($input) . "</h6>";
        }
        ?></td>
            <td><?php
        foreach ($_SESSION['product_name'] as $index => $input) {
                echo "<h6> <form method='post' action='dashboard.php' style='display:inline;'>
                    <input type='hidden' name='index' value='$index'>
                    <button type='submit' id='del_but' name='delete_input'>Delete</button>
                </form></h6>";    
        }
        ?></td>
                </tr>
            </table>
        </div>
        </form>
       <a href="calcResult.php"><button id="calcButton">Calculate</button></a>
    </main>
</body>
</html>

<style>
    aside{
    float: left;
    width: 50%;
}
#del_but{
    background-color: red;
    color: white;
    padding: 2px;
    width: 80px;
    border-radius: 5px;
}
.right-con{
    text-align: center;
}
body{
    text-align: center;
    background-color: rgb(0, 128, 107);
    color: white;
}
th{
    font-size: 20px;
}
.data{
    font-family: Arial, Helvetica, sans-serif;
    font-size: 20px;
    font-weight: 0px;
}
.ass{
    font-size: 20px;
}
.input{
    font-size: 25px;
    padding: 15px;
    border-radius: 20px;
}
#button:hover{
    background-color: rgb(13, 224, 13);
    color: white;
}
#button{
    border-radius: 50px;
    width: 300px;
    font-weight: bold;
    background-color: rgb(243, 22, 22);
}
.tabs{
    background-color: white;
    color: black;
    height: 400px;
    float: right;
    width: 50%;
    text-align: center;
    border-radius: 10px;
    border-bottom-left-radius: 10px;
    overflow: scroll;
}
td{
    height: 10px;
}
#calcButton{
    margin-top: 35px;
    border-radius: 50px;
    width: 300px;
    font-size: 20px;
    font-weight: bold;
    background-color: rgb(243, 22, 22);
    height: 60px;
}
#remove{
    background-color: red;
    border-radius: 5px;
    color: white;
    font-weight: bold;
    border: none;
    padding: 3px;
}
#remove:hover{
    background-color: rgb(13, 224, 13);
    color: white;
}
#calcButton:hover{
    background-color: rgb(13, 224, 13);
    color: white;
}
</style>
