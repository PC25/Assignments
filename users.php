<?php

    $conn=new mysqli("localhost","ritvik","kundalmapur","project");
    $query="SELECT person FROM users";
    $result=$conn->query($query);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            echo $row['person'].",";
        }
    }

?>