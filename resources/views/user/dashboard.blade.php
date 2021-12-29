@extends('user.layouts.main')

@section('title', 'Dashboard')
@section('footer', 'bg-primary text-light')
@section('navbar', 'navbar-dark bg-primary')
@section('btnlogout', 'btn-outline-light')

@section('css')
<style>
    .equal {
        display: flex;
        display: -webkit-flex;
        flex-wrap: wrap;
    }

    @media (min-width: 768px) {
        .row.equal {
            display: flex;
            flex-wrap: wrap;
        }
    }

</style>
@endsection

@section('content')

<section class="section ">
    <div class="container">
        <div class="row my-4 justify-content-center">
            <div class="col-12 text-center">
                <div class="alert alert-primary" role="alert">
                    <h4>Halo, <strong>{{Auth::user()->name}}</strong></h4>
                    <h4>Selamat datang di Sistem Online Pemilihan Ketua OSIM MA NU Sunan Giri Prigen</h4>
                    <h4>Masa Bhakti {{isset($site_settings->service_period) ? $site_settings->service_period : ''}}</h4>
                    <hr>
                    <p class="mb-1 font-weight-bold">PANDUAN TEKNIS PEMILIHAN: </p>
                    @if (isset($site_settings->guide))
                    <p class="m-0">{!! $site_settings->guide !!}</p>
                    @else
                    <p class="m-0">Panduan kosong</p>
                    @endif
                </div>
                <hr>
            </div>
        </div>
        @if ($voted)
        <div class="row my-4">
            <div class="col-md-6 offset-md-3">
                <div class="alert alert-success text-center" role="alert">
                    <i class="fas fa-fw fa-check fa-2x"></i>
                    <h4>Terimakasih</h4>
                    <h5>Kamu telah memilih kandidat dengan nomor urut {{$voted->candidate->order}}</h5>
                </div>
            </div>
        </div>
        @endif
        <div class="row my-4 justify-content-center equal list-candidates">
            @if ($candidate->isEmpty())
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    Kandidat ketua masih belum ada.
                </div>
            </div>
            @else
            @foreach ($candidate as $item)
            <div class="col-md-4 my-md-0 my-4">
                <div class="card text-dark" style="height: 100%">
                    <div class="card-body text-center">
                        <p class="mb-1">Nomor Urut</p>
                        <button type="button" class="mb-4 btn btn-lg btn-primary font-weight-bold">{{$item->order}}</button>
                        <img src="{{asset('storage/'.$item->photo.'')}}" class="w-100 img-thumbnail img-responsive" alt="">
                        <div class="body my-3">
                            <h3 class="font-weight-bold">{{$item->user->name}}</h3>
                            <hr>
                            <div class="text-left">
                                <p class="mb-1">Kelas : {{$item->user->class}} {{$item->user->major}}</p>
                                <p class="mb-1">Tanggal Lahir : {{ date('d M Y', strtotime($item->user->date_of_birth))}}</p>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <a href="" data-bs-toggle="modal" data-bs-id="{{$item->id}}" data-bs-target="#visiMisiModal" class="btn btn-sm btn-outline-dark btn-block btn-visimisi"><i class="fas fa-fw fa-cog"></i> Visi & Misi</a>
                                </div>
                                <div class="col-6">
                                    <a href="https://www.youtube.com/embed/ks5uAPITtVA" target="_blank" class="btn btn-sm btn-outline-danger btn-block"><i class="fab fa-fw fa-youtube"></i> Video Orasi</a>
                                </div>
                            </div>
                            <hr>
                            @if ($voted)
                            <button type="button" class="btn btn-danger" disabled><i class="fas fa-exclamation-triangle"></i> Kamu sudah melakukan pemilihan.</button>
                            @else
                            <a href="" data-bs-toggle="modal" data-bs-id="{{$item->id}}" data-bs-target="#pilihModal" class="btn btn-primary btn-pilih"><i class="fas fa-fw fa-edit"></i> Pilih Kandidat</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Visi Misi Modal-->
<div class="modal fade" id="visiMisiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div id="body-modal"></div>
        </div>
    </div>
</div>

<div class="modal fade" id="pilihModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="body-pilih-modal"></div>
        </div>
    </div>
</div>


@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(".list-candidates").on("click", ".btn-visimisi", function() {
            var id = $(this).attr("data-bs-id");
            $.ajax({
                type: "GET"
                , url: `${APP_URL}/candidate/visimisi`
                , data: {
                    id: id
                }
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , beforeSend: function() {
                    $('#body-modal').html('')
                }
                , success: function(response) {
                    $('#body-modal').html(response.html)
                }
            });
        });
        $(".list-candidates").on("click", ".btn-pilih", function() {
            var id = $(this).attr("data-bs-id");
            $.ajax({
                type: "GET"
                , url: `${APP_URL}/candidate/pilih`
                , data: {
                    id: id
                }
                , headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
                , beforeSend: function() {
                    $('#body-pilih-modal').html('')
                }
                , success: function(response) {
                    $('#body-pilih-modal').html(response.html)
                }
            });
        });
    });

</script>
@endsection
