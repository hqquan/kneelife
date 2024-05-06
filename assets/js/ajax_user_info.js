function editUser() {
	var userId = $('#userId').val();
	$.ajax({
		url: '../assets/controller/controllerUserInfo.php',
		method: 'POST',
		data: {
			action: 'editUser',
			userId: userId,
		},
		dataType: 'json', // Expecting JSON response
		success: function (data) {
			$('#editUserInfoName').val(data.userName);
			$('#editUserInfoPhone').val(data.userPhone);
			$('#editUserInfoRegisterDate').val(data.userRegisterDate);
			$('#editUserInfoEmail').val(data.userEmail);
			$('#editUserInfoGroup').val(data.userGroup);
			$('#editUserInfoId').val(userId);
		},
	});
}

function updateUser() {
	var editUserId = $('#userId').val();
	var editUserName = $('#editUserInfoName').val().trim();
	var editUserPhone = $('#editUserInfoPhone').val().trim();
	var editUserEmail = $('#editUserInfoEmail').val().trim();

	if (editUserName === '' || editUserEmail === '' || editUserPhone === '') {
		return;
	}

	var formData = new FormData();
	formData.append('action', 'updateUser');
	formData.append('editUserId', editUserId);
	formData.append('editUserName', editUserName);
	formData.append('editUserPhone', editUserPhone);
	formData.append('editUserEmail', editUserEmail);

	$.ajax({
		url: '../assets/controller/controllerUserInfo.php',
		method: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function (data) {
			if (data != 1) {
				var err_email_message =
					'Email has been already signed up, try another email.';
				$('#auth-form__error-email').text(err_email_message);
				$('#auth-form__error-email').show();
			} else {
				alert('Update success!');
				window.location.reload();
			}
		},
	});
}

function updateUserPassword() {
	// var editUserId  = $('#userId').val();
	var editUserEmail = $('#userEmail').val();
	var editUserOldPassword = $('#editUserInfoOldPassword').val().trim();
	var editUserNewPassword = $('#editUserInfoNewPassword').val().trim();

	if (editUserOldPassword === '' || editUserNewPassword === '') {
		return;
	}

	var formData = new FormData();
	formData.append('action', 'updateUserPassword');
	// formData.append('editUserId', editUserId);
	formData.append('editUserEmail', editUserEmail);
	formData.append('editUserOldPassword', editUserOldPassword);
	formData.append('editUserNewPassword', editUserNewPassword);

	$.ajax({
		url: '../assets/controller/controllerUserInfo.php',
		method: 'POST',
		data: formData,
		processData: false,
		contentType: false,
		success: function (data) {
			if (data != 1) {
				var err_pass_message = 'Password not match, please try again.';
				$('#auth-form__error-pass').text(err_pass_message);
				$('#auth-form__error-pass').show();
			} else {
				alert('Update success!');
				window.location.reload();
			}
		},
	});
}

$(document).ready(function () {
	editUser();
});
