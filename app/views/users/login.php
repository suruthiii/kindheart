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
        <div class="login-container">
            <div class="login-inner-container">
                <div class="login-inner-container-logo">
                    <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
                </div>
                <div class="login-inner-container-caption">
                    <h1>Welcome Back!</h1>
                    <span>Login to Kindheart</span> 
                </div>

                <!-- <?php if (!empty($data['err'])) { ?>
                    <div class="error-msg">
                        <span class="form-invalid"><?php echo $data["err"] ?></span>
                    </div>
                <?php } ?> -->

                <div class="login-inner-container-form-container">
                    <form action="<?php echo URLROOT ?>/users/studentAcountCreationPage2" method="POST">
                        <div class="login-inner-container-form-container-inputfeilds">      

                            <label for="email">Username</label>
                            <div class="login-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt" type="text" name="username" id="email" required>
                                <span class="error-message" for="verificationCode"></span>
                            </div>

                            <label for="email">Password</label>
                            <div class="login-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt" type="password" name="password" id="password" required>
                                <span class="error-message" for="verificationCode"></span>
                            </div>

                            <div class="login-inner-container-form-container-inputfeilds-forgetpassword">
                                <p><a style="color: black;" href="<?php echo URLROOT ?>/users/forgetPassword1">Forgot Password?</a></p>
                            </div>

                            <div class="login-inner-container-form-container-inputfeilds-rememberme">
                                <input type="checkbox" name="remember" id="remember">
                                <label for="remember">Remember me</label>
                            </div>

                        </div>
                        <div class="login-inner-container-form-container-buttons">
                            <button>Login</button>
                        </div>
                    </form>
                </div>             
            </div>            
        </div>
    </div>
</body>
</html>