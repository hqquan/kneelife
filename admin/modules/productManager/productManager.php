<div class="manager-site__wrapper">
    <div class="manager-site__header">
        <div class="manager-site__search-wrapper">
            <div class="manager-site__search-box">
                <input id="searchInput" type="text" class="manager-site__search-input" placeholder="Search ...">
                <i class="manager-site__search-icon fa-solid fa-magnifying-glass"></i>
            </div>
            <button onclick="openModal('addProduct')" class="manager-site__add-btn btn">+ ADD</button>
        </div>
        <div class="manager-site__category-wrapper">
            <div class="manager-site__category">
                <input onclick="fetchProductData()" type="button" value="All" class="manager-site__category-btn btn manager-site__category-btn--active">
                <?php 
                    $sql_category = "SELECT * FROM tbl_category ORDER BY categoryId ASC";  
                    $query_category = mysqli_query($mysqli, $sql_category);

                    while ($row = mysqli_fetch_array($query_category)) {
                ?>
                    <input onclick="fetchProductDataByCategory(<?php echo $row['categoryId'] ?>)" type="button" value="<?php echo $row['categoryName'] ?>" class="manager-site__category-btn btn">
                <?php 
                    }
                ?>
            </div>
        </div>
    </div>
    <div id="productData" class="manager-site__body">
        <!-- Load product data from database here -->

    </div>
    <div id="productPagination" class="manager-site__pagination"></div>
</div>