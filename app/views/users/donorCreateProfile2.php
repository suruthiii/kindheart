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
                    <form action="<?php echo URLROOT ?>/users/profileCreationSuccessful" method="GET">
                        <div class="studentCreateProfile-input-field">
                            <div class="studentCreateProfile-horizontal-input">
                                <div class="studentCreateProfile-horizontal-input">
                                    <div class="input-group">
                                        <label for="firstName" style="color: rgb(146, 141, 141); margin-top: 25px; margin-bottom: 12px !important;">First Name</label>
                                        <input class="inputt2" type="text" name="firstName" >
                                    </div>
                                    <div class="input-group">
                                        <label for="lastName" style="color: rgb(146, 141, 141); margin-top: 25px; margin-bottom: 12px !important;">Last Name</label>
                                        <input class="inputt2" type="text" name="lastName" >
                                    </div>
                                </div>
                            </div>
                            <div class="studentCreateProfile-horizontal-input">
                                <div class="input-group">
                                    <label for="nic" style="color: rgb(146, 141, 141); margin-top: 30px !important;">NIC Number</label><br>
                                    <input class="inputt2" type="text" name="nic" ><br>
                                </div>
                                <div class="input-group">
                                    <label for="gender" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Gender</label><br>
                                    <select class="inputt" name="orgType" >
                                        <option value="male" class="dropdown-option">Male</option>
                                        <option value="female" class="dropdown-option">Female</option>
                                    </select><br>
                                </div>
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