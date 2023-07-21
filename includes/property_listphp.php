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

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$city_name = $_GET["city"];

$sql = "SELECT * FROM cities where name = '$city_name'";
$result = mysqli_query($conn , $sql);
if(!$result)
{
    echo "something went wrong";
    exit();
}
$city = mysqli_fetch_assoc($result);
if(!$city)
{
    echo "Sorry! We do not have any PG listed in this city.";
    exit();
}

$city_id= $city['id'];

$sql2 = "SELECT * FROM properties where city_id= $city_id";
$result2 = mysqli_query($conn, $sql2);
if(!$result2)
{
    echo "something went wrong";
    exit();
}
$properties = mysqli_fetch_all($result2,MYSQLI_ASSOC);//error

$sql3 = "SELECT * FROM interested_users_properties iup
           INNER JOIN properties p ON iup.property_id = p.id
           WHERE p.city_id = $city_id";
$result3 = mysqli_query($conn , $sql3);
if(!$result3)
{
    echo "something went wrong ";
    exit();
}
$interested_users_properties = mysqli_fetch_all($result3,MYSQLI_ASSOC);//error



?>