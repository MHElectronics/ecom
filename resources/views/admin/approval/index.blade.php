@extends('layouts.admin')

@section('title', 'Order Approvals')

@section('content')
    <div class="br-pagetitle">
        <i class="icon ion-ios-checkmark-outline"></i>
        <div>
            <h4>Order Approvals</h4>
            <p class="mg-b-0">Approve or Reject Pending Orders</p>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Product</th>
                        <th>Subtotal</th>
                        <th>Shipping</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name ?? 'N/A' }}</td>
                        <td>{{ $order->product_name ?? 'N/A' }}</td>
                        <td>৳{{ $order->sub_total }}</td>
                        <td>৳{{ $order->total_shipping_charge }}</td>
                        <td>৳{{ $order->final_total }}</td>
                        <td><span class="badge badge-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'approved' ? 'success' : 'danger') }}">{{ ucfirst($order->status) }}</span></td>
                        <td>
                            @if($order->status === 'pending')
                                <form action="{{ route('admin.orders.approve', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-sm btn-success">Approve</button>
                                </form>
                                <form action="{{ route('admin.orders.reject', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <button class="btn btn-sm btn-danger">Reject</button>
                                </form>
                            @else
                                <em>No action</em>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No orders found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="mt-3">
                {{ $orders->links('admin.shared._paginate') }}
            </div>
        </div>
    </div>
@endsection
