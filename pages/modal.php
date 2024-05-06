<?php 
    if (isset($_GET['action']) == 'signout') {
        unset($_SESSION['submitSignup']);
        unset($_SESSION['userId']);
        header("Location: index.php");
    }
?>
<!-- Modal -->
<div class="modal">
    <div class="modal__overlay"></div>
    <div class="modal__body">
        <!-- Sign in form -->
        <form class="auth-form" name="signinModal" method="POST" action="javascript:void(0);">
            <div class="auth-form__container">
                <div class="auth-form__header">
                    <h3 class="auth-form__heading">Sign in</h3>
                    <div class="auth-form__switch-wrap">
                        <span class="auth-form__switch-label">New to Kneelife?</span>
                        <span class="auth-form__switch-btn" name="signup">Sign up</span>
                    </div>
                </div>
                <div class="auth-form__form">
                    <div class="auth-form__group">
                        <input id="userEmailSignin" type="email" class="auth-form__input-text" placeholder="Email" required>
                    </div>
                    <div class="auth-form__group">
                        <input id="userPasswordSignin" type="password" class="auth-form__input-text" placeholder="Password" required>
                    </div>
                    <h1 class="auth-form__error"></h1>
                    <div class="auth-form__aside">
                        <div class="auth-form__help">
                            <div class="auth-form__help-link auth-form__help--forgot" name="forgot">Forgot password?</div>
                        </div>
                    </div>
                    <div class="auth-form__controls">
                        <input onclick="submitSignin()" type="submit" class="btn btn--primary auth-form__button" value="Sign in">
                    </div>
                </div>
            </div>
        </form>
        <!-- End of Sign in form -->

        <!-- Sign up form -->
        <form class="auth-form" name="signupModal" method="POST" action="javascript:void(0);">
            <div class="auth-form__container">
                <div class="auth-form__header">
                    <h3 class="auth-form__heading">Sign up</h3>
                    <div class="auth-form__switch-wrap">
                        <span class="auth-form__switch-label">Already have account?</span>
                        <span class="auth-form__switch-btn" name="signin">Sign in</span>
                    </div>
                </div>
                <div class="auth-form__form">
                    <div class="auth-form__group">
                        <input id="userName" name="userName" type="name" class="auth-form__input-text" placeholder="Full name" required>
                    </div>
                    <div class="auth-form__group">
                        <input id="userPhone" name="userPhone" type="phone" class="auth-form__input-text" placeholder="Phone number" required>
                    </div>
                    <div class="auth-form__group">
                        <input id="userEmailSignup" name="userEmail" type="email" class="auth-form__input-text" placeholder="Email" required>
                    </div>
                    <h1 id="auth-form__error-email" class="auth-form__error"></h1>
                    <div class="auth-form__group">
                        <input id="userPasswordSignup" name="userPassword" type="password" class="auth-form__input-text" placeholder="Password" required>
                    </div>
                    <div class="auth-form__group">
                        <input id="userConfirmPassword" name="userConfirmPassword" type="password" class="auth-form__input-text" placeholder="Confirm password" required>
                    </div>
                    <h1 id="auth-form__error-pass" class="auth-form__error"></h1>
                    <div class="auth-form__controls">
                        <input onclick="submitSignup()" class="btn btn--primary auth-form__button" value="Sign up" type="submit">
                    </div>
                </div>
            </div>
        </form>
        <!-- End of Sign up form -->

        <!-- Forgot form -->
        <form class="auth-form" name="forgotModal" action="" method="">
            <div class="auth-form__container">
                <div class="auth-form__header">
                    <h3 class="auth-form__heading">Forgot password?</h3>
                </div>
                <div class="auth-form__form">
                    <div class="auth-form__group">
                        <input type="email" class="auth-form__input-text mt-32" placeholder="Email" required>
                    </div>
                    <div class="auth-form__controls mb-32">
                        <button class="btn btn--primary auth-form__button">Submit</button>
                        <span class="auth-form__switch-btn mt-16" name="signin">Back to Sign in</span>
                    </div>
                </div>
            </div>
        </form>
        <!-- End of Forgot form -->

        <!-- Reset password form -->
        <form class="auth-form" name="resetModal" action="" method="">
            <div class="auth-form__container">
                <div class="auth-form__header">
                    <h3 class="auth-form__heading">Reset password</h3>
                    <p class="auth-form__sub-heading mt-32">Enter a new password below to change your password</p>
                </div>
                <div class="auth-form__form">
                    <div class="auth-form__group">
                        <input type="password" class="auth-form__input-text" placeholder="Enter new password" required>
                    </div>
                    <div class="auth-form__group">
                        <input type="password" class="auth-form__input-text" placeholder="Confirm password" required>
                    </div>
                    <div class="auth-form__controls">
                        <button class="btn btn--primary auth-form__button">Submit</button>
                        <span class="auth-form__switch-btn mt-16">Back to Sign in</span>
                    </div>
                </div>
            </div>
        </form>
        <!-- End of Reset password form -->

        <!-- Change address form -->
        <form class="auth-form" name="changeInfoModal" action="javascript:void(0);" method="POST">
            <div class="auth-form__container">
                <input type="hidden" id="changeInfoUserId">
                <input type="hidden" id="changeInfoUserInfoId">
                <div class="auth-form__header">
                    <h3 class="auth-form__heading">Shipping address</h3>
                </div>
                <div class="auth-form__form">
                    <div class="auth-form__group">
                        <input id="changeInfoUserName" type="name" class="auth-form__input-text" placeholder="Full Name" required>
                    </div>
                    <div class="auth-form__group">
                        <input id="changeInfoUserPhone" type="tel" class="auth-form__input-text" placeholder="Phone Number" required>
                    </div>
                    <div class="auth-form__group">
                        <input id="changeInfoUserStreetAddress" type="text" class="auth-form__input-text" placeholder="Street Address" required>
                    </div>
                    <div class="auth-form__group">
                        <input id="changeInfoUserOptional" type="text" class="auth-form__input-text" placeholder="Apt/ Suite/ Unit (Optional)">
                    </div>
                    <div class="auth-form__group">
                        <input id="changeInfoUserCity" type="text" class="auth-form__input-text" placeholder="City" required>
                    </div>
                    <div class="auth-form__controls">
                        <input type="submit" onclick="updateInfo()" class="btn btn--primary auth-form__button" value="Confirm">
                    </div>
                </div>
            </div>
        </form>
        <!-- End of Change address form -->

        <!-- Product detail modal -->
        <div class="detail__product-wrapper" name="productDetailModal">
            <img src="" alt="" class="detail__product-img">
            <div class="detail__product">
                <h1 class="detail__product-name"></h1>
                <p class="detail__product-desc"></p>
                <div class="detail__product-btn" onclick="closeModalBtn('productDetail')">
                    <p class="detail__product-price"></p>
                    <p class="detail__product-add">
                        Add to cart
                        <i class="detail__product-add-icon fa-solid fa-plus"></i>
                    </p>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>
        <!-- End of Product detail -->

    </div>
</div>
<!-- End of Modal -->