<style>
    /* signup form */
.sign-popup{
    height: 100%;
    width: 100%;
    position: absolute;
    top:0;
    left:0;
    background: rgba(0,0,0,0.5);
    display:none;
    justify-content: center;
    text-align: center;
}
.sign-popup .popup-content{
    height: 526px;
    width: 449px;
    background: white;
    max-width: 800px;
    margin: 77px auto;
    padding: 16px;
    position: relative;
   
}
.sign-popup .popup-content h1{
    margin-bottom: 0.5rem;

    font-weight: 700;
}
.sign-popup .signup-close{
    position: relative;
    top: -69px;
    right: -209px;
    font-size: 18px;
   color: black;
 
    /* width: 23px;
    height: 23px; */

}


.sign-popup .popup-content .box input{
   
    width: 19rem;
    font-size: 20px;
    border: none;
  
    border-bottom: 2px solid black;   
    margin: 2px 0;
    outline: none;
    
  
}
.sign-popup .popup-content .box i{
   
    width: 7%;
    text-align: center;
   
}
.sign-popup .popup-content .box{

margin-bottom: 14px;
 width: 100%;
}

.sign-popup .popup-content form .check{
    /* margin-bottom:3rem; */
     font-size: 18px;}




.sign-popup .popup-content .check input{
    margin:0 7px;
}
.sign-popup form button{

background:#4dc7bc;
padding: 10px 15px;
color: black;
font-weight: bold;
text-transform: uppercase;
font-size: 18px;
border-radius: 5px;
box-shadow: 6px 6px 29px -4px rgba(0,0,0,0.5);
/* margin-top: 25px; */
text-decoration: none;
border: none;

}
.sign-popup .popup-content .button:hover{
    background: #4dc7bc;
    color: white;
}
</style>
    <!-- signup-form -->


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
<input type="text" name="city"  placeholder="city">
</div>

                <div class="check">

                I'm a<input type="radio" name="gender" value="male">Male
                    <input type="radio" name="gender" value="female" >Female

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
         document.getElementById("sign").addEventListener("click", function () {
            document.querySelector(".sign-popup").style.display = "flex";
        });

        document.querySelector(".signup-close").addEventListener("click", function () {
            document.querySelector(".sign-popup").style.display = "none";
        });
    </script>
