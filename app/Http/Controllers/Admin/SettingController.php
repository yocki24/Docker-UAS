<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $data = Setting::first();
        return view('admin.setting.index', compact('data'));
    }

    public function create()
    {
        $data = Setting::first();
        return view('admin.setting.edit', compact('data'));
    }

    public function updateLogo(Request $request)
    {
        $data = Setting::first();
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $exist = file_exists(storage_path('app/public/' . $data->logo));
            if (isset($data->logo) && $exist) {
                Storage::delete('public/' . $data->logo);
            }
            $ext = $file->getClientOriginalExtension();
            $file_name = date('YmdHis') . ".$ext";
            $file->storeAs('logo', $file_name, 'public');
            $payload['logo'] = 'logo/' . $file_name;
        }
        $data->update($payload);
        toast('Logo berhasil diupdate.', 'succes');
        return redirect()->route('admin.setting.index');
    }

    public function updateData(Request $request)
    {
        $payload = $request->all();
        Setting::first()->update($payload);
        toast('Data berhasil diupdate.', 'succes');
        return redirect()->route('admin.setting.index');
    }
}