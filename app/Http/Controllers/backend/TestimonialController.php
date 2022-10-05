<?php

namespace App\Http\Controllers\backend;

use App\Models\Testimonial;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Intervention\Image\Facades\Image;
use App\Http\Requests\TestimonialStoreRequest;
use App\Http\Requests\TestimonialUpdateRequest;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $testimonials = Testimonial::latest('id')->select(['id', 'client_name', 'client_name_slug', 'client_designation', 'client_message','is_active', 'client_image', 'updated_at'])->paginate();

        return view('backend.pages.testimonial.index', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonialStoreRequest $request)
    {
        // dd($request->all());
        $testimonial = Testimonial::create([
            'client_name' => $request->client_name,
            'client_name_slug' => Str::slug($request->client_name),
            'client_designation' => $request->client_designation,
            'client_message' => $request->client_message,
        ]);

        $this->imageUpload($request, $testimonial->id);

        Toastr::success('Testimonial Stored Successfully');
        return redirect()->route('testimonial.index');
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
        $edit_testimonial = Testimonial::where('client_name_slug', $slug)->first();
        return view('backend.pages.testimonial.edit' ,compact('edit_testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestimonialUpdateRequest $request, $slug)
    {
        $update_testimonial = Testimonial::where('client_name_slug', $slug)->first();
        $update_testimonial->update([
            'client_name' => $request->client_name,
            'client_name_slug' => Str::slug($request->client_name),
            'client_designation' => $request->client_designation,
            'client_message' => $request->client_message,
            'is_active' => $request->filled('is_active'),
        ]);

        $this->imageUpload($request, $update_testimonial->id);

        Toastr::success('Testimonial updated Successfully');
        return redirect()->route('testimonial.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $del_testimonial = Testimonial::where('client_name_slug', $slug)->first();
        if($del_testimonial->client_image){
            $photo_location = 'uploads/testimonials/'.$del_testimonial->client_image;
            unlink($photo_location);
        }
        $del_testimonial->delete();
        Toastr::success('Testimonial deleted Successfully');
        return redirect()->route('testimonial.index');
    }

    public function imageUpload($request, $item_id){
        $testimonial = Testimonial::findorFail($item_id);

        if($request->hasFile('client_image')){
            if($testimonial->client_image != 'default-client.jpg'){
                $photo_location = 'public/uploads/testimonials/';
                $old_photo_location = $photo_location.$testimonial->client_image;
                unlink(base_path($old_photo_location));
            }
            $photo_location = 'public/uploads/testimonials/';
            $uploaded_photo = $request->file('client_image');
            $new_photo_name = $testimonial->id.'.'.$uploaded_photo->getClientOriginalExtension();
            $new_photo_location = $photo_location.$new_photo_name;
            Image::make($uploaded_photo)->resize(105,105)->save(base_path($new_photo_location), 40);
            $check = $testimonial->update([
                'client_image' => $new_photo_name
            ]);
        }
    }
}
