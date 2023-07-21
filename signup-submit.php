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
$email = $_POST['mail'];
$name = $_POST['fullname'];
$phone = $_POST['phone'];

$password = $_POST['pass'];
$college_name = $_POST['college'];
$gender = $_POST['gender'];
$city = $_POST['city'];

$sql="INSERT INTO users (name,email,password,gender,college_name,phone,city) VALUES ('$name','$email','$password','$gender','$college_name','$phone','$city')";

$result=mysqli_query($conn,$sql);

if(!$result)
{
    echo "Error:".mysqli_error($conn);
    exit;
}

$_SESSION['status1']="Account Created Successfully.";
header("location:http://localhost/htmlcss/index%20(2).php");

// echo "Account created successfully :)";

mysqli_close($conn);
?>