<?php
 
    session_start();
    include("connection.php");
    $result=$conn->query("SELECT person FROM users WHERE id=".$_SESSION['id']);
    $temp=$result->fetch_assoc();
    $currentUser=$temp['person'];       //current user 

    $query="SELECT person,id FROM users";
    $result=$conn->query($query);
    $rows=$result->num_rows;
    if(isset($_POST['logout'])){
        setcookie('sid',null,-1);
        $query="DELETE FROM remember WHERE id=$_SESSION[id]";
        $conn->query($query);
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
    <div class="navbar display-flex" >
        <div class="profile-photo display-flex">
        <input type="file" name="profile-pic">
        </div>
        <span class="name"><p>Hi! <?php echo $currentUser;?></p></span>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <input type="submit" name="logout" value="logout">
        </form>
        <form action="edit.php" method="post">
        <input type="submit" name="submit" value="Edit">
        </form>
             
    </div>
    <form class="users" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="user-list">
        <?php
        echo "<ul>";
        while($current=$result->fetch_assoc())
            if($current['person']!=$currentUser) echo  "<li>$current[person]</li>  <input type='submit' value='chat' name='$current[id]'>";
        echo "</ul>";
        ?>
        </div>
    </form>
    
    <form class="chat display-flex" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name='send'>
    <div class="inputs display-flex">
    <input type="text" placeholder="Type Something" class="message" name="message">
    <input type="submit" placeholder="Send" class="submit" name="send" value=">>>">
    </div>
    <?php include("chat.php");?>
    </form>
</body>
<script src="timeline.js">
</script>
</html>


<?php

 $conn->close();
?>