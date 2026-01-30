<?php

namespace App\Http\Controllers\Setting;

use App\Models\Setting;
use App\Models\EntityOrder;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.setting.index');
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
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function indexEntityOrder(Request $request)
    {
        $role = $request->get('role', 'all');

        $query = EntityOrder::with('user');

        if ($role !== 'all') {
            $query->where('role', $role);
        }

        $entityOrders = $query->orderBy('order')->get();

        return view('admin.setting.entity-order.index', compact('entityOrders', 'role'));
    }

    public function bulkUpdateEntityOrder(Request $request)
    {
        $orders = $request->input('orders');

        if ($orders && is_array($orders)) {
            foreach ($orders as $item) {
                if (isset($item['user_id']) && isset($item['order'])) {
                    EntityOrder::where('user_id', $item['user_id'])->update([
                        'order' => $item['order']
                    ]);
                }
            }
        }

        return redirect()->route('admin.setting.entity-order')->with('success', 'Urutan berhasil disimpan');
    }
}
