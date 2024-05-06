<div class="manager-site__wrapper">
    <div class="manager-site__header">
        <div class="manager-site__search-wrapper">
            <div class="manager-site__search-box">
                <input type="text" class="manager-site__search-input" placeholder="Search ...">
                <i class="manager-site__search-icon fa-solid fa-magnifying-glass"></i>
            </div>
            <input type="date" class="manager-site__date-btn btn" >
            <button name="addVoucher" class="manager-site__add-btn btn">+ ADD</button>
        </div>
        <div class="manager-site__category-wrapper">
            <div class="manager-site__category">
                <button class="manager-site__category-btn btn manager-site__category-btn--active">All</button>
                <button class="manager-site__category-btn btn">Wait</button>
                <button class="manager-site__category-btn btn">Used</button>
                <button class="manager-site__category-btn btn">Cancel</button>
            </div>
            <button name="delete" class="manager-site__category-delete-btn btn">
                <i class="manager-site__btn-icon fa-solid fa-trash"></i>
            </button>
        </div>
    </div>
    <div class="manager-site__body">
        <table class="manager-site__manager">
            <tr class="manager-site__manager-row">
                <th class="manager-site__manager-header">ID</th>
                <th class="manager-site__manager-header">GROUP</th>
                <th class="manager-site__manager-header">VALUE</th>
                <th class="manager-site__manager-header">EXPIRATION DATE</th>
                <th class="manager-site__manager-header">STATUS</th>
                <th class="manager-site__manager-header">ID ORDER</th>
                <th class="manager-site__manager-header">ID USER</th>
                <th class="manager-site__manager-header">USE TIME</th>
                <th class="manager-site__manager-header">CONSTRAINT</th>
                <th class="manager-site__manager-header">DELETE</th>
            </tr>
            <tr class="manager-site__manager-row">
                <td class="manager-site__manager-data">001</td>
                <td class="manager-site__manager-data">Freeship</td>
                <td class="manager-site__manager-data">20,000 VND</td>
                <td class="manager-site__manager-data">12/12/2023</td>
                <td class="manager-site__manager-data">
                    <span class="item-status">Wait</span>
                </td>
                <td class="manager-site__manager-data"></td>
                <td class="manager-site__manager-data"></td>
                <td class="manager-site__manager-data"></td>
                <td class="manager-site__manager-data">Over 200</td>
                <td class="manager-site__manager-data">
                    <input class="data__checkbox" type="checkbox" name="" id="">
                </td>
            </tr>
        </table>
    </div>
</div>