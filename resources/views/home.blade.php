@extends('partials.header')

@section('content')
<section id="billboard" class="position-relative overflow-hidden bg-light-blue">
    <div class="swiper main-swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <div class="container">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6">
                            <div class="banner-content">
                                <h1 class="display-2 text-uppercase text-dark pb-5">Your Products Are Great.</h1>
                                <a href="shop.html" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Product</a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="image-holder">
                                <img src="{{asset('assets/images/banner-image.png')}}" alt="banner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-slide">
                <div class="container">
                    <div class="row d-flex flex-wrap align-items-center">
                        <div class="col-md-6">
                            <div class="banner-content">
                                <h1 class="display-2 text-uppercase text-dark pb-5">Technology Hack You Won't Get</h1>
                                <a href="shop.html" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Product</a>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="image-holder">
                                <img src="{{asset('assets/images/banner-image.png')}}" alt="banner">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-icon swiper-arrow swiper-arrow-prev">
        <svg class="chevron-left">
            <use xlink:href="#chevron-left" />
        </svg>
    </div>
    <div class="swiper-icon swiper-arrow swiper-arrow-next">
        <svg class="chevron-right">
            <use xlink:href="#chevron-right" />
        </svg>
    </div>
</section>
<section id="company-services" class="padding-large">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="icon-box d-flex">
                    <div class="icon-box-icon pe-3 pb-3">
                        <svg class="cart-outline">
                            <use xlink:href="#cart-outline" />
                        </svg>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">Free delivery</h3>
                        <p>Consectetur adipi elit lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="icon-box d-flex">
                    <div class="icon-box-icon pe-3 pb-3">
                        <svg class="quality">
                            <use xlink:href="#quality" />
                        </svg>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">Quality guarantee</h3>
                        <p>Dolor sit amet orem ipsu mcons ectetur adipi elit.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="icon-box d-flex">
                    <div class="icon-box-icon pe-3 pb-3">
                        <svg class="price-tag">
                            <use xlink:href="#price-tag" />
                        </svg>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">Daily offers</h3>
                        <p>Amet consectetur adipi elit loreme ipsum dolor sit.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 pb-3">
                <div class="icon-box d-flex">
                    <div class="icon-box-icon pe-3 pb-3">
                        <svg class="shield-plus">
                            <use xlink:href="#shield-plus" />
                        </svg>
                    </div>
                    <div class="icon-box-content">
                        <h3 class="card-title text-uppercase text-dark">100% secure payment</h3>
                        <p>Rem Lopsum dolor sit amet, consectetur adipi elit.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="mobile-products" class="product-store position-relative padding-large no-padding-top">
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
                                                    <option value="{{ $color }}">{{ $color->name }}</option>
                                                @endforeach
                                            </select>
                                            
                                            <select name="size" id="size" class="my-2 rounded bg-black text-white">
                                                @foreach($sizes as $size)
                                                    <option value="{{ $size }}">{{ $size->name }}</option>
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
<section id="smart-watches" class="product-store padding-large position-relative">
    <div class="container">
        <div class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">Smart Watches</h2>
                <div class="btn-right">
                    <a href="shop.html" class="btn btn-medium btn-normal text-uppercase">Go to Shop</a>
                </div>
            </div>
            <div class="swiper product-watch-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="images/product-item6.jpg" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline">
                                            <use xlink:href="#cart-outline"></use>
                                        </svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Pink watch</a>
                                </h3>
                                <span class="item-price text-primary">$870</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="images/product-item7.jpg" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline">
                                            <use xlink:href="#cart-outline"></use>
                                        </svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">Heavy watch</a>
                                </h3>
                                <span class="item-price text-primary">$680</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="images/product-item8.jpg" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline">
                                            <use xlink:href="#cart-outline"></use>
                                        </svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">spotted watch</a>
                                </h3>
                                <span class="item-price text-primary">$750</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="images/product-item9.jpg" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline">
                                            <use xlink:href="#cart-outline"></use>
                                        </svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between align-items-baseline pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">black watch</a>
                                </h3>
                                <span class="item-price text-primary">$650</span>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="product-card position-relative">
                            <div class="image-holder">
                                <img src="images/product-item10.jpg" alt="product-item" class="img-fluid">
                            </div>
                            <div class="cart-concern position-absolute">
                                <div class="cart-button d-flex">
                                    <a href="#" class="btn btn-medium btn-black">Add to Cart<svg class="cart-outline">
                                            <use xlink:href="#cart-outline"></use>
                                        </svg></a>
                                </div>
                            </div>
                            <div class="card-detail d-flex justify-content-between pt-3">
                                <h3 class="card-title text-uppercase">
                                    <a href="#">black watch</a>
                                </h3>
                                <span class="item-price text-primary">$750</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination position-absolute text-center"></div>
