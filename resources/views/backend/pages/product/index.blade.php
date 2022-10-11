@extends('backend.layouts.master')

@section('title', 'Product');

@push('admin_style')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">

    <style>
        .dataTables_length {
            padding: 20px 0;
        }

        #dataTable th {
            color: #fff !important;
            padding-top: 12px;
        }
    </style>
@endpush


@section('admin_content')
    <div class="row">

        <div class="col-12 my-4 d-flex justify-content-between">
            <h2>Product List Table</h2>
            <a href="{{ route('product.create') }}"><button class="btn btn-primary"><i class="fa-solid fa-circle-plus"></i>
                    Add New Product</button></a>
        </div>
        <div class="col-12">
            <div class="table-responsive my-2">
                <table class="table table-striped table-bordered auto" id="dataTable">
                    <thead>
                        <tr class="bg-dark">
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Last Modified</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock/Alert</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td scope="row">{{ $products->firstItem() + $loop->index }}</td>
                                <td>
                                    <img src="{{ asset('uploads/products') }}/{{ $product->product_image }}" alt=""
                                        class="img-fluid h-20 w-20 rounded">
                                </td>
                                <td>{{ $product->updated_at->format('d-M-Y') }}</td>
                                <td>{{ $product->category->title }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->product_price }}</td>
                                <td>
                                    @if ($product->product_stock <= $product->alert_quantity)
                                        <span class="badge bg-danger">{{ $product->product_stock }}</span>
                                    @else
                                        <span class="badge bg-success">{{ $product->product_stock }}</span>
                                    @endif/
                                    <span class="badge bg-danger">{{ $product->alert_quantity }}</span>
                                </td>
                                <td>{{ $product->product_rating }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">Settings</button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('product.edit', $product->slug) }}"
                                                    class="dropdown-item"><i class="fa-solid fa-pen-to-square"></i>
                                                    Edit</a> </li>
                                            <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item show_confirm" type="submit"><i
                                                        class="fa-solid fa-trash"></i>
                                                    Delete</button>
                                            </form>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('admin_script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                pagingType: 'first_last_numbers',
            });

            $('.show_confirm').click(function(event) {
                let form = $(this).closest('form');
                event.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })
        });
    </script>
@endpush
