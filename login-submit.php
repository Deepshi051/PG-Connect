<?php
session_start();

$db_hostname = "127.0.0.1";
$db_user="root";
$db_password="";
$db_name="pg";

$conn = mysqli_connect($db_hostname,$db_user,$db_password,$db_name);

if(!$conn)
{
    echo "connection failed! ".mysqli_connect_error();
    exit;
}


$email=$_POST['fullname'];
$password=$_POST['pass'];

$sql="SELECT * FROM users WHERE email = '$email' AND password = '$password'";
$result = mysqli_query($conn,$sql);

$row_count = mysqli_num_rows($result);

if($row_count==1)
{
    $row = mysqli_fetch_assoc($result);
//    echo"hello ". $row['name'];
$_SESSION['status']=1;
header("location:http://localhost/htmlcss/index%20(2).php");
   $_SESSION['user_id'] = $row['id'];
   $_SESSION['name'] = $row['name'];
   $_SESSION['city']= $row['city'];

   ?>
   <!-- <a href="http://localhost/htmlcss/dashboard.php">Click here</a> -->
   <?php
}
else{
    // echo "create your account plz";
    $_SESSION['status']=0;
    header("location:http://localhost/htmlcss/index%20(2).php");
}


mysqli_close($conn);
?>