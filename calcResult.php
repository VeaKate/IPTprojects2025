<?php
session_start();
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
    <a href="dashboard.php"> <button title="back" style="border: none; font-size: 40px; background-color: 
    white; float: inline-end; margin-top: 0%; margin-right: 0%;">⏩</button></a>
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
                            $email = $_SESSION["username"];
                            $date_time = $_SESSION["Date/Time"];
                            $city = $_SESSION["City"];
                            echo "<h6>" . htmlspecialchars($input) . "</h6>";
                            try{
                            $stmt = $conn->prepare("INSERT INTO `products` (`Email`, `Date/Time`, `City`, `Product Name`)
                            VALUES(?, ?, ?, ?)");
                            $stmt->bind_param("ssss", $email, $date_time, $city, $input);
                            $stmt->execute();
                            $stmt->close();
                        } catch (mysqli_sql_exception $e) {
                        }
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
                        $email = $_SESSION["username"];
                        $date_time = $_SESSION["Date/Time"];
                        $city = $_SESSION["City"];
                        echo "<h6>" . htmlspecialchars($currentStock) . "</h6>";
                       try{
                        $stmt = $conn->prepare("INSERT INTO `stocks` (`Email`, `Date/Time`, `City`, `Stocks`)
                        VALUES(?, ?, ?, ?)");
                        $stmt->bind_param("sssi", $email, $date_time, $city, $currentStock);
                        $stmt->execute();
                        $stmt->close();
                       } catch(mysqli_sql_exception $e) {
                       }
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
                        $email = $_SESSION["username"];
                        $date_time = $_SESSION["Date/Time"];
                        $city = $_SESSION["City"];
                        echo "<h6>" . htmlspecialchars($earnings) . "</h6>";
                        try{
                            $stmt = $conn->prepare("INSERT INTO `earnings` (`Email`, `Date/Time`, `City`, `Earnings`)
                            VALUES(?, ?, ?, ?)");
                            $stmt->bind_param("sssd", $email, $date_time, $city, $earnings);
                            $stmt->execute();
                            $stmt->close();
                           } catch(mysqli_sql_exception $e) {
                           }
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
                        $email = $_SESSION["username"];
                        $date_time = $_SESSION["Date/Time"];
                        $city = $_SESSION["City"];
                        try{
                            $stmt = $conn->prepare("INSERT INTO `sold` (`Email`, `Date/Time`, `City`, `Sold`)
                            VALUES(?, ?, ?, ?)");
                            $stmt->bind_param("sssi", $email, $date_time, $city, $input);
                            $stmt->execute();
                            $stmt->close();
                           } catch(mysqli_sql_exception $e) {
                           }
                    }
                    $_SESSION['slod'] = $totalSold;
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
        <style>
        body table{
            text-align: center;
            margin: auto;
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
        }
        table {
            border: none;
        }
        sup {
            float: right;
        }
    </style>
