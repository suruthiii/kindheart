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
                <a href="<?php echo URLROOT ?>/necessity/viewgood?necessity_ID=<?php echo $data['necessity_ID'] ?>">
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
                        <th width="30%">Donor Name</th>
                        <td width="70%"><?php echo $data['donation_details']->donorName ?></td>
                    </tr>
                    
                    <tr class="necessity-data">
                        <th width="30%">Donated Quantity</th>
                        <td width="70%"><?php echo $data['donation_details']->quantity ?></td>
                    </tr>
                    <?php if($data['donation_details']->deliveryReceipt != NULL) {?>
                        <tr class="necessity-data">
                            <th width="30%">Delivery Receipt</th>
                            <td width="70%">
                                <img src="<?php echo URLROOT ?>/nic/<?php print_r($data['donation_details']->deliveryReceipt); ?>" class="user-img" alt="">
                            </td>
                        </tr>
                    <?php }?>
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
                </table>
            </div>

            <?php if($data['donation_details']->verificationStatus == 1) {?>
                <div class="view-donation-btn-container">
                    <form action="<?php echo URLROOT ?>/necessity/verifygoodreceipt" method="post" class="delete-form">
                        <input type="text" name="donation_ID" id="donation_ID" hidden value="<?php echo $_GET['goodDonationID'] ?>" />
                        <button type="submit" class="view-donation-btn">
                            Verify Receipt
                        </button>
                    </form>
                </div>
            <?php }?>

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
