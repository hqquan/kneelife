var currentUserPage = 1;

function fetchUserData() {
    $.ajax({
        url: "controller/controllerUser.php",
        method: "POST",
        data: { 
            action: 'fetchUserData',
            page: currentUserPage
        },
        dataType: 'json',
        success: function(data) {
            $('#userData').html(data.html);

            var totalRows = data.totalRows; 
            var totalPages = Math.ceil(totalRows / data.itemsPerPage);
            setupUserPagination(totalPages);
        }
    });
}

function fetchUserDataByCategory(userGroup) {
    $.ajax({
        url: "controller/controllerUser.php",
        method: "POST",
        data: { 
            action: 'fetchUserData',
            userGroup: userGroup
        },
        dataType: 'json',
        success: function(data) {
            $('#userData').html(data.html);
            setupUserPagination(0);
        }
    });
}

function loadUserPage(page) {
    currentUserPage = page;
    fetchUserData();
}

function setupUserPagination(totalPages) {
    var paginationHtml = '';

    for (var i = 1; i <= totalPages; i++) {
        paginationHtml += '<button onclick="loadUserPage(' + i + ')" class="pagination__btn">' + i + '</button>';
    }

    $('#userPagination').html(paginationHtml);
}

function editUser(userId) {
    $.ajax({
        url: 'controller/controllerUser.php',
        method: 'POST',
        data: { 
            action: 'editUser', 
            userId: userId
        },
        dataType: 'json', // Expecting JSON response
        success: function(data) {
            openModal('editUser');
            $('#editUserName').val(data.userName);
            $('#editUserPhone').val(data.userPhone);
            $('#editUserRegisterDate').val(data.userRegisterDate);
            $('#editUserEmail').val(data.userEmail);
            $('#editUserGroup').val(data.userGroup);
            $('#editUserId').val(userId);
        }
    });
}

function updateUser() {
    var editUserId  = $('#editUserId').val();
    var editUserName = $('#editUserName').val().trim();
    var editUserGroup = $('#editUserGroup').val();

    if (editUserName === '') {
        return;
    } else if (editUserGroup === '') {
        return;
    }

    var formData = new FormData();
    formData.append('action', 'updateUser');
    formData.append('editUserId', editUserId);
    formData.append('editUserName', editUserName);
    formData.append('editUserGroup', editUserGroup)

    $.ajax({
        url: "controller/controllerUser.php",
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
            closeModalBtn('editUser');
            
            fetchUserData();
        },
        error: function(xhr, textStatus, errorThrown) {
            console.log('Error fetching user data: ' + errorThrown);
        }
    });
}

function deleteUserConfirmation(userId) {
    $.ajax({
        url: 'controller/controllerUser.php',
        method: 'POST',
        data: {
            action: 'deleteUserConfirmation',
            userId: userId
        },
        success: function(data) {
            openModal('deleteUser');
            $('#deleteUserId').val(data.userId);
        }
    });
}

function deleteUser() {
    var userId = $('#deleteUserId').val();
    $.ajax({
        url: 'controller/controllerUser.php',
        method: 'POST',
        data: {
            action: 'deleteUser',
            userId: userId
        },
        success: function(data) {
            closeModalBtn('deleteUser');
            fetchUserData();
        }
    });
}

function searchUser() {
    $('#searchInput').keyup(function(){
        var query = $(this).val();
        if(query != ''){
            $.ajax({
                url: 'controller/controllerUser.php',
                method: 'POST',
                data: {
                    action: 'search',
                    query: query
                },
                success: function(data){
                    $('#userData').html(data);
                }
            });
        } else {
            fetchUserData();
        }
    });
}

$(document).ready(function() {
    fetchUserData();
    searchUser();
});