<!DOCTYPE html>
<html lang="en">
<head>
    <title>Donor Creating Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/registerAndLogin.css" />

<body>
    <div class="container">
        <div class="image">
            <img src="<?php echo URLROOT?>/img/welcom.jpg" alt="Welcome_Image" id="registerAndLogin">
        </div>
        <div class="donorCreateProfile-formc shared-formc">
            <div class="donorCreateProfile-formce shared-formce">
                <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
            
                <h1>Creating Profile</h1>
                <span style="color: rgb(146, 141, 141);">Provide donations for their educational success</span><br><br><br>     
                <span style="color: rgb(146, 141, 141);">You're a</span>
                <div class="donorCreateProfile-text shared-text">    
                    <a href="<?php echo URLROOT ?>/users/donorCreateProfile2">                                      
                    <button class="choice" id="choice1">Individual</button><br>

                    <a href="<?php echo URLROOT ?>/users/donorCreateProfile3">
                    <button class="choice" id="choice2">Company</button>
                </div>         
            </div>       
        </div>
    </div>
</body>
</html>