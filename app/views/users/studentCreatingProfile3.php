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
                <span style="color: rgb(146, 141, 141);">3 of 6</span><br>   
                <div class="studentCreateProfile-text shared-text shared-label">
                    <form action="<?php echo URLROOT ?>/users/studentCreatingProfile3" method="POST">
                        <div class="studentCreateProfile-input-field shared-margin2">

                            <div class="studentCreateProfile-horizontal-input">
                                <div class="input-group">
                                    <label for="careType" style="color: rgb(146, 141, 141); margin-bottom: 5px !important;">Select Caregiver</label>
                                    <select class="inputt" name="careType" id="careType" value="<?php echo $data['careType']; ?>">
                                        <option value="Father" class="dropdown-option">Father</option>
                                        <option value="Mother" class="dropdown-option">Mother</option>
                                        <option value="Guardian" class="dropdown-option">Guardian</option>
                                    </select>
                                    <span class="error-message"><?php echo $data['careType_err']; ?></span>
                                </div>
                            </div>

                            <label for="careName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Caregiver Name</label><br>
                            <input class="inputt1" type="text" name="careName" value="<?php echo $data['careName']; ?>"><br><br>
                            <span class="error-message"><?php echo $data['careName_err']; ?></span>

                            <label for="careOccu" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Caregiver Occupation</label><br>
                            <input class="inputt1" type="text" name="careOccu" value="<?php echo $data['careOccu']; ?>"><br><br>
                            <span class="error-message"><?php echo $data['careOccu_err']; ?></span>

                            <label for="careRealat" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Relationship to the Student</label><br>
                            <input class="inputt1" type="text" name="careRealat" id="careRealat" value="<?php echo $data['careRealat']; ?>" disabled><br><br>
                            <span class="error-message"><?php echo $data['careRealat_err']; ?></span>
                        </div>
                        <div class="button-next">
                           
                                <button class="next shared-button2">Next</button>
                            
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