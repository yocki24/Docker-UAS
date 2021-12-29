@extends('admin.layouts.main')

@section('title', 'Edit Data Kandidat Ketua')

@section('css')
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{asset('vendor/bootstrap-select')}}/dist/css/bootstrap-select.min.css">
<link rel="stylesheet" href="{{asset('vendor/summernote/summernote-bs4.css')}}">
@endsection

@section('content')
<div class="container-fluid" style="min-height: 80vh">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Kandidat Ketua</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 mb-4">
            <a href="{{route('admin.candidate.index')}}" class="btn btn-sm btn-outline-dark"><i class="fas fa-fw fa-arrow-left"></i>Kembali</a>
        </div>
        <div class="col-md-8">
            <div class="card shadow rounded">
                <div class="card-header">
                    <h5 class="m-0 card-title">Form Edit Data Kandidat Ketua</h5>
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

                    <form method="POST" action="{{route('admin.candidate.update', $data->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Nama Siswa</label>
                            <select id="user_id" name="user_id" class="selectpicker form-control  @error('user_id') is-invalid @enderror" data-live-search="true">
                                <option disabled selected>-- Pilih Siswa --</option>
                                @foreach ($user as $item)
                                <option value="{{$item->id}}" {{$data->user_id === $item->id ?'selected' : ''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="order" class="form-label">Nomor Urut</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" name="order" id="order" min="1" placeholder="Masukkan nomor urut" value="{{$data->order}}" />
                            @error('order')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="vision" class="form-label">Visi</label>
                            <textarea class="form-control @error('vision') is-invalid @enderror" name="vision" id="vision" placeholder="Masukkan visi">{{$data->vision}}</textarea>
                            @error('vision')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="mision" class="form-label">Misi</label>
                            <textarea class="form-control @error('mision') is-invalid @enderror" name="mision" id="mision" placeholder="Masukkan visi">{{value($data->mision)}}</textarea>
                            @error('mision')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="youtube" class="form-label">Link Youtube</label>
                            <input type="text" class="form-control @error('youtube') is-invalid @enderror" name="youtube" id="youtube" min="1" placeholder="Masukkan link youtube" value="{{$data->youtube}}" />
                            @error('youtube')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-group">
                                <label for="photo">Foto</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('photo') is-invalid @enderror" id="photo" name="photo" accept="image/*">
                                    <label class="custom-file-label" for="photoInput">Choose file</label>
                                    <small class="form-text text-muted">*File berupa JPG|PNG dan ukuran file maksimal 3MB </small>
                                    @error('photo')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            @php
                            $src = "";
                            if ($data->photo){
                            $src = asset('storage/'. $data->photo);
                            }
                            @endphp
                            <img src="{{$src}}" class="img-responsive img-thumbnail w-50" id="preview-photo" alt="">
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Latest compiled and minified JavaScript -->
<script src="{{asset('vendor/bootstrap-select')}}/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="{{asset('vendor/bootstrap-select')}}/dist/js/i18n/defaults-*.min.js"></script>
<script src="{{asset('vendor/summernote/summernote-bs4.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $("#photo").on("change", function(e) {
            e.preventDefault();
            if (this.files && this.files[0]) {
                var name = this.files[0]["name"];
                $("form label[for='photoInput']").text(name);
                var reader = new FileReader();
                reader.onload = (e) => {
                    $("#preview-photo").css("display", 'block');
                    $("#preview-photo").attr("src", e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        $('#mision').summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']]
                , ['font', ['strikethrough', 'superscript', 'subscript']]
                , ['color', ['color']]
                , ['para', ['ul', 'ol', 'paragraph']]
                , ['height', ['height']]
                , ['insert', ['link']]
            , ]
            , placeholder: 'Masukkan misi'
            , tabsize: 2
            , height: 100
        });
        $('#vision').summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']]
                , ['font', ['strikethrough', 'superscript', 'subscript']]
                , ['color', ['color']]
                , ['para', ['ul', 'ol', 'paragraph']]
                , ['height', ['height']]
                , ['insert', ['link']]
            , ]
            , placeholder: 'Masukkan visi'
            , tabsize: 2
            , height: 100
        });
    });

</script>

@endsection
