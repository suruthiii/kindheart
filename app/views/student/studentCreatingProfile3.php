<html>
    <head>
        <title><?php echo SITENAME ?></title>

        <!-- External CSS -->
        <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/studentCreatingProfile3.css">
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
                <span style="color: rgb(146, 141, 141);">Receive donations for your educational activities</span><br><br><br>     
                <div class="text">
                    <form action="#">
                        <div class="input-field">
                            <label for="careType" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Select Caregiver</label><br><br>
                            <select class="inputt" name="careType" required>
                                <option value="Father" class="dropdown-option">Father</option>
                                <option value="Mother" class="dropdown-option">Mother</option>
                                <option value="Guardian" class="dropdown-option">Guardian</option>
                            </select><br>

                            <label for="careName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Caregiver Name</label><br>
                            <input class="inputt1" type="text" name="careName" required><br><br>
                            <label for="careOccu" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Caregiver Occupation</label><br>
                            <input class="inputt1" type="text" name="careOccu" required><br><br>
                            <label for="careRealat" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Relationship to the Student</label><br>
                            <input class="inputt1" type="text" name="careRealat" required><br><br>                       
                        </div>
                        <div class="button-next">
                            <button class="next">Next</button>
                        </div>
                    </form>
                </div>
            </div>       
        </div>
    </div>