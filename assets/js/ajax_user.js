function submitSignup() {
    var userName = $('#userName').val();
    var userPhone = $('#userPhone').val();
    var userEmail = $('#userEmailSignup').val();
    var userPassword = $('#userPasswordSignup').val();
    var userConfirmPassword = $('#userConfirmPassword').val();

    if (userName == '' || userPhone == '' || userEmail == '' || userPassword == ''|| userConfirmPassword == '') {
        return;
    }

    var formData = new FormData();
    formData.append('action', 'submitSignup');
    formData.append('userName', userName);
    formData.append('userPhone', userPhone);
    formData.append('userEmail', userEmail);
    formData.append('userPassword', userPassword);
    formData.append('userConfirmPassword', userConfirmPassword);

    $.ajax({
        url: 'assets/controller/controllerUser.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data != 1) {
                var err_pass_message = "Password not match, please try again.";
                var err_email_message = "Email has been already signed up, try another email.";
                $('#auth-form__error-pass').text(err_pass_message);
                $('#auth-form__error-email').text(err_email_message);

                if (data === 'error-pass') {
                    $('#auth-form__error-pass').show();
                    $('#auth-form__error-email').hide();
                } else if (data === 'error-email') {
                    $('#auth-form__error-email').show();
                    $('#auth-form__error-pass').hide();
                } else {
                    $('#auth-form__error-pass').show();
                    $('#auth-form__error-email').show();
                }
            } else {
                window.location.reload();
            }
        },
    });
}

function submitSignin() {
    var userEmail = $('#userEmailSignin').val();
    var userPassword = $('#userPasswordSignin').val();
    $.ajax({
        url: 'assets/controller/controllerUser.php',
        method: 'POST',
        data: {
            action: 'submitSignin',
            userEmail: userEmail,
            userPassword: userPassword
        },
        dataType: 'json',
        success: function (data) {
            if (data == 0) {
                var err_message = "Email or password not match. Please try again!";
                $('.auth-form__error').show();
                $('.auth-form__error').text(err_message);
            } else {
                window.location.reload();
            }
        },
    });
}

function changeInfo(userId) {
    if (userId === 0) {
        alert('Please sign in to continue!');
        return;
    }
    $.ajax({
        url: 'assets/controller/controllerUser.php',
        method: 'POST',
        data: {
            action: 'changeInfo',
            userId: userId
        },
        dataType: 'json',
        success: function (data) {
            openModal('changeInfo');
            $('#changeInfoUserName').val(data.userName);
            $('#changeInfoUserPhone').val(data.userPhone);
            $('#changeInfoUserStreetAddress').val(data.userStreetAddress);
            $('#changeInfoUserOptional').val(data.userOptional);
            $('#changeInfoUserCity').val(data.userCity);
            $('#changeInfoUserId').val(data.userId);
            $('#changeInfoUserInfoId').val(data.userInfoId);
        }
    });
}

function updateInfo() {
    var userId = $('#changeInfoUserId').val();
    var userInfoId = $('#changeInfoUserInfoId').val();
    var userName = $('#changeInfoUserName').val().trim();
    var userPhone = $('#changeInfoUserPhone').val().trim();
    var userStreetAddress = $('#changeInfoUserStreetAddress').val().trim();
    var userOptional = $('#changeInfoUserOptional').val();
    var userCity = $('#changeInfoUserCity').val().trim();

    if (userName == '' || userPhone == '' || userStreetAddress == '' || userCity == '') {
        return;
    }

    var formData = new FormData();
    formData.append('action', 'updateInfo');
    formData.append('userId', userId);
    formData.append('userInfoId', userInfoId);
    formData.append('userName', userName);
    formData.append('userPhone', userPhone);
    formData.append('userStreetAddress', userStreetAddress);
    formData.append('userOptional', userOptional);
    formData.append('userCity', userCity);

    $.ajax({
        url: 'assets/controller/controllerUser.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            closeModalBtn('changeInfo');
            fetchUserInfoData();
        }
    });
}

function fetchUserInfoData() {
    var userId = $('#userId').val();
    $.ajax({
        url: 'assets/controller/controllerUser.php',
        method: "POST",
        data: { 
            action: 'fetchUserInfoData',
            userId: userId
        },
        dataType: 'json',
        success: function(data) {
            $('.userInfoData').html(data.html);
        }
    });
}

$(document).ready(function() {
    fetchUserInfoData();
});