<?php 

$host="localhost";
$user="root";
$password="";
$db="accountdb"; //name of database

mysql_connect($host,$user,$password);
mysql_select_db($db);

if(isset($_POST['username'])){
    
    $uname=$_POST['username'];
    $password=$_POST['password'];
    
    $sql="select * from loginform where user='".$uname."'AND Pass='".$password."' limit 1";
    
    $result=mysql_query($sql);
    
    if(mysql_num_rows($result)==1){
        echo " You Have Successfully Logged in";//we put the index page stuff here
        exit();
    }
    else{
        echo " You Have Entered Incorrect Password";//we'll connect the forgot password link and stuff
        exit();
    }
        
}
?>

<html>
<head>
  <title> Login Form </title>
  <link rel="stylesheet" a href="style.css">
  <link rel="stylesheet" a href="css\font-awesome.min.css">
</head>
<body>
  <div class="container">
  <img src="login.png"/>
    <form>
      <div class="form-input">
        <input type="text" name="text" placeholder="Enter the User Name"/>  
      </div>
      <div class="form-input">
        <input type="password" name="password" placeholder="password"/>
      </div>
      <input type="submit" type="submit" value="LOGIN" class="btn-login"/>
    </form>
  </div>
  <div class="footer">
   <p> &copy; 2021 Himanshu Sharma and Aary Angre </p> 
 </div>
</body>
</html>