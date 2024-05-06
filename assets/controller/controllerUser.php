<?php 
    include "../../admin/config/config.php";

     //Thêm HTTPOnly cho session cookie
    ini_set('session.cookie_httponly', true);
    // Thiết lập Content Security Policy (CSP)
    header("Content-Security-Policy: default-src 'self'"); 

    if ($_POST['action'] === 'submitSignup' && isset($_POST['userEmail'])) {
         //Sử dụng hàm htmlspecialchars để encode dữ liệu chống XSS attack
        $userName = htmlspecialchars($_POST['userName']);
        $userPhone = htmlspecialchars($_POST['userPhone']);
        $userEmail = htmlspecialchars($_POST['userEmail']);
        //Không sử dụng htmlspecialchars 
        $userName = $_POST['userName'];
        $userPhone = $_POST['userPhone'];
        $userEmail = $_POST['userEmail'];
       //
        $userPassword = MD5($_POST['userPassword']);
        $userConfirmPassword = MD5($_POST['userConfirmPassword']);
        $userGroup = 'user';
        $userRegisterDate = date("Y-m-d");

        // Check email
        $sql_user = "SELECT * FROM tbl_user WHERE userEmail = '$userEmail'";
        $query_user = mysqli_query($mysqli, $sql_user);
        $count = mysqli_num_rows($query_user);
            
        if ($userPassword !== $userConfirmPassword && $count > 0) {
            echo 'error-all';
        } else if ($count > 0) {
            echo 'error-email';
        } else if ($userPassword !== $userConfirmPassword) {
            echo 'error-pass';
        } else {
            // Add user into tbl_user
            $sql_addUser = "INSERT INTO tbl_user (userName, userPhone, userEmail, userPassword, userRegisterDate, userGroup)
                        VALUE ('$userName', '$userPhone', '$userEmail', '$userPassword', '$userRegisterDate', '$userGroup')";
            $query_addUser = mysqli_query($mysqli, $sql_addUser);
            
            // Get user id
            $sql_user = "SELECT * FROM tbl_user WHERE userEmail = '$userEmail'";
            $query_user = mysqli_query($mysqli, $sql_user);
            $row_user = mysqli_fetch_assoc($query_user);
            $userId = $row_user['userId'];

            // Add user info into tbl_user_info
            $sql_addUserInfo = "INSERT INTO tbl_user_info (userId, userStreetAddress, userOptional, userCity)
                        VALUE ('$userId', '', '', '')";
            $query_addUserInfo = mysqli_query($mysqli, $sql_addUserInfo);

            session_start();
            ob_start();
            $_SESSION['submitSignup'] = $userEmail;
            $_SESSION['userId'] = $userId;
            echo 1;
        }
    }
    else if ($_POST['action'] === 'submitSignin' && isset($_POST['userEmail'])) {
        $group = 'user';
        $email = $_POST['userEmail'];
        $password = MD5($_POST['userPassword']);

        // // // Code không sử dụng prepared statement
        // $sql_user = "SELECT * 
        //             FROM tbl_user 
        //             WHERE userEmail = '$email' AND userPassword = '$password' AND userGroup = '$group' LIMIT 1";

        // $result = mysqli_query($mysqli, $sql_user);
        // $count = mysqli_num_rows($result);
        

        // Sử dụng prepared statement
        $sql_user = "SELECT * 
                    FROM tbl_user 
                    WHERE userEmail = ? AND userPassword = ? AND userGroup = ? LIMIT 1";
        // Chuẩn bị prepared statement
        $stmt = mysqli_prepare($mysqli, $sql_user);
        
        // Bind các tham số
        mysqli_stmt_bind_param($stmt, "sss", $email, $password, $group);
        
        // Thực thi truy vấn
        mysqli_stmt_execute($stmt);
        
        // Lấy kết quả
        $result = mysqli_stmt_get_result($stmt);
        
        // Đếm số dòng kết quả
        $count = mysqli_num_rows($result);

        if ($count > 0) {
            session_start();
            ob_start();
            $row = mysqli_fetch_assoc($result);
            $_SESSION['submitSignup'] = $row['userEmail'];
            $_SESSION['userId'] = $row['userId'];
            // echo $sql_user . " success ";
            echo 1;
        } else {
            // echo $sql_user . " failed ";
            echo 0;
        }
    }
    //Code không bảo mật XSS
    else if ($_POST['action'] === 'changeInfo' && isset($_POST['userId'])) {
        $userId = $_POST['userId'];

        $sql_user = "SELECT u.*, ui.*
                    FROM tbl_user u
                    JOIN tbl_user_info ui ON u.userId = ui.userId
                    WHERE u.userId = $userId";
        $query_user = mysqli_query($mysqli, $sql_user);
        $row = mysqli_fetch_assoc($query_user);

        $data = array(
            'userId' => $row['userId'],
            'userInfoId' => $row['userInfoId'],
            'userName' => $row['userName'],
            'userPhone' => $row['userPhone'],
            'userStreetAddress' => $row['userStreetAddress'],
            'userOptional' => $row['userOptional'],
            'userCity' => $row['userCity'],
        );
        
        header('Content-Type: application/json');
        echo json_encode($data);
    }
    else if ($_POST['action'] === 'updateInfo' && isset($_POST['userInfoId'])) {
        $userId = $_POST['userId'];
        $userInfoId = $_POST['userInfoId'];
        $userName = $_POST['userName'];
        $userPhone = $_POST['userPhone'];
        $userStreetAddress = $_POST['userStreetAddress'];
        $userOptional = $_POST['userOptional'];
        $userCity = $_POST['userCity'];

        $sql_updateUser = "UPDATE tbl_user
                            SET userName='$userName', userPhone='$userPhone'
                            WHERE userId='$userId'";

        $sql_updateUserInfo = "UPDATE tbl_user_info
                            SET userStreetAddress='$userStreetAddress', userOptional='$userOptional', userCity='$userCity'
                            WHERE userInfoId='$userInfoId'";

        mysqli_query($mysqli, $sql_updateUser);
        mysqli_query($mysqli, $sql_updateUserInfo);
    }
    // Code ngăn chặn XSS attack
    // else if ($_POST['action'] === 'changeInfo' && isset($_POST['userId'])) {
    //     $userId = $_POST['userId'];

    //     $sql_user = "SELECT u.*, ui.*
    //                 FROM tbl_user u
    //                 JOIN tbl_user_info ui ON u.userId = ui.userId
    //                 WHERE u.userId = ?";
    //     $stmt = mysqli_prepare($mysqli, $sql_user);
    //     mysqli_stmt_bind_param($stmt, "i", $userId);
    //     mysqli_stmt_execute($stmt);
    //     $result = mysqli_stmt_get_result($stmt);
    //     $row = mysqli_fetch_assoc($result);

    //     $data = array(
    //         'userId' => $row['userId'],
    //         'userInfoId' => $row['userInfoId'],
    //         'userName' => htmlspecialchars($row['userName']),
    //         'userPhone' => htmlspecialchars($row['userPhone']),
    //         'userStreetAddress' => htmlspecialchars($row['userStreetAddress']),
    //         'userOptional' => htmlspecialchars($row['userOptional']),
    //         'userCity' => htmlspecialchars($row['userCity']),
    //     );
        
    //     header('Content-Type: application/json');
    //     echo json_encode($data);
    // }
    // else if ($_POST['action'] === 'updateInfo' && isset($_POST['userInfoId'])) {
    //     $userId = $_POST['userId'];
    //     $userInfoId = $_POST['userInfoId'];
    //     //Encode dữ liệu chống XSS attack
    //     $userName = htmlspecialchars($_POST['userName']);
    //     $userPhone = htmlspecialchars($_POST['userPhone']);
    //     $userStreetAddress = htmlspecialchars($_POST['userStreetAddress']);
    //     $userOptional = htmlspecialchars($_POST['userOptional']);
    //     $userCity = htmlspecialchars($_POST['userCity']);

    //     $sql_updateUser = "UPDATE tbl_user
    //                         SET userName=?, userPhone=?
    //                         WHERE userId=?";
    //     $stmt = mysqli_prepare($mysqli, $sql_updateUser);
    //     mysqli_stmt_bind_param($stmt, "ssi", $userName, $userPhone, $userId);
    //     mysqli_stmt_execute($stmt);

    //     $sql_updateUserInfo = "UPDATE tbl_user_info
    //                         SET userStreetAddress=?, userOptional=?, userCity=?
    //                         WHERE userInfoId=?";
    //     $stmt = mysqli_prepare($mysqli, $sql_updateUserInfo);
    //     mysqli_stmt_bind_param($stmt, "sssi", $userStreetAddress, $userOptional, $userCity, $userInfoId);
    //     mysqli_stmt_execute($stmt);
    // }
    // //
    if ($_POST['action'] === 'fetchUserInfoData' && isset($_POST['userId'])) {
        $userId = $_POST['userId'];
        $html = "";

        $sql_user = "SELECT u.*, ui.*
                    FROM tbl_user u
                    JOIN tbl_user_info ui ON u.userId = ui.userId
                    WHERE u.userId = $userId";

        $query_user = mysqli_query($mysqli, $sql_user);
    
        while($row = mysqli_fetch_array($query_user)) {
            if ($row['userStreetAddress']) {
                if ($row['userOptional']) {
                    $html .= '
                        <p class="menu__address-info">'.$row['userStreetAddress'].', '.$row['userOptional'].', '.$row['userCity'].'</p>
                        <p class="menu__address-info">'.$row['userName'].', '.$row['userPhone'].'</p>
                    ';
                } else {
                    $html .= '
                        <p class="menu__address-info">'.$row['userStreetAddress'].', '.$row['userCity'].'</p>
                        <p class="menu__address-info">'.$row['userName'].', '.$row['userPhone'].'</p>
                    ';
                }
            }
        }

        // Include totalRows and itemsPerPage in the JSON response
        $data = array(
            'html' => $html
        );
    
        // Return the data as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }
?>