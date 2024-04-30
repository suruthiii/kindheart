<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "scholarships";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <h3>Scholarships</h3>
            <p style="margin-left: 10px"> </p>
            
            <div class="list">
                <div class="list-title">
                    <h4>Available</h4>
                </div>
                
                <div class="card-list">
                    <?php foreach($data['pending'] as $item) {?>
                    <a href="<?php echo URLROOT ?>/scholarship/viewscholarship?scholarship_ID=<?php echo $item->scholarshipID; ?>">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="30%" class="content">
                                        <h4><?php echo $item->title; ?></h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $item->description; ?></p>
                                    </td>
                                    <td width="30%" class="amount">Rs.&nbsp;<?php echo $item->amount; ?>.00</td>
                                    <td width="30%" class="option">
                                        <form action="<?php echo URLROOT ?>/scholarship/managescholarship" method="get" class="assign-manage-form">
                                            <input type="text" id="name" name="scholarship_ID" hidden value="<?php echo $item->scholarshipID; ?>" />
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
                    <?php foreach($data['confirmed'] as $item) {?>
                    <a href="<?php echo URLROOT ?>/scholarship/viewscholarship?scholarship_ID=<?php echo $item->scholarshipID; ?>">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="30%" class="content">
                                        <h4><?php echo $item->title; ?></h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $item->description; ?></p>
                                    </td>
                                    <td width="30%" class="amount">Rs.&nbsp;<?php echo $item->amount; ?>.00</td>
                                    <td width="30%" class="option">
                                        <!-- <form action="<?php echo URLROOT ?>/scholarship/managescholarship" method="get" class="assign-manage-form">
                                            <input type="text" id="name" name="scholarship_ID" hidden value="<?php echo $item->scholarshipID; ?>" />
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
                    <?php foreach($data['ongoing'] as $item) {?>
                    <a href="<?php echo URLROOT ?>/scholarship/viewscholarship?scholarship_ID=<?php echo $item->scholarshipID; ?>">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="30%" class="content">
                                        <h4><?php echo $item->title; ?></h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $item->description; ?></p>
                                    </td>
                                    <td width="30%" class="amount">Rs.&nbsp;<?php echo $item->amount; ?>.00</td>
                                    <td width="30%" class="option">
                                        <!-- <form action="<?php echo URLROOT ?>/scholarship/managescholarship" method="get" class="assign-manage-form">
                                            <input type="text" id="name" name="scholarship_ID" hidden value="<?php echo $item->scholarshipID; ?>" />
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
                        <div class="title">Posted Scholarships</div>
                        <div class="value">58,977</div>
                    </div>

                    
                    <div class="right-card">
                        <div class="title">Scholarship Applications</div>
                        <div class="value">58,977</div>
                    </div>

                    
                    <div class="right-card">
                        <div class="title">Confirmed Scholarships</div>
                        <div class="value">58,977</div>
                    </div>

                    
                    <div class="right-card">
                        <div class="title">Received Scholarships</div>
                        <div class="value">58,977</div>
                    </div>
                </div>
            </div> -->
            
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
