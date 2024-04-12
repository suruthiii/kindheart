<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "donations";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="donor-right-side-container">

            <!-- Middle container -->
            <div class="donor-middle-container">
                <!-- Go Back Button -->
                <!-- <div class="goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <button onclick="">Go Back</button>
                </div> -->

                <!-- main title -->
                <div class="donor-middle-container-title-typeone">
                    <h3>Post Donations</h3>
                    <p>Select the type of donation you want to post</p>
                </div>

                <!-- choose necessity button -->
                <div class="choose-benefaction-buttons-container">
                    <div class="choose-benefaction-button">
                        <button onclick="location.href ='<?php echo URLROOT ?>/benefaction/postedBenefactions'">
                            <img src="<?php echo URLROOT ?>/img/icon _Coins_.png">
                            <p>Benefaction</p>
                        </button>
                    </div>
                    <div class="choose-benefaction-button">
                        <button onclick="location.href ='<?php echo URLROOT ?>/benefaction/postedScholarships'">
                            <img src="<?php echo URLROOT ?>/img/icon _Box Open_.png">
                            <p>Scholarship</p>
                        </button>
                    </div>
                </div>
            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <?php require APPROOT.'/views/inc/components/askonluforneedbar.php'; ?>

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
