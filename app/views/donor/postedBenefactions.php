<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "necessities";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="donor-right-side-container">

            <!-- Middle container -->
            <div class="donor-middle-container">
                <!-- Go Back Button -->
                <div class="donor-goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <button onclick="location.href='<?php echo URLROOT ?>/donor/donorPostDonations'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="donor-middle-container-title-typeone">
                    <h3>Posted Monetary Necessities</h3>
                    <p>Last 30 Days</p>
                </div>

                <!-- Pending table -->
                <div class="posted-benefaction-pending-table-caption">
                    <p>Pending</p>
                </div>
                <div class="posted-benefaction-pending-table-grey-line"></div>
                <div class="posted-benefactions-pending-table">
                    <table>
                        <tr>
                            <td><img src="<?php echo URLROOT ?>/img/house.png"></td>
                            <td><h4>Stationary</h4><p>80 Pages CR books</p></td>
                            <td></td>
                            <td><p>Rs. 2000,00</p></td>
                        </tr>
                        <tr>
                            <td><img src="<?php echo URLROOT ?>/img/house.png"></td>
                            <td><h4>Stationary</h4><p>80 Pages CR books</p></td>
                            <td></td>
                            <td><p>Rs. 2000,00</p></td>
                        </tr>
                        <tr>
                            <td><img src="<?php echo URLROOT ?>/img/house.png"></td>
                            <td><h4>Stationary</h4><p>80 Pages CR books</p></td>
                            <td></td>
                            <td><p>Rs. 2000,00</p></td>
                        </tr>
                        <tr>
                            <td><img src="<?php echo URLROOT ?>/img/house.png"></td>
                            <td><h4>Stationary</h4><p>80 Pages CR books</p></td>
                            <td></td>
                            <td><p>Rs. 2000,00</p></td>
                        </tr>
                    </table>
                </div>

                <!-- Completed Table -->
                <div class="posted-benefaction-Completed-table-caption">
                    <p>Completed</p>
                </div>
                <div class="posted-benefaction-Completed-table-grey-line"></div>
                <div class="posted-benefactions-Completed-table">
                    <table>
                        <tr>
                            <td><img src="<?php echo URLROOT ?>/img/house.png"></td>
                            <td><h4>Stationary</h4><p>80 Pages CR books</p></td>
                            <td></td>
                            <td><p>Rs. 2000,00</p></td>
                        </tr>
                        <tr>
                            <td><img src="<?php echo URLROOT ?>/img/house.png"></td>
                            <td><h4>Stationary</h4><p>80 Pages CR books</p></td>
                            <td></td>
                            <td><p>Rs. 2000,00</p></td>
                        </tr>
                        <tr>
                            <td><img src="<?php echo URLROOT ?>/img/house.png"></td>
                            <td><h4>Stationary</h4><p>80 Pages CR books</p></td>
                            <td></td>
                            <td><p>Rs. 2000,00</p></td>
                        </tr>
                        <tr>
                            <td><img src="<?php echo URLROOT ?>/img/house.png"></td>
                            <td><h4>Stationary</h4><p>80 Pages CR books</p></td>
                            <td></td>
                            <td><p>Rs. 2000,00</p></td>
                        </tr>
                    </table>
                </div>

                <div class="add-benefaction-button-for-post">
                    <button onclick="location.href='<?php echo URLROOT ?>/organization/addmonetarynecessity'">
                        <img src="<?php echo URLROOT ?>/img/Plus.png">
                        <h5>Add Benefactions</h5>
                    </button>
                </div>

            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <?php require APPROOT.'/views/inc/components/askonluforneedbar.php'; ?>

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
