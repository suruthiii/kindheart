<html>
    <head>
        <title><?php echo SITENAME ?></title>

        <!-- External CSS -->
        <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/studentCreatingProfile4.css">
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
                            <div class="horizontal-input">
                                <div class="input-group">
                                    <label for="letterimg" style="color: rgb(146, 141, 141); margin-top: 30px; margin-bottom: 12px !important;">GS Certificate</label>
                                    <input class="inputt2" type="file" name="letterimg" placeholder="Upload a Photo" required>
                                    <p class="para" style="color: rgb(146, 141, 141); margin-top: 5px; margin-bottom: 10px !important;">How to obtain a GS certificate?<br>Click here </p>
                                </div>
                                <div class="input-group">
                                    <label for="letterimg" style="color: rgb(146, 141, 141); margin-top: 30px; margin-bottom: 12px !important;">University/ School Letter</label>
                                    <input class="inputt2" type="file" name="letterimg" placeholder="Upload a Photo" required>
                                    <p class="para" style="color: rgb(146, 141, 141); margin-top: 5px; margin-bottom: 10px !important;">Upload a letter confirming your enrolment<br>from your University/ school.</p>
                                </div>
                            </div>
                            <div class="horizontal-input">
                                <div class="input-group">
                                    <label for="letterimg" style="color: rgb(146, 141, 141); margin-top: 30px; margin-bottom: 12px !important;">NIC - Front </label>
                                    <input class="inputt2" type="file" name="letterimg" placeholder="Upload a Photo" >
                                </div>
                                <div class="input-group">
                                    <label for="letterimg" style="color: rgb(146, 141, 141); margin-top: 30px; margin-bottom: 12px !important;">NIC - Back </label>
                                    <input class="inputt2" type="file" name="letterimg" placeholder="Upload a Photo" >
                                </div>
                            </div>
                            <p class="para" style="color: rgb(146, 141, 141); margin-top: 5px; margin-bottom: 10px !important;">Upload clear photos of both sides of your National Identity card if the student age is above 16.</p>
                        </div>
                        <div class="button-next">
                            <button class="next">Next</button>
                        </div>
                    </form>
                </div>
            </div>       
        </div>
    </div>