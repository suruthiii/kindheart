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
                <a href="<?php echo URLROOT ?>/user/superadminstudent">
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
                        <th width="30%">User ID</th>
                        <td width="70%">6</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Student Username</th>
                        <td width="70%">student1</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Student Email</th>
                        <td width="70%">student1@gmail.com</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">First Name</th>
                        <td width="70%">Amy</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Last Name</th>
                        <td width="70%">Winehouse</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Gender</th>
                        <td width="70%">Female</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Date of Birth</th>
                        <td width="70%">01/01/2007</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Institute Name</th>
                        <td width="70%">ABC College</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Institue Type</th>
                        <td width="70%">School</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Bank Account Number</th>
                        <td width="70%">12345678</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Account Holder's Name</th>
                        <td width="70%">Kiara White</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Bank Name</th>
                        <td width="70%">HNB</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Branch Name</th>
                        <td width="70%">Wellawatte</td>
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
