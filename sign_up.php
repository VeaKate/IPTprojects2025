

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="sign_up_body">
    <div class="form">
        <form action="sign_up.php" method="post">
        <div><label  class="label">First Name:</label> <input type="text" id="fName" class="input" name="fName" required></div><br><br>
        <div><label  class="label">Last Name:</label> <input type="text" id="lName" class="input" name="lName" required></div><br><br>
        <div><label  class="label">Company Name:</label> <input type="text" id="company" class="input" name="company" required></div><br><br>
        <div><label  class="label">Position:</label> 
        <select id="position" class="input" name="position" required>
            <option value="Owner" name="position">Owner</option>
            <option value="CEO"  name="position">CEO</option>
            <option value="Employee"  name="position">Employee</option>
            <option value="Guess"  name="position">Guest</option>
        </select></div><br><br>
        <div><label  class="label">Email Adress:</label> <input required type="text" id="email" class="input" name="email"></div><br><br>
        <div><label  class="label">Gender:</label> 
        <label  id="gender" class="input">Male</label><input type="radio" name="gender" class="input" required value="Male">
        <label class="input">Female</label><input type="radio" name="gender" class="input" required value="Female">
        <label class="input">Custom</label><input name="gender" type="radio" gender required value="Custom"></div class="input"><br><br>
        <div><label  class="label">Birthday:</label> <input required type="date" id="bDay" class="input" name="bDay"></div><br><br>
        <div><label  class="label">Mobile/Telephone:</label> <input required type="text" id="mobile" class="input" name="contact"></div><br><br>
        <div><label  class="label">Password:</label> <input required type="password" id="pass" class="input" name="password" 
        minlength="7" maxlength="12" required></div><br><br>
        <div><label  class="label">Confirm Password:</label> <input required type="password" id="conpass" class="input"
        name="con_password" required minlength="7" maxlength="12"></div><br><br>
    <div class="button">
        <button type="submit" class="buttons" id="Create" name="create_acc" >Create Account</button>
        <a href="main.php" id="back">Back</a>
    </div>
    </p>
    </form>
</div>
</body>
</html>

<?php
    include("dataBase.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_acc"])) {
        $fName = filter_input(INPUT_POST,"fName", FILTER_SANITIZE_SPECIAL_CHARS);
        $lName = filter_input(INPUT_POST,"lName", FILTER_SANITIZE_SPECIAL_CHARS);
        $company = filter_input(INPUT_POST,"company", FILTER_SANITIZE_SPECIAL_CHARS);
        $position = $_POST["position"] ?? '';
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $gender = $_POST["gender"] ?? '';
        $birthday = $_POST["bDay"] ?? ''; 
        $contact = filter_input(INPUT_POST, "contact", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS) ;
        $con_password = filter_input(INPUT_POST,"con_password", FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(strpos($email, "@gmail.com" ) == false) {
            echo "Invalid Email! Please Enter a valid Email!";
        } 
        else if($password !== $con_password) {
            echo "Password did not Match";
        }
        else {
            $sql = "INSERT INTO `users info` (`First Name`, `Last Name`, `Company Name`, `Position`, `Email Address`, `Gender`, `Birthday`, `Mobile/Telephone`, `Password`)
                            VALUES ('$fName', '$lName', '$company', '$position', '$email', '$gender', '$birthday', '$contact', '$password')";
                            $result = mysqli_query($conn, $sql);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            mysqli_close($conn);
            echo "New Account Created Successfully";
            header("location: log_in.php");
        }
    }
?>
<style>
    #back{
        background-color: rgb(158, 247, 24);
        font-size: 30px;
        padding: 20px;
        border-radius: 25px;
        cursor: pointer;
        width: 500px;
        text-decoration: none;
        color: black;
    }
    .sign_up_body{
    justify-content: center;
    text-align: center;
    background-image: url("0_DThread_1741525280834.png");
    }
    #errMessage{
        color: red;
        font-weight: bold;
    }
    #fName{
        margin-left: 70px;
    }
    #lName{
        margin-left: 70px;
    }
    #company{
        margin-left: 18px;
    }
    #position{
        margin-left: 70px;
    }
    #email{
        margin-left: 50px;
    }
    #gender{
        margin-left: 73px;
    }
    #bDay{
        margin-left: 65px;
    }
    #mobile{
        margin-left: 10px;
    }
    #pass{
        margin-left: 99px;
    }
    #conpass{
        margin-left: 6px;
    }
    body{
        background-image: url(background1.webp);
        background-repeat: no-repeat;
        background-size: cover;
        text-align: center;
        color: white;
    }
    .input{
        border-radius: 5px;
        font-size: 25px;
    }
    .label{
        font-size: 25px;
    }
    .form{
        margin-top: 50px;
    }
    .button{
        font-size: 50px;
    }
    .buttons{
        font-size: 30px;
        padding: 20px;
        border-radius: 25px;
        cursor: pointer;
    }
    #Create:hover{
        background-color: rgb(73, 236, 73);
        font-weight: bold;
        color: white;
    }
    .input{
        padding: 10px; 
        border-radius: 15px;
    }
</style>