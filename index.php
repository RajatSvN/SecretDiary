<?php
session_start();
if(array_key_exists("logout",$_GET)){
 unset($_SESSION['id']);
  setcookie("id","",time()-60*60);
 $_COOKIE['id']="";
}else if((array_key_exists("id",$_SESSION) AND $_SESSION['id']) OR (array_key_exists("id",$_COOKIE) AND $_COOKIE['id']) ){
  header("Location: Diary.php");
}
$error = "";
include("connection.php");

$query = "";
if(array_key_exists("submit",$_POST)){

if(!$_POST['email'])
  $error .= "<p>E-mail field is empty!</p>";
  
  if(!$_POST['password'])
  $error .= "<p>Password field is empty!</p>";
  
  if($error!=""){
   $error = "There were following error(s) in your form : ".$error; 
  }else{
    if(mysqli_connect_error()){
     
      die("DATABASE CONNECTION ERROR!");
      
    }else{
      $query = "SELECT id FROM UserDiary WHERE email ='".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1";
       $res = mysqli_query($link,$query);
      
      if(mysqli_num_rows($res)>0){
       $error = "The email is already taken!" ;
      }else{
        $query = "INSERT INTO UserDiary (email,password) VALUES ('".mysqli_real_escape_string($link,$_POST['email'])."','".mysqli_real_escape_string($link,$_POST['password'])."')";
        if(!mysqli_query($link,$query)){
          $error = "<p>Could not sign you up.Sorry for the inconvinience! Please try again later.</p>";
        }else{
          $query = "UPDATE UserDiary SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";
          $_SESSION['id'] = mysqli_insert_id($link);
          mysqli_query($link,$query);
          
          
         if(isset($_POST['cbx'])){
         setcookie("id",mysqli_insert_id($link),time()+60*60*24*7);
         }
        header("Location: Diary.php");
        }
      }
      
    }
    
  }
  
}else if(array_key_exists("submit",$_GET)){
  
  if(!$_GET['email2'])
  $error .= "<p>E-mail field is empty!</p>";
  
  if(!$_GET['password2'])
  $error .= "<p>Password field is empty!</p>";

   if($error!=""){
   $error = "There were following error(s) in your form : ".$error; 
  }else{
      if(mysqli_connect_error()){
     
      die("DATABASE CONNECTION ERROR!");
      
    }else{
        $query = "SELECT * FROM UserDiary where email ='".mysqli_real_escape_string($link,$_GET['email2'])."'";
        
        $res = mysqli_query($link,$query);
        $row = mysqli_fetch_array($res);
        if(isset($row)){
          $hashedPassword = md5(md5($row['id']).$_GET['password2']) ;
          if($hashedPassword == $row['password']){
            $_SESSION['id']=$row['id'];
            if(isset($_POST['cbx'])){
         setcookie("id",mysqli_insert_id($link),time()+60*60*24*7);
         }
        header("Location: Diary.php");
          }else{
          
          $error = "The password you just entered is not correct!";
          
          }
          
        
        }else{
        
        $error = "This email does not exsist , Please check or Sign Up!";
          
        }
       
        
      }
     
   }
  
}



?>
<?php include("header.php"); ?>

  <div class="container">
 
      <form method="post" id="myForm">
 <div class="form-group emailDiv">
   <p class="specialFont">Secret Diary</p>
   <p class="smallspecialFont">Store your thoughts permanently and securely.</p>
   <p id="togglepara">Interested? Sign up now!</p>
   <div id="errorDiv" class="alert alert-danger col-sm-4 mx-auto"><?php echo $error;    ?></div>
    <input type="email" name="email" class="form-control col-sm-4 mx-auto initial" id="email" aria-describedby="emailHelp" placeholder="Your email">
  </div>
<div class="form-group" >
 
    <input type="password" name="password" class="form-control col-sm-4 mx-auto initial" id="password" placeholder="Your password">
 </div>
     <div class="form-group">
  
    <input type="email" name="email2" class="form-control col-sm-4 mx-auto hidden" id="email2" aria-describedby="emailHelp" placeholder="Your email">
  </div>
<div class="form-group">
 
    <input type="password" name="password2" class="form-control col-sm-4 mx-auto hidden" id="password2" placeholder="Your password">
 </div>

 <input type="checkbox" name="stayLoggedIn" value=1 name="cbx" ><span>Stay logged in!</span>
 <br>
  <button type="submit" class="btn btn-success" id="butn" name="submit">Sign Up</button>
  <br><br>
  <a  href="#" id="link">LOGIN</a>
</form>
 
</div>
<?php include("footer.php"); ?>
   