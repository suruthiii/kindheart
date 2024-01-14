<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/sidenavbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/askonlyforneeds.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/goback.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/rightcontainerandmiddle.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/fundingrequest.css">
</head>
<body>
    <!-- side navigation bar -->
    <?php $section = "necessities";?>
    <?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

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
                <p>Add Monetary Necessities</p>
            </div>
            <div class="subtitle">
                <p>Enter correct information and add your necessities</p>
            </div>

            <!-- form -->
            <form action="#" method="post">
                <div class="lines">

                    <!-- Necessity -->
                    <div class="firstbox">
                        <label for="">Necessity</label>
                        <input type="text" required>
                    </div>
                    <!-- Necessity Type -->
                    <div class="secondbox">
                        <label for="">Necessity Type</label>
                        <select id="necessityType" name="necessityType" required>
                            <option value="Recurring" selected>Recurring</option>
                            <option value="hr">One-Time</option>
                        </select>
                    </div>
                </div>
                <div class="lines">
                    <!-- Start Date(if recurring) -->
                    <div class="thirdbox">
                        <label for="">Start Date(if recurring)</label>
                        <input type="date" required>
                    </div>
                    <!-- End Date(if recurring) -->
                    <div class="fourthbox">
                        <label for="">End Date(if recurring)</label>
                        <input type="date"required>
                    </div>
                </div>
                <!-- Description -->
                <div class="lines column">
                    <label for="">Description</label>
                    <input type="text" required>
                </div>
                <!-- Requested Amount in Rupees -->
                <div class="lines column">
                    <label for="">Requested Amount in Rupees</label>
                    <input type="text" required>  
                </div>

                <!-- Add button -->
                <div class="add">
                    <input type="submit" value="Add" class="addtext">
                </div>
            </form>

        </div>

        <!-- Right side ber that contain a picture and some par -->
        <?php require APPROOT.'/views/inc/components/rightsidebar1.php'; ?>
    </div>

</body>
</html>