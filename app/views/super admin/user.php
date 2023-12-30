<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "users";?>
<?php require APPROOT.'/views/inc/components/sidenavbars.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <h3>Users</h3>
            <p style="margin-left: 10px">Select a user type</p>
            <div class="user-types">

                <!-- User 1 -->
                <a class="user-link" href="<?php echo URLROOT ?>/user/viewStudent">
                    <div class="user">
                        <div class="title">Students</div>
                    </div>
                </a>

                 <!-- User 2 -->
                 <a class="user-link" href="<?php echo URLROOT ?>/user/viewOrganization">
                    <div class="user">
                        <div class="title">Organizations</div>
                    </div>
                </a>

                 <!-- User 3 -->
                 <a class="user-link" href="<?php echo URLROOT ?>/user/viewDonor">
                    <div class="user">
                        <div class="title">Donors</div>
                    </div>
                </a>

            </div>
            <div class="right-content">
                <div class="right-cards">

                    <!-- Card 1 -->
                    <div class="right-card">
                        <div class="title">All users</div>
                        <div class="value">10,000</div>
                    </div>

                    <!-- Card 2 -->
                    <div class="right-card">
                        <div class="title">Students</div>
                        <div class="value">10,000</div>
                    </div>

                    <!-- Card 3 -->
                    <div class="right-card">
                        <div class="title">Organizations</div>
                        <div class="value">10,000</div>
                    </div>

                    <!-- Card 4 -->
                    <div class="right-card">
                        <div class="title">Donors</div>
                        <div class="value">10,000</div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>