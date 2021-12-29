<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CandidateRequest;
use App\Models\Candidate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Candidate::with('user')->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/admin/candidate/' . $row->id . '"  class="btn btn-sm btn-success"><i class="fas fa-fw fa-eye"></i></a>';
                    $button .= '<a href="/admin/candidate/' . $row->id . '/edit"  class="btn btn-sm btn-info"><i class="fas fa-fw fa-edit"></i></a>';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-id="' . $row->id . '" data-target="#delete-candidate-modal" class="btn btn-sm btn-danger btn-delete-candidate"><i class="fas fa-fw fa-trash"></i></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->editColumn('class', function ($row) {
                    return $row->user->class . ' ' . $row->user->major;
                })
                ->editColumn('vision', function ($row) {
                    return Str::length($row->vision) > 60 ? substr($row->vision, 0, 60) . '...' : $row->vision;
                })
                ->editColumn('mision', function ($row) {
                    return Str::length($row->mision) > 60 ? substr($row->mision, 0, 60) . '...' : $row->mision;
                })
                ->rawColumns(['action', 'class', 'vision', 'mision'])
                ->make(true);
        }
        return view('admin.candidate.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::where(['status' => 'siswa'])->get();
        return view('admin.candidate.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidateRequest $request)
    {
        $payload = $request->except(['photo']);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $ext = $file->getClientOriginalExtension();
            $file_name = date('YmdHis') . ".$ext";
            $file->storeAs('candidate', $file_name, 'public');
            $payload['photo'] = 'candidate/' . $file_name;
        }
        Candidate::create($payload);
        toast('Data berhasil ditambahkan', 'success');
        return redirect()->route('admin.candidate.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Candidate::with('user')->findOrFail($id);
        return view('admin.candidate.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where(['status' => 'siswa'])->get();
        $data = Candidate::findOrFail($id);
        return view('admin.candidate.edit', compact('user', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CandidateRequest $request, $id)
    {
        $payload = $request->except(['photo']);
        $candidate = Candidate::findOrFail($id);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');

            $exist = file_exists(storage_path('app/public/' . $candidate->photo));
            if (isset($candidate->photo) && $exist) {
                Storage::delete('public/' . $candidate->photo);
            }
            $ext = $file->getClientOriginalExtension();
            $file_name = date('YmdHis') . ".$ext";
            $file->storeAs('candidate', $file_name, 'public');
            $payload['photo'] = 'candidate/' . $file_name;
        } else {
            $payload['photo'] = $candidate->photo;
        }
        $candidate->update($payload);
        toast('Data berhasil di update', 'success');
        return redirect()->route('admin.candidate.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);
        $exist = file_exists(storage_path('app/public/' . $candidate->photo));
        if (isset($candidate->photo) && $exist) {
            Storage::delete('public/' . $candidate->photo);
        }
        $candidate->delete();
        toast('Data berhasil di hapus', 'success');
        return redirect()->route('admin.candidate.index');
    }
}