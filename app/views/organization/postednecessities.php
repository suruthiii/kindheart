<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/tablesandbutton.css">
    <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/rightsidebar2.css">
</head>
<body>
    <!-- side navigation bar -->
    <?php $section = "necessities";?>
    <?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

    <!-- right container -->
    <div class="rightcontainer">
        <!-- search bar and the notification icon -->
        <div class="searchbarandnotification">
            <!-- searchbar -->
            <div class="searchbar">
                <form action="" method="post">
                    <input type="text" placeholder="Search">
                    <button type="submit"><img src="<?php echo URLROOT ?>/img/filter.png" alt="Image1" class="buttonImage"></button>
                </form>
            </div>
            <!-- notificationbar -->
            <div class="notification">
                <button type="submit"><img src="<?php echo URLROOT ?>/img/bell-1.png" alt="bell"></button>
            </div>
                
        </div>
        
        <!-- second right side under the search and notification icon -->
        <div class="rightside">
            <!-- middle of the page -->
            <div class="middleofrightside">
                <!-- Main title of the page -->
                <div class="maintitle">
                    <p>Posted Necessities</p>
                </div>
                <!-- subtitle/under main title text -->
                <div class="subtitle1">
                    <p>Last 30 days</p>
                </div>

                <!-- For the Pending table -->
                <div class="subtitle2">
                    <p>Pending</p>
                </div>

                <!-- vertical line -->
                <div class="verticalline1"></div>

                <!-- pending table -->
                <div class="pendingtable">
                    
                </div>

                <!-- For the completed table -->
                <div class="subtitle3">
                    <p>Completed</p>
                </div>

                <!-- vertical line -->
                <div class="verticalline2"></div>

                <!-- Completed table -->
                <div class="completedtable">

                </div>

                <!-- Add Necessities button -->
                <div class="addbutton">
                    <button type="button" onclick="location.href='<?php echo URLROOT ?>/organization/necessityRequest'">
                        <img src="<?php echo URLROOT ?>/img/Plus.png" alt="Plus">
                        <p>Add Necessities</p>
                    </button>
                </div>

            </div>

            <!-- right side bar about show details -->
            <div class="rightsidebarbox">

                <div class="detailsbox">

                </div>

                <div class="detailsbox">
                    
                </div>

                <div class="detailsbox">
                    
                </div>

                
                
                <!-- learnmore -->
                <div class="learnmore">
                    <!-- images -->
                    <div class="images">
                        <div class="image1">
                            <img src="<?php echo URLROOT ?>/img/Illustration(1).png" alt="Image1">
                        </div>
                        <div class="image2">
                            <img src="<?php echo URLROOT ?>/img/Illustration.png" alt="Image2">
                        </div>
                    </div>

                    <!-- Discription title -->
                    <div class="discriptiontitle">
                        <p>Tips to get more Donations</p>
                    </div>
                    <!-- Discription -->
                    <div class="discription">
                        <p>Complete your profile by adding 
                            your success stories. 
                            Make it easier for the donors 
                            to see what you do with their 
                            good money.
                        </p>
                    </div>

                    <!-- Learnmorebutton -->
                    <div class="Learnmore">
                    <button type="button" onclick="location.href='#learnmore'">
                        <p>Learn More</p>
                    </button>
                </div>
                </div>


            </div>
        </div>

    </div>  

</body>
</html>