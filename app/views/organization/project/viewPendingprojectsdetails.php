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
                    <h3>View Projects</h3>
                    <p>View information about posted Projects and the donation received.</p>
                </div>

                <!-- <p style="margin-top: 30%;">Necessity ID: <?php echo $data['pendingNecessityDetails']->necessityID; ?></p> -->
                <!-- value="<?php echo $data['pendingNecessityDetails']->projectID ; ?>" -->

                <div class="posted-project-accordian-view">
                    <!-- display project name -->
                    <div class="project-name-and-description-to-view-project-name">
                        <h3>Project Name</h3>
                    </div>
                    <!-- Display project description -->
                    <div class="project-name-and-description-to-view-project-des">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Eos sed in odit inventore suscipit numquam eius magni architecto 
                            consequatur soluta iure eum temporibus itaque enim consequuntur, 
                            repellendus quia quod culpa.
                        </p>
                    </div>

                    <!-- Display the list of milestone -->
                    <div class="accordian-milestone">
                        <!-- This represent a one milestone -->
                        <div>
                            <input type="radio" name="milestoneSection" id="milestoneIndex1">
                            <label for="milestoneIndex1" class="accordian-milestone-label"><h4>Milestone #1</h4></label>
                            <div class="addordian-milestone-content">
                                <div class="addordian-milestone-images">
                                    <div class="addorian-image1">
                                        <img src="<?php echo URLROOT ?>/img/Asset_1hif_1.png">
                                    </div>
                                    <div class="addorian-image2">
                                        <img src="<?php echo URLROOT ?>/img/placeholder-benefaction1.png">
                                    </div>
                                </div>

                                <p>Budget for milestone</p>
                                
                                <p>
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                                    Eos sed in odit inventore suscipit numquam eius magni architecto 
                                    consequatur soluta iure eum temporibus itaque enim consequuntur, 
                                    repellendus quia quod culpa.
                                </p>
                            </div>
                        </div>
                        <!-- This represent a one milestone -->  
                    </div>
                </div>

                
                <div class="posted-necessity-view-table-edit-and-delete-buttons-row">
                    <form action="<?php echo URLROOT ?>" method="post">
                        <input type="hidden" name="projectID" id="projectID"/>
                        <button type="submit">
                            <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg" class="ncessity-view-table-edit-button-img">
                            <p>Edit</p>
                        </button>
                    </form>

                    <form action="<?php echo URLROOT ?>/project/deleteProjects" method="post" onsubmit="return confirmDelete();">
                        <input type="hidden" name="projectID" id="projectID"/>
                        <button type="submit">
                            <img src="<?php echo URLROOT ?>/img/trash-solid.svg" class="ncessity-view-table-delete-button-img">
                            <p>Delete</p>
                        </button>
                    </form>
                </div>

            </div> 

            <!-- right side bar for success story/ choose or add necessity -->
            <div class="rightside-bar-type-one">
                <div class="right-side-bar">
                    

                </div>
            </div>

        </div>
    </section>
</main>

<script>
    

    function confirmDelete() {
        return confirm("Are you sure you want to delete this?");
    }
</script>

<?php require APPROOT.'/views/inc/footer.php'; ?>
