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
                                
                                <a href="<?php echo URLROOT ?>/Student/viewDonor/<?php echo $item->donorID?>">
                               
                                    <div class="tile-donor">
                                        <table>
                                            <tr id="myBtn">
                                                <td width="50%" class="tile-name"><?php echo $item->donorName;?></td>
                                                    
                                                </td>
                                            </tr>

                                        </table>
                                    </div>
                            </a>
                               



                            <?php }?>
                        </div>
                    </div>


            </div> 
             <!-- right side bar for success story -->
              <!-- right side bar for success story -->
              <div class="user-profile-right-side-bar">
                <div class="user-profile-right-side-bar-inner">  
                    <!-- Topic -->
                    <div class="user-profile-right-side-bar-topic">
                        <h3>Donor Profile</h3>
                        <div class="user-profile-right-side-bar-grey-line"> </div>
                    </div>  
                    
                    <!-- Display user-profile or no requests message -->
                    <div class="user-profile-right-side-bar-all-user-profiles">
                        <div class="user-profile-right-side-bar-all-user-profiles-inner">
                           

                               <?php if (empty($data['donorDetailsInd'])): ?>
                                <div class="user-profile-right-side-bar-all-user-profiles-inner-image">
                                    <img src="<?php echo URLROOT ?>/img/companyDP.jpg" alt="Profile Image">
                                </div>
                                <div class="user-profile-right-side-bar-all-user-profiles-inner-details">
                                    <table>
                                        <tr class="user-profile-data">
                                            <th>User Name</th>
                                            <td><?php print_r($data['donorDetailsOrg']->username); ?></td>
                                        </tr>

                                        <tr class="user-profile-data">
                                            <th>Company Name</th>
                                            <td><?php print_r($data['donorDetailsOrg']->companyName); ?></td>
                                        </tr>
                                       
                                        <tr class="user-profile-data">
                                            <th>Donor Type</th>
                                            <td><?php print_r($data['donorDetailsOrg']-> donorType); ?></td>
                                        </tr>
                                        <tr class="user-profile-data">
                                            <th>Email Address</th>
                                            <td><?php print_r($data['donorDetailsOrg']->email); ?></td>
                                        </tr>
                                        <tr class="user-profile-data">
                                            <th>Phone Number</th>
                                            <td><?php print_r($data['donorDetailsOrg']->phoneNumber); ?></td>
                                        </tr>

                                        <tr class="user-profile-data">
                                            <th>Address</th>
                                            <td><?php print_r($data['donorDetailsOrg']->address); ?></td>
                                        </tr>
  
                                    </table>          
                                </div>
                            <?php else:  ?>
                                <div class="user-profile-right-side-bar-all-user-profiles-inner-image">
                                    <img src="<?php echo URLROOT ?>/img/IdividualDP.jpg" alt="Profile Image">
                                </div>
                                <div class="user-profile-right-side-bar-all-user-profiles-inner-details">
                                    <table>
                                        <tr class="user-profile-data">
                                            <th>User Name</th>
                                            <td><?php print_r($data['donorDetailsInd']->username); ?></td>
                                        </tr>
                                        <tr class="user-profile-data">
                                            <th>Name</th>
                                            <td><?php print_r($data['donorDetailsInd']->fName);print_r($data['donorDetailsInd']->lName); ?></td>
                                        </tr>
                                        <tr class="user-profile-data">
                                            <th>Email Address</th>
                                            <td><?php print_r($data['donorDetailsInd']->email); ?> </td>
                                        </tr>

                                        
                                  
                
                                    </table>          
                                </div>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
            </div>  



        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
