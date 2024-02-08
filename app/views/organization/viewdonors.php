<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "donors";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

            <!-- Middle container -->
            <div class="middle-container">
                <!-- Go Back Button -->
                <div class="goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <button onclick="">Go Back</button>
                </div>

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>View Donors</h3>
                    <p>View the list of donors</p>
                </div>

                <!-- search bar -->
                <div class="search-bar-for-view-donors">
                    <img src="<?php echo URLROOT ?>/img/Vector.png" alt="search">
                    <input type="search" placeholder="Search">
                </div>

                <!-- table caption -->
                <div class="table-caption-for-view-dobor">
                    <h4>Donors</h4>
                </div>

                <div class="grey-line-under-the-view-donor-table-caption"></div>


            </div> 

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
