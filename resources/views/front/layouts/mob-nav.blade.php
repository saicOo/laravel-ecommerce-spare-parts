<div class="mobile-nav-wrapper" role="navigation">
    <div class="closemobileMenu"><i class="icon cps cp-times pull-right"></i> {{$setting->name}}</div>
    <ul id="MobileNav" class="mobile-nav">
        <li class="lvl1"><a href="{{ url('/') }}" class="active">@lang('site.home')</a></li>
        <li class="lvl1"><a href="{{ route('products.index') }}">@lang('site.products')</a></li>
        <li class="lvl1 parent"><a href="#">@lang('site.categories') <i class="cps cp-plus"></i></a>
            <ul>
                @foreach ($primary_categories as $primary_category)
                <li>
                    <a class="title text-uppercase" href="#">{{ $primary_category->name }} <i
                            class="cps cp-plus"></i></a>
                    <ul class="m-items lvl-1">
                        @foreach ($primary_category->subCategories as $sub_category)
                        <li><a href="{{ route('products.index') . '?category_id=' . $sub_category->id }}" class="site-nav">{{ $sub_category->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
        </li>
        @guest
        <li class="lvl1"><a href="{{ route('login') }}">@lang('site.login') & @lang('site.register')</a></li>
        @else
        <li class="lvl1"><a href="{{ route('users.index') }}">@lang('site.my_account')</a></li>
        <li class="lvl1"><a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"> @lang('site.logout')<form id="logout-form" action="{{ route('logout') }}" method="POST"
            style="display: none;">
            @csrf
        </form></a></li>
        @endguest
        <li class="social">
            <div class="list-inline m-0 social-icons">
                <span class="list-inline-item"><a href="#;" target="_blank" title="Facebook"><i
                            class="cpb cp-facebook-f"></i></a></span>
                <span class="list-inline-item"><a href="#;" target="_blank" title="Twitter"><i
                            class="cpb cp-twitter"></i></a></span>
                <span class="list-inline-item"><a href="#;" target="_blank" title="Instagram"><i
                            class="cpb cp-instagram"></i></a></span>
                <span class="list-inline-item"><a href="#;" target="_blank" title="Google Plus"><i
                            class="cpb cp-google-plus"></i></a></span>
                <span class="list-inline-item"><a href="#;" target="_blank" title="Linked In"><i
                            class="cpb cp-linkedin-in"></i></a></span>
                <span class="list-inline-item"><a href="#;" target="_blank" title="Youtube"><i
                            class="cpb cp-youtube"></i></a></span>
            </div>
        </li>
    </ul>
</div>
