@extends('admin.layouts.main')

@section('title', 'Setting')

@section('css')
<link rel="stylesheet" href="{{asset('vendor/summernote/summernote-bs4.css')}}">

@endsection

@section('content')
<div class="container-fluid" style="min-height: 80vh">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Setting</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 mb-4">
            <a href="{{route('admin.setting.index')}}" class="btn btn-sm btn-outline-dark"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-md-4">
            <div class="card shadow rounded">
                <div class="card-header">
                    <h5 class="m-0 card-title">Logo Aplikasi</h5>
                </div>
                <div class="card-body">
                    @if (is_null($data->logo))
                    <img src="{{asset('img/logo.png')}}" class="img-thumbnail img-responsive w-100" alt="">
                    @else
                    <img src="{{asset('storage/'.$data->logo.'')}}" class="img-thumbnail img-responsive w-100" alt="">
                    @endif
                    <form action="{{route('admin.setting.updateLogo')}}" method="POST" enctype="multipart/form-data" id="form-logo">
                        @csrf
                        @method('PUT')
                        <div class="form-group my-3">
                            <label for="logo">Logo</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('logo') is-invalid @enderror" id="logo" name="logo" accept="image/*">
                                <label class="custom-file-label" for="logoInput">Choose file</label>
                                <small class="form-text text-muted">*File berupa JPG|PNG dan ukuran file maksimal 3MB </small>
                                @error('logo')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Update</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8 my-md-0 my-4">
            <div class="card shadow rounded">
                <div class="card-header">
                    <h5 class="m-0 card-title">Setting</h5>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.setting.updateData')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="service_period" class="form-label">Masa Bhakti</label>
                            @if (isset($site_settings->service_period))
                            <input type="text" class="form-control @error('service_period') is-invalid @enderror" name="service_period" id="service_period" placeholder="Masukkan masa bhakti" value="{{$data->service_period}}" />
                            @else
                            <input type="text" class="form-control @error('service_period') is-invalid @enderror" name="service_period" id="service_period" placeholder="Masukkan masa bhakti" value="{{ old('service_period')}}" />

                            @endif
                            @error('service_period')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="guide" class="form-label">Panduan Teknis Pemilihan</label>
                            @if (isset($site_settings->guide))
                            <textarea class="form-control @error('guide') is-invalid @enderror" name="guide" id="guide" placeholder="Masukkan visi">{{value($data->guide)}}</textarea>
                            @else
                            <textarea class="form-control @error('guide') is-invalid @enderror" name="guide" id="guide" placeholder="Masukkan visi">{{old('guide')}}</textarea>
                            @endif

                            @error('guide')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
<script src="{{asset('vendor/summernote/summernote-bs4.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $("#logo").on("change", function(e) {
            e.preventDefault();
            if (this.files && this.files[0]) {
                var name = this.files[0]["name"];
                $("form#form-logo label[for='logoInput']").text(name);
                var reader = new FileReader();
                reader.onload = (e) => {
                    $("#preview-logo").css("display", 'block');
                    $("#preview-logo").attr("src", e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

    });

    $('#guide').summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']]
            , ['font', ['strikethrough', 'superscript', 'subscript']]
            , ['color', ['color']]
            , ['para', ['ul', 'ol', 'paragraph']]
            , ['height', ['height']]
            , ['insert', ['link']]
        , ]
        , placeholder: 'Masukkan panduan teknis pemilihan'
        , tabsize: 2
        , height: 100
    });

</script>

@endsection
