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
                    <form action="<?php echo URLROOT ?>/Necessity/addmonetarynecessity" method="POST">
                        <!-- First line of form -->
                        <div class="add-necessity-one-line-second-type-input">
                            <div class="necessity-first-div">
                                <label for="necessityMonetary">Necessity</label>
                                <select id="necessityMonetary" name="necessityMonetary" value="<?php echo isset($data['necessityMonetary']) ? $data['necessityMonetary'] : ''; ?>">
                                    <!-- &#13 -> use for break the content of title attribute -->
                                    <option value="EducationalSuppliesandTools" title="Pencils&#13Pens&#13Notebooks&#13Textbooks&#13Calculators&#13Educational software&#13Interactive whiteboards&#13Microscopes&#13Lab equipment&#13Robotics kits&#13Coding software&#13Coding software&#13Laptops&#13 3D printers">
                                        Educational Supplies and Tools
                                    </option>
                                    <!-- &#13 -> use for break the content of title attribute -->
                                    <option value="ClothingandAccessories" title="School uniforms&#13T-shirts&#13Pants&#13Shoes&#13Backpacks&#13Hats">
                                        Clothing and Accessories
                                    </option>
                                    <!-- &#13 -> use for break the content of title attribute -->
                                    <option value="RecreationandSportsEquipment" title="Soccer balls&#13Basketballs&#13Gymnastics mats&#13Tennis rackets&#13Bicycles&#13Skateboards">
                                        Recreation and Sports Equipment
                                    </option>
                                    <!-- &#13 -> use for break the content of title attribute -->
                                    <option value="HealthandWellnessProducts" title="Hygiene products (e.g., soap, toothpaste)&#13Hand sanitizer&#13Yoga mats">
                                        Health and Wellness Products
                                    </option>
                                    <!-- &#13 -> use for break the content of title attribute -->
                                    <option value="TransportationandMobility" title="Bicycles&#13Wheelchairs&#13Scooters&#13Crutches&#13Walking canes">
                                        Transportation and Mobility
                                    </option>
                                    <!-- &#13 -> use for break the content of title attribute -->
                                    <option value="LiteratureandReadingMaterials" title="Fiction books&#13Non-fiction books&#13Language learning materials&#13Dictionaries&#13E-readers&#13Audiobooks">
                                        Literature and Reading Materials
                                    </option>
                                    <!-- &#13 -> use for break the content of title attribute -->
                                    <option value="othernecessitycato">
                                        Other
                                    </option>
                                </select>
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
                                <label for="recurringenddate">End Date (if recurring)</label>
                                <input type="date" id="recurringenddate" name="recurringenddate" value="<?php echo isset($data['recurringenddate']) ? $data['recurringstartdate'] : ''; ?>" min="<?php echo date('Y-m-d'); ?>">
                                <!-- Recurring End date error display -->
                                <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['recurringenddate_err']) ? $data['recurringenddate_err']: ''; ?></span>
                            </div>
                        </div>

                        <!-- funding duration -->
                        <div class="add-necessity-one-line-input-for-radio-buttons">
                            <label for="fundingDurations">Funding Duration</label><br>
                            <input type="radio" id="weekly" name="fundingDurations" value="weekly">
                            <label for="weekly">Weekly</label>
                            <input type="radio" id="monthly" name="fundingDurations" value="monthly">
                            <label for="weekly">Monthly</label>
                            <input type="radio" id="yearly" name="fundingDurations" value="yearly">
                            <label for="weekly">Yearly</label>
                        </div>

                        <!-- Description about requested necessity -->
                        <div class="add-necessity-text-area-input-to-oneline">
                            <label for="monetarynecessitydes">Description</label>
                            <textarea name="monetarynecessitydes" id="monetarynecessitydes" cols="30" rows="10" placeholder="Provide the item that belongs in the necessity category"><?php echo isset($data['monetarynecessitydes']) ? $data['monetarynecessitydes'] : ''; ?></textarea>
                            <!-- Neccessity description error display -->
                            <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['monetarynecessitydes_err']) ? $data['monetarynecessitydes_err']: ''; ?></span>
                        </div>

                        <!-- Requested Amount in Rupees -->
                        <div class="add-necessity-one-line-input">
                            <label for="requestedamount">Requested Amount in Rupees </label>
                            <input type="number" id="requestedamount" name="requestedamount" value="<?php echo isset($data['requestedamount']) ? $data['requestedamount'] : ''; ?>">
                            <!-- Requested Amount Error Display -->
                            <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['requestedamount_err']) ? $data['requestedamount_err']: ''; ?></span>
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
                        var recurringEndDateInput = document.getElementById('recurringenddate');

                        if (necessityTypeSelect.value === 'onetime') {
                            recurringStartDateInput.disabled = true;
                            recurringEndDateInput.disabled = true;
                        } else {
                            recurringStartDateInput.disabled = false;
                            recurringEndDateInput.disabled = false;
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
