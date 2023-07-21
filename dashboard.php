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
if (!isset($_SESSION["user_id"])) {
    header("location: index(2).php");
    exit();
}


$user_id = $_SESSION['user_id'];

$sql_1 = "SELECT * FROM users where id = '$user_id'";

$result_1 = mysqli_query($conn , $sql_1);

if(!$result_1)
{
    echo "something went wrong";
    return;
}

$user = mysqli_fetch_assoc($result_1);
if(!$user)
{
    echo " something went wrong";
    return;
}

$sql_2 = "SELECT * 
            FROM interested_users_properties iup
            INNER JOIN properties p ON iup.property_id = p.id
            WHERE iup.user_id = $user_id";
$result_2 = mysqli_query($conn, $sql_2);
if (!$result_2) {
    echo "Something went wrong!";
    return;
}
$interested_properties = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
?>

<!-------------------------------------------html code----------------------------------------------------- -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="http://localhost/htmlcss/CSS/style4.css">
    <style>
        .header .navbar  ul{
    list-style: none;
    justify-content: end;
    display:flex;
}
.header .navbar nav{
    height: 3rem;
    margin: 5px;
    padding: 16px;
    font-size:16px;
    text-align: center;
   
}
 .user-name{
    font-weight: bold;
   
}

.profile-container{
    position: relative;
    top: 49px;
    justify-content: center;
}
.profile-container .profile-content{
    max-width: 800px;
    padding: 3rem;
    margin: auto;
}
.profile-container .profile-content h1{
    margin-bottom:3rem;
}
.profile-container .profile-content .col-md-3{
    max-width:25%;
}
.profile-container .profile-content .col-md-3 i{
    width: 100px;
    height: 100px;
    font-size: 75px;
    text-align: center;
    line-height: 100px;
    border: 1px solid #e4e4e4;
    border-radius: 50%;
    color:#7d7d7d;
}
.profile-container .profile-content .col-md-9{
    display: flex;
    max-width: 75%;
    justify-content: space-between;
}
.profile-container .profile-content .col-md-9 .user-info .name{
    font-weight:900;
}
.profile-container .profile-content .col-md-9 .edit-profile{
    margin-top:4rem;
}
.profile-container .profile-content .col-md-9 .edit-profile a{
    color:#7d7d7d;
    text-decoration:underline;
}


    </style>


</head>
<body>

<?php
    include "includes/head.php";
    ?>

    <div class="profile-container">
        <div class="profile-content">
            <h1>My profile</h1>
            <div class="row">
                <div class="col-md-3">
                <i class="fa fa-user"></i>
                </div>
                <div class="col-md-9">
                      <div class="user-info">
                          <div class="name"> 
                            <?php
                           echo $user['name'];
                            ?>
                          </div>
                          <div class="email">
                            <?php
                              echo $user['email'];
                            ?>
                          </div>
                          <div class="phone">
                            <?php
                            echo $user['phone'];
                            ?>

                          </div>
                          <div class="college">
                            <?php
                            echo $user['college_name'];
                            ?>
                          </div>

                      </div>
                      <div class="edit-profile">
                           <a href="#">Edit profile</a>
                      </div>
                </div>
            </div>
        </div>
    </div>





    <?php
    if(count($interested_properties) > 0) {
    ?>
    <div class="interested-user-prop">
        <div class="interested-container">
            <h1>My interested properties</h1>
            <?php
                foreach ($interested_properties as $property) {
                    $property_images = glob("images/properties/" . $property['id'] . "/*");
                ?>
                <div class="property-card  property-id-<?php $property['id'] ?> row">
                    <div class="image-container">
                      <img src="<?= $property_images[0] ?>" />
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
                                 <?php
                                        } elseif ($rating >= $i + 0.3) {
                                        ?>
                                       <i class="fa fa-star-half-o"></i>
                                       <?php
                                        } else {
                                        ?>  
                                         <i class="fa fa-star-o"></i>
                                         <?php
                                        }
                                    }
                                    ?>


                               </div>
                               <div class="interests">
                                  <i class="is-interested-image fas fa-heart" property_id="<?= $property['id'] ?>"></i>
                                </div>
                        </div>
                     <div class="property-details">
                           <div class="property-name">
                        <?php  echo $property['name']; ?>
                           </div>
                           <div class="property-address">
                              <?php echo $property['address'];?>

                           </div>
                           <div class="property-gender">
                               <!-- <img src="/http://localhost/htmlcss/images/female.png" alt=""> -->
                               <?php if($property['gender']== "male"){
                                ?>
                                <img src="/http://localhost/htmlcss/images/male.png" alt="">
                              <?php } elseif($property['gender']=="female"){ ?>
                              <img src="/http://localhost/htmlcss/images/female.png" alt="">
                              <?php } else{?>
                                <img src="/http://localhost/htmlcss/images/unisex.png" alt="">
                                <?php }?>

                           </div>
                           <div class="rent">
                                   <div class="amount">
                                     <b><?= number_format($property['rent']) ?>-</b>
                                   per month
                                   </div>
                                   <div class="viewbtn">
                                         <a href="http://localhost/htmlcss/property-detail-list.php?property_id=<?= $property['id'] ?>"> <button type="button" onclick="girlspg()">
                                             view
                                           </button>
                                        </a>
                                  </div>
                            </div>
                      </div>
                </div>
                              </div>
               <?php
                }
               ?>
               </div>
            </div>
        
           
          
    <?php } ?>
   
    <?php
     include "includes/footer.php";
      ?>
     <script src="https://kit.fontawesome.com/8d472405f0.js" crossorigin="anonymous"></script>
</body>
</html>