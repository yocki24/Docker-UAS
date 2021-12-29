<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Pilihan Kandidat</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body text-center">
    <h5>Apakah kamu yakin akan memilih kandidat dengan <span class="badge badge-danger">nomor urut {{$data->order}}</span> ?</h5>

    <p>Klik pilih jika kamu sudah yakin! </p>
    <form action="{{route('candidate.store.pilih')}}" method="POST">
        @csrf
        <input type="hidden" name="candidate_id" value="{{$data->id}}">
        <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-edit"></i> PILIH</button>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
