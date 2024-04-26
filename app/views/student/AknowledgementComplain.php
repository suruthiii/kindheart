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
                        <div style="max-width: 600px; margin: 20px auto; background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                        <h1 style="color: #333; text-align: center;">Your Complaint has been sent!</h1>
                        <p style="color: #555; line-height: 1.6;">We're thrilled to inform you that your donation has been successfully received. Your generous contribution will make a significant impact on our cause.</p>
                        <p style="color: #555; line-height: 1.6;">Additionally, we're delighted to confirm that the acknowledgment has been sent successfully. Your kindness and support mean the world to us, and we're deeply grateful for your generosity.</p>
                        <p style="color: #555; line-height: 1.6;">Thank you once again for your compassion and commitment to making a difference in our community.</p>
                        <p style="font-weight: bold;">Warm regards,<br>KINDHEART</p>
                    </div>

                        
                    </div>

                    
            

        </div>
    </section>
</main>

<script>


</script>


<?php require APPROOT.'/views/inc/footer.php'; ?>