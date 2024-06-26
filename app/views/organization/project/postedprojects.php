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

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>Posted  Projects</h3>
                     
                </div>


                <!-- Pending table -->
                <div class="posted-necessity-pending-table-caption">
                    <p>Ongoing Projects</p>
                </div>
                <div class="posted-necessity-pending-table-grey-line"></div>
                <div class="posted-necessities-pending-table">
                    <table>
                        <?php foreach($data['pendingtablerow'] as $pendingtablerow): ?>
                            <tr>
                                <td>
                                    <img style="height: 55px;  width: 55px" src="<?php echo URLROOT ?>/img/project-management.png" alt="">
                                </td>
                                <td>
                                    <h4 class="pending-postednecessityTitle"><?php echo $pendingtablerow->title?></h4>
                                    <p class="pending-postednecessitydescription"><?php echo $pendingtablerow->description?></p>
                                </td>
                                <td><p>Rs. <?php echo number_format($pendingtablerow->budget, 2); ?></p></td>
                                <td>
                                    <form action="<?php echo URLROOT ?>/project/viewOngoingProjectDetails" method="POST">
                                        <input type="hidden" name="projectID" id="projectID" value="<?php echo $pendingtablerow->projectID; ?>">
                                        <button  type="submit">
                                            <img src="<?php echo URLROOT ?>/img/eye-solid.svg">
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="<?php echo URLROOT ?>/project/editPostedProjects" method="POST">
                                        <input type="hidden" name="projectID" id="projectID" value="<?php echo $pendingtablerow->projectID; ?>">
                                        <button onclick="location.href='<?php echo URLROOT ?>/organization/choosethenecessityType'">
                                            <img style="height: 16px;  width: 18px" src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg">
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="<?php echo URLROOT ?>/project/deleteOngoingandCompleteProjects" method="POST" class="delete-form" id="delete">
                                        <input type="hidden" name="projectID" id="projectID" value="<?php echo $pendingtablerow->projectID; ?>">
                                        <button  type="submit" onclick="confirmDecline(event)">
                                            <img style="height: 16px;  width: 18px" src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

                <!-- Completed Table -->
                <div class="posted-necessity-Completed-table-caption">
                    <p>Completed Projects</p>
                </div>
                <div class="posted-necessity-Completed-table-grey-line"></div>
                <div class="posted-necessities-Completed-table">
                    <table>
                        <?php foreach($data['completetablerow'] as $completetablerow): ?>
                            <tr>
                                <td>
                                    <img style="height: 55px;  width: 55px" src="<?php echo URLROOT ?>/img/project-management.png" alt="">
                                </td>
                                <td>
                                    <h4 class="pending-postednecessityTitle"><?php echo $completetablerow->title?></h4>
                                    <p class="pending-postednecessitydescription"><?php echo $completetablerow->description?></p>
                                </td>
                                <td><p>Rs. <?php echo number_format($completetablerow->budget,2); ?></p></td>
                                <td>
                                    <form action="<?php echo URLROOT ?>/project/viewCompletedProjectDetails" method="POST">
                                        <input type="hidden" name="projectID" id="projectID" value="<?php echo $completetablerow->projectID; ?>">
                                        <button  type="submit">
                                            <img src="<?php echo URLROOT ?>/img/eye-solid.svg">
                                        </button>
                                    </form>
                                </td>
                                <td></td>
                                <td>
                                    <form action="<?php echo URLROOT ?>/project/deleteOngoingandCompleteProjects" method="POST" class="delete-form" id="delete">
                                        <input type="hidden" name="projectID" id="projectID" value="<?php echo $completetablerow->projectID; ?>">
                                        <button  type="submit" onclick="confirmDecline(event)">
                                            <img style="height: 16px;  width: 18px" src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                
                
                <div class="add-necessity-button-for-post">
                    <button onclick="location.href='<?php echo URLROOT ?>/project/addprojects'">
                        <img src="<?php echo URLROOT ?>/img/Plus.png">
                        <h5>Add Projects</h5>
                    </button>
                </div>

                <!-- <div class="add-necessity-button-for-post">
                    <button onclick="location.href='<?php echo URLROOT ?>/necessity/addgoodsnecessity'">
                        <img src="<?php echo URLROOT ?>/img/Plus.png">
                        <h5>Add Necessities</h5>
                    </button>
                </div> -->

                

            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <div class="rightside-bar-type-one">
                <div class="right-side-bar">
                    <div class="right-side-bar-type-one-detailed-view-boxes-typeone">
                        <h5>Total Donation You Recieve</h5>
                        <p>Rs. <?php echo number_format(isset($data['totalReceivedAmount']) ? $data['totalReceivedAmount'] : 0 , 2); ?></p>
                    </div>
                    <div class="right-side-bar-type-one-detailed-view-boxes">
                        <h5>Donation Start Necessities</h5>
                    </div>

                    <div class="Still-not-completed-necessities">
                        <table>
                            <?php foreach($data['stateoneprojects'] as $stateoneprojects): ?>
                            <tr>
                                <td>
                                    <img style="height: 38px;  width: 38px" src="<?php echo URLROOT ?>/img/project-management.png" alt=""> 
                                </td>
                                <td>
                                    <h4 class="pending-postednecessityTitle"><?php echo $stateoneprojects->title?></h4>
                                    <p class="pending-postednecessitydescription"><?php echo $stateoneprojects->description?></p>
                                </td>
                                <td>
                                    <form action="<?php echo URLROOT ?>/project/viewdonatedprojects" method="POST">
                                        <input type="hidden" name="projectID" id="projectID" value="<?php echo $stateoneprojects->projectID; ?>">
                                        <button  type="submit">
                                            <img src="<?php echo URLROOT ?>/img/eye-solid.svg">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    
                    
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
            text: 'You are about to delete this Posted Project. This action cannot be undone.',
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
