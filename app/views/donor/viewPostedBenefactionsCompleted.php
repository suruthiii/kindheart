<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "benefactions";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="donor-right-side-container">

            <!-- Middle container -->
            <div class="donor-middle-container">
                <!-- Go Back Button -->
                <div class="donor-goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <button onclick="location.href='<?php echo URLROOT ?>/benefaction/postedBenefactions'">Go Back</button>
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
                    <h3>Posted Benefaction</h3>
                     
                </div>

                <div class="two-column-container">
                    <!-- Left column for view-benefaction-form -->
                    <div class="view-benefaction-left-column">
                        <!-- Benefaction Details -->
                        <div class="benefaction-info">
                            <table>
                                <tr class="benefaction-data">
                                    <th>Item Name</th>
                                    <td><?php print_r($data['benefaction_details']->itemName); ?></td>
                                </tr>
                                <tr class="benefaction-data">
                                    <th>Category</th>
                                    <td><?php print_r($data['benefaction_details']->itemCategory); ?></td>
                                </tr>
                                <tr class="benefaction-data">
                                    <th>Quantity</th>
                                    <td><?php print_r($data['benefaction_details']->itemQuantity) ?></td>
                                </tr>
                                <tr class="benefaction-data">
                                    <th>Description</th>
                                    <td><?php print_r($data['benefaction_details']->description) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Right column for photos container -->                    
                    <div class="view-benefaction-right-column">
                        <div class="view-benefaction-right-column-inner">
                            <div class="chosen-photos-container" id="chosen-photos-container1">
                                <?php if (!empty($data['benefaction_details']->itemPhoto1)): ?>
                                    <img style="max-width: 300px; max-height: 300px; background-color: #F5F5F5; box-shadow: 0px 4px 4px rgba(142, 0, 0, 0.25); border: 2px solid #8E0000; margin: 10px;" id="benefactionImage" src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefaction_details']->itemPhoto1; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="chosen-photos-container" id="chosen-photos-container2">
                                <?php if (!empty($data['benefaction_details']->itemPhoto2)): ?>
                                    <img style="max-width: 300px; max-height: 300px; background-color: #F5F5F5; box-shadow: 0px 4px 4px rgba(142, 0, 0, 0.25); border: 2px solid #8E0000; margin: 10px;" id="benefactionImage" src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefaction_details']->itemPhoto2; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="chosen-photos-container" id="chosen-photos-container3">
                                <?php if (!empty($data['benefaction_details']->itemPhoto3)): ?>
                                    <img style="max-width: 300px; max-height: 300px; background-color: #F5F5F5; box-shadow: 0px 4px 4px rgba(142, 0, 0, 0.25); border: 2px solid #8E0000; margin: 10px;" id="benefactionImage" src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefaction_details']->itemPhoto3; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="chosen-photos-container" id="chosen-photos-container4">
                                <?php if (!empty($data['benefaction_details']->itemPhoto4)): ?>
                                    <img style="max-width: 300px; max-height: 300px; background-color: #F5F5F5; box-shadow: 0px 4px 4px rgba(142, 0, 0, 0.25); border: 2px solid #8E0000; margin: 10px;" id="benefactionImage" src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefaction_details']->itemPhoto4; ?>">
                                <?php endif; ?>
                            </div>                            
                        </div>
                    </div> 
                </div>
            </div>

            <!-- right side bar for Requests -->
            <div class="request-right-side-bar">
                <div class="request-right-side-bar-inner">  
                    <!-- Topic -->
                    <div class="request-right-side-bar-topic">
                        <h3>Completed Donations</h3>
                        <div class="request-right-side-bar-grey-line"> </div>
                    </div>  
                    
                    <!-- Display requests or no requests message -->
                    <div class="request-right-side-bar-all-requests">
                        <?php foreach($data['benefaction_requests'] as $request): ?>
                            <?php if ($request->acceptanceStatus == 2) : ?>
                                <a href="<?php echo URLROOT ?>/benefaction/viewBenefactionRequest/<?php echo $request->doneeID?>/<?php echo $request->benefactionID?>">
                                    <div class="request-right-side-bar-type-requests-completed">
                                        <div class="request-right-side-bar-type-requests-left">
                                            <h4><?php echo $request->doneeName; ?></h4>
                                            <p>Donated Amount: <?php echo $request->donatedQuantity; ?></p>
                                            <!-- <p><?php echo substr($request->reason, 0, 20) . (strlen($request->reason) > 20 ? '...' : ''); ?></p> -->
                                        </div>
                                    </div>
                                </a> 
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>                                                            
        </div>
    </section>
</main>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this?");
    }
</script>

<?php require APPROOT.'/views/inc/footer.php'; ?>
