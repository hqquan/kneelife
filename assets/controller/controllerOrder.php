<?php 
    include '../../admin/config/config.php';

    if ($_POST['action'] === 'orderCart' && isset($_POST['userId'])) {
        $userId = $_POST['userId'];

        // Retrieve the JSON data from the AJAX request
        $productListJson = $_POST['productList'];
        // Decode the JSON data into a PHP array
        $productList = json_decode($productListJson, true);

        $timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
        $orderTime = new DateTime('now', $timezone);
        $orderTime = $orderTime->format('Y-m-d H:i:s');

        $orderStatus = 'Wait';
        $orderPayment = $_POST['orderPayment'];
        $orderCode = rand(0, 9999);
        $orderTotal = $_POST['orderTotal'];
        $sql_addOrder = "INSERT INTO tbl_order (orderTime, orderStatus, orderPayment, orderCode, orderTotal, userId)
                        VALUE ('$orderTime', '$orderStatus', '$orderPayment', '$orderCode', '$orderTotal', '$userId')";
        $query_addOrder = mysqli_query($mysqli, $sql_addOrder);
        $orderId = mysqli_insert_id($mysqli);
        if ($query_addOrder) {
            foreach ($productList as $product) {
                $productId = $product['productId'];
                $productNote = $product['productNote'];
                $productQuantity = $product['productQuantity'];
                $sql_addOrderDetail = "INSERT INTO tbl_order_detail (productId, orderCode, productNote, productQuantity, orderId)
                                        VALUE ('$productId', '$orderCode', '$productNote', '$productQuantity', '$orderId')";
                mysqli_query($mysqli, $sql_addOrderDetail);
            }
        }
    }
?>