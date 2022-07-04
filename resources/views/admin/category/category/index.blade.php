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
                                <h3 class="card-title">All Categories</h3>
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#categoryModal"><i class="fas fa-plus-circle"></i> Add Category</button>
                            </div>
                        <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Category Name</th>
                                        <th>Category Slug</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key=>$data)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$data->category_name}}</td>
                                                <td>{{$data->category_slug}}</td>
                                                <td>
                                                    <a href="{{route('category.edit', $data->id)}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                                    <a href="{{route('category.delete', $data->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<!-- Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('category.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                      <label for="category" class="form-label">Category Name</label>
                      <input type="text" class="form-control" id="category_name" name="category_name">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Category</button>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>
@endsection

