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
                <a href="<?php echo URLROOT ?>/superadmin/benefaction">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Benefaction</h3>
            <p style="margin-left: 10px">View information about the benefactions of donors</p>
            
            <div class="necessity-info">
                <table>
                    <tr class="necessity-data">
                        <th width="30%">Item Name</th>
                        <td width="70%"><?php echo $data['benefaction_details']->itemName ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Item Category</th>
                        <td width="70%"><?php echo $data['benefaction_details']->itemCategory ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Description</th>
                        <td width="70%"><?php echo $data['benefaction_details']->description ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Donor Name</th>
                        <td width="70%"><?php echo $data['benefaction_details']->name ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Item Quantity</th>
                        <td width="70%"><?php echo $data['benefaction_details']->itemQuantity ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Donated Quantity</th>
                        <td width="70%"><?php echo $data['benefaction_details']->donatedQuantity ?></td>
                    </tr>
                    <?php if($data['benefaction_details']->itemPhoto1 != NULL) {?>
                        <tr class="necessity-data">
                            <th width="30%">Item Photo 1</th>
                            <td width="70%">
                                <img src="<?php echo URLROOT ?>/benefactionUploads/<?php print_r($data['donation_details']->itemPhoto1); ?>" class="user-img" alt="">
                            </td>
                        </tr>
                    <?php }?>
                    <?php if($data['benefaction_details']->itemPhoto2 != NULL) {?>
                        <tr class="necessity-data">
                            <th width="30%">Item Photo 2</th>
                            <td width="70%">
                                <img src="<?php echo URLROOT ?>/benefactionUploads/<?php print_r($data['donation_details']->itemPhoto2); ?>" class="user-img" alt="">
                            </td>
                        </tr>
                    <?php }?>
                    <?php if($data['benefaction_details']->itemPhoto3 != NULL) {?>
                        <tr class="necessity-data">
                            <th width="30%">Item Photo 3</th>
                            <td width="70%">
                                <img src="<?php echo URLROOT ?>/benefactionUploads/<?php print_r($data['donation_details']->itemPhoto3); ?>" class="user-img" alt="">
                            </td>
                        </tr>
                    <?php }?>
                    <?php if($data['benefaction_details']->itemPhoto4 != NULL) {?>
                        <tr class="necessity-data">
                            <th width="30%">Item Photo 4</th>
                            <td width="70%">
                                <img src="<?php echo URLROOT ?>/benefactionUploads/<?php print_r($data['donation_details']->itemPhoto3); ?>" class="user-img" alt="">
                            </td>
                        </tr>
                    <?php }?>
                </table>
            </div>

            <div class="view-donation-btn-container">
                <a href="<?php echo URLROOT ?>/benefaction/viewdonorprofile/<?php echo $data['benefaction_ID'] ?>/<?php echo $data['benefaction_details']->donorID ?>" class="view-donation-btn">
                        View Donor Profile
                </a>
            </div>

            <div class="right-content" style="overflow-y:scroll;">
                <div class="right-content-title-container">
                    <h4 style="text-align:center">Donations</h4>
                </div>
                <div class="right-cards"> 

                    <!-- <?php foreach($data['donations'] as $item) { ?>
                        <a href="<?php echo URLROOT?>/benefaction/viewdonationdetails?ID=<?php echo $item->ID ?>">
                            <div class="right-card" style="display:flex;">
                                <div class="left-side-content" style="width:50%; padding-left:5px">
                                    <div class="title" style=""><?php echo $item->studentName ?></div>
                                    <div class="value" style="margin-top: 6px;"><?php echo $item->quantity ?></div>
                                </div>
                                <div class="right-side-content" style=" width:50%">
                                    <?php if($item->verificationStatus == 1) {?>
                                        <div class="verified-label" style="background-color: rgb(235, 194, 194); margin:12px; width:80px; padding:5px; text-align:center; border-radius:8px; color:black;">Verified</div>
                                    <?php }
                                    else {?>
                                        <div class="unverified-label" style="background-color:beige; margin:12px; width:80px; padding:5px; text-align:center; border-radius:8px; color:black;">Unverified</div>
                                    <?php }?> 
                                </div>
                            </div>
                        </a>
                    <?php }?> -->
                    </a>
                </div>
            </div>
            
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
