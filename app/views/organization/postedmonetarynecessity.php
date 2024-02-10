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
                <div class="goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <button onclick="location.href='<?php echo URLROOT ?>/organization/choosethenecessityType'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>Posted Monetary Necessities</h3>
                    <p>Last 30 Days</p>
                </div>

                <div class="posted-necessity-pending-table-caption">
                    <p>Pending</p>
                </div>
                <div class="posted-necessity-pending-table-grey-line"></div>

            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <div class="rightside-bar-type-one">
                <div class="right-side-bar">
                    

                </div>
            </div>

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
