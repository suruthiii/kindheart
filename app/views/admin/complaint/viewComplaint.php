<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "complaints";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/admin/complaint">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Complaint</h3>
            <p style="margin-left: 10px">View the complaints of users</p>
            
            <div class="necessity-info">
                <table>
                    <tr class="necessity-data">
                        <th width="30%">Complainer Name</th>
                        <td width="70%"><a href="<?php echo URLROOT?>/complaint/viewcomplainerprofile?complainer_ID=<?php echo $data['complainer_ID'] ?>"><?php echo $data['complainer_name']; ?></a></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Complainee Name</th>
                        <td width="70%"><a href="<?php echo URLROOT?>/complaint/viewcomplaineeprofile?complainee_ID=<?php echo $data['complainee_ID'] ?>"><?php echo $data['complainee_name']; ?></a></td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Description</th>
                        <td width="70%"><?php echo $data['complaint_description']; ?></td>
                    </tr>
                </table>
            </div>

            <div class="view-donation-btn-container">

                <?php if ($data['complaint_adminID'] == 0)  {?>
                    <form action="<?php echo URLROOT ?>/complaint/assignme" method="post" class="delete-form">
                        <input type="text" name="complaint_ID" id="complaint_ID" hidden value="<?php echo $data['complaint_ID']; ?>" />
                        <button type="submit" class="view-donation-btn" onclick="">
                            Assign
                        </button>
                    </form>

                <?php } 

                else if ($data['complaint_adminID'] == $_SESSION['user_id']) {?>
                    <form action="<?php echo URLROOT ?>/complaint/unassignadmin" method="post" class="delete-form">
                        <input type="text" name="complaint_ID" id="complaint_ID" hidden value="<?php echo $data['complaint_ID']; ?>" />
                        <button type="submit" class="view-donation-btn" onclick="">
                            Unassign
                        </button>
                    </form>
                <?php }?>
            </div>

            <div class="view-donation-btn-container">
                
            </div>

            <div class="right-content" style="overflow-y:scroll;">
                <div class="right-content-title-container">
                    <h4 style="text-align:center">Past Complaints</h4>
                </div>
                <div class="right-cards">  

                    <?php foreach($data['past_complaints'] as $item) {?>
                    <div class="right-card">
                        <div class="title"><?php echo $item->complainerName ?></div>
                        <div class="value"><?php echo $item->description ?></div>
                    </div>
                    <?php }?>
                    
                </div>
            </div>

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
