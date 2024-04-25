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
                    <div class="notification-count" style="background-color: red; border-radius: 50px; color: white; padding: 4px 6px 3px 6px; font-size: 8px; position: absolute; right: 115px; top: 32px">
                        <?php echo $other_data['notification_count']; ?>
                    </div>

                    <div class="notification-area">
                        <?php foreach($other_data['notifications'] as $item) {
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
                                <a href="<?php echo URLROOT?>/request/viewcomplaint?complaint_ID=<?php echo $item->data?>">
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
                            <?php }?>
                        <?php }?>
                    </div>
                    <img class="ico" src="<?php echo URLROOT ?>/img/bell-regular.svg" alt="" onclick="notificationToggle()">
                </div>
                   
                <div class="profile">
                    <img class="ico" src="<?php echo URLROOT ?>/img/woman.jpg" alt="">
                </div>
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