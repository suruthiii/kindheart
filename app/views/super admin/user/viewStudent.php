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
                        <th width="30%">Student Name</th>
                        <td width="70%">Student 1</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Student Username</th>
                        <td width="70%">student1</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Student Email</th>
                        <td width="70%">student1@gmail.com</td>
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
