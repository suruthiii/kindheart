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
        <div class="studentAcountCreationPage1-container">
            <div class="studentAcountCreationPage1-inner-container">
                <div class="studentAcountCreationPage1-inner-container-logo">
                    <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
                </div>
                <div class="studentAcountCreationPage1-inner-container-caption">
                    <h1>Register as a Student</h1>
                    <span>Receive donations for your educational activities</span> 
                </div>
                <div class="studentAcountCreationPage1-inner-container-form-container">
                    <form action="<?php echo URLROOT ?>/users/studentAcountCreationPage1" method="GET">
                        <div class="studentAcountCreationPage1-inner-container-form-container-inputfeilds">      

                            <label for="email">Enter your email address </label>
                            <div class="studentAcountCreationPage1-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt" type="email" name="email" id="email-field" value="<?php echo $data['email']?>" ><br>
                                <span class="error-message" for="verificationCode"><?php echo $data['email_err']?></span>
                            </div>

                            <div class="studentAcountCreationPage1-inner-container-form-container-inputfeilds-verificationmessage">
                                <button type="submit">Send Verification Code</button>
                            </div>
                    </form>

                    <form action="<?php echo URLROOT ?>/users/OTPstudentAcountCreationPage1" method="GET">
                        <div class="studentAcountCreationPage1-inner-container-form-container-inputfeilds">      
                            <label for="email">Enter the verification code</label>
                            <div class="studentAcountCreationPage1-inner-container-form-container-inputfeilds-feild2">
                                <input type="text" name="digit-1" />
                                <input type="text" name="digit-2" />
                                <input type="text" name="digit-3" />
                                <input type="text" name="digit-4" />
                                <input type="text" name="digit-5" />
                                <input type="text" name="digit-6" />
                                <input type="text" name="digit-7" />
                            </div>
                            <span class="error-message" for="verificationCode"><?php echo $data['otp_err']?></span>
                        </div>
                        <div class="studentAcountCreationPage1-inner-container-form-container-buttons">
                            <button>Verify</button>
                        </div>
                    </form>
                </div>             
            </div>            
        </div>
    </div>
</body>
</html>