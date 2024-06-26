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

                    <?php foreach($data['admins'] as $item){?>
                        <a href="<?php echo URLROOT ?>/superadmin/viewAdmin/<?php echo $item->adminID?>">
                            <div class="tile">
                                <table>
                                    <tr>
                                        <td width="50%" class="tile-name"><?php echo $item->adminName;?></td>
                                        <td width="50%" class="option">
                                            <form action="<?php echo URLROOT ?>/superadmin/editAdmin" method="GET" class="edit-form">
                                                <input type="text" name="admin_ID" id="admin_ID" hidden value="<?php echo $item->adminID?>" />
                                                <button type="submit" class="edit" onclick="return confirmSubmit();">
                                                    <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg" alt="">
                                                </button>
                                            </form>
                                            <form action="<?php echo URLROOT ?>/superadmin/deleteAdmin" method="post" class="delete-form">
                                                <input type="text" name="admin_ID" id="deladmin_ID" hidden value="<?php echo $item->adminID?>" />
                                                <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                    <img src="<?php echo URLROOT ?>/img/trash-solid.svg" style="transform:translateY(2px)" alt="">
                                                </button>
                                            </form>
                                            <form action="<?php echo URLROOT ?>/superadmin/banAdmin" method="post" class="ban-form">
                                                <input type="text" name="admin_ID" id="admin_ID" hidden value="<?php echo $item->adminID?>" />
                                                <button type="submit" class="ban" onclick="return confirmSubmit();">
                                                    <img src="<?php echo URLROOT ?>/img/ban-solid.svg" alt="" style='width: 100%'>
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
            
            <!-- <div class="add-report-btn-container">
                <button class="add-report-btn">
                    <span class="plus">+</span> 
                    &nbsp;Add Reports
                </button>
            </div> -->

            <div class="right-content">
                
                <h3 style="margin-top: 30px; text-align:center; margin-left: 0;">Admin Registration</h3>

                <?php if (sizeof($other_data) > 2){?>
                    <div class="error-msg">
                        <span class="form-invalid"><?php echo $other_data["err"] ?></span>
                    </div>

                    <form class="add-form" method="POST" action="<?php echo URLROOT ?>/superadmin/createAdmin">
                        <label for="name">Name</label><br>
                        <input type="text" id="name" name="name" required value="<?php print_r($other_data['name']);?>"><br><br>

                        <label for="username">Username</label><br>
                        <input type="text" id="username" name="username" required value="<?php print_r($other_data['username']);?>"><br><br>

                        <label for="email">Email</label><br>
                        <input type="email" id="email" name="email" required value="<?php print_r($other_data['email']);?>"><br><br>

                        <label for="password">Password</label><br>
                        <input type="password" id="password" name="password" required><br><br>

                        <label for="confirmPassword">Confirm Password</label><br>
                        <input type="password" id="confirmPassword" name="confirmPassword" required><br><br>

                        <input type="submit" value="Submit">
                    </form>
                <?php } else { ?>
                    <form class="add-form" method="POST" action="<?php echo URLROOT ?>/superadmin/createAdmin">
                        <label for="name">Name</label><br>
                        <input type="text" id="name" name="name" required><br><br>

                        <label for="username">Username</label><br>
                        <input type="text" id="username" name="username" required><br><br>

                        <label for="email">Email</label><br>
                        <input type="email" id="email" name="email" required><br><br>

                        <label for="password">Password</label><br>
                        <input type="password" id="password" name="password" required><br><br>

                        <label for="confirmPassword">Confirm Password</label><br>
                        <input type="password" id="confirmPassword" name="confirmPassword" required><br><br>

                        <input type="submit" value="Submit">
                    </form>
                <?php }?>
            </div>
        </div>
    </section>
</main>

<script>
    history.pushState(null, null, '/kindheart/superadmin/admin');
</script>

<?php require APPROOT.'/views/inc/footer.php'; ?>
