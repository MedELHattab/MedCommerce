@extends('partials.header')

@section('content')
    <section id="mobile-products" class="product-store position-relative padding-large pt-8">
        <div class="container">
            <div class="row">
                <div class="display-header d-flex justify-content-between pb-3">
                    <h2 class="display-7 text-dark text-uppercase">Favorites</h2>
                    <div class="btn-right">
                        <a href="{{route('AllProducts')}}" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                    </div>
                </div>
                @if(count($products) > 0)
                <div class="swiper product-swiper">
                    <div class="swiper-wrapper">
                        @foreach ($products as $product)
                            <div class="swiper-slide">
                                <div class="product-card position-relative">
                                    <div class="image-holder">
                                        <img src="{{ asset('uploads/products/' . $product->image) }}"
                                            alt="{{ $product->name }}" class="img-fluid">
                                    </div>
                                    <div class="cart-concern position-absolute">
                                        <div class="d-flex gap-3">
                                            <div class="cart-button d-flex">
                                                <form method="POST" action="{{ route('addProducttoCart', $product->id) }}">
                                                    @csrf
                                                    <div class="d-flex gap-2">
                                                        <select name="color" id="color"
                                                            class="my-2 rounded bg-black text-white">
                                                            @foreach ($colors as $color)
                                                                <option value="{{ $color->id }}">{{ $color->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        <select name="size" id="size"
                                                            class="my-2 rounded bg-black text-white">
                                                            @foreach ($sizes as $size)
                                                                <option value="{{ $size->id }}">{{ $size->name }}
                                                                </option>
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
                                            <div class="pt-4">
                                               <form action="{{ route('deleteFavoris') }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                                 <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-sm me-1 mb-2" data-mdb-tooltip-init title="Remove item">
                                                  <i class="fas fa-trash"></i>
                                                 </button>
                                             </form> 
                                            </div>
                                            
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
                @else
                    <div class="text-center text-danger py-5"> 
                        <p>No results found.</p>
                    </div>

                @endif
            </div>
        </div>
        <div class="swiper-pagination position-absolute text-center"></div>
    </section>
@endsection
