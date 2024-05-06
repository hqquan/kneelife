var currentOrderPage = 1;

function fetchOrderData() {
    $.ajax({
        url: "controller/controllerOrder.php",
        method: "POST",
        data: { 
            action: 'fetchOrderData',
            page: currentOrderPage
        },
        dataType: 'json',
        success: function(data) {
            $('#orderData').html(data.html);

            changeItemStatusBackground();
            checkDetailModal();

            var totalRows = data.totalRows; 
            var totalPages = Math.ceil(totalRows / data.itemsPerPage);
            setupOrderPagination(totalPages);

            formatNumber();
        }
    });
}

function loadOrderPage(page) {
    currentOrderPage = page;
    fetchOrderData();
}

function setupOrderPagination(totalPages) {
    var paginationHtml = '';

    for (var i = 1; i <= totalPages; i++) {
        paginationHtml += '<button onclick="loadOrderPage(' + i + ')" class="pagination__btn">' + i + '</button>';
    }

    $('#orderPagination').html(paginationHtml);
}

function viewOrderDetail(orderId) {
    $.ajax({
        url: 'controller/controllerOrder.php',
        method: 'POST',
        data: {
            action: 'viewOrderDetail',
            orderId: orderId
        },
        dataType: 'json',
        success: function(data) {
            openModal('viewDetail');
            $('#orderDetailOrderId').val(data.orderId);
            $('#orderDetailOrderCode').text(data.orderCode);
            $('#orderDetailUserName').text(data.userName);
            $('#orderDetailUserPhone').text(data.userPhone);
            if (data.userOptional === '') {
                $('#orderDetailUserAddress').text(data.userStreetAddress + ', ' + data.userCity);
            } else {
                $('#orderDetailUserAddress').text(data.userStreetAddress + ', ' + data.userOptional + ', ' + data.userCity);
            }
            $('#orderDetailOrderTime').text(data.orderTime);

            fetchProductListData(data.orderCode);
        }
    });
}

function fetchProductListData(orderCode) {
    $.ajax({
        url: 'controller/controllerOrder.php',
        method: 'POST',
        data: {
            action: 'fetchProductListData',
            orderCode: orderCode
        },
        dataType: 'json',
        success: function(data) {
            $('#orderDetailData').html(data.html);
            $('#orderDetailShipping').text(data.shipping);
            $('#orderDetailSubTotal').text(data.subtotal);
            $('#orderDetailVat').text(data.vat);
            $('#orderDetailDiscount').text(data.vat);
            $('#orderDetailTotal').text(data.total);

            formatNumber();
        }
    });
}

function acceptOrder() {
    var orderId = $('#orderDetailOrderId').val();
    $.ajax({
        url: 'controller/controllerOrder.php',
        method: 'POST',
        data: {
            action: 'acceptOrder',
            orderId: orderId
        },
        success: function(data) {
            closeModalBtn('viewDetail');
            fetchOrderData();
        }
    });
}

function cancelOrder() {
    var orderId = $('#orderDetailOrderId').val();
    $.ajax({
        url: 'controller/controllerOrder.php',
        method: 'POST',
        data: {
            action: 'cancelOrder',
            orderId: orderId
        },
        success: function(data) {
            closeModalBtn('viewDetail');
            fetchOrderData();
        }
    });
}

function deleteOrderConfirmation(orderId) {
    $.ajax({
        url: 'controller/controllerOrder.php',
        method: 'POST',
        data: {
            action: 'deleteOrderConfirmation',
            orderId: orderId
        },
        success: function(data) {
            openModal('deleteOrder');
            $('#deleteOrderId').val(data.orderId);
        }
    });
}

function deleteOrder() {
    var orderId = $('#deleteOrderId').val();
    $.ajax({
        url: 'controller/controllerOrder.php',
        method: 'POST',
        data: {
            action: 'deleteOrder',
            orderId: orderId
        },
        success: function(data) {
            closeModalBtn('deleteOrder');
            fetchOrderData();
        }
    });
}

function searchOrder() {
    $('#searchInput').keyup(function(){
        var query = $(this).val();
        if(query != ''){
            $.ajax({
                url: 'controller/controllerOrder.php',
                method: 'POST',
                data: {
                    action: 'search',
                    query: query
                },
                success: function(data){
                    $('#orderData').html(data);
                    changeItemStatusBackground();
                    formatNumber();
                }
            });
        } else {
            fetchOrderData();
        }
    });
}

$(document).ready(function() {
    fetchOrderData();
    searchOrder();
});