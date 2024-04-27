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
                    <!-- <button onclick="goBack()">Go Back</button>

                    <script>
                        function goBack() {
                            // Use history.back() to navigate to the previous page in history
                            history.back();
                        }
                    </script> -->
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

                                <!-- Category -->
                                <div class="benefaction-forth-div">
                                    <label for="benefactionCategory">Category </label>
                                    <div class="select-box">
                                        <select id="benefactionCategory" name="benefactionCategory" value="<?php echo isset($data['benefactionCategory']) ? $data['benefactionCategory'] : ''; ?>">
                                            <option value="0" >
                                                Select Category
                                            </option>
                                            <!-- &#13 -> use for break the content of title attribute -->
                                            <option value="1" title="Pencils&#13Pens&#13Notebooks&#13Textbooks&#13Calculators&#13Educational software&#13Interactive whiteboards&#13Microscopes&#13Lab equipment&#13Robotics kits&#13Coding software&#13Coding software&#13Laptops&#13 3D printers">
                                                Educational Supplies and Tools
                                            </option>
                                            <!-- &#13 -> use for break the content of title attribute -->
                                            <option value="2" title="School Uniforms&#13T-shirts&#13Pants&#13Shoes&#13Backpacks&#13Hats">
                                                Clothing and Accessories
                                            </option>
                                            <!-- &#13 -> use for break the content of title attribute -->
                                            <option value="3" title="Soccer balls&#13Basketballs&#13Gymnastics mats&#13Tennis rackets&#13Bicycles&#13Skateboards">
                                                Recreation and Sports Equipment
                                            </option>
                                            <!-- &#13 -> use for break the content of title attribute -->
                                            <option value="4" title="Hygiene products (e.g., soap, toothpaste)&#13Hand sanitizer&#13Yoga mats">
                                                Health and Wellness Products
                                            </option>
                                            <!-- &#13 -> use for break the content of title attribute -->
                                            <option value="5" title="Bicycles&#13Wheelchairs&#13Scooters&#13Crutches&#13Walking canes">
                                                Transportation and Mobility
                                            </option>
                                            <!-- &#13 -> use for break the content of title attribute -->
                                            <option value="6" title="Fiction books&#13Non-fiction books&#13Language learning materials&#13Dictionaries&#13E-readers&#13Audiobooks">
                                                Literature and Reading Materials
                                            </option>
                                            <!-- &#13 -> use for break the content of title attribute -->
                                            <option value="other">
                                                Other
                                            </option>
                                        </select>                                        
                                    </div>
 
                                    <!-- Requested Amount Error Display -->
                                    <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['benefactionCategory_err']) ? $data['benefactionCategory_err']: ''; ?> </span>
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
                                                    <input type="file" id="photoBenfaction1" name="photoBenfaction1" accept="image/png, image/jpeg, image/jpg" onchange="handleImageType(this)" style="display:none;" />
                                                    <p class='file_info' style="font-size:13px; ">Image 1</p>
                                                </label> 
                                            </div>
                                            <div class="add-benefaction-second-div">
                                                <label class="add-benefaction-box">
                                                    <input type="file" id="photoBenfaction2" name="photoBenfaction2" accept="image/png, image/jpeg, image/jpg" onchange="handleImageType(this)" style="display:none;" />
                                                    <p class='file_info' style="font-size:13px; ">Image 2</p>
                                                </label> 
                                            </div>
                                            <div class="add-benefaction-third-div">
                                                <label class="add-benefaction-box">
                                                    <input type="file" id="photoBenfaction3" name="photoBenfaction3" accept="image/png, image/jpeg, image/jpg" onchange="handleImageType(this)" style="display:none;" />
                                                    <p class='file_info' style="font-size:13px; ">Image 2</p>
                                                </label> 
                                            </div>
                                            <div class="add-benefaction-fourth-div">
                                                <label class="add-benefaction-box">
                                                    <input type="file" id="photoBenfaction4" name="photoBenfaction4" accept="image/png, image/jpeg, image/jpg" onchange="handleImageType(this)" style="display:none;" />
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

            <!-- right side bar for Requests -->
            <div class="add-benefaction-right-side-bar">
                <div class="add-benefaction-right-side-bar-inner">  
                    <!-- Topic -->
                    <div class="add-benefaction-right-side-bar-topic">
                        <h3>Items Included in Benfaction Categories </h3>
                        <div class="add-benefaction-right-side-bar-grey-line"> </div>
                    </div>  
                    
                    <!-- Display add-benefactions or no add-benefactions message -->
                    <div class="add-benefaction-right-side-bar-all-add-benefactions">
                        <div class="add-benefaction-right-side-bar-all-add-benefactions-inner">
                            <div class="add-benefaction-right-side-bar-all-add-benefactions-inner-content">
                                <h3>Educational Supplies and Tools</h3>
                                <p>Pencils, Pens, Notebooks, Textbooks, Calculators, Educational software, Interactive whiteboards, Microscopes, Lab equipment, Robotics kits, Coding software, Coding software, Laptops, 3D printers</p>
                            </div>
                            <div class="add-benefaction-right-side-bar-all-add-benefactions-inner-content">
                                <h3>Clothing and Accessories</h3>
                                <p>School Uniforms, T-shirts, Pants, Shoes, Backpacks, Hats</p>
                            </div>
                            <div class="add-benefaction-right-side-bar-all-add-benefactions-inner-content">
                                <h3>Recreation and Sports Equipment</h3>
                                <p>Soccer balls, Basketballs, Gymnastics mats, Tennis rackets, Bicycles, Skateboards</p>
                            </div>
                            <div class="add-benefaction-right-side-bar-all-add-benefactions-inner-content">
                                <h3>Health and Wellness Products</h3>
                                <p>Hygiene products (e.g., soap, toothpaste), Hand sanitizer, Yoga mats</p>
                            </div>
                            <div class="add-benefaction-right-side-bar-all-add-benefactions-inner-content">
                                <h3>Transportation and Mobility</h3>
                                <p>Bicycles, Wheelchairs, Scooters, Crutches, Walking canes</p>
                            </div>
                            <div class="add-benefaction-right-side-bar-all-add-benefactions-inner-content">
                                <h3>Literature and Reading Materials</h3>
                                <p>Fiction books, Non-fiction books, Language learning materials, Dictionaries, E-readers, Audiobooks</p>
                            </div>
                            <div class="add-benefaction-right-side-bar-all-add-benefactions-inner-content">
                                <h3>Other</h3>
                                <p>Any other items that do not fall into the above categories</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  

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

        document.addEventListener('DOMContentLoaded', function() {
            // Select all file input elements with class 'file-input'
            const fileInputs = document.querySelectorAll('.add-benefaction-box input[type="file"]');

            // Loop through each file input element
            fileInputs.forEach(function(input) {
                // Add onchange event listener to each file input element
                input.addEventListener('change', function() {
                    handleImageType(this); // Call handleImageType function with the current input element
                });
            });
        });

        function handleImageType(input){
            validateFileType(input);
            imageBox(input);
        }

        function validateFileType(input) {
            const file = input.files[0];
            const fileType = file ? file.type : '';

            // Check if the selected file type is an image
            if (!fileType.startsWith('image/')) {
                alert('Please select an image file (PNG, JPEG, JPG)');
                input.value = ''; // Clear the selected file
            }
        }

        function imageBox(input) {
        const parentLabel = input.parentElement;
        const parentDiv = parentLabel.parentElement;

        // Get the file from the input element
        const file = input.files[0];

        // Check if file type is valid (starts with 'image/')
        if (file && file.type.startsWith('image/')) {
            // Apply styling to the parent label (add-benefaction-box)
            parentLabel.style.border = '1px dashed red';
            parentLabel.style.backgroundColor = 'rgb(249, 224, 209)';
            parentLabel.style.color = 'rgb(213, 83, 7)';
        } else {
            // Apply default styling to the parent label (add-benefaction-box)
            parentLabel.style.border = '1px dashed red';
            parentLabel.style.backgroundColor = 'white';
            parentLabel.style.color = 'rgb(255, 0, 0)';
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


        // Select Box Customization
        var x, i, j, l, ll, selElmnt, a, b, c;

        /*look for any elements with the class "select-box":*/
        x = document.getElementsByClassName("select-box");
        l = x.length;

        for (i = 0; i < l; i++) {
            selElmnt = x[i].getElementsByTagName("select")[0];
            ll = selElmnt.length;

            /*for each element, create a new DIV that will act as the selected item:*/
            a = document.createElement("DIV");
            a.setAttribute("class", "select-selected");
            a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
            x[i].appendChild(a);

            /*for each element, create a new DIV that will contain the option list:*/
            b = document.createElement("DIV");
            b.setAttribute("class", "select-items select-hide");

            for (j = 1; j < ll; j++) {
                /*for each option in the original select element,
                create a new DIV that will act as an option item:*/
                c = document.createElement("DIV");
                c.innerHTML = selElmnt.options[j].innerHTML;
                c.addEventListener("click", function(e) {
                    /*when an item is clicked, update the original select box,
                    and the selected item:*/
                    var y, i, k, s, h, sl, yl;
                    s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                    sl = s.length;
                    h = this.parentNode.previousSibling;
                    for (i = 0; i < sl; i++) {
                        if (s.options[i].innerHTML == this.innerHTML) {
                            s.selectedIndex = i;
                            h.innerHTML = this.innerHTML;
                            y = this.parentNode.getElementsByClassName("same-as-selected");
                            yl = y.length;
                            for (k = 0; k < yl; k++) {
                            y[k].removeAttribute("class");
                            }
                            this.setAttribute("class", "same-as-selected");
                            break;
                        }
                    }
                    h.click();
                });
                b.appendChild(c);
            }
            x[i].appendChild(b);
            a.addEventListener("click", function(e) {
                /*when the select box is clicked, close any other select boxes,
                and open/close the current select box:*/
                e.stopPropagation();
                closeAllSelect(this);
                this.nextSibling.classList.toggle("select-hide");
                this.classList.toggle("select-arrow-active");
                });
        }

        function closeAllSelect(elmnt) {
            /*a function that will close all select boxes in the document,except the current select box:*/
            var x, y, i, xl, yl, arrNo = [];
            x = document.getElementsByClassName("select-items");
            y = document.getElementsByClassName("select-selected");
            xl = x.length;
            yl = y.length;
            for (i = 0; i < yl; i++) {
                if (elmnt == y[i]) {
                arrNo.push(i)
                } else {
                y[i].classList.remove("select-arrow-active");
                }
            }
            for (i = 0; i < xl; i++) {
                if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
                }
            }
        }
        /*if the user clicks anywhere outside the select box,then close all select boxes:*/
        document.addEventListener("click", closeAllSelect);


</script>

<?php require APPROOT.'/views/inc/footer.php'; ?>