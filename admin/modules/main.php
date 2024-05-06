<?php 
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    } else {
        $action = '';
    }
    
    if ($action == 'productManager') {
        include ("./modules/productManager/productManager.php");
    } else if ($action == 'categoryManager') {
        include ("./modules/productManager/categoryManager.php");
    } else if ($action == 'productManager') {
        include ("./modules/productManager/productManager.php");
    } else if ($action == 'userManager') {
        include ("./modules/userManager/userManager.php");
    } else if ($action == 'orderManager') {
        include ("./modules/ecommerce/orderManager.php");
    } 
    // else if ($action == 'voucherManager') {
    //     include ("./modules/ecommerce/voucherManager.php");
    // } 
    // else if ($action == 'report') {
    //     include ("./modules/report.php");
    // } 
    else if ($action == 'signout') {
        if (isset($_SESSION['signin'])) {
            unset($_SESSION['signin']);
            header('Location: login.php');
        }
    } else {
        include ("./modules/dashboard.php");
    }
?>