</section>
<section id="yearly-sale" class="bg-light-blue overflow-hidden mt-5 padding-xlarge" style="background-image: url('{{ asset('assets/images/single-image1.png')}}');background-position: right; background-repeat: no-repeat;">
    <div class="row d-flex flex-wrap align-items-center">
        <div class="col-md-6 col-sm-12">
            <div class="text-content offset-4 padding-medium">
                <h3>10% off</h3>
                <h2 class="display-2 pb-5 text-uppercase text-dark">New year sale</h2>
                <a href="shop.html" class="btn btn-medium btn-dark text-uppercase btn-rounded-none">Shop Sale</a>
            </div>
        </div>
        <div class="col-md-6 col-sm-12">

        </div>
    </div>
</section>
<section id="latest-blog" class="padding-large">
    <div class="container">
        <div class="row">
            <div class="display-header d-flex justify-content-between pb-3">
                <h2 class="display-7 text-dark text-uppercase">Latest Posts</h2>
                <div class="btn-right">
                    <a href="blog.html" class="btn btn-medium btn-normal text-uppercase">Read Blog</a>
                </div>
            </div>
            <div class="post-grid d-flex flex-wrap justify-content-between">
                <div class="col-lg-4 col-sm-12">
                    <div class="card border-none me-3">
                        <div class="card-image">
                            <img src="images/post-item1.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="card-body text-uppercase">
                        <div class="card-meta text-muted">
                            <span class="meta-date">feb 22, 2023</span>
                            <span class="meta-category">- Gadgets</span>
                        </div>
                        <h3 class="card-title">
                            <a href="#">Get some cool gadgets in 2023</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card border-none me-3">
                        <div class="card-image">
                            <img src="images/post-item2.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="card-body text-uppercase">
                        <div class="card-meta text-muted">
                            <span class="meta-date">feb 25, 2023</span>
                            <span class="meta-category">- Technology</span>
                        </div>
                        <h3 class="card-title">
                            <a href="#">Technology Hack You Won't Get</a>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card border-none me-3">
                        <div class="card-image">
                            <img src="images/post-item3.jpg" alt="" class="img-fluid">
                        </div>
                    </div>
                    <div class="card-body text-uppercase">
                        <div class="card-meta text-muted">
                            <span class="meta-date">feb 22, 2023</span>
                            <span class="meta-category">- Camera</span>
                        </div>
                        <h3 class="card-title">
                            <a href="#">Top 10 Small Camera In The World</a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="testimonials" class="position-relative">
    <div class="container">
        <div class="row">
            <div class="review-content position-relative">
                <div class="swiper-icon swiper-arrow swiper-arrow-prev position-absolute d-flex align-items-center">
                    <svg class="chevron-left">
                        <use xlink:href="#chevron-left" />
                    </svg>
                </div>
                <div class="swiper testimonial-swiper">
                    <div class="quotation text-center">
                        <svg class="quote">
                            <use xlink:href="#quote" />
                        </svg>
                    </div>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide text-center d-flex justify-content-center">
                            <div class="review-item col-md-10">
                                <i class="icon icon-review"></i>
                                <blockquote>“Tempus oncu enim pellen tesque este pretium in neque, elit morbi sagittis lorem habi mattis Pellen tesque pretium feugiat vel morbi suspen dise sagittis lorem habi tasse morbi.”</blockquote>
                                <div class="rating">
                                    <svg class="star star-fill">
                                        <use xlink:href="#star-fill"></use>
                                    </svg>
                                    <svg class="star star-fill">
                                        <use xlink:href="#star-fill"></use>
                                    </svg>
                                    <svg class="star star-fill">
                                        <use xlink:href="#star-fill"></use>
                                    </svg>
                                    <svg class="star star-half">
                                        <use xlink:href="#star-half"></use>
                                    </svg>
                                    <svg class="star star-empty">
                                        <use xlink:href="#star-empty"></use>
                                    </svg>
                                </div>
                                <div class="author-detail">
                                    <div class="name text-dark text-uppercase pt-2">Emma Chamberlin</div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide text-center d-flex justify-content-center">
                            <div class="review-item col-md-10">
                                <i class="icon icon-review"></i>
                                <blockquote>“A blog is a digital publication that can complement a website or exist independently. A blog may include articles, short posts, listicles, infographics, videos, and other digital content.”</blockquote>
                                <div class="rating">
                                    <svg class="star star-fill">
                                        <use xlink:href="#star-fill"></use>
                                    </svg>
                                    <svg class="star star-fill">
                                        <use xlink:href="#star-fill"></use>
                                    </svg>
                                    <svg class="star star-fill">
                                        <use xlink:href="#star-fill"></use>
                                    </svg>
                                    <svg class="star star-half">
                                        <use xlink:href="#star-half"></use>
                                    </svg>
                                    <svg class="star star-empty">
                                        <use xlink:href="#star-empty"></use>
                                    </svg>
                                </div>
                                <div class="author-detail">
                                    <div class="name text-dark text-uppercase pt-2">Jennie Rose</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-icon swiper-arrow swiper-arrow-next position-absolute d-flex align-items-center">
                    <svg class="chevron-right">
                        <use xlink:href="#chevron-right" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    <div class="swiper-pagination"></div>
