<div class="top-bar">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-4 d-flex justify-content-lg-start justify-content-center">
                <span class="phone-top d-flex align-items-center"> <a href="tel:123-456-7890"><i class="icon cps cp-phone align-middle px-1"></i> <span class="label">{{$setting->phone}}</span></a></span>
                <span class="language-dropdown top-dropdown d-flex align-items-center">
                    <i class="cps cp-language"></i>
                    <ul class="nav">
                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li class="nav-item"><a class="nav-link {{$localeCode == app()->getLocale() ? 'active' : ''}}" rel="alternate" hreflang="{{ $localeCode }}"
                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a></li>
                        @endforeach
                    </ul>
                </span>
            </div>
            <div class="col-xl-4 d-md-flex d-none justify-content-center p-0"><div class="shipping-msg"><b>15%</b> every products we have a great offer for you. <a href="#" class="btn btn-secondary btn--small rounded-pill">Shop Now</a></div></div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-4 justify-content-end d-none d-lg-flex">
                @if (Auth::user())
                <div class="setting-link">
                    <a href="javascript:void(0);"><i class="cp cp-user-circle"></i> <span class="label">{{Auth::user()->first_name}}</span></a>
                    <div id="settingsBox">
                        <ul>
                            <li><a href="{{ route('users.index') }}">@lang('site.my_account')</a></li>
                            <li><a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">@lang('site.logout')</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form></li>
                        </ul>
                    </div>
                </div>
                @endif
                <ul class="list-inline m-0 social-icons">
                    <li class="list-inline-item"><a href="#;" target="_blank" title="Facebook"><i class="cpb cp-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="#;" target="_blank" title="Twitter"><i class="cpb cp-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#;" target="_blank" title="Instagram"><i class="cpb cp-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="#;" target="_blank" title="Google Plus"><i class="cpb cp-google-plus"></i></a></li>
                    <li class="list-inline-item"><a href="#;" target="_blank" title="Linked In"><i class="cpb cp-linkedin-in"></i></a></li>
                    <li class="list-inline-item"><a href="#;" target="_blank" title="Youtube"><i class="cpb cp-youtube"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
