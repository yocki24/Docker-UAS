@extends('admin.layouts.main')

@section('title', 'Detail Kandidat Ketua')

@section('content')
<div class="container-fluid" style="min-height: 80vh">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Kandidat Ketua</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 mb-4">
            <a href="{{route('admin.candidate.index')}}" class="btn btn-sm btn-outline-dark"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
        </div>
        <div class="col-md-4">
            <div class="card shadow rounded">
                <div class="card-header">
                    <h5 class="m-0 card-title">Foto Kandidat Ketua</h5>
                </div>
                <div class="card-body">
                    <img src="{{asset('storage/'.$data->photo.'')}}" class="img-responsive img-thumbnail w-100" alt="">
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow rounded">
                <div class="card-header">
                    <h5 class="m-0 card-title">Data Kandidat Ketua</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Nomor Urut Kandidat</div>
                                <div class="col-md-8">{{$data->order}}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">NISN Siswa</div>
                                <div class="col-md-8">{{$data->user->nisn}}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Nama Siswa</div>
                                <div class="col-md-8">{{$data->user->name}}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Tanggal Lahir</div>
                                <div class="col-md-8">{{date('d M Y', strtotime($data->user->date_of_birth))}}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Kelas</div>
                                <div class="col-md-8">{{$data->user->class}}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Jurusan</div>
                                <div class="col-md-8">{{$data->user->major}}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-12 my-4">
            <div class="card shadow rounded">
                <div class="card-header">
                    <h5 class="m-0 card-title">Visi Misi Kandidat Ketua</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-2 font-weight-bold">Visi</div>
                                <div class="col-md-10">{!! $data->vision !!}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-2 font-weight-bold">Misi</div>
                                <div class="col-md-10">{!! $data->mision !!}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-2 font-weight-bold">Link Youtube</div>
                                <div class="col-md-10">{{ $data->youtube }}</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
