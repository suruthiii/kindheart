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
                    <!-- <button onclick="location.href='<?php echo URLROOT ?>/benefaction/postedBenefactions'">Go Back</button> -->
                    <button onclick="goBack()">Go Back</button>

                    <script>
                        function goBack() {
                            // Use history.back() to navigate to the previous page in history
                            history.back();
                        }
                    </script>
                </div>

                <!-- main title -->
                <div class="donor-middle-container-title-typeone">
                    <h3>Add Scholarships</h3>
                    <p>Enter correct information and add your scholarship.</p>
                </div>

                <!-- Add Benefaction Form -->
                <div class="add-scholarship-form">
                    <form action="<?php echo URLROOT ?>/scholarship/donorAddScholarships" method="POST">
                    
                        <!-- Title -->
                        <div class="scholarship-first-div">
                            <label for="titleScholarship">Scholarship Title</label>
                            <input type="text" id="titleScholarship" name="titleScholarship" value="<?php echo isset($data['titleScholarship']) ? $data['titleScholarship'] : ''; ?>">

                            <!-- Scholarship Title Error display -->
                            <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['titleScholarship_err']) ? $data['titleScholarship_err']: ''; ?></span>
                        </div>

                        <!-- Amount -->
                        <div class="scholarship-second-div">
                            <label for="amountScholarship">Scholarship Amount (In LKR)</label>
                            <input type="text" id="amountScholarship" name="amountScholarship" value="<?php echo isset($data['amountScholarship']) ? $data['amountScholarship'] : ''; ?>">

                            <!-- Scholarship Amount Error Display -->
                            <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['amountScholarship_err']) ? $data['amountScholarship_err']: ''; ?> </span>
                        </div>
                        
                        <!-- Dates -->
                        <div class="scholarship-third-div">
                            <div class="scholarship-third-div-two-input-one-line">
                                <div class="add-scholarship-first-div">
                                    <label for="startDateScholarship">Start Date</label>
                                    <input type="date" id="startDateScholarship" name="startDateScholarship" value="<?php echo isset($data['startDateScholarship']) ? $data['startDateScholarship'] : ''; ?>">

                                    <!-- Satrt Date Error display -->
                                    <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['startDateScholarship_err']) ? $data['startDateScholarship_err']: ''; ?></span>                                                
                                </div>

                                <div class="add-scholarship-second-div">
                                    <label for="durationScholarship">Duration (In Months)</label>
                                    <input type="number" id="durationScholarship" name="durationScholarship" value="<?php echo isset($data['durationScholarship']) ? $data['durationScholarship'] : ''; ?>" min="1">

                                    <!-- Duration Error display -->
                                    <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['durationScholarship_err']) ? $data['durationScholarship_err']: ''; ?></span> 
                                </div>
                            </div>
                        </div>

                        <!-- Deadline -->
                        <div class="scholarship-forth-div">
                            <label for="deadlineScholarship">Application Deadline </label>
                            <input type="date" id="deadlineScholarship" name="deadlineScholarship" value="<?php echo isset($data['deadlineScholarship']) ? $data['deadlineScholarship'] : ''; ?>" >

                            <!-- Deadline Error Display -->
                            <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['deadlineScholarship_err']) ? $data['deadlineScholarship_err']: ''; ?> </span>
                        </div>                                

                        <!-- Description about scholarship -->
                        <div class="add-scholarship-text-area-input-to-oneline">
                            <label for="scholarshipDescription">Description</label>
                            <textarea name="scholarshipDescription" id="scholarshipDescription" cols="30" rows="10"><?php echo isset($data['scholarshipDescription']) ? $data['scholarshipDescription'] : ''; ?></textarea>

                            <!-- Scholarship description error display -->
                            <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['scholarshipDescription_err']) ? $data['scholarshipDescription_err']: ''; ?></span>
                        </div>
                        
                        <!-- Add Button for scholarship -->
                        <div class="add-scholarship-add-button">
                            <input type="submit" value="+ Add" >
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