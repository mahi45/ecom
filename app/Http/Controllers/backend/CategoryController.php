<?php

namespace App\Http\Controllers\backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest('id')->select(['id','category_image' ,'title', 'slug','is_active', 'updated_at'])->paginate();

        // return $categories;
        return view('backend.pages.category.index', compact('categories'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request)
    {
        $category = Category::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title)
        ]);

        $this->imageUpload($request, $category->id);

        Toastr::success('Category Stored Successfully');

        return redirect()->route('category.index');
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
    public function edit($slug)
    {
        $edit_cat = Category::whereSlug($slug)->first();
        return view('backend.pages.category.edit', compact('edit_cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $slug)
    {
        $update_cat = Category::whereSlug($slug)->first();
        // return $update_cat;
        $update_cat->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'is_active' => $request->filled('is_active')
        ]);

        $this->imageUpload($request, $update_cat->id);

        Toastr::success('Category Updated Successfully');

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $del_category = Category::whereSlug($slug)->first();
        if($del_category->category_image){
            $photo_location = 'uploads/categories/'.$del_category->category_image;
            unlink($photo_location);
        }
        $del_category->delete();
        Toastr::success('Category Deleted Successfully');
        return redirect()->route('category.index');
    }

    public function imageUpload($request, $item_id){
        $category = Category::findorFail($item_id);

        if($request->hasFile('category_image')){
            if($category->category_image != 'default-image.jpg'){
                $photo_location = 'public/uploads/categories/';
                $old_photo_location = $photo_location.$category->category_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/categories/';
            $uploaded_photo = $request->file('category_image');
            $new_photo_name = $category->id.'.'.$uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location.$new_photo_name;
            Image::make($uploaded_photo)->save(base_path($new_photo_location), 40);
            $check = $category->update([
                'category_image' => $new_photo_name
            ]);
        }
    }


}
