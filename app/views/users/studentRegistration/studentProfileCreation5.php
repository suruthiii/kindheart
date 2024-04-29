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
        <div class="studentProfileCreation5-container">
            <div class="studentProfileCreation5-inner-container">
                <div class="studentProfileCreation5-inner-container-logo">
                    <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
                </div>
                <div class="studentProfileCreation5-inner-container-caption">
                    <h1>Creating Profile</h1>
                    <span>5 of 6</span> 
                </div>
                <div class="studentProfileCreation5-inner-container-form-container">
                    <form action="<?php echo URLROOT ?>/users/studentProfileCreation4" method="GET">
                        <div class="studentProfileCreation5-inner-container-form-container-inputfeilds">   

                            <label for="accHolderName">Account Holder's Name</label>
                            <div class="studentProfileCreation5-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt1" type="text" name="accHolderName" value="<?php echo $data['accHolderName']?>" >
                                <p class="error-message" for="accHolderName"><?php echo $data['accHolderName_err']?></p>
                            </div>

                            <label for="accNumber">Account Number</label>
                            <div class="studentProfileCreation5-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt1" type="text" name="accNumber" value="<?php echo $data['accNumber']?>" >
                                <p class="error-message" for="accNumber"><?php echo $data['accNumber_err']?></p>
                            </div>

                            <label for="bankName">Name of the Bank</label>
                            <div class="studentProfileCreation5-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt1" type="text" name="bankName" value="<?php echo $data['bankName']?>" >
                                <p class="error-message" for="bankName"><?php echo $data['bankName_err']?></p>
                            </div>

                            <label for="branchName">Branch Name</label>
                            <div class="studentProfileCreation5-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt1" type="text" name="branchName" value="<?php echo $data['branchName']?>" >
                                <p class="error-message" for="branchName"><?php echo $data['branchName_err']?></p>
                            </div>

                        </div>
                        <div class="studentProfileCreation5-inner-container-form-container-buttons">
                            <button>Next</button>
                        </div>
                    </form>
                </div>             
            </div>            
        </div>
    </div>
</body>
</html>