<!DOCTYPE html>
<html lang="en">
<head>
<title>Register Landing</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php echo URLROOT?>/css/registerAndLogin.css" />

<body>
    <div class="container">
        <div class="image">
            <img src="<?php echo URLROOT?>/img/welcom.jpg" alt="Welcome_Image" id="registerAndLogin">
        </div>
        <div class="registerLanding-formc shared-formc">
            <div class="registerLanding-formce shared-formce">
                <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
            
                <h1>Register to <span style="color: #FC44A6;">Kind</span><span style="color: #FB5F1E;">Heart</span></h1>
                <span style="color: rgb(146, 141, 141);">Who would you like to register as?</span><br><br><br>     
                <div class="registerLanding-text"> 
                    <a href="<?php echo URLROOT ?>/users/studentRegistration">
                    <button class="choice" id="choice1">
                        <span class="button-text">Student</span>
                        <p class="description">Sign up to receive donations for your educational activities</p>
                    </button>
                    <br>
                    <a href="<?php echo URLROOT ?>/users/organizationRegistration">                                        
                    <button class="choice" id="choice1">
                        <span class="button-text">Organization</span>
                        <p class="description">Sign up as a university or a school to receive donations for your students</p>
                    </button>
                    <br>
                    <a href="<?php echo URLROOT ?>/users/donorRegistration">
                    <button class="choice" id="choice1">
                        <span class="button-text">Donor</span>
                        <p class="description">Sign up as a donor to discover and donate for students in need</p>
                    </button>
                </div>            
                <p style="color: rgb(146, 141, 141); margin-top: 30px !important;">Already Registered? <a href="<?php echo URLROOT ?>/users/login">Log in here</a></p>
            </div>       
        </div>
    </div>
</body>
</html>