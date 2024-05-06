<?php 
    session_start();
    ob_start();
    if (!isset($_SESSION['signin'])) {
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kneelife - Manager Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="./css/base.css">
    <link rel="stylesheet" href="./css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
</head>

<body>
    <div class="app">
        
        <?php
            include './config/config.php';
            include ("./modules/header.php");
        ?>

        <div class="content">
            <div class="grid__full-width">
                <div class="grid__row">
                    <div class="menu grid__col-2">
                        <?php 
                            include ("./modules/menu.php");
                        ?>
                    </div>
                    <div class="grid__col-10 content__main">
                        <?php 
                            include ("./modules/main.php");
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <?php
        include ("./modules/modal.php");
    ?>
</body>
<script type="text/javascript" src="./js/getParentElement.js"></script>
<script type="text/javascript" src="./js/menuActive.js"></script>
<script type="text/javascript" src="./js/categoryActive.js"></script>
<script type="text/javascript" src="./js/modal.js"></script>
<script type="text/javascript" src="./js/itemStatus.js"></script>
<script type="text/javascript" src="./js/formatNumber.js"></script>
<script type="text/javascript" src="./js/mobileMenu.js"></script>
<script type="text/javascript" src="./js/ajax_category.js"></script>
<script type="text/javascript" src="./js/ajax_product.js"></script>
<script type="text/javascript" src="./js/ajax_user.js"></script>
<script type="text/javascript" src="./js/ajax_order.js"></script>

</html>