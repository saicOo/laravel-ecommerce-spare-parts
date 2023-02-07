<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">{{__('site.dashboard')}}</li>
            <li><a href="{{route('dashboard.index')}}" aria-expanded="false"><i class="icon-speedometer"></i> <span class="nav-text">{{__('site.dashboard')}}</span></a></li>
            <li><a href="#" aria-expanded="false"><i class="icon-key"></i> <span class="nav-text">{{__('site.permissions')}}</span></a></li>
            <li><a href="#" aria-expanded="false"><i class="icon-settings"></i> <span class="nav-text">{{__('site.settings')}}</span></a></li>
            <li class="nav-label">{{__('site.people')}}</li>
            <li><a href="{{route('dashboard.admins.index')}}" aria-expanded="false"><i class="icon-user"></i> <span class="nav-text">{{__('site.admins')}}</span></a></li>
            <li><a href="#" aria-expanded="false"><i class="icon-user"></i> <span class="nav-text">{{__('site.clients')}}</span></a></li>
            <li class="nav-label">{{__('site.orders')}}</li>
            <li><a href="#" aria-expanded="false"><i class="icon-basket"></i> <span class="nav-text">{{__('site.orders')}}</span></a></li>
            <li class="nav-label">{{__('site.categories')}}</li>
            <li><a href="{{route('dashboard.categories.index')}}" aria-expanded="false"><i class="icon-organization"></i><span class="nav-text">{{__('site.categories')}}</span></a></li>
            <li><a href="{{route('dashboard.brands.index')}}" aria-expanded="false"><i class="icon-tag"></i><span class="nav-text">{{__('site.brands')}}</span></a></li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon-ghost"></i><span class="nav-text">{{__('site.cars')}}</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{route('dashboard.cars.index')}}">{{__('site.models')}} {{__('site.cars')}}</a></li>
                    <li><a href="{{route('dashboard.factory-cars.index')}}">{{__('site.factories')}} {{__('site.cars')}}</a></li>
                </ul>
            </li>
            <li><a href="{{route('dashboard.products.index')}}" aria-expanded="false"><i class="icon-puzzle"></i><span class="nav-text">{{__('site.products')}}</span></a></li>
        </ul>
    </div>
</div>
