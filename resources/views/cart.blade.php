@extends('layouts.master')

@section('title', 'cart')

@section('custom_style')
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/cart.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/cart_responsive.css') }}">
@endsection

@section('custom_javascript')
    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        jQuery(document).ready(function () {
            jQuery('input:radio[name=delivery_option]').change(function () {
                let shippingId = jQuery('input:radio[name=delivery_option]:checked').val();
                let shippingView = jQuery('div.cart_total_value.shipping');

                jQuery.ajax({
                    type: "GET",
                    url: "{{ route('cart.shipping.setShipping') }}",
                    data: {
                        shippingId: shippingId
                    },
                    success: function (response) {
                        shippingView.html(response.shippingName);
                    }
                });
            });
        });
    </script>
@endsection

@section('content')

	<!-- Cart Info -->

	<div class="cart_info">
		<div class="container">
			<div class="row">
				<div class="col">
					<!-- Column Titles -->
					<div class="cart_info_columns clearfix">
						<div class="cart_info_col cart_info_col_product">Product</div>
						<div class="cart_info_col cart_info_col_price">Price</div>
						<div class="cart_info_col cart_info_col_quantity">Quantity</div>
						<div class="cart_info_col cart_info_col_total">Total</div>
					</div>
				</div>
			</div>
			<div class="row cart_items_row">
				<div class="col">

                    @foreach ($order->products as $product)
                        <!-- Cart Item -->
                        <div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
                            <!-- Name -->
                            <div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
                                <div class="cart_item_image">
                                    <div><img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"></div>
                                </div>
                                <div class="cart_item_name_container">
                                    <div class="cart_item_name"><a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a></div>
                                </div>
                            </div>
                            <!-- Price -->
                            <div class="cart_item_price">{{ $product->getPriceForCount() }}</div>
                            <!-- Quantity -->
                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
								@csrf
                                <div class="product_quantity clearfix">
                                    <span>Qty</span>
                                    <input id="quantity_input" name="quantity" type="text" readonly data-max="{{ $product->quantity }}" value="{{ $product->pivot->count }}">
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                                    </div>
                                </div>
                                <button type="submit" class="button cart_button">Add to cart</button>
							</form>
                            <!-- Total -->
                            <div class="cart_item_total">{{ $order->getSubTotalPrice() }}</div>
                        </div>
                    @endforeach

				</div>
			</div>
			<div class="row row_cart_buttons">
				<div class="col">
					<div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
						<div class="button continue_shopping_button"><a href="{{ route('index') }}">Continue shopping</a></div>
						<div class="cart_buttons_right ml-lg-auto">
							<div class="button clear_cart_button"><a href="{{ route('cart.clear') }}">Clear cart</a></div>
							<div class="button update_cart_button"><a href="{{ route('cart.index') }}">Update cart</a></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row row_extra">
				<div class="col-lg-4">

					<!-- Delivery -->
					<div class="delivery">
						<div class="section_title">Shipping method</div>
						<div class="section_subtitle">Select the one you want</div>
						<div class="delivery_options">
                            @foreach ($shippings as $shipping)
                                <label class="delivery_option clearfix">{{ $shipping->name }}
                                    <input type="radio" name="delivery_option" value="{{ $shipping->id }}">
                                    <span class="checkmark"></span>
                                    <span class="delivery_price">{{ $shipping->price }}</span>
                                </label>
                            @endforeach
						</div>
					</div>

					<!-- Coupon Code -->
					<div class="coupon">
						<div class="section_title">Coupon code</div>
						<div class="section_subtitle">Enter your coupon code</div>
						<div class="coupon_form_container">
							<form action="#" id="coupon_form" class="coupon_form">
								<input type="text" class="coupon_input" required="required">
								<button class="button coupon_button"><span>Apply</span></button>
							</form>
						</div>
					</div>
				</div>

				<div class="col-lg-6 offset-lg-2">
					<div class="cart_total">
						<div class="section_title">Cart total</div>
						<div class="section_subtitle">Final info</div>
						<div class="cart_total_container">
							<ul>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Subtotal</div>
									<div class="cart_total_value ml-auto">{{ $order->getSubTotalPrice() }}</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Shipping</div>
									<div class="cart_total_value shipping ml-auto">choose</div>
								</li>
								<li class="d-flex flex-row align-items-center justify-content-start">
									<div class="cart_total_title">Total</div>
									<div class="cart_total_value ml-auto">{{ $order->getTotalPrice() }}</div>
								</li>
							</ul>
						</div>
						<div class="button checkout_button"><a href="#">Proceed to checkout</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
