@section('title', __('Message'))
@extends('layouts.app')

@section('content')
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

        .row {
            --fc-gutter-x: 2rem;
            --fc-gutter-y: 0;
            display: flex;
            flex-wrap: wrap;
            margin-left: calc(var(--fc-gutter-x)* -.5);
            margin-right: calc(var(--fc-gutter-x)* -.5);
            margin-top: calc(var(--fc-gutter-y)* -1);
        }

        .row>* {
            flex-shrink: 0;
            margin-top: var(--fc-gutter-y);
            max-width: 100%;
            padding-left: calc(var(--fc-gutter-x)* .5);
            padding-right: calc(var(--fc-gutter-x)* .5);
            width: 100%;
        }

        @media (min-width: 1200px) {
            .col-xl-8 {
                flex: 0 0 auto;
                width: 66.66666667%;
            }

            .col-xl-4 {
                flex: 0 0 auto;
                width: 33.33333333%;
            }

        }

        @media (min-width: 992px) {
            .col-lg-7 {
                flex: 0 0 auto;
                width: 58.33333333%;
            }

            .col-lg-5 {
                flex: 0 0 auto;
                width: 41.66666667%;
            }

        }
    </style>



    <!-- MESSAGE PART START -->
    <section class="message-part mb-5" style="background: unset;">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-xl-4">
                    <div class="message-filter">
                        <div class="message-filter-group">
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
                            @foreach($messages as $message)
                            <li class="message-item unread message_vendor" data-id="{{ $message->user->id }}">

                                <a href="#" class="message-link">
                                    <div class="message-img active">
                                        @php
                                            $vendorPhoto = $message->user->photo ?? asset('images/user.png');
                                        @endphp
                                        <img src="{{ $vendorPhoto }}"
                                            alt="avatar">
                                    </div>
                                    <div class="message-text">
                                        <h6>{{ $message->user->name }} <span> {{ ($message->updated_at)? \Carbon\Carbon::parse($message->updated_at)->diffForHumans() : now()->diffForHumans() }}</span></h6>
                                        <p>{{ $chatMessages->first() ? $chatMessages->first()->message : '' }}</p>
                                    </div>
                                    <span class="message-count">{{ $chatMessages->count() }}</span>
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-7 col-xl-8">
                    <div id="messageInbox" class="message-inbox">
                        <div class="inbox-header">
                            <div class="inbox-header-profile">
                                <a class="inbox-header-img" href="#">
                                    <img src="{{ $vendorImage }}"
                                        alt="avatar">
                                </a>
                                @if(isset($message))
                                <div class="inbox-header-text">
                                    <h5><a href="#">{{ $message?->user?->name  }}</a></h5>
                                    <span>{{ ($message?->updated_at)? \Carbon\Carbon::parse($message->updated_at)->diffForHumans() : now()->diffForHumans() }}</span>
                                </div>
                                @endif
                            </div>
                            <ul class="inbox-header-list">
                                <li><a href="#" title="Delete" class="fas fa-trash-alt"></a></li>
                                <li><a href="#" title="Report" class="fas fa-flag"></a></li>
                                <li><a href="#" title="Block" class="fas fa-shield-alt"></a></li>
                            </ul>
                        </div>
                        <ul class="inbox-chat-list">
                            @foreach($chatMessages as $chatMessage)
                            <li class="inbox-chat-item @if($chatMessage->sender_id == auth()->user()->id) my-chat @endif ">
                                <div class="inbox-chat-img">
                                    @if($chatMessage->sender_id == Auth::user()->id)
                                        <img src="{{ $authImage }}" alt="{{ $authImage }}" />
                                    @else
                                        <img src="{{ $vendorImage }}" alt="{{ $vendorImage }}" />
                                    @endif
                                </div>
                                <div class="inbox-chat-content">
                                    <div class="inbox-chat-text">
                                        <p>{{ $chatMessage->message }}</p>
                                        <div class="inbox-chat-action">
                                            <a href="#" title="Remove" class="fas fa-trash-alt"></a>
                                        </div>
                                    </div>
                                    <small class="inbox-chat-time">{{ \Carbon\Carbon::parse($chatMessage->created_at)->diffForHumans() }}</small>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                        <div class="inbox-chat-form">
                            <textarea id="message" placeholder="Type a Message" class="chat-box"></textarea>
                            <button id="sendMessage" type="button"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <input type="hidden" id="vendorId" value="{{ ($messages->first())? $messages->first()->user_id : '' }}" />
    </section>
    <!-- MESSAGE PART END -->
@endsection

@push('scripts')
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

            $(document).on('click','#sendMessage', function() {
                const message = $('#message').val();
                const vendorId = $('#vendorId').val();
				console.log("send");
                $.ajax({
                    url: '{{ url("admin/send-message") }}',
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        message: message,
                        vendor_id: vendorId,
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $('#message').val('');
                            $('#messageInbox').html(response.view);
                            $('.inbox-chat-list').scrollTop($('.inbox-chat-list')[0].scrollHeight);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching product data:', error);
                    },
                });
            });

            $(document).on('click','.message_vendor',function(){
                const vendorId = $(this).data('id');
                $('#vendorId').val(vendorId);
                $('#messageInbox').html('');
                $.ajax({
                    url: '{{ url("admin/customer-message") }}',
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        vendor_id: vendorId,
                    },
                    success: function(response) {
                        if (response.status == true) {
                            $('#messageInbox').html(response.view);
                            $('.inbox-chat-list').scrollTop($('.inbox-chat-list')[0].scrollHeight);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching product data:', error);
                    },
                });
            });
        });
    </script>
@endpush
