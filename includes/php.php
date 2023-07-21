<?php

session_start();
$db_hostname = "127.0.0.1";
$db_user="root";
$db_password="";
$db_name="pg";

$conn = mysqli_connect($db_hostname,$db_user,$db_password,$db_name);
if(!$conn)
{
    echo "connection failed ". mysqli_connect_error();
    exit();
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$property_id = $_GET["property_id"];

$sql_1 = " SELECT *,p.id AS property_id, p.name AS property_name, c.name AS city_name 
            FROM properties p
            INNER JOIN cities c ON p.city_id =c.id 
            WHERE p.id= $property_id ";


$result_1 = mysqli_query($conn ,$sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}
$property = mysqli_fetch_assoc($result_1);
if (!$property) {
    echo "Something went wrong!";
    return;
}


 $sql_2 = "SELECT * FROM testinomials WHERE property_id = $property_id";
 $result_2 = mysqli_query($conn ,$sql_2);
 if(!$result_2)
 {
    echo "something went wrong ";
 }
 $testinomials = mysqli_fetch_all($result_2 , MYSQLI_ASSOC);


 $sql_3 = "SELECT * FROM amenities a INNER JOIN property_amenities pa ON a.id = pa.amenity_id where pa.property_id=$property_id";
$result_3 = mysqli_query($conn , $sql_3);
if(!$result_3)
{
    echo "something went wrong";
    exit();
}
$amenities = mysqli_fetch_all($result_3 ,MYSQLI_ASSOC);

$sqli_4 = "SELECT * FROM interested_users_properties where property_id= $property_id";
$result_4 = mysqli_query($conn , $sqli_4);
if(!$result_4)
{
    echo "something went wrong";
    exit();
}

$interested_users = mysqli_fetch_all($result_4, MYSQLI_ASSOC);
$interested_users_count = mysqli_num_rows($result_4);
?>

