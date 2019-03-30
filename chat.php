<?php
    include("connection.php");

    for($i=1;$i<=$rows;$i++){
        $name="".$i;
        if(isset($_POST[$name]))
            $_SESSION['receiver']=$name;
    }
    if(isset($_POST['message']) AND isset($_SESSION['receiver'])){
        $_POST['message']=htmlspecialchars($_POST['message']);
        $msgQuery="INSERT INTO chat(sender,receiver,string) VALUES($_SESSION[id],$_SESSION[receiver],'$_POST[message]')";
        $conn->query($msgQuery);
    }
    
    echo "<div class='msgs display-flex'>";
    if(isset($_SESSION['receiver'])){
    $msgs=$conn->query("SELECT sender,string FROM chat WHERE (sender=$_SESSION[receiver] AND receiver=$_SESSION[id]) OR (receiver=$_SESSION[receiver] AND sender=$_SESSION[id]) ORDER BY time"); 
    if($msgs->num_rows>0){
        while($msg=$msgs->fetch_assoc()){
            if($msg['sender']==$_SESSION['id'])
                echo "<p class='right'>$msg[string]</p>";
            else
                echo "<p class='left'>$msg[string]</p>";
        }
     }
     unset($_POST['message']);
     }
    echo "</div>";




?>