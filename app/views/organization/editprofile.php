<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/sidenavbar.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/askonlyforneeds.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/goback.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/rightcontainerandmiddle.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/formandtitles.css">
</head>
<body>
    <!-- side navigation bar -->
    <?php $section = "editprofile";?>
    <?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

    <!-- right container -->
    <div class="rightcontainersecond">
        <!-- go back icon and link -->
        <div class="gobackandicon">
            <a href="<?php echo URLROOT ?>/organization/editprofile" class="links">
                <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                <span class="GoBack">Go Back</span>
            </a>
        </div>

        <!-- maintitle and sub title -->
        <div class="maintitle">
            <p>Edit Profile</p>
        </div>
        <div class="subtitle">
            <p>Edit your Profile Details</p>
        </div>

        <!-- form -->
        <form action="#" method="post">
        <!-- Type of the organization -->
        <div class="lines1 column">
            <label for="">Type of the organization</label>
            <input type="text" required>
        </div>
        <!-- Name of the Organization -->
        <div class="lines1 column">
            <label for="">Name of the Organization</label>
            <input type="text" required>  
        </div>
        <!-- Address -->
        <div class="textareLine1">
            <label for="">Address</label>
            <textarea id="address" name="address" required></textarea>
        </div>
        <!-- Mobile Number -->
        <div class="lines1 column">
            <label for="">Mobile Number</label>
            <input type="tel" required>  
        </div>
        <div class="secondtitle">
            <p>Bank Details</p>
        </div>
        <!-- Account holder’s name -->
        <div class="lines1 column">
            <label for="">Account holder’s name</label>
            <input type="text" required>
        </div>
        <!-- Name of the Bank -->
        <div class="lines1 column">
            <label for="">Name of the Bank</label>
            <input type="text" required>  
        </div>
        <!-- Branch Name -->
        <div class="lines1 column">
            <label for="">Branch Name</label>
            <input type="text" required>  
        </div>
        <!-- Account Number -->
        <div class="lines1 column">
            <label for="">Account Number</label>
            <input type="text" required>  
        </div>
        <!-- Add button -->
            <div class="add">
                <input type="submit" value="Save Changes" class="addtext1">
            </div>
        </form>
        
    </div>

</body>
</html>