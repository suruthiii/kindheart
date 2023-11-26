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
                    <h4>Pending</h4>
                </div>
                <!-- <div class="list-items">
                    <a class="item-link" href="">
                        <table>
                            <tr>
                                <td class="item-icon" >
                                    <img class="icon" src="<?php echo URLROOT ?>/img/back-arrow.png" alt="">
                                </td>
                                <td class="title-desc">
                                    Hii<br/>Hiii
                                </td>
                                <td class="amount-quantity" >
                                    <p>Rs. 24,565</p>
                                </td>
                                <td class="del-icon" >
                                    <img class="icon" src="<?php echo URLROOT ?>/img/back-arrow.png" alt="">
                                </td>
                            </tr>
                        </table>
                    </a>
                </div> -->
              
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


                
