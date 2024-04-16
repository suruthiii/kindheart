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
                <a href="<?php echo URLROOT ?>/superadmin/scholarship">
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
            
            <div class="comment-form">
                <form action = "">
                    <label for="comment">Comment</label><br><br>
                    <textarea class="comment-textarea" name="comment"></textarea>

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

                    <div class="right-card">
                        <div class="title">Admin</div>
                        <div class="value">Comment</div>
                    </div>
    
                </div>
            </div>

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
