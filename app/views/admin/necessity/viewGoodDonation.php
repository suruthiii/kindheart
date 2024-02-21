<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "necessities"; ?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/necessity/viewAdminGood">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Donations</h3>
            <p style="margin-left: 10px">View information about the donations received</p>

            <div class="necessity-content">
                <h4>Stationary</h4>
                <p>80 Page CR Book</p>
            </div>

            <div class="necessity-donation-info">
                <table>
                    <tr class="donation-details-heading">
                        <th>Donor Name</th>
                        <th>Quantity</th>
                    </tr>
                    <tr class="donation-details">
                        <td>Lizzie Mayor</td>
                        <td>3</td>
                    </tr>
                    <tr class="donation-details">
                        <td>Lizzie Mayor</td>
                        <td>3</td>
                    </tr>
                    <tr class="donation-details">
                        <td>Lizzie Mayor</td>
                        <td>3</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>

            