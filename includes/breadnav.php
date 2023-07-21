<nav class="breadnav">
            <ul>
                <li>
                    <a href="http://localhost/htmlcss/index%20(2).php" class="Homebreadcrumb">Home</a>
                </li>
                <li>
                    <a href="http://localhost/htmlcss/property_list.php?city=<?php echo $property['city_name'];?>" class="mumbaibreadcrumb"><?php echo $property['city_name'];?></a>
                </li>
                <li>
                    <a href="#" class="activeitem"> <?php echo $property['property_name']; ?></a>
                </li>
            </ul>
        </nav>