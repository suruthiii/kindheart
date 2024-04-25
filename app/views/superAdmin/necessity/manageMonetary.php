<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "necessities";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/necessity/monetary">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">Manage Necessity</h3>
            <p style="margin-left: 10px">Add comments to necessity</p>
            
            <div class="necessity-info">
                <table>
                    <?php foreach($data['necessity_details'] as $key => $value){
                        if ($key == 'doneeID'){continue;}
                        else if($key == 'Start Date'){
                            $value = date('Y-m-d', strtotime($value));
                        }?>
                        
                        <tr class="necessity-data">
                            <th width="30%"><?php echo $key?></th>
                            <td width="70%"><?php echo $value?></td>
                        </tr>
                    <?php }?>
                </table>
            </div>

            <div class="comment-form">
                <form action = "<?php echo URLROOT; ?>/necessity/managemonetary" method = "post">
                    <label for="comment">Comment</label><br><br>
                    <?php if(!empty($data['err'])){?>
                        <p><?php echo $data['err']?></p>
                    <?php }?>
                    <textarea class="comment-textarea" required name="comment" ></textarea>
                    <input type="text" name="necessity_ID" hidden value="<?php echo $data['necessity_ID'] ?>">
                    <input type="submit" value="Add">
                </form>
            </div>

            <div class="view-donation-btn-container">
                <form action="<?php echo URLROOT ?>/necessity/deletenecessities" method="post" class="delete-form">
                    <input type="text" name="necessity_ID" hidden value=<?php echo $data['necessity_ID'] ?>>
                    <button type="submit" class="view-donation-btn" onclick="return confirmSubmit();">
                        Delete Necessity
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

<script>
    history.pushState(null, null, '/kindheart/necessity/managemonetary?necessity_ID=<?php echo $data['necessity_ID']?>');
</script>

<?php require APPROOT.'/views/inc/footer.php'; ?>
