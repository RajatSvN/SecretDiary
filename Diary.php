<?php

session_start();
$diaryVal="";
if(array_key_exists("id",$_COOKIE)){
  $_SESSION['id']=$_COOKIE['id'];
}

if(array_key_exists("id",$_SESSION)){
 //echo "<p>LOGGED In!<br></p>" ;
  include("connection.php");
  $query = "SELECT * FROM UserDiary WHERE id =".$_SESSION['id'];
  $row = mysqli_fetch_array(mysqli_query($link,$query));
  $diaryVal = $row[3];
}else{
 header("Location : index.php"); 
}

include("header.php");
?>
<nav class="navbar navbar-light bg-light navbar-fixed-top">
  <a class="navbar-brand" >SECRET DIARY</a>
 
    <div class="my-2 my-lg-0">
   
     <a href='index.php?logout=1'> <button class="btn btn-outline-success  pull-xs-right" type="submit">Log out</button></a>
    
  </div>
 
</nav>
<div class="conainer" id="DiaryContainer"> 
  
  <textarea id="userInput" class="form-control mx-auto" style="margin-top : 80px ;"><?php echo $diaryVal; ?></textarea>
  
  
  </div>


<?php
include("footer.php");


?>