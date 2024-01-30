<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "complaints";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

            <!-- Middle container -->
            <div class="middle-container">
                <!-- Go Back Button -->
                <div class="goback-button">
                    <img src="<?php echo URLROOT ?>/img/back-arrow.png">
                    <button onclick="">Go Back</button>
                </div>

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>Make a Complain</h3>
                </div>

                <!-- complaint form -->
                <div class="form-area">
                    <form action="" method="post">
                        <!-- Complaint in brief -->
                        <div class="middle-container-oneline-input">
                            <label for="complaintinbrief">Complaint in brief </label>
                            <input type="text" id="complaininbrief" name="complaininbrief">
                        </div>
                        <!-- Complaint Description -->
                        <div class="middle-container-online-textare">
                            <label for="complaintdescription">Description</label>
                            <textarea name="complaintdescription" id="complaintdescription"></textarea>
                        </div>
                        <!-- Complaint Button -->
                        <div class="complaint-button">
                            <input type="submit" value="Complaint">
                        </div>

                    </form>
                </div>

            </div>

            <!-- right side bar for success story -->
            <div class="rightside-bar-type-one">
                <div class="right-side-bar">
                    <!-- Image -->
                    <div class="rightside-bar-type-one-image">
                        <img src="<?php echo URLROOT ?>/img/Asset_1hif_1.png">
                    </div>
                    <!-- Ask only for what you really need -->
                    <div class="rigntside-bar-type-one-description">
                        <h4>Ask only for <br>what you really need</h4>
                        <p> Kindly prioritise and request only 
                            what you truly need for your education. 
                            Remember, there are many students 
                            like you seeking support. 
                            Let's ensure everyone gets a chance. 
                        </p>
                        <p>Thank you for your <br>understanding.</p>
                    </div>

                </div>
            </div> 

        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
