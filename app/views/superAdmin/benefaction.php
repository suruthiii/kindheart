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
            <p style="margin-left: 10px">Last 30 days</p>

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

            <div class="right-content">
                <div class="right-cards">

                    <!-- Card 1 -->
                    <div class="right-card">
                        <div class="title">Posted Benefactions</div>
                        <div class="value">58,977</div>
                    </div>

                    <!-- Card 2 -->
                    <div class="right-card">
                        <div class="title">Benefaction Requests</div>
                        <div class="value">58,977</div>
                    </div>

                    <!-- Card 3 -->
                    <div class="right-card">
                        <div class="title">Confirmed Benefactions</div>
                        <div class="value">58,977</div>
                    </div>

                    <!-- Card 4 -->
                    <div class="right-card">
                        <div class="title">Received Benefactions</div>
                        <div class="value">58,977</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
