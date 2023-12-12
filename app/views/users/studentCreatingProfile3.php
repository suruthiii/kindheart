<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Profile Creation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/registerAndLogin.css" />
</head>
<body>
    <div class="container">
        <div class="image">
            <img src="<?php echo URLROOT?>/img/setps.jpg" alt="Set Password" id="registerAndLogin">
        </div>
        <div class="studentProfile3-formc shared-formc">
            <div class="studentProfile3-formce shared-formce">
                <img src="<?php echo URLROOT?>/img/logo.jpg" alt="Logo_Image" id="logo">
            
                <h1>Privacy Preferences</h1>
                <span style="color: rgb(146, 141, 141);">Select the details you want to show in your profile</span>     
                <div class="studentProfile3-text shared-text">
                    <form action="#">
                        <div class="studentProfile3-checkboxes shared-margin">
                            <div class="box">
                                <label class="labels">
                                    <input class="inputt" type="checkbox" checked="checked" name="remember"> Name
                                </label>
                            </div>
                            <div class="box">
                                <label class="labels">
                                    <input class="inputt" type="checkbox" name="remember"> Address
                                </label>
                            </div>
                            <div class="box">
                                <label class="labels">
                                    <input class="inputt" type="checkbox" name="remember"> Parent/Guardian Details
                                </label>
                            </div>
                            <div class="box">
                                <label class="labels">
                                    <input class="inputt" type="checkbox" name="remember"> School/University name
                                </label>
                            </div>
                            <div class="box">
                                <label class="labels">
                                    <input class="inputt" type="checkbox" name="remember"> Bank Details
                                </label>
                            </div>
                            <div class="box">
                                <label class="labels">
                                    <input class="inputt" type="checkbox" name="remember"> Mobile Number
                                </label>
                            </div>               
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