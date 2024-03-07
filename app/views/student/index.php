<?php require APPROOT.'/views/inc/header.php'; ?>
<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<h1>Student Dashboard</h1>

<?php require APPROOT.'/views/inc/footer.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "dashboard";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container" >
    
    <section class="section" id="main"  >
        

        <div class="right-side-container" style="background-image: url('<?php echo URLROOT ?>/img/dashhh.png'); background-size: cover;">


            <!-- Middle container -->
            <div class="middle-container"  >
                <!-- middle container titles -->
                <div class="middle-container-titles" >
                    <h3>Hello Student1!</h3>
                    <p>Information About Your Donations</p>
                </div>

                <div class="dash-card-container">
                    <div class="dash-cards">
                            <h2>25</h2>
                            <h3>Total Received donations</h3>
                        </div>
                        
                        <div class="dash-cards">
                            <h2>10</h2>
                            <h3>Total Applied donations</h3>
                        </div>

                        <div class="dash-cards">
                            <h2>0</h2>
                            <h3>Ongoing Donations</h3>
                        </div>

                    </div>
                </div>

                
              
            </div> 

            

        </div>
    </section>
</main>
