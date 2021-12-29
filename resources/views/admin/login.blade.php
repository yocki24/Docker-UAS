<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

      @if (isset($site_settings->logo))
      <link rel="shortcut icon" href="{{asset('storage/'.$site_settings->logo.'')}}" type="image/x-icon">
      @else
      <link rel="shortcut icon" href="{{asset('img/logo.png')}}" type="image/x-icon">
      @endif

      <title>Login Admin - Pilketos OSMANUSGI</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('templates')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('templates')}}/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .bg-login-image {
            background-image: url({{asset('img/ma.jpg')}})
        }

    </style>

</head>

<body class="bg-gradient-primary">
    @include('sweetalert::alert')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center ">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h3 text-gray-900 mb-4">Login Admin</h1>
                                    </div>
                                    @if (Session::has('error'))
                                    <div class="alert alert-danger" role="alert">
                                        {{Session::get('error')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    @endif
                                    <form method="POST" class="user" action="{{route('auth.admin.login')}}">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-user @error('nisn') is-invalid @enderror"" name=" nisn" id="nisn" placeholder="Masukkan NISN/NIP" value="{{old('nisn')}}">
                                            @error('nisn')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror

                                        </div>
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror"" name=" password" id="password" placeholder="Masukkan password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block btn-user"><i class="fas fa-fw fa-sign-in-alt"></i> Login</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{route('home.index')}}">Kembali ke halaman utama!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('templates')}}/vendor/jquery/jquery.min.js"></script>
    <script src="{{asset('templates')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('templates')}}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('templates')}}/js/sb-admin-2.min.js"></script>

</body>

</html>
