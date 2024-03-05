<?php

namespace App\Http\Controllers\Mutabaah;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Category::all();
        return view('mutabaah.admin.category.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('mutabaah.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect()->route('mutabaah-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $mutabaah_category)
    {
        return view('mutabaah.admin.category.show', compact('mutabaah_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $mutabaah_category)
    {
        return view('mutabaah.admin.category.edit', compact('mutabaah_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $mutabaah_category)
    {
        $mutabaah_category->update($request->all());
        return redirect()->route('mutabaah-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('mutabaah-category.index');
    }
}
