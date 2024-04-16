<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "complaints";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <h3 style="margin-top: 25px">User Complaints</h3>
            <p style="margin-left: 10px">View the list of complaints</p>
            <div class="list">
                <div class="list-title">
                    <h4>Unassigned</h4>
                </div>
                
                <div class="card-list">
                    <?php foreach($data['unassigned'] as $item) {?>
                    <a href="<?php echo URLROOT ?>/complaint/viewunassignedcomplaint/<?php echo $item->complaintID ?>">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4><?php echo $item->username ?></h4>
                                    </td>
                                    <td width="40%" class="option">
                                        <form action="<?php echo URLROOT ?>/complaint/assignme" method="post" class="assign-manage-form">
                                            <input type="text" name="complaint_ID" id="complaint_ID" hidden value="<?php echo $item->complaintID ?>" />
                                            <button type="submit" class="assign-manage" onclick="">
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
                    <a href="<?php echo URLROOT ?>/complaint/viewassignedcomplaint/<?php echo $item->complaintID ?>">
                        <div class="card">
                            <table>
                                <tr>
                                    <td width="10%"><img src="<?php echo URLROOT ?>/img/house.png" alt=""></td>
                                    <td width="50%" class="content">
                                        <h4><?php echo $item->username ?></h4>
                                    </td>
                                    <td width="40%" class="option">
                                        <form action="<?php echo URLROOT ?>/complaint/unassignadmin" method="post" class="assign-manage-form">
                                            <input type="text" name="complaint_ID" id="complaint_ID" hidden value="<?php echo $item->complaintID ?>" />
                                            <button type="submit" class="assign-manage" onclick="">
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
