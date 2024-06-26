<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "necessities";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
                <div class="back-arrow-btn">
                    <a href="<?php echo URLROOT ?>/admin/necessity">
                        <table>
                            <tr>
                                <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                                <td width="70%">Go Back</td>
                            </tr>
                        </table>
                    </a>
                </div>

            <h3 style="margin-top: 25px">Monetary Necessities</h3>
            <p style="margin-left: 10px"> </p>
            <div class="list">
                <div class="list-title">
                    <h4>Pending</h4>
                </div>
                
                <div class="card-list">
                    <?php foreach($data['pending'] as $item) { ?>
                    <a href="<?php echo URLROOT ?>/necessity/viewmonetary?necessity_ID=<?php echo $item->necessityID; ?>">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="30%" class="content">
                                        <h4><?php echo $item->necessityName; ?></h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $item->description; ?></p>
                                    </td>
                                    <td width="30%" class="amount">Rs.&nbsp;<?php echo $item->amount; ?>.00</td>
                                    <td width="30%" class="option">
                                        <form action="<?php echo URLROOT ?>/necessity/managemonetary" method="get" class="assign-manage-form">
                                            <input type="text" id="name" name="necessity_ID" hidden value="<?php echo $item->necessityID; ?>" />
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
                    <h4>Confirmed</h4>
                </div>
                
                <div class="card-list">
                    <?php foreach($data['confirmed'] as $item) { ?>
                    <a href="<?php echo URLROOT ?>/necessity/viewmonetary?necessity_ID=<?php echo $item->necessityID; ?>">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="30%" class="content">
                                        <h4><?php echo $item->necessityName; ?></h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $item->description; ?></p>
                                    </td>
                                    <td width="30%" class="amount">Rs.&nbsp;<?php echo $item->amount; ?>.00</td>
                                    <td width="30%" class="option">
                                        <!-- <form action="<?php echo URLROOT ?>/necessity/managemonetary" method="get" class="assign-manage-form">
                                            <input type="text" id="name" name="necessity_ID" hidden value="<?php echo $item->necessityID; ?>" />
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

            <div class="list">
                <div class="list-title">
                    <h4>Ongoing</h4>
                </div>
                <div class="card-list">
                    <?php foreach($data['ongoing'] as $item) { ?>
                    <a href="<?php echo URLROOT ?>/necessity/viewmonetary?necessity_ID=<?php echo $item->necessityID; ?>">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="30%" class="content">
                                        <h4><?php echo $item->necessityName; ?></h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $item->description; ?></p>
                                    </td>
                                    <td width="30%" class="amount">Rs.&nbsp;<?php echo $item->amount; ?>.00</td>
                                    <td width="30%" class="option">
                                        <!-- <form action="<?php echo URLROOT ?>/necessity/managemonetary" method="get" class="assign-manage-form">
                                            <input type="text" id="name" name="necessity_ID" hidden value="<?php echo $item->necessityID; ?>" />
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

            <!-- <div class="right-content">
                <div class="right-cards">

                    
                    <div class="right-card">
                        <div class="title">Posted Necessities</div>
                        <div class="value">58,977</div>
                    </div>

                    
                    <div class="right-card">
                        <div class="title">Fulfilled Necessities</div>
                        <div class="value">58,977</div>
                    </div>

                    
                    <div class="right-card">
                        <div class="title">Monthly Donations</div>
                        <div class="value">Rs. 58,977.00</div>
                    </div>

                    
                    <div class="right-card">
                        <div class="title">Total Donations</div>
                        <div class="value">Rs. 58,977.00</div>
                    </div>
                </div>
            </div> -->
            
        </div>
    </section>
</main>

<script>
    function confirmSubmit() {
        return confirm("Are you sure you want to delete this?");
    }
</script>

<?php require APPROOT.'/views/inc/footer.php'; ?>


                
