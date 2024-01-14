<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "admins";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <h3>Admins</h3>
            <p style="margin-left: 10px">View the list of admins</p>
            
            <div class="tile-list">
                <div class="tiles">

                    <!-- Card 1 -->
                    <a href="">
                        <div class="tile">
                            <table>
                                <tr>
                                    <td width="50%" class="tile-name">Admin 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="edit-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="edit" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" style="transform:translateY(2px)" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="ban-form">
                                            <input type="text" name="name" id="name" hidden value="" />
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
            
            <!-- <div class="add-report-btn-container">
                <button class="add-report-btn">
                    <span class="plus">+</span> 
                    &nbsp;Add Reports
                </button>
            </div> -->

            <div class="right-content">
                
                <h3 style="margin-top: 30px; text-align:center; margin-left: 0;">Admin Registration</h3>
                
                <form class="add-form">
                    <label for="name">Name</label><br>
                    <input type="text" id="name" name="name"><br><br>

                    <label for="username">Username</label><br>
                    <input type="text" id="username" name="username"><br><br>

                    <label for="email">Email</label><br>
                    <input type="text" id="email" name="email"><br><br>

                    <label for="pass">Password</label><br>
                    <input type="password" id="pass" name="pass"><br><br>

                    <label for="con-pass">Confirm Password</label><br>
                    <input type="password" id="con-pass" name="con-pass"><br><br>

                    <input type="submit" value="Submit">
                </form>

                
                
            </div>
            
        </div>
    </section>
</main>



<?php require APPROOT.'/views/inc/footer.php'; ?>