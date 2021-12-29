@extends('admin.layouts.main')

@section('css')
<link rel="stylesheet" href="{{ asset('vendor') }}/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('vendor') }}/datatables-responsive/css/responsive.bootstrap4.min.css">
@endsection

@section('title', 'Data Guru')

@section('content')
<div class="container-fluid" style="min-height: 80vh">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Guru</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 mb-4">
            <a href="{{route('admin.teacher.create')}}" class="btn btn-sm btn-primary"><i class="fas fa-fw fa-plus"></i>Tambah Data Guru</a>
            <a href="javascript:void(0)" data-toggle="modal" data-target="#import-teacher" class="btn btn-sm btn-success"><i class="fa fa-fw fa-file-excel"></i>Import Excel</a>
        </div>
        <div class="col-12">
            <div class="card shadow rounded">
                <div class="card-header">
                    <h5 class="m-0 card-title">Data Guru</h5>
                </div>
                <div class="card-body">
                    <table id="table-teacher" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Tanggal lahir</th>
                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="delete-teacher-modal" tabindex="-1" role="dialog" aria-labelledby="delete-teacher-modal-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete-teacher-modal-title">Delete Confirmation</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah Anda yakin akan menghapus data?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form method="POST" id="form-delete-teacher">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-submit">
                            <i class="fas fa-fw fa-trash"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="import-teacher" tabindex="-1" role="dialog" aria-labelledby="import-teacher-title" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="import-teacher-title">Import Data Admin</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>*Unduh <a href="{{route('admin.teacher.export')}}">Format Excel</a></p>
                    <form action="{{route('admin.teacher.import')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Masukkan file Excel</label>
                            <input type="file" class="form-control-file" id="file" name="file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                            @error('file')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                            <button class="btn btn-primary mt-2" type="submit"><i class="fas fa-fw fa-save"></i> Submit</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('vendor') }}/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('vendor') }}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('vendor') }}/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('vendor') }}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script src="{{asset('js/teacher.js')}}"></script>

@endsection
