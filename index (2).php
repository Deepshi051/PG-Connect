<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="http://localhost/htmlcss/CSS/style.css">


</head>

<body>

    <div class="main">
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
        </div>

        <div class="bgimg">
            <div class="bg-content">

                <div class="heading">
                    <p>Happiness per Square Foot</p>
                </div>
                <form id="form" action="" method="GET">
                    <div class="search_wrap">
                        <div class="searchbox">
                            <input type="text" id="city" name="city" placeholder="Enter your city to search for PGs">
                            <div class="form-btn">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="cities">
        <h2 class="city_heading">Major Cities</h2>
        <div class="city_card">
            <div class="rounded-card " style="width:10rem">
                <a href="http://localhost/htmlcss/delhi.php?city=delhi">
                    <div class="delhi-card ">
                        <img src="http://localhost/htmlcss/images/delhi.png" alt="couldn't load :(" class="card-img">
                    </div>
                </a>
            </div>
            <div class="rounded-card" style="width:10rem ;">
                <a href="http://localhost/htmlcss/property_list.php?city=mumbai">
                    <div class="delhi-card ">
                        <img src="http://localhost/htmlcss/images/mumbai.png" alt="couldn't load :(" class="card-img">
                    </div>
                </a>
            </div>
            <div class="rounded-card" style="width:10rem ;">
                <a href="http://localhost/htmlcss/bengluru.php?city=Bengaluru">
                    <div class="delhi-card ">
                        <img src="http://localhost/htmlcss/images/bangalore.png" alt="couldn't load :(" class="card-img">
                    </div>
                </a>
            </div>
            <div class="rounded-card" style="width:10rem ;">
                <a href="http://localhost/htmlcss/hyderabad.php?city=Hyderabad">
                    <div class="delhi-card ">
                        <img src="http://localhost/htmlcss/images/hyderabad.png" alt="couldn't load :(" class="card-img">
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php include "includes/footer.php"; ?>

    <!-- login form -->
    <div class="log-popup">
        <div class="popup-content">
            <form action="http://localhost/htmlcss/login-submit.php" method="post" onsubmit="return validation()">
                <h1>Login </h1>
                <a href="#" class="log-close">
                    <i class="fa fa-times"></i>
                </a>
                <div class="box">
                    <i class="fa fa-user"></i>
                    <input type="text" name="fullname" id="e1" placeholder="email">
                    <span id="emailerror" style="color:red;    font-size: 12px;"></span>
                </div>
                <div class="box">
                    <i class="fa fa-key"></i>
                    <input type="password" name="pass" id="pass1" placeholder="password">
                    <span id="passerror" style="color:red;    font-size: 12px;"></span>
                </div>
                <div class="log-btn">
                    <button class="button">LogIn</button>
                </div>
                <hr>
                <div class="no-account">
                    Don't have an account?<a href="#" class="no-acc">Signup</a>
                </div>
                <div class="formerr">
                    <span id="formerror" style="color:red;font-size: 12px;"></span>
                </div>
            </form>
        </div>
    </div>

    <!-- signup-form -->
    <div class="sign-popup">
        <div class="popup-content">
            <form action="http://localhost/htmlcss/signup-submit.php" method="post">
                <h1>Signup </h1>
                <a href="#" class="signup-close">
                    <i class="fa fa-times"></i>
                </a>

                <div class="box">
                    <i class="fa fa-user"></i>
                    <input type="text" name="fullname" id="n1" placeholder="Full Name">
                </div>
                <div class="box">
                    <i class="fa fa-phone"></i>
                    <input type="text" name="phone" id="ph1" placeholder="phone number">
                </div>
                <div class="box">
                    <i class="fa fa-envelope"></i>
                    <input type="email" name="mail" id="mail" placeholder="email">
                </div>
                <div class="box">
                    <i class="fa fa-key"></i>
                    <input type="password" name="pass" id="p1" placeholder="password">
                </div>
                <div class="box">

                    <i class="fa fa-graduation-cap"></i>
                    <input type="text" name="college" placeholder="college name">
                </div>
                <div class="box">

                    <i class="fa fa-graduation-cap"></i>
                    <input type="text" name="city" id="college-city" placeholder="city">
                </div>

                <div class="check">

                    I'm a<input type="radio" name="gender" value="male">Male
                    <input type="radio" name="gender" value="female">Female

                </div>

                <button class="button">Create Account</button>
                <hr>
                <div class="account">
                    already have an account?<a href="#" class="have-acc">LogIn</a>
                </div>
            </form>
        </div>
    </div>



    <script>
        <?php if (!isset($_SESSION["user_id"])) { ?>
            document.getElementById("log").addEventListener("click", function() {
                document.querySelector(".log-popup").style.display = "flex";
                document.querySelector(".sign-popup").style.display = "none";
            })


            document.querySelector(".log-close").addEventListener("click", function() {
                document.querySelector(".log-popup").style.display = "none";
            })
            document.querySelector(".no-acc").addEventListener("click", function() {
                document.querySelector(".log-popup").style.display = "none";
                document.querySelector(".sign-popup").style.display = "flex";
            });

            function validation() {
                var user = document.getElementById("e1").value;
                var pass = document.getElementById("pass1").value;

                if (user == "" && pass == "") {
                    document.getElementById("emailerror").innerHTML = "*feild is empty";
                    document.getElementById("passerror").innerHTML = "*feild is empty";

                    return false;
                } else {
                    if (user == "") {
                        document.getElementById("emailerror").innerHTML = "*enter the email please";
                        return false;
                    } else if (pass == "") {
                        document.getElementById("passerror").innerHTML = "*enter the password  please";
                        return false;
                    }
                }
            }
            document.getElementById("sign").addEventListener("click", function() {
                document.querySelector(".sign-popup").style.display = "flex";
                document.querySelector(".log-popup").style.display = "none"; 
            })

            document.querySelector(".signup-close").addEventListener("click", function() {
                document.querySelector(".sign-popup").style.display = "none";
            })

            document.querySelector(".have-acc").addEventListener("click", function() {
                document.querySelector(".log-popup").style.display = "flex";
                document.querySelector(".sign-popup").style.display = "none";
            });

        <?php } ?>



        //forms

        document.querySelector(".form-btn").addEventListener("click", function() {
            var c = document.querySelector("#city");

            if (c.value == "mumbai" || c.value == "Mumbai") {
                document.getElementById('form').action = 'http://localhost/htmlcss/property_list.php?city=mumbai';

            } else if (c.value == "delhi" || c.value == "Delhi") {
                document.getElementById('form').action = 'http://localhost/htmlcss/delhi.php?city=delhi';

            } else if (c.value == "Bengaluru" || c.value == "bengaluru") {
                document.getElementById('form').action = 'bengluru.php';

            } else if (c.value == "Hyderabad" || c.value == "hyderabad") {
                document.getElementById('form').action = 'hyderabad.php';

            } else {
                alert("sorry no pg listed in this!");
            }

        });
    </script>
    

    <?php
    if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
        if ($_SESSION['status'] == 1) { ?>
            <script>
                swal({
                    title: "login sucess",
                    icon: "success",
                });
            </script>
        <?php
        }
        if ($_SESSION['status'] == 0) {
        ?>
            <script>
                swal({
                    title: "login unsucess",
                    icon: "error",
                });
            </script><?php }
                    unset($_SESSION['status']);
                } ?>


    <?php

    ?>
    <script>
        window.addEventListener("scroll", function() {
            var navbar = querySelector(".header");
            navbar.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>

<script src="https://kit.fontawesome.com/8d472405f0.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>