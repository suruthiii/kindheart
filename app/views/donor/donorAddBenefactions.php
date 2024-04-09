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
                    <button onclick="location.href='<?php echo URLROOT ?>/benefaction/postedBenefactions'">Go Back</button>
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
                            <form enctype="multipart/form-data" action="<?php echo URLROOT ?>/benefaction/donorAddBenefactions" method="POST" onsubmit="return validateForm()">
                            
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
                                    <input type="number" id="quantityBenfaction" name="quantityBenfaction" value="<?php echo isset($data['quantityBenfaction']) ? $data['quantityBenfaction'] : ''; ?>" min="1">

                                    <!-- Requested Amount Error Display -->
                                    <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['quantityBenfaction_err']) ? $data['quantityBenfaction_err']: ''; ?> </span>
                                </div>
                                
                                <!-- Images -->
                                <div class="benefaction-third-div">
                                    <label for="photoBenfaction">Photos of The Item </label>
                                    <div class="benefaction-third-div-four-input-one-line">
                                            <div class="add-benefaction-first-div">
                                                <label class="add-benefaction-box">
                                                    <input type="file" id="photoBenfaction1" name="photoBenfaction1" accept="image/png, image/jpeg, image/jpg" onchange="validateFileType(this)" style="display:none;" />
                                                    <p class='file_info' style="font-size:13px; ">Image 1</p>
                                                </label> 
                                            </div>
                                            <div class="add-benefaction-second-div">
                                                <label class="add-benefaction-box">
                                                    <input type="file" id="photoBenfaction2" name="photoBenfaction2" accept="image/png, image/jpeg, image/jpg" onchange="validateFileType(this)" style="display:none;" />
                                                    <p class='file_info' style="font-size:13px; ">Image 2</p>
                                                </label> 
                                            </div>
                                            <div class="add-benefaction-third-div">
                                                <label class="add-benefaction-box">
                                                    <input type="file" id="photoBenfaction3" name="photoBenfaction3" accept="image/png, image/jpeg, image/jpg" onchange="validateFileType(this)" style="display:none;" />
                                                    <p class='file_info' style="font-size:13px; ">Image 2</p>
                                                </label> 
                                            </div>
                                            <div class="add-benefaction-fourth-div">
                                                <label class="add-benefaction-box">
                                                    <input type="file" id="photoBenfaction4" name="photoBenfaction4" accept="image/png, image/jpeg, image/jpg" onchange="validateFileType(this)" style="display:none;" />
                                                    <p class='file_info' style="font-size:13px; ">Image 4</p>
                                                </label> 
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
                                    <input type="submit" value="+ Add" >
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Right column for chosen-photos-container -->
                    <div class="right-column">
                        <div class="right-column-inner">
                            <div class="chosen-photos-container" id="chosen-photos-container1">
                                <img id="placeholderImage" src="<?php echo URLROOT ?>/img/placeholder-benefaction1.png" alt="Placeholder Image" />
                            </div>
                            <div class="chosen-photos-container" id="chosen-photos-container2">
                                <img id="placeholderImage" src="<?php echo URLROOT ?>/img/placeholder-benefaction2.png" alt="Placeholder Image" />
                            </div>
                            <div class="chosen-photos-container" id="chosen-photos-container3">
                                <img id="placeholderImage" src="<?php echo URLROOT ?>/img/placeholder-benefaction3.png" alt="Placeholder Image" />
                            </div>
                            <div class="chosen-photos-container" id="chosen-photos-container4">
                                <img id="placeholderImage" src="<?php echo URLROOT ?>/img/placeholder-benefaction4.png" alt="Placeholder Image" />
                            </div>
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

        function validateFileType(input) {
            const file = input.files[0];
            const fileType = file.type;

            // Check if the selected file type is an image
            if (!fileType.startsWith('image/')) {
                alert('Please select an image file (PNG, JPEG)');
                input.value = ''; // Clear the selected file
            }
        }

        // Function to handle file input change
        function handleFileInputChange(inputId, containerId) {
            const input = document.getElementById(inputId);
            const container = document.getElementById(containerId);
            const placeholderImage = document.getElementById('placeholderImage');

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
                    image.style.maxWidth = '300px'; 
                    image.style.maxHeight = '300px';
                    image.style.backgroundColor = '#F5F5F5';
                    image.style.boxShadow = '0px 4px 4px rgba(142, 0, 0, 0.25)';
                    image.style.border = '2px solid #8E0000';
                    image.style.margin = '10px';


                    // Append image to container
                    container.appendChild(image);
                }

                // Hide the placeholder image
                placeholderImage.style.display = 'none';
            });
        }

        // Call the function for each file input
        handleFileInputChange('photoBenfaction1', 'chosen-photos-container1');
        handleFileInputChange('photoBenfaction2', 'chosen-photos-container2');
        handleFileInputChange('photoBenfaction3', 'chosen-photos-container3');
        handleFileInputChange('photoBenfaction4', 'chosen-photos-container4');


</script>

<?php require APPROOT.'/views/inc/footer.php'; ?>