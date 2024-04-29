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
        <div class="studentProfileCreation2-container">
            <div class="studentProfileCreation2-inner-container">
                <div class="studentProfileCreation2-inner-container-logo">
                    <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
                </div>
                <div class="studentProfileCreation2-inner-container-caption">
                    <h1>Creating Profile</h1>
                    <span>2 of 7</span> 
                </div>
                <div class="studentProfileCreation2-inner-container-form-container">
                    <form action="<?php echo URLROOT ?>/users/studentProfileCreation2" method="GET">
                        <div class="studentProfileCreation2-inner-container-form-container-inputfeilds">   

                            <label for="orgName">Name of the University / School</label>
                            <div class="studentProfileCreation2-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt1" type="text" name="orgName" value="<?php echo $data['orgName']?>" required>
                                <p class="error-message" for="orgName"><?php echo $data['orgName_err']?></p>
                            </div>

                            <label for="acaYear">Acadamic year/ Grade</label>
                            <div class="studentProfileCreation2-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt1" type="text" name="acaYear" value="<?php echo $data['acaYear']?>" required>
                                <p class="error-message" for="acaYear"><?php echo $data['acaYear_err']?></p>
                            </div>

                            <label for="schol">Mention Currently receiving scholarships(Use Commas to break)</label>
                            <div class="studentProfileCreation2-inner-container-form-container-inputfeilds-feild1">
                                <input class="inputt1" type="text" name="schol" value="<?php echo $data['schol']?>" required>
                                <p class="error-message" for="schol"><?php echo $data['schol_err']?></p>
                            </div>

                        </div>
                        <div class="studentProfileCreation2-inner-container-form-container-buttons">
                            <button>Next</button>
                        </div>
                    </form>
                </div>             
            </div>            
        </div>
    </div>
</body>
</html>