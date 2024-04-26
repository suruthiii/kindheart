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

            <!-- right side bar for user-profile -->
            <div class="user-profile-right-side-bar">
                <div class="user-profile-right-side-bar-inner">  
                    <!-- Topic -->
                    <div class="user-profile-right-side-bar-topic">
                        <h3>Donee Profile</h3>
                        <div class="user-profile-right-side-bar-grey-line"> </div>
                    </div>  
                    
                    <!-- Display user-profile or no requests message -->
                    <div class="user-profile-right-side-bar-all-user-profiles">
                        <div class="user-profile-right-side-bar-all-user-profiles-inner">
                            <?php if ($data['user_profile'][0]->userType === 'student'): ?>
                                <div class="user-profile-right-side-bar-all-user-profiles-inner-image">
                                    <img src="<?php echo URLROOT ?>/img/profile2.png" alt="Profile Image">
                                </div>
                                <div class="user-profile-right-side-bar-all-user-profiles-inner-details">
                                    <table>
                                        <tr class="user-profile-data">
                                            <th>Name</th>
                                            <td><?php print_r($data['user_profile'][0]->doneeName); ?></td>
                                        </tr>
                                        <tr class="user-profile-data">
                                            <th>Donee Type</th>
                                            <td><?php print_r($data['user_profile'][0]->doneeType); ?></td>
                                        </tr>
                                        <tr class="user-profile-data">
                                            <th>Gender</th>
                                            <td><?php print_r($data['user_profile'][0]->gender); ?></td>
                                        </tr>
                                        <tr class="user-profile-data">
                                            <th>Date Of Birth</th>
                                            <td><?php print_r($data['user_profile'][0]->dateOfBirth); ?></td>
                                        </tr>
                                        <tr class="user-profile-data">
                                            <th>Address</th>
                                            <td><?php print_r($data['user_profile'][0]->doneeAddress); ?></td>
                                        </tr>
                                        <tr class="user-profile-data">
                                            <th>Phone Number</th>
                                            <td><?php print_r($data['user_profile'][0]->doneePhoneNumber); ?></td>
                                        </tr>
                                        <tr class="user-profile-data">
                                            <th>Institution Name</th>
                                            <td><?php print_r($data['user_profile'][0]->institutionName); ?></td>
                                        </tr>
                                        <?php if ($data['user_profile'][0]->doneeType === 'School Student'): ?>
                                            <tr class="user-profile-data">
                                                <th>Grade</th>
                                                <td><?php print_r($data['user_profile'][0]->studyingYear); ?></td>
                                            </tr>
                                        <?php elseif ($data['user_profile'][0]->doneeType === 'University Student'): ?>
                                            <tr class="user-profile-data">
                                                <th>Studying Year</th>
                                                <td><?php print_r($data['user_profile'][0]->studyingYear); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    </table>          
                                </div>
                            <?php elseif ($data['user_profile'][0]->userType === 'organization'): ?>
                                <div class="user-profile-right-side-bar-all-user-profiles-inner-image">
                                    <img src="<?php echo URLROOT ?>/img/profile2.png" alt="Profile Image">
                                </div>
                                <div class="user-profile-right-side-bar-all-user-profiles-inner-details">
                                    <table>
                                        <tr class="user-profile-data">
                                            <th>Name</th>
                                            <td><?php print_r($data['user_profile'][0]->doneeName); ?></td>
                                        </tr>
                                        <tr class="user-profile-data">
                                            <th>Donee Type</th>
                                            <td><?php print_r($data['user_profile'][0]->doneeType); ?></td>
                                        </tr>
                                        <tr class="user-profile-data">
                                            <th>Address</th>
                                            <td><?php print_r($data['user_profile'][0]->doneeAddress); ?></td>
                                        </tr>
                                        <tr class="user-profile-data">
                                            <th>Phone Number</th>
                                            <td><?php print_r($data['user_profile'][0]->doneePhoneNumber); ?></td>
                                        </tr>
                                    </table>          
                                </div>
                            <?php endif; ?>
                        </div>
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
