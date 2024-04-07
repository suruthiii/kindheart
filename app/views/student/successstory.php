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
                    <?php foreach ($data['successstories'] as $item) { ?>
                        <div class="success-story-card-new">
                            <!-- logo name and story added date -->
                            <div class="logo-name-date">
                                <div class="logo-for-success">
                                    <img src="<?php echo URLROOT ?>/img/logo.jpg" alt="">
                                </div>
                                <div class="name-date">
                                    <h4><?php echo $item->username; ?></h4>
                                    <p><?php echo $item->addDate; ?></p>
                                </div>
                            </div>

                            <div class="added-story-title">
                                <h3><?php echo $item->title; ?></h3>
                            </div>

                            <!-- Added image show box -->
                            <?php if ($item->image !== null) { ?>
                                <div class="added-image-box1">
                                    <img src="<?php echo URLROOT ?>/uploads/<?php echo $item->image; ?>" alt="<?php echo $item->storyTitle; ?>">
                                </div>
                            <?php } ?>

                            <!-- added story description -->
                            <div class="added-story-description-new">
                                <p><?php echo $item->description; ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <!-- right side bar for success story -->
                <div class="rightside-bar-type-one">
                    <div class="right-side-bar">
                        <!-- title for rightside bar -->
                        <div class="rightside-bar-title">
                            <h3>Add success Stories</h3>
                        </div>
                        <!-- add image box -->
                        <form class="add-form" method="POST" enctype="multipart/form-data" action="<?php echo URLROOT ?>/successstory/addSuccessStory" onsubmit="return validateFileType()">
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
                                <input type="text" id="title" name="title" required><br><br>

                                <label for="storyDescription">Add Description</label><br>
                                <input type="textarea" id="storyDescription" name="storyDescription" required><br><br>

                                <input type="submit" value="Publish">

                            </div>                  
                        </form>

                        <!-- last-title for this -->

                        <div class="view-posted-stories" onclick="location.href='<?php echo URLROOT ?>/successstory/viewSuccessStory'">
                                <h3>Your Success Stories</h3>
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
    document .querySelector (".add-photo-box").style.border = '1px dashed red';
    document .querySelector (".add-photo-box").style.backgroundColor= 'rgb(249, 224, 209';
    document .querySelector (".add-photo-box").style.color= 'rgb(213, 83, 7)';

}   

function validateFileType() {
    const fileInput = document.getElementById("image-browser");
    const filePath = fileInput.value;
    const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;  

    const errorMessageElement = document.querySelector('.error-message');

    if (!allowedExtensions.exec(filePath)) {
        errorMessageElement.textContent = 'Invalid file type. Please choose a JPG, JPEG, or PNG file.';
        errorMessageElement.style.color = 'red'; 
        fileInput.value = ''; // Clear the invalid file selection
        return false; 
    } else {
        errorMessageElement.textContent = ''; // Clear error if valid
        return true;
    }
}

const form = document.querySelector('.add-form'); 
    form.addEventListener('submit', function(event) {
        if (!validateFileType()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
  });

  function adjustCardHeights() {
  const cards = document.querySelectorAll('.success-story-card-new');

  cards.forEach(card => {
    const innerContent = card.querySelector('.card-content'); 
    const contentHeight = innerContent.offsetHeight; 
    card.style.height = (contentHeight + 40) + 'px'; 
  });
}

// Call initially on page load 
adjustCardHeights(); 

</script>


<?php require APPROOT.'/views/inc/footer.php'; ?>
