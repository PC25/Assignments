<?php

    include("connection.php");
    $query="SELECT person FROM users";
    $result=$conn->query($query);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            echo $row['person'].",";
        }
    }

?>