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
                    <button onclick="location.href='<?php echo URLROOT ?>/donor/donorSelectDonation'">Go Back</button>
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
                    <h3>Your Posted Benefactions</h3>
                </div>

                <div class="posted-benefaction-container">
                    <!-- Pending table -->
                    <div class="posted-benefaction-pending-table-caption">
                        <p>Pending</p>
                    </div>
                    <div class="posted-benefaction-pending-table-grey-line"></div>
                        <div class="posted-benefactions-pending-table">
                            <?php foreach($data['pendingBenefaction'] as $benefaction){?>
                                <table>
                                        <tr>
                                            <td width="10%">
                                                <?php
                                                    if($benefaction->itemCategory == "Educational Supplies and Tools"){
                                                        echo '<img src="' . URLROOT . '/img/necessity-icons/stationary.png" width="55" height="55">'; 
                                                    }elseif($benefaction->itemCategory == "Clothing and Accessories"){
                                                        echo '<img src="' . URLROOT . '/img/necessity-icons/clothings.png" width="55" height="55">';
                                                    }elseif($benefaction->itemCategory == "Recreation and Sports Equipment"){
                                                        echo '<img src="' . URLROOT . '/img/necessity-icons/sports.png" width="55" height="55">';
                                                    }elseif($benefaction->itemCategory == "Health and Wellness Products"){
                                                        echo '<img src="' . URLROOT . '/img/necessity-icons/health.png" width="55" height="55">';
                                                    }elseif($benefaction->itemCategory == "Transportation and Mobility"){
                                                        echo '<img src="' . URLROOT . '/img/necessity-icons/transport.png" width="55" height="55">';
                                                    }elseif($benefaction->itemCategory == "Literature and Reading Materials"){
                                                        echo '<img src="' . URLROOT . '/img/necessity-icons/books.png" width="55" height="55">';
                                                    }elseif($benefaction->itemCategory == "Other"){
                                                        echo '<img src="' . URLROOT . '/img/necessity-icons/other.png" width="55" height="55">';
                                                    }else{
                                                        echo '<img src="' . URLROOT . '/img/house.png" width="55" height="55">';
                                                    }

                                                ?>
                                            </td>

                                            <td width="50%" style="transform: translateX(5%);">
                                                <h4><?php echo $benefaction->itemName;?></h4>
                                                <p><?php echo substr($benefaction->description, 0, 20) . (strlen($benefaction->description) > 20 ? '...' : ''); ?></p>
                                            </td>

                                            
                                            <td width="20%" style="transform: translateX(-35%);">
                                                <p>
                                                    <?php echo $benefaction->itemQuantity;?> Items
                                                </p>
                                            </td>

                                            <td width="15%"  style="transform: translateX(-55%);" >
                                                <p>
                                                    <?php $remainingQuantity = $benefaction->itemQuantity - $benefaction->donatedQuantity;
                                                    echo $remainingQuantity;?> Remains
                                                </p>
                                            </td>

                                            <td width="30%"  style="transform: translateX(-15%);" >
                                                <p>
                                                    <?php echo $benefaction->totalRequestedQuantity;?> Items Requested
                                                </p>
                                            </td>

                                            <td width="10%"style="transform: translateX(15%);">
                                                <form action="<?php echo URLROOT ?>/benefaction/viewPostedBenefactions" method="get" class="view-form">
                                                    <input type="hidden" name="benefactionID" id="benefactionID" value="<?php echo $benefaction->benefactionID; ?>" />
                                                    <button type="submit" class="benefaction_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;" >
                                                        <img src="<?php echo URLROOT ?>/img/eye-solid.svg">
                                                    </button>
                                                </form>
                                            </td>

                                            <td width="10%"style="transform: translateX(15%);"> 
                                                <form action="<?php echo URLROOT ?>/benefaction/editPostedBenefactions" method="get" class="edit-form">
                                                    <input type="text" name="benefactionID" id="benefactionID" hidden value="<?php echo $benefaction->benefactionID; ?>" />
                                                    <button type="submit" class="benefaction_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;" >
                                                        <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg" style="width:15px;">                                        
                                                    </button>
                                                </form>
                                            </td>

                                            <td width="10%"style="transform: translateX(15%);">
                                                <form action="<?php echo URLROOT ?>/benefaction/deleteBenefactions" method="post" class="delete-form" id="delete">
                                                    <input type="hidden" name="benefactionID" id="benefactionID" value="<?php echo $benefaction->benefactionID; ?>" />
                                                    <button type="submit" class="benefaction_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;" onclick="confirmDelete(event)">
                                                    <img src="<?php echo URLROOT ?>/img/trash-solid.svg" style="width:15px;">
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>

                                </table>
                                
                            <?php }?>
                        </div>

                    <!-- On Progress table -->
                    <div class="posted-benefaction-onProgress-table-caption">
                        <p>On Progress</p>
                    </div>
                    <div class="posted-benefaction-onProgress-table-grey-line"></div>
                        <div class="posted-benefactions-onProgress-table">
                            <?php foreach($data['onProgressBenefaction'] as $benefaction){?>
                                <table>
                                        <tr>
                                        <td width="10%">
                                                <?php
                                                    if($benefaction->itemCategory == "Educational Supplies and Tools"){
                                                        echo '<img src="' . URLROOT . '/img/necessity-icons/stationary.png" width="55" height="55">'; 
                                                    }elseif($benefaction->itemCategory == "Clothing and Accessories"){
                                                        echo '<img src="' . URLROOT . '/img/necessity-icons/clothings.png" width="55" height="55">';
                                                    }elseif($benefaction->itemCategory == "Recreation and Sports Equipment"){
                                                        echo '<img src="' . URLROOT . '/img/necessity-icons/sports.png" width="55" height="55">';
                                                    }elseif($benefaction->itemCategory == "Health and Wellness Products"){
                                                        echo '<img src="' . URLROOT . '/img/necessity-icons/health.png" width="55" height="55">';
                                                    }elseif($benefaction->itemCategory == "Transportation and Mobility"){
                                                        echo '<img src="' . URLROOT . '/img/necessity-icons/transport.png" width="55" height="55">';
                                                    }elseif($benefaction->itemCategory == "Literature and Reading Materials"){
                                                        echo '<img src="' . URLROOT . '/img/necessity-icons/books.png" width="55" height="55">';
                                                    }elseif($benefaction->itemCategory == "Other"){
                                                        echo '<img src="' . URLROOT . '/img/necessity-icons/other.png" width="55" height="55">';
                                                    }else{
                                                        echo '<img src="' . URLROOT . '/img/house.png" width="55" height="55">';
                                                    }
                                                ?>
                                            </td>

                                            <td width="50%" style="transform: translateX(5%);">
                                                <h4><?php echo $benefaction->itemName;?></h4>
                                                <p><?php echo substr($benefaction->description, 0, 20) . (strlen($benefaction->description) > 20 ? '...' : ''); ?></p>
                                            </td>

                                            
                                            <td width="20%" style="transform: translateX(-70%);">
                                                <p>
                                                    <?php echo $benefaction->itemQuantity;?> Items
                                                </p>
                                            </td>

                                            <td width="30%" style="transform: translateX(-45%);">
                                                <p>
                                                    <?php echo $benefaction->acknowledgedDonatedQuantity; ?> Not Acknowledged
                                                </p>
                                            </td>
                                            <!-- here have to edit with requested quatity of student -->

                                            <!-- <td width="10%"style="transform: translateX(15%);"> 
                                                <form action="<?php echo URLROOT ?>/benefaction/editPostedBenefactions" method="post" class="edit-form">
                                                    <input type="text" name="edit" id="edit" hidden value="<?php echo $benefaction->benefactionID; ?>" />
                                                    <button type="submit" class="benefaction_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;" >
                                                        <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg" style="width:15px;">                                        
                                                    </button>
                                                </form>
                                            </td> -->

                                            <td width="10%"style="transform: translateX(15%);">
                                                <!-- <form action="<?php echo URLROOT ?>/benefaction/deleteBenefactions" method="post" class="delete-form" onsubmit="return confirmDelete();">
                                                    <input type="hidden" name="delete" id="delete" value="<?php echo $benefaction->benefactionID; ?>" />
                                                    <button type="submit" class="benefaction_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;">
                                                    <img src="<?php echo URLROOT ?>/img/trash-solid.svg" style="width:15px;">
                                                    </button>
                                                </form> -->
                                                <form action="<?php echo URLROOT ?>/benefaction/viewPostedBenefactions" method="get" class="view-form">
                                                    <input type="hidden" name="benefactionID" id="benefactionID" value="<?php echo $benefaction->benefactionID; ?>" />
                                                    <button type="submit" class="benefaction_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;" >
                                                        <img src="<?php echo URLROOT ?>/img/eye-solid.svg">
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>

                                </table>
                                
                            <?php }?>
                        </div>

                    <!-- Completed Table -->
                    <div class="posted-benefaction-Completed-table-caption">
                        <p>Completed</p>
                    </div>
                    <div class="posted-benefaction-Completed-table-grey-line"></div>
                    <div class="posted-benefactions-Completed-table">
                        <?php foreach($data['completedBenefaction'] as $benefaction){?>
                            <table>
                                    <tr>
                                        <td width="10%">
                                            <?php
                                                if($benefaction->itemCategory == "Educational Supplies and Tools"){
                                                    echo '<img src="' . URLROOT . '/img/necessity-icons/stationary.png" width="55" height="55">'; 
                                                }elseif($benefaction->itemCategory == "Clothing and Accessories"){
                                                    echo '<img src="' . URLROOT . '/img/necessity-icons/clothings.png" width="55" height="55">';
                                                }elseif($benefaction->itemCategory == "Recreation and Sports Equipment"){
                                                    echo '<img src="' . URLROOT . '/img/necessity-icons/sports.png" width="55" height="55">';
                                                }elseif($benefaction->itemCategory == "Health and Wellness Products"){
                                                    echo '<img src="' . URLROOT . '/img/necessity-icons/health.png" width="55" height="55">';
                                                }elseif($benefaction->itemCategory == "Transportation and Mobility"){
                                                    echo '<img src="' . URLROOT . '/img/necessity-icons/transport.png" width="55" height="55">';
                                                }elseif($benefaction->itemCategory == "Literature and Reading Materials"){
                                                    echo '<img src="' . URLROOT . '/img/necessity-icons/books.png" width="55" height="55">';
                                                }elseif($benefaction->itemCategory == "Other"){
                                                    echo '<img src="' . URLROOT . '/img/necessity-icons/other.png" width="55" height="55">';
                                                }else{
                                                    echo '<img src="' . URLROOT . '/img/house.png" width="55" height="55">';
                                                }

                                            ?>
                                        </td>

                                        <td width="50%" style="transform: translateX(5%);">
                                            <h4><?php echo $benefaction->itemName;?></h4>
                                            <p><?php echo substr($benefaction->description, 0, 20) . (strlen($benefaction->description) > 20 ? '...' : ''); ?></p>
                                        </td>

                                        <td width="20%" style="transform: translateX(-35%);">
                                                <p>
                                                    <?php echo $benefaction->itemQuantity;?> Items
                                                </p>
                                            </td>

                                            <td width="30%"  style="transform: translateX(-10%);" >
                                                <p>
                                                    <?php echo $benefaction->donatedQuantity;?> Items Donated
                                                </p>
                                            </td>

                                        <td width="10%"style="transform: translateX(15%);">
                                            <!-- <form action="<?php echo URLROOT ?>/donor/editBenefaction" method="post" class="edit-form">
                                                <input type="hidden" name="edit" id="edit" value="<?php echo $benefaction->benefactionID; ?>" />
                                                <button type="submit" class="benefaction_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;" >
                                                    <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg" style="width:15px;">
                                                </button>
                                            </form> -->
                                        </td>

                                        <td width="10%"style="transform: translateX(15%);"> 
                                            <form action="<?php echo URLROOT ?>/benefaction/viewPostedBenefactions" method="get" class="view-form">
                                                <input type="hidden" name="benefactionID" id="benefactionID" value="<?php echo $benefaction->benefactionID; ?>" />
                                                <button type="submit" class="benefaction_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;" >
                                                    <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                                </button>
                                            </form>
                                        </td>

                                        <td width="10%"style="transform: translateX(15%);">
                                            <form action="<?php echo URLROOT ?>/benefaction/deleteBenefactions" method="post" class="delete-form" id="delete" >
                                                <input type="hidden" name="benefactionID" id="benefactionID" value="<?php echo $benefaction->benefactionID; ?>" />
                                                <button type="submit" class="benefaction_button" style=" background-color: rgba(245, 245, 245, 0); cursor: pointer; border: none;" onclick="confirmDecline(event)">
                                                    <img src="<?php echo URLROOT ?>/img/trash-solid.svg" style="width:15px;">
                                                </button>
                                            </form>
                                        </td>

                                    </tr>

                            </table>
                            
                        <?php }?>
                    </div>
                </div>

                <div class="add-benefaction-button-for-post">
                    <button onclick="location.href='<?php echo URLROOT ?>/benefaction/donorAddBenefactions'">
                        <img src="<?php echo URLROOT ?>/img/Plus.png">
                        <h5>Add Benefactions</h5>
                    </button>
                </div>

            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <?php require APPROOT.'/views/inc/components/giveonluforneedbar.php'; ?>

        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    // Function to handle delete confirmation
    function confirmDelete(event) {
        event.preventDefault(); // Prevent default form submission

        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to delete this benefaction. This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with form submission
                const form = event.target.closest('form'); // Find the closest form element
                if (form) {
                    form.submit(); // Submit the form
                }
            }
        });
    }

    // Bind the confirmDelete function to form submission events
    document.addEventListener('DOMContentLoaded', function() {
        const deleteForms = document.querySelectorAll('.delete-form'); // Select all delete forms
        deleteForms.forEach(form => {
            form.addEventListener('submit', confirmDelete); // Attach confirmDelete to form submission
        });
    });
</script>



<?php require APPROOT.'/views/inc/footer.php'; ?>
