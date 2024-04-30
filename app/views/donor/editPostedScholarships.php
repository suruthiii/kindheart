<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "donations";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="donor-right-side-container">

            <!-- Middle container -->
            <div class="donor-middle-container">

                <!-- Go Back Button -->
                <div class="donor-goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <!-- <button onclick="location.href='<?php echo URLROOT ?>/scholarship/postedScholarships'">Go Back</button> -->
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
                    <h3>Edit Posted Scholarships</h3>
                    <p>Edit Your Scholarships</p>
                </div>

                <!-- Add Scholarship Form -->
                <div class="add-scholarship-form">
                    <form action="<?php echo URLROOT ?>/scholarship/editPostedScholarships" method="POST">

                        <input type="text" name="scholarshipID" value="<?php echo $data['scholarshipID']?>" hidden required>
                    
                        <!-- Title -->
                        <div class="scholarship-first-div">
                            <label for="titleScholarship">Scholarship Title</label>
                            <input type="text" id="titleScholarship" name="titleScholarship" value="<?php print_r($data['scholarship_details']->title); ?>">

                            <!-- Scholarship Title Error display -->
                            <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['titleScholarship_err']) ? $data['titleScholarship_err']: ''; ?></span>
                        </div>

                        <!-- Amount -->
                        <div class="scholarship-second-div">
                            <label for="amountScholarship">Scholarship Amount (In LKR)</label>
                            <input type="text" id="amountScholarship" name="amountScholarship" value="<?php print_r($data['scholarship_details']->amount); ?>">

                            <!-- Scholarship Amount Error Display -->
                            <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['amountScholarship_err']) ? $data['amountScholarship_err']: ''; ?> </span>
                        </div>
                        
                        <!-- Dates -->
                        <div class="scholarship-third-div">
                            <div class="scholarship-third-div-two-input-one-line">
                                <div class="add-scholarship-first-div">
                                    <label for="startDateScholarship">Scholarship Starting Date</label>
                                    <?php
                                        // Format the startDate value for display in the input field
                                        $startDateFormatted = !empty($data['scholarship_details']->startDate) ? date('Y-m-d', strtotime($data['scholarship_details']->startDate)) : '';
                                    ?>
                                    <input type="date" id="startDateScholarship" name="startDateScholarship" value="<?php print_r($startDateFormatted); ?>">

                                    <!-- Satrt Date Error display -->
                                    <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['startDateScholarship_err']) ? $data['startDateScholarship_err']: ''; ?></span>                                                
                                </div>

                                <div class="add-scholarship-second-div">
                                    <label for="durationScholarship">Duration (In Months)</label>
                                    <input type="number" id="durationScholarship" name="durationScholarship" value="<?php print_r($data['scholarship_details']->duration); ?>">

                                    <!-- Duration Error display -->
                                    <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['durationScholarship_err']) ? $data['durationScholarship_err']: ''; ?></span> 
                                </div>
                            </div>
                        </div>

                        <!-- Deadline -->
                        <div class="scholarship-forth-div">
                            <label for="deadlineScholarship">Application Deadline </label>
                            <input type="datetime-local" id="deadlineScholarship" name="deadlineScholarship" value="<?php print_r($data['scholarship_details']->deadline); ?>" >

                            <!-- Deadline Error Display -->
                            <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['deadlineScholarship_err']) ? $data['deadlineScholarship_err']: ''; ?> </span>
                        </div>                                

                        <!-- Description about scholarship -->
                        <div class="add-scholarship-text-area-input-to-oneline">
                            <label for="scholarshipDescription">Description</label>
                            <textarea name="scholarshipDescription" id="scholarshipDescription" cols="30" rows="10"><?php print_r($data['scholarship_details']->description); ?></textarea>

                            <!-- Scholarship description error display -->
                            <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['scholarshipDescription_err']) ? $data['scholarshipDescription_err']: ''; ?></span>
                        </div>
                        
                        <!-- Add Button for scholarship -->
                        <div class="add-scholarship-add-button">
                            <input type="submit" value="Update" >
                        </div>
                    </form>
                </div>
            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <?php require APPROOT.'/views/inc/components/giveonluforneedbar.php'; ?>

        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<?php if (isset($data['success']) && $data['success']) : ?>
    <script>
        Swal.fire({
            position: "top",
            title: "Scholarship Updated Successfully!",
            showConfirmButton: false,
            timer: 1500,

            didOpen: () => {
                // Apply custom CSS styles using JavaScript
                const swalContainer = document.querySelector('.swal2-popup');
                if (swalContainer) {
                    swalContainer.style.border = '3px solid #00FF80';
                    swalContainer.style.backgroundColor = '#f9f9f9';
                }
                const swalTitle = document.querySelector('.swal2-title');
                if (swalTitle) {
                    swalTitle.style.fontSize = '15px';
                }
            }
        });
    </script>

<?php elseif (isset($data['fail']) && $data['fail']): ?>
    <script>
        Swal.fire({
            position: "top",
            title: "Scholarship Update Failed !",
            showConfirmButton: false,
            timer: 1500,

            didOpen: () => {
                // Apply custom CSS styles using JavaScript
                const swalContainer = document.querySelector('.swal2-popup');
                if (swalContainer) {
                    swalContainer.style.border = '3px solid red'; // Customize error border color
                    swalContainer.style.backgroundColor = '#f9f9f9';
                }
                const swalTitle = document.querySelector('.swal2-title');
                if (swalTitle) {
                    swalTitle.style.fontSize = '15px';
                }
            }
        });
    </script>
<?php endif; ?>

<?php require APPROOT.'/views/inc/footer.php'; ?>