<div class="manager-site__wrapper">
    <div class="manager-site__header">
        <div class="manager-site__search-wrapper">
            <div class="manager-site__search-box">
                <input id="searchInput" type="text" class="manager-site__search-input" placeholder="Search ...">
                <i class="manager-site__search-icon fa-solid fa-magnifying-glass"></i>
            </div>
            <button onclick="openModal('addCategory')" class="manager-site__add-btn btn">+ ADD</button>
        </div>
    </div>
    <div id="categoryData" class="manager-site__body">
        <!-- Render data from database here -->
    </div>
    <div id="categoryPagination" class="manager-site__pagination"></div>
</div>