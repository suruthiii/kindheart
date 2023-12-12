<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  TOP NAVIGATION  -->
<?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "reports";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <h3>Reports</h3>
            <p style="margin-left: 10px">Generate various reports</p>
            
            <div class="report-list">
                <div class="report-cards">

                    <!-- Card 1 -->
                    <a href="">
                        <div class="report-card">
                            <table>
                                <tr>
                                    <td width="50%" class="report-name">Report 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="view-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="view" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="download-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="download" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/download-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>

                    <!-- Card 2 -->
                    <a href="">
                        <div class="report-card">
                            <table>
                                <tr>
                                    <td width="50%" class="report-name">Report 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="view-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="view" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="download-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="download" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/download-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>

                     <!-- Card 3 -->
                     <a href="">
                        <div class="report-card">
                            <table>
                                <tr>
                                    <td width="50%" class="report-name">Report 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="view-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="view" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="download-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="download" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/download-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>

                    <!-- Card 4 -->
                    <a href="">
                        <div class="report-card">
                            <table>
                                <tr>
                                    <td width="50%" class="report-name">Report 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="view-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="view" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="download-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="download" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/download-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>

                     <!-- Card 5 -->
                     <a href="">
                        <div class="report-card">
                            <table>
                                <tr>
                                    <td width="50%" class="report-name">Report 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="view-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="view" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="download-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="download" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/download-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>

                    <!-- Card 6 -->
                    <a href="">
                        <div class="report-card">
                            <table>
                                <tr>
                                    <td width="50%" class="report-name">Report 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="view-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="view" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="download-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="download" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/download-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>
                    
                    <!-- Card 7 -->
                    <a href="">
                        <div class="report-card">
                            <table>
                                <tr>
                                    <td width="50%" class="report-name">Report 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="view-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="view" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="download-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="download" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/download-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>

                    <!-- Card 8 -->
                    <a href="">
                        <div class="report-card">
                            <table>
                                <tr>
                                    <td width="50%" class="report-name">Report 1</td>
                                    <td width="50%" class="option">
                                        <form action="<?php echo URLROOT ?>" method="post" class="view-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="view" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/eye-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="download-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="download" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/download-solid.svg" alt="">
                                            </button>
                                        </form>
                                        <form action="<?php echo URLROOT ?>" method="post" class="delete-form">
                                            <input type="text" name="name" id="name" hidden value="" />
                                            <button type="submit" class="delete" onclick="return confirmSubmit();">
                                                <img src="<?php echo URLROOT ?>/img/trash-solid.svg" alt="">
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </a>

                </div>
            </div>
            
            <!-- <div class="add-report-btn-container">
                <button class="add-report-btn">
                    <span class="plus">+</span> 
                    &nbsp;Add Reports
                </button>
            </div> -->

            <div class="right-content">
                
                <h3 style="margin-top: 30px; text-align:center; margin-left: 0;">Add Reports</h3>
                
                <form action="" class="add-report-form">
                    <label for="report-name">Report Name</label><br>
                    <input type="text" id="report-name" name="report-name"><br><br>
                    <label for="criteria">Criteria</label><br>
                    <input type="text" id="criteria" name="criteria"><br><br>
                    <label for="sdate">Start Date</label><br>
                    <input type="date" id="sdate" name="sdate"><br><br>
                    <label for="edate">End Date</label><br>
                    <input type="date" id="edate" name="edate"><br><br>
                    <input type="submit" value="Generate">
                </form>
                
            </div>
            
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
