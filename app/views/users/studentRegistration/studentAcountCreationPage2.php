<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/registerAndLogin.css" />
</head>

<body>
    <div class="container">
        <div class="image">
            <img src="<?php echo URLROOT?>/img/welcom.jpg" alt="Welcome_Image" id="registerAndLogin">
        </div>
        <div class="studentAcountCreationPage1-container">
            <div class="studentAcountCreationPage1-inner-container">
                <div class="studentAcountCreationPage1-inner-container-logo">
                    <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
                </div>
                <div class="studentAcountCreationPage1-inner-container-caption">
                    <h1>Register As A Student</h1>
                    <span style="color: rgb(146, 141, 141); margin-top: 10px;">Receive donations for your educational activities</span> 
                </div>
                <div class="studentAcountCreationPage1-inner-container-form-container">
                    <form action="<?php echo URLROOT ?>/users/studentRegistration" method="POST">
                        <div class="studentAcountCreationPage1-inner-container-form-container-inputfeilds">                            
                            <label for="email" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Create an Username </label>
                            <div class="studentAcountCreationPage1-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt" type="email" name="email" id="email-field" value="" >
                                <span class="error-message" for="verificationCode"></span>
                            </div>
                            
                            <label for="email" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Enter your email address </label>
                            <div class="studentAcountCreationPage1-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt" type="email" name="email" id="email-field" value="" >
                                <span class="error-message" for="verificationCode"></span>
                            </div><br>

                            <label for="psw" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Enter Password</label>
                            <div class="studentAcountCreationPage1-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt" type="password" name="password" id="password" value="">
                                <span class="error-message" for="verificationCode"></span>
                            </div><br>

                            <label for="psw" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Confirm Password</label>
                            <div class="studentAcountCreationPage1-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt" type="password" name="confirmPassword" id="confirmPassword" value="">                                
                                <span class="error-message" for="verificationCode"></span>
                            </div>
                        </div>
                        <div class="studentAcountCreationPage1-inner-container-form-container-buttons">
                            <button>Create Account</button>
                        </div>
                    </form>
                </div>
                
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>                
            </div>            
        </div>
    </div>

    <!-- <div class="container">
        <div class="image">
            <img src="<?php echo URLROOT?>/img/welcom.jpg" alt="Welcome_Image" id="registerAndLogin">
        </div>
        <div class="studentRegistration-formc shared-formc">
            <div class="studentRegistration-formce shared-formce">
                <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
            
                <h1>Register as a Student</h1>
                <span style="color: rgb(146, 141, 141);">Receive donations for your educational activities</span>     
                <div class="studentRegistration-text shared-text shared-label shared-button">
                    <form action="<?php echo URLROOT ?>/users/setPassword" method="GET">
                        <div class="studentRegistration-input-field1 shared-input shared-margin2">
                            <label for="email" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Enter your email address </label><br><br>
                            <input class="inputt" type="email" name="email" id="email-field" value="<?php echo $data['email']; ?>" /><br><br>
                            <span style="color: rgb(172, 34, 34); margin-bottom: 30px; font-weight: bold;" for="verificationCode"><?php echo $data['email_err'];?></span>


                            <label style="color: rgb(172, 34, 34); margin-bottom: 30px; font-weight: bold;" for="verificationCode">Send verification code</label><br><br><br>
                            <label for="verificationCode" style="color: rgb(146, 141, 141);">Enter the verification code </label><br><br>
                        </div>
                        <div class="studentRegistration-input-field2 shared-input2">
                            <input type="text" />
                            <input type="text"  />
                            <input type="text"  />
                            <input type="text"  />
                            <input type="text"  />
                            <input type="text"  />
                            <input type="text"  />
                        </div>
                        <button>Verify</button>
                    </form>
                </div>
                
            </div>
                
            
        </div>
    </div> -->
</body>
</html>