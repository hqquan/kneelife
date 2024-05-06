<?php
    include "../config/config.php";
    require '../../carbon/autoload.php';

    use Carbon\Carbon;
    use Carbon\CarbonInterval;

    if (isset($_POST['time'])) {
        $time = $_POST['time'];
    } else {
        $time = '';
        $subDays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
    }
    
    if ($time == "7ngay") {
        $subDays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
    } else if ($time == "28ngay") {
        $subDays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(28)->toDateString();
    } else if ($time == "90ngay") {
        $subDays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(90)->toDateString();
    } else if ($time == "365ngay") {
        $subDays = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
    }

    $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

    $sql_revenue = "SELECT * FROM tbl_order 
                    WHERE orderStatus = 'Finished' 
                    AND DATE(orderTime) BETWEEN '$subDays' AND '$now' 
                    ORDER BY orderTime ASC";
    $sql_revenue_query = mysqli_query($mysqli, $sql_revenue);

    $chart_revenue_data = array();
    while ($val = mysqli_fetch_array($sql_revenue_query)) {
        $chart_revenue_data[] = array(
            'time' => $val['orderTime'],
            'value' => $val['orderTotal']
        );
    }

    $sql_dish = "SELECT DISTINCT od.productId, SUM(od.productQuantity) as productQuantity, p.productName
                FROM tbl_order_detail od
                JOIN tbl_order o ON od.orderCode = o.orderCode
                JOIN tbl_product p ON p.productId = od.productId
                WHERE o.orderStatus = 'Finished' 
                AND DATE(o.orderTime) BETWEEN '$subDays' AND '$now' 
                GROUP BY od.productId";
    $sql_dish_query = mysqli_query($mysqli, $sql_dish);

    $chart_dish_data = array();
    while ($val = mysqli_fetch_array($sql_dish_query)) {
        $chart_dish_data[] = array(
            'name' => $val['productName'],
            'value' => $val['productQuantity']
        );
    }

    $data = array(
        'chartRevenue' => $chart_revenue_data,
        'chartDish' => $chart_dish_data
    );

    header('Content-Type: application/json');
    echo json_encode($data);
?>