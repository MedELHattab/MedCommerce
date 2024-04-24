<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
  <title>MedCommerce</title>
</head>

<body>
  <section style="background-color: #eee;">

    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6 d-flex align-items-center " style="background-image: url('assets/images/product-item1.jpg');  background-repeat: no-repeat;  background-size: cover;  height: 53rem;">
                <div class="text-black px-3 py-4 p-md-5 mx-md-4">
               
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">

                  <div class="text-center">
                    <img src="{{asset('assets/images/medcommerce-high-resolution-logo-removebg-preview.png')}}" style="width: 185px;" alt="logo">
                    <h4 class="mt-1 mb-5 pb-1">welcome to MedCommerce</h4>
                  </div>


                  <div class="text-center mb-4">
                    <a href="{{ route('google') }}" class="btn bsb-btn-xl btn-outline-primary">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                        <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                      </svg>
                      <span class="ms-2 fs-6">Google</span>
                    </a>
                  </div>

                  <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <p>Please create your account</p>

                    <div class="form-outline mb-4">
                      <input name="name" onkeyup="validateName()" type="name" id="name" class="form-control" placeholder="name" />
                      <label class="form-label" for="form2Example11">Name <span class="ps-3 text-danger" id="name-error"></span></label>
                    </div>

                    <div class="form-outline mb-4">
                      <input name="email" onkeyup="validateEmail()" type="email" id="email" class="form-control" placeholder=" email address"  />
                      <label class="form-label" for="form2Example11">Email <span class="ps-3 text-danger" id="email-error"></label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" id="password" onkeyup="validatePassword()" class="form-control" placeholder="Password" name="password"  />
                      <label class="form-label" for="form2Example22">Password <span class="ps-3 text-danger" id="password-error"></span></label>
                    </div>

                    <div class="form-outline mb-4">
                      <input type="password" id="confirmPassword" onkeyup="validateConfirmPassword()" class="form-control" placeholder="Confirm your Password" name="password_confirmation"  />
                      <label class="form-label" for="form2Example22">Confirm your Password<span class="ps-3 text-danger" id="confirmPassword-error"></span></label>
                    </div>

                    <div class="text-center pt-1 mb-5 pb-1 ">
                      <button class="btn btn-primary btn-block mb-3" type="submit">Register</button>
                    </div>

                    <div class="d-flex align-items-center justify-content-center pb-4">
                      <p class="mb-0 me-2">Already have an account?</p>
                      <a class="btn btn-outline-danger" href="{{ route('login') }}">Log in</a>
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