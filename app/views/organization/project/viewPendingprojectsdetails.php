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
                <!-- value="<?php echo $data['ongingProjectDetails']->projectID ; ?>" -->

                <div class="posted-project-accordian-view">
                    <!-- display project name -->
                    <div class="project-name-and-description-to-view-project-name">
                        <h3><?php echo $data['ongingProjectDetails']->title ; ?></h3>
                    </div>
                    <!-- Display project description -->
                    <div class="project-name-and-description-to-view-project-des">
                        <p><?php echo $data['ongingProjectDetails']->project_description ; ?></p>
                    </div>

                    <!-- Display the list of milestone -->
                    <div class="accordian-milestone">
                        <!-- This represent a one milestone -->
                        <?php foreach($data['ongoingmilestonedetails'] as $index => $milestone): ?>
                            <div>
                                <input type="radio" name="milestoneSection" id="milestoneIndex<?php echo $index; ?>">
                                <label for="milestoneIndex<?php echo $index; ?>" class="accordian-milestone-label">
                                    <h4><?php echo $milestone->milestoneName ; ?></h4>
                                </label>
                                <div class="addordian-milestone-content">
                                    <div class="addordian-milestone-images">
                                        <div class="addorian-image1">
                                            <img src="<?php echo URLROOT ?>/projectmilestoneuploadedimages/<?php echo $milestone->img1 ; ?>">
                                        </div>
                                        <div class="addorian-image2">
                                            <img src="<?php echo URLROOT ?>/projectmilestoneuploadedimages/<?php echo $milestone->img2 ; ?>">
                                        </div>
                                    </div>

                                    <p>Rs.<?php echo number_format($milestone->amount, 2) ; ?></p>
                                    
                                    <p><?php echo $milestone->milestone_description ; ?></p>
                                </div>
                            </div>
                            <?php endforeach; ?>
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

                    <form action="<?php echo URLROOT ?>/project/deleteOngoingandCompleteProjects" method="post" class="delete-form" id="delete">
                        <input type="hidden" name="projectID" id="projectID" value="<?php echo $data['ongingProjectDetails']->projectID; ?>"/>
                        <button type="submit" onclick="confirmDecline(event)">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Function to handle delete confirmation
    function confirmDelete(event) {
        event.preventDefault(); // Prevent default form submission

        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to delete this Pending Project. This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with form submission
                const form = event.target.closest('form'); // Find the closest form element
                if (form) {
                    form.submit(); // Submit the form
                }
            }
        });
    }

    // Bind the confirmDelete function to form submission events
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('.delete-form'); // Select all delete forms
        deleteForms.forEach(form => {
            form.addEventListener('submit', confirmDelete); // Attach confirmDelete to form submission
        });
    });
</script>

<?php require APPROOT.'/views/inc/footer.php'; ?>
