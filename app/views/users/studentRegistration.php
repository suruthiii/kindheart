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
        <div class="studentRegistration-formc shared-formc">
            <div class="studentRegistration-formce shared-formce">
                <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
            
                <h1>Register As A Student</h1>
                <span style="color: rgb(146, 141, 141); margin-top: 10px;">Receive donations for your educational activities</span>     
                <div class="studentRegistration-text shared-text shared-label shared-button">
                    <form action="<?php echo URLROOT ?>/users/studentRegistration" method="POST">
                        <div class="studentRegistration-input-field1 shared-input shared-margin2">
                            <label for="email" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Create an Username </label><br><br>
                            <div class="inputbox">
                                <input class="inputt" type="email" name="email" id="email-field" value="<?php echo $data['email']; ?>" ><br>
                                <span class="error-message" for="verificationCode"><?php echo $data['email_err']; ?></span>
                            </div><br>

                            <label for="email" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Enter your email address </label><br><br>
                            <div class="inputbox">
                                <input class="inputt" type="email" name="email" id="email-field" value="<?php echo $data['email']; ?>" ><br>
                                <span class="error-message" for="verificationCode"><?php echo $data['email_err']; ?></span>
                            </div><br>

                            <label for="psw" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Enter Password</label><br><br>
                            <div class="inputbox">
                                <input class="inputt" type="password" name="password" id="password" value="<?php echo $data['password']; ?>"><br>
                                <span class="error-message" for="verificationCode"><?php echo $data['password_err']; ?></span>
                            </div><br>

                            <label for="psw" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Confirm Password</label><br><br>
                            <div class="inputbox">
                                <input class="inputt" type="password" name="confirmPassword" id="confirmPassword" value="<?php echo $data['confirmPassword']; ?>"><br>
                                <span class="error-message" for="verificationCode"><?php echo $data['confirmPassword_err']; ?></span>
                            </div>
                        </div>
                        <button>Create Account</button>
                    </form>
                </div>
                
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