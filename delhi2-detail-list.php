<?php

include "includes/php.php";

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/htmlcss/CSS/style3.css">



    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"
/>



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

        <!-- <div class="breadnav"> -->
        <nav class="breadnav">
            <ul>
                <li>
                    <a href="http://localhost/htmlcss/index%20(2).php" class="Homebreadcrumb">Home</a>
                </li>
                <li>
                    <a href="http://localhost/htmlcss/delhi.php?city=<?= $property['city_name'];?>" class="delhibreadcrumb"><?php echo $property['city_name'];?></a>
                </li>
                <li>
                    <a href="#" class="activeitem"><?php echo $property['property_name']; ?></a>
                </li>
            </ul>
        </nav>
        <!-- </div> -->

    </div>
<?php include ("includes/carousel.php");?>
    <!-- carousel -->
    <!-- <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="3000">
                <img src="./images/properties/1/delhibg.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="4000">
                <img src="./images/properties/1/delhibg1.jpg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item" data-bs-interval="3000">
                <img src="./images/properties/1/delhibg2.jpg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> -->

    <div class="info-container">
        <div class="property-content">
        <?php
            $total_rating = ($property['rating_clean'] + $property['rating_food'] + $property['rating_safety']) / 3;
            $total_rating = round($total_rating, 1);
            ?>
            <div class="rate-intr">
                <div class="starcontainer">
                <?php
                $rating = $total_rating;
                for ($i = 0; $i < 5; $i++) {
                    if ($rating >= $i + 0.8) {
                ?>
                        <i class="fas fa-star"></i>
                    <?php
                    } elseif ($rating >= $i + 0.3) {
                    ?>
                        <i class="fas fa-star-half-alt"></i>
                    <?php
                    } else {
                    ?>
                        <i class="far fa-star"></i>
                <?php
                    }
                }
                ?>

                </div>
                <div class="interests">
                <?php
                $is_interested = false;
                foreach ($interested_users as $interested_user) {
                    if ($interested_user['user_id'] == $user_id) {
                        $is_interested = true;
                    }
                }

                if ($is_interested) {
                ?>
                    <i class="is-interested-image fas fa-heart"></i>
                <?php
                } else {
                ?>
                    <i class="is-interested-image far fa-heart"></i>
                <?php
                }
                ?>
                    <!-- <i class="fa fa-heart-o"></i> -->
                    <div class="interested-text"><?= $interested_users_count ?> interested</div>
                </div>
            </div>
            <div class="property-details">
                <div class="property-name">
                  <?php
                echo  $property['property_name'];
                  ?>
                </div>
                <div class="property-address">
                    <?php echo $property['address'];?>
                    <!-- H.No. 3958 Kaseru Walan, Pahar Ganj, New Delhi, Delhi 110055 -->
                </div>
                <div class="property-gender">
                <?php
                if ($property['gender'] == "male") {
                ?>
                    <img src="http://localhost/htmlcss/images/male.png" alt="">
                <?php
                } elseif ($property['gender'] == "female") {
                ?>
                   <img src="http://localhost/htmlcss/images/female.png" alt="">
                <?php
                } else {
                ?>
                  <img src="http://localhost/htmlcss/images/unisex.png" alt="">
                <?php
                }
                ?>
                </div>
            </div>
            <div class="rent">
                <div class="amount">
                    <b>₹ <?= number_format($property['rent']) ?>/-</b>
                    per month
                </div>
                <div class="viewbtn">
                    <button type="button">
                        Book Now
                    </button>
                </div>

            </div>
        </div>
    </div>


<!-- amenities -->
<?php include "includes/amenity.php";
?>


    <!-- about -->
    <div class="about-property">
        <div class="about-content">
            <h1>About the property</h1>
            <div class="about-desc">
               <?php echo $property['description'];?>
            </div>
        </div>
    </div>
<!-- 
    ratings 4.3, 3.4, 4.8) -->

<?php include "includes/rating.php";?>


    <!-- <div class="property-rating">
        <div class="rating-container">
            <h2>Property Rating</h2>
            <div class="lead-rate">
                <div class="per-rating">
                    <div class="per-rate1">
                        <div class="ico-info">
                            <a href=""><i class="fa-solid fa-broom"></i></a>
                            <span>Cleanliness</span>
                        </div>
                        <div class="rate-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                            <i class="fa fa-star-o"></i>
                        </div>

                    </div>
                    <div class="per-rate1">
                        <div class="ico-info">
                            <a href=""><i class="fa-solid fa-utensils"></i></a>
                            <span>Food-Quality</span>
                        </div>
                        <div class="rate-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>

                        </div>
                    </div>
                    <div class="per-rate1">
                        <div class="ico-info">
                            <a href=""><i class="fa-solid fa-lock"></i></a>
                            <span>Safety</span>
                        </div>
                        <div class="rate-stars">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                    </div>
                </div>
                <div class="rate-circle">
                    <div class="circle-container">
                        <div class="total-ratings">
                            4.2
                        </div>
                        <div class="circle-stars">
                            <a href=""> <i class="fa-solid fa-star"></i></a>
                            <a href=""> <i class="fa-solid fa-star"></i></a>
                            <a href=""> <i class="fa-solid fa-star"></i></a>
                            <a href=""> <i class="fa-solid fa-star"></i></a>
                            <a href=""><i class="fa-solid fa-star-half-stroke"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- booking -->
    <?php include "includes/booking.php"?>

    <!-- testimonials -->
<?php include "includes/testimonials.php";?>

    <?php include "includes/footer.php";?>
    <?php include "includes/signupinclude.php";?>
    <?php include "includes/logininclude.php";?>
<script src="/javascript/pg.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/8d472405f0.js" crossorigin="anonymous"></script>

    
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
</body>

</html>