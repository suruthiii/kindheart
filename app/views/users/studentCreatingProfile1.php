<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Creating Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/registerAndLogin.css" />
</head>
<body>
    <script>
        function myFunction() {
            var x = document.getElementById("whyGender");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>

    <div class="container">
        <div class="image">
            <img src="<?php echo URLROOT?>/img/welcom.jpg" alt="Welcome_Image" id="registerAndLogin">
        </div>
        <div class="studentCreateProfile-formc shared-formc">
            <div class="studentCreateProfile-formce shared-formce">
                <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
            
                <h1>Creating Profile</h1>
                <span style="color: rgb(146, 141, 141);">1 of 6</span><br><br><br>     
                <div class="studentCreateProfile-text">
                    <form action="<?php echo URLROOT ?>/users/studentCreatingProfile2" method="GET">
                        <div class="studentCreateProfile-input-field">
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
                            
                            <label for="address" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Address</label><br>
                            <input class="inputt1" type="text" name="address" ><br><br>

                            <div class="studentCreateProfile-horizontal-input">
                                <div class="input-group">
                                    <label for="gender" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Gender</label><br>
                                    <select class="inputt" name="orgType" >
                                        <option value="male" class="dropdown-option">Male</option>
                                        <option value="female" class="dropdown-option">Female</option>
                                        <option value="female" class="dropdown-option">Other</option>
                                    </select><br>
                                </div>
                                <div class="input-group">
                                    <label for="orgType" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Student Type</label><br>
                                    <select class="inputt" name="orgType" >
                                        <option value="school" class="dropdown-option">School Student</option>
                                        <option value="university" class="dropdown-option">University Student</option>
                                    </select><br>
                                </div>
                            </div>

                            <!-- <label for="orgType" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Birth Day</label><br><br>
                            <input type="date" id="birthday" name="birthday"> -->

                            <span style="color: rgb(146, 141, 141);" onclick="myFunction()" >Why Age & Gender</span>
                                <!-- <div id="whyGender">
                                    <ul>
                                        <li>The age limit requirement to use gudppl platform is 6 - 25 years.</li>
                                        <li>Due to legal, health and safety reasons some volunteer activities are available to specific age groups and genders.</li>
                                        <li>Your age and gender will remain private. <br>An organization might ask your age and/or gender when joining their volunteer group or activity. Then, you can choose to share or not.</li>
                                    </ul>
                                </div> -->

                            <!-- <label for="orgName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Name of the University/ School</label><br>
                            <input class="inputt1" type="text" name="orgName" ><br><br>
                            <label for="acaYear" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Acadamic year/ Grade</label><br>
                            <input class="inputt1" type="text" name="acaYear" ><br><br>
                            <label for="schol" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Mention Currently receiving scholarships(Use Commas to break)</label><br>
                            <input class="inputt1" type="text" name="schol"  ><br><br>

                            <div class="studentCreateProfile-horizontal-input">
                                <div class="input-group">
                                    <label for="careType" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Select Caregiver</label><br><br>
                                    <select class="inputt" name="careType" >
                                        <option value="Father" class="dropdown-option">Father</option>
                                        <option value="Mother" class="dropdown-option">Mother</option>
                                        <option value="Guardian" class="dropdown-option">Guardian</option>
                                    </select><br>
                                </div>
                            </div>

                            <label for="careName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Caregiver Name</label><br>
                            <input class="inputt1" type="text" name="careName" ><br><br>
                            <label for="careOccu" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Caregiver Occupation</label><br>
                            <input class="inputt1" type="text" name="careOccu" ><br><br>
                            <label for="careRealat" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Relationship to the Student</label><br>
                            <input class="inputt1" type="text" name="careRealat" ><br><br>

                            <div class="studentCreateProfile-horizontal-input">
                                <div class="input-group">
                                    <label for="letterimg" style="color: rgb(146, 141, 141); margin-top: 30px; margin-bottom: 12px !important;">GS Certificate</label>
                                    <input class="inputt2" type="file" name="letterimg" placeholder="Upload a Photo" >
                                    <p class="para" style="color: rgb(146, 141, 141); margin-top: 5px; margin-bottom: 10px !important;">How to obtain a GS certificate?<br>Click here </p>                                </div>
                                <div class="input-group">
                                    <label for="letterimg" style="color: rgb(146, 141, 141); margin-top: 30px; margin-bottom: 12px !important;">University/ School Letter</label>
                                    <input class="inputt2" type="file" name="letterimg" placeholder="Upload a Photo" >
                                    <p class="para" style="color: rgb(146, 141, 141); margin-top: 5px; margin-bottom: 10px !important;">Upload a letter confirming your enrolment<br>from your University/ school.</p>
                                </div>
                            </div>

                            <div class="studentCreateProfile-horizontal-input">
                                <div class="input-group">
                                    <label for="letterimg" style="color: rgb(146, 141, 141); margin-top: 30px; margin-bottom: 12px !important;">NIC - Front </label>
                                    <input class="inputt2" type="file" name="letterimg" placeholder="Upload a Photo" >
                                </div>
                                <div class="input-group">
                                    <label for="letterimg" style="color: rgb(146, 141, 141); margin-top: 30px; margin-bottom: 12px !important;">NIC - Back </label>
                                    <input class="inputt2" type="file" name="letterimg" placeholder="Upload a Photo" >
                                </div>
                            </div>
                            <p class="para" style="color: rgb(146, 141, 141); margin-top: 5px; margin-bottom: 10px !important;">Upload clear photos of both sides of your National Identity card if the student age is above 16.</p>
                            
                            <label for="accHolderName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Account holder's name</label><br>
                            <input class="inputt1" type="text" name="accHolderName" ><br><br>
                            <label for="bankName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Name of the Bank</label><br>
                            <input class="inputt1" type="text" name="bankName" ><br><br>
                            <label for="branchName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Branch Name</label><br>
                            <input class="inputt1" type="text" name="branchName" ><br><br>
                            <label for="accNumber" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Account Number</label><br>
                            <input class="inputt1" type="text" name="accNumber" ><br><br>
                        </div> -->
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