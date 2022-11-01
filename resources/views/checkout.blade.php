@extends('layouts.master')

@section('title', 'checkout')

@section('custom_style')
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/checkout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/checkout_responsive.css') }}">
@endsection

@section('custom_javascript')
    <script src="{{ asset('js/checkout.js') }}"></script>
@endsection

@section('content')

	<!-- Checkout -->

	<div class="checkout">
		<div class="container">
			<div class="row">

				<!-- Billing Info -->
				<div class="col-lg-6">
					<div class="billing checkout_section">
						<div class="section_title">Billing Address</div>
						<div class="section_subtitle">Enter your address info</div>
						<div class="checkout_form_container">
							<form action="{{ route('cart.checkout.confirm') }}" id="checkout_form" class="checkout_form" method="POST">
                                @csrf
								<div class="row">
									<div class="col-xl-6">
										<!-- Name -->
										<label for="checkout_name">First Name*</label>
										<input type="text" id="checkout_name" name="first_name" class="checkout_input" required="required">
                                        @include('includes.error', ['fieldName' => 'first_name'])
									</div>
									<div class="col-xl-6 last_name_col">
										<!-- Last Name -->
										<label for="checkout_last_name">Last Name*</label>
										<input type="text" id="checkout_last_name" name="last_name" class="checkout_input" required="required">
                                        @include('includes.error', ['fieldName' => 'last_name'])
									</div>
								</div>
								<div>
									<!-- Company -->
									<label for="checkout_company">Company</label>
									<input type="text" id="checkout_company" name="company" class="checkout_input">
                                    @include('includes.error', ['fieldName' => 'company'])
								</div>
								<div>
									<!-- Country -->
									<label for="checkout_country">Country*</label>
									<select name="country_id" id="checkout_country" name="country" class="dropdown_item_select checkout_input" require="required">
										<option></option>
										@foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
									</select>
                                    @include('includes.error', ['fieldName' => 'county_id'])
								</div>
								<div>
									<!-- Address -->
									<label for="checkout_address">Address*</label>
									<input type="text" name="address" id="checkout_address" class="checkout_input" required="required">
                                    @include('includes.error', ['fieldName' => 'address'])
									<input type="text" name="address_2" id="checkout_address_2" class="checkout_input checkout_address_2" required="required">
                                    @include('includes.error', ['fieldName' => 'address_2'])
                                </div>
								<div>
									<!-- Zipcode -->
									<label for="checkout_zipcode">Zipcode*</label>
									<input type="text" name="zipcode" id="checkout_zipcode" class="checkout_input" required="required">
                                    @include('includes.error', ['fieldName' => 'zipcode'])
								</div>
								<div>
									<!-- City / Town -->
									<label for="checkout_city">City/Town*</label>
									<select name="city_id" id="checkout_city" class="dropdown_item_select checkout_input" require="required">
										<option></option>
										@foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
									</select>
                                    @include('includes.error', ['fieldName' => 'city_id'])
								</div>
								<div>
									<!-- Province -->
									<label for="checkout_province">Province*</label>
									<select name="province_id" id="checkout_province" class="dropdown_item_select checkout_input" require="required">
										<option></option>
										@foreach ($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                                        @endforeach
									</select>
                                    @include('includes.error', ['fieldName' => 'province_id'])
								</div>
								<div>
									<!-- Phone no -->
									<label for="checkout_phone">Phone no*</label>
									<input type="phone" name="phone" id="checkout_phone" class="checkout_input" required="required">
                                    @include('includes.error', ['fieldName' => 'phone'])
								</div>
								<div>
									<!-- Email -->
									<label for="checkout_email">Email Address*</label>
									<input type="phone" name="email" id="checkout_email" class="checkout_input" required="required">
                                    @include('includes.error', ['fieldName' => 'email'])
								</div>

                                <button type="submit" class="button order_button">Place Order</button>
							</form>
						</div>
					</div>
				</div>

				<!-- Order Info -->

				<div class="col-lg-6">
					<div class="order checkout_section">
						<div class="section_title">Your order</div>
						<div class="section_subtitle">Order details</div>

						<!-- Order details -->
						<div class="order_list_container">
							<div class="order_list_bar d-flex flex-row align-items-center justify-content-start">
								<div class="order_list_title">Product</div>
								<div class="order_list_value ml-auto">Total</div>
							</div>
							<ul class="order_list">
                                @foreach ($order->products as $product)
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="order_list_title">{{ $product->name }} ({{ $product->pivot->count }})</div>
                                        <div class="order_list_value ml-auto">{{ $product->price }}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="order_list_title">Shipping</div>
                                        <div class="order_list_value ml-auto">{{ $order->shipping->name }}</div>
                                    </li>
                                    <li class="d-flex flex-row align-items-center justify-content-start">
                                        <div class="order_list_title">Total</div>
                                        <div class="order_list_value ml-auto">{{ $order->getTotalPriceWithCoupon() }}</div>
                                    </li>
                                @endforeach
							</ul>
						</div>

						<!-- Payment Options -->
						<div class="payment">
							<div class="payment_options">
								<label class="payment_option clearfix">Paypal
									<input type="radio" name="radio">
									<span class="checkmark"></span>
								</label>
								<label class="payment_option clearfix">Cach on delivery
									<input type="radio" name="radio">
									<span class="checkmark"></span>
								</label>
								<label class="payment_option clearfix">Credit card
									<input type="radio" name="radio">
									<span class="checkmark"></span>
								</label>
								<label class="payment_option clearfix">Direct bank transfer
									<input type="radio" checked="checked" name="radio">
									<span class="checkmark"></span>
								</label>
							</div>
						</div>

						<!-- Order Text -->
						<div class="order_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra temp or so dales. Phasellus sagittis auctor gravida. Integ er bibendum sodales arcu id te mpus. Ut consectetur lacus.</div>
						<div class="button order_button"><a href="#">Place Order</a></div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
