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
            
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
