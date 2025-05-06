<?php
    include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel="icon" type="image/png" href="newLogo.png">
</head>
<body>
    <form action="settings.php" method="post">
        <div class="butt">
        <button class="reset" id="edit" name="edit">Edit Information</button><br><br><br>
        <button class="reset" id="delete" name="delete">Delete Account</button><br><br><br>
        <button class="reset" id="logout" name="logout">Logout</button><br><br><br>
        </div>
    </form>
    <?php
        if(isset($_POST["edit"])) {
            include("reset.php");
            echo "<style> .butt{display: none} </style>";
        }
        if(isset($_POST["delete"])) {
            include("delete.php");
        }
        if(isset($_POST["logout"])) {
            header("location: main.php");
        }

    ?>
</body>
</html>

<style>
    body{
        background-color: rgb(0, 128, 107);
        background-repeat: no-repeat;
        background-size: cover;
    }
    #logout{
        background-color: rgb(250, 31, 31);
        color: black;
    }
    #logout:hover{
        color: white;
        background-color: rgb(22, 233, 22);
    }
    .butt{
        justify-content: center;
       display: inline-block;
        gap: 20px;
        padding: 50px;
        border-radius: 15px;
        background-color: white
    }
    .reset{
       font-size: 20px;
       padding: 20px;
       border-radius: 15px;
       margin-top: 40px;
       background-color: gray;
       color: white;
       font-weight: bold;
       font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }
    .reset:hover{
        font-weight: bold;
        background-color: white;
        color: black;
    }
    .reset:active{
        font-weight: bold;
        background-color: red;
        color: white;
    }
</style>
