<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "benefactions";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

        <a href="<?php echo URLROOT ?>/student/benefactions">
            <table>
                <tr>
                    <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                    <td width="70%">Go Back</td>
                </tr>
            </table>
        </a>

            <div class="donor-middle-container-title-typeone">
                       
                        <h3>Posted Benefaction</h3>
                        <p>View the information about benefaction</p>
                    </div>

                <div class="two-column-container">
                    <!-- Left column for view-benefaction-form -->
                    <div class="view-benefaction-left-column">
                        <!-- Benefaction Details -->
                        <div class="benefaction-info">
                            <table>
                                <tr class="benefaction-data">
                                    <th>Item Name</th>
                                    <td><?php print_r($data['benefactions']->itemName); ?></td>
                                </tr>
                                <tr class="benefaction-data">
                                    <th>Posted By</th>
                                    <td><?php print_r($data['benefactions']->username); ?></td>
                                </tr>
                                <tr class="benefaction-data">
                                    <th>Category</th>
                                    <td><?php print_r($data['benefactions']->itemCategory); ?></td>
                                </tr>
                                <tr class="benefaction-data">
                                    <th>Quantity</th>
                                    <td><?php print_r($data['benefactions']->itemQuantity) ?></td>
                                </tr>
                                <tr class="benefaction-data">
                                    <th>Description</th>
                                    <td><?php print_r($data['benefactions']->description) ?></td>
                                </tr>
                                <tr class="benefaction-data">
                                    <th>Requested Amount</th>
                                    <td><?php print_r($data['benefactions']->requestedQuantity) ?></td>
                                </tr>
                                <tr class="benefaction-data">
                                    <th>Recieved Amount</th>
                                    <td><?php print_r($data['benefactions']->receivedQuantity) ?></td>
                                </tr>
                                <tr class="benefaction-data">
                                    <th>status</th>
                                    <td><?php 
                                        $status = $data['benefactions']->availabilityStatus;
                                        $Acceptedstatus = $data['benefactions']->acceptanceStatus;
                                        $completedStatus = $data['benefactions']->verificationStatus;

                                        // Echo different divs based on the status
                                        if ($status === 0 && $Acceptedstatus === 0) {
                                            echo '<div class="status_pending"><p>Pending</p></div>';

                                        } elseif ($status === 1 && $Acceptedstatus === 1 && $completedStatus === 0 ) {
                                            echo '<div class="status_accepted"><p>Accepted</p></div>';

                                        } elseif ($status === 1 && $Acceptedstatus === 1 && $completedStatus === 1) {
                                            echo '<div class="status_accepted"><p>Accepted</p></div>';

                                        } elseif ($status === 1 && $Acceptedstatus === 1 && $completedStatus === 2) {
                                            echo '<div class="status_rejected"><p>Completed</p></div>';

                                        } elseif ($status === 1 && $Acceptedstatus === 1 && $completedStatus === 3) {
                                            echo '<div class="status_rejected"><p>Complainted</p></div>';

                                        } else {
                                            echo '<div class="status_unknown"><p>Rejected</p></div>';
                                        }
                                      
                                        ?></td>
                                </tr>

                                
                                <tr class="benefaction-data">
                                  
                                    <td><?php 

                                $status = $data['benefactions']->availabilityStatus;
                                $Acceptedstatus = $data['benefactions']->acceptanceStatus;
                                $completedStatus = $data['benefactions']->verificationStatus;

                                // Echo different divs based on the status

                                if (($status === 1 && $Acceptedstatus === 1) || ($status === 2 && $Acceptedstatus === 1 && $completedStatus === 1) ) {
                                 
                                    echo '<div class="status_accepted">
                                                <form action="'.URLROOT.'/student/sendAknowledgement" method="GET" class="btn" >
                                                    <input type="text" name="benefactionID" id="benefactionID" hidden value="' . $data["benefactions"]->benefactionID . '" />
                                                    <input type="text" name="doneeID" id="doneeID" hidden value="' . $data["benefactions"]->doneeID . '" />
                                                    <button type="submit" class="button-container" > send acknowledgement</button>
                                                </form>

                                                <form action="'.URLROOT.'/student/sendBenefactionComplain" method="GET" class="btn" >
                                                <input type="text" name="benefactionID" id="benefactionID" hidden value="' . $data["benefactions"]->benefactionID . '" />
                                                <input type="text" name="doneeID" id="doneeID" hidden value="' . $data["benefactions"]->doneeID . '" />
                                                <button type="submit" class="button-container" > did not received</button>
                                            </form>
                                            </div>';
                                } else {
                                    echo '<div class="status_rejected"></div>';
                                }
                                ?></td>

                                       
                                </tr>

                                
                            </table>
                        </div>
                    </div>

                    <!-- Right column for photos container -->                    
                    <div class="view-benefaction-right-column">
                        <div class="view-benefaction-right-column-inner">
                            <div class="chosen-photos-container" id="chosen-photos-container1">
                                <?php if (!empty($data['benefactions']->itemPhoto1)): ?>
                                    <img style="max-width: 300px; max-height: 300px; background-color: #F5F5F5; box-shadow: 0px 4px 4px rgba(142, 0, 0, 0.25); border: 2px solid #8E0000; margin: 10px;" id="benefactionImage" src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefactions']->itemPhoto1; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="chosen-photos-container" id="chosen-photos-container2">
                                <?php if (!empty($data['benefactions']->itemPhoto2)): ?>
                                    <img style="max-width: 300px; max-height: 300px; background-color: #F5F5F5; box-shadow: 0px 4px 4px rgba(142, 0, 0, 0.25); border: 2px solid #8E0000; margin: 10px;" id="benefactionImage" src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefactions']->itemPhoto2; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="chosen-photos-container" id="chosen-photos-container3">
                                <?php if (!empty($data['benefactions']->itemPhoto3)): ?>
                                    <img style="max-width: 300px; max-height: 300px; background-color: #F5F5F5; box-shadow: 0px 4px 4px rgba(142, 0, 0, 0.25); border: 2px solid #8E0000; margin: 10px;" id="benefactionImage" src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefactions']->itemPhoto3; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="chosen-photos-container" id="chosen-photos-container4">
                                <?php if (!empty($data['benefactions']->itemPhoto4)): ?>
                                    <img style="max-width: 300px; max-height: 300px; background-color: #F5F5F5; box-shadow: 0px 4px 4px rgba(142, 0, 0, 0.25); border: 2px solid #8E0000; margin: 10px;" id="benefactionImage" src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefactions']->itemPhoto4; ?>">
                                <?php endif; ?>
                            </div>                            
                        </div>
                    </div> 
                </div>

                
            </div>


        </div>
    </section>
</main>

<script>


</script>


<?php require APPROOT.'/views/inc/footer.php'; ?>
