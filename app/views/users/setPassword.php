<!DOCTYPE html>
<html lang="en">
<head>
    <title>Set Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/registerAndLogin.css" />
</head>
<body>
    <div class="container">
        <div class="image">
            <img src="<?php echo URLROOT?>/img/setps.jpg" alt="Set Password" id="registerAndLogin">
        </div>
        <div class="setPsw-formc shared-formc">
            <div class="setPsw-formce shared-formce">
                <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
            
                <h1>Set Password</h1>
                <span style="color: rgb(146, 141, 141);">Create a password for your account</span>     
                <div class="setPsw-text shared-label shared-button">
                    <form action="<?php echo URLROOT ?>/users/accountCreationSuccessful" method="GET">
                        <div class="setPsw-input-field shared-input shared-margin">
                            <label for="psw" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Enter Password</label><br><br>
                            <input class="inputt" spellcheck="false" type="password" name="psw" id="password" onkeyup="validateStrPassword()" ><br><br>
                            <span id="spassword-error"></span><br>

                            <label for="conf-psw" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Confirm New Password</label><br><br>
                            <input class="inputt" spellcheck="false"  type="password" name="conf-psw" id="cpassword" onkeyup="validatePassword()" ><br><br>
                            <span id="password-error"></span><br>
                        </div>
                        <button type="submit" id="setPassword">Set Password</button>
                    </form>
                </div>
               
            </div>  
        </div>
    </div>
</body>
</html>