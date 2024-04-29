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
                <a href="<?php echo URLROOT ?>/superadmin/scholarship">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Scholarship</h3>
            <p style="margin-left: 10px">View information about scholarships of donors</p>
            
            <div class="necessity-info">
                <table>
                        <tr class="necessity-data">
                            <th width="30%">Scholarship Title</th>
                            <td width="70%"><?php echo $data['scholarship_details']->title ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Donor Name</th>
                            <td width="70%"><?php echo $data['scholarship_details']->name ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Amount</th>
                            <td width="70%"><?php echo $data['scholarship_details']->amount ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Description</th>
                            <td width="70%"><?php echo $data['scholarship_details']->description ?></td>
                        </tr>
                </table>
            </div>

            <div class="view-donation-btn-container">
                <a href="<?php echo URLROOT ?>/scholarship/viewdonorprofile/<?php echo $data['scholarship_ID'] ?>/<?php echo $data['scholarship_details']->donorID ?>" class="view-donation-btn">
                        View Donor Profile
                </a>
            </div>

            <div class="right-content" style="overflow-y:scroll;">
                <div class="right-content-title-container">
                    <h4 style="text-align:center">Donations</h4>
                </div>
                <div class="right-cards"> 
                    <?php foreach($data['donations'] as $item) { ?>
                        <a href="<?php echo URLROOT?>/scholarship/viewdonationdetails?scholarship_ID=<?php echo $item->scholarshipID ?>&student_ID=<?php echo $item->studentID ?>">
                            <div class="right-card" style="display:flex;">
                                <div class="left-side-content" style="width:50%; padding-left:5px">
                                    <div class="title" style=""><?php echo $item->studentName ?></div>
                                    <div class="value" style="margin-top: 6px;"><?php echo $item->updatedMonth ?></div>
                                </div>
                                <div class="right-side-content" style=" width:50%">
                                    <?php if($item->verificationStatus == 2) {?>
                                        <div class="verified-label" style="background-color: rgb(235, 194, 194); margin:12px; width:80px; padding:5px; text-align:center; border-radius:8px; color:black;">Verified</div>
                                    <?php }
                                    else if($item->verificationStatus == 0) {?> 
                                        <div class="pending-label" style="background-color: white; margin:12px; width:80px; padding:5px; text-align:center; border-radius:8px; color:black;">Pending</div>
                                    <?php }
                                    else {?>
                                        <div class="unverified-label" style="background-color:beige; margin:12px; width:80px; padding:5px; text-align:center; border-radius:8px; color:black;">Unverified</div>
                                    <?php }?> 
                                </div>
                            </div>
                        </a>
                    <?php }?>
                </div>
            </div>
            
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
