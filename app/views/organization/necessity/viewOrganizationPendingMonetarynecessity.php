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
                    <button onclick="location.href='<?php echo URLROOT ?>/necessity/monetary'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>View Necessity</h3>
                    <p>View information about posted necessity and the donation received.</p>
                </div>

                <!-- <p style="margin-top: 30%;">Necessity ID: <?php echo $data['pendingNecessityDetails']->necessityID; ?></p> -->

                <table class="posted-necessity-view-tables-forpending-and-complete" style="margin: 15%;">
                    <tr>
                        <td>Necessity Name</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                    </tr>
                    <tr>
                        <td>Requested amount</td>
                    </tr>
                    <tr>
                        <td>Received amount</td>
                    </tr>
                    <tr>
                        <td>amountdue</td>
                    </tr>
                    <tr>
                        <td>Start date</td>
                    </tr>
                    <tr>
                        <td>End date</td>
                    </tr>
                    <tr>
                        <td>frequency</td>
                    </tr>
                </table>


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
