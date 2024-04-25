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
        <div class="studentAcountCreationPage2-container">
            <div class="studentAcountCreationPage2-inner-container">
                <div class="studentAcountCreationPage2-inner-container-logo">
                    <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
                </div>
                <div class="studentAcountCreationPage2-inner-container-caption">
                    <h1>Set Username and Password</h1>
                    <span>Create an username and a password for your account</span> 
                </div>
                <div class="studentAcountCreationPage2-inner-container-form-container">
                    <form action="<?php echo URLROOT ?>/users/studentAcountCreationPage3" method="POST">
                        <div class="studentAcountCreationPage2-inner-container-form-container-inputfeilds">                            
                            <label for="email">Create an Username </label>
                            <div class="studentAcountCreationPage2-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt" type="email" name="email" id="email-field" value="" >
                                <span class="error-message" for="verificationCode"></span>
                            </div>

                            <label for="psw">Enter Password</label>
                            <div class="studentAcountCreationPage2-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt" type="password" name="password" id="password" value="">
                                <span class="error-message" for="verificationCode"></span>
                            </div>

                            <label for="psw">Confirm Password</label>
                            <div class="studentAcountCreationPage2-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt" type="password" name="confirmPassword" id="confirmPassword" value="">                                
                                <span class="error-message" for="verificationCode"></span>
                            </div>
                        </div>
                        <div class="studentAcountCreationPage2-inner-container-form-container-buttons">
                            <button>Set Password</button>
                        </div>
                    </form>
                </div>             
            </div>            
        </div>
    </div>
</body>
</html>