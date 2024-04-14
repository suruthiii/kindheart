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
                    <tr class="necessity-data">
                        <th width="30%">Donee Name</th>
                        <td width="70%">Sarah Dawson</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Necessity Name</th>
                        <td width="70%">Stationary</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Description</th>
                        <td width="70%">80 Page CR Book</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Amount</th>
                        <td width="70%">Rs. 34,000.00</td>
                    </tr>
                    <tr class="necessity-data">
                        <th width="30%">Date</th>
                        <td width="70%">11/12/2023</td>
                    </tr>
                </table>
            </div>

            <div class="comment-form">
                <form action = "<?php echo URLROOT; ?>/necessity/addcomment" method = "post">
                    <label for="comment">Comment</label><br><br>
                    <textarea class="comment-textarea" name="comment" required></textarea>

                    <!-- <input type="submit" name="necessity_ID" value="Add" hidden value="<?php echo $item->necessityID ?>"> -->
                </form>
            </div>

            <div class="view-donation-btn-container">
                <a href="<?php echo URLROOT ?>" class="view-donation-btn">
                    <!-- <button type="submit" class="view-donation-btn" > -->
                        Delete Necessity
                    <!-- </button> -->
                </a>
            </div>

            <div class="right-content" style="overflow-y:scroll;">
                <div class="right-content-title-container">
                    <h4 style="text-align:center">Comments</h4>
                </div>
                <div class="right-cards">  

                    <!-- <?php foreach($data['comments'] as $item) {?> -->
                    <div class="right-card">
                        <div class="title">Admin
                            <!-- <?php echo $item->adminName ?> -->
                        </div>
                        <div class="value">Comment
                            <!-- <?php echo $item->comment ?> -->
                        </div>
                    </div>
                    <!-- <?php }?> -->
                </div>
            </div>

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>