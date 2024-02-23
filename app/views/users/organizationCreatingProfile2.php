<html>
    <head>
        <title><?php echo SITENAME ?></title>

        <!-- External CSS -->
        <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/organizationCreatingProfile2.css">
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
                            <label for="accHolderName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Account holder's name</label><br>
                            <input class="inputt" type="text" name="accHolderName" required><br>
                            <label for="bankName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Name of the Bank</label><br>
                            <input class="inputt" type="text" name="bankName" required><br>
                            <label for="branchName" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Branch Name</label><br>
                            <input class="inputt" type="text" name="branchName" required><br>
                            <label for="accNumber" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Account Number</label><br>
                            <input class="inputt" type="text" name="accNumber" required><br>
                        </div>
                        <div class="button-next">
                            <button class="next">Next</button>
                        </div>
                    </form>
                </div>
            </div>       
        </div>
    </div>