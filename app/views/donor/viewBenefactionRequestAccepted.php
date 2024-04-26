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
                    <h3>Accepted Benefaction Request Details</h3>
                    <p>Last 30 Days</p>
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
                    <form enctype="multipart/form-data" action="<?php echo URLROOT ?>/benefaction/benefactionRequestDonationSubmit" method="get">
                        <div class="benefactionRequest-donationinfo" style="display: none;">
                            <div class="benefactionRequest-donationinfo1">
                                <label for="donationQunatity">Donating Quantity</label>
                                <div class="benefactionRequest-donationdata">
                                    <input class="benefactionRequest--input" type="number" name="donationQunatity" value="<?php echo isset($data['donationQunatity']) ? $data['donationQunatity'] : ''; ?>" >
                                    <span class="donor-form-error-details" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['donationQunatity_err']) ? $data['donationQunatity_err']: ''; ?> </span>
                                </div>
                            </div>
                            <div class="benefactionRequest-donationinfo1">
                                <label for="donationQunatity">Delivery Reciept</label>
                                <div class="benefactionRequest-donationdata">
                                    <label for="deliveryReceipt" class="benefactionRequest-donationdata-image">
                                        <p>Upload the Receipt</p>
                                        <input type="file" id="deliveryReceipt" name="deliveryReceipt" accept="image/png, image/jpeg, image/jpg" onchange="handleImageType(this)" style="display:none;" />
                                    </label>
                                </div>
                            </div>
                            <span class="donor-form-error-details" id="deliveryReceipt_err" style="color: #8E0000; font-family: 'Inter', sans-serif;"><?php echo isset($data['deliveryReceipt_err']) ? $data['deliveryReceipt_err']: ''; ?></span>
                        </div>                    
                    </form>
                </div>

                <div class="view-benefactionRequest-btn-container">
                    <!-- <form action="<?php echo URLROOT ?>/benefaction/temporyStudentProfile" method="get" class="donee-profile">
                        <input type="hidden" name="doneeID" id="doneeID" value="" />
                        <button type="submit" class="benefactionRequest_button" style="cursor: pointer;">
                            <img src="<?php echo URLROOT ?>/img/profile2.png" style="filter: invert(100%); width:15px;">
                            <h5>View Donee Profile</h5>
                        </button>
                    </form> -->

                    <form class="make-donation" id="acceptForm">
                        <!-- <input type="hidden" name="benefactionID" id="benefactionID" value="<?php echo $data['benefactionRequest_details'][0]->benefactionID; ?>" /> -->
                        <!-- <input type="hidden" name="doneeID" id="doneeID" value="<?php echo $data['benefactionRequest_details'][0]->doneeID; ?>" /> -->
                        <button type="botton" class="benefactionRequest_button" style="cursor: pointer;"onclick="showDonationInfo()" >
                            <img src="<?php echo URLROOT ?>/img/check.png" style="filter: invert(100%); width:18px;">
                            <h5>Make the Donation</h5>
                        </button>
                    </form>

                    <form action="<?php echo URLROOT ?>/benefaction/" method="post" class="submit-request" id="submitForm" style="display: none;">
                        <input type="hidden" name="benefactionID" id="benefactionID" value="<?php echo $data['benefactionRequest_details'][0]->benefactionID; ?>" />
                        <input type="hidden" name="doneeID" id="doneeID" value="<?php echo $data['benefactionRequest_details'][0]->doneeID; ?>" />
                        <button type="submit" class="benefactionRequest_button" style="cursor: pointer;"onclick="confirmSubmit(event)" >
                            <!-- <img src="<?php echo URLROOT ?>/img/close.png" style="filter: invert(100%); width:11px;"> -->
                            <h5>Submit</h5>
                        </button>
                    </form>
                </div>
            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <?php require APPROOT.'/views/inc/components/askonluforneedbar.php'; ?>

        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>

    function showDonationInfo() {
        // Show the donation info div
        const donationInfoDiv = document.querySelector('.benefactionRequest-donationinfo');
        donationInfoDiv.style.display = 'flex';

        // Disable the Make Donation button
        const makeDonationButton = document.querySelector('.make-donation .benefactionRequest_button');
        makeDonationButton.disabled = true;
        makeDonationButton.style.backgroundColor = 'rgb(211, 211, 211)';

        // Show the Decline Request button
        const declineButtonForm = document.querySelector('.submit-request');
        declineButtonForm.style.display = 'block';
    }


    function handleImageType(input) {
        const parentLabel = input.parentElement;
        const parentDiv = parentLabel.parentElement;

        // Get the file from the input element
        const file = input.files[0];

        // Check if file type is valid (starts with 'image/')
        if (file && file.type.startsWith('image/')) {
            // Apply styling to the parent label (add-benefaction-box)
            parentLabel.style.border = '1px solid red';
            parentLabel.style.backgroundColor = 'rgb(249, 224, 209)';
            parentLabel.style.color = 'rgb(213, 83, 7)';
        } else {
            // Apply default styling to the parent label (add-benefaction-box)
            parentLabel.style.border = '1px dashed red';
            parentLabel.style.backgroundColor = 'white';
            parentLabel.style.color = 'rgb(255, 0, 0)';
        }
    }

    function validateForm() {
        var fileInputs = document.querySelectorAll('input[type="file"]');
        var errorMessage = '';

        fileInputs.forEach(function(input) {
            var fileName = input.value;
            if (fileName) {
                var fileExtension = fileName.split('.').pop().toLowerCase();
                var acceptedExtensions = ['png', 'jpg', 'jpeg'];
                if (acceptedExtensions.indexOf(fileExtension) === -1) {
                    errorMessage = 'Please upload a PNG, JPG, or JPEG file.';
                    return false;
                }
            }
        });

        if (errorMessage) {
            alert(errorMessage);
            return false;
        }

        return true;
    }

    // function confirmDecline(event) {
    //     event.preventDefault(); // Prevent default form submission

    //     Swal.fire({
    //         title: 'Are you sure?',
    //         text: 'You are about to decline this request. This action cannot be undone.',
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#d33',
    //         cancelButtonColor: '#3085d6',
    //         confirmButtonText: 'Yes, decline it!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             // Submit the form programmatically
    //             const form = document.getElementById('declineForm');
    //             form.submit(); // Submit the form
    //         }
    //     });
    // }

    // function confirmAccept(event) {
    //     event.preventDefault(); // Prevent default form submission

    //     Swal.fire({
    //         title: 'Great!',
    //         text: 'You are about to accept this request. This action cannot be undone.',
    //         icon: 'success',
    //         showCancelButton: true,
    //         confirmButtonColor: '#d33',
    //         cancelButtonColor: '#3085d6',
    //         confirmButtonText: 'Yes, Accept it!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             // Submit the form programmatically
    //             const form = document.getElementById('acceptForm');
    //             form.submit(); // Submit the form
    //         }
    //     });
    // }
</script>


<?php require APPROOT.'/views/inc/footer.php'; ?>
