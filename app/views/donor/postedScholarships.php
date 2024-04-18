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
                    <!-- <button onclick="location.href='<?php echo URLROOT ?>/donor/donorSelectDonation'">Go Back</button> -->
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
                    <h3>Your Posted Scholarships</h3>
                    <p>Last 30 Days</p>
                </div>

                <!-- Pending table -->
                <div class="posted-scholarship-pending-table-caption">
                    <p>Pending</p>
                </div>
                <div class="posted-scholarship-pending-table-grey-line"></div>
                    <div class="posted-scholarships-pending-table">
                        <?php foreach($data['pendingScholarship'] as $scholarship){?>
                            <table>
                                    <tr>
                                        <td width="10%">
                                            <img src="<?php echo URLROOT ?>/img/necessity-icons/stationary.png" width="55" height="55">
                                        </td>

                                        <td width="50%">
                                            <h4><?php echo $scholarship->title;?></h4>
                                            <p><?php echo substr($scholarship->description, 0, 20) . (strlen($scholarship->description) > 20 ? '...' : ''); ?></p>
                                        </td>

                                        <td width="10%"  style="transform: translateX(-150%);" ><p><?php echo $scholarship->amount;?> LKR </p></td>

                                        <td width="10%"style="transform: translateX(15%);">
                                            <form action="<?php echo URLROOT ?>/scholarship/viewPostedScholarships" method="get" class="view-form">
                                                <input type="hidden" name="scholarshipID" id="scholarshipID" value="<?php echo $scholarship->scholarshipID; ?>" />
                                                <button type="submit" class="scholarship_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;" >
                                                    <img src="<?php echo URLROOT ?>/img/eye-solid.svg">
                                                </button>
                                            </form>
                                        </td>

                                        <td width="10%"style="transform: translateX(15%);"> 
                                            <form action="<?php echo URLROOT ?>/scholarship/editPostedScholarships" method="get" class="edit-form">
                                                <input type="text" name="scholarshipID" id="scholarshipID" hidden value="<?php echo $scholarship->scholarshipID; ?>" />
                                                <button type="submit" class="scholarship_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;" >
                                                    <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg" style="width:15px;">                                        
                                                </button>
                                            </form>
                                        </td>

                                        <td width="10%"style="transform: translateX(15%);">
                                            <form action="<?php echo URLROOT ?>/scholarship/deleteScholarships" method="post" class="delete-form" onsubmit="return confirmDelete();">
                                                <input type="hidden" name="scholarshipID" id="scholarshipID" value="<?php echo $scholarship->scholarshipID; ?>" />
                                                <button type="submit" class="scholarship_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" style="width:15px;">
                                                </button>
                                            </form>
                                        </td>

                                    </tr>

                            </table>
                            
                        <?php }?>
                    </div>

                <!-- On Progress table -->
                <div class="posted-scholarship-onProgress-table-caption">
                    <p>On Progress</p>
                </div>
                <div class="posted-scholarship-onProgress-table-grey-line"></div>
                    <div class="posted-scholarships-onProgress-table">
                        <?php foreach($data['onProgressScholarship'] as $scholarship){?>
                            <table>
                                    <tr>
                                        <td width="10%">
                                            <img src="<?php echo URLROOT ?>/img/necessity-icons/stationary.png" width="55" height="55">
                                        </td>

                                        <td width="50%">
                                            <h4><?php echo $scholarship->title;?></h4>
                                            <p><?php echo substr($scholarship->description, 0, 20) . (strlen($scholarship->description) > 20 ? '...' : ''); ?></p>
                                        </td>

                                        <td width="10%"  style="transform: translateX(-150%);" ><p><?php echo $scholarship->amount;?> LKR </p></td>
                                        <!-- here have to edit with requested quatity of student -->

                                        <td width="10%"style="transform: translateX(15%);"> 
                                            <!-- <form action="<?php echo URLROOT ?>/scholarship/editPostedScholarships" method="post" class="edit-form">
                                                <input type="text" name="edit" id="edit" hidden value="<?php echo $scholarship->scholarshipID; ?>" />
                                                <button type="submit" class="scholarship_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;" >
                                                    <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg" style="width:15px;">                                        
                                                </button>
                                            </form> -->
                                        </td>
                                        
                                        <td width="10%"style="transform: translateX(15%);"> 
                                            <!-- <form action="<?php echo URLROOT ?>/scholarship/editPostedScholarships" method="post" class="edit-form">
                                                <input type="text" name="edit" id="edit" hidden value="<?php echo $scholarship->scholarshipID; ?>" />
                                                <button type="submit" class="scholarship_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;" >
                                                    <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg" style="width:15px;">                                        
                                                </button>
                                            </form> -->
                                        </td>

                                        <td width="10%"style="transform: translateX(15%);">
                                            <!-- <form action="<?php echo URLROOT ?>/scholarship/deleteScholarships" method="post" class="delete-form" onsubmit="return confirmDelete();">
                                                <input type="hidden" name="delete" id="delete" value="<?php echo $scholarship->scholarshipID; ?>" />
                                                <button type="submit" class="scholarship_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" style="width:15px;">
                                                </button>
                                            </form> -->
                                            <form action="<?php echo URLROOT ?>/scholarship/viewPostedScholarships" method="get" class="view-form">
                                                <input type="hidden" name="scholarshipID" id="scholarshipID" value="<?php echo $scholarship->scholarshipID; ?>" />
                                                <button type="submit" class="scholarship_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;" >
                                                    <img src="<?php echo URLROOT ?>/img/eye-solid.svg">
                                                </button>
                                            </form>
                                        </td>

                                    </tr>

                            </table>
                            
                        <?php }?>
                    </div>

                <!-- Completed Table -->
                <div class="posted-scholarship-Completed-table-caption">
                    <p>Completed</p>
                </div>
                <div class="posted-scholarship-Completed-table-grey-line"></div>
                    <div class="posted-scholarships-Completed-table">
                    <?php foreach($data['completedScholarship'] as $scholarship){?>
                        <table>
                                <tr>
                                    <td width="10%">
                                            <img src="<?php echo URLROOT ?>/img/necessity-icons/stationary.png" width="55" height="55">
                                        </td>

                                    <td width="50%">
                                        <h4><?php echo $scholarship->title;?></h4>
                                        <p><?php echo substr($scholarship->description, 0, 20) . (strlen($scholarship->description) > 20 ? '...' : ''); ?></p>
                                    </td>

                                    <td width="10%"  style="transform: translateX(-150%);" ><p><?php echo $scholarship->amount;?> LKR </p></td>

                                    <td width="10%"style="transform: translateX(15%);">
                                        <!-- <form action="<?php echo URLROOT ?>/donor/editScholarship" method="post" class="edit-form">
                                            <input type="hidden" name="edit" id="edit" value="<?php echo $scholarship->scholarshipID; ?>" />
                                            <button type="submit" class="scholarship_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;" >
                                                <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg" style="width:15px;">
                                            </button>
                                        </form> -->
                                    </td>

                                    <td width="10%"style="transform: translateX(15%);"> 
                                        <form action="<?php echo URLROOT ?>/scholarship/viewPostedScholarships" method="get" class="view-form">
                                            <input type="hidden" name="scholarshipID" id="scholarshipID" value="<?php echo $scholarship->scholarshipID; ?>" />
                                            <button type="submit" class="scholarship_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;" >
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>

                                    <td width="10%"style="transform: translateX(15%);">
                                        <form action="<?php echo URLROOT ?>/scholarship/deleteScholarships" method="post" class="delete-form" onsubmit="return confirmDelete();">
                                            <input type="hidden" name="scholarshipID" id="scholarshipID" value="<?php echo $scholarship->scholarshipID; ?>" />
                                            <button type="submit" class="scholarship_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" style="width:15px;">
                                            </button>
                                        </form>
                                    </td>

                                </tr>

                        </table>
                        
                    <?php }?>
                    </div>
                <!-- </a> -->

                <div class="add-scholarship-button-for-post">
                    <button onclick="location.href='<?php echo URLROOT ?>/scholarship/donorAddscholarships'">
                        <img src="<?php echo URLROOT ?>/img/Plus.png">
                        <h5>Add scholarships</h5>
                    </button>
                </div>

            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <?php require APPROOT.'/views/inc/components/askonluforneedbar.php'; ?>

        </div>
    </section>
</main>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this?");
    }
</script>

<?php require APPROOT.'/views/inc/footer.php'; ?>
