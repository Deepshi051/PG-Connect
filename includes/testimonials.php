
    <!-- testimonials -->
    <div class="testimonials-main">
        <div class="testimonials-container">
            <h2>What people say</h2>
            <?php
             foreach($testinomials as $testinomial){
                $t = glob("images/testimonials/" . $property['property_id']. "/".$testinomial['id']. "/*");
                
            ?>
            <div class="testimonial1">
            <?php

foreach ($t as $index => $t_img) { 

    ?>
                <div class="testi-image">
                <img src="<?= $t_img ?>" alt="not found" width="750" height="750">
                            
                </div>
                <?php  } ?>
                <div class="testi-desc">
                   <?php
                   echo $testinomial['content'];


                   ?>
            
                <div class="testi-foot">-
                    <?php echo $testinomial['user_name'];?> <!-- Ashutosh Gowariker -->
                    </div>
            </div>

            
        </div>
        <?php }?>
    </div>