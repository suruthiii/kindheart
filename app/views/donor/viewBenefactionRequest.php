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
                    <!-- <button onclick="location.href='<?php echo URLROOT ?>/benefaction/viewBenefactionRequest'">Go Back</button> -->
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
                    <h3>Benefaction Request</h3>
                    <p>Last 30 Days</p>
                </div>

                <div class="benefactionRequest-left-column">
                    <!-- benefaction Request Details -->
                    <div class="benefactionRequest-info">
                        <table>
                            <tr class="benefactionRequest-data">
                                <th>Donee Name</th>
                                <?php var_dump($data['benefactionRequest_details']); ?>
                                <td><?php print_r($data['benefactionRequest_details']->doneeName); ?></td>
                            </tr>
                            <tr class="benefactionRequest-data">
                                <th>Donee Type</th>
                                <td><?php print_r($data['benefactionRequest_details']->userType); ?></td>
                            </tr>
                            <tr class="benefactionRequest-data">
                                <th>Requested Amount</th>
                                <td><?php print_r($data['benefactionRequest_details']->requestedQuantity); ?></td>
                            </tr>
                            <tr class="benefactionRequest-data">
                                <th>Reason</th>
                                <td><?php print_r($data['benefactionRequest_details']->reason) ?></td>
                            </tr>
                        </table>                    
                    </div>                    
                </div>

                <div class="view-benefactionRequest-btn-container">
                    <form action="<?php echo URLROOT ?>/benefaction/temporyStudentProfile" method="get" class="donee-profile">
                        <input type="hidden" name="doneeID" id="doneeID" value="" />
                        <button type="submit" class="benefactionRequest_button" style="cursor: pointer;">
                            <img src="<?php echo URLROOT ?>/img/profile2.png" style="filter: invert(100%); width:15px;">
                            <h5>View Donee Profile</h5>
                        </button>
                    </form>

                    <form action="<?php echo URLROOT ?>/benefaction/" method="get" class="accept-request">
                        <input type="hidden" name="doneeID" id="doneeID" value="" />
                        <button type="submit" class="benefactionRequest_button" style="cursor: pointer;">
                            <img src="<?php echo URLROOT ?>/img/check.png" style="filter: invert(100%); width:18px;">
                            <h5>Accept Request</h5>
                        </button>
                    </form>

                    <form action="<?php echo URLROOT ?>/benefaction/declineBenefactionRequest" method="post" class="decline-request">
                    <!-- <input type="hidden" name="ids" id="ids" value="<?php echo $data['benefactionRequest_details']->benefactionID . '-' . $data['benefactionRequest_details']->doneeID; ?>" /> -->
                        <button type="submit" class="benefactionRequest_button" style="cursor: pointer;"onclick="confirmDecline()" >
                            <img src="<?php echo URLROOT ?>/img/close.png" style="filter: invert(100%); width:11px;">
                            <h5>Decline Request</h5>
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
    function confirmDecline() {
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
                // Submit the form asynchronously
                document.getElementById('declineForm').submit();
            }
        });
    }
</script>

<?php require APPROOT.'/views/inc/footer.php'; ?>