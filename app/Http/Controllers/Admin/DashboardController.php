<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = User::where(['status' => 'siswa'])->get()->count();
        $siswa_x = User::where(['status' => 'siswa', 'class' => 'X'])->get()->count();
        $siswa_xi = User::where(['status' => 'siswa', 'class' => 'XI'])->get()->count();
        $siswa_xii = User::where(['status' => 'siswa', 'class' => 'XII'])->get()->count();
        $guru = User::where(['status' => 'guru'])->get()->count();
        $pemilih = Vote::get()->count();
        $kandidat = Candidate::get()->count();

        $data_candidate = Candidate::select('users.name')
            ->join('users', 'users.id', '=', 'candidates.user_id')
            ->groupBy('users.name')
            ->pluck('users.name');

        $data_pemilih = Vote::select(DB::raw('count(*) as total'))
            ->join('candidates', 'candidates.id', '=', 'votes.candidate_id')
            ->groupBy('candidates.id')
            ->pluck('total');

        return view('admin.dashboard.index', compact('data_candidate', 'data_pemilih', 'siswa', 'guru', 'pemilih', 'kandidat', 'siswa_x', 'siswa_xi', 'siswa_xii'));
    }

    public function getChartDataVote()
    {
        $kandidat = Candidate::get()->count();

        $data_candidate = Candidate::select('users.name')
            ->join('users', 'users.id', '=', 'candidates.user_id')
            ->groupBy('users.name')
            ->pluck('users.name');

        $data_pemilih = Vote::select(DB::raw('count(*) as total'))
            ->join('candidates', 'candidates.id', '=', 'votes.candidate_id')
            ->groupBy('candidates.id')
            ->pluck('total');
        return response()->json(compact('kandidat', 'data_candidate', 'data_pemilih'), 200);
    }

    public function pemilih(Request $request)
    {
        $data = Vote::with('user', 'candidate')->get();
        $siswa_x = Vote::whereHas('user', function ($q) {
            $q->where(['status' => 'siswa', 'class' => 'X']);
        })->get()->count();
        $siswa_xi = Vote::whereHas('user', function ($q) {
            $q->where(['status' => 'siswa', 'class' => 'XI']);
        })->get()->count();
        $siswa_xii = Vote::whereHas('user', function ($q) {
            $q->where(['status' => 'siswa', 'class' => 'XII']);
        })->get()->count();
        $guru = Vote::whereHas('user', function ($q) {
            $q->where(['status' => 'guru']);
        })->get()->count();

        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="javascript:void(0)" data-toggle="modal" data-id="' . $row->id . '" data-target="#delete-pemilih-modal" class="btn btn-sm btn-danger btn-delete-pemilih"><i class="fas fa-fw fa-times"></i> Reset</a>';
                    $button .= '</div>';
                    return $button;
                })
                ->editColumn('candidate', function ($row) {
                    return $row->candidate->user->name;
                })
                ->editColumn('class', function ($row) {
                    return $row->user->class . ' ' . $row->user->major;
                })
                ->editColumn('status', function ($row) {
                    return $row->user->status === 'siswa' ? '<span class="badge badge-primary">Siswa</span>' :
                        '<span class="badge badge-success">Guru</span>';
                })
                ->editColumn('order', function ($row) {
                    return '<span class="badge badge-info p-2">' . $row->candidate->order . '</span>';
                })
                ->rawColumns(['action', 'candidate', 'order', 'class', 'status'])
                ->make(true);
        }
        return view('admin.pemilih.index', compact('data', 'siswa_x', 'siswa_xi', 'siswa_xii', 'guru'));
    }

    public function destroyPemilih($id)
    {
        $data = Vote::findOrFail($id);
        $data->delete();
        toast('Data berhasil di reset.', 'success');
        return redirect()->back();
    }
}