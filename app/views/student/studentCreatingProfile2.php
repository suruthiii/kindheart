<html>
    <head>
        <title><?php echo SITENAME ?></title>

        <!-- External CSS -->
        <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/studentCreatingProfile2.css">
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
                            <label for="orgName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Name of the University/ School</label><br>
                            <input class="inputt" type="text" name="orgName" required><br>
                            <label for="acaYear" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Acadamic year/ Grade</label><br>
                            <input class="inputt" type="text" name="acaYear" required><br>
                            <label for="schol" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Mention Currently receiving scholarships(If any)</label><br>
                            <input class="inputt1" type="text" name="schol" required><br>
                        </div>
                        <div class="button-next">
                            <button class="next">Next</button>
                        </div>
                    </form>
                </div>
            </div>       
        </div>
    </div>