<html>
    <head>
        <title><?php echo SITENAME ?></title>

        <!-- External CSS -->
        <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/registerLanding.css">
    </head>
    <body>

    <div class="container">
        <div class="image">
            <img src="<?php echo URLROOT ?>/images/welcom.jpg" alt="Welcome_Image" id="welcome">
        </div>
        <div class="formc">
            <div class="formce">
                <img src="<?php echo URLROOT ?>/images/logo.png" alt="Logo_Image" id="logo">
            
                <h1>Register to <span style="color: #FC44A6;">Kind</span><span style="color: #FB5F1E;">Heart</span></h1>
                <span style="color: rgb(146, 141, 141);">Who would you like to register as?</span><br><br><br>     
                <div class="text">                                          
                    <button class="choice" id="choice1">
                        <span class="button-text">Student</span>
                        <p class="description">Sign up to receive donations for your educational activities</p>
                    </button><br>
                    <button class="choice" id="choice1">
                        <span class="button-text">Organization</span>
                        <p class="description">Sign up as a university or a school to receive donations for your students</p>
                    </button><br>
                    <button class="choice" id="choice1">
                        <span class="button-text">Donor</span>
                        <p class="description">Sign up as a donor to discover and donate for students in need</p>
                    </button>
                </div>            
                <p style="color: rgb(146, 141, 141); margin-top: 30px !important;">Already Registered? <a href="">Log in here</a></p>
            </div>       
        </div>
    </div>