<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "users"; ?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/user/superadmindonor">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Donor</h3>
            <p style="margin-left: 10px">View information about the donor</p>
            
            <div class="necessity-info">
                <table>
                    <tr class="necessity-data">
                        <th width="30%">Donor ID</th>
                        <td width="70%">6</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Donor Name</th>
                        <td width="70%">Donor 1</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Donor Username</th>
                        <td width="70%">donor1</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Donor Email</th>
                        <td width="70%">donor1@gmail.com</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Donor Type</th>
                        <td width="70%">Individual</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Address</th>
                        <td width="70%">ABD Road</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Phone Number</th>
                        <td width="70%">0712345678</td>
                    </tr>
                </table>
            </div>

            <div class="view-donation-btn-container">
                <a href="" class="view-donation-btn">Change Password</a>
                <a href="" class="view-donation-btn">Edit</a>
                <a href="" class="view-donation-btn">Delete</a>
                <a href="" class="view-donation-btn">Ban</a>
            </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
