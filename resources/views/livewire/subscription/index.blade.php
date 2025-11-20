@extends('layouts.app')

@section('title', 'Subscription Packages')

@section('content')
<div class="w-full bg-gray-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto bg-white shadow-md rounded-xl p-8">
        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-5 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800">Subscription Packages</h2>
            <a href="{{ route('subscription.create') }}"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 4v16m8-8H4" />
                </svg>
                Add New
            </a>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table View (Desktop) -->
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-lg">
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left">Photo</th>
                        <th class="px-4 py-3 text-left">Package Name</th>
                        {{-- <th class="px-4 py-3 text-left">Vendor Type</th> --}}
                        <th class="px-4 py-3 text-left">Days</th>
                        <th class="px-4 py-3 text-left">Amount</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($packages as $package)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                @if($package->photo)
                                    <img src="{{ asset('storage/'.$package->photo) }}" alt="{{ $package->name }}" class="h-12 w-12 rounded-lg object-cover">
                                @else
                                    <div class="h-12 w-12 flex items-center justify-center bg-gray-200 text-gray-500 rounded-lg text-sm">
                                        No Image
                                    </div>
                                @endif
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-800">{{ $package->name }}</td>
                            {{-- <td class="px-4 py-3 text-gray-700">{{ $package->vendorType->name ?? '—' }}</td> --}}
                            <td class="px-4 py-3 text-gray-700">{{ $package->days }} days</td>
                            <td class="px-4 py-3 text-gray-700">
                                @if($package->is_free)
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Free</span>
                                @else
                                    ${{ number_format($package->amount, 2) }}
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                @if($package->status === 'active')
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">Active</span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">Inactive</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('subscription.edit', $package->id) }}"
                                       class="text-blue-600 hover:text-blue-800 transition">
                                        <i class="fas fa-edit mr-1 text-sm"></i>
                                        
                                    </a>
                                    <form action="{{ route('subscription.destroy', $package->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this package?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-6">No subscription packages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Card View (Mobile) -->
        <div class="md:hidden space-y-4">
            @forelse($packages as $package)
                <div class="border border-gray-200 rounded-lg p-4 shadow-sm bg-white">
                    <div class="flex items-center gap-4">
                        @if($package->photo)
                            <img src="{{ asset('storage/'.$package->photo) }}" alt="{{ $package->name }}" class="h-16 w-16 rounded-lg object-cover">
                        @else
                            <div class="h-16 w-16 flex items-center justify-center bg-gray-200 text-gray-500 rounded-lg text-sm">No Image</div>
                        @endif
                        <div>
                            <h3 class="font-semibold text-gray-800">{{ $package->name }}</h3>
                            {{-- <p class="text-sm text-gray-600">{{ $package->vendorType->name ?? '—' }}</p> --}}
                        </div>
                    </div>
                    <div class="mt-3 text-sm text-gray-600">
                        <p><strong>Days:</strong> {{ $package->days }}</p>
                        <p><strong>Status:</strong>
                            @if($package->status === 'active')
                                <span class="text-blue-600 font-medium">Active</span>
                            @else
                                <span class="text-red-600 font-medium">Inactive</span>
                            @endif
                        </p>
                        <p><strong>Amount:</strong>
                            @if($package->is_free)
                                <span class="text-green-600 font-medium">Free</span>
                            @else
                                ${{ number_format($package->amount, 2) }}
                            @endif
                        </p>
                    </div>
                    <div class="mt-4 flex justify-end gap-3">
                        <a href="{{ route('subscription.edit', $package->id) }}"
                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                           <i class="fas fa-edit mr-1 text-sm"></i>
                        </a>
                        <form action="{{ route('subscription.destroy', $package->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Delete</button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">No subscription packages found.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $packages->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection
