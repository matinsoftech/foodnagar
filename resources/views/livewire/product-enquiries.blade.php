@extends('layouts.app')
@section('content')
@section('title', __('Product Enquiries'))

<style>
    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .table-header {
        background-color: #f8f9fa;
    }

    .table-row:nth-child(even) {
        background-color: #f2f2f2;
    }

    .table-row:hover {
        background-color: #e9ecef;
    }

    .table th,
    .table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .user-info {
        display: flex;
        flex-direction: column;
    }

    .text-muted {
        color: #6c757d;
    }

    .product-link {
        color: #007bff;
        text-decoration: none;
    }

    .product-link:hover {
        text-decoration: underline;
    }

    .btn {
        display: inline-block;
        padding: 5px 10px;
        font-size: 14px;
        text-align: center;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .btn-info {
        background-color: #17a2b8;
        color: #fff;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    .btn-danger {
        background-color: #dc3545;
        color: #fff;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }
</style>
<x-baseview title="{{ __('Product Enquiries') }}">
    <table class="table">
        <thead class="table-header">
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Product</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enquiries as $enquiry)
                <tr class="table-row">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="user-info">
                            {{ $enquiry->user->name ?? 'N/A' }} <br>
                            <small class="text-muted">{{ $enquiry->user->email ?? 'N/A' }}</small>
                        </div>
                    </td>
                    <td>
                        <a href="{{ route('products_view', $enquiry->product_id) }}" class="product-link">
                            {{ $enquiry->product->name ?? 'N/A' }}
                        </a>
                    </td>
                    <td>{{ $enquiry->subject ?? 'N/A' }}</td>
                    <td>{{ $enquiry->message ?? 'N/A' }}</td>
                    <td>{{ $enquiry->created_at->format('d M, Y H:i') }}</td>
                    <td>
                        <!-- View or Delete Actions -->
                        <a href="{{ route('products_view', $enquiry->product_id) }}" class="btn btn-info btn-sm"
                            title="View Product">
                            <i class="fas fa-eye"></i>
                        </a>
                        {{-- <form action="{{ route('admin.enquiries.delete', $enquiry->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Enquiry">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form> --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No enquiries found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-3">
        {{ $enquiries->links() }}
    </div>
</x-baseview>

@endsection
