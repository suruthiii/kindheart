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
                    <a href="<?php echo URLROOT ?>/student/successstory">
                        <table>
                            <tr>
                                <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                                <td width="70%">Go Back</td>
                            </tr>
                        </table>
                    </a>
            
                    <!-- middle container titles -->
                    <div class="middle-container-titles">
                        <h3>Edit Your Success Stories</h3>
                        <p>Edit the  success story Posted by You</p>
                    </div>

                    <div class="edit-story">
                        <form class="add-form" method="POST" enctype="multipart/form-data" action="<?php echo URLROOT ?>/student/editSuccessStory" onsubmit="return validateFileType()">
                            <div >
                                
                                <label for ="image-browser" class="add-photo-box">
                                        <input onchange="display_image_name(this.files[0].name)" id="image-browser" type="file" name ="image"  style="display:none;" />
                                        <p class='file_info'>+ Add Photo</p>
                                </label> 
                                <small class="error-message"></small> 
                            
                                <br><br>
                                    
                            </div> 

                            <!-- add description and title box -->
                            <div>
                            

                                <label for="title">Add Title</label><br>
                                <input type="text" value="<?php print_r($data['storyData']->title) ?>" name="title" ><br><br>

                                <label for="storyDescription">Add Description</label><br>
                                <input type="textarea" value="<?php print_r($data['storyData']->description) ?>" name="storyDescription" ><br><br>
                                <input type="text" value="<?php print_r($data['storyData']->storyID) ?>" name="storyID" hidden >
                                <input type="submit" value="Save">

                            </div>                  
                        </form>

                    </div>
            

        </div>
    </section>
</main>


<script>

history.pushState(null, null, '/kindheart/student/viewSuccessStory');


</script>


<?php require APPROOT.'/views/inc/footer.php'; ?>
