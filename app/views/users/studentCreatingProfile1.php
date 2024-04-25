<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Creating Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/registerAndLogin.css" />
</head>
<body>
    <!-- <script>
        function myFunction() {
            var x = document.getElementById("whyGender");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script> -->

    <div class="container">
        <div class="image">
            <img src="<?php echo URLROOT?>/img/welcom.jpg" alt="Welcome_Image" id="registerAndLogin">
        </div>
        <div class="studentCreateProfile-formc shared-formc">
            <div class="studentCreateProfile-formce shared-formce">
                <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
            
                <h1>Creating Profile</h1>
                <span style="color: rgb(146, 141, 141);">1 of 6</span><br><br><br>   
                <div class="studentCreateProfile-text shared-text shared-label">
                    <form action="<?php echo URLROOT ?>/users/studentProfileCreation2" method="POST">
                        <div class="studentCreateProfile-input-field">
                            <div class="studentCreateProfile-horizontal-input">
                                <div class="input-group">
                                    <label for="firstName" style="color: rgb(146, 141, 141); margin-top: 25px; margin-bottom: 12px !important;">First Name</label>
                                    <input class="inputt2" type="text" name="firstName" value="<?php echo $data['firstName']; ?>">
                                    <span class="error-message"><?php echo $data['firstName_err']; ?></span>
                                </div>
                                <div class="input-group">
                                    <label for="lastName" style="color: rgb(146, 141, 141); margin-top: 25px; margin-bottom: 12px !important;">Last Name</label>
                                    <input class="inputt2" type="text" name="lastName" value="<?php echo $data['lastName']; ?>">
                                    <span class="error-message"><?php echo $data['lastName_err']; ?></span>
                                </div>
                            </div>
                            
                            <label for="address" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Address</label><br>
                            <input class="inputt1" type="text" name="address" value="<?php echo $data['address']; ?>"><br>
                            <span class="error-message"><?php echo $data['address_err']; ?></span>
                            <br>

                            <label for="dob" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Date Of Birth</label><br>
                            <input class="inputt1" type="date" name="dob" value="<?php echo $data['dob']; ?>"><br>
                            <span class="error-message"><?php echo $data['dob_err']; ?></span>
                            <br>

                            <div class="studentCreateProfile-horizontal-input">
                                <div class="radio-group1">
                                    <label for="gender" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Gender</label><br>
                                    <div class="radio-buttons">
                                        <input type="radio" id="male" name="gender" value="male"<?php echo ($data['gender'] === 'male') ? ' checked' : ''; ?>>
                                        <label id="radio_label" for="male">Male</label><br>
                                        <input type="radio" id="female" name="gender" value="female"<?php echo ($data['gender'] === 'female') ? ' checked' : ''; ?>>
                                        <label id="radio_label" for="female">Female</label><br>
                                        <input type="radio" id="other" name="gender" value="other"<?php echo ($data['gender'] === 'other') ? ' checked' : ''; ?>>
                                        <label id="radio_label" for="other">Other</label><br>
                                    </div>
                                    <span class="error-message"><?php echo $data['gender_err']; ?></span>   

                                </div>
                                <!-- <br> -->

                                <div class="radio-group2">
                                    <label for="studentType" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Student Type</label><br>
                                    <div class="radio-buttons" >
                                        <input type="radio" id="schoolStudent" name="studentType" value="schoolStudent"<?php echo ($data['studentType'] === 'schoolStudent') ? ' checked' : ''; ?>>
                                        <label id="radio_label" for="schoolStudent">School Student</label><br>
                                        <input type="radio" id="universityStudent" name="studentType" value="universityStudent"<?php echo ($data['studentType'] === 'universityStudent') ? ' checked' : ''; ?>>
                                        <label id="radio_label" for="universityStudent">University Student</label><br>
                                    </div>
                                    <span class="error-message"><?php echo $data['studentType_err']; ?></span>
                                </div>
                                <!-- <br> -->
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