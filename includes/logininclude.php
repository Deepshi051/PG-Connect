<style>
   
/* forms */
.log-popup{
    height: 100%;
    width: 100%;
    position: absolute;
    top:0;
    left:0;
    background: rgba(0,0,0,0.5);
    display:none;
    justify-content: center;
    /* text-align: center; */
}
.log-popup .popup-content{
    height: 351px;
    width: 351px;
    background: white;
    padding: 20px;
    position: relative;
    margin: 9rem auto;
}
.log-popup .popup-content h1{
    margin-bottom: 0.5rem;
text-align: center;
    font-weight: 700;
}
.log-close{
    position: relative;
    top: -73px;
    right: -305px;
    font-size: 18px;
   color: black;
 
    /* width: 23px;
    height: 23px; */

}

.log-popup .popup-content .box input{
   
    /* margin: 21px auto; */
   
    /* padding: 11px; */
    border: none;
    width: 85%;
    /* padding-bottom: 10px; */
    border-bottom: 2px solid black;   
    background: transparent;
    outline: none;
    
  
}
.log-popup .popup-content .box i{
    width: 8%;
    text-align: center;
}
.log-popup .popup-content .box{
   width: 100%;
  margin-bottom: 2rem;
}
.log-popup .popup-content .log-btn{
    text-align: center;
}
.log-popup .button{

background:#4dc7bc;
padding: 10px 15px;
color: black;
font-weight: bold;
text-transform: uppercase;
font-size: 18px;
border-radius: 5px;
box-shadow: 6px 6px 29px -4px rgba(0,0,0,0.5);
margin-top: 25px;
text-decoration: none;
text-align: center;
border: none;
outline: none;
}
.log-popup .popup-content .button:hover{
    background: #4dc7bc;
    color: white;
}
.log-popup .popup-content .no-account{
    text-align: center;
    margin: -9px 0;
}

</style>



<!-- login form -->

 <div class="log-popup">
        <div class="popup-content">
           <form action="http://localhost/htmlcss/login-submit.php" method="post">
                <h1>Login </h1>
                 <a href="#" class="log-close">
                   <i class="fa fa-times"></i>
                </a>
            
           
               <div class="box">
                  <i class="fa fa-user"></i>
                  <input type="text" name="fullname" id="e1" placeholder="Full Name">
               </div>
               <div class="box">
                   <i class="fa fa-key"></i>
                   <input type="password" name="pass" id="pass1" placeholder="password">
               </div>
                <div class="log-btn">
                     <button class="button">LogIn</button>
                </div>
           
                <hr>
               <div class="no-account">
                   Don't have an account?<a href="#" class="no-acc">Signup</a>
                </div>
           </form>
        
           
        </div>
    </div>

    <script>
        <?php if(!isset($_SESSION["user_id"])){?>
        document.getElementById("log").addEventListener("click", function () {
            document.querySelector(".log-popup").style.display = "flex";
        })


        document.querySelector(".log-close").addEventListener("click", function () {
            document.querySelector(".log-popup").style.display = "none";
        })
        <?php } ?>
    </script>