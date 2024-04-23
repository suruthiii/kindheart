<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "projects";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/superadmin/project">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">Manage Project</h3>
            <p style="margin-left: 10px">Add comments to project</p>
            
            <div class="necessity-info">
                <table>
                        <tr class="necessity-data">
                            <th width="30%">Project Title</th>
                            <td width="70%"><?php echo $data['project_details']->title ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Organization Name</th>
                            <td width="70%"><?php echo $data['project_details']->orgName ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Budget</th>
                            <td width="70%"><?php echo $data['project_details']->budget ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Received Amount</th>
                            <td width="70%"><?php echo $data['project_details']->receivedAmount ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Description</th>
                            <td width="70%"><?php echo $data['project_details']->description ?></td>
                        </tr>
                </table>
            </div>

            <div class="comment-form">
                <form action = "<?php echo URLROOT; ?>/project/manageproject" method = "post">
                    <label for="comment">Comment</label><br><br>
                    <?php if(!empty($data['err'])){?>
                        <p><?php echo $data['err']?></p>
                    <?php }?>
                    <textarea class="comment-textarea" required name="comment" ></textarea>
                    <input type="text" name="project_ID" hidden value="<?php echo $data['project_ID'] ?>">
                    <input type="submit" value="Add">
                </form>
            </div>

            <div class="view-donation-btn-container">
                <form action="<?php echo URLROOT ?>/project/deleteproject" method="post" class="delete-form">
                    <input type="text" name="project_ID" hidden value=<?php echo $data['project_ID'] ?>>
                    <button type="submit" class="view-donation-btn" onclick="return confirmSubmit();">
                        Delete Project
                    </button>
                </form>
            </div>

            <div class="right-content" style="overflow-y:scroll;">
                <div class="right-content-title-container">
                    <h4 style="text-align:center">Comments</h4>
                </div>
                <div class="right-cards">  

                    <?php foreach($data['comments'] as $item) {?>
                        <div class="right-card">
                            <div class="title"><?php echo $item->adminName ?></div>
                            <div class="value"><?php echo $item->comment ?></div>
                        </div>
                    <?php }?>

                </div>
            </div>

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
