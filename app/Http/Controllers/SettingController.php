<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        activity()->log('Membuka menu pengaturan');
        return view('setting.index');
    }

    public function show()
    {
        return Setting::first();
        
    }

    public function update(Request $request)
    {
        $setting = Setting::first();
        $setting->company_name = $request->company_name;
        $setting->address = $request->address;
        $setting->phone = $request->phone;
        $setting->nota_type = $request->nota_type;
        
        if ($request->hasFile('path_logo'))
        {
            $file   = $request->file('path_logo');
            $name = 'logo-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('/img'), $name);


            $setting->path_logo = "/img/$name";
        }

        $setting->update();
        activity()->log('Mengubah data pengaturan');

        return response()->json('Data berhasil disimpan', 200);
    }
}
