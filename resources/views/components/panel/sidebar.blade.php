<style>
    .font-bold {
        font-weight: bold;
        font-size: 15px !important;
    }
</style>

<!-- Divider -->
{{--        <hr class="sidebar-divider d-none d-md-block">--}}

{{-- -------------------------------------- User Routes -------------------------------------- --}}

@if(auth()->user()->hasRole('user'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.orders.data') }}">
            <i class="fas fa-box"></i>
            <span class="font-bold">Orders</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.settings') }}">
            <i class="fas fa-cog"></i>
            <span class="font-bold">General Settings</span></a>
    </li>
@endif

{{-- -------------------------------------- User Routes -------------------------------------- --}}

{{-- -------------------------------------- Admin Routes -------------------------------------- --}}

@if(auth()->user()->hasRole('admin'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('editors') }}">
            <i class="fas fa-user-edit"></i>
            <span class="font-bold">Editors</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('categories') }}">
            <i class="fas fa-tags"></i>
            <span class="font-bold">Categories</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('styles') }}">
            <i class="fas fa-paint-brush"></i>
            <span class="font-bold">Styles</span>
        </a>
    </li>
@endif


{{-- -------------------------------------- Admin Routes -------------------------------------- --}}
