@extends('layouts.app')

@section('title', 'Our Partners')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto bg-white shadow-lg rounded-2xl overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-indigo-600">
            <h2 class="text-xl font-semibold text-white">Our Partners</h2>

            <form method="GET" class="flex items-center space-x-2">
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Search name or phone" 
                    class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:outline-none w-64">
                <button type="submit" class="bg-white text-blue-700 text-sm px-3 py-1.5 rounded-lg font-medium hover:bg-gray-100 transition">
                    Search
                </button>
            </form>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 text-sm m-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 uppercase text-xs text-gray-600">
                    <tr>
                        <th class="px-6 py-3">#</th>
                        <th class="px-6 py-3">Restaurant</th>
                        <th class="px-6 py-3">Owner</th>
                        <th class="px-6 py-3">Phone</th>
                        <th class="px-6 py-3">Address</th>
                        <th class="px-6 py-3">Message</th>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($partners as $index => $partner)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-3">{{ $partners->firstItem() + $index }}</td>
                            <td class="px-6 py-3 font-medium text-gray-800">{{ $partner->restaurant_name }}</td>
                            <td class="px-6 py-3">{{ $partner->owner_name }}</td>
                            <td class="px-6 py-3">{{ $partner->phone }}</td>
                            <td class="px-6 py-3">{{ $partner->address }}</td>
                            <td class="px-6 py-3 text-gray-600">{{ $partner->message ?? '-' }}</td>
                            <td class="px-6 py-3">{{ $partner->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-3 text-center">
                                <form action="{{ route('our_partners.destroy', $partner->id) }}" method="POST" onsubmit="return confirmDelete(event)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-gray-500 py-6">No partners found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($partners->hasPages())
        <div class="px-6 py-4 border-t bg-gray-50 flex justify-center">
            {{ $partners->links('pagination::tailwind') }}
        </div>
        @endif
    </div>
</div>

<script>
    function confirmDelete(e) {
        if (!confirm('Are you sure you want to delete this partner?')) {
            e.preventDefault();
            return false;
        }
    }
</script>
@endsection
