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
            
                <h1>Verify Email Address</h1>
                <span style="color: rgb(146, 141, 141); display: block; margin-top: 10px;">We've sent an email to [email] with a verification code. </span>
                <span style="color: rgb(146, 141, 141); display: block;">Please enter the code below, to verify your email. </span>
                <span style="color: rgb(146, 141, 141); display: block;">Thank you.</span>     
                <div class="studentRegistration-text shared-text shared-label shared-button">
                    <form action="<?php echo URLROOT ?>/users/accountCreationSuccessfulStudent" method="GET">
                        <div class="studentRegistration-input-field1 shared-input shared-margin2">
                            <label for="email" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Enter the verification code</label><br><br>
                            <div class="studentRegistration-input-field2 shared-input2">
                                <input type="text" />
                                <input type="text"  />
                                <input type="text"  />
                                <input type="text"  />
                                <input type="text"  />
                                <input type="text"  />
                                <input type="text"  />
                            </div>
                        </div>
                        <button>Submit</button> <br>
                        <button style="width: 300px; margin-top: 15px;">Resend Verification Code</button>
                    </form>
                </div>
                
            </div>               
        </div>
    </div>
</body>
</html>