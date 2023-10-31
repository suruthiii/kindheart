<html>
    <head>
        <title><?php echo SITENAME ?></title>

        <!-- External CSS -->
        <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/newPassword.css">
    </head>
    <body>

<div class="container">
        <div class="image">
            <img src="images/setps.jpg" alt="Set Password" id="password">
        </div>
        <div class="formc">
            <div class="formce">
                <img src="images/logo.png" alt="Logo_Image" id="logo">
            
                <h1>Forget Password?</h1>
                <span style="color: rgb(146, 141, 141);">Reset your password</span>     
                <div class="text">
                    <form action="#">
                        <div class="input-field">
                            <label for="psw" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Enter Password</label><br><br>
                            <input class="inputt" type="password" name="psw" required><br><br>
                            <label for="conf-psw" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Confirm New Password</label><br><br>
                            <input class="inputt" type="password" name="conf-psw" required><br><br>
                            <!-- <label>
                                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
                            </label> -->
                            <!-- <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p> -->
                        </div>
                        <button type="submit" id="setPassword">Reset Password</button>
                    </form>
                </div>
               
            </div>  
        </div>
    </div>