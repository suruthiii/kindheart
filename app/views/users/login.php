<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/registerAndLogin.css" />
</head>
<body>
    <div class="container">
        <div class="image">
            <img src="<?php echo URLROOT?>/img/welcom.jpg" alt="Set Password" id="registerAndLogin">
        </div>
        <div class="login-formc shared-formc">
            <div class="login-formce shared-formce">
                <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
            
                <h1>Welcome Back!</h1>

                <?php if (!empty($data['err'])) { ?>
                    <div class="error-msg">
                        <span class="form-invalid"><?php echo $data["err"] ?></span>
                    </div>
                <?php } ?>
                
                <!-- <span style="color: rgb(146, 141, 141);">Create a password for your account</span>      -->
                <div class="login-text shared-text shared-label shared-button">
                    <form action="<?php echo URLROOT ?>/users/login" method="POST">
                        <div class="login-input-field shared-input shared-margin2">
                            <label for="username" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Username</label><br><br>
                            <input class="inputt" type="text" name="username" id="email" required><br><br>
                            <label for="password" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Password</label><br><br>
                            <input class="inputt" type="password" name="password" id="password" required><br><br>
                            <label for="forget-password" style="color: rgb(146, 141, 141); margin-top: 30px !important;"><a href="<?php echo URLROOT ?>/users/forgetPassword1">Forgot Password?</a></label><br><br>
                        </div>
                        <div>
                            <label>
                                <input type="checkbox" checked="checked" name="remember"> Remember me
                            </label>
                        </div>
                        <button type="submit" id="Login">Login</button>
                    </form>
                </div>
               
            </div>  
        </div>
    </div>
</body>
</html>