</section>
<section id="subscribe" class="container-grid padding-large position-relative overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="subscribe-content bg-dark d-flex flex-wrap justify-content-center align-items-center padding-medium">
                <div class="col-md-6 col-sm-12">
                    <div class="display-header pe-3">
                        <h2 class="display-7 text-uppercase text-light">Subscribe Us Now</h2>
                        <p>Get latest news, updates and deals directly mailed to your inbox.</p>
                    </div>
                </div>
                <div class="col-md-5 col-sm-12">
                    <form class="subscription-form validate">
                        <div class="input-group flex-wrap">
                            <input class="form-control btn-rounded-none" type="email" name="EMAIL" placeholder="Your email address here" required="">
                            <button class="btn btn-medium btn-primary text-uppercase btn-rounded-none" type="submit" name="subscribe">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="instagram" class="padding-large overflow-hidden no-padding-top">
    <div class="container">
        <div class="row">
            <div class="display-header text-uppercase text-dark text-center pb-3">
                <h2 class="display-7">Shop Our Insta</h2>
            </div>
            <div class="d-flex flex-wrap">
                <figure class="instagram-item pe-2">
                    <a href="https://templatesjungle.com/" class="image-link position-relative">
                        <img src="{{asset('assets/images/insta-item1.jpg')}}" alt="instagram" class="insta-image">
                        <div class="icon-overlay position-absolute d-flex justify-content-center">
                            <svg class="instagram">
                                <use xlink:href="#instagram"></use>
                            </svg>
                        </div>
                    </a>
                </figure>
                <figure class="instagram-item pe-2">
                    <a href="https://templatesjungle.com/" class="image-link position-relative">
                        <img src="{{asset('assets/images/insta-item2.jpg')}}" alt="instagram" class="insta-image">
                        <div class="icon-overlay position-absolute d-flex justify-content-center">
                            <svg class="instagram">
                                <use xlink:href="#instagram"></use>
                            </svg>
                        </div>
                    </a>
                </figure>
                <figure class="instagram-item pe-2">
                    <a href="https://templatesjungle.com/" class="image-link position-relative">
                        <img src="{{asset('assets/images/insta-item3.jpg')}}" alt="instagram" class="insta-image">
                        <div class="icon-overlay position-absolute d-flex justify-content-center">
                            <svg class="instagram">
                                <use xlink:href="#instagram"></use>
                            </svg>
                        </div>
                    </a>
                </figure>
                <figure class="instagram-item pe-2">
                    <a href="https://templatesjungle.com/" class="image-link position-relative">
                        <img src="{{asset('assets/images/insta-item4.jpg')}}" alt="instagram" class="insta-image">
                        <div class="icon-overlay position-absolute d-flex justify-content-center">
                            <svg class="instagram">
                                <use xlink:href="#instagram"></use>
                            </svg>
                        </div>
                    </a>
                </figure>
                <figure class="instagram-item pe-2">
                    <a href="https://templatesjungle.com/" class="image-link position-relative">
                        <img src="{{asset('assets/images/insta-item5.jpg')}}" alt="instagram" class="insta-image">
                        <div class="icon-overlay position-absolute d-flex justify-content-center">
                            <svg class="instagram">
                                <use xlink:href="#instagram"></use>
                            </svg>
                        </div>
                    </a>
                </figure>
            </div>
        </div>
    </div>
</section>
@endsection