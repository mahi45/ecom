@extends('backend.layouts.master')

@section('title', 'Order');

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
            <h2>Order List Table</h2>
        </div>
        <div class="col-12">
            <div class="table-responsive my-2">
                <table class="table table-striped table-bordered" id="dataTable">
                    <thead>
                        <tr class="bg-dark">
                            <th scope="col">#</th>
                            <th scope="col">View Details</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Sub Total(BDT)</th>
                            <th scope="col">Discount(BDT)</th>
                            <th scope="col">Total(BDT)</th>
                            <th scope="col">Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td scope="row">{{ $loop->index + 1 }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modal{{ $order->id }}">Order Details</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modal{{ $order->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modal{{ $order->id }}Title" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="width: 800px">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="#modal{{ $order->id }}Title">Order Number
                                                        #{{ $order->id }}
                                                    </h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                @include('backend.pages.order.order-details1')
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $order->created_at->format('d-M-Y H:i:s') }}</td>
                                <td>{{ $order->sub_total }}</td>
                                <td>{{ $order->discount_amount }}({{ $order->coupon_name }})</td>
                                <td>{{ $order->total }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">Settings</button>
                                        <ul class="dropdown-menu">
                                            <li><a href="" class="dropdown-item"><i
                                                        class="fa-solid fa-pen-to-square"></i>
                                                    Edit</a> </li>
                                            <form action="" method="POST">
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
