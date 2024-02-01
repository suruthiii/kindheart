<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "donors";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">
            <!-- Go Back Button -->
            <div class="goback-button">
                <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                <button onclick="">Go Back</button>
            </div>

            <!-- View Donor title and sub title -->
            <div class="middle-container-title-typeone">
                <h3>View Donors</h3>
                <p>View the list of donors</p>
            </div>

            <div class="search-bar-for-view-donors"></div>

            <!-- <div class="donor-list-caption"><h4>Donor</h4></div>

            <div class="donor-list-grey-line"></div> -->
             
            <!-- donor list -->
            <!-- <div class="donor-list-to-view">

            </div> -->

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
