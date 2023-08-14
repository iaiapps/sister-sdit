<?php

namespace App\Http\Controllers\Presence;

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
        $presence_settings = PresenceSetting::where('name', '!=', 'qrcode')->get();
        $qrcode = PresenceSetting::where('name', '=', 'qrcode')->get()->first();

        return view('admin.setting.presence.index', compact('presence_settings', 'qrcode'));
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
        return redirect()->route('presenceset.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PresenceSetting $presenceSetting)
    {
        //
    }
}
