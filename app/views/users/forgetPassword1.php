<!DOCTYPE html>
<html lang="en">
<head>
    <title>Forget Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/registerAndLogin.css" />
</head>
<body>
    <div class="container">
        <div class="image">
            <img src="<?php echo URLROOT?>/img/setps.jpg" alt="Set Password" id="registerAndLogin">
        </div>
        <div class="forgetPsw-formc shared-formc">
            <div class="forgetPsw-formce shared-formce">
                <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
            
                <h1>Forgot Password?</h1>
                <span style="color: rgb(146, 141, 141);">Reset your password</span>     
                <div class="forgetPsw-text shared-text shared-label shared-button">
                    <form action="<?php echo URLROOT ?>/users/forgetPassword2" method="GET">
                        <div class="forgetPsw-input-field1 shared-input shared-margin">
                            <label for="email" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Enter your Email address</label><br><br>
                            <input class="inputt" type="text" name="email" /><br><br>
                            <label style="color: rgb(172, 34, 34); margin-bottom: 30px;" for="verificationCode"><b>Send OTP</b></label><br><br><br>
                            <label for="verificationCode" style="color: rgb(146, 141, 141);">Enter the verification code </label><br><br>
                        </div>
                        <div class="forgetPsw-input-field2 shared-input2">
                            <input type="text" />
                            <input type="text"  />
                            <input type="text"  />
                            <input type="text"  />
                            <input type="text"  />
                            <input type="text"  />
                            <input type="text"  />
                        </div>

                        <button type="submit">Continue</button>
                        
                    </form>
                </div>
                
            </div>
                
            
        </div>
    </div>
</body>
</html>