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
                    <button onclick="location.href='<?php echo URLROOT ?>/benefaction/postedBenefactions'">Go Back</button>
                </div>

                <!-- main title -->
                <div class="donor-middle-container-title-typeone">
                    <h3>Posted Benefaction</h3>
                    <p>Last 30 Days</p>
                </div>
            
                <div class="benefaction-info">
                    <table>
                        <tr class="benefaction-data">
                            <th>Item Name</th>
                            <td><?php print_r($data['benefaction_details']->itemName); ?></td>
                        </tr>
                        <tr class="benefaction-data">
                            <th>Quantity</th>
                            <td><?php print_r($data['benefaction_details']->itemQuantity) ?></td>
                        </tr>
                        <tr class="benefaction-data">
                            <th>Description</th>
                            <td><?php print_r($data['benefaction_details']->description) ?></td>
                        </tr>
                        <tr class="benefaction-data-image-row">
                            <th>Images</th>
                            <?php if (!empty($data['benefaction_details']->itemPhoto1)): ?>
                                <td><img src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefaction_details']->itemPhoto1; ?>"></td>
                            <?php endif; ?>
                            <?php if (!empty($data['benefaction_details']->itemPhoto2)): ?>
                                <td><img src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefaction_details']->itemPhoto2; ?>"></td>
                            <?php endif; ?>
                            <?php if (!empty($data['benefaction_details']->itemPhoto3)): ?>
                                <td><img src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefaction_details']->itemPhoto3; ?>"></td>
                            <?php endif; ?>
                            <?php if (!empty($data['benefaction_details']->itemPhoto4)): ?>
                                <td><img src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefaction_details']->itemPhoto4; ?>"></td>
                            <?php endif; ?>
                        </tr>
                    </table>
                </div>

                <div class="view-benefaction-btn-container">
                    <form action="<?php echo URLROOT ?>/donor/editBenefaction" method="post" class="edit-form">
                        <input type="hidden" name="edit" id="edit" value="<?php echo $data['benefaction_details']->benefactionID; ?>" />
                        <button type="submit" class="view-benefaction_button" style="cursor: pointer;">
                            <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg" style="filter: invert(100%); width:15px;">
                            <h5>Edit</h5>
                        </button>
                    </form>

                    <form action="<?php echo URLROOT ?>/benefaction/deleteBenefactions" method="post" class="delete-form" onsubmit="return confirmDelete();">
                        <input type="hidden" name="delete" id="delete" value="<?php echo $data['benefaction_details']->benefactionID; ?>"/>
                        <button type="submit" class="view-benefaction_button" style="cursor: pointer;">
                            <img src="<?php echo URLROOT ?>/img/trash-solid.svg" style="filter: invert(100%); width:14px;">
                            <h5>Delete</h5>
                        </button>
                    </form>
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
