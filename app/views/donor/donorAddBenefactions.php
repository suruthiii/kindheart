<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "benefactions";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="donor-right-side-container">

            <!-- Middle container -->
            <div class="donor-middle-container">
                <!-- Go Back Button -->
                <div class="donor-goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <button onclick="location.href='<?php echo URLROOT ?>/donor/postDonations'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="donor-middle-container-title-typeone">
                    <h3>Add Benefactions</h3>
                    <p>Enter correct information and add your benefactions.</p>
                </div>

                <!-- Add Monetary Neceessity Form -->
                <div class="add-benefaction-form">
                    <form action="<?php echo URLROOT ?>/Benefaction/addingbenefactions" method="POST">
                    
                        <!-- Item -->
                        <div class="benefaction-first-div">
                            <label for="itemBenefaction">Item</label>
                            <input type="text" id="itemBenefaction" name="itemBenefaction" value="<?php echo isset($data['itemBenefaction']) ? $data['itemBenefaction'] : ''; ?>">

                            <!-- Monetary necessity Error display -->
                            <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['itemBenefaction_err']) ? $data['itemBenefaction_err']: ''; ?></span>
                        </div>

                        <!-- Quantity -->
                        <div class="benefaction-second-div">
                            <label for="quantityBenfaction">Quantity </label>
                            <input type="number" id="quantityBenfaction" name="quantityBenfaction" value="<?php echo isset($data['quantityBenfaction']) ? $data['quantityBenfaction'] : ''; ?>">

                            <!-- Requested Amount Error Display -->
                            <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['quantityBenfaction_err']) ? $data['quantityBenfaction_err']: ''; ?></span>
                        </div>

                        <!-- Description about requested necessity -->
                        <div class="add-benefaction-text-area-input-to-oneline">
                            <label for="benefactionDescription">Description</label>
                            <textarea name="benefactionDescription" id="benefactionDescription" cols="30" rows="10"><?php echo isset($data['benefactionDescription']) ? $data['benefactionDescription'] : ''; ?></textarea>

                            <!-- Neccessity description error display -->
                            <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['benefactionDescription_err']) ? $data['benefactionDescription_err']: ''; ?></span>
                        </div>

                        <!-- Add Button for necessity -->
                        <div class="add-benefaction-add-button">
                            <input type="submit" value="Add">
                        </div>
                    </form>
                </div>

                

            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <?php require APPROOT.'/views/inc/components/askonluforneedbar.php'; ?>

            <!-- ----------------- Javascript for disable recurring chossing date when one-time---------------- -->
            <!-- <script>
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
            </script> -->
            <!-- ---------------------------------------------------------------------------------------------- -->

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>