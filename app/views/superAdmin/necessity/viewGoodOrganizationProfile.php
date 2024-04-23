<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "necessities"; ?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/necessity/viewgood?necessity_ID=<?php echo $data['necessity_ID']?>">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Donee Profile</h3>
            <p style="margin-left: 10px">View information about the donee</p>
            
            <div class="necessity-info">
                <table>
                <tr class="necessity-data">
                        <th width="30%">Organization ID</th>
                        <td width="70%"><?php print_r($data['details']->orgID); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Organization Username</th>
                        <td width="70%"><?php print_r($data['details']->username); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Organization Email</th>
                        <td width="70%"><?php print_r($data['details']->email); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Organization Name</th>
                        <td width="70%"><?php print_r($data['details']->orgName); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Organization Number</th>
                        <td width="70%"><?php print_r($data['details']->orgNumber); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Organization Type</th>
                        <td width="70%"><?php print_r($data['details']->orgType); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Bank Account Number</th>
                        <td width="70%"><?php print_r($data['details']->accNumber); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Account Holder's Name</th>
                        <td width="70%"><?php print_r($data['details']->accountHoldersName); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Bank Name</th>
                        <td width="70%"><?php print_r($data['details']->bankName); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Branch Name</th>
                        <td width="70%"><?php print_r($data['details']->branchName); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Address</th>
                        <td width="70%"><?php print_r($data['details']->address); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">School/ University Letter</th>
                        <td width="70%">
                            <img src="<?php echo URLROOT ?>/nic/<?php print_r($data['details']->letterImage); ?>" class="user-img" alt="">
                        </td>
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
