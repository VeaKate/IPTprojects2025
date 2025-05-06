<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="icon" type="image/png" href="newLogo.png">
    <link rel="stylesheet" href="style.css">
</head>
<body class="log_in_page">
    <div class="log_in_container">
        <form action="log_in.php" method="post">
            <h2 id="log_in_head">Log in</h2>
            <label>Email or Username</label><br>
            <input type="text" name="username" class="textbox" required><br><br>
            <label>Password</label><br>
            <input type="password" name="password" class="textbox" required><br><br>
            <input type="submit" class="log_in_page_buttons" id="log_in" name="log_in" value="Log in"><br><br>
            <a href="main.php" class="log_in_page_buttons" id="Back">Back</a><br><br>
        </form>
        <?php
include("dataBase.php");
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["log_in"])) {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    $sql = "SELECT `Email Address`, `Password` FROM `users info` WHERE `Email Address` = ? AND `Password` = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $password); 
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            header("location: dashboard.php");
        } else {
            echo "Credentials not found! 😥";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
        </h1>
    </div>
</body>
</html>



<style>
    #Back{
        text-decoration: none;
        background-color: red;
        padding-left: 90px;
        padding-right: 90px;
        color:black;
    }
    #Back:hover{
        font-weight: bold;
        background-color: rgb(218, 9, 9);
    }
</style>
