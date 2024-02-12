<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Creating Profile</title>
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
                <span style="color: rgb(146, 141, 141);">5 of 6</span><br> <br>  
                <div class="studentCreateProfile-text shared-text shared-label">
                    <form action="<?php echo URLROOT ?>/users/studentOrganizationCreatingProfile2" method="GET">
                        <div class="studentCreateProfile-input-field">
                            
                            <label for="accHolderName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Account holder's name</label><br>
                            <input class="inputt1" type="text" name="accHolderName" ><br><br>
                            <label for="bankName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Name of the Bank</label><br>
                            <input class="inputt1" type="text" name="bankName" ><br><br>
                            <label for="branchName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Branch Name</label><br>
                            <input class="inputt1" type="text" name="branchName" ><br><br>
                            <label for="accNumber" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Account Number</label><br>
                            <input class="inputt1" type="text" name="accNumber" ><br><br>
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