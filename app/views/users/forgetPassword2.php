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
        <div class="forgetPassword2-container">
            <div class="forgetPassword2-inner-container">
                <div class="forgetPassword2-inner-container-logo">
                    <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
                </div>
                <div class="forgetPassword2-inner-container-caption">
                    <h1>Forget Password ?</h1>
                    <span>Setting up new password</span> 
                </div>
                <div class="forgetPassword2-inner-container-form-container">
                    <form action="<?php echo URLROOT ?>/users/forgetPassword2" method="GET">
                        <div class="forgetPassword2-inner-container-form-container-inputfeilds">

                            <label for="password">Enter Password</label>
                            <div class="forgetPassword2-inner-container-form-container-inputfeilds-feild1">
                                <input class="forgetPassword2-input" type="password" name="password" id="password" value="<?php echo $data['password']?>">
                                <p class="error-message" for="password"><?php echo $data['password_err']?></p>
                            </div>

                            <label for="confirmPassword">Confirm Password</label>
                            <div class="forgetPassword2-inner-container-form-container-inputfeilds-feild1">
                                <input class="forgetPassword2-input" type="password" name="confirmPassword" id="confirmPassword" value="">                                
                                <p class="error-message" for="confirmPassword"><?php echo $data['confirmPassword_err']?></p>
                            </div>

                        </div>

                        <div class="forgetPassword2-inner-container-form-container-buttons">
                            <button>Set Password</button>
                        </div>
                    </form>
                </div>             
            </div>            
        </div>
    </div>
</body>
</html>