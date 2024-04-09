<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "projects";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <h3>Projects</h3>
            <p style="margin-left: 10px">Last 30 days</p>
            <div class="list">
                <div class="list-title">
                    <h4>Pending</h4>
                </div>
                
                <div class="card-list">
                    <?php foreach($data['pending'] as $item) {?>
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4><?php echo $item->title; ?></h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $item->description; ?></p>
                                    </td>
                                    <td width="30%" class="amount">Rs.&nbsp;<?php echo $item->amount; ?>.00</td>
                                    <td width="10%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
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
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4><?php echo $item->title; ?></h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $item->description; ?></p>
                                    </td>
                                    <td width="30%" class="amount">Rs.&nbsp;<?php echo $item->amount; ?>.00</td>
                                    <td width="10%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
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
                    <h4>Ongoing</h4>
                </div>
                
                <div class="card-list">
                    <?php foreach($data['ongoing'] as $item) {?>
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4><?php echo $item->title; ?></h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $item->description; ?></p>
                                    </td>
                                    <td width="30%" class="amount">Rs.&nbsp;<?php echo $item->amount; ?>.00</td>
                                    <td width="10%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
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
                        <div class="title">Posted Projects</div>
                        <div class="value">58,977</div>
                    </div>

                    <!-- Card 2 -->
                    <div class="right-card">
                        <div class="title">Completed Projects</div>
                        <div class="value">58,977</div>
                    </div>

                    <!-- Card 3 -->
                    <div class="right-card">
                        <div class="title">Monthly Funds</div>
                        <div class="value">Rs. 58,977.00</div>
                    </div>

                    <!-- Card 4 -->
                    <div class="right-card">
                        <div class="title">Total Funds</div>
                        <div class="value">Rs. 58,977.00</div>
                    </div>
                </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
