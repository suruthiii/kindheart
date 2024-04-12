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
                        <h3>Your Success Stories</h3>
                        <p>View success stories Posted by You</p>
                    </div>


                    <div class="tile-list-new">
                        <div class="tiles-new">

                            <?php foreach($data['stories'] as $item){?>
                                <!-- <a href="<?php echo URLROOT ?>/student/SuccessStory/<?php echo $item->storyID?>"> -->
                                    <div class="tile-new">
                                        <table>
                                            <tr id="myBtn">
                                                <td width="50%" class="tile-name"><?php echo $item->title;?></td>
                                                <td width="50%" class="option-new">
                                                    <form action="<?php echo URLROOT ?>/successstory/editStory" method="GET" class="edit-form-new " >
                                                        <input type="text" name="storyID" id="storyID" hidden value="<?php echo $item->storyID?>" />
                                                        <button type="submit" class="edit" >
                                                            <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg" alt="">
                                                        </button>
                                                    </form>
                                                    
                                                    <form action="<?php echo URLROOT ?>/successstory/deleteStory" method="post" class="delete-form-new " onsubmit="return confirmDelete();">
                                                        <input type="text" name="storyID" id="storyID" hidden value="<?php echo $item->storyID?>" />
                                                        <button type="submit" class="delete">
                                                            <img src="<?php echo URLROOT ?>/img/trash-solid.svg" style="transform:translateY(2px)" alt="">
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <!-- The Modal -->

                                        </table>
                                    </div>
                                <!-- Modal for Edit -->
<div id="editModal" class="modal">
    <div class="modal-content">
    <p>Some text in the Modal..</p>
    </div>
</div>

<!-- Modal for Delete
<div id="deleteModal" class="modal">
    <div class="modal-content"> -->
        <!-- Add your delete confirmation content here -->
    <!-- </div>
</div>
                            <?php }?>
                        </div>
                    </div>
                 </div>
                  -->
            

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

// history.pushState(null, null, '/kindheart/student/viewSuccessStory');

function confirmDelete() {
        return confirm("Are you sure you want to delete this story?");
    }
    function openModal(modalId) {
        var modal = document.getElementById(modalId);
        modal.style.display = "block";
    }

</script>


<?php require APPROOT.'/views/inc/footer.php'; ?>
