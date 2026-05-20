<?php

namespace App\Http\Controllers\Setting;

use App\Models\PresenceSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PresenceSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = PresenceSetting::all();

        $qrcode = $all->where('name', 'qrcode')->first();

        $umum = $all->whereIn('name', ['latitude', 'longitude', 'radius', 'version', 'versionk', 'timeline']);

        $grupA = $all->reject(fn ($s) =>
            str_contains($s->name, ':') || in_array($s->name, ['qrcode', 'latitude', 'longitude', 'radius', 'version', 'versionk', 'timeline'])
        );

        $karyawan  = $all->filter(fn ($s) => str_ends_with($s->name, ':karyawan'));
        $kasir     = $all->filter(fn ($s) => str_ends_with($s->name, ':kasir'));
        $ibudapur  = $all->filter(fn ($s) => str_ends_with($s->name, ':ibudapur'));

        return view('admin.setting.presence.index', compact('qrcode', 'umum', 'grupA', 'karyawan', 'kasir', 'ibudapur'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PresenceSetting $presenceSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PresenceSetting $presenceset)
    {
        return view('admin.setting.presence.edit', compact('presenceset'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PresenceSetting $presenceset)
    {
        // dd($request);
        $presenceset->update($request->all());
        return redirect()->route('admin.presenceset.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PresenceSetting $presenceSetting)
    {
        //
    }
}
