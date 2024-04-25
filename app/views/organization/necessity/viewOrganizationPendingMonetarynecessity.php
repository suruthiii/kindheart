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
                    <button onclick="location.href='<?php echo URLROOT ?>/necessity/monetary'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>View Necessity</h3>
                    <p>View information about posted necessity and the donation received.</p>
                </div>

                <!-- <p style="margin-top: 30%;">Necessity ID: <?php echo $data['pendingNecessityDetails']->necessityID; ?></p> -->

                <div class="posted-necessity-view-tables-css-for-pending-and-complete">
                    <table>
                        <tr>
                            <td><p>Necessity Name</P></td>
                            <td><?php echo $data['pendingNecessityDetails']->necessityName; ?></td>
                        </tr>
                        <tr>
                            <td><p>Description</p></td>
                            <td><p><?php echo $data['pendingNecessityDetails']->description; ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Necessity Type</p></td>
                            <td><p><?php echo $data['pendingNecessityDetails']->monetaryNecessityType; ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Monthly Requested<br>Amount</p></td>
                            <td><p>Rs.<?php echo number_format($data['pendingNecessityDetails']->monthlyAmount, 2); ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Requested Amount</p></td>
                            <td><p>Rs.<?php echo number_format($data['pendingNecessityDetails']->requestedAmount, 2); ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Received Amount</p></td>
                            <td><p>Rs.<?php echo number_format($data['pendingNecessityDetails']->receivedAmount, 2); ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Amount Due</p></td>
                            <td><p>Rs.<?php echo number_format($data['pendingNecessityDetails']->amount_due, 2); ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Donation Starting Date</p></td>
                            <td><p><?php echo $data['pendingNecessityDetails']->startDate !== null ? date('Y-m-d', strtotime($data['pendingNecessityDetails']->startDate)) : '---'; ?></p></td>
                        </tr>
                        <tr>
                            <td><p>Duration</p></td>
                            <td><p><?php echo $data['pendingNecessityDetails']->duration; ?> Months</p></td>
                        </tr>
                    </table>
                </div>
                <div class="posted-necessity-view-table-edit-and-delete-buttons-row">
                    <form action="<?php echo URLROOT ?>" method="post">
                        <input type="hidden" name="necessityID" id="necessityID" value="<?php echo $data['pendingNecessityDetails']->necessityID ; ?>" />
                        <button type="submit">
                            <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg" class="ncessity-view-table-edit-button-img">
                            <p>Edit</p>
                        </button>
                    </form>

                    <form action="<?php echo URLROOT ?>/necessity/deleteNecessity" method="post" class="delete-form" id="delete">
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
                    <div class="right-side-bar-for-display-title">
                        <h3>Donors Who Donated</h3>
                    </div>
                    <div class="right-side-bar-for-scrolling">
                        <div class="donated-donor-details-box">
                            <p></p>
                        </div>
                        <div class="donated-donor-details-box">
                        
                        </div>
                        <div class="donated-donor-details-box">
                        
                        </div>
                        <div class="donated-donor-details-box">
                        
                        </div>
                        <div class="donated-donor-details-box">
                        
                        </div>
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
            text: 'You are about to delete this Pending Necessity. This action cannot be undone.',
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
