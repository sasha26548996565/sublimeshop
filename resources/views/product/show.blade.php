@extends('layouts.master')

@section('title', $product->name)

@section('custom_style')
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/product.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('styles/product_responsive.css') }}">
@endsection

@section('custom_javascript')
    <script src="{{ asset('js/product.js') }}"></script>
@endsection

@section('content')
	<!-- Product Details -->

	<div class="product_details">
		<div class="container">
			<div class="row details_row">

				<!-- Product Image -->
				<div class="col-lg-6">
					<div class="details_image">
						<div class="details_image_large"><img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"></div>
					</div>
				</div>

				<!-- Product Content -->
				<div class="col-lg-6">
					<div class="details_content">
						<div class="details_name">{{ $product->name }}</div>
						<div class="details_price">{{ $product->price }}</div>

						<!-- In Stock -->
						<div class="in_stock_container">
							<div class="availability">Availability:</div>
							<span>{{ $product->isStock() ? "in stock ($product->quantity)" : 'no stock' }}</span>
						</div>
						<div class="details_text">
							<p>{{ $product->description }}</p>
						</div>

						<!-- Product Quantity -->
						<div class="product_quantity_container">
							<form action="{{ route('cart.add', $product->id) }}" method="POST">
								@csrf
                                <div class="product_quantity clearfix">
                                    <span>Qty</span>
                                    <?php
                                        $countAvailable = $product->quantity;
                                        $orderId = session('orderId');

                                        if (! is_null($orderId))
                                        {
                                            $order = App\Models\Order::findOrFail($orderId);
                                            if ($order->products->contains($product->id))
                                            {
                                                $pivotRow = $order->products()->where('product_id', $product->id)->first()->pivot;
                                                $countAvailable = $product->quantity - $pivotRow->count;
                                            }
                                        }
                                    ?>
                                    <input id="quantity_input" name="quantity" type="text" readonly data-max="{{ $countAvailable }}" value="{{ $countAvailable }}">
                                    <div class="quantity_buttons">
                                        <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
                                        <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                                    </div>
                                </div>
                                <button type="submit" class="button cart_button">Add to cart</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Products -->

	<div class="products">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="products_title">Related Products</div>
				</div>
			</div>
			<div class="row">
				<div class="col">

					<div class="product_grid">
                        @foreach ($relatedProducts as $product)
                            <div class="product">
                                <div class="product_image"><img src="{{ Storage::url($product->image) }}" style="max-width: 690px; max-height: 690px;" alt="{{ $product->name }}"></div>
                                <div class="product_content">
                                    <div class="product_title"><a href="product.html">{{ $product->name }}</a></div>
                                    <div class="product_price">{{ $product->price }}</div>
                                </div>
                            </div>
                        @endforeach

					</div>
				</div>
			</div>
		</div>
	</div>

@endsection
