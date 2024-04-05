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
                <a href="<?php echo URLROOT ?>/user/organization">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Organization</h3>
            <p style="margin-left: 10px">View information about the organization</p>
            
            <div class="necessity-info">
                <table>
                    <tr class="necessity-data">
                        <th width="30%">Organization ID</th>
                        <td width="70%"><?php print_r($data['organization_details']->orgID); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Organization Username</th>
                        <td width="70%"><?php print_r($data['organization_details']->username); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Organization Email</th>
                        <td width="70%"><?php print_r($data['organization_details']->email); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Organization Name</th>
                        <td width="70%"><?php print_r($data['organization_details']->orgName); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Organization Number</th>
                        <td width="70%"><?php print_r($data['organization_details']->orgNumber); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%"><?php print_r($data['organization_details']->orgType); ?></th>
                        <td width="70%">School</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Bank Account Number</th>
                        <td width="70%"><?php print_r($data['organization_details']->accNumber); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Account Holder's Name</th>
                        <td width="70%"><?php print_r($data['organization_details']->accountHoldersName); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Bank Name</th>
                        <td width="70%"><?php print_r($data['organization_details']->bankName); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Branch Name</th>
                        <td width="70%"><?php print_r($data['organization_details']->branchName); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Address</th>
                        <td width="70%"><?php print_r($data['organization_details']->address); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Phone Number</th>
                        <td width="70%"><?php print_r($data['organization_details']->phoneNumber); ?></td>
                    </tr>
                </table>
            </div>

            <div class="view-donation-btn-container" style="display: flex;">
                <form action="<?php echo URLROOT ?>/user/deleteUser" method="post" class="delete-form">
                    <input type="text" name="user_ID" id="user_ID" hidden value="<?php echo $data['organization_details']->orgID; ?>" />
                    <button type="submit" class="view-donation-btn" onclick="return confirmSubmit();">
                        Delete
                    </button>
                </form>
                &nbsp;
                <form action="<?php echo URLROOT ?>/user/banUser" method="post" class="delete-form">
                    <input type="text" name="user_ID" id="user_ID" hidden value="<?php echo $data['organization_details']->orgID; ?>" />
                    <button type="submit" class="view-donation-btn" onclick="return confirmSubmit();">
                        Ban
                    </button>
                </form>
                
            </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
