<?php
    session_start();
    include("connection.php");
    function update($conn,$field,$value){
        //echo "UPDATE users SET $field='$value' WHERE id=$_SESSION[id]";
        $conn->query("UPDATE users SET $field='$value' WHERE id=$_SESSION[id]");
    }
    if(isset($_SERVER['HTTP_REFERER'])){
        $arr=explode("/",$_SERVER['HTTP_REFERER']);
        $referer=end($arr);
    }
    else{
        die("LOGIN FIRST");
    }
    if($referer=="timeline.php" or $referer=="edit.php"){  
        $result=$conn->query("SELECT * FROM users WHERE id=$_SESSION[id]");
        $user=$result->fetch_assoc();
        if(isset($_POST['update'])){
            if($user['pass']==$_POST['password_confirmation']){
                if($_POST['update_person']!="")
                    update($conn,'person',$_POST['update_person']);

                if($_POST['update_email']!="")
                    update($conn,'email',$_POST['update_email']);

                if($_POST['update_pass']!="")
                    update($conn,'pass',$_POST['update_pass']);

                if($_POST['update_dob']!="")
                    update($conn,'dob',$_POST['update_dob']);
            }
            else{
                die("WRONG PASSWORD!!!");
            }
        }
    }
    else{
        die("LOGIN FIRST");
    }
?>
<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <style>
        *{
            font-family:'Montserrat',sans-serif;
        }
    ul{
        list-style-type:square;
    }
    .correction{
        display:flex;
        justify-content:center;
        width:100%;
        border:1px solid black;
    }
    input{
        padding:1%;     
    }
    ul input{
        display:none;   
    }
    li:hover{
        cursor:pointer;
    }
    </style>
</head>
<body>
    <div class="correction">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <ul class="inputs">
        <?php
        if(isset($user)){
            echo "<div><li>NAME : $user[person]</li>  <input type='text' name='update_person' placeholder='Enter Name'></div>";
            echo "<div><li>EMAIL : $user[email]</li>  <input type='text' name='update_email' placeholder='Enter E-mail'></div>";
            echo "<div><li>PASS : ************</li>   <input type='text' name='update_pass' placeholder='Enter Password'></div>";
            echo "<div><li>DOB : $user[dob]</li>     <input type='text' name='update_dob' placeholder='DD-MM-YYYY'></div> ";
        }
        ?>
        </ul>
        <input type="text" name="password_confirmation" placeholder="Type password..">
        <input type="submit" name="update" value="Update">
    </form>
    </div>
</body>
<script src="edit.js">

</script>
</html>