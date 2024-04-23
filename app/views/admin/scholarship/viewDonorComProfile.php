<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "scholarships"; ?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/scholarship/viewscholarship?scholarship_ID=<?php echo $data['scholarship_ID'] ?>">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Donor Profile</h3>
            <p style="margin-left: 10px">View information about the donor</p>
            
            <div class="necessity-info">
                <table>
                    <tr class="necessity-data">
                            <th width="30%">Donor ID</th>
                            <td width="70%"><?php print_r($data['details']->donorID); ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Donor Username</th>
                            <td width="70%"><?php print_r($data['details']->username); ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Donor Email</th>
                            <td width="70%"><?php print_r($data['details']->email); ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Donor Type</th>
                            <td width="70%"><?php print_r($data['details']->donorType); ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Company Name</th>
                            <td width="70%"><?php print_r($data['details']->companyName); ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Registration Number</th>
                            <td width="70%"><?php print_r($data['details']->regNumber); ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Address</th>
                            <td width="70%"><?php print_r($data['details']->address); ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Phone Number</th>
                            <td width="70%"><?php print_r($data['details']->phoneNumber); ?></td>
                    </tr>
                </table>
            </div>

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
