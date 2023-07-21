<?php

session_start();
$db_hostname = "127.0.0.1";
$db_user = "root";
$db_password = "";
$db_name = "pg";

$conn = mysqli_connect($db_hostname, $db_user, $db_password, $db_name);
if (!$conn) {
    echo "connection failed " . mysqli_connect_error();
    exit();
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$property_id = $_GET["property_id"];

$sql_1 = " SELECT *,p.id AS property_id, p.name AS property_name, c.name AS city_name 
            FROM properties p
            INNER JOIN cities c ON p.city_id =c.id 
            WHERE p.id= $property_id ";


$result_1 = mysqli_query($conn, $sql_1);
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
$result_2 = mysqli_query($conn, $sql_2);
if (!$result_2) {
    echo "something went wrong ";
}
$testinomials = mysqli_fetch_all($result_2, MYSQLI_ASSOC);


$sql_3 = "SELECT * FROM amenities a INNER JOIN property_amenities pa ON a.id = pa.amenity_id where pa.property_id=$property_id";
$result_3 = mysqli_query($conn, $sql_3);
if (!$result_3) {
    echo "something went wrong";
    exit();
}
$amenities = mysqli_fetch_all($result_3, MYSQLI_ASSOC);

$sqli_4 = "SELECT * FROM interested_users_properties where property_id= $property_id";
$result_4 = mysqli_query($conn, $sqli_4);
if (!$result_4) {
    echo "something went wrong";
    exit();
}

$interested_users = mysqli_fetch_all($result_4, MYSQLI_ASSOC);
$interested_users_count = mysqli_num_rows($result_4);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/htmlcss/CSS/style3.css">


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
                        <?php if (!isset($_SESSION["user_id"])) { ?>
                            <div class="signup">
                                <a href="#" class="button" id="sign"><i class="fa-solid fa-user"></i> Signup</a>

                            </div>
                        <?php } else { ?>
                            <div class="signup">
                                <a href="dashboard.php"><i class="fa-solid fa-user"></i> Dashboard</a>
                            </div>

                        <?php
                        } ?>
                    </li>
                    <li>
                        <div class="line-ver"></div>
                    </li>
                    <li>
                        <?php if (!isset($_SESSION["user_id"])) { ?>
                            <div class="login" id="log">
                                <a href="#" class="button"><i class="fa-solid fa-right-to-bracket"></i> Login</a>

                            </div>
                        <?php } else { ?>
                            <div class="logout" id="logout">
                                <a href="includes/logout.php"><i class="fa-solid fa-right-to-bracket"></i> Logout</a>
                            </div>
                        <?php
                        } ?>
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
                    <a href="http://localhost/htmlcss/property_list.php?city=<?php echo $property['city_name']; ?>" class="mumbaibreadcrumb"><?php echo $property['city_name']; ?></a>
                </li>
                <li>
                    <a href="#" class="activeitem"> <?php echo $property['property_name']; ?></a>
                </li>
            </ul>
        </nav>
    </div>
    <?php include "includes/carousel.php"; ?>

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
                    <div class="interested-text"><?= $interested_users_count ?>interested</div>
                </div>
            </div>
            <div class="property-details">
                <div class="property-name">
                    <?php echo $property['property_name']; ?>
                </div>
                <div class="property-address">
                    <?php echo $property['address']; ?>
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

    <!-- ammenities -->
    <div class="property-ammenities">
        <div class="ammenities-container">
            <h1>Ammenities</h1>
            <div class="ammenities-details">
                <div class="d1">
                    <h5>Building</h5>
                    <?php
                    foreach ($amenities as $amenity) {
                        if ($amenity['type'] == "Building") {
                    ?>
                            <div class="item-container">
                                <img src="images/<?php echo $amenity['icon'] ?>.svg" alt="">
                                <span><?php echo $amenity['name']; ?></span>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <div class="d2">
                    <h5>Common Area</h5>
                    <?php
                    foreach ($amenities as $amenity) {
                        if ($amenity['type'] == "Common Area") {
                    ?>
                            <div class="item-container">
                                <img src="images/<?= $amenity['icon']; ?>.svg" alt="">
                                <span> <?php echo $amenity['name']; ?></span>
                            </div>
                    <?php
                        }
                    } ?>
                </div>
                <div class="d3">
                    <h5>Bedroom</h5>
                    <?php
                    foreach ($amenities as $amenity) {

                        if ($amenity['type'] == 'Bedroom') {
                    ?>
                            <div class="item-container">
                                <img src="images/<?= $amenity['icon']; ?>.svg" alt="">
                                <span><?php echo $amenity['name']; ?></span>
                            </div>
                    <?php

                        }
                    } ?>
                </div>
                <div class="d4">
                    <h5>Washroom</h5>
                    <?php
                    foreach ($amenities as $amenity) {
                        if ($amenity['type'] == "Washroom") {

                    ?>
                            <div class="item-container">

                                <img src="images/<?= $amenity['icon'] ?>.svg" alt="">
                                <span><?= $amenity['name']; ?></span>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- about -->
    <div class="about-property">
        <div class="about-content">
            <h1>About the property</h1>
            <div class="about-desc">
                <?php
                echo $property['description'];
                ?>
            </div>
        </div>
    </div>

    <!-- ratings -->
    <div class="property-rating">
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
                            <?php
                            $rating = $property['rating_clean'];
                            for ($i = 0; $i < 5; $i++) {
                                if ($rating >= $i + 0.8) {
                            ?>

                                    <i class="fa-solid fa-star"></i>
                                <?php } elseif ($rating >= $i + 0.3) { ?>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                <?php } else { ?>
                                    <i class="far fa-star"></i>
                            <?php }
                            } ?>

                        </div>
                    </div>
                    <div class="per-rate1">
                        <div class="ico-info">
                            <a href=""><i class="fa-solid fa-utensils"></i></a>
                            <span>Food-Quality</span>
                        </div>
                        <div class="rate-stars">
                            <?php
                            $rating = $property['rating_food'];
                            for ($i = 0; $i < 5; $i++) {
                                if ($rating >= $i + 0.8) {
                            ?>
                                    <i class="fa-solid fa-star"></i>
                                <?php } elseif ($rating >= $i + 0.3) { ?>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                <?php } else {
                                ?>
                                    <i class="fa fa-star-o"></i>
                            <?php }
                            } ?>
                        </div>
                    </div>
                    <div class="per-rate1">
                        <div class="ico-info">
                            <a href=""><i class="fa-solid fa-lock"></i></a>
                            <span>Safety</span>
                        </div>
                        <div class="rate-stars">
                            <?php
                            $rating = $property['rating_safety'];
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
                    </div>
                </div>
                <div class="rate-circle">
                    <div class="circle-container">
                        <?php
                        $total_rating = ($property['rating_clean'] + $property['rating_food'] + $property['rating_safety']) / 3;
                        $total_rating = round($total_rating, 1);
                        ?>
                        <div class="total-ratings">
                            <?php echo $total_rating  ?>
                        </div>
                        <div class="circle-stars">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bookings">
        <div class="book-container">
            <div class="book-content">
                <h1>Book your Pg now! </h1>
                <div class="para">
                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit
                    </p> -->
                </div>
            </div>
            <div class="book-form">
                <form action="http://localhost/htmlcss/booking-submit.php" method="POST">
                    <div class="one">
                        <input type="text" id="name" name="name" placeholder="Name">
                        <input type="text" id="email" name="email" placeholder="Email">
                    </div>

                    <div class="one">
                        <input type="text" id="number" name="number" placeholder="Ph.No">
                        <input type="text" id="college" name="college" placeholder="College Name">
                    </div>
                    <div class="three">
                        <input type="text" id="pg" name="pg" placeholder="PG name">
                    </div>
                    <div class="two">
                        Gender <input type="radio" id="gender1" name="gender" value="male">Male
                        <input type="radio" id="gender2" name="gender" value="female">Female

                    </div>
                    <div class="button">
                        <input type="submit" value="Booh Now" id="btn" name="btn">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- testimonials -->
    <div class="testimonials-main">
        <div class="testimonials-container">
            <h2>What people say</h2>
            <?php
            foreach ($testinomials as $testinomial) {
                $t = glob("images/testimonials/" . $property['property_id']. "/".$testinomial['id']. "/*");
                
            ?>
                <div class="testimonial1">
                    <?php

                    foreach ($t as $index => $t_img) { 
                    
                        ?>
                        <div class="testi-image">
                            <img src="<?= $t_img ?>" alt="not found" width="750" height="750">
                            <!-- <img src="images/man.png" alt="couldn't load :("> -->
                        </div>
                    <?php  } ?>
                    <div class="testi-desc">
                        <?php
                        echo $testinomial['content'];
                        ?>
                        <div class="testi-foot">-
                            <?php echo $testinomial['user_name']; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- footer -->
        <?php include "includes/footer.php"; ?>
        <?php include "includes/signupinclude.php"; ?>
        <?php include "includes/logininclude.php"; ?>
        <script src="/javascript/pg.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://kit.fontawesome.com/8d472405f0.js" crossorigin="anonymous"></script>
</body>

</html>