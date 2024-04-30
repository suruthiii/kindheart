<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "dashboard";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <h3>Super Admin Dashboard</h3>
            <div class="cards">
                <!-- Card 3 -->
                <a class="card-link" href="<?php echo URLROOT ?>/superadmin/admin">
                    <div class="card">
                        <div class="title">Admins</div>
                        <div class="value"><?php echo $data['admins'] ?></div>
                    </div>
                </a>

                <!-- Card 3 -->
                <a class="card-link" href="<?php echo URLROOT ?>/superadmin/request">
                    <div class="card">
                        <div class="title">Requests</div>
                        <div class="value"><?php echo $data['requests'] ?></div>
                    </div>
                </a>
                
                <!-- Card 3 -->
                <a class="card-link" href="<?php echo URLROOT ?>/superadmin/complaint">
                    <div class="card">
                        <div class="title">Complaints</div>
                        <div class="value"><?php echo $data['complaints'] ?></div>
                    </div>
                </a>

                <!-- Card 3 -->
                <!-- <a class="card-link" href="">
                    <div class="card">
                        <div class="title">Monthly Donations</div>
                        <div class="value">Rs. 58,977.00</div>
                    </div>
                </a> -->

                <!-- Card 4 -->
                <!-- <a class="card-link" href="">
                    <div class="card">
                        <div class="title">Monthly Donations</div>
                        <div class="value">Rs. 58,977.00</div>
                    </div>
                </a> -->
                
            </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>