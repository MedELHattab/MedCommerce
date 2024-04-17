@extends('partials.header')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/product.css')}}">

@section('content')

<div class="container" >
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="{{asset('uploads/products/' . $product->image)}}" ></div>
						  <div class="tab-pane" id="pic-2"><img src="{{asset('uploads/products/' . $product->image)}}" ></div>
						  <div class="tab-pane" id="pic-3"><img src="{{asset('uploads/products/' . $product->image)}}" ></div>
						  <div class="tab-pane" id="pic-4"><img src="{{asset('uploads/products/' . $product->image)}}" ></div>
						  <div class="tab-pane" id="pic-5"><img src="{{asset('uploads/products/' . $product->image)}}" ></div>
						</div>
						<ul class="preview-thumbnail nav nav-tabs">
						  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="{{asset('uploads/products/' . $product->image)}}" /></a></li>
						  <li><a data-target="#pic-2" data-toggle="tab"><img src="{{asset('uploads/products/' . $product->image)}}" ></a></li>
						  <li><a data-target="#pic-3" data-toggle="tab"><img src="{{asset('uploads/products/' . $product->image)}}" ></a></li>
						  <li><a data-target="#pic-4" data-toggle="tab"><img src="{{asset('uploads/products/' . $product->image)}}" ></a></li>
						  <li><a data-target="#pic-5" data-toggle="tab"><img src="{{asset('uploads/products/' . $product->image)}}" ></a></li>
						</ul>
						
					</div>
					<div class="details col-md-6">
						<h3 class="product-title">{{$product->name}}</h3>
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							<span class="review-no">41 reviews</span>
						</div>
						<p class="product-description">{{$product->description}}</p>
						<h4 class="price">current price: <span>{{$product->price}}$</span></h4>
						<p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
						<h5 class="sizes">sizes:
                            @foreach($sizes as $size)
							<span class="size" data-toggle="tooltip" title="small">{{$size->name}}</span>
                            @endforeach
						</h5>
						<h5 class="colors">colors:
                        @foreach($colors as $color)
							<span class="color" style="width: fit-content;">{{$color->name}}</span>
                            @endforeach
						</h5>
						<div class="action">
							<button type="submit" class="add-to-cart btn btn-default" style="background: #ff9f1a;">add to cart</button>
							<button class="like btn btn-default" type="submit" style="background: #ff9f1a;"><span class="fa fa-heart"></span></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<section >
  <div class="container my-5 py-5">
    <div class="row d-flex justify-content-center">
      <div class="col-md-12 col-lg-10 col-xl-8">
        <div class="card">
          <div class="card-body">
            @foreach($comments as $comment)
            <div class="d-flex flex-start align-items-center">
              <img class="rounded-circle shadow-1-strong me-3"
                src="{{asset('uploads/users/'.$comment->user->image)}}" alt="avatar" width="60"
                height="60" />
              <div>
                <h6 class="fw-bold text-primary mb-1">{{$comment->user->name}}</h6>
                <p class="text-muted small mb-0">
                  Shared publicly - {{$comment->created_at}}
                </p>
              </div>
            </div>

            <p class="mt-3 mb-4 pb-2">
            {{$comment->comment}}
            </p>

            <div class="small d-flex justify-content-start">
            <div class="d-flex align-items-center me-3 gap-1">
    <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-link p-0">
            <i class="fas fa-trash"></i>
            <span class="mb-0">delete</span>
        </button>
    </form>
</div>
            </div>
            @endforeach
          </div>
          <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
    <div class=" w-100">
        <img class="rounded-circle shadow-1-strong me-3 mb-4"
            src="{{ asset('uploads/users/' . auth()->user()->image) }}" alt="avatar" width="40" height="40" />
        <form action="{{ route('comment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}"> 

            <div data-mdb-input-init class="form-outline w-100">
                <textarea class="form-control" id="textAreaExample" name="comment" rows="4"
                    style="background: #fff; width: 100% ;"></textarea>
                <!-- Adjusted width: 100% - 90px (to leave space for the buttons) -->
                <label class="form-label" for="textAreaExample">Message</label>
            </div>
            
            <div class="float-end mt-2 pt-1">
                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-sm">Post comment</button>
                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-sm ms-2">Cancel</button>
            </div>
        </form>   
        </div>
    </div>
</div>

        </div>
      </div>
    </div>
  </div>
</section>
@endsection

