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
        <div class="studentProfileCreation4-container">
            <div class="studentProfileCreation4-inner-container">
                <div class="studentProfileCreation4-inner-container-logo">
                    <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
                </div>
                <div class="studentProfileCreation4-inner-container-caption">
                    <h1>Creating Profile</h1>
                    <span>4 of 6</span> 
                </div>
                <div class="studentProfileCreation4-inner-container-form-container">
                    <form action="<?php echo URLROOT ?>/users/studentProfileCreation2" method="POST">
                        <div class="studentProfileCreation4-inner-container-form-container-inputfeilds">   
                            <div class="studentProfileCreation4-inner-container-form-container-inputfeilds-2-input-horizontal">
                                <div class="studentProfileCreation4-inner-container-form-container-inputfeilds-2-input-horizontal-input1">
                                    <label>GS Certificate</label>
                                    <label class="studentProfileCreation4-inner-container-form-container-inputfeilds-2-input-horizontal-input1-letterbox">
                                        <p>Upload a Photo</p>
                                        <input type="file" id="letterimage1" name="letterimage1" accept="image/png, image/jpeg, image/jpg" onchange="handleImageType(this)" style="display:none;" />
                                    </label> 
                                </div>
                                <div class="studentProfileCreation4-inner-container-form-container-inputfeilds-2-input-horizontal-input2">
                                    <label>GS Certificate</label>
                                    <label class="studentProfileCreation4-inner-container-form-container-inputfeilds-2-input-horizontal-input1-letterbox">
                                        <p>Upload a Photo</p>
                                        <input type="file" id="letterimage2" name="letterimage2" accept="image/png, image/jpeg, image/jpg" onchange="handleImageType(this)" style="display:none;" />
                                    </label> 
                                </div>
                            </div>  

                            <div class="studentProfileCreation4-inner-container-form-container-inputfeilds-2-input-horizontal">
                                <div class="studentProfileCreation4-inner-container-form-container-inputfeilds-2-input-horizontal-input3">
                                    <label>NIC - front</label>
                                    <label class="studentProfileCreation4-inner-container-form-container-inputfeilds-2-input-horizontal-input1-letterbox">
                                        <p>Upload a Photo</p>
                                        <input type="file" id="letterimage3" name="letterimage3" accept="image/png, image/jpeg, image/jpg" onchange="handleImageType(this)" style="display:none;" />
                                    </label> 
                                </div>
                                <div class="studentProfileCreation4-inner-container-form-container-inputfeilds-2-input-horizontal-input4">
                                    <label>NIC - back</label>
                                    <label class="studentProfileCreation4-inner-container-form-container-inputfeilds-2-input-horizontal-input1-letterbox">
                                        <p>Upload a Photo</p>
                                        <input type="file" id="letterimage4" name="letterimage4" accept="image/png, image/jpeg, image/jpg" onchange="handleImageType(this)" style="display:none;" />
                                    </label> 
                                </div>
                            </div>  
                            <div class="studentProfileCreation4-inner-container-form-container-buttons">
                                <button>Next</button>
                            </div>
                        </div>
                    </form>
                </div>             
            </div>            
        </div>
    </div>

    <script>
        function handleImageType(input) {
            const parentLabel = input.parentElement;
            const parentDiv = parentLabel.parentElement;

            // Get the file from the input element
            const file = input.files[0];

            // Check if file type is valid (starts with 'image/')
            if (file && file.type.startsWith('image/')) {
                // Apply styling to the parent label (add-benefaction-box)
                parentLabel.style.border = '1px solid red';
                parentLabel.style.backgroundColor = 'rgb(249, 224, 209)';
                parentLabel.style.color = 'rgb(213, 83, 7)';
            } else {
                // Apply default styling to the parent label (add-benefaction-box)
                parentLabel.style.border = '1px dashed red';
                parentLabel.style.backgroundColor = 'white';
                parentLabel.style.color = 'rgb(255, 0, 0)';
            }
        }


        // Form validation function
        function validateForm() {
            var fileInputs = document.querySelectorAll('input[type="file"]');
            var errorMessage = '';

            fileInputs.forEach(function(input) {
                var fileName = input.value;
                if (fileName) {
                    var fileExtension = fileName.split('.').pop().toLowerCase();
                    var acceptedExtensions = ['png', 'jpg', 'jpeg'];
                    if (acceptedExtensions.indexOf(fileExtension) === -1) {
                        errorMessage = 'Please upload a PNG, JPG, or JPEG file.';
                        return false;
                    }
                }
            });

            if (errorMessage) {
                alert(errorMessage);
                return false;
            }

            return true;
        }
    </script>
</body>
</html>