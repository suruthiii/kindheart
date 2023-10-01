<?php require APPROOT.'/views/inc/header.php'; ?>
    <!--  TOP NAVIGATION  -->
    <?php require APPROOT.'/views/inc/components/topnavbar.php'; ?>

    <div class="form-container">
        <h1>Sign up</h1>
        <?php if (!empty($data['err'])){?>
        <div class="error-msg">
            <span class="form-invalid"><?php echo $data["err"] ?></span>
        </div>
        <?php } ?>

        <a href="<?php echo URLROOT ?>/users/studentRegister">Student</a><br>
        <a href="<?php echo URLROOT ?>/users/donorRegister">Donor</a><br>
        <a href="<?php echo URLROOT ?>/users/organizationRegister">Organization</a>
    </div>
<?php require APPROOT.'/views/inc/footer.php'; ?>
