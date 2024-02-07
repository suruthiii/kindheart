<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "admins"; ?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>
<!-- <?php print_r($data)?> -->
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

            <h3 style="margin-top: 25px">Edit Admin</h3>
            <p style="margin-left: 10px">Edit information about the admins</p>
            
            <div class="necessity-info">
            <?php if (!empty($other_data)){?>
                    <div class="error-msg">
                        <span class="form-invalid"><?php echo $other_data["err"] ?></span>
                    </div>
                <?php } else { ?>
                    <form action="" method='POST' >
                        <input type="text" name="user_ID" id="user_ID" value="<?php print_r($data['admin_details']['adminID']) ?>" required hidden>
                        <table>
                            <tr class="necessity-data">
                                <th width="30%">User ID</th>
                                <td width="70%"><?php print_r($data['admin_details']['adminID']); ?></td>
                            </tr>
                            <tr class="necessity-data">
                                <th width="30%">Admin Name</th>
                                <td width="70%"><input type="text" value="<?php print_r($data['admin_details']['adminName']) ?>" required name="name" style="width: 200px; border: none; border-bottom: 1px solid rgba(0, 0, 0, 0.153); outline: none; padding: 5px;"></td>
                            </tr>
                            <tr class="necessity-data">
                                <th width="30%">Admin Username</th>
                                <td width="70%"><input type="text" value="<?php print_r($data['admin_details']['username']) ?>" required name="username" style="width: 200px; border: none; border-bottom: 1px solid rgba(0, 0, 0, 0.153); outline: none; padding: 5px;"></td>
                                <td width="70%"><input type="text" value="<?php print_r($data['admin_details']['username']) ?>" required hidden name="old_username"></td>
                            </tr>
                            <tr class="necessity-data">
                                <th width="30%">Admin Email</th>
                                <td width="70%"><?php print_r($data['admin_details']['email']) ?></td>
                            </tr>
                        </table>
                        <input type="submit" value="Save Changes" style="padding: 5px 10px; margin-top: 20px; border-radius: 5px; border: none; background-color: #8e0000; color: white;">
                    </form>
                <?php }?>
            </div>

            <!-- <div class="view-donation-btn-container">
                <a href="" class="view-donation-btn">Change Password</a>
            </div> -->
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
