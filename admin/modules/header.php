<!-- Header -->
<header class="header">
    <div class="grid__full-width">
        <nav class="header__navbar">
            <div class="header__logo">
                <a href="/" class="header__logo-link" target="_blank">
                    <img src="../../assets/img/logo.png" alt="" width="230px">
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
                    <p class="header__user">Hello, <span class="header__user-name"><?php if(isset($_SESSION['signin'])) { echo $_SESSION['signin']; } ?></span></p>
                    <a href="index.php?action=signout&query=null" class="header__user-signout"><u>Sign out</u></a>
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