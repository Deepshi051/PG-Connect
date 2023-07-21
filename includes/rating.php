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
                            <?php } elseif($rating>= $i+0.3){ ?>
                                <i class="fa-solid fa-star-half-stroke"></i>
                                <?php } else { ?>
                                    <i class="far fa-star"></i>
                                    <?php }
                            }?>
                    
                         
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
                            <?php } elseif($rating >= $i + 0.3){ ?>
                                <i class="fa-solid fa-star-half-stroke"></i>
                                <?php } else {
                                    ?>
                                     <i class="fa fa-star-o"></i>
                                     <?php }
                            }?>

                         

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
                            <!-- 4.2 -->
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
