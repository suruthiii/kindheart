<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "successStories";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
        
            <h3>Success Stories</h3>
            <p style="margin-left: 10px">View the success stories of students who benefited from donations</p>

            <div class="story-cards">
                
                <?php foreach ($data['successstories'] as $item) { ?>
                    <div class="story-card">
                        <div class="profile">
                            <div class="profile-img">
                                <img class="pro-pic" src="<?php echo URLROOT?>/img/logo.jpg" alt="">
                            </div>
                            <div class="profile-content">
                                <h4 class="name"><?php echo $item->username; ?></h4>
                                <p class="date"><?php echo $item->addDate; ?></p>
                            </div>
                        </div>

                        <div class="successstory-title" style="transform: translate(30px, -50px)">
                                <h3><?php echo $item->title; ?></h3>
                        </div>

                        <!-- Added image show box -->
                        <?php if ($item->image !== null) { ?>
                            <div class="story-img-container">
                                <img class="story-img" src="<?php echo URLROOT ?>/uploads/<?php echo $item->image; ?>" alt="<?php echo $item->storyTitle; ?>">
                            </div>
                        <?php } ?>
                        <div class="story-desc">
                            <?php echo $item->description; ?>
                            <a class="more-desc-link" href="">Read more</a>
                        </div>

                    </div> 
                <?php }?>       
            </div>

            <!-- <div class="right-content">
                <div class="right-cards">

                    
                    <div class="right-card">
                        <div class="title">Posted Success Stories</div>
                        <div class="value">58,977</div>
                    </div>

                    
                    <div class="right-card">
                        <div class="title">Success Stories Per Year</div>
                        <div class="value">58,977</div>
                    </div>

                    
                    <div class="right-card">
                        <div class="title">Success Stories Per Month</div>
                        <div class="value">58,977</div>
                    </div>

                    
                    <div class="right-card">
                        <div class="title">Success Stories Per Day</div>
                        <div class="value">58,977</div>
                    </div>
                </div>
            </div> -->
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
