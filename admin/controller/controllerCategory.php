<?php 
    include "../config/config.php";

    if ($_POST['action'] === 'addCategory' && isset($_POST['addCategoryName'])) {
        $categoryName = $_POST['addCategoryName'];

        $categoryImage = $_FILES['addCategoryImage']['name'];
        $categoryImage_tmp = $_FILES['addCategoryImage']['tmp_name'];
        $categoryImage = time()."_".$categoryImage;

        $sql_addCategory = "INSERT INTO tbl_category(categoryName, categoryImage)
                            VALUE ('$categoryName', '$categoryImage')";
        
        mysqli_query($mysqli, $sql_addCategory);
        move_uploaded_file($categoryImage_tmp, '../upload/'.$categoryImage);
    } else if ($_POST['action'] === 'editCategory' && isset($_POST['categoryId'])) {
        $categoryId = $_POST['categoryId'];

        $sql_getCategory = "SELECT categoryName FROM tbl_category WHERE categoryId = $categoryId LIMIT 1";
        $query_getCategory = mysqli_query($mysqli, $sql_getCategory);

        $data = mysqli_fetch_assoc($query_getCategory);

        // Return the data as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    } else if ($_POST['action'] === 'updateCategory' && isset($_POST['editCategoryName'])) {
        
        $categoryId = $_POST['editCategoryId'];
        $categoryName = $_POST['editCategoryName'];

        // Get the original image name from the database
        $result = mysqli_query($mysqli, "SELECT * FROM tbl_category WHERE categoryId = '$categoryId'");
        while ($row = mysqli_fetch_array($result)) {
            $categoryImageOrigin = $row['categoryImage'];
            $filePath = '../upload/' . $categoryImageOrigin;
        }

        // Check if a new image is uploaded
        if (!empty($_FILES['editCategoryImage']['name'])) {
            // Unlink the original image
            unlink($filePath);

            // Handle the new image
            $categoryImage = $_FILES['editCategoryImage']['name'];
            $categoryImage_tmp = $_FILES['editCategoryImage']['tmp_name'];
            $categoryImage = time() . "_" . $categoryImage;
            move_uploaded_file($categoryImage_tmp, '../upload/'.$categoryImage);
        } else {
            // If no new image is uploaded, keep the original image
            $categoryImage = $categoryImageOrigin;
        }

        $sql_updateCategory = "UPDATE tbl_category
                                SET categoryName='$categoryName', categoryImage='$categoryImage'
                                WHERE categoryId='$categoryId'";
        
        mysqli_query($mysqli, $sql_updateCategory);
    } else if ($_POST['action'] === 'deleteCategoryConfirmation' && isset($_POST['categoryId'])) {
        
        $categoryId = $_POST['categoryId'];

        $data = array(
            'categoryId' => $categoryId,
        );

        // Return the data as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    } else if ($_POST['action'] === 'deleteCategory' && isset($_POST['categoryId'])) {
        $categoryId = $_POST['categoryId'];
        $sql_deleteCategory = "DELETE FROM tbl_category WHERE categoryId = '$categoryId'";
        
        $query_deleteImage = mysqli_query($mysqli, "SELECT categoryImage FROM tbl_category WHERE categoryId = '$categoryId'");
        while ($row = mysqli_fetch_array($query_deleteImage)) {
            $categoryImage = $row['categoryImage'];  
            $filePath = '../upload/'.$categoryImage;
        }
        
        // Attempt to delete from the database
        $query_result = mysqli_query($mysqli, $sql_deleteCategory);
        
        if ($query_result) {
            // Database deletion successful, unlink the file
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
    }
    else if ($_POST['action'] === 'search' && isset($_POST['query'])) {
        $html = '';
        $search = $_POST['query'];

        $sql = "SELECT * FROM tbl_category WHERE categoryName LIKE '%$search%'";
        $result = mysqli_query($mysqli, $sql);

        $html .= '
            <table class="manager-site__manager">
                <tr class="manager-site__manager-row">
                    <th class="manager-site__manager-header">ID</th>
                    <th class="manager-site__manager-header">NAME</th>
                    <th class="manager-site__manager-header">IMG</th>
                    <th class="manager-site__manager-header">DELETE</th>
                    <th class="manager-site__manager-header">EDIT</th>
                </tr>
        ';
    
        if (mysqli_num_rows($result) > 0) {
            while($rows = mysqli_fetch_array($result)) {
                $html .= '
                    <tr class="manager-site__manager-row">
                        <td class="manager-site__manager-data">'.$rows['categoryId'].'</td>
                        <td class="manager-site__manager-data">'.$rows['categoryName'].'</td>
                        <td class="manager-site__manager-data">
                            <img class="data__img" src="upload/'.$rows['categoryImage'].'">
                        </td>
                        <td class="manager-site__manager-data">
                            <button onclick="deleteCategoryConfirmation('.$rows['categoryId'].')" class="data__edit-btn red-bg-color btn">DELETE</button>
                        </td>
                        <td class="manager-site__manager-data">
                            <button onclick="editCategory('.$rows['categoryId'].')" class="data__edit-btn blue-bg-color btn">EDIT</button>
                        </td>
                    </tr>
                ';
            }
        } else {
            $html .= '
                <tr class="manager-site__manager-row">
                    <td class="manager-site__manager-data" colspan=5 style="font-weight: 700;"> Data is empty! </td>
                </tr>
            ';
        }
    
        $html .= '</table>';

        header('Content-Type: application/json');
        echo json_encode($html);
    }

    if ($_POST['action'] === 'fetchCategoryData') {
        $html = "";
        $itemsPerPage = 5;
        
        // Determine the current page
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        $offset = ($page - 1) * $itemsPerPage;
        
        $sql_category = mysqli_query($mysqli, "SELECT * FROM tbl_category ORDER BY categoryId ASC LIMIT $offset, $itemsPerPage");
        $html .= '
            <table class="manager-site__manager">
                <tr class="manager-site__manager-row">
                    <th class="manager-site__manager-header">ID</th>
                    <th class="manager-site__manager-header">NAME</th>
                    <th class="manager-site__manager-header">IMG</th>
                    <th class="manager-site__manager-header">DELETE</th>
                    <th class="manager-site__manager-header">EDIT</th>
                </tr>
        ';
    
        if (mysqli_num_rows($sql_category) > 0) {
            while($rows = mysqli_fetch_array($sql_category)) {
                $html .= '
                    <tr class="manager-site__manager-row">
                        <td class="manager-site__manager-data">'.$rows['categoryId'].'</td>
                        <td class="manager-site__manager-data">'.$rows['categoryName'].'</td>
                        <td class="manager-site__manager-data">
                            <img class="data__img" src="upload/'.$rows['categoryImage'].'">
                        </td>
                        <td class="manager-site__manager-data">
                            <button onclick="deleteCategoryConfirmation('.$rows['categoryId'].')" class="data__edit-btn red-bg-color btn">DELETE</button>
                        </td>
                        <td class="manager-site__manager-data">
                            <button onclick="editCategory('.$rows['categoryId'].')" class="data__edit-btn blue-bg-color btn">EDIT</button>
                        </td>
                    </tr>
                ';
            }
        } else {
            $html .= '
                <tr class="manager-site__manager-row">
                    <td class="manager-site__manager-data" colspan=5 style="font-weight: 700;"> Data is empty! </td>
                </tr>
            ';
        }
    
        $html .= '</table>';

        // Get the total number of rows without limit
        $sql_totalRows = "SELECT COUNT(*) AS totalRows FROM tbl_category";
        $query_totalRows = mysqli_query($mysqli, $sql_totalRows);
        $totalRows = mysqli_fetch_assoc($query_totalRows)['totalRows'];

        // Include totalRows in the JSON response
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