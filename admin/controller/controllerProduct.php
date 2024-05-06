<?php 
    include "../config/config.php";
    
    if ($_POST['action'] === 'addProduct' && isset($_POST['addProductName'])) {
        $productName = $_POST['addProductName'];
        $productPrice = $_POST['addProductPrice'];
        $productGroup = $_POST['addProductGroup'];
        $productDescribe = $_POST['addProductDescribe'];
    
        $productImage = $_FILES['addProductImage']['name'];
        $productImage_tmp = $_FILES['addProductImage']['tmp_name'];
        $productImage = time()."_".$productImage;

        $sql_addProduct = "INSERT INTO tbl_product(productName, productPrice, productGroup, productDescribe, productImage)
                            VALUE ('$productName', '$productPrice', '$productGroup', '$productDescribe', '$productImage')";
        
        mysqli_query($mysqli, $sql_addProduct);
        move_uploaded_file($productImage_tmp, '../upload/'.$productImage);
    } else if ($_POST['action'] === 'editProduct' && isset($_POST['productId'])) {
        $productId = $_POST['productId'];

        $sql_getProduct = "SELECT * FROM tbl_product WHERE productId = $productId LIMIT 1";
        $query_getProduct = mysqli_query($mysqli, $sql_getProduct);

        $data = mysqli_fetch_assoc($query_getProduct);

        // Return the data as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    } else if ($_POST['action'] === 'updateProduct' && isset($_POST['editProductName'])) {
        
        $productId = $_POST['editProductId'];
        $productName = $_POST['editProductName'];
        $productPrice = $_POST['editProductPrice'];
        $productGroup = $_POST['editProductGroup'];
        $productDescribe = $_POST['editProductDescribe'];

        // Get the original image name from the database
        $result = mysqli_query($mysqli, "SELECT * FROM tbl_product WHERE productId = '$productId'");
        while ($row = mysqli_fetch_array($result)) {
            $productImageOrigin = $row['productImage'];
            $filePath = '../upload/' . $productImageOrigin;
        }

        // Check if a new image is uploaded
        if (!empty($_FILES['editProductImage']['name'])) {
            // Unlink the original image
            unlink($filePath);

            // Handle the new image
            $productImage = $_FILES['editProductImage']['name'];
            $productImage_tmp = $_FILES['editProductImage']['tmp_name'];
            $productImage = time() . "_" . $productImage;

            // Move the new image to the upload directory
            move_uploaded_file($productImage_tmp, '../upload/' . $productImage);
        } else {
            // If no new image is uploaded, keep the original image
            $productImage = $productImageOrigin;
        }

        $sql_updateProduct = "UPDATE tbl_product
                                SET productName='$productName', productPrice='$productPrice', 
                                productGroup='$productGroup', productDescribe='$productDescribe', 
                                productImage='$productImage'
                                WHERE productId='$productId'";

        mysqli_query($mysqli, $sql_updateProduct);
        
    } else if ($_POST['action'] === 'deleteProductConfirmation' && isset($_POST['productId'])) {
       
        $productId = $_POST['productId'];

        $data = array(
            'productId' => $productId,
        );

        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    } else if ($_POST['action'] === 'deleteProduct' && isset($_POST['productId'])) {
        $productId = $_POST['productId'];
        $sql_deleteProduct = "DELETE FROM tbl_product WHERE productId = '$productId'";
        $query_deleteImage = mysqli_query($mysqli, "SELECT productImage FROM tbl_product WHERE productId = '$productId'");
        while ($row = mysqli_fetch_array($query_deleteImage)) {
            $productImage = $row['productImage'];  
            $filePath = '../upload/'.$productImage;
        }
        unlink($filePath);
        mysqli_query($mysqli, $sql_deleteProduct);
    }
    else if ($_POST['action'] === 'search' && isset($_POST['query'])) {
        $html = '';
        $search = $_POST['query'];

        $sql = "SELECT p.*, c.categoryName 
                FROM tbl_product p
                JOIN tbl_category c ON p.productGroup = c.categoryId
                WHERE p.productName LIKE '%$search%'";
        $result = mysqli_query($mysqli, $sql);

        $html .= '
            <table class="manager-site__manager">
                <tr class="manager-site__manager-row">
                    <th class="manager-site__manager-header">ID</th>
                    <th class="manager-site__manager-header">NAME</th>
                    <th class="manager-site__manager-header">IMG</th>
                    <th class="manager-site__manager-header">GROUP</th>
                    <th class="manager-site__manager-header">PRICE</th>
                    <th class="manager-site__manager-header">DESCRIBE</th>
                    <th class="manager-site__manager-header">DELETE</th>
                    <th class="manager-site__manager-header">EDIT</th>
                </tr>
        ';
    
        if (mysqli_num_rows($result) > 0) {
            while($rows = mysqli_fetch_array($result)) {
                $html .= '
                    <tr class="manager-site__manager-row">
                        <td class="manager-site__manager-data">'.$rows['productId'].'</td>
                        <td class="manager-site__manager-data">'.$rows['productName'].'</td>
                        <td class="manager-site__manager-data">
                            <img class="data__img" src="upload/'.$rows['productImage'].'" alt="">
                        </td>
                        <td class="manager-site__manager-data">'.$rows['categoryName'].'</td>
                        <td class="manager-site__manager-data price">'.$rows['productPrice'].'</td>
                        <td contenteditable class="manager-site__manager-data">
                            <p class="data__desc">'.$rows['productDescribe'].'</p>
                        </td>
                        <td class="manager-site__manager-data">
                            <button onclick="deleteProductConfirmation('.$rows['productId'].')" class="data__edit-btn red-bg-color btn">DELETE</button>
                        </td>
                        <td class="manager-site__manager-data">
                            <button onclick="editProduct('.$rows['productId'].')" class="data__edit-btn blue-bg-color btn">EDIT</button>
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

    if ($_POST['action'] === 'fetchProductData') {
        $html = "";
        $itemsPerPage = 5;
    
        $sql_product = '';
        $totalRows = 0;
    
        if (isset($_POST['productCategoryId'])) {
            // Determine the current page
            $page = isset($_POST['page']) ? $_POST['page'] : 1;
            $offset = ($page - 1) * $itemsPerPage;
    
            $productCategoryId = $_POST['productCategoryId'];
            $sql_product = "SELECT p.*, c.categoryName 
                            FROM tbl_product p
                            JOIN tbl_category c ON p.productGroup = c.categoryId
                            WHERE p.productGroup = $productCategoryId
                            ORDER BY p.productId ASC";

        } else {
            // Determine the current page
            $page = isset($_POST['page']) ? $_POST['page'] : 1;
            $offset = ($page - 1) * $itemsPerPage;
    
            $sql_product = "SELECT p.*, c.categoryName 
                            FROM tbl_product p
                            JOIN tbl_category c ON p.productGroup = c.categoryId
                            ORDER BY p.productId ASC
                            LIMIT $offset, $itemsPerPage";
    
            // Get the total number of rows without limit
            $sql_totalRows = "SELECT COUNT(*) AS totalRows FROM tbl_product";
            $query_totalRows = mysqli_query($mysqli, $sql_totalRows);
            $totalRows = mysqli_fetch_assoc($query_totalRows)['totalRows'];
        }
    
        $query_product = mysqli_query($mysqli, $sql_product);
        $html .= '
            <table class="manager-site__manager">
                <tr class="manager-site__manager-row">
                    <th class="manager-site__manager-header">ID</th>
                    <th class="manager-site__manager-header">NAME</th>
                    <th class="manager-site__manager-header">IMG</th>
                    <th class="manager-site__manager-header">GROUP</th>
                    <th class="manager-site__manager-header">PRICE</th>
                    <th class="manager-site__manager-header">DESCRIBE</th>
                    <th class="manager-site__manager-header">DELETE</th>
                    <th class="manager-site__manager-header">EDIT</th>
                </tr>
        ';
    
        if (mysqli_num_rows($query_product) > 0) {
            while($rows = mysqli_fetch_array($query_product)) {
                $html .= '
                    <tr class="manager-site__manager-row">
                        <td class="manager-site__manager-data">'.$rows['productId'].'</td>
                        <td class="manager-site__manager-data">'.$rows['productName'].'</td>
                        <td class="manager-site__manager-data">
                            <img class="data__img" src="upload/'.$rows['productImage'].'" alt="">
                        </td>
                        <td class="manager-site__manager-data">'.$rows['categoryName'].'</td>
                        <td class="manager-site__manager-data price">'.$rows['productPrice'].'</td>
                        <td contenteditable class="manager-site__manager-data">
                            <p class="data__desc">'.$rows['productDescribe'].'</p>
                        </td>
                        <td class="manager-site__manager-data">
                            <button onclick="deleteProductConfirmation('.$rows['productId'].')" class="data__edit-btn red-bg-color btn">DELETE</button>
                        </td>
                        <td class="manager-site__manager-data">
                            <button onclick="editProduct('.$rows['productId'].')" class="data__edit-btn blue-bg-color btn">EDIT</button>
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