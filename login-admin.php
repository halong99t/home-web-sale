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
        <a class="btn" href="index.php">User</a>
    </div>
    <div class="modal-dialog text-center">
        <div class="col-sm-12 main-section">
            <div class="modal-content">
                <div class="col-12 user-img">
                    <img src="./img/user (2).png" class="img-user" alt="">
                    <div >
                        <form id="login" action="./controllers/check-admin.php" class="col-12" method="post">
                            <div class="form-group">
                                <input type="text" name="admin_name" class="form-control" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="password" name="admin_pass" class="form-control" placeholder="Password">
                            </div>
                            <button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i>Login</button>
                        </form>
                    </div>

                    <div class="col-12 forgot">
                        <a style="text-decoration: none;" href="#">Forgot Password</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>