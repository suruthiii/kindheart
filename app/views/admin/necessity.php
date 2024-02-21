<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "necessities";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <h3>Necessities</h3>
            <p style="margin-left: 10px">Select a necessity type</p>
            <div class="user-types">

                <!-- Necessity 1 -->
                <a class="user-link" href="<?php echo URLROOT ?>/necessity/physicalGood">
                    <div class="user">
                        <div class="title">Physical Goods</div>
                    </div>
                </a>

                 <!-- Necessity 2 -->
                 <a class="user-link" href="<?php echo URLROOT ?>/necessity/viewAdminMonetary">
                    <div class="user">
                        <div class="title">Monetary</div>
                    </div>
                </a>

            </div>
            <div class="right-content">
                <div class="right-cards">

                    <!-- Card 1 -->
                    <div class="right-card">
                        <div class="title">Posted Necessities</div>
                        <div class="value">58,977</div>
                    </div>

                    <!-- Card 2 -->
                    <div class="right-card">
                        <div class="title">Fulfilled Necessities</div>
                        <div class="value">58,977</div>
                    </div>

                    <!-- Card 3 -->
                    <div class="right-card">
                        <div class="title">Monthly Donations</div>
                        <div class="value">Rs. 58,977.00</div>
                    </div>

                    <!-- Card 4 -->
                    <div class="right-card">
                        <div class="title">Total Donations</div>
                        <div class="value">Rs. 58,977.00</div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
