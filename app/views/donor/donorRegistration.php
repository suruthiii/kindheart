<html>
    <head>
        <title><?php echo SITENAME ?></title>

        <!-- External CSS -->
        <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/donorRegistration.css">
    </head>
    <body>

<div class="donor-registration">
            <div class="image">
                <img src="images/welcom.jpg" alt="Welcome_Image" id="welcome">
            </div>
            <div class="formc">
                <div class="formce">
                    <img src="images/logo.png" alt="Logo_Image" id="logo">
                
                    <h1>Register as a Donor</h1>
                    <span style="color: rgb(146, 141, 141);">Provide donations for their educational success</span>     
                    <div class="text2">
                        <form action="#">
                            <div class="input-field1">
                                <label for="email" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Enter your email address </label><br><br>
                                <input class="inputt" type="text" name="email" required><br><br>
                                <label style="color: rgb(172, 34, 34); margin-bottom: 30px;" for="verificationCode"><b>Send verification code</b></label><br><br><br>
                                <label for="verificationCode" style="color: rgb(146, 141, 141);">Enter the verification code </label><br><br>
                            </div>
                            <div class="input-field2">
                                <input type="number" />
                                <input type="number" disabled />
                                <input type="number" disabled />
                                <input type="number" disabled />
                                <input type="number" disabled />
                                <input type="number" disabled />
                                <input type="number" disabled />
                            </div>
                            <button type='submit'>Verify OTP</button>
                        </form>
                    </div>
                   
                </div>
                  
                
            </div>
        </div>