<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/registration_Login.css" />
</head>

<body>
    <div class="container">
        <div class="image">
            <img src="<?php echo URLROOT?>/img/welcom.jpg" alt="Welcome_Image" id="registerAndLogin">
        </div>
        <div class="studentAcountCreationPage3-container">
            <div class="studentAcountCreationPage3-inner-container">
                <div class="studentAcountCreationPage3-inner-container-logo">
                    <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
                </div>
                <div class="studentAcountCreationPage3-inner-container-caption">
                    <h1>Account Creation Successful!</h1>
                    <span>Now you can login to your account</span> 
                </div>

                <div class="studentAcountCreationPage3-inner-container-buttons">
                    <a href="<?php echo URLROOT ?>/users/login">
                        <button>Continue</button>
                    </a>
                </div>            
            </div>            
        </div>
    </div>
</body>
</html>