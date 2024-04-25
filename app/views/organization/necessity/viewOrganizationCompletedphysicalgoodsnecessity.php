<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "necessities";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

            <!-- Middle container -->
            <div class="middle-container">
                <!-- Go Back Button -->
                <div class="goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <button onclick="location.href='<?php echo URLROOT ?>/necessity/physicalgood'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>View Necessity</h3>
                    <p>View information about posted necessity that completed.</p>
                </div>

                <!-- <p style="margin-top: 30%;">Necessity ID: <?php echo $data['pendingNecessityDetails']->necessityID; ?></p> -->

                <div class="posted-necessity-view-tables-css-for-pending-and-complete">
                    <table>
                        <tr>
                            <td><p>Necessity Category</p></td>
                            <td><p><?php echo $data['pendingNecessityDetails']->itemCategory; ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Necessity Name</P></td>
                            <td><?php echo $data['pendingNecessityDetails']->necessityName; ?></td>
                        </tr>
                        <tr>
                            <td><p>Description</p></td>
                            <td><p><?php echo $data['pendingNecessityDetails']->description; ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Requested Quantity</p></td>
                            <td><p><?php echo $data['pendingNecessityDetails']->requestedQuantity; ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Received Quantity</p></td>
                            <td><p><?php echo $data['pendingNecessityDetails']->receivedQuantity; ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Quantity Due</p></td>
                            <td><p><?php echo $data['pendingNecessityDetails']->quantity_due; ?></p></td>
                        </tr>
                    </table>
                </div>

                <div class="posted-necessity-view-table-edit-and-delete-buttons-row">
                    <form action="<?php echo URLROOT ?>/necessity/deleteGoodsNecessity" method="post" class="delete-form" id="delete">
                        <input type="hidden" name="necessityID" id="necessityID" value="<?php echo $data['pendingNecessityDetails']->necessityID ; ?>"/>
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
            text: 'You are about to delete this Completed Necessity. This action cannot be undone.',
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
