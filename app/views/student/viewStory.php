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
                <a href="<?php echo URLROOT ?>/SuccessStory/viewSuccessStory">
                        <table>
                            <tr>
                                <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                                <td width="70%">Go Back</td>
                            </tr>
                        </table>
                    </a>
                <!-- middle container titles -->
                <div class="middle-container-titles">
                    <h3>Success Stories</h3>
                    <p>View</p>
                </div>
                
                <div class="succes-story-scrol-card-container">
                    
                    <!-- added story cards -->
                    
                        <div class="success-story-card-new">

                            <div class="added-story-title">
                                <h3><?php  echo $data['stories']->title; ?></h3>
                            </div>

                            <!-- Added image show box -->
                            <?php if ($data['stories']->image !== null) { ?>
                                <div class="added-image-box1">
                                    <img src="<?php echo URLROOT ?>/uploads/<?php echo $data['stories']->image; ?>" alt="<?php echo $data['stories']->storyTitle; ?>">
                                </div>
                            <?php } ?>

                            <!-- added story description -->
                            <div class="added-story-description-new">
                                <p><?php echo $data['stories']->description; ?></p>
                            </div>
                        </div>
                        
                  
                </div>

               
                 

        </div>
    </section>
</main>

<script>
  



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
