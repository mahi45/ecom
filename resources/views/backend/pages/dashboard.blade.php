@extends('backend.layouts.master')

@section('title', 'Dashboard')

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
        <h3>Admin Dashboard</h3>
        <h2 class="small-title">Analytics Report</h2>
    </div>
    <!-- Stats Start -->
    <div class="row">
        <div class="col-12">
            <div class="mb-5">
                <div class="row g-2">
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-100 hover-scale-up cursor-pointer">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div
                                    class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                                    <i data-cs-icon="dollar" class="text-primary"></i>
                                </div>
                                <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">EARNINGS
                                </div>
                                <div class="text-primary cta-4">৳ {{ $total_earning }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-100 hover-scale-up cursor-pointer">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div
                                    class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                                    <i data-cs-icon="basket" class="text-primary"></i>
                                </div>
                                <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">ORDERS
                                </div>
                                <div class="text-primary cta-4">{{ $total_order }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-100 hover-scale-up cursor-pointer">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div
                                    class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                                    <i data-cs-icon="server" class="text-primary"></i>
                                </div>
                                <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">CATEGORY
                                </div>
                                <div class="text-primary cta-4">{{ $total_category }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-100 hover-scale-up cursor-pointer">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div
                                    class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                                    <i data-cs-icon="arrow-top-left" class="text-primary"></i>
                                </div>
                                <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">PRODUCT
                                </div>
                                <div class="text-primary cta-4">{{ $total_product }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-100 hover-scale-up cursor-pointer">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div
                                    class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                                    <i data-cs-icon="user" class="text-primary"></i>
                                </div>
                                <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">USERS
                                </div>
                                <div class="text-primary cta-4">{{ $total_customer }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-100 hover-scale-up cursor-pointer">
                            <div class="card-body d-flex flex-column align-items-center">
                                <div
                                    class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                                    <i data-cs-icon="message" class="text-primary"></i>
                                </div>
                                <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">COMMENTS
                                </div>
                                <div class="text-primary cta-4">5</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Stats End -->
    <!--Order table start-->
    <div class="row">
        <div class="col-8">
            <h2>Orders List</h2>
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
        <div class="col-4">
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
    </div>
    <!--Order table end-->
@endsection

@push('admin_script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

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
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['2020', '2021', '2022'],
                datasets: [{
                    label: '# of Orders',
                    data: <?php echo json_encode($orders_yearwise); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
