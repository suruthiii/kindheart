<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "requests"; ?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/request/studentrequest">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Student</h3>
            <p style="margin-left: 10px">View information about the student</p>
            
            <div class="necessity-info">
                <table>
                    <tr class="necessity-data">
                        <th width="30%">Student ID</th>
                        <td width="70%"><?php print_r($data['student_details']->studentID); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Student Username</th>
                        <td width="70%"><?php print_r($data['student_details']->username); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Student Email</th>
                        <td width="70%"><?php print_r($data['student_details']->email); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">First Name</th>
                        <td width="70%"><?php print_r($data['student_details']->fName); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Last Name</th>
                        <td width="70%"><?php print_r($data['student_details']->lName); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Gender</th>
                        <td width="70%"><?php print_r($data['student_details']->gender); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Date of Birth</th>
                        <td width="70%"><?php print_r($data['student_details']->dateOfBirth); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">NIC Number</th>
                        <td width="70%"><?php print_r($data['student_details']->nicNumber); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Student Type</th>
                        <td width="70%"><?php print_r($data['student_details']->studentType); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Institution Name</th>
                        <td width="70%"><?php print_r($data['student_details']->institutionName); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Studying Year</th>
                        <td width="70%"><?php print_r($data['student_details']->studyingYear); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Caregiver's Name</th>
                        <td width="70%"><?php print_r($data['student_details']->caregiverName); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Caregiver's Type</th>
                        <td width="70%"><?php print_r($data['student_details']->caregiverType); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Caregiver's Relationship to Student</th>
                        <td width="70%"><?php print_r($data['student_details']->caregiverRelationship); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Caregiver's Occupation</th>
                        <td width="70%"><?php print_r($data['student_details']->caregiverName); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Bank Account Number</th>
                        <td width="70%"><?php print_r($data['student_details']->accNumber); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Account Holder's Name</th>
                        <td width="70%"><?php print_r($data['student_details']->accountHoldersName); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Bank Name</th>
                        <td width="70%"><?php print_r($data['student_details']->bankName); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Branch Name</th>
                        <td width="70%"><?php print_r($data['student_details']->branchName); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Address</th>
                        <td width="70%"><?php print_r($data['student_details']->address); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Phone Number</th>
                        <td width="70%"><?php print_r($data['student_details']->phoneNumber); ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">School/ University Letter</th>
                        <td width="70%">
                            <img src="<?php echo URLROOT ?>/nic/<?php print_r($data['student_details']->letterImage); ?>" class="user-img" alt="">
                        </td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">NIC Front</th>
                        <td width="70%">
                            <img src="<?php echo URLROOT ?>/nic/<?php print_r($data['student_details']->nicFrontImage); ?>" class="user-img" alt="">
                        </td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">NIC Back</th>
                        <td width="70%">
                            <img src="<?php echo URLROOT ?>/nic/<?php print_r($data['student_details']->nicBackImage); ?> " class="user-img" alt="">
                        </td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">GS Certificate</th>
                        <td width="70%">
                            <img src="<?php echo URLROOT ?>/nic/<?php print_r($data['student_details']->gsCertificateImage); ?> " class="user-img" alt="">
                        </td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Receiving Scholarships</th>
                        <td width="70%"><?php print_r($data['student_details']->receivingScholarships); ?></td>
                    </tr>
                </table>
            </div>

            <div class="view-donation-btn-container" style="display: flex;">
                <form action="<?php echo URLROOT ?>/user/deleteUser" method="post" class="delete-form">
                    <input type="text" name="user_ID" id="user_ID" hidden value="<?php echo $data['student_details']->studentID; ?>" />
                    <button type="submit" class="view-donation-btn" onclick="return confirmSubmit();">
                        Delete
                    </button>
                </form>
                &nbsp;
                <form action="<?php echo URLROOT ?>/user/banUser" method="post" class="delete-form">
                    <input type="text" name="user_ID" id="user_ID" hidden value="<?php echo $data['student_details']->studentID; ?>" />
                    <button type="submit" class="view-donation-btn" onclick="return confirmSubmit();">
                        Ban
                    </button>
                </form>
                
            </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
