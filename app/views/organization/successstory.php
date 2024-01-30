<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "successStories";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

            <!-- Middle container -->
            <div class="middle-container"></div>

            <!-- right side bar for success story -->
            <div class="rightside-bar-type-one">
                <div class="right-side-bar">
                    <!-- title for rightside bar -->
                    <div class="rightside-bar-title">
                        <h3>Add success Stories</h3>
                    </div>
                    <!-- add image box -->
                    <div class="add-photo-box">
                        <form action="">
                            <input type="image" value="+ Add Photo">
                        </form>         
                    </div>
                    <!-- add description box -->
                    <div class="add-description-box">
                        <form action="">
                            <textarea placeholder="Add description..."></textarea>
                        </form>         
                    </div>

                    <div class="post-story-button">
                        <form action="">
                            <input type="submit" value="Post">
                        </form>         
                    </div>

                    <div class="last-title">
                        <h3>Your success stories</h3>
                    </div>

                </div>
            </div> 

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
