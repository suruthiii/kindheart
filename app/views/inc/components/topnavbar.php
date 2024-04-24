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

                    <div class="notification-area" style="box-shadow: 0 0 10px 0.1px gray; border-radius: 10px; padding: 10px; width: 100px; position: absolute; right: 20px; top: 70px; z-index: 100;">
                        <?php foreach($other_data['notifications'] as $item) {?> 
                            <div class="notification">
                            </div>
                        <?php }?>
                    </div>
                    <img class="ico" src="<?php echo URLROOT ?>/img/bell-regular.svg" alt="">
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
</script>