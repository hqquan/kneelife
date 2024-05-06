<?php 
    include "../config/config.php";
    
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
        $userName = $_POST['editUserName'];
        $userGroup = $_POST['editUserGroup'];

        $sql_updateUser = "UPDATE tbl_user
                            SET userName='$userName', userGroup='$userGroup'
                            WHERE userId='$userId'";

        mysqli_query($mysqli, $sql_updateUser);
        
    } 
    else if ($_POST['action'] === 'deleteUserConfirmation' && isset($_POST['userId'])) {
       
        $userId = $_POST['userId'];

        $data = array(
            'userId' => $userId,
        );

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    } 
    else if ($_POST['action'] === 'deleteUser' && isset($_POST['userId'])) {
        $userId = $_POST['userId'];
        $sql_deleteUser = "DELETE FROM tbl_user WHERE userId = '$userId'";
       
        mysqli_query($mysqli, $sql_deleteUser);
    }
    else if ($_POST['action'] === 'search' && isset($_POST['query'])) {
        $html = '';
        $search = $_POST['query'];

        $sql = "SELECT * FROM tbl_user 
                WHERE userName LIKE '%$search%'
                OR userPhone LIKE '%$search%'
                OR userEmail LIKE '%$search%'
                OR userRegisterDate LIKE '%$search%'";
        $result = mysqli_query($mysqli, $sql);

        $html .= '
            <table class="manager-site__manager">
                <tr class="manager-site__manager-row">
                    <th class="manager-site__manager-header">ID</th>
                    <th class="manager-site__manager-header">PHONE</th>
                    <th class="manager-site__manager-header">NAME</th>
                    <th class="manager-site__manager-header">EMAIL</th>
                    <th class="manager-site__manager-header">GROUP</th>
                    <th class="manager-site__manager-header">REGISTER DATE</th>
                    <th class="manager-site__manager-header">DELETE</th>
                    <th class="manager-site__manager-header">EDIT</th>
                </tr>
        ';
    
        if (mysqli_num_rows($result) > 0) {
            while($rows = mysqli_fetch_array($result)) {
                $html .= '
                    <tr class="manager-site__manager-row">
                        <td class="manager-site__manager-data">'.$rows['userId'].'</td>
                        <td class="manager-site__manager-data">'.$rows['userPhone'].'</td>
                        <td class="manager-site__manager-data">'.$rows['userName'].'</td>
                        <td class="manager-site__manager-data">'.$rows['userEmail'].'</td>
                        <td class="manager-site__manager-data">'.$rows['userGroup'].'</td>
                        <td class="manager-site__manager-data">'.$rows['userRegisterDate'].'</td>
                        <td class="manager-site__manager-data">
                            <button onclick="deleteUserConfirmation('.$rows['userId'].')" class="data__edit-btn red-bg-color btn">DELETE</button>
                        </td>
                        <td class="manager-site__manager-data">
                            <button onclick="editUser('.$rows['userId'].')" class="data__edit-btn blue-bg-color btn">EDIT</button>
                        </td>
                    </tr>
                ';
            }
        } else {
            $html .= '
                <tr class="manager-site__manager-row">
                    <td class="manager-site__manager-data" colspan=8 style="font-weight: 700;"> Data is empty! </td>
                </tr>
            ';
        }
    
        $html .= "</table>";

        header('Content-Type: application/json');
        echo json_encode($html);
    }

    if ($_POST['action'] === 'fetchUserData') {
        $html = "";
        $itemsPerPage = 5;

        $sql_user = '';
        $totalRows = 0;
    
        if (isset($_POST['userGroup'])) {
            // Determine the current page
            $page = isset($_POST['page']) ? $_POST['page'] : 1;
            $offset = ($page - 1) * $itemsPerPage;

            $userGroup = $_POST['userGroup'];
            $sql_user = "SELECT *
                        FROM tbl_user
                        WHERE userGroup = '$userGroup'
                        ORDER BY userId ASC";
        } else {
            // Determine the current page
            $page = isset($_POST['page']) ? $_POST['page'] : 1;
            $offset = ($page - 1) * $itemsPerPage;
    
            $sql_user = "SELECT *
                        FROM tbl_user
                        ORDER BY userId ASC
                        LIMIT $offset, $itemsPerPage";
    
            // Get the total number of rows without limit
            $sql_totalRows = "SELECT COUNT(*) AS totalRows FROM tbl_user";
            $query_totalRows = mysqli_query($mysqli, $sql_totalRows);
            $totalRows = mysqli_fetch_assoc($query_totalRows)['totalRows'];
        }

        $query_user = mysqli_query($mysqli, $sql_user);
        $html .= '
            <table class="manager-site__manager">
                <tr class="manager-site__manager-row">
                    <th class="manager-site__manager-header">ID</th>
                    <th class="manager-site__manager-header">PHONE</th>
                    <th class="manager-site__manager-header">NAME</th>
                    <th class="manager-site__manager-header">EMAIL</th>
                    <th class="manager-site__manager-header">GROUP</th>
                    <th class="manager-site__manager-header">REGISTER DATE</th>
                    <th class="manager-site__manager-header">DELETE</th>
                    <th class="manager-site__manager-header">EDIT</th>
                </tr>
        ';
    
        if (mysqli_num_rows($query_user) > 0) {
            while($rows = mysqli_fetch_array($query_user)) {
                $html .= '
                    <tr class="manager-site__manager-row">
                        <td class="manager-site__manager-data">'.$rows['userId'].'</td>
                        <td class="manager-site__manager-data">'.$rows['userPhone'].'</td>
                        <td class="manager-site__manager-data">'.$rows['userName'].'</td>
                        <td class="manager-site__manager-data">'.$rows['userEmail'].'</td>
                        <td class="manager-site__manager-data">'.$rows['userGroup'].'</td>
                        <td class="manager-site__manager-data">'.$rows['userRegisterDate'].'</td>
                        <td class="manager-site__manager-data">
                            <button onclick="deleteUserConfirmation('.$rows['userId'].')" class="data__edit-btn red-bg-color btn">DELETE</button>
                        </td>
                        <td class="manager-site__manager-data">
                            <button onclick="editUser('.$rows['userId'].')" class="data__edit-btn blue-bg-color btn">EDIT</button>
                        </td>
                    </tr>
                ';
            }
        } else {
            $html .= '
                <tr class="manager-site__manager-row">
                    <td class="manager-site__manager-data" colspan=8 style="font-weight: 700;"> Data is empty! </td>
                </tr>
            ';
        }
    
        $html .= "</table>";
    
        // Include totalRows and itemsPerPage in the JSON response
        $data = array(
            'totalRows' => $totalRows,
            'itemsPerPage' => $itemsPerPage,
            'html' => $html
        );
    
        // Return the data as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }
?>