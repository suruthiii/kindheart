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
                    <!-- <button onclick="location.href='<?php echo URLROOT ?>/scholarship/postedScholarships'">Go Back</button> -->
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
                    <h3>Posted Scholarship</h3>
                     
                </div>

                <div class="scholarship-left-column">
                    <!-- Left column for view-benefaction-form -->
                    <div class="view-scholarship-left-column">
                        <!-- Scholarship Details -->
                        <div class="scholarship-info">
                            <table>
                                <tr class="scholarship-data">
                                    <th>Title</th>
                                    <td><?php print_r($data['scholarship_details']->title); ?></td>
                                </tr>
                                <tr class="scholarship-data">
                                    <th>Scholarship Amount</th>
                                    <td>LKR <?php print_r($data['scholarship_details']->amount); ?></td>
                                </tr>
                                <tr class="scholarship-data">
                                    <th>Scholarship Starting Date</th>
                                    <td><?php print_r($data['scholarship_details']->startDate) ?></td>
                                </tr>
                                <tr class="scholarship-data">
                                    <th>Duration</th>
                                    <td><?php print_r($data['scholarship_details']->duration) ?></td>
                                </tr>
                                <tr class="scholarship-data">
                                    <th>Description</th>
                                    <td><?php print_r($data['scholarship_details']->description); ?></td>
                                </tr>
                                <tr class="scholarship-data">
                                    <th>Application Deadline</th>
                                    <td><?php print_r($data['scholarship_details']->deadline) ?></td>
                                </tr>
                            </table>
                        </div> 
                    </div>                   
                </div>

                <div class="view-scholarship-btn-container">
                    <form action="<?php echo URLROOT ?>/scholarship/editPostedScholarships" method="get" class="edit-form">
                        <input type="hidden" name="scholarshipID" id="scholarshipID" value="<?php echo $data['scholarship_details']->scholarshipID; ?>" />
                        <button type="submit" class="view-scholarship_button" style="cursor: pointer;">
                            <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg" style="filter: invert(100%); width:15px;">
                            <h5>Edit</h5>
                        </button>
                    </form>

                    <form action="<?php echo URLROOT ?>/scholarship/deleteScholarships" method="post" class="delete-form" onsubmit="return confirmDelete();">
                        <input type="hidden" name="scholarshipID" id="scholarshipID" value="<?php echo $data['scholarship_details']->scholarshipID; ?>"/>
                        <button type="submit" class="view-scholarship_button" style="cursor: pointer;">
                            <img src="<?php echo URLROOT ?>/img/trash-solid.svg" style="filter: invert(100%); width:14px;">
                            <h5>Delete</h5>
                        </button>
                    </form>
                </div>
            </div>

            <!-- right side bar for applications -->
            <div class="application-right-side-bar">
                <div class="application-right-side-bar-inner">
                    <?php
                        // Determine which section to display based on availability status
                        $availabilityStatus = $data['benefaction_details']->availabilityStatus;

                        // $verificationStatus = $data['benefaction_applications']->verificationStatus;

                        switch ($availabilityStatus) {
                            case 0:
                                $sectionTitle = 'Applications';
                                break;
                            case 1:
                                $sectionTitle = 'Accepted Applications';
                                break;
                            case 2:
                                $sectionTitle = 'Completed Applications';
                                break;
                            default:
                                $sectionTitle = 'Applications';
                                break;
                        }

                        // switch ($verificationStatus) {
                        //     case 0:
                        //         // Unverified applications (verificationStatus = 0)
                        //         $sectionTitle = 'Applications';
                        //         break;
                        //     case 1:
                        //     case 3:
                        //         // Verified applications (verificationStatus = 1 or 3)
                        //         $sectionTitle = 'Accepted Applications';
                        //         break;
                        //     case 2:
                        //         // Completed applications (verificationStatus = 2)
                        //         $sectionTitle = 'Completed Applications';
                        //         break;
                        //     default:
                        //         // Default to availability status if verification status doesn't match known cases
                        //         break;
                        // }
                    ?>
                    <!-- Topic -->
                    <div class="application-right-side-bar-topic">
                        <h3><?php echo $sectionTitle; ?></h3>
                        <div class="application-right-side-bar-grey-line"> </div>
                    </div>

                    <!-- Display applications or no applications message -->
                    <?php if (empty($data['benefaction_applications'])) : ?>
                        <div class="application-right-side-bar-no-applications">
                            <p>No Applications Yet</p>
                        </div>
                    <?php else : ?>
                        <div class="application-right-side-bar-all-applications">
                            <?php foreach($data['benefaction_applications'] as $application): ?>
                                <a href="<?php echo URLROOT ?>/benefaction/viewBenefactionapplication/<?php echo $application->doneeID?>/<?php echo $application->benefactionID?>">
                                    <div class="application-right-side-bar-type-applications">
                                        <h4> <?php echo $application->doneeName; ?></h4>
                                        <!-- <p>rRequested Amount:<?php echo $application->requestedQuantity; ?></p> -->
                                        <p><?php echo substr($application->reason, 0, 20) . (strlen($application->reason) > 20 ? '...' : ''); ?></p>
                                    </div>
                                </a>                                
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
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
