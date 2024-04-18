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
                    <form enctype="multipart/form-data" action="<?php echo URLROOT ?>/project/addprojects" method="POST" onsubmit="return validateForm()">
                        <!-- Project title -->
                        <div class="add-necessity-one-line-input">
                            <label for="projectTitle">Project Title</label>
                            <input type="text" id="projectTitle" name="projectTitle" title="Title of the project" value="<?php echo isset($data['projectTitle']) ? $data['projectTitle'] : ''; ?>">
                            <!-- Requested Amount Error Display -->
                            <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['projectTitle_err']) ? $data['projectTitle_err']: ''; ?></span>
                        </div>

                        <!-- Description about requested necessity -->
                        <div class="add-necessity-text-area-input-to-oneline">
                            <label for="projectdescription">Description</label>
                            <textarea name="projectdescription" id="projectdescription" cols="30" rows="10" title="An explanation of project"><?php echo isset($data['projectdescription']) ? $data['projectdescription'] : ''; ?></textarea>
                            <!-- Neccessity description error display -->
                            <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['projectdescription_err']) ? $data['projectdescription_err']: ''; ?></span>
                        </div>
                        
                        <div id="form-container">
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
        // Function to add a new milestone field
        function addMilestoneField() {
            const formContainer = document.getElementById('form-container');
            const newField = document.createElement('div');
            newField.className = 'add-projects-add-more-field-input';
            newField.innerHTML = `
                <div class="project-first-div">
                    <label for="projectsmilestones">Project Milestones</label>
                    <input type="text" name="projectsmilestones[]" value="">
                    <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"></span>
                </div>
                <div class="project-second-div">
                    <label for="milestonebudget">Milestone Budget</label>
                    <input type="number" name="milestonebudget[]" value="" min="25">
                    <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"></span>
                </div>
            `;
            formContainer.appendChild(newField);
            checkMilestoneFieldCount();
        }

        function removeLastMilestoneField() {
            const formContainer = document.getElementById('form-container');
            const milestoneFields = formContainer.getElementsByClassName('add-projects-add-more-field-input');
            const lastField = milestoneFields[milestoneFields.length - 1];
            if (lastField !== null) {
                formContainer.removeChild(lastField);
            }
            checkMilestoneFieldCount();
        }

        // Event listener for adding milestone fields
        document.getElementById('add-milestones-button').addEventListener('click', function (event) {
            event.preventDefault(); // Prevent form submission
            addMilestoneField();
        });


        // Event listener for removing the last added milestone field
        document.getElementById('remove-milestones-button').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent form submission
            removeLastMilestoneField();
        });

        // Function to check the number of added milestone fields and disable the "remove MileStone" button if there are none
        function checkMilestoneFieldCount() {
            const milestoneFieldsCount = document.getElementsByClassName('add-projects-add-more-field-input').length;
            const removeButton = document.getElementById('remove-milestones-button');
            if (milestoneFieldsCount === 1) {
                removeButton.disabled = true;
            } else {
                removeButton.disabled = false;
            }
        }

        // Call the checkMilestoneFieldCount function to disable the "remove MileStone" button initially if there are no added fields
        checkMilestoneFieldCount();
        
    });
</script>




<?php require APPROOT.'/views/inc/footer.php'; ?>
