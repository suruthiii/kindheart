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
                    <img src="<?php echo URLROOT; ?>/img/back-arrow.png">
                    <button onclick="location.href='<?php echo URLROOT; ?>/organization/postedmonetarynecessity'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>Add Monetary Necessities</h3>
                    <p>Enter correct information and add your necessities.</p>
                </div>

                <!-- Add Monetary Neceessity Form -->
                <div class="add-necessity-form">
                    <form action="<?php echo URLROOT;?>/Necessity/addingmonetarynecessity" method="POST">
                        <!-- First line of form -->
                        <div class="add-necessity-one-line-second-type-input">
                            <div class="necessity-first-div">
                                <label>Necessity </label>
                                <input type="text" id="necessityMonetary" name="necessityMonetary" value="<?php echo $data['necessityMonetary']; ?>">
                                <span class="form-invalid-row"><?php echo $data['necessityMonetary_err']; ?></span>
                            </div>
                            <div class="necessity-second-div">
                                <label>Necessity Type</label>
                                <select name="necessityType" id="necessityType">
                                    <option value=""><option>
                                    <option value="recurring">Recurring</option>
                                    <option value="onetime">One-Time</option>
                                </select>
                            </div>
                        </div>
                        <!-- Second line of form -->
                        <div class="add-necessity-one-line-second-type-input">
                            <div class="necessity-third-div">
                                <label>Start Date (if recurring) </label>
                                <input type="date" id="recurringstartdate" name="recurringstartdate" min="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="necessity-fourth-div">
                                <label>End Date (if recurring)</label>
                                <input type="date" id="recurringenddate" name="recurringenddate" min="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                        <!-- Description about requested necessity -->
                        <div class="add-necessity-text-area-input-to-oneline">
                            <label>Description</label>
                            <textarea name="monetarynecessitydes" id="monetarynecessitydes">
                                
                            </textarea>
                        </div>

                        <!-- Requested Amount in Rupees -->
                        <div class="add-necessity-one-line-input">
                            <label>Requested Amount in Rupees </label>
                            <input type="number" id="requestedamount" name="requestedamount">
                        </div>
                        <!-- Add Button for necessity -->
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
