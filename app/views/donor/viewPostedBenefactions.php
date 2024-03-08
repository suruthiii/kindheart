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
                    <h3>Posted Benefaction</h3>
                    <p>Last 30 Days</p>
                </div>
            
                <div class="benefaction-info">
                    <table>
                        <tr class="benefaction-data">
                            <th width="20%">Item Name</th>
                            <td width="20%"><?php print_r($data['benefaction_details']->itemName); ?></td>
                        </tr>
                        <tr class="benefaction-data">
                            <th width="20%">Quantity</th>
                            <td width="20%"><?php print_r($data['benefaction_details']->itemQuantity) ?></td>
                        </tr>
                        <tr class="benefaction-data">
                            <th width="20%">Description</th>
                            <td width="20%"><?php print_r($data['benefaction_details']->description) ?></td>
                        </tr>
                        <tr class="benefaction-data" style="height: 100px">
                            <th width="20%">Images</th>
                            <td width="20%"><img src="<?php echo "img/benefactionPhotos/".$data['benefaction_details']->itemPhoto1; ?>" width="100px"></td>
                            <td width="20%"><img src="<?php echo $data['benefaction_details']->itemPhoto2; ?>"></td>
                            <td width="20%"><img src="<?php echo $data['benefaction_details']->itemPhoto3; ?>"></td>
                            <td width="20%"><img src="<?php echo $data['benefaction_details']->itemPhoto4; ?>"></td>
                        </tr>
                    </table>
                </div>

                <div class="view-benefaction-btn-container">
                    <button onclick="location.href='<?php echo URLROOT ?>/benefaction/editPostedBenefactions'">
                        <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg" style="filter: invert(100%); width:15px;">
                        <h5>Edit</h5>
                    </button>

                    <button onclick="location.href='<?php echo URLROOT ?>/benefaction/donorAddBenefactions'">
                        <img src="<?php echo URLROOT ?>/img/trash-solid.svg" style="filter: invert(100%); width:15px;">
                        <h5>Delete</h5>
                    </button>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
