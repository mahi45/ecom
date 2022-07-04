<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Showing all category
    public function index()
    {
        // $data = DB::table('categories')->get(); //Query builder
        $data = Category::orderBy('id', 'desc')->get();
        return view('admin.category.category.index', [
            'data' => $data
        ]);
    }

    public function store(categoryRequest $request)
    {
        $validated = $request->validated();
        $validated['category_slug'] = Str::of($validated['category_name'])->slug('-');

        Category::create($validated);

        return redirect()->back();
    }

    public function delete($id)
    {
        Category::find($id)->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.category.edit', [
            'category' => $category
        ]);
    }

    public function update(categoryRequest $request, $id)
    {
        $validated = $request->validated();
        $validated['category_slug'] = Str::of($request['category_name'])->slug('-');
        Category::find($id)->update($validated);
        return redirect()->route('category.index');
    }
}
