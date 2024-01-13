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
                <div class="studentCreateProfile-text">
                    <form action="#">
                        <div class="studentCreateProfile-input-field">
                            <label for="company" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Company</label><br>
                            <input class="inputt1" type="text" name="company" required><br><br>
                            <label for="regNo" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Company Registration Number</label><br>
                            <input class="inputt1" type="text" name="regNo" required><br><br>
                        </div>                            
                        <div class="button-next">
                            <button class="next shared-button2">Next</button>
                        </div>
                    </form>
                </div>            
            </div>       
        </div>
    </div>
</body>
</html>