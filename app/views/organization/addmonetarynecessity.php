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
                    <button onclick="location.href='<?php echo URLROOT ?>/necessity/monetary'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>Add Monetary Necessities</h3>
                    <p>Enter correct information and add your necessities.</p>
                </div>

                <!-- Add Monetary Neceessity Form -->
                <div class="add-necessity-form">
                    <form enctype="multipart/form-data" action="<?php echo URLROOT ?>/Necessity/addmonetarynecessity" method="POST" onsubmit="return validateForm()">
                        <!-- First line of form -->
                        <div class="add-necessity-one-line-second-type-input">
                            <div class="necessity-first-div">
                                <label for="necessityMonetary">Necessity</label>
                                <input type="text" id="necessityMonetary" name="necessityMonetary" value="<?php echo isset($data['necessityMonetary']) ? $data['necessityMonetary'] : ''; ?>">
                                <!-- Monetary necessity Error display -->
                                <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['necessityMonetary_err']) ? $data['necessityMonetary_err']: ''; ?></span>
                            </div>
                            <div class="necessity-second-div">
                                <label for="necessityType">Necessity Type</label>
                                <select name="necessityType" id="necessityType" value="<?php echo isset($data['necessityType']) ? $data['necessityType'] : '(Select)'; ?>">
                                    <option value="recurring">Recurring</option>
                                    <option value="onetime">One-Time</option>
                                </select>
                                <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['necessityType_err']) ? $data['necessityType_err']: ''; ?></span>
                            </div>
                        </div>
                        <!-- Second line of form -->
                        <div class="add-necessity-one-line-second-type-input">
                            <div class="necessity-third-div">
                                <label for="recurringstartdate">Start Date (if recurring) </label>
                                <input type="date" id="recurringstartdate" name="recurringstartdate" value="<?php echo isset($data['recurringstartdate']) ? $data['recurringstartdate'] : ''; ?>" min="<?php echo date('Y-m-d'); ?>">
                                <!-- Recurring start date error display -->
                                <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['recurringstartdate_err']) ? $data['recurringstartdate_err']: ''; ?></span>
                            </div>
                            <div class="necessity-fourth-div">
                                <label for="donationduration">Durations (Monthly)</label>
                                <input type="number" id="donationduration" name="donationduration" value="<?php echo isset($data['donationduration']) ? $data['donationduration'] : ''; ?>" min="1">
                                <!-- Recurring End date error display -->
                                <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['donationduration_err']) ? $data['donationduration_err']: ''; ?></span>
                            </div>
                        </div>

                        <!-- Description about requested necessity -->
                        <div class="add-necessity-text-area-input-to-oneline">
                            <label for="monetarynecessitydes">Description</label>
                            <textarea name="monetarynecessitydes" id="monetarynecessitydes" cols="30" rows="10" title="An explanation of why funding is necessary"><?php echo isset($data['monetarynecessitydes']) ? $data['monetarynecessitydes'] : ''; ?></textarea>
                            <!-- Neccessity description error display -->
                            <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['monetarynecessitydes_err']) ? $data['monetarynecessitydes_err']: ''; ?></span>
                        </div>

                        <!-- Requested Amount in Rupees -->
                        <div class="add-necessity-one-line-second-type-input">
                            <div class="necessity-third-div">
                                <label for="requestedamount">Requested Amount in Rupees</label>
                                <input type="number" id="requestedamount" name="requestedamount" title="Full Requested Amount" min="25" value="<?php echo isset($data['requestedamount']) ? $data['requestedamount'] : ''; ?>">
                                <!-- Requested Amount Error Display -->
                                <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['requestedamount_err']) ? $data['requestedamount_err']: ''; ?></span>
                            </div>
                            <div class="necessity-fourth-div">
                                <label for="monthlyrequestedamount">Monthly Requested Amount</label>
                                <input type="number" id="monthlyrequestedamount" name="monthlyrequestedamount" title="Monthly Requested Amount" min="25" value="<?php echo isset($data['monthlyrequestedamount']) ? $data['monthlyrequestedamount'] : ''; ?>">
                                <!-- Requested Amount Error Display -->
                                <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['monthlyrequestedamount_err']) ? $data['monthlyrequestedamount_err']: ''; ?></span>
                            </div>
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

            <!-- ----------------- Javascript for disable recurring chossing date when one-time---------------- -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var necessityTypeSelect = document.getElementById('necessityType');

                    function toggleRecurringFields() {
                        var recurringStartDateInput = document.getElementById('recurringstartdate');
                        var donationduration = document.getElementById('donationduration');
                        var monthlyrequestedamount = document.getElementById('monthlyrequestedamount');
                        var requestedamount = document.getElementById('requestedamount');

                        if (necessityTypeSelect.value === 'onetime') {
                            recurringStartDateInput.disabled = true;
                            donationduration.disabled = true;
                            monthlyrequestedamount.disabled = true;
                            requestedamount.disabled = false;
                        } else {
                            recurringStartDateInput.disabled = false;
                            donationduration.disabled = false;
                            monthlyrequestedamount.disabled = false;
                            requestedamount.disabled = true;
                        }
                    }

                    // Call toggleRecurringFields initially to set initial state
                    toggleRecurringFields();

                    // Add event listener to necessityType select element
                    necessityTypeSelect.addEventListener('change', toggleRecurringFields);
                });
            </script>
            <!-- ---------------------------------------------------------------------------------------------- -->

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
