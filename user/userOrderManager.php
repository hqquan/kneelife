<input type="hidden" id="userId" value="<?php echo $_SESSION['userId']; ?>">
<div class="manager-site__wrapper">
    <div class="manager-site__header">
        <div class="manager-site__search-wrapper">
            <div class="manager-site__search-box">
                <input id="searchInput" type="text" class="manager-site__search-input" placeholder="Search ...">
                <i class="manager-site__search-icon fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
    </div>
    <div id="orderData" class="manager-site__body" style="overflow-x:auto;">
        <!-- Render data from database here -->
    </div>
    <div id="orderPagination" class="manager-site__pagination"></div>
</div>