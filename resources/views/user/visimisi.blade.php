<div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Visi & Misi Kandidat Nomor Urut {{$data->order}}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
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
    </ul>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
</div>
