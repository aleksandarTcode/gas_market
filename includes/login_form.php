
<?php
include ("includes/header.php")
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-5">
            <h1 class="display-4 text-center">Create account</h1>
            <form action="register.php" method="post">

                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" name="username" type="text" id="username" placeholder="Enter Username" maxlength="30" value="<?php echo $_SESSION['username']; ?>"><span class="error"><?php echo $usernameErr;?></span>
                </div>


                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" name="password" type="password" id="password" placeholder="Enter password" maxlength="30" value="<?php echo $_SESSION['password']; ?>"><span class="error"><?php echo $passwordErr;?></span>
                </div>

                <button class="btn btn-primary btn-block" type="submit" name="login">Login</button>
                <a href="register.php" class="btn btn-success btn-block" name="register">Register</a>

            </form>
        </div>
    </div>
</div>


<?php
include ("includes/footer.php");
?>