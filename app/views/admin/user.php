<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "users";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <h3>Users</h3>
            <p style="margin-left: 10px">Select a user type</p>
            <div class="user-types">

                <!-- User 1 -->
                <a class="user-link" href="<?php echo URLROOT ?>/user/student">
                    <div class="user">
                        <div class="title">Students</div>
                    </div>
                </a>

                 <!-- User 2 -->
                 <a class="user-link" href="<?php echo URLROOT ?>/user/organization">
                    <div class="user">
                        <div class="title">Organizations</div>
                    </div>
                </a>

                 <!-- User 3 -->
                 <a class="user-link" href="<?php echo URLROOT ?>/user/donor">
                    <div class="user">
                        <div class="title">Donors</div>
                    </div>
                </a>

            </div>
            <!-- <div class="right-content">
                <div class="right-cards">

                    
                    <div class="right-card">
                        <div class="title">All users</div>
                        <div class="value">10,000</div>
                    </div>

                    
                    <div class="right-card">
                        <div class="title">Students</div>
                        <div class="value">10,000</div>
                    </div>

                    
                    <div class="right-card">
                        <div class="title">Organizations</div>
                        <div class="value">10,000</div>
                    </div>

                    
                    <div class="right-card">
                        <div class="title">Donors</div>
                        <div class="value">10,000</div>
                    </div>

                </div>
            </div> -->
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
