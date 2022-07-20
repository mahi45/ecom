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
                                <h3 class="card-title">All Sub Categories</h3>
                                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#subcategoryModal"><i class="fas fa-plus-circle"></i> Add Sub Category</button>
                            </div>
                        <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Sub Category Name</th>
                                        <th>Sub Category Slug</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key=>$data)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$data->subcategory_name}}</td>
                                                <td>{{$data->subcategory_slug}}</td>
                                                <td>{{$data->category->category_name}}</td>
                                                <td>
                                                    <a href="{{route('subcategory.edit', $data->id)}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                                                    <a href="{{route('subcategory.delete', $data->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
<div class="modal fade" id="subcategoryModal" tabindex="-1" aria-labelledby="subcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="subcategoryModalLabel">Add New Sub Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('subcategory.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category" class="form-label">Category Name</label>
                        <select class="form-control" name="category_id" required>
                            <option value="">Select category name</option>
                            @foreach ($category as $row)
                                <option value="{{$row->id}}">{{$row->category_name}}</option>
                            @endforeach
                        </select>
                      </div>
                    <div class="mb-3">
                      <label for="subcategory" class="form-label">Sub Category Name</label>
                      <input type="text" class="form-control" id="subcategory_name" name="subcategory_name">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Sub Category</button>
                    </div>
                </form>
            </div>    
        </div>
    </div>
</div>
@endsection

