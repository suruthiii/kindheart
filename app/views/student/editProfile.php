<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "editprofile";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

            <!-- Middle container -->
            <div class="middle-container">
                <!-- Go Back Button -->
                

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>Edit Profile</h3>
                    <p>Edit your profile details (some details cannot be change due to validation policies)</p>
                </div>
                
                    <!-- <div class="edit-profile-picture">
                      <img class="profile-picture" src="<?php echo URLROOT ?>/img/woman.jpg" alt="">

                    </div> -->

                <div class="edit-profile-form">
                    <form action="<?php echo URLROOT ?>/student/editProfileDetails" method="post">

                    <div class="lines">
                        <div class="edit-profile-picture">
                        <img class="profile-picture" src="<?php echo URLROOT ?>/img/woman.jpg" alt="">
                        </div>
                            
                    </div>

                    <div class="lines">
                            <label for="">User Name</label>
                            <input type="text" value="<?php print_r($_SESSION['user_name']) ?>" name="fName" readonly required>
                        </div>
                 
                        <div class="lines">
                            <label for="">First Name</label>
                            <input type="text" value="<?php print_r($data['studentData']->fName) ?>" name="fName" readonly required>
                        </div>
                   
                        <div class="lines">
                            <label for="">Last Name</label>
                            <input type="text" value="<?php print_r($data['studentData']->lName) ?>" name="lName" required>  
                        </div>
                        <div class="lines">
                            <label for="">Phone Number</label>
                            <input type="text" value="<?php print_r($data['studentData']->phoneNumber) ?>" name="phoneNumber" required>  
                        </div>

                        <div class="lines">
                            <label for="">Gender</label>
                            <input type="text" value="<?php print_r($data['studentData']->gender) ?>" name="gender" required>  
                        </div>
               
                        <div class="lines">
                            <label for="">Address</label>
                            <input type="textarea" value="<?php print_r($data['studentData']->address) ?>" name="address" required></textarea>
                        </div>
           
                        <div class="lines">
                            <label for="">Date Of Birth</label>
                            <input type="tel" value="<?php print_r($data['studentData']->dateOfBirth)?>" name="dateOfBirth" required>  
                        </div>
                  
                        <div class="lines">
                            <label for="">National Identity Card Number</label>
                            <input type="text" value="<?php print_r($data['studentData']->nicNumber) ?>" name="nicNumber" required>
                        </div>

                        <div class="lines">
                            <label for="">School Name</label>
                            <input type="text" value="<?php print_r($data['studentData']->institutionName) ?>" name="institutionName" required>
                        </div>

                        <div class="lines">
                            <label for="">Year Of Studying</label>
                            <input type="text" value="<?php print_r($data['studentData']->studyingYear) ?>" name="studyingYear" required>
                        </div>

                        <div class="lines">
                            <label for="">Student Type</label>
                            <input type="text" value="<?php print_r($data['studentData']->studentType) ?>" name="studentType" required>  
                        </div>

                        <div class="lines">
                            <label for="">Caregiver Name</label>
                            <input type="text" value="<?php print_r($data['studentData']->caregiverName) ?>" name="caregiverName" required>  
                        </div>

                        <div class="lines">
                            <label for="">Caregiver Type</label>
                            <input type="text" value="<?php print_r($data['studentData']->caregiverType) ?>" name="caregiverType" required>  
                        </div>
                        <div class="lines">
                            <label for="">Caregiver's relation to the student</label>
                            <input type="text" value="<?php print_r($data['studentData']->caregiverRelationship) ?>" name="caregiverRelationship" required>  
                        </div>

                        <div class="lines">
                            <label for="">Caregiver's Occupation</label>
                            <input type="text" value="<?php print_r($data['studentData']->caregiverOccupation) ?>" name="caregiverOccupation" required>  
                        </div>

                        <div class="lines">
                            <label for="">Currently Receiving Scholarships</label>
                            <input type="textarea" value="<?php print_r($data['studentData']->receivingScholarships) ?>" name="caregiverOccupation" >  
                        </div>

                        <h4> Bank Details</h4>

                        <div class="lines">
                            <label for="">Account Holder's Name</label>
                            <input type="text" value="<?php print_r($data['studentData']->accountHoldersName) ?>" name="accountHoldersName" required>  
                        </div>

                        <div class="lines">
                            <label for="">Account Number</label>
                            <input type="text" value="<?php print_r($data['studentData']->accNumber) ?>" name="accNumber" required>  
                        </div>

                        <div class="lines">
                            <label for="">Bank</label>
                            <input type="text" value="<?php print_r($data['studentData']->bankName) ?>" name="bankName" required>  
                        </div>

                        <div class="lines">
                            <label for="">Branch</label>
                            <input type="text" value="<?php print_r($data['studentData']->branchName) ?>" name="branchName" required>  
                        </div>
                        
                        <!-- Add button -->
                            <div class="btn">
                                <input type="submit" value="Save Changes" >
                            </div>
                        </form>
                </div>




            </div>
            

          
        </div>
    </section>
</main>
<script>
   

    </script>

<?php require APPROOT.'/views/inc/footer.php'; ?>
