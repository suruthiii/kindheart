<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "scholarships";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

            <!-- Middle container -->
            <div class="middle-container">
                <!-- Go Back Button -->
                <a href="<?php echo URLROOT ?>/student/scholarships">
                        <table>
                            <tr>
                                <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                                <td width="70%">Go Back</td>
                            </tr>
                        </table>
                    </a>
                

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>View Scholarship</h3>
                    <p>View the information about the scholarship</p>
                </div>

                <div class="scholarship-left-column">
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
                                <th>Posted by</th>
                                <td><?php print_r($data['scholarship_details']->username) ?></td>
                            </tr>
                            <tr class="scholarship-data">
                                <th>Scholarship Starting Date</th>
                                <td><?php print_r($data['scholarship_details']->startDate) ?></td>
                            </tr>
                            <tr class="scholarship-data">
                                <th>Duration</th>
                                <td><?php print_r($data['scholarship_details']->duration) ?> Month</td>
                            </tr>
                            <tr class="scholarship-data">
                                <th>Description</th>
                                <td><?php print_r($data['scholarship_details']->description); ?></td>
                            </tr>
                            <tr class="scholarship-data">
                                <th>Deadline</th>
                                <td><?php print_r($data['scholarship_details']->deadline); ?></td>
                            </tr>
                            <tr class="benefaction-data">
                                    <th>status</th>
                                    <td><?php 
                                        $status = $data['scholarship_details']->availabilityStatus;
                                        $Acceptedstatus = $data['scholarship_details']->acceptanceStatus;
                                        $completedStatus = $data['scholarship_details']->verificationStatus;

                                        // Echo different divs based on the status
                                        
                                        if ($Acceptedstatus === 0) {
                                            echo '<div class="status_pending"><p>Pending</p></div>';

                                        } elseif ($Acceptedstatus === 1  ) {
                                            echo '<div class="status_accepted"><p>Accepted</p></div>';

                                        } elseif ($Acceptedstatus === 2 && $completedStatus === 0) {
                                            echo '<div class="status_accepted"><p>Accepted</p></div>';

                                        } elseif ($Acceptedstatus === 2 && $completedStatus === 1) {
                                            echo '<div class="status_rejected"><p>Donated</p></div>';

                                        } elseif ($Acceptedstatus === 2 && $completedStatus === 2) {
                                            echo '<div class="status_rejected"><p>Completed</p></div>';

                                        } elseif ($Acceptedstatus === 1 && $completedStatus === 3) {
                                            echo '<div class="status_rejected"><p>Complained</p></div>';

                                        } else {
                                            echo '<div class="status_unknown"><p>Rejected</p></div>';
                                        }
                                      
                                        ?></td>
                                </tr>
                                </table>

                                <?php 

                                    $status = $data['scholarship_details']->availabilityStatus;
                                    $Acceptedstatus = $data['scholarship_details']->acceptanceStatus;
                                    $completedStatus = $data['scholarship_details']->verificationStatus;

                                    // Echo different divs based on the status

                                    if ($Acceptedstatus === 2 && $completedStatus === 1) {
                                    
                                        echo '<div class="ack-buttons">
                                                    <form style="padding-right:10px;" action="'.URLROOT.'/student/sendAknowledgement" method="GET" class="btn" >
                                                        <input type="text" name="scholarshipID" id="scholarshipID" hidden value="' . $data["scholarship_details"]->scholarshipID . '" />
                                                        <input type="text" name="doneeID" id="doneeID" hidden value="' . $data["scholarship_details"]->studentID . '" />
                                                        <div class = "my-button"> <input type="submit" class="button-container" value="Recieved"> </div>
                                                    </form>

                                                    <form action="'.URLROOT.'/student/sendBenefactionComplain" method="GET" class="btn" >
                                                    <input type="text" name="scholarshipID" id="scholarshipID" hidden value="' . $data["scholarship_details"]->scholarshipID. '" />
                                                    <input type="text" name="doneeID" id="doneeID" hidden value="' . $data["scholarship_details"]->studentID . '" />
                                                    <div class = "my-button"> <input type="submit" class="button-container" value="Not Recieved"> </div>
                                                </form>
                                                </div>';
                                    } else {
                                        echo '<div class="status_rejected"></div>';
                                    }
                                    ?>
                        
                      
                    </div>
                </div>


            </div>
            

            <!-- right side bar for success story/ choose or add necessity -->
            <div class="rightside-bar-type-one">
                    <div class="right-side-bar">
                        <!-- title for rightside bar -->
                        <div class="rightside-bar-title">

                        <h3>Applied Scholarships</h3>

                        <?php foreach ($data['appliedScholarships'] as $item) { ?>
                                <a href="<?php echo URLROOT ?>/Student/ViewAppliedScholarship/<?php echo $item->scholarshipID?>">
                            <div class="applied-benefaction-cards">
                                <div class="left">
                                    <h3><?php echo $item->title; ?><h3>
                                    <p><?php echo $item->amount; ?> LKR</p>
                                
                                </div>
                                <div class="right">
                                    
                                <p><?php 
                                        $status = $item->availabilityStatus ;
                                        $Acceptedstatus = $item->acceptanceStatus  ;
                                        $completedStatus = $item->verificationStatus  ;
    

                                        // Echo different divs based on the status
                                        if ($Acceptedstatus === 0) {
                                            echo '<div class="status_pending"><p>Pending</p></div>';

                                        } elseif ($Acceptedstatus === 1  ) {
                                            echo '<div class="status_accepted"><p>Accepted</p></div>';

                                        } elseif ($Acceptedstatus === 2 && $completedStatus === 0) {
                                            echo '<div class="status_accepted"><p>Accepted</p></div>';

                                        } elseif ($Acceptedstatus === 2 && $completedStatus === 1) {
                                            echo '<div class="status_rejected"><p>Donated</p></div>';

                                        } elseif ($Acceptedstatus === 2 && $completedStatus === 2) {
                                            echo '<div class="status_rejected"><p>Completed</p></div>';

                                        } elseif ($Acceptedstatus === 1 && $completedStatus === 3) {
                                            echo '<div class="status_rejected"><p>Complained</p></div>';

                                        } else {
                                            echo '<div class="status_unknown"><p>Rejected</p></div>';
                                        }
                                        ?></p>
                                                                  
                                </div>
                            </div>
                            <?php } ?> 
                        </div>
                    </div>
                </div> 

        </div>
    </section>
</main>


<?php require APPROOT.'/views/inc/footer.php'; ?>