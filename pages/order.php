<!-- Order page -->
<section id="order__page">
    <div class="order__page-container grid__full-width grid__row">
        <div class="order__cart-container grid__col-8">
            <h1 class="order__cart-header">My Cart (<span class="order__cart-quantity">0</span>)</h1>                    
            <div class="order__cart-wrapper grid__row">
                <div class="grid__col-4-8">
                    <div class="order__cart-item-wrapper">

                    </div>
                    <a href="#menu__page" class="order__cart-btn btn btn--primary">Add more</a>
                </div>
                <div class="grid__col-4-8">
                    <div class="order__cart-option">
                        <div class="order__cart-radio">
                            <h1 class="order__radio-header">Payment Method</h1>
                            <div class="order__radio-wrapper">
                                <span class="order__radio">
                                    <input value="Cash on Delivery" type="radio" name="order__payment" class="order__radio-item" checked>Cash on Delivery
                                </span>
                                <!-- <span class="order__radio">
                                    <input value="ATM" type="radio" name="order__payment" class="order__radio-item">ATM
                                </span>
                                <span class="order__radio">
                                    <input value="VISA" type="radio" name="order__payment" class="order__radio-item">VISA
                                </span> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="order__pay-wrapper grid__col-4">
            <div class="order__pay-info">
                <h1 class="order__info-header">Delivering to:</h1>
                <div class="userInfoData">
                    <!-- Load user info data -->
                </div>
            </div>
            <div class="order__pay-bill">
                <h1 class="order__bill-header">Order Summary</h1>
                <ul class="order__bill-info-list">
                    <h1 class="order__info-header">Delivery items (<span class="order__cart-quantity">0</span>)</h1>
                    <li class="order__info-list-item">
                        <p class="order__item-header">Sub-total</p>
                        <p class="order__item-price order__sub-total">0 VND</p>
                    </li>
                    <li class="order__info-list-item">
                        <p class="order__item-header">Shipping</p>
                        <p class="order__item-price order__shipping">0 VND</p>
                    </li>
                    <li class="order__info-list-item">
                        <p class="order__item-header">VAT 8%</p>
                        <p class="order__item-price order__vat">0 VND</p>
                    </li>
                    <li class="order__info-list-item">
                        <p class="order__item-header">Discount</p>
                        <p class="order__item-price order__discount">0 VND</p>
                    </li>
                </ul>
                <div class="order__bill-total">
                    <h1 class="order__bill-header">Total</h1>
                    <div class="order__bill-price order__total">0 VND</div>
                </div>
                <button id="orderUserId" onclick="orderCart(<?php echo (isset($_SESSION['userId']) ? $_SESSION['userId'] : 0); ?>)" value="<?php echo (isset($_SESSION['userId']) ? $_SESSION['userId'] : 0); ?>" class="order__pay-btn btn btn--primary">ORDER</button>
            </div>
        </div>
    </div>
</section>
<!-- End of Order page -->