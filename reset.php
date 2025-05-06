
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reset</title>
    <link rel="icon" type="image/png" href="newLogo.png">
</head>
<body>
    <form action="reset.php" method="post" id="pop-up">
       <label>First Name:</label><br>
       <input type="text" class="intp" name="fName"><br><br>
       <br><label>Last Name:</label><br>
       <input type="text" class="intp" name="lName"><br><br>
       <br><label>Company Name:</label><br>
       <input type="text" class="intp" name="company"><br><br>
       <label>Position:</label><br>
      <select class="intp" name="position">
        <option name="position" value="Owner">Owner</option>
        <option name="position" value="CEO">CEO</option>
        <option name="position" value="Employee">Employee</option>
        <option name="position" value="Guest">Guest</option>
      </select><br><br>
      <label>Gender:</label><br>
      <label>Male</label><input type="radio" name="gender" value="Male"> 
      <label>Female</label><input type="radio" name="gender" value="Female">
      <label>Custom</label><input type="radio" name="gender" value="Custom"><br><br>
      <br><label>Birthday:</label><br>
      <input type="date" class="intp" name="bDay"><br><br>
      <label>Mobile/Telephone:</label><br>
      <input type="text" class="intp" name="contact"><br><br>
      <button id="close" class="intp" name="submit">Submit</button>
      <button id="close" class="intp" name="close">Close</button>
      <h5>
        <?php
            session_start();

            include("dataBase.php"); 
            
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
                $email_reset = $_SESSION["username"];
                $fName = filter_input(INPUT_POST,"fName", FILTER_SANITIZE_SPECIAL_CHARS);
                $lName = filter_input(INPUT_POST,"lName", FILTER_SANITIZE_SPECIAL_CHARS);
                $company = filter_input(INPUT_POST,"company", FILTER_SANITIZE_SPECIAL_CHARS);
                $position = $_POST["position"] ?? '';
                $gender = $_POST["gender"] ?? '';
                $birthday = $_POST["bDay"] ?? ''; 
                $contact = $_POST["contact"] ?? '';
            
                $sql = "UPDATE `users info` SET `First Name` = ?, `Last Name` = ?, 
                    `Company Name` = ?, `Position` = ?, `Gender` = ?, `Birthday` = ?, `Mobile/Telephone` = ? WHERE `Email Address` = ?";
                
                if ($stmt = mysqli_prepare($conn, $sql)) {
                    mysqli_stmt_bind_param($stmt, "sssssiss", $fName, $lName, $company, $position,
                    $gender, $birthday, $contact, $email_reset);
                    
                    if (mysqli_stmt_execute($stmt)) {
                        if (mysqli_stmt_affected_rows($stmt) > 0) {
                           header("location: dashboard.php");
                        } 
                    } else {
                        echo "Error executing query: " . mysqli_error($conn);
                    }
                    
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Error preparing statement: " . mysqli_error($conn);
                }
            }
            if(isset($_POST["close"])) {
                header("location: settings.php");
            }
            mysqli_close($conn);
        ?>
    </h5>
    </form>
</body>
</html>

<style>
    #pop-up{
        background-color: gray;
        width: 300px;
        padding: 20px;
        float: center;
        margin: auto;
        margin-top: 15px;
        border-radius: 20px;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    }
    .intp{
        font-size: 20px;
        padding: 5px;
        font-family: 'Courier New', Courier, monospace;
        border-radius: 10px;
    }
</style>
