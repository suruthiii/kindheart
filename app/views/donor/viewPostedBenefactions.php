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
                            <th width="30%">Item Name</th>
                            <!-- <td width="70%"><?php print_r($data['benefaction_details']->itemName); ?></td> -->
                        </tr>
                        <tr class="benefaction-data">
                            <th width="30%">Quantity</th>
                            <!-- <td width="70%"><?php print_r($data['benefaction_details']->itemQuantity) ?></td> -->
                        </tr>
                        <tr class="benefaction-data">
                            <th width="30%">Description</th>
                            <!-- <td width="70%"><?php print_r($data['benefaction_details']->description) ?></td> -->
                        </tr>
                        <tr class="benefaction-data">
                            <th width="30%">Images</th>
                            <!-- <td width="18%"><?php print_r($data['benefaction_details']->itemPhoto1) ?></td>
                            <td width="18%"><?php print_r($data['benefaction_details']->itemPhoto2) ?></td>
                            <td width="18%"><?php print_r($data['benefaction_details']->itemPhoto3) ?></td>
                            <td width="18%"><?php print_r($data['benefaction_details']->itemPhoto4) ?></td> -->
                        </tr>
                    </table>
                </div>

                <div class="view-benefaction-btn-container">
                    <a href="" class="view-donation-btn">Edit</a>
                    <a href="" class="view-donation-btn">Delete</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
