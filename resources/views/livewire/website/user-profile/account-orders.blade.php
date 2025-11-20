@extends('livewire.website.layouts.app')

@section('content')
    <main>
        <!-- section -->
        <section>
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center d-md-none py-4">
                            <!-- heading -->
                            <h3 class="fs-5 mb-0">Account Setting</h3>
                            <!-- button -->
                            <button class="btn btn-outline-gray-400 text-muted d-md-none btn-icon btn-sm ms-3" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasAccount" aria-controls="offcanvasAccount">
                                <i class="bi bi-text-indent-left fs-3"></i>
                            </button>
                        </div>
                    </div>

                    @include('livewire.website.user-profile.account-sidebar')

                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="py-6 p-md-6 p-lg-10">
                            <!-- heading -->
                            <h2 class="mb-6">My Orders</h2>

                            <div class="table-responsive-xxl border-0">
                                <!-- Table -->
                                <table class="table mb-0 text-nowrap table-centered">
                                    <!-- Table Head -->
                                    <thead class="bg-light">
                                        <tr>
                                            <th>S.N</th>
                                            <th>Order Code</th>
                                            <th>Total Price</th>
                                            <th>Vendor</th>
                                            <th>Payment Method</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Table body -->
                                        @foreach ($orders as $order)
                                        <tr>
                                            <td class="align-middle border-top-0">
                                                {{$loop->iteration}}
                                            </td>
                                            <td class="align-middle border-top-0">
                                                <a href="{{ route('order-details',$order->code) }}" class="fw-semibold text-inherit">
                                                   #{{$order->code}}
                                                </a>
                                            </td>
                                            <td class="align-middle border-top-0"> {{currencyFormat($order->total)}}</td>
                                            <td class="align-middle border-top-0"> {{$order->vendor ? $order->vendor->name : ''}}</td>

                                            <td class="align-middle border-top-0">
                                                <span class="badge bg-warning">{{$order->payment_method ? $order->payment_method->name : ''}}</span>
                                            </td>
                                            <td class="align-middle border-top-0">
                                                <span class="badge bg-warning">{{$order->payment_status ? $order->payment_status : ''}}</span>
                                            </td>
                                            <td class="align-middle border-top-0">{{ $order->created_at->format('F j, Y, g:i a') }}
                                            </td>
                                            <td class="text-muted align-middle border-top-0">
                                                <a href="{{ route('order-details',$order->code) }}" class="text-inherit" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" data-bs-title="View"><i
                                                        class="feather-icon icon-eye"></i></a>
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
    </main>
@endsection

