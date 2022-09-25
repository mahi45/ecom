@extends('backend.layouts.master')

@section('title', 'Category');

@section('admin_content')
    <h2>Category List Table</h2>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive my-2">
                <table class="table table-striped table-bordered">
                    <thead class="bg-dark">
                        <tr>
                            <th scope="col" class="text-white">#</th>
                            <th scope="col" class="text-white">Last Modified</th>
                            <th scope="col" class="text-white">Category Name</th>
                            <th scope="col" class="text-white">Category Slug</th>
                            <th scope="col" class="text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $loop->index }}</td>
                                <td>{{ $category->updated_at->format('d-m-Y') }}</td>
                                <td>{{ $category->title }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>Edit || Delete</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
