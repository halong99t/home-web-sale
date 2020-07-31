<?php
    try {
        require('./Service/connect_sql.php');
        if ($conn->connect_error) {
            die("Connection faile :" .$conn->connect_error);
        }
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT user_mail, user_pass FROM users WHERE user_mail = '".$email."'";
    $result = $conn->query($query);
    $count = $result->num_rows;
    $row = $result->fetch_array(MYSQLI_NUM);
    if($count == 1){
        if(password_verify($password, $row[1])){
            session_start();
            $_SESSION["user"] = $email;
            // header("location: admin-page.php");
            echo "oce";
            exit();
        }
        else{
            $errorstring = "<p class='text-center col-sm-8' style='color:red' ";
            $errorstring .= "Invalid pasword!<br /> Re-enter password.</p>";
            echo $errorstring;
        }

    }else{
        $errorstring = "<p class='text-center col-sm-8' style='color:red'>";
        $errorstring .="Invalid account!<br /> You could not login.</p>";
        echo $errorstring;
    }
    
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(),"\n";
    }
?>