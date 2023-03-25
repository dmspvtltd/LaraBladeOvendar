<div class="mobile-overlay-bottom d-flex justify-content-between d-md-none">
    <div>
        <a href="{{route('home')}}" class="active-menu-m">
            <i class="navbar-tool-icon czi-home"></i>
            <p>Home</p>
        </a>
    </div>
    <div>
        <a href="{{route('categories')}}">
            <i class="navbar-tool-icon czi-list"></i>
        <p>Categories</p>
        </a>
    </div>
    <div>
       <a href="{{ route('shop-cart') }}">
            <i class="navbar-tool-icon czi-cart"></i>
        <p>Cart</p>
       </a>
    </div>
    <div>
        @if(auth('customer')->check())
            <a href="{{route('account-oder')}}">
                <i class="navbar-tool-icon czi-user"></i>
                <p>Account</p>
            </a>
        @else
            <a href="{{route('customer.auth.login')}}">
                <i class="navbar-tool-icon czi-user"></i>
                <p>Dashboard</p>
            </a>
        @endif
    </div>
</div>