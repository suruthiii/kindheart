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
                <a href="<?php echo URLROOT ?>/admin/project">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Project</h3>
            <p style="margin-left: 10px">View information about the projects of organizations</p>
            
            <div class="necessity-info">
                <table>
                        <tr class="necessity-data">
                            <th width="30%">Project Title</th>
                            <td width="70%"><?php echo $data['project_details']->title ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Organization Name</th>
                            <td width="70%"><?php echo $data['project_details']->orgName ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Budget</th>
                            <td width="70%"><?php echo $data['project_details']->budget ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Received Amount</th>
                            <td width="70%"><?php echo $data['project_details']->receivedAmount ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Description</th>
                            <td width="70%"><?php echo $data['project_details']->description ?></td>
                        </tr>
                </table>
            </div>

            <div class="view-donation-btn-container">
                <a href="<?php echo URLROOT ?>/project/deleteproject" class="view-donation-btn">
                    <!-- <button type="submit" class="view-donation-btn" > -->
                        View Donee Profile
                    <!-- </button> -->
                </a>
            </div>

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
