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
                <a href="<?php echo URLROOT ?>/necessity/physicalgood">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Necessity</h3>
            <p style="margin-left: 10px">View information about the necessities of donees</p>
            
            <div class="necessity-info">
                <table>
                    <?php foreach($data['necessity_details'] as $key => $value){
                        if ($key == 'doneeID'){continue;} ?>
                        
                        <tr class="necessity-data">
                            <th width="30%"><?php echo $key?></th>
                            <td width="70%"><?php echo $value?></td>
                        </tr>
                    <?php }?>

                </table>
            </div>

            <div class="view-donation-btn-container">
                <a href="<?php echo URLROOT ?>/necessity/viewgooddoneeprofile/<?php echo $data['necessity_ID'] ?>/<?php echo $data['necessity_details']->doneeID ?>" class="view-donation-btn">
                        View Donee Profile
                </a>
            </div>

            <div class="right-content" style="overflow-y:scroll;">
                <div class="right-content-title-container">
                    <h4 style="text-align:center">Donations</h4>
                </div>
                <div class="right-cards"> 

                    <?php foreach($data['donations'] as $item) { ?>
                        <a href="<?php echo URLROOT?>/necessity/viewgooddonationdetails?goodDonationID=<?php echo $item->goodDonationID ?>">
                            <div class="right-card" style="display:flex;">
                                <div class="left-side-content" style="width:50%; padding-left:5px">
                                    <div class="title" style=""><?php echo $item->donorName ?></div>
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
                    <?php }?>
                    </a>
                </div>
            </div>
            
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
