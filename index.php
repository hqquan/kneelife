<?php 
    session_start();
    ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kneelife - Kneel for spine, kneel for life</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./assets/css/base.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="./assets/img/favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="app">

        <?php
            include './admin/config/config.php';
            include ("./pages/header.php");
            include ("./pages/home.php");
            include ("./pages/menu.php");
            include ("./pages/order.php");
            include ("./pages/consult.php");
            include ("./pages/footer.php");
        ?>

    </div>

    <?php 
        include ("./pages/modal.php");
    ?>

</body>

<script type="text/javascript" src="./assets/js/showSlides.js"></script>
<script type="text/javascript" src="./assets/js/getParentElement.js"></script>
<script type="text/javascript" src="./assets/js/collapseContent.js"></script>
<script type="text/javascript" src="./assets/js/navbarActive.js"></script>
<script type="text/javascript" src="./assets/js/modal.js"></script>
<script type="text/javascript" src="./assets/js/cardContent.js"></script>
<script type="text/javascript" src="./assets/js/showProduct.js"></script>
<script type="text/javascript" src="./assets/js/updateOrder.js"></script>
<script type="text/javascript" src="./assets/js/deleteItem.js"></script>
<script type="text/javascript" src="./assets/js/productListScroll.js"></script>
<script type="text/javascript" src="./assets/js/productQuantity.js"></script>
<script type="text/javascript" src="./assets/js/addToCart.js"></script>
<script type="text/javascript" src="./assets/js/mobileMenu.js"></script>
<script type="text/javascript" src="./assets/js/formatNumber.js"></script>
<script type="text/javascript" src="./assets/js/ajax_user.js"></script>
<script type="text/javascript" src="./assets/js/ajax_order.js"></script>

</html>