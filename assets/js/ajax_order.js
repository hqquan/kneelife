function orderCart(userId) {
	if (!$(".menu__address-info").text().trim()) {
		if (userId === 0) {
			alert("Please sign in to continue!");
			return;
		} else {
			alert("Please enter address to continue!");
			changeInfo(userId);
			return;
		}
	}

	var orderPayment = $('input[name="order__payment"]:checked').val();
	var orderTotal = $(".order__bill-price")
		.text()
		.replace(/[^0-9]/g, "");
	parseFloat(orderTotal);

	if (orderTotal == 0) {
		alert("Please select a product!");
		return;
	}

	var listItem = $(".order__cart-item-wrapper .cart-item");
	var productList = [];

	listItem.each(function (index, item) {
		let productId = item.id.replace(/[^0-9]/g, "");
		parseInt(productId);

		let productNote = $(item).find("#productNote").val();
		let productQuantity = $(item).find("#productQuantity").val();

		let productData = {
			productId: productId,
			productNote: productNote,
			productQuantity: productQuantity,
		};

		productList.push(productData);
	});

	$.ajax({
		url: "assets/controller/controllerOrder.php",
		method: "POST",
		data: {
			action: "orderCart",
			userId: userId,
			orderPayment: orderPayment,
			orderTotal: orderTotal,
			productList: JSON.stringify(productList),
		},
		success: function (data) {
			alert("Order successfully!");
			window.location.href = "index.php";
		},
	});
}
