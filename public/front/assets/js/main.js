function product_addToCart(msg){
	$('.add-to-cart').click(function(){
		var _this = $(this);
		var product_id = _this.parents("[product-id]").attr('product-id');
		var serial_number = _this.parents("[serial-number]").attr('serial-number');
		var quantity = window.prompt(msg[2], 1);

		if(quantity != null){
			$.ajax({
				url: '/my-cart/add-item/'+product_id,
				cache: false,
				type: 'post',
				data: {quantity: quantity},
				success: function(data){
					alert(data.message + " - quantity: " + quantity);
					$('#navbar-1 .cart-value').text(data.cart_count);
				},
				statusCode: {
					401: function() {
						if(window.confirm(msg[0])) {
							window.location.href = '/login?ref_to='+serial_number;
						} else {
							alert(msg[1]);
						}
					},
					400: function(data) {
						alert(data.responseJSON.message);
					}
				}
			})
		}
	});
}

function cartRemoveItem(){
    $('.remove-item').on('click', function(){
        var item_id = $(this).attr('item-id');
        $.ajax({
            url: '/my-cart/remove-item/' + item_id,
            type: 'post',
            success: function(data){
                alert(data.message);
                location.reload();
            }
        });
    });
}