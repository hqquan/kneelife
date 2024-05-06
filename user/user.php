<?php
    include '../admin/config/config.php';
    session_start();
    ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kneelife - User Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="../admin/css/base.css">
    <link rel="stylesheet" href="../admin/css/main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon"
        href='data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" viewBox="0 0 55 55" fill="none"><path d="M54.3912 54.6305C54.0563 54.9082 53.6293 55.0363 53.2038 54.9869C52.7782 54.9374 52.3889 54.7144 52.1211 54.3667C51.7652 53.8897 43.1378 42.4187 43.1378 19.6422C43.1378 15.3258 41.4903 11.1862 38.5577 8.13405C35.6252 5.08191 31.6478 3.36723 27.5005 3.36723C23.3532 3.36723 19.3758 5.08191 16.4433 8.13405C13.5107 11.1862 11.8632 15.3258 11.8632 19.6422C11.8632 42.4187 3.24926 53.8897 2.88259 54.3667C2.6148 54.7158 2.22477 54.9398 1.79828 54.9895C1.3718 55.0392 0.943802 54.9106 0.608446 54.6319C0.27309 54.3532 0.0578463 53.9473 0.0100659 53.5034C-0.0377145 53.0595 0.085882 52.6141 0.353666 52.265C0.453421 52.1331 8.62794 41.1251 8.62794 19.6422C8.62794 14.4327 10.6163 9.43668 14.1556 5.75306C17.6949 2.06944 22.4952 0 27.5005 0C32.5058 0 37.3061 2.06944 40.8454 5.75306C44.3847 9.43668 46.3731 14.4327 46.3731 19.6422C46.3731 41.1447 54.5637 52.1556 54.6473 52.265C54.9147 52.6141 55.0379 53.0594 54.9898 53.503C54.9418 53.9465 54.7265 54.3521 54.3912 54.6305ZM19.9515 20.2034C19.4182 20.2034 18.897 20.368 18.4536 20.6763C18.0102 20.9846 17.6647 21.4229 17.4606 21.9356C17.2566 22.4483 17.2032 23.0125 17.3072 23.5568C17.4112 24.1012 17.668 24.6011 18.0451 24.9936C18.4221 25.386 18.9025 25.6532 19.4255 25.7615C19.9485 25.8698 20.4906 25.8142 20.9832 25.6018C21.4759 25.3895 21.8969 25.0298 22.1932 24.5683C22.4894 24.1069 22.6476 23.5644 22.6476 23.0094C22.6476 22.2652 22.3635 21.5515 21.8579 21.0252C21.3523 20.499 20.6665 20.2034 19.9515 20.2034ZM37.7456 23.0094C37.7456 22.4544 37.5875 21.9119 37.2912 21.4505C36.995 20.989 36.5739 20.6294 36.0813 20.417C35.5886 20.2046 35.0465 20.149 34.5235 20.2573C34.0006 20.3656 33.5202 20.6328 33.1431 21.0252C32.766 21.4177 32.5093 21.9177 32.4052 22.462C32.3012 23.0063 32.3546 23.5705 32.5587 24.0832C32.7627 24.596 33.1083 25.0342 33.5517 25.3425C33.995 25.6509 34.5163 25.8154 35.0495 25.8154C35.7646 25.8154 36.4503 25.5198 36.9559 24.9936C37.4616 24.4673 37.7456 23.7536 37.7456 23.0094ZM19.5983 31.6043C19.2143 31.4044 18.7698 31.3716 18.3625 31.5129C17.9552 31.6542 17.6186 31.958 17.4266 32.3577C17.2346 32.7573 17.203 33.22 17.3388 33.6438C17.4745 34.0677 17.7665 34.4181 18.1505 34.6179L26.7779 39.1076C27.0024 39.224 27.2497 39.2845 27.5005 39.2844C27.7521 39.2842 28.0003 39.2237 28.2257 39.1076L36.8532 34.6179C37.2372 34.4181 37.5292 34.0677 37.6649 33.6438C37.8007 33.22 37.7691 32.7573 37.5771 32.3577C37.3851 31.958 37.0484 31.6542 36.6412 31.5129C36.2339 31.3716 35.7894 31.4044 35.4054 31.6043L27.5005 35.7179L19.5983 31.6043ZM27.5005 44.8964C25.0016 44.9185 22.5537 45.6344 20.4095 46.9702C18.2654 48.306 16.5027 50.2133 15.3034 52.4951C15.2 52.6884 15.1343 52.901 15.1098 53.1207C15.0854 53.3404 15.1027 53.563 15.1609 53.7758C15.2785 54.2055 15.5552 54.5689 15.9303 54.7862C16.3053 55.0035 16.7479 55.0569 17.1608 54.9345C17.3652 54.874 17.5561 54.7721 17.7227 54.6347C17.8893 54.4973 18.0282 54.3271 18.1316 54.1338C19.0336 52.3616 20.3825 50.8787 22.0335 49.8445C23.6844 48.8102 25.5749 48.2637 27.5018 48.2637C29.4288 48.2637 31.3193 48.8102 32.9702 49.8445C34.6211 50.8787 35.9701 52.3616 36.8721 54.1338C37.0123 54.3958 37.2171 54.614 37.4655 54.7659C37.7139 54.9179 37.9967 54.998 38.2848 54.9981C38.5597 54.9989 38.83 54.9254 39.0694 54.7848C39.2551 54.6774 39.4187 54.533 39.5507 54.3598C39.6828 54.1866 39.7808 53.988 39.8392 53.7754C39.8975 53.5628 39.915 53.3403 39.8907 53.1206C39.8664 52.9009 39.8008 52.6884 39.6976 52.4951C38.4979 50.2137 36.7351 48.3067 34.591 46.971C32.4469 45.6352 29.9992 44.9191 27.5005 44.8964Z" fill="white"/></svg>'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
