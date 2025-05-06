
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dash Board</title>
    <link rel="icon" type="image/png" href="newLogo.png">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v3.0.6/css/line.css">
</head>
<body>
    <div class="head">
    <?php
            $ch = curl_init("http://127.0.0.1:8000/api/current-time/");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            $response = curl_exec($ch);
            
            if (curl_errno($ch)) {
                echo 'cURL error: ' . curl_error($ch);
                curl_close($ch);
                exit;
            }
            
            curl_close($ch);
            
            $data = json_decode($response);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo "Error Occured";
                exit; 
            }
            
            if (isset($data->current_time) && isset($data->timezone)) {
                $_SESSION["Date/Time"] = htmlspecialchars($data->current_time);
                $_SESSION["City"] =  htmlspecialchars($data->timezone);
                echo "Date/Time:", htmlspecialchars($data->current_time), " ", " ";
                echo "City:", htmlspecialchars($data->timezone);
            } else {
             echo "Request did not Respond.";
            }
        ?>
        <div class="nav_container">
                <a class="nav" href="dashboard.php" title="Homepage"><i class="uil uil-home fa-5x" style="color: blue"></i></i></i></a>
                <a class="nav" href="profile.php"  title="Profile"><i class="uil uil-user-circle fa-5x" style="color: blue"></i></i></a>
                <!--<a class="nav"><i class="uil uil-transaction fa-2x" style="color: blue"></i> </a>-->
                <a class="nav" href="history.php"  title="History"><i class="uil uil-history fa-5x" style="color: blue"></i> </a>
                <a class="nav" href="settings.php"  title="Settings"><i class="uil uil-setting fa-5x" style="color: blue"></i></a>
                <a href="log_in.php" title="logout"><i class="uil uil-signout fa-5x" style="color: blue"></i></a>
            </div>
    </div>     
</body>
</html>

<style>
    body{
        justify-content: center;
        text-align: center;
        color: white;
        margin-top: 0px;
        margin: 0%;
    }
    i{
        font-size: 70px;
    }
    i:hover{
        background-color: aqua;
        border-radius: 50px;
        color: red;
    }
    .nav{
        margin: 0 110px; 
        display: inline-block;
        overflow: hidden;
    }
    .nav_container{
        display: flex; 
        justify-content: center; 
        flex-wrap: wrap;
        float: center;
        padding-top: 20px;
        padding-bottom: 20px;
    }
    .head{
        background-color:black;
        box-shadow: 0 4px 20px rgba(235, 55, 55, 0.5);
        margin-bottom: 20px;
    }
    @media (max-width: 600px) {
        .nav{
            margin: 0 10px;
        }
    }
</style>
