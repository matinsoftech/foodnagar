<!-- col -->
<div class="col-lg-3 col-md-4 col-12 border-end d-none d-md-block">
    <div class="pt-10 pe-lg-10">
        <!-- nav item -->
        <ul class="nav flex-column nav-pills nav-pills-dark">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account-orders') ? 'active' : '' }}"
                    href="{{ url('account-orders') }}">
                    <i class="feather-icon icon-shopping-bag me-2"></i>
                    Your Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account-settings') ? 'active' : '' }}"
                    href="{{ url('account-settings') }}">
                    <i class="feather-icon icon-settings me-2"></i>
                    Settings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('message') ? 'active' : '' }}" href="{{ url('message') }}">
                    <img class="me-2" src="{{ asset('css/assets/images/send.svg') }}" alt="message"
                        style="width: 14px; height: 14px;">
                    Message
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('ad-listing') ? 'active' : '' }}"
                    href="{{ route('user-add-listing') }}">
                    <i class="feather-icon icon-map-pin me-2"></i>
                    Add Listing
                </a>
            </li>
           <li class="nav-item">
                 {{--<a class="nav-link {{ Request::is('user-index') ? 'active' : '' }}"
                    href="{{ route('user-index', ['userId' => auth()->user()->id]) }}">
                    <i class="feather-icon icon-map-pin me-2"></i>
                    My Listing
                </a>--}}
                <a class="nav-link {{ Request::is('user-index') ? 'active' : '' }}"
                   href="{{ auth()->check() ? route('user-index', ['userId' => auth()->user()->id]) : '#' }}">
                    <i class="feather-icon icon-map-pin me-2"></i>
                    My Listing
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link {{ Request::is('user-product-enquiry') ? 'active' : '' }}"
                    href="{{ route('user-product-enquiry') }}">
                    <i class="fa-solid fa-circle-exclamation icon-map-pin me-2"></i>
                    {{-- <i class="feather-icon icon-map-pin me-2"></i> --}}
                    My Enquiries
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('my-ads') ? 'active' : '' }}"
                    href="{{ url('my-ads') }}">
                    <i class="feather-icon icon-map-pin me-2"></i>
                    My Ads
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account-address') ? 'active' : '' }}"
                    href="{{ url('account-address') }}">
                    <i class="feather-icon icon-map-pin me-2"></i>
                    Address
                </a>
            </li>
            {{--  <li class="nav-item">
                <a class="nav-link {{ Request::is('account-payment-method') ? 'active' : '' }}"
                    href="{{ url('account-payment-method') }}">
                    <i class="feather-icon icon-credit-card me-2"></i>
                    Payment Method
                </a>
            </li>  --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('account-notification') ? 'active' : '' }}"
                    href="{{ url('account-notification') }}">
                    <i class="feather-icon icon-bell me-2"></i>
                    Notification
                </a>
            </li>
            <li class="nav-item">
                <hr />
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('web_logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link {{ Request::is('/') ? 'active' : '' }}"
                        style="text-decoration: none;">
                        <i class="feather-icon icon-log-out me-2"></i>
                        Log out
                    </button>
                </form>
            </li>
        </ul>

    </div>
</div>
