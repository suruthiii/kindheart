<html>
    <head>
        <title><?php echo SITENAME ?></title>

        <!-- External CSS -->
        <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/donorCreatingProfile2.css">
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
                            <label for="company" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Company</label><br><br>
                            <input class="inputt" type="text" name="company" required><br><br>
                            <label for="regNo" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Registration Number</label><br><br>
                            <input class="inputt" type="text" name="regNo" required><br><br>
                        </div>
                        <div class="button-next">
                            <button class="next">Next</button>
                        </div>
                    </form>
                </div>
            </div>       
        </div>
    </div>