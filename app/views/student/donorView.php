<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "donors";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="right-side-container">

            <!-- Middle container -->
            <div class="middle-container">
           
                <!-- Go Back Button -->
                <a href="<?php echo URLROOT ?>/Student/donors">
                        <table>
                            <tr>
                                <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                                <td width="70%">Go Back</td>
                            </tr>
                        </table>
                    </a>

                <!-- main title -->
                <div class="middle-container-title-typeone">
                    <h3>View Donors</h3>
                    <p>View the list of donors</p>
                </div>

                <!-- search bar -->
                <div class="search-bar-for-view-donors">
                    <img src="<?php echo URLROOT ?>/img/Vector.png" alt="search">
                    <input type="search" placeholder="Search">
                </div>

                <!-- table caption -->
                <div class="table-caption-for-view-dobor">
                    <h4>Donors</h4>
                </div>

                <div class="grey-line-under-the-view-donor-table-caption"></div>

                <!-- view Donor table -->
                <div class="tile-list-donor">
                        <div class="tiles-donor">

                            <?php foreach($data['donors'] as $item){?>
                                
                                <!-- <a href="<?php echo URLROOT ?>/SuccessStory/viewOwnSuccessStory/<?php echo $item->storyID?>"> -->
                               
                                    <div class="tile-donor">
                                        <table>
                                            <tr id="myBtn">
                                                <td width="50%" class="tile-name"><?php echo $item->donorName;?></td>
                                                    
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                               



                            <?php }?>
                        </div>
                    </div>


            </div> 
             <!-- right side bar for success story -->
              <!-- right side bar for success story -->
            <div class="rightside-bar-type-one">
                <div class="right-side-bar">
                    <!-- title for rightside bar -->
                    <div class="rightside-bar-title">
                        <h3>Donor Profile</h3>
                    </div>
                    <div class="details-Container">

                        <table>
                            <tr>
                                <td width="50%" class="detail-name">Nameeeeeeeeeeeeeeeeeeeeeeeeee</td>
                                <td width="50%" class="detail-value">hellowfghvjhvbjjkhytyrewaszxcfgvhbjkiolk,mnbhgfdrx</td>
                            </tr>

                        </table>
                        
                    
                    </div>


                    <!-- Display donor details -->
                    
                   

                </div>
            </div> 



        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
