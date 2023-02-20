<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">{{__('site.dashboard')}}</li>
            <li><a href="{{route('dashboard.index')}}" aria-expanded="false"><i class="icon-speedometer"></i> <span class="nav-text">{{__('site.dashboard')}}</span></a></li>
            @can('check-permissions','read_admins')
            <li><a href="{{route('dashboard.settings.index')}}" aria-expanded="false"><i class="icon-settings"></i> <span class="nav-text">{{__('site.settings')}}</span></a></li>
            @endcan
            <li class="nav-label">{{__('site.users')}}</li>
            @can('check-permissions','read_admins')
            <li><a href="{{route('dashboard.admins.index')}}" aria-expanded="false"><i class="icon-user"></i> <span class="nav-text">{{__('site.admins')}}</span></a></li>
            @endcan
            @can('check-permissions','read_users')
            <li><a href="{{route('dashboard.clients.index')}}" aria-expanded="false"><i class="icon-user"></i> <span class="nav-text">{{__('site.clients')}}</span></a></li>
            @endcan
            <li class="nav-label">{{__('site.orders')}}</li>
            @can('check-permissions','read_orders')
            <li><a href="{{route('dashboard.orders.index')}}" aria-expanded="false"><i class="icon-basket"></i> <span class="nav-text">{{__('site.orders')}}</span></a></li>
            @endcan
            <li class="nav-label">{{__('site.categories')}}</li>
            @can('check-permissions','read_categories')
            <li><a href="{{route('dashboard.categories.index')}}" aria-expanded="false"><i class="icon-organization"></i><span class="nav-text">{{__('site.categories')}}</span></a></li>
            @endcan
            @can('check-permissions','read_brands')
            <li><a href="{{route('dashboard.brands.index')}}" aria-expanded="false"><i class="icon-tag"></i><span class="nav-text">{{__('site.brands')}}</span></a></li>
            @endcan
            @can('check-permissions','read_cars')
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon-ghost"></i><span class="nav-text">{{__('site.cars')}}</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{route('dashboard.cars.index')}}">{{__('site.models')}} {{__('site.cars')}}</a></li>
                    <li><a href="{{route('dashboard.factory-cars.index')}}">{{__('site.factories')}} {{__('site.cars')}}</a></li>
                </ul>
            </li>
            @endcan
            @can('check-permissions','read_products')
            <li><a href="{{route('dashboard.products.index')}}" aria-expanded="false"><i class="icon-puzzle"></i><span class="nav-text">{{__('site.products')}}</span></a></li>
            @endcan
        </ul>
    </div>
</div>
