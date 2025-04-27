
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Main Interface</title>
    <link rel="icon" type="image/jpg" href="OIP.jpg">
    <link rel="stylesheet" href="style.css">
</head>
<body class="main">
<h1 id="title">Welcome to Daily Sales Inventory</h1>
        <span>
        <form action="main.php"  class="MainContainer"
        align="center" method="post">
        <button class="button1"  id="b1" name="sign">Sign in</button><br><br><br>
        <button class="button1" id="b2" name="create" type="submit">Create Account</button>
        </form>
        </span>
</body>
</html>

<?php
  if(isset($_POST["sign"])) {
    header("location: log_in.php");
  }
  if(isset($_POST["create"])) {
    header("location: sign_up.php");
  }
?>

