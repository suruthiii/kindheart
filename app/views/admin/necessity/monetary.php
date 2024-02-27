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
            <p style="margin-left: 10px">Last 30 days</p>
            <div class="list">
                <div class="list-title">
                    <h4>Pending</h4>
                </div>
                
                <div class="card-list">
                    <a href="<?php echo URLROOT ?>/necessity/viewadminmonetary">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Stationary</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">80 Page CR Book</p>
                                    </td>
                                    <td width="30%" class="amount">Rs. 34,000.00</td>
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

                    <a href="<?php echo URLROOT ?>/necessity/viewadminmonetary">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Stationary</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">80 Page CR Book</p>
                                    </td>
                                    <td width="30%" class="amount">Rs. 34,000.00</td>
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
                    
                    <a href="<?php echo URLROOT ?>/necessity/viewadminmonetary">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Stationary</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">80 Page CR Book</p>
                                    </td>
                                    <td width="30%" class="amount">Rs. 34,000.00</td>
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

                    <a href="<?php echo URLROOT ?>/necessity/viewadminmonetary">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Stationary</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">80 Page CR Book</p>
                                    </td>
                                    <td width="30%" class="amount">Rs. 34,000.00</td>
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

                    <a href="<?php echo URLROOT ?>/necessity/viewadminmonetary">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Stationary</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">80 Page CR Book</p>
                                    </td>
                                    <td width="30%" class="amount">Rs. 34,000.00</td>
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

                    <a href="<?php echo URLROOT ?>/necessity/viewadminmonetary">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Stationary</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">80 Page CR Book</p>
                                    </td>
                                    <td width="30%" class="amount">Rs. 34,000.00</td>
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
                    
                </div>
            </div>

            <div class="list">
                <div class="list-title">
                    <h4>Completed</h4>
                </div>
                
                <div class="card-list">
                <a href="<?php echo URLROOT ?>/necessity/viewadminmonetary">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Stationary</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">80 Page CR Book</p>
                                    </td>
                                    <td width="30%" class="amount">Rs. 34,000.00</td>
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

                    <a href="<?php echo URLROOT ?>/necessity/viewadminmonetary">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Stationary</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">80 Page CR Book</p>
                                    </td>
                                    <td width="30%" class="amount">Rs. 34,000.00</td>
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
                    
                    <a href="<?php echo URLROOT ?>/necessity/viewadminmonetary">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Stationary</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">80 Page CR Book</p>
                                    </td>
                                    <td width="30%" class="amount">Rs. 34,000.00</td>
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

                    <a href="<?php echo URLROOT ?>/necessity/viewadminmonetary">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Stationary</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">80 Page CR Book</p>
                                    </td>
                                    <td width="30%" class="amount">Rs. 34,000.00</td>
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

                    <a href="<?php echo URLROOT ?>/necessity/viewadminmonetary">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Stationary</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">80 Page CR Book</p>
                                    </td>
                                    <td width="30%" class="amount">Rs. 34,000.00</td>
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

                    <a href="<?php echo URLROOT ?>/necessity/viewadminmonetary">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Stationary</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">80 Page CR Book</p>
                                    </td>
                                    <td width="30%" class="amount">Rs. 34,000.00</td>
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

                    <a href="<?php echo URLROOT ?>/necessity/viewadminmonetary">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Stationary</h4>
                                        <p>80 Page CR Book</p>
                                    </td>
                                    <td width="30%" class="amount">Rs. 34,567.00</td>
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
                </div>
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

<script>
    function confirmSubmit() {
        return confirm("Are you sure you want to delete this?");
    }
</script>

<?php require APPROOT.'/views/inc/footer.php'; ?>


                
