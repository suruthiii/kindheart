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
            <p style="margin-left: 10px">Last 30 days</p>
            <div class="list">
                <div class="list-title">
                    <h4>Available</h4>
                </div>
                
                <div class="card-list">

                    <!-- Card 1 -->
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Mahapola</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Sample Description</p>
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

                    <!-- Card 2 -->
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Mahapola</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Sample Description</p>
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

                    <!-- Card 3 -->
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Mahapola</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Sample Description</p>
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

                    <!-- Card 4 -->
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Mahapola</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Sample Description</p>
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

                    <!-- Card 5 -->
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Mahapola</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Sample Description</p>
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

                    <!-- Card 6 -->
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Mahapola</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Sample Description</p>
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

                    <!-- Card 7 -->
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Mahapola</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Sample Description</p>
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

                    <!-- Card 8 -->
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Mahapola</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Sample Description</p>
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
                    <h4>Received</h4>
                </div>
                
                <div class="card-list">

                    <!-- Card 1 -->
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Mahapola</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Sample Description</p>
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

                    <!-- Card 2 -->
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Mahapola</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Sample Description</p>
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

                    <!-- Card 3 -->
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Mahapola</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Sample Description</p>
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

                    <!-- Card 4 -->
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Mahapola</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Sample Description</p>
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

                    <!-- Card 5 -->
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Mahapola</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Sample Description</p>
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

                    <!-- Card 6 -->
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Mahapola</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Sample Description</p>
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

                    <!-- Card 7 -->
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Mahapola</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Sample Description</p>
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

                    <!-- Card 8 -->
                    <a href="">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4>Mahapola</h4>
                                        <p style="width: 110px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">Sample Description</p>
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

            <div class="right-content">
                <div class="right-cards">

                    <!-- Card 1 -->
                    <div class="right-card">
                        <div class="title">Posted Scholarships</div>
                        <div class="value">58,977</div>
                    </div>

                    <!-- Card 2 -->
                    <div class="right-card">
                        <div class="title">Scholarship Applications</div>
                        <div class="value">58,977</div>
                    </div>

                    <!-- Card 3 -->
                    <div class="right-card">
                        <div class="title">Confirmed Scholarships</div>
                        <div class="value">58,977</div>
                    </div>

                    <!-- Card 4 -->
                    <div class="right-card">
                        <div class="title">Received Scholarships</div>
                        <div class="value">58,977</div>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
