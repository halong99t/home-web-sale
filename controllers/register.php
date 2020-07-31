<?php
    try {
        require('./Service/connect_sql.php');
        if ($conn->connect_error) {
            die("Connection faile :" .$conn->connect_error);
        }
    
    $user_name = $_POST['new_user'];
    $user_email = $_POST['new_email'];
    $user_pass = $_POST['new_pass'];
    $hashed_passcode = password_hash($user_pass,PASSWORD_DEFAULT);
    
    $insert = "INSERT INTO users (user_name,user_mail,user_pass) ";
    $insert .= "VALUES(?,?,?)";
    $stmt = $conn->prepare($insert);
    $stmt->bind_param("sss",$user_name,$user_email,$hashed_passcode);
    echo '1';
    if ($stmt->execute()) {
        echo 'insert oce';
        exit();
    } else {
        echo 'insert not oce';
        exit();
    }
    
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(),"\n";
    }
    $conn->close();
    $stmt->close();
?>