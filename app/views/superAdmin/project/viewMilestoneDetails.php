
<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "projects";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/project/viewproject?">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Milestone</h3>
            <p style="margin-left: 10px">View information about the milestone</p>
            
            <div class="necessity-info">
                <table>
                        <tr class="necessity-data">
                            <th width="30%">Milestone Name</th>
                            <td width="70%"><?php echo $data['milestone_details']->milestoneName ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Description</th>
                            <td width="70%"><?php echo $data['milestone_details']->description ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Budget</th>
                            <td width="70%">Rs.&nbsp;<?php echo $data['milestone_details']->amount ?>.00</td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Received Amount</th>
                            <td width="70%"><?php echo $data['milestone_details']->receivedAmount ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Description</th>
                            <td width="70%"><?php echo $data['milestone_details']->description ?></td>
                        </tr>
                </table>
            </div>

            <div class="view-donation-btn-container">
                <a href="<?php echo URLROOT ?>/project/viewdoneeprofile/<?php echo $data['project_ID'] ?>/<?php echo $data['project_details']->orgID ?>" class="view-donation-btn">
                        View Donee Profile
                </a>
            </div>

            <div class="right-content" style="overflow-y:scroll;">
                <div class="right-content-title-container">
                    <h4 style="text-align:center">Milestones</h4>
                </div>
                <div class="right-cards"> 

                    <?php foreach($data['milestones'] as $item) { ?>
                        <a href="<?php echo URLROOT?>/project/viewmilestonedetails?milestoneID=<?php echo $data['milestones']->milestoneID ?>">
                        
                            <div class="right-card" style="display:flex;">
                                <div class="left-side-content" style="width:50%; padding-left:5px">
                                    <div class="title" style=""><?php echo $item->milestoneName ?></div>
                                    <div class="value" style="margin-top: 6px;">Rs.&nbsp;<?php echo $item->amount ?>.00</div>
                                </div>
                                <div class="right-side-content" style=" width:50%">
                                    <?php if($item->status == 1) {?>
                                        <div class="verified-label" style="background-color: rgb(235, 194, 194); margin:12px; width:80px; padding:5px; text-align:center; border-radius:8px; color:black;">Completed</div>
                                    <?php }
                                    else {?>
                                        <div class="unverified-label" style="background-color:beige; margin:12px; width:80px; padding:5px; text-align:center; border-radius:8px; color:black;">Not Completed</div>
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
