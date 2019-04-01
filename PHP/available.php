<?php
    
    include("connection.php");
    $newquery="SELECT username FROM users";
    $result=$conn->query($newquery);
    if($result->num_rows>0){
        while($current=$result->fetch_assoc()){
            echo $current['username'].",";
        }
    }
    $conn->close()
?>
