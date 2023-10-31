<html>
    <head>
        <title><?php echo SITENAME ?></title>

        <!-- External CSS -->
        <link rel="stylesheet" href="<?php echo URLROOT ?>/css/components/login.css">
    </head>
    <body>

    <div class="container">
        <div class="image">
            <img src="images/setps.jpg" alt="Set Password" id="password">
        </div>
        <div class="formc">
            <div class="formce">
                <img src="images/logo.png" alt="Logo_Image" id="logo">
            
                <h1>Welcome Back!</h1>
                <span style="color: rgb(146, 141, 141);">Create a password for your account</span>     
                <div class="text">
                    <form action="#">
                        <div class="input-field">
                            <label for="username" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Username</label><br><br>
                            <input class="inputt" type="username" name="psw" required><br><br>
                            <label for="password" style="color: rgb(146, 141, 141); margin-top: 30px !important;">Password</label><br><br>
                            <input class="inputt" type="password" name="conf-psw" required><br><br>
                            <label for="forget-password" style="color: rgb(146, 141, 141); margin-top: 30px !important;"><a href="#">Forget Password?</a></label><br><br>
                        </div>
                        <div>
                            <label>
                                <input type="checkbox" checked="checked" name="remember"> Remember me
                            </label>
                        </div>
                        <button type="submit" id="Login">Login</button>
                    </form>
                </div>
               
            </div>  
        </div>
    </div>