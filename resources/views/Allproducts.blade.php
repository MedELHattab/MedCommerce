@extends('partials.header')

@section('content')

<section id="mobile-products" class="product-store position-relative padding-large py-8">
    <div class="container">
        <div class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">All Products</h2>
            </div>

            <div class="container-fluid p-4 px-lg-5">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <input type="text" id="search_input" placeholder="Search for products" class="form-control rounded-start">
                            <button type="submit" class="btn btn-primary rounded-end">Search</button>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select id="category" name="category" class="form-select">
                            <option value="0" selected>All</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4" id="place_result">
                    @foreach($products as $product)
                    <div class="col py-4">
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
    <div class="mt-9 p-3">
        {{ $products->links() }}
    </div>
</section>

@endsection
