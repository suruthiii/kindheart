<?php require APPROOT.'/views/inc/header.php'; ?>
<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "benefactions";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="donor-right-side-container">

            <!-- Title container -->
            <div class="donor-div-one">
                <h1>Welcome Back <b>....Name.....<b></h1>
                <p>Here's The Latest Updates</p>
            </div>

            <!-- Status container -->
            <div class="donor-div-two">
                <h4>Status</h4>
                <div class="status">
                    <p>Donation Status</p>
                </div>
                <div class="status">
                    <p>Donation Status</p>
                </div>
                <div class="status">
                    <p>Donation Status</p>
                </div>
                <div class="status">
                    <p>Donation Status</p>
                </div>
            </div>

            <!-- Status container -->
            <div class="donor-div-three">
                <!-- Graph container -->
                <div class="donor-right-container">
                    <h4>Donation Summary</h4>
                    <p>----------------</p>
                </div>
                
                <!-- Donation container -->
                <div class="donor-left-container">
                    <h4>Recent Donations</h4>
                    <p>------------</p>
                </div>  
            </div>                   
        </div>
    </section>
</main>

<h1>Donor Dashboard</h1>

<?php require APPROOT.'/views/inc/footer.php'; ?>
