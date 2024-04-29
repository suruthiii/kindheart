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
        <div class="studentProfileCreation7-container">
            <div class="studentProfileCreation7-inner-container">
                <div class="studentProfileCreation7-inner-container-logo">
                    <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
                </div>
                <div class="studentProfileCreation7-inner-container-caption">
                    <h1>Privacy Preferences</h1>
                    <span>6 of 7</span> 
                    <span>Select the details you want to show in your profile</span> 
                </div>
                <div class="studentProfileCreation7-inner-container-form-container">
                    <form action="<?php echo URLROOT ?>/users/studentProfileCreation6" method="GET">
                        <div class="studentProfileCreation7-inner-container-form-container-inputfeilds">   

                            <div class="studentProfileCreation7-inner-container-form-container-inputfeilds-feild1">
                                <label class="studentProfileCreation7-inner-container-form-container-inputfeilds-feild1-labels">
                                    <input class="inputt" type="checkbox"  name="remember1"> School/University Name
                                </label>
                            </div>

                            <div class="studentProfileCreation7-inner-container-form-container-inputfeilds-feild1">
                                <label class="studentProfileCreation7-inner-container-form-container-inputfeilds-feild1-labels">
                                    <input class="inputt" type="checkbox"  name="remember2"> Academic Year
                                </label>
                            </div>

                            <div class="studentProfileCreation7-inner-container-form-container-inputfeilds-feild1">
                                <label class="studentProfileCreation7-inner-container-form-container-inputfeilds-feild1-labels">
                                    <input class="inputt" type="checkbox"  name="remember3"> Address
                                </label>
                            </div>

                            <div class="studentProfileCreation7-inner-container-form-container-inputfeilds-feild1">
                                <label class="studentProfileCreation7-inner-container-form-container-inputfeilds-feild1-labels">
                                    <input class="inputt" type="checkbox"  name="remember4"> Mobile Number
                                </label>
                            </div>

                            <div class="studentProfileCreation7-inner-container-form-container-inputfeilds-feild1">
                                <label class="studentProfileCreation7-inner-container-form-container-inputfeilds-feild1-labels">
                                    <input class="inputt" type="checkbox"  name="remember5"> Parent/Guardian Details
                                </label>
                            </div>
                        </div>
                        <p class="error-message" for="err"><?php echo $data['err']?></p>
                        <div class="studentProfileCreation7-inner-container-form-container-buttons">
                            <button>Next</button>
                        </div>
                    </form>
                </div>             
            </div>            
        </div>
    </div>
</body>
</html>