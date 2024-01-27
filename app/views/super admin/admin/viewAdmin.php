<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "admins"; ?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/superadmin/admin">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Admin</h3>
            <p style="margin-left: 10px">View information about the admins</p>
            
            <div class="necessity-info">
                <table>
                    <tr class="necessity-data">
                        <th width="30%">User ID</th>
                        <td width="70%"><?php print_r($data['admin_details']->adminID); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Admin Name</th>
                        <td width="70%"><?php print_r($data['admin_details']->adminName) ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Admin Username</th>
                        <td width="70%"><?php print_r($data['admin_details']->username) ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Admin Email</th>
                        <td width="70%"><?php print_r($data['admin_details']->email) ?></td>
                    </tr>
                </table>
            </div>

            <div class="view-donation-btn-container">
                <a href="" class="view-donation-btn">Edit</a>
                <a href="" class="view-donation-btn">Delete</a>
                <a href="" class="view-donation-btn">Ban</a>
            </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
