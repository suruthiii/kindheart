<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "scholarships";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

            <!-- Middle container -->
            <div class="middle-container">
                <!-- Go Back Button -->
                

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>Posted scholarships</h3>
                    <p>View the available scholarships posted by donors</p>
                </div>

                <div class ="scholarship-card-container">
                    <?php foreach ($data['scholarships'] as $item) { ?>

                        <div class="card">
                    
                            <div class="course"> 
                                <div class="preview">
                                    <h6><?php echo $item->duration; ?> months</h6>
                                    <h2><?php echo $item->amount; ?> LKR</h2>

                                </div>
                                <div class="info"> 
                                    <div class="info_text">
                                        <h6><?php echo $item->postedDate; ?></h6>
                                        <h2><?php echo $item->title; ?></h2>
                                    </div>
                                    <div class="btn">
                                        <form action="<?php echo URLROOT ?>/student/Applyscholarship" method="GET" >
                                            <input type="text" name="scholarshipID" id="scholarshipID" hidden value="<?php echo $item->scholarshipID?>" />
                                    
                                            <?php if ($item->studentID == $_SESSION['user_id']){?>
                                                <h4> Already Applied</h4>
                                            <?php } else{?>
                                                <button type="submit" > Apply</button>
                                            <?php }?>
                                        </form>

                                    </div>     
                                </div>
                            </div>
                        </div>
                    <?php } ?>                        
                </div>
            </div>
            

            <!-- right side bar for success story/ choose or add necessity -->
            <div class="rightside-bar-type-one">
                    <div class="right-side-bar">
                        <!-- title for rightside bar -->
                        <div class="rightside-bar-title">

                            <h3>Applied Scholarships</h3>

                            <?php foreach ($data['appliedScholarships'] as $item) { ?>
                                <a href="<?php echo URLROOT ?>/Student/ViewAppliedScholarship/<?php echo $item->scholarshipID?>">
                            <div class="applied-benefaction-cards">
                                <div class="left">
                                    <h3><?php echo $item->title; ?><h3>
                                    <p><?php echo $item->amount; ?> LKR</p>
                                
                                </div>
                                <div class="right">
                                    
                                        <p><?php 
                                        $status = $item->availabilityStatus;

                                        // Echo different divs based on the status
                                        if ($status === 0) {
                                            echo '<div class="status_pending"><p>Pending</p></div>';
                                        } elseif ($status === 1) {
                                            echo '<div class="status_accepted"><p>Accepted</p></div>';
                                        } elseif ($status === 2) {
                                            echo '<div class="status_rejected"><p>Completed</p></div>';
                                        } else {
                                            echo '<div class="status_unknown"><p>Unknown status</p></div>';
                                        }
                                        ?></p>
                                                                  
                                </div>
                            </div>
                            <?php } ?> 



                        </div>

                        
                    </div>
                </div> 

        </div>
    </section>
</main>
<script>
    const trunc = document.querySelector ('p-trunc'); 
    trunc. innerText = trunc.innerText.substring(0,100)+'...';

    </script>

<?php require APPROOT.'/views/inc/footer.php'; ?>
