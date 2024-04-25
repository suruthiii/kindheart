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
        <div class="studentProfileCreation3-container">
            <div class="studentProfileCreation3-inner-container">
                <div class="studentProfileCreation3-inner-container-logo">
                    <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
                </div>
                <div class="studentProfileCreation3-inner-container-caption">
                    <h1>Creating Profile</h1>
                    <span>3 of 6</span> 
                </div>
                <div class="studentProfileCreation3-inner-container-form-container">
                    <form action="<?php echo URLROOT ?>/users/studentProfileCreation4" method="POST">
                        <div class="studentProfileCreation3-inner-container-form-container-inputfeilds">   

                            <label for="careType">Select Parent/Guardian</label>
                            <div class="studentProfileCreation3-inner-container-form-container-inputfeilds-selectbox">
                                <select id="careType" name="careType" value="">
                                    <option value="0" >
                                        Select Parent / Guardian
                                    </option>
                                    <option value="1">
                                        Father
                                    </option>
                                    <option value="2">
                                        Mother
                                    </option>
                                    <option value="3">
                                        Guardian
                                    </option>
                                </select>  
                                <span class="error-message" for="verificationCode"></span>
                            </div>

                            <label for="careName">Parent/Guardian Name</label>
                            <div class="studentProfileCreation3-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt1" type="text" name="careName" value="" >
                                <span class="error-message" for="verificationCode"></span>
                            </div>

                            <label for="careOccu">Parent/Guardian Occupation</label>
                            <div class="studentProfileCreation3-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt1" type="text" name="careOccu" value="" >
                                <span class="error-message" for="verificationCode"></span>
                            </div>

                            <label for="careRealat">Relationship to the Student</label>
                            <div class="studentProfileCreation3-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt1" type="text" name="careRealat" id="careRealat" value="" disabled>
                                <span class="error-message" for="verificationCode"></span>
                            </div>

                        </div>
                        <div class="studentProfileCreation3-inner-container-form-container-buttons">
                            <button>Next</button>
                        </div>
                    </form>
                </div>             
            </div>            
        </div>
    </div>

    <script>
        document.getElementById("careType").onchange = function() {
            var careType = this.value;
            var careRealatInput = document.getElementById("careRealat");
            if (careType === "Guardian") {
                // If the caregiver type is "Guardian", enable the relationship input
                careRealatInput.disabled = false;
            } else {
                // If not, disable the relationship input and clear its value
                careRealatInput.disabled = true;
                careRealatInput.value = "";
            }
        };
    </script>
</body>
</html>