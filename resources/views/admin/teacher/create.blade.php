@extends('admin.layouts.main')

@section('title', 'Tambah Data Guru')

@section('content')
<div class="container-fluid" style="min-height: 80vh">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Data Guru</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 mb-4">
            <a href="{{route('admin.teacher.index')}}" class="btn btn-sm btn-outline-dark"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
        </div>
        <div class="col-md-6">
            <div class="card shadow rounded">
                <div class="card-header">
                    <h5 class="m-0 card-title">Form Tambah Data Guru</h5>
                </div>
                <div class="card-body">
                    @if (Session::has('error'))
                    <div class="alert alert-danger" role="alert">
                        {{Session::get('error')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <form method="POST" action="{{route('admin.auth.register')}}">
                        @csrf
                        <input type="hidden" name="status" value="guru">
                        <div class="mb-3">
                            <label for="nisn" class="form-label">NIP</label>
                            <input type="text" class="form-control @error('nisn') is-invalid @enderror" name=" nisn" id="nisn" placeholder="Masukkan NIP" value="{{old('nisn')}}">
                            @error('nisn')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name=" name" id="name" placeholder="Masukkan nama lengkap" value="{{old('name')}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" id=" date_of_birth" name="date_of_birth" placeholder="Masukkan tanggal lahir">
                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Level</label>
                            <select id="role" name="role" class="form-control @error('role') is-invalid @enderror">
                                <option disabled hidden selected>-- Pilih Level --</option>
                                <option value="adm">Admin</option>
                                <option value="usr">User</option>
                            </select>
                            @error('role')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name=" password" id="password" placeholder="Masukkan password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
