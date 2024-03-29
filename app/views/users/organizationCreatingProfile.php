<!DOCTYPE html>
<html lang="en">
<head>
    <title>organization Creating Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/registerAndLogin.css" />
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
                <span style="color: rgb(146, 141, 141);">Receive donations for your educational activities</span><br><br><br>     
                <div class="studentCreateProfile-text">
                    <form action="#">
                        <div class="studentCreateProfile-input-field">                            
                            <div class="studentCreateProfile-horizontal-input">
                                <div class="input-group">
                                    <label for="orgType" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Select Type of Organization</label><br>
                                    <select class="inputt" name="orgType" required>
                                        <option value="school" class="dropdown-option">School</option>
                                        <option value="university" class="dropdown-option">University</option>
                                    </select><br>
                                </div>
                            </div>
                            <label for="orgName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Name of the School/ University</label><br>
                            <input class="inputt1" type="text" name="orgName" required><br><br>

                            <div class="studentCreateProfile-horizontal-input">
                                <div class="input-group">
                                    <label for="orgNumber" style="color: rgb(146, 141, 141); margin-top: 30px; margin-bottom: 12px !important;">School Census Number/<br>University Number</label>
                                    <input class="inputt2" type="text" name="orgNumber" required>
                                </div>
                                <div class="input-group">
                                    <label for="letterimg" style="color: rgb(146, 141, 141); margin-top: 30px; margin-bottom: 12px !important;">Letter with a school/<br>university letter head</label>
                                    <input class="inputt2" type="file" name="letterimg" placeholder="Upload a Photo" required>
                                </div>
                            </div>

                            <label for="accHolderName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Account holder's name</label><br>
                            <input class="inputt1" type="text" name="accHolderName" required><br><br>
                            <label for="bankName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Name of the Bank</label><br>
                            <input class="inputt1" type="text" name="bankName" required><br><br>
                            <label for="branchName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Branch Name</label><br>
                            <input class="inputt1" type="text" name="branchName" required><br><br>
                            <label for="accNumber" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Account Number</label><br>
                            <input class="inputt1" type="text" name="accNumber" required><br><br>
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