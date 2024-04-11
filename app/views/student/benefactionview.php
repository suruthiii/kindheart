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
                    <a href="<?php echo URLROOT ?>/student/benefactions">
                        <table>
                            <tr>
                                <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                                <td width="70%">Go Back</td>
                            </tr>
                        </table>
                    </a>
            
                    <!-- middle container titles -->
                    <div class="middle-container-titles">
                        <h3>View benefation</h3>
                        <p>View benefaction info</p>
                    </div>
                    <div class="benefaction-info">
                <table>
                    <tr class="benefaction-data">
                        <th width="30%">Item</th>
                        <td width="70%"><?php print_r($data['benefactions']->itemName) ?></td>
                    </tr>
                    <tr class="benefaction-data">
                        <th width="30%">Donor name</th>
                        <td width="70%"><?php print_r($data['benefactions']->username) ?></td>
                    </tr>
                    <tr class="benefaction-data">
                        <th width="30%">Date</th>
                        <td width="70%"><?php print_r($data['benefactions']->postedDate) ?></td>
                    </tr>
                    <tr class="benefaction-data">
                        <th width="30%">Quantity</th>
                        <td width="70%"><?php print_r($data['benefactions']->itemQuantity) ?></td>
                    </tr>
                    <tr class="benefaction-data">
                        <th width="30%">Description</th>
                        <td width="70%"><?php print_r($data['benefactions']->description) ?></td>
                    </tr>
                </table>
            </div>


                   
                 </div>
                 
            

            <!-- right side bar for success story -->
            <div class="rightside-bar-type-one">
                <div class="right-side-bar">
                    <!-- title for rightside bar -->
                    <div class="rightside-bar-title">
                        <h3>applied Benefactions</h3>
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

// history.pushState(null, null, '/kindheart/student/viewSuccessStory');

function confirmDelete() {
        return confirm("Are you sure you want to delete this story?");
    }

</script>


<?php require APPROOT.'/views/inc/footer.php'; ?>
