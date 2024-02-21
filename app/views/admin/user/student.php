<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "users";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/admin/user">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">Students</h3>
            <p style="margin-left: 10px">View the list of students</p>

            <div class="tile-list">
                <div class="tiles">

                    <!-- Card 1 -->
                    <a href="">
                        <div class="tile">
                            <table>
                                <tr>
                                    <td width="50%" class="tile-name">Student 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="del" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" style="transform:translateY(2px)" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="ban-form">
                                            <input type="text" name="name" id="ban" hidden value="" />
                                            <button type="submit" class="ban" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/ban-solid.svg" alt="" style='width: 100%'>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>

                    <!-- Card 2 -->
                    <a href="">
                        <div class="tile">
                            <table>
                                <tr>
                                    <td width="50%" class="tile-name">Student 2</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="del" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" style="transform:translateY(2px)" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="ban-form">
                                            <input type="text" name="name" id="ban" hidden value="" />
                                            <button type="submit" class="ban" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/ban-solid.svg" alt="" style='width: 100%'>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>

                     <!-- Card 3 -->
                     <a href="">
                        <div class="tile">
                            <table>
                                <tr>
                                    <td width="50%" class="tile-name">Student 3</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="del" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" style="transform:translateY(2px)" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="ban-form">
                                            <input type="text" name="name" id="ban" hidden value="" />
                                            <button type="submit" class="ban" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/ban-solid.svg" alt="" style='width: 100%'>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
