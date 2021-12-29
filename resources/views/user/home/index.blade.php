@extends('user.layouts.main')

@section('title', 'Home')
@section('footer', 'bg-light text-dark')
@section('navbar', 'navbar-light bg-light')
@section('btnlogout', 'btn-outline-danger')

@section('content')

<section class="bg-primary py-5">
    <div class="container">
        <div class="row align-items-center section">
            <div class="col-md-6 order-md-2">
                <img src="{{asset('img/hero.png')}}" class="w-100" alt="">
            </div>
            <div class="col-md-6 text-light order-md-1">
                <h1 class="display-4 fw-bold">Selamat Datang di</h1>
                <h3>Sistem Online Pemilihan Ketua OSIM <br> MA NU Sunan Giri Prigen <br> Masa Bhakti {{isset($site_settings->service_period) ? $site_settings->service_period : ''}}</h3>
                @if (Auth::check())
                <a href="{{route('user.dashboard')}}" class="btn btn-light"><i class="fas fa-fw fa-home"></i> Masuk Ke Dashboard</a>
                @else
                <a href="{{route('auth.showLogin')}}" class="btn btn-light"><i class="fas fa-fw fa-sign-in-alt"></i> Login Sekarang</a>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
