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
                        <div class="story-card">
                            <div class="profile">
                                <div class="profile-img">
                                    <img class="pro-pic" src="<?php echo URLROOT?>/img/logo.jpg" alt="">
                                </div>
                                <div class="profile-content">
                                    <h4 class="name">Suruthi</h4>
                                    <p class="date">5 days ago</p>
                                </div>
                            </div>
                            <div class="story-img-container">
                                <img class="story-img" src="<?php echo URLROOT?>/img/logo.jpg" alt="">
                            </div>
                            <div class="story-desc">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatum dolore error distinctio omnis sed officiis, qui, vitae voluptates ea exercitationem eligendi incidunt? Accusantium repellat vel, quis quibusdam sapiente sit eum? 
                                <a class="more-desc-link" href="">Read more</a>
                            </div>
                            <div class="story-btn-container">
                                <button class="del-btn">Delete</button>
                            </div>
                        </div>    

                        <!-- <div class="story-card">
                            <div class="profile">
                                <div class="profile-img">
                                    <img class="pro-pic" src="<?php echo URLROOT?>/img/logo.jpg" alt="">
                                </div>
                                <div class="profile-content">
                                    <h4 class="name">Suruthi</h4>
                                    <p class="date">5 days ago</p>
                                </div>
                            </div>
                            <div class="story-img-container">
                                <img class="story-img" src="<?php echo URLROOT?>/img/logo.jpg" alt="">
                            </div>
                            <div class="story-desc">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatum dolore error distinctio omnis sed officiis, qui, vitae voluptates ea exercitationem eligendi incidunt? Accusantium repellat vel, quis quibusdam sapiente sit eum? 
                                <a class="more-desc-link" href="">Read more</a>
                            </div>
                            <div class="story-btn-container">
                                <button class="del-btn">Delete</button>
                            </div>
                        </div>  -->
                        
                        <!-- <div class="story-card">
                            <div class="profile">
                                <div class="profile-img">
                                    <img class="pro-pic" src="<?php echo URLROOT?>/img/logo.jpg" alt="">
                                </div>
                                <div class="profile-content">
                                    <h4 class="name">Suruthi</h4>
                                    <p class="date">5 days ago</p>
                                </div>
                            </div>
                            <div class="story-img-container">
                                <img class="story-img" src="<?php echo URLROOT?>/img/logo.jpg" alt="">
                            </div>
                            <div class="story-desc">
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptatum dolore error distinctio omnis sed officiis, qui, vitae voluptates ea exercitationem eligendi incidunt? Accusantium repellat vel, quis quibusdam sapiente sit eum? 
                                <a class="more-desc-link" href="">Read more</a>
                            </div>
                            <div class="story-btn-container">
                                <button class="del-btn">Delete</button>
                            </div>
                        </div>     -->
            </div>

            <div class="right-content">
                <div class="right-cards">

                    <!-- Card 1 -->
                    <div class="right-card">
                        <div class="title">Posted Success Stories</div>
                        <div class="value">58,977</div>
                    </div>

                    <!-- Card 2 -->
                    <div class="right-card">
                        <div class="title">Success Stories Per Year</div>
                        <div class="value">58,977</div>
                    </div>

                    <!-- Card 3 -->
                    <div class="right-card">
                        <div class="title">Success Stories Per Month</div>
                        <div class="value">58,977</div>
                    </div>

                    <!-- Card 4 -->
                    <div class="right-card">
                        <div class="title">Success Stories Per Day</div>
                        <div class="value">58,977</div>
                    </div>
                </div>
        </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
