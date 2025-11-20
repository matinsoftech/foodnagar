@extends('layouts.app')
@section('content')
@section('title', __('Products'))
@push('styles')
    <style>
        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.375rem;
            cursor: pointer;
            border: none;
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.025em;
            transition: all 0.2s ease-in-out;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .btn-danger {
            background: linear-gradient(135deg, #e53e3e 0%, #c53030 100%);
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c53030 0%, #9c2626 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px 0 rgba(197, 48, 48, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #2f855a 0%, #276749 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px 0 rgba(47, 133, 90, 0.4);
        }

        .btn-primary {
            background: linear-gradient(135deg, #3182ce 0%, #2c5282 100%);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #2c5282 0%, #2a4365 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px 0 rgba(44, 82, 130, 0.4);
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
        }

        .card {
            background: #ffffff;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border: 1px solid rgba(229, 231, 235, 0.8);
            overflow: hidden;
            transition: box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-bottom: 2px solid #e2e8f0;
            padding: 1.25rem 1.5rem;
            font-weight: 700;
            font-size: 1.125rem;
            color: #2d3748;
            letter-spacing: 0.025em;
        }

        .card-body {
            padding: 2rem 1.5rem;
            background: #ffffff;
        }

        .alert {
            padding: 1rem 1.25rem;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid;
            font-weight: 500;
        }

        .alert-success {
            background-color: #f0fff4;
            color: #22543d;
            border-left-color: #38a169;
            border: 1px solid #9ae6b4;
        }

        .alert-danger {
            background-color: #fed7d7;
            color: #742a2a;
            border-left-color: #e53e3e;
            border: 1px solid #feb2b2;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            transition: all 0.2s ease-in-out;
            background-color: #ffffff;
        }

        .form-control:focus {
            outline: none;
            border-color: #3182ce;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
            background-color: #ffffff;
        }

        .form-control:hover {
            border-color: #d1d5db;
        }

        .mt-3 {
            margin-top: 1.5rem;
        }

        /* Container styling */
        div > div.card {
            max-width: 600px;
            margin: 0 auto;
        }

        /* File input specific styling */
        input[type="file"] {
            padding: 0.75rem;
            background: #f9fafb;
            border: 2px dashed #d1d5db;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
        }

        input[type="file"]:hover {
            border-color: #9ca3af;
            background: #f3f4f6;
        }

        input[type="file"]:focus {
            border-color: #3182ce;
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.1);
        }
    </style>
@endpush
<div>
    <div class="card">
        <div class="card-header">Bulk Upload Products</div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ route('admin.products.bulk-upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Select CSV File</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Upload</button>
            </form>
        </div>
    </div>

</div>
@endsection
@push('scripts')
    {{-- <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
@endpush