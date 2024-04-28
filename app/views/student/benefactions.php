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
                    <?php 
                    $benefactionDataArray = array();
                    foreach (array_reverse($data['benefactions']) as $item) { 
                        if (!in_array($item->benefactionID, $benefactionDataArray)) { ?>

                            <div class="card">
                            <img src="<?php echo URLROOT ?>/benefactionUploads/<?php echo $item->itemPhoto1; ?>" alt="<?php echo $item->description; ?>">
                            <div class="card-content">
                                <h3><?php echo $item->itemName; ?></h3>
                                <p>posted by <?php echo $item->username; ?></p>
                                <div class="btn-container">
                                <form action="<?php echo URLROOT ?>/student/benefactionviewNotApplied" method="GET" class="btn" >
                                    <input type="text" name="benefactionID" id="benefactionID" hidden value="<?php echo $item->benefactionID?>" />
                                    <button type="submit" class="btn1" > View </button>
                                </form>
                                <form action="<?php echo URLROOT ?>/student/ApplyForBenefaction" method="GET" class="btn" >
                                    <input type="text" name="benefactionID" id="benefactionID" hidden value="<?php echo $item->benefactionID?>" />
                                    <?php if ($item->doneeID == $_SESSION['user_id']){?>
                                        <p> Already Applied</p>
                                    <?php } else{?>
                                        <button type="submit" class="btn1" > Apply</button>
                                    <?php }?>
                                </form>
                            </div>
                        </div> 
                        </div> 
                        <?php 
                        array_push($benefactionDataArray,$item->benefactionID);
                        }
                    
                    
                     } ?>

                </div>
               
            </div>
            

                <!-- right side bar for success story -->
                <div class="rightside-bar-type-one">
                    <div class="right-side-bar">
                        <!-- title for rightside bar -->
                        <div class="rightside-bar-title">

                            <h3>Applied Benefactions</h3>

                            <?php foreach ($data['appliedBenefactions'] as $item) { 
                              ;?>
                                <a href="<?php echo URLROOT ?>/Student/viewAppliedBenefaction/<?php echo $item->benefactionID?>">
                            <div class="applied-benefaction-cards">
                                <div class="left">
                                    
                                    <h3><?php echo $item->itemName; ?><h3>
                                    <p>Req Amount: <?php echo $item->requestedQuantity; ?></p>
                                
                                </div>
                                <div class="right">
                                    
                                        <p><?php 
                                        $status = $item->availabilityStatus ;
                                        $Acceptedstatus = $item->acceptanceStatus  ;
                                        $completedStatus = $item->verificationStatus  ;

                                       
                                        

                                        // Echo different divs based on the status
                                        if ($Acceptedstatus === 0) {
                                            echo '<div class="status_pending"><p>Pending</p></div>';

                                        } elseif ($Acceptedstatus === 1  ) {
                                            echo '<div class="status_accepted"><p>Accepted</p></div>';

                                        } elseif ($Acceptedstatus === 2 && $completedStatus === 0) {
                                            echo '<div class="status_accepted"><p>Accepted</p></div>';

                                        } elseif ($Acceptedstatus === 2 && $completedStatus === 1) {
                                            echo '<div class="status_rejected"><p>Donated</p></div>';

                                        } elseif ($Acceptedstatus === 2 && $completedStatus === 2) {
                                            echo '<div class="status_rejected"><p>Completed</p></div>';

                                        } elseif ($Acceptedstatus === 1 && $completedStatus === 3) {
                                            echo '<div class="status_rejected"><p>Complained</p></div>';

                                        } else {
                                            echo '<div class="status_unknown"><p>Rejected</p></div>';
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


</script>


<?php require APPROOT.'/views/inc/footer.php'; ?>
