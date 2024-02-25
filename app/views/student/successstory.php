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
            <div class="middle-container">
                <!-- middle container titles -->
                <div class="middle-container-titles">
                    <h3>Success Stories</h3>
                    <p>View success stories of students who benefited from your donations</p>
                </div>
                
                <div class="succes-story-scrol-card-container">
                    <!-- added story cards -->
                    <div class="success-story-card">
                        <!-- logo name and story added date -->
                        <div class="logo-name-date">
                            <div class="logo-for-success">
                                <img src="<?php echo URLROOT ?>/img/logo.jpg" alt="">
                            </div>
                            <div class="name-date">
                                <h4>[Donee Name]</h4>
                                <p>[add date]</p>
                            </div>
                        </div>

                        <!-- Added image show box -->
                        <div class="added-image-box"></div>

                        <!-- added story description -->
                        <div class="added-story-description">
                            <p>Lorem ipsum dolor sit amet, 
                                consectetur adipiscing elit. 
                                In iaculis aliquam ultrices. 
                                Integer fermentum eros quis 
                                fermentum auctor. Pellentesque 
                                quis metus metus. Curabitur 
                                dignissim sodales lacinia.</p>
                        </div>
                    </div>
                    
                    <!-- example story cards -->
                    <div class="success-story-card">
                        <!-- logo name and story added date -->
                        <div class="logo-name-date">
                            <div class="logo-for-success">
                                <img src="<?php echo URLROOT ?>/img/logo.jpg" alt="">
                            </div>
                            <div class="name-date">
                                <h4>[Donee Name]</h4>
                                <p>[add date]</p>
                            </div>
                        </div>

                        <!-- Added image show box -->
                        <div class="added-image-box"></div>

                        <!-- added story description -->
                        <div class="added-story-description">
                            <p>Lorem ipsum dolor sit amet, 
                                consectetur adipiscing elit. 
                                In iaculis aliquam ultrices. 
                                Integer fermentum eros quis 
                                fermentum auctor. Pellentesque 
                                quis metus metus. Curabitur 
                                dignissim sodales lacinia.</p>
                        </div>
                    </div>

                    <div class="success-story-card">
                        <!-- logo name and story added date -->
                        <div class="logo-name-date">
                            <div class="logo-for-success">
                                <img src="<?php echo URLROOT ?>/img/logo.jpg" alt="">
                            </div>
                            <div class="name-date">
                                <h4>[Donee Name]</h4>
                                <p>[add date]</p>
                            </div>
                        </div>

                        <!-- Added image show box -->
                        <div class="added-image-box"></div>

                        <!-- added story description -->
                        <div class="added-story-description">
                            <p>Lorem ipsum dolor sit amet, 
                                consectetur adipiscing elit. 
                                In iaculis aliquam ultrices. 
                                Integer fermentum eros quis 
                                fermentum auctor. Pellentesque 
                                quis metus metus. Curabitur 
                                dignissim sodales lacinia.</p>
                        </div>
                    </div>

                    <div class="success-story-card">
                        <!-- logo name and story added date -->
                        <div class="logo-name-date">
                            <div class="logo-for-success">
                                <img src="<?php echo URLROOT ?>/img/logo.jpg" alt="">
                            </div>
                            <div class="name-date">
                                <h4>[Donee Name]</h4>
                                <p>[add date]</p>
                            </div>
                        </div>

                        <!-- Added image show box -->
                        <div class="added-image-box"></div>

                        <!-- added story description -->
                        <div class="added-story-description">
                            <p>Lorem ipsum dolor sit amet, 
                                consectetur adipiscing elit. 
                                In iaculis aliquam ultrices. 
                                Integer fermentum eros quis 
                                fermentum auctor. Pellentesque 
                                quis metus metus. Curabitur 
                                dignissim sodales lacinia.</p>
                        </div>
                    </div>

                </div>

            </div>

            <!-- right side bar for success story -->
            <div class="rightside-bar-type-one">
                <div class="right-side-bar">
                    <!-- title for rightside bar -->
                    <div class="rightside-bar-title">
                        <h3>Add success Stories</h3>
                    </div>
                    <!-- add image box -->
                    <form class="add-form" method="POST" enctype="multipart/form-data" action="<?php echo URLROOT ?>/student/addSuccessStory">
                    <div >

                        
                    <label for ="image-browser" class="add-photo-box">
                            <input onchange="display_image_name(this.files[0].name)" id="image-browser" type="file" name ="image"  style="display:none;">
                            + Add Photo</input>
                    </label> 
                
                    <small class="file_info text-muted"> </small>
                    <br>
                             
                    </div> 
                    <!-- add description box -->

                    <div class="add-title-box">
                        
                        <input type=text placeholder="Add title..." id="title" name="title" ></text>

                        <div class="add-description-box">
                            <textarea placeholder="Add description..." id="storyDescription" name="storyDescription" ></textarea>
                        </div> 
                        <br>
                        <!-- post button -->
                        <div class="post-story-button"> 
                           <input type="submit" value="Post">
                        </div> 
                    
                    </div> 
                                       
                    </form>

                    <!-- last-title for this -->
                    <div class="last-title">
                        <h3>Your success stories</h3>
                    </div>

                </div>
            </div> 

        </div>
    </section>
</main>

<script>
function display_image_name (file_name)
{
    document .querySelector (".file_info").innerHTML = ' <b>Selected file:</b> <br>' + file_name;
}   
</script>


<?php require APPROOT.'/views/inc/footer.php'; ?>
