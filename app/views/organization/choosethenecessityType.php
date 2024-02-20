<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "necessities";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

            <!-- Middle container -->
            <div class="middle-container">
                <!-- Go Back Button -->
                <!-- <div class="goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <button onclick="">Go Back</button>
                </div> -->

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>Choose the<br>necessity type</h3>
                    <p>Select the type of Necessity you want to post</p>
                </div>

                <!-- choose necessity button -->
                <div class="choose-necessity-buttons-container">
                    <div class="choose-necessity-button">
                        <button onclick="location.href ='<?php echo URLROOT ?>/organization/postedmonetarynecessity'">
                            <img src="<?php echo URLROOT ?>/img/icon _Coins_.png">
                            <p>Monetary Funding</p>
                        </button>
                    </div>
                    <div class="choose-necessity-button">
                        <button onclick="location.href ='<?php echo URLROOT ?>/organization/postedphysicalgoodsnecessity'">
                            <img src="<?php echo URLROOT ?>/img/icon _Box Open_.png">
                            <p>Physical Goods</p>
                        </button>
                    </div>
                </div>
                
                <div class="choose-the-type-last-insruction">
                    <p>Physical goods may include : Food Items, Clothing, Stationary etc</p>
                </div>

            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <?php require APPROOT.'/views/inc/components/askonluforneedbar.php'; ?>

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
