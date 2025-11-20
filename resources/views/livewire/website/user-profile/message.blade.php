@extends('livewire.website.layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/assets/css/listing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/assets/css/message.css') }}">

    <style>
        .message-filter-src input {
            padding: 5px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .message-filter-group select {
            -webkit-tap-highlight-color: transparent;
            background-color: transparent;
            clear: both;
            cursor: pointer;
            display: block;
            float: left;
            font-weight: normal;
            font-family: inherit;
            padding-right: 15px;
            outline: none;
            position: relative;
            text-transform: capitalize;
            text-align: left !important;
            -webkit-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            white-space: nowrap;
            width: auto;
            border: unset;
        }
    </style>
@endsection

@section('content')
    <main>

        <section>
            <!-- container -->
            <div class="container_sec">
                <!-- row -->
                <div class="row ">
                    <!-- col -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center d-md-none py-4">
                            <!-- heading -->
                            <h3 class="fs-5 mb-0">Account Setting</h3>
                            <!-- button -->
                            <button class="btn btn-outline-gray-400 text-muted d-md-none btn-icon btn-sm ms-3" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasAccount"
                                aria-controls="offcanvasAccount">
                                <i class="bi bi-text-indent-left fs-3"></i>
                            </button>
                        </div>
                    </div>

                    @include('livewire.website.user-profile.account-sidebar')
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="py-6 p-md-0 p-lg-0">
                            <!-- MESSAGE PART START -->
                            <section class="message-part mb-5">
                                <div class="container_sec">
                                    <div class="row">
                                        <div class="col-lg-5 col-xl-4">
                                            <div class="message-filter">
                                                <div class="message-filter-group">
                                                    {{-- <select class="select" id="user_type">
                                                        <option value="">All</option>
                                                        <option value="vendors">Vendors</option>
                                                        <option value="users">Users</option>
                                                    </select> --}}
                                                    {{-- <button class="message-filter-btn"><i class="fas fa-search"></i></button> --}}
                                                    <!-- <button class="message-filter-btn">
                                                        <i class="fas fa-search"></i>
                                                    </button> -->
                                                                        {{-- <div class="search-text-form" style="display: none;">
                                                    <input type="text" placeholder="Search..." />
                                                </div> --}}

                                                                    </div>
                                                                    <!-- <form class="message-filter-src" style="display: none;">
                                                    <input type="text" placeholder="Search for Username" />
                                                </form> -->
                                                <ul class="message-list">
                                                    @foreach ($messages as $message)
                                                        @if($message->user_id == auth()->user()->id)
                                                        <li class="message-item unread message_vendor"
                                                            data-id="{{ $message->vendor->id }}">
                                                            <a href="#" class="message-link">
                                                                <div class="message-img active">
                                                                    @php
                                                                        $vendorPhoto =
                                                                            $message->vendor->photo ??
                                                                            asset('images/user.png');
                                                                    @endphp
                                                                    <img src="{{ $vendorPhoto }}" alt="avatar">
                                                                </div>
                                                                <div class="message-text">
                                                                    <h6>{{ $message->vendor->name }} <span>
                                                                            {{ $message->updated_at ? \Carbon\Carbon::parse($message->updated_at)->diffForHumans() : now()->diffForHumans() }}</span>
                                                                    </h6>
                                                                    <p>
                                                                        @php
                                                                        $lastMessage = \app\Models\MessageDetail::with('user', 'vendor')
                                                                                        ->where(function($query) use($message) {
                                                                                            $query->where('vendor_id', $message->vendor_id)->where('user_id', auth()->user()->id);
                                                                                        })
                                                                                        ->orWhere(function($query) use($message) {
                                                                                            $query->where('vendor_id', auth()->user()->id)->where('user_id', $message->vendor_id);
                                                                                        })->latest()->first(); 
                                                                        $messageCount = \app\Models\MessageDetail::with('user', 'vendor')
                                                                                        ->where(function($query) use($message) {
                                                                                            $query->where('vendor_id', $message->vendor_id)->where('user_id', auth()->user()->id);
                                                                                        })
                                                                                        ->orWhere(function($query) use($message) {
                                                                                            $query->where('vendor_id', auth()->user()->id)->where('user_id', $message->vendor_id);
                                                                                        })->latest()->count();
                                                                         
                                                                        @endphp
                                                                        
                                                                        {{ $messageCount ?? 0 }}
                                                                    </p>
                                                                </div>
                                                                <span class="message-count">
                                                                    @if($message->MessageDetail && $message->MessageDetail->isNotEmpty())
                                                                    {{ $message->MessageDetail->count() }}
                                                                    @else 
                                                                    0
                                                                    @endif
                                                                </span>
                                                            </a>
                                                        </li>
                                                        @else
                                                        <li class="message-item unread message_vendor"
                                                            data-id="{{ $message->user->id }}">
                                                            <a href="#" class="message-link">
                                                                <div class="message-img active">
                                                                    @php
                                                                        $vendorPhoto =
                                                                            $message->user->photo ??
                                                                            asset('images/user.png');
                                                                    @endphp
                                                                    <img src="{{ $vendorPhoto }}" alt="avatar">
                                                                </div>
                                                                <div class="message-text">
                                                                    <h6>{{ $message->vendor->name }} <span>
                                                                            {{ $message->updated_at ? \Carbon\Carbon::parse($message->updated_at)->diffForHumans() : now()->diffForHumans() }}</span>
                                                                    </h6>
                                                                    <p>
                                                                        @php
                                                                        $lastMessage = \app\Models\MessageDetail::with('user', 'vendor')
                                                                                        ->where(function($query) use($message) {
                                                                                            $query->where('vendor_id', $message->user_id)->where('user_id', auth()->user()->id);
                                                                                        })
                                                                                        ->orWhere(function($query) use($message) {
                                                                                            $query->where('vendor_id', auth()->user()->id)->where('user_id', $message->user_id);
                                                                                        })->latest()->first(); 
                                                                        $messageCount = \app\Models\MessageDetail::with('user', 'vendor')
                                                                                        ->where(function($query) use($message) {
                                                                                            $query->where('vendor_id', $message->user_id)->where('user_id', auth()->user()->id);
                                                                                        })
                                                                                        ->orWhere(function($query) use($message) {
                                                                                            $query->where('vendor_id', auth()->user()->id)->where('user_id', $message->user_id);
                                                                                        })->count();
                                                                        @endphp
                                                                        @if($lastMessage)
                                                                            {{ $lastMessage->message }}
                                                                        @else
                                                                            No message
                                                                        @endif
                                                                    </p>
                                                                </div>
                                                                <span
                                                                    class="message-count">
                                                                    {{ $messageCount ?? 0 }}
                                                                </span>
                                                            </a>
                                                        </li>

                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-xl-8">
                                            <div id="messageInbox" class="message-inbox" style="margin-bottom: 25px;">
                                                <div class="inbox-header">
                                                    <div class="inbox-header-profile">
                                                        <a class="inbox-header-img" href="#">
                                                            <img src="{{ $vendorImage }}" alt="avatar">
                                                        </a>
                                                        @if (isset($message))
                                                            <div class="inbox-header-text">
                                                                <h5><a href="#">
                                                                    @if($messages->first()->user_id == auth()->user()->id)
                                                                        {{ $messages->first()?->vendor?->name }}
                                                                    @else
                                                                        {{ $messages->first()?->user?->name }}
                                                                    @endif
                                                                </a>
                                                                </h5>
                                                                <span>{{ $message?->updated_at ? \Carbon\Carbon::parse($message->updated_at)->diffForHumans() : now()->diffForHumans() }}</span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <ul class="inbox-header-list">
                                                        <li><a href="#" title="Delete" class="fas fa-trash-alt"></a>
                                                        </li>
                                                        <li><a href="#" title="Report" class="fas fa-flag"></a></li>
                                                        <li><a href="#" title="Block" class="fas fa-shield-alt"></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <ul class="inbox-chat-list">
                                                    @foreach ($chatMessages as $chatMessage)
                                                        <li
                                                            class="inbox-chat-item @if ($chatMessage->sender_id == auth()->user()->id) my-chat @endif ">
                                                            <div class="inbox-chat-img">
                                                                @if ($chatMessage->sender_id == Auth::user()->id)
                                                                    <img src="{{ $authImage }}"
                                                                        alt="{{ $authImage }}" />
                                                                @else
                                                                    <img src="{{ $vendorImage }}"
                                                                        alt="{{ $vendorImage }}" />
                                                                @endif
                                                            </div>
                                                            <div class="inbox-chat-content">
                                                                <div class="inbox-chat-text">
                                                                    <p>{{ $chatMessage->message }}</p>
                                                                    <div class="inbox-chat-action">
                                                                        <a href="#" title="Remove"
                                                                            class="fas fa-trash-alt"></a>
                                                                    </div>
                                                                </div>
                                                                <small
                                                                    class="inbox-chat-time">{{ \Carbon\Carbon::parse($chatMessage->created_at)->diffForHumans() }}</small>
                                                            </div>
                                                        </li>
                                                    @endforeach

                                                </ul>
                                                <div class="inbox-chat-form">
                                                    <textarea id="message" placeholder="Type a Message" class="chat-box"></textarea>
                                                    <button id="sendMessage" type="button"><i
                                                            class="fas fa-paper-plane"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <!-- MESSAGE PART END -->
    <input type="hidden" id="vendorId" value="{{ $messages->first() ? $messages->first()->vendor_id : '' }}" />
    {{-- <input type="hidden" id="vendorId" value="{{ $firstVendorId }}" /> --}}

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.inbox-chat-list').scrollTop($('.inbox-chat-list')[0].scrollHeight);

            $('.message-filter-btn').on('click', function() {
                const $icon = $(this).find('i'); // Select the icon inside the button
                const $form = $('.message-filter-src'); // Select the search form

                $form.toggle(); // Toggle the visibility of the search form

                // Toggle the icon class
                if ($form.is(':visible')) {
                    $icon.removeClass('fa-search').addClass('fa-times'); // Switch to cross icon
                } else {
                    $icon.removeClass('fa-times').addClass('fa-search'); // Switch to search icon
                }
            });

            $(document).on('click', '#sendMessage', function() {
                const message = $('#message').val();
                const vendorId = $('#vendorId').val();
                console.log('Vendor ID:', vendorId);
                if (!vendorId) {
                    alert("Vendor ID is missing. Unable to start chat.");
                    return;
                }

                if (!message) {
                    alert("Please type a message to start chatting.");
                    return;
                }

                $.ajax({
                    url: '{{ route('send-message') }}',
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        vendor_id: vendorId,
                        message: message,
                    },
                    success: function(response) {
                        if (response.status === true) {
                            $('#message').val('');
                            $('#messageInbox').html(response.view);
                            $('.inbox-chat-list').scrollTop($('.inbox-chat-list')[0].scrollHeight);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        alert("An error occurred while sending the message.");
                    },
                });
            });

            $(document).on('click', '.message_vendor', function() {
                const vendorId = $(this).data('id');
                $('#vendorId').val(vendorId);
                console.log('Selected Vendor ID:', vendorId); // Log vendor ID
                $.ajax({
                    url: '{{ route('vendor-message') }}',
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        vendor_id: vendorId,
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $('#messageInbox').html(response.view);
                            $('.inbox-chat-list').scrollTop($('.inbox-chat-list')[0]
                                .scrollHeight);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching product data:', error);
                    },
                });
            });
        });
    </script>
@endsection
