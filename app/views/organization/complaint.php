<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "complaints";?>
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
                    <h3>Make a Complain</h3>
                </div>

                <!-- complaint form -->
                <div class="form-area">
                    <form action="" method="post">
                        <!-- Complaint in brief -->
                        <div class="middle-container-oneline-input">
                            <label for="complaintinbrief">Complaint in brief </label>
                            <input type="text" id="complaininbrief" name="complaininbrief">
                        </div>
                        <!-- Complaint Description -->
                        <div class="middle-container-online-textare">
                            <label for="complaintdescription">Description</label>
                            <textarea name="complaintdescription" id="complaintdescription"></textarea>
                        </div>
                        <!-- Complaint Button -->
                        <div class="complaint-button">
                            <input type="submit" value="Complaint">
                        </div>

                    </form>
                </div>

            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <?php require APPROOT.'/views/inc/components/askonluforneedbar.php'; ?> 

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
