<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Mini Penugasan Laravel Developer Kasir Pintar - Salsabila Emma">
    <meta name="keywords" content="Mini Penugasan Laravel Developer Kasir Pintar - Salsabila Emma">
    <meta name="author" content="pixelstrap">
    <meta name="cuba-url" content="{{ url('public/cuba') }}">
    <link rel="icon" href="{{ url('cuba') }}/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="{{ url('cuba') }}/assets/images/favicon.png" type="image/x-icon">
    <title>Register - Reimbursement Salsabila Emma</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/style.css">
    <link id="color" rel="stylesheet" href="{{ url('cuba') }}/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ url('cuba') }}/assets/css/responsive.css">
  </head>
  <body>
    <!-- login page start-->
    <div class="container-fluid p-0">
      <div class="row m-0">
        <div class="col-12 p-0">
          <div class="login-card">
            <div>
              <div><a class="logo" href="{{ route('dashboard') }}">
                {{-- <img class="img-fluid for-light" src="{{ url('cuba') }}/assets/images/logo.png" alt="looginpage"><img class="img-fluid for-dark" src="{{ url('cuba') }}/assets/images/logo/logo_dark.png" alt="looginpage"> --}}
            </a></div>
              <div class="login-main">
                <form class="theme-form" method="POST" action="{{ route('register') }}">
                    @csrf
                  <h4>Create your account</h4>
                  <p>Enter your personal details to create account</p>
                  <div class="form-group">
                    <label class="col-form-label">Username</label>
                    <input class="form-control" type="text" name="nama" id="nama" required placeholder="Name" required autofocus>
                  </div>
                  <div class="form-group">
                      <div class="row g-2">
                          <div class="col-6">
                            <div class="form-group">
                                <label class="col-form-label pt-0">NIP</label>
                                <input class="form-control" type="text" required name="nip" id="nip" placeholder="****">
                            </div>
                          </div>
                          <div class="col-6">
                            <div class="form-group">
                                <label class="col-form-label pt-0">Jabatan</label>
                                <input class="form-control" type="text" required name="jabatan" name="jabatan" placeholder="Jabatan">
                            </div>
                          </div>
                        </div>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Email Address</label>
                    <input class="form-control" type="email" required name="email" name="email" placeholder="Test@gmail.com">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password" name="password" required placeholder="*********">
                      {{-- <div class="show-hide"><span class="show"></span></div> --}}
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Confirm Password</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password_confirmation" name="password_confirmation" required placeholder="*********">
                      {{-- <div class="show-hide"><span class="show"></span></div> --}}
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    {{-- <div class="checkbox p-0">
                      <input id="checkbox1" type="checkbox">
                      <label class="text-muted" for="checkbox1">Agree with<a class="ms-2" href="#">Privacy Policy</a></label>
                    </div> --}}
                    {{-- <button class="btn btn-primary btn-block w-100" type="submit">Create Account</button> --}}
                    <x-primary-button class="btn btn-primary btn-block w-100">
                        {{ __('Register') }}
                    </x-primary-button>
                  </div>
                  <p class="mt-4 mb-0">Already have an account?<a class="ms-2" href="{{ route('login') }}">Sign in</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- latest jquery-->
      <script src="{{ url('cuba') }}/assets/js/jquery-3.5.1.min.js"></script>
      <!-- Bootstrap js-->
      <script src="{{ url('cuba') }}/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
      <!-- feather icon js-->
      <script src="{{ url('cuba') }}/assets/js/icons/feather-icon/feather.min.js"></script>
      <script src="{{ url('cuba') }}/assets/js/icons/feather-icon/feather-icon.js"></script>
      <!-- scrollbar js-->
      <!-- Sidebar jquery-->
      <script src="{{ url('cuba') }}/assets/js/config.js"></script>
      <!-- Plugins JS start-->
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="{{ url('cuba') }}/assets/js/script.js"></script>
      <!-- login js-->
      <!-- Plugin used-->
    </div>
  </body>
</html>
