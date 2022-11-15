@component('mail::message')
appeared new product, {{ $product->name }}

@component('mail::button', ['url' => route('product.show', $product->slug)])
more info..
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
