@extends('partials.header')

@section('content')

<div class="py-5">

<section class="h-100 gradient-custom">
@php
    $array = session('cart', []);
    $cartItems = array_filter(array_merge(array(0),$array));
    $cartItemCount = count($cartItems);
  //  dd($cartItems) ;
@endphp
  <div class="container py-5">
    <div class="row d-flex justify-content-center my-4">
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Cart - {{$cartItemCount}} items</h5>
          </div>
          <div class="card-body">

            <!-- Single item -->
            @foreach($cartItems as $itemId => $item)
    
        
        
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                <!-- Image -->
                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                    <a href="#!">
                      <img src="{{ asset('uploads/products/' . $item['image']) }}" class="w-100" alt="{{ $item['name'] }}" />
                        <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                    </a>
                </div>
                <!-- Image -->
            </div>

            <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                <!-- Data -->
                <p><strong>{{ $item['name'] }}</strong></p>
                <div class="d-flex gap-2">
                  <p>{{ $item['size'] }}</p>
                <p>{{ $item['color'] }}</p>
                </div>
                
                <div class="d-flex">
                  <form action="{{ route('deleteItem', ['id' => $itemId]) }}" method="post">
                     @csrf
                     @method('DELETE')

                      <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-sm me-1 mb-2" data-mdb-tooltip-init title="Remove item">
                       <i class="fas fa-trash"></i>
                      </button>
                  </form>
      @php
            $userFavorites = auth()->user()->favoris->pluck('product_id')->toArray();

            $isInFavorites = in_array($itemId, $userFavorites);
       @endphp
@if(!$isInFavorites)
<form action="{{route('favoris.store')}}" method="POST">
@csrf
<input type="hidden" name="product_id" value="{{ $itemId}}">
  <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-sm mb-2" data-mdb-tooltip-init title="Move to the wish list">
    <i class="fas fa-heart"></i>
</button>
</form>
@endif
                </div>

                <!-- Data -->
            </div>

            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <!-- Quantity -->
                <form action="{{ route('updateCart', $itemId) }}" method="POST">
        @csrf
        <input type="hidden" name="id" value="{{ $itemId }}">
                <div class="input-group">
                    <button class="btn btn-primary" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown();">
                        <i class="fas fa-minus"></i>
                    </button>

                    <input class="form-control" type="number" name="quantity" value="{{ $item['quantity'] }}" min="0">
                    
                    <button class="btn btn-primary" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp();">
                        <i class="fa-solid fa-plus"></i>
                    </button>

                    <button type="submit" class="btn btn-primary mx-2">Update Cart</button>
                </div>
                <!-- Quantity -->
                
                <!-- Price -->
                <p class="text-start text-md-center">
                    <strong>Total: {{ $item['quantity'] }} * ${{ $item['price'] }} = ${{ $item['quantity'] * $item['price'] }}</strong>
                </p>
                <!-- Price -->
            </div>
        </div>
    </form>
@endforeach


            <hr class="my-4" />

            
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-body">
            <p><strong>Expected shipping delivery</strong></p>
            <p class="mb-0">12.10.2020 - 14.10.2020</p>
          </div>
        </div>
        <div class="card mb-4 mb-lg-0">
          <div class="card-body">
            <p><strong>We accept</strong></p>
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
              alt="Visa" />
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
              alt="American Express" />
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
              alt="Mastercard" />
            <img class="me-2" width="45px"
              src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.webp"
              alt="PayPal acceptance mark" />
          </div>
        </div>
      </div>
      <div class="col-md-4">
      <div class="card mb-4">
    <div class="card-header py-3">
        <h5 class="mb-0">Summary</h5>
    </div>
    <div class="card-body">
        <ul class="list-group list-group-flush">
            @php
                $totalPrice = 0;
            @endphp
            @foreach($cartItems as $item)
                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                    {{ $item['name'] }}
                    <span>${{ $item['quantity'] * $item['price'] }}</span>
                </li>
                @php
                    $totalPrice += $item['quantity'] * $item['price'];
                @endphp
            @endforeach
        </ul>

        <div class="container py-3">
          <div class="row">
            <div class="col-md-12">
              <form action="Applycoupon" method="POST">
                @csrf
              <div class="input-group mb-3">
                <input type="hidden" name="total price" value="{{$totalPrice}}">
           
                  <input type="text" name="code" class="form-control" placeholder="Enter coupon code" aria-label="Enter coupon code" aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="submit" id="button-addon2">Apply</button>
                </div>
                
              </div>
            </form>
            </div>
          </div>
        </div>


<form action="{{route('mollie')}}" method="POST">
  @csrf
  <input type="hidden" name="totalPrice" value="{{session('totalPrice')}}">
  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
            <div>
                <strong>Total amount</strong>
                <strong>
                    <p class="mb-0">(including VAT)</p>
                </strong>
            </div>
            <span><strong>${{$totalPrice}}</strong></span>
            <span><strong>{{session('totalPrice')}}</strong></span>
        </li>
        
        <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block">
            Go to checkout
        </button>
</form>
        
    </div>
</div>

  
</section>
</div>

@endsection
