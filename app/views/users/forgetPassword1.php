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
        <div class="forgetPassword1-container">
            <div class="forgetPassword1-inner-container">
                <div class="forgetPassword1-inner-container-logo">
                    <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
                </div>
                <div class="forgetPassword1-inner-container-caption">
                    <h1>Forget Password ?</h1>
                    <span>Reset Your Password</span> 
                </div>
                <div class="forgetPassword1-inner-container-form-container">
                    <form action="<?php echo URLROOT ?>/users/forgetPassword1" method="POST">
                        <div class="forgetPassword1-inner-container-form-container-inputfeilds">      

                            <label for="email">Enter your email address </label>
                            <div class="forgetPassword1-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt" type="email" name="email" id="email-field" value="<?php echo $data['email']?>" disabled><br>
                                <span class="error-message" for="verificationCode"><?php echo $data['email_err']?></span>
                            </div>

                            <div class="forgetPassword1-inner-container-form-container-inputfeilds-verificationmessage">
                                <button type="submit">Send Verification Code</button>
                            </div>
                    </form>

                    <form action="<?php echo URLROOT ?>/users/OTPforgetPassword1" method="GET">
                        <div class="forgetPassword1-inner-container-form-container-inputfeilds">      
                            <label for="email">Enter the verification code</label>
                            <div class="forgetPassword1-inner-container-form-container-inputfeilds-feild2">
                                <input type="text" name="digit-1" required/>
                                <input type="text" name="digit-2" required/>
                                <input type="text" name="digit-3" required/>
                                <input type="text" name="digit-4" required/>
                                <input type="text" name="digit-5" required/>
                                <input type="text" name="digit-6" required/>
                                <input type="text" name="digit-7" required/>
                            </div>
                            <span class="error-message" for="verificationCode"><?php echo $data['otp_err']?></span>
                        </div>
                        <div class="forgetPassword1-inner-container-form-container-buttons">
                            <button>Verify</button>
                        </div>
                    </form>
                </div>             
            </div>            
        </div>
    </div>
</body>
</html>