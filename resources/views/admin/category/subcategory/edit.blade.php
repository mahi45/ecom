@extends('layouts.admin')

@section('admin_content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Sub Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-end">
                <li class="breadcrumb-item"><a href="#">Sub Category</a></li>
                <li class="breadcrumb-item active">Sub Categories</li>
                </ol>
            </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit Sub Category</h3>
                                <a href="{{route('subcategory.index')}}" type="button" class="btn btn-primary float-end"><i class="fas fa-plus-circle"></i> All Sub Categories</a>
                            </div>
                        <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{route('subcategory.update', $subcategory->id)}}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category Name</label>
                                        <select class="form-control" name="category_id" required>
                                            <option value="">Select category name</option>
                                            @foreach ($category as $row)
                                                <option value="{{$row->id}}" @if ($row->id == $subcategory->category_id) selected @endif>{{$row->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="subcategory" class="form-label">Sub Category Name</label>
                                        <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" value="{{$subcategory->subcategory_name}}">
                                    </div>
                                    <div>
                                        <a href="{{route('subcategory.index')}}" type="button" class="btn btn-info">Back</a>
                                        <button type="submit" class="btn btn-primary">Update Sub Category</button>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

