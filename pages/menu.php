<!-- Menu page -->
<section id="menu__page">
    <div class="menu__page-container grid__full-width grid__row">
        <div class="menu__order-wrapper grid__col-8">
            <!-- <div class="menu__search">
                <i class="menu__search-icon fa-solid fa-magnifying-glass"></i>
                <input type="text" class="menu__search-input" placeholder="What would you like to eat?">
                <i class="menu__search-icon fa-solid fa-bars"></i>
            </div> -->
            <ul class="menu__category-list grid__row">
                <?php 
                    $sql_show_category = "SELECT * FROM tbl_category ORDER BY categoryId ASC";
                    $query_show_category = mysqli_query($mysqli, $sql_show_category);
                    $i = 0;
                    while ($row = mysqli_fetch_array($query_show_category)) {
                        $i++;
                ?>
                    <li class="grid__col-1-8">
                        <div class="menu__category-item <?php if ($i == 1) { echo "menu__category-item--active"; } ?>" name="menu<?php echo $row['categoryId'] ?>">
                            <img class="menu__category-item-img" src="admin/upload/<?php echo $row['categoryImage'] ?>">
                            <h1 class="menu__category-item-name"><?php echo $row['categoryName'] ?></h1>
                        </d>
                    </li>
                <?php
                    }
                ?>
            </ul>
            <div class="menu__product-list-wrapper menu__product-scroll-btn--active">
                <span class="menu__product-scroll-btn btn--hover btn-left"><i class="fa-solid fa-chevron-left"></i></span>
                <?php 
                    $sql_category = "SELECT * FROM tbl_category ORDER BY categoryId ASC";
                    $query_category = mysqli_query($mysqli, $sql_category);
                    $i = 0;
                    while ($row_category = mysqli_fetch_array($query_category)) {
                        $i++;
                ?>
                        <ul class="menu__product-list <?php if ($i == 1) { echo "menu__product-list--active"; } ?> grid__row" name="menu<?php echo $row_category['categoryId'] ?>">
                            <?php 
                                $sql_show_product = "SELECT * FROM tbl_product WHERE productGroup = '".$row_category['categoryId']."'";
                                $query_show_product = mysqli_query($mysqli, $sql_show_product);
                                while ($row_product = mysqli_fetch_array($query_show_product)) {
                            ?>
                                <li class="grid__col-2-8">
                                    <div class="menu__product-wrapper" id="<?php echo $row_product['productId'] ?>">
                                        <img src="admin/upload/<?php echo $row_product['productImage'] ?>" class="menu__product-img" name="productDetail">
                                        <h1 class="menu__product-name"><?php echo $row_product['productName'] ?></h1>
                                        <span class="menu__product-btn btn--hover"><img src="./assets/img/item-btn.png"></span>
                                        <h2 class="menu__product-price"><?php echo $row_product['productPrice'] ?></h2>
                                        <p class="menu__product-desc"><?php echo $row_product['productDescribe'] ?></p>
                                    </div>
                                </li>
                            <?php 
                                }  
                            ?>
                        </ul>
                <?php 
                    }
                ?>
                <span class="menu__product-scroll-btn btn--hover btn-right"><i class="fa-solid fa-chevron-right"></i></span>
            </div>
        </div>
        <div class="menu__user-wrapper grid__col-4">
            <div class="menu__user-address">
                <h1 class="menu__address-header">My Address</h1>
                <p class="menu__address-sub-header">Delivery address</p>
                <div class="userInfoData">
                    <!-- Load user info data -->
                </div>
                <?php 
                    $userId = 0;
                    if (isset($_SESSION['submitSignup'])) {
                        $userEmail = $_SESSION['submitSignup'];
                        $sql_user = "SELECT u.*, ui.*
                                    FROM tbl_user u
                                    JOIN tbl_user_info ui ON u.userId = ui.userId
                                    WHERE u.userEmail = '$userEmail'";
                        $query_user = mysqli_query($mysqli, $sql_user);
                        $row = mysqli_fetch_assoc($query_user);
                        $userId = $row['userId'];
                        // if ($row['userStreetAddress']) {
                        //     echo "<p class='menu__address-info'>".$row['userStreetAddress'].", ".$row['userCity']."</p>";
                        // } else {
                        //     echo "<p class='menu__address-info'>Please enter address</p>";
                        // }
                    }
                ?>
                <div class="menu__address-ship">
                    <p class="menu__ship-time"><i class="menu__ship-icon fa-solid fa-clock"></i>15-20 mins</p>
                    <p class="menu__ship-distance"><i class="menu__ship-icon fa-solid fa-location-dot"></i>5km</p>
                </div>
                <button id="userId" onclick="changeInfo(<?php echo $userId; ?>)" value="<?php echo $userId; ?>" class="menu__address-change-btn">*Change address direction*</button>
            </div>
            <div class="menu__cart-item-wrapper">
                <h1 class="menu__cart-header">My Cart</h1>
            </div>
            <a href="#order__page" class="menu__cart-btn btn btn--primary">Check out</a>
        </div>
    </div>
</section>
<!-- End of Menu page -->