<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">


<link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
  <title>MedCommerce</title>
</head>

<body>
  <section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">

                  <div class="text-center">
                    <img src="{{asset('assets/images/medcommerce-high-resolution-logo-removebg-preview.png')}}" style="width: 185px;" alt="logo">
                    <h4 class="mt-1 mb-5 pb-1">welcome to MedCommerce</h4>
                  </div>

                  <form action="{{ route('login') }}" method="POST">
                  @csrf
                    <p>Please login to your account</p>

                    <div class="form-outline mb-4">
                      <input name="email" type="email" id="form2Example11" class="form-control" placeholder=" email address" value="{{ old('email') }}" />
                      <label class="form-label" for="form2Example11">Email</label>
                      @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" id="form2Example22" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}" />
                      <label class="form-label" for="form2Example22">Password</label>
                    </div>

                    <div class="text-center pt-1 mb-5 pb-1">
                      <div class="text-center pt-1 mb-1 pb-1 ">
                        <button class="btn btn-primary btn-block mb-3" type="submit">log in</button>
                      </div>
                      <a class="text-muted" href="{{route('password.request')}}">Forgot password?</a>
                    </div>

                    <div class="d-flex align-items-center justify-content-center pb-4">
                      <p class="mb-0 me-2">Don't have an account?</p>
                      <a class="btn btn-outline-danger" href="{{ route('register') }}">Create new</a>  
                    </div>

                  </form>

                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center " style="background-image: url('assets/images/product-item3.jpg');  background-repeat: no-repeat;  background-size: cover;  height: 45rem;">
            
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</script>

@if(session("error"))
<script>
Swal.fire({
  title: "error?",
  text: '{{ session("error") }}',
  icon: "question"
});
</script>
@endif

<script src="{{asset('assets/js/validation.js')}}"></script>


</html>