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
                       
                    </table>
                </div>


            </div>
            

            <!-- right side bar for success story/ choose or add necessity -->
            <div class="rightside-bar-type-one">
                    <div class="right-side-bar">
                        <!-- title for rightside bar -->
                        <div class="rightside-bar-title">

                            <h3>Apply for scholarship</h3>
                                <div class="application-form-data">
                                    <form class="add-form" method="POST" action="<?php echo URLROOT ?>/Scholarship/addAppliedScholarship">

                

                                        <label for="reason">Reason</label><br>
                                        <input type="textarea" id="reason" name="reason" required><br><br>

                                        <input type="text" name="scholarshipID" id="scholarshipID" hidden value="<?php echo $data["scholarshipID"]?>" />


                                        <input type="submit" value="Apply">
                            </form>
                        
                        </div>

                           



                        </div>

                        
                    </div>
                </div> 

        </div>
    </section>
</main>


<?php require APPROOT.'/views/inc/footer.php'; ?>