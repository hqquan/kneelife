<?php 
    include "../../admin/config/config.php";

    // Thiết lập Content Security Policy (CSP)
    header("Content-Security-Policy: default-src 'self'");

    if ($_POST['action'] === 'viewOrderDetail' && isset($_POST['orderId'])) {
        
        $orderId = $_POST['orderId'];

        $sql_getOrderDetail = "SELECT u.*, ui.*, o.*, od.*
                                FROM tbl_order o
                                JOIN tbl_order_detail od ON o.orderId = od.orderId
                                JOIN tbl_user u ON o.userId = u.userId
                                JOIN tbl_user_info ui ON u.userId = ui.userId
                                WHERE o.orderId = $orderId";
        $query_getOrderDetail = mysqli_query($mysqli, $sql_getOrderDetail);
        $row = mysqli_fetch_assoc($query_getOrderDetail);

        $data = array(
            'orderId' => $orderId,
            'userName' => $row['userName'],
            'userPhone' => $row['userPhone'],
            'userStreetAddress' => $row['userStreetAddress'],
            'userOptional' => $row['userOptional'],
            'userCity' => $row['userCity'],
            'orderTime' => $row['orderTime'],
            'orderCode' => $row['orderCode'],
        );

        // Return the data as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    } 
    else if ($_POST['action'] === 'fetchProductListData' && isset($_POST['orderCode'])) {
        $orderCode = $_POST['orderCode'];
        
        $sql_getOrderDetail = "SELECT od.*, p.* 
                                FROM tbl_order_detail od
                                JOIN tbl_product p ON od.productId = p.productId
                                WHERE orderCode = '$orderCode' 
                                ORDER BY orderDetailId ASC";
        $query_getOrderDetail = mysqli_query($mysqli, $sql_getOrderDetail);

        $html = '';
        $total = 0;
        $subtotal = 0;

        while ($rows = mysqli_fetch_array($query_getOrderDetail)) {
            $rows['productPrice'] = (int) str_replace(',', '', $rows['productPrice']);

            $price = $rows['productPrice'] * $rows['productQuantity'];
            $subtotal += $price;
            $html .= '
                <div class="detail__info-row">
                    <p class="detail__info-header">
                        '.$rows['productName'].'
                        <span class="detail__info-sign">x</span>
                        <span class="detail__info-quantity">'.$rows['productQuantity'].'</span>
                    </p>
                    <p class="detail__info-data price">'.$rows['productPrice'].'</p>
                </div>
            ';
        }

        $shipping = 27000;
        $vat = $subtotal * 0.08;
        $total = $subtotal + $shipping;

        $data = array(
            'html' => $html,
            'shipping' => $shipping,
            'subtotal' => $subtotal,
            'total' => $total,
            'vat' => $vat,
        );

        header('Content-Type: application/json');
        echo json_encode($data);   
    }
    else if ($_POST['action'] === 'acceptOrder' && isset($_POST['orderId'])) {
        $orderId = $_POST['orderId'];
        
        $sql_setOrder = "UPDATE tbl_order
                        SET orderStatus = 'Finished'
                        WHERE orderId = '$orderId'";
        mysqli_query($mysqli, $sql_setOrder);
    }
    else if ($_POST['action'] === 'cancelOrder' && isset($_POST['orderId'])) {
        $orderId = $_POST['orderId'];
        
        $sql_setOrder = "UPDATE tbl_order
                        SET orderStatus = 'Cancel'
                        WHERE orderId = '$orderId'";
        mysqli_query($mysqli, $sql_setOrder);
    }
    else if ($_POST['action'] === 'deleteOrderConfirmation' && isset($_POST['orderId'])) {
        
        $orderId = $_POST['orderId'];

        $data = array(
            'orderId' => $orderId,
        );

        // Return the data as JSON
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    } 
    else if ($_POST['action'] === 'deleteOrder' && isset($_POST['orderId'])) {
        $orderId = $_POST['orderId'];
        $sql_deleteOrder = "DELETE FROM tbl_order WHERE orderId = '$orderId'";
        
        mysqli_query($mysqli, $sql_deleteOrder);
    }
    else if ($_POST['action'] === 'search' && isset($_POST['query'])) {
        $html = '';
        $search = $_POST['query'];

        $sql = "SELECT o.*, u.* 
                FROM tbl_order o
                JOIN tbl_user u ON o.userId = u.userId
                WHERE u.userName LIKE '%$search%'
                OR u.userPhone LIKE '%$search%'
                OR o.orderTime LIKE '%$search%'
                OR o.orderPayment LIKE '%$search%'
                OR o.orderStatus LIKE '%$search%'";
        $result = mysqli_query($mysqli, $sql);

        $html .= '
            <table class="manager-site__manager">
                <tr class="manager-site__manager-row">
                    <th class="manager-site__manager-header">ID</th>
                    <th class="manager-site__manager-header">PHONE</th>
                    <th class="manager-site__manager-header">NAME</th>
                    <th class="manager-site__manager-header">TOTAL</th>
                    <th class="manager-site__manager-header">PAYMENT METHOD</th>
                    <th class="manager-site__manager-header">PAYMENT STATUS</th>
                    <th class="manager-site__manager-header">ORDER STATUS</th>
                    <th class="manager-site__manager-header">ORDER TIME</th>
                    <th class="manager-site__manager-header">DELETE</th>
                </tr>
        ';
    
        if (mysqli_num_rows($result) > 0) {
            while($rows = mysqli_fetch_array($result)) {
                $html .= '
                    <tr class="manager-site__manager-row">
                        <td class="manager-site__manager-data">'.$rows['orderId'].'</td>
                        <td class="manager-site__manager-data">'.$rows['userPhone'].'</td>
                        <td class="manager-site__manager-data">'.$rows['userName'].'</td>
                        <td class="manager-site__manager-data price">'.$rows['orderTotal'].'</td>
                        <td class="manager-site__manager-data">'.$rows['orderPayment'].'</td>
                        <td class="manager-site__manager-data">
                            <a onclick="return false" class="item-status">Paid</a>
                        </td>
                        <td class="manager-site__manager-data">
                            <button onclick="viewOrderDetail('.$rows['orderId'].')" name="viewDetail" class="item-status">'.$rows['orderStatus'].'</button>
                        </td>
                        <td class="manager-site__manager-data">'.$rows['orderTime'].'</td>
                        <td class="manager-site__manager-data">
                            <button onclick="deleteOrderConfirmation('.$rows['orderId'].')" class="data__edit-btn red-bg-color btn">DELETE</button>
                        </td>
                    </tr>
                ';
            }
        } else {
            $html .= '
                <tr class="manager-site__manager-row">
                    <td class="manager-site__manager-data" colspan=9 style="font-weight: 700;"> Data is empty! </td>
                </tr>
            ';
        }
    
        $html .= '</table>';

        header('Content-Type: application/json');
        echo json_encode($html);
    }

    if ($_POST['action'] === 'fetchOrderData' && isset($_POST['userId'])) {
        $userId = $_POST['userId'];
        $html = "";
        $itemsPerPage = 5;
        
        // Determine the current page
        $page = isset($_POST['page']) ? $_POST['page'] : 1;
        $offset = ($page - 1) * $itemsPerPage;
        
        $sql_order = "SELECT o.*, u.* 
                    FROM tbl_order o
                    JOIN tbl_user u ON o.userId = u.userId
                    WHERE o.userId = $userId
                    ORDER BY o.orderId ASC
                    LIMIT $offset, $itemsPerPage";
        
        $query_order = mysqli_query($mysqli, $sql_order);

        $html .= '
            <table class="manager-site__manager">
                <tr class="manager-site__manager-row">
                    <th class="manager-site__manager-header">PHONE</th>
                    <th class="manager-site__manager-header">NAME</th>
                    <th class="manager-site__manager-header">TOTAL</th>
                    <th class="manager-site__manager-header">PAYMENT METHOD</th>
                    <th class="manager-site__manager-header">PAYMENT STATUS</th>
                    <th class="manager-site__manager-header">ORDER STATUS</th>
                    <th class="manager-site__manager-header">ORDER TIME</th>
                </tr>
        ';
    
        if (mysqli_num_rows($query_order) > 0) {
            while($rows = mysqli_fetch_array($query_order)) {
                $html .= '
                    <tr class="manager-site__manager-row">
                        <td class="manager-site__manager-data">'.$rows['userPhone'].'</td>
                        <td class="manager-site__manager-data">'.$rows['userName'].'</td>
                        <td class="manager-site__manager-data price">'.$rows['orderTotal'].'</td>
                        <td class="manager-site__manager-data">'.$rows['orderPayment'].'</td>
                        <td class="manager-site__manager-data">
                            <a onclick="return false" class="item-status">Paid</a>
                        </td>
                        <td class="manager-site__manager-data">
                            <button onclick="viewOrderDetail('.$rows['orderId'].')" name="viewDetail" class="item-status">'.$rows['orderStatus'].'</button>
                        </td>
                        <td class="manager-site__manager-data">'.$rows['orderTime'].'</td>
                    </tr>
                ';
            }
        } else {
            $html .= '
                <tr class="manager-site__manager-row">
                    <td class="manager-site__manager-data" colspan=9 style="font-weight: 700;"> Data is empty! </td>
                </tr>
            ';
        }
    
        $html .= '</table>';

        // Get the total number of rows without limit
        $sql_totalRows = "SELECT COUNT(*) AS totalRows FROM tbl_order";
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