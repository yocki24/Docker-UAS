<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TeacherExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExcelRequest;
use App\Imports\TeacherImport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::where(['status' => 'guru'])->get();
        if ($request->ajax()) {
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $button = '<div class="btn-group" role="group">';
                    $button .= '<a href="/admin/teacher/' . $row->id . '/edit"  class="btn btn-sm btn-info"><i class="fas fa-fw fa-edit"></i></a>';
                    if (Auth::user()->nisn != $row->nisn) {
                        $button .= '<a href="javascript:void(0)" data-toggle="modal" data-id="' . $row->id . '" data-target="#delete-teacher-modal" class="btn btn-sm btn-danger btn-delete-teacher"><i class="fas fa-fw fa-trash"></i></a>';
                    }
                    $button .= '</div>';
                    return $button;
                })
                ->editColumn('date_of_birth', function ($row) {
                    return date("d M Y", strtotime($row->date_of_birth));
                })
                ->editColumn('class', function ($row) {
                    return strtoupper($row->class);
                })
                ->editColumn('major', function ($row) {
                    return strtoupper($row->major);
                })
                ->editColumn('role', function ($row) {
                    return $row->role === 'adm' ? '<span class="badge badge-primary">Admin</span>' :
                        '<span class="badge badge-danger">User</span>';
                })
                ->rawColumns(['action', 'date_of_birth', 'class', 'major', 'role'])
                ->make(true);
        }
        return view('admin.teacher.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teacher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin.teacher.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        toast('Data berhasil di hapus!', 'success');
        return redirect()->back();
    }

    public function export()
    {
        try {
            return Excel::download(new TeacherExport, 'guru.xlsx');
        } catch (\Throwable $th) {
            toast('Gagal mengunduh!', 'error');
            return redirect()->back();
        }
    }

    public function import(ExcelRequest $request)
    {
        try {
            Excel::import(new TeacherImport, $request->file('file'));
            toast('Data berhasil di import!', 'success');
        } catch (\Throwable $th) {
            toast('Gagal import data. Cek ulang file excel!', 'error');
        }
        return redirect()->back();
    }
}