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
                    <!-- <button onclick="location.href='<?php echo URLROOT ?>/benefaction/viewbenefactionRequestAccepted'">Go Back</button> -->
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
                    <h3>Ongoing Benefaction Request Details</h3>
                    <p>Last 30 Days</p>
                </div>

                <div class="benefactionRequestAccepted-left-column">   
                    <div class="benefactionRequestAccepted-left-column-left-column">
                        <div class="as">
                            <h4>Request Details</h4>
                        </div>
                        <!-- benefaction Request Details -->
                        <div class="benefactionRequestAccepted-info">
                            <table>
                                <tr class="benefactionRequestAccepted-data">
                                    <th>Donee Name</th>
                                    <td><?php print_r($data['benefactionRequest_details'][0]->doneeName); ?></td>
                                </tr>
                                <tr class="benefactionRequestAccepted-data">
                                    <th>Donee Type</th>
                                    <td><?php print_r($data['benefactionRequest_details'][0]->userType); ?></td>
                                </tr>
                                <tr class="benefactionRequestAccepted-data">
                                    <th>Requested Amount</th>
                                    <td><?php print_r($data['benefactionRequest_details'][0]->requestedQuantity); ?></td>
                                </tr>
                                <tr class="benefactionRequestAccepted-data">
                                    <th>Reason</th>
                                    <td><?php print_r($data['benefactionRequest_details'][0]->reason) ?></td>
                                </tr>
                            </table>                    
                        </div> 
                    </div>
                    <div class="benefactionRequestAccepted-left-column-right-column">
                        <div class="as">
                            <h4>Donation Details</h4>
                        </div>
                        <!-- benefaction Request Details -->
                        <div class="benefactionRequestAccepted-info">
                            <!-- <?php print_r($data['benefactionRequest_details']) ?> -->
                            <table>
                                <tr class="benefactionRequestAccepted-data">
                                    <th>glyigiyg</th>
                                    <td><?php print_r($data['benefactionRequest_details'][0]->doneeName); ?></td>
                                </tr>
                                <tr class="benefactionRequestAccepted-data">
                                    <th>fvhouev</th>
                                    <td><?php print_r($data['benefactionRequest_details'][0]->userType); ?></td>
                                </tr>
                                <tr class="benefactionRequestAccepted-data">
                                    <th>Agreed Amount</th>
                                    <td><?php print_r($data['benefactionRequest_details'][0]->requestedQuantity); ?></td>
                                </tr>
                                <tr class="benefactionRequestAccepted-data">
                                    <th>fdvefr</th>
                                    <td><?php print_r($data['benefactionRequest_details'][0]->reason) ?></td>
                                </tr>
                            </table>                    
                        </div> 
                    </div>   
                </div>

                <div class="view-benefactionRequestAccepted-btn-container">
                    <!-- <form action="<?php echo URLROOT ?>/benefaction/temporyStudentProfile" method="get" class="donee-profile">
                        <input type="hidden" name="doneeID" id="doneeID" value="" />
                        <button type="submit" class="benefactionRequestAccepted_button" style="cursor: pointer;">
                            <img src="<?php echo URLROOT ?>/img/profile2.png" style="filter: invert(100%); width:15px;">
                            <h5>View Donee Profile</h5>
                        </button>
                    </form>

                    <form action="<?php echo URLROOT ?>/benefaction/" method="get" class="accept-request">
                        <input type="hidden" name="doneeID" id="doneeID" value="" />
                        <button type="submit" class="benefactionRequestAccepted_button" style="cursor: pointer;">
                            <img src="<?php echo URLROOT ?>/img/check.png" style="filter: invert(100%); width:18px;">
                            <h5>Accept Request</h5>
                        </button>
                    </form>

                    <form action="<?php echo URLROOT ?>/benefaction/declinebenefactionRequestPending" method="post" class="decline-request" id="declineForm">
                        <input type="hidden" name="benefactionID" id="benefactionID" value="<?php echo $data['benefactionRequestAccepted_details'][0]->benefactionID; ?>" />
                        <input type="hidden" name="doneeID" id="doneeID" value="<?php echo $data['benefactionRequestAccepted_details'][0]->doneeID; ?>" />
                        <button type="submit" class="benefactionRequestAccepted_button" style="cursor: pointer;"onclick="confirmDecline(event)" >
                            <img src="<?php echo URLROOT ?>/img/close.png" style="filter: invert(100%); width:11px;">
                            <h5>Decline Request</h5>
                        </button>
                    </form> -->
                </div>
            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <?php require APPROOT.'/views/inc/components/askonluforneedbar.php'; ?>

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
</script>


<?php require APPROOT.'/views/inc/footer.php'; ?>
