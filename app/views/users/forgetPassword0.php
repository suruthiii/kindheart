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
        <div class="forgetPassword0-container">
            <div class="forgetPassword0-inner-container">
                <div class="forgetPassword0-inner-container-logo">
                    <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
                </div>
                <div class="forgetPassword0-inner-container-caption">
                    <h1>Forget Password ?</h1>
                    <span>Setting up a new password</span> 
                </div>
                <div class="forgetPassword0-inner-container-form-container">
                    <form action="<?php echo URLROOT ?>/users/forgetPassword0" method="GET">
                        <div class="forgetPassword0-inner-container-form-container-inputfeilds">

                            <label for="password">Enter Username</label>
                            <div class="forgetPassword0-inner-container-form-container-inputfeilds-feild1">
                                <input class="forgetPassword0-input" type="text" name="username" id="username" value="<?php echo $data['username']?>" required>
                                <p class="error-message" for="username"><?php echo $data['username_err']?></p>
                            </div>
                        </div>

                        <div class="forgetPassword0-inner-container-form-container-buttons">
                            <button>Continue</button>
                        </div>
                    </form>
                </div>             
            </div>            
        </div>
    </div>
</body>
</html>