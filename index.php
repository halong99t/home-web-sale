<?php 
if ($_SERVER['REQUEST_METHOD']== 'POST'){
    require('register.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/yourcode.js"></script>
    <title>Login</title>
</head>
<body>
    <div>
            <a class="btn" href="login-admin.php">Admin</a>
    </div>
    <div class="modal-dialog text-center">
        <div class="col-sm-12 main-section">
            <div class="modal-content">
                <div class="col-12 user-img">
                    <img src="./img/user (2).png" class="img-user" alt="">
                    <div class="in-up">
                        <div style="margin-left: 0px;">
                            <button type="submit" class="btn" onclick="login()" ><i class="fas fa-sign-in-alt"></i>Sign In</button>
                        </div>
                        <div><button type="submit" class="btn" onclick="register()" ><i class="fas fa-sign-in-alt"></i>Sign Up</button></div>
                        
                    </div>
                    <div >
                        <label id="alert-check"></label>
                        <form id="login" action="./controllers/check-login.php" class="col-12" method="post" onsubmit="validData()">
                            <div class="form-group">
                                <input type="text" id="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                            </div>
                            <button type="submit" onclick="return validData()" class="btn"><i class="fas fa-sign-in-alt"></i>Login</button>
                        </form>
                        <form id="register" action="./controllers/register.php" class="col-12" method="post">
                            <div class="form-group">
                                <input type="text" name="new_user" class="form-control" placeholder="UserName">
                            </div>
                            <div class="form-group">
                                <input type="text" name="new_email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" name="new_pass" class="form-control" placeholder="Password">
                            </div>
                            <button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i>Register</button>
                        </form>
                    </div>

                    <div class="col-12 forgot">
                        <a style="text-decoration: none;" href="#">Forgot Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var x = document.getElementById("register")
        var y = document.getElementById("login")
        function register(){
            x.style.display = "inline";
            y.style.display = "none";
        }
        function login(){
            y.style.display = "inline";
            x.style.display = "none";
        }

        function validData() {
            if (document.getElementById("email").value === "" || document.getElementById("password").value === "") {
                document.getElementById("alert-check").innerHTML = "Invalid!";
                document.getElementById("alert-check").style.backgroundColor = "#f00";
                return false;
            } else {
                document.getElementById("alert-check").innerHTML = "";
                return true;
            }
        }
    </script>
</body>
</html>