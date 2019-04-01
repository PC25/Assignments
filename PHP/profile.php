<?php 

 $file_name=$_SESSION['id']."*";
 if(file_exists("uploads/$file_name")){
     die("1");
 }




?>