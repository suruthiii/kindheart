<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "necessities";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="donor-right-side-container">

            <!-- Middle container -->
            <div class="donor-middle-container">
                <!-- Go Back Button -->
                <div class="donor-goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <button onclick="location.href='<?php echo URLROOT ?>/donor/donorPostDonations'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="donor-middle-container-title-typeone">
                    <h3>Posted Benefactions</h3>
                    <p>Last 30 Days</p>
                </div>

                <!-- Pending table -->
                <div class="posted-benefaction-pending-table-caption">
                    <p>Pending</p>
                </div>
                <div class="posted-benefaction-pending-table-grey-line"></div>
                <div class="posted-benefactions-pending-table">
                    <?php foreach($data['pendingBenefaction'] as $benefaction){?>
                        <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png"></td>

                                    <td width="50%">
                                        <h4><?php echo $benefaction->itemName;?></h4>
                                        <p style="margin-bottom: 20px; margin-top: -10px; color: #6e6e6d;"><?php echo $benefaction->description;?></p>
                                    </td>

                                    <td width="10%"><p><?php echo $benefaction->itemQuantity;?></p></td>

                                    <td width="10%">
                                        <form action="<?php echo URLROOT ?>/donor/viewBenefaction" method="post" class="view-form">
                                            <input type="text" name="view" id="view" hidden value="" />
                                            <button type="submit" class="view">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>

                                    <td width="10%">
                                        <form action="<?php echo URLROOT ?>/donor/editBenefaction" method="post" class="edit-form">
                                            <input type="text" name="edit" id="edit" hidden value="" />
                                            <button type="submit" class="edit">
                                                <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>

                                    <td width="10%">
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="delete" id="delete" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmDelete();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
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

                <!-- <a href="<?php echo URLROOT ?>/Benefaction/viewDonorBenefaction"> -->
                    <div class="posted-benefactions-Completed-table">
                        <table>

                        </table>
                    </div>
                <!-- </a> -->

                <div class="add-benefaction-button-for-post">
                    <button onclick="location.href='<?php echo URLROOT ?>/donor/donorAddBenefactions'">
                        <img src="<?php echo URLROOT ?>/img/Plus.png">
                        <h5>Add Benefactions</h5>
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
