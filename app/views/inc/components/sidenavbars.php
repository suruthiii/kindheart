<div class="sidenav">
    <div class="container">
        <div class="logo"><img src="<?php echo URLROOT ?>/img/logo.jpg" alt=""></div>
        <a class="sidenav-close-btn" onclick="navToggle()">X</a>
        <div class="items">
            <a href="<?php echo URLROOT ?>/superadmin/index">
                <?php if ($section == 'dashboard'){?>
                    <div class="selected-item">Dashboard</div>
                <?php }
                else{ ?>
                    <div class="item">Dashboard</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/superadmin/admin">
                <?php if ($section == 'admins'){?>
                    <div class="selected-item">Admins</div>
                <?php }
                else{ ?>
                    <div class="item">Admins</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/superadmin/necessity">
                <?php if ($section == 'necessities'){?>
                    <div class="selected-item">Necessities</div>
                <?php }
                else{ ?>
                    <div class="item">Necessities</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/superadmin/project">
                <?php if ($section == 'projects'){?>
                    <div class="selected-item">Projects</div>
                <?php }
                else{ ?>
                    <div class="item">Projects</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/superadmin/user">
                <?php if ($section == 'users'){?>
                    <div class="selected-item">Users</div>
                <?php }
                else{ ?>
                    <div class="item">Users</div>
                <?php } ?>
            </a>
            
            <a href="<?php echo URLROOT ?>/superadmin/successStory">
                <?php if ($section == 'successStories'){?>
                    <div class="selected-item">Success Stories</div>
                <?php }
                else{ ?>
                    <div class="item">Success Stories</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/superadmin/complaint">
                <?php if ($section == 'complaints'){?>
                    <div class="selected-item">Complaints</div>
                <?php }
                else{ ?>
                    <div class="item">Complaints</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/users/logOut">
                <?php if ($section == 'logOut'){?>
                    <div class="selected-item">Log Out</div>
                <?php }
                else{ ?>
                    <div class="item">Log Out</div>
                <?php } ?>
            </a>
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