</head>

<body>
    <div class="app">
        <!-- Header -->
        <header class="header">
            <div class="grid__full-width">
                <nav class="header__navbar">
                <div class="header__logo">
                    <a href="/" class="header__logo-link">
                        <img src="../assets/img/logo.png" alt="" width="250px" />
                    </a>
                </div>

                    <!-- Mobile menu -->
                    <div class="mobile-menu-btn">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                    <!-- End of Mobile menu -->

                    <!-- User -->
                    <div class="header__navbar-user">
                        <i class="header__user-img fa-solid fa-user"></i>
                        <div class="header__user-controls">
                            <p class="header__user">Hello, <span class="header__user-name">
                            <?php 
                                $userId = $_SESSION['userId'];
                                $sql_getUser = "SELECT * FROM tbl_user WHERE userId = $userId LIMIT 1";
                                $query_getUser = mysqli_query($mysqli, $sql_getUser);
                                $result = mysqli_fetch_assoc($query_getUser);
                                echo $result['userEmail'];
                            ?>
                            </span></p>
                            <a href="?action=signout" class="header__user-signout"><u>Sign out</u></a>
                        </div>
                        <a href="#order__page" class="header__item-btn">
                            <i class="header__cart-icon fa-solid fa-bell"></i>
                        </a>
                    </div>
                    <!-- End of User -->
                </nav>
            </div>
        </header>
        <!-- End of Header -->

        <div class="content">
            <div class="grid__full-width">
                <div class="grid__row">
                    <div class="menu grid__col-2">
                        <!-- Menu -->
                        <ul class="menu__wrapper">
                            <li class="menu__item">
                                <a class="menu__item-link" href="?action=userInformation">
                                    <i class="menu__item-icon fa-solid fa-user"></i>   
                                    User information
                                </a>
                            </li>
                            <li class="menu__item">
                                <a class="menu__item-link" href="?action=userOrderManager">
                                    <i class="menu__item-icon fa-solid fa-star"></i>
                                    Order Manager
                                </a>
                            </li>
                        </ul>
                        <!-- End of Menu -->
                    </div>
                    <div class="grid__col-10 content__main">
                        <?php 
                            if (isset($_GET['action'])) {
                                $action = $_GET['action'];
                            } else {
                                $action = '';
                            }
                            if ($action == 'userInformation') {
                                include ("userInformation.php");
                            } else if ($action == 'userOrderManager') {
                                include ("userOrderManager.php");
                            } else if ($action == 'signout') {
                                if (isset($_SESSION['submitSignup'])) {
                                    unset($_SESSION['submitSignup']);
                                    header('Location: ../index.php');
                                }
                            } else {
                                include ("userInformation.php");
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <?php 
            include '../admin/modules/modal.php';
        ?>
    </div>
</body>
<script type="text/javascript" src="../admin/js/getParentElement.js"></script>
<script type="text/javascript" src="../admin/js/menuActive.js"></script>
<script type="text/javascript" src="../assets/js/modal.js"></script>
<script type="text/javascript" src="../admin/js/itemStatus.js"></script>
<script type="text/javascript" src="../admin/js/formatNumber.js"></script>
<script type="text/javascript" src="../assets/js/ajax_user_info.js"></script>
<script type="text/javascript" src="../assets/js/ajax_user_order.js"></script>
<script type="text/javascript" src="../assets/js/mobileMenu.js"></script>

</html>