<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
    if (!isset($_SESSION["username"])) {
        header("Location: main.php"); 
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Sales Inventory</title>
    <link rel="icon" type="image/png" href="newLogo.png">
</head>
<body align="center">
    <a href="dashboard.php"> 
        <button title="back" style="border: none; font-size: 20px; background-color: white; 
    position: fixed; top: 20px; left: 20px; padding: 10px 20px; border-radius: 8px; 
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); cursor: pointer;">
     Back
</button>
    </a>
    <sup style="margin-right: 30px;">
        <?php
        if (isset($_SESSION["Date/Time"], $_SESSION["City"])) {
            echo htmlspecialchars($_SESSION["Date/Time"]) . "   " . htmlspecialchars($_SESSION["City"]);
        }
        ?>
    </sup>
    <div class="head" style="text-align: center; border: 1px solid white;">
        <h1>Daily Reports</h1>
    </div>
    <div style="text-align: center;">
        <div style="place-items: center;"><img src="prof_sample.jpg"></div>
        <div style="text-align: center;">
            <p>Kathania Thunderfox</p>
            <p>CEO of</p>
            <p>Instagram Company</p>
        </div>
    </div>
    <table border="1">
        <tr style="font-weight: bold; font-size: 30px;">
            <th width="300">Product Name</th>
            <th width="300">Current Stock</th>
            <th width="300">Earnings</th>
            <th width="300">Sold out</th>
        </tr>
        <tr>
            <td style="font-size: 25px; font-family:'Times New Roman', Times, serif;">
                <?php
                include("dataBase.php");
                if (isset($_SESSION['product_name'])) {
                    $products = $_SESSION['product_name'];
                    foreach ($products as $input) {
                        echo "<h6>" . htmlspecialchars($input) . "</h6>";
                    }
                }
                ?>
            </td>
            <td style="font-size: 25px; font-family:'Times New Roman', Times, serif;">
                <?php
                include("dataBase.php");
                $totalCurrentStock = 0;
                if (isset($_SESSION['stock'], $_SESSION['sold']) && count($_SESSION['stock']) == count($_SESSION['sold'])) {
                    foreach ($_SESSION['stock'] as $index => $input) {
                        $stock = (int)$input;
                        $sold = (int)$_SESSION['sold'][$index];
                        $currentStock = $stock - $sold;
                        $totalCurrentStock += $currentStock;
                        echo "<h6>" . htmlspecialchars($currentStock) . "</h6>";
                    }
                    $_SESSION['curStock'] = $totalCurrentStock;
                }
                ?>
            </td>
            <td style="font-size: 25px; font-family:'Times New Roman', Times, serif;">
                <?php
                include("dataBase.php");
                $totalEarnings = 0;
                if (isset($_SESSION['price'], $_SESSION['sold']) && count($_SESSION['price']) == count($_SESSION['sold'])) {
                    foreach ($_SESSION['price'] as $index => $input) {
                        $price = (double)$input;
                        $sold = (double)$_SESSION['sold'][$index];
                        $earnings = $price * $sold;
                        $totalEarnings += $earnings;
                        echo "<h6>" . htmlspecialchars($earnings) . "</h6>";
                    }
                    $_SESSION['earned'] = $totalEarnings;
                }
                ?>
            </td>
            <td style="font-size: 25px; font-family:'Times New Roman', Times, serif;">
                <?php
                include("dataBase.php");
                $totalSold = 0;
                if (isset($_SESSION['sold'])) {
                    foreach ($_SESSION['sold'] as $input) {
                        $totalSold += $input;
                        echo "<h6>" . htmlspecialchars($input) . "</h6>";
                    $_SESSION['slod'] = $totalSold;
                    }
                }
                ?>
            </td>
        </tr>
        <tr style="font-weight: bold; font-size: 30px;">
            <td>Total:</td>
            <td>
                <?php
                echo "<h6>" . htmlspecialchars($_SESSION['curStock'] ?? 0) . "</h6>";
                ?>
            </td>
            <td>
                <?php
                echo "<h6>" . htmlspecialchars($_SESSION['earned'] ?? 0) . "</h6>";
                ?>
            </td>
            <td>
                <?php
                echo "<h6>" . htmlspecialchars($_SESSION['slod'] ?? 0) . "</h6>";
                ?>
            </td>
        </tr>
    </table>
</body>
</html>

<?php
if(isset($_SESSION["username"], $_SESSION["curStock"], $_SESSION["earned"], $_SESSION["slod"], $_SESSION["Date/Time"], $_SESSION["City"])) {
    $KEY = "oihdobvj784734qoryqt7tw9w47tw9w7tw8w9";
    $ch = curl_init('http://localhost/apidatabase/transactions.php'); 
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
        'username' => $_SESSION["username"],
        'Product_Stocks' => $_SESSION["curStock"],
        'Daily_Earnings' => $_SESSION["earned"],
        'Daily_Sold_Out' => $_SESSION["slod"],
        'Date' => $_SESSION["Date/Time"],
        'City' => $_SESSION["City"],
        'API_Key' => $KEY
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);
    $response = curl_exec($ch);

    if ($response === false) {
        echo 'Curl error: ' . curl_error($ch);
    }
    curl_close($ch);
}
?>

<style>
    body table{
        text-align: center;
        margin: auto;
        width: 90%;
        max-width: 1200px;
        border-spacing: 0;
    }
    sup {
        display: inline-block;
    }
    .backB button {
        float: left;
        padding: 0;
        font-size: 50px;
        background-color: white;
        border: none;
        margin-left: -850px;
        margin-top: -30px;
    }
    img {
        height: 80px;
        border: 2px solid;
        border-radius: 50%;
        width: 90px;
        display: inline-block;
    }
    div {
        display: inline-block;
    }
    .head {
        display: block;
        margin-top: 20px;
    }
    table {
        border: none;
        width: 100%;
        margin-top: 20px;
    }
    th, td {
        padding: 15px;
        text-align: center;
        font-size: 20px;
    }
    th {
        background-color: #f1f1f1;
    }
    td {
        background-color: #fff;
        font-size: 18px;
    }
    td h6 {
        margin: 0;
    }
    sup {
        float: right;
    }
</style>
