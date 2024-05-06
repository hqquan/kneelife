<?php 
    include "../../admin/config/config.php";
    // Thiết lập Content Security Policy (CSP)
    header("Content-Security-Policy: default-src 'self'");
    if ($_POST['action'] === 'editUser' && isset($_POST['userId'])) {
        $userId = $_POST['userId'];

        $sql_getUser = "SELECT * FROM tbl_user WHERE userId = $userId LIMIT 1";
        $query_getUser = mysqli_query($mysqli, $sql_getUser);

        $data = mysqli_fetch_assoc($query_getUser);

        // Return the data as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    } 
    else if ($_POST['action'] === 'updateUser' && isset($_POST['editUserName'])) {
        
        $userId = $_POST['editUserId'];
        // encode special chars
        // $userName = htmlspecialchars($_POST['editUserName']);
        // $userPhone = htmlspecialchars($_POST['editUserPhone']);
        // $userEmail = htmlspecialchars($_POST['editUserEmail']);
        $userName = $_POST['editUserName'];
        $userPhone = $_POST['editUserPhone'];
        $userEmail = $_POST['editUserEmail'];
        //
        // Check email
        $sql_user = "SELECT * FROM tbl_user WHERE userEmail = '$userEmail'";
        $query_user = mysqli_query($mysqli, $sql_user);
        $count = mysqli_num_rows($query_user);
        $result = mysqli_fetch_assoc($query_user);
            
        if ($count > 0 && $result['userId'] != $userId) {
            echo 'error-email';
        } else {
            $sql_updateUser = "UPDATE tbl_user
                                SET userName='$userName', userPhone='$userPhone', userEmail='$userEmail'
                                WHERE userId='$userId'";
    
            mysqli_query($mysqli, $sql_updateUser);
            echo 1;
        }
    } 
    else if ($_POST['action'] === 'updateUserPassword' && isset($_POST['editUserOldPassword'])) {
        
        // $userId = $_POST['editUserId'];

        $userEmail = $_POST['editUserEmail'];

        $editUserOldPassword = md5($_POST['editUserOldPassword']);
        $editUserNewPassword = md5($_POST['editUserNewPassword']);

        // $sql_user = "SELECT userPassword 
        //     FROM tbl_user 
        //     WHERE userId = '$userId'";

        $sql_user = "SELECT userPassword 
                    FROM tbl_user 
                    WHERE userEmail = '$userEmail'";
                    
        $query_user = mysqli_query($mysqli, $sql_user);

        if ($row = mysqli_fetch_assoc($query_user)) {
            if ($editUserOldPassword === $row['userPassword']) {

                $sql_updateUser = "UPDATE tbl_user
                                    SET userPassword = '$editUserNewPassword'
                                    WHERE userEmail = '$userEmail'";
                                    // WHERE userId = '$userId'";

                mysqli_query($mysqli, $sql_updateUser);
                echo 1;
            } else {
                echo 'error-pass';
            }
        }
    }
?>