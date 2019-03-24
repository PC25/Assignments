<?php
     session_start();
     include("connection.php");
     if(isset($_COOKIE['sid'])){
        $Query="SELECT id FROM remember WHERE string='$_COOKIE[sid]'";
        print_r($_COOKIE);
        $result=$conn->query($Query);
        if($result->num_rows>0){
            print_r($result);
            $row=$result->fetch_assoc();
            $_SESSION['id']=$row['id']; 
            echo $_SESSION['id'];
            header("Location: timeline.php");  
        } 
        
    }
    
    

    function createUser($username,$name,$password,$email,$dob,$gender,$conn){
        $newQuery = "INSERT INTO users(username,person,pass,email,dob,gender) VALUES('$username','$name','$password','$email','$dob','$gender')";
        $conn->query($newQuery);
      }
    
      $signup_error_msg="";
      $login_error="";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(isset($_POST['submit'])){
            $susername=htmlspecialchars($_POST['susername']);
            $sname=htmlspecialchars($_POST['sname']);
            $spassword=htmlspecialchars($_POST['spassword']);
            $semail=htmlspecialchars($_POST['semail']);
            $gender=htmlspecialchars($_POST['gender']);
            $sdob= htmlspecialchars($_POST['day'])."-".htmlspecialchars($_POST['month'])."-".htmlspecialchars($_POST['year']);
            
                $request="SELECT * FROM users WHERE username='$susername' OR email='$semail'";
                $result=$conn->query($request);
                echo $conn->error;
                if($result->num_rows==0)
                    createUser($susername,$sname,$spassword,$semail,$sdob,$gender,$conn);
                else
                    $error_msg="email already exists";
        }
        if(isset($_POST['lsubmit'])){
            $lusername=$_POST['lusername'];
            $lpass=$_POST['lpassword'];
            if(!empty($lusername) and !empty($lpass)){
                $request="SELECT pass,id FROM users WHERE username='$lusername'";
                $result=$conn->query($request);
                if($result->num_rows>0){
                    $current=$result->fetch_assoc();
                    if($lpass==$current['pass']){
                        $_SESSION['id']=$current['id'];
                        $id=session_id();
                        if(isset($_POST['keepMeSignedIn'])){
                            setcookie("sid",$id,time()+86400*30);
                            $newQuery="INSERT INTO remember VALUES($current[id],'$id')";
                            echo $newQuery;
                            $conn->query($newQuery);
                        }
                        else{
                            if(isset($_COOKIE['sid'])){
                            $newQuery="SELECT id FROM remember WHERE string=$id";
                            $people=$conn->query($newQuery);
                            if($people->num_rows>0){
                                $conn->query("DELETE FROM remember WHERE id=$_COOKIE[sid]");
                                unset($_COOKIE['sid']);
                            }
                        }
                        }
                        header("Location: timeline.php");
                    }
                }
                else{
                    $login_error="You need to register";
                }
            }
        }
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
        <input type="text" placeholder="Username" name="susername" class="susername">
        <span class="sname_error"></span>

        <input type="text" placeholder="Name" name="sname" class="sname">
        <span class="sname_error"></span>

        <input type="text" placeholder="Email-Adress" name="semail" class="semail">
        <span class="semail_error"><?php echo $signup_error_msg;?></span>

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
        <select name='gender'>
            <option>MALE</option>
            <option>FEMALE</option>
        </select>
        <input type="submit" name="submit" class="submit">
        </form>
    </div>
    <div class="login-box display-flex">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="display-flex form">
        <span><?php echo $login_error?></span>
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
