<?php
    try {
        require('./Service/connect_sql.php');
        if ($conn->connect_error) {
            die("Connection faile :" .$conn->connect_error);
        }
    
    $name = $_POST['admin_name'];
    $password = $_POST['admin_pass'];

    $query = "SELECT admin_name, admin_pass FROM admin WHERE admin_name = '".$name."'";
    $result = $conn->query($query);
    $count = $result->num_rows;
    $row = $result->fetch_array(MYSQLI_NUM);
    if($count == 1){
        if(password_verify($password, $row[1])){
            session_start();
            $_SESSION["admin"] = $name;
            header("location: ../admin-page.html");
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
