@extends('partials.header')

@section('content')

<section id="mobile-products" class="product-store position-relative padding-large pt-8">
    <div class="container">
        <div class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">Mobile Products</h2>
                <div class="btn-right">
                    <a href="shop.html" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                </div>
            </div>
            <div class="swiper product-swiper">
                <div class="swiper-wrapper">
                    @foreach($products as $product)
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <form method="POST" action="{{ route('addProducttoCart', $product->id) }}">
                                        @csrf
                                        <div class="d-flex gap-2">
                                            <select name="color" id="color" class="my-2 rounded bg-black text-white">
                                                @foreach($colors as $color)
                                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                                @endforeach
                                            </select>
                                            
                                            <select name="size" id="size" class="my-2 rounded bg-black text-white">
                                                @foreach($sizes as $size)
                                                    <option value="{{ $size->id }}">{{ $size->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-medium btn-black">Add to Cart
                                            <svg class="cart-outline">
                                                <use xlink:href="#cart-outline"></use>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                                </h3>
                                <span class="item-price text-primary">${{ $product->price }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination position-absolute text-center"></div>
</section>


@endsection