@extends('admin.layouts.main')

@section('title', 'Setting')

@section('content')
<div class="container-fluid" style="min-height: 80vh">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Setting</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 mb-4">
            <a href="{{route('admin.setting.create')}}" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-edit"></i> Edit</a>
        </div>
        <div class="col-md-4">
            <div class="card shadow rounded">
                <div class="card-header">
                    <h5 class="m-0 card-title">Logo Aplikasi</h5>
                </div>
                <div class="card-body">
                    @if (isset($data->logo))
                    <img src="{{asset('storage/'.$data->logo.'')}}" class="img-thumbnail img-responsive w-100" alt="">
                    @else
                    <img src="{{asset('img/logo.png')}}" class="img-thumbnail img-responsive w-100" alt="">
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8 my-md-0 my-4">
            <div class="card shadow rounded">
                <div class="card-header">
                    <h5 class="m-0 card-title">Setting</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Masa Bhakti</div>
                                <div class="col-md-8">{{ isset($data->service_period) ? $data->service_period : '' }}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Panduan Teknis</div>
                                <div class="col-md-8">{!! isset($data->guide) ? $data->guide : '' !!}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
