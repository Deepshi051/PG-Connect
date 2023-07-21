<div class="header">
            <div class="logo">
                <img src="http://localhost/htmlcss/images/logo.png" alt="cant load the image">
            </div>
            <div class="navbar">
                <nav>
                    <ul>
                    <?php
                             //Check if user is loging or not
                            if (!isset($_SESSION["user_id"])) {
                     ?>
                        <li>
                            <div class="signup">
                                <a href="#" class="button" id="sign"><i class="fa-solid fa-user"></i> Signup</a>
                            </div>
                        </li>
                        <li>
                            <div class="line-ver"></div>
                        </li>
                        <li>
                            <div class="login" id="log">
                                <a href="#" class="button"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                            </div>
                        </li>
                        <?php
                        } 
                       else {
                        ?>
                        <div class='user-name'>
                        Hi, <?php echo $_SESSION["name"] ?>
                    </div>
                   
                    <li>
                            <div class="signup">
                            <a href ="dashboard.php"><i class="fa-solid fa-user"></i> Dashboard</a>
                            </div>
                        </li>
                        <li>
                            <div class="line-ver"></div>
                        </li>
                  
                      <li>
                            <div class="logout" id="logout">
                            <a href ="includes/logout.php"><i class="fa-solid fa-right-to-bracket"></i> Logout</a>
                            </div>
                        </li>
              
                    </ul>
                </nav>

                
            </div>

            <nav class="breadnav">
            <ul>
                <li>
                    <a href="http://localhost/htmlcss/index%20(2).php" class="Homebreadcrumb">Home</a>
                </li>
               
                <li>
                    <a href="#" class="activeitem"> Dashboard</a>
                </li>
                <?php
                }
                     ?>
            </ul>
        </nav>
        </div>


        <script>
            document.querySelector(".logout").addEventListener("click",function(){
                header("location:logout.php")
            })

            </script>