@extends('layouts.admin')

@section('admin_content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Category</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-end">
                <li class="breadcrumb-item"><a href="#">Category</a></li>
                <li class="breadcrumb-item active">Categories</li>
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
                                <h3 class="card-title">Edit Category</h3>
                                <a href="{{route('category.index')}}" type="button" class="btn btn-primary float-end"><i class="fas fa-plus-circle"></i> All Categories</a>
                            </div>
                        <!-- /.card-header -->
                            <div class="card-body">
                                <form action="{{route('category.update', $category->id)}}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category Name</label>
                                        <input type="text" class="form-control" id="category_name" name="category_name" value="{{$category->category_name}}">
                                    </div>
                                    <div>
                                        <a href="{{route('category.index')}}" type="button" class="btn btn-info">Back</a>
                                        <button type="submit" class="btn btn-primary">Update Category</button>
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

