<div class="sidenav">
    <div class="container">
        <div class="logo"><img src="<?php echo URLROOT ?>/img/logo.jpg" alt=""></div>
        <a class="sidenav-close-btn" onclick="navToggle()">X</a>
        <div class="items">
            <a href="<?php echo URLROOT ?>/admin/index">
                <?php if ($section == 'dashboard'){?>
                    <div class="selected-item">Dashboard</div>
                <?php }
                else{ ?>
                    <div class="item">Dashboard</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/admin/necessity">
                <?php if ($section == 'necessities'){?>
                    <div class="selected-item">Necessities</div>
                <?php }
                else{ ?>
                    <div class="item">Necessities</div>
                <?php } ?>
            </a>
            
            <a href="<?php echo URLROOT ?>/admin/project">
                <?php if ($section == 'projects'){?>
                    <div class="selected-item">Projects</div>
                <?php }
                else{ ?>
                    <div class="item">Projects</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/admin/scholarship">
                <?php if ($section == 'scholarships'){?>
                    <div class="selected-item">Scholarships</div>
                <?php }
                else{ ?>
                    <div class="item">Scholarships</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/admin/benefaction">
                <?php if ($section == 'benefactions'){?>
                    <div class="selected-item">Benefactions</div>
                <?php }
                else{ ?>
                    <div class="item">Benefactions</div>
                <?php } ?>
            </a>
            
            <a href="<?php echo URLROOT ?>/admin/successStory">
                <?php if ($section == 'successStories'){?>
                    <div class="selected-item">Success Stories</div>
                <?php }
                else{ ?>
                    <div class="item">Success Stories</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/admin/user">
                <?php if ($section == 'users'){?>
                    <div class="selected-item">Users</div>
                <?php }
                else{ ?>
                    <div class="item">Users</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/admin/request">
                <?php if ($section == 'requests'){?>
                    <div class="selected-item">Requests</div>
                <?php }
                else{ ?>
                    <div class="item">Requests</div>
                <?php } ?>
            </a>
            
            <a href="<?php echo URLROOT ?>/admin/report">
                <?php if ($section == 'reports'){?>
                    <div class="selected-item">Reports</div>
                <?php }
                else{ ?>
                    <div class="item">Reports</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/admin/complaint">
                <?php if ($section == 'complaints'){?>
                    <div class="selected-item">Complaints</div>
                <?php }
                else{ ?>
                    <div class="item">Complaints</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/admin/logOut">
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