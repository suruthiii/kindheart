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
                    <h3>Profile Viewwww</h3>
                    <p>Edit your profile details (some details cannot be change due to validation policies)</p>
                </div>
                <div class ="form-container">

                <div class="edit-profile-form">
                    <form action="#" method="post">
                 
                        <div class="lines">
                            <label for="">First Name</label>
                            <input type="text" value="<?php print_r($data['studentData']->fName) ?>" required>
                        </div>
                   
                        <div class="lines">
                            <label for="">Last Name</label>
                            <input type="text" value="<?php print_r($data['studentData']->lName) ?>" required>  
                        </div>
                        <div class="lines">
                            <label for="">Phone Number</label>
                            <input type="text" value="<?php print_r($data['studentData']->phoneNumber) ?>" required>  
                        </div>

                        <div class="lines">
                            <label for="">Gender</label>
                            <input type="text" value="<?php print_r($data['studentData']->gender) ?>" required>  
                        </div>
               
                        <div class="lines">
                            <label for="">Address</label>
                            <input type="textarea" value="<?php print_r($data['studentData']->address) ?>" required></textarea>
                        </div>
           
                        <div class="lines">
                            <label for="">Date Of Birth</label>
                            <input type="tel" value="<?php print_r($data['studentData']->dateOfBirth)?>" required>  
                        </div>
                  
                        <div class="lines">
                            <label for="">National Identity Card Number</label>
                            <input type="text" value="<?php print_r($data['studentData']->nicNumber) ?>" required>
                        </div>

                        <div class="lines">
                            <label for="">School Name</label>
                            <input type="text" value="<?php print_r($data['studentData']->institutionName) ?>" required>
                        </div>

                        <div class="lines">
                            <label for="">Year Of Studying</label>
                            <input type="text" value="<?php print_r($data['studentData']->studyingYear) ?>" required>
                        </div>

                        <div class="lines">
                            <label for="">Student Type</label>
                            <input type="text" value="<?php print_r($data['studentData']->studentType) ?>" required>  
                        </div>

                        <div class="lines">
                            <label for="">Caregiver Name</label>
                            <input type="text" value="<?php print_r($data['studentData']->caregiverName) ?>" required>  
                        </div>

                        <div class="lines">
                            <label for="">Caregiver Type</label>
                            <input type="text" value="<?php print_r($data['studentData']->caregiverType,) ?>" required>  
                        </div>
                        <div class="lines">
                            <label for="">Caregiver's relation to the student</label>
                            <input type="text" value="<?php print_r($data['studentData']->caregiverRelationship) ?>" required>  
                        </div>

                        <div class="lines">
                            <label for="">Caregiver's Occupation</label>
                            <input type="text" value="<?php print_r($data['studentData']->caregiverOccupation,) ?>" required>  
                        </div>

                        <h4> Bank Details</h4>

                        <div class="lines">
                            <label for="">Account Holder's Name</label>
                            <input type="text" value="<?php print_r($data['studentData']->accountHoldersName,) ?>" required>  
                        </div>

                        <div class="lines">
                            <label for="">Account Number</label>
                            <input type="text" value="<?php print_r($data['studentData']->accNumber) ?>" required>  
                        </div>

                        <div class="lines">
                            <label for="">Bank</label>
                            <input type="text" value="<?php print_r($data['studentData']->bankName) ?>" required>  
                        </div>

                        <div class="lines">
                            <label for="">Branch</label>
                            <input type="text" value="<?php print_r($data['studentData']->branchName) ?>" required>  
                        </div>
                        
                        <!-- Add button -->
                            <div class="btn">
                                <input type="submit" value="Save Changes" class="addtext1">
                            </div>
                        </form>
                </div>
</div>



            </div>
            

          
        </div>
    </section>
</main>
<script>
   

    </script>

<?php require APPROOT.'/views/inc/footer.php'; ?>
