function addProduct() {
    var addProductName = $('#addProductName').val().trim();
    var addProductPrice = $('#addProductPrice').val();
    var addProductGroup = $('#addProductGroup').val();
    var addProductDescribe = $('#addProductDescribe').val().trim();
    var addProductImage = $('#addProductImage')[0].files[0];

    if (addProductName === '') {
        return;
    } else if (addProductPrice === '') {
        return;
    } else if (addProductGroup === '') {
        return;
    } else if (addProductDescribe === '') {
        return;
    } else if (addProductImage === undefined) {
        return;
    }

    var formData = new FormData();
    formData.append('action', 'addProduct');
    formData.append('addProductName', addProductName);
    formData.append('addProductPrice', addProductPrice);
    formData.append('addProductGroup', addProductGroup);
    formData.append('addProductDescribe', addProductDescribe);
    formData.append('addProductImage', addProductImage)

    $.ajax({
        url: "controller/controllerProduct.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            closeModalBtn('addProduct');
            fetchProductData();
        }
    });
}

var currentProductPage = 1;

function fetchProductData() {
    $.ajax({
        url: "controller/controllerProduct.php",
        method: "POST",
        data: { 
            action: 'fetchProductData',
            page: currentProductPage,
        },
        dataType: 'json',
        success: function(data) {
            $('#productData').html(data.html);

            var totalRows = data.totalRows; 
            var totalPages = Math.ceil(totalRows / data.itemsPerPage);
            setupProductPagination(totalPages);

            formatNumber();
        }
    });
}

function fetchProductDataByCategory(productCategoryId) {
    $.ajax({
        url: "controller/controllerProduct.php",
        method: "POST",
        data: { 
            action: 'fetchProductData',
            productCategoryId: productCategoryId
        },
        dataType: 'json',
        success: function(data) {
            $('#productData').html(data.html);
            setupProductPagination(0);

            formatNumber();
        }
    });
}

function loadProductPage(page) {
    currentProductPage = page;
    fetchProductData();
}

function setupProductPagination(totalPages) {
    var paginationHtml = '';

    for (var i = 1; i <= totalPages; i++) {
        paginationHtml += '<button onclick="loadProductPage(' + i + ')" class="pagination__btn">' + i + '</button>';
    }

    $('#productPagination').html(paginationHtml);
}

function editProduct(productId) {
    $.ajax({
        url: 'controller/controllerProduct.php',
        method: 'POST',
        data: { 
            action: 'editProduct', 
            productId: productId
        },
        dataType: 'json', // Expecting JSON response
        success: function(data) {
            openModal('editProduct');
            $('#editProductId').val(productId);
            $('#editProductName').val(data.productName);
            $('#editProductPrice').val(data.productPrice);
            $('#editProductGroup').val(data.productGroup);
            $('#editProductDescribe').val(data.productDescribe);
        }
    });
}

function updateProduct() {
    var editProductId = $('#editProductId').val();
    var editProductName = $('#editProductName').val().trim();
    var editProductPrice = $('#editProductPrice').val();
    var editProductGroup = $('#editProductGroup').val();
    var editProductDescribe = $('#editProductDescribe').val().trim();
    var editProductImage = $('#editProductImage')[0].files[0];

    if (editProductName === '') {
        return;
    } else if (editProductPrice === '') {
        return;
    } else if (editProductGroup === '') {
        return;
    } else if (editProductDescribe === '') {
        return;
    }

    var formData = new FormData();
    formData.append('action', 'updateProduct');
    formData.append('editProductId', editProductId);
    formData.append('editProductName', editProductName);
    formData.append('editProductPrice', editProductPrice);
    formData.append('editProductGroup', editProductGroup);
    formData.append('editProductDescribe', editProductDescribe);
    formData.append('editProductImage', editProductImage)

    $.ajax({
        url: "controller/controllerProduct.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            closeModalBtn('editProduct');
            fetchProductData();
        },
        error: function(xhr, textStatus, errorThrown) {
            console.log('Error fetching product data: ' + errorThrown);
        }
    });
}

function deleteProductConfirmation(productId) {
    $.ajax({
        url: 'controller/controllerProduct.php',
        method: 'POST',
        data: {
            action: 'deleteProductConfirmation',
            productId: productId
        },
        success: function(data) {
            openModal('deleteProduct');
            $('#deleteProductId').val(data.productId);
        }
    });
}

function deleteProduct() {
    var productId = $('#deleteProductId').val();
    $.ajax({
        url: 'controller/controllerProduct.php',
        method: 'POST',
        data: {
            action: 'deleteProduct',
            productId: productId
        },
        success: function(data) {
            closeModalBtn('deleteProduct');
            fetchProductData();
        }
    });
}

function searchProduct() {
    $('#searchInput').keyup(function(){
        var query = $(this).val();
        if(query != ''){
            $.ajax({
                url: 'controller/controllerProduct.php',
                method: 'POST',
                data: {
                    action: 'search',
                    query: query
                },
                success: function(data){
                    $('#productData').html(data);
                }
            });
        } else {
            fetchProductData();
        }
    });
}

$(document).ready(function() {
    fetchProductData();
    searchProduct();
});