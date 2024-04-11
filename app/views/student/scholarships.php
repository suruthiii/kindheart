<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "scholarships ";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

            <!-- Middle container -->
            <div class="middle-container">
                <!-- Go Back Button -->
                <div class="goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <button onclick="location.href='<?php echo URLROOT ?>/student/necessities'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>Posted scholarships</h3>
                    <p>View the available scholarships posted by donors</p>
                </div>

                
       


            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <div class="rightside-bar-type-one">
                <div class="right-side-bar">
                    

                </div>
            </div>

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
