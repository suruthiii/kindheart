<div class="sidenav">
    <div class="container">
        <div class="user">
            <img src="<?php echo URLROOT ?>/img/Bitmap.png" alt="Profile_Picture">
            <div class="userName">
                <h3>Samantha</h3>
            </div>
            <div class="email">
                <h5>samanthabadhra@gmail.com</h5>
            </div>
        </div>
        <a class="sidenav-close-btn" onclick="navToggle()">X</a>
        <div class="items">
            <a href="<?php echo URLROOT ?>/organization/postednecessities" class="child1">
                <?php 
                $section = isset($section) ? $section : '';
                if ($section == 'necessities'){?>
                    <div class="selected-item" style="color: #fff;">Necessities</div>
                <?php }
                else{ ?>
                    <div class="item">Necessities</div>
                <?php } ?>
            </a>
            
            <a href="#2">
                <?php if ($section == 'projects'){?>
                    <div class="selected-item">Projects</div>
                <?php }
                else{ ?>
                    <div class="item">Projects</div>
                <?php } ?>
            </a>

            <a href="#3">
                <?php if ($section == 'benefactions'){?>
                    <div class="selected-item">Benefactions</div>
                <?php }
                else{ ?>
                    <div class="item">Benefactions</div>
                <?php } ?>
            </a>

            <a href="#4">
                <?php if ($section == 'successStories'){?>
                    <div class="selected-item">Success Stories</div>
                <?php }
                else{ ?>
                    <div class="item">Success Stories</div>
                <?php } ?>
            </a>

            <a href="#5">
                <?php if ($section == 'donors'){?>
                    <div class="selected-item">Donors</div>
                <?php }
                else{ ?>
                    <div class="item">Donors</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/organization/editprofile">
                <?php if ($section == 'editprofile'){?>
                    <div class="selected-item">Edit Profile</div>
                <?php }
                else{ ?>
                    <div class="item">Edit Profile</div>
                <?php } ?>
            </a>

            <a href="#7">
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