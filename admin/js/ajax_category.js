function addCategory() {
    var addCategoryName = $('#addCategoryName').val().trim();
    var addCategoryImage = $('#addCategoryImage')[0].files[0];

    if (addCategoryName === '') {
        return;
    } else if (addCategoryImage === undefined) {
        return;
    }

    var formData = new FormData();
    formData.append('action', 'addCategory');
    formData.append('addCategoryName', addCategoryName);
    formData.append('addCategoryImage', addCategoryImage)

    $.ajax({
        url: "controller/controllerCategory.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            closeModalBtn('addCategory');

            fetchCategoryData();
        }
    });
}

var currentCategoryPage = 1;

function fetchCategoryData() {
    $.ajax({
        url: "controller/controllerCategory.php",
        method: "POST",
        data: { 
            action: 'fetchCategoryData',
            page: currentCategoryPage
        },
        dataType: 'json',
        success: function(data) {
            $('#categoryData').html(data.html);

            var totalRows = data.totalRows; 
            var totalPages = Math.ceil(totalRows / data.itemsPerPage);
            setupCategoryPagination(totalPages);
        }
    });
}

function loadCategoryPage(page) {
    currentCategoryPage = page;
    fetchCategoryData();
}

function setupCategoryPagination(totalPages) {
    var paginationHtml = '';

    for (var i = 1; i <= totalPages; i++) {
        paginationHtml += '<button onclick="loadCategoryPage(' + i + ')" class="pagination__btn">' + i + '</button>';
    }

    $('#categoryPagination').html(paginationHtml);
}

function editCategory(categoryId) {
    $.ajax({
        url: 'controller/controllerCategory.php',
        method: 'POST',
        data: { 
            action: 'editCategory', 
            categoryId: categoryId
        },
        dataType: 'json', // Expecting JSON response
        success: function(data) {
            openModal('editCategory');
            $('#editCategoryName').val(data.categoryName);
            $('#editCategoryId').val(categoryId);
        }
    });
}

function updateCategory() {
    var editCategoryId  = $('#editCategoryId').val();
    var editCategoryName = $('#editCategoryName').val().trim();
    var editCategoryImage = $('#editCategoryImage')[0].files[0];

    if (editCategoryName === '') {
        return;
    }

    var formData = new FormData();
    formData.append('action', 'updateCategory');
    formData.append('editCategoryId', editCategoryId);
    formData.append('editCategoryName', editCategoryName);
    formData.append('editCategoryImage', editCategoryImage)

    $.ajax({
        url: "controller/controllerCategory.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            closeModalBtn('editCategory');
            
            fetchCategoryData();
        },
        error: function(xhr, textStatus, errorThrown) {
            console.log('Error fetching category data: ' + errorThrown);
        }
    });
}

function deleteCategoryConfirmation(categoryId) {
    $.ajax({
        url: 'controller/controllerCategory.php',
        method: 'POST',
        data: {
            action: 'deleteCategoryConfirmation',
            categoryId: categoryId
        },
        success: function(data) {
            openModal('deleteCategory');
            $('#deleteCategoryId').val(data.categoryId);
        }
    });
}

function deleteCategory() {
    var categoryId = $('#deleteCategoryId').val();
    $.ajax({
        url: 'controller/controllerCategory.php',
        method: 'POST',
        data: {
            action: 'deleteCategory',
            categoryId: categoryId
        },
        success: function(data) {
            closeModalBtn('deleteCategory');
            fetchCategoryData();
        }
    });
}

function searchCategory() {
    $('#searchInput').keyup(function(){
        var query = $(this).val();
        if(query != ''){
            $.ajax({
                url: 'controller/controllerCategory.php',
                method: 'POST',
                data: {
                    action: 'search',
                    query: query
                },
                success: function(data){
                    $('#categoryData').html(data);
                }
            });
        } else {
            fetchCategoryData();
        }
    });
}

$(document).ready(function() {
    fetchCategoryData();
    searchCategory();
});