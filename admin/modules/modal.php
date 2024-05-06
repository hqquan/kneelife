<div class="modal">
    <div class="modal__overlay"></div>
    <div class="modal__body">
        <div name="addProductModal" class="add__modal">
            <h1 class="add__modal-header">Add new product</h1>
            <form class="add__modal-wrapper" action="javascript:void(0);" method="POST" enctype="multipart/form-data">
                <div class="add__input-group">
                    <label for="addProductName" class="add__input-label">Name <span class="add__input-require">*</span></label>
                    <input id="addProductName" type="text" class="add__input-text" required>
                </div>
                <div class="add__input-group">
                    <label for="addProductPrice" class="add__input-label">Price (VND) <span class="add__input-require">*</span></label>
                    <input id="addProductPrice" min="0" class="add__input-text price-input" required>
                </div>
                <div class="add__input-group">
                    <label for="addProductGroup" class="add__input-label">Group <span class="add__input-require">*</span></label>
                    <select id="addProductGroup" class="add__input-text" required>
                        <option value="">-- Category --</option>
                        <?php 
                            $sql_fetchCategoryGroup = "SELECT * FROM tbl_category ORDER BY categoryId ASC";
                            $query_fetchCategoryGroup = mysqli_query($mysqli, $sql_fetchCategoryGroup);
                            while ($row = mysqli_fetch_array($query_fetchCategoryGroup)) {
                        ?>
                            <option value="<?php echo $row['categoryId'] ?>"><?php echo $row['categoryName'] ?></option>
                        <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="add__input-group">
                    <label for="addProductDescribe" class="add__input-label">Describe <span class="add__input-require">*</span></label>
                    <textarea id="addProductDescribe" class="add__input-text" cols="30" rows="5" required></textarea>
                </div>
                <div class="add__input-group">
                    <label for="addProductImage" class="add__input-label">Image <span class="add__input-require">*</span></label>
                    <input id="addProductImage" type="file" class="add__input-text" accept="image/*" required>
                </div>
                <div class="add__btn-wrapper">
                    <input onclick="addProduct()" class="add__btn" type="submit" value="Add new product">
                    <input type="button" class="add__btn cancel" onclick="closeModalBtn('addProduct')" value="Cancel">
                </div>
            </form>
        </div>
        <div name="addCategoryModal" class="add__modal">
            <h1 class="add__modal-header">Add new category</h1>
            <form class="add__modal-wrapper" action="javascript:void(0);" id="addCategoryForm" method="POST" enctype="multipart/form-data">
                <div class="add__input-group">
                    <label for="addCategoryName" class="add__input-label">Category name <span class="add__input-require">*</span></label>
                    <input id="addCategoryName" type="text" class="add__input-text" required>
                </div>
                <div class="add__input-group">
                    <label for="addCategoryImage" class="add__input-label">Category image <span class="add__input-require">*</span></label>
                    <input id="addCategoryImage" type="file" class="add__input-text" accept="image/*" required>
                </div>
                <div class="add__btn-wrapper">
                    <input onclick="addCategory()" class="add__btn" type="submit" value="Add new category">
                    <input type="button" class="add__btn cancel" onclick="closeModalBtn('addCategory')" value="Cancel">
                </div>
            </form>
        </div>
        <div name="deleteCategoryModal" class="delete__modal">
            <form method="POST" action="javascript:void(0);">
                <input type="hidden" id="deleteCategoryId">
                <i class="delete__icon fa-solid fa-exclamation"></i>
                <p class="delete__message">
                    Are you sure you want to delete current data? These data cannot be recovered
                </p>
                <div class="delete__btn-wrapper">
                    <input onclick="deleteCategory()" class="delete__btn btn" type="submit" value="Delete">
                    <input type="button" class="cancel__btn btn" onclick="closeModalBtn('deleteCategory')" value="Cancel">
                </div>
            </form>
        </div>
        <div name="deleteProductModal" class="delete__modal">
            <form method="POST" action="javascript:void(0);">
                <input type="hidden" id="deleteProductId">
                <i class="delete__icon fa-solid fa-exclamation"></i>
                <p class="delete__message">
                    Are you sure you want to delete current data? These data cannot be recovered
                </p>
                <div class="delete__btn-wrapper">
                    <input onclick="deleteProduct()" class="delete__btn btn" type="submit" value="Delete">
                    <input type="button" class="cancel__btn btn" onclick="closeModalBtn('deleteProduct')" value="Cancel">
                </div>
            </form>
        </div>
        <div name="deleteUserModal" class="delete__modal">
            <form method="POST" action="javascript:void(0);">
                <input type="hidden" id="deleteUserId">
                <i class="delete__icon fa-solid fa-exclamation"></i>
                <p class="delete__message">
                    Are you sure you want to delete current data? These data cannot be recovered
                </p>
                <div class="delete__btn-wrapper">
                    <input onclick="deleteUser()" class="delete__btn btn" type="submit" value="Delete">
                    <input type="button" class="cancel__btn btn" onclick="closeModalBtn('deleteUser')" value="Cancel">
                </div>
            </form>
        </div>
        <div name="deleteOrderModal" class="delete__modal">
            <form method="POST" action="javascript:void(0);">
                <input type="hidden" id="deleteOrderId">
                <i class="delete__icon fa-solid fa-exclamation"></i>
                <p class="delete__message">
                    Are you sure you want to delete current data? These data cannot be recovered
                </p>
                <div class="delete__btn-wrapper">
                    <input onclick="deleteOrder()" class="delete__btn btn" type="submit" value="Delete">
                    <input type="button" class="cancel__btn btn" onclick="closeModalBtn('deleteOrder')" value="Cancel">
                </div>
            </form>
        </div>
        <div name="viewDetailModal" class="detail__modal">
            <h1 class="detail__header">Order - <span id="orderDetailOrderCode" class="detail__order-id"></span></h1>
            <input type="hidden" id="orderDetailOrderId">
            <div class="detail__user-info">
                <div class="detail__info-row">
                    <p class="detail__info-header">Name:</p>
                    <p id="orderDetailUserName" class="detail__info-data">Nguyễn Văn A</p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">Phone:</p>
                    <p id="orderDetailUserPhone" class="detail__info-data">090123456</p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">Address:</p>
                    <p id="orderDetailUserAddress" class="detail__info-data">KTX Khu B, ĐHQG TP.HCM</p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">Time:</p>
                    <p id="orderDetailOrderTime" class="detail__info-data">11:00 AM, 11/12/2023</p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">Shipping unit:</p>
                    <p class="detail__info-data">Vietnammm.com</p>
                </div>
            </div>
            <div id="orderDetailData" class="detail__user-order">
                <!-- Load data from database here -->
            </div>
            <div class="detail__user-bill">
                <div class="detail__info-row">
                    <p class="detail__info-header">Sub-total</p>
                    <p id="orderDetailSubTotal" class="detail__info-data price"></p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">Shipping</p>
                    <p id="orderDetailShipping" class="detail__info-data price"></p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">VAT 8%</p>
                    <p id="orderDetailVat" class="detail__info-data price"></p>
                </div>
                <div class="detail__info-row">
                    <p class="detail__info-header">Discount</p>
                    <p id="orderDetailDiscount" class="detail__info-data price"></p>
                </div>
                <div class="detail__info-row total">
                    <p class="detail__info-header">Total</p>
                    <p id="orderDetailTotal" class="detail__info-data price"></p>
                </div>
            </div>
            <div class="detail__btn-wrapper">
                <input onclick="acceptOrder()" class="detail__btn accept" type="button" value="Accept order">
                <input onclick="cancelOrder()" class="detail__btn cancel" type="button" value="Cancel order">
                <button class="detail__btn print" onclick="window.print();return false">Print</button>
            </div>
        </div>
        <div name="addVoucherModal" class="add__modal">
            <h1 class="add__modal-header">Add new voucher</h1>
            <form class="add__modal-wrapper" action="" method="">
                <div class="add__input-group-wrapper">
                    <div class="add__input-group">
                        <label for="" class="add__input-label">Group <span class="add__input-require">*</span></label>
                        <select name="" class="add__input-text" required>
                            <option value="">-- Voucher type --</option>
                            <option value="">Discount</option>
                            <option value="">Freeship</option>
                        </select>
                    </div>
                    <div class="add__input-group">
                        <label for="" class="add__input-label">Value (VND) <span class="add__input-require">*</span></label>
                        <input type="number" class="add__input-text" min="0" required>
                    </div>
                </div>
                <div class="add__input-group-wrapper">
                    <div class="add__input-group">
                        <label for="" class="add__input-label">Effective date <span class="add__input-require">*</span></label>
                        <input type="date" class="add__input-text" required>
                    </div>
                    <div class="add__input-group">
                        <label for="" class="add__input-label">Expiration date <span class="add__input-require">*</span></label>
                        <input type="date" class="add__input-text" required>
                    </div>
                </div>
                <div class="add__input-group-wrapper">               
                    <div class="add__input-group">
                        <label for="" class="add__input-label">Bill over (VND)</label>
                        <input type="number" min="0" class="add__input-text">
                    </div>
                    <div class="add__input-group">
                        <label for="" class="add__input-label">Discount maximum (VND)</label>
                        <input type="number" min="0" class="add__input-text">
                    </div>
                </div>
                <div class="add__input-group">
                    <label for="" class="add__input-label">Quantity</label>
                    <input type="number" class="add__input-text" min="1" required>
                </div>
                <div class="add__btn-wrapper">
                    <input class="add__btn" type="submit" value="Create">
                    <button class="add__btn cancel" onclick="closeModalBtn('addVoucher')">Cancel</button>
                </div>
            </form>
        </div>
        <div name="editProductModal" class="edit__modal">
            <form class="edit__modal-wrapper" method="POST" action="javascript:void(0);" enctype="multipart/form-data">
                <input type="hidden" id="editProductId" value="">
                <div class="edit__modal-input-wrapper">
                    <div class="edit__input-group">
                        <label for="editProductName" class="edit__input-label">Name</label>
                        <input id="editProductName" type="text" class="edit__input-text" required>
                    </div>
                    <div class="edit__input-group-wrapper">
                        <div class="edit__input-group">
                            <label for="editProductPrice" class="edit__input-label">Price (VND)</label>
                            <input id="editProductPrice" min="0" class="edit__input-text price-input" required>
                        </div>
                        <div class="edit__input-group">
                            <label for="editProductGroup" class="edit__input-label">Group</label>
                            <select id="editProductGroup" class="edit__input-text" required>
                                <option value="">-- Category --</option>
                                <?php 
                                    $sql_category = "SELECT * FROM tbl_category ORDER BY categoryId ASC";
                                    $query_category = mysqli_query($mysqli, $sql_category);
                                    while ($row_category = mysqli_fetch_array($query_category)) {
                                ?>
                                    <option value="<?php echo $row_category['categoryId'] ?>"><?php echo $row_category['categoryName'] ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="edit__input-group">
                        <label for="editProductDescribe" class="edit__input-label">Describe</label>
                        <input id="editProductDescribe" type="text" class="edit__input-text" required>
                    </div>
                    <div class="edit__input-group">
                        <label for="editProductImage" class="edit__input-label">Image</label>
                        <input id="editProductImage" type="file" class="edit__input-text" accept="image/*">
                    </div>
                    <div class="edit__btn-wrapper">
                        <input onclick="updateProduct()" class="edit__btn" type="submit" value="Save">
                        <input type="button" class="edit__btn cancel" onclick="closeModalBtn('editProduct')" value="Cancel">
                    </div>
                </div>
            </form>
        </div>
        <div name="editCategoryModal" class="edit__modal">
            <form id="editCategoryForm" class="edit__modal-wrapper" action="javascript:void(0);" method="POST" enctype="multipart/form-data">
                <input id="editCategoryId" type="hidden">
                <div class="edit__modal-input-wrapper">
                    <div class="edit__input-group">
                        <label for="editCategoryName" class="edit__input-label">Name</label>
                        <input id="editCategoryName" type="text" class="edit__input-text" required>
                    </div>
                    <div class="edit__input-group">
                        <label for="editCategoryImage" class="edit__input-label">Image</label>
                        <input id="editCategoryImage" type="file" class="edit__input-text" accept="image/*">
                    </div>
                    <div class="edit__btn-wrapper">
                        <input type="submit" onclick="updateCategory()" class="edit__btn" value="Save">
                        <input type="button" onclick="closeModalBtn('editCategory')" class="edit__btn cancel" value="Cancel">
                    </div>
                </div>
            </form>
        </div>
        <div name="editUserModal" class="edit__modal">
            <form class="edit__modal-wrapper" method="POST" action="javascript:void(0);">
                <input type="hidden" id="editUserId">
                <div class="edit__modal-input-wrapper">
                    <div class="edit__input-group-wrapper">
                        <div class="edit__input-group">
                            <label for="editUserPhone" class="edit__input-label">Phone</label>
                            <input id="editUserPhone" type="text" class="edit__input-text" disabled>
                        </div>
                        <div class="edit__input-group">
                            <label for="editUserRegisterDate" class="edit__input-label">Register date</label>
                            <input id="editUserRegisterDate" type="text" class="edit__input-text" disabled>
                        </div>
                    </div>
                    <div class="edit__input-group-wrapper">
                        <div class="edit__input-group">
                            <label for="editUserName" class="edit__input-label">Name</label>
                            <input id="editUserName" type="text" class="edit__input-text" required>
                        </div>
                        <div class="edit__input-group">
                            <label for="editUserGroup" class="edit__input-label">Group</label>
                            <select id="editUserGroup" class="edit__input-text" required>
                                <option value="">-- Group --</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                    </div>
                    <div class="edit__input-group">
                        <label for="editUserEmail" class="edit__input-label">Mail</label>
                        <input id="editUserEmail" type="email" class="edit__input-text" disabled>
                    </div>
                    <div class="edit__btn-wrapper">
                        <input onclick="updateUser()" class="edit__btn" type="submit" value="Save">
                        <input type="button" class="edit__btn cancel" onclick="closeModalBtn('editUser')" value="Cancel">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>