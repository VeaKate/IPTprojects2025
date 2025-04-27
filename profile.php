<?php
    include("header.php");
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>profile.com</title>
    </head>
    <body>
        <h1>Profile</h1>
        <div class="content">
        <img src="prof_sample.jpg" id="prof.pic" align="center" style="max-height: 200px;
        width: 200px; ">
        <form action="profile.php" method="post">
        <pre>Name: Dasha Taran</pre>
        <pre>Age: 24</pre>
        <pre>Status: Single</pre>
        <pre>Company: Telegram</pre>
        <pre>Position: CEO</pre>
        <pre>Email: example34@gmail.com</pre>
        <pre>Gender: Female</pre><br><br>
        <pre>Upload Photo: <input type="file" id="upload" name="prof"></pre><br>
        <button id="but" type="submit" >Change Profile</button>
        </form>
        </div>
    <script src="prof.js"></script>
    </body>
    </html>

<style>
    body{
    background-color: rgb(0, 128, 107);
    justify-content: center;
    text-align: center;
    }
    .content{
    border: solid 2px black;
    width: 50%;
    display: inline-block;
    background-color: black;
    height: 800px;
    padding: 30px;
    border-radius: 25px;
    text-align: center;
    justify-content: center;
    place-items: center;
    overflow: hidden;
    font-size: 20px;
    }
    pre{
    color: whitesmoke
    }
    #but{
    font-size: 15px;
    padding: 10px;
    height: 40px;
    border-radius: 5px;
    font-weight: bold;
    background-color: rgb(194, 252, 108);
    }
    #but:hover{
    background-color: rgb(245, 3, 3);
    color: white;
    font-weight: bold;
    cursor: pointer;
    }
</style>