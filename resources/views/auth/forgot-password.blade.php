<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
  <title>MedCommerce</title>
</head>

<body>
  <section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">

                  <div class="text-center">
                    <img src="{{asset('assets/images/medcommerce-high-resolution-logo-removebg-preview.png')}}" style="width: 185px;" alt="logo">                    <h4 class="mt-1 mb-5 pb-1">welcome to MedCommerce</h4>
                  </div>

                  <form action="{{ route('password.email') }}" method="POST">
                  @csrf
                    <p>Reset Password</p>

                    <div class="form-outline mb-4">
                      <input name="email" type="email" id="form2Example11" class="form-control" placeholder=" email address" value="{{ old('email') }}" />
                      <label class="form-label" for="form2Example11">Email</label>
                    </div>

                    <div class="text-center pt-1 mb-5 pb-1">
                      <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Send link</button>
                    </div>

                    

                  </form>

                </div>
              </div>

          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>