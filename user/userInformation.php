<input type="hidden" id="userId" value="<?php echo $_SESSION['userId']; ?>">
<input type="hidden" id="userEmail" value="<?php echo $_SESSION['submitSignup']; ?>">
<div class="edit__modal">
    <form class="edit__modal-wrapper" method="POST" action="javascript:void(0);">
        <div class="edit__modal-input-wrapper">
            <div class="edit__input-group-wrapper">
                <div class="edit__input-group">
                    <label for="editUserInfoPhone" class="edit__input-label">Phone</label>
                    <input id="editUserInfoPhone" type="text" class="edit__input-text" required>
                </div>
                <div class="edit__input-group">
                    <label for="editUserInfoRegisterDate" class="edit__input-label">Register date</label>
                    <input id="editUserInfoRegisterDate" type="text" class="edit__input-text" disabled>
                </div>
            </div>
            <div class="edit__input-group-wrapper">
                <div class="edit__input-group">
                    <label for="editUserInfoName" class="edit__input-label">Name</label>
                    <input id="editUserInfoName" type="text" class="edit__input-text" required>
                </div>
                <div class="edit__input-group">
                    <label for="editUserInfoGroup" class="edit__input-label">Group</label>
                    <select id="editUserInfoGroup" class="edit__input-text" disabled>
                        <option value="">-- Group --</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </div>
            <div class="edit__input-group">
                <label for="editUserInfoEmail" class="edit__input-label">Mail</label>
                <input id="editUserInfoEmail" type="email" class="edit__input-text" required>
            </div>
            <h1 id="auth-form__error-email" style="color: red; display: none; font-size: 1.6rem"></h1>
            <div class="edit__btn-wrapper">
                <input onclick="updateUser()" class="edit__btn" type="submit" value="Save">
            </div>
        </div>
    </form>
</div>
<div class="edit__modal" style="margin-top: 1.6rem">
    <form class="edit__modal-wrapper" method="POST" action="javascript:void(0);">
        <div class="edit__modal-input-wrapper">
            <div class="edit__input-group">
                <label for="editUserInfoOldPassword" class="edit__input-label">Old Password</label>
                <input id="editUserInfoOldPassword" type="password" class="edit__input-text" required>
            </div>
            <h1 id="auth-form__error-pass" style="color: red; display: none; font-size: 1.6rem"></h1>
            <div class="edit__input-group">
                <label for="editUserInfoNewPassword" class="edit__input-label">New Password</label>
                <input id="editUserInfoNewPassword" type="password" class="edit__input-text" required>
            </div>
            <div class="edit__btn-wrapper">
                <input onclick="updateUserPassword()" class="edit__btn" type="submit" value="Save">
            </div>
        </div>
    </form>
</div>

<style>
    .edit__modal {
        background-color: var(--white-color);
        padding: 2rem;
        border-radius: 6px;
        width: fit-content;
    }
    .edit__modal-wrapper {
        display: flex;
    }
    .edit__input-group-wrapper {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .edit__input-group {
        margin-top: 2rem;
        margin-right: 2rem;
        flex-grow: 1;
    }
    .edit__input-label {
        font-size: 1.5rem;
        font-weight: 700;
        line-height: 1.8rem;
        display: block;
        margin-bottom: 0.8rem;
    }
    .edit__input-require {
        color: var(--red-color);
    }
    .edit__input-text {
        font-size: 1.6rem;
        border-radius: 4px;    
        line-height: 2rem;
        padding: 0.8rem 1.2rem;
        outline: none;
        border: 1px solid var(--border-color);
        width: 100%;
    }
    .edit__btn-wrapper {
        text-align: center;
    }
    .edit__btn {
        background-color: var(--blue-color);
        color: var(--white-color);
        padding: 1.2rem 2.4rem;
        outline: none;
        border-radius: 6px;
        border: none;
        box-shadow: 0px 4px 4px 0px #00000040;
        margin-top: 1.6rem;
        font-size: 1.3rem;
        font-weight: 600;
        line-height: 1.6rem;
        cursor: pointer;
        margin-right: 2rem;
    }
</style>