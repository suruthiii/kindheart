<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "benefactions";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

            <!-- Middle container -->
            <div class="middle-container">
                <!-- middle container titles -->
                <div class="middle-container-titles">
                    <h3>Posted Benefactions</h3>
                    <p>View physical good items posted by donors</p>
                </div>
                <!-- <div class="benefaction-cards"> -->
               
                
                <div class="benefaction-card-container">
                    <!-- added story cards -->
                    <?php foreach ($data['benefactions'] as $item) { ?>
                    
                    <div class="card">
                        <img src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $item->itemPhoto1; ?>" alt="<?php echo $item->description; ?>">
                        <div class="card-content">
                            <h3><?php echo $item->itemName; ?></h3>
                            <p>posted by <?php echo $item->username; ?></p>
                            <div class="btn-container">
                            <form action="<?php echo URLROOT ?>/student/benefactionview" method="GET" class="btn" >
                                <input type="text" name="benefactionID" id="benefactionID" hidden value="<?php echo $item->benefactionID?>" />
                                <button type="submit" class="btn1" > View </button>
                            </form>
                            <form action="<?php echo URLROOT ?>/student/ApplyForBenefaction" method="GET" class="btn" >
                                <input type="text" name="benefactionID" id="benefactionID" hidden value="<?php echo $item->benefactionID?>" />
                                <button type="submit" class="btn1" > Apply</button>
                            </form>
                    </div>
                        </div> 
                    </div>   
                    <?php } ?>

                </div>
               
            </div>
            

                <!-- right side bar for success story -->
                <div class="rightside-bar-type-one">
                    <div class="right-side-bar">
                        <!-- title for rightside bar -->
                        <div class="rightside-bar-title">
                            <h3>Applied Benefactions</h3>
                            <!-- <p>View states of applied benefactions</p> -->
                        </div>

                        
                    </div>
                </div> 

        </div>
    </section>
</main>

<script>


</script>


<?php require APPROOT.'/views/inc/footer.php'; ?>
