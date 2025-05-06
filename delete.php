
<?php
session_start(); 
include("dataBase.php"); 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["yes"])) {
    $email = $_SESSION["username"];
    if (isset($email)) {
        $email = $_SESSION["username"]; 
        $sql = "DELETE FROM `users info` WHERE `Email Address` = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email); 
            if (mysqli_stmt_execute($stmt)) {
                if (mysqli_stmt_affected_rows($stmt) > 0) {
                    header("location: main.php");
                    $email = null;
                }
            } else {
                echo "Error executing query: " . mysqli_error($conn);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    } else {
        echo "{$email} not Found!.";
    }
}

if(isset($_POST["errbutton"])) {
    header("location: settings.php");
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link rel="icon" type="image/png" href="newLogo.png">
</head>
<body>
    <form action="delete.php" method="post" class="notify">
        <h4>Are you sure you want to delete your account?</h4>
        <button class="errbutton" name="yes">Yes</button>
        <button class="errbutton" name="errbutton">No</button>
    </form>
</body>
</html>

<style>
    .notify{
        background-color: gray;
        width: 300px;
        padding: 20px;
        color: white;
        float: center;
        text-align: center;
        margin: auto;
        margin-top: 100px;
        border-radius: 20px;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }
    .errbutton{
        font-size: 15px;
        padding: 10px;
        width: 70px;
        border-radius: 10px;
    }
    .errbutton:hover{
        background-color: red;
        font-weight: bold;
        color: white;
        cursor: pointer;
    }    
</style>
