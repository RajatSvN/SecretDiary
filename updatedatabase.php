<?php

session_start();

if(array_key_exists("content",$_POST)){

  include("connection.php");
 
  $query = "Update UserDiary set Diary='".mysqli_real_escape_string($link,$_POST['content'])."' where id =".$_SESSION['id'] ;
  
mysqli_query($link,$query);
 

}


?>