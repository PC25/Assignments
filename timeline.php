<?php
    session_id($_COOKIE['ssid']);
    session_start();
    print_r($_SESSION['username']);

    $conn=new mysqli("localhost","ritvik","kundalmapur","project");
    $query="SELECT person FROM users";
    $result=$conn->query($query);
    
    if(isset($_POST['submit'])){
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_COOKIE['ssid']);
        header("Location:signup.php");
    }


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="timeline.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<body>
    <div class="navbar display-flex">
        <div class="profile-photo display-flex">
        <input type="file" name="profile-pic">
        </div>
        <span class="name"><p>Hi! <?php echo $_SESSION['username']?></p></span>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <input type="submit" name="submit">
        </form>     
    </div>
    <div class="users">
        <?php
        echo "<ul>";
        while($current=$result->fetch_assoc())
            echo  "<li>$current[person]</li>";
        echo "</ul>";
        ?>
    </div>
    
</body>
<script src="timeline.js">
</script>
</html>


<?php

 $conn->close();
?>