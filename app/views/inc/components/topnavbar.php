<div class="topnav">
    <div class="container">
        <div class="items">
            <a class="item menu" onclick="navToggle()"><img style="width: 20px" src="<?php echo URLROOT ?>/img/menu.svg" alt=""></i></a>
            <div class="content">
                <!-- <div class="search">
                    <input class="search-bar"  type="search" placeholder="Search...">
                    <div class="filter">
                        <img class="filter-ico" src="<?php echo URLROOT ?>/img/filter.png" alt="">
                    </div>
                </div> -->
                <div class="notify">
                    <!-- <div class="notification-count" style="background-color: red; border-radius: 50px; color: white; padding: 4px 6px 3px 6px; font-size: 8px; position: absolute; right: 115px; top: 32px">
                        <?php echo $other_data['notification_count']; ?>
                    </div>

                    <div class="notification-area">
                        <?php foreach($other_data['notifications'] as $item) {

                            /* ------------------------------ Admin and Super Admin Notifications ----------------------------- */
                            if($item->notificationType == "complaint"){?> 
                                <a href="<?php echo URLROOT?>/complaint/viewcomplaint?complaint_ID=<?php echo $item->data?>">
                                    <div class="notification" >
                                        <div class="notification-content">
                                            <div class="notification-name"><?php echo $item->name ?></div>
                                            <div class="notification-des"><?php echo $item->description ?></div>
                                        </div>
                                        <div class="notification-option">
                                            <form action="<?php echo URLROOT?>/notification/markasread" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translate(-30px, 10px);">
                                                    <img class="ico" style="width: 13px;" src="<?php echo URLROOT ?>/img/check.png" alt="" >
                                                </button>
                                            </form>

                                            <form action="<?php echo URLROOT?>/notification/deletenotification" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translateY(-8px);">
                                                    <img class="ico" style="width: 10px;" src="<?php echo URLROOT ?>/img/close.png" alt="" >
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            <?php }

                            else if($item->notificationType == "studentRegistrationRequest"){?> 
                                <a href="<?php echo URLROOT?>/request/viewstudentrequest/<?php echo $item->data?>">
                                    <div class="notification" >
                                        <div class="notification-content">
                                            <div class="notification-name"><?php echo $item->name ?></div>
                                            <div class="notification-des"><?php echo $item->description ?></div>
                                        </div>
                                        <div class="notification-option">
                                            <form action="<?php echo URLROOT?>/notification/markasread" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translate(-30px, 10px);">
                                                    <img class="ico" style="width: 13px;" src="<?php echo URLROOT ?>/img/check.png" alt="" >
                                                </button>
                                            </form>

                                            <form action="<?php echo URLROOT?>/notification/deletenotification" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translateY(-8px);">
                                                    <img class="ico" style="width: 10px;" src="<?php echo URLROOT ?>/img/close.png" alt="" >
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            <?php }

                            else if($item->notificationType == "organizationRegistrationRequest"){?> 
                                <a href="<?php echo URLROOT?>/request/vieworganizationrequest/<?php echo $item->data?>">
                                    <div class="notification" >
                                        <div class="notification-content">
                                            <div class="notification-name"><?php echo $item->name ?></div>
                                            <div class="notification-des"><?php echo $item->description ?></div>
                                        </div>
                                        <div class="notification-option">
                                            <form action="<?php echo URLROOT?>/notification/markasread" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translate(-30px, 10px);">
                                                    <img class="ico" style="width: 13px;" src="<?php echo URLROOT ?>/img/check.png" alt="" >
                                                </button>
                                            </form>

                                            <form action="<?php echo URLROOT?>/notification/deletenotification" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translateY(-8px);">
                                                    <img class="ico" style="width: 10px;" src="<?php echo URLROOT ?>/img/close.png" alt="" >
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            <?php }

                            else if($item->notificationType == "MonetarySlipUpload"){?> 
                                <a href="<?php echo URLROOT?>/request/vieworganizationrequest/<?php echo $item->data?>">
                                    <div class="notification" >
                                        <div class="notification-content">
                                            <div class="notification-name"><?php echo $item->name ?></div>
                                            <div class="notification-des"><?php echo $item->description ?></div>
                                        </div>
                                        <div class="notification-option">
                                            <form action="<?php echo URLROOT?>/notification/markasread" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translate(-30px, 10px);">
                                                    <img class="ico" style="width: 13px;" src="<?php echo URLROOT ?>/img/check.png" alt="" >
                                                </button>
                                            </form>

                                            <form action="<?php echo URLROOT?>/notification/deletenotification" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translateY(-8px);">
                                                    <img class="ico" style="width: 10px;" src="<?php echo URLROOT ?>/img/close.png" alt="" >
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            <?php } 

                            else if($item->notificationType == "GoodReceiptUpload"){?> 
                                <a href="<?php echo URLROOT?>/request/vieworganizationrequest/<?php echo $item->data?>">
                                    <div class="notification" >
                                        <div class="notification-content">
                                            <div class="notification-name"><?php echo $item->name ?></div>
                                            <div class="notification-des"><?php echo $item->description ?></div>
                                        </div>
                                        <div class="notification-option">
                                            <form action="<?php echo URLROOT?>/notification/markasread" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translate(-30px, 10px);">
                                                    <img class="ico" style="width: 13px;" src="<?php echo URLROOT ?>/img/check.png" alt="" >
                                                </button>
                                            </form>

                                            <form action="<?php echo URLROOT?>/notification/deletenotification" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translateY(-8px);">
                                                    <img class="ico" style="width: 10px;" src="<?php echo URLROOT ?>/img/close.png" alt="" >
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            <?php } 

                            else if($item->notificationType == "ProjectFundSlipUpload"){?> 
                                <a href="<?php echo URLROOT?>/request/vieworganizationrequest/<?php echo $item->data?>">
                                    <div class="notification" >
                                        <div class="notification-content">
                                            <div class="notification-name"><?php echo $item->name ?></div>
                                            <div class="notification-des"><?php echo $item->description ?></div>
                                        </div>
                                        <div class="notification-option">
                                            <form action="<?php echo URLROOT?>/notification/markasread" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translate(-30px, 10px);">
                                                    <img class="ico" style="width: 13px;" src="<?php echo URLROOT ?>/img/check.png" alt="" >
                                                </button>
                                            </form>

                                            <form action="<?php echo URLROOT?>/notification/deletenotification" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translateY(-8px);">
                                                    <img class="ico" style="width: 10px;" src="<?php echo URLROOT ?>/img/close.png" alt="" >
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            <?php } 

                            else if($item->notificationType == "ScholarshipSlipUpload"){?> 
                                <a href="<?php echo URLROOT?>/request/vieworganizationrequest/<?php echo $item->data?>">
                                    <div class="notification" >
                                        <div class="notification-content">
                                            <div class="notification-name"><?php echo $item->name ?></div>
                                            <div class="notification-des"><?php echo $item->description ?></div>
                                        </div>
                                        <div class="notification-option">
                                            <form action="<?php echo URLROOT?>/notification/markasread" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translate(-30px, 10px);">
                                                    <img class="ico" style="width: 13px;" src="<?php echo URLROOT ?>/img/check.png" alt="" >
                                                </button>
                                            </form>

                                            <form action="<?php echo URLROOT?>/notification/deletenotification" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translateY(-8px);">
                                                    <img class="ico" style="width: 10px;" src="<?php echo URLROOT ?>/img/close.png" alt="" >
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            <?php } 

                            else if($item->notificationType == "BenefactionReceiptUpload"){?> 
                                <a href="<?php echo URLROOT?>/request/vieworganizationrequest/<?php echo $item->data?>">
                                    <div class="notification" >
                                        <div class="notification-content">
                                            <div class="notification-name"><?php echo $item->name ?></div>
                                            <div class="notification-des"><?php echo $item->description ?></div>
                                        </div>
                                        <div class="notification-option">
                                            <form action="<?php echo URLROOT?>/notification/markasread" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translate(-30px, 10px);">
                                                    <img class="ico" style="width: 13px;" src="<?php echo URLROOT ?>/img/check.png" alt="" >
                                                </button>
                                            </form>

                                            <form action="<?php echo URLROOT?>/notification/deletenotification" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translateY(-8px);">
                                                    <img class="ico" style="width: 10px;" src="<?php echo URLROOT ?>/img/close.png" alt="" >
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            <?php } 

                            else if($item->notificationType == "MonetaryDonationNotReceived"){?> 
                                <a href="<?php echo URLROOT?>/request/vieworganizationrequest/<?php echo $item->data?>">
                                    <div class="notification" >
                                        <div class="notification-content">
                                            <div class="notification-name"><?php echo $item->name ?></div>
                                            <div class="notification-des"><?php echo $item->description ?></div>
                                        </div>
                                        <div class="notification-option">
                                            <form action="<?php echo URLROOT?>/notification/markasread" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translate(-30px, 10px);">
                                                    <img class="ico" style="width: 13px;" src="<?php echo URLROOT ?>/img/check.png" alt="" >
                                                </button>
                                            </form>

                                            <form action="<?php echo URLROOT?>/notification/deletenotification" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translateY(-8px);">
                                                    <img class="ico" style="width: 10px;" src="<?php echo URLROOT ?>/img/close.png" alt="" >
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            <?php } 

                            else if($item->notificationType == "GoodDonationNotReceived"){?> 
                                <a href="<?php echo URLROOT?>/request/vieworganizationrequest/<?php echo $item->data?>">
                                    <div class="notification" >
                                        <div class="notification-content">
                                            <div class="notification-name"><?php echo $item->name ?></div>
                                            <div class="notification-des"><?php echo $item->description ?></div>
                                        </div>
                                        <div class="notification-option">
                                            <form action="<?php echo URLROOT?>/notification/markasread" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translate(-30px, 10px);">
                                                    <img class="ico" style="width: 13px;" src="<?php echo URLROOT ?>/img/check.png" alt="" >
                                                </button>
                                            </form>

                                            <form action="<?php echo URLROOT?>/notification/deletenotification" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translateY(-8px);">
                                                    <img class="ico" style="width: 10px;" src="<?php echo URLROOT ?>/img/close.png" alt="" >
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            <?php } 

                            else if($item->notificationType == "ProjectFundNotReceived"){?> 
                                <a href="<?php echo URLROOT?>/request/vieworganizationrequest/<?php echo $item->data?>">
                                    <div class="notification" >
                                        <div class="notification-content">
                                            <div class="notification-name"><?php echo $item->name ?></div>
                                            <div class="notification-des"><?php echo $item->description ?></div>
                                        </div>
                                        <div class="notification-option">
                                            <form action="<?php echo URLROOT?>/notification/markasread" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translate(-30px, 10px);">
                                                    <img class="ico" style="width: 13px;" src="<?php echo URLROOT ?>/img/check.png" alt="" >
                                                </button>
                                            </form>

                                            <form action="<?php echo URLROOT?>/notification/deletenotification" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translateY(-8px);">
                                                    <img class="ico" style="width: 10px;" src="<?php echo URLROOT ?>/img/close.png" alt="" >
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            <?php } 

                            else if($item->notificationType == "ScholarshipNotReceived"){?> 
                                <a href="<?php echo URLROOT?>/request/vieworganizationrequest/<?php echo $item->data?>">
                                    <div class="notification" >
                                        <div class="notification-content">
                                            <div class="notification-name"><?php echo $item->name ?></div>
                                            <div class="notification-des"><?php echo $item->description ?></div>
                                        </div>
                                        <div class="notification-option">
                                            <form action="<?php echo URLROOT?>/notification/markasread" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translate(-30px, 10px);">
                                                    <img class="ico" style="width: 13px;" src="<?php echo URLROOT ?>/img/check.png" alt="" >
                                                </button>
                                            </form>

                                            <form action="<?php echo URLROOT?>/notification/deletenotification" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translateY(-8px);">
                                                    <img class="ico" style="width: 10px;" src="<?php echo URLROOT ?>/img/close.png" alt="" >
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            <?php } 

                            else if($item->notificationType == "BenefactionNotReceived"){?> 
                                <a href="<?php echo URLROOT?>/request/vieworganizationrequest/<?php echo $item->data?>">
                                    <div class="notification" >
                                        <div class="notification-content">
                                            <div class="notification-name"><?php echo $item->name ?></div>
                                            <div class="notification-des"><?php echo $item->description ?></div>
                                        </div>
                                        <div class="notification-option">
                                            <form action="<?php echo URLROOT?>/notification/markasread" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translate(-30px, 10px);">
                                                    <img class="ico" style="width: 13px;" src="<?php echo URLROOT ?>/img/check.png" alt="" >
                                                </button>
                                            </form>

                                            <form action="<?php echo URLROOT?>/notification/deletenotification" method="post">
                                                <input type="text" name="notification_ID" hidden value="<?php echo $item->notificationID ?>">
                                                <button class="notification-opt-btn" type="submit" style="border: none; outline: none; transform: translateY(-8px);">
                                                    <img class="ico" style="width: 10px;" src="<?php echo URLROOT ?>/img/close.png" alt="" >
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </a>
                            <?php } ?>

                        <?php }?>
                    </div>
                    <img class="ico" src="<?php echo URLROOT ?>/img/bell-regular.svg" alt="" onclick="notificationToggle()">
                </div>
                   
                <div class="profile" >
                    <img class="ico" src="<?php echo URLROOT ?>/img/woman.jpg" onclick="toggleMenu()">
            

                </div>
                
                <?php if($_SESSION['user_type']== 'student') : ?>
                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <div class="user-info">
                           <img src="<?php echo URLROOT ?>/img/woman.jpg">
                           <h2>Hello <?php print_r( $_SESSION['user_name']) ?>!</h2>
                           <p><?php print_r( $_SESSION['user_email']) ?></p>
                          
                        </div>
                        <hr>
                        <a href="<?php echo URLROOT ?>/student/editProfile" class="sub-menu-link">
                        <!-- <a href="#" class="sub-menu-link"> -->
                            <img src="<?php echo URLROOT ?>/img/pen-to-square-solid.svg">
                            <p>Edit Profile</p>
                            <span>></span>
                        </a>
                        <a href="#" class="sub-menu-link">
                        <img src="<?php echo URLROOT ?>/img/settings.svg">
                            <p>Settings</p>
                            <span>></span>
                        </a>
                        <a href="#" class="sub-menu-link">
                        <img src="<?php echo URLROOT ?>/img/handshake.svg">
                            <p>Help</p>
                            <span>></span>
                        </a>
                        <!-- <a href="#" class="sub-menu-link"> -->
                        <a href="<?php echo URLROOT ?>/users/logout" onclick="confirmLogout(event)"  class="sub-menu-link">
                        <img src="<?php echo URLROOT ?>/img/logout.svg">
                            <p>Log Out</p>
                            <span>></span>
                        </a>
                    </div>
                </div>
                <?php endif; ?>
             
            </div>
        </div>
    </div>
</div>

<script>
    function navToggle() {
        console.log("pushed")
        var element;
        element = document.querySelector('.sidenav');
        element.classList.toggle("sidenav-toggled");
    }

    function notificationToggle() {
        console.log("pushed")
        var element;
        element = document.querySelector('.notification-area');
        element.classList.toggle("notification-area-active");
    }
</script>