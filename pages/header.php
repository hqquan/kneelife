<!-- Header -->
<header class="header">
    <div class="grid__full-width">
        <nav class="header__navbar">
            <div class="header__logo">
                <a href="/" class="header__logo-link">
                    <img src="./assets/img/logo.png" alt="" width="250px" />
                </a>
            </div>

            <!-- Mobile menu -->
            <div class="mobile-menu-btn">
                <i class="fa-solid fa-bars"></i>
            </div>
            <!-- End of Mobile menu -->

            <ul class="header__navbar-nav">
                <li class="header__navbar-item">
                    <a href="#home__page" class="header__item-link header__item-link--active">Home</a>
                </li>
                <li class="header__navbar-item">
                    <a href="#menu__page" class="header__item-link">Product</a>
                </li>
                <li class="header__navbar-item">
                    <a href="#order__page" class="header__item-link">Cart</a>
                </li>
                <li class="header__navbar-item">
                    <a href="#consult__page" class="header__item-link">Consult</a>
                </li>
            </ul>
            <?php 
                if (isset($_SESSION['submitSignup'])) {
                    echo '
                        <!-- User -->
                        <div class="header__navbar-user">
                            <a href="user/user.php" class="header__item-btn">
                                <i class="header__user-img fa-solid fa-user"></i>
                            </a>
                            <div class="header__user-controls">
                                <p class="header__user">Hello, <span class="header__user-name">'.$_SESSION['submitSignup'].'</span></p>
                                <a href="index.php?action=signout" class="header__user-signout"><u>Sign out</u></a>
                            </div>
                            <a href="#order__page" class="header__item-btn">
                                <i class="header__cart-icon fa-solid fa-cart-shopping"></i>
                            </a>
                        </div>
                        <!-- End of User -->
                    ';
                } else {
                    echo '
                        <ul class="header__navbar-control">
                            <li class="header__navbar-item" name="signin">
                                <a href="" onclick="return false;" class="header__item-btn">Sign in</a>
                            </li>
                            <li class="header__navbar-item" name="signup">
                                <a href="" onclick="return false;" class="header__item-btn">Sign up</a>
                            </li>
                            <li class="header__navbar-item header__cart">
                                <a href="#order__page" class="header__item-btn">
                                    <i class="header__cart-icon fa-solid fa-cart-shopping"></i>
                                </a>
                            </li>
                        </ul>
                    ';
                }
            ?>

            
        </nav>
    </div>
</header>
<!-- End of Header -->