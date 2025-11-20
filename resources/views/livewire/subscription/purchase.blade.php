@extends('layouts.app')

@section('title', 'Subscription Purchases')

@section('content')
<div class="w-full bg-gray-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto">

        <h2 class="text-2xl font-bold text-gray-800 mb-6">Subscription Purchases</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($purchases as $purchase)
                <div class="bg-white shadow-md rounded-xl p-6 flex flex-col justify-between">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $purchase->package->name ?? 'N/A' }}</h3>
                        <p class="text-gray-600 text-sm mb-2">{{ $purchase->package->description ?? '' }}</p>
                        <p class="text-gray-700 text-sm"><strong>User:</strong> {{ $purchase->user->name ?? 'N/A' }}</p>
                        <p class="text-gray-700 text-sm"><strong>Amount:</strong> {{ $purchase->amount ?? 0 }}</p>
                        <p class="text-gray-700 text-sm"><strong>Start Date:</strong> {{ $purchase->start_date ?? 'N/A' }}</p>
                        <p class="text-gray-700 text-sm"><strong>End Date:</strong> {{ $purchase->end_date }}</p>
                        <p class="mt-2"><strong>Status:</strong>
                            <span class="px-2 py-1 rounded {{ $purchase->status == 'completed' ? 'bg-green-200 text-green-800' : ($purchase->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                                {{ ucfirst($purchase->status) }}
                            </span>
                        </p>
                        @if($purchase->payment_receipt)
                            <a href="{{ asset('storage/'.$purchase->payment_receipt) }}" target="_blank" class="mt-2 inline-block text-blue-600 underline text-sm">
                                View Receipt
                            </a>
                        @endif
                    </div>

                    @if($purchase->status == 'pending')
                        <form action="{{ route('subscription_purchases.update_status', $purchase->id) }}" method="POST" class="flex gap-2 mt-4">
                            @csrf
                            <select name="status" class="border rounded px-2 py-1 flex-1">
                                <option value="pending" {{ $purchase->status=='pending'?'selected':'' }}>Pending</option>
                                <option value="completed">Completed</option>
                                <option value="rejected">Rejected</option>
                            </select>
                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Update</button>
                        </form>
                    @endif
                </div>
            @empty
                <p class="col-span-3 text-center text-gray-500">No purchases found.</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $purchases->links() }}
        </div>
    </div>
</div>
@endsection
