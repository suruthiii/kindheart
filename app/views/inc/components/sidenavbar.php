<div class="sidenav">
    <div class="container">
        <div class="logo"><img src="<?php echo URLROOT ?>/img/logo.jpg" alt=""></div>
        <a class="sidenav-close-btn" onclick="navToggle()">X</a>
        <div class="items">

            <!------------------------- Admin ------------------------->
            <?php if ($_SESSION['user_type'] == 'admin'){ ?>
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

                <a href="<?php echo URLROOT ?>/users/logout">
                    <?php if ($section == 'logOut'){?>
                        <div class="selected-item">Log Out</div>
                    <?php }
                    else{ ?>
                        <div class="item">Log Out</div>
                    <?php } ?>
                </a>
            <?php } ?>   

            <!------------------- Super Admin ------------------>
            <?php if ($_SESSION['user_type'] == 'superAdmin'){ ?>
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

                <a href="<?php echo URLROOT ?>/superadmin/scholarship">
                    <?php if ($section == 'scholarships'){?>
                        <div class="selected-item">Scholarships</div>
                    <?php }
                    else{ ?>
                        <div class="item">Scholarships</div>
                    <?php } ?>
                </a>
                
                <a href="<?php echo URLROOT ?>/superadmin/benefaction">
                    <?php if ($section == 'benefactions'){?>
                        <div class="selected-item">Benefactions</div>
                    <?php }
                    else{ ?>
                        <div class="item">Benefactions</div>
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

                <a href="<?php echo URLROOT ?>/superadmin/user">
                    <?php if ($section == 'users'){?>
                        <div class="selected-item">Users</div>
                    <?php }
                    else{ ?>
                        <div class="item">Users</div>
                    <?php } ?>
                </a>

                <a href="<?php echo URLROOT ?>/superadmin/request">
                    <?php if ($section == 'requests'){?>
                        <div class="selected-item">Requests</div>
                    <?php }
                    else{ ?>
                        <div class="item">Requests</div>
                    <?php } ?>
                </a>

                <a href="<?php echo URLROOT ?>/superadmin/report">
                    <?php if ($section == 'reports'){?>
                        <div class="selected-item">Reports</div>
                    <?php }
                    else{ ?>
                        <div class="item">Reports</div>
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
            <?php } ?>
            
            <!------------------- Student ------------------>



            <?php if ($_SESSION['user_type'] == 'student'){ ?>
                <a href="<?php echo URLROOT ?>/student/index">
                    <?php if ($section == 'dashboard'){?>
                        <div class="selected-item">Dashboard</div>
                    <?php }
                    else{ ?>
                        <div class="item">Dashboard</div>
                    <?php } ?>
                </a>


                <a href="<?php echo URLROOT ?>/student/neccessities">
                    <?php if ($section == 'student'){?>
                        <div class="selected-item">Necessities</div>
                    <?php }
                    else{ ?>
                        <div class="item">Necessities</div>
                    <?php } ?>
                </a>
            


                <a href="#2">
                    <?php if ($section == 'scholarships'){?>
                        <div class="selected-item">Scholarships</div>
                    <?php }
                    else{ ?>
                        <div class="item">Scholarships</div>
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

                <a href="<?php echo URLROOT ?>/student/successstory">
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
                
                <a href="#6">
                    <?php if ($section == 'editprofile'){?>
                        <div class="selected-item">Edit Profile</div>
                    <?php }
                    else{ ?>
                        <div class="item">Edit Profile</div>
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
            <?php } ?>

            <!------------------- Organization ------------------>
            <?php if ($_SESSION['user_type'] == 'organization'){ ?>
                <a href="<?php echo URLROOT ?>/organization/choosethenecessityType">
                    <?php if ($section == 'necessities'){?>
                        <div class="selected-item">Necessities</div>
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

                <a href="<?php echo URLROOT ?>/organization/successstory">
                    <?php if ($section == 'successStories'){?>
                        <div class="selected-item">Success Stories</div>
                    <?php }
                    else{ ?>
                        <div class="item">Success Stories</div>
                    <?php } ?>
                </a>

                <a href="<?php echo URLROOT ?>/organization/viewdonors">
                    <?php if ($section == 'donors'){?>
                        <div class="selected-item">Donors</div>
                    <?php }
                    else{ ?>
                        <div class="item">Donors</div>
                    <?php } ?>
                </a>

                <a href="<?php echo URLROOT ?>/organization/complaint">
                    <?php if ($section == 'complaint'){?>
                        <div class="selected-item">Complaint</div>
                    <?php }
                    else{ ?>
                        <div class="item">Complaint</div>
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

                
                <a href="<?php echo URLROOT ?>/users/logOut">
                    <?php if ($section == 'logOut'){?>
                        <div class="selected-item">Log Out</div>
                    <?php }
                    else{ ?>
                        <div class="item">Log Out</div>
                    <?php } ?>
                </a>
            <?php } ?>

            <!------------------- Donor ------------------>
            <?php if ($_SESSION['user_type'] == 'donor'){ ?>
                <a href="<?php echo URLROOT ?>/donor/necessity">
                    <?php if ($section == 'necessities'){?>
                        <div class="selected-item">Necessities</div>
                    <?php }
                    else{ ?>
                        <div class="item">Necessities</div>
                    <?php } ?>
                </a>
                
                <a href="<?php echo URLROOT ?>/donor/project">
                    <?php if ($section == 'projects'){?>
                        <div class="selected-item">Projects</div>
                    <?php }
                    else{ ?>
                        <div class="item">Projects</div>
                    <?php } ?>
                </a>

                <a href="<?php echo URLROOT ?>/donor/scholarship">
                    <?php if ($section == 'scholarships'){?>
                        <div class="selected-item">Scholarships</div>
                    <?php }
                    else{ ?>
                        <div class="item">Scholarships</div>
                    <?php } ?>
                </a>

                <a href="<?php echo URLROOT ?>/donor/benefaction">
                    <?php if ($section == 'benefactions'){?>
                        <div class="selected-item">Benefactions</div>
                    <?php }
                    else{ ?>
                        <div class="item">Benefactions</div>
                    <?php } ?>
                </a>

                <a href="<?php echo URLROOT ?>/donor/successStory">
                    <?php if ($section == 'successStories'){?>
                        <div class="selected-item">Success Stories</div>
                    <?php }
                    else{ ?>
                        <div class="item">Success Stories</div>
                    <?php } ?>
                </a>

                <a href="<?php echo URLROOT ?>/donor/viewdonors">
                    <?php if ($section == 'donors'){?>
                        <div class="selected-item">Donees</div>
                    <?php }
                    else{ ?>
                        <div class="item">Donees</div>
                    <?php } ?>
                </a>

                <a href="<?php echo URLROOT ?>/donor/complaint">
                    <?php if ($section == 'complaint'){?>
                        <div class="selected-item">Complaint</div>
                    <?php }
                    else{ ?>
                        <div class="item">Complaint</div>
                    <?php } ?>
                </a>
                
                <a href="<?php echo URLROOT ?>/donor/editprofile">
                    <?php if ($section == 'editprofile'){?>
                        <div class="selected-item">Edit Profile</div>
                    <?php }
                    else{ ?>
                        <div class="item">Edit Profile</div>
                    <?php } ?>
                </a>

                <a href="<?php echo URLROOT ?>/users/logout">
                    <?php if ($section == 'logOut'){?>
                        <div class="selected-item">Log Out</div>
                    <?php }
                    else{ ?>
                        <div class="item">Log Out</div>
                    <?php } ?>
                </a>
            <?php } ?>  
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

