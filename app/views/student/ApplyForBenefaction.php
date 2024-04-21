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
                        <h3>Apply for the benefaction</h3>
                        <p>Apply for the benefaction posted by the donor</p>
                        
                    </div>

                    <div class="application-form-data">
                        <form class="add-form" method="POST" action="<?php echo URLROOT ?>/Benefaction/addAppliedBenefaction">

                            <label for="requestedQuantity">Requested amount</label><br>
                            <input type="number" id="requestedQuantity" name="requestedQuantity" min="1" max="<?php echo $data['benefactions']->itemQuantity;?>" required><br><br>

                            <label for="reason">Reason</label><br>
                            <input type="textarea" id="reason" name="reason" required><br><br>

                            <input type="text" name="benefactionID" id="benefactionID" hidden value="<?php echo $data["benefactionID"]?>" />


                            <input type="submit" value="Apply">
                        </form>
                       
                    </div>
            </div>

            

            <!-- right side bar for success story -->
            <div class="rightside-bar-type-one">
                <div class="right-side-bar">
                    <!-- title for rightside bar -->
                    <div class="rightside-bar-title">
                        <h3>Applied Benefactions</h3>
                        <?php foreach ($data['appliedBenefactions'] as $item) { ?>
                                <a href="<?php echo URLROOT ?>/Student/viewAppliedBenefaction/<?php echo $item->benefactionID?>">
                            <div class="applied-benefaction-cards">
                                <div class="left">
                                    <h3><?php echo $item->itemName; ?><h3>
                                    <p>Req Amount: <?php echo $item->requestedQuantity; ?></p>
                                
                                </div>
                                <div class="right">
                                    
                                        <p><?php 
                                        $status = $item->verificationStatus;

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


</script>


<?php require APPROOT.'/views/inc/footer.php'; ?>
