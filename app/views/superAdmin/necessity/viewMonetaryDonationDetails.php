<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "necessities";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/necessity/viewmonetary?necessity_ID=<?php echo $data['necessity_ID'] ?>">
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
                    <?php if($data['necessity_type'] == 'onetime') {?>
                        <tr class="necessity-data">
                            <th width="30%">Donor Name</th>
                            <td width="70%"><?php echo $data['donation_details']->donorName ?></td>
                        </tr>
                        
                        <tr class="necessity-data">
                            <th width="30%">Donated Amount</th>
                            <td width="70%">Rs.&nbsp;<?php echo $data['donation_details']->amount ?>.00</td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Payment Slip</th>
                            <td width="70%">
                                <img src="<?php echo URLROOT ?>/nic/<?php print_r($data['donation_details']->paymentSlip); ?>" class="user-img" alt="">
                            </td>
                        </tr>
                        <?php if($data['donation_details']->verificationStatus == 2) {?>
                            <tr class="necessity-data">
                                <th width="30%">Verification Status</th>
                                <td width="70%">Verified</td>
                            </tr>
                            <tr class="necessity-data">
                                <th width="30%">Acknowledgement</th>
                                <td width="70%"><?php echo $data['donation_details']->acknowledgement ?></td>
                            </tr>
                        <?php }

                        else if($data['donation_details']->verificationStatus == 1) {?> 
                            <tr class="necessity-data">
                                <th width="30%">Verification Status</th>
                                <td width="70%">Unverified</td>
                            </tr>
                        <?php } ?>
                        
                    <?php }

                    else if($data['necessity_type'] == 'recurring') {?> 
                        <tr class="necessity-data">
                            <th width="30%">Donor Name</th>
                            <td width="70%"><?php echo $data['donation_details']->donorName ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Updated Month</th>
                            <td width="70%"><?php echo $data['donation_details']->updatedMonth ?></td>
                        </tr>

                        <?php if($data['donation_details']->verificationStatus == 2) {?>
                            <tr class="necessity-data">
                                <th width="30%">Verification Status</th>
                                <td width="70%">Verified</td>
                            </tr>
                            <tr class="necessity-data">
                                <th width="30%">Acknowledgement</th>
                                <td width="70%"><?php echo $data['donation_details']->acknowledgement ?></td>
                            </tr>
                        <?php }

                        else if($data['donation_details']->verificationStatus == 1) {?> 
                            <tr class="necessity-data">
                                <th width="30%">Verification Status</th>
                                <td width="70%">Unverified</td>
                            </tr>
                        <?php } ?>
                    <?php }?>
                    
                </table>
            </div>

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
