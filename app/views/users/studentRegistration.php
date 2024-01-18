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
            
                <h1>Register as a Student</h1>
                <span style="color: rgb(146, 141, 141);">Receive donations for your educational activities</span>     
                <div class="studentRegistration-text shared-text shared-label shared-button">
                    <form action="<?php echo URLROOT ?>/users/setPassword" method="GET">
                        <div class="studentRegistration-input-field1 shared-input shared-margin2">
                            <label for="email" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Enter your email address </label><br><br>
                            <!-- <input class="inputt" spellcheck="false" type="email" name="email" id="email-field" onkeyup="validateEmail()" ><br><br> -->
                            <input class="inputt" type="email" name="email" id="email-field" value="<?php echo $data['email'];?>" ><br><br>
                            <span id="email-error"></span><br>


                            <label style="color: rgb(172, 34, 34); margin-bottom: 30px;" for="verificationCode"><b>Send verification code</b></label><br><br><br>
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
    </div>
</body>
</html>