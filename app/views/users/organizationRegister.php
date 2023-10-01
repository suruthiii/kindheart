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

    <form action="<?php echo URLROOT ?>/users/register" method="post">
        <!-- Name -->
        <div class="form-input-title">Name:</div>
        <input type="text" name="name" id="name" required value="<?php echo $data['name'] ?>" />

        <!-- Email -->
        <div class="form-input-title">Email:</div>
        <input type="email" name="email" id="email" required value="<?php echo $data['email'] ?>" />

        <!-- Password -->
        <div class="form-input-title">Password:</div>
        <input type="password" name="password" id="password" required />

        <!-- Password Strength Indicator -->
        <div class="strength-text" id="strength-text"></div>


        <!-- Confirm Password -->
        <div class="form-input-title">Confirm Password:</div>
        <input type="password" name="confirm_password" id="confirm_password" required />


        <!-- Hidden Input for User Type -->
        <input type="hidden" name="user_type" id="user_type" value="organization" />

        <br><br>

        <!-- Submit -->
        <input type="submit" value="Submit">
    </form>
</div>
<?php require APPROOT.'/views/inc/footer.php'; ?>
