<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "necessities";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

            <!-- Middle container -->
            <div class="middle-container">
                <!-- Go Back Button -->
                <div class="goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <button onclick="location.href='<?php echo URLROOT ?>/organization/postedphysicalgoodsnecessity'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>Add (Good) Necessities</h3>
                    <p>Enter correct information and add your necessities.</p>
                </div>

                <div class="add-necessity-form">
                    <form>
                        <div class="add-necessity-one-line-input">
                            <label for="complaintinbrief">Complaint in brief </label>
                            <input type="text" id="complaininbrief" name="complaininbrief">
                        </div>
                        <div class="add-necessity-one-line-input">
                            <label for="complaintinbrief">Complaint in brief </label>
                            <input type="text" id="complaininbrief" name="complaininbrief">
                        </div>
                        <div class="add-necessity-text-area-input">
                            <label for="complaintdescription">Description</label>
                            <textarea name="complaintdescription" id="complaintdescription"></textarea>
                        </div>
                        <div class="add-necessity-add-button">
                            <input type="submit" value="Add">
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
