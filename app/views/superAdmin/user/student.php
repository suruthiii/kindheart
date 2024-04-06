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
                <a href="<?php echo URLROOT ?>/superadmin/user">
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

                    <?php foreach($data['students'] as $item) {?>
                    <a href="<?php echo URLROOT ?>/user/viewStudent/<?php echo $item->studentID; ?>">
                        <div class="tile">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" class="user-image" alt=""></td>
                                    <td width="40%" class="tile-name"><?php echo $item->name; ?></td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>/user/deleteUser" method="post" class="delete-form">
                                            <input type="text" name="user_ID" id="user_ID" hidden value="<?php echo $item->studentID; ?>" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" style="transform:translateY(2px)" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>/user/banUser" method="post" class="ban-form">
                                            <input type="text" name="user_ID" id="user_ID" hidden value="<?php echo $item->studentID; ?>" />
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
            
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
