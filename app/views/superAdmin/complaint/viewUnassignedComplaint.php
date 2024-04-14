<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "complaints";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/superadmin/complaint">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Complaint</h3>
            <p style="margin-left: 10px">View the complaints of users</p>
            
            <div class="necessity-info">
                <table>
                    <tr class="necessity-data">
                        <th width="30%">Complainer Name</th>
                        <td width="70%">Sarah Dawson</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Complainee Name</th>
                        <td width="70%">Steve Dawson</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Description</th>
                        <td width="70%">80 Page CR Book</td>
                    </tr>
                </table>
            </div>

            <div class="right-content" style="overflow-y:scroll;">
                <div class="right-content-title-container">
                    <h4 style="text-align:center">Past Complaints</h4>
                </div>
                <div class="right-cards">  

                    <!-- <?php foreach($data['past_complaints'] as $item) {?> -->
                    <div class="right-card">
                        <div class="title">Admin
                            <!-- <?php echo $item->name ?> -->
                        </div>
                        <div class="value">Comment
                            <!-- <?php echo $item->description ?> -->
                        </div>
                    </div>
                    <!-- <?php }?> -->
                </div>
            </div>

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
