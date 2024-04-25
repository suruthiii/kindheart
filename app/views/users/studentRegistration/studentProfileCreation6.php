<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/registration_Login.css" />
</head>

<body>
    <div class="container">
        <div class="image">
            <img src="<?php echo URLROOT?>/img/welcom.jpg" alt="Welcome_Image" id="registerAndLogin">
        </div>
        <div class="studentProfileCreation6-container">
            <div class="studentProfileCreation6-inner-container">
                <div class="studentProfileCreation6-inner-container-logo">
                    <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
                </div>
                <div class="studentProfileCreation6-inner-container-caption">
                    <h1>Creating Profile</h1>
                    <span>6 of 6</span> 
                </div>
                <div class="studentProfileCreation6-inner-container-form-container">
                    <form action="<?php echo URLROOT ?>/users/studentProfileCreation7" method="POST">
                        <div class="studentProfileCreation6-inner-container-form-container-inputfeilds">      

                            <label for="mobileNumber">Mobile Number </label>
                            <div class="studentProfileCreation6-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt" type="tel" name="email" id="email-field" value="" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}" required >
                                <span class="error-message" for="verificationCode"></span>
                            </div>

                            <div class="studentProfileCreation6-inner-container-form-container-inputfeilds-verificationmessage">
                                <p>Send Verification Code</p>
                            </div>

                            <label for="mobileNumber">Enter the verification code</label>
                            <div class="studentProfileCreation6-inner-container-form-container-inputfeilds-feild2">
                                <input type="text" />
                                <input type="text"  />
                                <input type="text"  />
                                <input type="text"  />
                                <input type="text"  />
                                <input type="text"  />
                                <input type="text"  />
                            </div>
                        </div>
                        <div class="studentProfileCreation6-inner-container-form-container-buttons">
                            <button>Verify</button>
                        </div>
                    </form>
                </div>             
            </div>            
        </div>
    </div>
</body>
</html>