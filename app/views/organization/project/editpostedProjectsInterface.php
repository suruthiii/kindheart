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
                    <h3>Edit Projects</h3>
                    <p>Update correct information and add your project.</p>
                </div>

                <!-- Add Monetary Neceessity Form -->
                <div class="add-necessity-form">
                    <form enctype="multipart/form-data" action="<?php echo URLROOT ?>/project/addprojects" method="POST">
                        <!-- Project title -->
                        <div class="add-necessity-one-line-input">
                            <label for="projectTitle">Project Title</label>
                            <input type="text" id="projectTitle" name="projectTitle" title="Title of the project" value="<?php echo isset($data['projectTitle']) ? $data['projectTitle'] : ''; ?>">
                            <!-- Requested Amount Error Display -->
                            <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['projectTitle_err']) ? $data['projectTitle_err']: ''; ?></span>
                        </div>

                        <!-- Description about project -->
                        <div class="add-necessity-text-area-input-to-oneline">
                            <label for="projectDescription">Description</label>
                            <textarea name="projectDescription" id="projectDescription" cols="30" rows="10" title="An explanation of overall Project"><?php echo isset($data['projectDescription']) ? $data['projectDescription'] : ''; ?></textarea>
                            <!-- Neccessity description error display -->
                            <span class="form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['projectDescription_err']) ? $data['projectDescription_err']: ''; ?></span>
                        </div>

                        <table>
                            <td>Title</td>
                            <td>Description</td>
                            <td>Budget</td>
                            
                        </table>


                        <!-- Add Button for necessity -->
                        <div class="add-necessity-add-button">
                            <!-- <input type="hidden" name="projectID" id="projectID" value="<?php echo $data['ongingProjectDetails']->projectID; ?>"/> -->
                            <input type="submit" value="Update">
                        </div>
                    </form>
                </div>

                

            </div>

            <!-- right side bar for success story/ choose or add necessity -->

            <div class="rightside-bar-type-one">
                <div class="right-side-bar">
                    <!-- Image -->
                    <div class="rightside-bar-type-one-image">
                        <img src="<?php echo URLROOT ?>/img/Asset_1hif_1.png">
                    </div>
                    <!-- Ask only for what you really need -->
                    <div class="rigntside-bar-type-one-description" style="padding-right: 10px;">
                        <h4>Let's Update Your Project</h4>
                        <p> We provide you the option to Update <b>Project Title, Project Description </b> on your Projects.
                            Update the Project Title/Description to Give better understanding to Donor
                        </p>
                        <p>Hope this will Help you.</p>
                    </div>

                </div>
            </div>

            <?php require APPROOT.'/views/inc/components/askonluforneedbar.php'; ?>

        </div>
    </section>
</main>


<?php require APPROOT.'/views/inc/footer.php'; ?>
