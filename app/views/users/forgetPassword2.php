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
            
                <h1>Forget Password?</h1>
                <span style="color: rgb(146, 141, 141);">Reset your password</span>     
                <div class="forgetPsw-text2 shared-text shared-label shared-button">
                    <form action="#">
                        <div class="forgetPsw-input-field shared-input shared-margin">
                            <label for="psw" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Enter Password</label><br><br>
                            <input class="inputt" spellcheck="false" type="password" name="psw" id="password" required><br><br>
                            <span id="spassword-error"></span><br>

                            <label for="conf-psw" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Confirm New Password</label><br><br>
                            <input class="inputt" spellcheck="false"  type="password" name="conf-psw" id="cpassword" required><br><br>
                            <span id="password-error"></span><br>
                        </div>
                        <button type="submit" id="setPassword">Reset Password</button>
                    </form>
                </div>               
            </div>  
        </div>
    </div>
</body>
</html>