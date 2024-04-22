<html>
    <head>
        <title><?php echo SITENAME ?></title>

        <!-- External CSS -->
        <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/studentCreatingProfile1.css">
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
                            <div class="horizontal-input">
                                <div class="input-group">
                                    <label for="firstName" style="color: rgb(146, 141, 141); margin-top: 25px; margin-bottom: 12px !important;">First Name</label>
                                    <input class="inputt2" type="text" name="firstName" required>
                                </div>
                                <div class="input-group">
                                    <label for="lastName" style="color: rgb(146, 141, 141); margin-top: 25px; margin-bottom: 12px !important;">Last Name</label>
                                    <input class="inputt2" type="text" name="lastName" required>
                                </div>
                            </div>
                            
                            <label for="address" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Address</label><br>
                            <input class="inputt1" type="text" name="address" required><br><br>
                            <label for="gender" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Gender</label><br>
                            <input class="inputt1" type="text" name="gender" required><br><br>

                            <label for="orgType" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Select Type of Student</label><br><br>
                            <select class="inputt" name="orgType" required>
                                <option value="school" class="dropdown-option">School Student</option>
                                <option value="university" class="dropdown-option">University Student</option>
                            </select><br>
                        </div>
                        <div class="button-next">
                            <button class="next">Next</button>
                        </div>
                    </form>
                </div>
            </div>       
        </div>
    </div>