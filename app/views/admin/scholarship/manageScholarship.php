<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "scholarships";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/admin/scholarship">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">Manage Scholarship</h3>
            <p style="margin-left: 10px">Add comments to scholarship</p>
            
            <div class="necessity-info">
                <table>
                        <tr class="necessity-data">
                            <th width="30%">Scholarship Title</th>
                            <td width="70%"><?php echo $data['scholarship_details']->title ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Donor Name</th>
                            <td width="70%"><?php echo $data['scholarship_details']->name ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Amount</th>
                            <td width="70%"><?php echo $data['scholarship_details']->amount ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Start Date</th>
                            <td width="70%"><?php echo $data['scholarship_details']->startDate ?></td>
                        </tr>
                        <tr class="necessity-data">
                            <th width="30%">Description</th>
                            <td width="70%"><?php echo $data['scholarship_details']->description ?></td>
                        </tr>
                </table>
            </div>

            <div class="comment-form">
                <form action = "<?php echo URLROOT; ?>/scholarship/managescholarship" method = "post">
                    <label for="comment">Comment</label><br><br>
                    <?php if(!empty($data['err'])){?>
                        <p><?php echo $data['err']?></p>
                    <?php }?>
                    <textarea class="comment-textarea" required name="comment" ></textarea>
                    <input type="text" name="scholarship_ID" hidden value="<?php echo $data['scholarship_ID'] ?>">
                    <input type="submit" value="Add">
                </form>
            </div>

            <div class="view-donation-btn-container">
                <a href="<?php echo URLROOT ?>" class="view-donation-btn">
                    <!-- <button type="submit" class="view-donation-btn" > -->
                        Delete Scholarship
                    <!-- </button> -->
                </a>
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
