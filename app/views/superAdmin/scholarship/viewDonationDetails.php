<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "scholarships";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/scholarship/viewscholarship?scholarship_ID=<?php echo $data['scholarship_ID'] ?>">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Donation</h3>
            <p style="margin-left: 10px">View information about the donations of donors</p>
            
            <div class="necessity-info">
                <table>
                    <tr class="necessity-data">
                        <th width="30%">Student Name</th>
                        <td width="70%"><?php echo $data['donation_details']->studentName ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Updated Month</th>
                        <td width="70%"><?php echo $data['donation_details']->updatedMonth ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Slip Count</th>
                        <td width="70%"><?php echo $data['donation_details']->slipCount ?></td>
                    </tr>
                    <?php if($data['donation_details']->paymentSlip != NULL) {?>
                        <tr class="necessity-data">
                            <th width="30%">Payment Slip</th>
                            <td width="70%">
                                <img src="<?php echo URLROOT ?>/nic/<?php print_r($data['donation_details']->paymentSlip); ?>" class="user-img" alt="">
                            </td>
                        </tr>
                    <?php }?>
                    <?php if($data['donation_details']->verificationStatus == 2) {?>
                        <tr class="necessity-data">
                            <th width="30%">Verification Status</th>
                            <td width="70%">Verified</td>
                        </tr>
                    <?php }

                    else if($data['donation_details']->verificationStatus == 1) {?> 
                        <tr class="necessity-data">
                            <th width="30%">Verification Status</th>
                            <td width="70%">Unverified</td>
                        </tr>
                    <?php } 
                    else if($data['donation_details']->verificationStatus == 0) {?> 
                        <tr class="necessity-data">
                            <th width="30%">Verification Status</th>
                            <td width="70%">Pending</td>
                        </tr>
                    <?php } ?>
                    <tr class="necessity-data">
                            <th width="30%">Acknowledgement</th>
                            <td width="70%"><?php echo $data['donation_details']->acknowledgement ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Acknowledgement Count</th>
                        <td width="70%"><?php echo $data['donation_details']->acknowledgementCount ?></td>
                    </tr>
                </table>
            </div>

            <?php if($data['donation_details']->verificationStatus == 1) {?>
                <div class="view-donation-btn-container">
                    <form action="<?php echo URLROOT ?>/scholarship/verifyslip" method="post" class="delete-form">
                        <input type="text" name="student_ID" id="student_ID" hidden value="<?php echo $_GET['student_ID'] ?>" />
                        <input type="text" name="scholarship_ID" id="scholarship_ID" hidden value="<?php echo $_GET['scholarship_ID'] ?>" />
                        <button type="submit" class="view-donation-btn">
                            Verify Slip
                        </button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
