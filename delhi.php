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






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/htmlcss/CSS/style2.css">
    <style>
        .delhi-img .back {
    background: linear-gradient(rgba(255,255,255),rgba(0,0,0,0.2)),url(http://localhost/htmlcss/images/D2.jpg);
    background-size: cover;
}
    </style>


</head>

<body>
      <!-- header -->
      <div class="header">
        <div class="logo">
            <img src="http://localhost/htmlcss/images/logo.png" alt="cant load the image">
        </div>
        <div class="navbar">
            <nav>
                <ul>
                    <li>
                    <?php if(!isset($_SESSION["user_id"])){?>
                            <div class="signup">
                                <a href="#" class="button" id="sign"><i class="fa-solid fa-user"></i> Signup</a>

                            </div>
                            <?php } else {?>
                                <div class="signup">
                            <a href ="dashboard.php"><i class="fa-solid fa-user"></i> Dashboard</a>
                            </div>
                        
                            <?php
                          }?>
                    
                    </li>
                    <li>
                        <div class="line-ver"></div>
                    </li>
                    <li>
                    <?php if(!isset($_SESSION["user_id"])){?>
                            <div class="login" id="log">
                                <a href="#" class="button"><i class="fa-solid fa-right-to-bracket"></i> Login</a>

                            </div>
                          <?php } else {?>
                            <div class="logout" id="logout">
                            <a href="includes/logout.php"><i class="fa-solid fa-right-to-bracket"></i> Logout</a>
                            </div>
                            <?php
                          }?>
                    </li>
                </ul>
            </nav>
        </div>
        <!-- breadcrumb -->

      
        <nav class="breadnav">
            <ul>
                <li>
                    <a href="http://localhost/htmlcss/index%20(2).php" class="Homebreadcrumb">Home</a>
                </li>
                
                <li>
                    <a href="#" class="activeitem">
                        <?php    echo $city_name;  ?>
                    </a>
                </li>
            </ul>
        </nav>
     

    </div>
    <!-- container -->

    <div class="delhi-img" >
       
        <div class="back">
         
        <div class="page-container">
           
            <div class="filterbar">
                <div class="filter">
                    <img src="http://localhost/htmlcss/images/filter.png" alt="" class="filter-image">
                    <span>Filter</span>
                </div>
                <div class="filter">
                    <img src="http://localhost/htmlcss/images/desc.png" alt="" >
                    <span>Highest Rank First</span>
                </div>
                <div class="filter">
                    <img src="http://localhost/htmlcss/images/asc.png" alt="">
                    <span>Lowest Rank First</span>
                </div>
            </div>
              <!-- cards -->

   
            <?php
        foreach ($properties as $property) {
            $property_images = glob("images/properties/" . $property['id'] . "/*");
        ?>
            <div class="property-card row">
                <div class="image-container">
                <img src="<?= $property_images[0] ?>" />
               <!-- <img src="./images/properties/1/delhibg.jpg" alt=""> -->
                </div>
                <div class="property-content">
                    <div class="rate-intr">
                    <?php
                        $total_rating = ($property['rating_clean'] + $property['rating_food'] + $property['rating_safety']) / 3;
                        $total_rating = round($total_rating, 1);
                        ?>
                        <div class="starcontainer">
                        <?php
                            $rating = $total_rating;
                            for ($i = 0; $i < 5; $i++) {
                                if ($rating >= $i + 0.8) {
                            ?>
                            <i class="fa fa-star"></i>
                            <?php } elseif($rating >= $i + 0.3){
                                ?>
                                 <i class="fa fa-star-half-o"></i> 
                            <?php } else{?>
                                  <i class="fa fa-star-o"></i>
                            <?php } ?>
                            <?php } ?>

                            <!-- <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> -->


                        </div>
                        <div class="interests">
                        <?php
                                     $interested_users_count = 0;
                                     $is_interested = false;
                                foreach ($interested_users_properties as $interested_user_property) {
                                      if ($interested_user_property['property_id'] == $property['id']) {
                                                   $interested_users_count++;

                                               if ($interested_user_property['user_id'] == $user_id) {
                                                   $is_interested = true;
                                                  }
                                         }
                                 }
                                 
                            if ($is_interested) {
                                ?>
                                 <!-- <i class="fas fa-heart"></i> -->
                                 	
                                   <i class="fa fa-heart"></i>
                                 <?php
                            } else {
                            ?>
                             <!-- <i class="far fa-heart"></i> -->
                             <i class="fa fa-heart-o"></i>
                             <?php }?>
                            <!-- <i class="fa fa-heart-o"></i> -->
                          
                            <div class="interested-text"><?php  $interested_users_count ?>interested</div>
                        </div>
                    </div>
                    <div class="property-details">
                        <div class="property-name">
                        <?php echo  $property['name'];?>

                        </div>
                        <div class="property-address">
                        <?php echo $property['address']; ?>
                        </div>
                        <div class="property-gender">
                      
                        
                            <!-- <img src="http://localhost/htmlcss/images/male.png" alt=""> -->
                           
                            <?php 
                                if($property['gender']=="male"){
                             ?>
                        
                            <img src="http://localhost/htmlcss/images/male.png" alt="">
                            <?php } elseif($property['gender']== "female"){
                             ?>
                              <img src="http://localhost/htmlcss/images/female.png" alt="">
                              <?php } else {
                                ?>
                                <img src="http://localhost/htmlcss/images/unisex.png" alt="">
                                <?php }?>

                        </div>
                    </div>
                    <div class="rent">
                        <div class="amount">
                            <b> ₹ <?= number_format($property['rent']) ?>/-</b>
                            per month
                        </div>
                        <div class="viewbtn">
                            <a href="delhi2-detail-list.php?property_id=<?php echo $property['id'];?>">
                                <button type="button">
                                    view
                                </button>
                            </a>
                        </div>

                    </div>
                </div>

            </div>
           <?php }?>

        </div>
    </div>


    <!-- footer -->
    <?php
  include "includes/footer.php"
  ?>

    <!-- filter popup -->

    <div class="filter-popup">
        <div class="filter-content">
            <div class="filter-header">
                <h1>Filters</h1>
                <a href="#" class="filter-close"> <i class="fa fa-times"></i></a>
            </div>
            <hr>
            <div class="filter-center">
                <h5>Gender</h5>
                <hr>
                <div class="filter-buttons">
                    <button class="active-btn"> No filter</button>
                    <button class="btn">
                        <i class="fa fa-venus-mars"></i>
                        unisex
                    </button>
                    <button class="btn">
                        <i class="fa fa-mars"></i>
                        Male
                    </button>
                    <button class="btn">
                        <i class="fa fa-venus"></i>
                        Female
                    </button>

                </div>
                <hr>
                <div class="filter-footer">
                    <button class="ok-button">Okay</button>
                </div>
            </div>
        </div>
    </div>
    <?php include "includes/signupinclude.php";?>
    <?php include "includes/logininclude.php";?>

<script>
    document.querySelector(".filter-image").addEventListener("click",function(){
      document.querySelector(".filter-popup").style.display="flex";
    });
    document.querySelector(".filter-close").addEventListener("click",function(){
      document.querySelector(".filter-popup").style.display="none";
    });
</script>
   
    <script src="https://kit.fontawesome.com/8d472405f0.js" crossorigin="anonymous"></script>
</body>

</html>