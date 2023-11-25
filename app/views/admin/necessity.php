<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "necessities";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <h3>Posted Nessicities</h3>
            <p>Last 30 days</p>
            <div class="list">
                <div class="list-title">
                    <p>Pending</p>
                </div>
                <div class="list-items">
                    <a class="item-link" href="">
                        <div class="list-item">
                            <div class="list-icon">
                                <!-- <img class="ico" src="<?php echo URLROOT ?>/img/bell-regular.svg" alt=""> -->
                            </div>
                            <div class="title-desc">
                                <div class="title"></div>
                                <div class="desc"></div>
                            </div>
                            <div class="crud-icons">

                            </div>
                        </div>
                    </a>
                </div>
              
            </div>
            <div class="right-content">
                <div class="right-cards">

                    <!-- Card 1 -->
                    <div class="right-card">
                        <div class="title">Monthly Donations</div>
                        <div class="value">Rs. 58,977.00</div>
                    </div>

                    <!-- Card 2 -->
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


                
