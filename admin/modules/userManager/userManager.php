<div class="manager-site__wrapper">
    <div class="manager-site__header">
        <div class="manager-site__search-wrapper">
            <div class="manager-site__search-box">
                <input id="searchInput" type="text" class="manager-site__search-input" placeholder="Search ...">
                <i class="manager-site__search-icon fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
        <div class="manager-site__category-wrapper">
            <div class="manager-site__category">
                <input onclick="fetchUserData()" type="button" value="All" class="manager-site__category-btn btn manager-site__category-btn--active">
                <?php 
                    $sql_user = "SELECT DISTINCT userGroup FROM tbl_user";
                    $query_user = mysqli_query($mysqli, $sql_user);
                    while ($row = mysqli_fetch_array($query_user)) {
                    
                ?>
                        <input onclick="fetchUserDataByCategory('<?php echo $row['userGroup'] ?>')" type="button" value="<?php echo $row['userGroup'] ?>" class="manager-site__category-btn btn">
                <?php 
                    }
                ?>
            </div>
        </div>
    </div>
    <div id="userData" class="manager-site__body">
        <!-- Load user data from database here -->
    </div>
    <div id="userPagination" class="manager-site__pagination"></div>
</div>