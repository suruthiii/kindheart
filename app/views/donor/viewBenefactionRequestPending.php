<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "donations";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="donor-right-side-container">

            <!-- Middle container -->
            <div class="donor-middle-container">
                <!-- Go Back Button -->
                <div class="donor-goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <!-- <button onclick="location.href='<?php echo URLROOT ?>/benefaction/viewBenefactionRequestPending'">Go Back</button> -->
                    <button onclick="goBack()">Go Back</button>

                    <script>
                        function goBack() {
                            // Use history.back() to navigate to the previous page in history
                            history.back();
                        }
                    </script>
                </div>

                <!-- main title -->
                <div class="donor-middle-container-title-typeone">
                    <h3>Pending Benefaction Request Details</h3>
                     
                </div>

                <div class="benefactionRequest-left-column">
                    <!-- benefaction Request Details -->
                    <div class="benefactionRequest-info">
                        <table>
                            <tr class="benefactionRequest-data">
                                <th>Donee Name</th>
                                <td><?php print_r($data['benefactionRequest_details'][0]->doneeName); ?></td>
                            </tr>
                            <tr class="benefactionRequest-data">
                                <th>Donee Type</th>
                                <td><?php print_r($data['benefactionRequest_details'][0]->userType); ?></td>
                            </tr>
                            <tr class="benefactionRequest-data">
                                <th>Requested Amount</th>
                                <td><?php print_r($data['benefactionRequest_details'][0]->requestedQuantity); ?></td>
                            </tr>
                            <tr class="benefactionRequest-data">
                                <th>Reason</th>
                                <td><?php print_r($data['benefactionRequest_details'][0]->reason) ?></td>
                            </tr>
                        </table>                    
                    </div>                    
                </div>

                <div class="view-benefactionRequest-btn-container">
                    <!-- <form action="<?php echo URLROOT ?>/benefaction/temporyStudentProfile" method="get" class="donee-profile">
                        <input type="hidden" name="doneeID" id="doneeID" value="" />
                        <button type="submit" class="benefactionRequest_button" style="cursor: pointer;">
                            <img src="<?php echo URLROOT ?>/img/profile2.png" style="filter: invert(100%); width:15px;">
                            <h5>View Donee Profile</h5>
                        </button>
                    </form> -->

                    <form action="<?php echo URLROOT ?>/benefaction/acceptBenefactionRequest" method="post" class="accept-request" id="acceptForm">
                        <input type="hidden" name="benefactionID" id="benefactionID" value="<?php echo $data['benefactionRequest_details'][0]->benefactionID; ?>" />
                        <input type="hidden" name="doneeID" id="doneeID" value="<?php echo $data['benefactionRequest_details'][0]->doneeID; ?>" />
                        <button type="submit" class="benefactionRequest_button" style="cursor: pointer;"onclick="confirmAccept(event)" >
                            <img src="<?php echo URLROOT ?>/img/check.png" style="filter: invert(100%); width:18px;">
                            <h5>Accept Request</h5>
                        </button>
                    </form>

                    <form action="<?php echo URLROOT ?>/benefaction/declineBenefactionRequest" method="post" class="decline-request" id="declineForm">
                        <input type="hidden" name="benefactionID" id="benefactionID" value="<?php echo $data['benefactionRequest_details'][0]->benefactionID; ?>" />
                        <input type="hidden" name="doneeID" id="doneeID" value="<?php echo $data['benefactionRequest_details'][0]->doneeID; ?>" />
                        <button type="submit" class="benefactionRequest_button" style="cursor: pointer;"onclick="confirmDecline(event)" >
                            <img src="<?php echo URLROOT ?>/img/close.png" style="filter: invert(100%); width:11px;">
                            <h5>Decline Request</h5>
                        </button>
                    </form>
                </div>
            </div>

            <!-- right side bar for Requests -->
            <div class="request-right-side-bar">
                <div class="request-right-side-bar-inner">  
                    <!-- Topic -->
                    <div class="request-right-side-bar-topic">
                        <h3>User Profile</h3>
                        <div class="request-right-side-bar-grey-line"> </div>
                    </div>  
                    
                    <!-- Display requests or no requests message -->
                    <div class="request-right-side-bar-all-requests">
                        <!-- <?php foreach($data['user_profile'] as $profile): ?>
                                <div>
                                    <h4>Donee Name: <?php echo $profile->doneeName; ?></h4>
                                    <p>Donee Type: <?php echo $profile->userType; ?></p>
                                    <p>Address: <?php echo $profile->address; ?></p>
                                    <p>Email: <?php echo $profile->email; ?></p>
                                    <p>Phone Number: <?php echo $profile->phoneNumber; ?></p>
                                </div>
                        <?php endforeach; ?> -->
                    </div>
                </div>
            </div>   

        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmDecline(event) {
        event.preventDefault(); // Prevent default form submission

        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to decline this request. This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, decline it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form programmatically
                const form = document.getElementById('declineForm');
                form.submit(); // Submit the form
            }
        });
    }

    function confirmAccept(event) {
        event.preventDefault(); // Prevent default form submission

        Swal.fire({
            title: 'Great!',
            text: 'You are about to accept this request. This action cannot be undone.',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, Accept it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form programmatically
                const form = document.getElementById('acceptForm');
                form.submit(); // Submit the form
            }
        });
    }
</script>


<?php require APPROOT.'/views/inc/footer.php'; ?>
