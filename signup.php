<?php


    $sname=$_POST['sname'];
    $spassword=$_POST['spassword'];
    $semail=$_POST['semail'];
    $sdob= $_POST['day']."-".$_POST['month']."-".$_POST['year'];
 
    if($sname and $spassword and $semail and $sdob){


        $conn = new mysqli("localhost","ritvik","kundalmapur","project");
        function createUser($name,$password,$email,$dob,$conn){
            $newQuery = "INSERT INTO users(username,pass,email,dob) VALUES('$name','$password','$email','$dob')";
            if($conn->query($newQuery)){
                return true;
            }
            else{
                return false;
            }
        }
        createUser($sname,$spassword,$semail,$sdob,$conn);

        $conn->close();
    }
    
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="./styles1.css" type="text/css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<body>
    <div class="container display-flex">
    <div class="signup-box display-flex">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="display-flex form">
        <input type="text" placeholder="Name" name="sname" class="sname">
        <span class="sname_error"></span>

        <input type="text" placeholder="Email-Adress" name="semail" class="semail">
        <span class="semail_error"></span>

        <input type="password" placeholder="New Password" name="spassword" class="spassword">
        <span class="spassword_error"></span>

        <input type="password" placeholder="Confirm Password" name="scpassword" class="scpassword">
        <span class="spassword_error"></span>

        <div class="dob">
        <select class='day' name="day">
            <?php
                for($i=1;$i<=31;$i++)
                    echo "<option>".$i."</option>";
            ?>    
        <select>
        <select class="month" name="month">
            <?php
                for($i=1;$i<=12;$i++)
                    echo "<option>".$i."</option>";
            ?>    
        <select>
        <select class="year" name="year">
            <?php
                for($i=1999;$i<=2018;$i++)
                    echo "<option>".$i."</option>";
            ?>    
        <select>
        <span class="dob"></span>

        </div>
        <input type="submit" name="submit" class="submit">
        </form>
    </div>
    <div class="login-box display-flex">
        <form action="timeline.php" method="post" class="display-flex form">
        <input type="text" class="lusername" placeholder="Username" name="lusername">
        <input type="password" class="lpassword" placeholder="Password" name="lpassword">
        <input type="submit" class="submit" name="lsubmit">
        <div class="checkbox display-flex"><input type="checkbox" name="keepMeSignedIn"><span>Keep me signed in</span></div>
        </form>
    </div>
    </div>
</body>
<script src="./signup-js.js"></script>
</html>
