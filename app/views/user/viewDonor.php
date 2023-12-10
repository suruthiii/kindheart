<?php require APPROOT.'/views/inc/header.php'; ?>

<!--  SIDE NAVIGATION  -->
<?php $section = "viewAdminNecessity";?>
<?php require APPROOT.'/views/inc/components/sidenavbar.php'; ?>

<main class="page-container">
    <section class="section" id="main">
        <div class="container">
            <div class="back-arrow-btn">
                <a href="<?php echo URLROOT ?>/admin/user">
                    <table>
                        <tr>
                            <td width="30%"><img class="back-arrow-img" src="<?php echo URLROOT ?>/img/back-arrow.png" alt=""></td>
                            <td width="70%">Go Back</td>
                        </tr>
                    </table>
                </a>
            </div>

            <h3 style="margin-top: 25px">View Donors</h3>
            <p style="margin-left: 10px">View the list of donors</p>

            <div class="user-list">
                <div class="user-list-title">
                    <h4>Donor name</h4>
                </div>

                <div class="user-list-items">
                    <table>
                        <!-- Donor 1 -->
                        <tr class="user-list-item">
                            <td width="60%" class="user-name">
                                <h4>Lizzie Mayor</h4>
                            </td>
                            <td width="20%" class="view-btn-container">
                                <button class="view-btn">View</button>
                            </td>
                            <td width="20%" class="remove-btn-container">
                                <button class="remove-btn">Remove</button>
                            </td>
                        </tr>
                        
                        <!-- Donor 2 -->
                        <tr class="user-list-item">
                            <td width="60%" class="user-name">
                                <h4>Lizzie Mayor</h4>
                            </td>
                            <td width="20%" class="view-btn-container">
                                <button class="view-btn">View</button>
                            </td>
                            <td width="20%" class="remove-btn-container">
                                <button class="remove-btn">Remove</button>
                            </td>
                        </tr>

                        <!-- Donor 3 -->
                        <tr class="user-list-item">
                            <td width="60%" class="user-name">
                                <h4>Lizzie Mayor</h4>
                            </td>
                            <td width="20%" class="view-btn-container">
                                <button class="view-btn">View</button>
                            </td>
                            <td width="20%" class="remove-btn-container">
                                <button class="remove-btn">Remove</button>
                            </td>
                        </tr>

                        <!-- Donor 4 -->
                        <tr class="user-list-item">
                            <td width="60%" class="user-name">
                                <h4>Lizzie Mayor</h4>
                            </td>
                            <td width="20%" class="view-btn-container">
                                <button class="view-btn">View</button>
                            </td>
                            <td width="20%" class="remove-btn-container">
                                <button class="remove-btn">Remove</button>
                            </td>
                        </tr>

                        <!-- Donor 5 -->
                        <tr class="user-list-item">
                            <td width="60%" class="user-name">
                                <h4>Lizzie Mayor</h4>
                            </td>
                            <td width="20%" class="view-btn-container">
                                <button class="view-btn">View</button>
                            </td>
                            <td width="20%" class="remove-btn-container">
                                <button class="remove-btn">Remove</button>
                            </td>
                        </tr>

                        <!-- Donor 6 -->
                        <tr class="user-list-item">
                            <td width="60%" class="user-name">
                                <h4>Lizzie Mayor</h4>
                            </td>
                            <td width="20%" class="view-btn-container">
                                <button class="view-btn">View</button>
                            </td>
                            <td width="20%" class="remove-btn-container">
                                <button class="remove-btn">Remove</button>
                            </td>
                        </tr>
                    </table>  
                </div>     
            </div>
        </div>
    </section>
</main>

<?php require APPROOT.'/views/inc/footer.php'; ?>
