<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/sidenavbar1.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/rightsidebar1.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/goback.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/rightcontainerandmiddle.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/necessityrequest.css">
</head>
<body>
    <!-- side navigation bar -->
    <?php require APPROOT.'/views/inc/components/sidenavbar2.php'; ?>
    <!-- right container -->
    <div class="rightcontainer">

        <!-- middle part of the user interface -->
        <div class="rightmiddle">

            <!-- go back icon and link -->
            <div class="gobackandicon">
                <a href="#1" class="links">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <span class="GoBack">Go Back</span>
                </a>
            </div>

            <!-- main and sub title -->
            <div class="MainTitle">
                <p>Request for<br/>Necessities</p>
            </div>
            <div class="instruction">
                <p>Select the type of Necessity you want to post</p>
            </div>

            <!-- two links to for request necessities -->

            <!-- Request for Monetary Funding Button -->
            <a href="<?php echo URLROOT ?>/student/monetoryfundingRequest" class="links">
                <div class="requestButton">
                    <img src="<?php echo URLROOT ?>/img/icon Coins.png">
                    <span class="TextOfButton"><p>Request for Monetary Funding</p></span>
                </div>
            </a>

            <!-- Request for Physical Goods Button -->
            <a href="<?php echo URLROOT ?>/student/physicalgoodsRequest" class="links">
                <div class="requestButton">
                    <img src="<?php echo URLROOT ?>/img/icon Box Open.png">
                    <span class="TextOfButton"><p>Request for Physical Goods</p></span>
                </div>
            </a>

            <!-- Last Instruction -->
            <div class="instruction">
                <p>Physical goods may include : Food Items, Clothing, Stationary etc</p>
            </div>

        </div>
        <!-- Right side ber that contain a picture and some par -->
        <?php require APPROOT.'/views/inc/components/rightsidebar1.php'; ?>
    </div>

    <!-- js for side navigation bar -->
    <script src="<?php echo URLROOT ?>/js/sidenavbar1.js"></script>

</body>
</html>