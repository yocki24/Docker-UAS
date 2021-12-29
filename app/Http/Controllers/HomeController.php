<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        return view('user.home.index');
    }

    public function dashboard()
    {
        $candidate = Candidate::with('user')->orderBy('order')->get();
        $voted = Vote::with('candidate')->where('user_id', Auth::user()->id)->first();
        return view('user.dashboard', compact('candidate', 'voted'));
    }

    public function visimisi(Request $request)
    {
        $data = Candidate::findOrFail($request->id);
        return response()->json(['html' => view('user.visimisi', compact('data'))->render()], 200);
    }

    public function pilih(Request $request)
    {
        $data = Candidate::findOrFail($request->id);
        return response()->json(['html' => view('user.pilih', compact('data'))->render()], 200);
    }

    public function storePilih(Request $request)
    {
        $payload = $request->all();
        $payload['user_id'] = Auth::user()->id;
        $exist = Vote::where('user_id', Auth::user()->id)->first();
        if ($exist) {
            toast('Hak pilih hanya untuk 1 kali', 'error');
            return redirect()->route('user.dashboard');
        }
        Vote::create($payload);
        toast('Pemilihan kandidat telah berhasil', 'success');
        return redirect()->route('user.dashboard');
    }
}