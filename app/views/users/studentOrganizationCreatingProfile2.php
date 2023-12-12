<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Profile Creation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/registerAndLogin.css" />
</head>
<body>
    <div class="container">
        <div class="image">
            <img src="<?php echo URLROOT?>/img/welcom.jpg" alt="Welcome_Image" id="registerAndLogin">
        </div>
        <div class="studentProfile-formc shared-formc">
            <div class="studentProfile-formce shared-formce">
                <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
            
                <h1>Creating Profile</h1>
                <span style="color: rgb(146, 141, 141);">Receive donations for your educational activities</span>     
                <div class="studentProfile-text shared-text shared-label shared-button">
                    <form action="#">
                        <div class="studentProfile-input-field1 shared-input shared-margin">
                            <label for="mobilenumber" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Mobile Number </label><br><br>
                            <input class="inputt" type="text" name="email" required><br><br>
                            <label style="color: rgb(172, 34, 34); margin-bottom: 30px;" for="verificationCode"><b>Send OTP</b></label><br><br><br>
                            <label for="verificationCode" style="color: rgb(146, 141, 141);">Enter the verification code </label><br><br>
                        </div>
                        <div class="studentProfile-input-field2 shared-input2">
                            <input type="text" />
                            <input type="text" disabled />
                            <input type="text" disabled />
                            <input type="text" disabled />
                            <input type="text" disabled />
                            <input type="text" disabled />
                            <input type="text" disabled />
                        </div>
                        <button type='submit'>Verify OTP</button>
                    </form>
                </div>
                
            </div>
                
            
        </div>
    </div>
</body>
</html>