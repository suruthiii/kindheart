<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "benefactions";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/benefaction/viewbenefaction?benefaction_ID=<?php echo $data['benefaction_ID'] ?>">
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
                        <th width="30%">Donee Name</th>
                        <td width="70%"><?php echo $data['donation_details']->doneeName ?></td>
                    </tr>
                    
                    <tr class="necessity-data">
                        <th width="30%">Received Quantity</th>
                        <td width="70%"><?php echo $data['donation_details']->receivedQuantity ?></td>
                    </tr>
                    <?php if($data['donation_details']->deliveryReceipt != NULL) {?>
                        <tr class="necessity-data">
                            <th width="30%">Delivery Receipt</th>
                            <td width="70%">
                                <img src="<?php echo URLROOT ?>/benefactionUploads/<?php print_r($data['donation_details']->deliveryReceipt); ?>" class="user-img" alt="">
                            </td>
                        </tr>
                    <?php }?>
                    <?php if($data['donation_details']->verificationStatus == 1) {?>
                        <tr class="necessity-data">
                            <th width="30%">Verification Status</th>
                            <td width="70%">Verified</td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Acknowledgement</th>
                            <td width="70%"><?php echo $data['donation_details']->acknowledgement ?></td>
                        </tr>
                    <?php }

                    else if($data['donation_details']->verificationStatus == 0) {?> 
                        <tr class="necessity-data">
                            <th width="30%">Verification Status</th>
                            <td width="70%">Unverified</td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

            <?php if($data['donation_details']->verificationStatus == 0) {?>
                <div class="view-donation-btn-container">
                    <form action="<?php echo URLROOT ?>/benefaction/verifyreceipt" method="post" class="delete-form">
                        <input type="text" name="donee_ID" id="donee_ID" hidden value="<?php echo $_GET['donee_ID'] ?>" />
                        <input type="text" name="benefaction_ID" id="benefaction_ID" hidden value="<?php echo $_GET['benefaction_ID'] ?>" />
                        <button type="submit" class="view-donation-btn">
                            Verify Receipt
                        </button>
                    </form>
                </div>
            <?php }

            else if($data['donation_details']->verificationStatus == 3) {?>
                <div class="view-donation-btn-container">
                    <form action="<?php echo URLROOT ?>/benefaction/verifyreceiptagain" method="post" class="delete-form">
                        <input type="text" name="donee_ID" id="donee_ID" hidden value="<?php echo $_GET['donee_ID'] ?>" />
                        <input type="text" name="benefaction_ID" id="benefaction_ID" hidden value="<?php echo $_GET['benefaction_ID'] ?>" />
                        <button type="submit" class="view-donation-btn">
                            Verify Receipt
                        </button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
