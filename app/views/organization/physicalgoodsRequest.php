<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/sidenavbar1.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/askonlyforneeds.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/goback.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/rightcontainerandmiddle.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/fundingrequest.css">
</head>
<body>
    <!-- side navigation bar -->
    <?php require APPROOT.'/views/inc/components/sidenavbar1.php'; ?>
    <!-- right container -->
    <div class="rightcontainer">

        <!-- middle part of the user interface -->
        <div class="rightmiddle">
            <!-- go back icon and link -->
            <div class="gobackandicon">
                <a href="<?php echo URLROOT ?>/organization/necessityRequest" class="links">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <span class="GoBack">Go Back</span>
                </a>
            </div>

            <!-- maintitle and sub title -->
            <div class="maintitle">
                <p>Add Necessities</p>
            </div>
            <div class="subtitle">
                <p>Enter correct information and add your necessities</p>
            </div>

            <!-- form -->
            <form action="#" method="post">
                <div class="lines column">
                    <label for="">Necessity</label>
                    <input type="text" required>
                </div>
                <div class="lines column">
                    <label for="">Requested quantity</label>
                    <input type="text" required>
                </div>
                <div class="textareLine">
                    <label for="">Description</label>
                    <textarea id="message" name="message" required></textarea>
                </div>

                <!-- Add button -->
                <div class="add features">
                    <input type="submit" value="Add" class="addtext">
                </div>
            </form>

        </div>

        <!-- Right side ber that contain a picture and some par -->
        <?php require APPROOT.'/views/inc/components/rightsidebar1.php'; ?>
    </div>

    <!-- js for side navigation bar -->
    <script src="<?php echo URLROOT ?>/js/sidenavbar1.js"></script>

</body>
</html>