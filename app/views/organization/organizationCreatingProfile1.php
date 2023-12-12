<html>
    <head>
        <title><?php echo SITENAME ?></title>

        <!-- External CSS -->
        <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/organizationCreatingProfile1.css">
    </head>
    <body>


<div class="container">
        <div class="image">
            <img src="images/welcom.jpg" alt="Welcome_Image" id="welcome">
        </div>
        <div class="formc">
            <div class="formce">
                <img src="images/logo.png" alt="Logo_Image" id="logo">
            
                <h1>Creating Profile</h1>
                <span style="color: rgb(146, 141, 141);">Provide donations for their educational success</span><br><br><br>     
                <div class="text">
                    <form action="#">
                        <div class="input-field">
                            <label for="orgType" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Select Type of Organization</label><br><br>
                            <select class="inputt" name="orgType" required>
                                <option value="school" class="dropdown-option">School</option>
                                <option value="university" class="dropdown-option">University</option>
                            </select><br><br>
                            <label for="orgName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Name of the School/ University</label><br><br>
                            <input class="inputt1" type="text" name="orgName" required><br><br>
                            <div class="horizontal-input">
                                <div class="input-group">
                                    <label for="orgNumber" style="color: rgb(146, 141, 141); margin-top: 30px; margin-bottom: 12px !important;">School Census Number/<br>University Number</label>
                                    <input class="inputt2" type="text" name="orgNumber" required>
                                </div>
                                <div class="input-group">
                                    <label for="letterimg" style="color: rgb(146, 141, 141); margin-top: 30px; margin-bottom: 12px !important;">Letter with a school/<br>university letter head</label>
                                    <input class="inputt2" type="file" name="letterimg" placeholder="Upload a Photo" required>
                                </div>
                            </div>
                        </div>
                        <div class="button-next">
                            <button class="next">Next</button>
                        </div>
                    </form>
                </div>
            </div>       
        </div>
    </div>