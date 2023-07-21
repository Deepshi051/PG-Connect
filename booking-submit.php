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

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['number'];
$college= $_POST['college'];
$pg=$_POST['pg'];
$gender = $_POST['gender'];


$sql="INSERT INTO bookings (name,email,gender,phone,college_name,pgname) VALUES ('$name','$email','$gender','$phone','$college','$pg')";

$result=mysqli_query($conn,$sql);

if($result)
{   
  
   header("location:http://localhost/htmlcss/index%20(2).php");
   
   



    exit;
}



// echo "Account created successfully :)";

mysqli_close($conn);
?>