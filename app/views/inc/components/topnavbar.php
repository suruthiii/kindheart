<div class="topnav">
    <div class="container">
        <div class="items">
            <a class="item menu" onclick="navToggle()"><img style="width: 20px" src="<?php echo URLROOT ?>/img/menu.svg" alt=""></i></a>
            <div class="content">
                <div class="search">
                    <input class="search-bar"  type="search" placeholder="Search...">
                    <div class="filter">
                        <img class="filter-ico" src="<?php echo URLROOT ?>/img/filter.png" alt="">
                    </div>
                </div>
                <div class="notify">
                    <img class="ico" src="<?php echo URLROOT ?>/img/bell-regular.svg" alt="">
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