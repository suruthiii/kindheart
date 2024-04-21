<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "projects";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

            <!-- Middle container -->
            <div class="middle-container">
                <!-- Go Back Button -->
                <div class="goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <button onclick="location.href='<?php echo URLROOT ?>/project/postedprojects'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>Add Projects</h3>
                    <p>Enter correct information and add your project.</p>
                </div>

                <!-- Add Monetary Neceessity Form -->
                <div class="add-necessity-form">
                    <form enctype="multipart/form-data" action="<?php echo URLROOT ?>/project/addprojects" method="POST" onsubmit="return validateFileType()">
                        <!-- Project title -->
                        <div class="add-necessity-one-line-input">
                            <label for="projectTitle">Project Title</label>
                            <input type="text" id="projectTitle" name="projectTitle" title="Title of the project" value="<?php echo isset($data['projectTitle']) ? $data['projectTitle'] : ''; ?>">
                            <!-- Requested Amount Error Display -->
                            <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['projectTitle_err']) ? $data['projectTitle_err']: ''; ?></span>
                        </div>
                        
                        <div id="form-container">
                            <div class="dynamic-input-block">
                                <!-- First line of form -->
                                <div class="add-projects-add-more-field-input" id="add-more-milestone" name="add-more-milestone">
                                    <div class="project-first-div">
                                        <label for="projectsmilestones"> Project MileStones</label>
                                        <input type="text" id="projectsmilestones[]" name="projectsmilestones[]" value="<?php echo isset($data['projectsmilestones']) ? $data['projectsmilestones'] : ''; ?>">
                                        <!-- Monetary necessity Error display -->
                                        <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['projectsmilestones_err']) ? $data['projectsmilestones_err']: ''; ?></span>
                                    </div>
                                    <div class="project-second-div">
                                        <label for="milestonebudget">MileStone Budget</label>
                                        <input type="number" id="milestonebudget[]" name="milestonebudget[]" value="<?php echo isset($data['milestonebudget']) ? $data['milestonebudget'] : ''; ?>" min="25">
                                        <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['milestonebudget_err']) ? $data['milestonebudget_err']: ''; ?></span>
                                    </div>
                                </div>
                                <!-- Description about each project mile stone -->
                                <div class="add-projects-text-area-input-to-oneline" name="add-projects-text-area-input-to-oneline" id="add-projects-text-area-input-to-oneline">
                                    <label for="milestonedescription">Milestone Description</label>
                                    <textarea name="milestonedescription[]" id="milestonedescription[]" cols="30" rows="10" title="An explanation of project"><?php echo isset($data['milestonedescription']) ? $data['milestonedescription'] : ''; ?></textarea>
                                </div>
                                <!-- Adding Images -->
                                <div class="project-milestones-images">
                                    <label>Add Images</label>
                                </div>
                                <div class="add-project-one-line-second-type-input">
                                    <div class="projects-first-div">
                                        <input type="file" id="firstprojectImages[]" name="firstprojectImages[]" title="Add Image" accept="image/png, image/jpeg, image/jpg">
                                        <!-- Recurring start date error display -->
                                        <!-- <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['recurringstartdate_err']) ? $data['recurringstartdate_err']: ''; ?></span> -->
                                    </div>
                                    <div class="projects-second-div">
                                        <input type="file" id="seconprojectImages[]" name="seconprojectImages[]" title="Add Image" accept="image/png, image/jpeg, image/jpg">
                                        <!-- Recurring End date error display -->
                                        <!-- <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['recurringenddate_err']) ? $data['recurringenddate_err']: ''; ?></span> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="add-more-project-milestones">
                            <button id="add-milestones-button" name="add-milestones-button">Add MileStone</button>
                            <button id="remove-milestones-button" name="remove-milestones-button">Remove MileStone</button>
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

<script>
        document.addEventListener('DOMContentLoaded', function () {
            const formContainer = document.getElementById('form-container');

            // Function to create a new milestone block
            function createMilestoneBlock() {
                const milestoneBlock = document.createElement('div');
                milestoneBlock.className = 'dynamic-input-block';

                // First line of form
                const firstLine = document.createElement('div');
                firstLine.className = 'add-projects-add-more-field-input';
                firstLine.innerHTML = `
                    <div class="project-first-div">
                        <label for="projectsmilestones"> Project MileStones</label>
                        <input type="text" id="projectsmilestones[]" name="projectsmilestones[]" value="">
                        <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"></span>
                    </div>
                    <div class="project-second-div">
                        <label for="milestonebudget">MileStone Budget</label>
                        <input type="number" id="milestonebudget[]" name="milestonebudget[]" value="" min="25">
                        <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"></span>
                    </div>
                `;
                milestoneBlock.appendChild(firstLine);

                // Description about each project mile stone
                const descriptionLine = document.createElement('div');
                descriptionLine.className = 'add-projects-text-area-input-to-oneline';
                descriptionLine.innerHTML = `
                    <label for="milestonedescription">Milestone Description</label>
                    <textarea name="milestonedescription" id="milestonedescription" cols="30" rows="10" title="An explanation of project"></textarea>
                `;
                milestoneBlock.appendChild(descriptionLine);

                // Image about each project mile stone
                const ImageLine = document.createElement('div');
                ImageLine.className = 'add-project-one-line-second-type-input';
                ImageLine.innerHTML = `
                <div class="projects-first-div">
                    <input type="file" id="firstprojectImages[]" name="firstprojectImages[]" title="Add Image" accept="image/png, image/jpeg, image/jpg">
                    <!-- Recurring start date error display -->
                    <!-- <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['recurringstartdate_err']) ? $data['recurringstartdate_err']: ''; ?></span> -->
                </div>
                <div class="projects-second-div">
                    <input type="file" id="seconprojectImages[]" name="seconprojectImages[]" title="Add Image" accept="image/png, image/jpeg, image/jpg">
                    <!-- Recurring End date error display -->
                    <!-- <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['recurringenddate_err']) ? $data['recurringenddate_err']: ''; ?></span> -->
                </div>
                `;
                milestoneBlock.appendChild(ImageLine);

                return milestoneBlock;
            }

            // Function to add a new milestone block
            function addMilestoneBlock() {
                const newBlock = createMilestoneBlock();
                formContainer.appendChild(newBlock);
            }

            // Event listener for adding milestone block
            document.getElementById('add-milestones-button').addEventListener('click', function (event) {
                event.preventDefault(); // Prevent form submission
                addMilestoneBlock();
            });

            // Function to remove the last milestone field
            function removeLastMilestoneBlock() {
                const milestoneBlocks = document.querySelectorAll('.dynamic-input-block');
                if (milestoneBlocks.length > 1) {
                    const lastBlock = milestoneBlocks[milestoneBlocks.length - 1];
                    formContainer.removeChild(lastBlock);
                }
            }

            // Event listener for removing last added milestone block
            document.getElementById('remove-milestones-button').addEventListener('click', function (event) {
                event.preventDefault();
                removeLastMilestoneBlock();
            });

        });

        function display_image_name(input, index) {
            if (input.files && input.files[0]) {
                var filename = input.files[0].name;
                var parentBlock = input.closest('.dynamic-input-block');
                var label = parentBlock.querySelectorAll('.project-file-upload-label')[index];
                label.querySelector('.project-file-upload-label-icon-text').innerText = filename;
            }
        }
    </script>


<?php require APPROOT.'/views/inc/footer.php'; ?>
