<?php 
    // echo 'connect';
    try {
        if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
            $id = htmlspecialchars($_GET['id'],ENT_QUOTES);
        } else {
            // header("location: admin-page.php");
            echo 'not';
            exit();
        }
        require('./Service/connect_sql.php');
        
        $stmt = $conn->stmt_init();
        $query = "DELETE FROM users WHERE user_id=? LIMIT 1";
        $stmt->prepare($query);

        $stmt->bind_param("i",$id);

        $stmt->execute();
        if ($stmt->affected_rows == 1) {
            echo '<h3 class= "text-center">The record has been deleted. </h3>';
        } else {
            echo '<p class="text-center">The record not could be deleted. </p>';
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        print("An Exception occurred.Message: ") . $e->getMessage();
    }
?>