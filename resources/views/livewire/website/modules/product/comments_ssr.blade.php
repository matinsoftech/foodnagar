<div class="wrap container">
    <!-- Add comment start -->
    <div class="comment-section">
        <textarea class="mb-2 comment_text" row="2" id="commentInput" placeholder="Write a comment..."></textarea>
        <div id="commentActions" class="mb-4 actions hidden">
            <button class="btn bg-danger text-white" id="cancelBtn">Cancel</button>
            <button class="btn bg-primary text-white comment_now" data-id="{{ $product_detail->id }}" id="commentBtn"
                disabled>Comment</button>
        </div>
    </div>
    <!-- Add comment start -->


    @foreach($comments as $comment)
    <div class="comment d-flex gap-3">
        <figure class="m-0 user_image rounded-circle overflow-hidden flex-shrink-0"
            style="width: 4rem;height: 4rem;">
            <img class="object-fit-cover w-100"
                src="https://randomuser.me/api/portraits/men/50.jpg" alt="User Image">
        </figure>
        <div class="comment-details">
            <!-- Comment -->
            <div class="p-3 rounded" style="background-color: #f2f4f7;">
                <div class="user_name fw-bold">{{ $comment->user->name }}</div>
                <p class="m-0" style="max-width: 70ch;">
                    {{ $comment->message }}
                </p>
            </div>
            <!--  -->
            <!--Sub comment Start-->
            <!--  -->
            @if($comment->replies)
            <div class="replies_{{ $comment->id }} @if($request->thread_id != $comment->id) hidden @endif" id="sub_comment">
                
                @foreach($comment->replies as $reply)
                <div class="comment d-flex gap-3 mt-3 flex-wrap">
                    <figure
                        class="m-0 user_image rounded-circle overflow-hidden flex-shrink-0"
                        style="width: 4rem;height: 4rem;">
                        <img class="object-fit-cover w-100"
                            src="https://randomuser.me/api/portraits/men/50.jpg"
                            alt="User Image">
                    </figure>
                    <div class="comment-details">
                        <div class="p-3 rounded" style="background-color: #f2f4f7;">
                            <div class="user_name fw-bold"> {{ $reply->user->name }} </div>
                            <p class="m-0" style="max-width: 70ch;">
                                {{ $reply->message }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            @endif
            <!--  -->
            <!--Sub comment End-->
            <!--  -->

            <!-- Toggle User Reply field start -->
            <button class="reply-toggle-btn border-0 bg-white me-3" data-comment_id="{{ $comment->id }}">
                Reply
            </button>
            <!-- Toggle User Reply field start -->

            <button class="comment_reply_toggle mt-2 border bg-white border-0" data-comment_id="{{ $comment->id }}">
                <svg style="width: 1rem;" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
                {{ $comment->replies->count() }} Replies
            </button>
            <!-- Submit User Reply -->
            <div class="reply mt-3 @if($request->thread_id != $comment->id ) hidden @endif comment_reply_{{ $comment->id }}">
                <textarea class="p-2 pb-0 w-100 rounded user_reply_{{ $comment->id }}" placeholder="Reply.." name="" id=""></textarea>
                <button class="reply_submit btn btn-primary" data-product_id="{{ $product_detail->id }}" data-comment_id="{{ $comment->id }}">Reply</button>
                <button class="reply_cancel btn btn-danger">Cancel</button>
            </div>
            <!-- Submit User Reply End-->
        </div>
    </div>
    @endforeach


</div>