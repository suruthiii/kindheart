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
                    <button onclick="location.href='<?php echo URLROOT ?>/benefaction/viewPostedBenefactions?benefactionID=<?php echo $data['benefactionRequest_details'][0]->benefactionID; ?>'">Go Back</button>
                    <!-- <button onclick="goBack()">Go Back</button>

                    <script>
                        function goBack() {
                            // Use history.back() to navigate to the previous page in history
                            history.back();
                        }
                    </script> -->
                </div>

                <!-- main title -->
                <div class="donor-middle-container-title-typeone">
                    <h3>Completed Benefaction Request Details</h3>
                     
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
                            <tr class="benefactionRequest-data">
                                <th>Donatated Amount</th>
                                <td><?php print_r($data['benefactionRequest_details'][0]->donatedQuantity) ?></td>
                            </tr>
                            <tr class="benefactionRequest-data">
                                <th>Admin Verification Status</th>
                                <?php
                                
                                switch ($data['benefactionRequest_details'][0]->verificationStatus) {
                                    case 0:
                                        $adminverificationStatus = 'Pending';
                                        break;
                                    case 1:
                                        $adminverificationStatus = 'Verified';
                                        break;
                                    case 2:
                                        $adminverificationStatus = 'Verified';
                                        break;
                                    case 3:
                                        $adminverificationStatus = 'Verified';
                                        break;
                                    default:
                                        $adminverificationStatus = 'Pending';
                                        break;
                                    }
                                ?>
                                <td><?php print_r($adminverificationStatus) ?></td>
                            </tr>
                            <tr class="benefactionRequest-data">
                                <th>Donee Acknowledgement Status</th>
                                <?php
                                
                                switch ($data['benefactionRequest_details'][0]->verificationStatus) {
                                    case 2:
                                        $doneeAcknowledgemntStatus = 'Acknowledged';
                                        break;
                                    case 3:
                                        $doneeAcknowledgemntStatus = 'Not Acknowledged';
                                        break;
                                    default:
                                        $doneeAcknowledgemntStatus = 'Not Acknowledged';
                                        break;
                                    }
                                ?>
                                <td><?php print_r($doneeAcknowledgemntStatus) ?></td>
                            </tr>
                            <tr class="benefactionRequest-data">
                                <th>Acknowledgement</th>
                                <?php
                                
                                switch ($data['benefactionRequest_details'][0]->verificationStatus) {
                                    case 2:
                                        $doneeAcknowledgemnt = $data['benefactionRequest_details'][0]->acknowledgement;
                                        break;
                                    case 3:
                                        $doneeAcknowledgemnt = '-';
                                        break;
                                    default:
                                        $doneeAcknowledgemnt = '-';
                                        break;
                                    }
                                ?>
                                
                                <td><?php print_r($doneeAcknowledgemnt) ?></td>
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
                    </form>

                    <form action="<?php echo URLROOT ?>/benefaction/" method="get" class="accept-request">
                        <input type="hidden" name="doneeID" id="doneeID" value="" />
                        <button type="submit" class="benefactionRequest_button" style="cursor: pointer;">
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
                    </form> -->
                </div>
            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <?php require APPROOT.'/views/inc/components/askonluforneedbar.php'; ?>

        </div>
    </section>
</main>


<?php require APPROOT.'/views/inc/footer.php'; ?>
