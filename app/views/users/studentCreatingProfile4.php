<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Creating Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/registerAndLogin.css" />

    <style>
        .fileUpload {
            border-radius: 3px;
            cursor: pointer;
            border: 1px solid #acacac;
            background-image: url('<?php echo URLROOT?>/img/Upload_a_photo.png');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image">
            <img src="<?php echo URLROOT?>/img/welcom.jpg" alt="Welcome_Image" id="registerAndLogin">
        </div>
        <div class="studentCreateProfile-formc shared-formc">
            <div class="studentCreateProfile-formce shared-formce">
                <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
            
                <h1>Creating Profile</h1>
                <span style="color: rgb(146, 141, 141);">4 of 6</span><br>   
                <div class="studentCreateProfile-text shared-text shared-label">
                    <form action="<?php echo URLROOT ?>/users/studentCreatingProfile5" method="GET">
                        <div class="studentCreateProfile-input-field shared-input shared-margin2">
                            <div class="studentCreateProfile-horizontal-input">
                                <div class="input-group">
                                    <label for="letterimg" style="color: rgb(146, 141, 141); margin-top: 50px; margin-bottom: 12px !important;">GS Certificate</label>
                                    <button class="fileUpload"><input class="inputt2" type="file" name="letterimg" placeholder="Upload a Photo" ></button>
                                    <p class="para" style="color: rgb(146, 141, 141); margin-top: 5px; margin-bottom: 10px !important;">How to obtain a GS certificate?<br>Click here </p>                                
                                </div>
                                <div class="input-group">
                                    <label for="letterimg" style="color: rgb(146, 141, 141); margin-top: 50px; margin-bottom: 12px !important;">University/ School Letter</label>
                                    <button class="fileUpload"><input class="inputt2" type="file" name="letterimg" placeholder="Upload a Photo" ></button>
                                    <p class="para" style="color: rgb(146, 141, 141); margin-top: 5px; margin-bottom: 10px !important;">Upload a letter confirming your enrolment<br>from your University/ school.</p>
                                </div>
                            </div>
                            <br>

                            <div class="studentCreateProfile-horizontal-input">
                                <div class="input-group">
                                    <label for="letterimg" style="color: rgb(146, 141, 141); margin-top: 30px; margin-bottom: 12px !important;">NIC - Front </label>
                                    <button class="fileUpload"><input class="inputt2" type="file" name="letterimg" placeholder="Upload a Photo" ></button>
                                </div>
                                <div class="input-group">
                                    <label for="letterimg" style="color: rgb(146, 141, 141); margin-top: 30px; margin-bottom: 12px !important;">NIC - Back </label>
                                    <button class="fileUpload"><input class="inputt2" type="file" name="letterimg" placeholder="Upload a Photo" ></button>
                                </div>
                            </div>
                            <p class="para" style="color: rgb(146, 141, 141); margin-top: 5px; margin-bottom: 10px !important;">Upload clear photos of both sides of your National Identity card if the student age is above 16.</p>
                            
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