<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "benefactions";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

        <a href="<?php echo URLROOT ?>/student/benefactions">
            <table>
                <tr>
                    <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                    <td width="70%">Go Back</td>
                </tr>
            </table>
        </a>

            <div class="donor-middle-container-title-typeone">
                       
                        <h3>Posted Benefaction</h3>
                        <p>View the information about benefaction</p>
                    </div>

                <div class="two-column-container">
                    <!-- Left column for view-benefaction-form -->
                    <div class="view-benefaction-left-column">
                        <!-- Benefaction Details -->
                        <div class="benefaction-info">
                            <table>
                                <tr class="benefaction-data">
                                    <th>Item Name</th>
                                    <td><?php print_r($data['benefactions']->itemName); ?></td>
                                </tr>
                                <tr class="benefaction-data">
                                    <th>Posted By</th>
                                    <td><?php print_r($data['benefactions']->username); ?></td>
                                </tr>
                                <tr class="benefaction-data">
                                    <th>Posted Date</th>
                                    <td><?php print_r($data['benefactions']->postedDate); ?></td>
                                </tr>
                                <tr class="benefaction-data">
                                    <th>Category</th>
                                    <td><?php print_r($data['benefactions']->itemCategory); ?></td>
                                </tr>
                                <tr class="benefaction-data">
                                    <th>Quantity</th>
                                    <td><?php print_r($data['benefactions']->itemQuantity) ?></td>
                                </tr>
                                <tr class="benefaction-data">
                                    <th>Description</th>
                                    <td><?php print_r($data['benefactions']->description) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Right column for photos container -->                    
                    <div class="view-benefaction-right-column">
                        <div class="view-benefaction-right-column-inner">
                            <div class="chosen-photos-container" id="chosen-photos-container1">
                                <?php if (!empty($data['benefactions']->itemPhoto1)): ?>
                                    <img style="max-width: 300px; max-height: 300px; background-color: #F5F5F5; box-shadow: 0px 4px 4px rgba(142, 0, 0, 0.25); border: 2px solid #8E0000; margin: 10px;" id="benefactionImage" src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefactions']->itemPhoto1; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="chosen-photos-container" id="chosen-photos-container2">
                                <?php if (!empty($data['benefactions']->itemPhoto2)): ?>
                                    <img style="max-width: 300px; max-height: 300px; background-color: #F5F5F5; box-shadow: 0px 4px 4px rgba(142, 0, 0, 0.25); border: 2px solid #8E0000; margin: 10px;" id="benefactionImage" src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefactions']->itemPhoto2; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="chosen-photos-container" id="chosen-photos-container3">
                                <?php if (!empty($data['benefactions']->itemPhoto3)): ?>
                                    <img style="max-width: 300px; max-height: 300px; background-color: #F5F5F5; box-shadow: 0px 4px 4px rgba(142, 0, 0, 0.25); border: 2px solid #8E0000; margin: 10px;" id="benefactionImage" src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefactions']->itemPhoto3; ?>">
                                <?php endif; ?>
                            </div>
                            <div class="chosen-photos-container" id="chosen-photos-container4">
                                <?php if (!empty($data['benefactions']->itemPhoto4)): ?>
                                    <img style="max-width: 300px; max-height: 300px; background-color: #F5F5F5; box-shadow: 0px 4px 4px rgba(142, 0, 0, 0.25); border: 2px solid #8E0000; margin: 10px;" id="benefactionImage" src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $data['benefactions']->itemPhoto4; ?>">
                                <?php endif; ?>
                            </div>                            
                        </div>
                    </div> 
                </div>

                <div class="view-benefaction-btn-container">

                    <!-- <form action="<?php echo URLROOT ?>/student/ApplyForBenefaction" method="GET" class="edit-form" >
                        <input type="text" name="benefactionID" id="benefactionID" hidden value="<?php echo  $data['benefactions']->benefactionID;?>" />
                        <?php if ($data['benefactions']->doneeID == $_SESSION['user_id']){?>
                                    <label> Already Applied</label>
                                <?php } else{?>
                                    <button type="submit" class="btn1" > Apply</button>
                                <?php }?>
                    </form> -->

                    
                </div>
            </div>


        </div>
    </section>
</main>

<script>


</script>


<?php require APPROOT.'/views/inc/footer.php'; ?>
