<div class="inbox-header">
    <div class="inbox-header-profile">
        <a class="inbox-header-img" href="#">
            <img src="{{ $vendorImage }}"
                alt="avatar">
        </a>
        <div class="inbox-header-text">
            <h5><a href="#">{{ $vendor->name  }}</a></h5>
            <span>{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</span>
        </div>
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
            @if($chatMessage->sender_id == auth()->user()->id)
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