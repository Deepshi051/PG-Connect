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
                        <img src="images/<?php echo $amenity['icon']?>.svg" alt="">
                        <span><?php echo $amenity['name'];?></span>
                    </div>
                    <?php
                        }
                    }
                        ?>
                    <!-- <div class="item-container">
                        <img src="/images/.svg" alt="">
                        <span></span>

                    </div> -->


                </div>
                <div class="d2">
                    <h5>Common Area</h5>
                    <?php
                    foreach ($amenities as $amenity) {
                        if ($amenity['type'] == "Common Area") {
                    ?>
                    <div class="item-container">
                        <img src="images/<?= $amenity['icon'];?>.svg" alt="">
                        <span> <?php echo $amenity['name'];?></span>
                    </div>
                    <?php
                        }
                    }?>
        


                </div>
                <div class="d3">
                    <h5>Bedroom</h5>
<?php 
foreach($amenities as $amenity){

if($amenity['type']== 'Bedroom'){


?>
                    <div class="item-container">
                        <img src="images/<?= $amenity['icon'];?>.svg" alt="">
                        <span><?php echo $amenity['name'];?></span>
                    </div>
                 
                    <?php

}
}?>

                </div>
                <div class="d4">
                    <h5>Washroom</h5>
                    <?php
                    foreach($amenities as $amenity)
                    {
                        if($amenity['type']=="Washroom"){
                    
                    ?>

                    <div class="item-container">

                        <img src="images/<?= $amenity['icon']?>.svg" alt="">
                        <span><?= $amenity['name']; ?></span>
                    </div>

<?php }
                    }?>
                </div>
            </div>
        </div>
    </div>

