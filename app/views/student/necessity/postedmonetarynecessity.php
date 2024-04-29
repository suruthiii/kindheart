<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "necessities";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

            <!-- Middle container -->
            <div class="middle-container">
                <!-- Go Back Button -->
                <div class="goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <button onclick="location.href='<?php echo URLROOT ?>/student/necessities'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>Posted Monetary Necessities</h3>
                     
                </div>

                <!-- Pending table -->
                <div class="posted-necessity-pending-table-caption">
                    <p>Pending</p>
                </div>
                <div class="posted-necessity-pending-table-grey-line"></div>
                <div class="posted-necessities-pending-table">
                    <table>
                        <?php foreach($data['pendingtablerow'] as $pendingtablerow): ?>
                            <tr>
                                <td>
                                    <?php
                                        if ($pendingtablerow->monetaryNecessityType == "recurring"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/recurring.png" width="55" height="55">'; 
                                        }elseif($pendingtablerow->monetaryNecessityType == "onetime"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/one time.png" width="55" height="55">';
                                        }
                                    ?>
                                </td>
                                <td><h4 class="pending-postednecessityTitle"><?php echo $pendingtablerow->necessityName?></h4>
                                    <p class="pending-postednecessitydescription"><?php echo $pendingtablerow->description?></p>
                                </td>
                                <td><p>Rs. <?php echo number_format($pendingtablerow->requestedAmount-$pendingtablerow->receivedAmount, 2); ?></p></td>
                                <td>
                                    <form action="<?php echo URLROOT ?>/necessity/viewPendingMonetarynecessity" method="POST">
                                        <input type="hidden" name="necessityID" id="necessityID" value="<?php echo $pendingtablerow->necessityID; ?>">
                                        <button  type="submit">
                                            <img src="<?php echo URLROOT ?>/img/eye-solid.svg">
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <!-- if the necessity is recurring -->
                                    <?php if($pendingtablerow->monetaryNecessityType == "recurring") { ?>
                                        <form action="<?php echo URLROOT ?>/necessity/editRecuringMonetaryNecessity" method="POST">
                                            <input type="hidden" name="necessityID" id="necessityID" value="<?php echo $pendingtablerow->necessityID; ?>">
                                            <button  type="submit">
                                                <img style="height: 16px;  width: 18px" src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg">
                                            </button>
                                        </form>
                                    <!-- if the necessity is onetime -->
                                    <?php } else if($pendingtablerow->monetaryNecessityType == "onetime"){ ?>
                                        <form action="<?php echo URLROOT ?>/necessity/editOnetimeMonetaryNecessity" method="POST">
                                            <input type="hidden" name="necessityID" id="necessityID" value="<?php echo $pendingtablerow->necessityID; ?>">
                                            <button  type="submit">
                                                <img style="height: 16px;  width: 18px" src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg">
                                            </button>
                                        </form>
                                    <?php } ?>
                                </td>
                                <td>
                                    <form action="<?php echo URLROOT ?>/necessity/deleteNecessity" method="POST" class="delete-form" id="delete">
                                        <input type="hidden" name="necessityID" id="necessityID" value="<?php echo $pendingtablerow->necessityID; ?>">
                                        <button  type="submit" onclick="confirmDecline(event)">
                                            <img style="height: 16px;  width: 18px" src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

                <!-- Completed Table -->
                <div class="posted-necessity-Completed-table-caption">
                    <p>Completed</p>
                </div>
                <div class="posted-necessity-Completed-table-grey-line"></div>
                <div class="posted-necessities-Completed-table">
                    <table>
                        <?php foreach($data['completetablerow'] as $completetablerow): ?>
                            <tr>
                                <td>
                                    <?php
                                        if ($completetablerow->monetaryNecessityType == "recurring"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/recurring.png" width="55" height="55">'; 
                                        }elseif($completetablerow->monetaryNecessityType == "onetime"){
                                            echo '<img src="' . URLROOT . '/img/necessity-icons/one time.png" width="55" height="55">';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <h4 class="pending-postednecessityTitle"><?php echo $completetablerow->necessityName?></h4>
                                    <p class="pending-postednecessitydescription"><?php echo $completetablerow->description?></p>
                                </td>
                                <td><p>Rs. <?php echo number_format($completetablerow->requestedAmount, 2); ?></p></td>
                                <td>
                                    <form action="<?php echo URLROOT ?>/necessity/viewCompletedMonetarynecessity" method="POST">
                                        <input type="hidden" name="necessityID" id="necessityID" value="<?php echo $completetablerow->necessityID; ?>">
                                        <button  type="submit">
                                            <img src="<?php echo URLROOT ?>/img/eye-solid.svg">
                                        </button>
                                    </form>
                                </td>
                                <td></td>
                                <td>
                                    <form action="<?php echo URLROOT ?>/necessity/deleteNecessity" method="POST" class="delete-form" id="delete">
                                        <input type="hidden" name="necessityID" id="necessityID" value="<?php echo $completetablerow->necessityID; ?>">
                                        <button  type="submit" onclick="confirmDecline(event)">
                                            <img style="height: 16px;  width: 18px" src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>

                <div class="add-necessity-button-for-post">
                    <button onclick="location.href='<?php echo URLROOT ?>/necessity/addmonetarynecessity'">
                        <img src="<?php echo URLROOT ?>/img/Plus.png">
                        <h5>Add Necessities</h5>
                    </button>
                </div>

            </div>

            <!-- right side bar for success story/ choose or add necessity -->
            <div class="rightside-bar-type-one">
                <div class="right-side-bar">
                    <div class="right-side-bar-type-one-detailed-view-boxes-typeone">
                        <h5>Total Donation You Recieve</h5>
                        <p>Rs. <?php echo number_format(isset($data['totalReceivedAmount']) ? $data['totalReceivedAmount'] : 0 , 2); ?></p>
                    </div>
                    <div class="right-side-bar-type-one-detailed-view-boxes">
                        <h5>Donation Start Necessities</h5>
                    </div>

                    <div class="Still-not-completed-necessities">
                        <table>
                            <?php foreach($data['stillnotCompleted'] as $stillnotCompleted): ?>
                            <tr>
                                <td>
                                        <?php
                                            if ($stillnotCompleted->monetaryNecessityType == "recurring"){
                                                echo '<img src="' . URLROOT . '/img/necessity-icons/recurring.png" width="38" height="38">'; 
                                            }elseif($stillnotCompleted->monetaryNecessityType == "onetime"){
                                                echo '<img src="' . URLROOT . '/img/necessity-icons/one time.png" width="38" height="38">';
                                            }
                                        ?>
                                </td>
                                <td>
                                    <h4 class="pending-postednecessityTitle"><?php echo $stillnotCompleted->necessityName?></h4>
                                    <p class="pending-postednecessitydescription"><?php echo $stillnotCompleted->description?></p>
                                </td>
                                <td>
                                    <form action="<?php echo URLROOT ?>/necessity/ViewdonationstartNecessity" method="POST">
                                        <input type="hidden" name="necessityID" id="necessityID" value="<?php echo $stillnotCompleted->necessityID; ?>">
                                        <button  type="submit">
                                            <img src="<?php echo URLROOT ?>/img/eye-solid.svg">
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    
                </div>
            </div>

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
            text: 'You are about to delete this Posted Monetary Necessity. This action cannot be undone.',
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

