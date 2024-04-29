<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "benefactions";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/superadmin/benefaction">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">Manage Benefaction</h3>
            <p style="margin-left: 10px">Add comments to Benefaction</p>
            
            <div class="necessity-info">
                <table>
                    <tr class="necessity-data">
                        <th width="30%">Item Name</th>
                        <td width="70%"><?php echo $data['benefaction_details']->itemName ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Item Category</th>
                        <td width="70%"><?php echo $data['benefaction_details']->itemCategory ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Description</th>
                        <td width="70%"><?php echo $data['benefaction_details']->description ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Donor Name</th>
                        <td width="70%"><?php echo $data['benefaction_details']->name ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Item Quantity</th>
                        <td width="70%"><?php echo $data['benefaction_details']->itemQuantity ?></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Donated Quantity</th>
                        <td width="70%"><?php echo $data['benefaction_details']->donatedQuantity ?></td>
                    </tr>
                    <?php if($data['benefaction_details']->itemPhoto1 != NULL) {?>
                        <tr class="necessity-data">
                            <th width="30%">Item Photo 1</th>
                            <td width="70%">
                                <img src="<?php echo URLROOT ?>/benefactionUploads/<?php print_r($data['benefaction_details']->itemPhoto1); ?>" class="user-img" alt="">
                            </td>
                        </tr>
                    <?php }?>
                    <?php if($data['benefaction_details']->itemPhoto2 != NULL) {?>
                        <tr class="necessity-data">
                            <th width="30%">Item Photo 2</th>
                            <td width="70%">
                                <img src="<?php echo URLROOT ?>/benefactionUploads/<?php print_r($data['benefaction_details']->itemPhoto2); ?>" class="user-img" alt="">
                            </td>
                        </tr>
                    <?php }?>
                    <?php if($data['benefaction_details']->itemPhoto3 != NULL) {?>
                        <tr class="necessity-data">
                            <th width="30%">Item Photo 3</th>
                            <td width="70%">
                                <img src="<?php echo URLROOT ?>/benefactionUploads/<?php print_r($data['benefaction_details']->itemPhoto3); ?>" class="user-img" alt="">
                            </td>
                        </tr>
                    <?php }?>
                    <?php if($data['benefaction_details']->itemPhoto4 != NULL) {?>
                        <tr class="necessity-data">
                            <th width="30%">Item Photo 4</th>
                            <td width="70%">
                                <img src="<?php echo URLROOT ?>/benefactionUploads/<?php print_r($data['benefaction_details']->itemPhoto3); ?>" class="user-img" alt="">
                            </td>
                        </tr>
                    <?php }?>
                </table>
            </div>

            <div class="comment-form">
                <form action = "<?php echo URLROOT; ?>/benefaction/managebenefaction" method = "post">
                    <label for="comment">Comment</label><br><br>
                    <?php if(!empty($data['err'])){?>
                        <p><?php echo $data['err']?></p>
                    <?php }?>
                    <textarea class="comment-textarea" required name="comment" ></textarea>
                    <input type="text" name="benefaction_ID" hidden value="<?php echo $data['benefaction_ID'] ?>">
                    <input type="submit" value="Add">
                </form>
            </div>

            <div class="right-content" style="overflow-y:scroll;">
                <div class="right-content-title-container">
                    <h4 style="text-align:center">Comments</h4>
                </div>
                <div class="right-cards">  

                    <?php foreach($data['comments'] as $item) {?>
                        <div class="right-card">
                            <div class="title"><?php echo $item->adminName ?></div>
                            <div class="value"><?php echo $item->comment ?></div>
                        </div>
                    <?php }?>

                </div>
            </div>

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
