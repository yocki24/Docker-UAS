@extends('user.layouts.main')

@section('title', 'Login')
@section('footer', 'bg-light text-dark')
@section('navbar', 'navbar-light bg-light')
@section('btnlogout', 'btn-outline-danger')

@section('css')
<style>
    .bg-login-image {
        background-image: url({{asset('img/ma.jpg')}})
    }
</style>
@endsection

@section('content')
<section class="bg-primary">
    <div class="container-fluid">
       <div class="row section justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="text-gray-900 mb-4">Login</h1>
                                </div>
                                @if (Session::has('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{Session::get('error')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                <form method="POST" class="user" action="{{route('auth.login')}}">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control form-control-user @error('nisn') is-invalid @enderror"" name=" nisn" id="nisn" placeholder="Masukkan NISN/NIP" value="{{old('nisn')}}">
                                        @error('nisn')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                        @enderror

                                    </div>
                                    <div class="mb-3">
                                        <input type="date" class="form-control form-control-user @error('date_of_birth') is-invalid @enderror"" id=" date_of_birth" name="date_of_birth" placeholder="Masukkan tanggal lahir">
                                        @error('date_of_birth')

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
                                    <small>Terjadi kendala? Klik untuk hubungi panitia via <a href="https://wa.me/6285648989767?text=Halo%20Kak...%0A%0ASaya%20mengalami%20kendala%20login%20pada%20Sistem%20Online%20Pemilihan%20Ketua%20OSIM%20MA%20NU%20Sunan%20Giri%20Prigen.%0A%0ABagaimana%20untuk%20mengatasi%20kendala%20ini%20kak%3F%0A%0ATerimakasih" target="_blank">WhatsApp</a></small>
                                    <br>
                                    <small>Login sebagai <a href="{{route('auth.admin.showLogin')}}">Admin</a></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

