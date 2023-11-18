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
            
            <a href="<?php echo URLROOT ?>/users/viewProfile">
                <?php if ($section == 'profile'){?>
                    <div class="selected-item">Profile</div>
                <?php }
                else{ ?>
                    <div class="item">Profile</div>
                <?php } ?>
            </a>

            <a href="">
                <?php if ($section == 'dashboard'){?>
                    <div class="selected-item">Dashboard</div>
                <?php }
                else{ ?>
                    <div class="item">Dashboard</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/parkingOwner/lands">
                <?php if ($section == 'donor'){?>
                    <div class="selected-item">Donor</div>
                <?php }
                else{ ?>
                    <div class="item">Donor</div>
                <?php } ?>
            </a>
            
            <a href="<?php echo URLROOT ?>/users/viewProfile">
                <?php if ($section == 'profile'){?>
                    <div class="selected-item">Profile</div>
                <?php }
                else{ ?>
                    <div class="item">Profile</div>
                <?php } ?>
            </a>

            <a href="">
                <?php if ($section == 'dashboard'){?>
                    <div class="selected-item">Dashboard</div>
                <?php }
                else{ ?>
                    <div class="item">Dashboard</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/parkingOwner/lands">
                <?php if ($section == 'lands'){?>
                    <div class="selected-item">Lands</div>
                <?php }
                else{ ?>
                    <div class="item">Lands</div>
                <?php } ?>
            </a>
            
            <a href="<?php echo URLROOT ?>/users/viewProfile">
                <?php if ($section == 'profile'){?>
                    <div class="selected-item">Profile</div>
                <?php }
                else{ ?>
                    <div class="item">Profile</div>
                <?php } ?>
            </a>

            <a href="">
                <?php if ($section == 'dashboard'){?>
                    <div class="selected-item">Dashboard</div>
                <?php }
                else{ ?>
                    <div class="item">Dashboard</div>
                <?php } ?>
            </a>

            <a href="<?php echo URLROOT ?>/parkingOwner/lands">
                <?php if ($section == 'lands'){?>
                    <div class="selected-item">Lands</div>
                <?php }
                else{ ?>
                    <div class="item">Lands</div>
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