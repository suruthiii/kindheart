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
                    <button onclick="location.href='<?php echo URLROOT ?>/donor/postedBenefactions'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="donor-middle-container-title-typeone">
                    <h3>Add Benefactions</h3>
                    <p>Enter correct information and add your benefactions.</p>
                </div>

                <div class="two-column-container">
                    <!-- Left column for add-benefaction-form -->
                    <div class="left-column">
                        <!-- Add Benefaction Form -->
                        <div class="add-benefaction-form">
                            <form action="<?php echo URLROOT ?>/benefaction/donorAddBenefactions" method="POST" onsubmit="return validateForm()">
                            
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
                                
                                <!-- Images -->
                                <div class="benefaction-third-div">
                                    <label for="photoBenfaction">Photos of The Item </label>
                                    <div class="benefaction-third-div-four-input-one-line">
                                            <div class="add-benefaction-first-div">
                                                <input type="file" id="photoBenfaction1" name="photoBenfaction1" value="<?php echo isset($data['photoBenfaction1']) ? $data['photoBenfaction1'] : ''; ?>" accept=".png, .jpg, .jpeg" onchange="preview()">
                                            </div>
                                            <div class="add-benefaction-second-div">
                                                <input type="file" id="photoBenfaction2" name="photoBenfaction2" value="<?php echo isset($data['photoBenfaction2']) ? $data['photoBenfaction2'] : ''; ?>" accept=".png, .jpg, .jpeg">
                                            </div>
                                            <div class="add-benefaction-third-div">
                                                <input type="file" id="photoBenfaction3" name="photoBenfaction3" value="<?php echo isset($data['photoBenfaction3']) ? $data['photoBenfaction3'] : ''; ?>" accept=".png, .jpg, .jpeg">
                                            </div>
                                            <div class="add-benefaction-fourth-div">
                                                <input type="file" id="photoBenfaction4" name="photoBenfaction4" value="<?php echo isset($data['photoBenfaction4']) ? $data['photoBenfaction4'] : ''; ?>" accept=".png, .jpg, .jpeg">
                                            </div>
                                    </div>

                                        <!-- Requested Amount Error Display -->
                                        <span class="donor-form-error-details" id="photoBenfaction_err" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['photoBenfaction_err']) ? $data['photoBenfaction_err']: ''; ?></span>
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

                    <!-- Right column for chosen-photos-container -->
                    <div class="right-column">
                        <div class="chosen-photos-container" id="chosen-photos-container1">
                        </div>
                        <div class="chosen-photos-container" id="chosen-photos-container2">
                        </div>
                        <div class="chosen-photos-container" id="chosen-photos-container3">
                        </div>
                        <div class="chosen-photos-container" id="chosen-photos-container4">
                        </div>
                    </div>
                </div>

            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <?php require APPROOT.'/views/inc/components/askonluforneedbar.php'; ?>

        </div>
    </section>
</main>
<script>
        function validateForm() {
            var fileInput = document.getElementById('photoBenfaction');
            var errorMessage = document.getElementById('photoBenfaction_err');
            var fileName = fileInput.value;
            var acceptedExtensions = ['png', 'jpg', 'jpeg'];

            if (fileName) {
                var fileExtension = fileName.split('.').pop().toLowerCase();
                if (acceptedExtensions.indexOf(fileExtension) === -1) {
                    errorMessage.textContent = 'Please upload a PNG, JPG, or JPEG file.';
                    return false;
                }
            }

            return true;
        }

        // Function to handle file input change
        function handleFileInputChange(inputId, containerId) {
            const input = document.getElementById(inputId);
            const container = document.getElementById(containerId);

            input.addEventListener('change', function() {
                // Clear previous content
                container.innerHTML = '';

                // Loop through selected files
                for (const file of input.files) {
                    // Create image element
                    const image = document.createElement('img');
                    image.src = URL.createObjectURL(file);
                    image.alt = 'Chosen Photo';
                    image.classList.add('chosen-photo');

                    // Apply styles to adjust image size
                    image.style.maxWidth = '200px'; 
                    image.style.maxHeight = '200px';
                    image.style.transform = 'translateX(-25%)';
                    image.style.backgroundColor = '#F5F5F5';
                    image.style.boxShadow = '0px 4px 4px rgba(0, 0, 0, 0.25)';
                    image.style.border = '2px solid #292828';
                    image.style.margin = '10px';


                    // Append image to container
                    container.appendChild(image);
                }
            });
        }

        // Call the function for each file input
        handleFileInputChange('photoBenfaction1', 'chosen-photos-container1');
        handleFileInputChange('photoBenfaction2', 'chosen-photos-container2');
        handleFileInputChange('photoBenfaction3', 'chosen-photos-container3');
        handleFileInputChange('photoBenfaction4', 'chosen-photos-container4');


</script>

<?php require APPROOT.'/views/inc/footer.php'; ?>