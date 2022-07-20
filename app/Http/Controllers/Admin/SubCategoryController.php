<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Http\Requests\SubCategoryRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $data = DB::table('subcategories')->leftJoin('categories', 'subcategories.category_id', 'categories.id')
        //     ->select('subcategories.*', 'categories.category_name')
        //     ->get();

        $data = Subcategory::all();
        $category = Category::all();

        return view('admin.category.subcategory.index', [
            'data' => $data,
            'category' => $category
        ]);
    }

    public function store(SubCategoryRequest $request)
    {
        $validated = $request->validated();
        $validated['subcategory_slug'] = Str::of($validated['subcategory_name'])->slug('-');
        Subcategory::create($validated);
        return redirect()->route('subcategory.index');
    }

    public function delete($id)
    {
        Subcategory::find($id)->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
        $subcategory = Subcategory::find($id);
        $category = Category::all();
        return view('admin.category.subcategory.edit', [
            'subcategory' => $subcategory,
            'category' => $category
        ]);
    }

    public function update(SubCategoryRequest $request, $id)
    {
        $validated = $request->validated();
        $validated['subcategory_slug'] = Str::of($request['subcategory_name'])->slug('-');
        Subcategory::find($id)->update($validated);
        return redirect()->route('subcategory.index');
    }
}
