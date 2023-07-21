<?php

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

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

if(!$result)
{
   echo "Error:". mysqli_error($conn);
   exit;
}

while($row = mysqli_fetch_assoc($result))
{
    echo $row['name'] . "<br/>";
}

mysqli_close($conn);



?>