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
                <span style="color: rgb(146, 141, 141);">2 of 6</span><br><br><br>     
                <div class="studentCreateProfile-text  shared-text shared-label">
                    <form action="<?php echo URLROOT ?>/users/studentCreatingProfile3" method="GET">
                        <div class="studentCreateProfile-input-field ">
                            
                            <label for="orgName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Name of the University/ School</label><br>
                            <input class="inputt1" type="text" name="orgName" ><br><br>
                            <label for="acaYear" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Acadamic year/ Grade</label><br>
                            <input class="inputt1" type="text" name="acaYear" ><br><br>
                            <label for="schol" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Mention Currently receiving scholarships(Use Commas to break)</label><br>
                            <input class="inputt1" type="text" name="schol"  ><br><br>
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