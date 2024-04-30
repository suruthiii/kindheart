<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "benefactions";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <h3>Benefactions</h3>
            <p style="margin-left: 10px"> </p>

            <div class="list">
                <div class="list-title">
                    <h4>Pending</h4>
                </div>

                <div class="card-list">
                    <?php foreach($data['pending'] as $item) {?>
                        <a href="<?php echo URLROOT ?>/benefaction/viewbenefaction?benefaction_ID=<?php echo $item->benefactionID; ?>">
                            <div class="card">
                                <table>
                                    <tr>
                                        <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                        <td width="30%" class="content">
                                            <h4><?php echo $item->itemName; ?></h4>
                                            <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $item->description; ?></p>
                                        </td>
                                        <td width="30%" class="amount"><?php echo $item->quantity; ?>&nbsp;items</td>
                                        <td width="30%" class="option">
                                            <form action="<?php echo URLROOT ?>/benefaction/managebenefaction" method="get" class="assign-manage-form">
                                                <input type="text" id="name" name="benefaction_ID" hidden value="<?php echo $item->benefactionID; ?>" />
                                                <button type="submit" class="assign-manage" onclick="">
                                                    Manage
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </a>
                    <?php }?>
                </div>

            </div>      
            
            
            <div class="list">
                <div class="list-title">
                    <h4>On Progress</h4>
                </div>
                
                <div class="card-list">

                    <?php foreach($data['on_progress'] as $item) {?>
                        <a href="<?php echo URLROOT ?>/benefaction/viewbenefaction?benefaction_ID=<?php echo $item->benefactionID; ?>">
                            <div class="card">
                                <table>
                                    <tr>
                                        <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                        <td width="30%" class="content">
                                            <h4><?php echo $item->itemName; ?></h4>
                                            <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $item->description; ?></p>
                                        </td>
                                        <td width="30%" class="amount"><?php echo $item->quantity; ?>&nbsp;items</td>
                                        <td width="30%" class="option">
                                            <!-- <form action="<?php echo URLROOT ?>/benefaction/managebenefaction" method="get" class="assign-manage-form">
                                                <input type="text" id="name" name="benefaction_ID" hidden value="<?php echo $item->benefactionID; ?>" />
                                                <button type="submit" class="assign-manage" onclick="">
                                                    Manage
                                                </button>
                                            </form> -->
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </a>
                    <?php }?>
                </div> 
            
            </div>    

            
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
