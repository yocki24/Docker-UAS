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


    <title>@yield('title') - Pilketos OSMANUSGI</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('templates')}}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('templates')}}/css/sb-admin-2.min.css" rel="stylesheet">
    @yield('css')
</head>

<body id="page-top">

    @include('sweetalert::alert')

    <!-- Page Wrapper -->
    <div id="wrapper">
