<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "requests";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
                <div class="back-arrow-btn">
                    <a href="<?php echo URLROOT ?>/admin/request">
                        <table>
                            <tr>
                                <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                                <td width="70%">Go Back</td>
                            </tr>
                        </table>
                    </a>
                </div>

            <h3 style="margin-top: 25px">Organization Requests</h3>
            <p style="margin-left: 10px">View the list of organization requests</p>
            <div class="list">
                <div class="list-title">
                    <h4>Unassigned</h4>
                </div>
                
                <div class="card-list">
                    <?php foreach($data['unassigned'] as $item) {?>
                    <a href="<?php echo URLROOT ?>/request/vieworganizationrequest/<?php echo $item->userID ?>">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4><?php echo $item->username ?></h4>
                                    </td>
                                    <td width="40%" class="option">
                                        <form action="<?php echo URLROOT ?>/request/assignme" method="post" class="assign-manage-form">
                                            <input type="text" name="user_ID" id="user_ID" hidden value="<?php echo $item->userID; ?>" />
                                            <button type="submit" class="assign-manage" onclick="return confirmSubmit();">
                                                Assign
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
                    <h4>Assigned To Me</h4>
                </div>
                
                <div class="card-list">

                    <?php foreach($data['assigned'] as $item) {?>
                    <a href="<?php echo URLROOT ?>/request/vieworganizationrequest/<?php echo $item->userID ?>">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4><?php echo $item->username ?></h4>
                                    </td>
                                    <td width="40%" class="option">
                                        <form action="<?php echo URLROOT ?>/request/unassignadmin" method="post" class="assign-manage-form">
                                            <input type="text" name="user_ID" id="user_ID" hidden value="<?php echo $item->userID; ?>" />
                                            <button type="submit" class="assign-manage" onclick="return confirmSubmit();">
                                                Unassign
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
