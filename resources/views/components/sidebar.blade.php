<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">Admin Panel</span>
        </a>

        <ul class="sidebar-nav">

            @php
                // fetch and store current url
                $currentUrl = Request::url();   
            @endphp

            <li class="sidebar-item @if($currentUrl === route('dashboards.index')) active @endif">
                <a class="sidebar-link" href="{{ route('dashboards.index') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span
                        class="align-middle">Dashboard</span>
                </a>
            </li>
            
            @can('all', App\Models\Role::class)
                
                <li class="sidebar-item @if($currentUrl === route('roles.index')) active @endif">
                    <a class="sidebar-link" href="{{ route('roles.index') }}">
                        <i class="align-middle" data-feather="users"></i> <span
                            class="align-middle">Roles</span>
                    </a>
                </li>

            @endcan

            @can('viewAny', App\Models\User::class)

                <li class="sidebar-item @if($currentUrl === route('users.index')) active @endif">
                    <a class="sidebar-link" href="{{ route('users.index') }}">
                        <i class="align-middle" data-feather="users"></i> <span
                            class="align-middle">Users</span>
                    </a>
                </li>

            @endcan

            @can('all', App\Models\Category::class)

                <li class="sidebar-item @if($currentUrl === route('categories.index')) active @endif">
                    <a class="sidebar-link" href="{{ route('categories.index') }}">
                        <i class="align-middle" data-feather="server"></i> <span
                            class="align-middle">Categories</span>
                    </a>
                </li>

            @endcan

            @can('all', App\Models\Product::class)

                <li class="sidebar-item @if($currentUrl === route('products.index')) active @endif">
                    <a class="sidebar-link" href="{{ route('products.index') }}">
                        <i class="align-middle" data-feather="box"></i> <span
                            class="align-middle">Products</span>
                    </a>
                </li>

            @endcan

        </ul>

    </div>
</nav>