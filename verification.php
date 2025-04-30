<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify</title>
</head>
<body style="text-align: center;color: white; margin-top: 0px; 
        margin: 0%; float: center; background-color: rgb(0, 128, 107);">
    <form action="verification.php" method="post" style="text-align: center;
        transform:translateY(50%); background-color: black;
        display: inline-block; padding: 30px; border-radius: 15px;">
        <h3>Verification❗</h3>
        We need to verify it's you <br>
        before you can proceed. 
        <h4>Please Enter you password first</h4>
        <input name="password" type="password" style="padding: 10px; font-size: 15px;"><br><br>
        <button name="back" style="margin-right: 50px; padding: 5px; width: 70px;">Back</button>
        <button name="verify" style="padding: 5px; width: 70px;">Verify</button>
        <?php
            $email = $_SESSION["username"] ?? '';
            $password = $_SESSION["password"] ?? ''; 

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['verify'])) {
                if (!isset($_POST["password"]) || $_POST["password"] == '' || $_POST["password"] != $password) {
                    echo "<h4 style='color: red;'>Password is Invalid!</h4>";
                } else {
                    header("Location: calcResult.php");
                    exit(); 
                }
            }

            if (isset($_POST['back'])) {
                header("Location: dashboard.php");
                exit(); 
            }
            ?>
    </form>
</body>
</html>
