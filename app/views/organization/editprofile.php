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
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($_SESSION['user_name']) ?>" name="username" readonly required>
                                </div>
                            </div>
                    </div>
                 
                        <div class="lines">
                            <label for="">First Name</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->fName) ?>" name="fName" readonly required>
                                </div>
                            </div>
                        </div>
                   
                        <div class="lines">
                            <label for="">Last Name</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->lName) ?>" name="lName" readonly required>
                                </div>
                            </div>  
                        </div>
                        <div class="lines">
                            <label for="">Phone Number</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->phoneNumber) ?>" name="phoneNumber" readonly required>
                                </div>
                            </div>    
                        </div>

                        <div class="lines">
                            <label for="">Gender</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->gender) ?>" name="gender" readonly required>
                                </div>
                            </div>   
                        </div>
               
                        <div class="lines">
                            <label for="">Address</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->address) ?>" name="address" readonly required>
                                </div>
                            </div>   
                            
                        </div>
           
                        <div class="lines">
                            <label for="">Date Of Birth</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->dateOfBirth)?>" name="dateOfBirth" readonly required>
                                </div>
                            </div>   
        
                        </div>
                  
                        <div class="lines">
                            <label for="">National Identity Card Number</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->nicNumber) ?>" name="nicNumber" readonly required>
                                </div>
                            </div>   
                        </div>

                        <div class="lines">
                            <label for="">School Name</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->institutionName) ?>" name="institutionName" readonly required>
                                </div>

                                <div class="form-field-visibility">
                                    <label class="switch">
                                    <?php if ($data['studentData']->institutionNameVisibility==1): ?>
                                        <input type="checkbox" name="institutionNameVisibility" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="institutionNameVisibility" >
                                    <?php endif; ?>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="lines">
                            <label for="">Year Of Studying</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->studyingYear) ?>" name="studyingYear" readonly required>
                                </div>

                                <div class="form-field-visibility">
                                    <label class="switch">
                                    <?php if ($data['studentData']->institutionNameVisibility==1): ?>
                                        <input type="checkbox" name="studyingYearVisibility" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="studyingYearVisibility" >
                                    <?php endif; ?>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="lines">
                            <label for="">Student Type</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->studentType) ?>" name="studentType"readonly required>
                                </div>
                            </div>   
                             
                        </div>

                        <div class="lines">
                            <label for="">Caregiver Name</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->caregiverName) ?>" name="caregiverName" readonly required>
                                </div>

                                <div class="form-field-visibility">
                                    <label class="switch">
                                    <?php if ($data['studentData']->caregiverNameVisibility==1): ?>
                                        <input type="checkbox" name="caregiverNameVisibility" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="caregiverNameVisibility" >
                                    <?php endif; ?>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                            
                        </div>

                        <div class="lines">
                            <label for="" >Caregiver Type</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->caregiverType) ?>" name="caregiverType" readonly required>
                                </div>

                                <div class="form-field-visibility">
                                    <label class="switch">
                                    <?php if ($data['studentData']->caregiverTypeVisibility==1): ?>
                                        <input type="checkbox" name="caregiverTypeVisibility" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="caregiverTypeVisibility" >
                                    <?php endif; ?>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                             
                        </div>
                        <div class="lines">
                            <label for="">Caregiver's relation to the student</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->caregiverRelationship) ?>" name="caregiverRelationship" readonly required>
                                </div>

                                <div class="form-field-visibility">
                                    <label class="switch">
                                    <?php if ($data['studentData']->caregiverRelationshipVisibility==1): ?>
                                        <input type="checkbox" name="caregiverRelationshipVisibility" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="caregiverRelationshipVisibility" >
                                    <?php endif; ?>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                           
                        </div>

                        <div class="lines">
                            <label for="">Caregiver's Occupation</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->caregiverOccupation) ?>" name="caregiverOccupation"  readonly required>
                                </div>

                                <div class="form-field-visibility">
                                    <label class="switch">
                                    <?php if ($data['studentData']->caregiverOccupationVisibility==1): ?>
                                        <input type="checkbox" name="caregiverOccupationVisibility" checked>
                                    <?php else: ?>
                                        <input type="checkbox" name="caregiverOccupationVisibility" >
                                    <?php endif; ?>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                           
                        </div>

                        <div class="lines">
                            <label for="">Currently Receiving Scholarships</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->receivingScholarships) ?>" name="receivingScholarships" >
                                </div>
                            </div>   
                            
                        </div>

                        <h4> Bank Details</h4>

                        <div class="lines">
                            <label for="">Account Holder's Name</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->accountHoldersName) ?>" name="accountHoldersName" required>
                                </div>
                            </div>   
                           
                        </div>

                        <div class="lines">
                            <label for="">Account Number</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->accNumber) ?>" name="accNumber" required>
                                </div>
                            </div>   
                 
                        </div>

                        <div class="lines">
                            <label for="">Bank</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->bankName) ?>" name="bankName" required>
                                </div>
                            </div>  
                            
                        </div>

                        <div class="lines">
                            <label for="">Branch</label>
                            <div class="form-field">
                                <div class="form-field-data">
                                    <input type="text" value="<?php print_r($data['studentData']->branchName) ?>" name="branchName" required>
                                </div>
                            </div>  
                           
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
