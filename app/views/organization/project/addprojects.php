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

                        <!-- First line of form -->
                        <div class="add-projects-add-more-field-input">
                            <div class="project-first-div">
                                <label for="projectsmilestones"> Project MileStones</label>
                                <input type="text" id="projectsmilestones" name="projectsmilestones" value="<?php echo isset($data['projectsmilestones']) ? $data['projectsmilestones'] : ''; ?>">
                                <!-- Monetary necessity Error display -->
                                <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['projectsmilestones_err']) ? $data['projectsmilestones_err']: ''; ?></span>
                            </div>
                            <div class="project-second-div">
                                <label for="milestonebudget">MileStone Budget</label>
                                <input type="number" id="milestonebudget" name="milestonebudget" value="<?php echo isset($data['milestonebudget']) ? $data['milestonebudget'] : ''; ?>" min="25">
                                <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['milestonebudget_err']) ? $data['milestonebudget_err']: ''; ?></span>
                            </div>
                            <div class="project-third-div">
                                <button>Add</button>
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

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
