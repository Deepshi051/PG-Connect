


       <!-- carousel -->
    <div id="carouselExampleInterval" class="carousel slide" data-ride="carousel">
        <?php $property_images = glob("images/properties/" . $property['property_id'] . "/*");?>
        <div class="carousel-inner">
           
            <?php
            
            foreach($property_images as $index => $property_image){?>
             <div class="carousel-item <?= $index == 0 ? "active" : ""; ?>" data-bs-interval="2000">
                    <img class="d-block w-100" src="<?= $property_image ?>" alt="slide">
                </div> 
             
            
        
            <?php }?>
           
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
    </div>   
    
    